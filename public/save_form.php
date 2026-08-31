<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$unique_form_id = trim($_POST['unique_form_id'] ?? '');

if ($unique_form_id === '') {
    echo json_encode(['success' => false, 'message' => 'unique_form_id is required.']);
    exit;
}

$field_data = $_POST;
unset($field_data['unique_form_id']);

$project_json = json_encode($field_data, JSON_UNESCAPED_UNICODE);

if ($project_json === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to encode form data.']);
    exit;
}
$parts     = explode('||', $unique_form_id);
$unique_id = end($parts);

$created_by = trim(($_SESSION['username'] ?? '') . '-' . ($_SESSION['executing_agency'] ?? '') . '-' . ($_SESSION['desig'] ?? '')) ?: null;

try {
    $pdo->beginTransaction();

    $check = $pdo->prepare("SELECT id FROM umbrella_projects WHERE type = 'EID' AND common_id = ? LIMIT 1");
    $check->execute([$unique_form_id]);
    $existing = $check->fetch();

    if ($existing) {
        $update = $pdo->prepare("UPDATE umbrella_projects SET project_data = ?, updated_by = ? WHERE id = ?");
        $update->execute([$project_json, $created_by, $existing['id']]);
    } else {
        $insert = $pdo->prepare("
            INSERT INTO umbrella_projects (type, unique_id, common_id, project_data, created_by, updated_by)
            VALUES ('EID', ?, ?, ?, ?, ?)
        ");
        $insert->execute([$unique_id, $unique_form_id, $project_json, $created_by, $created_by]);
    }

    // Same effect mark_filled.php had — flip the instance's fill flag so the
    // sidebar's (x/y) badge updates.
    $pdo->prepare("UPDATE project_forms SET is_filled = 1 WHERE unique_form_id = ?")
        ->execute([$unique_form_id]);

    $pdo->commit();

    echo json_encode(['success' => true, 'message' => 'Form saved successfully.']);

} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
