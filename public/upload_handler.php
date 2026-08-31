<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/database.php';


// | JSON Error Response 
function fail(string $message, int $code = 400): void
{
    http_response_code($code);
    echo json_encode([
        'success' => false,
        'message' => $message
    ]);
    exit;
}

// | Only POST allowed 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail(
        'Invalid request method.',
        405
    );
}

// | Input
$targetId = trim(
    $_POST['project_id'] ?? $_POST['umbrella_id'] ?? ''
);
$documentId = trim(
    $_POST['document_id'] ?? ''
);
$documentName = trim(
    $_POST['document_name'] ?? ''
);
$uploadType = strtoupper(trim(
    $_POST['upload_type'] ?? $_POST['type'] ?? ''
));

if ($uploadType === '') {
    $uploadType = isset($_POST['project_id']) ? 'PID' : 'UPID';
}

$uploadDirectories = [
    'UPID'  => 'uploads/umbrella/',
    'PID'   => 'uploads/project/',
    'ULEID' => 'uploads/forms/',
];

if (!isset($uploadDirectories[$uploadType])) {
    fail('Invalid upload type.');
}

$uploadDirectory = $uploadDirectories[$uploadType];

if (
    $targetId === '' ||
    $documentId === ''
) {
    fail(
        'Project or Umbrella ID and document type are required.'
    );
}


/* File Validation */
if (
    !isset($_FILES['file'])
) {
    fail(
        'No file was received.'
    );
}


$file = $_FILES['file'];
if (
    $file['error'] !== UPLOAD_ERR_OK
) {
    $errors = [
        UPLOAD_ERR_INI_SIZE =>
            'File exceeds the server upload limit.',
        UPLOAD_ERR_FORM_SIZE =>
            'File exceeds the allowed size.',
        UPLOAD_ERR_PARTIAL =>
            'File was only partially uploaded.',
        UPLOAD_ERR_NO_FILE =>
            'No file was selected.',
        UPLOAD_ERR_NO_TMP_DIR =>
            'Temporary upload directory is missing.',
        UPLOAD_ERR_CANT_WRITE =>
            'Server cannot write the uploaded file.',
        UPLOAD_ERR_EXTENSION =>
            'PHP stopped the file upload.'
    ];
    fail(
        $errors[$file['error']]
        ?? 'File upload failed.'
    );
}

/*| File Settings */
$allowedExtensions = [
    'pdf',
    'doc',
    'docx',
    'xls',
    'xlsx',
    'jpg',
    'jpeg',
    'png'

];
$maxFileSize =
    50 * 1024 * 1024; // 50 MB
$originalName =
    basename($file['name']);
$extension =
    strtolower(
        pathinfo(
            $originalName,
            PATHINFO_EXTENSION
        )
    );

// | Extension Validation
if (
    !in_array(
        $extension,
        $allowedExtensions,
        true
    )
) {

    fail(
        'File type not allowed.'
    );
}

// | File Size Validation
if (
    $file['size'] > $maxFileSize
) {

    fail(
        'File exceeds the 50 MB limit.'
    );
}


/* Actual location: /var/www/trd_eig/uploads/umbrella/    */
$baseUploadDir =
    dirname(__DIR__) .
    '/' . $uploadDirectory;

/* | Safe Umbrella ID */
$safeUmbrellaId =
    preg_replace(
        '/[^A-Za-z0-9_-]/',
        '_',
        $targetId
    );
if (
    $safeUmbrellaId === ''
) {
    fail(
        'Invalid Umbrella ID.'
    );
}

/*| Create Base Folder */
if (
    !is_dir($baseUploadDir)
) {
    if (
        !mkdir(
            $baseUploadDir,
            0770,
            true
        )
    ) {
        fail(
            'Could not create upload storage.',
            500
        );
    }
}


/* | Check Base Folder   */
if (
    !is_writable($baseUploadDir)
) {
    fail(
        'Upload storage is not writable.',
        500
    );
}

/* | Generate Stored Filename   */
$safeDocumentName = preg_replace(
    '/[^A-Za-z0-9_-]/',
    '_',
    $documentName
);
$storedName =
    $safeUmbrellaId . '_' .
    $safeDocumentName . '.' .
    $extension;
