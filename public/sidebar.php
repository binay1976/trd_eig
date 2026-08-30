<?php
/*
 * sidebar.php
 * ---------------------------------------------------------------------
 * Used two ways:
 *   1) Included from form.php to render the umbrella/project/equipment
 *      picker in the left sidebar.
 *   2) Hit directly via fetch() as a JSON AJAX endpoint:
 *        - ?action=get_projects&umbrella_id=...  -> list of project_ids
 *        - ?project_id=...                       -> equipment/form list
 *
 * All fetch() URLs below are RELATIVE (no leading slash) because this
 * file lives in the same directory as sidebar.php/uploads.php/
 * get_form_data.php/forms/*.php on both dev (served from public/ as
 * webroot) and prod (served under /trd_eig/public/). A relative path
 * resolves correctly in both cases; a hardcoded /trd_eig/public/...
 * path 404s on dev.
 * ---------------------------------------------------------------------
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Buffer everything so a stray notice/warning from anywhere (this file,
// database.php, etc.) can never leak into a JSON response and break
// response.json() on the client.
ob_start();

require_once __DIR__ . '/../config/database.php';

$userName = $_SESSION['username'] ?? '';
$desig    = $_SESSION['desig'] ?? '';
$agency   = $_SESSION['executing_agency'] ?? '';

// Some historical rows were written with "/" separators, some with "\".
// Match either so old and new data both resolve to the logged-in user.
$identityVariants = array_values(array_unique(array_filter([
    trim($userName . '/' . $desig . '/' . $agency),
    trim($userName . '\\' . $desig . '\\' . $agency),
], fn($v) => $v !== '')));

/*| AJAX: Get Project IDs for a given Umbrella ID (logged-in user only) |----*/
if (isset($_GET['action']) && $_GET['action'] === 'get_projects') {
    ob_clean();
    header('Content-Type: application/json');

    $umbrellaId = trim($_GET['umbrella_id'] ?? '');
    if ($umbrellaId === '' || empty($identityVariants)) {
        echo json_encode(['success' => false, 'projects' => []]);
        exit;
    }

    $placeholders = implode(',', array_fill(0, count($identityVariants), '?'));
    $stmt = $pdo->prepare("
        SELECT DISTINCT project_id
        FROM project_forms
        WHERE umbrella_id = ?
          AND assigned_to IN ($placeholders)
          AND project_id IS NOT NULL
          AND project_id <> ''
        ORDER BY project_id
    ");
    $stmt->execute([$umbrellaId, ...$identityVariants]);

    echo json_encode([
        'success'  => true,
        'projects' => $stmt->fetchAll(PDO::FETCH_COLUMN),
    ]);
    exit;
}

/*| AJAX: Get Equipment/Form list for a given Project ID (logged-in user only) |*/
if (isset($_GET['project_id'])) {
    ob_clean();
    header('Content-Type: application/json');

    $projectId = trim($_GET['project_id'] ?? '');
    if ($projectId === '' || empty($identityVariants)) {
        echo json_encode(['type_project' => '', 'equipment' => []]);
        exit;
    }

    $placeholders = implode(',', array_fill(0, count($identityVariants), '?'));
    $stmt = $pdo->prepare("
        SELECT form_name, form_no, unique_form_id, sequence_label, is_filled
        FROM project_forms
        WHERE project_id = ?
          AND assigned_to IN ($placeholders)
        ORDER BY form_no ASC, sequence_label ASC
    ");
    $stmt->execute([$projectId, ...$identityVariants]);

    $rows = $stmt->fetchAll();
    $grouped = [];

    foreach ($rows as $row) {
        $key = $row['form_no'];
        if (!isset($grouped[$key])) {
            $grouped[$key] = [
                'form_name' => $row['form_name'],
                'form_no'   => $row['form_no'],
                'total'     => 0,
                'filled'    => 0,
                'instances' => [],
            ];
        }

        $grouped[$key]['total']++;
        if ((int)$row['is_filled'] === 1) {
            $grouped[$key]['filled']++;
        }

        $grouped[$key]['instances'][] = [
            'uid'       => $row['unique_form_id'],
            'label'     => $row['sequence_label'],
            'is_filled' => (int)$row['is_filled'],
        ];
    }

    echo json_encode([
        'type_project' => '',
        'equipment'    => array_values($grouped),
    ]);
    exit;
}

/*| Normal page render: Umbrella IDs for the logged-in user |----------------*/
if (!empty($identityVariants)) {
    $placeholders = implode(',', array_fill(0, count($identityVariants), '?'));
    $stmt = $pdo->prepare("
        SELECT DISTINCT umbrella_id
        FROM project_forms
        WHERE assigned_to IN ($placeholders)
          AND umbrella_id IS NOT NULL
          AND umbrella_id <> ''
        ORDER BY umbrella_id
    ");
    $stmt->execute($identityVariants);
    $umbrellas = $stmt->fetchAll(PDO::FETCH_COLUMN);
} else {
    $umbrellas = [];
}

// From here on we're rendering HTML, so let the buffered output flow
// normally to the browser.
ob_end_flush();
?>
<div class="max-w-sm">
    <!-- Heading -->
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-800">Field User Console</h2>
        <p class="text-xs text-gray-400 mt-0.5">Select umbrella and project to load Forms</p>
    </div>

    <!-- Umbrella ID Dropdown -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Umbrella ID <span class="text-red-500">*</span>
        </label>
        <select
            id="umbrella_id"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white"
        >
            <option value="">-- Select Umbrella --</option>
            <?php foreach ($umbrellas as $umbrellaId): ?>
                <option value="<?= htmlspecialchars($umbrellaId) ?>">
                    <?= htmlspecialchars($umbrellaId) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Project ID Dropdown -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Project ID <span class="text-red-500">*</span>
        </label>
        <select
            id="project_id"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white"
            disabled>
            <option value="">-- First Select Umbrella --</option>
        </select>
    </div>

    <!-- Equipment List -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Equipment Data Entry Forms
        </label>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <ul id="equipment_list" class="divide-y divide-gray-100">
                <li class="px-3 py-3 text-sm text-gray-400 text-center">
                    — Select a project first —
                </li>
            </ul>
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex gap-3">
        <button type="button" id="resetBtn"
            class="flex-1 px-4 py-2 text-sm font-medium bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
            Reset
        </button>
        <button type="button"
            class="flex-1 px-4 py-2 text-sm font-medium bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Continue
        </button>
    </div>
</div>

<script>
const umbrellaDropdown = document.getElementById('umbrella_id');
const projectDropdown  = document.getElementById('project_id');

umbrellaDropdown.addEventListener('change', function () {
    const umbrellaId = this.value;
    projectDropdown.innerHTML = '<option value="">Loading Projects...</option>';
    projectDropdown.disabled = true;

    if (!umbrellaId) {
        projectDropdown.innerHTML = '<option value="">-- First Select Umbrella --</option>';
        return;
    }

    fetch('sidebar.php?action=get_projects&umbrella_id=' + encodeURIComponent(umbrellaId))
        .then(response => {
            if (!response.ok) throw new Error('HTTP ' + response.status);
            return response.json();
        })
        .then(data => {
            projectDropdown.innerHTML = '<option value="">-- Select Project --</option>';
            if (data.success && data.projects.length > 0) {
                data.projects.forEach(projectId => {
                    const option = document.createElement('option');
                    option.value = projectId;
                    option.textContent = projectId;
                    projectDropdown.appendChild(option);
                });
                projectDropdown.disabled = false;
            } else {
                projectDropdown.innerHTML = '<option value="">No Projects Found</option>';
            }
        })
        .catch(error => {
            console.error('Project loading error:', error);
            projectDropdown.innerHTML = '<option value="">Error Loading Projects</option>';
        });
});

// ── Build form page URL: filename is exactly form_name + .php ────────────────
function formUrl(type, formName) {
    const safeName = (formName || '').trim();
    if (!safeName) return '';
    return 'forms/' + safeName + '.php';
}

// ── Current form-instance navigation state — one equipment item's A/B/C... ───
window.formNav = { base: '', instances: [], currentIdx: 0, liIndex: -1 };

function hasUnsavedChanges() {
    const frame = document.getElementById('formFrame');
    if (!frame) return false;
    let doc;
    try { doc = frame.contentDocument; } catch (e) { return false; }
    if (!doc) return false;
    const fields = doc.querySelectorAll('input, textarea, select');
    for (let i = 0; i < fields.length; i++) {
        const f = fields[i];
        if (['button', 'submit', 'reset', 'file'].includes(f.type)) continue;
        if (f.type === 'checkbox' || f.type === 'radio') {
            if (f.checked) return true;
        } else if (f.value && f.value.trim() !== '') {
            return true;
        }
    }
    return false;
}

function confirmLeaveIfDirty() {
    if (!hasUnsavedChanges()) return true;
    return confirm('This form has unsaved data. Leaving now will lose it. Continue?');
}

// ── Load a specific instance (A, B, C...) of the currently selected equipment ─
function loadNavInstance(idx) {
    const nav = window.formNav;
    if (!nav.instances.length || idx < 0 || idx >= nav.instances.length) return;
    if (!confirmLeaveIfDirty()) return;
    nav.currentIdx = idx;
    const uid = nav.instances[idx].uid;
    const url = nav.base + '?unique_form_id=' + encodeURIComponent(uid);
    const frame = document.getElementById('formFrame');
    if (frame) {
        frame.src = url + '&embed=1';
    } else {
        window.location.href = url;
    }
    highlightItem(nav.liIndex);
}

function injectFormNav() {
    const nav = window.formNav;
    if (!nav.instances || nav.instances.length <= 1) return;
    const frame = document.getElementById('formFrame');
    if (!frame) return;
    let doc;
    try { doc = frame.contentDocument; } catch (e) { return; }
    if (!doc) return;
    let resetBtn = doc.querySelector('button[type="reset"]');
    if (!resetBtn) {
        resetBtn = Array.from(doc.querySelectorAll('button')).find(function (b) {
            return /reset/i.test(b.textContent);
        });
    }
    if (!resetBtn) return;
    const row = resetBtn.parentElement;
    if (!row || row.querySelector('.eig-form-nav-injected')) return;
    const total   = nav.instances.length;
    const current = nav.currentIdx + 1;
    const btnCls  = 'eig-form-nav-injected px-5 py-2 text-sm font-medium bg-gray-700 text-white rounded-lg hover:bg-gray-800 disabled:bg-gray-300 disabled:cursor-not-allowed';
    const prevBtn = doc.createElement('button');
    prevBtn.type = 'button';
    prevBtn.textContent = '← Prev';
    prevBtn.className = btnCls;
    prevBtn.disabled = nav.currentIdx <= 0;
    prevBtn.addEventListener('click', function () { loadNavInstance(nav.currentIdx - 1); });
    const label = doc.createElement('span');
    label.textContent = 'Form ' + current + ' of ' + total;
    label.className = 'eig-form-nav-injected text-sm font-medium text-gray-600 px-2';
    const nextBtn = doc.createElement('button');
    nextBtn.type = 'button';
    nextBtn.textContent = 'Next →';
    nextBtn.className = btnCls;
    nextBtn.disabled = nav.currentIdx >= total - 1;
    nextBtn.addEventListener('click', function () { loadNavInstance(nav.currentIdx + 1); });
    row.insertBefore(prevBtn, resetBtn);
    row.insertBefore(label, resetBtn);
    row.appendChild(nextBtn);
}

function injectUploadButton() {
    const frame = document.getElementById('formFrame');
    if (!frame) return;
    let doc;
    try { doc = frame.contentDocument; } catch (e) { return; }
    if (!doc) return;
    let resetBtn = doc.querySelector('button[type="reset"]');
    if (!resetBtn) {
        resetBtn = Array.from(doc.querySelectorAll('button')).find(function (b) {
            return /reset/i.test(b.textContent);
        });
    }
    if (!resetBtn) return;
    const row = resetBtn.parentElement;
    if (!row || row.querySelector('.eig-upload-btn-injected')) return;
    let uid = '';
    try { uid = new URLSearchParams(doc.location.search).get('unique_form_id') || ''; } catch (e) {}
    const uploadBtn = doc.createElement('button');
    uploadBtn.type = 'button';
    uploadBtn.textContent = 'Upload';
    uploadBtn.className = 'eig-upload-btn-injected px-5 py-2 text-sm font-medium bg-green-600 text-white rounded-lg hover:bg-green-700';
    uploadBtn.addEventListener('click', function () {
        let url = 'uploads.php?scope=form';
        if (uid) url += '&unique_form_id=' + encodeURIComponent(uid);
        frame.src = url + '&embed=1';
    });
    row.appendChild(uploadBtn);
}

// ── Inject the Unique Form ID just below "FORM NO" at the top-left badge ─────
function injectUniqueFormId() {
    const frame = document.getElementById('formFrame');
    if (!frame) return;
    let doc;
    try { doc = frame.contentDocument; } catch (e) { return; }
    if (!doc) return;
    let uid = '';
    try { uid = new URLSearchParams(doc.location.search).get('unique_form_id') || ''; } catch (e) { return; }
    if (!uid) return;
    const formNoSpan = Array.from(doc.querySelectorAll('span')).find(function (s) {
        return s.textContent.trim() === 'FORM NO';
    });
    if (!formNoSpan) return;

    const formNoRow      = formNoSpan.parentElement;
    const badgeContainer = formNoRow ? formNoRow.parentElement : null;
    if (!formNoRow || !badgeContainer || badgeContainer.querySelector('.eig-unique-id-injected')) return;

    const idRow = doc.createElement('div');
    idRow.className   = 'eig-unique-id-injected';
    idRow.style.cssText = 'font-size:11px; opacity:.85; margin-top:2px;';

    const label = doc.createElement('span');
    label.style.cssText = 'opacity:.75;font-size:11px;letter-spacing:.5px;';
    label.textContent   = 'FORM ID';

    const value = doc.createElement('strong');
    value.style.cssText = 'font-size:12px;';
    value.textContent   = uid;

    idRow.appendChild(label);
    idRow.appendChild(doc.createTextNode(' '));
    idRow.appendChild(value);

    formNoRow.insertAdjacentElement('afterend', idRow);
}

// ── Intercept each form's own submit and route it to save_form.php ───────────
// NOTE: save_form.php was not found in /var/www/trd_eig/public on the server
// as of this edit. Create it (or update this URL to whatever endpoint
// actually persists form data) or saving will 404.
function interceptFormSave() {
    const frame = document.getElementById('formFrame');
    if (!frame) return;

    let doc;
    try { doc = frame.contentDocument; } catch (e) { return; }
    if (!doc) return;

    const form = doc.querySelector('form');
    if (!form || form.dataset.eigSaveWired) return;
    form.dataset.eigSaveWired = '1';

    let uid = '';
    try { uid = new URLSearchParams(doc.location.search).get('unique_form_id') || ''; } catch (e) {}

    form.addEventListener('submit', function (ev) {
        ev.preventDefault();

        if (!uid) {
            alert('Cannot save: no form instance ID found in the URL.');
            return;
        }

        const formData = new FormData(form);
        formData.set('unique_form_id', uid);

        fetch('save_form.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Form saved successfully.');
                    const sel = document.getElementById('project_id');
                    if (sel && sel.value) sel.dispatchEvent(new Event('change'));
                } else {
                    alert('Save failed: ' + (data.message || 'Unknown error.'));
                }
            })
            .catch(() => alert('Connection error. Please try again.'));
    });
}

