@extends('layouts.app')

@section('title', 'Tambah Produk - Stockify')

@section('content')

<div class="space-y-6">

    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">

        <div>

            <div class="flex items-center gap-2 mb-2">

                <span class="inline-flex items-center px-2.5 py-1
                             text-[10px] font-bold tracking-wider
                             text-indigo-600 uppercase rounded-full
                             bg-indigo-50 border border-indigo-500/20">

                    Produk

                </span>

                <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>

                <span class="text-xs text-slate-500">
                    Tambah data
                </span>

            </div>

            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Tambah Produk
            </h1>

            <p class="mt-1.5 text-sm text-slate-500">
                Tambahkan produk baru ke dalam sistem Stockify.
            </p>

        </div>

        <a
            href="{{ route('products.index') }}"
            class="inline-flex items-center justify-center gap-2
                   px-4 py-2.5 text-sm font-semibold
                   rounded-xl border border-slate-300
                   bg-white text-slate-700
                   px-5 py-2.5 text-sm font-semibold
                   hover:bg-slate-100 transition"
        >

            <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M15 19l-7-7 7-7"
                />
            </svg>

            Kembali

        </a>

    </div>


    {{-- =====================================================
         ALERT ERROR
    ====================================================== --}}
    @if($errors->any())

        <div class="rounded-2xl border border-rose-200
                    bg-rose-50 p-5">

            <div class="flex items-start gap-3">

                <div class="flex items-center justify-center
                            w-9 h-9 rounded-xl bg-rose-100
                            text-rose-600 shrink-0">

                    !

                </div>

                <div>

                    <h3 class="text-sm font-semibold text-rose-700">
                        Data belum dapat disimpan
                    </h3>

                    <ul class="mt-2 space-y-1 text-sm text-rose-600/80">

                        @foreach($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =====================================================
         FORM
    ====================================================== --}}
    <form
        action="{{ route('products.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


            {{-- =================================================
                 LEFT / MAIN FORM
            ================================================== --}}
            <div class="xl:col-span-2">

                <div class="overflow-hidden stockify-card">

                    {{-- CARD HEADER --}}
                    <div class="px-6 py-5 border-b border-slate-100">

                        <div class="flex items-center gap-3">

                            <div class="flex items-center justify-center
                                        w-10 h-10 rounded-xl
                                        bg-indigo-50
                                        border border-indigo-100">

                                <svg
                                    class="w-5 h-5 text-indigo-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 6v12M6 12h12"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h2 class="text-lg font-semibold text-slate-900">
                                    Informasi Produk
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">
                                    Isi informasi utama produk.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- FORM BODY --}}
                    <div class="p-6 space-y-6">


                        {{-- NAMA + SKU --}}
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- NAMA --}}
                            <div>

                                <label
                                    for="name"
                                    class="block mb-2 text-sm font-medium text-slate-700"
                                >
                                    Nama Produk
                                    <span class="text-rose-600">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="Contoh: Laptop ASUS"
                                    class="w-full px-4 py-3 text-sm
                                           text-slate-900 placeholder-slate-400
                                           bg-white border border-slate-300
                                           rounded-xl outline-none
                                           focus:border-indigo-500
                                           focus:ring-2 focus:ring-indigo-100
                                           transition"
                                >

                                @error('name')

                                    <p class="mt-1.5 text-xs text-rose-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- SKU --}}
                            <div>

                                <label
                                    for="sku"
                                    class="block mb-2 text-sm font-medium text-slate-700"
                                >
                                    SKU
                                    <span class="text-rose-600">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="sku"
                                    name="sku"
                                    value="{{ old('sku') }}"
                                    required
                                    placeholder="Contoh: LAP-ASUS-001"
                                    class="w-full px-4 py-3 text-sm
                                           text-slate-900 placeholder-slate-400
                                           bg-white border border-slate-300
                                           rounded-xl outline-none
                                           focus:border-indigo-500
                                           focus:ring-2 focus:ring-indigo-100
                                           transition"
                                >

                                @error('sku')

                                    <p class="mt-1.5 text-xs text-rose-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- KATEGORI + SUPPLIER --}}
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- KATEGORI --}}
                            <div>

                                <label
                                    for="category_id"
                                    class="block mb-2 text-sm font-medium text-slate-700"
                                >
                                    Kategori
                                    <span class="text-rose-600">*</span>
                                </label>

                                <select
                                    id="category_id"
                                    name="category_id"
                                    required
                                    class="w-full px-4 py-3 text-sm
                                           text-slate-900 bg-white
                                           border border-slate-300
                                           rounded-xl outline-none
                                           focus:border-indigo-500
                                           focus:ring-2 focus:ring-indigo-100
                                           transition"
                                >

                                    <option value="">
                                        Pilih kategori
                                    </option>

                                    @foreach($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('category_id')

                                    <p class="mt-1.5 text-xs text-rose-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- SUPPLIER --}}
                            <div>

                                <label
                                    for="supplier_id"
                                    class="block mb-2 text-sm font-medium text-slate-700"
                                >
                                    Supplier
                                    <span class="text-rose-600">*</span>
                                </label>

                                <select
                                    id="supplier_id"
                                    name="supplier_id"
                                    required
                                    class="w-full px-4 py-3 text-sm
                                           text-slate-900 bg-white
                                           border border-slate-300
                                           rounded-xl outline-none
                                           focus:border-indigo-500
                                           focus:ring-2 focus:ring-indigo-100
                                           transition"
                                >

                                    <option value="">
                                        Pilih supplier
                                    </option>

                                    @foreach($suppliers as $supplier)

                                        <option
                                            value="{{ $supplier->id }}"
                                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}
                                        >
                                            {{ $supplier->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('supplier_id')

                                    <p class="mt-1.5 text-xs text-rose-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- HARGA --}}
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- HARGA BELI --}}
                            <div>

                                <label
                                    for="purchase_price"
                                    class="block mb-2 text-sm font-medium text-slate-700"
                                >
                                    Harga Beli
                                    <span class="text-rose-600">*</span>
                                </label>

                                <div class="relative">

                                    <span
                                        class="absolute left-4 top-1/2
                                               -translate-y-1/2
                                               text-sm text-slate-500"
                                    >
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        id="purchase_price"
                                        name="purchase_price"
                                        value="{{ old('purchase_price') }}"
                                        min="0"
                                        step="1"
                                        required
                                        placeholder="0"
                                        class="w-full px-4 py-3 pl-11
                                               text-sm text-slate-900
                                               placeholder-slate-400
                                               bg-white
                                               border border-slate-300
                                               rounded-xl outline-none
                                               focus:border-indigo-500
                                               focus:ring-2 focus:ring-indigo-100
                                               transition"
                                    >

                                </div>

                                @error('purchase_price')

                                    <p class="mt-1.5 text-xs text-rose-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- HARGA JUAL --}}
                            <div>

                                <label
                                    for="selling_price"
                                    class="block mb-2 text-sm font-medium text-slate-700"
                                >
                                    Harga Jual
                                    <span class="text-rose-600">*</span>
                                </label>

                                <div class="relative">

                                    <span
                                        class="absolute left-4 top-1/2
                                               -translate-y-1/2
                                               text-sm text-slate-500"
                                    >
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        id="selling_price"
                                        name="selling_price"
                                        value="{{ old('selling_price') }}"
                                        min="0"
                                        step="1"
                                        required
                                        placeholder="0"
                                        class="w-full px-4 py-3 pl-11
                                               text-sm text-slate-900
                                               placeholder-slate-400
                                               bg-white
                                               border border-slate-300
                                               rounded-xl outline-none
                                               focus:border-indigo-500
                                               focus:ring-2 focus:ring-indigo-100
                                               transition"
                                    >

                                </div>

                                @error('selling_price')

                                    <p class="mt-1.5 text-xs text-rose-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- STOK --}}
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- STOK AWAL --}}
                            <div>

                                <label
                                    for="stock"
                                    class="block mb-2 text-sm font-medium text-slate-700"
                                >
                                    Stok Awal
                                    <span class="text-rose-600">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="stock"
                                    name="stock"
                                    value="{{ old('stock', 0) }}"
                                    min="0"
                                    step="1"
                                    required
                                    placeholder="0"
                                    class="w-full px-4 py-3 text-sm
                                           text-slate-900 placeholder-slate-400
                                           bg-white
                                           border border-slate-300
                                           rounded-xl outline-none
                                           focus:border-indigo-500
                                           focus:ring-2 focus:ring-indigo-100
                                           transition"
                                >

                                <p class="mt-2 text-xs text-slate-500">
                                    Jumlah stok yang tersedia saat produk pertama kali dibuat.
                                </p>

                                @error('stock')

                                    <p class="mt-1.5 text-xs text-rose-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- MINIMUM STOCK --}}
                            <div>

                                <label
                                    for="minimum_stock"
                                    class="block mb-2 text-sm font-medium text-slate-700"
                                >
                                    Minimum Stok
                                    <span class="text-rose-600">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="minimum_stock"
                                    name="minimum_stock"
                                    value="{{ old('minimum_stock', 5) }}"
                                    min="0"
                                    step="1"
                                    required
                                    placeholder="5"
                                    class="w-full px-4 py-3 text-sm
                                           text-slate-900 placeholder-slate-400
                                           bg-white
                                           border border-slate-300
                                           rounded-xl outline-none
                                           focus:border-indigo-500
                                           focus:ring-2 focus:ring-indigo-100
                                           transition"
                                >

                                <p class="mt-2 text-xs text-slate-500">
                                    Batas minimum stok sebelum produk dianggap menipis.
                                </p>

                                @error('minimum_stock')

                                    <p class="mt-1.5 text-xs text-rose-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- DESKRIPSI --}}
                        <div>

                            <label
                                for="description"
                                class="block mb-2 text-sm font-medium text-slate-700"
                            >
                                Deskripsi Produk
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Masukkan deskripsi produk..."
                                class="w-full px-4 py-3 text-sm
                                       text-slate-900 placeholder-slate-400
                                       bg-white
                                       border border-slate-300
                                       rounded-xl outline-none
                                       focus:border-indigo-500
                                       focus:ring-2 focus:ring-indigo-100
                                       transition resize-none"
                            >{{ old('description') }}</textarea>

                            @error('description')

                                <p class="mt-1.5 text-xs text-rose-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 RIGHT / IMAGE
            ================================================== --}}
            <div>

                <div class="overflow-hidden stockify-card">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <div class="flex items-center gap-3">

                            <div class="flex items-center justify-center
                                        w-10 h-10 rounded-xl
                                        bg-violet-50
                                        border border-violet-100">

                                <svg
                                    class="w-5 h-5 text-violet-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <rect
                                        x="3"
                                        y="3"
                                        width="18"
                                        height="18"
                                        rx="2"
                                    />

                                    <circle
                                        cx="8.5"
                                        cy="8.5"
                                        r="1.5"
                                    />

                                    <path
                                        d="M21 15l-5-5L5 21"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h2 class="text-lg font-semibold text-slate-900">
                                    Gambar Produk
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">
                                    Upload gambar produk.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">


                        {{-- PREVIEW --}}
                        <div
                            class="relative w-full aspect-square
                                   overflow-hidden rounded-2xl
                                   bg-white
                                   border border-slate-300
                                   flex items-center justify-center"
                        >

                            {{-- PLACEHOLDER --}}
                            <div
                                id="previewPlaceholder"
                                class="text-center px-5"
                            >

                                <div
                                    class="flex items-center justify-center
                                           w-20 h-20 mx-auto
                                           rounded-2xl
                                           bg-indigo-50
                                           border border-indigo-100"
                                >

                                    <svg
                                        class="w-9 h-9 text-indigo-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <rect
                                            x="3"
                                            y="3"
                                            width="18"
                                            height="18"
                                            rx="2"
                                        />

                                        <circle
                                            cx="8.5"
                                            cy="8.5"
                                            r="1.5"
                                        />

                                        <path
                                            d="M21 15l-5-5L5 21"
                                        />
                                    </svg>

                                </div>

                                <p class="mt-4 text-sm font-semibold text-slate-700">
                                    Belum ada gambar
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    JPG, JPEG, PNG atau WEBP
                                </p>

                            </div>


                            {{-- IMAGE PREVIEW --}}
                            <img
                                id="previewImage"
                                src=""
                                alt="Preview gambar produk"
                                class="hidden absolute inset-0
                                       w-full h-full object-cover"
                            >

                        </div>


                        {{-- FILE INPUT --}}
                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="hidden"
                        >


                        {{-- SELECT BUTTON --}}
                        <label
                            for="image"
                            class="mt-5 w-full inline-flex
                                   items-center justify-center gap-2
                                   px-4 py-3 rounded-xl
                                   border border-slate-300
                                   bg-white
                                   text-gray-300
                                   font-semibold text-sm
                                   cursor-pointer
                                   hover:bg-gray-800
                                   hover:border-indigo-500/40
                                   hover:text-white
                                   transition"
                        >

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 16l4-4 3 3 4-5 5 6"
                                />

                                <rect
                                    x="3"
                                    y="3"
                                    width="18"
                                    height="18"
                                    rx="2"
                                />
                            </svg>

                            Pilih Gambar

                        </label>


                        @error('image')

                            <p class="mt-2 text-xs text-rose-600">
                                {{ $message }}
                            </p>

                        @enderror


                        <div
                            class="mt-4 p-4 rounded-xl
                                   bg-indigo-50
                                   border border-indigo-100"
                        >

                            <p class="text-xs leading-5 text-slate-500">

                                Format yang didukung:
                                <span class="text-slate-400">
                                    JPG, JPEG, PNG, WEBP
                                </span>
                                <br>

                                Ukuran maksimal:
                                <span class="text-slate-400">
                                    2 MB
                                </span>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             FORM FOOTER
        ====================================================== --}}
        <div class="flex flex-col-reverse gap-3
                    mt-6 sm:flex-row
                    sm:items-center sm:justify-between">

            <a
                href="{{ route('products.index') }}"
                class="inline-flex items-center justify-center
                       px-5 py-3 rounded-xl
                       border border-slate-300
                       bg-white
                       text-slate-700
                       text-sm font-semibold
                       hover:bg-slate-100
                       transition"
            >

                Batal

            </a>


            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2
                       px-6 py-3 rounded-xl
                       bg-gradient-to-r from-indigo-600 to-violet-600
                       text-white text-sm font-semibold
                       shadow-lg shadow-indigo-500/20
                       hover:from-indigo-700
                       hover:to-violet-700
                       hover:-translate-y-0.5
                       transition-all duration-200"
            >

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                Simpan Produk

            </button>

        </div>

    </form>

