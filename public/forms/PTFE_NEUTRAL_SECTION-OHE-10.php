<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTFE Neutral Section (Arthur Flurry) Inspection Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">OHE-10</strong></div>
        <div style="font-size:12px; opacity:.9;">OHE-PTFE NEUTRAL SECTION (ARTHUR FLURRY) INSPECTION REPORT</div>
    </div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            PTFE Neutral Section (Arthur Flurry) Inspection Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the PTFE assembly check and maintenance details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- SR 1-2: General Location Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                1. General Location Details <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Section <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="section" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Location between <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="location_between" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 3-4: Connections, Fasteners, Jumpers & PG Clamps -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                2. Connections & Jumpers Tightness <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Connections and fasteners tightness <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="connections_fasteners_tightness" placeholder="Should be tight" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Earthing Jumpers and PG clamps tightness <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="earthing_jumpers_tightness" placeholder="Should not be loose" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 5-6: Splices & Droppers (Groups) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                3. Splices & Adjustable Droppers <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- 5. Contact end splices -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">5. Contact end splices</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">End-1</label>
                            <input type="text" name="splice_end_1" placeholder="Good" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">End-2</label>
                            <input type="text" name="splice_end_2" placeholder="Good" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 6. Adjustable droppers and split pins -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">6. Adjustable droppers and split pins</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">End-1</label>
                            <input type="text" name="dropper_end_1" placeholder="Intact" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">End-2</label>
                            <input type="text" name="dropper_end_2" placeholder="Intact" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 7: Diameter of PTFE Rod (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                4. Diameter of PTFE Rod (mm) <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <label class="block text-xs text-gray-500 mb-1">1st End-1</label>
                    <input type="text" name="ptfe_dia_1st_end_1" placeholder="Record actual value (mm)" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <label class="block text-xs text-gray-500 mb-1">1st End-2</label>
                    <input type="text" name="ptfe_dia_1st_end_2" placeholder="Record actual value (mm)" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <label class="block text-xs text-gray-500 mb-1">2nd End-1</label>
                    <input type="text" name="ptfe_dia_2nd_end_1" placeholder="Record actual value (mm)" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <label class="block text-xs text-gray-500 mb-1">2nd End-2</label>
                    <input type="text" name="ptfe_dia_2nd_end_2" placeholder="Record actual value (mm)" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
            </div>
        </div>

        <!-- SR 8-12: Cleaning, Stagger, Insulation Wear, Level & Underwear -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                5. Cleaning, Alignment & Wear Checks <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8. Clean PTFE Rod with OEM paste <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ptfe_cleaning" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9. Stagger of PTFE Bracket <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ptfe_bracket_stagger" placeholder="Should be zero" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10. Wear of insulator rod (5 positions) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="insulator_rod_wear" placeholder="Max 2mm: turn by 2 marks" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11. Level of PTFE assembly (spirit level) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ptfe_assembly_level" placeholder="Should be zero" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12. Under wear of the runners <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="runners_underwear" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 13: Catenary ending cones (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                6. Catenary Ending Cones <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        13.1 End-1 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="catenary_cone_end_1" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        13.2 End-2 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="catenary_cone_end_2" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 14-17: Skid, Thickness, Earth Electrode & Boards -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                7. Skids, Earthing & Boards <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14. Condition of skid (hit/damages) <span class="text-red-500">*</span>
                    </label>
                    <select name="skid_condition_check" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        15. Profile thickness at bottom of skid <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="skid_thickness" max="2" step="any" placeholder="≤ 2 mm" required
                            class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">mm</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16. Earth electrode connection <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="earth_electrode_resistance" max="10" step="any" placeholder="≤ 10 ohm" required
                            class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">ohm</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        17. Provision of PTFE boards <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ptfe_boards_provision" placeholder="Yes or No" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 18: Supervisor Name & Signature -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                18. Name and signature of supervisor <span class="text-red-500">*</span>
            </label>
            <input type="text" name="supervisor_name_signature" required placeholder="Supervisor Name & Designation"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
        </div>

        <!-- Submit & Reset Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-3 pt-2 pb-8">
            <button type="reset"
                class="w-full sm:w-auto px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition">
                Reset
            </button>
            <button type="submit"
                class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition">
                Save PTFE Arthur Flurry Report
            </button>
        </div>

    </form>
</div>

</body>
</html>