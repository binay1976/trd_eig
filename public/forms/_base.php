<?php
$embed          = isset($_GET['embed']) && $_GET['embed'] === '1';
$unique_form_id = htmlspecialchars($_GET['unique_form_id'] ?? '');
$prev_url       = $_GET['prev_url'] ?? '';
$next_url       = $_GET['next_url'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($form_name) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 <?= $embed ? '' : 'min-h-screen' ?>">

<?php if (!$embed): ?>
    <?php include __DIR__ . '/../navbar.php'; ?>
    <div class="flex min-h-screen">
        <aside class="w-72 bg-white border-r border-gray-200 shadow-sm flex-shrink-0 p-5 overflow-y-auto">
            <?php include __DIR__ . '/../sidebar.php'; ?>
        </aside>
        <main class="flex-1 p-6 overflow-y-auto">
<?php else: ?>
    <div class="p-6">
<?php endif; ?>

        <!-- Page Title -->
        <div class="mb-5 flex items-start justify-between gap-6">

            <!-- Left: Unique Form ID -->
            <?php if ($unique_form_id): ?>
            <div class="flex-shrink-0">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-1">Form Instance ID</p>
                <span class="inline-block font-mono text-sm font-bold text-white bg-blue-600 px-3 py-1.5 rounded-lg tracking-wide">
                    <?= $unique_form_id ?>
                </span>
            </div>
            <?php endif; ?>

            <!-- Right: Form No, Name, Description -->
            <div class="<?= $unique_form_id ? 'text-right' : '' ?>">
                <span class="text-xs font-mono font-semibold text-gray-400 uppercase tracking-widest">
                    <?= htmlspecialchars($form_no) ?>
                </span>
                <h1 class="text-xl font-bold text-gray-800 mt-0.5">
                    <?= htmlspecialchars($form_name) ?>
                </h1>
                <p class="text-sm text-gray-400 mt-0.5">Fill in all test details and upload supporting documents.</p>
            </div>

        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form id="mainForm" enctype="multipart/form-data">

                <!-- ── Section 1: Basic Details ── -->
                <div class="mb-7">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">
                        Basic Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Project ID</label>
                            <input type="text" name="project_id" placeholder="Enter Project ID"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Equipment Serial No.</label>
                            <input type="text" name="serial_no" placeholder="Enter Serial Number"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Make / Manufacturer</label>
                            <input type="text" name="make" placeholder="Enter Manufacturer"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="location" placeholder="Enter Location"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Testing</label>
                            <input type="date" name="test_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Inspected By</label>
                            <input type="text" name="inspected_by" placeholder="Enter Inspector Name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                    </div>
                </div>

                <!-- ── Section 2: Test Measurements ── -->
                <div class="mb-7">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">
                        Test Measurements
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reading — Phase R</label>
                            <input type="number" step="any" name="reading_r" placeholder="0.00"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reading — Phase Y</label>
                            <input type="number" step="any" name="reading_y" placeholder="0.00"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reading — Phase B</label>
                            <input type="number" step="any" name="reading_b" placeholder="0.00"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Test Voltage Applied (kV)</label>
                            <input type="number" step="any" name="test_voltage" placeholder="0.00"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Duration of Test (min)</label>
                            <input type="number" step="any" name="duration" placeholder="0"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Test Result</label>
                            <select name="test_result"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Select --</option>
                                <option value="Pass">Pass</option>
                                <option value="Fail">Fail</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- ── Section 3: Observations ── -->
                <div class="mb-7">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">
                        Observations
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Physical Condition</label>
                            <select name="physical_condition"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Select --</option>
                                <option>Good</option>
                                <option>Fair</option>
                                <option>Poor</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Insulation Condition</label>
                            <select name="insulation_condition"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Select --</option>
                                <option>Good</option>
                                <option>Fair</option>
                                <option>Poor</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Overall Status</label>
                            <select name="overall_status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Select --</option>
                                <option>Satisfactory</option>
                                <option>Unsatisfactory</option>
                                <option>Needs Attention</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- ── Section 4: Remarks ── -->
                <div class="mb-7">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">
                        Remarks
                    </h3>
                    <textarea name="remarks" rows="3" placeholder="Enter any remarks or observations..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                </div>

                <!-- ── Section 5: Upload ── -->
                <div class="mb-8">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">
                        Documents &amp; Photos
                    </h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Upload Files
                            <span class="text-gray-400 font-normal">(PDF, JPG, PNG — multiple allowed)</span>
                        </label>
                        <input type="file" id="formFiles" name="files[]"
                               multiple accept=".pdf,image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none">
                        <div id="fileDisplay" class="mt-2 text-xs text-gray-400 space-y-1">
                            No files selected.
                        </div>
                    </div>
                </div>

                <!-- ── Buttons ── -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100 gap-4">

                    <!-- Left: Prev -->
                    <div class="flex-shrink-0">
                        <?php if ($prev_url): ?>
                        <button type="button" id="prevFormBtn"
                            data-url="<?= htmlspecialchars($prev_url) ?>"
                            class="px-5 py-2 text-sm font-medium bg-gray-700 text-white rounded-lg hover:bg-gray-800 flex items-center gap-1">
                            ← Prev
                        </button>
                        <?php else: ?>
                        <div class="w-24"></div>
                        <?php endif; ?>
                    </div>

                    <!-- Centre: Reset / Upload / Submit -->
                    <div class="flex gap-3">
                        <button type="button" id="formResetBtn"
                            class="px-5 py-2 text-sm font-medium bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                            Reset
                        </button>
                        <button type="button" id="formUploadBtn"
                            class="px-5 py-2 text-sm font-medium bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Upload
                        </button>
                        <button type="button" id="formSubmitBtn"
                            class="px-5 py-2 text-sm font-medium bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Submit
                        </button>
                    </div>

                    <!-- Right: Next -->
                    <div class="flex-shrink-0">
                        <?php if ($next_url): ?>
                        <button type="button" id="nextFormBtn"
                            data-url="<?= htmlspecialchars($next_url) ?>"
                            class="px-5 py-2 text-sm font-medium bg-gray-700 text-white rounded-lg hover:bg-gray-800 flex items-center gap-1">
                            Next →
                        </button>
                        <?php else: ?>
                        <div class="w-24"></div>
                        <?php endif; ?>
                    </div>

                </div>

            </form>
        </div>

<?php if (!$embed): ?>
        </main>
    </div>
<?php else: ?>
    </div>
<?php endif; ?>

    <script src="/trd_eig/public/js/form_common.js"></script>

</body>
</html>