</div>


{{-- =====================================================
     IMAGE PREVIEW SCRIPT
====================================================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('image');
    const previewImage = document.getElementById('previewImage');
    const previewPlaceholder = document.getElementById('previewPlaceholder');

    if (
        !imageInput ||
        !previewImage ||
        !previewPlaceholder
    ) {
        return;
    }


    imageInput.addEventListener('change', function (event) {

        const file = event.target.files[0];


        {{-- Tidak ada file --}}
        if (!file) {

            previewImage.src = '';

            previewImage.classList.add('hidden');

            previewPlaceholder.classList.remove('hidden');

            return;
        }


        {{-- Validasi tipe file --}}
        if (!file.type.startsWith('image/')) {

            alert('File yang dipilih harus berupa gambar.');

            imageInput.value = '';

            previewImage.src = '';

            previewImage.classList.add('hidden');

            previewPlaceholder.classList.remove('hidden');

            return;
        }


        {{-- Validasi ukuran 2 MB --}}
        const maxSize = 2 * 1024 * 1024;

        if (file.size > maxSize) {

            alert('Ukuran gambar maksimal 2 MB.');

            imageInput.value = '';

            previewImage.src = '';

            previewImage.classList.add('hidden');

            previewPlaceholder.classList.remove('hidden');

            return;
        }


        {{-- Baca gambar --}}
        const reader = new FileReader();


        reader.onload = function (e) {

            previewImage.src = e.target.result;

            previewImage.classList.remove('hidden');

            previewPlaceholder.classList.add('hidden');

        };


        reader.readAsDataURL(file);

    });

});
</script>

@endsection