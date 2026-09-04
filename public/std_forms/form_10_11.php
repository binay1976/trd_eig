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
    <title>Proforma 10.11 - Clearance Certificate OHE Energisation</title>
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
            margin-bottom: 20px;
        }
        .reg-block { font-size: 16px; line-height: 1.8; text-align: justify; margin-bottom: 15px; }
        .reg-block .reg-label { font-weight: bold; }
        .intro-text { font-size: 16px; line-height: 1.8; text-indent: 40px; margin-bottom: 10px; }
        .certified-text { font-size: 16px; line-height: 1.8; margin-bottom: 8px; }
        .items-list { font-size: 16px; line-height: 1.8; text-align: justify; list-style-type: lower-alpha; padding-left: 35px; }
        .items-list li { margin-bottom: 10px; }
        .conclusion-text { font-size: 16px; line-height: 1.8; text-align: justify; text-indent: 40px; margin-top: 15px; }
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

    <div class="main-heading">
        PROFORMA-10.11<br><br>
        CLEARANCE CERTIFICATE FOR ENERGISATION ON 25KV<br>
        Over Head Equipment
    </div>

    <div class="reg-block">
        <span class="reg-label">Reg. : </span>
        <?= htmlspecialchars($projectData['reg_description'] ?? '') ?>
    </div>

    <div class="intro-text">Detailed description of overhead equipment to be energized:</div>
    <div class="certified-text">It is hereby certified that:</div>

    <ul class="items-list">
        <li>The above over-head equipment is being jointly checked for completeness, electrical
        clearance and tested for installation and continuity, electrical independence of different
        elementary sections as also bonding and earthing etc. and found to be in order.</li>

        <li>The work is being completed in accordance with the latest approved general supply
        diagram and sectioning diagram etc. and complies in all respects with the requirements
        of "Manual of AC Traction Maintenance and Operation" and Indian Electricity Rules.</li>

        <li>All our staff have been withdrawn and warned that the line will be charged at 25KV AC
        immediately. Clearance Certificates to the same effect have been obtained from all the
        contractors working on the above section. No work on the above section will be taken up
        hereafter without obtaining a power block from an official authorize by
        <?= htmlspecialchars($projectData['sr_dee_trd_designation'] ?? 'Sr. DEE/TRD/RTM') ?>.</li>

        <li>All necessary safety precautions have been taken in accordance with "Manual for AC
        Traction Maintenance and Operation". Section viz. Double line section from
        <?= htmlspecialchars($projectData['from_location'] ?? '') ?>
        <?= htmlspecialchars($projectData['from_km_no'] ?? '') ?>
        to <?= htmlspecialchars($projectData['to_location'] ?? '') ?>,
        <?= htmlspecialchars($projectData['to_km_no'] ?? '') ?>,
        including switching stations at
        <?= htmlspecialchars($projectData['ssp_name'] ?? '') ?> and
        <?= htmlspecialchars($projectData['tss_name'] ?? '') ?>
        including 25KV feeder lines, and provision of new Auxiliary Transformers of 10KVA capacity,
        in connection with doubling work between
        <?= htmlspecialchars($projectData['main_section_name'] ?? '') ?> section of
        <?= htmlspecialchars($projectData['division'] ?? '') ?> Division of Western Railway,
        have been adjusted, checked and made ready for energisation.</li>
    </ul>

    <div class="conclusion-text">
        The overhead equipment referred to above is clear and fit for energisation and may be
        energized at 25 KV AC (Regular measure).
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
