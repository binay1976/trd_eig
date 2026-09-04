<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section Insulator (SI) Inspection Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">OHE-12</strong></div>
        <div style="font-size:12px; opacity:.9;">OHE-SECTION INSULATOR (SI) INSPECTION REPORT</div>
    </div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Section Insulator (SI) Inspection Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the section insulator check and maintenance details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- SR 1-3 & 18: General Location & Date Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                1. General Identification & Location Details <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Station / Yard / Section <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="station_yard_section" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Location Between <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="location_between" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Elementary Section <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="elementary_section" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        18. Date of checking <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="date_of_checking" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                </div>
            </div>
        </div>

        <!-- SR 4-6: Axial Distance, Track Separation & Stagger -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                2. Clearance & Stagger Measurements <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Axial distance between Catenary & Contact wire <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="axial_distance_catenary_contact" placeholder="More than 450 mm" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6. Stagger of Section Insulator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="stagger_section_insulator" placeholder="100 mm" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>

            <!-- 5. Track separation at the location of Section insulator (Group) -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <span class="block font-medium text-gray-700 mb-3 text-sm">5. Track separation at the location of Section insulator</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Runners toward centre of Turn out</label>
                        <input type="text" name="track_sep_toward_center" placeholder="1650 mm" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Runner away from centre of Turn out</label>
                        <input type="text" name="track_sep_away_center" placeholder="1450 mm" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 7: Distance of Section Insulator from support (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                3. Distance from Support <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7.1 For Obligatory type X-over/Turn out <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="dist_support_obligatory" placeholder="2 to 10 m" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7.2 For knuckle type X-over/Turn out <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="dist_support_knuckle" placeholder="More than 2 m" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>

        <!-- SR 8-12: Alignment, Leveling, Clamps, Clearances & Sag -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                4. Physical & Mechanical Checks <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8. Alignment of Runners <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="alignment_runners" placeholder="Properly aligned" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9. Leveling with Spirit level <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="leveling_spirit_level" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10. Condition of Anchor clamp <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="anchor_clamp_condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11. Clearance between runners & contact wire <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="clearance_runners_contact" placeholder="250 mm" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12. Sag of Section Insulator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sag_section_insulator" placeholder="Zero" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 13: Insulator Make, Batch & Testing (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                5. Insulator Details (As per SMI TI MI 0042 Rev-1) <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        13.1 9T insulator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="insulator_9t" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        13.2 Core Insulator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="insulator_core" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 14: Contact wire diameter (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                6. Contact Wire Diameter <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14.1 Facing end (≥ 10 mm) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="contact_wire_facing_end" min="10" step="any" placeholder="≥ 10 mm" required
                            class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">mm</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14.2 Trailing end (≥ 10 mm) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="contact_wire_trailing_end" min="10" step="any" placeholder="≥ 10 mm" required
                            class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">mm</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 15-17: Droppers, Stiffners & Earthing -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                7. Droppers, Stiffners & Earthing <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        15. Condition of balancing droppers <span class="text-red-500">*</span>
                    </label>
                    <select name="balancing_droppers_condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        17. Earthing of Neutral part (dedicated earth & rail) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="earthing_neutral_part" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>

            <!-- 16. Checking of stiffner on both side of SI (Group) -->
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <span class="block font-medium text-gray-700 mb-3 text-sm">16. Checking of stiffener on both sides of SI</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Length of Stiffener Facing & Trailing end</label>
                        <div class="relative">
                            <input type="number" name="stiffener_length" min="1000" step="any" placeholder="≥ 1000 mm" required
                                class="w-full px-3 py-2 pr-16 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                            <span class="absolute right-3 top-2 text-gray-500 text-xs">mm</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">No. of droppers on Stiffener (Min. 2 nos.)</label>
                        <input type="text" name="stiffener_droppers_count" placeholder="Minimum 2 nos." required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 19: Supervisor Name & Signature -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                19. Name and signature of supervisor <span class="text-red-500">*</span>
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
                Save Section Insulator Inspection Report
            </button>
        </div>

    </form>
</div>

</body>
</html>