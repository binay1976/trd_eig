
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-09</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-CLEARANCE INSPECTION</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Clearance Inspection Form
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the clearance and inspection details. All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- SR 1: Height of live conductor above Ground level (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                1. Height of live conductor above Ground level <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- 1.1 i) 132KV -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        i) 132KV (Min 4.6 m) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="height_132kv" placeholder="Min 4.6 m" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">m</span>
                    </div>
                </div>

                <!-- 1.2 ii) 25kV -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        ii) 25kV (Min 3.8 m) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="height_25kv" placeholder="Min 3.8 m" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">m</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 2: Clearance between two live phase (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                2. Clearance between two live phase <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- 2.1 i) 132KV -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        i) 132KV (Min 1.3 m) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="phase_clearance_132kv" placeholder="Min 1.3 m" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">m</span>
                    </div>
                </div>

                <!-- 2.2 ii) 25kV -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        ii) 25kV (Min 0.6 m) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="phase_clearance_25kv" placeholder="Min 0.6 m" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">m</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 3: Electrical clearance between live and earthed parts (Group) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                3. Electrical clearance between live and earthed parts <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- 3.1 i) 132KV -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        i) 132KV (Min 1.3 m) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="live_earth_clearance_132kv" placeholder="Min 1.3 m" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">m</span>
                    </div>
                </div>

                <!-- 3.2 ii) 25kV -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        ii) 25kV (Min 0.5 m) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="live_earth_clearance_25kv" placeholder="Min 0.5 m" required
                            class="w-full px-4 py-3 pr-14 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <span class="absolute right-3 top-3.5 text-gray-500 text-sm">m</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SR 4-6: Visual Inspection, Number Plates & Fencing Earthing -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                <!-- 4. Visual inspection of insulators -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        4. Visual inspection of insulators <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="visual_inspection_insulators" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 5. Number plates -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        5. Number plates <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="number_plates" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <!-- 6. Fencing earthing -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        6. Fencing earthing <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="fencing_earthing" required
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
                Save Clearance Inspection
            </button>
        </div>

    </form>
</div>
