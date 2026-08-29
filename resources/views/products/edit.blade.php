@extends('layouts.app')

@section('title', 'Edit Produk - Stockify')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">

        <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">

            <a href="{{ route('products.index') }}"
               class="hover:text-indigo-600 transition">
                Produk
            </a>

            <span>/</span>

            <a href="{{ route('products.show', $product) }}"
               class="hover:text-indigo-600 transition">
                {{ $product->name }}
            </a>

            <span>/</span>

            <span class="text-slate-700">
                Edit
            </span>

        </div>

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Edit Produk
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Perbarui informasi produk yang tersimpan di Stockify.
                </p>
            </div>

            <div class="px-3 py-1.5 rounded-lg bg-indigo-50 border border-indigo-100">
                <span class="text-xs font-semibold text-indigo-600">
                    SKU: {{ $product->sku }}
                </span>
            </div>

        </div>

    </div>


    {{-- FORM CARD --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">

            <h2 class="text-lg font-semibold text-slate-900">
                Informasi Produk
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Ubah data yang diperlukan kemudian simpan perubahan.
            </p>

        </div>


        <form
            action="{{ route('products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="p-6 space-y-8">

                {{-- INFORMASI DASAR --}}
                <div>

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center">

                            <svg class="w-5 h-5 text-indigo-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.7"
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-semibold text-slate-900">
                                Informasi Dasar
                            </h3>

                            <p class="text-xs text-slate-500">
                                Identitas dan klasifikasi produk
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- NAMA --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-slate-700">
                                Nama Produk
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300
                                       bg-white text-slate-900 text-sm
                                       focus:ring-2 focus:ring-indigo-100
                                       focus:border-indigo-500
                                       outline-none transition"
                                required
                            >

                            @error('name')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- SKU --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-slate-700">
                                SKU
                            </label>

                            <input
                                type="text"
                                name="sku"
                                value="{{ old('sku', $product->sku) }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300
                                       bg-white text-slate-900 text-sm
                                       focus:ring-2 focus:ring-indigo-100
                                       focus:border-indigo-500
                                       outline-none transition"
                                required
                            >

                            @error('sku')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- KATEGORI --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-slate-700">
                                Kategori
                            </label>

                            <select
                                name="category_id"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300
                                       bg-white text-slate-900 text-sm
                                       focus:ring-2 focus:ring-indigo-100
                                       focus:border-indigo-500
                                       outline-none transition"
                                required
                            >

                                <option value="">
                                    Pilih kategori
                                </option>

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('category_id')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- SUPPLIER --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-slate-700">
                                Supplier
                            </label>

                            <select
                                name="supplier_id"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300
                                       bg-white text-slate-900 text-sm
                                       focus:ring-2 focus:ring-indigo-100
                                       focus:border-indigo-500
                                       outline-none transition"
                                required
                            >

                                <option value="">
                                    Pilih supplier
                                </option>

                                @foreach($suppliers as $supplier)

                                    <option
                                        value="{{ $supplier->id }}"
                                        {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}
                                    >
                                        {{ $supplier->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('supplier_id')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- HARGA --}}
                <div class="pt-7 border-t border-slate-100">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">

                            <svg class="w-5 h-5 text-emerald-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.7"
                                      d="M12 8c-3 0-5 1.5-5 3.5S9 15 12 15s5 1.5 5 3.5S15 22 12 22M12 2v20"/>
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-semibold text-slate-900">
                                Harga Produk
                            </h3>

                            <p class="text-xs text-slate-500">
                                Harga pembelian dan penjualan
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>

                            <label class="block mb-2 text-sm font-medium text-slate-700">
                                Harga Beli
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    name="purchase_price"
                                    value="{{ old('purchase_price', $product->purchase_price) }}"
                                    min="0"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-300
                                           bg-white text-slate-900 text-sm
                                           focus:ring-2 focus:ring-indigo-100
                                           focus:border-indigo-500
                                           outline-none transition"
                                    required
                                >

                            </div>

                            @error('purchase_price')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <div>

                            <label class="block mb-2 text-sm font-medium text-slate-700">
                                Harga Jual
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    name="selling_price"
                                    value="{{ old('selling_price', $product->selling_price) }}"
                                    min="0"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-300
                                           bg-white text-slate-900 text-sm
                                           focus:ring-2 focus:ring-indigo-100
                                           focus:border-indigo-500
                                           outline-none transition"
                                    required
                                >

                            </div>

                            @error('selling_price')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- STOK --}}
                <div class="pt-7 border-t border-slate-100">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center">

                            <svg class="w-5 h-5 text-amber-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.7"
                                      d="M4 7h16M4 12h16M4 17h16"/>
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-semibold text-slate-900">
                                Pengaturan Stok
                            </h3>

                            <p class="text-xs text-slate-500">
                                Informasi stok saat ini dan batas minimum stok
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>

                            <label class="block mb-2 text-sm font-medium text-slate-700">
                                Stok Saat Ini
                            </label>

                            <div class="px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm font-semibold">
                                {{ number_format($product->stock) }} unit
                            </div>

                            <p class="mt-2 text-xs text-slate-500">
                                Stok tidak dapat diubah di sini. Gunakan Transaksi Stok atau Stock Opname.
                            </p>

                        </div>

                        <div>

                            <label class="block mb-2 text-sm font-medium text-slate-700">
                                Minimum Stok
                            </label>

                            <input
                                type="number"
                                name="minimum_stock"
                                value="{{ old('minimum_stock', $product->minimum_stock) }}"
                                min="0"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300
                                       bg-white text-slate-900 text-sm
                                       focus:ring-2 focus:ring-indigo-100
                                       focus:border-indigo-500
                                       outline-none transition"
                                required
                            >

                            <p class="mt-2 text-xs text-slate-500">
                                Digunakan sebagai batas peringatan stok menipis.
                            </p>

                            @error('minimum_stock')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- DESKRIPSI --}}
                <div class="pt-7 border-t border-slate-100">

                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Deskripsi Produk
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                               bg-white text-slate-900 text-sm
                               focus:ring-2 focus:ring-indigo-100
                               focus:border-indigo-500
                               outline-none transition resize-none"
                    >{{ old('description', $product->description) }}</textarea>

                    @error('description')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- IMAGE --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Gambar Produk
                    </label>

                    {{-- PREVIEW GAMBAR SAAT INI --}}
                    <div class="flex items-center gap-4 mb-4">

                        <div
                            class="w-24 h-24 rounded-xl border border-slate-200
                                 bg-slate-50 overflow-hidden
                                 flex items-center justify-center
                                 shrink-0"
                        >

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >

                                <div
                                    style="display:none"
                                    class="w-full h-full flex items-center justify-center
                                         text-slate-400 text-2xl font-bold"
                                >
                                    {{ strtoupper(substr($product->name ?? 'P', 0, 1)) }}
                                </div>

                            @else

                                <div
                                    class="w-full h-full flex items-center justify-center
                                         text-slate-400 text-2xl font-bold"
                                >
                                    {{ strtoupper(substr($product->name ?? 'P', 0, 1)) }}
                                </div>

                            @endif

                        </div>

                        <div class="flex-1 min-w-0">

                            <p class="text-xs text-slate-500">
                                Format: JPG, JPEG, PNG, WEBP
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Ukuran maksimal: 2 MB
                            </p>

                            @if($product->image)

                                <p class="mt-2 text-xs text-emerald-600 font-medium">
                                    <span class="inline-flex items-center gap-1.5"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg> Gambar saat ini akan dipertahankan jika tidak diganti.</span>

                                </p>

                            @else

                                <p class="mt-2 text-xs text-slate-400">
                                    Belum ada gambar produk.
                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- INPUT FILE --}}
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                               bg-white text-slate-900 text-sm
                               focus:ring-2 focus:ring-indigo-100
                               focus:border-indigo-500
                               outline-none transition file:mr-4 file:py-2 file:px-4
                               file:rounded-lg file:border-0
                               file:text-sm file:font-semibold
                               file:bg-indigo-50 file:text-indigo-700
                               hover:file:bg-indigo-100"
                    >

                    @error('image')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror


                    {{-- OPSI HAPUS GAMBAR --}}
                    @if($product->image)

                        <div class="mt-3 flex items-center gap-2">

                            <input
                                type="checkbox"
                                id="remove_image"
                                name="remove_image"
                                value="1"
                                class="w-4 h-4 rounded border-slate-300
                                       text-indigo-600 focus:ring-indigo-500"
                            >

                            <label
                                for="remove_image"
                                class="text-sm text-slate-600 cursor-pointer"
                            >
                                Hapus gambar produk ini
                            </label>

                        </div>

                    @endif

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="px-6 py-5 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row justify-between gap-3">

                <a
                    href="{{ route('products.show', $product) }}"
                    class="px-5 py-2.5 rounded-xl border border-slate-300
                           bg-white text-slate-700 text-sm font-medium
                           hover:bg-slate-100 transition text-center"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-indigo-600
                           text-white text-sm font-semibold
                           hover:bg-indigo-700
                           focus:ring-4 focus:ring-indigo-100
                           transition"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

