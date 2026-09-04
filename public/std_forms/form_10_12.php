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
    <title>Proforma 10.12 - Clearance Certificate Switching Stations</title>
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
        .header-line {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 15px;
        }
        .main-heading {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            text-decoration: underline;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .section-title { font-size: 16px; font-weight: bold; margin: 12px 0 8px; }
        .body-text { font-size: 16px; line-height: 1.8; text-align: justify; margin-bottom: 10px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0 15px;
            font-size: 15px;
        }
        th, td {
            border: 1px solid #222;
            padding: 7px 5px;
            text-align: center;
            vertical-align: middle;
        }
        th { font-weight: bold; }
        .items-list { font-size: 16px; line-height: 1.8; list-style-type: lower-alpha; padding-left: 30px; text-align: justify; }
        .items-list li { margin-bottom: 8px; }
        .conclusion-text { font-size: 16px; line-height: 1.8; margin-top: 15px; }
        .signatures {
            margin-top: 35px;
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

    <div class="header-line">
        <span>Western Railway</span>
        <span>Proforma 10.12</span>
    </div>

    <div class="main-heading">
        CLEARANCE CERTIFICATE FOR ENERGISATION ON 25 KV SWITCHING STATIONS<br>
        AND AUXILIARY TRANSFORMERS OF 10KVA CAPACITY
    </div>

    <div class="section-title">1. Detailed description of following posts to be energised:</div>

    <div class="body-text">
        A. Modification of existing <?= htmlspecialchars($projectData['ssp_name'] ?? '') ?> and
        <?= htmlspecialchars($projectData['tss_name'] ?? '') ?> as per the doubling work between
        <?= htmlspecialchars($projectData['main_section_name'] ?? '') ?> section of
        <?= htmlspecialchars($projectData['division'] ?? '') ?> Division of Western Railway.
    </div>

    <div class="body-text">B. Commissioning of Auxiliary Transformers at following locations between
    <?= htmlspecialchars($projectData['at_section'] ?? '') ?> section:</div>

    <table>
        <thead>
            <tr>
                <th>S.NO.</th>
                <th>LOCATION</th>
                <th>RATING</th>
                <th>LINE</th>
                <th>QTY</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($projectData['aux_transformers']) && is_array($projectData['aux_transformers'])): ?>
                <?php foreach ($projectData['aux_transformers'] as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($row['location'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['rating'] ?? '10kVA') ?></td>
                    <td><?= htmlspecialchars($row['line'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['qty'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4"><strong>TOTAL</strong></td>
                    <td><strong><?= htmlspecialchars($projectData['at_total_qty'] ?? '') ?></strong></td>
                </tr>
            <?php else: ?>
                <tr><td>1</td><td></td><td>10kVA</td><td></td><td></td></tr>
                <tr><td colspan="4"><strong>TOTAL</strong></td><td><strong></strong></td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <ul class="items-list">
        <li>The abovementioned <?= htmlspecialchars($projectData['ssp_name'] ?? '') ?> and
        <?= htmlspecialchars($projectData['tss_name'] ?? '') ?> and Auxiliary Transformers have been jointly
        checked and tested for completeness, correct electrical connections, electrical clearances, insulation
        resistance and earthing and bonding etc. and found to be in order. Test reports have been separately submitted.</li>

        <li>The works are being completed in accordance with approved drawings and complies in all respects
        with the requirements of the "Manual for A.C. Traction Maintenance and Operation", Indian Electricity
        Rules and special instructions on the subject.</li>

        <li>All the staff has been withdrawn and warned that the above posts will be charged at 25 KV AC
        immediately. Clearance certificate to the same effect have been obtained from the contractor of above
        Switching Station. No work on the above posts will be taken up hereafter without obtaining a power block
        from official authorized by <strong><?= htmlspecialchars($projectData['sr_dee_trd_designation'] ?? 'Sr.DEE/TRD/RTM') ?></strong>.</li>

        <li>All other safety precautions necessary have been taken.</li>
    </ul>

    <div class="conclusion-text">
        <strong>2.</strong> The <?= htmlspecialchars($projectData['ssp_name'] ?? '') ?> and
        <?= htmlspecialchars($projectData['tss_name'] ?? '') ?> and Auxiliary Transformers are clear and fit
        for energisation on 25 KV AC.
    </div>

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
