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
    <title>Warning to Road Users - Indian Railway</title>
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
        .top-number { text-align: right; font-size: 16px; margin-bottom: 5px; font-weight: bold; }
        .main-heading {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            text-decoration: underline;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .sub-heading {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin: 10px 0 20px;
        }
        .notice-text { margin-top: 20px; font-size: 16px; line-height: 1.8; text-align: justify; }
        .notice-text p { margin: 0 0 15px 0; text-indent: 40px; }
        .notice-text p:first-child { text-indent: 0; }
        .dangers { margin-top: 10px; font-size: 16px; line-height: 1.8; }
        .dangers ol { margin-top: 5px; padding-left: 30px; }
        .dangers li { margin-bottom: 5px; }
        .footer-info { margin-top: 30px; font-size: 15px; line-height: 1.7; }
        .signature {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box { width: 220px; text-align: left; font-size: 15px; line-height: 1.5; }
        .sign-name { font-size: 23px; line-height: 1.2; margin-top: 5px; }
        .digitally-signed { font-size: 10px; line-height: 1.5; margin-left: 25px; margin-top: 0; }
        @media print {
            body { background: white; padding: 0; }
            .a4-page { width: 210mm; min-height: 297mm; margin: 0; box-shadow: none; padding: 12mm 10mm; }
        }
    </style>
</head>
<body>
<div class="a4-page">
    <div class="top-number">Proforma-10.02</div>

    <div class="main-heading">
        INDIAN RAILWAY<br>
        INTRODUCTION OF AC 25KV TRACTION
    </div>

    <div class="sub-heading">"WARNING TO ROAD USERS"</div>

    <div class="notice-text">
        <p>It is notified for information of the public that in connection with introduction of 25 KV AC electric
        traction over <?= htmlspecialchars($projectData['from_location'] ?? '') ?> <?= htmlspecialchars($projectData['from_km_no'] ?? '') ?>
        to <?= htmlspecialchars($projectData['to_location'] ?? '') ?> <?= htmlspecialchars($projectData['to_km_no'] ?? '') ?>
        between <?= htmlspecialchars($projectData['main_section_name'] ?? '') ?> section of
        <?= htmlspecialchars($projectData['division'] ?? '') ?> Division, Western Railway,
        Height gauge has been erected to the level crossings with clear height of
        <?= htmlspecialchars($projectData['height_gauge'] ?? '4.78') ?> meter above road level with a view to prevent loads of
        excessive height from coming into contactor dangerous proximity to live traction wire.</p>

        <p>Public are hereby notified to observe the height specified above for the purpose of loading
        vehicles and to see that the load carried in road vehicle do not infringe the height gauges under
        any circumstances.</p>
    </div>

    <div class="dangers">
        The dangers of a load of excessive height are as follows:-
        <ol>
            <li>Dangers to the height gauge and consequence obstruction to the road as well as the Railway line.</li>
            <li>Danger to the materials of equipment carried on the vehicles itself.</li>
            <li>Danger of fire and risk of life due to contact with or dangerous proximity to the conductors.</li>
        </ol>
    </div>

    <div class="footer-info">
        <div>No: <?= htmlspecialchars($projectData['letter_no'] ?? '') ?></div>
        <div>Date: <?= date('d-m-Y') ?></div>
        <div>Place: <?= htmlspecialchars($projectData['division'] ?? '') ?></div>
    </div>

    <div class="signature">
        <div class="signature-box">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name"><br></div>
                <div class="digitally-signed"><br></div>
            </div>
            <div style="font-size:16px; margin-top:5px;">
                Dy. CE/Const/<?= htmlspecialchars($projectData['division'] ?? '') ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
