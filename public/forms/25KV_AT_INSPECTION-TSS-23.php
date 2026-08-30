<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSS-25KV AT INSPECTION</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 py-8">

<div class="max-w-6xl mx-auto px-4">
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-23</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-25KV AT INSPECTION</div>
    </div>
<div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            25KV AT Inspection
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" method="POST" class="space-y-6">

        <!-- Basic Data -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">1. Identification No. <span class="text-red-500">*</span></label>
                    <input type="text" name="identification_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">2. Make <span class="text-red-500">*</span></label>
                    <input type="text" name="make" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">3. Maker Sl.No <span class="text-red-500">*</span></label>
                    <input type="text" name="maker_sl_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">4. Manufacter's Year <span class="text-red-500">*</span></label>
                    <input type="text" name="manufacters_year" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">5. Rating <span class="text-red-500">*</span></label>
                    <input type="text" name="rating" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">6. Insulator (Check Condition) <span class="text-red-500">*</span></label>
                    <input type="text" name="insulator_condition" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- 7. Insulation Resistance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">7. Insulation resistance between (as per OEM)</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">7.1 a) Pri to sec (2.5kv) <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="ir_pri_sec" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">7.2 b) Pri to earth (2.5kv) <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="ir_pri_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">7.3 c) Sec to earth (500v) <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="ir_sec_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- 11. Ratio test (Multi-fields) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">11. Ratio test</h3>
            
            <div class="space-y-6">
                <!-- T1 -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 border border-gray-100 rounded-lg bg-gray-50">
                    <div class="sm:col-span-3 text-sm font-semibold text-gray-700">11.1 Ratio test (For T1) <span class="text-red-500">*</span></div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Pri Volt {v}</label>
                        <input type="text" name="t1_pri_volt" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Sec Volt {v}</label>
                        <input type="text" name="t1_sec_volt" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Ratio observed</label>
                        <input type="text" name="t1_ratio" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <!-- T2 -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 border border-gray-100 rounded-lg bg-gray-50">
                    <div class="sm:col-span-3 text-sm font-semibold text-gray-700">11.2 Ratio test (For T2) <span class="text-red-500">*</span></div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Pri Volt {v}</label>
                        <input type="text" name="t2_pri_volt" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Sec Volt {v}</label>
                        <input type="text" name="t2_sec_volt" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Ratio observed</label>
                        <input type="text" name="t2_ratio" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <!-- T3 -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 border border-gray-100 rounded-lg bg-gray-50">
                    <div class="sm:col-span-3 text-sm font-semibold text-gray-700">11.3 Ratio test (For T3) <span class="text-red-500">*</span></div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Pri Volt {v}</label>
                        <input type="text" name="t3_pri_volt" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Sec Volt {v}</label>
                        <input type="text" name="t3_sec_volt" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Ratio observed</label>
                        <input type="text" name="t3_ratio" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <!-- T4 -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 border border-gray-100 rounded-lg bg-gray-50">
                    <div class="sm:col-span-3 text-sm font-semibold text-gray-700">11.4 Ratio test (For T4) <span class="text-red-500">*</span></div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Pri Volt {v}</label>
                        <input type="text" name="t4_pri_volt" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Sec Volt {v}</label>
                        <input type="text" name="t4_sec_volt" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-600 mb-1">Ratio observed</label>
                        <input type="text" name="t4_ratio" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Remaining Fields (8 to 17) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">8. Duplicate earth and earth continuity <span class="text-red-500">*</span></label>
                    <input type="text" name="duplicate_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">9. Earthing tightness and general condition <span class="text-red-500">*</span></label>
                    <input type="text" name="earthing_tightness" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">10. No of Tapping on secondary side <span class="text-red-500">*</span></label>
                    <input type="text" name="tapping_secondary" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">12. Oil level <span class="text-red-500">*</span></label>
                    <input type="text" name="oil_level" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">13. HV Side Fuse Link Provided <span class="text-red-500">*</span></label>
                    <input type="text" name="hv_fuse_link" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">14. LV Side Neutral Grounded <span class="text-red-500">*</span></label>
                    <input type="text" name="lv_neutral_grounded" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">15. BDV of Transformer oil <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="bdv_oil" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">16. Arcing horn gap <span class="text-red-500">*</span></label>
                    <input type="text" name="arcing_horn_gap" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">17. Earth resistance value <span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="earth_resistance_value" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <div class="flex justify-center gap-4 pt-2 pb-8">
            <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition-colors">Reset</button>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors">Save 25KV AT</button>
        </div>
    </form>
</div>

</body>
</html>