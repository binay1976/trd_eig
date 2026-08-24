<?php
// ── Handle POST (AJAX submission) ────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    session_start();
    error_reporting(0);
    ob_start();

    require_once __DIR__ . '/../config/database.php';

    header('Content-Type: application/json');

    // =========================================================
    // 1. Collect inputs
    // =========================================================
    $umbrella_id      = trim($_POST['umbrella_id']      ?? '');
    $project_category = trim($_POST['project_category'] ?? ''); // OHE or PSI
    $type_project      = trim($_POST['type_project']    ?? ''); // TSS/SP/SSP/FP/AT/Back-Charging/OHE
    $project_type     = trim($_POST['project_type']     ?? '');
    $location         = trim($_POST['location']         ?? '');
    $executing_agency = trim($_POST['executing_agency'] ?? '');

    $from_station     = trim($_POST['from_station']     ?? '');
    $to_station       = trim($_POST['to_station']       ?? '');
    $station          = trim($_POST['station']          ?? '');

    $from_km          = trim($_POST['from_km']          ?? '');
    $to_km            = trim($_POST['to_km']            ?? '');
    $route_km         = trim($_POST['route_km']         ?? '');
    $track_km         = trim($_POST['track_km']         ?? '');

    $created_by = trim(($_SESSION['username'] ?? '') . '-' . ($_SESSION['desig'] ?? '')) ?: null;

    // =========================================================
    // 2. Validate required fields (category-dependent)
    // =========================================================
    $required = [
        'Umbrella ID'      => $umbrella_id,
        'Project Category' => $project_category,
        'Type of Project'  => $type_project,
        'Project Type'     => $project_type,
        'Location'         => $location,
        'Executing Agency' => $executing_agency,
    ];

    if ($project_category === 'OHE') {
        $required['From Station'] = $from_station;
        $required['To Station']   = $to_station;
        $required['Route KM']     = $route_km;
        $required['Track KM']     = $track_km;
    } elseif ($project_category === 'PSI') {
        $required['Station'] = $station;
    }

    foreach ($required as $label => $value) {
        if ($value === '') {
            ob_clean();
            echo json_encode(['success' => false, 'message' => "{$label} is required."]);
            exit;
        }
    }

    // =========================================================
    // 3. Build project_data JSON (mirrors create_umbrella.php pattern)
    // =========================================================
    $project_data = [
        'project_category' => $project_category,
        'project_type'     => $project_type,
        'location'         => $location,
        'from_station'     => $project_category === 'OHE' ? $from_station : null,
        'to_station'       => $project_category === 'OHE' ? $to_station   : null,
        'station'          => $project_category === 'PSI' ? $station     : null,
        'from_km'          => $from_km !== '' ? $from_km : null,
        'to_km'            => $to_km   !== '' ? $to_km   : null,
        'route_km'         => $project_category === 'OHE' ? ($route_km !== '' ? $route_km : null) : null,
        'track_km'         => $project_category === 'OHE' ? ($track_km !== '' ? $track_km : null) : null,
        'executing_agency' => $executing_agency,
    ];

    $project_json = json_encode($project_data, JSON_UNESCAPED_UNICODE);

    if ($project_json === false) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Failed to create project JSON.']);
        exit;
    }

    // =========================================================
    // 4. Generate Project ID: {umbrella_id}-{type_project}-{A/B/C...}
    // =========================================================
    function num_to_alpha(int $n): string {
        $result = '';
        $n++;
        while ($n > 0) {
            $n--;
            $result = chr(65 + ($n % 26)) . $result;
            $n      = intdiv($n, 26);
        }
        return $result;
    }

    $id_prefix = "{$umbrella_id}-{$type_project}";

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM projects WHERE project_id LIKE ?");
    $stmt->execute([$id_prefix . '-%']);
    $count = (int) $stmt->fetchColumn();

    $project_id = "{$id_prefix}-" . num_to_alpha($count);

    // Ensure uniqueness
    while (true) {
        $check = $pdo->prepare("SELECT project_id FROM projects WHERE project_id = ? LIMIT 1");
        $check->execute([$project_id]);
        if (!$check->fetch()) break;
        $count++;
        $project_id = "{$id_prefix}-" . num_to_alpha($count);
    }

    // =========================================================
    // 5. Insert into database (project_id, umbrella_id, type_project
    //    stay real columns; everything else lives in project_data JSON)
    // =========================================================
    try {
        $insert = $pdo->prepare("
            INSERT INTO projects (
                project_id, umbrella_id, type_project, status, created_by, updated_by, project_data
            ) VALUES (?, ?, ?, 1, ?, ?, ?)
        ");

        $insert->execute([
            $project_id,
            $umbrella_id,
            $type_project,
            $created_by,
            $created_by,
            $project_json,
        ]);

        ob_clean();
        echo json_encode([
            'success'    => true,
            'message'    => "Project created successfully!",
            'project_id' => $project_id,
        ]);

    } catch (Exception $e) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }

    exit;
}

