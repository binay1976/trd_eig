<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Collection (Oliver-G) Inspection Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">OHE-02</strong></div>
        <div style="font-size:12px; opacity:.9;">OHE-CURRENT COLLECTION (OLIVER-G) REPORT</div>
    </div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Current Collection (Oliver-G) Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the current collection flashing and inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Train & Journey Details <span class="text-red-500">*</span></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">1. Date <span class="text-red-500">*</span></label>
                    <input type="date" name="date" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">2. Timing <span class="text-red-500">*</span></label>
                    <input type="time" name="timing" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">3. Train No <span class="text-red-500">*</span></label>
                    <input type="text" name="train_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">4. Train departure <span class="text-red-500">*</span></label>
                    <input type="text" name="train_departure" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">5. Train Arrival <span class="text-red-500">*</span></label>
                    <input type="text" name="train_arrival" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">7. Loco No. & Base <span class="text-red-500">*</span></label>
                    <input type="text" name="loco_no_base" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">8. By whom done <span class="text-red-500">*</span></label>
                    <input type="text" name="by_whom_done" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">9. Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <span class="block font-medium text-gray-700 mb-3 text-sm">6. Section</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">From</label>
                        <input type="text" name="section_from" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">To</label>
                        <input type="text" name="section_to" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Flashing Analysis & Intensity (Mega Pixel Units) <span class="text-red-500">*</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 sm:col-span-3">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">10. Flashes in Mega Pixel Units</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">High Intensity</label>
                            <input type="text" name="flash_high_intensity" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">> 100 units (Red Colour)</label>
                            <input type="text" name="flash_red_colour" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Medium Intensity</label>
                            <input type="text" name="flash_medium_intensity" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">11. Blue Colour (60-100 units) <span class="text-red-500">*</span></label>
                    <input type="text" name="flash_blue_colour" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">12. White Colour (40-60 units) <span class="text-red-500">*</span></label>
                    <input type="text" name="flash_white_colour" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">13. Date of attending high intensity <span class="text-red-500">*</span></label>
                    <input type="date" name="date_attending_high" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">14. Date of attending medium intensity (fortnight) <span class="text-red-500">*</span></label>
                    <input type="date" name="date_attending_medium_fortnight" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">15. Date of attending medium intensity (month) <span class="text-red-500">*</span></label>
                    <input type="date" name="date_attending_medium_month" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">16. Reason of flashing <span class="text-red-500">*</span></label>
                <input type="text" name="reason_of_flashing" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">17. Remarks <span class="text-red-500">*</span></label>
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