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
    <title>Proforma 10.05 - Safety Procedures Certificate</title>
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
        .certified-text { font-size: 16px; line-height: 1.8; margin-bottom: 10px; }
        .items-list { font-size: 16px; line-height: 1.8; text-align: justify; padding-left: 0; list-style: none; }
        .items-list li { display: flex; margin-bottom: 12px; }
        .items-list li .num { min-width: 30px; font-weight: normal; }
        .signatures-grid {
            margin-top: 35px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px 10px;
            font-size: 14px;
        }
        .sig-block { text-align: left; }
        .sign-name { font-size: 20px; line-height: 1.2; }
        .digitally-signed { font-size: 9px; line-height: 1.4; margin-left: 15px; }
        .sig-title { font-size: 14px; font-weight: bold; margin-top: 3px; }
        @media print {
            body { background: white; padding: 0; }
            .a4-page { width: 210mm; min-height: 297mm; margin: 0; box-shadow: none; padding: 12mm 10mm; }
        }
    </style>
</head>
<body>
<div class="a4-page">

    <div class="main-heading">
        PROFORMA-10.05<br><br>
        CERTIFICATE REGARDING SAFETY PROCEDURES AND PRECAUTIONARY MEASURES FOR STAFF
    </div>

    <div class="reg-block">
        <span class="reg-label">Reg:- </span>
        Energization of OHE on 25 kV AC on Newly Constructed DN Line from
        <?= htmlspecialchars($projectData['from_location'] ?? '') ?> Station (Incl.)
        <?= htmlspecialchars($projectData['from_km_no'] ?? '') ?>
        to <?= htmlspecialchars($projectData['to_location'] ?? '') ?> Station (Excl.)
        <?= htmlspecialchars($projectData['to_km_no'] ?? '') ?>,
        in connection with doubling work between
        <?= htmlspecialchars($projectData['main_section_name'] ?? '') ?> section of
        <?= htmlspecialchars($projectData['division'] ?? '') ?> Division as regular measures with trial run of Electric Loco.
    </div>

    <div class="certified-text">It is hereby certified that: -</div>

    <ol class="items-list">
        <li>
            <span class="num">1.</span>
            <span>A copy of General and Subsidiary Rules for 25KV AC Electric Traction is already
            available at the Stations in the electrified section of
            <?= htmlspecialchars($projectData['from_location'] ?? '') ?> Station (Incl.)
            <?= htmlspecialchars($projectData['from_km_no'] ?? '') ?>
            to <?= htmlspecialchars($projectData['to_location'] ?? '') ?> Station (Excl.)
            <?= htmlspecialchars($projectData['to_km_no'] ?? '') ?>,
            in connection with doubling work between
            <?= htmlspecialchars($projectData['main_section_name'] ?? '') ?> section of
            <?= htmlspecialchars($projectData['division'] ?? '') ?> Division.</span>
        </li>
        <li>
            <span class="num">2.</span>
            <span>All staff including running and maintenance staff have been made fully conversant
            with the safety procedures and precautionary measures laid down in the General and
            Subsidiary Rules and special working rules for 25KV AC Traction and the manual for
            AC Traction Maintenance and operation to be observed while working in the electrified section.</span>
        </li>
        <li>
            <span class="num">3.</span>
            <span>Necessary instructions in connection with the safety procedures and precautionary
            measures to be observed while working in the section provided with 25KV AC Traction
            system have been issued to all categories of staff including running and maintenance
            staff of the various department working in and required to work in the electrified section.</span>
        </li>
        <li>
            <span class="num">4.</span>
            <span>The assurance of all the sectional running and maintenance staff in regard to their
            having adequate knowledge of safety procedures and precautionary measures to be
            observed while working in the section provided with 25KV AC electric traction has
            been obtained from them individually.</span>
        </li>
    </ol>

    <div class="signatures-grid">
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_dom_designation'] ?? 'Sr.DOM/RTM') ?></div>
        </div>
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_dso_designation'] ?? 'Sr.DSO/RTM') ?></div>
        </div>
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_dee_trd_designation'] ?? 'Sr.DEE/TRD/RTM') ?></div>
        </div>
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_den_designation'] ?? 'Sr.DEN(N)/RTM') ?></div>
        </div>
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_dste_designation'] ?? 'Sr.DSTE(Co)/RTM') ?></div>
        </div>
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_dee_tro_designation'] ?? 'Sr.DEE(TRO)RTM') ?></div>
        </div>
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_dee_p_designation'] ?? 'Sr.DEE/P/RTM') ?></div>
        </div>
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['sr_den_co_designation'] ?? 'Sr.DEN(Co)RTM') ?></div>
        </div>
        <div class="sig-block">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div class="sig-title"><?= htmlspecialchars($projectData['drm_designation'] ?? 'Divisional Railway Manager ' . ($projectData['division'] ?? '') . ' (WR)') ?></div>
        </div>
    </div>

</div>
</body>
</html>
