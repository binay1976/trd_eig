<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/database.php';

session_start();
$stmt = $pdo->prepare("
    SELECT common_id
    FROM umbrella_projects
    WHERE common_id IS NOT NULL
    ORDER BY common_id
");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-xl">
    <h1 class="text-2xl font-bold mb-6 text-center">Select Project</h1>
    <form action="/std_forms/set_project.php" method="POST">
        <label class="block mb-2 font-semibold">
            Select Common ID
        </label>
        <select
            name="common_id"
            required
            class="w-full border rounded-lg p-3 mb-5">
            <option value="">
                -- Select Common ID --
            </option>
            <?php foreach ($projects as $project): ?>
                <option value="<?= htmlspecialchars($project['common_id']) ?>">
                    <?= htmlspecialchars($project['common_id']) ?>
                    <?php if (!empty($project['project_name'])): ?>
                        - <?= htmlspecialchars($project['project_name']) ?>
                    <?php endif; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button
            type="submit"
            class="w-full bg-blue-700 text-white p-3 rounded-lg hover:bg-blue-800">
            Open Forms
        </button>
    </form>
</div>
</body>
</html>