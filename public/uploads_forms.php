<?php
require_once __DIR__ . '/../config/database.php';

$SCOPES = [
    'umbrella' => [
        'row_type'  => 'UPID',   // umbrella_projects.type this scope's IDs come from
        'upload_type' => 'UPID', // project_uploads.type saved uploads get tagged with
        'param'     => 'umbrella_id',
        'title'     => 'Umbrella Documents Upload',
        'subtitle'  => 'Select Umbrella ID and upload the required documents.',
        'label'     => 'Umbrella ID',
        'documents' => [
            ['name' => 'Project Approval', 'slug' => 'project_approval'],
            ['name' => 'Project Drawing',  'slug' => 'project_drawing'],
            ['name' => 'Circuit Diagram',  'slug' => 'circuit_diagram'],
        ],
    ],
    'project' => [
        'row_type'  => 'PID',
        'upload_type' => 'UPID',
        'param'     => 'project_id',
        'title'     => 'Project Documents Upload',
        'subtitle'  => 'Select Project ID and upload the required documents.',
        'label'     => 'Project ID',
        'documents' => [
            ['name' => 'Project Approval', 'slug' => 'project_approval'],
            ['name' => 'Project Drawing',  'slug' => 'project_drawing'],
            ['name' => 'Circuit Diagram',  'slug' => 'circuit_diagram'],
        ],
    ],
    'form' => [
        'row_type'  => null, // no dropdown — the ID comes from the URL instead
        'upload_type' => 'ULEID',
        'param'     => 'unique_form_id',
        'title'     => 'Form Documents Upload',
        'subtitle'  => 'Upload supporting documents for this form instance.',
        'label'     => null,
        'documents' => [
            ['name' => 'Test Report',      'slug' => 'test_report'],
            ['name' => 'Photograph',       'slug' => 'photograph'],
            ['name' => 'Calibration Cert', 'slug' => 'calibration_cert'],
        ],
    ],
];

$scope = $_GET['scope'] ?? '';
if (!isset($SCOPES[$scope])) {
    http_response_code(400);
    exit('Invalid or missing scope. Use ?scope=umbrella, ?scope=project, or ?scope=form.');
}
$cfg       = $SCOPES[$scope];
$documents = $cfg['documents'];

// Dropdown options for umbrella/project scopes
$ids = [];
if ($cfg['row_type']) {
    $stmt = $pdo->prepare("
        SELECT common_id FROM umbrella_projects
        WHERE type = ? AND common_id IS NOT NULL AND common_id <> ''
        ORDER BY common_id
    ");
    $stmt->execute([$cfg['row_type']]);
    $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// The form scope is opened directly in an iframe (via the Upload button
// injected into every form by sidebar.php), so unlike umbrella/project it
// needs the full navbar+sidebar page shell and embed-awareness.
$isFullPage = ($scope === 'form');
$embed      = isset($_GET['embed']) && $_GET['embed'] === '1';
$scopedId   = trim($_GET[$cfg['param']] ?? ''); // only set via URL for scope=form
?>
<?php if ($isFullPage): ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($cfg['title']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 <?= $embed ? '' : 'min-h-screen' ?>">
<?php if (!$embed): ?>
    <?php include __DIR__ . '/navbar.php'; ?>
    <div class="flex min-h-screen">
        <aside class="w-96 bg-white border-r border-gray-200 shadow-sm flex-shrink-0 p-5 overflow-y-auto">
            <?php include __DIR__ . '/sidebar.php'; ?>
        </aside>
        <main class="flex-1 p-6 overflow-y-auto">
<?php else: ?>
    <div class="p-6">
<?php endif; ?>
<?php endif; ?>

        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-800"><?= htmlspecialchars($cfg['title']) ?></h1>
                    <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($cfg['subtitle']) ?></p>
                    <?php if ($scope === 'form'): ?>
                        <?php if ($scopedId): ?>
                            <p class="text-xs font-mono uppercase tracking-widest text-gray-400 mt-2"><?= htmlspecialchars($scopedId) ?></p>
                        <?php else: ?>
                            <p class="text-xs text-red-500 mt-2">No form instance ID found — open this page via a form's Upload button.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <?php if ($cfg['label']): ?>
                <div class="mb-6 max-w-md">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select <?= htmlspecialchars($cfg['label']) ?><span class="text-red-500">*</span></label>
                    <select id="uploadScopeId" onchange="loadUploadedFiles()" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <option value="">Select <?= htmlspecialchars($cfg['label']) ?></option>
                        <?php foreach ($ids as $id): ?>
                            <option value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-blue-950 text-white">
                                <th class="px-4 py-3 text-left w-20">Sr No</th>
                                <th class="px-4 py-3 text-left">Name</th>
                                <th class="px-4 py-3 text-center w-48">Upload</th>
                                <th class="px-4 py-3 text-left">Uploaded File</th>
                                <th class="px-4 py-3 text-center">View File</th>
                            </tr>
                        </thead>
                        <tbody id="uploadTableBody">
                            <?php foreach ($documents as $i => $doc):
                                $elId = str_replace(' ', '_', $doc['name']);
                            ?>
                            <tr class="border-b">
                                <td class="px-4 py-4"><?= $i + 1 ?></td>
                                <td class="px-4 py-4 font-medium text-gray-700"><?= htmlspecialchars($doc['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="px-4 py-4 text-center">
                                    <label class="inline-block cursor-pointer px-4 py-2 bg-blue-950 text-white rounded-lg hover:bg-blue-600">
                                        Upload
                                        <input type="file"
                                               accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png"
                                               class="hidden"
                                               data-document="<?= htmlspecialchars($doc['name'], ENT_QUOTES, 'UTF-8') ?>"
                                               data-doc-id="<?= htmlspecialchars($doc['slug'], ENT_QUOTES, 'UTF-8') ?>"
                                               onchange="handleUpload(this)">
                                    </label>
                                </td>
                                <td id="<?= $elId ?>" class="px-4 py-4 text-sm text-gray-500">Not Uploaded</td>
                                <td class="px-4 py-4 text-center" id="view_<?= $elId ?>"><span class="text-gray-400">Not Available</span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<?php if ($isFullPage): ?>
<?php if (!$embed): ?>
        </main>
    </div>
<?php else: ?>
    </div>
<?php endif; ?>
<?php endif; ?>

<script>
    window.EIG_UPLOAD_SCOPE = <?= json_encode($scope) ?>;
    window.EIG_UPLOAD_PARAM = <?= json_encode($cfg['param']) ?>;
    <?php if ($scope === 'form'): ?>
    window.EIG_SCOPED_VALUE = <?= json_encode($scopedId) ?>;
    <?php endif; ?>
</script>
<script src="js/uploads.js"></script>

<?php if ($isFullPage): ?>
</body>
</html>
<?php endif; ?>
