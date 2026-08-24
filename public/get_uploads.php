<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/database.php';

$umbrellaId = trim($_GET['umbrella_id'] ?? '');

if ($umbrellaId === '' || !preg_match('/^[A-Za-z0-9_-]+$/', $umbrellaId)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid Umbrella ID.'
    ]);
    exit;
}

try {
    $stmt = $pdo->prepare('
        SELECT
            umbrella_id,
            document_id,
            original_name,
            stored_name,
            file_path,
            file_size,
            mime_type,
            uploaded_at
        FROM umbrella_uploads
        WHERE umbrella_id = ?
        ORDER BY document_id
    ');
    $stmt->execute([$umbrellaId]);

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
