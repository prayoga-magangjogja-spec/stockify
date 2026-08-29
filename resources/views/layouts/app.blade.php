<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('title', 'Stockify')</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --stockify-page: #f6f8fc;
            --stockify-white: #ffffff;
            --stockify-sidebar: #0b1020;
            --stockify-sidebar-dark: #090e1b;

            --stockify-text: #172033;
            --stockify-text-secondary: #64748b;
            --stockify-text-muted: #94a3b8;

            --stockify-border: #e5eaf2;

            --stockify-primary: #6366f1;
            --stockify-primary-dark: #4f46e5;
            --stockify-violet: #7c3aed;

            --stockify-blue: #2563eb;
            --stockify-green: #059669;
            --stockify-red: #dc2626;
            --stockify-amber: #d97706;
        }

        html {
            min-height: 100%;
            background: var(--stockify-page);
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            color: var(--stockify-text);
            background:
                radial-gradient(
                    circle at 85% -15%,
                    rgba(99, 102, 241, 0.08),
                    transparent 28%
                ),
                var(--stockify-page);
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        ::selection {
            color: #312e81;
            background: rgba(99, 102, 241, 0.18);
        }

        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .stockify-sidebar {
            background:
                linear-gradient(
                    180deg,
                    var(--stockify-sidebar) 0%,
                    var(--stockify-sidebar-dark) 100%
                );

            border-right: 1px solid rgba(255, 255, 255, 0.06);

            box-shadow:
                16px 0 40px rgba(15, 23, 42, 0.08);

            transition: transform 0.25s ease;
        }

        .stockify-logo {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #7c3aed
                );

            box-shadow:
                0 10px 25px rgba(99, 102, 241, 0.28);
        }

        .stockify-menu {
            position: relative;

            color: #94a3b8;

            transition:
                color 0.2s ease,
                background 0.2s ease,
                transform 0.2s ease;
        }

        .stockify-menu:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.055);
            transform: translateX(2px);
        }

        .stockify-menu.active {
            color: #ffffff !important;

            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #7c3aed
                );

            box-shadow:
                0 10px 24px rgba(99, 102, 241, 0.22);
        }

        .stockify-menu.active::before {
            content: "";

            position: absolute;
            left: 0;
            top: 22%;

            width: 3px;
            height: 56%;

            border-radius: 0 999px 999px 0;
            background: #ffffff;
        }

        .stockify-user-card {
            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.065),
                    rgba(255, 255, 255, 0.025)
                );

            border: 1px solid rgba(255, 255, 255, 0.08);
        }


        /* =========================================================
           MAIN AREA
        ========================================================= */

        .stockify-main {
            min-height: 100vh;
            background: transparent;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .stockify-topbar {
            position: relative;

            display: flex;
            align-items: center;
            justify-content: space-between;

            min-height: 78px;

            background: #ffffff;

            border: 1px solid var(--stockify-border);

            box-shadow:
                0 8px 28px rgba(15, 23, 42, 0.045);

            overflow: hidden;
        }

        .stockify-topbar::after {
            content: "";

            position: absolute;
            top: -110px;
            right: -80px;

            width: 220px;
            height: 220px;

            border-radius: 999px;

            background:
                radial-gradient(
                    circle,
                    rgba(99, 102, 241, 0.08),
                    transparent 68%
                );

            pointer-events: none;
        }

        .stockify-page-content {
            width: 100%;
        }


        /* =========================================================
           COMPONENT UMUM
        ========================================================= */

        .stockify-card {
            background: #ffffff;

            border: 1px solid var(--stockify-border);

            border-radius: 18px;

            box-shadow:
                0 8px 28px rgba(15, 23, 42, 0.04);
        }

        .stockify-primary {
            color: #ffffff;

            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #7c3aed
                );

            box-shadow:
                0 10px 24px rgba(99, 102, 241, 0.2);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .stockify-primary:hover {
            transform: translateY(-1px);

            box-shadow:
                0 14px 30px rgba(99, 102, 241, 0.28);
        }

        .stockify-soft-button {
            color: #64748b;
            background: #ffffff;
            border: 1px solid var(--stockify-border);

            transition:
                color 0.2s ease,
                background 0.2s ease,
                border-color 0.2s ease;
        }

        .stockify-soft-button:hover {
            color: #4f46e5;
            background: #f8faff;
            border-color: #cbd5e1;
        }


        /* =========================================================
           INPUT
        ========================================================= */

        .stockify-input {
            width: 100%;

            color: #172033;
            background: #ffffff;

            border: 1px solid #dbe2ec;
            border-radius: 12px;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .stockify-input::placeholder {
            color: #94a3b8;
        }

        .stockify-input:hover {
            border-color: #cbd5e1;
        }

        .stockify-input:focus {
            border-color: #818cf8;

            box-shadow:
                0 0 0 4px rgba(99, 102, 241, 0.1);
        }


        /* =========================================================
           TABLE
        ========================================================= */

        .stockify-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .stockify-table thead {
            background: #f8fafc;
        }

        .stockify-table tbody tr {
            background: #ffffff;
            transition: background 0.18s ease;
        }

        .stockify-table tbody tr:hover {
            background: #fafbff;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .stockify-alert-success {
            color: #047857;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
        }

        .stockify-alert-error {
            color: #be123c;
            background: #fff1f2;
            border: 1px solid #fecdd3;
        }

        .stockify-alert-warning {
            color: #b45309;
            background: #fffbeb;
            border: 1px solid #fde68a;
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        .stockify-mobile-toggle {
            display: none;
        }

        .stockify-mobile-overlay {
            display: none;
        }

        @media (max-width: 767px) {
            .stockify-sidebar {
                transform: translateX(-100%);
                z-index: 60;
            }

            .stockify-sidebar.open {
                transform: translateX(0);
            }

            .stockify-mobile-toggle {
                display: inline-flex;
            }

            .stockify-main {
                margin-left: 0 !important;
            }

            .stockify-mobile-overlay {
                position: fixed;
                inset: 0;

                z-index: 50;

                background: rgba(15, 23, 42, 0.45);

                backdrop-filter: blur(3px);
            }

            .stockify-mobile-overlay.open {
                display: block;
            }
        }

        @media (min-width: 768px) {
            .stockify-sidebar {
                transform: translateX(0) !important;
            }
        }


        /* =========================================================
           PRINT
        ========================================================= */

        @media print {
            .stockify-sidebar,
            .stockify-mobile-overlay,
            .stockify-mobile-toggle {
                display: none !important;
            }

            .stockify-main {
                margin-left: 0 !important;
                padding: 0 !important;
            }

            .stockify-topbar {
                box-shadow: none !important;
                border: none !important;
            }
        }
    </style>
</head>

<body>

    {{-- MOBILE OVERLAY --}}
    <div
        id="stockifyMobileOverlay"
        class="stockify-mobile-overlay"
        onclick="stockifyCloseSidebar()"
    ></div>


    {{-- =========================================================
       SIDEBAR
    ========================================================= --}}
    <aside
        id="stockifySidebar"
        class="stockify-sidebar fixed top-0 left-0 z-40 w-64 h-screen"
    >
        <div class="h-full px-4 py-5 overflow-y-auto">

            {{-- LOGO --}}
            <div class="flex items-center px-2 mb-8">
                <div class="stockify-logo mr-3">
                    <svg
                        class="w-5 h-5 text-white"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4 7-4A2 2 0 0021 16z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3.27 6.96L12 12l8.73-5.04M12 22V12"
                        />
                    </svg>
                </div>

                <div>
                    <div class="text-lg font-bold tracking-tight text-white">
                        Stockify
                    </div>

                    <div class="text-[10px] tracking-[.14em] text-slate-500 uppercase">
                        Inventory Management
                    </div>
                </div>
            </div>


            {{-- USER --}}
            @auth
                <div class="stockify-user-card mb-7 p-4 rounded-2xl">
                    <div class="flex items-center gap-3">

                        <div
                            class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600"
                        >
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">
                            <p class="text-[10px] font-medium tracking-[.14em] text-slate-500 uppercase">
                                Login sebagai
                            </p>

                            <p class="mt-1 text-sm font-semibold text-white truncate">
                                {{ auth()->user()->name }}
                            </p>

                            <span class="inline-flex mt-2 px-2.5 py-1 text-[10px] font-semibold text-indigo-200 bg-indigo-500/10 border border-indigo-400/15 rounded-lg">
                                {{ auth()->user()->role }}
                            </span>
                        </div>
                    </div>
                </div>
            @endauth


            {{-- NAVIGASI --}}
            <ul class="space-y-1">

                @auth
                    <li>
                        <a
                            href="{{ route('dashboard') }}"
                            class="stockify-menu {{ request()->routeIs('dashboard') || request()->routeIs('home') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm"
                        >
                            <svg
                                class="w-5 h-5 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M3 12l9-9 9 9M5 10v10h14V10"
                                />
                            </svg>

                            Dashboard
                        </a>
                    </li>
                @endauth


                <li class="pt-6 pb-2">
                    <p class="px-3 text-[10px] font-bold tracking-[.18em] text-slate-600 uppercase">
                        Manajemen
                    </p>
                </li>


                @auth
                    <li>
                        <a
                            href="{{ route('products.index') }}"
                            class="stockify-menu {{ request()->routeIs('products.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm"
                        >
                            <svg
                                class="w-5 h-5 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 0021 16z"
                                />
                            </svg>

                            Produk
                        </a>
                    </li>
                @endauth


                @auth
                    @if (
                        auth()->user()->role === 'Admin' ||
                        auth()->user()->role === 'Manajer Gudang'
                    )
                        <li>
                            <a
                                href="{{ route('categories.index') }}"
                                class="stockify-menu {{ request()->routeIs('categories.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm"
                            >
                                <svg
                                    class="w-5 h-5 shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M4 6h16M4 12h16M4 18h10"
                                    />
                                </svg>

                                Kategori
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('suppliers.index') }}"
                                class="stockify-menu {{ request()->routeIs('suppliers.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm"
                            >
                                <svg
                                    class="w-5 h-5 shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 17a2 2 0 104 0M17 17a2 2 0 104 0"
                                    />
                                </svg>

                                Supplier
                            </a>
                        </li>
                    @endif
                @endauth


                @auth
                    @if (auth()->user()->role === 'Admin')
                        <li>
                            <a
                                href="{{ route('users.index') }}"
                                class="stockify-menu {{ request()->routeIs('users.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm"
                            >
                                <svg
                                    class="w-5 h-5 shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 010 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                    />
                                </svg>

                                Manajemen User
                            </a>
                        </li>
                    @endif
                @endauth


                <li class="pt-6 pb-2">
                    <p class="px-3 text-[10px] font-bold tracking-[.18em] text-slate-600 uppercase">
                        Stok
                    </p>
                </li>


                @auth
                    <li>
                        <a
                            href="{{ route('stock-transactions.index') }}"
                            class="stockify-menu {{ request()->routeIs('stock-transactions.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm"
                        >
                            <svg
                                class="w-5 h-5 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M7 7h10M7 12h10M7 17h10"
                                />
                            </svg>

                            Transaksi Stok
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('stock-opnames.index') }}"
                            class="stockify-menu {{ request()->routeIs('stock-opnames.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm"
                        >
                            <svg
                                class="w-5 h-5 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 0111-1"
                                />
                            </svg>

                            Stock Opname
                        </a>
                    </li>
                @endauth


                @auth
                    @if (
                        auth()->user()->role === 'Admin' ||
                        auth()->user()->role === 'Manajer Gudang'
                    )
                        <li class="pt-6 pb-2">
                            <p class="px-3 text-[10px] font-bold tracking-[.18em] text-slate-600 uppercase">
                                Laporan
                            </p>
                        </li>

                        <li>
                            <a
                                href="{{ route('reports.stock') }}"
                                class="stockify-menu {{ request()->routeIs('reports.stock') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm"
                            >
                                <svg
                                    class="w-5 h-5 shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M4 19V5M4 19h16M8 16v-5M12 16V8M16 16v-7"
                                    />
                                </svg>

                                Laporan Stok
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('reports.transactions') }}"
                                class="stockify-menu {{ request()->routeIs('reports.transactions') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm"
                            >
                                <svg
                                    class="w-5 h-5 shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M4 19V5M4 19h16M7 15l3-3 3 2 5-6"
                                    />
                                </svg>

                                Laporan Transaksi
                            </a>
                        </li>
                    @endif
                @endauth


                @auth
                    <li class="pt-6 pb-4">
                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="stockify-menu flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-sm text-rose-400 hover:bg-rose-500/10"
                            >
                                <svg
                                    class="w-5 h-5 shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 012-2V7a2 2 0 012-2h6a2 2 0 012 2v1"
                                    />
                                </svg>

                                Logout
                            </button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </aside>


    {{-- =========================================================
       MAIN CONTENT
    ========================================================= --}}
    <div class="stockify-main min-h-screen p-3 sm:p-4 md:ml-64">

        {{-- HEADER --}}
        <header class="stockify-topbar px-4 py-4 sm:px-6 sm:py-5 rounded-2xl">

            <div class="relative z-10 flex items-center gap-3">

                {{-- MOBILE MENU --}}
                <button
                    type="button"
                    onclick="stockifyOpenSidebar()"
                    class="stockify-mobile-toggle items-center justify-center w-10 h-10 rounded-xl stockify-soft-button"
                    aria-label="Buka menu"
                >
                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <div>
                    <p class="text-[10px] sm:text-[11px] font-bold tracking-[.2em] text-indigo-500 uppercase">
                        Stockify
                    </p>

                    <h1 class="mt-1 text-sm sm:text-lg font-semibold tracking-tight text-slate-900">
                        Aplikasi Manajemen Stok Barang
                    </h1>
                </div>
            </div>


            {{-- USER HEADER --}}
            @auth
                <div class="relative z-10 flex items-center gap-3">

                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-semibold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-slate-400">
                            {{ auth()->user()->role }}
                        </p>
                    </div>

                    <div
                        class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/20"
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            @endauth

        </header>


        {{-- PAGE CONTENT --}}
        <main class="stockify-page-content mt-5 sm:mt-6">
            @yield('content')
        </main>

    </div>


    @stack('scripts')


    {{-- MOBILE SIDEBAR SCRIPT --}}
    <script>
        function stockifyOpenSidebar() {
            const sidebar = document.getElementById('stockifySidebar');
            const overlay = document.getElementById('stockifyMobileOverlay');

            if (sidebar) {
                sidebar.classList.add('open');
            }

            if (overlay) {
                overlay.classList.add('open');
            }
        }

        function stockifyCloseSidebar() {
            const sidebar = document.getElementById('stockifySidebar');
            const overlay = document.getElementById('stockifyMobileOverlay');

            if (sidebar) {
                sidebar.classList.remove('open');
            }

            if (overlay) {
                overlay.classList.remove('open');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document
                .querySelectorAll('#stockifySidebar a')
                .forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (window.innerWidth < 768) {
                            stockifyCloseSidebar();
                        }
                    });
                });
        });
    </script>

</body>
</html>