// ── Pre-fill a form's fields from previously saved data (if any) ─────────────
function hydrateFormFromSaved() {
    const frame = document.getElementById('formFrame');
    if (!frame) return;

    let doc;
    try { doc = frame.contentDocument; } catch (e) { return; }
    if (!doc) return;

    let uid = '';
    try { uid = new URLSearchParams(doc.location.search).get('unique_form_id') || ''; } catch (e) { return; }
    if (!uid) return;

    const form = doc.querySelector('form');
    if (!form || form.dataset.eigHydrated) return;
    form.dataset.eigHydrated = '1';

    fetch('get_form_data.php?unique_form_id=' + encodeURIComponent(uid))
        .then(res => res.json())
        .then(result => {
            if (!result.success || !result.data) return;

            Object.keys(result.data).forEach(function (name) {
                const value = result.data[name];
                if (value === null || value === undefined) return;

                let fields;
                try {
                    fields = form.querySelectorAll('[name="' + CSS.escape(name) + '"]');
                } catch (e) {
                    return;
                }

                fields.forEach(function (field) {
                    if (field.type === 'checkbox' || field.type === 'radio') {
                        field.checked = (field.value === value);
                    } else {
                        field.value = value;
                    }
                });
            });
        })
        .catch(() => {});
}

// ── Render equipment list ─────────────────────────────────────────────────────
function renderEquipment(equipmentList, data) {
    if (data.equipment.length === 0) {
        equipmentList.innerHTML = '<li class="px-3 py-3 text-sm text-gray-400 text-center">No equipment added for this project yet.</li>';
        return;
    }

    const type = data.type_project;
    equipmentList.innerHTML = '';

    data.equipment.forEach(function (e, i) {
        const total  = e.total;
        const filled = e.filled;
        const base   = formUrl(type, e.form_name);

        let badgeColor;
        if (filled === 0)           badgeColor = 'color:#dc2626;background:#fee2e2';
        else if (filled < total)    badgeColor = 'color:#ea580c;background:#ffedd5';
        else                        badgeColor = 'color:#16a34a;background:#dcfce7';

        const li = document.createElement('li');
        li.className   = 'border-b border-gray-100 px-3 py-2';

        const row1 = document.createElement('div');
        row1.className = 'flex items-start gap-2 cursor-pointer group mb-1';

        const num = document.createElement('span');
        num.className   = 'text-xs text-gray-400 w-5 flex-shrink-0 pt-0.5';
        num.textContent = (i + 1) + '.';

        const name = document.createElement('span');
        name.className   = 'flex-1 min-w-0 text-sm text-gray-700 group-hover:text-blue-600 font-medium whitespace-normal break-words';
        name.textContent = e.form_name;
        name.id          = 'eq-name-' + i;

        const badge = document.createElement('span');
        badge.id        = 'eq-badge-' + i;
        badge.className = 'text-xs font-bold px-1.5 py-0.5 rounded-full flex-shrink-0';
        badge.style.cssText = badgeColor;
        badge.textContent   = '(' + filled + '/' + total + ')';

        row1.appendChild(num);
        row1.appendChild(name);
        row1.appendChild(badge);

        row1.addEventListener('click', function () {
            window.formNav = {
                base:       base,
                instances:  e.instances,
                currentIdx: 0,
                liIndex:    i,
            };
            loadNavInstance(0);
        });

        li.appendChild(row1);
        equipmentList.appendChild(li);
    });
}

