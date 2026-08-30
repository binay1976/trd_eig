<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SP-25KV CT-IR TEST (INSULATION RESISTANCE TEST)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 py-8">

<div class="max-w-6xl mx-auto px-4">
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">SP-11</strong></div>
        <div style="font-size:12px; opacity:.9;">SP-25KV CT-IR TEST (INSULATION RESISTANCE TEST)</div>
    </div>
<!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            25KV CT IR Test
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <!-- Form -->
    <form action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" method="POST" class="space-y-6">

        <!-- Basic Details Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- 0 -->
                

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
                        3. Maker Sl.No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="maker_sl_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 4 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        4. Manufacture's Year <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="manufactures_year" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 5 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        5. Insulator (Check Condition) <span class="text-red-500">*</span>
                    </label>
                    <select name="insulator_condition" required class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Select</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 6. Insulation resistance between (as per OEM) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                6. Insulation resistance between (as per OEM)
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- 6.1 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        6.1 a) Pri to earth with 2.5kv Insulation Tester <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="any" name="ir_pri_to_earth" required class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 6.2 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        6.2 b) Pri to sec with 2.5kv Insulation Tester <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="any" name="ir_pri_to_sec" required class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 6.3 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        6.3 c) Sec to earth with 500v Insulation Tester <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="any" name="ir_sec_to_earth" required class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 7. Earth Continuity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-700 mb-2">
                    7. Duplicate earth and earth continuity <span class="text-red-500">*</span>
                </label>
                <input type="text" name="duplicate_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-4 pt-2 pb-8">
            <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition-colors">
                Reset
            </button>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors">
                Save 25KV CT IR Test
            </button>
        </div>

    </form>
</div>

</body>
</html>