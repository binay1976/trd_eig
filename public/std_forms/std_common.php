<?php
/**
 * std_common.php
 * Shared bootstrap/helpers for the Standard Forms (10.01-10.17) module.
 * Included by std_sidebar.php, std_upload.php and project_data.php.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database.php';

// Same "username\executing_agency\desig" identity string used across
// create_umbrella.php / create_project.php / add_equipment.php.
function std_identity(): ?string
{
    $id = trim(($_SESSION['username'] ?? '') . '\\' . ($_SESSION['executing_agency'] ?? '') . '\\' . ($_SESSION['desig'] ?? ''));
    return $id !== '' ? $id : null;
}

function std_unique_id(string $project_id, string $form_no): string
{
    return $project_id . '||STDID\\' . $form_no;
}

// Fetch + merge the umbrella (UPID) and project (PID) rows' project_data
// JSON. Project-level keys win over umbrella-level keys on collision.
function std_merge_project_data(PDO $pdo, string $umbrella_id, string $project_id): array
{
    $merged = [];

    if ($umbrella_id !== '') {
        $stmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'UPID' AND common_id = ? LIMIT 1");
        $stmt->execute([$umbrella_id]);
        $row = $stmt->fetch();
        if ($row) {
            $merged = array_merge($merged, json_decode($row['project_data'] ?? '{}', true) ?: []);
        }
    }

    if ($project_id !== '') {
        $stmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'PID' AND common_id = ? LIMIT 1");
        $stmt->execute([$project_id]);
        $row = $stmt->fetch();
        if ($row) {
            $merged = array_merge($merged, json_decode($row['project_data'] ?? '{}', true) ?: []);
        }
    }

    return $merged;
}

// Load (or null) the std_form_entries row for a given project+form.
function std_load_entry(PDO $pdo, string $project_id, string $form_no): ?array
{
    $stmt = $pdo->prepare("SELECT * FROM std_form_entries WHERE project_id = ? AND form_no = ? LIMIT 1");
    $stmt->execute([$project_id, $form_no]);
    $row = $stmt->fetch();
    return $row ?: null;
}

// Upsert the std_form_entries row, merging into extra_data rather than
// replacing it (so e.g. saving a signature doesn't wipe other keys).
function std_save_entry_data(PDO $pdo, string $umbrella_id, string $project_id, string $form_no, array $patch): array
{
    $unique_id = std_unique_id($project_id, $form_no);
    $existing  = std_load_entry($pdo, $project_id, $form_no);
    $current   = $existing ? (json_decode($existing['extra_data'] ?? '{}', true) ?: []) : [];
    $updated   = array_replace_recursive($current, $patch);
    $by        = std_identity();

    if ($existing) {
        $stmt = $pdo->prepare("UPDATE std_form_entries SET extra_data = ?, updated_by = ? WHERE id = ?");
        $stmt->execute([json_encode($updated, JSON_UNESCAPED_UNICODE), $by, $existing['id']]);
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO std_form_entries (umbrella_id, project_id, form_no, unique_stdform_id, extra_data, created_by, updated_by)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$umbrella_id, $project_id, $form_no, $unique_id, json_encode($updated, JSON_UNESCAPED_UNICODE), $by, $by]);
    }

    return $updated;
}

// Project-level "standard forms details" fields — the shared extra data
// (beyond what create_project.php/create_umbrella.php already collect)
// used across the certificate templates. Filled once per project and
// merged into that project's own umbrella_projects.project_data JSON.
const STD_PROJECT_DETAIL_FIELDS = [
    'reg_description', 'ssp_name', 'tss_name', 'ssp_short_name', 'fp_short_name',
    'from_location', 'to_location', 'letter_no', 'height_gauge', 'block_section',
    'energization_date', 'bonding_date', 'division_pincode', 'at_section', 'at_total_qty',
    'dy_cee_designation', 'dy_cee_full_designation', 'sr_dee_trd_designation', 'dy_cste_designation',
    'sr_dom_designation', 'sr_dso_designation', 'sr_den_designation', 'sr_dste_designation',
    'sr_dee_tro_designation', 'sr_dee_p_designation', 'sr_den_co_designation', 'drm_designation',
    'contractor_name', 'contractor_address', 'contractor_email', 'contractor_work_location',
    'contractor_date', 'contractor_ref_no_15', 'contractor_ref_no_16', 'contractor_ref_no_17',
];

const STD_PROJECT_DETAIL_TABLES = [
    'feeder_lines'     => ['from', 'to', 'length', 'description'],
    'aux_transformers' => ['location', 'rating', 'line', 'qty'],
];
