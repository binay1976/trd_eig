
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">SSP-06</strong></div>
        <div style="font-size:12px; opacity:.9;">SSP-TRANSFORMER INSULATION & POLARIZATION INDEX TEST</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Transformer Insulation & Polarization Index Test Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the insulation and PI test details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- General Details (Station Type & Sr A to 8) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

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

                <!-- 3. Maker's Sl. No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Maker’s Sl. No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="maker_sl_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4. MVA Rating -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. MVA Rating <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="mva_rating" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 5. Year of Manufacture -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5. Year of Manufacture <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="year_of_manufacture" placeholder="YYYY" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 6. Type of Cooling -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6. Type of Cooling <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="type_of_cooling" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 7. Tap changer -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7. Tap changer <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="tap_changer" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 8. Normal position of tap -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8. Normal position of tap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="normal_position_of_tap" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- SR 9: Megger used -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                9. Megger Used <span class="text-red-500">*</span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.1 a) Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="megger_make" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.2 b) Sr. No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="megger_sr_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- SR 2: Insulation Resistance of Windings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                2. Insulation Resistance of Windings
            </h2>
            <p class="text-sm text-gray-500 mb-5">As per ACTM Vol-I Pt-I Para 20907</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        i. HV — Earth <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" min="2000" step="any" name="ir_hv_earth" placeholder="≥ 2000 MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        ii. LV — Earth <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" min="400" step="any" name="ir_lv_earth" placeholder="≥ 400 MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        iii. HV — LV <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" min="2500" step="any" name="ir_hv_lv" placeholder="≥ 2500 MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 3: PI value -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                3. PI value (Polarization Index)
            </h2>
            <p class="text-sm text-gray-500 mb-5">As per ACTM Vol-II, Part-I para No-20907</p>

            <div class="space-y-6">
                <!-- 3.1 i. HV — Earth -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">3.1 i. HV — Earth</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">IR 10sec (MΩ)</label>
                            <input type="number" step="any" name="pi_hv_earth_10s" required placeholder="IR 10sec"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">IR 60sec (MΩ)</label>
                            <input type="number" step="any" name="pi_hv_earth_60s" required placeholder="IR 60sec"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">IR 600sec (MΩ)</label>
                            <input type="number" step="any" name="pi_hv_earth_600s" required placeholder="IR 600sec"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">PI = R60/R10 (>1.4)</label>
                            <input type="number" step="any" name="pi_hv_earth_r60_r10" required placeholder="> 1.4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">PI = R600/R60 (>1.2)</label>
                            <input type="number" step="any" name="pi_hv_earth_r600_r60" required placeholder="> 1.2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 3.2 ii. LV — Earth -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">3.2 ii. LV — Earth</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">IR 10sec (MΩ)</label>
                            <input type="number" step="any" name="pi_lv_earth_10s" required placeholder="IR 10sec"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">IR 60sec (MΩ)</label>
                            <input type="number" step="any" name="pi_lv_earth_60s" required placeholder="IR 60sec"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">IR 600sec (MΩ)</label>
                            <input type="number" step="any" name="pi_lv_earth_600s" required placeholder="IR 600sec"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">PI = R60/R10 (>1.4)</label>
                            <input type="number" step="any" name="pi_lv_earth_r60_r10" required placeholder="> 1.4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">PI = R600/R60 (>1.2)</label>
                            <input type="number" step="any" name="pi_lv_earth_r600_r60" required placeholder="> 1.2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 3.3 iii. HV — LV -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">3.3 iii. HV — LV</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">IR 10sec (MΩ)</label>
                            <input type="number" step="any" name="pi_hv_lv_10s" required placeholder="IR 10sec"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">IR 60sec (MΩ)</label>
                            <input type="number" step="any" name="pi_hv_lv_60s" required placeholder="IR 60sec"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">IR 600sec (MΩ)</label>
                            <input type="number" step="any" name="pi_hv_lv_600s" required placeholder="IR 600sec"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">PI = R60/R10 (>1.4)</label>
                            <input type="number" step="any" name="pi_hv_lv_r60_r10" required placeholder="> 1.4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">PI = R600/R60 (>1.2)</label>
                            <input type="number" step="any" name="pi_hv_lv_r600_r60" required placeholder="> 1.2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 4: HV Bushings Insulation Resistance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                4. HV Bushings (condenser type) - HV Insulation Resistance
            </h2>
            <p class="text-sm text-gray-500 mb-5">With 5000V Megger w.r.t. earth (> 10000 MΩ as per ACTM Vol-II, Part-I Para 20905)</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- 4.1 i. 1.1 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">i. 1.1</span>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Obtained Value (MΩ)</label>
                            <div class="relative">
                                <input type="number" min="10000" step="any" name="bushings_1_1_value" required placeholder="≥ 10000"
                                    class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2 text-gray-500 text-xs">MΩ</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Remarks</label>
                            <input type="text" name="bushings_1_1_remarks" required placeholder="Remarks"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 4.2 ii. 1.2 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">ii. 1.2</span>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Obtained Value (MΩ)</label>
                            <div class="relative">
                                <input type="number" min="10000" step="any" name="bushings_1_2_value" required placeholder="≥ 10000"
                                    class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2 text-gray-500 text-xs">MΩ</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Remarks</label>
                            <input type="text" name="bushings_1_2_remarks" required placeholder="Remarks"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 4.3 iii. 2.1 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">iii. 2.1</span>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Obtained Value (MΩ)</label>
                            <div class="relative">
                                <input type="number" min="10000" step="any" name="bushings_2_1_value" required placeholder="≥ 10000"
                                    class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2 text-gray-500 text-xs">MΩ</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Remarks</label>
                            <input type="text" name="bushings_2_1_remarks" required placeholder="Remarks"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 4.4 iv. 2.2 -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">iv. 2.2</span>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Obtained Value (MΩ)</label>
                            <div class="relative">
                                <input type="number" min="10000" step="any" name="bushings_2_2_value" required placeholder="≥ 10000"
                                    class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2 text-gray-500 text-xs">MΩ</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Remarks</label>
                            <input type="text" name="bushings_2_2_remarks" required placeholder="Remarks"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
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
