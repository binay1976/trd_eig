<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/tree_data.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$umbrellaId = $_GET['umbrella_id'] ?? '';
if ($umbrellaId === '') {
    die('Umbrella ID is required.');
}

$tree = eig_build_umbrella_tree($pdo, $umbrellaId);
if ($tree === null) {
    die('Umbrella Project not found.');
}

// Full raw project_data for the umbrella itself
$stmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'UPID' AND common_id = ? LIMIT 1");
$stmt->execute([$umbrellaId]);
$umbrellaFullData = json_decode($stmt->fetchColumn() ?: '{}', true) ?: [];

function h($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }

function prettifyLabel(string $key): string
{
    return ucwords(str_replace('_', ' ', $key));
}

function renderPageToTempPdf(string $html, string $tmpDir): string
{
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $path = $tmpDir . '/' . uniqid('page_') . '.pdf';
    file_put_contents($path, $dompdf->output());
    return $path;
}

// --------------------------------------------------
// Master styles applied to all standard content pages
// --------------------------------------------------
function pageStyles(): string
{
    return '
        /* Sets the blank margin space outside the border */
        @page { margin: 30px; size: A4 portrait; }
        
        html, body { margin: 0; padding: 0; font-family: "Helvetica Neue", Arial, sans-serif; color: #1F2937; font-size: 13px; }
        
        /* Fixed position acts as a border that wraps the content perfectly */
        .page-border {
            position: fixed;
            top: 0; left: 0; bottom: 0; right: 0;
            border: 2px solid #1E3A5F;
            z-index: -100;
        }
        
        /* Adds space inside the border so text doesn\'t touch the lines */
        .content-wrapper {
            padding: 30px;
        }
        
        .header-container { border-bottom: 3px solid #1E3A5F; padding-bottom: 10px; margin-bottom: 20px; }
        h1.section-title { font-size: 22px; color: #1E3A5F; margin: 0; padding: 0; letter-spacing: 0.5px; }
        h3.sub-title { font-size: 14px; color: #065F46; margin: 15px 0 10px; text-transform: uppercase; letter-spacing: 0.5px; }
        
        /* Modern Table Styles */
        table.info-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        table.info-table thead tr { background-color: #1E3A5F; color: #ffffff; }
        table.info-table th { padding: 12px 15px; text-align: left; font-size: 14px; letter-spacing: 0.5px; border: 1px solid #1E3A5F; }
        table.info-table td { padding: 10px 15px; border: 1px solid #D1D5DB; line-height: 1.5; }
        table.info-table tbody tr:nth-child(even) { background-color: #F9FAFB; }
        
        table.info-table td.label { font-weight: bold; width: 35%; color: #0F2038; }
        table.info-table td.blank { border-bottom: 1px dashed #9CA3AF; background-color: #ffffff; }
        
        .muted { color: #6B7280; font-style: italic; margin-bottom: 15px; }
        .full-image { width: 100%; text-align: center; margin-top: 10px; }
        .full-image img { max-width: 100%; max-height: 80vh; border: 1px solid #E5E7EB; padding: 5px; background: #fff; }
    ';
}

function renderInfoTablePage(string $title, array $fields, string $tmpDir): string
{
    $rows = '';
    foreach ($fields as $key => $value) {
        if ($value === null || $value === '') continue;
        $rows .= '<tr><td class="label">' . h(prettifyLabel((string) $key)) . '</td><td>' . h($value) . '</td></tr>';
    }
    if ($rows === '') {
        $rows = '<tr><td colspan="2" class="muted" style="text-align:center; padding: 20px;">No data recorded.</td></tr>';
    }

    $html = '<html><head><style>' . pageStyles() . '</style></head><body>
        <div class="page-border"></div>
        <div class="content-wrapper">
            <div class="header-container"><h1 class="section-title">' . h($title) . '</h1></div>
            <table class="info-table">
                <thead><tr><th>Parameter</th><th>Details</th></tr></thead>
                <tbody>' . $rows . '</tbody>
            </table>
        </div>
        </body></html>';

    return renderPageToTempPdf($html, $tmpDir);
}

function extractFormFieldLabels(string $formFilePath): array
{
    if (!is_file($formFilePath)) {
        return [];
    }

    $html = file_get_contents($formFilePath);
    $html = preg_replace('/<\?php.*?\?>/s', '', $html);

    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="utf-8" ?><div>' . $html . '</div>', LIBXML_NOERROR | LIBXML_NOWARNING);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $fields = [];
    $skipTypes = ['hidden', 'submit', 'button', 'reset', 'file'];

    foreach ($xpath->query('//input[@name] | //select[@name] | //textarea[@name]') as $el) {
        $name = $el->getAttribute('name');
        if ($name === '' || in_array($el->getAttribute('type'), $skipTypes, true)) {
            continue;
        }

        $label = '';
        if ($el->parentNode) {
            foreach ($xpath->query('.//label', $el->parentNode) as $labelEl) {
                $label = trim($labelEl->textContent);
                break;
            }
        }
        if ($label === '') {
            $label = prettifyLabel($name);
        }
        $label = trim(preg_replace('/\s+/', ' ', $label), " *\t\n\r");

        $fields[$name] = $label;
    }

    return $fields;
}

function renderNotFilledPage(string $formLabel, string $formName, string $tmpDir): string
{
    $fields = extractFormFieldLabels(__DIR__ . '/forms/' . $formName . '.php');

    $rows = '';
    foreach ($fields as $label) {
        $rows .= '<tr><td class="label">' . h($label) . '</td><td class="blank">&nbsp;</td></tr>';
    }
    if ($rows === '') {
        $rows = '<tr><td colspan="2" class="muted" style="text-align:center; padding: 20px;">No fields found for this form.</td></tr>';
    }

    $html = '<html><head><style>' . pageStyles() . '</style></head><body>
        <div class="page-border"></div>
        <div class="content-wrapper">
            <div class="header-container"><h1 class="section-title">' . h($formLabel) . '</h1></div>
            <p class="muted"><strong>Note:</strong> This form has not been filled out yet. The fields below are shown blank.</p>
            <table class="info-table">
                <thead><tr><th>Parameter</th><th>Details</th></tr></thead>
                <tbody>' . $rows . '</tbody>
            </table>
        </div>
        </body></html>';
    return renderPageToTempPdf($html, $tmpDir);
}

function renderImagePage(string $label, string $imagePath, string $tmpDir): string
{
    $data = base64_encode(file_get_contents($imagePath));
    $ext  = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
    $mime = ($ext === 'png') ? 'image/png' : 'image/jpeg';

    $html = '<html><head><style>' . pageStyles() . '</style></head><body>
        <div class="page-border"></div>
        <div class="content-wrapper">
            <h3 class="sub-title">' . h($label) . '</h3>
            <div class="full-image"><img src="data:' . $mime . ';base64,' . $data . '"></div>
        </div>
        </body></html>';
    return renderPageToTempPdf($html, $tmpDir);
}

function renderPlaceholderPage(string $label, string $filename, string $tmpDir): string
{
    $html = '<html><head><style>' . pageStyles() . '</style></head><body>
        <div class="page-border"></div>
        <div class="content-wrapper">
            <div class="header-container"><h1 class="section-title">' . h($label) . '</h1></div>
            <p class="muted">Document <strong>"' . h($filename) . '"</strong> is not previewable in this report (Word/Excel format) — see the original upload.</p>
        </div>
        </body></html>';
    return renderPageToTempPdf($html, $tmpDir);
}

// function appendUploadPages(array &$pages, array $upload, string $tmpDir): void
// {
//     $filePath = dirname(__DIR__) . '/' . ltrim($upload['file_path'] ?? '', '/');

//     if ($upload['file_path'] === '' || !is_file($filePath)) {
//         $pages[] = renderPlaceholderPage($upload['label'] ?? 'Document', ($upload['original_name'] ?? 'unknown') . ' (file missing)', $tmpDir);
//         return;
//     }

//     $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

//     if ($ext === 'pdf') {
//         $pages[] = $filePath; 
//     } elseif (in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
//         $pages[] = renderImagePage(($upload['label'] ?? 'Document') . ': ' . ($upload['original_name'] ?? ''), $filePath, $tmpDir);
//     } else {
//         $pages[] = renderPlaceholderPage($upload['label'] ?? 'Document', $upload['original_name'] ?? basename($filePath), $tmpDir);
//     }
// }


function appendUploadPages(array &$pages, array $upload, string $tmpDir): void
{
    $uploadRoot = dirname(__DIR__) . '/uploads';

    // Path stored in database
    $dbPath = trim($upload['file_path'] ?? '');

    if ($dbPath === '') {
        $pages[] = renderPlaceholderPage(
            $upload['label'] ?? 'Document',
            ($upload['original_name'] ?? 'unknown') . ' (file path missing)',
            $tmpDir
        );
        return;
    }

    /*
     * Resolve the actual physical file path.
     */

    // If DB already contains full Linux path
    if (isset($dbPath[0]) && $dbPath[0] === '/') {

        $filePath = $dbPath;

    } else {

        // Remove leading slash
        $relativePath = ltrim($dbPath, '/');

        /*
         * Handle different possible DB path formats:
         *
         * umbrella/file.pdf
         * project/file.pdf
         * uploads/umbrella/file.pdf
         */

        $relativePath = preg_replace(
            '#^uploads/#',
            '',
            $relativePath
        );

        $filePath = $uploadRoot . '/' . $relativePath;
    }

    // Debug logs - useful while testing
    error_log('========================================');
    error_log('UPLOAD DB PATH: ' . $dbPath);
    error_log('RESOLVED FILE PATH: ' . $filePath);
    error_log('FILE EXISTS: ' . (is_file($filePath) ? 'YES' : 'NO'));

    // File missing
    if (!is_file($filePath)) {

        $pages[] = renderPlaceholderPage(
            $upload['label'] ?? 'Document',
            ($upload['original_name'] ?? 'unknown') . ' (file missing)',
            $tmpDir
        );

        return;
    }

    // Get extension
    $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

    // PDF - directly add to mutool merge
    if ($ext === 'pdf') {

        $pages[] = $filePath;

    }

    // Images - convert to PDF page
    elseif (in_array($ext, ['jpg', 'jpeg', 'png'], true)) {

        $pages[] = renderImagePage(
            ($upload['label'] ?? 'Document') . ': ' .
            ($upload['original_name'] ?? ''),
            $filePath,
            $tmpDir
        );

    }

    // Word / Excel etc.
    else {

        $pages[] = renderPlaceholderPage(
            $upload['label'] ?? 'Document',
            $upload['original_name'] ?? basename($filePath),
            $tmpDir
        );
    }
}

// --------------------------------------------------
// Build the ordered list of PDF page-sources
// --------------------------------------------------
$tmpDir = sys_get_temp_dir() . '/eig_book_' . uniqid();
mkdir($tmpDir, 0770, true);

$pages = [];

$coverBgStyle = 'background: linear-gradient(160deg, #1E3A5F 0%, #0F2038 100%);';
foreach (['jpg', 'jpeg', 'png'] as $ext) {
    $candidate = __DIR__ . '/images/report-cover.' . $ext;
    if (file_exists($candidate)) {
        $mime = $ext === 'png' ? 'image/png' : 'image/jpeg';
        $data = base64_encode(file_get_contents($candidate));
        $coverBgStyle = 'background: url("data:' . $mime . ';base64,' . $data . '") left top no-repeat; background-size: 100% 100%;';
        break;
    }
}

$u = $tree['umbrella'];
$pceeSentence = 'Application of PCEE sanction for introduction of commercial services at '
    . h($umbrellaFullData['type_of_traction']  ?? '') . ' 50Hz AC Traction on '
    . h($umbrellaFullData['section_type']      ?? '') . ' section Between '
    . h($umbrellaFullData['main_section_name'] ?? '') . ' stations from km '
    . h($umbrellaFullData['from_km_no']        ?? '') . ' to km '
    . h($umbrellaFullData['to_km_no']           ?? '') . ' on '
    . h($umbrellaFullData['main_section_name'] ?? '') . ' section of '
    . h($umbrellaFullData['division']          ?? '') . ' Division of '
    . h($umbrellaFullData['zone']               ?? '') . '.';

// --------------------------------------------------
// Cover Page HTML (now featuring margins and border)
// --------------------------------------------------
$coverHtml = '<html><head><style>
    /* 30px outer margin, same as content pages */
    @page { margin: 30px; size: A4 portrait; }
    html, body { margin: 0; padding: 0; width: 100%; height: 100%; }
    
    .page-border {
        position: fixed;
        top: 0; left: 0; bottom: 0; right: 0;
        border: 2px solid #1E3A5F;
        z-index: 10;
        pointer-events: none; /* ensures text inside can still be highlighted */
    }

    /* Cover perfectly scales to fit inside the bordered area */
    .cover { 
        position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
        ' . $coverBgStyle . ' 
        font-family: "Helvetica Neue", Arial, sans-serif; 
    }

    .pcee-header { position: absolute; top: 260px; width: 100%; color: #0a4985; text-align: center; font-size: 24px; font-weight: bold; text-decoration: underline; letter-spacing: 0.5px; color: #0F2038; }

    .textblock { position: absolute; left: 10%; top: 300px; width: 80%; }
    .pcee-body { font-size: 18px; line-height: 1.9; text-align: center; color: #0c0d0f; }

    .pcee-footer { position: absolute; width: 100%; color: #e61313; font-weight: bold; font-size: 16px; font-weight: bold; letter-spacing: 0.5px; }
    .pcee-footer .left { position: absolute; top: 600px; left: 10%; }
    .pcee-footer .right { position: absolute; top: 600px; right: 10%; }
</style></head><body>
<div class="page-border"></div>
<div class="cover">
    <div class="pcee-header">APPLICATION FOR PCEE\'S SANCTION</div>
    <div class="textblock">
        <div class="pcee-body">' . $pceeSentence . '</div>
    </div>
    <div class="pcee-footer">
        <span class="left">RKM: ' . h($umbrellaFullData['route_km'] ?? '') . ', TKM: ' . h($umbrellaFullData['track_km'] ?? '') . '</span>
        <span class="right">Gauge - 1676mm</span>
    </div>
</div>
</body></html>';

$pages[] = renderPageToTempPdf($coverHtml, $tmpDir);

$pages[] = renderInfoTablePage('Umbrella Details — ' . $umbrellaId, $umbrellaFullData, $tmpDir);

foreach ($tree['umbrella']['uploads'] as $u) {
    appendUploadPages($pages, $u, $tmpDir);
}

foreach ($tree['projects'] as $project) {
    $pstmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'PID' AND common_id = ? LIMIT 1");
    $pstmt->execute([$project['id']]);
    $projectFullData = json_decode($pstmt->fetchColumn() ?: '{}', true) ?: [];

    $pages[] = renderInfoTablePage('Project — ' . $project['id'], $projectFullData, $tmpDir);

    foreach ($project['uploads'] as $u) {
        appendUploadPages($pages, $u, $tmpDir);
    }

    foreach ($project['forms'] as $form) {
        foreach ($form['instances'] as $inst) {
            $formLabel = $form['form_no'] . ' (' . $inst['label'] . ') — ' . $form['form_name'];

            if ($inst['is_filled']) {
                $fstmt = $pdo->prepare("SELECT project_data FROM umbrella_projects WHERE type = 'EID' AND common_id = ? LIMIT 1");
                $fstmt->execute([$inst['unique_form_id']]);
                $formData = json_decode($fstmt->fetchColumn() ?: '{}', true) ?: [];
                $pages[] = renderInfoTablePage($formLabel, $formData, $tmpDir);
            } else {
                $pages[] = renderNotFilledPage($formLabel, $form['form_name'], $tmpDir);
            }

            foreach ($inst['uploads'] as $u) {
                appendUploadPages($pages, $u, $tmpDir);
            }
        }
    }
}

// --------------------------------------------------
// Merge everything with mutool
// --------------------------------------------------
$outputPath = $tmpDir . '/book_final.pdf';

$cmd = escapeshellarg(eig_mutool_path()) . ' merge -o ' . escapeshellarg($outputPath);
foreach ($pages as $p) {
    $cmd .= ' ' . escapeshellarg($p);
}

exec($cmd . ' 2>&1', $output, $exitCode);

if ($exitCode !== 0 || !is_file($outputPath)) {
    http_response_code(500);
    die('Could not assemble the report book. mutool output: ' . implode("\n", $output));
}

// --------------------------------------------------
// Stamp a page number (bottom-left) and a footer line (bottom-right) onto
// every page except the cover (see eig_stamp_pdf_pages() in tree_data.php).
// --------------------------------------------------
$finalPath = eig_stamp_pdf_pages(
    $outputPath,
    'Western Railway, @Deeprail || Generated by WR/EIG Tool',
    $tmpDir
);

// --------------------------------------------------
// Stream the final PDF inline, then clean up temp files
// --------------------------------------------------
header('Content-Type: application/pdf');
header('Content-Length: ' . filesize($finalPath));
header('Content-Disposition: inline; filename="Umbrella_Book_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $umbrellaId) . '.pdf"');
readfile($finalPath);

// Cleanup
array_map('unlink', glob($tmpDir . '/*'));
rmdir($tmpDir);