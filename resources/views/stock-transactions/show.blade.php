@extends('layouts.app')

@section('title', 'Detail Transaksi - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc]">

    <div class="max-w-[1200px] mx-auto px-6 py-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm
                    px-7 py-6 mb-7">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <div>

                    <div class="flex items-center gap-2 text-sm font-medium text-indigo-600 mb-2">

                        <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                        STOK / DETAIL

                    </div>

                    <h1 class="text-3xl font-bold text-slate-900">
                        Detail Transaksi
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Informasi lengkap transaksi stok.
                    </p>

                </div>


                <a href="{{ route('stock-transactions.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl
                          border border-slate-200 bg-white
                          text-slate-700 font-semibold text-sm
                          hover:bg-slate-50 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7" /></svg> Kembali

                </a>

            </div>

        </div>


        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 flex items-center gap-3">
                <span><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg></span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if(session('error'))
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-semibold text-rose-700 flex items-center gap-3">
                <span>!</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif


        {{-- MAIN --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- TRANSACTION STATUS --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <p class="text-sm font-medium text-slate-500 mb-4">
                    Status Transaksi
                </p>

                @php
                    $isMasuk = strtolower((string)$transaction->type) === 'masuk' || strtolower((string)$transaction->type) === 'in';
                @endphp

                @if($isMasuk)

                    <div class="rounded-2xl bg-emerald-50 border border-emerald-100
                                p-6 text-center">

                        <div class="w-16 h-16 mx-auto rounded-2xl bg-emerald-100
                                    flex items-center justify-center
                                    text-emerald-600 text-3xl mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7l-7 7-7-7" /></svg>

                        </div>

                        <h2 class="text-xl font-bold text-emerald-700">
                            Stock In (Masuk)
                        </h2>

                        <p class="text-sm text-emerald-600 mt-1">
                            Barang masuk
                        </p>

                    </div>

                @else

                    <div class="rounded-2xl bg-red-50 border border-red-100
                                p-6 text-center">

                        <div class="w-16 h-16 mx-auto rounded-2xl bg-red-100
                                    flex items-center justify-center
                                    text-red-600 text-3xl mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg>

                        </div>

                        <h2 class="text-xl font-bold text-red-700">
                            Stock Out (Keluar)
                        </h2>

                        <p class="text-sm text-red-600 mt-1">
                            Barang keluar
                        </p>

                    </div>

                @endif


                {{-- STATUS BADGE --}}
                <div class="mt-6 pt-6 border-t border-slate-100 text-center">

                    <p class="text-xs text-slate-400 mb-2">
                        Status Saat Ini
                    </p>

                    @if($transaction->status === 'Pending')
                        <span class="inline-flex px-3 py-1.5 text-xs font-bold text-amber-700 rounded-lg bg-amber-50 border border-amber-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Pending
                        </span>
                    @elseif($transaction->status === 'Diterima')
                        <span class="inline-flex px-3 py-1.5 text-xs font-bold text-emerald-700 rounded-lg bg-emerald-50 border border-emerald-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg> Diterima
                        </span>
                    @elseif($transaction->status === 'Dikeluarkan')
                        <span class="inline-flex px-3 py-1.5 text-xs font-bold text-red-700 rounded-lg bg-red-50 border border-red-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg> Dikeluarkan
                        </span>
                    @elseif($transaction->status === 'Ditolak')
                        <span class="inline-flex px-3 py-1.5 text-xs font-bold text-rose-700 rounded-lg bg-rose-50 border border-rose-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg> Ditolak
                        </span>
                    @else
                        <span class="inline-flex px-3 py-1.5 text-xs font-bold text-slate-700 rounded-lg bg-slate-50 border border-slate-200">
                            {{ $transaction->status }}
                        </span>
                    @endif

                </div>


                {{-- APPROVAL ACTION BUTTONS (HANYA UNTUK PENDING & ADMIN/MANAJER GUDANG) --}}
                @auth
                    @if(
                        $transaction->status === 'Pending' &&
                        (auth()->user()->role === 'Admin' || auth()->user()->role === 'Manajer Gudang')
                    )

                        <div class="mt-6 pt-6 border-t border-slate-100 space-y-3">

                            <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 text-center">
                                Pilihan Persetujuan
                            </p>

                            {{-- SETUJUI --}}
                            <form action="{{ route('stock-transactions.update-status', $transaction->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                @if($isMasuk)
                                    <input type="hidden" name="status" value="Diterima">
                                    <button type="submit"
                                            class="w-full py-3 px-4 rounded-xl bg-emerald-600 text-white font-bold text-sm shadow-md hover:bg-emerald-700 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg> Setujui (Terima Barang)
                                    </button>
                                @else
                                    <input type="hidden" name="status" value="Dikeluarkan">
                                    <button type="submit"
                                            class="w-full py-3 px-4 rounded-xl bg-red-600 text-white font-bold text-sm shadow-md hover:bg-red-700 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg> Setujui (Keluarkan Barang)
                                    </button>
                                @endif
                            </form>

                            {{-- TOLAK --}}
                            <form action="{{ route('stock-transactions.update-status', $transaction->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit"
                                        class="w-full py-3 px-4 rounded-xl bg-white border border-rose-200 text-rose-600 font-bold text-sm hover:bg-rose-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg> Tolak Transaksi
                                </button>
                            </form>

                        </div>

                    @endif
                @endauth


                <div class="mt-6 pt-6 border-t border-slate-100 text-center">

                    <p class="text-sm text-slate-500">
                        Jumlah
                    </p>

                    <p class="text-4xl font-bold text-slate-900 mt-1">
                        {{ number_format($transaction->quantity) }}
                    </p>

                    <p class="text-sm text-slate-400">
                        unit
                    </p>

                </div>

            </div>


            {{-- DETAIL --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200
                        shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100">

                    <h2 class="text-lg font-bold text-slate-900">
                        Informasi Transaksi
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Data transaksi yang tercatat di sistem.
                    </p>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- PRODUCT --}}
                        <div>

                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Produk
                            </p>

                            <div class="flex items-center gap-3 mt-3">

                                <div class="w-11 h-11 rounded-xl bg-indigo-50
                                            flex items-center justify-center
                                            text-indigo-600 font-bold">

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

                        </div>


                        {{-- QUANTITY --}}
                        <div>

                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Jumlah
                            </p>

                            <p class="text-2xl font-bold text-slate-900 mt-2">
                                {{ number_format($transaction->quantity) }}
                                <span class="text-sm font-medium text-slate-400">
                                    unit
                                </span>
                            </p>

                        </div>


                        {{-- DATE --}}
                        <div>

                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Tanggal Transaksi
                            </p>

                            <p class="font-semibold text-slate-800 mt-2">
                                {{ $transaction->date?->format('d F Y') ?? $transaction->created_at?->format('d F Y') }}
                            </p>

                            <p class="text-sm text-slate-400 mt-1">
                                {{ $transaction->created_at?->format('H:i') }} WIB
                            </p>

                        </div>


                        {{-- USER --}}
                        <div>

                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Dicatat Oleh
                            </p>

                            <p class="font-semibold text-slate-800 mt-2">
                                {{ $transaction->user->name ?? 'Administrator' }}
                            </p>

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="mt-7 pt-6 border-t border-slate-100">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Keterangan / Catatan
                        </p>

                        <div class="mt-3 rounded-xl bg-slate-50 border border-slate-100
                                    p-4 text-sm text-slate-600 leading-relaxed">

                            {{ $transaction->notes ?? $transaction->description ?? 'Tidak ada keterangan.' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
