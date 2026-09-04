<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overline Structure Inspection Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">OHE-09</strong></div>
        <div style="font-size:12px; opacity:.9;">OHE-OVERLINE STRUCTURE (OLS) INSPECTION REPORT</div>
    </div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Overline Structure (OLS) Inspection Report
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the overline structure check and clearance details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">
        <!-- General Location Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Structure Identification <span class="text-red-500">*</span></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">1. Location of OLS from <span class="text-red-500">*</span></label>
                    <input type="text" name="ols_from" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">2. Location of OLS to <span class="text-red-500">*</span></label>
                    <input type="text" name="ols_to" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">3. Type of overline structure <span class="text-red-500">*</span></label>
                    <select name="structure_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select Type</option>
                        <option value="FOB">FOB</option>
                        <option value="ROB">ROB</option>
                        <option value="Railway line">Railway line</option>
                        <option value="Pipeline">Pipeline</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">5. Date of Checking <span class="text-red-500">*</span></label>
                    <input type="date" name="date_checking" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                </div>
            </div>
        </div>

        <!-- Lines & Spans -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Lines & Spans <span class="text-red-500">*</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">4. Line (L-1, L-2, L-3)</span>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">L-1</label>
                            <input type="text" name="line_l1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">L-2</label>
                            <input type="text" name="line_l2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">L-3</label>
                            <input type="text" name="line_l3" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">6. Span in meter</span>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">L-1 Span</label>
                            <input type="text" name="span_l1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">L-2 Span</label>
                            <input type="text" name="span_l2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">L-3 Span</label>
                            <input type="text" name="span_l3" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Height from Rail Level -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Height from Rail Level (in mm) <span class="text-red-500">*</span></h2>
            
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">7. Rail to bottom of Overline structure (L-1)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END1</label>
                            <input type="text" name="rail_to_bottom_l1_end1" placeholder="43" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END2</label>
                            <input type="text" name="rail_to_bottom_l1_end2" placeholder="34" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">10. Rail to bottom of Overline structure (L-2)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END1</label>
                            <input type="text" name="rail_to_bottom_l2_end1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END2</label>
                            <input type="text" name="rail_to_bottom_l2_end2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">11. Rail to bottom of Overline structure (L-3)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END1</label>
                            <input type="text" name="rail_to_bottom_l3_end1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END2</label>
                            <input type="text" name="rail_to_bottom_l3_end2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact wire height from Rail level -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Contact Wire Height from Rail Level (in mm) <span class="text-red-500">*</span></h2>
            
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">12. Contact wire height (L-1)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END1</label>
                            <input type="text" name="contact_height_l1_end1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END2</label>
                            <input type="text" name="contact_height_l1_end2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">15. Contact wire height (L-2)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END1</label>
                            <input type="text" name="contact_height_l2_end1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END2</label>
                            <input type="text" name="contact_height_l2_end2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">16. Contact wire height (L-3)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END1</label>
                            <input type="text" name="contact_height_l3_end1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END2</label>
                            <input type="text" name="contact_height_l3_end2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clearance between upper conductor and bottom of Overline structure -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Clearance between upper conductor & bottom of OLS (in mm) <span class="text-red-500">*</span></h2>
            
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">17. L-1 Clearance</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END1 (≥ 250 mm)</label>
                            <input type="number" name="clearance_l1_end1" min="250" step="any" placeholder="≥ 250" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END2 (≥ 250 mm)</label>
                            <input type="number" name="clearance_l1_end2" min="250" step="any" placeholder="≥ 250" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">18. L-2 Clearance</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END1 (≥ 250 mm)</label>
                            <input type="number" name="clearance_l2_end1" min="250" step="any" placeholder="≥ 250" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END2 (≥ 250 mm)</label>
                            <input type="number" name="clearance_l2_end2" min="250" step="any" placeholder="≥ 250" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3 text-sm">19. L-3 Clearance</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END1 (≥ 250 mm)</label>
                            <input type="number" name="clearance_l3_end1" min="250" step="any" placeholder="≥ 250" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">END2 (≥ 250 mm)</label>
                            <input type="number" name="clearance_l3_end2" min="250" step="any" placeholder="≥ 250" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Safety, Screens, Drainage & Earthing -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 space-y-5">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Safety, Drainage & Earthing <span class="text-red-500">*</span></h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">20. Continuous Protective Screen <span class="text-red-500">*</span></label>
                    <input type="text" name="protective_screen" placeholder="Yes or No" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">21. Crossing of Power cable in conduit <span class="text-red-500">*</span></label>
                    <input type="text" name="power_cable_conduit" placeholder="Yes or No" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">22. Provision of 25 KV Caution Board <span class="text-red-500">*</span></label>
                    <input type="text" name="caution_board" placeholder="Yes or No" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">23. Drainages not falling over OHE <span class="text-red-500">*</span></label>
                    <input type="text" name="drainage_check" placeholder="Yes or No" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">25. False catenary (RDSO SMI TI MI 0062) <span class="text-red-500">*</span></label>
                    <input type="text" name="false_catenary" placeholder="Yes or No" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <span class="block font-medium text-gray-700 mb-3 text-sm">24. Earthing</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Provided</label>
                        <input type="text" name="earthing_provided" placeholder="Yes or No" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Earthing Value (≤ 10 Ω)</label>
                        <input type="number" name="earthing_value" max="10" step="any" placeholder="≤ 10 Ω" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Signatures & Remarks -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">26. Signature & Name of Sup./Staff <span class="text-red-500">*</span></label>
                <input type="text" name="supervisor_signature" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">27. Remarks <span class="text-red-500">*</span></label>
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