<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
/* Database Connection */
require_once __DIR__ . '/../../config/database.php';
/* Check Selected Project */
if (
    !isset($_SESSION['common_id']) ||
    empty($_SESSION['common_id'])
) {
    die("No project selected. Please select a project first.");

}
$common_id = $_SESSION['common_id'];
/* Get Project */
$stmt = $pdo->prepare("
    SELECT *
    FROM umbrella_projects
    WHERE common_id = ?
    LIMIT 1
");
$stmt->execute([$common_id]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$project) {
    die("Project not found.");

}
/* Decode project_data JSON */
$projectData = json_decode(
    $project['project_data'] ?? '{}',
    true
);
/* Safety check */
if (!is_array($projectData)) {
    $projectData = [];
}
?>