<?php
/**
 * std_sidebar.php
 * Entry point for the "Standard Forms" tab in admin_home.php (loaded into
 * #pageContent by js/app.js's loadPage('std_forms')).
 *
 * Same umbrella -> project cascading pattern as sidebar.php / admin_dashboard.php,
 * but listing the fixed Standard Forms catalog (std_forms_master) instead of
 * per-project equipment, and with no per-user assigned_to restriction (every
 * admin sees every umbrella/project, like create_umbrella.php / create_project.php).
 *
 * Also serves as the AJAX endpoint for this tab (?action=...), same
 * single-file convention as sidebar.php.
 */

ob_start();
require_once __DIR__ . '/std_common.php';

$action = $_GET['action'] ?? ($_SERVER['REQUEST_METHOD'] === 'POST' ? ($_POST['action'] ?? '') : '');

/*| AJAX: projects for a given umbrella (all projects, admin-wide) |----------*/
if ($action === 'get_projects') {
    ob_clean();
    header('Content-Type: application/json');

    $umbrellaId = trim($_GET['umbrella_id'] ?? '');
    if ($umbrellaId === '') {
        echo json_encode(['success' => false, 'projects' => []]);
        exit;
    }

    $stmt = $pdo->prepare("
        SELECT common_id, project_data
        FROM umbrella_projects
        WHERE type = 'PID'
          AND JSON_UNQUOTE(JSON_EXTRACT(project_data, '$.parent_umbrella_id')) = ?
        ORDER BY common_id ASC
    ");
    $stmt->execute([$umbrellaId]);
    $rows = $stmt->fetchAll();

    $projects = array_map(function ($row) {
        $data = json_decode($row['project_data'] ?? '{}', true) ?: [];
        return [
            'project_id'   => $row['common_id'],
            'type_project' => $data['type_project'] ?? '',
            'location'     => $data['location'] ?? '',
        ];
    }, $rows);

    echo json_encode(['success' => true, 'projects' => $projects]);
    exit;
}

/*| AJAX: Standard Forms checklist for a given project |---------------------*/
if ($action === 'get_forms') {
    ob_clean();
    header('Content-Type: application/json');

    $projectId  = trim($_GET['project_id'] ?? '');
    $umbrellaId = trim($_GET['umbrella_id'] ?? '');
    if ($projectId === '') {
        echo json_encode(['success' => false, 'forms' => []]);
        exit;
    }

    $masters = $pdo->query("SELECT form_no, form_name, file_name, needs_signature FROM std_forms_master WHERE status = 'ACTIVE' ORDER BY sort_order ASC")->fetchAll();

    // Signature/tracking data already saved for this project.
    $stmt = $pdo->prepare("SELECT form_no, extra_data FROM std_form_entries WHERE project_id = ?");
    $stmt->execute([$projectId]);
    $entryMap = [];
    foreach ($stmt->fetchAll() as $row) {
        $entryMap[$row['form_no']] = json_decode($row['extra_data'] ?? '{}', true) ?: [];
    }

    // Attachment counts (project_uploads.project_id holds unique_stdform_id).
    $uniqueIds = array_map(fn($m) => std_unique_id($projectId, $m['form_no']), $masters);
    $countMap  = [];
    if ($uniqueIds) {
        $placeholders = implode(',', array_fill(0, count($uniqueIds), '?'));
        $stmt = $pdo->prepare("SELECT project_id, COUNT(*) AS cnt FROM project_uploads WHERE type = 'STDID' AND project_id IN ($placeholders) GROUP BY project_id");
        $stmt->execute($uniqueIds);
        foreach ($stmt->fetchAll() as $row) {
            $countMap[$row['project_id']] = (int) $row['cnt'];
        }
    }

    $forms = array_map(function ($m) use ($projectId, $entryMap, $countMap) {
        $uid    = std_unique_id($projectId, $m['form_no']);
        $extra  = $entryMap[$m['form_no']] ?? [];
        return [
            'form_no'          => $m['form_no'],
            'form_name'        => $m['form_name'],
            'file_name'        => $m['file_name'],
            'needs_signature'  => (bool) $m['needs_signature'],
            'signature_status' => $extra['signature']['status'] ?? 'pending',
            'attachment_count' => $countMap[$uid] ?? 0,
            'unique_stdform_id'=> $uid,
        ];
    }, $masters);

    echo json_encode(['success' => true, 'forms' => $forms]);
    exit;
}

/*| AJAX: fetch the shared "project standard-forms details" for editing |----*/
if ($action === 'get_project_details') {
    ob_clean();
    header('Content-Type: application/json');

    $projectId = trim($_GET['project_id'] ?? '');
    if ($projectId === '') {
        echo json_encode(['success' => false, 'message' => 'Project ID is required.']);
        exit;
    }

    $stmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'PID' AND common_id = ? LIMIT 1");
    $stmt->execute([$projectId]);
    $row = $stmt->fetch();
    if (!$row) {
        echo json_encode(['success' => false, 'message' => 'Project not found.']);
        exit;
    }
    $data = json_decode($row['project_data'] ?? '{}', true) ?: [];

    $details = [];
    foreach (STD_PROJECT_DETAIL_FIELDS as $key) {
        $details[$key] = $data[$key] ?? '';
    }
    foreach (STD_PROJECT_DETAIL_TABLES as $key => $cols) {
        $details[$key] = (!empty($data[$key]) && is_array($data[$key])) ? $data[$key] : [];
    }

    echo json_encode(['success' => true, 'details' => $details]);
    exit;
}

/*| AJAX: save the shared "project standard-forms details" |-----------------*/
if ($action === 'save_project_details' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_clean();
    header('Content-Type: application/json');

    $body      = json_decode(file_get_contents('php://input'), true) ?: [];
    $projectId = trim($body['project_id'] ?? '');
    if ($projectId === '') {
        echo json_encode(['success' => false, 'message' => 'Project ID is required.']);
        exit;
    }

    $stmt = $pdo->prepare("SELECT id, project_data FROM umbrella_projects WHERE type = 'PID' AND common_id = ? LIMIT 1");
    $stmt->execute([$projectId]);
    $row = $stmt->fetch();
    if (!$row) {
        echo json_encode(['success' => false, 'message' => 'Project not found.']);
        exit;
    }

    $data = json_decode($row['project_data'] ?? '{}', true) ?: [];

    foreach (STD_PROJECT_DETAIL_FIELDS as $key) {
        if (array_key_exists($key, $body)) {
            $data[$key] = trim((string) $body[$key]);
        }
    }
    foreach (STD_PROJECT_DETAIL_TABLES as $key => $cols) {
        if (isset($body[$key]) && is_array($body[$key])) {
            $clean = [];
            foreach ($body[$key] as $rowVals) {
                $r = [];
                foreach ($cols as $c) {
                    $r[$c] = trim((string) ($rowVals[$c] ?? ''));
                }
                if (implode('', $r) !== '') {
                    $clean[] = $r;
                }
            }
            $data[$key] = $clean;
        }
    }

    try {
        $by = std_identity();
        $pdo->prepare("UPDATE umbrella_projects SET project_data = ?, updated_by = ? WHERE id = ?")
            ->execute([json_encode($data, JSON_UNESCAPED_UNICODE), $by, $row['id']]);
        echo json_encode(['success' => true, 'message' => 'Project details saved.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
    exit;
}

/*| Normal page render |------------------------------------------------------*/
$umbrellas = $pdo->query("SELECT common_id FROM umbrella_projects WHERE type = 'UPID' ORDER BY common_id ASC")->fetchAll(PDO::FETCH_COLUMN);

ob_end_flush();
?>
<div class="flex gap-4" style="height: 720px;">

    <!-- Sidebar: umbrella -> project -> forms checklist -->
    <aside class="bg-gray-50 border border-gray-200 rounded-lg p-4 overflow-y-auto flex-shrink-0" style="width: 340px;">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Standard Forms</h2>
        <p class="text-xs text-gray-400 mb-4">Select umbrella and project to load the forms checklist.</p>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Umbrella ID <span class="text-red-500">*</span></label>
            <select id="stdUmbrella" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white">
                <option value="">-- Select Umbrella --</option>
                <?php foreach ($umbrellas as $u): ?>
                    <option value="<?= htmlspecialchars($u) ?>"><?= htmlspecialchars($u) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Project ID <span class="text-red-500">*</span></label>
            <select id="stdProject" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white" disabled>
                <option value="">-- First Select Umbrella --</option>
            </select>
        </div>

        <button type="button" id="stdDetailsBtn" disabled
            class="w-full mb-4 px-3 py-2 text-sm font-medium bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:bg-gray-300 disabled:cursor-not-allowed">
            Fill Project Standard-Forms Details
        </button>

        <label class="block text-sm font-medium text-gray-700 mb-2">Forms Checklist</label>
        <div class="border border-gray-200 rounded-lg overflow-hidden bg-white">
            <ul id="stdFormsList" class="divide-y divide-gray-100">
                <li class="px-3 py-3 text-sm text-gray-400 text-center">— Select a project first —</li>
            </ul>
        </div>
    </aside>

    <!-- Main: toolbar + iframe -->
    <main class="flex-1 flex flex-col border border-gray-200 rounded-lg overflow-hidden bg-white min-w-0">

        <div id="stdToolbar" class="hidden border-b border-gray-200 bg-gray-50 px-4 py-2 flex flex-wrap items-center gap-2 text-sm">
            <span id="stdToolbarTitle" class="font-semibold text-gray-700"></span>
            <span id="stdSignBadge" class="hidden px-2 py-0.5 rounded-full text-xs font-bold"></span>
            <div class="flex-1"></div>
            <button type="button" id="stdAttachBtn" class="px-3 py-1.5 bg-gray-700 text-white rounded-lg hover:bg-gray-800 text-xs font-medium">Attachments (<span id="stdAttachCount">0</span>)</button>
            <label id="stdSignUploadLabel" class="hidden cursor-pointer px-3 py-1.5 bg-green-600 text-white rounded-lg hover:bg-green-700 text-xs font-medium">
                Upload Signed Copy
                <input type="file" id="stdSignUploadInput" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="hidden">
            </label>
        </div>

        <div id="stdAttachPanel" class="hidden border-b border-gray-200 bg-gray-50 px-4 py-3 text-sm max-h-48 overflow-y-auto">
            <table class="w-full text-xs">
                <thead><tr class="text-left text-gray-500"><th class="py-1">File</th><th class="py-1">Uploaded</th><th class="py-1 text-center">View</th></tr></thead>
                <tbody id="stdAttachTableBody"></tbody>
            </table>
            <label class="inline-block mt-2 cursor-pointer px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-xs font-medium">
                + Add Attachment
                <input type="file" id="stdAttachInput" class="hidden">
            </label>
        </div>

        <div class="flex-1 relative">
            <iframe id="stdFormFrame" src="" class="w-full h-full border-none hidden" title="Standard Form"></iframe>
            <div id="stdFormPlaceholder" class="w-full h-full flex flex-col items-center justify-center text-center px-8">
                <div class="text-5xl mb-4">📋</div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">No form selected</h2>
                <p class="text-sm text-gray-400">Select an umbrella and project from the sidebar,<br>then click a form from the checklist.</p>
            </div>
        </div>
    </main>
</div>

<!-- Project Standard-Forms Details modal -->
<div id="stdDetailsModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-4xl max-h-[90vh] overflow-y-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Project Standard-Forms Details</h3>
            <button type="button" id="stdDetailsCloseBtn" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        <p class="text-sm text-gray-500 mb-4">Filled once per project — every Standard Form for this project reuses these values automatically.</p>

        <div id="stdDetailsFields" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6"></div>

        <div class="mb-6">
            <h4 class="font-semibold text-gray-700 mb-2">25KV Feeder Lines (Proforma 10.10)</h4>
            <table class="w-full text-sm border-collapse border border-gray-300 mb-2">
                <thead><tr class="bg-gray-100">
                    <th class="border border-gray-300 px-2 py-1">From</th>
                    <th class="border border-gray-300 px-2 py-1">To</th>
                    <th class="border border-gray-300 px-2 py-1">Length</th>
                    <th class="border border-gray-300 px-2 py-1">Description</th>
                    <th class="border border-gray-300 px-2 py-1 w-10"></th>
                </tr></thead>
                <tbody id="stdFeederRows"></tbody>
            </table>
            <button type="button" data-add-table="feeder_lines" class="px-3 py-1 bg-gray-200 rounded-lg text-xs font-medium hover:bg-gray-300">+ Add Row</button>
        </div>

        <div class="mb-6">
            <h4 class="font-semibold text-gray-700 mb-2">Auxiliary Transformers (Proforma 10.12 / 10.16)</h4>
            <table class="w-full text-sm border-collapse border border-gray-300 mb-2">
                <thead><tr class="bg-gray-100">
                    <th class="border border-gray-300 px-2 py-1">Location</th>
                    <th class="border border-gray-300 px-2 py-1">Rating</th>
                    <th class="border border-gray-300 px-2 py-1">Line</th>
                    <th class="border border-gray-300 px-2 py-1">Qty</th>
                    <th class="border border-gray-300 px-2 py-1 w-10"></th>
                </tr></thead>
                <tbody id="stdAuxRows"></tbody>
            </table>
            <button type="button" data-add-table="aux_transformers" class="px-3 py-1 bg-gray-200 rounded-lg text-xs font-medium hover:bg-gray-300">+ Add Row</button>
        </div>

        <div class="flex justify-end gap-3">
            <button type="button" id="stdDetailsCancelBtn" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">Cancel</button>
            <button type="button" id="stdDetailsSaveBtn" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">Save Details</button>
        </div>
    </div>
</div>

<script>
(function () {
    const FIELD_LABELS = <?= json_encode(array_combine(STD_PROJECT_DETAIL_FIELDS, array_map(function ($k) {
        return ucwords(str_replace('_', ' ', $k));
    }, STD_PROJECT_DETAIL_FIELDS))) ?>;
    const DATE_FIELDS  = ['energization_date', 'bonding_date', 'contractor_date'];
    const AREA_FIELDS  = ['reg_description'];
    const TABLE_COLS   = <?= json_encode(STD_PROJECT_DETAIL_TABLES) ?>;

    const umbrellaSel = document.getElementById('stdUmbrella');
    const projectSel  = document.getElementById('stdProject');
    const detailsBtn  = document.getElementById('stdDetailsBtn');
    const formsList   = document.getElementById('stdFormsList');
    const frame       = document.getElementById('stdFormFrame');
    const placeholder = document.getElementById('stdFormPlaceholder');
    const toolbar     = document.getElementById('stdToolbar');
    const toolbarTitle= document.getElementById('stdToolbarTitle');
    const signBadge   = document.getElementById('stdSignBadge');
    const attachBtn   = document.getElementById('stdAttachBtn');
    const attachCount = document.getElementById('stdAttachCount');
    const attachPanel = document.getElementById('stdAttachPanel');
    const attachBody  = document.getElementById('stdAttachTableBody');
    const attachInput = document.getElementById('stdAttachInput');
    const signLabel   = document.getElementById('stdSignUploadLabel');
    const signInput   = document.getElementById('stdSignUploadInput');

    let currentForm = null; // { form_no, form_name, file_name, needs_signature, unique_stdform_id }

    function escHtml(str) {
        const d = document.createElement('div');
        d.textContent = str == null ? '' : String(str);
        return d.innerHTML;
    }

    // ── Umbrella -> Project ──────────────────────────────────────────────────
    umbrellaSel.addEventListener('change', function () {
        const umbrellaId = this.value;
        projectSel.innerHTML = '<option value="">Loading...</option>';
        projectSel.disabled = true;
        detailsBtn.disabled = true;
        resetForms();

        if (!umbrellaId) {
            projectSel.innerHTML = '<option value="">-- First Select Umbrella --</option>';
            return;
        }

        fetch('std_forms/std_sidebar.php?action=get_projects&umbrella_id=' + encodeURIComponent(umbrellaId))
            .then(r => r.json())
            .then(data => {
                projectSel.innerHTML = '<option value="">-- Select Project --</option>';
                if (data.success && data.projects.length) {
                    data.projects.forEach(p => {
                        const opt = document.createElement('option');
                        opt.value = p.project_id;
                        opt.textContent = p.project_id + (p.location ? ' - ' + p.location : '');
                        projectSel.appendChild(opt);
                    });
                    projectSel.disabled = false;
                } else {
                    projectSel.innerHTML = '<option value="">No Projects Found</option>';
                }
            })
            .catch(() => { projectSel.innerHTML = '<option value="">Error Loading Projects</option>'; });
    });

    // ── Project -> Forms checklist ───────────────────────────────────────────
    projectSel.addEventListener('change', function () {
        const projectId = this.value;
        resetForms();
        if (!projectId) return;

        detailsBtn.disabled = false;
        formsList.innerHTML = '<li class="px-3 py-3 text-sm text-gray-400 text-center">Loading...</li>';

        fetch('std_forms/std_sidebar.php?action=get_forms&project_id=' + encodeURIComponent(projectId) + '&umbrella_id=' + encodeURIComponent(umbrellaSel.value))
            .then(r => r.json())
            .then(data => renderForms(data.forms || []))
            .catch(() => { formsList.innerHTML = '<li class="px-3 py-3 text-sm text-red-400 text-center">Error loading forms.</li>'; });
    });

    function resetForms() {
        formsList.innerHTML = '<li class="px-3 py-3 text-sm text-gray-400 text-center">— Select a project first —</li>';
        frame.classList.add('hidden');
        frame.src = '';
        placeholder.classList.remove('hidden');
        toolbar.classList.add('hidden');
        attachPanel.classList.add('hidden');
        currentForm = null;
    }

    function renderForms(forms) {
        if (!forms.length) {
            formsList.innerHTML = '<li class="px-3 py-3 text-sm text-gray-400 text-center">No standard forms configured.</li>';
            return;
        }
        formsList.innerHTML = '';
        forms.forEach((f, i) => {
            const li = document.createElement('li');
            li.className = 'px-3 py-2 cursor-pointer hover:bg-blue-50 flex items-center gap-2';
            li.dataset.formNo = f.form_no;

            const signed = f.needs_signature && f.signature_status === 'signed';
            const pending = f.needs_signature && f.signature_status !== 'signed';

            li.innerHTML = `
                <span class="text-xs text-gray-400 w-8 flex-shrink-0">${escHtml(f.form_no)}</span>
                <span class="flex-1 min-w-0 text-sm text-gray-700 whitespace-normal break-words">${escHtml(f.form_name)}</span>
                ${f.attachment_count > 0 ? `<span class="text-xs text-gray-400 flex-shrink-0">📎${f.attachment_count}</span>` : ''}
                ${signed ? '<span class="text-xs font-bold px-1.5 py-0.5 rounded-full flex-shrink-0" style="color:#16a34a;background:#dcfce7">Signed</span>' : ''}
                ${pending ? '<span class="text-xs font-bold px-1.5 py-0.5 rounded-full flex-shrink-0" style="color:#dc2626;background:#fee2e2">Pending</span>' : ''}
            `;
            li.addEventListener('click', () => openForm(f, i));
            formsList.appendChild(li);
        });
    }

    function openForm(f) {
        currentForm = f;
        document.querySelectorAll('#stdFormsList li').forEach(el => el.classList.remove('bg-blue-100'));
        const li = Array.from(formsList.children).find(el => el.dataset.formNo === f.form_no);
        if (li) li.classList.add('bg-blue-100');

        const url = 'std_forms/' + f.file_name + '.php'
            + '?umbrella_id=' + encodeURIComponent(umbrellaSel.value)
            + '&project_id=' + encodeURIComponent(projectSel.value)
            + '&form_no=' + encodeURIComponent(f.form_no);

        frame.src = url;
        frame.classList.remove('hidden');
        placeholder.classList.add('hidden');

        toolbarTitle.textContent = f.form_no + ' — ' + f.form_name;
        toolbar.classList.remove('hidden');
        attachPanel.classList.add('hidden');

        if (f.needs_signature) {
            signBadge.classList.remove('hidden');
            const signed = f.signature_status === 'signed';
            signBadge.textContent = signed ? 'Digitally Signed' : 'Signature Pending';
            signBadge.style.color = signed ? '#16a34a' : '#dc2626';
            signBadge.style.background = signed ? '#dcfce7' : '#fee2e2';
            signLabel.classList.toggle('hidden', signed);
        } else {
            signBadge.classList.add('hidden');
            signLabel.classList.add('hidden');
        }

        attachCount.textContent = f.attachment_count || 0;
    }

    // ── Attachments panel ────────────────────────────────────────────────────
    attachBtn.addEventListener('click', function () {
        if (!currentForm) return;
        attachPanel.classList.toggle('hidden');
        if (!attachPanel.classList.contains('hidden')) loadAttachments();
    });

    function loadAttachments() {
        if (!currentForm) return;
        attachBody.innerHTML = '<tr><td colspan="3" class="text-center text-gray-400 py-2">Loading...</td></tr>';
        fetch('std_forms/std_upload.php?unique_stdform_id=' + encodeURIComponent(currentForm.unique_stdform_id))
            .then(r => r.json())
            .then(data => {
                if (!data.success || !data.uploads.length) {
                    attachBody.innerHTML = '<tr><td colspan="3" class="text-center text-gray-400 py-2">No attachments yet.</td></tr>';
                    return;
                }
                attachBody.innerHTML = data.uploads.map(u => `
                    <tr class="border-b">
                        <td class="py-1">${u.document_id === 'signed_copy' ? '✍ ' : ''}${escHtml(u.original_name)}</td>
                        <td class="py-1">${escHtml((u.uploaded_at || '').replace('T', ' '))}</td>
                        <td class="py-1 text-center"><a class="text-blue-600 hover:underline" target="_blank" href="std_forms/std_upload.php?action=view&id=${u.id}">View</a></td>
                    </tr>
                `).join('');
            })
            .catch(() => { attachBody.innerHTML = '<tr><td colspan="3" class="text-center text-red-400 py-2">Error loading attachments.</td></tr>'; });
    }

    function uploadFile(file, documentId) {
        const fd = new FormData();
        fd.append('unique_stdform_id', currentForm.unique_stdform_id);
        fd.append('project_id', projectSel.value);
        fd.append('umbrella_id', umbrellaSel.value);
        fd.append('form_no', currentForm.form_no);
        fd.append('document_id', documentId || '');
        fd.append('file', file);

        return fetch('std_forms/std_upload.php', { method: 'POST', body: fd }).then(r => r.json());
    }

    attachInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file || !currentForm) return;
        uploadFile(file, '').then(data => {
            this.value = '';
            if (data.success) {
                currentForm.attachment_count = (currentForm.attachment_count || 0) + 1;
                attachCount.textContent = currentForm.attachment_count;
                loadAttachments();
            } else {
                alert('Upload failed: ' + (data.message || 'Unknown error.'));
            }
        }).catch(() => alert('Connection error.'));
    });

    signInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file || !currentForm) return;
        uploadFile(file, 'signed_copy').then(data => {
            this.value = '';
            if (data.success) {
                currentForm.signature_status = 'signed';
                currentForm.attachment_count = (currentForm.attachment_count || 0) + 1;
                attachCount.textContent = currentForm.attachment_count;
                signBadge.textContent = 'Digitally Signed';
                signBadge.style.color = '#16a34a';
                signBadge.style.background = '#dcfce7';
                signLabel.classList.add('hidden');
                const li = Array.from(formsList.children).find(el => el.dataset.formNo === currentForm.form_no);
                if (li) {
                    const pendingBadge = li.querySelector('span[style*="dc2626"]');
                    if (pendingBadge) pendingBadge.remove();
                    if (!li.querySelector('.std-signed-badge')) {
                        const badge = document.createElement('span');
                        badge.className = 'std-signed-badge text-xs font-bold px-1.5 py-0.5 rounded-full flex-shrink-0';
                        badge.style.color = '#16a34a';
                        badge.style.background = '#dcfce7';
                        badge.textContent = 'Signed';
                        li.appendChild(badge);
                    }
                }
                loadAttachments();
            } else {
                alert('Upload failed: ' + (data.message || 'Unknown error.'));
            }
        }).catch(() => alert('Connection error.'));
    });

    // ── Project Standard-Forms Details modal ─────────────────────────────────
    const modal        = document.getElementById('stdDetailsModal');
    const fieldsWrap    = document.getElementById('stdDetailsFields');
    const feederRows    = document.getElementById('stdFeederRows');
    const auxRows       = document.getElementById('stdAuxRows');

    function inputRow(container, cols, values) {
        const tr = document.createElement('tr');
        tr.innerHTML = cols.map(c => `<td class="border border-gray-300 px-1 py-1"><input type="text" data-col="${c}" value="${escHtml(values ? values[c] : '')}" class="w-full px-1 py-1 text-xs border border-gray-200 rounded"></td>`).join('')
            + '<td class="border border-gray-300 text-center"><button type="button" class="text-red-500 text-xs" data-remove-row>&times;</button></td>';
        tr.querySelector('[data-remove-row]').addEventListener('click', () => tr.remove());
        container.appendChild(tr);
    }

    document.querySelectorAll('[data-add-table]').forEach(btn => {
        btn.addEventListener('click', function () {
            const key = this.dataset.addTable;
            if (key === 'feeder_lines') inputRow(feederRows, TABLE_COLS.feeder_lines, null);
            if (key === 'aux_transformers') inputRow(auxRows, TABLE_COLS.aux_transformers, null);
        });
    });

    detailsBtn.addEventListener('click', function () {
        const projectId = projectSel.value;
        if (!projectId) return;

        fieldsWrap.innerHTML = '<p class="text-gray-400 text-sm">Loading...</p>';
        feederRows.innerHTML = '';
        auxRows.innerHTML = '';
        modal.classList.remove('hidden');

        fetch('std_forms/std_sidebar.php?action=get_project_details&project_id=' + encodeURIComponent(projectId))
            .then(r => r.json())
            .then(data => {
                if (!data.success) {
                    fieldsWrap.innerHTML = '<p class="text-red-500 text-sm">' + escHtml(data.message || 'Error') + '</p>';
                    return;
                }
                const d = data.details;
                fieldsWrap.innerHTML = Object.keys(FIELD_LABELS).map(key => {
                    const isArea = AREA_FIELDS.includes(key);
                    const type   = DATE_FIELDS.includes(key) ? 'date' : 'text';
                    const val    = escHtml(d[key] || '');
                    if (isArea) {
                        return `<div class="md:col-span-3"><label class="block text-xs font-medium text-gray-600 mb-1">${FIELD_LABELS[key]}</label>
                            <textarea data-field="${key}" rows="3" class="w-full px-2 py-1.5 border border-gray-300 rounded text-sm">${val}</textarea></div>`;
                    }
                    return `<div><label class="block text-xs font-medium text-gray-600 mb-1">${FIELD_LABELS[key]}</label>
                        <input type="${type}" data-field="${key}" value="${val}" class="w-full px-2 py-1.5 border border-gray-300 rounded text-sm"></div>`;
                }).join('');

                (d.feeder_lines || []).forEach(row => inputRow(feederRows, TABLE_COLS.feeder_lines, row));
                (d.aux_transformers || []).forEach(row => inputRow(auxRows, TABLE_COLS.aux_transformers, row));
            })
            .catch(() => { fieldsWrap.innerHTML = '<p class="text-red-500 text-sm">Connection error.</p>'; });
    });

    document.getElementById('stdDetailsCloseBtn').addEventListener('click', () => modal.classList.add('hidden'));
    document.getElementById('stdDetailsCancelBtn').addEventListener('click', () => modal.classList.add('hidden'));

    function collectTable(container, cols) {
        return Array.from(container.querySelectorAll('tr')).map(tr => {
            const row = {};
            cols.forEach(c => { row[c] = tr.querySelector(`[data-col="${c}"]`).value.trim(); });
            return row;
        }).filter(row => Object.values(row).some(v => v !== ''));
    }

    document.getElementById('stdDetailsSaveBtn').addEventListener('click', function () {
        const payload = { project_id: projectSel.value };
        fieldsWrap.querySelectorAll('[data-field]').forEach(el => { payload[el.dataset.field] = el.value; });
        payload.feeder_lines     = collectTable(feederRows, TABLE_COLS.feeder_lines);
        payload.aux_transformers = collectTable(auxRows, TABLE_COLS.aux_transformers);

        fetch('std_forms/std_sidebar.php?action=save_project_details', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                modal.classList.add('hidden');
                if (currentForm && frame.src) frame.src = frame.src; // reload to reflect new data
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon: 'success', title: 'Saved', text: data.message, confirmButtonColor: '#2563EB' });
                } else {
                    alert(data.message);
                }
            } else {
                alert('Save failed: ' + (data.message || 'Unknown error.'));
            }
        })
        .catch(() => alert('Connection error.'));
    });
})();
</script>