$destPath =
    $baseUploadDir .
    $storedName;

/* Move File  */

if (
    !move_uploaded_file(
        $file['tmp_name'],
        $destPath
    )
) {
    fail(
        'Could not save uploaded file.',
        500
    );
}



// | File Information
$mimeType =
    mime_content_type(
        $destPath
    );
if (!$mimeType) {
    $mimeType =
        $file['type']
        ?? 'application/octet-stream';
}
$fileSize =
    $file['size'];


/*
|--------------------------------------------------------------------------
| Database Relative Path
|
| This is relative to:
|
| /var/www/trd_eig
|--------------------------------------------------------------------------
*/
$relativePath =
    $uploadDirectory .
    $storedName;


/*
|--------------------------------------------------------------------------
| Uploaded By
|--------------------------------------------------------------------------
*/


$uploadedBy = trim(($_SESSION['username'] ?? '') . '\\' . ($_SESSION['executing_agency'] ?? '') . '\\' . ($_SESSION['desig'] ?? '')) ?: null;

/*
|--------------------------------------------------------------------------
| Database
|--------------------------------------------------------------------------
*/

try {

    /*
    |--------------------------------------------------------------------------
    | Check Existing Document
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare("
        SELECT
            id,
            file_path
                FROM project_uploads
                    WHERE type = ?
                AND project_id = ?
          AND document_id = ?
        LIMIT 1
    ");


    $stmt->execute([
        $uploadType,
        $targetId,
        $documentId
    ]);
    $existing =
        $stmt->fetch(
            PDO::FETCH_ASSOC
        );

    /*
    |--------------------------------------------------------------------------
    | Existing File → UPDATE
    |--------------------------------------------------------------------------
    */

    if ($existing) {

        $update = $pdo->prepare("
            UPDATE project_uploads
            SET
                original_name = ?,
                stored_name = ?,
                file_path = ?,
                file_size = ?,
                mime_type = ?,
                uploaded_by = ?,
                uploaded_at = NOW()
            WHERE id = ?
        ");
        $update->execute([
            $originalName,
            $storedName,
            $relativePath,
            $fileSize,
            $mimeType,
            $uploadedBy,
            $existing['id']
        ]);


        /*
        |--------------------------------------------------------------------------
        | Delete Previous Physical File
        |--------------------------------------------------------------------------
        */

        if (
            !empty(
                $existing['file_path']
            )
        ) {

            $oldPath =
                dirname(__DIR__) .
                '/' .
                ltrim(
                    $existing['file_path'],
                    '/'
                );


            if (
                is_file($oldPath) &&
                $oldPath !== $destPath
            ) {

                @unlink($oldPath);
            }
        }


        $recordId =
            $existing['id'];

    }


    /*
    |--------------------------------------------------------------------------
    | New File → INSERT
    |--------------------------------------------------------------------------
    */

    else {

        $insert = $pdo->prepare("
            INSERT INTO project_uploads
            (
                type,
                project_id,
                document_id,
                original_name,
                stored_name,
                file_path,
                file_size,
                mime_type,
                uploaded_by,
                uploaded_at
            )

            VALUES
            (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                NOW()
            )
        ");


        $insert->execute([
            $uploadType,
            $targetId,
            $documentId,
            $originalName,
            $storedName,
            $relativePath,
            $fileSize,
            $mimeType,
            $uploadedBy

        ]);


        $recordId =
            $pdo->lastInsertId();
    }


} catch (PDOException $e) {

    /*
    |--------------------------------------------------------------------------
    | Database Failed
    |
    | Delete newly uploaded file
    |--------------------------------------------------------------------------
    */

    if (
        is_file($destPath)
    ) {

        @unlink($destPath);
    }


    error_log(
        'Umbrella Upload DB Error: ' .
        $e->getMessage()
    );


    fail(
        'Database error while saving upload.',
        500
    );
}


/*
|--------------------------------------------------------------------------
| SUCCESS
|--------------------------------------------------------------------------
*/

echo json_encode([

    'success' => true,

    'message' =>
        'File uploaded successfully.',

    'document_id' =>
        $documentId,

    'document_name' =>
        $documentName,

    'original_name' =>
        $originalName,

    'file_path' =>
        $relativePath,

    'id' =>
        $recordId

]);

exit;