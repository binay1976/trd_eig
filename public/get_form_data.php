<?php
// Returns a filled form's previously saved field values (type='EID' row's
// project_data), so sidebar.php's hydrateFormFromSaved() can pre-fill the
// form when a user reopens it instead of showing it blank.
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

$unique_form_id = trim($_GET['unique_form_id'] ?? '');

if ($unique_form_id === '') {
    echo json_encode(['success' => false, 'message' => 'unique_form_id is required.']);
    exit;
}

$stmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'EID' AND common_id = ? LIMIT 1");
$stmt->execute([$unique_form_id]);
$row = $stmt->fetch();

// Not found just means the form hasn't been saved yet — not an error.
$data = $row ? json_decode($row['project_data'], true) : null;

echo json_encode(['success' => true, 'data' => $data]);
