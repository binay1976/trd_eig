<?php
// ── AJAX: save selected forms ─────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_start();
    require_once __DIR__ . '/../config/database.php';
    header('Content-Type: application/json');

    $data       = json_decode(file_get_contents('php://input'), true);
    $project_id = trim($data['project_id'] ?? '');
    $forms      = $data['forms'] ?? [];   // array of form data from JS

    if ($project_id === '' || empty($forms)) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Project and forms are required.']);
        exit;
    }

    // project_id is always "{umbrella_id}||PID\..." (see create_project.php) —
    // the parent umbrella_id is everything before that separator.
    $umbrella_id = strstr($project_id, '||PID\\', true);
    if ($umbrella_id === false) {
        $umbrella_id = null;
    }

    $inserted = [];
    $skipped  = [];
    $errors   = [];

    foreach ($forms as $form) {
        $form_no   = trim($form['form_no']);
        $form_name = trim($form['form_name']);
        $nature    = trim($form['nature'] ?? '');
        $quantity  = max(1, (int)$form['quantity']);

        // Generate A, B, C ... based on quantity
        for ($i = 0; $i < $quantity; $i++) {
            $seq            = chr(65 + $i);          // 65 = ASCII 'A'
            $unique_form_id = $project_id . '||EID\\' . $form_no . '\\' . $seq;

            try {
                $stmt = $pdo->prepare("
                    INSERT IGNORE INTO project_forms
                        (unique_form_id, project_id, umbrella_id, form_no, form_name, nature, quantity, sequence_label)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([$unique_form_id, $project_id, $umbrella_id, $form_no, $form_name, $nature, $quantity, $seq]);
                if ($stmt->rowCount() > 0) {
                    $inserted[] = $unique_form_id;   // actually inserted
                } else {
                    $skipped[]  = $unique_form_id;   // already existed, skipped
                }
            } catch (Exception $e) {
                $errors[] = $unique_form_id . ': ' . $e->getMessage();
            }
        }
    }

    ob_clean();
    echo json_encode([
        'success'  => empty($errors),
        'inserted' => $inserted,
        'skipped'  => $skipped,
        'errors'   => $errors,
    ]);
    exit;
}

