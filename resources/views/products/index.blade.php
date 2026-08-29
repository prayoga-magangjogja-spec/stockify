@extends('layouts.app')

@section('title', 'Produk - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <div class="mb-2 flex items-center gap-2">

                <span class="h-2 w-2 rounded-full bg-indigo-600"></span>

                <span class="text-xs font-bold uppercase tracking-[0.15em] text-indigo-600">
                    Manajemen
                </span>

            </div>

            <h1 class="text-3xl font-bold text-slate-900">
                Produk
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola data produk, stok, kategori, supplier, dan harga barang.

            </p>

        </div>


        @auth
            @if (
                auth()->user()->role === 'Admin' ||
                auth()->user()->role === 'Manajer Gudang'
            )
                <a
                    href="{{ route('products.create') }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl
                           bg-gradient-to-r from-indigo-600 to-violet-600
                           px-5 py-3
                           text-sm font-semibold text-white
                           shadow-lg shadow-indigo-200
                           transition-all duration-200
                           hover:-translate-y-0.5
                           hover:from-indigo-700 hover:to-violet-700
                           hover:shadow-xl hover:shadow-indigo-200"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Tambah Produk
                </a>
            @endif
        @endauth

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="mb-5 flex items-center gap-3 rounded-2xl
                    border border-emerald-200 bg-emerald-50
                    px-5 py-4 text-sm font-semibold text-emerald-700">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 13l4 4L19 7"
                />
            </svg>

            <span>{{ session('success') }}</span>

        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="mb-5 flex items-center gap-3 rounded-2xl
                    border border-rose-200 bg-rose-50
                    px-5 py-4 text-sm font-semibold text-rose-700">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
            </svg>

            <span>{{ session('error') }}</span>

        </div>

    @endif


    {{-- =========================================================
        STATISTIK
    ========================================================== --}}
    @php

        $totalProducts = $products->count();

        $totalStock = $products->sum(function ($product) {
            return (int) ($product->stock ?? 0);
        });

        $safeStock = $products->filter(function ($product) {
            return (int) ($product->stock ?? 0) > (int) ($product->minimum_stock ?? 0);
        })->count();

        $lowStock = $products->filter(function ($product) {
            return (int) ($product->stock ?? 0) <= (int) ($product->minimum_stock ?? 0);
        })->count();

    @endphp


    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


        {{-- TOTAL PRODUK --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm
                    transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Produk
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalProducts, 0, ',', '.') }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Produk terdaftar
                    </p>

                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.27 6.96L12 12l8.73-5.04M12 22V12"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- TOTAL STOK --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm
                    transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Stok
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalStock, 0, ',', '.') }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Unit tersedia
                    </p>

                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 7l8-4 8 4-8 4-8-4zm0 5l8 4 8-4M4 17l8 4 8-4"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- STOK AMAN --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm
                    transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Stok Aman
                    </p>

                    <p class="mt-2 text-3xl font-bold text-emerald-600">
                        {{ number_format($safeStock, 0, ',', '.') }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Di atas batas minimum
                    </p>

                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- STOK MENIPIS --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm
                    transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Stok Menipis
                    </p>

                    <p class="mt-2 text-3xl font-bold text-amber-600">
                        {{ number_format($lowStock, 0, ',', '.') }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Perlu diperhatikan
                    </p>

                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 2.57h16.94A2 2 0 0022.18 18L13.71 3.86a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        DAFTAR PRODUK
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


        {{-- TABLE HEADER --}}
        <div class="flex flex-col gap-4 border-b border-slate-100 px-6 py-5
                    sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Daftar Produk
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Semua produk yang tersimpan di Stockify
                </p>

            </div>


            {{-- SEARCH --}}
            <div class="relative w-full sm:w-72">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                    />
                </svg>


                <input
                    type="text"
                    id="productSearch"
                    placeholder="Cari nama produk atau SKU..."
                    autocomplete="off"
                    class="w-full rounded-xl border border-slate-200
                           bg-slate-50 py-2.5 pl-10 pr-4
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           outline-none transition
                           focus:border-indigo-500
                           focus:bg-white
                           focus:ring-4 focus:ring-indigo-100"
                >

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[850px]">

                <thead class="bg-slate-50 border-b border-slate-100">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Produk
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Kategori
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Supplier
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                            Stok
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Harga Jual
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($products as $product)

                        @php
                            $stock = (int) ($product->stock ?? 0);
                            $minimumStock = (int) ($product->minimum_stock ?? 0);

                            if ($stock <= 0) {
                                $stockClass = 'bg-rose-50 text-rose-700 border-rose-100';
                                $stockLabel = 'Habis';
                            } elseif ($stock <= $minimumStock) {
                                $stockClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                $stockLabel = number_format($stock);
                            } else {
                                $stockClass = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                $stockLabel = number_format($stock);
                            }
                        @endphp


                        <tr
                            class="product-row transition-colors duration-150 hover:bg-indigo-50/30"
                            data-search="{{ strtolower(($product->name ?? '') . ' ' . ($product->sku ?? '') . ' ' . ($product->category->name ?? '') . ' ' . ($product->supplier->name ?? '')) }}"
                        >

                            {{-- PRODUK --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="h-11 w-11 shrink-0 overflow-hidden rounded-xl
                                                bg-indigo-50 flex items-center justify-center
                                                text-indigo-600 font-bold">

                                        @if($product->image)

                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="h-full w-full object-cover"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                            >

                                            <div
                                                style="display:none"
                                                class="h-full w-full items-center justify-center
                                                     text-sm font-bold text-indigo-600"
                                            >
                                                {{ strtoupper(substr($product->name ?? 'P', 0, 1)) }}
                                            </div>

                                        @else

                                            <span class="text-sm font-bold">
                                                {{ strtoupper(substr($product->name ?? 'P', 0, 1)) }}
                                            </span>

                                        @endif

                                    </div>


                                    <div>

                                        <p class="font-semibold text-slate-800">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            SKU: {{ $product->sku }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- KATEGORI --}}
                            <td class="px-6 py-4">

                                <span class="text-sm text-slate-600">
                                    {{ $product->category->name ?? '-' }}
                                </span>

                            </td>


                            {{-- SUPPLIER --}}
                            <td class="px-6 py-4">

                                <span class="text-sm text-slate-600">
                                    {{ $product->supplier->name ?? '-' }}
                                </span>

                            </td>


                            {{-- STOK --}}
                            <td class="px-6 py-4 text-center">

                                <span class="inline-flex items-center justify-center rounded-lg border px-3 py-1.5 text-xs font-bold {{ $stockClass }}">
                                    {{ $stockLabel }}
                                </span>

                                <div class="mt-1 text-[10px] text-slate-400">
                                    Min. {{ number_format($minimumStock) }}
                                </div>

                            </td>


                            {{-- HARGA --}}
                            <td class="px-6 py-4">

                                <span class="font-semibold text-slate-800">
                                    Rp {{ number_format((float) ($product->selling_price ?? 0), 0, ',', '.') }}
                                </span>

                            </td>


                            {{-- AKSI --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-2">


                                    {{-- DETAIL --}}
                                    <a
                                        href="{{ route('products.show', $product) }}"
                                        title="Lihat detail"
                                        class="group flex h-9 w-9 items-center justify-center rounded-lg
                                               border border-indigo-200 bg-indigo-50 text-indigo-600
                                               transition-all duration-200
                                               hover:border-indigo-300 hover:bg-indigo-100 hover:text-indigo-700"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"
                                            />
                                            <circle cx="12" cy="12" r="2.5"/>
                                        </svg>

                                    </a>


                                    {{-- EDIT --}}
                                    @auth
                                        @if (
                                            auth()->user()->role === 'Admin' ||
                                            auth()->user()->role === 'Manajer Gudang'
                                        )
                                            <a
                                                href="{{ route('products.edit', $product) }}"
                                                title="Edit produk"
                                                class="group flex h-9 w-9 items-center justify-center rounded-lg
                                                       border border-violet-200 bg-violet-50 text-violet-600
                                                       transition-all duration-200
                                                       hover:border-violet-300 hover:bg-violet-100 hover:text-violet-700"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m16.86 3.49 3.65 3.65M4 20l4.15-.9L19.6 7.65a2.58 2.58 0 0 0-3.65-3.65L4.5 15.8 4 20Z"
                                                    />
                                                </svg>

                                            </a>
                                        @endif
                                    @endauth


                                    {{-- DELETE --}}
                                    @auth
                                        @if(auth()->user()->role === 'Admin')

                                            <form
                                                method="POST"
                                                action="{{ route('products.destroy', $product) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus produk ini?');"
                                                style="display:inline;"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Hapus produk"
                                                    class="group flex h-9 w-9 items-center justify-center rounded-lg
                                                           border border-rose-200 bg-rose-50 text-rose-500
                                                           transition-all duration-200
                                                           hover:border-rose-300 hover:bg-rose-100 hover:text-rose-600"
                                                >

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M4 7h16M10 11v6m4-6v6M9 7V4h6v3m-9 0 1 14h10l1-14"
                                                        />
                                                    </svg>

                                                </button>

                                            </form>

                                        @endif
                                    @endauth

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- EMPTY STATE --}}
                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-500">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3.27 6.96L12 12l8.73-5.04M12 22V12"
                                            />
                                        </svg>

                                    </div>


                                    <h3 class="font-semibold text-slate-900">
                                        Belum ada produk
                                    </h3>


                                    <p class="mt-1 text-sm text-slate-500">
                                        Tambahkan produk pertama untuk mulai mengelola stok.

                                    </p>


                                    @auth
                                        @if (
                                            auth()->user()->role === 'Admin' ||
                                            auth()->user()->role === 'Manajer Gudang'
                                        )
                                            <a
                                                href="{{ route('products.create') }}"
                                                class="mt-5 inline-flex items-center gap-2 rounded-xl
                                                       bg-indigo-600 px-4 py-2.5
                                                       text-sm font-semibold text-white
                                                       transition hover:bg-indigo-700"
                                            >
                                                Tambah Produk
                                            </a>
                                        @endif
                                    @endauth

                                </div>

                            </td>

                        </tr>

                    @endforelse


                    {{-- SEARCH EMPTY STATE --}}
                    @if($products->count() > 0)

                        <tr id="productSearchEmpty" style="display:none;">

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                            />
                                        </svg>

                                    </div>


                                    <h3 class="font-semibold text-slate-900">
                                        Produk tidak ditemukan
                                    </h3>


                                    <p class="mt-1 text-sm text-slate-500">
                                        Coba gunakan nama produk, SKU, kategori, atau supplier yang berbeda.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endif

                </tbody>

            </table>

        </div>


        {{-- TABLE FOOTER --}}
        <div class="flex flex-col gap-2 border-t border-slate-100 px-6 py-4
                    sm:flex-row sm:items-center sm:justify-between">

            <p class="text-sm text-slate-500">

                Menampilkan

                <span class="font-semibold text-slate-700">
                    {{ $products->count() }}
                </span>

                produk

            </p>

            <p class="text-xs text-slate-400">
                Data produk diurutkan berdasarkan ID
            </p>

        </div>

    </div>

</div>


{{-- =========================================================
    SEARCH INTERAKTIF
========================================================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('productSearch');
    const rows = document.querySelectorAll('.product-row');
    const emptyState = document.getElementById('productSearchEmpty');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const keyword = this.value
            .toLowerCase()
            .trim();

        let visibleRows = 0;

        rows.forEach(function (row) {

            const searchableText = row.dataset.search || '';

            const matched = searchableText.includes(keyword);

            row.style.display = matched ? '' : 'none';

            if (matched) {
                visibleRows++;
            }

        });

        if (emptyState) {
            emptyState.style.display =
                keyword !== '' && visibleRows === 0
                    ? ''
                    : 'none';
        }

    });

});
</script>

@endsection