@extends('layouts.app')

@section('title', 'Transaksi Baru - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc]">

    <div class="max-w-[1500px] mx-auto px-6 py-7">

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-7 py-6 mb-6">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>

                    <div class="flex items-center gap-2 text-sm font-semibold text-indigo-600 mb-2">

                        <span class="w-2 h-2 rounded-full bg-indigo-600"></span>

                        STOK

                    </div>

                    <h1 class="text-3xl font-bold text-slate-900">
                        Transaksi Baru
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Catat barang masuk atau barang keluar dari gudang.
                    </p>

                </div>


                <a href="{{ route('stock-transactions.index') }}"
                   class="inline-flex items-center justify-center gap-2
                          px-5 py-3 rounded-xl
                          border border-slate-200
                          bg-white
                          text-slate-700
                          font-semibold
                          hover:bg-slate-50
                          transition">

                    <span class="text-lg"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7" /></svg></span>

                    Kembali

                </a>

            </div>

        </div>


        {{-- ERROR VALIDATION --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex gap-3">

                    <div class="w-9 h-9 rounded-lg bg-red-100
                                flex items-center justify-center
                                text-red-600 font-bold">

                        !

                    </div>

                    <div>

                        <h3 class="font-bold text-red-800">
                            Terdapat kesalahan
                        </h3>

                        <ul class="mt-1 text-sm text-red-700 list-disc list-inside">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- FORM --}}
        <form action="{{ route('stock-transactions.store') }}"
              method="POST"
              id="transactionForm">

            @csrf


            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


                {{-- LEFT FORM --}}
                <div class="xl:col-span-2 space-y-6">


                    {{-- TRANSACTION TYPE --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                        <div class="mb-5">

                            <h2 class="text-lg font-bold text-slate-900">
                                Jenis Transaksi
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                Tentukan apakah barang masuk atau keluar dari gudang.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                            {{-- MASUK --}}
                            <label class="relative cursor-pointer">

                                <input
                                    type="radio"
                                    name="type"
                                    value="Masuk"
                                    class="peer sr-only"
                                    {{ old('type', 'Masuk') === 'Masuk' ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border-2 border-slate-200
                                            p-5
                                            transition-all duration-200
                                            peer-checked:border-emerald-500
                                            peer-checked:bg-emerald-50
                                            hover:border-emerald-300">

                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-xl
                                                    bg-emerald-100
                                                    text-emerald-600
                                                    flex items-center justify-center
                                                    text-xl font-bold">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7l-7 7-7-7" /></svg>

                                        </div>

                                        <div>

                                            <p class="font-bold text-slate-900">
                                                Stock In
                                            </p>

                                            <p class="text-sm text-slate-500">
                                                Barang masuk ke gudang
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>


                            {{-- KELUAR --}}
                            <label class="relative cursor-pointer">

                                <input
                                    type="radio"
                                    name="type"
                                    value="Keluar"
                                    class="peer sr-only"
                                    {{ old('type') === 'Keluar' ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border-2 border-slate-200
                                            p-5
                                            transition-all duration-200
                                            peer-checked:border-red-500
                                            peer-checked:bg-red-50
                                            hover:border-red-300">

                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-xl
                                                    bg-red-100
                                                    text-red-600
                                                    flex items-center justify-center
                                                    text-xl font-bold">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m-7 7l7-7 7 7" /></svg>

                                        </div>

                                        <div>

                                            <p class="font-bold text-slate-900">
                                                Stock Out
                                            </p>

                                            <p class="text-sm text-slate-500">
                                                Barang keluar dari gudang
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>


                    {{-- PRODUCT --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                        <div class="mb-5">

                            <h2 class="text-lg font-bold text-slate-900">
                                Informasi Barang
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                Pilih produk dan tentukan jumlah unit transaksi.
                            </p>

                        </div>


                        {{-- PRODUCT --}}
                        <div class="mb-5">

                            <label for="product_id"
                                   class="block text-sm font-semibold text-slate-700 mb-2">

                                Produk

                                <span class="text-red-500">*</span>

                            </label>


                            <select
                                name="product_id"
                                id="product_id"
                                required
                                class="w-full px-4 py-3 rounded-xl
                                       border border-slate-200
                                       bg-white
                                       text-slate-800
                                       focus:outline-none
                                       focus:ring-4
                                       focus:ring-indigo-500/10
                                       focus:border-indigo-500
                                       transition">

                                <option value="">
                                    Pilih produk
                                </option>

                                @foreach ($products as $product)

                                    <option
                                        value="{{ $product->id }}"
                                        data-stock="{{ $product->stock ?? 0 }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}
                                    >

                                        {{ $product->name }}

                                        — SKU: {{ $product->sku }}

                                    </option>

                                @endforeach

                            </select>

                            @error('product_id')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- STOCK INFORMATION --}}
                        <div id="stockInfo"
                             class="hidden mb-5 rounded-xl border border-indigo-100
                                    bg-indigo-50 px-4 py-4">

                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-lg
                                                bg-white
                                                flex items-center justify-center
                                                text-indigo-600">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.27 6.96L12 12l8.73-5.04M12 22V12" /></svg>

                                    </div>

                                    <div>

                                        <p class="text-xs font-medium text-indigo-500">
                                            STOK SAAT INI
                                        </p>

                                        <p id="currentStock"
                                           class="text-lg font-bold text-indigo-900">

                                            0 unit

                                        </p>

                                    </div>

                                </div>

                                <div class="text-right">

                                    <p class="text-xs text-slate-500">
                                        Status
                                    </p>

                                    <p id="stockStatus"
                                       class="text-sm font-bold text-emerald-600">

                                        Aman

                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- QUANTITY --}}
                        <div class="mb-5">

                            <label for="quantity"
                                   class="block text-sm font-semibold text-slate-700 mb-2">

                                Jumlah

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <input
                                    type="number"
                                    name="quantity"
                                    id="quantity"
                                    value="{{ old('quantity', 1) }}"
                                    min="1"
                                    required
                                    class="w-full px-4 py-3 pr-20 rounded-xl
                                           border border-slate-200
                                           bg-white
                                           text-slate-800
                                           font-semibold
                                           focus:outline-none
                                           focus:ring-4
                                           focus:ring-indigo-500/10
                                           focus:border-indigo-500
                                           transition"
                                >

                                <span class="absolute right-4 top-1/2
                                             -translate-y-1/2
                                             text-sm text-slate-400">

                                    unit

                                </span>

                            </div>

                            @error('quantity')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                            <p id="quantityWarning"
                               class="hidden mt-2 text-sm text-red-600">

                                Jumlah Stock Out melebihi stok yang tersedia.

                            </p>

                        </div>


                        {{-- NOTES --}}
                        <div>

                            <label for="notes"
                                   class="block text-sm font-semibold text-slate-700 mb-2">

                                Keterangan

                                <span class="text-slate-400 font-normal">
                                    (Opsional)
                                </span>

                            </label>


                            <textarea
                                name="notes"
                                id="notes"
                                rows="4"
                                placeholder="Contoh: Penerimaan barang dari supplier..."
                                class="w-full px-4 py-3 rounded-xl
                                       border border-slate-200
                                       bg-white
                                       text-slate-800
                                       resize-none
                                       focus:outline-none
                                       focus:ring-4
                                       focus:ring-indigo-500/10
                                       focus:border-indigo-500
                                       transition"
                            >{{ old('notes') }}</textarea>

                            @error('notes')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- RIGHT SIDE --}}
                <div class="space-y-6">


                    {{-- STATUS --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                        <div class="mb-5">

                            <h2 class="text-lg font-bold text-slate-900">
                                Status Transaksi
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                Tentukan status transaksi.
                            </p>

                        </div>


                        <div class="space-y-3">


                            {{-- PENDING --}}
                            <label class="flex items-center gap-3
                                          p-4 rounded-xl
                                          border border-slate-200
                                          cursor-pointer
                                          hover:bg-slate-50
                                          transition">

                                <input
                                    type="radio"
                                    name="status"
                                    value="Pending"
                                    class="w-4 h-4 text-indigo-600
                                           border-slate-300
                                           focus:ring-indigo-500"
                                    {{ old('status', 'Diterima') === 'Pending' ? 'checked' : '' }}
                                >

                                <div>

                                    <p class="font-semibold text-slate-800">
                                        Pending
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        Menunggu proses
                                    </p>

                                </div>

                            </label>


                            {{-- DITERIMA --}}
                            <label class="flex items-center gap-3
                                          p-4 rounded-xl
                                          border border-slate-200
                                          cursor-pointer
                                          hover:bg-slate-50
                                          transition">

                                <input
                                    type="radio"
                                    name="status"
                                    value="Diterima"
                                    class="w-4 h-4 text-emerald-600
                                           border-slate-300
                                           focus:ring-emerald-500"
                                    {{ old('status', 'Diterima') === 'Diterima' ? 'checked' : '' }}
                                >

                                <div>

                                    <p class="font-semibold text-slate-800">
                                        Diterima
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        Barang sudah diterima
                                    </p>

                                </div>

                            </label>


                            {{-- DIKELUARKAN --}}
                            <label class="flex items-center gap-3
                                          p-4 rounded-xl
                                          border border-slate-200
                                          cursor-pointer
                                          hover:bg-slate-50
                                          transition">

                                <input
                                    type="radio"
                                    name="status"
                                    value="Dikeluarkan"
                                    class="w-4 h-4 text-red-600
                                           border-slate-300
                                           focus:ring-red-500"
                                    {{ old('status') === 'Dikeluarkan' ? 'checked' : '' }}
                                >

                                <div>

                                    <p class="font-semibold text-slate-800">
                                        Dikeluarkan
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        Barang sudah dikeluarkan
                                    </p>

                                </div>

                            </label>


                            {{-- DITOLAK --}}
                            <label class="flex items-center gap-3
                                          p-4 rounded-xl
                                          border border-slate-200
                                          cursor-pointer
                                          hover:bg-slate-50
                                          transition">

                                <input
                                    type="radio"
                                    name="status"
                                    value="Ditolak"
                                    class="w-4 h-4 text-red-600
                                           border-slate-300
                                           focus:ring-red-500"
                                    {{ old('status') === 'Ditolak' ? 'checked' : '' }}
                                >

                                <div>

                                    <p class="font-semibold text-slate-800">
                                        Ditolak
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        Transaksi ditolak
                                    </p>

                                </div>

                            </label>

                        </div>


                        @error('status')

                            <p class="mt-3 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- INFO CARD --}}
                    <div class="rounded-2xl
                                bg-gradient-to-br from-indigo-600 to-violet-600
                                text-white p-6
                                shadow-lg shadow-indigo-200">

                        <div class="w-11 h-11 rounded-xl
                                    bg-white/15
                                    flex items-center justify-center
                                    text-xl mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>

                        </div>

                        <h3 class="font-bold text-lg">
                            Pastikan data benar
                        </h3>

                        <p class="mt-2 text-sm text-indigo-100 leading-relaxed">
                            Periksa produk, jumlah, tipe transaksi,
                            dan status sebelum menyimpan.
                        </p>

                    </div>


                    {{-- ACTION --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                        <button
                            type="submit"
                            id="submitButton"
                            class="w-full inline-flex items-center justify-center
                                   gap-2 px-5 py-3.5
                                   rounded-xl
                                   bg-gradient-to-r
                                   from-indigo-600 to-violet-600
                                   text-white
                                   font-bold
                                   shadow-lg shadow-indigo-200
                                   hover:from-indigo-700
                                   hover:to-violet-700
                                   hover:-translate-y-0.5
                                   transition-all duration-200">

                            <span class="text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            </span>

                            Simpan Transaksi

                        </button>


                        <a href="{{ route('stock-transactions.index') }}"
                           class="mt-3 w-full
                                  inline-flex items-center justify-center
                                  px-5 py-3
                                  rounded-xl
                                  border border-slate-200
                                  bg-white
                                  text-slate-600
                                  font-semibold
                                  hover:bg-slate-50
                                  transition">

                            Batal

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- INTERACTION SCRIPT --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');

    const stockInfo = document.getElementById('stockInfo');
    const currentStock = document.getElementById('currentStock');
    const stockStatus = document.getElementById('stockStatus');

    const quantityWarning = document.getElementById('quantityWarning');

    const transactionForm = document.getElementById('transactionForm');

    function getType() {

        const selected = document.querySelector(
            'input[name="type"]:checked'
        );

        return selected ? selected.value : 'Masuk';

    }


    function updateStockInfo() {

        if (!productSelect.value) {

            stockInfo.classList.add('hidden');

            return;

        }


        const option = productSelect.options[
            productSelect.selectedIndex
        ];

        const stock = parseInt(
            option.dataset.stock || 0
        );


        stockInfo.classList.remove('hidden');

        currentStock.textContent = stock + ' unit';


        if (stock <= 0) {

            stockStatus.textContent = 'Habis';

            stockStatus.className =
                'text-sm font-bold text-red-600';

        } else if (stock <= 5) {

            stockStatus.textContent = 'Menipis';

            stockStatus.className =
                'text-sm font-bold text-amber-600';

        } else {

            stockStatus.textContent = 'Aman';

            stockStatus.className =
                'text-sm font-bold text-emerald-600';

        }

        validateQuantity();

    }


    function validateQuantity() {

        const selected = productSelect.options[
            productSelect.selectedIndex
        ];

        if (!selected || !productSelect.value) {

            quantityWarning.classList.add('hidden');

            return true;

        }


        const stock = parseInt(
            selected.dataset.stock || 0
        );

        const quantity = parseInt(
            quantityInput.value || 0
        );


        if (
            getType() === 'Keluar' &&
            quantity > stock
        ) {

            quantityWarning.classList.remove('hidden');

            return false;

        }


        quantityWarning.classList.add('hidden');

        return true;

    }


    productSelect.addEventListener(
        'change',
        updateStockInfo
    );


    quantityInput.addEventListener(
        'input',
        validateQuantity
    );


    document
        .querySelectorAll('input[name="type"]')
        .forEach(function (radio) {

            radio.addEventListener(
                'change',
                validateQuantity
            );

        });


    transactionForm.addEventListener(
        'submit',
        function (event) {

            if (!validateQuantity()) {

                event.preventDefault();

                quantityInput.focus();

                return;

            }

        }
    );


    updateStockInfo();

});

</script>

@endsection