// ── AJAX: fetch forms by project_id ──────────────────────────────────────────
if (isset($_GET['project_id'])) {
    error_reporting(0);
    ob_start();

    require_once __DIR__ . '/../config/database.php';

    header('Content-Type: application/json');

    $project_id = trim($_GET['project_id']);

    if ($project_id === '') {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Project ID is required.']);
        exit;
    }

    // Step 1: get type_project for the selected project (from project_data JSON)
    $stmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'PID' AND common_id = ? LIMIT 1");
    $stmt->execute([$project_id]);
    $projectRow = $stmt->fetch();

    if (!$projectRow) {
        ob_clean();
        echo json_encode(['success' => false, 'message' => 'Project not found.']);
        exit;
    }

    $projectData = json_decode($projectRow['project_data'] ?? '{}', true) ?: [];
    $project     = ['type_project' => $projectData['type_project'] ?? ''];

    // Step 2: fetch active forms matching that type_project
    $stmt = $pdo->prepare("
        SELECT id, form_no, form_name, nature, status
        FROM forms
        WHERE type_project = ? AND status = 'ACTIVE'
        ORDER BY form_no ASC
    ");
    $stmt->execute([$project['type_project']]);
    $forms = $stmt->fetchAll();

    // Step 3: fetch already saved forms for this project
    $stmt = $pdo->prepare("
        SELECT form_no, quantity, COUNT(*) as saved_count
        FROM project_forms
        WHERE project_id = ?
        GROUP BY form_no, quantity
    ");
    $stmt->execute([$project_id]);
    $savedRaw = $stmt->fetchAll();

    $saved = [];
    foreach ($savedRaw as $row) {
        $saved[$row['form_no']] = [
            'quantity'    => (int)$row['quantity'],
            'saved_count' => (int)$row['saved_count'],
        ];
    }

    ob_clean();
    echo json_encode([
        'success'      => true,
        'type_project' => $project['type_project'],
        'forms'        => $forms,
        'saved'        => $saved,
    ]);
    exit;
}

// ── GET: render page ──────────────────────────────────────────────────────────
require_once __DIR__ . '/../config/database.php';

try {
    $stmt     = $pdo->query("SELECT common_id AS project_id FROM umbrella_projects WHERE type = 'PID' ORDER BY common_id ASC");
    $projects = $stmt->fetchAll();
} catch (Exception $e) {
    $projects = [];
}
?>

<div class="max-w-5xl mx-auto">

    <!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Add Equipments & Machines</h2>
        <p class="text-sm text-gray-500 mt-1">
            Select a project and define the quantity of equipments and machines required.
        </p>
    </div>

    <!-- Project Selection -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="project_id" class="block text-sm font-medium text-gray-700 mb-2">
                Project ID <span class="text-red-500">*</span>
            </label>
            <select id="project_id" name="project_id"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="">-- Select Project --</option>
                <?php foreach ($projects as $row): ?>
                    <option value="<?= htmlspecialchars($row['project_id']) ?>">
                        <?= htmlspecialchars($row['project_id']) ?>
                    </option>
                <?php endforeach; ?>
                <?php if (empty($projects)): ?>
                    <option value="" disabled>No projects found</option>
                <?php endif; ?>
            </select>
        </div>
    </div>

    <!-- Type badge -->
    <div class="mb-4">
        <span id="typeProjectBadge"
            class="hidden inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">
        </span>
    </div>

    <!-- Forms Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-3 text-center">S. No.</th>
                    <th class="border border-gray-300 px-4 py-3 text-left">Form Name</th>
                    <th class="border border-gray-300 px-4 py-3 text-left">Form No.</th>
                    <th class="border border-gray-300 px-4 py-3 text-left">Nature</th>
                    <th class="border border-gray-300 px-4 py-3 text-center">Quantity</th>
                    <th class="border border-gray-300 px-4 py-3 text-center">Select</th>
                </tr>
            </thead>
            <tbody id="formsTableBody">
                <tr>
                    <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                        Select a project to view forms.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-center gap-4 mt-6">
        <button type="button" id="resetFormsBtn"
            class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
            Reset
        </button>
        <button type="button" id="continueBtn"
            class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm">
            Submit
        </button>
    </div>

    <script>
    // ── Project dropdown → load forms table ───────────────────────────────────
    document.getElementById('project_id').addEventListener('change', function () {
        const projectId = this.value;
        const tbody     = document.getElementById('formsTableBody');
        const badge     = document.getElementById('typeProjectBadge');

        if (!projectId) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                        Select a project to view forms.
                    </td>
                </tr>`;
            if (badge) badge.classList.add('hidden');
            return;
        }

        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-gray-400">
                    Loading forms...
                </td>
            </tr>`;

        fetch('create_equipment.php?project_id=' + encodeURIComponent(projectId))
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-red-500">
                                ${data.message}
                            </td>
                        </tr>`;
                    return;
                }

                if (badge) {
                    badge.textContent = 'Type: ' + data.type_project;
                    badge.classList.remove('hidden');
                }

                if (data.forms.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                                No forms found for type <strong>${data.type_project}</strong>.
                            </td>
                        </tr>`;
                    return;
                }

                const saved = data.saved || {};

                tbody.innerHTML = data.forms.map((form, index) => {
                    const s         = saved[form.form_no];
                    const isSaved   = !!s;
                    const savedQty  = isSaved ? s.quantity    : 0;
                    const savedCnt  = isSaved ? s.saved_count : 0;

                    // Build sequence labels e.g. A, B, C
                    const seqLabels = [];
                    for (let i = 0; i < savedCnt; i++) seqLabels.push(String.fromCharCode(65 + i));

                    const savedBadge = isSaved
                        ? `<span class="ml-2 text-xs font-semibold text-green-700 bg-green-100 px-2 py-0.5 rounded-full">
                               Saved: ${savedCnt} (${seqLabels.join(', ')})
                           </span>`
                        : '';

                    const rowClass = isSaved ? 'bg-green-50' : 'hover:bg-gray-50';

                    return `
                    <tr class="${rowClass}">
                        <td class="border border-gray-300 px-4 py-3 text-center text-sm">${index + 1}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm font-medium">
                            ${escHtml(form.form_name)}${savedBadge}
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-sm text-gray-600">${escHtml(form.form_no)}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm text-gray-500">${escHtml(form.nature || '—')}</td>
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <input type="number" min="0" name="quantity[${form.id}]"
                                value="${isSaved ? savedQty : ''}"
                                class="w-20 px-2 py-1 border border-gray-300 rounded text-center text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="0">
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <input type="checkbox" name="selected[]" value="${form.id}"
                                ${isSaved ? 'checked' : ''}
                                class="w-4 h-4 accent-blue-600 cursor-pointer">
                        </td>
                    </tr>`;
                }).join('');
            })
            .catch(() => {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-red-500">
                            Connection error. Please try again.
                        </td>
                    </tr>`;
            });
    });

    function escHtml(str) {
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    // ── Reset button ──────────────────────────────────────────────────────────
    document.getElementById('resetFormsBtn').addEventListener('click', function () {
        document.getElementById('project_id').value = '';
        document.getElementById('formsTableBody').innerHTML = `
            <tr>
                <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                    Select a project to view forms.
                </td>
            </tr>`;
        const badge = document.getElementById('typeProjectBadge');
        if (badge) badge.classList.add('hidden');
    });

    // ── Submit button ─────────────────────────────────────────────────────────
    document.getElementById('continueBtn').addEventListener('click', function () {
        const projectId = document.getElementById('project_id').value;
        if (!projectId) {
            alert('Please select a project first.');
            return;
        }

        const checked = document.querySelectorAll('input[name="selected[]"]:checked');
        if (checked.length === 0) {
            alert('Please select at least one form.');
            return;
        }

        const forms = [];
        checked.forEach(function (checkbox) {
            const row      = checkbox.closest('tr');
            const cells    = row.querySelectorAll('td');
            const qtyInput = row.querySelector('input[type="number"]');
            const qty      = parseInt(qtyInput ? qtyInput.value : 1) || 1;

            forms.push({
                form_no:   cells[2].textContent.trim(),
                form_name: cells[1].textContent.trim(),
                nature:    cells[3].textContent.trim(),
                quantity:  qty
            });
        });

        fetch('create_equipment.php', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify({ project_id: projectId, forms: forms })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                let html = '';
                if (data.inserted.length) {
                    html += '<p style="font-weight:600;margin-bottom:4px;color:#166534">Newly Added:</p>'
                          + '<div style="text-align:left;font-size:13px;margin-bottom:10px">'
                          + data.inserted.map(id => '• ' + id).join('<br>') + '</div>';
                }
                if (data.skipped.length) {
                    html += '<p style="font-weight:600;margin-bottom:4px;color:#92400e">Already Existed (skipped):</p>'
                          + '<div style="text-align:left;font-size:13px;color:#78350f">'
                          + data.skipped.map(id => '• ' + id).join('<br>') + '</div>';
                }
                if (!data.inserted.length && !data.skipped.length) {
                    html = 'Nothing to save.';
                }
                Swal.fire({
                    icon:  data.inserted.length ? 'success' : 'info',
                    title: data.inserted.length ? 'Saved Successfully!' : 'Nothing New to Save',
                    html:  '<div style="max-height:250px;overflow-y:auto">' + html + '</div>',
                    confirmButtonText:  'OK',
                    confirmButtonColor: '#2563EB',
                }).then(() => {
                    document.getElementById('project_id').dispatchEvent(new Event('change'));
                });
            } else {
                const msg = (data.errors && data.errors.length)
                    ? data.errors.join('\n')
                    : (data.message || 'Unknown error.');
                Swal.fire({
                    icon:  'error',
                    title: 'Save Failed',
                    text:  msg,
                    confirmButtonColor: '#2563EB',
                });
            }
        })
        .catch(() => Swal.fire({
            icon:  'error',
            title: 'Connection Error',
            text:  'Could not reach the server. Please try again.',
            confirmButtonColor: '#2563EB',
        }));
    });
    </script>

</div>
