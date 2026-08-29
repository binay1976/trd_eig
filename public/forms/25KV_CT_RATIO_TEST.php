<div class="max-w-5xl mx-auto px-4">
    <!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            25KV Interrupter Inspection
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <!-- Form -->
    <form action="actions/save_25kv_interrupter.php" method="POST" class="space-y-6">

        <!-- Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <!-- A -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Name of the <span class="text-red-500">*</span>
                    </label>
                    <select name="name_of" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <option value="">Select</option>
                        <option value="TSS">TSS</option>
                        <option value="SS">SS</option>
                        <option value="SSP">SSP</option>
                    </select>
                </div>

                <!-- 1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Rly. Identification No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rly_identification_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="make" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Maker Sl.No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="maker_sl_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Manufacture's Year <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="manufactures_year" required
                        placeholder="YYYY"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 5 -->
                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        External condition (check porcelain carefully) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="external_condition" rows="3" required
                        placeholder="Enter external condition"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                </div>

                <!-- 6 Make -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Make of the Interrupter <span class="text-red-500">*</span>
                    </label>
                    <select name="interrupter_make" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <option value="">Select Make</option>
                        <option value="ALIND">ALIND</option>
                        <option value="BHEL">BHEL</option>
                        <option value="Megawin">Megawin</option>
                        <option value="VANS">VANS</option>
                    </select>
                </div>

            </div>
        </div>

        <!-- 6 Insulation Resistance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-1">
                6. Insulation Resistance
            </h3>
            <p class="text-xs text-gray-500 mb-5">
                With 2.5/5kV Megger as per TI/MI/0054 / OEM
            </p>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.1 Top to bottom <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="insulation_top_bottom" min="5000" step="any" required
                            placeholder="≥ 5000"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.2 Top to earth <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="insulation_top_earth" min="5000" step="any" required
                            placeholder="≥ 5000"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.3 Bottom to earth <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="insulation_bottom_earth" min="5000" step="any" required
                            placeholder="≥ 5000"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.4 Top to Bottom to Earth (CB Close) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="insulation_top_bottom_earth_cb_close" min="5000" step="any" required
                            placeholder="≥ 5000"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- 10 Contact Resistance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-1">
                10. Contact Resistance
            </h3>
            <p class="text-xs text-gray-500 mb-5">
                As per TI/MI/0054
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        For the same above make <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="contact_resistance" max="50" min="0" step="any" required
                            placeholder="≤ 50"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">µΩ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 11 Operating Time -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-1">
                11. Operating Time
            </h3>
            <p class="text-xs text-gray-500 mb-5">
                As per TI/MI/0054. Write "0" wherever not applicable.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11.1 Alind Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="alind_operating_time" required
                        placeholder="Enter operating time / 0"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12. Closing <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="closing_time" max="120" min="0" step="any" required
                            placeholder="≤ 120"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">ms</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        13. Opening <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="opening_time" max="90" min="0" step="any" required
                            placeholder="≤ 90"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">ms</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- 14 VANS -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                14. VANS Make as per OEM
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14.1 Closing <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="vans_closing" max="80" min="0" step="any" required
                            placeholder="≤ 80"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">ms</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14.2 Opening <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="vans_opening" max="65" min="0" step="any" required
                            placeholder="≤ 65"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">ms</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- 15 Megawin -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                15. Megawin Make
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        15.1 Closing <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="megawin_closing" max="120" min="0" step="any" required
                            placeholder="≤ 120"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">ms</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        15.2 Opening <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="megawin_opening" max="90" min="0" step="any" required
                            placeholder="≤ 90"
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">ms</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- 16 Key No -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                16. Key No.
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.1 Wipe (W1-W2) for Alind <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="wipe_w1_w2" required placeholder="8+1/-0"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.2 W1 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="w1" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.3 W2 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="w2" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.4 Travel (T1-T2) for Alind <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="travel_t1_t2" required placeholder="22±1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.5 T1 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="t1" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16.6 T2 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="t2" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- 17 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                17. Local/Remote operation <span class="text-red-500">*</span>
            </label>
            <input type="text" name="local_remote_operation" required
                placeholder="Enter Local / Remote operation"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
        </div>

        <!-- 18 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                18. Duplicate earth and earth continuity
            </h3>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                18.1 Terminal connection (check for tightness) <span class="text-red-500">*</span>
            </label>

            <textarea name="terminal_connection" rows="3" required
                placeholder="OK / Not OK"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
        </div>

        <!-- 19 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                19. Check for
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        19.1 Mechanical tripping & closing <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="mechanical_tripping_closing" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        19.2 Heater circuit <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="heater_circuit" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        19.3 Counter <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="counter" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- 20 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                20. Megger Used
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        20.1 Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="megger_make" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        20.2 Serial No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="megger_serial_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-center gap-4 pt-2 pb-8">

            <button type="reset"
                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                Reset
            </button>

            <button type="submit"
                class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm">
                Save 25KV Interrupter Inspection
            </button>

        </div>

    </form>

</div>


