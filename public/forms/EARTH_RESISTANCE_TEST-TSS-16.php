
    <script src="https://cdn.tailwindcss.com"></script>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    
    <!-- Form ID Badge -->
    <div style="display:inline-block; background:#003366; color:#fff;
                padding:8px 18px; border-radius:8px; margin-bottom:18px;
                font-family:Calibri,Arial,sans-serif; font-size:13px; line-height:1.7;">
        <div><span style="opacity:.75;font-size:11px;letter-spacing:.5px;">FORM NO</span>
             &nbsp;<strong style="font-size:15px;">TSS-16</strong></div>
        <div style="font-size:12px; opacity:.9;">TSS-EARTH RESISTANCE TEST</div>
    </div>
<div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Earth Resistance Test Inspection
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Enter the earth pit resistance values (EP-01 to EP-40). All marked fields are mandatory.
        </p>
    </div>

    <form method="POST" action="/trd_eig/public/save_form.php?unique_form_id=<?= htmlspecialchars($_GET['unique_form_id'] ?? '') ?>" class="space-y-5">

        <!-- Station Type Section (Dropdown) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            
        </div>

        <!-- Earth Pits EP-01 to EP-40 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
                Earth Pit Resistance Values (≤ 10 Ω) <span class="text-red-500">*</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                <!-- Loop generated for EP-01 to EP-40 -->
                <!-- EP-01 to EP-10 -->
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">1. EP-01</label>
                    <div class="relative">
                        <input type="number" name="ep_01" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">2. EP-02</label>
                    <div class="relative">
                        <input type="number" name="ep_02" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">3. EP-03</label>
                    <div class="relative">
                        <input type="number" name="ep_03" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">4. EP-04</label>
                    <div class="relative">
                        <input type="number" name="ep_04" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">5. EP-05</label>
                    <div class="relative">
                        <input type="number" name="ep_05" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">6. EP-06</label>
                    <div class="relative">
                        <input type="number" name="ep_06" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">7. EP-07</label>
                    <div class="relative">
                        <input type="number" name="ep_07" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">8. EP-08</label>
                    <div class="relative">
                        <input type="number" name="ep_08" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">9. EP-09</label>
                    <div class="relative">
                        <input type="number" name="ep_09" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">10. EP-10</label>
                    <div class="relative">
                        <input type="number" name="ep_10" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>

                <!-- EP-11 to EP-20 -->
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">11. EP-11</label>
                    <div class="relative">
                        <input type="number" name="ep_11" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">12. EP-12</label>
                    <div class="relative">
                        <input type="number" name="ep_12" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">13. EP-13</label>
                    <div class="relative">
                        <input type="number" name="ep_13" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">14. EP-14</label>
                    <div class="relative">
                        <input type="number" name="ep_14" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">15. EP-15</label>
                    <div class="relative">
                        <input type="number" name="ep_15" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">16. EP-16</label>
                    <div class="relative">
                        <input type="number" name="ep_16" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">17. EP-17</label>
                    <div class="relative">
                        <input type="number" name="ep_17" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">18. EP-18</label>
                    <div class="relative">
                        <input type="number" name="ep_18" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">19. EP-19</label>
                    <div class="relative">
                        <input type="number" name="ep_19" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">20. EP-20</label>
                    <div class="relative">
                        <input type="number" name="ep_20" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>

                <!-- EP-21 to EP-30 -->
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">21. EP-21</label>
                    <div class="relative">
                        <input type="number" name="ep_21" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">22. EP-22</label>
                    <div class="relative">
                        <input type="number" name="ep_22" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">23. EP-23</label>
                    <div class="relative">
                        <input type="number" name="ep_23" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">24. EP-24</label>
                    <div class="relative">
                        <input type="number" name="ep_24" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">25. EP-25</label>
                    <div class="relative">
                        <input type="number" name="ep_25" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">26. EP-26</label>
                    <div class="relative">
                        <input type="number" name="ep_26" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">27. EP-27</label>
                    <div class="relative">
                        <input type="number" name="ep_27" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">28. EP-28</label>
                    <div class="relative">
                        <input type="number" name="ep_28" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">29. EP-29</label>
                    <div class="relative">
                        <input type="number" name="ep_29" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">30. EP-30</label>
                    <div class="relative">
                        <input type="number" name="ep_30" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>

                <!-- EP-31 to EP-40 -->
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">31. EP-31</label>
                    <div class="relative">
                        <input type="number" name="ep_31" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">32. EP-32</label>
                    <div class="relative">
                        <input type="number" name="ep_32" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">33. EP-33</label>
                    <div class="relative">
                        <input type="number" name="ep_33" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">34. EP-34</label>
                    <div class="relative">
                        <input type="number" name="ep_34" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">35. EP-35</label>
                    <div class="relative">
                        <input type="number" name="ep_35" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">36. EP-36</label>
                    <div class="relative">
                        <input type="number" name="ep_36" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">37. EP-37</label>
                    <div class="relative">
                        <input type="number" name="ep_37" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">38. EP-38</label>
                    <div class="relative">
                        <input type="number" name="ep_38" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">39. EP-39</label>
                    <div class="relative">
                        <input type="number" name="ep_39" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">40. EP-40</label>
                    <div class="relative">
                        <input type="number" name="ep_40" max="10" step="any" placeholder="≤ 10 Ω" required
                            class="w-full px-3 py-2.5 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <span class="absolute right-3 top-2.5 text-gray-500 text-xs">Ω</span>
                    </div>
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
                Save Earth Resistance Test
            </button>
        </div>

    </form>
</div>
