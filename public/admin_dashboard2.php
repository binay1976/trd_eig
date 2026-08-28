<?php
// Progress dashboard — two dependent dropdowns (Umbrella -> Project). Picking
// an umbrella shows its overall completion %, forms filled/total, and total
// files uploaded across everything under it. Additionally picking a project
// shows that project's own progress/uploads plus a per-form breakdown (each
// form's filled/total instance count and its own uploaded-file count).
//
// Connects to:
//   - config/tree_data.php  — eig_build_umbrella_tree() is the sole data
//                             source; every number on this page is computed
//                             client-side from that one nested JSON response,
//                             so it can never disagree with tree_view.php or
//                             the PDF reports, which use the same function.
//   - js/app.js             — loadPage('dashboard2') routes here
//   - admin_home.php        — the button that calls loadPage('dashboard2')
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/tree_data.php';

// ── AJAX: global totals + every project (for "All Umbrellas") ────────────
// Cheap direct aggregate queries rather than looping eig_build_umbrella_tree()
// over every umbrella — this only needs totals plus a flat project list for
// the dropdown, not the full nested structure.
if (isset($_GET['all_umbrellas'])) {
    header('Content-Type: application/json');

    $umbrellasCount = (int) $pdo->query("SELECT COUNT(*) FROM umbrella_projects WHERE type = 'UPID'")->fetchColumn();

    $projRows = $pdo->query("
        SELECT common_id, project_data
        FROM umbrella_projects
        WHERE type = 'PID'
        ORDER BY common_id ASC
    ")->fetchAll();

    $projects = [];
    foreach ($projRows as $row) {
        $pData = json_decode($row['project_data'] ?? '{}', true) ?: [];
        // A project's common_id is always "{parent umbrella's common_id}||PID\..."
        $umbrellaId = strstr($row['common_id'], '||PID\\', true);
        $projects[] = [
            'id'           => $row['common_id'],
            'umbrella_id'  => $umbrellaId !== false ? $umbrellaId : '',
            'type_project' => $pData['type_project'] ?? '',
            'location'     => $pData['location'] ?? '',
        ];
    }

    $formsRow     = $pdo->query("SELECT COUNT(*) AS total, COALESCE(SUM(is_filled), 0) AS filled FROM project_forms")->fetch();
    $uploadsTotal = (int) $pdo->query("SELECT COUNT(*) FROM project_uploads")->fetchColumn();

    echo json_encode([
        'success' => true,
        'stats' => [
            'umbrellasCount' => $umbrellasCount,
            'projectsCount'  => count($projects),
            'formsTotal'     => (int) $formsRow['total'],
            'formsFilled'    => (int) $formsRow['filled'],
            'uploadsTotal'   => $uploadsTotal,
        ],
        'projects' => $projects,
    ]);
    exit;
}

// ── AJAX: full nested tree for one umbrella ───────────────────────────────
// Same self-contained-AJAX pattern as sidebar.php / tree_view.php.
if (isset($_GET['umbrella_id'])) {
    header('Content-Type: application/json');
    $umbrellaId = trim($_GET['umbrella_id']);

    if ($umbrellaId === '') {
        echo json_encode(['success' => false, 'message' => 'Umbrella ID is required.']);
        exit;
    }

    $tree = eig_build_umbrella_tree($pdo, $umbrellaId);

    if ($tree === null) {
        echo json_encode(['success' => false, 'message' => 'Umbrella not found.']);
        exit;
    }

    echo json_encode(array_merge(['success' => true], $tree));
    exit;
}

// ── Page render ────────────────────────────────────────────────────────────
// This file is normally loaded as a bare SPA fragment (js/app.js's
// loadPage() fetches it and drops the HTML straight into #pageContent
// inside admin_home.php's shell, which already has Tailwind + navbar
// loaded). But opened directly by URL there is no shell — so without this
// check the page would render completely unstyled (no Tailwind at all).
// loadPage() marks its fetch with X-Requested-With; its absence means this
// is a direct visit, and the fragment below gets wrapped in a full page.
$isFragment = (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') !== '');

if (!$isFragment) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Progress Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <?php include __DIR__ . '/navbar.php'; ?>
        <main class="max-w-7xl mx-auto px-6 py-6">
            <div class="bg-white rounded-xl shadow-md p-6 min-h-[600px]">
    <?php
}

// ── Umbrella dropdown list ─────────────────────────────────────────────────
$umbrellas = [];
try {
    $stmt = $pdo->query("
        SELECT
            common_id AS umbrella_id,
            JSON_UNQUOTE(JSON_EXTRACT(project_data, '$.umbrella_project_name')) AS name
        FROM umbrella_projects
        WHERE type = 'UPID' AND common_id IS NOT NULL AND common_id <> ''
        ORDER BY common_id ASC
    ");
    $umbrellas = $stmt->fetchAll();
} catch (Exception $e) {
    $umbrellas = [];
}
?>

<style>
.eig-progress-track { background: #E5E7EB; border-radius: 999px; overflow: hidden; }
.eig-progress-fill   { background: linear-gradient(90deg, #22C55E, #16A34A); height: 100%; border-radius: 999px; transition: width 0.4s ease; }
.eig-stat-tile        { background: #fff; border: 1px solid #E5E7EB; border-radius: 12px; padding: 14px 16px; }
.eig-form-card         { background: #fff; border: 1px solid #E5E7EB; border-radius: 10px; padding: 12px 14px; }
.eig-form-card:hover  { border-color: #93C5FD; box-shadow: 0 1px 6px rgba(0,0,0,0.06); }
.eig-inst-chip          { display: inline-flex; align-items: center; justify-content: center; width: 22px; height: 22px; border-radius: 6px; font-size: 11px; font-weight: 700; }
.eig-inst-chip.filled { background: #DCFCE7; color: #15803D; }
.eig-inst-chip.empty  { background: #F3F4F6; color: #9CA3AF; }
</style>

<div class="mb-6">
    <h2 class="text-xl font-bold text-gray-800">Progress Dashboard</h2>
    <p class="text-sm text-gray-400 mt-0.5">Select an umbrella, then optionally a project, to see completion progress and upload counts.</p>
</div>

<!-- Dependent dropdowns -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Umbrella Project</label>
        <select id="d2UmbrellaSelect"
            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Select Umbrella --</option>
            <option value="__all__">🌐 All Umbrellas</option>
            <?php foreach ($umbrellas as $row): ?>
                <option value="<?= htmlspecialchars($row['umbrella_id']) ?>">
                    <?= htmlspecialchars($row['umbrella_id']) ?><?= $row['name'] ? ' — ' . htmlspecialchars($row['name']) : '' ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Project</label>
        <select id="d2ProjectSelect" disabled
            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm bg-gray-50 text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Select an umbrella first --</option>
        </select>
    </div>
</div>

<div id="d2Placeholder" class="flex flex-col items-center justify-center h-64 text-center text-gray-400">
    <div class="text-5xl mb-3">📊</div>
    <p class="text-sm">Select an umbrella above to see its progress.</p>
</div>

<div id="d2Content" class="hidden space-y-6"></div>

<script>
let d2Tree = null;

// ── Small render helpers ──────────────────────────────────────────────────
function d2Bar(percent, height) {
    height = height || 'h-3';
    return '<div class="eig-progress-track w-full ' + height + '">' +
               '<div class="eig-progress-fill" style="width:' + percent + '%"></div>' +
           '</div>';
}

function d2Esc(str) {
    const d = document.createElement('div');
    d.textContent = str == null ? '' : String(str);
    return d.innerHTML;
}

// ── Stats computed straight from the tree JSON — nothing else to fetch ───
function d2FormStats(form) {
    const total  = form.instances.length;
    const filled = form.instances.filter(function (i) { return i.is_filled === 1; }).length;
    const uploads = form.instances.reduce(function (sum, i) { return sum + (i.uploads ? i.uploads.length : 0); }, 0);
    return { total: total, filled: filled, uploads: uploads, percent: total ? Math.round(filled / total * 100) : 0 };
}

function d2ProjectStats(project) {
    let total = 0, filled = 0, formUploads = 0, completeForms = 0;
    project.forms.forEach(function (f) {
        const s = d2FormStats(f);
        total += s.total;
        filled += s.filled;
        formUploads += s.uploads;
        if (s.total > 0 && s.filled === s.total) completeForms++;
    });
    const ownUploads = project.uploads ? project.uploads.length : 0;
    return {
        total: total, filled: filled, percent: total ? Math.round(filled / total * 100) : 0,
        ownUploads: ownUploads, formUploads: formUploads, totalUploads: ownUploads + formUploads,
        formsTotal: project.forms.length, formsComplete: completeForms,
    };
}

function d2UmbrellaStats(tree) {
    let total = 0, filled = 0, projUploads = 0, formUploads = 0;
    tree.projects.forEach(function (p) {
        projUploads += (p.uploads ? p.uploads.length : 0);
        const ps = d2ProjectStats(p);
        total += ps.total;
        filled += ps.filled;
        formUploads += ps.formUploads;
    });
    const ownUploads = tree.umbrella.uploads ? tree.umbrella.uploads.length : 0;
    return {
        total: total, filled: filled, percent: total ? Math.round(filled / total * 100) : 0,
        totalUploads: ownUploads + projUploads + formUploads,
        projectsCount: tree.projects.length,
    };
}

// ── Umbrella-level summary card ───────────────────────────────────────────
function d2RenderUmbrella(tree) {
    const u = tree.umbrella;
    const s = d2UmbrellaStats(tree);

    return `
    <div class="rounded-xl overflow-hidden border border-gray-200">
        <div class="bg-gradient-to-r from-blue-900 to-slate-800 text-white px-6 py-5">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-blue-200 font-semibold mb-1">Umbrella Project</div>
                    <div class="text-lg font-bold">${d2Esc(u.name || u.id)}</div>
                    <div class="text-xs font-mono text-blue-200 mt-1">${d2Esc(u.id)}</div>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-extrabold text-green-400">${s.percent}%</div>
                    <div class="text-xs text-blue-200">Overall Complete</div>
                </div>
            </div>
            <div class="mt-4">${d2Bar(s.percent, 'h-2.5')}</div>
        </div>
        <div class="bg-white px-6 py-4 grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">Zone / Division</div>
                <div class="text-sm font-semibold text-gray-800">${d2Esc(u.zone)} / ${d2Esc(u.division)}</div>
            </div>
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">Projects</div>
                <div class="text-lg font-bold text-gray-800">${s.projectsCount}</div>
            </div>
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">Forms Filled / Total</div>
                <div class="text-lg font-bold text-gray-800">${s.filled} <span class="text-gray-400 font-normal">/ ${s.total}</span></div>
            </div>
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">📎 Files Uploaded</div>
                <div class="text-lg font-bold text-gray-800">${s.totalUploads}</div>
            </div>
        </div>
    </div>`;
}

// ── Global summary card ("All Umbrellas") ─────────────────────────────────
function d2RenderGlobal(stats) {
    const percent = stats.formsTotal ? Math.round(stats.formsFilled / stats.formsTotal * 100) : 0;

    return `
    <div class="rounded-xl overflow-hidden border border-gray-200">
        <div class="bg-gradient-to-r from-slate-900 to-blue-950 text-white px-6 py-5">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-blue-200 font-semibold mb-1">All Umbrella Projects</div>
                    <div class="text-lg font-bold">🌐 Global Overview</div>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-extrabold text-green-400">${percent}%</div>
                    <div class="text-xs text-blue-200">Overall Complete</div>
                </div>
            </div>
            <div class="mt-4">${d2Bar(percent, 'h-2.5')}</div>
        </div>
        <div class="bg-white px-6 py-4 grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">Umbrellas</div>
                <div class="text-lg font-bold text-gray-800">${stats.umbrellasCount}</div>
            </div>
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">Projects</div>
                <div class="text-lg font-bold text-gray-800">${stats.projectsCount}</div>
            </div>
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">Forms Filled / Total</div>
                <div class="text-lg font-bold text-gray-800">${stats.formsFilled} <span class="text-gray-400 font-normal">/ ${stats.formsTotal}</span></div>
            </div>
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">📎 Files Uploaded</div>
                <div class="text-lg font-bold text-gray-800">${stats.uploadsTotal}</div>
            </div>
        </div>
    </div>`;
}

// ── One form's card (used inside the project detail section) ─────────────
function d2RenderFormCard(form) {
    const s = d2FormStats(form);

    const chips = form.instances.map(function (inst) {
        const cls = inst.is_filled === 1 ? 'filled' : 'empty';
        const mark = inst.is_filled === 1 ? '✓' : inst.label;
        return '<span class="eig-inst-chip ' + cls + '" title="Instance ' + d2Esc(inst.label) + (inst.is_filled === 1 ? ' — filled' : ' — not filled') + '">' + mark + '</span>';
    }).join(' ');

    const barColor = s.percent === 100 ? 'text-green-600' : (s.percent === 0 ? 'text-gray-400' : 'text-amber-600');

    return `
    <div class="eig-form-card">
        <div class="flex items-start justify-between gap-3 mb-2">
            <div class="min-w-0">
                <div class="text-xs font-mono text-blue-700 font-semibold">${d2Esc(form.form_no)}</div>
                <div class="text-sm font-medium text-gray-800 break-words">${d2Esc(form.form_name)}</div>
            </div>
            <div class="flex-shrink-0 text-right">
                <div class="text-sm font-bold ${barColor}">${s.filled}/${s.total}</div>
                <div class="text-[11px] text-gray-400">filled</div>
            </div>
        </div>
        ${d2Bar(s.percent, 'h-1.5')}
        <div class="flex items-center justify-between mt-2.5">
            <div class="flex gap-1 flex-wrap">${chips}</div>
            <div class="text-xs text-gray-500 flex-shrink-0 ml-2">📎 ${s.uploads} file${s.uploads === 1 ? '' : 's'}</div>
        </div>
    </div>`;
}

// ── Project-level detail section ──────────────────────────────────────────
function d2RenderProject(project) {
    const s = d2ProjectStats(project);

    const formsHtml = project.forms.length === 0
        ? '<div class="text-sm text-gray-400 text-center py-8 col-span-full">No equipment/forms added to this project yet.</div>'
        : project.forms.map(d2RenderFormCard).join('');

    return `
    <div class="rounded-xl overflow-hidden border border-gray-200">
        <div class="bg-gradient-to-r from-purple-900 to-indigo-800 text-white px-6 py-5">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-purple-200 font-semibold mb-1">Project</div>
                    <div class="text-sm font-mono font-bold break-all">${d2Esc(project.id)}</div>
                    <div class="text-xs text-purple-200 mt-1">${d2Esc(project.type_project)}${project.location ? ' · ' + d2Esc(project.location) : ''}</div>
                </div>
                <div class="text-right flex-shrink-0">
                    <div class="text-3xl font-extrabold text-green-400">${s.percent}%</div>
                    <div class="text-xs text-purple-200">Project Complete</div>
                </div>
            </div>
            <div class="mt-4">${d2Bar(s.percent, 'h-2.5')}</div>
        </div>
        <div class="bg-white px-6 py-4 grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">Forms Completed</div>
                <div class="text-lg font-bold text-gray-800">${s.formsComplete} <span class="text-gray-400 font-normal">/ ${s.formsTotal}</span></div>
            </div>
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">Instances Filled</div>
                <div class="text-lg font-bold text-gray-800">${s.filled} <span class="text-gray-400 font-normal">/ ${s.total}</span></div>
            </div>
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">📎 Project's Own Files</div>
                <div class="text-lg font-bold text-gray-800">${s.ownUploads}</div>
            </div>
            <div class="eig-stat-tile">
                <div class="text-xs text-gray-400 mb-1">📎 Total Files (incl. forms)</div>
                <div class="text-lg font-bold text-gray-800">${s.totalUploads}</div>
            </div>
        </div>
        <div class="bg-gray-50 px-6 py-5">
            <h4 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">Equipment &amp; Forms Breakdown</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">${formsHtml}</div>
        </div>
    </div>`;
}

// ── Dropdown wiring ────────────────────────────────────────────────────────
const d2UmbrellaSelect = document.getElementById('d2UmbrellaSelect');
const d2ProjectSelect  = document.getElementById('d2ProjectSelect');
const d2Placeholder    = document.getElementById('d2Placeholder');
const d2Content        = document.getElementById('d2Content');

let d2Mode = null; // 'single' | 'all' — which branch the Project dropdown is currently sourced from
let d2GlobalStats = null;
let d2GlobalProjects = [];
const d2TreeCache = {}; // umbrella_id -> tree JSON, reused when drilling into a project from "All Umbrellas"

d2UmbrellaSelect.addEventListener('change', function () {
    const umbrellaId = this.value;

    d2ProjectSelect.innerHTML = '<option value="">-- Select an umbrella first --</option>';
    d2ProjectSelect.disabled = true;
    d2ProjectSelect.classList.add('bg-gray-50', 'text-gray-400');

    if (!umbrellaId) {
        d2Tree = null;
        d2Mode = null;
        d2Content.classList.add('hidden');
        d2Content.innerHTML = '';
        d2Placeholder.classList.remove('hidden');
        return;
    }

    d2Placeholder.classList.add('hidden');
    d2Content.classList.remove('hidden');
    d2Content.innerHTML = '<div class="flex items-center justify-center h-40 text-gray-400 text-sm">Loading…</div>';

    // ── "All Umbrellas" — global totals + a flat, umbrella-tagged project list
    if (umbrellaId === '__all__') {
        d2Mode = 'all';
        d2Tree = null;

        fetch('admin_dashboard2.php?all_umbrellas=1')
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (!data.success) {
                    d2Content.innerHTML = '<div class="text-center text-red-500 text-sm py-10">' + d2Esc(data.message || 'Could not load overview.') + '</div>';
                    return;
                }

                d2GlobalStats = data.stats;
                d2GlobalProjects = data.projects;
                d2Content.innerHTML = d2RenderGlobal(d2GlobalStats);

                d2ProjectSelect.innerHTML = '<option value="">🗂 All Projects</option>';
                d2GlobalProjects.forEach(function (p) {
                    const opt = document.createElement('option');
                    opt.value = p.id;
                    opt.textContent = p.umbrella_id + ' → ' + p.id + (p.location ? ' — ' + p.location : '') + ' (' + p.type_project + ')';
                    d2ProjectSelect.appendChild(opt);
                });
                d2ProjectSelect.disabled = false;
                d2ProjectSelect.classList.remove('bg-gray-50', 'text-gray-400');
            })
            .catch(function () {
                d2Content.innerHTML = '<div class="text-center text-red-500 text-sm py-10">Connection error. Please try again.</div>';
            });
        return;
    }

    // ── One specific umbrella ──────────────────────────────────────────────
    d2Mode = 'single';

    fetch('admin_dashboard2.php?umbrella_id=' + encodeURIComponent(umbrellaId))
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (!data.success) {
                d2Content.innerHTML = '<div class="text-center text-red-500 text-sm py-10">' + d2Esc(data.message || 'Could not load umbrella.') + '</div>';
                return;
            }

            d2Tree = data;
            d2TreeCache[umbrellaId] = data;
            d2Content.innerHTML = d2RenderUmbrella(d2Tree);

            d2ProjectSelect.innerHTML = '<option value="">🗂 All Projects</option>';
            d2Tree.projects.forEach(function (p) {
                const opt = document.createElement('option');
                opt.value = p.id;
                opt.textContent = p.id + (p.location ? ' — ' + p.location : '') + ' (' + p.type_project + ')';
                d2ProjectSelect.appendChild(opt);
            });
            d2ProjectSelect.disabled = false;
            d2ProjectSelect.classList.remove('bg-gray-50', 'text-gray-400');
        })
        .catch(function () {
            d2Content.innerHTML = '<div class="text-center text-red-500 text-sm py-10">Connection error. Please try again.</div>';
        });
});

d2ProjectSelect.addEventListener('change', function () {
    const projectId = this.value;

    // ── Drilling into one project while "All Umbrellas" is selected ──────
    if (d2Mode === 'all') {
        if (!projectId) {
            d2Content.innerHTML = d2RenderGlobal(d2GlobalStats);
            return;
        }

        const projMeta = d2GlobalProjects.find(function (p) { return p.id === projectId; });
        if (!projMeta) return;

        const renderFromTree = function (tree) {
            const project = tree.projects.find(function (p) { return p.id === projectId; });
            d2Content.innerHTML = d2RenderUmbrella(tree) + (project ? d2RenderProject(project) : '');
        };

        if (d2TreeCache[projMeta.umbrella_id]) {
            renderFromTree(d2TreeCache[projMeta.umbrella_id]);
            return;
        }

        d2Content.innerHTML = '<div class="flex items-center justify-center h-40 text-gray-400 text-sm">Loading…</div>';

        fetch('admin_dashboard2.php?umbrella_id=' + encodeURIComponent(projMeta.umbrella_id))
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (!data.success) {
                    d2Content.innerHTML = '<div class="text-center text-red-500 text-sm py-10">' + d2Esc(data.message || 'Could not load project.') + '</div>';
                    return;
                }
                d2TreeCache[projMeta.umbrella_id] = data;
                renderFromTree(data);
            })
            .catch(function () {
                d2Content.innerHTML = '<div class="text-center text-red-500 text-sm py-10">Connection error. Please try again.</div>';
            });
        return;
    }

    // ── One specific umbrella already loaded ──────────────────────────────
    if (!d2Tree) return;

    if (!projectId) {
        d2Content.innerHTML = d2RenderUmbrella(d2Tree);
        return;
    }

    const project = d2Tree.projects.find(function (p) { return p.id === projectId; });
    if (!project) return;

    d2Content.innerHTML = d2RenderUmbrella(d2Tree) + d2RenderProject(project);
});
</script>
<?php if (!$isFragment): ?>
            </div>
        </main>
    </body>
    </html>
<?php endif; ?>
