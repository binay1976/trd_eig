<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/database.php';

$isProject = isset($_GET['project_id']);
$targetId = trim($_GET[$isProject ? 'project_id' : 'umbrella_id'] ?? '');
$validationId = str_replace(['\\', '|'], '', $targetId);
$uploadType = strtoupper(trim($_GET['type'] ?? ($isProject ? 'PID' : 'UPID')));

if (
    $targetId === '' ||
    !preg_match('/^[A-Za-z0-9_-]+$/', $validationId) ||
    !in_array($uploadType, ['UPID', 'PID'], true)
) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid Umbrella ID.'
    ]);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT
            type,
            project_id,
            document_id,
            original_name,
            stored_name,
            file_path,
            file_size,
            mime_type,
            uploaded_at
            FROM project_uploads
            WHERE type = ?
            AND project_id = ?
        ORDER BY document_id
    ");
    $stmt->execute([$uploadType, $targetId]);

    echo json_encode([
        'success' => true,
        'uploads' => $stmt->fetchAll(PDO::FETCH_ASSOC)
    ]);
} catch (PDOException $e) {
    error_log('Get uploads DB Error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error while loading uploaded files.'
    ]);
}
