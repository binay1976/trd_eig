<?php

// ============================================================
// DEBUG MODE
// ============================================================

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// ============================================================
// ERROR HANDLER
// ============================================================

function showDebugError($title, $data = [])
{
    http_response_code(200);

    echo '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Debug - ' . htmlspecialchars($title) . '</title>

        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f3f4f6;
                padding: 30px;
                margin: 0;
            }

            .box {
                max-width: 1000px;
                margin: auto;
                background: white;
                border-radius: 12px;
                padding: 25px;
                box-shadow: 0 4px 20px rgba(0,0,0,.1);
            }

            h2 {
                color: #dc2626;
                margin-top: 0;
            }

            .row {
                margin: 12px 0;
                padding: 12px;
                background: #f9fafb;
                border-left: 4px solid #2563eb;
                word-break: break-all;
            }

            .label {
                font-weight: bold;
                color: #374151;
            }

            .value {
                color: #111827;
                margin-top: 5px;
                font-family: monospace;
            }

            .success {
                color: #15803d;
            }

            .error {
                color: #dc2626;
            }

            pre {
                background: #111827;
                color: #22c55e;
                padding: 15px;
                border-radius: 8px;
                overflow: auto;
            }
        </style>
    </head>

    <body>

    <div class="box">

        <h2>⚠ File Viewer Debug Information</h2>

        <h3>' . htmlspecialchars($title) . '</h3>';

    foreach ($data as $key => $value) {

        if (is_array($value)) {
            $value = '<pre>' .
                htmlspecialchars(print_r($value, true)) .
                '</pre>';
        } else {
            $value = htmlspecialchars((string)$value);
        }

        echo '
        <div class="row">
            <div class="label">' . htmlspecialchars($key) . '</div>
            <div class="value">' . $value . '</div>
        </div>';
    }

    echo '
    </div>

    </body>
    </html>';

    exit;
}


// ============================================================
// CONFIGURATION
// ============================================================

$SCOPES = [

    'umbrella' => [
        'param' => 'umbrella_id',
        'folder' => 'umbrella'
    ],

    'project' => [
        'param' => 'project_id',
        'folder' => 'project'
    ],

    'form' => [
        'param' => 'unique_form_id',
        'folder' => 'forms'
    ]

];


// ============================================================
// GET PARAMETERS
// ============================================================

$scope = $_GET['scope'] ?? '';

if (!isset($SCOPES[$scope])) {

    showDebugError('INVALID SCOPE', [

        'Received scope' => $scope,

        'Available scopes' => array_keys($SCOPES),

        'GET Parameters' => $_GET

    ]);
}


$cfg = $SCOPES[$scope];

$paramName = $cfg['param'];

$scopedId = trim($_GET[$paramName] ?? '');

$documentName = trim($_GET['document_name'] ?? '');


// ============================================================
// VALIDATE PARAMETERS
// ============================================================

if ($scopedId === '') {

    showDebugError('MISSING ID', [

        'Scope' => $scope,

        'Expected parameter' => $paramName,

        'Received GET Parameters' => $_GET

    ]);
}


if ($documentName === '') {

    showDebugError('MISSING DOCUMENT NAME', [

        'Scope' => $scope,

        'Scoped ID' => $scopedId,

        'GET Parameters' => $_GET

    ]);
}


// ============================================================
// SANITIZE
// ============================================================

$safeScopedId = preg_replace(
    '/[^A-Za-z0-9_-]/',
    '_',
    $scopedId
);


$safeDocumentName = preg_replace(
    '/[^A-Za-z0-9_-]/',
    '_',
    $documentName
);


// ============================================================
// UPLOAD PATH
// ============================================================

$uploadRoot = '/var/www/trd_eig/uploads';

$uploadDir = $uploadRoot . '/' . $cfg['folder'];


// ============================================================
// CHECK DIRECTORY
// ============================================================

if (!is_dir($uploadDir)) {

    showDebugError('UPLOAD DIRECTORY DOES NOT EXIST', [

        'Upload Root' => $uploadRoot,

        'Expected Directory' => $uploadDir,

        'Directory Exists' => is_dir($uploadDir) ? 'YES' : 'NO',

        'Current PHP File' => __FILE__,

        'Current Directory' => __DIR__

    ]);
}


// ============================================================
// BUILD SEARCH PATTERN
// ============================================================

$pattern =

    $uploadDir . '/' .

    $safeScopedId . '_' .

    $safeDocumentName .

    '.*';


// ============================================================
// FIND FILES
// ============================================================

$files = glob($pattern);


// ============================================================
// DEBUG IF FILE NOT FOUND
// ============================================================

if (!$files || count($files) === 0) {

    // Show all files available in directory
    $directoryFiles = glob($uploadDir . '/*');

    $fileList = [];

    if ($directoryFiles) {

        foreach ($directoryFiles as $file) {

            $fileList[] = basename($file);

        }

    }


    showDebugError('FILE NOT FOUND', [

        'Scope' => $scope,

        'Original Scoped ID' => $scopedId,

        'Safe Scoped ID' => $safeScopedId,

        'Original Document Name' => $documentName,

        'Safe Document Name' => $safeDocumentName,

        'Upload Directory' => $uploadDir,

        'Directory Exists' => is_dir($uploadDir) ? 'YES' : 'NO',

        'Search Pattern' => $pattern,

        'Files Found By Pattern' => $files ?: 'NONE',

        'ALL FILES IN DIRECTORY' => $fileList

    ]);

}


// ============================================================
// GET FILE
// ============================================================

$filePath = reset($files);


// ============================================================
// VERIFY FILE
// ============================================================

if (!is_file($filePath)) {

    showDebugError('PATH FOUND BUT NOT A FILE', [

        'File Path' => $filePath

    ]);

}


// ============================================================
// CHECK READ PERMISSION
// ============================================================

if (!is_readable($filePath)) {

    showDebugError('FILE EXISTS BUT IS NOT READABLE', [

        'File Path' => $filePath,

        'File Permissions' => substr(sprintf('%o', fileperms($filePath)), -4),

        'PHP User' => get_current_user()

    ]);

}


// ============================================================
// MIME TYPE
// ============================================================

$mimeType = mime_content_type($filePath);

if (!$mimeType) {

    $mimeType = 'application/octet-stream';

}


// ============================================================
// SEND FILE
// ============================================================

header('Content-Type: ' . $mimeType);

header('Content-Length: ' . filesize($filePath));

header(
    'Content-Disposition: inline; filename="' .
    basename($filePath) .
    '"'
);

header('X-Content-Type-Options: nosniff');


readfile($filePath);

exit;

?>