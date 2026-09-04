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
    <title>Proforma 10.08 - Signalling and Telecom Works Certificate</title>
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
        .items-list { font-size: 16px; line-height: 1.8; text-align: justify; padding-left: 0; list-style: none; }
        .items-list li { display: flex; margin-bottom: 10px; }
        .items-list li .num { min-width: 30px; font-weight: bold; }
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
        PROFORMA-10.08<br><br>
        CERTIFICATE REGARDING COMPLETION OF SIGNALLING AND TELECOM WORKS
    </div>

    <div class="reg-block">
        <span class="reg-label">Reg. : </span>
        <?= htmlspecialchars($projectData['reg_description'] ?? '') ?>
    </div>

    <ol class="items-list">
        <li><span class="num">1.</span><span>All modifications to electrical signaling is being carried out to make the installations suitable for introduction of 25 KV AC traction.</span></li>
        <li><span class="num">2.</span><span>Colour light signaling is being installed in above section.</span></li>
        <li><span class="num">3.</span><span>The existing block instruments (<?= htmlspecialchars($projectData['block_section'] ?? '') ?> section) are being modified to suit the introduction of 25KV AC traction.</span></li>
        <li><span class="num">4.</span><span>All overhead signaling circuits are being transferred to underground cables. Communication installations have been modified to make them suitable for 25 KV AC traction. Emergency control circuits exist with emergency sockets alongside the track. Traction power control phones have been provided at all station.</span></li>
        <li><span class="num">5.</span><span>The existing signals are being re-sited without infringement to the "Schedule of dimensions" except where approval of Railway Board/Competent Authority has been obtained.</span></li>
        <li><span class="num">6.</span><span>Necessary rule books in connection with working in the section energized with 25 KV AC have been issued to S&T staff for working in the above section.</span></li>
        <li><span class="num">7.</span><span>The modifications and the new works mentioned above have been done according to the "Manual of Instruction for Installation of S&T Equipment on 25 KV, 50 HZ, AC Electrified sections".</span></li>
        <li><span class="num">8.</span><span>The undersigned has no objection to the energization of the section mentioned above with 25 KV AC, with effect from on or after <?= htmlspecialchars($projectData['energization_date'] ?? '') ?>.</span></li>
    </ol>

    <div class="signatures">
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_dste_designation'] ?? 'Sr. DSTE/CO/RTM') ?></div>
        </div>
        <div class="sig-block" style="text-align:right;">
            <div style="display:flex; align-items:flex-start; justify-content:flex-end;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['dy_cste_designation'] ?? 'Dy.CSTE/C/RTM') ?></div>
        </div>
    </div>

</div>
</body>
</html>
