<?php
// require_once __DIR__ . '/../config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 — must be loaded here so Swal is available to all partials -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <?php include './navbar.php'; ?>
    <main class="max-w-7xl mx-auto px-6 py-6">
        <div class="flex justify-center gap-3 flex-wrap mb-6">
            <button
                onclick="loadPage('home')"
                class="flex-1 px-5 py-3 bg-blue-950 text-white rounded-lg hover:bg-blue-600">
                Home
            </button>
            
            <button
                onclick="loadPage('umbrella')"
                class="flex-1 px-5 py-3 bg-blue-950 text-white rounded-lg hover:bg-blue-600">
                Create Umbrella Project
            </button>
            <button
                onclick="loadPage('project')"
                class="flex-1 px-5 py-3 bg-blue-950 text-white rounded-lg hover:bg-blue-600">
                Create Project
            </button>

            <button
                onclick="loadPage('equipment')"
                class="flex-1 px-5 py-3 bg-blue-950 text-white rounded-lg hover:bg-blue-600">
                Add Equipment & Machine
            </button>
            <button
                onclick="loadPage('view')"
                class="flex-1 px-5 py-3 bg-blue-950 text-white rounded-lg hover:bg-blue-600">
                View & print
            </button>
            <button
                onclick="loadPage('std_forms')"
                class="flex-1 px-5 py-3 bg-blue-950 text-white rounded-lg hover:bg-blue-600">
                Standard Forms
            </button>

        </div>

        <!-- Common Content Container -->
        <div
            id="pageContent"
            class="bg-white rounded-xl shadow-md p-6 min-h-[600px]">

            <?php include __DIR__ . '/admin_dashboard.php'; ?>

        </div>

    </main>

    <script src="js/app.js"></script>

</body>
</html>