
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
             &nbsp;<strong style="font-size:15px;">TSS-01</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-132KV SF6 CB INSPECTION</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            132KV SF6 CB Inspection
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- SR 1-5 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                <!-- 1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Identification No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="identification_no"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Make <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="make"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Maker Sl.No <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="maker_sl_no"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Manufacture's Year <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="manufactures_year"
                           placeholder="YYYY"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>

            <!-- 5 -->
            <div class="mt-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    5. External condition (check porcelain carefully)
                    <span class="text-red-500">*</span>
                </label>

                <textarea name="external_condition"
                          rows="3"
                          required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                 outline-none resize-none"></textarea>
            </div>

        </div>


        <!-- SR 6 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <h2 class="text-base sm:text-lg font-semibold text-gray-800">
                6. Insulation Resistance
            </h2>

            <p class="text-sm text-gray-500 mt-1 mb-5">
                With 5kv Megger as per OEM- CGL Manual.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                <!-- 6.1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.1 a) Top to bottom <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <input type="number"
                               name="top_to_bottom"
                               min="1500"
                               step="any"
                               placeholder="≥ 1500 MΩ"
                               required
                               class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">
                            MΩ
                        </span>
                    </div>
                </div>

                <!-- 6.2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.2 b) Top to earth <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <input type="number"
                               name="top_to_earth"
                               min="1500"
                               step="any"
                               placeholder="≥ 1500 MΩ"
                               required
                               class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">
                            MΩ
                        </span>
                    </div>
                </div>

                <!-- 6.3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.3 c) Bottom to earth <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <input type="number"
                               name="bottom_to_earth"
                               min="1500"
                               step="any"
                               placeholder="≥ 1500 MΩ"
                               required
                               class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">
                            MΩ
                        </span>
                    </div>
                </div>

                <!-- 6.4 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6.4 d) Top to Bottom to Earth (CB Close)
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <input type="number"
                               name="top_bottom_earth_cb_close"
                               min="1500"
                               step="any"
                               placeholder="≥ 1500 MΩ"
                               required
                               class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">
                            MΩ
                        </span>
                    </div>
                </div>

            </div>
        </div>


        <!-- SR 7 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                7. Breaker operating time as per OEM- CGL manual
                <span class="text-red-500">*</span>
            </label>

            <input type="text"
                   name="breaker_operating_time"
                   required
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

        </div>


        <!-- SR 8 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                8. CGL Make
            </h2>

            <p class="text-sm text-gray-500 mb-5">
                Write "0" wherever is not applicable
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- 8.1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.1 Close (ms) <span class="text-red-500">*</span>
                    </label>

                    <input type="number"
                           name="cgl_close"
                           max="130"
                           step="any"
                           placeholder="≤ 130"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 8.2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.2 Open (ms) <span class="text-red-500">*</span>
                    </label>

                    <input type="number"
                           name="cgl_open"
                           max="30"
                           step="any"
                           placeholder="≤ 30"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 8.3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8.3 Contact resistance (µΩ)
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="cgl_contact_resistance"
                           placeholder="50"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>


        <!-- SR 9 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                9. ABB Make
            </h2>

            <p class="text-sm text-gray-500 mb-5">
                Write "0" wherever is not applicable
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- 9.1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.1 Close (ms) <span class="text-red-500">*</span>
                    </label>

                    <input type="number"
                           name="abb_close"
                           max="75"
                           step="any"
                           placeholder="≤ 75 ms"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 9.2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.2 Open (ms) <span class="text-red-500">*</span>
                    </label>

                    <input type="number"
                           name="abb_open"
                           max="45"
                           step="any"
                           placeholder="≤ 45 ms"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 9.3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9.3 Contact resistance (µΩ)
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="abb_contact_resistance"
                           placeholder="42"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>


        <!-- SR 10-11 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- 10 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        10. Local/Remote operation
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="local_remote_operation"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 11 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11. Duplicate earth and earth continuity
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="duplicate_earth_continuity"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>


        <!-- SR 12 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                12. Terminal connection (check for tightness and general condition)
                <span class="text-red-500">*</span>
            </label>

            <textarea name="terminal_connection"
                      rows="3"
                      placeholder="OK / Not OK"
                      required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg
                             focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                             outline-none resize-none"></textarea>

        </div>


        <!-- SR 13 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                13. Check for <span class="text-red-500">*</span>
            </label>

            <textarea name="check_for"
                      rows="3"
                      required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg
                             focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                             outline-none resize-none"></textarea>

        </div>


        <!-- SR 14-18 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- 14 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14. Mechanical tripping & closing
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="mechanical_tripping_closing"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 15 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        15. Heater circuit
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="heater_circuit"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 16 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        16. DC fail test (condensor tripping)
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="dc_fail_test"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 17 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        17. Counter <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="counter"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 18 -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        18. Interlocking CB with associated Isolator
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="interlocking_cb_isolator"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>


        <!-- SR 19-23 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- 19 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        19. SF6 gas pressure (CGL & ABB)
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="sf6_gas_pressure"
                           placeholder="6.5 kg/cm²"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 20 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        20. Alarm at 6.5 kg/cm²
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="alarm_at_6_5"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 21 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        21. Lock out at 6.0
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="lock_out_at_6_0"
                           placeholder="kg/cm²"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 22 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        22. Gas Leakage test
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="gas_leakage_test"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 23 -->
                <div class="sm:col-span-2 lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        23. Healthiness of heaters in housing
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="heater_healthiness"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>


        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-3 pt-2 pb-8">

            <button type="reset"
                    class="w-full sm:w-auto px-6 py-3 bg-gray-200 text-gray-700
                           rounded-lg hover:bg-gray-300 font-medium transition">
                Reset
            </button>

            <button type="submit"
                    class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white
                           rounded-lg hover:bg-blue-700 font-medium shadow-sm transition">
                Save 132KV SF6 CB Inspection
            </button>

        </div>

    </form>

</div>
