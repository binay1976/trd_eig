<?php
const EIG_DOC_LABELS = [
    'project_approval' => 'Project Approval',
    'project_drawing'  => 'Project Drawing',
    'circuit_diagram'  => 'Circuit Diagram',
    'test_report'      => 'Test Report',
    'photograph'       => 'Photograph',
    'calibration_cert' => 'Calibration Cert',
];


function like_escape(string $value): string
{
    return str_replace(
        ['\\', '%', '_'],
        ['\\\\', '\\%', '\\_'],
        $value
    );
}

function eig_fetch_uploads(PDO $pdo, string $type, string $scopedId): array
{
    $stmt = $pdo->prepare("SELECT document_id, original_name, stored_name, file_path FROM project_uploads WHERE type = ? AND project_id = ?");
    $stmt->execute([$type, $scopedId]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as &$row) {
        $row['label'] = EIG_DOC_LABELS[$row['document_id']] ?? $row['document_id'];
    }

    return $rows;
}

function eig_build_umbrella_tree(PDO $pdo, string $umbrellaId): ?array
{
    $stmt = $pdo->prepare("SELECT project_data, created_at FROM umbrella_projects WHERE type = 'UPID' AND common_id = ? LIMIT 1");
    $stmt->execute([$umbrellaId]);
    $umbRow = $stmt->fetch();

    if (!$umbRow) {
        return null;
    }

    $umbData = json_decode($umbRow['project_data'] ?? '{}', true) ?: [];

    $umbrella = [
        'id'         => $umbrellaId,
        'name'       => $umbData['umbrella_project_name'] ?? '',
        'zone'       => $umbData['zone']     ?? '',
        'division'   => $umbData['division'] ?? '',
        'created_at' => $umbRow['created_at'] ?? '',
        'uploads'    => eig_fetch_uploads($pdo, 'ULUPID', $umbrellaId),
    ];

    $stmt = $pdo->prepare("
        SELECT common_id, type_project, project_data
        FROM umbrella_projects
        WHERE type = 'PID' AND common_id LIKE ?
        ORDER BY common_id
    ");
    $stmt->execute([like_escape($umbrellaId) . '||PID\\\\%']);
    $projectRows = $stmt->fetchAll();

    $projects = [];
    foreach ($projectRows as $p) {
        $pData = json_decode($p['project_data'] ?? '{}', true) ?: [];

        $fstmt = $pdo->prepare("
            SELECT form_no, form_name, unique_form_id, sequence_label, is_filled
            FROM project_forms
            WHERE project_id = ?
            ORDER BY form_no ASC, sequence_label ASC
        ");
        $fstmt->execute([$p['common_id']]);
        $formRows = $fstmt->fetchAll();

        $grouped = [];
        foreach ($formRows as $fr) {
            $key = $fr['form_no'];
            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'form_no'   => $fr['form_no'],
                    'form_name' => $fr['form_name'],
                    'instances' => [],
                ];
            }
            $grouped[$key]['instances'][] = [
                'label'          => $fr['sequence_label'],
                'unique_form_id' => $fr['unique_form_id'],
                'is_filled'      => (int) $fr['is_filled'],
                'uploads'        => eig_fetch_uploads($pdo, 'ULEID', $fr['unique_form_id']),
            ];
        }

        $projects[] = [
            'id'               => $p['common_id'],
            'type_project'     => $p['type_project'],
            'project_category' => $pData['project_category'] ?? '',
            'location'         => $pData['location']         ?? '',
            'uploads'          => eig_fetch_uploads($pdo, 'ULPID', $p['common_id']),
            'forms'            => array_values($grouped),
        ];
    }

    return ['umbrella' => $umbrella, 'projects' => $projects];
}

function eig_mutool_path(): string
{
    $winget = 'C:\\Users\\USER\\AppData\\Local\\Microsoft\\WinGet\\Packages\\ArtifexSoftware.mutool_Microsoft.Winget.Source_8wekyb3d8bbwe\\mupdf-1.23.0-windows\\mutool.exe';
    return file_exists($winget) ? $winget : 'mutool';
}

// Stamps a page number (bottom-left) and a fixed footer line (bottom-right)
// onto every page of $inputPath except the first (the cover), returning the
// path to the stamped copy — or $inputPath unchanged if stamping fails.
//
// This is done with mutool's JS engine (FreeText annotations) rather than
// Dompdf's own page-numbering APIs: Dompdf's post-render page_script()/
// page_text() calls turned out to corrupt page content in this environment
// (reopening an already-rendered page's object wrote the stamp onto the
// wrong page, or duplicated one page's content onto another — confirmed by
// a standalone test), and inline <script type="text/php"> blocks only fire
// once per document unless wrapped in a repeating fixed-position frame,
// which is finicky to get to reliably skip just the first page. Stamping
// the finished PDF as a separate pass sidesteps both problems, and it's the
// exact same technique already used to merge real uploaded PDFs into the
// book report, so it also works uniformly on non-Dompdf-generated pages.
function eig_stamp_pdf_pages(string $inputPath, string $footerText, string $tmpDir): string
{
    $stampedPath = $tmpDir . '/' . uniqid('stamped_') . '.pdf';
    $stampScript = $tmpDir . '/' . uniqid('stamp_') . '.js';

    file_put_contents($stampScript, '
        var doc = new PDFDocument(' . json_encode($inputPath) . ');
        var n = doc.countPages();
        for (var i = 1; i < n; i++) {
            var page = doc.loadPage(i);
            var b = page.getBounds();

            var left = page.createAnnotation("FreeText");
            left.setRect([b[0] + 20, b[3] - 38, b[0] + 180, b[3] - 10]);
            left.setContents("Page " + (i));
            left.setDefaultAppearance("Helv", 8, [1, 0, 0]);
            left.setQuadding(0);
            left.setBorder(0);
            left.update();

            var right = page.createAnnotation("FreeText");
            right.setRect([b[2] - 480, b[3] - 38, b[2] - 20, b[3] - 10]);
            right.setContents(' . json_encode($footerText) . ');
            right.setDefaultAppearance("Helv", 8, [1, 0, 0]);
            right.setQuadding(2);
            right.setBorder(0);
            right.update();
        }
        doc.save(' . json_encode($stampedPath) . ', "");
    ');

    $cmd = escapeshellarg(eig_mutool_path()) . ' run ' . escapeshellarg($stampScript);
    exec($cmd . ' 2>&1', $output, $exitCode);

    return ($exitCode === 0 && is_file($stampedPath)) ? $stampedPath : $inputPath;
}
