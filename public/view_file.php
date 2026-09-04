<?php
// This Code is for Showing Uploaded files----------------------------------------------------------------------------


require_once __DIR__ . '/../config/database.php';

const UPLOAD_ROOT = __DIR__ . '/../uploads';

if (($_GET['scope'] ?? '') === 'form') {
    $targetId = trim($_GET['unique_form_id'] ?? '');
    $documentId = trim($_GET['document_id'] ?? '');

    if ($targetId === '' || $documentId === '') {
        http_response_code(400);
        exit('Invalid file request.');
    }

    $stmt = $pdo->prepare(
        'SELECT file_path, original_name, mime_type FROM project_uploads WHERE type = ? AND project_id = ? AND document_id = ? LIMIT 1'
    );
    $stmt->execute(['ULEID', $targetId, $documentId]);
    $upload = $stmt->fetch(PDO::FETCH_ASSOC);
    $uploadRoot = realpath(UPLOAD_ROOT . '/forms');
    $filePath = $upload ? realpath(__DIR__ . '/../' . ltrim($upload['file_path'], '/')) : false;

    if (!$upload || !$uploadRoot || !$filePath || strpos($filePath, $uploadRoot . DIRECTORY_SEPARATOR) !== 0 || !is_file($filePath)) {
        http_response_code(404);
        exit('File not found.');
    }

    header('Content-Type: ' . ($upload['mime_type'] ?: 'application/octet-stream'));
    header('Content-Length: ' . filesize($filePath));
    header('Content-Disposition: inline; filename="' . basename($upload['original_name']) . '"');
    readfile($filePath);
    exit;
}

$isProject = isset($_GET['project_id']);
$targetId = trim($_GET[$isProject ? 'project_id' : 'umbrella_id'] ?? '');
$validationId = str_replace(['\\', '|'], '', $targetId);
$documentName = trim($_GET['document_name'] ?? '');
$uploadLevel = $isProject ? 'Project' : 'Umbrella';
$allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];

// Document names are driven by uploads_master (see upload_umbrella.php /
// upload_project.php) rather than a fixed list, so validate against that
// same table instead of a hardcoded allowlist.
$stmt = $pdo->prepare("SELECT 1 FROM uploads_master WHERE particulars = ? AND upload_level = ? AND status = 'ACTIVE' LIMIT 1");
$stmt->execute([$documentName, $uploadLevel]);
$isKnownDocument = (bool) $stmt->fetchColumn();

if (
    !preg_match('/^[A-Za-z0-9_-]+$/', $validationId) ||
    !$isKnownDocument
) {
    http_response_code(400);
    exit('Invalid file request.');
}

$safeDocumentName = preg_replace('/[^A-Za-z0-9_-]/', '_', $documentName);
$safeTargetId = preg_replace('/[^A-Za-z0-9_-]/', '_', $targetId);
$uploadDirectory = $isProject ? 'project' : 'umbrella';
$files = glob(UPLOAD_ROOT . '/' . $uploadDirectory . '/' . $safeTargetId . '_' . $safeDocumentName . '.*');
$files = array_filter($files, function ($file) use ($allowedExtensions) {
    return is_file($file) && in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $allowedExtensions, true);
});

if (!$files) {
    http_response_code(404);
    exit('File not found.');
}

$filePath = reset($files);
$mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

header('Content-Type: ' . $mimeType);
header('Content-Length: ' . filesize($filePath));
header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
readfile($filePath);
exit;