
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-06</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-132/27 KV TRF RATIO AND WINDING RESISTANCE INSPECTION</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            132/27 KV TRF Ratio and Winding Resistance Inspection
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the transformer testing details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- General Details (Capacity, Make, Rly ID, Manufacturer, etc.) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- 0.1 Capacity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Capacity (MVA) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="capacity" placeholder="e.g. 20/25 MVA" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 0.2 Make -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="make" placeholder="text" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 1. Rly Identification No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Rly Identification No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rly_identification_no" placeholder="text" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 2. Manufacturer -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Manufacturer <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="manufacturer" placeholder="text" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 3. Manufacturer Sl. No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Manufacturer Sl. No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="manufacturer_sl_no" placeholder="text" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4. Year of Manufacture -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Year of Manufacture <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="year_of_manufacture" placeholder="e.g. 2020" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- SR 5: Ratio Test (Tap 1 to Tap 6) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                5. Ratio Test (Tap 1 to Tap 6) <span class="text-red-500">*</span>
            </h2>

            <div class="space-y-4">
                <!-- Tap 1 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 1</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">HV Side (V)</label>
                            <input type="number" step="any" name="tap1_hv_side" required placeholder="HV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">LV Side (V)</label>
                            <input type="number" step="any" name="tap1_lv_side" required placeholder="LV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (HV + LV or Ratio)</label>
                            <input type="number" step="any" name="tap1_conclusion" required placeholder="e.g. Sum or Ratio"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 2 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 2</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">HV Side (V)</label>
                            <input type="number" step="any" name="tap2_hv_side" required placeholder="HV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">LV Side (V)</label>
                            <input type="number" step="any" name="tap2_lv_side" required placeholder="LV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (HV + LV or Ratio)</label>
                            <input type="number" step="any" name="tap2_conclusion" required placeholder="e.g. Sum or Ratio"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 3 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 3</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">HV Side (V)</label>
                            <input type="number" step="any" name="tap3_hv_side" required placeholder="HV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">LV Side (V)</label>
                            <input type="number" step="any" name="tap3_lv_side" required placeholder="LV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (HV + LV or Ratio)</label>
                            <input type="number" step="any" name="tap3_conclusion" required placeholder="e.g. Sum or Ratio"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 4 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 4</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">HV Side (V)</label>
                            <input type="number" step="any" name="tap4_hv_side" required placeholder="HV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">LV Side (V)</label>
                            <input type="number" step="any" name="tap4_lv_side" required placeholder="LV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (HV + LV or Ratio)</label>
                            <input type="number" step="any" name="tap4_conclusion" required placeholder="e.g. Sum or Ratio"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 5 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 5</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">HV Side (V)</label>
                            <input type="number" step="any" name="tap5_hv_side" required placeholder="HV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">LV Side (V)</label>
                            <input type="number" step="any" name="tap5_lv_side" required placeholder="LV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (HV + LV or Ratio)</label>
                            <input type="number" step="any" name="tap5_conclusion" required placeholder="e.g. Sum or Ratio"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 6 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 6</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">HV Side (V)</label>
                            <input type="number" step="any" name="tap6_hv_side" required placeholder="HV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">LV Side (V)</label>
                            <input type="number" step="any" name="tap6_lv_side" required placeholder="LV Side (V)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (HV + LV or Ratio)</label>
                            <input type="number" step="any" name="tap6_conclusion" required placeholder="e.g. Sum or Ratio"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 6: Winding Resistance Test (Tap 1 to Tap 6, 3 Phases + Conclusion) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                6. Winding Resistance Test (at ____ °C) <span class="text-red-500">*</span>
            </h2>

            <div class="space-y-4">
                <!-- Tap 1 Winding -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 1 - Phases</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 1.1 & 1.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap1_p1" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 2.1 & 2.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap1_p2" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 3.1 & 3.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap1_p3" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (Sum/Avg)</label>
                            <input type="number" step="any" name="wnd_tap1_conclusion" required placeholder="Sum or Average"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 2 Winding -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 2 - Phases</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 1.1 & 1.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap2_p1" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 2.1 & 2.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap2_p2" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 3.1 & 3.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap2_p3" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (Sum/Avg)</label>
                            <input type="number" step="any" name="wnd_tap2_conclusion" required placeholder="Sum or Average"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 3 Winding -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 3 - Phases</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 1.1 & 1.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap3_p1" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 2.1 & 2.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap3_p2" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 3.1 & 3.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap3_p3" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (Sum/Avg)</label>
                            <input type="number" step="any" name="wnd_tap3_conclusion" required placeholder="Sum or Average"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 4 Winding -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 4 - Phases</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 1.1 & 1.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap4_p1" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 2.1 & 2.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap4_p2" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 3.1 & 3.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap4_p3" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (Sum/Avg)</label>
                            <input type="number" step="any" name="wnd_tap4_conclusion" required placeholder="Sum or Average"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 5 Winding -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 5 - Phases</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 1.1 & 1.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap5_p1" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 2.1 & 2.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap5_p2" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 3.1 & 3.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap5_p3" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (Sum/Avg)</label>
                            <input type="number" step="any" name="wnd_tap5_conclusion" required placeholder="Sum or Average"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tap 6 Winding -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">Tap 6 - Phases</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 1.1 & 1.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap6_p1" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 2.1 & 2.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap6_p2" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Phase 3.1 & 3.2 (mΩ)</label>
                            <input type="number" step="any" name="wnd_tap6_p3" required placeholder="mΩ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Conclusion (Sum/Avg)</label>
                            <input type="number" step="any" name="wnd_tap6_conclusion" required placeholder="Sum or Average"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 7: Dielectric Strength of Oil -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                7. Dielectric Strength of Oil
            </h2>
            <p class="text-sm text-gray-500 mb-5">Minimum- 70 kV as per ACTM Vol-II, Part-I para No-20207, Sphere gap 2.5 mm</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
                <!-- Reading 1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        i. Reading 1 (kV) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" min="0" step="any" name="oil_reading_1" required placeholder="kV"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">kV</span>
                    </div>
                </div>

                <!-- Reading 2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        ii. Reading 2 (kV) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" min="0" step="any" name="oil_reading_2" required placeholder="kV"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">kV</span>
                    </div>
                </div>

                <!-- Reading 3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        iii. Reading 3 (kV) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" min="0" step="any" name="oil_reading_3" required placeholder="kV"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">kV</span>
                    </div>
                </div>

                <!-- Reading 4 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        iv. Reading 4 (kV) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" min="0" step="any" name="oil_reading_4" required placeholder="kV"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">kV</span>
                    </div>
                </div>

                <!-- Average -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Average (kV) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" min="70" step="any" name="oil_average" placeholder="≥ 70 kV" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">kV</span>
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
                Save Transformer Test Report
            </button>
        </div>

    </form>
</div>
