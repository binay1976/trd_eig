<?php
session_start();

// // ── AJAX: projects by umbrella_id ─────────────────────────────────────────────
// if (isset($_GET['umbrella_id'])) {
//     require_once __DIR__ . '/../config/database.php';
//     header('Content-Type: application/json');
//     $umbrella_id = trim($_GET['umbrella_id']);

//     $stmt = $pdo->prepare("
//         SELECT common_id AS project_id
//         FROM umbrella_projects
//         WHERE type = 'PID'
//           AND LEFT(common_id, CHAR_LENGTH(?)) = ?
//         ORDER BY common_id ASC
//     ");
//     $projectPrefix = $umbrella_id . '||PID\\';
//     $stmt->execute([$projectPrefix, $projectPrefix]);
//     echo json_encode(['projects' => $stmt->fetchAll()]);
//     exit;
// }

// // ── AJAX: equipment by project_id ─────────────────────────────────────────────
// if (isset($_GET['project_id'])) {
//     require_once __DIR__ . '/../config/database.php';
//     header('Content-Type: application/json');
//     $project_id = trim($_GET['project_id']);

//     $identityParts = [
//         $_SESSION['username'] ?? '',
//         $_SESSION['desig'] ?? '',
//         $_SESSION['executing_agency'] ?? '',
//     ];
//     if (!empty($_SESSION['user_id'])) {
//         $userStmt = $pdo->prepare('SELECT user_name, desig, executing_agency FROM users WHERE id = ? LIMIT 1');
//         $userStmt->execute([$_SESSION['user_id']]);
//         $userRow = $userStmt->fetch();
//         if ($userRow) {
//             $identityParts = [$userRow['user_name'], $userRow['desig'], $userRow['executing_agency']];
//         }
//     }
//     $identity = implode('/', array_map('trim', $identityParts));
//     $legacyIdentity = str_replace('/', '\\', $identity);

//     // type_project is now a real column
//     $stmt = $pdo->prepare("SELECT type_project FROM umbrella_projects WHERE type = 'PID' AND common_id = ? LIMIT 1");
//     $stmt->execute([$project_id]);
//     $projectRow = $stmt->fetch();
//     $project = ['type_project' => $projectRow['type_project'] ?? ''];

//     // Get saved forms grouped by form_no with filled counts
//     $stmt = $pdo->prepare("
//         SELECT form_name, form_no, unique_form_id, sequence_label, is_filled
//         FROM project_forms
//         WHERE project_id = ?
//                     AND assigned_to IN (?, ?)
//         ORDER BY form_no ASC, sequence_label ASC
//     ");
//         $stmt->execute([$project_id, $identity, $legacyIdentity]);
//     $rows = $stmt->fetchAll();

//     // Group rows by form_no
//     $grouped = [];
//     foreach ($rows as $row) {
//         $key = $row['form_no'];
//         if (!isset($grouped[$key])) {
//             $grouped[$key] = [
//                 'form_name' => $row['form_name'],
//                 'form_no'   => $row['form_no'],
//                 'total'     => 0,
//                 'filled'    => 0,
//                 'instances' => [],
//             ];
//         }
//         $grouped[$key]['total']++;
//         if ((int)$row['is_filled'] === 1) $grouped[$key]['filled']++;
//         $grouped[$key]['instances'][] = [
//             'uid'       => $row['unique_form_id'],
//             'label'     => $row['sequence_label'],
//             'is_filled' => (int)$row['is_filled'],
//         ];
//     }
//     echo json_encode([
//         'type_project' => $project ? $project['type_project'] : '',
//         'equipment'    => array_values($grouped),
//     ]);
//     exit;
// }