function highlightItem(idx) {
    document.querySelectorAll('#equipment_list li').forEach(function (el) {
        el.style.background = '';
    });
    const items = document.querySelectorAll('#equipment_list li');
    if (items[idx]) items[idx].style.background = '#eff6ff';
}

// ── Project → Equipment ───────────────────────────────────────────────────────
document.getElementById('project_id').addEventListener('change', function () {
    const projectId     = this.value;
    const equipmentList = document.getElementById('equipment_list');

    equipmentList.innerHTML = '<li class="px-3 py-3 text-sm text-gray-400 text-center">Loading...</li>';

    if (!projectId) {
        equipmentList.innerHTML = '<li class="px-3 py-3 text-sm text-gray-400 text-center">— Select a project first —</li>';
        return;
    }

    fetch('sidebar.php?project_id=' + encodeURIComponent(projectId))
        .then(res => res.json())
        .then(data => renderEquipment(equipmentList, data))
        .catch(error => {
            console.error('Equipment loading error:', error);
            equipmentList.innerHTML = '<li class="px-3 py-3 text-sm text-red-400 text-center">Error loading forms.</li>';
        });
});

// ── Listen for form-filled message from iframe ────────────────────────────────
window.addEventListener('message', function (ev) {
    if (ev.data && ev.data.type === 'formFilled') {
        const sel = document.getElementById('project_id');
        if (sel && sel.value) sel.dispatchEvent(new Event('change'));
    }
});

// ── Reset ─────────────────────────────────────────────────────────────────────
document.getElementById('resetBtn').addEventListener('click', function () {
    document.getElementById('umbrella_id').value = '';
    document.getElementById('project_id').innerHTML  = '<option value="">-- Select Project --</option>';
    document.getElementById('equipment_list').innerHTML = '<li class="px-3 py-3 text-sm text-gray-400 text-center">— Select a project first —</li>';
});
</script>