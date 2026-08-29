```blade
@extends('layouts.app')

@section('title', 'Dashboard - Stockify')

@push('styles')

<style>
    /* =========================================================
       STOCKIFY DASHBOARD - MODERN UI
    ========================================================= */

    .dashboard-page {
        position: relative;
        min-height: calc(100vh - 40px);
        color: #e5e7eb;
    }

    /* Background glow */
    .dashboard-page::before {
        content: "";
        position: fixed;
        width: 420px;
        height: 420px;
        top: 80px;
        right: 50px;
        border-radius: 50%;
        background: rgba(99, 102, 241, .10);
        filter: blur(100px);
        pointer-events: none;
        z-index: -1;
    }

    .dashboard-page::after {
        content: "";
        position: fixed;
        width: 350px;
        height: 350px;
        bottom: 50px;
        left: 250px;
        border-radius: 50%;
        background: rgba(16, 185, 129, .06);
        filter: blur(100px);
        pointer-events: none;
        z-index: -1;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .dashboard-heading {
        margin-bottom: 26px;
    }

    .dashboard-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        padding: 6px 10px;
        border: 1px solid rgba(99, 102, 241, .25);
        border-radius: 999px;
        background: rgba(99, 102, 241, .08);
        color: #a5b4fc;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .15em;
        text-transform: uppercase;
    }

    .dashboard-eyebrow-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #818cf8;
        box-shadow: 0 0 10px #818cf8;
    }

    .dashboard-title {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -.04em;
        color: #fff;
    }

    .dashboard-subtitle {
        margin-top: 7px;
        color: #71717a;
        font-size: 14px;
    }

    /* =========================================================
       STAT CARDS
    ========================================================= */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 18px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        min-height: 158px;
        padding: 22px;
        border: 1px solid rgba(255, 255, 255, .07);
        border-radius: 20px;
        background:
            linear-gradient(
                145deg,
                rgba(24, 24, 32, .96),
                rgba(11, 11, 16, .96)
            );
        box-shadow:
            0 15px 40px rgba(0, 0, 0, .20),
            inset 0 1px 0 rgba(255, 255, 255, .025);
        transition:
            transform .25s ease,
            border-color .25s ease,
            box-shadow .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: rgba(255, 255, 255, .14);
        box-shadow:
            0 22px 55px rgba(0, 0, 0, .30),
            0 0 35px rgba(99, 102, 241, .06);
    }

    .stat-card::before {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        top: -85px;
        right: -65px;
        border-radius: 50%;
        background: var(--stat-glow);
        filter: blur(2px);
        opacity: .65;
    }

    .stat-card-blue {
        --stat-glow: rgba(59, 130, 246, .22);
    }

    .stat-card-purple {
        --stat-glow: rgba(139, 92, 246, .22);
    }

    .stat-card-green {
        --stat-glow: rgba(16, 185, 129, .20);
    }

    .stat-card-red {
        --stat-glow: rgba(239, 68, 68, .20);
    }

    .stat-top {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .stat-label {
        color: #8b8b98;
        font-size: 12px;
        font-weight: 600;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 20px;
    }

    .stat-icon-blue {
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, .20);
        background: rgba(59, 130, 246, .10);
    }

    .stat-icon-purple {
        color: #a78bfa;
        border: 1px solid rgba(139, 92, 246, .20);
        background: rgba(139, 92, 246, .10);
    }

    .stat-icon-green {
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, .20);
        background: rgba(16, 185, 129, .10);
    }

    .stat-icon-red {
        color: #fb7185;
        border: 1px solid rgba(239, 68, 68, .20);
        background: rgba(239, 68, 68, .10);
    }

    .stat-value {
        position: relative;
        z-index: 1;
        margin-top: 18px;
        font-size: 31px;
        line-height: 1;
        font-weight: 800;
        letter-spacing: -.04em;
        color: #fff;
    }

    .stat-description {
        position: relative;
        z-index: 1;
        margin-top: 9px;
        color: #62626d;
        font-size: 11px;
    }

    /* =========================================================
       CONTENT CARDS
    ========================================================= */

    .dashboard-card {
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, .07);
        border-radius: 20px;
        background:
            linear-gradient(
                145deg,
                rgba(20, 20, 27, .94),
                rgba(10, 10, 14, .97)
            );
        box-shadow:
            0 15px 40px rgba(0, 0, 0, .18),
            inset 0 1px 0 rgba(255, 255, 255, .025);
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 20px 22px;
        border-bottom: 1px solid rgba(255, 255, 255, .06);
    }

    .card-title {
        margin: 0;
        color: #f4f4f5;
        font-size: 15px;
        font-weight: 750;
    }

    .card-description {
        margin-top: 5px;
        color: #686873;
        font-size: 11px;
    }

    .card-body {
        padding: 20px;
    }

    /* =========================================================
       CHART
    ========================================================= */

    .main-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.75fr) minmax(280px, .75fr);
        gap: 18px;
        margin-bottom: 18px;
    }

    .chart-wrapper {
        position: relative;
        height: 310px;
    }

    .chart-controls {
        display: flex;
        gap: 5px;
        padding: 4px;
        border: 1px solid rgba(255, 255, 255, .07);
        border-radius: 10px;
        background: rgba(255, 255, 255, .025);
    }

    .chart-filter {
        padding: 7px 11px;
        border: 0;
        border-radius: 7px;
        background: transparent;
        color: #71717a;
        cursor: pointer;
        font-size: 10px;
        font-weight: 700;
        transition: .2s ease;
    }

    .chart-filter:hover {
        color: #fff;
        background: rgba(255, 255, 255, .05);
    }

    .chart-filter.active {
        color: #fff;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        box-shadow: 0 5px 15px rgba(99, 102, 241, .25);
    }

    /* =========================================================
       DONUT
    ========================================================= */

    .donut-area {
        min-height: 310px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .donut-container {
        position: relative;
        width: 205px;
        height: 205px;
    }

    .donut-center {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .donut-center-value {
        color: #fff;
        font-size: 30px;
        font-weight: 800;
    }

    .donut-center-label {
        margin-top: 3px;
        color: #71717a;
        font-size: 10px;
    }

    .donut-legend {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 12px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #8b8b95;
        font-size: 10px;
    }

    .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .legend-green {
        background: #34d399;
        box-shadow: 0 0 10px rgba(52, 211, 153, .45);
    }

    .legend-red {
        background: #fb7185;
        box-shadow: 0 0 10px rgba(251, 113, 133, .45);
    }

    /* =========================================================
       LOWER GRID
    ========================================================= */

    .lower-grid {
        display: grid;
        grid-template-columns: .8fr 1.2fr;
        gap: 18px;
        margin-bottom: 18px;
    }

    /* =========================================================
       SUMMARY
    ========================================================= */

    .summary-list {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .summary-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 13px 14px;
        border: 1px solid rgba(255, 255, 255, .055);
        border-radius: 12px;
        background: rgba(255, 255, 255, .018);
        transition: .2s ease;
    }

    .summary-item:hover {
        transform: translateX(3px);
        border-color: rgba(99, 102, 241, .20);
        background: rgba(99, 102, 241, .045);
    }

    .summary-left {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #9ca3af;
        font-size: 11px;
    }

    .summary-icon {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 12px;
    }

    .summary-value {
        color: #f4f4f5;
        font-size: 12px;
        font-weight: 800;
    }

    /* =========================================================
       LOW STOCK
    ========================================================= */

    .status-pill {
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 9px;
        font-weight: 800;
    }

    .status-safe {
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, .18);
        background: rgba(16, 185, 129, .08);
    }

    .status-danger {
        color: #fb7185;
        border: 1px solid rgba(239, 68, 68, .18);
        background: rgba(239, 68, 68, .08);
    }

    .empty-state {
        min-height: 220px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .empty-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 13px;
        border: 1px solid rgba(16, 185, 129, .16);
        border-radius: 15px;
        background: rgba(16, 185, 129, .07);
        color: #34d399;
        font-size: 20px;
    }

    .empty-title {
        color: #34d399;
        font-size: 12px;
        font-weight: 750;
    }

    .empty-description {
        margin-top: 5px;
        color: #5f5f68;
        font-size: 10px;
    }

    /* =========================================================
       TABLE
    ========================================================= */

    .transactions-card {
        margin-bottom: 20px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dashboard-table th {
        padding: 12px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, .06);
        background: rgba(255, 255, 255, .018);
        color: #666671;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .08em;
        text-align: left;
        text-transform: uppercase;
    }

    .dashboard-table td {
        padding: 14px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, .045);
        color: #a1a1aa;
        font-size: 11px;
    }

    .dashboard-table tbody tr {
        transition: .2s ease;
    }

    .dashboard-table tbody tr:hover {
        background: rgba(99, 102, 241, .035);
    }

    .product-name {
        color: #e4e4e7;
        font-weight: 650;
    }

    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 7px;
        font-size: 8px;
        font-weight: 800;
    }

    .type-in {
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, .16);
        background: rgba(16, 185, 129, .07);
    }

    .type-out {
        color: #fb7185;
        border: 1px solid rgba(239, 68, 68, .16);
        background: rgba(239, 68, 68, .07);
    }

    .quantity {
        color: #f4f4f5;
        font-weight: 800;
    }

    /* =========================================================
       QUICK ACTION
    ========================================================= */

    .quick-actions {
        display: flex;
        gap: 8px;
    }

    .quick-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 11px;
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 9px;
        background: rgba(255, 255, 255, .025);
        color: #a1a1aa;
        font-size: 10px;
        font-weight: 650;
        transition: .2s ease;
    }

    .quick-button:hover {
        transform: translateY(-1px);
        border-color: rgba(99, 102, 241, .30);
        background: rgba(99, 102, 241, .08);
        color: #fff;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .main-grid {
            grid-template-columns: 1fr;
        }

        .lower-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-title {
            font-size: 24px;
        }

        .card-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .chart-controls {
            width: 100%;
        }

        .chart-filter {
            flex: 1;
        }

        .quick-actions {
            flex-wrap: wrap;
        }
    }

    /* =========================================================
       ANIMATION
    ========================================================= */

    .dashboard-animate {
        animation: dashboardFade .55s ease both;
    }

    .delay-1 {
        animation-delay: .05s;
    }

    .delay-2 {
        animation-delay: .10s;
    }

    .delay-3 {
        animation-delay: .15s;
    }

    .delay-4 {
        animation-delay: .20s;
    }

    @keyframes dashboardFade {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@endpush


@section('content')

<div class="dashboard-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="dashboard-heading dashboard-animate">

        <div class="dashboard-eyebrow">
            <span class="dashboard-eyebrow-dot"></span>
            Live Inventory
        </div>

        <h1 class="dashboard-title">
            Dashboard
        </h1>

        <p class="dashboard-subtitle">
            Pantau kondisi stok dan aktivitas gudang secara real-time.
        </p>

    </div>


    {{-- =====================================================
         STATISTICS
    ====================================================== --}}

    <div class="stats-grid">


        {{-- TOTAL PRODUK --}}

        <div class="stat-card stat-card-blue dashboard-animate delay-1">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Total Produk
                    </div>
                </div>

                <div class="stat-icon stat-icon-blue">
                    📦
                </div>

            </div>

            <div
                class="stat-value counter"
                data-value="{{ $totalProducts }}"
            >
                0
            </div>

            <div class="stat-description">
                Produk terdaftar
            </div>

        </div>


        {{-- TOTAL STOK --}}

        <div class="stat-card stat-card-purple dashboard-animate delay-2">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Total Stok
                    </div>
                </div>

                <div class="stat-icon stat-icon-purple">
                    ✓
                </div>

            </div>

            <div
                class="stat-value counter"
                data-value="{{ $totalStock }}"
            >
                0
            </div>

            <div class="stat-description">
                Unit tersedia
            </div>

        </div>


        {{-- STOCK IN --}}

        <div class="stat-card stat-card-green dashboard-animate delay-3">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Stock In
                    </div>
                </div>

                <div class="stat-icon stat-icon-green">
                    ↑
                </div>

            </div>

            <div
                class="stat-value counter"
                data-value="{{ $totalStockIn }}"
            >
                0
            </div>

            <div class="stat-description">
                Barang diterima
            </div>

        </div>


        {{-- STOCK OUT --}}

        <div class="stat-card stat-card-red dashboard-animate delay-4">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Stock Out
                    </div>
                </div>

                <div class="stat-icon stat-icon-red">
                    ↓
                </div>

            </div>

            <div
                class="stat-value counter"
                data-value="{{ $totalStockOut }}"
            >
                0
            </div>

            <div class="stat-description">
                Barang dikeluarkan
            </div>

        </div>

    </div>


    {{-- =====================================================
         CHART + DONUT
    ====================================================== --}}

    <div class="main-grid">


        {{-- ACTIVITY CHART --}}

        <div class="dashboard-card dashboard-animate delay-2">

            <div class="card-header">

                <div>

                    <h2 class="card-title">
                        Aktivitas Stok
                    </h2>

                    <p class="card-description">
                        Pergerakan barang masuk dan keluar.
                    </p>

                </div>


                <div class="chart-controls">

                    <button
                        type="button"
                        class="chart-filter active"
                        data-range="7"
                    >
                        7 Hari
                    </button>

                    <button
                        type="button"
                        class="chart-filter"
                        data-range="30"
                    >
                        30 Hari
                    </button>

                </div>

            </div>


            <div class="card-body">

                <div class="chart-wrapper">

                    <canvas id="stockActivityChart"></canvas>

                </div>

            </div>

        </div>


        {{-- STOCK COMPOSITION --}}

        <div class="dashboard-card dashboard-animate delay-3">

            <div class="card-header">

                <div>

                    <h2 class="card-title">
                        Arus Stok
                    </h2>

                    <p class="card-description">
                        Perbandingan barang masuk dan keluar.
                    </p>

                </div>

            </div>


            <div class="card-body">

                <div class="donut-area">

                    <div class="donut-container">

                        <canvas id="stockDonutChart"></canvas>

                        <div class="donut-center">

                            <div class="donut-center-value">
                                {{ $totalStock }}
                            </div>

                            <div class="donut-center-label">
                                Total Unit
                            </div>

                        </div>

                    </div>


                    <div class="donut-legend">

                        <div class="legend-item">

                            <span class="legend-dot legend-green"></span>

                            Stock In

                        </div>

                        <div class="legend-item">

                            <span class="legend-dot legend-red"></span>

                            Stock Out

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         SUMMARY + LOW STOCK
    ====================================================== --}}

    <div class="lower-grid">


        {{-- SUMMARY --}}

        <div class="dashboard-card dashboard-animate delay-3">

            <div class="card-header">

                <div>

                    <h2 class="card-title">
                        Ringkasan Stok
                    </h2>

                    <p class="card-description">
                        Kondisi stok saat ini.
                    </p>

                </div>

            </div>


            <div class="card-body">

                <div class="summary-list">


                    <div class="summary-item">

                        <div class="summary-left">

                            <span
                                class="summary-icon"
                                style="background:rgba(99,102,241,.10);color:#818cf8;"
                            >
                                📦
                            </span>

                            Total Stok

                        </div>

                        <div class="summary-value">
                            {{ $totalStock }}
                        </div>

                    </div>


                    <div class="summary-item">

                        <div class="summary-left">

                            <span
                                class="summary-icon"
                                style="background:rgba(16,185,129,.10);color:#34d399;"
                            >
                                ↑
                            </span>

                            Barang Masuk

                        </div>

                        <div class="summary-value">
                            {{ $totalStockIn }}
                        </div>

                    </div>


                    <div class="summary-item">

                        <div class="summary-left">

                            <span
                                class="summary-icon"
                                style="background:rgba(239,68,68,.10);color:#fb7185;"
                            >
                                ↓
                            </span>

                            Barang Keluar

                        </div>

                        <div class="summary-value">
                            {{ $totalStockOut }}
                        </div>

                    </div>


                    <div class="summary-item">

                        <div class="summary-left">

                            <span
                                class="summary-icon"
                                style="background:rgba(245,158,11,.10);color:#fbbf24;"
                            >
                                ⚠
                            </span>

                            Stok Menipis

                        </div>

                        <div class="summary-value">
                            {{ $lowStockProducts->count() }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- LOW STOCK --}}

        <div class="dashboard-card dashboard-animate delay-4">

            <div class="card-header">

                <div>

                    <h2 class="card-title">
                        Stok Menipis
                    </h2>

                    <p class="card-description">
                        Produk yang membutuhkan perhatian.
                    </p>

                </div>


                @if ($lowStockProducts->count() > 0)

                    <span class="status-pill status-danger">
                        {{ $lowStockProducts->count() }} Produk
                    </span>

                @else

                    <span class="status-pill status-safe">
                        Aman
                    </span>

                @endif

            </div>


            @if ($lowStockProducts->count() > 0)

                <div class="table-wrapper">

                    <table class="dashboard-table">

                        <thead>

                            <tr>
                                <th>Produk</th>
                                <th>Stok</th>
                                <th>Minimum</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($lowStockProducts as $product)

                                <tr>

                                    <td>
                                        <span class="product-name">
                                            {{ $product->name }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="quantity">
                                            {{ $product->stock }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $product->minimum_stock }}
                                    </td>

                                    <td>

                                        <span class="status-pill status-danger">
                                            Perlu Restock
                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        ✓
                    </div>

                    <div class="empty-title">
                        Semua stok aman
                    </div>

                    <div class="empty-description">
                        Tidak ada produk yang berada di bawah batas minimum.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =====================================================
         TRANSACTIONS
    ====================================================== --}}

    <div class="dashboard-card transactions-card dashboard-animate delay-4">

        <div class="card-header">

            <div>

                <h2 class="card-title">
                    Transaksi Terbaru
                </h2>

                <p class="card-description">
                    Lima aktivitas stok terakhir.
                </p>

            </div>


            <div class="quick-actions">

                <a
                    href="{{ route('stock-transactions.index') }}"
                    class="quick-button"
                >
                    Lihat Semua →
                </a>

            </div>

        </div>


        <div class="table-wrapper">

            <table class="dashboard-table">

                <thead>

                    <tr>

                        <th>Produk</th>

                        <th>Tipe</th>

                        <th>Jumlah</th>

                        <th>Status</th>

                        <th>Tanggal</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($recentTransactions as $transaction)

                        <tr>

                            <td>

                                <span class="product-name">

                                    {{ $transaction->product->name ?? '-' }}

                                </span>

                            </td>


                            <td>

                                @if ($transaction->type === 'Masuk')

                                    <span class="type-badge type-in">
                                        ↑ STOCK IN
                                    </span>

                                @else

                                    <span class="type-badge type-out">
                                        ↓ STOCK OUT
                                    </span>

                                @endif

                            </td>


                            <td>

                                <span class="quantity">
                                    {{ $transaction->quantity }}
                                </span>

                            </td>


                            <td>

                                @if ($transaction->status === 'Diterima')

                                    <span class="status-pill status-safe">
                                        ● Diterima
                                    </span>

                                @elseif ($transaction->status === 'Dikeluarkan')

                                    <span class="status-pill status-danger">
                                        ● Dikeluarkan
                                    </span>

                                @else

                                    <span
                                        class="status-pill"
                                        style="
                                            color:#fbbf24;
                                            border:1px solid rgba(245,158,11,.18);
                                            background:rgba(245,158,11,.08);
                                        "
                                    >
                                        ● {{ $transaction->status }}
                                    </span>

                                @endif

                            </td>


                            <td>

                                {{ $transaction->created_at?->format('d/m/Y H:i') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                style="
                                    padding:45px;
                                    text-align:center;
                                    color:#666671;
                                "
                            >
                                Belum ada transaksi stok.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


</div>

@endsection


@push('scripts')

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       COUNTER ANIMATION
    ========================================================= */

    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {

        const target = Number(counter.dataset.value || 0);

        let current = 0;

        const duration = 700;

        const start = performance.now();

        function animateCounter(timestamp) {

            const progress = Math.min(
                (timestamp - start) / duration,
                1
            );

            const eased =
                1 - Math.pow(1 - progress, 3);

            current = Math.floor(target * eased);

            counter.textContent =
                current.toLocaleString('id-ID');

            if (progress < 1) {

                requestAnimationFrame(
                    animateCounter
                );

            } else {

                counter.textContent =
                    target.toLocaleString('id-ID');

            }

        }

        requestAnimationFrame(
            animateCounter
        );

    });


    /* =========================================================
       CHART DATA
    ========================================================= */

    const transactions = @json(
        $recentTransactions->map(function ($transaction) {
            return [
                'type' => $transaction->type,
                'quantity' => (int) $transaction->quantity,
                'date' => optional($transaction->created_at)->format('d M')
            ];
        })->values()
    );


    /*
     * Karena controller saat ini mengirimkan transaksi terbaru,
     * chart menggunakan data transaksi tersebut.
     *
     * Backend tidak perlu diubah untuk UI ini.
     */

    const stockInTotal =
        Number(@json($totalStockIn));

    const stockOutTotal =
        Number(@json($totalStockOut));


    /* =========================================================
       ACTIVITY CHART
    ========================================================= */

    const activityCanvas =
        document.getElementById('stockActivityChart');

    const labels =
        transactions.length
            ? transactions
                .map(item => item.date)
                .reverse()
            : ['Tidak ada data'];

    const inData =
        transactions.length
            ? transactions
                .map(item =>
                    item.type === 'Masuk'
                        ? item.quantity
                        : 0
                )
                .reverse()
            : [0];

    const outData =
        transactions.length
            ? transactions
                .map(item =>
                    item.type === 'Keluar'
                        ? item.quantity
                        : 0
                )
                .reverse()
            : [0];


    const activityChart =
        new Chart(
            activityCanvas,
            {
                type: 'line',

                data: {

                    labels: labels,

                    datasets: [

                        {
                            label: 'Stock In',

                            data: inData,

                            borderColor: '#34d399',

                            backgroundColor:
                                'rgba(52,211,153,.10)',

                            borderWidth: 2,

                            pointRadius: 4,

                            pointHoverRadius: 7,

                            pointBackgroundColor:
                                '#34d399',

                            pointBorderColor:
                                '#07130f',

                            tension: .42,

                            fill: true
                        },

                        {
                            label: 'Stock Out',

                            data: outData,

                            borderColor: '#fb7185',

                            backgroundColor:
                                'rgba(251,113,133,.07)',

                            borderWidth: 2,

                            pointRadius: 4,

                            pointHoverRadius: 7,

                            pointBackgroundColor:
                                '#fb7185',

                            pointBorderColor:
                                '#16090d',

                            tension: .42,

                            fill: true
                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    interaction: {
                        mode: 'index',
                        intersect: false
                    },

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                color: '#71717a',

                                usePointStyle: true,

                                pointStyle: 'circle',

                                padding: 20,

                                font: {
                                    size: 10
                                }

                            }

                        },

                        tooltip: {

                            backgroundColor:
                                'rgba(15,15,20,.96)',

                            borderColor:
                                'rgba(255,255,255,.08)',

                            borderWidth: 1,

                            titleColor: '#fff',

                            bodyColor: '#a1a1aa',

                            padding: 12,

                            cornerRadius: 10

                        }

                    },

                    scales: {

                        x: {

                            grid: {
                                color:
                                    'rgba(255,255,255,.035)'
                            },

                            ticks: {
                                color: '#52525b',
                                font: {
                                    size: 9
                                }
                            },

                            border: {
                                display: false
                            }

                        },

                        y: {

                            beginAtZero: true,

                            grid: {
                                color:
                                    'rgba(255,255,255,.045)'
                            },

                            ticks: {
                                color: '#52525b',
                                font: {
                                    size: 9
                                }
                            },

                            border: {
                                display: false
                            }

                        }

                    }

                }

            }
        );


    /* =========================================================
       DONUT CHART
    ========================================================= */

    const donutCanvas =
        document.getElementById('stockDonutChart');


    new Chart(
        donutCanvas,
        {
            type: 'doughnut',

            data: {

                labels: [
                    'Stock In',
                    'Stock Out'
                ],

                datasets: [

                    {
                        data: [
                            stockInTotal,
                            stockOutTotal
                        ],

                        backgroundColor: [
                            '#34d399',
                            '#fb7185'
                        ],

                        borderColor: [
                            '#101016',
                            '#101016'
                        ],

                        borderWidth: 6,

                        hoverOffset: 8
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '73%',

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {

                        backgroundColor:
                            'rgba(15,15,20,.96)',

                        borderColor:
                            'rgba(255,255,255,.08)',

                        borderWidth: 1,

                        padding: 12,

                        cornerRadius: 10,

                        titleColor: '#fff',

                        bodyColor: '#a1a1aa'

                    }

                }

            }

        }
    );


    /* =========================================================
       RANGE BUTTON
    ========================================================= */

    document
        .querySelectorAll('.chart-filter')
        .forEach(button => {

            button.addEventListener(
                'click',
                function () {

                    document
                        .querySelectorAll('.chart-filter')
                        .forEach(item =>
                            item.classList.remove('active')
                        );

                    this.classList.add('active');

                    const range =
                        Number(
                            this.dataset.range
                        );

                    /*
                     * Animasi ulang chart ketika
                     * periode ditekan.
                     */

                    activityChart.reset();

                    setTimeout(() => {

                        activityChart.update();

                    }, 120);

                }
            );

        });

});

</script>

@endpush
```
