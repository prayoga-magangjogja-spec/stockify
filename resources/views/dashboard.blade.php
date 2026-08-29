@extends('layouts.app')

@section('title', 'Dashboard - Stockify')

@section('content')

@php
    $chartTransactions = [];

    foreach ($recentTransactions as $transaction) {
        $chartTransactions[] = [
            'product' => $transaction->product->name ?? 'Produk',
            'type' => strtolower((string) $transaction->type),
            'quantity' => (int) $transaction->quantity,
            'date' => $transaction->created_at
                ? $transaction->created_at->format('d/m H:i')
                : '-',
        ];
    }
@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">

        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-bold tracking-wider text-indigo-600 uppercase rounded-full bg-indigo-50 border border-indigo-100">
                    Overview
                </span>

                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                <span class="text-xs text-slate-500">
                    Sistem aktif
                </span>
            </div>

            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Dashboard
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Pantau kondisi stok dan aktivitas gudang secara cepat.
            </p>
        </div>

        <a
            href="{{ route('stock-transactions.create') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 shadow-lg shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 transition"
        >
            <span class="text-lg leading-none">+</span>
            Transaksi Baru
        </a>

    </div>


    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

        {{-- TOTAL PRODUK --}}
        <div class="relative overflow-hidden p-6 bg-white border border-slate-200 rounded-2xl shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Produk
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalProducts) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Produk terdaftar
                    </p>
                </div>

                <div class="flex items-center justify-center w-12 h-12 text-xl text-indigo-600 rounded-xl bg-indigo-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.27 6.96L12 12l8.73-5.04M12 22V12" /></svg>
                </div>

            </div>
        </div>


        {{-- TOTAL STOK --}}
        <div class="relative overflow-hidden p-6 bg-white border border-slate-200 rounded-2xl shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Stok
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalStock) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Unit tersedia
                    </p>
                </div>

                <div class="flex items-center justify-center w-12 h-12 text-xl text-indigo-600 rounded-xl bg-indigo-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.27 6.96L12 12l8.73-5.04M12 22V12" /></svg>
                </div>

            </div>
        </div>


        {{-- STOCK IN --}}
        <div class="relative overflow-hidden p-6 bg-white border border-slate-200 rounded-2xl shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Stock In
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-emerald-600">
                        {{ number_format($totalStockIn) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Barang diterima
                    </p>
                </div>

                <div class="flex items-center justify-center w-12 h-12 text-xl text-emerald-600 rounded-xl bg-emerald-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7l-7 7-7-7" /></svg>
                </div>

            </div>
        </div>


        {{-- STOCK OUT --}}
        <div class="relative overflow-hidden p-6 bg-white border border-slate-200 rounded-2xl shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Stock Out
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-rose-600">
                        {{ number_format($totalStockOut) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Barang dikeluarkan
                    </p>
                </div>

                <div class="flex items-center justify-center w-12 h-12 text-xl text-rose-600 rounded-xl bg-rose-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg>
                </div>

            </div>
        </div>

    </div>


    {{-- CHART DAN RINGKASAN --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- CHART --}}
        <div class="p-6 bg-white border border-slate-200 rounded-2xl shadow-sm xl:col-span-2">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Aktivitas Transaksi
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Pergerakan transaksi stok terbaru.
                    </p>
                </div>

                <div class="flex items-center gap-2">

                    <button
                        type="button"
                        id="chartLineButton"
                        class="px-3 py-2 text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-100 rounded-lg"
                    >
                        Line
                    </button>

                    <button
                        type="button"
                        id="chartBarButton"
                        class="px-3 py-2 text-xs font-semibold text-slate-500 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition"
                    >
                        Bar
                    </button>

                </div>

            </div>


            <div class="relative h-[310px] mt-6">

                <canvas id="stockTransactionChart"></canvas>

                <div
                    id="chartEmptyState"
                    class="absolute inset-0 items-center justify-center hidden"
                >
                    <div class="text-center">

                        <div class="flex items-center justify-center w-14 h-14 mx-auto text-2xl rounded-2xl bg-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                        </div>

                        <p class="mt-3 text-sm font-medium text-slate-500">
                            Belum ada aktivitas transaksi
                        </p>

                    </div>
                </div>

            </div>

        </div>


        {{-- RINGKASAN --}}
        <div class="p-6 bg-white border border-slate-200 rounded-2xl shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Ringkasan Stok
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Kondisi stok saat ini.
                    </p>
                </div>

                <span class="px-2.5 py-1 text-[10px] font-bold tracking-wide text-indigo-600 uppercase rounded-lg bg-indigo-50">
                    Live
                </span>

            </div>


            <div class="mt-6 space-y-3">

                <div class="flex items-center justify-between p-4 rounded-xl bg-slate-50 border border-slate-100">

                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.27 6.96L12 12l8.73-5.04M12 22V12" /></svg>
                        </div>

                        <span class="text-sm font-semibold text-slate-600">
                            Total Stok
                        </span>
                    </div>

                    <span class="font-bold text-slate-900">
                        {{ number_format($totalStock) }}
                    </span>

                </div>


                <div class="flex items-center justify-between p-4 rounded-xl bg-emerald-50 border border-emerald-100">

                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7l-7 7-7-7" /></svg>
                        </div>

                        <span class="text-sm font-semibold text-emerald-700">
                            Barang Masuk
                        </span>
                    </div>

                    <span class="font-bold text-emerald-600">
                        {{ number_format($totalStockIn) }}
                    </span>

                </div>


                <div class="flex items-center justify-between p-4 rounded-xl bg-rose-50 border border-rose-100">

                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-rose-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg>
                        </div>

                        <span class="text-sm font-semibold text-rose-700">
                            Barang Keluar
                        </span>
                    </div>

                    <span class="font-bold text-rose-600">
                        {{ number_format($totalStockOut) }}
                    </span>

                </div>


                <div class="flex items-center justify-between p-4 rounded-xl bg-amber-50 border border-amber-100">

                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 2.57h16.94A2 2 0 0022.18 18L13.71 3.86a2 2 0 00-3.42 0z" /></svg>
                        </div>

                        <span class="text-sm font-semibold text-amber-700">
                            Stok Menipis
                        </span>
                    </div>

                    <span class="font-bold text-amber-600">
                        {{ $lowStockProducts->count() }}
                    </span>

                </div>

            </div>


            <div class="pt-5 mt-5 border-t border-slate-100">

                <a
                    href="{{ route('reports.stock') }}"
                    class="flex items-center justify-between text-sm font-semibold text-indigo-600 hover:text-indigo-700"
                >
                    <span>Lihat laporan stok</span>
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7" /></svg></span>
                </a>

            </div>

        </div>

    </div>


    {{-- TABEL --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

        {{-- STOK MENIPIS --}}
        <div class="overflow-hidden bg-white border border-slate-200 rounded-2xl shadow-sm">

            <div class="flex items-center justify-between p-5 border-b border-slate-100">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Stok Menipis
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Produk yang perlu diperhatikan.
                    </p>
                </div>

                <span class="px-3 py-1.5 text-xs font-bold text-amber-700 rounded-lg bg-amber-50 border border-amber-100">
                    {{ $lowStockProducts->count() }} Produk
                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr class="text-left">

                            <th class="px-5 py-4 text-[10px] font-bold tracking-wider text-slate-500 uppercase">
                                Produk
                            </th>

                            <th class="px-5 py-4 text-[10px] font-bold tracking-wider text-center text-slate-500 uppercase">
                                Stok
                            </th>

                            <th class="px-5 py-4 text-[10px] font-bold tracking-wider text-center text-slate-500 uppercase">
                                Minimum
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($lowStockProducts as $product)

                            <tr class="hover:bg-slate-50/70 transition">

                                <td class="px-5 py-4">

                                    <div class="font-semibold text-slate-800">
                                        {{ $product->name }}
                                    </div>

                                    <div class="mt-1 text-xs text-slate-400">
                                        SKU: {{ $product->sku ?? '-' }}
                                    </div>

                                </td>


                                <td class="px-5 py-4 text-center">

                                    <span class="inline-flex px-3 py-1 text-xs font-bold text-rose-600 rounded-lg bg-rose-50 border border-rose-100">
                                        {{ number_format($product->stock) }}
                                    </span>

                                </td>


                                <td class="px-5 py-4 text-center text-slate-500">
                                    {{ number_format($product->minimum_stock) }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="px-5 py-12 text-center">

                                    <div class="flex items-center justify-center w-14 h-14 mx-auto text-2xl rounded-2xl bg-emerald-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    </div>

                                    <p class="mt-3 font-semibold text-emerald-600">
                                        Semua stok aman
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Tidak ada produk di bawah batas minimum.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- TRANSAKSI TERBARU --}}
        <div class="overflow-hidden bg-white border border-slate-200 rounded-2xl shadow-sm">

            <div class="flex items-center justify-between p-5 border-b border-slate-100">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Transaksi Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Aktivitas stok paling baru.
                    </p>
                </div>

                <a
                    href="{{ route('stock-transactions.index') }}"
                    class="text-xs font-bold text-indigo-600 hover:text-indigo-700"
                >
                    Lihat semua
                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr class="text-left">

                            <th class="px-5 py-4 text-[10px] font-bold tracking-wider text-slate-500 uppercase">
                                Produk
                            </th>

                            <th class="px-5 py-4 text-[10px] font-bold tracking-wider text-center text-slate-500 uppercase">
                                Tipe
                            </th>

                            <th class="px-5 py-4 text-[10px] font-bold tracking-wider text-center text-slate-500 uppercase">
                                Jumlah
                            </th>

                            <th class="px-5 py-4 text-[10px] font-bold tracking-wider text-slate-500 uppercase">
                                Tanggal
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($recentTransactions as $transaction)

                            @php
                                $transactionType = strtolower((string) $transaction->type);

                                $isIn = $transactionType === 'masuk'
                                    || $transactionType === 'in';
                            @endphp

                            <tr class="hover:bg-slate-50/70 transition">

                                <td class="px-5 py-4">

                                    <div class="font-semibold text-slate-800">
                                        {{ $transaction->product->name ?? '-' }}
                                    </div>

                                    <div class="mt-1 text-xs text-slate-400">
                                        {{ $transaction->user->name ?? 'System' }}
                                    </div>

                                </td>


                                <td class="px-5 py-4 text-center">

                                    @if($isIn)

                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[10px] font-bold tracking-wide text-emerald-700 uppercase rounded-lg bg-emerald-50 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            IN
                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[10px] font-bold tracking-wide text-rose-700 uppercase rounded-lg bg-rose-50 border border-rose-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            OUT
                                        </span>

                                    @endif

                                </td>


                                <td class="px-5 py-4 text-center font-bold text-slate-700">
                                    {{ number_format($transaction->quantity) }}
                                </td>


                                <td class="px-5 py-4 whitespace-nowrap">

                                    <div class="text-xs font-medium text-slate-600">
                                        {{ $transaction->created_at ? $transaction->created_at->format('d/m/Y') : '-' }}
                                    </div>

                                    <div class="mt-1 text-[10px] text-slate-400">
                                        {{ $transaction->created_at ? $transaction->created_at->format('H:i') : '' }}
                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="px-5 py-12 text-center">

                                    <div class="flex items-center justify-center w-14 h-14 mx-auto text-2xl rounded-2xl bg-slate-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4" /></svg>
                                    </div>

                                    <p class="mt-3 text-sm font-medium text-slate-500">
                                        Belum ada transaksi stok.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('stockTransactionChart');

    if (!canvas) {
        return;
    }

    const transactions = @json($chartTransactions);

    const emptyState = document.getElementById('chartEmptyState');

    if (!transactions || transactions.length === 0) {
        canvas.style.display = 'none';

        if (emptyState) {
            emptyState.classList.remove('hidden');
            emptyState.classList.add('flex');
        }

        return;
    }

    const labels = transactions.map(function (item) {
        return item.date;
    });

    const stockInData = transactions.map(function (item) {
        if (item.type === 'masuk' || item.type === 'in') {
            return item.quantity;
        }

        return 0;
    });

    const stockOutData = transactions.map(function (item) {
        if (item.type === 'keluar' || item.type === 'out') {
            return item.quantity;
        }

        return 0;
    });

    const context = canvas.getContext('2d');

    const gradientIn = context.createLinearGradient(0, 0, 0, 310);
    gradientIn.addColorStop(0, 'rgba(16, 185, 129, 0.25)');
    gradientIn.addColorStop(1, 'rgba(16, 185, 129, 0)');

    const gradientOut = context.createLinearGradient(0, 0, 0, 310);
    gradientOut.addColorStop(0, 'rgba(244, 63, 94, 0.20)');
    gradientOut.addColorStop(1, 'rgba(244, 63, 94, 0)');

    const chart = new Chart(context, {
        type: 'line',

        data: {
            labels: labels,

            datasets: [
                {
                    label: 'Stock In',
                    data: stockInData,
                    borderColor: '#10b981',
                    backgroundColor: gradientIn,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 3,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    borderWidth: 2.5,
                    tension: 0.42,
                    fill: true
                },
                {
                    label: 'Stock Out',
                    data: stockOutData,
                    borderColor: '#f43f5e',
                    backgroundColor: gradientOut,
                    pointBackgroundColor: '#f43f5e',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 3,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    borderWidth: 2.5,
                    tension: 0.42,
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

            animation: {
                duration: 900
            },

            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',

                    labels: {
                        color: '#64748b',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        boxWidth: 7,
                        padding: 18,

                        font: {
                            size: 11,
                            weight: '600'
                        }
                    }
                },

                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.96)',
                    titleColor: '#ffffff',
                    bodyColor: '#cbd5e1',
                    padding: 12,
                    cornerRadius: 10
                }
            },

            scales: {
                x: {
                    grid: {
                        display: false
                    },

                    ticks: {
                        color: '#64748b',

                        font: {
                            size: 10
                        }
                    }
                },

                y: {
                    beginAtZero: true,

                    grid: {
                        color: 'rgba(148, 163, 184, 0.12)'
                    },

                    border: {
                        display: false
                    },

                    ticks: {
                        color: '#64748b',
                        precision: 0,

                        font: {
                            size: 10
                        }
                    }
                }
            }
        }
    });


    const lineButton = document.getElementById('chartLineButton');
    const barButton = document.getElementById('chartBarButton');


    function activateLine() {

        chart.config.type = 'line';

        chart.data.datasets.forEach(function (dataset) {
            dataset.tension = 0.42;
            dataset.borderRadius = 0;
            dataset.borderSkipped = false;
        });

        chart.update();

        lineButton.className =
            'px-3 py-2 text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-100 rounded-lg';

        barButton.className =
            'px-3 py-2 text-xs font-semibold text-slate-500 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition';
    }


    function activateBar() {

        chart.config.type = 'bar';

        chart.data.datasets.forEach(function (dataset) {
            dataset.tension = 0;
            dataset.borderRadius = 7;
            dataset.borderSkipped = false;
            dataset.backgroundColor = dataset.label === 'Stock In'
                ? 'rgba(16, 185, 129, 0.75)'
                : 'rgba(244, 63, 94, 0.75)';
        });

        chart.update();

        barButton.className =
            'px-3 py-2 text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-100 rounded-lg';

        lineButton.className =
            'px-3 py-2 text-xs font-semibold text-slate-500 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition';
    }


    if (lineButton) {
        lineButton.addEventListener('click', activateLine);
    }

    if (barButton) {
        barButton.addEventListener('click', activateBar);
    }

});
</script>

@endsection
