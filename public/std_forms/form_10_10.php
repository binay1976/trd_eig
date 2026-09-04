<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'project_data.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proforma 10.10 - Clearance Certificate 25KV Feeder Lines</title>
    <style>
        @page { size: A4; margin: 10mm; }
        * { box-sizing: border-box; }
        body { margin: 0; padding: 20px; background: #e5e5e5; font-family: "Times New Roman", serif; color: #111; }
        .a4-page {
            width: 210mm;
            min-height: 297mm;
            margin: auto;
            padding: 12mm 10mm;
            background: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.25);
        }
        .main-heading {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            text-decoration: underline;
            line-height: 1.6;
            margin-bottom: 5px;
        }
        .sub-heading {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin: 10px 0 15px;
        }
        .reg-block { font-size: 16px; line-height: 1.8; text-align: justify; margin-bottom: 15px; }
        .reg-block .reg-label { font-weight: bold; }
        .body-text { font-size: 16px; line-height: 1.8; text-align: justify; text-indent: 40px; margin-bottom: 15px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 15px;
        }
        th, td {
            border: 1px solid #222;
            padding: 7px 5px;
            text-align: center;
            vertical-align: middle;
        }
        th { font-weight: bold; }
        .signatures {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            font-size: 15px;
        }
        .sig-block { text-align: left; }
        .sign-name { font-size: 23px; line-height: 1.2; }
        .digitally-signed { font-size: 10px; line-height: 1.5; margin-left: 20px; }
        .sig-title { font-size: 15px; font-weight: bold; margin-top: 5px; }
        @media print {
            body { background: white; padding: 0; }
            .a4-page { width: 210mm; min-height: 297mm; margin: 0; box-shadow: none; padding: 12mm 10mm; }
        }
    </style>
</head>
<body>
<div class="a4-page">

    <div class="main-heading">PROFORMA-10.10</div>
    <div class="main-heading" style="margin-top:15px;">CLEARANCE CERTIFICATE FOR ENERGISATION ON 25 KV</div>
    <div class="sub-heading">25KV Feeder Lines</div>

    <div class="reg-block">
        <span class="reg-label">Reg. : </span>
        <?= htmlspecialchars($projectData['reg_description'] ?? '') ?>
    </div>

    <div class="body-text">
        It is certified that the following installation of 25 kV feeders is being provided for the work of
        Energization of OHE on 25 kV AC on double line section from
        <strong><?= htmlspecialchars($projectData['from_location'] ?? '') ?> <?= htmlspecialchars($projectData['from_km_no'] ?? '') ?></strong>
        to <strong><?= htmlspecialchars($projectData['to_location'] ?? '') ?>, <?= htmlspecialchars($projectData['to_km_no'] ?? '') ?></strong>,
        including switching stations at
        <?= htmlspecialchars($projectData['ssp_name'] ?? '') ?> and
        <?= htmlspecialchars($projectData['tss_name'] ?? '') ?>
        in connection with doubling work between
        <?= htmlspecialchars($projectData['main_section_name'] ?? '') ?> section:
    </div>

    <table>
        <thead>
            <tr>
                <th>S. No.</th>
                <th>Location From</th>
                <th>Location To</th>
                <th>Feeder Length</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($projectData['feeder_lines']) && is_array($projectData['feeder_lines'])): ?>
                <?php foreach ($projectData['feeder_lines'] as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($row['from'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['to'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['length'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['description'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>1.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="signatures">
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_dee_trd_designation'] ?? 'Sr. DEE/TRD/RTM') ?></div>
        </div>
        <div class="sig-block" style="text-align:right;">
            <div style="display:flex; align-items:flex-start; justify-content:flex-end;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['dy_cee_designation'] ?? 'DYCEE/C/RTM') ?></div>
        </div>
    </div>

</div>
</body>
</html>
