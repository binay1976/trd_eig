<?php
const UPLOAD_DIRECTORY = '/var/www/trd_eig/uploads/umbrella';

$umbrellaId = trim($_GET['umbrella_id'] ?? '');
$documentName = trim($_GET['document_name'] ?? '');

$allowedDocuments = [
    'Project Approval',
    'Project Drawing',
    'Circuit Diagram'
];
$allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];

if (
    !preg_match('/^[A-Za-z0-9_-]+$/', $umbrellaId) ||
    !in_array($documentName, $allowedDocuments, true)
) {
    http_response_code(400);
    exit('Invalid file request.');
}

$safeDocumentName = preg_replace('/[^A-Za-z0-9_-]/', '_', $documentName);
$files = glob(UPLOAD_DIRECTORY . '/' . $umbrellaId . '_' . $safeDocumentName . '.*');
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
