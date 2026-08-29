@extends('layouts.app')

@section('title', 'Laporan Transaksi - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc]">

    <div class="max-w-[1600px] mx-auto px-6 py-6">


        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-7 py-6 mb-7">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>

                    <div class="flex items-center gap-2 text-sm font-medium text-indigo-600 mb-2">

                        <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                        LAPORAN

                    </div>

                    <h1 class="text-3xl font-bold text-slate-900">
                        Laporan Transaksi Stok
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Riwayat barang masuk dan barang keluar Stockify.
                    </p>

                </div>


                {{-- PRINT --}}
                <button
                    onclick="window.print()"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-3 rounded-xl
                           bg-gradient-to-r from-indigo-600 to-violet-600
                           text-white font-semibold
                           shadow-lg shadow-indigo-200
                           hover:from-indigo-700 hover:to-violet-700
                           hover:-translate-y-0.5
                           transition-all duration-200
                           no-print"
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
                            stroke-width="2"
                            d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5h-2M6 14h12v8H6v-8z"
                        />

                    </svg>

                    Cetak Laporan

                </button>

            </div>

        </div>


        {{-- =========================================================
            FILTER
        ========================================================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-7">

            <div class="mb-5">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 4h18M6 8h12M8 12h8M10 16h4"
                            />

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Filter Laporan
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Gunakan filter untuk menampilkan transaksi tertentu.
                        </p>

                    </div>

                </div>

            </div>


            <form
                action="{{ route('reports.transactions') }}"
                method="GET"
                class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4"
            >


                {{-- TYPE --}}
                <div>

                    <label
                        for="type"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Tipe Transaksi
                    </label>

                    <select
                        name="type"
                        id="type"
                        class="w-full px-4 py-3
                               rounded-xl
                               border border-slate-200
                               bg-slate-50
                               text-sm text-slate-700
                               focus:outline-none
                               focus:ring-2
                               focus:ring-indigo-500/20
                               focus:border-indigo-500"
                    >

                        <option value="">
                            Semua Transaksi
                        </option>

                        <option
                            value="Masuk"
                            {{ request('type') === 'Masuk' ? 'selected' : '' }}
                        >
                            Barang Masuk
                        </option>

                        <option
                            value="Keluar"
                            {{ request('type') === 'Keluar' ? 'selected' : '' }}
                        >
                            Barang Keluar
                        </option>

                    </select>

                </div>


                {{-- START DATE --}}
                <div>

                    <label
                        for="start_date"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        id="start_date"
                        value="{{ request('start_date') }}"
                        class="w-full px-4 py-3
                               rounded-xl
                               border border-slate-200
                               bg-slate-50
                               text-sm text-slate-700
                               focus:outline-none
                               focus:ring-2
                               focus:ring-indigo-500/20
                               focus:border-indigo-500"
                    >

                </div>


                {{-- END DATE --}}
                <div>

                    <label
                        for="end_date"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Tanggal Akhir
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        id="end_date"
                        value="{{ request('end_date') }}"
                        class="w-full px-4 py-3
                               rounded-xl
                               border border-slate-200
                               bg-slate-50
                               text-sm text-slate-700
                               focus:outline-none
                               focus:ring-2
                               focus:ring-indigo-500/20
                               focus:border-indigo-500"
                    >

                </div>


                {{-- BUTTON --}}
                <div class="flex items-end gap-2 no-print">

                    <button
                        type="submit"
                        class="flex-1 inline-flex items-center
                               justify-center gap-2
                               px-4 py-3 rounded-xl
                               bg-indigo-600
                               text-white
                               text-sm font-semibold
                               hover:bg-indigo-700
                               transition"
                    >

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                            />

                        </svg>

                        Filter

                    </button>


                    <a
                        href="{{ route('reports.transactions') }}"
                        class="inline-flex items-center
                               justify-center
                               px-4 py-3 rounded-xl
                               border border-slate-200
                               bg-white
                               text-slate-600
                               text-sm font-semibold
                               hover:bg-slate-50
                               transition"
                    >

                        Reset

                    </a>

                </div>

            </form>

        </div>


        {{-- =========================================================
            STATISTICS
        ========================================================== --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7">


            {{-- TOTAL --}}
            <div
                class="bg-white rounded-2xl
                       border border-slate-200
                       shadow-sm p-6
                       hover:-translate-y-1
                       hover:shadow-md
                       transition-all duration-200"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Transaksi
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ number_format($totalTransactions) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Sesuai filter yang dipilih
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl
                                bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4" /></svg>

                    </div>

                </div>

            </div>


            {{-- IN --}}
            <div
                class="bg-white rounded-2xl
                       border border-slate-200
                       shadow-sm p-6
                       hover:-translate-y-1
                       hover:shadow-md
                       transition-all duration-200"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Barang Masuk
                        </p>

                        <p class="mt-2 text-3xl font-bold text-emerald-600">
                            {{ number_format($totalIn) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Status diterima
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl
                                bg-emerald-50
                                flex items-center justify-center
                                text-emerald-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7l-7 7-7-7" /></svg>

                    </div>

                </div>

            </div>


            {{-- OUT --}}
            <div
                class="bg-white rounded-2xl
                       border border-slate-200
                       shadow-sm p-6
                       hover:-translate-y-1
                       hover:shadow-md
                       transition-all duration-200"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Barang Keluar
                        </p>

                        <p class="mt-2 text-3xl font-bold text-red-600">
                            {{ number_format($totalOut) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Status dikeluarkan
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl
                                bg-red-50
                                flex items-center justify-center
                                text-red-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            CHART
        ========================================================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-7">

            <div class="px-6 py-5 border-b border-slate-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Grafik Transaksi
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Perbandingan jumlah barang masuk dan keluar berdasarkan tanggal.
                        </p>

                    </div>


                    <div class="flex items-center gap-5 text-xs">

                        <div class="flex items-center gap-2">

                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>

                            <span class="text-slate-500">
                                Barang Masuk
                            </span>

                        </div>

                        <div class="flex items-center gap-2">

                            <span class="w-3 h-3 rounded-full bg-red-500"></span>

                            <span class="text-slate-500">
                                Barang Keluar
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="relative w-full h-80">

                    <canvas id="transactionChart"></canvas>

                </div>

            </div>

        </div>


        {{-- =========================================================
            TABLE
        ========================================================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


            {{-- TABLE HEADER --}}
            <div class="px-6 py-5 border-b border-slate-100">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Riwayat Transaksi
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Data transaksi berdasarkan filter yang dipilih.
                        </p>

                    </div>


                    {{-- SEARCH --}}
                    <div class="relative w-full lg:w-80 no-print">

                        <svg
                            class="absolute left-4 top-1/2
                                   -translate-y-1/2
                                   w-5 h-5 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                            />

                        </svg>

                        <input
                            type="text"
                            id="transactionSearch"
                            placeholder="Cari transaksi..."
                            class="w-full pl-11 pr-4 py-3
                                   rounded-xl
                                   border border-slate-200
                                   bg-slate-50
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-indigo-500/20
                                   focus:border-indigo-500
                                   transition"
                        >

                    </div>

                </div>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1000px]">

                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                No
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Produk
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Tipe
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Jumlah
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                User
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Tanggal
                            </th>

                        </tr>

                    </thead>


                    <tbody
                        id="transactionTable"
                        class="divide-y divide-slate-100"
                    >

                        @forelse($transactions as $index => $transaction)

                            <tr
                                class="transaction-row
                                       hover:bg-indigo-50/30
                                       transition-colors duration-150"
                            >


                                {{-- NO --}}
                                <td class="px-6 py-4">

                                    <span
                                        class="inline-flex items-center justify-center
                                               w-9 h-9 rounded-lg
                                               bg-slate-100
                                               text-sm font-semibold
                                               text-slate-600"
                                    >

                                        {{ $index + 1 }}

                                    </span>

                                </td>


                                {{-- PRODUK --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-10 h-10 rounded-xl
                                                   bg-indigo-50
                                                   flex items-center justify-center
                                                   text-indigo-600
                                                   font-bold"
                                        >

                                            {{ strtoupper(substr($transaction->product->name ?? 'P', 0, 1)) }}

                                        </div>

                                        <div>

                                            <p class="font-semibold text-slate-800">
                                                {{ $transaction->product->name ?? '-' }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">

                                                SKU:
                                                {{ $transaction->product->sku ?? '-' }}

                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- TIPE --}}
                                <td class="px-6 py-4 text-center">

                                    @if($transaction->type === 'Masuk')

                                        <span
                                            class="inline-flex items-center gap-2
                                                   px-3 py-1.5 rounded-full
                                                   bg-emerald-50
                                                   text-emerald-700
                                                   text-xs font-bold"
                                        >

                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                            Masuk

                                        </span>

                                    @elseif($transaction->type === 'Keluar')

                                        <span
                                            class="inline-flex items-center gap-2
                                                   px-3 py-1.5 rounded-full
                                                   bg-red-50
                                                   text-red-700
                                                   text-xs font-bold"
                                        >

                                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                            Keluar

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex px-3 py-1.5
                                                   rounded-full
                                                   bg-slate-100
                                                   text-slate-600
                                                   text-xs font-bold"
                                        >

                                            {{ $transaction->type ?? '-' }}

                                        </span>

                                    @endif

                                </td>


                                {{-- JUMLAH --}}
                                <td class="px-6 py-4 text-center">

                                    @if($transaction->type === 'Masuk')

                                        <span class="font-bold text-emerald-600">
                                            +{{ number_format($transaction->quantity) }}
                                        </span>

                                    @elseif($transaction->type === 'Keluar')

                                        <span class="font-bold text-red-600">
                                            -{{ number_format($transaction->quantity) }}
                                        </span>

                                    @else

                                        <span class="font-bold text-slate-700">
                                            {{ number_format($transaction->quantity) }}
                                        </span>

                                    @endif

                                    <span class="text-xs text-slate-400">
                                        unit
                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-6 py-4">

                                    @if($transaction->status === 'Diterima')

                                        <span
                                            class="inline-flex items-center gap-2
                                                   px-3 py-1.5 rounded-full
                                                   bg-emerald-50
                                                   text-emerald-700
                                                   text-xs font-bold"
                                        >

                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                            Diterima

                                        </span>

                                    @elseif($transaction->status === 'Dikeluarkan')

                                        <span
                                            class="inline-flex items-center gap-2
                                                   px-3 py-1.5 rounded-full
                                                   bg-red-50
                                                   text-red-700
                                                   text-xs font-bold"
                                        >

                                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                            Dikeluarkan

                                        </span>

                                    @elseif($transaction->status === 'Ditolak')

                                        <span
                                            class="inline-flex items-center gap-2
                                                   px-3 py-1.5 rounded-full
                                                   bg-red-50
                                                   text-red-700
                                                   text-xs font-bold"
                                        >

                                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                            Ditolak

                                        </span>

                                    @elseif($transaction->status === 'Pending')

                                        <span
                                            class="inline-flex items-center gap-2
                                                   px-3 py-1.5 rounded-full
                                                   bg-amber-50
                                                   text-amber-700
                                                   text-xs font-bold"
                                        >

                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                            Pending

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex px-3 py-1.5
                                                   rounded-full
                                                   bg-slate-100
                                                   text-slate-600
                                                   text-xs font-bold"
                                        >

                                            {{ $transaction->status ?? '-' }}

                                        </span>

                                    @endif

                                </td>


                                {{-- USER --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="w-9 h-9 rounded-lg
                                                   bg-slate-100
                                                   flex items-center justify-center
                                                   text-xs font-bold
                                                   text-slate-600"
                                        >

                                            {{ strtoupper(substr($transaction->user->name ?? 'U', 0, 1)) }}

                                        </div>

                                        <span class="text-sm font-medium text-slate-700">

                                            {{ $transaction->user->name ?? '-' }}

                                        </span>

                                    </div>

                                </td>


                                {{-- TANGGAL --}}
                                <td class="px-6 py-4">

                                    <p class="text-sm font-medium text-slate-700">

                                        {{ $transaction->created_at?->format('d/m/Y') }}

                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">

                                        {{ $transaction->created_at?->format('H:i') }}

                                    </p>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="w-16 h-16 rounded-2xl
                                                   bg-slate-100
                                                   flex items-center justify-center
                                                   text-slate-400 text-2xl"
                                        >

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4" /></svg>

                                        </div>

                                        <h3 class="mt-4 font-bold text-slate-800">
                                            Tidak ada transaksi
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Coba ubah filter laporan.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- FOOTER --}}
            <div
                class="px-6 py-4
                       border-t border-slate-100
                       flex flex-col sm:flex-row
                       sm:items-center sm:justify-between
                       gap-2"
            >

                <p class="text-sm text-slate-500">

                    Menampilkan

                    <span class="font-semibold text-slate-700">
                        {{ $transactions->count() }}
                    </span>

                    transaksi

                </p>

                <p class="text-xs text-slate-400">
                    Data mengikuti filter yang aktif.
                </p>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    SEARCH
========================================================== --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('transactionSearch');

    const rows =
        document.querySelectorAll('.transaction-row');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const keyword =
            this.value.toLowerCase().trim();

        rows.forEach(function (row) {

            const text =
                row.innerText.toLowerCase();

            row.style.display =
                text.includes(keyword)
                    ? ''
                    : 'none';

        });

    });

});

</script>


{{-- =========================================================
    CHART.JS
========================================================== --}}
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const transactions = @json($transactions);

    const groupedData = {};


    transactions.forEach(function (transaction) {

        const date = transaction.created_at
            ? transaction.created_at.substring(0, 10)
            : null;

        if (!date) {
            return;
        }

        if (!groupedData[date]) {

            groupedData[date] = {
                masuk: 0,
                keluar: 0
            };

        }


        /*
        |--------------------------------------------------------------------------
        | Masuk hanya yang Diterima
        |--------------------------------------------------------------------------
        */

        if (
            transaction.type === 'Masuk' &&
            transaction.status === 'Diterima'
        ) {

            groupedData[date].masuk +=
                Number(transaction.quantity);

        }


        /*
        |--------------------------------------------------------------------------
        | Keluar hanya yang Dikeluarkan
        |--------------------------------------------------------------------------
        */

        if (
            transaction.type === 'Keluar' &&
            transaction.status === 'Dikeluarkan'
        ) {

            groupedData[date].keluar +=
                Number(transaction.quantity);

        }

    });


    const dates =
        Object.keys(groupedData).sort();


    const labels =
        dates.map(function (date) {

            const parts =
                date.split('-');

            return parts[2] + '/' + parts[1];

        });


    const masukData =
        dates.map(function (date) {

            return groupedData[date].masuk;

        });


    const keluarData =
        dates.map(function (date) {

            return groupedData[date].keluar;

        });


    const canvas =
        document.getElementById('transactionChart');

    if (!canvas) {
        return;
    }


    const ctx =
        canvas.getContext('2d');


    new Chart(ctx, {

        type: 'line',

        data: {

            labels: labels,

            datasets: [

                {
                    label: 'Barang Masuk',

                    data: masukData,

                    borderColor: '#10b981',

                    backgroundColor: 'rgba(16, 185, 129, 0.08)',

                    borderWidth: 3,

                    tension: 0.4,

                    fill: true,

                    pointRadius: 4,

                    pointHoverRadius: 6,

                    pointBackgroundColor: '#10b981',

                    pointBorderColor: '#ffffff',

                    pointBorderWidth: 2
                },


                {
                    label: 'Barang Keluar',

                    data: keluarData,

                    borderColor: '#ef4444',

                    backgroundColor: 'rgba(239, 68, 68, 0.08)',

                    borderWidth: 3,

                    tension: 0.4,

                    fill: true,

                    pointRadius: 4,

                    pointHoverRadius: 6,

                    pointBackgroundColor: '#ef4444',

                    pointBorderColor: '#ffffff',

                    pointBorderWidth: 2
                }

            ]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,


            interaction: {

                intersect: false,

                mode: 'index'

            },


            plugins: {

                legend: {

                    display: false

                },


                tooltip: {

                    backgroundColor: '#0f172a',

                    titleColor: '#ffffff',

                    bodyColor: '#e2e8f0',

                    padding: 12,

                    cornerRadius: 10,

                    displayColors: true

                }

            },


            scales: {

                x: {

                    grid: {

                        color: '#f1f5f9',

                        drawBorder: false

                    },

                    ticks: {

                        color: '#64748b'

                    }

                },


                y: {

                    beginAtZero: true,

                    grid: {

                        color: '#f1f5f9',

                        drawBorder: false

                    },

                    ticks: {

                        color: '#64748b',

                        precision: 0

                    }

                }

            }

        }

    });

});

</script>

@endpush


{{-- =========================================================
    PRINT STYLE
========================================================== --}}
<style>

@media print {

    body {
        background: white !important;
    }

    aside,
    nav {
        display: none !important;
    }

    .no-print {
        display: none !important;
    }

    .bg-\[\#f7f9fc\] {
        background: white !important;
    }

    .shadow-sm {
        box-shadow: none !important;
    }

    .rounded-2xl {
        border-radius: 0 !important;
    }

}

</style>

@endsection
