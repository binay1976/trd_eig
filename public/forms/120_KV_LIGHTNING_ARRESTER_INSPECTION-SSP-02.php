<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSP-120 KV LIGHTNING ARRESTER INSPECTION</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 py-8">

<div class="max-w-6xl mx-auto px-4">
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">SSP-02</strong></div>
        <div style="font-size:12px; opacity:.9;">SSP-120 KV LIGHTNING ARRESTER INSPECTION</div>
    </div>
<!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            120 KV LA Inspection
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <!-- Form -->
    <form action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" method="POST" class="space-y-6">

        <!-- Basic Information Section (Fields A, 1-9) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- A -->
                

                <!-- 1 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        1. Rly Identification No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rly_identification_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 2 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        2. Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="make" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 3 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        3. Type <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 4 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        4. Maker Sl.No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="maker_sl_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 5 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        5. Manfacture's Year <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="manufactures_year" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 6 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        6. Rating <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rating" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 7 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        7. External condition <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="external_condition" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 8 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        8. Duplicate earth and earth continuity <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="duplicate_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 9 -->
                <div class="flex flex-col md:col-span-2 lg:col-span-3">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        9. Terminal connectors (check for tightness and general condition) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="terminal_connectors" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                </div>

            </div>
        </div>

        <!-- Section 10: Insulation Resistance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                10. Insulation resistance with 5kv Insulation Tester (as per TI/MI/0041)
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- 10.1 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        10.1 Top to Earth <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="any" name="insulation_top_earth" required class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 10.2 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        10.2 Top to bottom <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="any" name="insulation_top_bottom" required class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Checks (Fields 11-17) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- 11 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        11. Base insulator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="base_insulator" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 12 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        12. Check Disconnector assembly <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="disconnector_assembly" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 13 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        13. Size of flexible cable for disconnector <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="any" name="flexible_cable_size" required class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">sqmm</span>
                    </div>
                </div>

                <!-- 14 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        14. Check Surge monitor <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="check_surge_monitor" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 15 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        15. Resistive Leakage current <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="any" name="leakage_current" required class="w-full px-4 py-3 pr-24 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">micro Amp</span>
                    </div>
                </div>

                <!-- 16 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        16. Surge monitor serial no <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="surge_monitor_serial" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 17 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        17. Surge monitor counter reading <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="surge_monitor_counter" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-4 pt-2 pb-8">
            <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition-colors">
                Reset
            </button>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors">
                Save 120 KV LA Inspection
            </button>
        </div>

    </form>
</div>

</body>
</html>