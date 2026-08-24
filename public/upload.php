<?php
session_start();
header('Content-Type: application/json');

// const UPLOAD_DIRECTORY = '/var/www/trd_eig/storage/umbrella_uploads';
$uploadFolders = [
    'umbrella' => '/var/www/trd_eig/storage/umbrella_uploads',
    'project'  => '/var/www/trd_eig/storage/project_uploads',
    'equipment' => '/var/www/trd_eig/storage/equiments_uploads'
];

$uploadType = $_POST['upload_type'] ?? '';

if (!isset($uploadFolders[$uploadType])) {
    respond(false, 'Invalid upload destination.', 400);
}

$uploadDirectory = $uploadFolders[$uploadType];


function respond(bool $success, string $message, int $status = 200, array $extra = [])
{
    http_response_code($status);
    echo json_encode(array_merge(['success' => $success, 'message' => $message], $extra));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.', 405);
}

$umbrellaId = trim($_POST['umbrella_id'] ?? '');
$documentName = trim($_POST['document_name'] ?? '');

if ($umbrellaId === '' || !preg_match('/^[A-Za-z0-9_-]+$/', $umbrellaId)) {
    respond(false, 'Please select a valid Umbrella ID.', 400);
}

$allowedDocuments = ['Project Approval', 'Project Drawing', 'Circuit Diagram'];
if (!in_array($documentName, $allowedDocuments, true)) {
    respond(false, 'Invalid document type.', 400);
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    $uploadError = $_FILES['file']['error'] ?? UPLOAD_ERR_NO_FILE;
    if ($uploadError === UPLOAD_ERR_INI_SIZE || $uploadError === UPLOAD_ERR_FORM_SIZE) {
        $message = 'The selected file is too large.';
    } elseif ($uploadError === UPLOAD_ERR_NO_FILE) {
        $message = 'Please select a file.';
    } else {
        $message = 'The file upload failed.';
    }
    respond(false, $message, 400);
}

$file = $_FILES['file'];
$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];

if (!in_array($extension, $allowedExtensions, true)) {
    respond(false, 'Allowed file types: PDF, Word, Excel, JPG and PNG.', 400);
}

if ($file['size'] > 10 * 1024 * 1024) {
    respond(false, 'The maximum file size is 10 MB.', 400);
}

$allowedMimeTypes = [
    'pdf' => ['application/pdf'],
    'doc' => ['application/msword', 'application/octet-stream'],
    'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip'],
    'xls' => ['application/vnd.ms-excel', 'application/octet-stream'],
    'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip'],
    'jpg' => ['image/jpeg'],
    'jpeg' => ['image/jpeg'],
    'png' => ['image/png']
];
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = $fileInfo ? finfo_file($fileInfo, $file['tmp_name']) : '';
if ($fileInfo) {
    finfo_close($fileInfo);
}

if (!in_array($mimeType, $allowedMimeTypes[$extension], true)) {
    respond(false, 'The selected file content does not match its file type.', 400);
}

$safeDocumentName = str_replace(' ', '_', $documentName);
$fileName = $umbrellaId . '_' . $safeDocumentName . '.' . $extension;
$destination = $uploadDirectory . '/' . $fileName;

if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0775, true)) {
    respond(false, 'Upload folder is not available on the server.', 500);
}

if (!is_writable($uploadDirectory)) {
    respond(false, 'Upload folder is not writable by the web server.', 500);
}

if (!move_uploaded_file($file['tmp_name'], $destination)) {
    respond(false, 'Could not save the file on the server.', 500);
}

respond(true, 'File uploaded successfully.', 200, ['file_name' => $fileName]);