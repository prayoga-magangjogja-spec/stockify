@extends('layouts.app')

@section('title', 'Detail Stock Opname - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc]">

    <div class="max-w-[1200px] mx-auto px-6 py-6">


        {{-- BACK --}}
        <a href="{{ route('stock-opnames.index') }}"
           class="inline-flex items-center gap-2
                  text-sm font-medium text-slate-500
                  hover:text-indigo-600 transition mb-5">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7" /></svg> Kembali ke Stock Opname

        </a>


        {{-- HEADER --}}
        <div class="bg-white rounded-2xl
                    border border-slate-200
                    shadow-sm px-7 py-6 mb-6">

            <div class="flex flex-col md:flex-row
                        md:items-center
                        md:justify-between gap-5">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl
                                bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>

                    </div>

                    <div>

                        <div class="flex items-center gap-2
                                    text-sm font-medium
                                    text-indigo-600 mb-1">

                            <span class="w-2 h-2 rounded-full
                                         bg-indigo-600"></span>

                            STOCK OPNAME

                        </div>

                        <h1 class="text-2xl font-bold text-slate-900">
                            Detail Stock Opname
                        </h1>

                        <p class="text-sm text-slate-500 mt-1">

                            {{ $stockOpname->date?->format('d F Y') }}

                        </p>

                    </div>

                </div>


                {{-- DIFFERENCE STATUS --}}
                <div>

                    @if($stockOpname->difference > 0)

                        <span class="inline-flex items-center gap-2
                                     px-4 py-2 rounded-full
                                     bg-indigo-50 text-indigo-700
                                     text-sm font-bold">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg> Stok Lebih

                        </span>

                    @elseif($stockOpname->difference < 0)

                        <span class="inline-flex items-center gap-2
                                     px-4 py-2 rounded-full
                                     bg-red-50 text-red-700
                                     text-sm font-bold">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7l-7 7-7-7" /></svg> Stok Kurang

                        </span>

                    @else

                        <span class="inline-flex items-center gap-2
                                     px-4 py-2 rounded-full
                                     bg-emerald-50 text-emerald-700
                                     text-sm font-bold">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg> Stok Sesuai

                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- PRODUCT CARD --}}
        <div class="bg-white rounded-2xl
                    border border-slate-200
                    shadow-sm p-6 mb-6">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-xl
                            bg-indigo-50
                            flex items-center justify-center
                            text-indigo-600
                            text-xl font-bold">

                    {{ strtoupper(substr($stockOpname->product->name ?? 'P', 0, 1)) }}

                </div>

                <div>

                    <p class="text-sm text-slate-400">
                        Produk
                    </p>

                    <h2 class="text-xl font-bold text-slate-900">
                        {{ $stockOpname->product->name ?? '-' }}
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">

                        SKU:
                        {{ $stockOpname->product->sku ?? '-' }}

                    </p>

                </div>

            </div>

        </div>


        {{-- STOCK COMPARISON --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">


            {{-- SYSTEM --}}
            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm p-6">

                <p class="text-sm font-medium text-slate-500">
                    Stok Sistem
                </p>

                <div class="flex items-end gap-2 mt-3">

                    <span class="text-4xl font-bold text-slate-900">

                        {{ $stockOpname->system_stock }}

                    </span>

                    <span class="text-sm text-slate-400 mb-1">
                        unit
                    </span>

                </div>

                <p class="text-xs text-slate-400 mt-3">
                    Jumlah stok sebelum pemeriksaan.
                </p>

            </div>


            {{-- PHYSICAL --}}
            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm p-6">

                <p class="text-sm font-medium text-slate-500">
                    Stok Fisik
                </p>

                <div class="flex items-end gap-2 mt-3">

                    <span class="text-4xl font-bold text-indigo-600">

                        {{ $stockOpname->physical_stock }}

                    </span>

                    <span class="text-sm text-slate-400 mb-1">
                        unit
                    </span>

                </div>

                <p class="text-xs text-slate-400 mt-3">
                    Jumlah barang yang ditemukan secara fisik.
                </p>

            </div>


            {{-- DIFFERENCE --}}
            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm p-6">

                <p class="text-sm font-medium text-slate-500">
                    Selisih
                </p>

                <div class="flex items-end gap-2 mt-3">

                    @if($stockOpname->difference > 0)

                        <span class="text-4xl font-bold text-indigo-600">
                            +{{ $stockOpname->difference }}
                        </span>

                    @elseif($stockOpname->difference < 0)

                        <span class="text-4xl font-bold text-red-600">
                            {{ $stockOpname->difference }}
                        </span>

                    @else

                        <span class="text-4xl font-bold text-emerald-600">
                            0
                        </span>

                    @endif

                    <span class="text-sm text-slate-400 mb-1">
                        unit
                    </span>

                </div>

                <p class="text-xs text-slate-400 mt-3">

                    Fisik − sistem

                </p>

            </div>

        </div>


        {{-- INFORMATION --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- DETAIL --}}
            <div class="lg:col-span-2
                        bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm overflow-hidden">

                <div class="px-6 py-5
                            border-b border-slate-100">

                    <h2 class="text-lg font-bold text-slate-900">
                        Informasi Pemeriksaan
                    </h2>

                </div>


                <div class="p-6">


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- DATE --}}
                        <div>

                            <p class="text-xs font-bold
                                      uppercase tracking-wider
                                      text-slate-400">

                                Tanggal

                            </p>

                            <p class="mt-2 text-sm
                                      font-semibold text-slate-800">

                                {{ $stockOpname->date?->format('d F Y') }}

                            </p>

                        </div>


                        {{-- USER --}}
                        <div>

                            <p class="text-xs font-bold
                                      uppercase tracking-wider
                                      text-slate-400">

                                Petugas

                            </p>

                            <div class="flex items-center gap-2 mt-2">

                                <div class="w-8 h-8 rounded-lg
                                            bg-slate-100
                                            flex items-center justify-center
                                            text-xs font-bold
                                            text-slate-600">

                                    {{ strtoupper(substr($stockOpname->user->name ?? 'U', 0, 1)) }}

                                </div>

                                <p class="text-sm font-semibold
                                          text-slate-800">

                                    {{ $stockOpname->user->name ?? '-' }}

                                </p>

                            </div>

                        </div>


                        {{-- NOTES --}}
                        <div class="md:col-span-2">

                            <p class="text-xs font-bold
                                      uppercase tracking-wider
                                      text-slate-400">

                                Catatan

                            </p>

                            <div class="mt-2 rounded-xl
                                        bg-slate-50
                                        border border-slate-100
                                        p-4">

                                <p class="text-sm
                                          text-slate-600
                                          leading-6">

                                    {{ $stockOpname->notes ?: 'Tidak ada catatan.' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- SUMMARY --}}
            <div class="bg-gradient-to-br
                        from-indigo-600
                        to-violet-600
                        rounded-2xl
                        shadow-lg
                        shadow-indigo-200
                        p-6 text-white">

                <p class="text-sm text-indigo-100">
                    Ringkasan
                </p>

                <h3 class="text-xl font-bold mt-1">
                    Hasil Pemeriksaan
                </h3>


                <div class="mt-6 space-y-4">


                    <div class="flex items-center justify-between
                                border-b border-white/10 pb-4">

                        <span class="text-sm text-indigo-100">
                            Stok Sistem
                        </span>

                        <span class="font-bold">
                            {{ $stockOpname->system_stock }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between
                                border-b border-white/10 pb-4">

                        <span class="text-sm text-indigo-100">
                            Stok Fisik
                        </span>

                        <span class="font-bold">
                            {{ $stockOpname->physical_stock }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between">

                        <span class="text-sm text-indigo-100">
                            Selisih
                        </span>

                        <span class="text-xl font-bold">

                            @if($stockOpname->difference > 0)
                                +{{ $stockOpname->difference }}
                            @else
                                {{ $stockOpname->difference }}
                            @endif

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
