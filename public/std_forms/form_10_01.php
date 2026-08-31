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
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Public Notification - Indian Railways</title>
    <style>
        /* ================================
           PAGE SETUP
        ================================= */
        @page {
            size: A4;
            margin: 10mm;
        }
        * {
            box-sizing: border-box;
        }
        body {margin: 0; padding: 20px;background: #e5e5e5; font-family: "Times New Roman", serif;color: #111;}
        .a4-page {
            width: 210mm;
            min-height: 297mm;
            margin: auto;
            padding: 12mm 10mm;
            background: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.25);
            position: relative;
        }
        .top-number {
            text-align: right;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .main-heading {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            text-decoration: underline;
            line-height: 1.5;
        }
        .notice-text {
            margin-top: 35px;
            font-size: 16px;
            line-height: 1.8;
            text-align: justify;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 15px;
        }
        th,
        td {
            border: 1px solid #222;
            padding: 7px 5px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            font-weight: bold;
        }
        .signature {
            margin-top: 35px;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box {
            width: 200px;
            text-align: left;
            font-size: 15px;
            line-height: 1.5;
        }
        .sign-name {
            font-size: 23px;
            line-height: 1.2;
            margin-top: 5px;
        }
        .digitally-signed {
            font-size: 10px;
            line-height: 1.5;
            margin-left: 25px;
            margin-top: 0;
        }
        .forwarded {
            margin-top: 25px;
            font-size: 15px;
            line-height: 1.55;
        }
        .forwarded-title {
            margin-bottom: 3px;
        }
        .forwarded ol {
            margin-top: 0;
            padding-left: 20px;
        }
        .forwarded li {
            padding-left: 2px;
            margin-bottom: 2px;
        }
        .footer-info {
            margin-top: 22px;
            font-size: 15px;
            line-height: 1.7;
        }


        /* ================================
           BOTTOM SIGNATURE
        ================================= */

        .bottom-signature {
            margin-top: 15px;
            display: flex;
            justify-content: flex-end;
        }
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .a4-page {
                width: 210mm;
                min-height: 297mm;
                margin: 0;
                box-shadow: none;
                padding: 12mm 10mm;
            }
        }
    </style>
</head>

<body>
<div class="a4-page">
    <div class="top-number">
        Proforma-10.01
    </div>
    <div class="main-heading">
        <div>INDIAN RAILWAYS</div>
        <div>“PUBLIC NOTIFICATION”</div>
    </div>
    <div class="notice-text">
        Notice is hereby given to all users of Railway lines and premises
        situated on the completed section of the under noted section of the
        western railway that the 25000 Volts, 50 Hz AC overhead traction wires
        will be energized on or after the date specified in the section.
        On and from the same date, the overhead traction line shall be treated
        as live at all times and no unauthorized person shall approach or work
        in the proximity of the said overhead lines.
    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width:22%;">Section</th>
                <th colspan="2" style="width:56%;">Location</th>
                <th rowspan="2" style="width:22%;">Date</th>
            </tr>
            <tr>
                <th>From</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Between<br><?= htmlspecialchars($projectData['main_section_name'] ?? '') ?><br>section
                </td>
                <td>
                    <?= htmlspecialchars($projectData['sub_section_name'] ?? '') ?><br>
                    <?= htmlspecialchars($projectData['from_km_no'] ?? '') ?>
                </td>
                <td>
                    <?= htmlspecialchars($projectData['sub_section_name'] ?? '') ?><br>
                    <?= htmlspecialchars($projectData['to_km_no'] ?? '') ?>
                </td>
                <td>
                    <strong>20-01-2026</strong>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <div class="signature-box">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name">
                    <br>
                </div>

                <div class="digitally-signed">
                    <br>
                </div>
            </div>
            <div style="font-size:16px; margin-top:5px;">
                Dy. CE/Const/<?= htmlspecialchars($projectData['division'] ?? '') ?><br>
            </div>
        </div>
    </div>

    <div class="forwarded">
        <div class="forwarded-title">
            Copy forwarded for information to:
        </div>
        <ol>
            <li>
                The secretary (Railway Electrification), Railway Board,
                New Delhi
            </li>
            <li>
                The Commissioner of Railway Safety, Western Circle,
                Church Gate
            </li>
            <li>
                The Principal Chief Electric Engineer & EIG,
                Western Railway, Church Gate
            </li>
            <li>
                The General Manager, Principal Chief Operating Manager,
                Principal Chief Engineer, Principal Chief Commercial Manager,
                Principal Chief Mechanical Engineer, Principal Chief Signal &
                Telecommunication Engineer, Principal Chief Safety Officer,
                CEDE, CELE, CESE, CETE, CEE(RS) Western Railway,
                Church Gate
            </li>
            <li>
                Divisional Railway Manager,
                Ratlam, Bhopal, Vadodara, Kota
            </li>
            <li>
                Assistant Director General (DOT),
                Railway Electrification Project, Mumbai Post Master General
                Mandsaur
            </li>
            <li>
                Chief Engineer, State Electricity Board -
                Nimach, Ratlam
            </li>
            <li>
                The Superintendent, Government Police -
                Nimach, Ratlam
            </li>
            <li>
                Sr.DEE(TRD), Sr.DEE(TRO), Sr.DEE(P),
                Sr.DOM, Sr.DCM, Sr.DEN(Co),
                Sr.DEN(I), Jr.DEN(S), Sr.DME(C&W),
                Sr.DEN (DL), Sr.DSTE, Sr.DSO,
                CMS, Dy.CE(O-I), Dy.CE(O-II),
                Dy.CE(C)-IV, IND & Dy.CE(C)RTM,
                Dy.CSTE(C)RTM, SM/NMH, HKL,
                MLG, PIP, MDS, DLD.
            </li>
            <li>
                M/s SRC-ERNRICH-VRR JV - Hyderabad
            </li>
        </ol>
    </div>

    <div class="footer-info">
        <div>
            No: 
        </div>
        <div>
           Date: <?= date('d-m-Y') ?>
        </div>
        <div>
            Place: <?= htmlspecialchars($projectData['division'] ?? '') ?> 
        </div>
    </div>

    <div class="bottom-signature">
        <div class="signature-box">
            <div style="display:flex; align-items:flex-start;">
                <div class="sign-name">
                    <br>
                </div>
                <div class="digitally-signed">
                    <br><br><br>
                </div>
            </div>
            <div style="font-size:16px; margin-top:5px;">
                Dy. CE/Const/<?= htmlspecialchars($projectData['division'] ?? '') ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>