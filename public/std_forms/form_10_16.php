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
    <title>Proforma 10.16 - Contractor Certificate Switching Stations</title>
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
        .letterhead { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #111; padding-bottom: 10px; }
        .company-name { font-size: 26px; font-weight: bold; margin-bottom: 4px; }
        .company-address { font-size: 13px; line-height: 1.5; }
        .ref-date-row { display: flex; justify-content: space-between; font-size: 15px; margin-bottom: 5px; }
        .to-block { font-size: 15px; line-height: 1.6; margin-bottom: 10px; }
        .proforma-no { text-align: right; font-size: 16px; font-weight: bold; margin: 8px 0; }
        .reg-block { font-size: 16px; line-height: 1.8; text-align: justify; margin-bottom: 12px; }
        .reg-block .reg-label { font-weight: bold; }
        .body-text { font-size: 16px; line-height: 1.8; text-align: justify; margin-bottom: 10px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0 12px;
            font-size: 15px;
        }
        th, td { border: 1px solid #222; padding: 7px 5px; text-align: center; vertical-align: middle; }
        th { font-weight: bold; }
        .conclusion-text { font-size: 16px; line-height: 1.8; text-align: justify; margin-top: 10px; }
        .signature { margin-top: 30px; text-align: right; font-size: 15px; }
        .yours-faith { font-weight: bold; margin-bottom: 5px; }
        .sign-name { font-size: 23px; line-height: 1.2; }
        .digitally-signed { font-size: 10px; line-height: 1.5; margin-left: 20px; }
        @media print {
            body { background: white; padding: 0; }
            .a4-page { width: 210mm; min-height: 297mm; margin: 0; box-shadow: none; padding: 12mm 10mm; }
        }
    </style>
</head>
<body>
<div class="a4-page">

    <div class="letterhead">
        <div class="company-name"><?= htmlspecialchars($projectData['contractor_name'] ?? '') ?></div>
        <div class="company-address">
            <?= htmlspecialchars($projectData['contractor_address'] ?? '') ?><br>
            Email: <?= htmlspecialchars($projectData['contractor_email'] ?? '') ?>
        </div>
    </div>

    <div class="ref-date-row">
        <span>Ref: <?= htmlspecialchars($projectData['contractor_ref_no_16'] ?? '') ?></span>
        <span>Dated: <?= htmlspecialchars($projectData['contractor_date'] ?? '') ?></span>
    </div>

    <div class="proforma-no">Proforma 10.16</div>

    <div class="to-block">
        To,<br>
        <?= htmlspecialchars($projectData['dy_cee_full_designation'] ?? 'Dy.CEE / Construction') ?><br>
        W.R. <?= htmlspecialchars($projectData['division'] ?? '') ?> <?= htmlspecialchars($projectData['division_pincode'] ?? '') ?>.
    </div>

    <div class="reg-block">
        <span class="reg-label">Reg:- </span>
        <?= htmlspecialchars($projectData['reg_description'] ?? '') ?>
    </div>

    <div class="body-text">
        It is certified that all physical works are being completed at
        <?= htmlspecialchars($projectData['ssp_short_name'] ?? '') ?> and
        <?= htmlspecialchars($projectData['fp_short_name'] ?? '') ?>
        as per standard norms and that these switching station posts are fit to be charged with 25 KV AC,
        50 Hz, electrical energy on and from <?= htmlspecialchars($projectData['energization_date'] ?? '') ?>.
    </div>

    <div class="body-text">
        Further, It is certified that all physical works are being completed at below mentioned Auxiliary
        Transformer locations as per standard norms and are fit to be charged with 25 KV AC, 50 Hz, electrical
        energy on and from <?= htmlspecialchars($projectData['energization_date'] ?? '') ?>:
    </div>

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

    <div class="conclusion-text">
        All men, materials and earths have been removed from the above switching stations and AT
        locations, and have been warned for maintaining adequate clearance from all the live
        equipments at all times.
    </div>

    <div class="signature">
        <div class="yours-faith">Your's faithfully,</div>
        <div style="display:flex; align-items:flex-start; justify-content:flex-end;">
            <div class="sign-name"><br><br></div>
            <div class="digitally-signed"><br></div>
        </div>
        <div>For - <?= htmlspecialchars($projectData['contractor_name'] ?? '') ?> (Contractor)</div>
    </div>

</div>
</body>
</html>
