
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-17</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-240V AC DISTRIBUTION BOARD (AC DB) INSPECTION</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            AC DB (Alternating Current Distribution Board) Inspection
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- Station Type Section (Dropdown) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            
        </div>

        <!-- SR 1-4: Switches & Fuses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <!-- 1. Operation of main switches -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Operation of main switches <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="operation_main_switches" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 2. Check whether proper fuse is put in -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Check whether proper fuse is put in <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="proper_fuse_check" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 3. Phase line, also check rating & continuity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        3. Phase line, also check rating & continuity <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="phase_line_rating_continuity" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 4. Incoming Double pole switch -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Incoming Double pole switch <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="incoming_double_pole_switch" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

            </div>
        </div>

        <!-- SR 5: Insulation Resistance (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-1">
                5. Insulation resistance with 500V Insulation Tester
            </h2>
            <p class="text-sm text-gray-500 mb-5">Switch incoming, outgoing & other switches in off position.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- 5.1 a) Between phase & Neutral -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5.1 a) Between phase & Neutral <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="phase_to_neutral_ir" placeholder="MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>

                <!-- 5.2 b) Between phase & Earth -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5.2 b) Between phase & Earth <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="phase_to_earth_ir" placeholder="MΩ" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">MΩ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 6-7: Changeover Switch & Earth Connection -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6. Operation of Changeover Switch <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="operation_changeover_switch" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        7. Earth connection <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="earth_connection" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>
            </div>
        </div>

        <!-- Submit & Reset Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-3 pt-2 pb-8">
            <button type="reset"
                class="w-full sm:w-auto px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition">
                Reset
            </button>
            <button type="submit"
                class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition">
                Save AC DB Inspection
            </button>
        </div>

    </form>
</div>
