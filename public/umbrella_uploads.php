<?php
require_once __DIR__ . '/../config/database.php';

$umbrellaIds = $pdo->query(
    "SELECT DISTINCT umbrella_id
     FROM umbrella_projects
     WHERE umbrella_id IS NOT NULL AND umbrella_id <> ''
     ORDER BY umbrella_id"
)->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="max-w-6xl mx-auto">
    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Umbrella Documents Upload
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Select Umbrella ID and upload the required documents.
            </p>
        </div>

        <!-- Umbrella ID -->
        <div class="mb-6 max-w-md">
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Umbrella ID<span class="text-red-500">*</span></label>
            <select id="umbrellaId" onchange="loadUploadedFiles()" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="">Select Umbrella ID</option>
                <?php foreach ($umbrellaIds as $umbrellaId): ?>
                    <option value="<?= htmlspecialchars($umbrellaId, ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($umbrellaId, ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-950 text-white">
                        <th class="px-4 py-3 text-left w-20">Sr No</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-center w-48">Upload</th>
                        <th class="px-4 py-3 text-left">Uploaded File</th>
                    </tr>
                </thead>

                <tbody id="uploadTableBody">
                    <tr class="border-b">
                        <td class="px-4 py-4">1</td>
                        <td class="px-4 py-4 font-medium text-gray-700">Project Approval</td>
                        <td class="px-4 py-4 text-center"><label class="inline-block cursor-pointer px-4 py-2 bg-blue-950 text-white rounded-lg hover:bg-blue-600">Upload<input type="file" class="hidden" onchange="handleUpload(this, 1)"></label></td>
                        <td id="fileName1" class="px-4 py-4 text-sm text-gray-500">Not Uploaded</td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-4">1</td>
                        <td class="px-4 py-4 font-medium text-gray-700">Project Approval</td>
                        <td class="px-4 py-4 text-center"><label class="inline-block cursor-pointer px-4 py-2 bg-blue-950 text-white rounded-lg hover:bg-blue-600">Upload<input type="file" class="hidden" onchange="handleUpload(this, 1)"></label></td>
                        <td id="fileName1" class="px-4 py-4 text-sm text-gray-500">Not Uploaded</td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-4">1</td>
                        <td class="px-4 py-4 font-medium text-gray-700">Project Approval</td>
                        <td class="px-4 py-4 text-center"><label class="inline-block cursor-pointer px-4 py-2 bg-blue-950 text-white rounded-lg hover:bg-blue-600">Upload<input type="file" class="hidden" onchange="handleUpload(this, 1)"></label></td>
                        <td id="fileName1" class="px-4 py-4 text-sm text-gray-500">Not Uploaded</td>
                    </tr>

                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- <script>

    /*
    -------------------------------------------------------
    Temporary demo storage
    -------------------------------------------------------
    Replace this later with PHP/MySQL data.
    */

    const uploadedFiles = {

        "UMB-001": {
            1: "Project_Approval.pdf",
            2: "Estimate.pdf"
        },

        "UMB-002": {
            1: "Approval_Letter.pdf",
            3: "Drawing.pdf"
        },

        "UMB-003": {},

        "UMB-004": {
            4: "Sanction_Letter.pdf"
        }

    };


    /*
    -------------------------------------------------------
    Load Previously Uploaded Files
    -------------------------------------------------------
    */

    function loadUploadedFiles() {

        const umbrellaId =
            document.getElementById("umbrellaId").value;


        // Clear all file names

        for (let i = 1; i <= 4; i++) {

            const element =
                document.getElementById("fileName" + i);

            element.textContent = "Not Uploaded";

            element.classList.remove(
                "text-green-600",
                "font-medium"
            );

            element.classList.add("text-gray-500");

        }


        // Nothing selected

        if (!umbrellaId) {
            return;
        }


        // Get files for selected Umbrella ID

        const files =
            uploadedFiles[umbrellaId] || {};


        // Display previously uploaded files

        Object.keys(files).forEach(function(srNo) {

            const element =
                document.getElementById(
                    "fileName" + srNo
                );

            element.textContent =
                files[srNo];

            element.classList.remove(
                "text-gray-500"
            );

            element.classList.add(
                "text-green-600",
                "font-medium"
            );

        });

    }


    /*
    -------------------------------------------------------
    Handle New Upload
    -------------------------------------------------------
    */

    function handleUpload(input, srNo) {

        const umbrellaId =
            document.getElementById("umbrellaId").value;


        // Require Umbrella ID

        if (!umbrellaId) {

            alert("Please select Umbrella ID first.");

            input.value = "";

            return;

        }


        // Check file

        if (!input.files.length) {
            return;
        }


        const file =
            input.files[0];


        /*
        Display filename immediately
        */

        const element =
            document.getElementById(
                "fileName" + srNo
            );


        element.textContent =
            file.name;

        element.classList.remove(
            "text-gray-500"
        );

        element.classList.add(
            "text-green-600",
            "font-medium"
        );


        /*
        Store temporarily
        */

        if (!uploadedFiles[umbrellaId]) {

            uploadedFiles[umbrellaId] = {};

        }


        uploadedFiles[umbrellaId][srNo] =
            file.name;


        console.log(
            "Umbrella ID:",
            umbrellaId
        );

        console.log(
            "Sr No:",
            srNo
        );

        console.log(
            "File:",
            file.name
        );


        /*
        ---------------------------------------------------
        IMPORTANT:
        Here you will later send the file to PHP.
        ---------------------------------------------------

        Example:

        const formData = new FormData();

        formData.append("umbrella_id", umbrellaId);
        formData.append("sr_no", srNo);
        formData.append("file", file);

        fetch("upload.php", {
            method: "POST",
            body: formData
        });

        */

    }
</script> -->