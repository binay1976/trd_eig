<?php
// navbar.php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$displayUserName = $_SESSION['username']
    ?? $_SESSION['user_name']
    ?? $_SESSION['mobile']
    ?? 'User Name';
$displayRole = $_SESSION['role'] ?? 'User';

// Get current page name for active menu highlighting
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Navbar -->
<nav class="bg-slate-900 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-16">

            <!-- =========================
                 LOGO / BRAND
            ========================== -->
            <div class="flex items-center">
                <a href="index.php"
                   class="flex items-center gap-3">
                    <!-- Logo -->
                    <div class="w-9 h-9 bg-blue-600 rounded-lg
                                flex items-center justify-center
                                font-bold text-lg">
                    </div>

                    <!-- Brand Name -->
                    <span class="text-xl font-bold tracking-wide">
                        W.Rly TRD EIG
                    </span>
                </a>
            </div>
            <!-- =========================
                 USER / PROFILE
            ========================== -->
            <div class="hidden md:flex items-center ml-4">

                <div class="flex items-center gap-3">

                    <!-- Avatar -->
                    <div class="w-9 h-9 rounded-full
                                bg-blue-600
                                flex items-center justify-center
                                font-semibold">
                    </div>
                    <div class="text-sm">

                        <div class="font-medium">
                            <?= htmlspecialchars($displayUserName, ENT_QUOTES, 'UTF-8') ?>
                        </div>

                        <div class="text-xs text-gray-400">
                            <?= htmlspecialchars($displayRole, ENT_QUOTES, 'UTF-8') ?>
                        </div>

                    </div>

                    <!-- Logout -->
                    <a href="logout.php"
                       class="ml-3 px-3 py-2
                              rounded-lg
                              text-sm
                              text-red-400
                              hover:bg-red-500/10
                              hover:text-red-300
                              transition">

                        Logout

                    </a>

                </div>

            </div>


            <!-- =========================
                 MOBILE MENU BUTTON
            ========================== -->
            <div class="md:hidden">

                <button
                    onclick="toggleMobileMenu()"
                    class="p-2 rounded-lg
                           text-gray-300
                           hover:bg-slate-800
                           hover:text-white">

                    <svg id="menuIcon"
                         class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>

                    </svg>

                </button>

            </div>

        </div>


        <!-- =========================
             MOBILE MENU
        ========================== -->
        <div id="mobileMenu"
             class="hidden md:hidden pb-4">

            <div class="space-y-1">

                <a href="index.php"
                   class="block px-4 py-3 rounded-lg
                          text-gray-300
                          hover:bg-slate-800
                          hover:text-white">

                    Dashboard

                </a>


                <a href="forms.php"
                   class="block px-4 py-3 rounded-lg
                          text-gray-300
                          hover:bg-slate-800
                          hover:text-white">

                    Forms

                </a>


                <a href="reports.php"
                   class="block px-4 py-3 rounded-lg
                          text-gray-300
                          hover:bg-slate-800
                          hover:text-white">

                    Reports

                </a>


                <a href="users.php"
                   class="block px-4 py-3 rounded-lg
                          text-gray-300
                          hover:bg-slate-800
                          hover:text-white">

                    Users

                </a>


                <a href="zone_div.php"
                   class="block px-4 py-3 rounded-lg
                          text-gray-300
                          hover:bg-slate-800
                          hover:text-white">

                    Zone / Division

                </a>


                <a href="settings.php"
                   class="block px-4 py-3 rounded-lg
                          text-gray-300
                          hover:bg-slate-800
                          hover:text-white">

                    Settings

                </a>


                <a href="logout.php"
                   class="block px-4 py-3 rounded-lg
                          text-red-400
                          hover:bg-red-500/10">

                    Logout

                </a>

            </div>

        </div>

    </div>
</nav>


<!-- =========================
     MOBILE MENU JAVASCRIPT
========================== -->

<script>

function toggleMobileMenu() {

    const menu = document.getElementById("mobileMenu");

    menu.classList.toggle("hidden");

}

</script>

