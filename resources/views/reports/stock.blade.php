@extends('layouts.app')

@section('title', 'Laporan Stok - Stockify')

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
                        Laporan Stok
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Pantau kondisi stok seluruh produk Stockify secara real-time.
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
            STATISTICS
        ========================================================== --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7">


            {{-- TOTAL PRODUK --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6
                        hover:-translate-y-1 hover:shadow-md
                        transition-all duration-200">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Produk
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ number_format($totalProducts) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Produk terdaftar
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl
                                bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m-8-4l8 4m0 0v10"
                            />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- TOTAL STOK --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6
                        hover:-translate-y-1 hover:shadow-md
                        transition-all duration-200">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Stok
                        </p>

                        <p class="mt-2 text-3xl font-bold text-emerald-600">
                            {{ number_format($totalStock) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Seluruh unit barang
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl
                                bg-emerald-50
                                flex items-center justify-center
                                text-emerald-600">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 12l5 5L20 7"
                            />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- STOK MENIPIS --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6
                        hover:-translate-y-1 hover:shadow-md
                        transition-all duration-200">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Stok Menipis
                        </p>

                        <p class="mt-2 text-3xl font-bold text-red-600">
                            {{ number_format($lowStockProducts->count()) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Perlu diperhatikan
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl
                                bg-red-50
                                flex items-center justify-center
                                text-red-600">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v4m0 4h.01M10.3 3.7L2.9 17a2 2 0 001.7 3h14.8a2 2 0 001.7-3L13.7 3.7a2 2 0 00-3.4 0z"
                            />

                        </svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            TABLE CARD
        ========================================================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


            {{-- TABLE HEADER --}}
            <div class="px-6 py-5 border-b border-slate-100">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Daftar Stok Produk
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Kondisi stok berdasarkan data produk saat ini.
                        </p>

                    </div>


                    {{-- SEARCH --}}
                    <div class="relative w-full lg:w-80 no-print">

                        <svg
                            class="absolute left-4 top-1/2 -translate-y-1/2
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
                            id="stockSearch"
                            placeholder="Cari produk, SKU, kategori..."
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

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                SKU
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Kategori
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Stok
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Minimum
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody id="stockTable"
                           class="divide-y divide-slate-100">

                        @forelse($products as $index => $product)

                            <tr
                                class="stock-row
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

                                            {{ strtoupper(substr($product->name ?? 'P', 0, 1)) }}

                                        </div>

                                        <div>

                                            <p class="font-semibold text-slate-800">
                                                {{ $product->name }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">
                                                ID Produk #{{ $product->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- SKU --}}
                                <td class="px-6 py-4">

                                    <span
                                        class="inline-flex px-2.5 py-1
                                               rounded-lg
                                               bg-slate-100
                                               text-xs font-medium
                                               text-slate-600"
                                    >

                                        {{ $product->sku }}

                                    </span>

                                </td>


                                {{-- KATEGORI --}}
                                <td class="px-6 py-4">

                                    <span class="text-sm text-slate-600">

                                        {{ $product->category->name ?? '-' }}

                                    </span>

                                </td>


                                {{-- STOK --}}
                                <td class="px-6 py-4 text-center">

                                    @if($product->stock == 0)

                                        <span class="font-bold text-red-600">
                                            {{ number_format($product->stock) }}
                                        </span>

                                    @elseif($product->stock <= $product->minimum_stock)

                                        <span class="font-bold text-amber-600">
                                            {{ number_format($product->stock) }}
                                        </span>

                                    @else

                                        <span class="font-bold text-emerald-600">
                                            {{ number_format($product->stock) }}
                                        </span>

                                    @endif

                                    <span class="text-xs text-slate-400">
                                        unit
                                    </span>

                                </td>


                                {{-- MINIMUM --}}
                                <td class="px-6 py-4 text-center">

                                    <span class="font-medium text-slate-600">
                                        {{ number_format($product->minimum_stock) }}
                                    </span>

                                    <span class="text-xs text-slate-400">
                                        unit
                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-6 py-4 text-center">

                                    @if($product->stock == 0)

                                        <span
                                            class="inline-flex items-center gap-2
                                                   px-3 py-1.5 rounded-full
                                                   bg-red-50
                                                   text-red-700
                                                   text-xs font-bold"
                                        >

                                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                            Stok Habis

                                        </span>

                                    @elseif($product->stock <= $product->minimum_stock)

                                        <span
                                            class="inline-flex items-center gap-2
                                                   px-3 py-1.5 rounded-full
                                                   bg-amber-50
                                                   text-amber-700
                                                   text-xs font-bold"
                                        >

                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                            Stok Menipis

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center gap-2
                                                   px-3 py-1.5 rounded-full
                                                   bg-emerald-50
                                                   text-emerald-700
                                                   text-xs font-bold"
                                        >

                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                            Aman

                                        </span>

                                    @endif

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
                                                   text-slate-400
                                                   text-2xl"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.27 6.96L12 12l8.73-5.04M12 22V12" /></svg>
                                        </div>

                                        <h3 class="mt-4 font-bold text-slate-800">
                                            Belum ada produk
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Belum terdapat data produk untuk laporan stok.
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
                        {{ $products->count() }}
                    </span>

                    produk

                </p>

                <p class="text-xs text-slate-400">
                    Laporan diperbarui berdasarkan data stok saat ini.
                </p>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    SEARCH SCRIPT
========================================================== --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('stockSearch');

    const rows = document.querySelectorAll('.stock-row');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        rows.forEach(function (row) {

            const text = row.innerText.toLowerCase();

            row.style.display =
                text.includes(keyword)
                    ? ''
                    : 'none';

        });

    });

});

</script>


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
