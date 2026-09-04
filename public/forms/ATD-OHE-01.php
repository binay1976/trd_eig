<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATD Checking Inspection Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">OHE-01</strong></div>
        <div style="font-size:12px; opacity:.9;">OHE-ATD (AUTO TENSIONING DEVICE) CHECKING REPORT</div>
    </div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            ATD (Auto Tensioning Device) Checking Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the ATD inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- SR 1-5: Installation & General Parameters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                1. General Parameters & Installation Details <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- 1. Date of Installation -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Date of Installation <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="date_of_installation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                </div>

                <!-- 3. Type of OHE -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Type of OHE <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="type_of_ohe" placeholder="Conventional / Tramway" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4. Half Tension length -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Half Tension length (Meters) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="half_tension_length" placeholder="not more than 750" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 5. Temperature -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5. Temperature (°C) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="temperature" placeholder="°C" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 7. Free movement of ATD -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7. Free movement of ATD <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="free_movement_atd" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 2: ATD Details (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                2. ATD Specifications <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2.1 Type <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="atd_type" placeholder="3-Pulley or 5-Pulley" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2.2 Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="atd_make" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 6: Value of X & Y (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                6. Value of X & Y (in meters) <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.1 X value <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="x_value" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.2 Y value <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="y_value" placeholder="value" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 8: SS wire Rope (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                8. SS Wire Rope Parameters <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.1 Condition of SS wire rope <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ss_rope_condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.2 Position over pulley groove <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ss_rope_pulley_position" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.3 Date of lubrication <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ss_rope_lubrication_date" placeholder="Balmerol oil" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.4 Status of inner and outer strands <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ss_rope_strands_status" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.6 Make & batch of SS wire Rope <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ss_rope_make_batch" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div class="sm:col-span-2 lg:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.5 Ovality of SS wire rope over moving portion <span class="text-red-500">*</span>
                    </label>
                    <textarea name="ss_rope_ovality" rows="2" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                </div>
            </div>
        </div>

        <!-- SR 9: Drum & wheel disc (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                9. Drum & Wheel Disc Examination <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.1 Visual wear of drum (Go/No-go) <span class="text-red-500">*</span>
                    </label>
                    <select name="drum_wear_exam" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.2 Wear of bent arms on both sides <span class="text-red-500">*</span>
                    </label>
                    <select name="bent_arms_wear" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.3 Grazing of side walls with wire rope <span class="text-red-500">*</span>
                    </label>
                    <select name="drum_grazing" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.4 Alignment of drum with OHE <span class="text-red-500">*</span>
                    </label>
                    <select name="drum_alignment" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.5 Gap between drum and wheel disc <span class="text-red-500">*</span>
                    </label>
                    <select name="drum_wheel_gap" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- SR 10: Pulley (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                10. Pulley Examination <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10.1 Wear of pulley, bent arms <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pulley_wear" placeholder="Ok" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10.2 Movement of axle <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pulley_axle_movement" placeholder="Free" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10.3 Grazing with wire rope <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pulley_grazing" placeholder="Yes/No" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10.4 Alignment with OHE <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pulley_alignment" placeholder="Align/Not align" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 11-13: Bearing, Clevis & Eye -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                11. Bearing & Clevis Details <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11.1 Make of sealed bearing <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bearing_make" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11.2 Condition of felt & grease seal <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bearing_seal_condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12.1 Clevis & eye visual exam <span class="text-red-500">*</span>
                    </label>
                    <select name="clevis_visual_exam" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12.2 Alignment with fixed pulley <span class="text-red-500">*</span>
                    </label>
                    <select name="clevis_alignment" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Option</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        13. Movement of clevis & eye <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="clevis_movement" placeholder="Proper" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 14-15: Hex Tie Rod -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                14. Hex Tie Rod <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14.2 Parallelism of hex tie rod <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="hex_rod_parallelism" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14.3 Length of hex tie rod (m) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="hex_rod_length" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14.1 Rusting/corrosion/deformation/breakage exam <span class="text-red-500">*</span>
                    </label>
                    <textarea name="hex_rod_exam" rows="2" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        15. Movement of angle spacer of hex tie rod <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="angle_spacer_movement" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 16-20: Counter Weights, Mast Anchor, Guide Tube & Fasteners -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                16. Counter Weights & Structural Mountings <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.2 Deformation of counter weight base eye <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="counter_weight_eye_deformation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.3 Condition of counter weight <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="counter_weight_condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        17.1 Deformation of mast anchor fitting <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="mast_fitting_deformation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        17.2 Eye of fitting in horizontal plane <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="mast_fitting_plane" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        19.1 Looseness of fasteners <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="fasteners_looseness" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        20. Condition of other fittings/components <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="other_fittings_condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div class="sm:col-span-2 lg:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.1 Check for missing counter weight <span class="text-red-500">*</span>
                    </label>
                    <textarea name="missing_counter_weight" rows="2" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                </div>
                <div class="sm:col-span-2 lg:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        18.1 Guide tube check (bent/deformed/missing) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="guide_tube_check" rows="2" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                </div>
            </div>
        </div>

        <!-- SR 21-26: Modifications, Alignment & Insulators -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 space-y-5">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-2">
                7. Modifications, Alignment & Insulation <span class="text-red-500">*</span>
            </h2>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    21. Anti-falling arrangement modification in 3-Pulley ATD as per HQ.TC No.66 <span class="text-red-500">*</span>
                </label>
                <textarea name="mod_anti_falling" rows="2" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    22. Forged Clevis & eyehook (ID 5322-1) as per RDSO mod. (TI/DRG/OHE/ATD/RDSO/00005/02/01) <span class="text-red-500">*</span>
                </label>
                <textarea name="mod_forged_clevis" rows="2" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    23. SS wire rope as per RDSO spec No.TI/SPC/OHE/WR/1060 (Batch 2006 onwards) <span class="text-red-500">*</span>
                </label>
                <textarea name="mod_ss_rope_spec" rows="2" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 pt-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        24. Alignment of ATD with OHE <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="atd_ohe_alignment" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        25. Make & batch of 9T Insulator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="insulator_9t_make_batch" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        26. Provision of distance rod <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="distance_rod_provision" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 27-28: Remarks & Supervisor Sign -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    27. Remarks <span class="text-red-500">*</span>
                </label>
                <textarea name="remarks" rows="3" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    28. Sign of supervisor with name & design. <span class="text-red-500">*</span>
                </label>
                <input type="text" name="supervisor_sign_designation" required placeholder="Supervisor Name & Designation"
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
                Save ATD Checking Report
            </button>
        </div>

    </form>
</div>

</body>
</html>