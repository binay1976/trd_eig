<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SP-25 KV PT (POTENTIAL TRANSFORMER) INSPECTION</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 py-8">

<div class="max-w-5xl mx-auto px-4">
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">SP-18</strong></div>
        <div style="font-size:12px; opacity:.9;">SP-25 KV PT (POTENTIAL TRANSFORMER) INSPECTION</div>
    </div>
<!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            25KV PT Inspection
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <!-- Form -->
    <form action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" method="POST" class="space-y-6">

        <!-- Basic Information Section (Sr A to 7) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- A -->
                

                <!-- 2. Rly Identification No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Rly Identification No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rly_identification_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 2. Make (Repeated Sr 2 in JSON) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="make" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Maker Sl.No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="maker_sl_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Manufacter's Year <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="manufacters_year" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 5 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5. Insulator( Check Condition) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="insulator_condition" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 6 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6. Voltage Ratio <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="voltage_ratio" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 7 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7. VA Rating <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="va_rating" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- 8. Insulation Resistance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                8. Insulation resistance between(as per OEM)
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- 8.1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.1 a) Pri to earth with 2.5kv Insulation Tester <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="ir_pri_earth" min="200" step="any" required placeholder="≥ 200" class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 8.2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.2 b) Pri to sec with 2.5kv Insulation Tester <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="ir_pri_sec" min="200" step="any" required placeholder="≥ 200" class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 8.3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.3 c) Sec to earth with 500v Insulation Tester <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="ir_sec_earth" min="2" step="any" required placeholder="≥ 2" class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Checks (Sr 9 to 12) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- 9 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9. Secondary Fuse Rating <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="secondary_fuse_rating" required placeholder="amp" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 10 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10. Secondary continuity <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="secondary_continuity" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 11 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11. Duplicate earth and earth continuity <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="duplicate_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 12 -->
                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12. Terminal connector (check for tightness and general condition) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="terminal_connector" rows="2" required placeholder="OK / Not OK" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                </div>
            </div>
        </div>

        <!-- 14. Ratio test (Multi fields) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                14. Ratio test
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pri Voltage -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pri Voltage <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="ratio_test_pri_voltage" min="10" max="20" step="any" required placeholder="Applied Voltage in Primary" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">V</span>
                    </div>
                </div>

                <!-- Sec Voltage -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Sec Voltage <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="ratio_test_sec_voltage" min="10" max="20" step="any" required placeholder="Applied Voltage in Primary" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">V</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 14.1. Reading observed of Ratio test (Multi fields) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                14.1 Reading observed of Ratio test
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pri/ Sec -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pri/ Sec <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="reading_pri_sec" required placeholder="Pri Value" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">V</span>
                    </div>
                </div>

                <!-- Rated Ratio -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Rated Ratio <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="reading_rated_ratio" required placeholder="Sec Value" class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">V</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-4 pt-2 pb-8">
            <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                Reset
            </button>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm">
                Save 25KV PT Inspection
            </button>
        </div>

    </form>
</div>

</body>
</html>