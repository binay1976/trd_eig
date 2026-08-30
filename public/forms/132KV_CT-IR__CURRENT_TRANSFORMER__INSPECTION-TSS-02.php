
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-02</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-132KV CT-IR (CURRENT TRANSFORMER) INSPECTION</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            132KV CT-IR (Current Transformer) Inspection
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- SR 1-5: General Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                <!-- 1. Rly Identification No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Rly Identification No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rly_identification_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 2. Make -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="make" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 3. Maker Sl.No -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Maker Sl.No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="maker_sl_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4. Manufacture's Year -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Manufacture's Year <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="manufactures_year" placeholder="YYYY" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>

            <!-- 5. Insulator Condition -->
            <div class="mt-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    5. Insulator (Check Condition) <span class="text-red-500">*</span>
                </label>
                <input type="text" name="insulator_condition" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>
        </div>

        <!-- SR 6: Insulation Resistance (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                6. Insulation resistance between (as per OEM)
            </h2>
            <p class="text-sm text-gray-500 mb-5">Ensure prescribed tester voltage limits are applied.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- 6.1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.1 a) Pri to sec (5kV) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="pri_to_sec_ir" min="2000" step="any" placeholder="≥ 2000 MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 6.2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.2 b) Pri to earth (5kV) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="pri_to_earth_ir" min="2000" step="any" placeholder="≥ 2000 MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 6.3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.3 c) Sec to earth (500V) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="sec_to_earth_ir" min="200" step="any" placeholder="≥ 200 MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 7-9: Polarity, Oil Level & Duplicate Earth -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                <!-- 7. Polarity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7. Polarity (by DC flick test) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="polarity_dc_flick_test" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 8. Oil level -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8. Oil level <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="oil_level" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 9. Duplicate earth -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9. Duplicate earth & continuity <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="duplicate_earth_continuity" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- SR 10: Terminal Connector (Textarea) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                10. Terminal connector (check for tightness and general condition) <span class="text-red-500">*</span>
            </label>
            <textarea name="terminal_connector_check" rows="3" placeholder="OK / Not OK" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
        </div>

        <!-- Submit & Reset Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-3 pt-2 pb-8">
            <button type="reset"
                class="w-full sm:w-auto px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition">
                Reset
            </button>
            <button type="submit"
                class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition">
                Save 132KV CT-IR Inspection
            </button>
        </div>

    </form>
</div>
