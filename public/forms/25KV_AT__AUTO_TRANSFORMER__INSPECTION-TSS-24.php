
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-24</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-25KV AT (AUTO TRANSFORMER) INSPECTION</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            25KV AT (Auto Transformer) Inspection
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- General Details: Station Type & Sr 1-5 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- 1. Identification No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Identification No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="identification_no" required
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

                <!-- 4. Manufacturer's Year -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Manufacturer's Year <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="manufactures_year" placeholder="YYYY" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 5. Rating -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5. Rating <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rating" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>

            <!-- 6. Insulator Condition -->
            <div class="mt-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    6. Insulator (Check Condition) <span class="text-red-500">*</span>
                </label>
                <input type="text" name="insulator_condition" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>
        </div>

        <!-- SR 7: Insulation Resistance (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                7. Insulation resistance between (as per OEM)
            </h2>
            <p class="text-sm text-gray-500 mb-5">Ensure prescribed tester voltage limits are applied.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- 7.1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7.1 a) Pri to sec (2.5kV) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="pri_to_sec_ir" min="200" step="any" placeholder="≥ 200 MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 7.2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7.2 b) Pri to earth (2.5kV) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="pri_to_earth_ir" min="200" step="any" placeholder="≥ 200 MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 7.3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7.3 c) Sec to earth (500V) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="sec_to_earth_ir" min="2" step="any" placeholder="≥ 2 MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 8-10: Earth & Tapping -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8. Duplicate earth & continuity <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="duplicate_earth_continuity" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9. Earthing tightness & condition <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="earthing_tightness_condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10. Tapping on secondary side <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="tapping_secondary_side" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 11: Ratio Test Group (T1 to T4) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                11. Ratio Test (T1 to T4) <span class="text-red-500">*</span>
            </h2>

            <div class="space-y-6">
                <!-- Loop for T1 to T4 -->
                <!-- 11.1 T1 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3">11.1 Ratio test (For T1)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Pri Volt (V)</label>
                            <input type="number" step="any" name="t1_pri_volt" required placeholder="Pri Volt {v}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Sec Volt (V)</label>
                            <input type="number" step="any" name="t1_sec_volt" required placeholder="Sec Volt {v}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Ratio observed</label>
                            <input type="text" name="t1_ratio_observed" required placeholder="Ratio observed"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 11.2 T2 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3">11.2 Ratio test (For T2)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Pri Volt (V)</label>
                            <input type="number" step="any" name="t2_pri_volt" required placeholder="Pri Volt {v}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Sec Volt (V)</label>
                            <input type="number" step="any" name="t2_sec_volt" required placeholder="Sec Volt {v}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Ratio observed</label>
                            <input type="text" name="t2_ratio_observed" required placeholder="Ratio observed"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 11.3 T3 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3">11.3 Ratio test (For T3)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Pri Volt (V)</label>
                            <input type="number" step="any" name="t3_pri_volt" required placeholder="Pri Volt {v}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Sec Volt (V)</label>
                            <input type="number" step="any" name="t3_sec_volt" required placeholder="Sec Volt {v}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Ratio observed</label>
                            <input type="text" name="t3_ratio_observed" required placeholder="Ratio observed"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 11.4 T4 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3">11.4 Ratio test (For T4)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Pri Volt (V)</label>
                            <input type="number" step="any" name="t4_pri_volt" required placeholder="Pri Volt {v}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Sec Volt (V)</label>
                            <input type="number" step="any" name="t4_sec_volt" required placeholder="Sec Volt {v}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Ratio observed</label>
                            <input type="text" name="t4_ratio_observed" required placeholder="Ratio observed"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 12-17: Oil, Fuses, BDV & Earth Resistance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- 12 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12. Oil level <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="oil_level" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 13 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        13. HV Side Fuse Link Provided <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="hv_side_fuse_link" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 14 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14. LV Side Neutral Grounded <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="lv_side_neutral_grounded" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 15 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        15. BDV of Transformer oil <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="bdv_oil" min="40" step="any" placeholder="≥ 40 KV" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">KV</span>
                    </div>
                </div>

                <!-- 16 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16. Arcing horn gap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="arcing_horn_gap" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 17 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        17. Earth resistance value <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="earth_resistance" max="10" step="any" placeholder="≤ 10 Ohm" required
                            class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">Ohm</span>
                    </div>
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
                Save 25KV AT Inspection
            </button>
        </div>

    </form>
</div>
