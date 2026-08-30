
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">SSP-05</strong></div>
        <div style="font-size:12px; opacity:.9;">SSP-BATTERY BANK INSPECTION & CELL TESTING</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Battery Bank Inspection & Cell Testing
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the battery details and individual cell specific gravity & voltage readings (Cell No. 1 to 55). All marked fields are mandatory.
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

        <!-- Section 4: Battery Cells (Cell No. 1 to 55) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                4. Battery Temp. - 37°C Readings
            </h2>
            <p class="text-sm text-gray-500 mb-5">Enter Specific Gravity and Voltage for each cell (Cell No. 1 to 55).</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <!-- Loop for Cell No. 1 to 55 -->
                <!-- Cells 1 to 55 generated efficiently -->
                <script>
                    // Dynamic generation block or static repetition for all 55 cells
                </script>

                <!-- I will include all 55 cells clearly structured -->
                <!-- Let's render the template loop blocks for cells 1 through 55 -->
                <!-- Note: Due to length, explicit HTML blocks are provided below -->
                
                <!-- Cell 1 - 55 -->
                <!-- (To keep the code clean and fully functional, loop rendering or explicit blocks are added) -->

                <!-- For demonstration and complete coverage, here are cells 1 to 55 blocks -->
                <!-- Copying template structure for each cell -->
                
                <!-- We can loop through 1 to 55 in PHP if used dynamically, but here is standard clean HTML markup for all cells -->
                
                <!-- Cell 1 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 1</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_1_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_1_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 2 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 2</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_2_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_2_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 3 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 3</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_3_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_3_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 4 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 4</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_4_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_4_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 5 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 5</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_5_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_5_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 6 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 6</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_6_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_6_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 7 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 7</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_7_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_7_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 8 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 8</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_8_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_8_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 9 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 9</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_9_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_9_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 10 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 10</span>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <input type="number" step="any" name="cell_10_gravity" placeholder="Sp. Gravity" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <input type="number" step="any" name="cell_10_voltage" placeholder="Voltage (V)" required
                                class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Cell 11 to 20 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 11</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_11_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_11_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 12</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_12_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_12_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 13</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_13_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_13_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 14</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_14_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_14_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 15</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_15_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_15_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 16</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_16_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_16_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 17</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_17_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_17_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 18</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_18_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_18_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 19</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_19_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_19_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 20</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_20_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_20_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>

                <!-- Cell 21 to 30 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 21</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_21_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_21_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 22</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_22_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_22_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 23</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_23_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_23_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 24</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_24_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_24_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 25</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_25_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_25_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 26</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_26_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_26_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 27</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_27_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_27_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 28</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_28_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_28_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 29</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_29_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_29_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 30</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_30_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_30_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>

                <!-- Cell 31 to 40 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 31</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_31_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_31_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 32</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_32_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_32_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 33</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_33_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_33_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 34</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_34_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_34_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 35</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_35_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_35_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 36</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_36_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_36_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 37</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_37_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_37_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 38</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_38_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_38_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 39</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_39_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_39_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 40</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_40_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_40_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>

                <!-- Cell 41 to 55 -->
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 41</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_41_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_41_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 42</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_42_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_42_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 43</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_43_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_43_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 44</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_44_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_44_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 45</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_45_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_45_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 46</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_46_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_46_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 47</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_47_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_47_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 48</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_48_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_48_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 49</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_49_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_49_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 50</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_50_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_50_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 51</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_51_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_51_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 52</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_52_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_52_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 53</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_53_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_53_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 54</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_54_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_54_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>
                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200"><span class="block font-medium text-gray-700 mb-2 text-xs">Cell No. 55</span><div class="grid grid-cols-2 gap-2"><input type="number" step="any" name="cell_55_gravity" placeholder="Sp. Gravity" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"><input type="number" step="any" name="cell_55_voltage" placeholder="Voltage" required class="w-full px-2.5 py-2 border border-gray-300 rounded-md text-xs bg-white outline-none"></div></div>

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
                Save Battery Report
            </button>
        </div>

    </form>
</div>
