<?php
require_once __DIR__ . '/../config/database.php';

$umbrellaIds = $pdo->query(
    "SELECT common_id AS umbrella_id
     FROM umbrella_projects
     WHERE common_id IS NOT NULL AND common_id <> ''
     AND type = 'UPID' ORDER BY updated_at DESC"
)->fetchAll(PDO::FETCH_COLUMN);

// Document types shown in the table — sourced from uploads_master (the
// "List of ACTM performa uploads" master list) filtered to this level.
// Equipments-level rows are handled separately later. The 'slug' is what
// gets stored as document_id in project_uploads; it's derived from the
// row's own id rather than the (long, punctuation-heavy) particulars text.
$documents = array_map(
    fn($d) => ['name' => $d['particulars'], 'slug' => 'doc_' . $d['id']],
    $pdo->query("
        SELECT id, particulars
        FROM uploads_master
        WHERE upload_level = 'Umbrella' AND status = 'ACTIVE'
        ORDER BY sort_order ASC
    ")->fetchAll()
);
?>

<div class="max-w-6xl mx-auto">
    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Umbrella Documents Upload
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Select Umbrella ID and upload the required documents.
            </p>
        </div>

        <!-- Umbrella ID -->
        <div class="mb-6 max-w-md">
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Umbrella ID<span class="text-red-500">*</span></label>
            <select id="umbrellaId" onchange="loadUploadedFiles()" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="">Select Umbrella ID</option>
                <?php foreach ($umbrellaIds as $umbrellaId): ?>
                    <option value="<?= htmlspecialchars($umbrellaId, ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($umbrellaId, ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

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
                        $elId = str_replace(' ', '_', $doc['name']); // e.g. Project_Approval
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

<script src="js/umbrella_uploads.js"></script>
