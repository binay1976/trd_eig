<?php
// Multi-page PDF report for one umbrella — cover page, then a summary page,
// then one section per project (details, uploads, and every added form's
// fill status + its own uploads). Streamed INLINE so it displays inside
// tree_view.php's popup instead of downloading. Uses Dompdf (Composer).
// Data comes from the same shared source as tree_view.php's JSON tree
// (config/tree_data.php), so the report and the on-screen tree never
// disagree with each other.
//
// Connects to:
//   - config/tree_data.php  — eig_build_umbrella_tree(), eig_stamp_pdf_pages()
//   - js/tree_view.js       — opens this file's URL inside the popup
//   - vendor/dompdf         — the PDF rendering library (Composer)
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/tree_data.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// --------------------------------------------------
// Get Umbrella ID + build the full tree
// --------------------------------------------------
$umbrellaId = $_GET['umbrella_id'] ?? '';
if ($umbrellaId === '') {
    die('Umbrella ID is required.');
}

$tree = eig_build_umbrella_tree($pdo, $umbrellaId);
if ($tree === null) {
    die('Umbrella Project not found.');
}

$umbrella = $tree['umbrella'];
$projects = $tree['projects'];

// Full raw project_data for the umbrella (tree_data.php only exposes summary
// fields) — needed for the PCEE sanction page's templated sentence below.
$stmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'UPID' AND common_id = ? LIMIT 1");
$stmt->execute([$umbrellaId]);
$umbrellaFullData = json_decode($stmt->fetchColumn() ?: '{}', true) ?: [];

// --------------------------------------------------
// Background Image (optional — falls back to a plain colour if missing,
// rather than dying, since no cover image has been supplied yet)
// --------------------------------------------------
// Dompdf does not reliably support the "cover" background-size keyword (it
// was leaving the image short of the page's height, cropping the top and
// showing blank canvas at the bottom) — so the cover-fit size is computed by
// hand in pixels from the image's real dimensions and forced explicitly.
// Also note: Dompdf's default is 96 css-px-per-inch, not 72 (a PDF point),
// so an A4 page (595.28 x 841.89 pt) is really 794 x 1123 in this css-px
// unit — matches the .cover-page height/width set below.
$backgroundImage = __DIR__ . '/images/report-cover.jpg';
$coverStyle = 'background-color: #1E3A5F;';
$coverPageW = 794;
$coverPageH = 1123;
if (file_exists($backgroundImage)) {
    $imageData = base64_encode(file_get_contents($backgroundImage));
    $backgroundImageSrc = 'data:image/jpeg;base64,' . $imageData;
    $imgSize = @getimagesize($backgroundImage);
    $scale = ($imgSize && $imgSize[0] > 0 && $imgSize[1] > 0)
        ? max($coverPageW / $imgSize[0], $coverPageH / $imgSize[1])
        : 1;
    $bgW = $imgSize ? round($imgSize[0] * $scale) : $coverPageW;
    $bgH = $imgSize ? round($imgSize[1] * $scale) : $coverPageH;
    $coverStyle = 'background-image: url("' . $backgroundImageSrc . '"); background-size: ' . $bgW . 'px ' . $bgH . 'px; background-position: center top; background-repeat: no-repeat;';
}

// --------------------------------------------------
// Small render helpers
// --------------------------------------------------
function h($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }

function renderUploadsTable(array $uploads): string
{
    if (empty($uploads)) {
        return '<p class="muted">No documents uploaded.</p>';
    }
    $rows = '';
    foreach ($uploads as $u) {
        $rows .= '<tr><td>' . h($u['label']) . '</td><td>' . h($u['original_name']) . '</td></tr>';
    }
    return '<table class="doc-table"><tr><th>Document Type</th><th>File Name</th></tr>' . $rows . '</table>';
}

