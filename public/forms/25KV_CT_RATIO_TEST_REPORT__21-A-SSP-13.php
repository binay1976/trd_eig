
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">SSP-13</strong></div>
        <div style="font-size:12px; opacity:.9;">SSP-25KV CT RATIO TEST REPORT (21-A)</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            25KV CT Ratio Test Report (2/1A)
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the Current Transformer ratio test details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- General Details (Station Type & Sr 1-3) -->
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

                <!-- 3. Maker’s Sl. No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Maker’s Sl. No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="maker_sl_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- Section 6: CT Ratio Test - 2/1A (Core 1) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                6. CT Ratio Test - 2/1A
            </h2>
            <p class="text-sm text-gray-500 mb-5">Primary and Secondary Core injection values for 2/1A ratio.</p>

            <div class="space-y-4">
                <!-- 6.1 2/1A a -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">6.1 2/1A - Phase / Core a</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">CURRENT INJECTED (PRI.CURRENT(A))</label>
                            <input type="number" step="any" name="ratio_2_1a_a_pri" required placeholder="Pri Current (A)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">SEC.CURRENT(A) CORE1 (1S1/1S2) Measured Value</label>
                            <input type="number" step="any" name="ratio_2_1a_a_measured" required placeholder="Measured Value"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">SEC.CURRENT(A) CORE1 (1S1/1S2) Calculated Value</label>
                            <input type="number" step="any" name="ratio_2_1a_a_calculated" required placeholder="Calculated Value"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 6.2 2/1A b -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">6.2 2/1A - Phase / Core b</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">CURRENT INJECTED (PRI.CURRENT(A))</label>
                            <input type="number" step="any" name="ratio_2_1a_b_pri" required placeholder="Pri Current (A)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">SEC.CURRENT(A) CORE1 (1S1/1S2) Measured Value</label>
                            <input type="number" step="any" name="ratio_2_1a_b_measured" required placeholder="Measured Value"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">SEC.CURRENT(A) CORE1 (1S1/1S2) Calculated Value</label>
                            <input type="number" step="any" name="ratio_2_1a_b_calculated" required placeholder="Calculated Value"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- 6.3 2/1A c -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">6.3 2/1A - Phase / Core c</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">CURRENT INJECTED (PRI.CURRENT(A))</label>
                            <input type="number" step="any" name="ratio_2_1a_c_pri" required placeholder="Pri Current (A)"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">SEC.CURRENT(A) CORE1 (1S1/1S2) Measured Value</label>
                            <input type="number" step="any" name="ratio_2_1a_c_measured" required placeholder="Measured Value"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">SEC.CURRENT(A) CORE1 (1S1/1S2) Calculated Value</label>
                            <input type="number" step="any" name="ratio_2_1a_c_calculated" required placeholder="Calculated Value"
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
                Save 25KV CT Ratio Test (2/1A) Report
            </button>
        </div>

    </form>
</div>
