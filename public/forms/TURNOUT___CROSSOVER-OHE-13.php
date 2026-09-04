<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnout & Crossover Inspection Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">OHE-13</strong></div>
        <div style="font-size:12px; opacity:.9;">OHE-TURNOUT & CROSSOVER OHE INSPECTION REPORT</div>
    </div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Turnout & Crossover OHE Inspection Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the turnout and crossover check details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- SR 1-5: General Identification Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                1. General Identification Details <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- 1. Point No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Point No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="point_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 2. Particulars of turnout/crossover -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Particulars of turnout/crossover <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="particulars" placeholder="i.e 1:8 ½, 1:12, 1:16" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 3. Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Section <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="section" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4. Location No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Location No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="location_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 5. Date of checking -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5. Date of checking <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="date_of_checking" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                </div>
            </div>
        </div>

        <!-- SR 6-12: Arrangement & Physical Parameters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                2. Arrangement & Structural Parameters <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- 6. Type of arrangement -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6. Type of arrangement <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="type_of_arrangement" placeholder="Crossed type / Overlap type" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 7. Turnout span -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7. Turnout span <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="turnout_span" placeholder="54 mtr." required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 8. Length of redundant pipe -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8. Length of redundant pipe <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="length_redundant_pipe" placeholder="As per chart" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 9. Track separation at obligatory structure -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9. Track separation at obligatory struct. (mm) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="track_separation_obligatory" placeholder="500-700 mm (permissible up to 150 mm)" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 10. Implantation of obligatory structure -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10. Implantation of obligatory struct. (m) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="implantation_obligatory" placeholder="3.0 mtr." required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 11. Distance of ‘G’ jumper -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11. Distance of ‘G’ jumper from struct. (m) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="distance_g_jumper" placeholder="5.6 mtr. towards overlap" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 12. Length of ‘G’ jumper -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12. Length of ‘G’ jumper (m) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="length_g_jumper" placeholder="4.0 mtr." required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 13-14: Contact Wire Heights (Groups) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                3. Contact Wire Heights <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- 13. Height at obligatory structure -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">13. Height at obligatory structure</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">ML - H</label>
                            <input type="text" name="height_obligatory_ml" required placeholder="ML - H"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">T/O – H+50</label>
                            <input type="text" name="height_obligatory_to" required placeholder="T/O – H+50"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 14. Height towards turnout up to 10 mtr. (Danger zone) -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">14. Height up to 10 mtr. (Danger zone)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">ML - H</label>
                            <input type="text" name="height_danger_ml" required placeholder="ML - H"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">T/O – H+50</label>
                            <input type="text" name="height_danger_to" required placeholder="T/O – H+50"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 15-18: Stagger & Section Insulator Sag -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                4. Stagger & Section Insulator Details <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- 15. Stagger at obligatory structure -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        15. Stagger at obligatory struct. (mm) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="stagger_obligatory" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 16. ML – 200 max -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16. ML – 200 max <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ml_200_max" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 17. T/O – 300 max -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        17. T/O – 300 max <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="to_300_max" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 18. Sag of section insulator -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        18. Sag of section insulator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sag_section_insulator" placeholder="Zero" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 19-20: Tower Wagon Movements (Groups) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                5. Tower Wagon Movement Measurements (650-720) <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- 19. Main line to turnout -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">19. Main line to turnout</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Take on</label>
                            <input type="text" name="tw_ml_to_to_take_on" required placeholder="Take on"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Take off</label>
                            <input type="text" name="tw_ml_to_to_take_off" required placeholder="Take off"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 20. Turnout to main line -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">20. Turnout to main line</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Take on</label>
                            <input type="text" name="tw_to_to_ml_take_on" required placeholder="Take on"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Take off</label>
                            <input type="text" name="tw_to_to_ml_take_off" required placeholder="Take off"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 21-25: Track Separation, ATD, Pantograph & Obligatory Observations -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                6. Track Separation, ATD & Observations <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- 21. Stagger of section insulator -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        21. Stagger of section insulator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="stagger_section_insulator" placeholder="+/- 100 mm" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 23. Condition of ATD -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        23. Condition of ATD of Turnout/Mainline <span class="text-red-500">*</span>
                    </label>
                    <select name="atd_condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>

                <!-- 24. While running T/W on main line -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        24. T/W observation on main line <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="tw_running_observation" placeholder="Not to touch the panto pan" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>

            <!-- 22. Track separation at the location (Group) -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <span class="block font-medium text-gray-700 mb-3 text-sm">22. Track separation at the location</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Runners towards center of Turnout</label>
                        <input type="text" name="track_sep_towards_center" required placeholder="Min. 1.65 mtr."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Runners away from center of Turnout</label>
                        <input type="text" name="track_sep_away_center" required placeholder="Min. 1.4 mtr."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- 25. Observation on obligatory location (Group) -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <span class="block font-medium text-gray-700 mb-3 text-sm">25. Observation on obligatory location</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">RT horizontal</label>
                        <input type="text" name="obs_rt_horizontal" required placeholder="RT horizontal"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Bracket plumbed</label>
                        <input type="text" name="obs_bracket_plumbed" required placeholder="Bracket plumbed"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Deep</label>
                        <input type="text" name="obs_deep" required placeholder="25-30 cm"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 26-27: Remarks & Supervisor Sign -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 space-y-5">
            <!-- 26. Remarks -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    26. Remarks if any
                </label>
                <textarea name="remarks" rows="3" placeholder="Enter any additional remarks..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
            </div>

            <!-- 27. Name & signature of Supervisor -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    27. Name & signature of Supervisor <span class="text-red-500">*</span>
                </label>
                <input type="text" name="supervisor_name_signature" required placeholder="Supervisor Name & Designation"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
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
                Save Turnout & Crossover Report
            </button>
        </div>

    </form>
</div>

</body>
</html>