// --------------------------------------------------
// Build HTML
// --------------------------------------------------
$html = '
<!DOCTYPE html>
<html>
<head>
<style>
@page { margin: 30px 36px; }
html, body { margin: 0; padding: 0; font-family: Arial, sans-serif; color: #1F2937; font-size: 12px; }

/* ── Cover page ─────────────────────────────────────────────── */
.cover-page {
    width: 100%;
    height: 1063px; /* full A4 page height in Dompdf css-px, minus the @page margins undone below — Dompdf does not support 100vh */
    margin: -30px -36px;
    ' . $coverStyle . '
    position: relative;
    font-family: Arial, sans-serif;
}
/* Sits in the empty white space of the branded cover template — below the
   logo, above the wave graphics, left of the circular photo — so dark text
   is used directly, no overlay panel needed. */
.cover-content { position: absolute; top: 24%; left: 8%; width: 58%; text-align: left; color: #0F2038; }
.title { font-size: 26px; font-weight: bold; margin-bottom: 18px; line-height: 1.25; color: #0F2038; }
.project-name { font-size: 18px; font-weight: 600; margin-bottom: 8px; color: #1E3A5F; }
.location { font-size: 12px; margin-bottom: 4px; color: #4B5563; }
.umbrella-id { font-size: 11px; font-family: monospace; color: #6B7280; margin-top: 10px; }

/* ── Report pages ───────────────────────────────────────────── */
.report-section { page-break-before: always; }
h1.section-title { font-size: 20px; color: #1E3A5F; border-bottom: 2px solid #1E3A5F; padding-bottom: 6px; margin-bottom: 14px; }
h2.project-title { font-size: 16px; color: #5B21B6; background: #EDE9FE; padding: 8px 10px; border-radius: 4px; margin: 20px 0 10px; }
h3.sub-title { font-size: 13px; color: #065F46; margin: 14px 0 6px; text-transform: uppercase; letter-spacing: 0.03em; }
.muted { color: #9CA3AF; font-style: italic; margin: 4px 0 10px; }

table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
table.info-table td { padding: 4px 8px; border: 1px solid #E5E7EB; }
table.info-table td.label { background: #F3F4F6; font-weight: bold; width: 160px; }
table.doc-table th, table.doc-table td { border: 1px solid #E5E7EB; padding: 5px 8px; text-align: left; }
table.doc-table th { background: #1E3A5F; color: #fff; }
table.forms-table th, table.forms-table td { border: 1px solid #E5E7EB; padding: 5px 8px; text-align: left; font-size: 11px; }
table.forms-table th { background: #065F46; color: #fff; }
.status-filled { color: #16A34A; font-weight: bold; }
.status-unfilled { color: #DC2626; }

/* ── PCEE sanction application text, overlaid on the cover image ─── */
.pcee-block { position: absolute; left: 6%; top: 30%; width: 88%; }
.pcee-heading { text-align: center; font-size: 18px; font-weight: bold; text-decoration: underline; letter-spacing: 0.5px; color: #0F2038; margin: 0 0 30px; }
.pcee-body { font-size: 13px; line-height: 1.9; text-align: justify; color: #1F2937; }
.pcee-footer { position: absolute; bottom: 22px; width: 100%; color: #DC2626; font-weight: bold; font-size: 12px; }
.pcee-footer .left { position: absolute; left: 6%; }
.pcee-footer .right { position: absolute; right: 6%; }
</style>
</head>
<body>

<div class="cover-page">
    <div class="pcee-block">
        <div class="pcee-heading">APPLICATION FOR PCEE\'S SANCTION</div>
        <div class="pcee-body">Application of PCEE sanction for introduction of commercial services at '
            . h($umbrellaFullData['type_of_traction']  ?? '') . ' 50Hz AC Traction on '
            . h($umbrellaFullData['section_type']      ?? '') . ' section Between '
            . h($umbrellaFullData['main_section_name'] ?? '') . ' stations from km '
            . h($umbrellaFullData['from_km_no']        ?? '') . ' to km '
            . h($umbrellaFullData['to_km_no']           ?? '') . ' on '
            . h($umbrellaFullData['main_section_name'] ?? '') . ' section of '
            . h($umbrellaFullData['division']          ?? '') . ' Division of '
            . h($umbrellaFullData['zone']               ?? '') . '.</div>
    </div>
    <div class="pcee-footer">
        <span class="left">RKM: ' . h($umbrellaFullData['route_km'] ?? '') . ', TKM: ' . h($umbrellaFullData['track_km'] ?? '') . '</span>
        <span class="right">Gauge - 1676mm</span>
    </div>
</div>

<div class="report-section">
    <h1 class="section-title">Umbrella Summary</h1>
    <table class="info-table">
        <tr><td class="label">Umbrella ID</td><td>' . h($umbrella['id']) . '</td></tr>
        <tr><td class="label">Name</td><td>' . h($umbrella['name']) . '</td></tr>
        <tr><td class="label">Zone</td><td>' . h($umbrella['zone']) . '</td></tr>
        <tr><td class="label">Division</td><td>' . h($umbrella['division']) . '</td></tr>
        <tr><td class="label">Created</td><td>' . h($umbrella['created_at']) . '</td></tr>
        <tr><td class="label">Total Projects</td><td>' . count($projects) . '</td></tr>
    </table>

    <h3 class="sub-title">Umbrella Documents</h3>
    ' . renderUploadsTable($umbrella['uploads']) . '
</div>
';

if (empty($projects)) {
    $html .= '<div class="report-section"><h1 class="section-title">Projects</h1><p class="muted">No projects created under this umbrella yet.</p></div>';
}

foreach ($projects as $project) {
    $html .= '<div class="report-section">';
    $html .= '<h2 class="project-title">Project: ' . h($project['id']) . '</h2>';

    $html .= '<table class="info-table">
        <tr><td class="label">Type of Project</td><td>' . h($project['type_project']) . '</td></tr>
        <tr><td class="label">Category</td><td>' . h($project['project_category']) . '</td></tr>
        <tr><td class="label">Location</td><td>' . h($project['location']) . '</td></tr>
    </table>';

    $html .= '<h3 class="sub-title">Project Documents</h3>';
    $html .= renderUploadsTable($project['uploads']);

    $html .= '<h3 class="sub-title">Equipment &amp; Forms</h3>';

    if (empty($project['forms'])) {
        $html .= '<p class="muted">No equipment/forms added to this project yet.</p>';
    } else {
        $html .= '<table class="forms-table"><tr><th>Form No</th><th>Form Name</th><th>Instance</th><th>Status</th><th>Documents</th></tr>';
        foreach ($project['forms'] as $form) {
            foreach ($form['instances'] as $inst) {
                $statusHtml = $inst['is_filled']
                    ? '<span class="status-filled">Filled</span>'
                    : '<span class="status-unfilled">Not Filled</span>';

                $docsHtml = empty($inst['uploads'])
                    ? '—'
                    : implode(', ', array_map(function ($u) { return h($u['label']); }, $inst['uploads']));

                $html .= '<tr>'
                    . '<td>' . h($form['form_no']) . '</td>'
                    . '<td>' . h($form['form_name']) . '</td>'
                    . '<td>' . h($inst['label']) . '</td>'
                    . '<td>' . $statusHtml . '</td>'
                    . '<td>' . $docsHtml . '</td>'
                    . '</tr>';
            }
        }
        $html .= '</table>';
    }

    $html .= '</div>';
}

$html .= '</body></html>';

// --------------------------------------------------
// Generate PDF
// --------------------------------------------------
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// --------------------------------------------------
// Page number (bottom-left) + footer text (bottom-right) on every page
// except the cover. Stamped onto the finished PDF via mutool (see
// eig_stamp_pdf_pages() in tree_data.php) rather than through Dompdf's own
// page-numbering APIs — Dompdf's post-render page_script()/page_text()
// calls turned out to corrupt page content in this environment (confirmed
// by an isolated test: reopening an already-rendered page's object wrote
// the stamp onto the wrong page instead), so the same proven mutool
// annotation pass already used for the full book report is used here too.
// --------------------------------------------------
$tmpDir = sys_get_temp_dir() . '/eig_report_' . uniqid();
mkdir($tmpDir, 0770, true);

$rawPath = $tmpDir . '/report_raw.pdf';
file_put_contents($rawPath, $dompdf->output());

$finalPath = eig_stamp_pdf_pages(
    $rawPath,
    'Western Railway, @Deeprail || Generated by WR/EIG Tool',
    $tmpDir
);

// --------------------------------------------------
// Stream PDF inline — displays in an iframe/popup instead of downloading.
// --------------------------------------------------
header('Content-Type: application/pdf');
header('Content-Length: ' . filesize($finalPath));
header('Content-Disposition: inline; filename="Umbrella_Report_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $umbrellaId) . '.pdf"');
readfile($finalPath);

array_map('unlink', glob($tmpDir . '/*'));
rmdir($tmpDir);
