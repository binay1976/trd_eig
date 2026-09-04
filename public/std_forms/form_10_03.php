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
    <title>Proforma 10.03 - Certificate Standard Specifications</title>
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
            position: relative;
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
        .body-text { font-size: 16px; line-height: 1.8; text-align: justify; text-indent: 40px; }
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
        PROFORMA – 10.03<br><br>
        CERTIFICATE REGARDING STANDARD SPECIFICATIONS<br>
        AND INFRINGEMENT TO SOD
    </div>

    <div class="reg-block">
        <span class="reg-label">Reg. : </span>
        <?= htmlspecialchars($projectData['reg_description'] ?? '') ?>
    </div>

    <div class="body-text">
        Certified that the OHE in the proposed section and equipments at
        <?= htmlspecialchars($projectData['ssp_name'] ?? '') ?> and
        <?= htmlspecialchars($projectData['tss_name'] ?? '') ?>
        (25 KV AC Interrupters, Isolators, Lightening Arrester, Potential Transformer)
        including Auxiliary Transformers at various locations, as mentioned in the test reports,
        in the above mentioned section, are being erected as per approved drawings, standard
        specifications and approved make/brand, and there are no infringements to the schedule
        of Dimensions (including the Rules applicable for 25 KV AC traction) except when
        approval of Railway Board/Competent authority has been obtained. The OHE will be
        inspected and charged only if found to comply with the above requirements.
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
            <div class="sig-title"><?= htmlspecialchars($projectData['dy_cee_designation'] ?? 'Dy.CEE/C/RTM') ?></div>
        </div>
    </div>

</div>
</body>
</html>
