<?php
session_start();

// Admin dashboard: 3-column drill-down (umbrellas -> their projects -> each
// project's added equipment/forms with fill progress). Loaded into
// #pageContent via loadPage('home') in js/app.js.

// ── AJAX: projects by umbrella_id ─────────────────────────────────────────────
if (isset($_GET['umbrella_id'])) {
    error_reporting(0);
    ob_start();
    require_once __DIR__ . '/../config/database.php';
    header('Content-Type: application/json');
    $umbrella_id = trim($_GET['umbrella_id']);
    if ($umbrella_id === '') {
        ob_clean(); echo json_encode(['success' => false, 'message' => 'Umbrella ID is required.']); exit;
    }
    $stmt = $pdo->prepare("
        SELECT common_id AS umbrella_id, project_data
        FROM umbrella_projects
        WHERE type = 'PID'
          AND JSON_UNQUOTE(JSON_EXTRACT(project_data, '$.parent_umbrella_id')) = ?
        ORDER BY common_id ASC
    ");
    $stmt->execute([$umbrella_id]);
    $rows = $stmt->fetchAll();

    $projects = array_map(function ($row) {
        $data = json_decode($row['project_data'] ?? '{}', true) ?: [];
        return [
            'project_id'   => $row['umbrella_id'],
            'type_project' => $data['type_project'] ?? '',
            'location'     => $data['location']     ?? '',
            'project_type' => $data['project_type'] ?? '',
        ];
    }, $rows);

    ob_clean();
    echo json_encode(['success' => true, 'projects' => $projects]);
    exit;
}

// ── AJAX: equipment/forms by project_id ───────────────────────────────────────
if (isset($_GET['project_id'])) {
    error_reporting(0);
    ob_start();
    require_once __DIR__ . '/../config/database.php';
    header('Content-Type: application/json');
    $project_id = trim($_GET['project_id']);
    if ($project_id === '') {
        ob_clean(); echo json_encode(['success' => false, 'message' => 'Project ID is required.']); exit;
    }
    $stmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'PID' AND common_id = ? LIMIT 1");
    $stmt->execute([$project_id]);
    $projectRow = $stmt->fetch();
    if (!$projectRow) {
        ob_clean(); echo json_encode(['success' => false, 'message' => 'Project not found.']); exit;
    }
    $projectData = json_decode($projectRow['project_data'] ?? '{}', true) ?: [];
    $project = [
        'type_project' => $projectData['type_project'] ?? '',
        'project_name' => $projectData['location']     ?? '',
    ];

    // Actual saved forms for this project (added via "Add Equipment & Machine"),
    // grouped by form_no with fill progress — same source sidebar.php uses.
    $stmt = $pdo->prepare("
        SELECT form_name, form_no, unique_form_id, sequence_label, is_filled
        FROM project_forms
        WHERE project_id = ?
        ORDER BY form_no ASC, sequence_label ASC
    ");
    $stmt->execute([$project_id]);
    $rows = $stmt->fetchAll();

    $grouped = [];
    foreach ($rows as $row) {
        $key = $row['form_no'];
        if (!isset($grouped[$key])) {
            $grouped[$key] = [
                'form_no'   => $row['form_no'],
                'form_name' => $row['form_name'],
                'total'     => 0,
                'filled'    => 0,
            ];
        }
        $grouped[$key]['total']++;
        if ((int)$row['is_filled'] === 1) $grouped[$key]['filled']++;
    }

    ob_clean();
    echo json_encode([
        'success'      => true,
        'type_project' => $project['type_project'],
        'project_name' => $project['project_name'],
        'equipment'    => array_values($grouped),
    ]);
    exit;
}

// ── Page render ───────────────────────────────────────────────────────────────
require_once __DIR__ . '/../config/database.php';
try {
    $sessionZone = strtoupper(trim($_SESSION['zone'] ?? ''));
    $sessionDivision = strtoupper(trim($_SESSION['div_name'] ?? ''));

    $stmt = $pdo->prepare("
        SELECT
            u.common_id AS umbrella_id,
            JSON_UNQUOTE(JSON_EXTRACT(u.project_data, '$.umbrella_project_name')) AS umbrella_project_name,
            JSON_UNQUOTE(JSON_EXTRACT(u.project_data, '$.zone'))                  AS zone,
            JSON_UNQUOTE(JSON_EXTRACT(u.project_data, '$.division'))              AS division,
            COUNT(p.id) AS project_count
        FROM umbrella_projects u
        LEFT JOIN umbrella_projects p
            ON p.type = 'PID'
           AND JSON_UNQUOTE(JSON_EXTRACT(p.project_data, '$.parent_umbrella_id')) = u.common_id
                WHERE u.type = 'UPID'
                    AND JSON_UNQUOTE(JSON_EXTRACT(u.project_data, '$.zone')) = ?
                    AND JSON_UNQUOTE(JSON_EXTRACT(u.project_data, '$.division')) = ?
        GROUP BY u.common_id, umbrella_project_name, zone, division
        ORDER BY u.common_id ASC
    ");
        $stmt->execute([$sessionZone, $sessionDivision]);
    $umbrellas = $stmt->fetchAll();
} catch (Exception $e) {
    $umbrellas = [];
}
?>

<style>
.col-row {
    padding: 8px 12px;
    border-bottom: 1px solid #E5E7EB;
    cursor: pointer;
    font-size: 0.82rem;
}
.col-row:hover  { background: #F0F9FF; }
.col-row.active { background: #DBEAFE; border-left: 3px solid #2563EB; }
.col-scroll { overflow-y: auto; flex: 1; }
.col-scroll::-webkit-scrollbar { width: 4px; }
.col-scroll::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 4px; }
</style>

<div class="mb-3">
    <h2 class="text-xl font-bold text-gray-800">Admin Dashboard</h2>
    <p class="text-sm text-gray-400 mt-0.5">Click a row to drill down.</p>
</div>

<!-- 3-column table -->
<div style="border: 1px solid #9CA3AF; border-radius: 8px; overflow: hidden; display: flex; height: 520px;">

    <!-- Column 1: Umbrella Projects -->
    <div style="flex: 1; display: flex; flex-direction: column; overflow: hidden; min-width: 0;">
        <!-- Column header -->
        <div style="background: #1E3A5F; color: #fff; padding: 8px 12px; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em; display: flex; justify-content: space-between; align-items: center; flex-shrink: 0;">
            <span>UMBRELLA PROJECTS</span>
            <span style="background: rgba(255,255,255,0.2); padding: 1px 8px; border-radius: 99px; font-size: 0.7rem;"><?= count($umbrellas) ?></span>
        </div>
        <!-- Sub-header labels -->
        <div style="background: #F3F4F6; border-bottom: 1px solid #D1D5DB; padding: 5px 12px; display: flex; gap: 8px; font-size: 0.7rem; font-weight: 600; color: #6B7280; flex-shrink: 0; text-transform: uppercase; letter-spacing: 0.05em;">
            <span style="flex: 1;">ID / Name</span>
            <span style="width: 60px; text-align: center;">Zone</span>
            <span style="width: 40px; text-align: center;">Proj</span>
        </div>
        <div class="col-scroll" id="umbrellaList">
            <?php if (empty($umbrellas)): ?>
                <div style="padding: 32px 12px; text-align: center; color: #9CA3AF; font-size: 0.82rem;">No umbrella projects found.</div>
            <?php else: ?>
                <?php foreach ($umbrellas as $row): ?>
                    <div class="col-row" data-id="<?= htmlspecialchars($row['umbrella_id']) ?>" style="display: flex; gap: 8px; align-items: center;">
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-family: monospace; font-size: 0.72rem; color: #1D4ED8; font-weight: 600; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?= htmlspecialchars($row['umbrella_id']) ?>
                            </div>
                            <div style="color: #374151; margin-top: 1px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?= htmlspecialchars($row['umbrella_project_name']) ?>
                            </div>
                            <div style="font-size: 0.68rem; color: #9CA3AF; margin-top: 2px;">
                                <?= htmlspecialchars($row['division']) ?>
                            </div>
                        </div>
                        <div style="width: 60px; text-align: center; color: #6B7280; font-size: 0.75rem;"><?= htmlspecialchars($row['zone']) ?></div>
                        <div style="width: 40px; text-align: center; color: #6B7280; font-size: 0.75rem;"><?= (int)$row['project_count'] ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Double separator -->
    <div style="width: 6px; border-left: 2px solid #9CA3AF; border-right: 2px solid #9CA3AF; background: #F9FAFB; flex-shrink: 0;"></div>

    <!-- Column 2: Projects -->
    <div style="flex: 1; display: flex; flex-direction: column; overflow: hidden; min-width: 0;">
        <div style="background: #3B1F6B; color: #fff; padding: 8px 12px; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em; display: flex; justify-content: space-between; align-items: center; flex-shrink: 0;">
            <span>PROJECTS</span>
            <span id="projectCountBadge" style="background: rgba(255,255,255,0.2); padding: 1px 8px; border-radius: 99px; font-size: 0.7rem; display: none;">0</span>
        </div>
        <div style="background: #F3F4F6; border-bottom: 1px solid #D1D5DB; padding: 5px 12px; display: flex; gap: 8px; font-size: 0.7rem; font-weight: 600; color: #6B7280; flex-shrink: 0; text-transform: uppercase; letter-spacing: 0.05em;">
            <span style="flex: 1;">ID / Name</span>
            <span style="width: 50px; text-align: center;">Type</span>
        </div>
        <div class="col-scroll" id="projectList">
            <div style="padding: 32px 12px; text-align: center; color: #9CA3AF; font-size: 0.82rem;">← Select an umbrella project</div>
        </div>
    </div>

    <!-- Double separator -->
    <div style="width: 6px; border-left: 2px solid #9CA3AF; border-right: 2px solid #9CA3AF; background: #F9FAFB; flex-shrink: 0;"></div>

    <!-- Column 3: Equipment / Forms -->
    <div style="flex: 1; display: flex; flex-direction: column; overflow: hidden; min-width: 0;">
        <div style="background: #065F46; color: #fff; padding: 8px 12px; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em; display: flex; justify-content: space-between; align-items: center; flex-shrink: 0;">
            <span>EQUIPMENT &amp; FORMS</span>
            <span id="equipmentCountBadge" style="background: rgba(255,255,255,0.2); padding: 1px 8px; border-radius: 99px; font-size: 0.7rem; display: none;">0</span>
        </div>
        <div style="background: #F3F4F6; border-bottom: 1px solid #D1D5DB; padding: 5px 12px; display: flex; gap: 8px; font-size: 0.7rem; font-weight: 600; color: #6B7280; flex-shrink: 0; text-transform: uppercase; letter-spacing: 0.05em;">
            <span style="width: 24px; text-align: center;">#</span>
            <span style="width: 70px;">Form No.</span>
            <span style="flex: 1;">Form Name</span>
            <span style="width: 60px; text-align: center;">Progress</span>
        </div>
        <div class="col-scroll" id="equipmentList">
            <div style="padding: 32px 12px; text-align: center; color: #9CA3AF; font-size: 0.82rem;">← Select a project</div>
        </div>
    </div>

</div>

<script src="js/admin_dashboard.js"></script>
