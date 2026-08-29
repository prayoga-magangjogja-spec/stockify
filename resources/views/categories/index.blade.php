@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- =========================================================
        HEADER HALAMAN
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
                Kategori
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola kategori produk yang tersedia di Stockify.
            </p>

        </div>


        {{-- TOMBOL TAMBAH --}}
        <a
            href="{{ route('categories.create') }}"
            class="inline-flex items-center justify-center gap-2
                   rounded-xl
                   bg-gradient-to-r from-indigo-600 to-violet-600
                   px-5 py-3
                   text-sm font-semibold text-white
                   shadow-lg shadow-indigo-200
                   transition-all duration-200
                   hover:-translate-y-0.5
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

            Tambah Kategori

        </a>

    </div>


    {{-- =========================================================
        STATISTIK
    ========================================================== --}}
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">


        {{-- TOTAL KATEGORI --}}
        <div
            class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm
                   transition-all duration-200
                   hover:-translate-y-0.5 hover:shadow-md"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Kategori
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $categories->count() }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Kategori terdaftar
                    </p>

                </div>


                <div
                    class="flex h-12 w-12 items-center justify-center
                           rounded-xl bg-indigo-50 text-indigo-600"
                >

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
                            d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- MEMILIKI PRODUK --}}
        <div
            class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm
                   transition-all duration-200
                   hover:-translate-y-0.5 hover:shadow-md"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Memiliki Produk
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $categories->filter(fn($category) => $category->products->count() > 0)->count() }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Kategori aktif
                    </p>

                </div>


                <div
                    class="flex h-12 w-12 items-center justify-center
                           rounded-xl bg-emerald-50 text-emerald-500"
                >

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
                            d="m5 12 4 4L19 6"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- BELUM DIGUNAKAN --}}
        <div
            class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm
                   transition-all duration-200
                   hover:-translate-y-0.5 hover:shadow-md"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Belum Digunakan
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $categories->filter(fn($category) => $category->products->count() === 0)->count() }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Belum memiliki produk
                    </p>

                </div>


                <div
                    class="flex h-12 w-12 items-center justify-center
                           rounded-xl bg-amber-50 text-amber-500"
                >

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
                            d="M12 9v3.5m0 3h.01M10.3 4.8 3.4 17a2 2 0 0 0 1.73 3h13.74a2 2 0 0 0 1.73-3L13.7 4.8a2 2 0 0 0-3.4 0Z"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        DAFTAR KATEGORI
    ========================================================== --}}
    <div
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white
               shadow-sm"
    >

        {{-- HEADER TABEL --}}
        <div
            class="flex flex-col gap-4
                   border-b border-slate-100
                   px-6 py-5
                   sm:flex-row sm:items-center sm:justify-between"
        >

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Daftar Kategori
                </h2>

                <p class="mt-1 text-sm text-slate-400">
                    Daftar seluruh kategori produk.
                </p>

            </div>


            {{-- SEARCH --}}
            <div class="relative w-full sm:w-72">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="absolute left-3 top-1/2 h-4 w-4
                           -translate-y-1/2 text-slate-400"
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
                    id="categorySearch"
                    placeholder="Cari kategori..."
                    class="w-full rounded-xl
                           border border-slate-200
                           bg-slate-50
                           py-2.5 pl-10 pr-4
                           text-sm text-slate-900
                           outline-none
                           transition
                           focus:border-indigo-500
                           focus:bg-white
                           focus:ring-4 focus:ring-indigo-100"
                >

            </div>

        </div>


        {{-- =====================================================
            TABLE
        ====================================================== --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[850px]">

                <thead>

                    <tr class="border-b border-slate-100 bg-slate-50">

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase tracking-wider
                                   text-slate-500"
                        >
                            #
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase tracking-wider
                                   text-slate-500"
                        >
                            Kategori
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase tracking-wider
                                   text-slate-500"
                        >
                            Deskripsi
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase tracking-wider
                                   text-slate-500"
                        >
                            Produk
                        </th>

                        <th
                            class="px-6 py-4 text-right
                                   text-xs font-bold uppercase tracking-wider
                                   text-slate-500"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody id="categoryTable">

                    @forelse ($categories as $category)

                        <tr
                            class="category-row
                                   border-b border-slate-100
                                   last:border-0
                                   transition-colors
                                   hover:bg-indigo-50/30"
                        >

                            {{-- NOMOR --}}
                            <td class="px-6 py-5">

                                <span
                                    class="inline-flex h-8 w-8
                                           items-center justify-center
                                           rounded-lg
                                           bg-slate-100
                                           text-xs font-semibold
                                           text-slate-500"
                                >
                                    {{ $loop->iteration }}
                                </span>

                            </td>


                            {{-- KATEGORI --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 shrink-0
                                               items-center justify-center
                                               rounded-xl
                                               bg-gradient-to-br
                                               from-indigo-500
                                               to-violet-600
                                               text-sm font-bold text-white
                                               shadow-sm"
                                    >
                                        {{ strtoupper(substr($category->name, 0, 1)) }}
                                    </div>


                                    <div>

                                        <p
                                            class="category-name
                                                   font-semibold
                                                   text-slate-900"
                                        >
                                            {{ $category->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            ID #{{ $category->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- DESKRIPSI --}}
                            <td class="px-6 py-5">

                                <p
                                    class="max-w-[280px]
                                           truncate
                                           text-sm
                                           text-slate-500"
                                >
                                    {{ $category->description ?: 'Tidak ada deskripsi' }}
                                </p>

                            </td>


                            {{-- PRODUK --}}
                            <td class="px-6 py-5">

                                @if ($category->products->count() > 0)

                                    <span
                                        class="inline-flex items-center gap-2
                                               rounded-lg
                                               bg-indigo-50
                                               px-3 py-2
                                               text-xs font-semibold
                                               text-indigo-600"
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
                                                d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Zm0 0v9m8-4.5-8 4.5m-8-4.5 8 4.5"
                                            />
                                        </svg>

                                        {{ $category->products->count() }}
                                        Produk

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-2
                                               rounded-lg
                                               bg-slate-100
                                               px-3 py-2
                                               text-xs font-semibold
                                               text-slate-500"
                                    >
                                        Belum ada produk
                                    </span>

                                @endif

                            </td>


                            {{-- =================================================
                                AKSI
                            ================================================== --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-end gap-2">


                                    {{-- =================================================
                                        DETAIL - BIRU
                                    ================================================== --}}
                                    <a
                                        href="{{ route('categories.show', $category) }}"
                                        title="Lihat detail"
                                        class="group flex h-10 w-10
                                               items-center justify-center
                                               rounded-xl
                                               border border-indigo-200
                                               bg-indigo-50
                                               text-indigo-600
                                               shadow-sm
                                               transition-all duration-200
                                               hover:-translate-y-0.5
                                               hover:border-indigo-300
                                               hover:bg-indigo-100
                                               hover:text-indigo-700
                                               hover:shadow-md
                                               hover:shadow-indigo-100"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-[18px] w-[18px]
                                                   transition-transform
                                                   duration-200
                                                   group-hover:scale-110"
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

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                            />
                                        </svg>

                                    </a>


                                    {{-- =================================================
                                        EDIT - UNGU
                                    ================================================== --}}
                                    <a
                                        href="{{ route('categories.edit', $category) }}"
                                        title="Edit kategori"
                                        class="group flex h-10 w-10
                                               items-center justify-center
                                               rounded-xl
                                               border border-violet-200
                                               bg-violet-50
                                               text-violet-600
                                               shadow-sm
                                               transition-all duration-200
                                               hover:-translate-y-0.5
                                               hover:border-violet-300
                                               hover:bg-violet-100
                                               hover:text-violet-700
                                               hover:shadow-md
                                               hover:shadow-violet-500/10"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-[18px] w-[18px]
                                                   transition-transform
                                                   duration-200
                                                   group-hover:scale-110"
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


                                    {{-- =================================================
                                        HAPUS - MERAH
                                    ================================================== --}}
                                    <form
                                        action="{{ route('categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            title="Hapus kategori"
                                            class="group flex h-10 w-10
                                                   items-center justify-center
                                                   rounded-xl
                                                   border border-red-200
                                                   bg-red-50
                                                   text-red-500
                                                   shadow-sm
                                                   transition-all duration-200
                                                   hover:-translate-y-0.5
                                                   hover:border-red-300
                                                   hover:bg-red-100
                                                   hover:text-red-600
                                                   hover:shadow-md
                                                   hover:shadow-red-500/10"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-[18px] w-[18px]
                                                       transition-transform
                                                       duration-200
                                                       group-hover:scale-110"
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

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- EMPTY STATE --}}
                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-16 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <div
                                        class="mb-4 flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl
                                               bg-indigo-50
                                               text-indigo-500"
                                    >

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
                                                d="M4 6h16M4 12h16M4 18h16"
                                            />
                                        </svg>

                                    </div>


                                    <h3 class="font-semibold text-slate-900">
                                        Belum ada kategori
                                    </h3>


                                    <p class="mt-1 text-sm text-slate-400">
                                        Tambahkan kategori pertama untuk produk Anda.
                                    </p>


                                    <a
                                        href="{{ route('categories.create') }}"
                                        class="mt-5 inline-flex items-center gap-2
                                               rounded-xl
                                               bg-indigo-600
                                               px-4 py-2.5
                                               text-sm font-semibold
                                               text-white
                                               transition
                                               hover:bg-indigo-700"
                                    >
                                        Tambah Kategori
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- =============================================================
    SEARCH INTERAKTIF
============================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('categorySearch');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        const rows = document.querySelectorAll('.category-row');

        rows.forEach(function (row) {

            const categoryName =
                row.querySelector('.category-name')?.textContent
                    .toLowerCase() || '';

            const rowText =
                row.textContent.toLowerCase();

            if (
                categoryName.includes(keyword) ||
                rowText.includes(keyword)
            ) {

                row.style.display = '';

            } else {

                row.style.display = 'none';

            }

        });

    });

});

</script>

@endsection