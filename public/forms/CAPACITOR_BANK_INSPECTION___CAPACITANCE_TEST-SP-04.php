
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">SP-04</strong></div>
        <div style="font-size:12px; opacity:.9;">SP-CAPACITOR BANK INSPECTION & CAPACITANCE TEST</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Capacitor Bank Inspection & Capacitance Test
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the capacitor bank unit details and measured capacitance values (Sr No. 1 to 33). All marked fields are mandatory.
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

                <!-- 3. Manufacturing Year -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Manufacturing Year <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="manufacturing_year" placeholder="YYYY" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- Section 4: CAP BANK Units (Sr No. 1 to 33) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                4. Capacitor Bank Units Testing
            </h2>
            <p class="text-sm text-gray-500 mb-5">Enter Identification and Measured Capacitance in µF for each unit.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <!-- Loop for Sr No. 1 to 33 -->
                <!-- Units 1 to 10 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 1</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_1_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_1_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 2</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_2_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_2_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 3</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_3_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_3_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 4</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_4_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_4_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 5</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_5_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_5_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 6</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_6_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_6_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 7</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_7_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_7_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 8</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_8_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_8_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 9</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_9_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_9_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 10</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_10_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_10_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <!-- Units 11 to 20 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 11</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_11_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_11_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 12</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_12_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_12_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 13</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_13_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_13_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 14</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_14_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_14_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 15</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_15_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_15_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 16</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_16_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_16_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 17</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_17_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_17_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 18</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_18_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_18_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 19</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_19_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_19_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 20</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_20_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_20_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <!-- Units 21 to 30 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 21</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_21_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_21_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 22</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_22_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_22_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 23</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_23_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_23_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 24</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_24_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_24_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 25</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_25_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_25_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 26</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_26_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_26_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 27</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_27_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_27_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 28</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_28_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_28_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 29</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_29_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_29_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 30</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_30_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_30_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <!-- Units 31 to 33 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 31</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_31_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_31_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 32</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_32_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_32_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Sr no. 33</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="unit_33_id" placeholder="Identification" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="relative">
                            <input type="number" step="any" min="1" name="unit_33_cap" placeholder="µF" required
                                class="w-full px-2.5 py-2 pr-7 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <span class="absolute right-2 top-2 text-gray-400 text-xs">µF</span>
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
                Save Capacitor Bank Report
            </button>
        </div>

    </form>
</div>
