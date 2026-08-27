<?php
require_once __DIR__ . '/../config/database.php';

$projectIds = $pdo->query(
    "SELECT common_id AS project_id
     FROM umbrella_projects
     WHERE common_id IS NOT NULL AND common_id <> ''
     AND type = 'PID' ORDER BY updated_at DESC"
)->fetchAll(PDO::FETCH_COLUMN);

$documents = [
    ['name' => 'Project Approval', 'slug' => 'project_approval'],
    ['name' => 'Project Drawing',  'slug' => 'project_drawing'],
    ['name' => 'Circuit Diagram',  'slug' => 'circuit_diagram'],
];
?>

<div id="projectUploadPage"
    data-upload-type="PID"
    data-upload-directory="/uploads/project"
    class="max-w-6xl mx-auto">
    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Project Documents Upload
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Select Project ID and upload the required documents.
            </p>
        </div>

        <!-- Project ID -->
        <div class="mb-6 max-w-md">
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Project ID<span class="text-red-500">*</span></label>
            <select id="projectId" onchange="loadUploadedFiles()" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="">Select Project ID</option>
                <?php foreach ($projectIds as $projectId): ?>
                    <option value="<?= htmlspecialchars($projectId, ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($projectId, ENT_QUOTES, 'UTF-8') ?>
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
                                       data-upload-type="PID"
                                       data-upload-directory="/uploads/project"
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
