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
    <title>Proforma 10.04 - Certificate Bonding and Earthing</title>
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
            margin-bottom: 25px;
        }
        .reg-block { font-size: 16px; line-height: 1.8; text-align: justify; margin-bottom: 20px; }
        .reg-block .reg-label { font-weight: bold; }
        .body-text { font-size: 16px; line-height: 1.8; text-align: justify; }
        .signatures {
            margin-top: 50px;
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

    <div class="main-heading">
        PROFORMA-10.04<br><br>
        CERTIFICATE REGARDING BONDING AND EARTHING
    </div>

    <div class="reg-block">
        <span class="reg-label">Reg. : </span>
        <?= htmlspecialchars($projectData['reg_description'] ?? '') ?>
    </div>

    <div class="body-text">
        <p style="margin:0 0 12px 0;">
            Certified that the bonding and earthing of the above section including
            <?= htmlspecialchars($projectData['ssp_name'] ?? '') ?> and
            <?= htmlspecialchars($projectData['tss_name'] ?? '') ?>
            of <?= htmlspecialchars($projectData['division'] ?? '') ?> Division,
            is being carried out as per the "Bonding Code" and as per approved drawings.
        </p>
        <p style="margin:0;">
            The erected equipments have been connected to the grid in presence of concerned TRD
            representative on date <?= htmlspecialchars($projectData['bonding_date'] ?? '') ?>.
        </p>
    </div>

    <div class="signatures">
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['dy_cste_designation'] ?? 'Dy.CSTE/C/RTM') ?></div>
        </div>
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
            <div class="sig-title"><?= htmlspecialchars($projectData['dy_cee_designation'] ?? 'Dy.CEE/C/RTM') ?></div>
        </div>
    </div>

</div>
</body>
</html>
