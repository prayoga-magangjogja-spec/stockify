@extends('layouts.app')

@section('title', 'Stock Opname - Stockify')

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
                        Stock Opname
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Periksa dan sesuaikan stok sistem dengan stok fisik.
                    </p>

                </div>


                <a href="{{ route('stock-opnames.create') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl
                          bg-gradient-to-r from-indigo-600 to-violet-600
                          text-white font-semibold
                          shadow-lg shadow-indigo-200
                          hover:from-indigo-700 hover:to-violet-700
                          hover:-translate-y-0.5
                          transition-all duration-200">

                    <span class="text-xl leading-none">
                        +
                    </span>

                    Stock Opname Baru

                </a>

            </div>

        </div>


        {{-- STATISTICS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">


            {{-- TOTAL OPNAME --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Opname
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $stockOpnames->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Seluruh pemeriksaan stok
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>

                    </div>

                </div>

            </div>


            {{-- SESUAI --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Stok Sesuai
                        </p>

                        <p class="mt-2 text-3xl font-bold text-emerald-600">
                            {{ $stockOpnames->where('difference', 0)->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Tidak ada selisih
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-emerald-50
                                flex items-center justify-center
                                text-emerald-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>

                    </div>

                </div>

            </div>


            {{-- LEBIH --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Stok Lebih
                        </p>

                        <p class="mt-2 text-3xl font-bold text-indigo-600">
                            {{ $stockOpnames->where('difference', '>', 0)->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Fisik lebih banyak
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg>

                    </div>

                </div>

            </div>


            {{-- KURANG --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Stok Kurang
                        </p>

                        <p class="mt-2 text-3xl font-bold text-red-600">
                            {{ $stockOpnames->where('difference', '<', 0)->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Fisik lebih sedikit
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-red-50
                                flex items-center justify-center
                                text-red-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7l-7 7-7-7" /></svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


            {{-- TABLE HEADER --}}
            <div class="px-6 py-5 border-b border-slate-100">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Riwayat Stock Opname
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Daftar pemeriksaan dan penyesuaian stok.
                        </p>

                    </div>


                    {{-- SEARCH --}}
                    <div class="relative w-full lg:w-80">

                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" /></svg>
                        </span>

                        <input
                            type="text"
                            id="opnameSearch"
                            placeholder="Cari produk atau petugas..."
                            class="w-full pl-11 pr-4 py-3 rounded-xl
                                   border border-slate-200
                                   bg-slate-50
                                   text-sm text-slate-700
                                   focus:outline-none
                                   focus:ring-2 focus:ring-indigo-500/20
                                   focus:border-indigo-500
                                   transition"
                        >

                    </div>

                </div>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1050px]">

                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr class="text-left">

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                No
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Produk
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Sistem
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Fisik
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Selisih
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Petugas
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="opnameTable" class="divide-y divide-slate-100">

                        @forelse($stockOpnames as $index => $opname)

                            <tr class="opname-row hover:bg-indigo-50/30 transition-colors duration-150">


                                {{-- NO --}}
                                <td class="px-6 py-4">

                                    <span class="inline-flex items-center justify-center
                                                 w-9 h-9 rounded-lg
                                                 bg-slate-100
                                                 text-sm font-semibold
                                                 text-slate-600">

                                        {{ $index + 1 }}

                                    </span>

                                </td>


                                {{-- PRODUK --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 rounded-xl
                                                    bg-indigo-50
                                                    flex items-center justify-center
                                                    text-indigo-600
                                                    font-bold">

                                            {{ strtoupper(substr($opname->product->name ?? 'P', 0, 1)) }}

                                        </div>

                                        <div>

                                            <p class="font-semibold text-slate-800">
                                                {{ $opname->product->name ?? '-' }}
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                SKU:
                                                {{ $opname->product->sku ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- SYSTEM --}}
                                <td class="px-6 py-4">

                                    <span class="font-semibold text-slate-700">
                                        {{ $opname->system_stock }}
                                    </span>

                                    <span class="text-xs text-slate-400">
                                        unit
                                    </span>

                                </td>


                                {{-- PHYSICAL --}}
                                <td class="px-6 py-4">

                                    <span class="font-bold text-slate-800">
                                        {{ $opname->physical_stock }}
                                    </span>

                                    <span class="text-xs text-slate-400">
                                        unit
                                    </span>

                                </td>


                                {{-- DIFFERENCE --}}
                                <td class="px-6 py-4">

                                    @if($opname->difference > 0)

                                        <span class="inline-flex items-center gap-2
                                                     px-3 py-1.5 rounded-full
                                                     bg-indigo-50 text-indigo-700
                                                     text-xs font-bold">

                                            +{{ $opname->difference }}

                                        </span>

                                    @elseif($opname->difference < 0)

                                        <span class="inline-flex items-center gap-2
                                                     px-3 py-1.5 rounded-full
                                                     bg-red-50 text-red-700
                                                     text-xs font-bold">

                                            {{ $opname->difference }}

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-2
                                                     px-3 py-1.5 rounded-full
                                                     bg-emerald-50 text-emerald-700
                                                     text-xs font-bold">

                                            0

                                        </span>

                                    @endif

                                </td>


                                {{-- USER --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-2">

                                        <div class="w-9 h-9 rounded-lg bg-slate-100
                                                    flex items-center justify-center
                                                    text-sm font-bold text-slate-600">

                                            {{ strtoupper(substr($opname->user->name ?? 'U', 0, 1)) }}

                                        </div>

                                        <span class="text-sm font-medium text-slate-700">

                                            {{ $opname->user->name ?? '-' }}

                                        </span>

                                    </div>

                                </td>


                                {{-- DATE --}}
                                <td class="px-6 py-4">

                                    <p class="text-sm font-medium text-slate-700">

                                        {{ $opname->date?->format('d/m/Y') }}

                                    </p>

                                </td>


                                {{-- ACTION --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center">

                                        <a href="{{ route('stock-opnames.show', $opname->id) }}"
                                           title="Detail"
                                           class="w-9 h-9 rounded-lg
                                                  bg-indigo-50
                                                  text-indigo-600
                                                  border border-indigo-100
                                                  flex items-center justify-center
                                                  hover:bg-indigo-600
                                                  hover:text-white
                                                  transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z" /><circle cx="12" cy="12" r="3" /></svg>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="w-16 h-16 rounded-2xl
                                                    bg-slate-100
                                                    flex items-center justify-center
                                                    text-2xl text-slate-400 mb-4">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>

                                        </div>

                                        <h3 class="font-bold text-slate-800">
                                            Belum ada stock opname
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">
                                            Belum terdapat pemeriksaan stok.
                                        </p>

                                        <a href="{{ route('stock-opnames.create') }}"
                                           class="mt-5 px-4 py-2.5 rounded-xl
                                                  bg-indigo-600
                                                  text-white text-sm
                                                  font-semibold
                                                  hover:bg-indigo-700
                                                  transition">

                                            + Buat Stock Opname

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- FOOTER --}}
            <div class="px-6 py-4 border-t border-slate-100
                        flex items-center justify-between">

                <p class="text-sm text-slate-500">

                    Menampilkan

                    <span class="font-semibold text-slate-700">
                        {{ $stockOpnames->count() }}
                    </span>

                    data stock opname

                </p>

                <p class="text-xs text-slate-400">
                    Data terbaru berada di bagian atas.
                </p>

            </div>

        </div>

    </div>

</div>


{{-- SEARCH --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('opnameSearch');

    const rows = document.querySelectorAll('.opname-row');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        rows.forEach(function (row) {

            const text = row.innerText.toLowerCase();

            row.style.display = text.includes(keyword)
                ? ''
                : 'none';

        });

    });

});

</script>

@endsection
