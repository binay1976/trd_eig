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
    <title>Proforma 10.15 - Clearance Certificate by OHE Contractor</title>
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
        .ref-date-row { display: flex; justify-content: space-between; font-size: 15px; margin-bottom: 10px; }
        .proforma-no { text-align: right; font-size: 16px; font-weight: bold; margin-bottom: 5px; }
        .main-heading {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin: 15px 0;
        }
        .reg-block { font-size: 16px; line-height: 1.8; text-align: justify; margin-bottom: 15px; }
        .reg-block .reg-label { font-weight: bold; }
        .salutation { font-size: 16px; margin-bottom: 10px; }
        .items-list { font-size: 16px; line-height: 1.8; text-align: justify; padding-left: 0; list-style: none; }
        .items-list li { display: flex; margin-bottom: 10px; }
        .items-list li .num { min-width: 30px; }
        .conclusion-text { font-size: 16px; line-height: 1.8; margin-top: 10px; }
        .signature { margin-top: 35px; text-align: right; font-size: 15px; }
        .yours-faith { font-weight: bold; margin-bottom: 5px; }
        .sign-name { font-size: 23px; line-height: 1.2; }
        .digitally-signed { font-size: 10px; line-height: 1.5; margin-left: 20px; }
        .sig-title { font-size: 15px; }
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
        <span>Ref: <?= htmlspecialchars($projectData['contractor_ref_no_15'] ?? '') ?></span>
        <span>Dated: <?= htmlspecialchars($projectData['contractor_date'] ?? '') ?></span>
    </div>

    <div class="proforma-no">PROFORMA 10.15</div>

    <div class="main-heading">CLEARANCE CERTIFICATE BY OHE CONTRACTOR</div>

    <div class="reg-block">
        <span class="reg-label">Reg:- </span>
        <?= htmlspecialchars($projectData['reg_description'] ?? '') ?>
    </div>

    <div class="salutation">Dear Sir,</div>

    <ol class="items-list">
        <li>
            <span class="num">1.</span>
            <span>It is hereby certified that all our work at
            <?= htmlspecialchars($projectData['contractor_work_location'] ?? '') ?>
            section is being completed as per standard norms.</span>
        </li>
        <li>
            <span class="num">2.</span>
            <span>It is hereby certified that all our staff have been withdrawn and warned that above section
            would be energized 25 KV AC on or after
            <?= htmlspecialchars($projectData['energization_date'] ?? '') ?>
            and that no one may henceforth carry out any work on the above section without obtaining a permit-to-work
            from an official authorized by <?= htmlspecialchars($projectData['sr_dee_trd_designation'] ?? 'Sr. DEE/TRD/RTM') ?>.</span>
        </li>
        <li>
            <span class="num">3.</span>
            <span>Adequate precaution will also be taken by our staff when working in areas contiguous to the
            section electrified on AC 25 KV system or on parallel lines.</span>
        </li>
        <li>
            <span class="num">4.</span>
            <span>The dead overhead sections contiguous and adjacent to the electrified sections have been
            and will be kept solidly earthed. The installations on the above section are being made ready
            and safe for energisation.</span>
        </li>
    </ol>

    <div class="conclusion-text">
        The section may be charged at 25 KV AC, 50 Hz supply as regular measure.
    </div>

    <div class="signature">
        <div class="yours-faith">Your's faithfully</div>
        <div style="display:flex; align-items:flex-start; justify-content:flex-end;">
            <div class="sign-name"><br><br></div>
            <div class="digitally-signed"><br></div>
        </div>
        <div class="sig-title">
            For - <?= htmlspecialchars($projectData['contractor_name'] ?? '') ?> (Contractor)
        </div>
    </div>

</div>
</body>
</html>
