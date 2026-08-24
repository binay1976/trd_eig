<?php
// ── Handle POST (AJAX submission) ────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    session_start();

    // Suppress PHP notices/warnings from polluting JSON output
    error_reporting(0);
    ob_start();

    require_once __DIR__ . '/../config/database.php';

    header('Content-Type: application/json');

    // =========================================================
    // 1. Collect inputs
    // =========================================================

    $umbrella_project_name = trim($_POST['umbrella_project_name'] ?? '');
    $type_of_traction      = trim($_POST['type_of_traction']      ?? '');
    $section_type          = trim($_POST['section_type']          ?? '');
    $main_section_name     = trim($_POST['main_section_name']     ?? '');
    $sub_section_name      = trim($_POST['sub_section_name']      ?? '');
    $from_km_no            = trim($_POST['from_km_no']            ?? '');
    $to_km_no              = trim($_POST['to_km_no']              ?? '');
    $zone                  = strtoupper(trim($_POST['zone']       ?? ''));
    $division              = strtoupper(trim($_POST['division']   ?? ''));
    $route_km              = trim($_POST['route_km']              ?? '');
    $track_km              = trim($_POST['track_km']              ?? '');
    $sanction_date         = trim($_POST['sanction_date']         ?? '');
    $executing_agency      = trim($_POST['executing_agency']      ?? '');
    $pink_book_no          = trim($_POST['pink_book_no']          ?? '');
    $estimated_cost        = trim($_POST['estimated_cost']        ?? '');
    $description           = trim($_POST['description']           ?? '');


    // =========================================================
    // 2. Validate required fields
    // =========================================================

    $required = [
        'Umbrella Project Name' => $umbrella_project_name,
        'Type of Traction'      => $type_of_traction,
        'Section Type'          => $section_type,
        'Main Section Name'     => $main_section_name,
        'Sub Section Name'      => $sub_section_name,
        'From KM No'            => $from_km_no,
        'To KM No'              => $to_km_no,
        'Zone'                  => $zone,
        'Division'              => $division,
        'Route KM'              => $route_km,
        'Track KM'              => $track_km,
        'Sanction Date'         => $sanction_date,
        'Executing Agency'      => $executing_agency,
        'Pink Book No'          => $pink_book_no,
        'Estimated Cost'        => $estimated_cost
    ];

    foreach ($required as $label => $value) {

        if ($value === '') {

            ob_clean();

            echo json_encode([
                'success' => false,
                'message' => "{$label} is required."
            ]);

            exit;
        }
    }


    // =========================================================
    // 3. Create project data array
    // =========================================================
    //
    // All project information will be stored inside ONE
    // JSON column named "project_data".
    //
    // =========================================================

    $project_data = [

        'umbrella_project_name' => $umbrella_project_name,
        'type_of_traction'      => $type_of_traction,
        'section_type'          => $section_type,
        'main_section_name'     => $main_section_name,
        'sub_section_name'      => $sub_section_name,
        'from_km_no'            => $from_km_no,
        'to_km_no'              => $to_km_no,
        'zone'                  => $zone,
        'division'              => $division,
        'route_km'              => $route_km,
        'track_km'              => $track_km,
        'sanction_date'         => $sanction_date,
        'executing_agency'      => $executing_agency,
        'pink_book_no'          => $pink_book_no,
        'estimated_cost'        => $estimated_cost,
        'description'           => $description
    ];


    // =========================================================
    // 4. Convert PHP array into JSON
    // =========================================================

    $project_json = json_encode(
        $project_data,
        JSON_UNESCAPED_UNICODE
    );


    // Check whether JSON conversion was successful

    if ($project_json === false) {

        ob_clean();

        echo json_encode([
            'success' => false,
            'message' => 'Failed to create project JSON.'
        ]);

        exit;
    }


    // =========================================================
    // 5. Generate Umbrella ID
    //
    // Format:
    //
    // ZONE-UMB-YEAR-DIVISION-LOCATION-0001
    //
    // Example:
    //
    // WR-UMB-2026-BRC-AHMEDABAD-0001
    //
    // =========================================================

    $year = date('Y');


    // Clean main section name

    $location = strtoupper(
        preg_replace(
            '/[^A-Za-z0-9\s]/',
            '',
            $main_section_name
        )
    );


    // Replace multiple spaces with -

    $location = preg_replace(
        '/\s+/',
        '-',
        trim($location)
    );


    // Limit location to 10 characters

    $location = substr(
        $location,
        0,
        10
    );


    // Create ID prefix

    $id_prefix = "{$zone}-UMB-{$year}-{$division}-{$location}";


    // =========================================================
    // 6. Find next sequence number
    // =========================================================

    $stmt = $pdo->prepare(
        "SELECT COUNT(*)
         FROM umbrella_projects
         WHERE umbrella_id LIKE ?"
    );

    $stmt->execute([
        $id_prefix . '-%'
    ]);


    $count = (int) $stmt->fetchColumn();


    // Create 4-digit sequence

    $sequence = str_pad(
        $count + 1,
        4,
        '0',
        STR_PAD_LEFT
    );


    // Create final umbrella ID

    $umbrella_id = "{$id_prefix}-{$sequence}";


    // =========================================================
    // 7. Ensure Umbrella ID is unique
    // =========================================================

    while (true) {

        $check = $pdo->prepare(
            "SELECT id
             FROM umbrella_projects
             WHERE umbrella_id = ?
             LIMIT 1"
        );

        $check->execute([
            $umbrella_id
        ]);


        // If ID does not exist, break the loop

        if (!$check->fetch()) {
            break;
        }


        // If ID exists, increase sequence

        $count++;


        $sequence = str_pad(
            $count + 1,
            4,
            '0',
            STR_PAD_LEFT
        );


        $umbrella_id = "{$id_prefix}-{$sequence}";
    }


    // =========================================================
    // 8. Insert into database
    // =========================================================
    //
    // IMPORTANT:
    //
    // We are NOT inserting the 16 fields separately.
    //
    // They are all inside:
    //
    // $project_json
    //
    // Database columns used:
    //
    // umbrella_id
    // project_data
    // created_by
    //
    // =========================================================

    try {

        $created_by = trim(($_SESSION['username'] ?? '') . '-' . ($_SESSION['desig'] ?? '')) ?: null;

        $insert = $pdo->prepare("
            INSERT INTO umbrella_projects (
                umbrella_id,
                project_data,
                created_by,
                updated_by
            )
            VALUES (?, ?, ?, ?)
        ");


        $insert->execute([

            $umbrella_id,

            $project_json,

            $created_by,

            $created_by

        ]);


        // =====================================================
        // 9. Return success response
        // =====================================================

        ob_clean();

        echo json_encode([

            'success'     => true,

            'message'     => 'Umbrella Project created successfully!',

            'umbrella_id' => $umbrella_id

        ]);


    } catch (Exception $e) {

        // =====================================================
        // 10. Database error
        // =====================================================

        ob_clean();

        echo json_encode([

            'success' => false,

            'message' => 'Database error: ' . $e->getMessage()

        ]);
    }


    exit;
}
?>


