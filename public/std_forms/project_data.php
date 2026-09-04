<?php
/**
 * project_data.php
 * Shared data bootstrap for every Standard Forms certificate (10.01-10.17).
 * Each form_10_xx.php just does require_once 'project_data.php' and reads
 * $projectData['key'] — this file builds that array from the DB instead of
 * a hardcoded sample, so every certificate auto-fills from whatever the
 * selected umbrella/project already has on record.
 */

require_once __DIR__ . '/std_common.php';

$umbrella_id = trim($_GET['umbrella_id'] ?? '');
$project_id  = trim($_GET['project_id']  ?? '');
$form_no     = trim($_GET['form_no']     ?? '');

if ($project_id === '') {
    die('No project selected. Open this form from the Standard Forms sidebar.');
}

$projectData = std_merge_project_data($pdo, $umbrella_id, $project_id);

// feeder_lines / aux_transformers are repeatable tables — keep them arrays
// (empty until filled via the project-details panel) so the templates'
// `!empty(...) && is_array(...)` guards render nothing instead of warning.
foreach (array_keys(STD_PROJECT_DETAIL_TABLES) as $tableKey) {
    if (!isset($projectData[$tableKey]) || !is_array($projectData[$tableKey])) {
        $projectData[$tableKey] = [];
    }
}

// Signature/upload tracking for this specific form instance (not part of
// $projectData — the certificate templates don't read this; the parent
// std_sidebar.php toolbar injected into the iframe uses it instead).
$std_unique_id = $form_no !== '' ? std_unique_id($project_id, $form_no) : null;
$std_entry     = $form_no !== '' ? std_load_entry($pdo, $project_id, $form_no) : null;
$std_extra     = $std_entry ? (json_decode($std_entry['extra_data'] ?? '{}', true) ?: []) : [];
