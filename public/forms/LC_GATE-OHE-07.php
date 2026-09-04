<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC Gate Inspection Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">OHE-07</strong></div>
        <div style="font-size:12px; opacity:.9;">OHE-LC GATE INSPECTION REPORT</div>
    </div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            LC Gate Inspection Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the level crossing gate details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Gate Identification <span class="text-red-500">*</span></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">1. Location of Level Crossing <span class="text-red-500">*</span></label>
                    <input type="text" name="location_lc" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">2. Gate No <span class="text-red-500">*</span></label>
                    <input type="text" name="gate_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">3. High rise or Conventional <span class="text-red-500">*</span></label>
                    <input type="text" name="rise_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">4. Date of Checking <span class="text-red-500">*</span></label>
                    <input type="date" name="date_checking" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Clearance & Ground Parameters <span class="text-red-500">*</span></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">5. Height of Contact wire <span class="text-red-500">*</span></label>
                    <input type="text" name="height_contact_wire" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">6. Condition of Height Gauge <span class="text-red-500">*</span></label>
                    <input type="text" name="condition_height_gauge" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">7. Level of Road below rail level <span class="text-red-500">*</span></label>
                    <input type="text" name="level_road_below_rail" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Bonding & Earth Pit <span class="text-red-500">*</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">8. Condition of Bonding</span>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Good or Bad</label>
                            <input type="text" name="bonding_quality" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Intact or not</label>
                            <input type="text" name="bonding_intact" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">9. Condition of earth pit and value</span>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Good/Bad</label>
                            <input type="text" name="earth_pit_cond" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Value in Ohm</label>
                            <input type="text" name="earth_pit_value" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">10. Whether manned or unmanned <span class="text-red-500">*</span></label>
                    <input type="text" name="manned_status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">11. Provision of 25 KV caution board <span class="text-red-500">*</span></label>
                    <input type="text" name="caution_board" placeholder="of 25 KV caution board" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">12. Remarks <span class="text-red-500">*</span></label>
                <textarea name="remarks" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
            </div>
        </div>

        <div class="flex justify-center gap-3 pt-2 pb-8">
            <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition">Reset</button>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">Save Report</button>
        </div>
    </form>
</div>
</body>
</html>