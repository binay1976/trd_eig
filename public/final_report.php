<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// --------------------------------------------------
// Get Umbrella ID
// --------------------------------------------------
$umbrellaId = $_GET['umbrella_id'] ?? '';
if ($umbrellaId === '') {
    die('Umbrella ID is required.');
}

// --------------------------------------------------
// Get Umbrella Data
// --------------------------------------------------
$stmt = $pdo->prepare("
    SELECT *
    FROM umbrella_projects
    WHERE umbrella_id = ?
    LIMIT 1
");

$stmt->execute([$umbrellaId]);
$umbrella = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$umbrella) {
    die('Umbrella Project not found.');
}
// --------------------------------------------------
// Background Image
// --------------------------------------------------
$backgroundImage = __DIR__ . '/../assets/report-cover.jpg';
if (!file_exists($backgroundImage)) {
    die('Cover background image not found.');
}
// Convert image to Base64
$imageData = base64_encode(file_get_contents($backgroundImage));
$backgroundImageSrc =
    'data:image/jpeg;base64,' . $imageData;
// --------------------------------------------------
// Data from Database
// --------------------------------------------------
$projectName = $umbrella['project_name'] ?? '';
$location     = $umbrella['location'] ?? '';
$createdAt    = $umbrella['created_at'] ?? '';
// --------------------------------------------------
// Create HTML
// --------------------------------------------------
$html = '
<!DOCTYPE html>
<html>
<head>
<style>
@page {
    margin: 0;
}

html,
body {
    margin: 0;
    padding: 0;
}

.cover-page {

    width: 100%;
    height: 100vh;

    background-image: url("' . $backgroundImageSrc . '");

    background-size: cover;
    background-position: center;

    position: relative;

    font-family: Arial, sans-serif;
}

.cover-content {

    position: absolute;

    top: 35%;
    left: 10%;
    right: 10%;

    text-align: center;

    color: #ffffff;

}

.title {

    font-size: 32px;
    font-weight: bold;

    margin-bottom: 30px;

}

.project-name {

    font-size: 24px;
    font-weight: bold;

    margin-bottom: 15px;

}

.location {

    font-size: 18px;

    margin-bottom: 10px;

}

.umbrella-id {

    font-size: 16px;

}

</style>

</head>

<body>


<div class="cover-page">

    <div class="cover-content">

        <div class="title">
            PROJECT REPORT
        </div>

        <div class="project-name">
            ' . htmlspecialchars($projectName) . '
        </div>

        <div class="location">
            Location: ' . htmlspecialchars($location) . '
        </div>

        <div class="umbrella-id">
            Umbrella ID: ' . htmlspecialchars($umbrellaId) . '
        </div>

    </div>

</div>


</body>

</html>
';


// --------------------------------------------------
// Generate PDF
// --------------------------------------------------

$options = new Options();

$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();


// --------------------------------------------------
// Download PDF
// --------------------------------------------------

$dompdf->stream(
    'Umbrella_Report_' . $umbrellaId . '.pdf',
    [
        'Attachment' => true
    ]
);