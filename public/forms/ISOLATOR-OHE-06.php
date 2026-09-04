<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isolator Inspection Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">OHE-06</strong></div>
        <div style="font-size:12px; opacity:.9;">OHE-ISOLATOR INSPECTION REPORT</div>
    </div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Isolator Inspection Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the isolator maintenance and check details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- SR 1-5: General Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                1. General Details <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Station <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="station" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Isolator Switch No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="isolator_switch_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Location <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="location" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Line <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="line" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5. Elementary Section <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="elementary_section" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 6-10: Plate, Operation, Alignment & Arcing Horn -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                2. Plates, Operation & Alignment <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6. Provision of Number plate <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="number_plate_provision" placeholder="Cleaned" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7. Securing the Number plate <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="number_plate_securing" placeholder="Secured" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8. Free movement during operation <span class="text-red-500">*</span>
                    </label>
                    <select name="free_movement_check" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9. Checked for alignment <span class="text-red-500">*</span>
                    </label>
                    <select name="alignment_check" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10. Check arcing horn for proper Arcing <span class="text-red-500">*</span>
                    </label>
                    <select name="arcing_horn_check" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- SR 11-15: Earthing, Lubrication & Contacts -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                3. Contacts & Mechanical Checks <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11. Earth continuity jumper at handle <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="earth_continuity_jumper" placeholder="Available" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12. Lubrication & brass bushes condition <span class="text-red-500">*</span>
                    </label>
                    <select name="lubrication_bushes_check" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        13. Check Male/Female contacts <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="contacts_check" placeholder="No marks" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14. Application of petroleum jelly <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="petroleum_jelly_application" placeholder="Yes" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        15. Distance between contacts (Open) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="open_contacts_distance" min="500" step="any" placeholder="≥ 500 mm" required
                            class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">mm</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 16: Checking the terminal lug (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                16. Checking the Terminal Lug <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.1 Rusting <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="lug_rusting" placeholder="No rust" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.2 Melting <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="lug_melting" placeholder="No melting" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.3 Flashing <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="lug_flashing" placeholder="No flashing" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.4 Strand damages <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="lug_strand_damages" placeholder="No damages" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.5 Soldering failures etc. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="lug_soldering_failures" placeholder="Properly soldered." required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 17-22: Jumpers, Bus Bars, Pipe & Insulators -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                4. Jumpers, Bus Bars & Insulators <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        17. Proper soldering of jumper <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jumper_soldering_check" placeholder="Yes" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        18. Copper bus bar (HQ TC No.85) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="copper_bus_bar" placeholder="Yes" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        19. Handle pipe near sleeve rustiness <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="handle_pipe_rust" placeholder="No rust" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        20. Anti-falling arrangement for jumper <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="anti_falling_jumper" placeholder="Provided" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        21. Tie rod & pedestal insulator check <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="insulator_crack_check" placeholder="No Flash/ Crack" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        22. Shunt across handle <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="shunt_across_handle" placeholder="Yes/No" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 23-27: Locks, Batch & Signatures -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                5. Lock Details & Signatures <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        23. Integral lock Key No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="integral_lock_key_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        24. Pad Lock Key No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pad_lock_key_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        25. Make & Batch No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="make_and_batch_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        26. Name of Technician <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="technician_name" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        27. Name & signature of Supervisor/Staff <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="supervisor_name_signature" required placeholder="Supervisor Name & Designation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- Submit & Reset Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-3 pt-2 pb-8">
            <button type="reset"
                class="w-full sm:w-auto px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition">
                Reset
            </button>
            <button type="submit"
                class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition">
                Save Isolator Inspection Report
            </button>
        </div>

    </form>
</div>

</body>
</html>