<?php
// Unified "serve an uploaded file back for viewing" endpoint
// (?scope=umbrella | project | form). Sanitizes the ID the same way
// upload_handler.php did before saving, or the lookup can never find what's
// actually on disk. Replaces the old view_files.php, project_view_files.php,
// and forms_view_files.php.
//
// Connects to:
//   - js/tree_view.js  — builds this file's URL and opens it in the popup
//   - upload_handler.php — must sanitize scoped IDs identically to this file

$SCOPES = [
    'umbrella' => [
        'param'     => 'umbrella_id',
        'folder'    => 'umbrella',
        'documents' => ['Project Approval', 'Project Drawing', 'Circuit Diagram'],
    ],
    'project' => [
        'param'     => 'project_id',
        'folder'    => 'project',
        'documents' => ['Project Approval', 'Project Drawing', 'Circuit Diagram'],
    ],
    'form' => [
        'param'     => 'unique_form_id',
        'folder'    => 'forms',
        'documents' => ['Test Report', 'Photograph', 'Calibration Cert'],
    ],
];

$scope = $_GET['scope'] ?? '';
if (!isset($SCOPES[$scope])) {
    http_response_code(400);
    exit('Invalid or missing scope.');
}
$cfg = $SCOPES[$scope];

$scopedId     = trim($_GET[$cfg['param']]   ?? '');
$documentName = trim($_GET['document_name'] ?? '');

$allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];

if (
    $scopedId === '' ||
    !in_array($documentName, $cfg['documents'], true)
) {
    http_response_code(400);
    exit('Invalid file request.');
}

// Same sanitization upload_handler.php applies before saving — must match
// exactly, or a lookup can never find what was actually stored on disk.
$safeScopedId      = preg_replace('/[^A-Za-z0-9_-]/', '_', $scopedId);
$safeDocumentName  = preg_replace('/[^A-Za-z0-9_-]/', '_', $documentName);

if ($safeScopedId === '') {
    http_response_code(400);
    exit('Invalid file request.');
}

$uploadDir = __DIR__ . '/../uploads/' . $cfg['folder'];
$files = glob($uploadDir . '/' . $safeScopedId . '_' . $safeDocumentName . '.*');
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
