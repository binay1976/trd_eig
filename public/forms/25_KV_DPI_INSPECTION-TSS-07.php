<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSS-25 KV DPI INSPECTION</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 py-8">

<div class="max-w-6xl mx-auto px-4">
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-07</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-25 KV DPI INSPECTION</div>
    </div>
<div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            25 KV DPI Inspection
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" method="POST" class="space-y-6">

        <!-- Basic Details (Fields 1-8) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">1. Rly Identification No. <span class="text-red-500">*</span></label>
                    <input type="text" name="rly_identification_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 2 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">2. Make <span class="text-red-500">*</span></label>
                    <input type="text" name="make" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 3 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">3. Maker's serial No. <span class="text-red-500">*</span></label>
                    <input type="text" name="maker_serial_no" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 4 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">4. Rating <span class="text-red-500">*</span></label>
                    <input type="text" name="rating" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 5 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">5. Manufacture's Year <span class="text-red-500">*</span></label>
                    <input type="text" name="manufactures_year" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 6 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">6. Insulators Condition <span class="text-red-500">*</span></label>
                    <input type="text" name="insulators_condition" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 7 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">7. Terminal connectors <span class="text-red-500">*</span></label>
                    <input type="text" name="terminal_connectors" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 8 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">8. Contacts ( check for Operation ( manual ) <span class="text-red-500">*</span></label>
                    <input type="text" name="contacts_operation" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- 9. Insulation resistance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-5">
                9. Insulation resistance with 5KV Megger.
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- 10.1 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">10.1 a) Pole to pole (Open Position) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="number" step="any" name="ir_pole_pole" required class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
                <!-- 10.2 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">10.2 b) Pole to Earth (Close Position) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="number" step="any" name="ir_pole_earth" required class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
                <!-- 10.3 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">10.3 c) Pole A to Pole B(Close position) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="number" step="any" name="ir_pole_a_b" required class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Remaining Fields (10-13) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 10 (Clearance) -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">10. Clearance between contact in open position <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="number" step="any" name="contact_clearance" required class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <span class="absolute right-4 top-3.5 text-gray-500 text-sm">mm</span>
                    </div>
                </div>
                <!-- 12 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">12. Duplicate earth and earth continuity <span class="text-red-500">*</span></label>
                    <input type="text" name="duplicate_earth" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <!-- 13 -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">13. Terminal connections <span class="text-red-500">*</span></label>
                    <input type="text" name="terminal_connections_check" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                
                <!-- 11 -->
                <div class="flex flex-col md:col-span-2 lg:col-span-3">
                    <label class="text-sm font-medium text-gray-700 mb-2">11. Lock (check whether both lock and padlock fit conveniently when isolator is in open or close position) <span class="text-red-500">*</span></label>
                    <textarea name="lock_check" rows="2" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-center gap-4 pt-2 pb-8">
            <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition-colors">Reset</button>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors">Save 25 KV DPI</button>
        </div>
    </form>
</div>

</body>
</html>