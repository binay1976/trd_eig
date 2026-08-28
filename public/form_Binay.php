<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EIG Module — Forms</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body { height: 100%; margin: 0; }
    </style>
</head>

<body class="bg-gray-100 flex flex-col h-screen overflow-hidden">

    <!-- Navbar -->
    <?php include __DIR__ . '/navbar.php'; ?>

    <!-- Body: sidebar + content -->
    <div class="flex flex-1 overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-96 bg-white border-r border-gray-200 shadow-sm flex-shrink-0 p-5 overflow-y-auto">
            <?php include __DIR__ . '/sidebar.php'; ?>
        </aside>

        <!-- Form iframe -->
        <main class="flex-1 overflow-hidden bg-gray-100">
            <iframe
                id="formFrame"
                src=""
                class="w-full h-full border-none"
                title="Form Content">
            </iframe>

            <!-- Placeholder shown when no form is selected -->
            <div id="formPlaceholder" class="w-full h-full flex flex-col items-center justify-center text-center px-8" style="display:flex!important">
                <div class="text-5xl mb-4">📋</div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">No form selected</h2>
                <p class="text-sm text-gray-400">Select an umbrella and project from the sidebar,<br>then click a form from the equipment list.</p>
            </div>
        </main>

    </div>

    <script>
    // Show/hide placeholder when iframe loads a real page
    const frame = document.getElementById('formFrame');
    const placeholder = document.getElementById('formPlaceholder');

    frame.style.display = 'none';

    frame.addEventListener('load', function () {
        if (frame.src && frame.src !== window.location.href) {
            frame.style.display = 'block';
            placeholder.style.display = 'none';
        }
        // Inject Prev/Next/Form-N controls, the Upload button, and the
        // Unique Form ID into the loaded form itself (defined in
        // sidebar.php — same parent document)
        if (typeof injectFormNav === 'function') injectFormNav();
        if (typeof injectUploadButton === 'function') injectUploadButton();
        if (typeof injectUniqueFormId === 'function') injectUniqueFormId();
        if (typeof hydrateFormFromSaved === 'function') hydrateFormFromSaved();
        if (typeof interceptFormSave === 'function') interceptFormSave();
    });
    </script>

</body>
</html>
