<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implantation & Foundation Inspection Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">OHE-04</strong></div>
        <div style="font-size:12px; opacity:.9;">OHE-IMPLANTATION & FOUNDATION REPORT</div>
    </div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Implantation & Foundation Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the implantation and foundation check details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Location & Foundation Details <span class="text-red-500">*</span></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">1. Location No. <span class="text-red-500">*</span></label>
                    <input type="text" name="location_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">2. Type of Loc. <span class="text-red-500">*</span></label>
                    <input type="text" name="type_of_loc" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">3. Date of checking <span class="text-red-500">*</span></label>
                    <input type="date" name="date_checking" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">4. Foundation type & condition <span class="text-red-500">*</span></label>
                    <input type="text" name="foundation_type_condition" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">5. Type of soil <span class="text-red-500">*</span></label>
                    <input type="text" name="type_of_soil" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Measurements & Leaning <span class="text-red-500">*</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">6. Implantation</span>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">As per SED</label>
                            <input type="text" name="implantation_sed" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Actual</label>
                            <input type="text" name="implantation_actual" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">7. Step distance (in mm) <span class="text-red-500">*</span></label>
                    <input type="text" name="step_distance" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">8. HRL mark height above rail level <span class="text-red-500">*</span></label>
                    <input type="text" name="hrl_mark_height" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">9. Leaning at Cont. wire level (mm)</span>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Towards track</label>
                            <input type="text" name="leaning_wire_towards" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Away from track</label>
                            <input type="text" name="leaning_wire_away" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">10. Leaning at 1.85 mtr from HRL</span>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Towards track</label>
                            <input type="text" name="leaning_185_towards" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Away from track</label>
                            <input type="text" name="leaning_185_away" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">11. Reason for leaning <span class="text-red-500">*</span></label>
                <input type="text" name="reason_for_leaning" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">12. Action taken <span class="text-red-500">*</span></label>
                <input type="text" name="action_taken" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">13. Name & Signature of Staff / Supervisor <span class="text-red-500">*</span></label>
                <input type="text" name="supervisor_signature" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
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