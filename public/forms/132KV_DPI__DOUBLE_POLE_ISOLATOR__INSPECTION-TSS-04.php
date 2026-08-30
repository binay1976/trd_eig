
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-04</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-132KV DPI (DOUBLE POLE ISOLATOR) INSPECTION</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            132KV DPI (Double Pole Isolator) Inspection
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- SR 1-5: General Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

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

                <!-- 3. Maker's serial No. -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Maker's serial No. <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="makers_serial_no" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4. Rating -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Rating <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rating" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 5. Manufacture's Year -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5. Manufacture's Year <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="manufactures_year" placeholder="YYYY" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- SR 6-9: Mechanical & Physical Check -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                <!-- 6. Insulators Condition -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6. Insulators Condition <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="insulators_condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 7. Terminal connectors -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7. Terminal connectors <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="terminal_connectors" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 8. Contacts -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        8. Contacts <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="contacts_check" placeholder="alignment & condition" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 9. Operation -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        9. Operation (manual) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="operation_manual" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- SR 10: Insulation Resistance with 5KV Megger (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                10. Insulation resistance with 5KV Megger
            </h2>
            <p class="text-sm text-gray-500 mb-5">Enter measured values in MΩ for respective poles.</p>

            <div class="space-y-6">
                <!-- 10.1 a) Pole to pole (Open Position) -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3">10.1 a) Pole to pole (Open Position) *</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Pole A</label>
                            <div class="relative">
                                <input type="number" step="any" name="pole_to_pole_open_pole_a" required placeholder="MΩ"
                                    class="w-full px-4 py-2.5 pr-14 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2.5 text-gray-500 text-sm">MΩ</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Pole B</label>
                            <div class="relative">
                                <input type="number" step="any" name="pole_to_pole_open_pole_b" required placeholder="MΩ"
                                    class="w-full px-4 py-2.5 pr-14 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2.5 text-gray-500 text-sm">MΩ</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 10.1 b) Pole to Earth (Close Position) -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3">10.1 b) Pole to Earth (Close Position) *</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Pole A</label>
                            <div class="relative">
                                <input type="number" step="any" name="pole_to_earth_close_pole_a" required placeholder="MΩ"
                                    class="w-full px-4 py-2.5 pr-14 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2.5 text-gray-500 text-sm">MΩ</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Pole B</label>
                            <div class="relative">
                                <input type="number" step="any" name="pole_to_earth_close_pole_b" required placeholder="MΩ"
                                    class="w-full px-4 py-2.5 pr-14 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2.5 text-gray-500 text-sm">MΩ</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 10.1 c) Pole A to Pole B (Close position) -->
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <span class="block font-medium text-gray-700 mb-3">10.1 c) Pole A to Pole B (Close position) *</span>
                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Pole A & B - earth</label>
                            <div class="relative">
                                <input type="number" step="any" name="pole_ab_to_earth_close" required placeholder="MΩ"
                                    class="w-full px-4 py-2.5 pr-14 border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2.5 text-gray-500 text-sm">MΩ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 11-14: Clearance, Lock & Earth Continuity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <!-- 11. Clearance -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        11. Clearance between contact in open position <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="clearance_open_position" min="500" step="any" placeholder="≥ 500 mm" required
                            class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">mm</span>
                    </div>
                </div>

                <!-- 13. Duplicate earth -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        13. Duplicate earth and earth continuity <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="duplicate_earth_continuity" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 12. Lock (Textarea) -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        12. Lock (check whether both lock and padlock fit conveniently when isolator is in open or close position) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="lock_check" rows="3" placeholder="OK / Not OK" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                </div>

                <!-- 14. Terminal connections -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        14. Terminal connections <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="terminal_connections" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-3 pt-2 pb-8">
            <button type="reset"
                class="w-full sm:w-auto px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition">
                Reset
            </button>
            <button type="submit"
                class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition">
                Save 132KV DPI Inspection
            </button>
        </div>

    </form>
</div>
