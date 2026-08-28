<?php
// Umbrella "tree" explorer — pick an umbrella, see everything under it at
// once: its projects, each project's uploads and added forms, each form's
// fill status, and each filled form instance's own uploads. Pure read-only
// view, built on top of eig_build_umbrella_tree()'s single nested structure.
//
// Connects to:
//   - config/tree_data.php    — supplies eig_build_umbrella_tree() (the data)
//   - js/tree_view.js         — renders the tree below and drives the popup
//   - view_file.php           — opened inside the popup for an upload click
//   - view_form.php           — opened inside the popup for a form click
//   - final_report.php        — opened inside the popup, "View PDF Report"
//   - final_report_book.php   — opened inside the popup, "View Full Book"
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/tree_data.php';

// ── AJAX: full nested tree for one umbrella ───────────────────────────────
// Was its own file (get_tree.php); folded in here since this is the only
// page that ever calls it, same self-contained-AJAX pattern as sidebar.php.
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

$umbrellas = $pdo->query("
    SELECT common_id FROM umbrella_projects
    WHERE type = 'UPID' AND common_id IS NOT NULL AND common_id <> ''
    ORDER BY common_id
")->fetchAll(PDO::FETCH_COLUMN);
?>

<style>
/* ── Tree branch connectors ─────────────────────────────────────────────── */
.eig-tree, .eig-tree ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.eig-tree ul {
    padding-left: 1.75rem;
}
.eig-tree li {
    position: relative;
    padding: 0.35rem 0 0.35rem 1.75rem;
}
.eig-tree li::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    border-left: 2px solid #A9784F;
}
.eig-tree li:last-child::before {
    bottom: auto;
    height: 1.35rem;
}
.eig-tree li::after {
    content: '';
    position: absolute;
    top: 1.35rem;
    left: 0;
    width: 1.4rem;
    border-top: 2px solid #A9784F;
}
.eig-tree > li { padding-left: 0; }
.eig-tree > li::before, .eig-tree > li::after { display: none; }

/* ── Node chip styling ───────────────────────────────────────────────────── */
.eig-node {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.3rem 0.7rem;
    border-radius: 999px;
    font-size: 0.82rem;
    line-height: 1.2;
}
.eig-node-umbrella { background: #1E3A5F; color: #fff; font-weight: 600; }
.eig-node-project  { background: #EDE9FE; color: #5B21B6; font-weight: 600; }
.eig-node-form     { background: #ECFDF5; color: #065F46; font-weight: 500; }
.eig-node-instance { background: #FFF7ED; color: #9A3412; font-size: 0.76rem; }
.eig-node-upload    { background: #EFF6FF; color: #1D4ED8; font-size: 0.74rem; }
.eig-node-empty    { color: #9CA3AF; font-size: 0.76rem; font-style: italic; }

/* ── Subtle tree-themed backdrop behind the whole card ──────────────────── */
.eig-tree-backdrop {
    position: relative;
    background-color: #F9FAF7;
    background-image:
        radial-gradient(circle at 8% 12%, rgba(74,124,89,0.06) 0, transparent 45%),
        radial-gradient(circle at 92% 85%, rgba(74,124,89,0.06) 0, transparent 45%),
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='220' height='220' viewBox='0 0 220 220'%3E%3Cg fill='none' stroke='%234A7C59' stroke-opacity='0.07' stroke-width='2'%3E%3Cpath d='M110 210 L110 90'/%3E%3Cpath d='M110 140 L70 100'/%3E%3Cpath d='M110 120 L150 80'/%3E%3Cpath d='M110 100 L85 60'/%3E%3Cpath d='M110 90 L135 55'/%3E%3Ccircle cx='85' cy='60' r='5'/%3E%3Ccircle cx='135' cy='55' r='5'/%3E%3Ccircle cx='70' cy='100' r='5'/%3E%3Ccircle cx='150' cy='80' r='5'/%3E%3C/g%3E%3C/svg%3E");
    background-repeat: repeat;
    background-size: 220px 220px, 220px 220px, 220px 220px;
}
</style>

<div class="max-w-5xl mx-auto">

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Umbrella Tree View</h2>
        <p class="text-sm text-gray-500 mt-1">Select an umbrella to see every project, form, and upload underneath it.</p>
    </div>

    <div class="mb-6 max-w-md">
        <label class="block text-sm font-medium text-gray-700 mb-2">Select Umbrella<span class="text-red-500">*</span></label>
        <select id="treeUmbrellaId" onchange="loadTree()"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            <option value="">-- Select Umbrella --</option>
            <?php foreach ($umbrellas as $id): ?>
                <option value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div id="treeContainer" class="eig-tree-backdrop rounded-xl border border-gray-200 shadow-sm p-6 min-h-[300px]">
        <div class="flex items-center justify-center h-64 text-gray-400 text-sm">
            🌳 Select an umbrella above to grow its tree.
        </div>
    </div>

</div>

<!-- View-only popup — used for both uploaded documents and filled forms -->
<div id="eigModalOverlay" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-6">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-7xl h-[95vh] flex flex-col overflow-hidden">
        <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 flex-shrink-0">
            <h3 id="eigModalTitle" class="font-semibold text-gray-800 text-sm"></h3>
            <button onclick="closeEigModal()" class="text-gray-400 hover:text-gray-700 text-2xl leading-none px-2">&times;</button>
        </div>
        <iframe id="eigModalFrame" class="flex-1 w-full border-none"></iframe>
    </div>
</div>

<script src="js/tree_view.js"></script>