// ── AJAX: PIDs by umbrella_id ────────────────────────────────────────────────
if (isset($_GET['umbrella_id'])) {
    require_once __DIR__ . '/../config/database.php';
    header('Content-Type: application/json');
    $umbrella_id = trim($_GET['umbrella_id']);
    // ---------------------------------------------------------
    // Build current user's identity
    // Same identity format used in project_forms.assigned_to
    // ---------------------------------------------------------
    $identityParts = [
        $_SESSION['username'] ?? '',
        $_SESSION['desig'] ?? '',
        $_SESSION['executing_agency'] ?? '',
    ];

    if (!empty($_SESSION['user_id'])) {
        $userStmt = $pdo->prepare("
            SELECT user_name, desig, executing_agency
            FROM users
            WHERE id = ?
            LIMIT 1
        ");
        $userStmt->execute([$_SESSION['user_id']]);
        $userRow = $userStmt->fetch(PDO::FETCH_ASSOC);
        if ($userRow) {
            $identityParts = [
                $userRow['user_name'],
                $userRow['desig'],
                $userRow['executing_agency']
            ];
        }
    }

    $identity = implode(
        '/',
        array_map('trim', $identityParts)
    );
    $legacyIdentity = str_replace('/', '\\', $identity);


    // ---------------------------------------------------------
    // Get PIDs ONLY from project_forms
    //
    // Conditions:
    // 1. Selected umbrella_id
    // 2. assigned_to matches current session
    // 3. Return unique project_id
    // ---------------------------------------------------------

    $stmt = $pdo->prepare("
        SELECT DISTINCT
            project_id
        FROM project_forms
        WHERE umbrella_id = ?
          AND assigned_to IN (?, ?)
          AND project_id <> ''
        ORDER BY project_id ASC
    ");

    $stmt->execute([
        $umbrella_id,
        $identity,
        $legacyIdentity
    ]);

    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo json_encode([
        'projects' => $projects
    ]);

    exit;
}


// ── AJAX: forms by project_id ─────────────────────────────────────────────────
if (isset($_GET['project_id'])) {

    require_once __DIR__ . '/../config/database.php';

    header('Content-Type: application/json');

    $project_id = trim($_GET['project_id']);


    // ---------------------------------------------------------
    // Build current user's identity
    // ---------------------------------------------------------
    $identityParts = [
        $_SESSION['username'] ?? '',
        $_SESSION['desig'] ?? '',
        $_SESSION['executing_agency'] ?? '',
    ];

    if (!empty($_SESSION['user_id'])) {

        $userStmt = $pdo->prepare("
            SELECT user_name, desig, executing_agency
            FROM users
            WHERE id = ?
            LIMIT 1
        ");

        $userStmt->execute([
            $_SESSION['user_id']
        ]);

        $userRow = $userStmt->fetch(PDO::FETCH_ASSOC);

        if ($userRow) {

            $identityParts = [
                $userRow['user_name'],
                $userRow['desig'],
                $userRow['executing_agency']
            ];
        }
    }


    $identity = implode(
        '/',
        array_map('trim', $identityParts)
    );

    $legacyIdentity = str_replace('/', '\\', $identity);


    // ---------------------------------------------------------
    // Get forms ONLY from project_forms
    // ---------------------------------------------------------
    $stmt = $pdo->prepare("
        SELECT
            form_name,
            form_no,
            unique_form_id,
            sequence_label,
            is_filled,
            umbrella_id
        FROM project_forms
        WHERE project_id = ?
          AND assigned_to IN (?, ?)
        ORDER BY
            form_no ASC,
            sequence_label ASC
    ");

    $stmt->execute([
        $project_id,
        $identity,
        $legacyIdentity
    ]);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // ---------------------------------------------------------
    // Group forms by form_no
    // ---------------------------------------------------------
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


    // ---------------------------------------------------------
    // Return JSON
    // ---------------------------------------------------------
    echo json_encode([
        'equipment' => array_values($grouped)
    ]);

    exit;
}

// ── Normal page load: fetch umbrellas only ────────────────────────────────────
require_once __DIR__ . '/../config/database.php';
$umbrellas = [];
try {
    $stmt = $pdo->query("SELECT common_id AS umbrella_id FROM umbrella_projects WHERE type = 'UPID' ORDER BY common_id ASC");
    $umbrellas = $stmt->fetchAll();
} catch (Exception $e) {
    $umbrellas = [];
}
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
        <select id="umbrella_id"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Select Umbrella --</option>
            <?php foreach ($umbrellas as $row): ?>
                <option value="<?= htmlspecialchars($row['umbrella_id']) ?>">
                    <?= htmlspecialchars($row['umbrella_id']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Project ID Dropdown -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Project ID <span class="text-red-500">*</span>
        </label>
        <select id="project_id"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Select Project --</option>
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
// ── Umbrella → Project ────────────────────────────────────────────────────────
document.getElementById('umbrella_id').addEventListener('change', function () {
    const umbrellaId      = this.value;
    const projectDropdown = document.getElementById('project_id');
    const equipmentList   = document.getElementById('equipment_list');

    projectDropdown.innerHTML = '<option value="">-- Select Project --</option>';
    equipmentList.innerHTML   = '<li class="px-3 py-3 text-sm text-gray-400 text-center">— Select a project first —</li>';

    if (!umbrellaId) return;

    fetch('/trd_eig/public/sidebar.php?umbrella_id=' + encodeURIComponent(umbrellaId))
        .then(res => res.json())
        .then(data => {
            data.projects.forEach(function (p) {
                const option       = document.createElement('option');
                option.value       = p.project_id;
                option.textContent = p.project_id;
                projectDropdown.appendChild(option);
            });
        });
});

// ── Build form page URL: filename is exactly form_name + .php ────────────────
function formUrl(type, formName) {
    return '/trd_eig/public/forms/' + formName + '.php';
}

// ── Current form-instance navigation state — one equipment item's A/B/C... ───
window.formNav = { base: '', instances: [], currentIdx: 0, liIndex: -1 };

// ── Warn before leaving a form that has entered-but-unsaved values ───────────
// (Nothing persists typed field values anywhere yet — this is a safety net,
// not a fix. See project notes on adding real autosave/backend storage.)
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

// ── Inject Prev / "Form N of Total" / Next next to the form's own Reset
//    button. Runs after every iframe load (form.php calls this). Only shown
//    when the equipment has more than one instance to fill. ─────────────────
function injectFormNav() {
    const nav = window.formNav;
    if (!nav.instances || nav.instances.length <= 1) return;

    const frame = document.getElementById('formFrame');
    if (!frame) return;

    let doc;
    try { doc = frame.contentDocument; } catch (e) { return; }
    if (!doc) return;

    // Forms use inconsistent markup — find the Reset button by type first,
    // then fall back to matching its visible text.
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

// ── Inject an Upload button next to Reset — shown on every form, unlike
//    Prev/Next which only appear for multi-instance equipment. ──────────────
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
        let url = '/trd_eig/public/uploads.php?scope=form';
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

    // Every form's badge has a <span> whose text is exactly "FORM NO"
    const formNoSpan = Array.from(doc.querySelectorAll('span')).find(function (s) {
        return s.textContent.trim() === 'FORM NO';
    });
    if (!formNoSpan) return;

    const formNoRow      = formNoSpan.parentElement;      // <div>FORM NO  <strong>TSS-14</strong></div>
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
    idRow.appendChild(doc.createTextNode(' '));
    idRow.appendChild(value);

    formNoRow.insertAdjacentElement('afterend', idRow);
}

// ── Intercept each form's own submit (which points at a nonexistent
//    save_xxx.php) and route it to the shared save_form.php endpoint instead.
//    Runs after every iframe load, same technique as the other injections. ───
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

        fetch('/trd_eig/public/save_form.php', { method: 'POST', body: formData })
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

// ── Pre-fill a form's fields from previously saved data (if any), so
//    revisiting a filled form shows what was entered instead of a blank
//    page. Runs after every iframe load, same technique as the others. ───────
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

    fetch('/trd_eig/public/get_form_data.php?unique_form_id=' + encodeURIComponent(uid))
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

        // Badge colour
        let badgeColor;
        if (filled === 0)           badgeColor = 'color:#dc2626;background:#fee2e2';   // red
        else if (filled < total)    badgeColor = 'color:#ea580c;background:#ffedd5';   // orange
        else                        badgeColor = 'color:#16a34a;background:#dcfce7';   // green

        const li = document.createElement('li');
        li.className   = 'border-b border-gray-100 px-3 py-2';

        // ── Row 1: name + badge ───────────────────────────────────────────────
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
            // loadNavInstance() itself checks for unsaved changes before navigating
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

    fetch('/trd_eig/public/sidebar.php?project_id=' + encodeURIComponent(projectId))
        .then(res => res.json())
        .then(data => renderEquipment(equipmentList, data));
});

// ── Listen for form-filled message from iframe ────────────────────────────────
window.addEventListener('message', function (ev) {
    if (ev.data && ev.data.type === 'formFilled') {
        // Re-trigger project change to refresh badges
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
