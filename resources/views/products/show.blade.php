@extends('layouts.app')

@section('title', 'Detail Produk - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc]">

    <div class="max-w-[1600px] mx-auto px-6 py-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-7 py-6 mb-7">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>

                    <div class="flex items-center gap-2 text-sm font-medium text-indigo-600 mb-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                        INVENTORY
                    </div>

                    <h1 class="text-3xl font-bold text-slate-900">
                        Detail Produk
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Informasi lengkap produk dan kondisi stok.
                    </p>

                </div>

                <div class="flex items-center gap-3">

                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-3 rounded-xl
                              bg-slate-100 text-slate-700 font-semibold
                              hover:bg-slate-200 transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7" /></svg> Kembali

                    </a>

                    <a href="{{ route('products.edit', $product) }}"
                       class="inline-flex items-center gap-2 px-5 py-3 rounded-xl
                              bg-gradient-to-r from-indigo-600 to-violet-600
                              text-white font-semibold shadow-lg shadow-indigo-200
                              hover:from-indigo-700 hover:to-violet-700
                              transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4z" /></svg> Edit Produk

                    </a>

                </div>

            </div>

        </div>


        {{-- PRODUCT OVERVIEW --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

            {{-- IMAGE CARD --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <div class="aspect-square rounded-2xl bg-slate-50
                            border border-slate-100 overflow-hidden
                            flex items-center justify-center">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                        >

                    @else

                        <div class="flex flex-col items-center justify-center text-slate-400">

                            <div class="w-20 h-20 rounded-2xl bg-indigo-50
                                        flex items-center justify-center
                                        text-indigo-500 text-3xl font-bold mb-3">

                                {{ strtoupper(substr($product->name ?? 'P', 0, 1)) }}

                            </div>

                            <p class="text-sm">
                                Tidak ada gambar produk
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- PRODUCT INFORMATION --}}
            <div class="xl:col-span-2 bg-white rounded-2xl
                        border border-slate-200 shadow-sm p-7">

                <div class="flex flex-col sm:flex-row
                            sm:items-start sm:justify-between gap-4 mb-7">

                    <div>

                        <p class="text-sm font-medium text-slate-400 mb-1">
                            Nama Produk
                        </p>

                        <h2 class="text-2xl font-bold text-slate-900">
                            {{ $product->name }}
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            SKU: {{ $product->sku ?? '-' }}
                        </p>

                    </div>


                    {{-- STOCK STATUS --}}
                    @if($product->stock <= $product->minimum_stock)

                        <span class="inline-flex items-center gap-2
                                     px-4 py-2 rounded-full
                                     bg-red-50 text-red-700
                                     text-sm font-bold">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            Stok Menipis

                        </span>

                    @else

                        <span class="inline-flex items-center gap-2
                                     px-4 py-2 rounded-full
                                     bg-emerald-50 text-emerald-700
                                     text-sm font-bold">

                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                            Stok Aman

                        </span>

                    @endif

                </div>


                {{-- INFO GRID --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                    {{-- CATEGORY --}}
                    <div class="rounded-xl bg-slate-50 border border-slate-100 p-5">

                        <p class="text-xs font-semibold uppercase
                                  tracking-wider text-slate-400 mb-2">

                            Kategori

                        </p>

                        <p class="font-semibold text-slate-800">

                            {{ $product->category->name ?? '-' }}

                        </p>

                    </div>


                    {{-- SUPPLIER --}}
                    <div class="rounded-xl bg-slate-50 border border-slate-100 p-5">

                        <p class="text-xs font-semibold uppercase
                                  tracking-wider text-slate-400 mb-2">

                            Supplier

                        </p>

                        <p class="font-semibold text-slate-800">

                            {{ $product->supplier->name ?? '-' }}

                        </p>

                    </div>


                    {{-- PURCHASE PRICE --}}
                    <div class="rounded-xl bg-slate-50 border border-slate-100 p-5">

                        <p class="text-xs font-semibold uppercase
                                  tracking-wider text-slate-400 mb-2">

                            Harga Beli

                        </p>

                        <p class="text-lg font-bold text-slate-800">

                            Rp {{ number_format(
                                $product->purchase_price,
                                0,
                                ',',
                                '.'
                            ) }}

                        </p>

                    </div>


                    {{-- SELLING PRICE --}}
                    <div class="rounded-xl bg-slate-50 border border-slate-100 p-5">

                        <p class="text-xs font-semibold uppercase
                                  tracking-wider text-slate-400 mb-2">

                            Harga Jual

                        </p>

                        <p class="text-lg font-bold text-indigo-600">

                            Rp {{ number_format(
                                $product->selling_price,
                                0,
                                ',',
                                '.'
                            ) }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- STOCK SUMMARY --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">


            {{-- CURRENT STOCK --}}
            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Stok Saat Ini
                        </p>

                        <p class="mt-2 text-3xl font-bold text-indigo-600">

                            {{ number_format($product->stock, 0, ',', '.') }}

                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Unit tersedia
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.27 6.96L12 12l8.73-5.04M12 22V12" /></svg>

                    </div>

                </div>

            </div>


            {{-- MINIMUM STOCK --}}
            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Minimum Stok
                        </p>

                        <p class="mt-2 text-3xl font-bold text-amber-600">

                            {{ number_format($product->minimum_stock, 0, ',', '.') }}

                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Batas minimum stok
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-amber-50
                                flex items-center justify-center
                                text-amber-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 2.57h16.94A2 2 0 0022.18 18L13.71 3.86a2 2 0 00-3.42 0z" /></svg>

                    </div>

                </div>

            </div>


            {{-- STOCK DIFFERENCE --}}
            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Selisih Stok
                        </p>

                        @php
                            $stockDifference = $product->stock - $product->minimum_stock;
                        @endphp

                        <p class="mt-2 text-3xl font-bold
                                  {{ $stockDifference < 0
                                      ? 'text-red-600'
                                      : 'text-emerald-600' }}">

                            {{ $stockDifference > 0 ? '+' : '' }}{{ number_format($stockDifference, 0, ',', '.') }}

                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Dibanding minimum stok
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl
                                {{ $stockDifference < 0
                                    ? 'bg-red-50 text-red-600'
                                    : 'bg-emerald-50 text-emerald-600' }}
                                flex items-center justify-center text-xl">

                        @if ($stockDifference < 0)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7l-7 7-7-7" /></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg>
                    @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- ATTRIBUTES --}}
        @if(isset($product->attributes) && $product->attributes->count())

            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm overflow-hidden mb-6">

                <div class="px-6 py-5 border-b border-slate-100">

                    <h2 class="text-lg font-bold text-slate-900">
                        Atribut Produk
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Informasi tambahan mengenai produk.
                    </p>

                </div>

                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        @foreach($product->attributes as $attribute)

                            <div class="rounded-xl bg-slate-50
                                        border border-slate-100 p-5">

                                <p class="text-xs font-semibold uppercase
                                          tracking-wider text-slate-400 mb-2">

                                    {{ $attribute->name ?? 'Atribut' }}

                                </p>

                                <p class="font-semibold text-slate-800">

                                    {{ $attribute->value ?? '-' }}

                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        @endif


        {{-- PRODUCT TIMESTAMPS --}}
        <div class="bg-white rounded-2xl border border-slate-200
                    shadow-sm p-6">

            <div class="flex flex-col md:flex-row
                        md:items-center md:justify-between gap-4">

                <div>

                    <p class="text-xs font-semibold uppercase
                              tracking-wider text-slate-400">

                        Dibuat

                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">

                        {{ $product->created_at?->format('d F Y, H:i') ?? '-' }}

                    </p>

                </div>


                <div class="hidden md:block w-px h-10 bg-slate-200"></div>


                <div>

                    <p class="text-xs font-semibold uppercase
                              tracking-wider text-slate-400">

                        Terakhir diperbarui

                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">

                        {{ $product->updated_at?->format('d F Y, H:i') ?? '-' }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