<div class="max-w-5xl mx-auto">

    <!-- Page Title -->

    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-800">
            Create Umbrella Project
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Enter the details to create a new umbrella project.
            (All Fields Required)
        </p>

    </div>


    <!-- Form -->

    <form id="umbrellaForm" class="space-y-6">


        <!-- Umbrella Project Name -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">

                Umbrella Project Name

                <span class="text-red-500">*</span>

            </label>

            <input
                type="text"
                name="umbrella_project_name"
                required
                placeholder="Enter umbrella project name"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
            >

        </div>


        <!-- Project Details -->

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">


            <!-- Type of Traction -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Type of Traction

                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="type_of_traction"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

                    <option value="">
                        Select Traction
                    </option>

                    <option value="1x25 KV">
                        1x25 KV
                    </option>

                    <option value="2x25 KV">
                        2x25 KV
                    </option>

                </select>

            </div>


            <!-- Section Type -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Section Type

                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="section_type"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

                    <option value="">
                        Select Section Type
                    </option>

                    <option value="Single Line">
                        Single Line
                    </option>

                    <option value="Double Line">
                        Double Line
                    </option>

                    <option value="Multiple Line">
                        Multiple Line
                    </option>

                </select>

            </div>


            <!-- Main Section Name -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Main Section Name

                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    name="main_section_name"
                    required
                    placeholder="Enter Main Section name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

            </div>


            <!-- Sub Section Name -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Sub Section Name

                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    name="sub_section_name"
                    required
                    placeholder="Enter Sub Section name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

            </div>


            <!-- From KM -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    From KM No.

                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    name="from_km_no"
                    required
                    placeholder="Enter From KM No."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

            </div>


            <!-- To KM -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    To KM No.

                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    name="to_km_no"
                    required
                    placeholder="Enter To KM No."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

            </div>


            <!-- Zone -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Zone

                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="zone"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

                    <option value="">
                        Select Zone
                    </option>

                    <option value="WR">
                        WR
                    </option>

                    <option value="CR">
                        CR
                    </option>

                    <option value="SR">
                        SR
                    </option>

                </select>

            </div>


            <!-- Division -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Division

                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="division"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

                    <option value="">
                        Select Division
                    </option>

                    <option value="BCT">
                        BCT
                    </option>

                    <option value="BRC">
                        BRC
                    </option>

                    <option value="ADI">
                        ADI
                    </option>

                    <option value="RTM">
                        RTM
                    </option>

                    <option value="BVP">
                        BVP
                    </option>

                    <option value="RJT">
                        RJT
                    </option>

                </select>

            </div>


            <!-- Route KM -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Route KM (RKM)

                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="number"
                    step="0.001"
                    name="route_km"
                    required
                    placeholder="Enter Route KM"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

            </div>


            <!-- Track KM -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Track KM (TKM)

                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="number"
                    step="0.001"
                    name="track_km"
                    required
                    placeholder="Enter Track KM"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

            </div>


            <!-- Sanction Date -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Sanction Date

                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="date"
                    name="sanction_date"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

            </div>


            <!-- Executing Agency -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Executing Agency

                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="executing_agency"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

                    <option value="">
                        Select Executing Agency
                    </option>

                    <option value="RE">
                        RE
                    </option>

                    <option value="MRVC">
                        MRVC
                    </option>

                    <option value="CONST">
                        CONST.
                    </option>

                    <option value="RVNL">
                        RVNL
                    </option>

                    <option value="GRID">
                        GRID
                    </option>

                    <option value="Division">
                        Division
                    </option>

                    <option value="Owner">
                        Owner
                    </option>

                    <option value="Other">
                        Other
                    </option>

                </select>

            </div>


            <!-- Pink Book -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Pink Book No

                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    name="pink_book_no"
                    required
                    placeholder="Enter Pink Book No"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

            </div>


            <!-- Estimated Cost -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Estimated Cost (₹ in Lakhs)

                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="number"
                    step="0.01"
                    name="estimated_cost"
                    required
                    placeholder="Enter Estimated Cost"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >

            </div>

        </div>


        <!-- Description -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">

                Project Description

            </label>

            <textarea
                name="description"
                rows="4"
                placeholder="Enter project description"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"
            ></textarea>

        </div>


        <!-- Buttons -->

        <div class="flex justify-center gap-4 pt-4">

            <button
                type="reset"
                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium"
            >
                Reset
            </button>


            <button
                type="submit"
                id="umbrellaSubmitBtn"
                class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm"
            >
                Create Umbrella Project
            </button>


            <!-- Uploads Button -->

            <button
                type="button"
                onclick="loadPage('umbrella_uploads')"
                class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium shadow-sm"
            >
                Uploads
            </button>

        </div>

    </form>

</div>


<script src="js/create_umbrella.js"></script>