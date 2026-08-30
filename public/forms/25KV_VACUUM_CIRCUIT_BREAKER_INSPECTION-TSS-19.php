<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSS-25KV VACUUM CIRCUIT BREAKER INSPECTION</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 py-8">

<div class="max-w-6xl mx-auto px-4">
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-19</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-25KV VACUUM CIRCUIT BREAKER INSPECTION</div>
    </div>
<!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            25KV VCB Inspection
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <!-- Form -->
    <form action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" method="POST" class="space-y-6">

        <!-- Basic Information Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- A -->
                

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
                        5. External condition (check porcelain carefully) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="external_condition" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 6 (First instance) -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">
                        6. Name of the (Make) <span class="text-red-500">*</span>
                    </label>
                    <select name="vcb_make_dropdown" required class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Select</option>
                        <option value="ALIND">ALIND</option>
                        <option value="BHEL">BHEL</option>
                        <option value="Alind">Alind</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 6. Insulation Resistance (with 2.5/5kv Megger) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                6. Insulation Resistance (with 2.5/5kv Megger) for ALIND, BHEL, Alind as per TI/MI/0054 / OEM
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">6.1 a) Top to bottom: <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="ir_top_to_bottom" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">6.2 b) Top to earth: <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="ir_top_to_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">6.3 c) Bottom to earth: <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="ir_bottom_to_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">6.4 d) Top to Bottom to Earth (CB Close) <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="ir_top_bottom_earth_close" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- 9. Insulation Resistance/Resistance (with 500V Megger) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                9. Insulation Resistance/Resistance (with 500V Megger)
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">9.1 a) Spring charging motor with earth <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="res_motor_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">9.2 b) Closing coil resistance <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="res_closing_coil" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">9.3 c) Trip coil resistance <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="res_trip_coil" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">9.4 d) Spring charging Time Of motor <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="res_charging_time" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- 10. Contact Resistance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                10. Contact resistance as per TI/MI/0054
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">10.1 ALIND <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="cr_alind" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">10.2 Megawin <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="cr_megawin" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">10.3 BHEL <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="cr_bhel" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- 11 to 14. Operating Time -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                11. Operating time as per TI/MI/0054 / OEM
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- 12. Alind Make -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <h4 class="text-sm font-semibold text-gray-700 mb-4">12. Alind Make</h4>
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <label class="text-sm font-medium text-gray-700 mb-2">12.1 a) Closing <span class="text-red-500">*</span></label>
                            <input type="number" step="any" name="alind_closing" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-sm font-medium text-gray-700 mb-2">12.2 b) Opening <span class="text-red-500">*</span></label>
                            <input type="number" step="any" name="alind_opening" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- 13. VANS Make -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <h4 class="text-sm font-semibold text-gray-700 mb-4">13. VANS Make as per OEM</h4>
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <label class="text-sm font-medium text-gray-700 mb-2">13.1 a) Closing <span class="text-red-500">*</span></label>
                            <input type="number" step="any" name="vans_closing" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-sm font-medium text-gray-700 mb-2">13.2 b) Opening <span class="text-red-500">*</span></label>
                            <input type="number" step="any" name="vans_opening" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- 14. Megawin Make -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <h4 class="text-sm font-semibold text-gray-700 mb-4">14. Megawin Make</h4>
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <label class="text-sm font-medium text-gray-700 mb-2">14.1 a) Closing <span class="text-red-500">*</span></label>
                            <input type="number" step="any" name="megawin_closing" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-sm font-medium text-gray-700 mb-2">14.2 b) Opening <span class="text-red-500">*</span></label>
                            <input type="number" step="any" name="megawin_opening" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- 15 to 21. Key & Travel Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 15 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">15. Key No. <span class="text-red-500">*</span></label>
                    <input type="text" name="key_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 16 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">16. Wipe (W1-W2) for Alind <span class="text-red-500">*</span></label>
                    <input type="text" name="wipe_w1_w2" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 17 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">17. W1 <span class="text-red-500">*</span></label>
                    <input type="text" name="w1" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 18 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">18. W2 <span class="text-red-500">*</span></label>
                    <input type="text" name="w2" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 19 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">19. Travel (T1-T2) for Alind <span class="text-red-500">*</span></label>
                    <input type="text" name="travel_t1_t2" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 20 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">20. T1 <span class="text-red-500">*</span></label>
                    <input type="text" name="t1" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 21 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">21. T2 <span class="text-red-500">*</span></label>
                    <input type="text" name="t2" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- 22 to 31. Other Checks & Megger Info -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- 22 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">22. Local/Remote operation <span class="text-red-500">*</span></label>
                    <input type="text" name="local_remote_op" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 23 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">23. Duplicate earth and earth continuity <span class="text-red-500">*</span></label>
                    <input type="text" name="duplicate_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 24 -->
                <div class="flex flex-col md:col-span-2">
                    <label class="text-sm font-medium text-gray-700 mb-2">24. Terminal connection (check for tightness) <span class="text-red-500">*</span></label>
                    <textarea name="terminal_connection" rows="2" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                </div>

                <!-- 25 -->
                <div class="flex flex-col md:col-span-2">
                    <label class="text-sm font-medium text-gray-700 mb-2">25. Check for <span class="text-red-500">*</span></label>
                    <textarea name="check_for" rows="2" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                </div>

                <!-- 26 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">26. Mechanical tripping & closing <span class="text-red-500">*</span></label>
                    <input type="text" name="mech_tripping_closing" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 27 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">27. Heater circuit <span class="text-red-500">*</span></label>
                    <input type="text" name="heater_circuit" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 28 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">28. Counter <span class="text-red-500">*</span></label>
                    <input type="text" name="counter" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 29 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">29. Megger Used <span class="text-red-500">*</span></label>
                    <input type="text" name="megger_used" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 30 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">30. a) Make <span class="text-red-500">*</span></label>
                    <input type="text" name="megger_make" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- 31 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">31. b) Serial No. <span class="text-red-500">*</span></label>
                    <input type="text" name="megger_serial_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-4 pt-2 pb-8">
            <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition-colors">
                Reset
            </button>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors">
                Save 25KV VCB Inspection
            </button>
        </div>

    </form>
</div>

</body>
</html>