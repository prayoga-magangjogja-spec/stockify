@extends('layouts.app')

@section('title', 'Transaksi Stok - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc]">

    <div class="max-w-[1600px] mx-auto px-6 py-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-7 py-6 mb-7">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>

                    <div class="flex items-center gap-2 text-sm font-medium text-indigo-600 mb-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                        STOK
                    </div>

                    <h1 class="text-3xl font-bold text-slate-900">
                        Transaksi Stok
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Kelola seluruh transaksi barang masuk dan keluar.
                    </p>

                </div>

                <a href="{{ route('stock-transactions.create') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl
                          bg-gradient-to-r from-indigo-600 to-violet-600
                          text-white font-semibold
                          shadow-lg shadow-indigo-200
                          hover:from-indigo-700 hover:to-violet-700
                          hover:-translate-y-0.5 transition-all duration-200">

                    <span class="text-xl leading-none">+</span>

                    Transaksi Baru

                </a>

            </div>

        </div>


        {{-- STATISTICS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">


            {{-- TOTAL TRANSAKSI --}}
            <div class="relative overflow-hidden bg-white rounded-2xl border border-slate-200
                        shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Transaksi
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $transactions->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Seluruh transaksi
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4" /></svg>

                    </div>

                </div>

            </div>


            {{-- STOCK IN --}}
            <div class="relative overflow-hidden bg-white rounded-2xl border border-slate-200
                        shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Stock In
                        </p>

                        <p class="mt-2 text-3xl font-bold text-emerald-600">
                            {{ $transactions->where('type', 'Masuk')->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Barang masuk
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-emerald-50
                                flex items-center justify-center
                                text-emerald-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7l-7 7-7-7" /></svg>

                    </div>

                </div>

            </div>


            {{-- STOCK OUT --}}
            <div class="relative overflow-hidden bg-white rounded-2xl border border-slate-200
                        shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Stock Out
                        </p>

                        <p class="mt-2 text-3xl font-bold text-red-600">
                            {{ $transactions->where('type', 'Keluar')->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Barang keluar
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-red-50
                                flex items-center justify-center
                                text-red-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg>

                    </div>

                </div>

            </div>


            {{-- TOTAL UNIT --}}
            <div class="relative overflow-hidden bg-white rounded-2xl border border-slate-200
                        shadow-sm p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Unit
                        </p>

                        <p class="mt-2 text-3xl font-bold text-indigo-600">
                            {{ $transactions->sum('quantity') }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Jumlah unit transaksi
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.27 6.96L12 12l8.73-5.04M12 22V12" /></svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- TABLE CARD --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


            {{-- CARD HEADER --}}
            <div class="px-6 py-5 border-b border-slate-100">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Daftar Transaksi
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Riwayat seluruh transaksi stok Stockify.
                        </p>

                    </div>


                    {{-- SEARCH --}}
                    <div class="relative w-full lg:w-80">

                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" /></svg>
                        </span>

                        <input
                            type="text"
                            id="transactionSearch"
                            placeholder="Cari transaksi..."
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

                <table class="w-full min-w-[1000px]">

                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr class="text-left">

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                No
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Produk
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Tipe
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Jumlah
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Keterangan
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="transactionTable" class="divide-y divide-slate-100">

                        @forelse($transactions as $index => $transaction)

                            <tr class="transaction-row hover:bg-indigo-50/30 transition-colors duration-150">


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

                                            {{ strtoupper(substr($transaction->product->name ?? 'P', 0, 1)) }}

                                        </div>


                                        <div>

                                            <p class="font-semibold text-slate-800">

                                                {{ $transaction->product->name ?? '-' }}

                                            </p>

                                            <p class="text-xs text-slate-400">

                                                SKU:
                                                {{ $transaction->product->sku ?? '-' }}

                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- TYPE --}}
                                <td class="px-6 py-4">

                                    @if($transaction->type === 'Masuk')

                                        {{-- STOCK IN --}}

                                        <span class="inline-flex items-center gap-2
                                                     px-3 py-1.5
                                                     rounded-full
                                                     bg-emerald-50
                                                     text-emerald-700
                                                     text-xs font-bold">

                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                            Stock In

                                        </span>


                                    @elseif($transaction->type === 'Keluar')

                                        {{-- STOCK OUT --}}

                                        <span class="inline-flex items-center gap-2
                                                     px-3 py-1.5
                                                     rounded-full
                                                     bg-red-50
                                                     text-red-700
                                                     text-xs font-bold">

                                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                            Stock Out

                                        </span>


                                    @else

                                        {{-- UNKNOWN TYPE --}}

                                        <span class="inline-flex items-center gap-2
                                                     px-3 py-1.5
                                                     rounded-full
                                                     bg-slate-100
                                                     text-slate-600
                                                     text-xs font-bold">

                                            {{ $transaction->type }}

                                        </span>

                                    @endif

                                </td>


                                {{-- QUANTITY --}}
                                <td class="px-6 py-4">

                                    <span class="font-bold text-slate-800">
                                        {{ $transaction->quantity }}
                                    </span>

                                    <span class="text-xs text-slate-400">
                                        unit
                                    </span>

                                </td>


                                {{-- KETERANGAN --}}
                                <td class="px-6 py-4 max-w-[250px]">

                                    <p class="text-sm text-slate-600 truncate">

                                        {{ $transaction->description ?? $transaction->notes ?? '-' }}

                                    </p>

                                </td>


                                {{-- DATE --}}
                                <td class="px-6 py-4">

                                    <p class="text-sm font-medium text-slate-700">

                                        {{ $transaction->created_at?->format('d/m/Y') }}

                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">

                                        {{ $transaction->created_at?->format('H:i') }}

                                    </p>

                                </td>


                                {{-- ACTION --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('stock-transactions.show', $transaction->id) }}"
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

                            {{-- EMPTY STATE --}}

                            <tr>

                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="w-16 h-16 rounded-2xl
                                                    bg-slate-100
                                                    flex items-center justify-center
                                                    text-2xl
                                                    text-slate-400
                                                    mb-4">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4" /></svg>

                                        </div>

                                        <h3 class="font-bold text-slate-800">

                                            Belum ada transaksi

                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">

                                            Belum terdapat transaksi stok.

                                        </p>

                                        <a href="{{ route('stock-transactions.create') }}"
                                           class="mt-5 px-4 py-2.5 rounded-xl
                                                  bg-indigo-600
                                                  text-white
                                                  text-sm
                                                  font-semibold
                                                  hover:bg-indigo-700
                                                  transition">

                                            + Tambah Transaksi

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

                        {{ $transactions->count() }}

                    </span>

                    transaksi

                </p>

                <p class="text-xs text-slate-400">

                    Transaksi terbaru berada di bagian bawah.

                </p>

            </div>

        </div>

    </div>

</div>


{{-- SEARCH SCRIPT --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('transactionSearch');

    const rows = document.querySelectorAll('.transaction-row');


    if (!searchInput) {
        return;
    }


    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();


        rows.forEach(function (row) {

            const text = row.innerText.toLowerCase();

            row.style.display = text.includes(keyword) ? '' : 'none';

        });

    });

});

</script>

@endsection