// ── GET: load umbrella IDs for dropdown ──────────────────────────────────────
require_once __DIR__ . '/../config/database.php';

try {
    $umbrellas = $pdo->query("SELECT umbrella_id FROM umbrella_projects ORDER BY umbrella_id ASC")->fetchAll();
} catch (Exception $e) {
    $umbrellas = [];
}
?>

<div class="max-w-5xl mx-auto">

    <!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Create Project</h2>
        <p class="text-sm text-gray-500 mt-1">Enter the details to create a new project. Fields marked <span class="text-red-500">*</span> are required.</p>
    </div>

    <form id="projectForm" class="space-y-6">

        <!-- Umbrella ID -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Umbrella ID <span class="text-red-500">*</span></label>
            <select name="umbrella_id" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="">-- Select Umbrella Project --</option>
                <?php foreach ($umbrellas as $u): ?>
                    <option value="<?= htmlspecialchars($u['umbrella_id']) ?>">
                        <?= htmlspecialchars($u['umbrella_id']) ?>
                    </option>
                <?php endforeach; ?>
                <?php if (empty($umbrellas)): ?>
                    <option value="" disabled>No umbrella projects found</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Project Category (OHE / PSI) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project Category <span class="text-red-500">*</span></label>
                <select id="project_category" name="project_category" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="">Select Category</option>
                    <option value="OHE">OHE</option>
                    <option value="PSI">PSI</option>
                </select>
            </div>

            <!-- Type of Project (options depend on Project Category) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type of Project <span class="text-red-500">*</span></label>
                <select id="type_project" name="type_project" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="">Select Category First</option>
                    <option value="TSS" data-group="PSI">TSS</option>
                    <option value="SP" data-group="PSI">SP</option>
                    <option value="SSP" data-group="PSI">SSP</option>
                    <option value="FP" data-group="PSI">FP</option>
                    <option value="AT" data-group="PSI">AT</option>
                    <option value="Back-Charging" data-group="PSI">Back-Charging</option>
                    <option value="OHE" data-group="OHE">OHE</option>
                </select>
            </div>

            <!-- Project Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project Type <span class="text-red-500">*</span></label>
                <select name="project_type" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="">Select Project Type</option>
                    <option value="New Construction">New Construction</option>
                    <option value="Modification">Modification</option>
                    <option value="Upgradation">Upgradation</option>
                    <option value="Replacement">Replacement</option>
                    <option value="Augmentation">Augmentation</option>
                    <option value="Extension">Extension</option>
                </select>
            </div>

            <!-- Location -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Location <span class="text-red-500">*</span></label>
                <input type="text" name="location" required placeholder="Enter location"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <!-- Executing Agency -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Executing Agency <span class="text-red-500">*</span></label>
                <select name="executing_agency" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="">Select Agency</option>
                    <option value="RE">RE</option>
                    <option value="MRVC">MRVC</option>
                    <option value="CONST">CONST.</option>
                    <option value="RVNL">RVNL</option>
                    <option value="GRID">G-RIDE</option>
                    <option value="Division">Division</option>
                    <option value="Owner">Owner</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- From Station (OHE only) -->
            <div id="field_from_station">
                <label class="block text-sm font-medium text-gray-700 mb-2">From Station</label>
                <input type="text" name="from_station" placeholder="Enter from station"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <!-- To Station (OHE only) -->
            <div id="field_to_station">
                <label class="block text-sm font-medium text-gray-700 mb-2">To Station</label>
                <input type="text" name="to_station" placeholder="Enter to station"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <!-- Station (PSI only) -->
            <div id="field_station" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Station</label>
                <input type="text" name="station" placeholder="Enter station"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <!-- From KM -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">From KM</label>
                <input type="number" step="0.001" name="from_km" placeholder="e.g. 12.500"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <!-- To KM -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">To KM</label>
                <input type="number" step="0.001" name="to_km" placeholder="e.g. 45.200"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <!-- Route KM (OHE only) -->
            <div id="field_route_km">
                <label class="block text-sm font-medium text-gray-700 mb-2">Route KM (RKM)</label>
                <input type="number" step="0.001" name="route_km" placeholder="Enter route KM"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <!-- Track KM (OHE only) -->
            <div id="field_track_km">
                <label class="block text-sm font-medium text-gray-700 mb-2">Track KM (TKM)</label>
                <input type="number" step="0.001" name="track_km" placeholder="Enter track KM"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

        </div>

        <!-- Buttons -->
        <div class="flex justify-center gap-4 pt-4">
            <button type="reset"
                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                Reset
            </button>
            <button type="submit" id="projectSubmitBtn"
                class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm">
                Create Project
            </button>
            <button type="button" onclick="loadPage('project_uploads')"
                class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium shadow-sm">
                Uploads
            </button>
        </div>

    </form>
</div>

<script src="js/create_project.js"></script>
