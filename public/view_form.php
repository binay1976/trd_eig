<?php
// Read-only viewer for one filled form instance — used inside tree_view.php's
// popup. Loads the real form file (correct labels/layout) in an iframe,
// pre-fills it from get_form_data.php the same way sidebar.php's
// hydrateFormFromSaved() does, then locks every field and hides all buttons.
// No save path exists here — view only, by design.
//
// Connects to:
//   - js/tree_view.js    — builds this file's URL and opens it in the popup
//   - forms/*.php        — the real form file loaded into the iframe below
//   - get_form_data.php  — supplies the saved field values used to pre-fill it
require_once __DIR__ . '/../config/database.php';

$uniqueFormId = trim($_GET['unique_form_id'] ?? '');

if ($uniqueFormId === '') {
    http_response_code(400);
    exit('unique_form_id is required.');
}

$stmt = $pdo->prepare("SELECT form_name FROM project_forms WHERE unique_form_id = ? LIMIT 1");
$stmt->execute([$uniqueFormId]);
$formName = $stmt->fetchColumn();

if (!$formName) {
    http_response_code(404);
    exit('Form instance not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Form (Read Only)</title>
    <style>html, body { height: 100%; margin: 0; }</style>
</head>
<body style="display:flex; flex-direction:column;">

    <div style="background:#FEF3C7; color:#92400E; font-size:12px; font-weight:600; text-align:center; padding:8px 12px; flex-shrink:0;">
        👁 View only — this form cannot be edited here.
    </div>

    <iframe id="viewFrame"
            src="/trd_eig/public/forms/<?= rawurlencode($formName) ?>.php?unique_form_id=<?= urlencode($uniqueFormId) ?>&embed=1"
            style="flex:1; width:100%; border:none;">
    </iframe>

<script>
const frame = document.getElementById('viewFrame');
const uniqueFormId = <?= json_encode($uniqueFormId) ?>;

frame.addEventListener('load', function () {
    let doc;
    try { doc = frame.contentDocument; } catch (e) { return; }
    if (!doc) return;

    fetch('/trd_eig/public/get_form_data.php?unique_form_id=' + encodeURIComponent(uniqueFormId))
        .then(res => res.json())
        .then(result => {
            if (result.success && result.data) {
                Object.keys(result.data).forEach(function (name) {
                    const value = result.data[name];
                    if (value === null || value === undefined) return;

                    let fields;
                    try {
                        fields = doc.querySelectorAll('[name="' + CSS.escape(name) + '"]');
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
            }
        })
        .finally(function () {
            // Lock the form down — view only, no edit, no submit.
            doc.querySelectorAll('input, textarea, select').forEach(function (el) {
                el.disabled = true;
            });
            doc.querySelectorAll('button').forEach(function (btn) {
                btn.style.display = 'none';
            });
        });
});
</script>

</body>
</html>
