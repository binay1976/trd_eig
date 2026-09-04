<?php
/**
 * std_upload.php
 * Upload handler + list + view for Standard Forms attachments, modeled
 * directly on upload_handler.php / get_uploads.php but scoped to
 * type='STDID' and storing files under uploads/stdforms/. Reuses the same
 * project_uploads table — project_id column holds the form's
 * unique_stdform_id. document_id='signed_copy' is the DSC-signed-copy
 * slot; any other document_id is a plain, freely-added attachment.
 */

require_once __DIR__ . '/std_common.php';

header('Content-Type: application/json; charset=utf-8');

function std_upload_fail(string $message, int $code = 400): void
{
    http_response_code($code);
    echo json_encode(['success' => false, 'message' => $message]);
    exit;
}

const STD_UPLOAD_DIR = 'uploads/stdforms/';

// ── GET ?action=view&id= : stream a file back ────────────────────────────────
if (($_GET['action'] ?? '') === 'view' && isset($_GET['id'])) {
    header_remove('Content-Type');
    $id = (int) $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM project_uploads WHERE id = ? AND type = 'STDID' LIMIT 1");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if (!$row) {
        http_response_code(404);
        exit('File not found.');
    }
    $filePath = dirname(__DIR__, 2) . '/' . ltrim($row['file_path'], '/');
    if (!is_file($filePath)) {
        http_response_code(404);
        exit('File not found.');
    }
    $mimeType = $row['mime_type'] ?: (mime_content_type($filePath) ?: 'application/octet-stream');
    header('Content-Type: ' . $mimeType);
    header('Content-Length: ' . filesize($filePath));
    header('Content-Disposition: inline; filename="' . basename($row['original_name']) . '"');
    readfile($filePath);
    exit;
}

// ── GET ?unique_stdform_id= : list uploads for a form instance ──────────────
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $targetId = trim($_GET['unique_stdform_id'] ?? '');
    if ($targetId === '') {
        std_upload_fail('unique_stdform_id is required.');
    }
    $stmt = $pdo->prepare("
        SELECT id, document_id, original_name, file_size, mime_type, uploaded_by, uploaded_at
        FROM project_uploads
        WHERE type = 'STDID' AND project_id = ?
        ORDER BY (document_id = 'signed_copy') DESC, uploaded_at ASC
    ");
    $stmt->execute([$targetId]);
    echo json_encode(['success' => true, 'uploads' => $stmt->fetchAll()]);
    exit;
}

// ── POST : upload a file ─────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    std_upload_fail('Invalid request method.', 405);
}

$targetId   = trim($_POST['unique_stdform_id'] ?? '');
$documentId = trim($_POST['document_id'] ?? '');
$projectId  = trim($_POST['project_id'] ?? '');
$formNo     = trim($_POST['form_no'] ?? '');
$umbrellaId = trim($_POST['umbrella_id'] ?? '');

if ($targetId === '') {
    std_upload_fail('unique_stdform_id is required.');
}
if ($documentId === '') {
    $documentId = 'att_' . bin2hex(random_bytes(4));
}

if (!isset($_FILES['file'])) {
    std_upload_fail('No file was received.');
}
$file = $_FILES['file'];
if ($file['error'] !== UPLOAD_ERR_OK) {
    $errors = [
        UPLOAD_ERR_INI_SIZE   => 'File exceeds the server upload limit.',
        UPLOAD_ERR_FORM_SIZE  => 'File exceeds the allowed size.',
        UPLOAD_ERR_PARTIAL    => 'File was only partially uploaded.',
        UPLOAD_ERR_NO_FILE    => 'No file was selected.',
        UPLOAD_ERR_NO_TMP_DIR => 'Temporary upload directory is missing.',
        UPLOAD_ERR_CANT_WRITE => 'Server cannot write the uploaded file.',
        UPLOAD_ERR_EXTENSION  => 'PHP stopped the file upload.',
    ];
    std_upload_fail($errors[$file['error']] ?? 'File upload failed.');
}

$allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];
$maxFileSize       = 50 * 1024 * 1024;
$originalName      = basename($file['name']);
$extension         = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

if (!in_array($extension, $allowedExtensions, true)) {
    std_upload_fail('File type not allowed.');
}
if ($file['size'] > $maxFileSize) {
    std_upload_fail('File exceeds the 50 MB limit.');
}

$baseUploadDir = dirname(__DIR__, 2) . '/' . STD_UPLOAD_DIR;
$safeTargetId  = preg_replace('/[^A-Za-z0-9_-]/', '_', $targetId);
if ($safeTargetId === '') {
    std_upload_fail('Invalid form instance ID.');
}

if (!is_dir($baseUploadDir) && !mkdir($baseUploadDir, 0770, true)) {
    std_upload_fail('Could not create upload storage.', 500);
}
if (!is_writable($baseUploadDir)) {
    std_upload_fail('Upload storage is not writable.', 500);
}

$safeDocumentId = preg_replace('/[^A-Za-z0-9_-]/', '_', $documentId);
$storedName     = $safeTargetId . '_' . $safeDocumentId . '_' . time() . '.' . $extension;
$destPath       = $baseUploadDir . $storedName;

if (!move_uploaded_file($file['tmp_name'], $destPath)) {
    std_upload_fail('Could not save uploaded file.', 500);
}

$mimeType     = mime_content_type($destPath) ?: ($file['type'] ?? 'application/octet-stream');
$fileSize     = $file['size'];
$relativePath = STD_UPLOAD_DIR . $storedName;
$uploadedBy   = std_identity();

try {
    $check = $pdo->prepare("SELECT id, file_path FROM project_uploads WHERE type = 'STDID' AND project_id = ? AND document_id = ? LIMIT 1");
    $check->execute([$targetId, $documentId]);
    $existing = $check->fetch();

    if ($existing) {
        $pdo->prepare("
            UPDATE project_uploads
            SET original_name = ?, stored_name = ?, file_path = ?, file_size = ?, mime_type = ?, uploaded_by = ?, uploaded_at = NOW()
            WHERE id = ?
        ")->execute([$originalName, $storedName, $relativePath, $fileSize, $mimeType, $uploadedBy, $existing['id']]);

        if (!empty($existing['file_path'])) {
            $oldPath = dirname(__DIR__, 2) . '/' . ltrim($existing['file_path'], '/');
            if (is_file($oldPath) && $oldPath !== $destPath) {
                @unlink($oldPath);
            }
        }
        $recordId = $existing['id'];
    } else {
        $pdo->prepare("
            INSERT INTO project_uploads (type, project_id, document_id, original_name, stored_name, file_path, file_size, mime_type, uploaded_by, uploaded_at)
            VALUES ('STDID', ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ")->execute([$targetId, $documentId, $originalName, $storedName, $relativePath, $fileSize, $mimeType, $uploadedBy]);
        $recordId = $pdo->lastInsertId();
    }

    // Uploading the designated "signed copy" slot flips the signature status.
    if ($documentId === 'signed_copy' && $projectId !== '' && $formNo !== '') {
        std_save_entry_data($pdo, $umbrellaId, $projectId, $formNo, [
            'signature' => [
                'required'  => true,
                'status'    => 'signed',
                'signed_at' => date('c'),
                'marked_by' => $uploadedBy,
                'upload_id' => (int) $recordId,
            ],
        ]);
    }
} catch (PDOException $e) {
    if (is_file($destPath)) {
        @unlink($destPath);
    }
    error_log('Std Upload DB Error: ' . $e->getMessage());
    std_upload_fail('Database error while saving upload.', 500);
}

echo json_encode([
    'success'       => true,
    'message'       => 'File uploaded successfully.',
    'document_id'   => $documentId,
    'original_name' => $originalName,
    'id'            => $recordId,
]);
