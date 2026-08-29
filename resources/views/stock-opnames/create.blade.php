@extends('layouts.app')

@section('title', 'Stock Opname Baru - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc]">

    <div class="max-w-[1200px] mx-auto px-6 py-6">


        {{-- HEADER --}}
        <div class="mb-7">

            <a href="{{ route('stock-opnames.index') }}"
               class="inline-flex items-center gap-2
                      text-sm font-medium text-slate-500
                      hover:text-indigo-600 transition mb-4">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7" /></svg> Kembali ke Stock Opname

            </a>

            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm px-7 py-6">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl
                                bg-indigo-50
                                flex items-center justify-center
                                text-indigo-600 text-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>

                    </div>

                    <div>

                        <h1 class="text-2xl font-bold text-slate-900">
                            Stock Opname Baru
                        </h1>

                        <p class="mt-1 text-sm text-slate-500">
                            Cocokkan stok sistem dengan jumlah barang fisik.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- FORM --}}
        <form action="{{ route('stock-opnames.store') }}"
              method="POST">

            @csrf


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                {{-- MAIN FORM --}}
                <div class="lg:col-span-2
                            bg-white rounded-2xl
                            border border-slate-200
                            shadow-sm overflow-hidden">


                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-lg font-bold text-slate-900">
                            Data Pemeriksaan
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Isi data stok fisik sesuai hasil pemeriksaan.
                        </p>

                    </div>


                    <div class="p-6 space-y-6">


                        {{-- PRODUCT --}}
                        <div>

                            <label for="product_id"
                                   class="block text-sm font-semibold text-slate-700 mb-2">

                                Produk

                                <span class="text-red-500">
                                    *
                                </span>

                            </label>

                            <select
                                name="product_id"
                                id="product_id"
                                required
                                class="w-full px-4 py-3 rounded-xl
                                       border border-slate-200
                                       bg-white
                                       text-sm text-slate-700
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-indigo-500/20
                                       focus:border-indigo-500">

                                <option value="">
                                    Pilih produk
                                </option>

                                @foreach($products as $product)

                                    <option
                                        value="{{ $product->id }}"
                                        data-stock="{{ $product->stock }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}>

                                        {{ $product->name }}
                                        — SKU {{ $product->sku }}

                                    </option>

                                @endforeach

                            </select>

                            @error('product_id')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- STOCK INFO --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                            {{-- SYSTEM STOCK --}}
                            <div class="rounded-xl
                                        bg-slate-50
                                        border border-slate-200
                                        p-5">

                                <p class="text-sm font-medium text-slate-500">
                                    Stok Sistem
                                </p>

                                <div class="flex items-end gap-2 mt-2">

                                    <span id="systemStock"
                                          class="text-3xl font-bold text-slate-900">

                                        0

                                    </span>

                                    <span class="text-sm text-slate-400 mb-1">
                                        unit
                                    </span>

                                </div>

                                <p class="text-xs text-slate-400 mt-2">
                                    Stok yang tercatat dalam sistem.
                                </p>

                            </div>


                            {{-- PHYSICAL STOCK --}}
                            <div class="rounded-xl
                                        bg-indigo-50
                                        border border-indigo-100
                                        p-5">

                                <label for="physical_stock"
                                       class="block text-sm font-medium text-indigo-700">

                                    Stok Fisik

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="flex items-center gap-2 mt-2">

                                    <input
                                        type="number"
                                        name="physical_stock"
                                        id="physical_stock"
                                        min="0"
                                        value="{{ old('physical_stock') }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl
                                               border border-indigo-200
                                               bg-white
                                               text-lg font-bold
                                               text-slate-800
                                               focus:outline-none
                                               focus:ring-2
                                               focus:ring-indigo-500/20
                                               focus:border-indigo-500">

                                    <span class="text-sm text-slate-500">
                                        unit
                                    </span>

                                </div>

                                @error('physical_stock')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- DIFFERENCE PREVIEW --}}
                        <div id="differenceBox"
                             class="rounded-xl
                                    bg-slate-50
                                    border border-slate-200
                                    p-5">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm font-medium text-slate-500">
                                        Selisih Stok
                                    </p>

                                    <p id="differenceDescription"
                                       class="text-xs text-slate-400 mt-1">

                                        Pilih produk dan masukkan stok fisik.

                                    </p>

                                </div>

                                <div id="differenceValue"
                                     class="text-2xl font-bold text-slate-400">

                                    0

                                </div>

                            </div>

                        </div>


                        {{-- DATE --}}
                        <div>

                            <label for="date"
                                   class="block text-sm font-semibold text-slate-700 mb-2">

                                Tanggal Pemeriksaan

                                <span class="text-red-500">
                                    *
                                </span>

                            </label>

                            <input
                                type="date"
                                name="date"
                                id="date"
                                value="{{ old('date', now()->format('Y-m-d')) }}"
                                required
                                class="w-full px-4 py-3 rounded-xl
                                       border border-slate-200
                                       bg-white
                                       text-sm text-slate-700
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-indigo-500/20
                                       focus:border-indigo-500">

                            @error('date')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- NOTES --}}
                        <div>

                            <label for="notes"
                                   class="block text-sm font-semibold text-slate-700 mb-2">

                                Catatan

                            </label>

                            <textarea
                                name="notes"
                                id="notes"
                                rows="4"
                                placeholder="Tambahkan catatan jika diperlukan..."
                                class="w-full px-4 py-3 rounded-xl
                                       border border-slate-200
                                       bg-white
                                       text-sm text-slate-700
                                       resize-none
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-indigo-500/20
                                       focus:border-indigo-500">{{ old('notes') }}</textarea>

                            @error('notes')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- FORM FOOTER --}}
                    <div class="px-6 py-5
                                border-t border-slate-100
                                flex flex-col sm:flex-row
                                justify-end gap-3">

                        <a href="{{ route('stock-opnames.index') }}"
                           class="inline-flex items-center justify-center
                                  px-5 py-3 rounded-xl
                                  border border-slate-200
                                  bg-white
                                  text-slate-600
                                  font-semibold
                                  hover:bg-slate-50
                                  transition">

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   px-5 py-3 rounded-xl
                                   bg-gradient-to-r
                                   from-indigo-600 to-violet-600
                                   text-white font-semibold
                                   shadow-lg shadow-indigo-200
                                   hover:from-indigo-700
                                   hover:to-violet-700
                                   transition">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg> Simpan Stock Opname

                        </button>

                    </div>

                </div>


                {{-- SIDE INFORMATION --}}
                <div class="space-y-6">


                    <div class="bg-white rounded-2xl
                                border border-slate-200
                                shadow-sm p-6">

                        <div class="w-11 h-11 rounded-xl
                                    bg-indigo-50
                                    flex items-center justify-center
                                    text-indigo-600 mb-4">

                            i

                        </div>

                        <h3 class="font-bold text-slate-900">
                            Tentang Stock Opname
                        </h3>

                        <p class="text-sm text-slate-500 mt-2 leading-6">

                            Stock opname digunakan untuk membandingkan
                            jumlah stok yang tercatat di sistem dengan
                            jumlah barang yang benar-benar tersedia secara fisik.

                        </p>

                    </div>


                    <div class="bg-gradient-to-br
                                from-indigo-600
                                to-violet-600
                                rounded-2xl
                                shadow-lg
                                shadow-indigo-200
                                p-6 text-white">

                        <p class="text-sm text-indigo-100">
                            Perhatian
                        </p>

                        <h3 class="mt-1 font-bold text-lg">
                            Stok akan disesuaikan
                        </h3>

                        <p class="text-sm text-indigo-100 mt-2 leading-6">

                            Setelah stock opname disimpan,
                            stok produk akan diperbarui mengikuti
                            jumlah stok fisik yang kamu masukkan.

                        </p>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- SCRIPT --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const productSelect = document.getElementById('product_id');
    const physicalInput = document.getElementById('physical_stock');

    const systemStockElement = document.getElementById('systemStock');
    const differenceElement = document.getElementById('differenceValue');
    const differenceDescription = document.getElementById('differenceDescription');

    function updateDifference() {

        const selectedOption =
            productSelect.options[productSelect.selectedIndex];

        const systemStock =
            parseInt(selectedOption?.dataset.stock || 0);

        const physicalStock =
            parseInt(physicalInput.value || 0);

        systemStockElement.textContent = systemStock;

        const difference =
            physicalStock - systemStock;

        differenceElement.textContent =
            difference > 0
                ? '+' + difference
                : difference;

        if (difference > 0) {

            differenceElement.className =
                'text-2xl font-bold text-indigo-600';

            differenceDescription.textContent =
                'Stok fisik lebih banyak dari stok sistem.';

        } else if (difference < 0) {

            differenceElement.className =
                'text-2xl font-bold text-red-600';

            differenceDescription.textContent =
                'Stok fisik lebih sedikit dari stok sistem.';

        } else {

            differenceElement.className =
                'text-2xl font-bold text-emerald-600';

            differenceDescription.textContent =
                'Stok fisik sesuai dengan stok sistem.';

        }

    }


    productSelect.addEventListener(
        'change',
        updateDifference
    );

    physicalInput.addEventListener(
        'input',
        updateDifference
    );


    updateDifference();

});

</script>

@endsection
