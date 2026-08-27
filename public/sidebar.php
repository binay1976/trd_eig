<?php
// ── AJAX: projects by umbrella_id ─────────────────────────────────────────────
if (isset($_GET['umbrella_id'])) {
    require_once __DIR__ . '/../config/database.php';
    header('Content-Type: application/json');
    $umbrella_id = trim($_GET['umbrella_id']);
    $stmt = $pdo->prepare("SELECT project_id FROM projects WHERE umbrella_id = ? ORDER BY project_id ASC");
    $stmt->execute([$umbrella_id]);
    echo json_encode(['projects' => $stmt->fetchAll()]);
    exit;
}

// ── AJAX: equipment by project_id ─────────────────────────────────────────────
if (isset($_GET['project_id'])) {
    require_once __DIR__ . '/../config/database.php';
    header('Content-Type: application/json');
    $project_id = trim($_GET['project_id']);

    // Get type_project (needed by JS to build form file URL)
    $stmt = $pdo->prepare("SELECT type_project FROM projects WHERE project_id = ? LIMIT 1");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch();

    // Get saved forms grouped by form_no with filled counts
    $stmt = $pdo->prepare("
        SELECT form_name, form_no, unique_form_id, sequence_label, is_filled
        FROM project_forms
        WHERE project_id = ?
        ORDER BY form_no ASC, sequence_label ASC
    ");
    $stmt->execute([$project_id]);
    $rows = $stmt->fetchAll();

    // Group rows by form_no
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
        if ((int)$row['is_filled'] === 1) $grouped[$key]['filled']++;
        $grouped[$key]['instances'][] = [
            'uid'       => $row['unique_form_id'],
            'label'     => $row['sequence_label'],
            'is_filled' => (int)$row['is_filled'],
        ];
    }

    echo json_encode([
        'type_project' => $project ? $project['type_project'] : '',
        'equipment'    => array_values($grouped),
    ]);
    exit;
}

// ── Normal page load: fetch umbrellas only ────────────────────────────────────
require_once __DIR__ . '/../config/database.php';
$umbrellas = [];
try {
    $stmt = $pdo->query("SELECT common_id AS umbrella_id FROM umbrella_projects ORDER BY common_id ASC");
    $umbrellas = $stmt->fetchAll();
} catch (Exception $e) {
    $umbrellas = [];
}
?>

<div class="max-w-sm">

    <!-- Heading -->
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-800">Project Filter</h2>
        <p class="text-xs text-gray-400 mt-0.5">Select umbrella and project to load equipment.</p>
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
            Equipment &amp; Forms
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

// ── Build form page URL from type + form_name ────────────────────────────────
function formUrl(type, formName) {
    var s = formName.toLowerCase().replace(/[^a-z0-9 ]/g, '').trim().replace(/ +/g, '_');
    return '/trd_eig/public/forms/' + type.toLowerCase() + '_' + s + '.php';
}

// ── Load a specific instance into the iframe ──────────────────────────────────
function loadInstance(type, e, idx) {
    const base     = formUrl(type, e.form_name);
    const instance = e.instances[idx];
    const prevInst = idx > 0                      ? e.instances[idx - 1] : null;
    const nextInst = idx < e.instances.length - 1 ? e.instances[idx + 1] : null;

    let url = base + '?unique_form_id=' + encodeURIComponent(instance.uid);
    if (prevInst) url += '&prev_url=' + encodeURIComponent(base + '?unique_form_id=' + prevInst.uid);
    if (nextInst) url += '&next_url=' + encodeURIComponent(base + '?unique_form_id=' + nextInst.uid);

    const frame = document.getElementById('formFrame');
    if (frame) {
        frame.src = url + '&embed=1';
    } else {
        window.location.href = url;
    }
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

        // Badge colour
        let badgeColor;
        if (filled === 0)           badgeColor = 'color:#dc2626;background:#fee2e2';   // red
        else if (filled < total)    badgeColor = 'color:#ea580c;background:#ffedd5';   // orange
        else                        badgeColor = 'color:#16a34a;background:#dcfce7';   // green

        const li = document.createElement('li');
        li.className   = 'border-b border-gray-100 px-3 py-2';
        li._currentIdx = 0;

        // ── Row 1: name + badge ───────────────────────────────────────────────
        const row1 = document.createElement('div');
        row1.className = 'flex items-center gap-2 cursor-pointer group mb-1';

        const num = document.createElement('span');
        num.className   = 'text-xs text-gray-400 w-5 flex-shrink-0';
        num.textContent = (i + 1) + '.';

        const name = document.createElement('span');
        name.className   = 'flex-1 text-sm text-gray-700 group-hover:text-blue-600 font-medium';
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
            loadInstance(type, e, li._currentIdx);
            highlightItem(i);
        });

        li.appendChild(row1);

        // ── Row 2: Prev / instance label / Next (only if quantity > 1) ───────
        if (total > 1) {
            const row2 = document.createElement('div');
            row2.className = 'flex items-center gap-1 mt-1 ml-5';

            const prevBtn = document.createElement('button');
            prevBtn.type      = 'button';
            prevBtn.className = 'text-xs px-2 py-0.5 bg-gray-100 text-gray-600 rounded hover:bg-gray-200';
            prevBtn.textContent = '← Prev';

            const instLabel = document.createElement('span');
            instLabel.id        = 'eq-inst-' + i;
            instLabel.className = 'flex-1 text-center text-xs text-gray-500';
            instLabel.textContent = e.instances[0].label;

            const nextBtn = document.createElement('button');
            nextBtn.type      = 'button';
            nextBtn.className = 'text-xs px-2 py-0.5 bg-gray-100 text-gray-600 rounded hover:bg-gray-200';
            nextBtn.textContent = 'Next →';

            prevBtn.addEventListener('click', function () {
                if (li._currentIdx > 0) {
                    li._currentIdx--;
                    instLabel.textContent = e.instances[li._currentIdx].label;
                    loadInstance(type, e, li._currentIdx);
                    highlightItem(i);
                }
            });

            nextBtn.addEventListener('click', function () {
                if (li._currentIdx < total - 1) {
                    li._currentIdx++;
                    instLabel.textContent = e.instances[li._currentIdx].label;
                    loadInstance(type, e, li._currentIdx);
                    highlightItem(i);
                }
            });

            row2.appendChild(prevBtn);
            row2.appendChild(instLabel);
            row2.appendChild(nextBtn);
            li.appendChild(row2);
        }

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
