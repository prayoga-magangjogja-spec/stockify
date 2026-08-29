@extends('layouts.app')

@section('title', 'Supplier')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <div class="mb-2 flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-indigo-600"></span>

                <span class="text-xs font-bold uppercase tracking-[0.15em] text-indigo-600">
                    Manajemen
                </span>
            </div>

            <h1 class="text-3xl font-bold text-slate-900">
                Supplier
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola data supplier yang menyediakan produk Stockify.
            </p>

        </div>


        <a
            href="{{ route('suppliers.create') }}"
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

            Tambah Supplier

        </a>

    </div>


    {{-- STATISTIK --}}
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">

        {{-- TOTAL --}}
        <div
            class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm
                   transition-all duration-200
                   hover:-translate-y-0.5 hover:shadow-md"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Supplier
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $suppliers->count() }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Supplier terdaftar
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
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- PUNYA PRODUK --}}
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
                        {{ $suppliers->filter(fn($supplier) => $supplier->products->count() > 0)->count() }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Supplier aktif
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


        {{-- TANPA PRODUK --}}
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
                        {{ $suppliers->filter(fn($supplier) => $supplier->products->count() === 0)->count() }}
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


    {{-- TABLE --}}
    <div
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white shadow-sm"
    >

        {{-- TABLE HEADER --}}
        <div
            class="flex flex-col gap-4
                   border-b border-slate-100
                   px-6 py-5
                   sm:flex-row sm:items-center sm:justify-between"
        >

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Daftar Supplier
                </h2>

                <p class="mt-1 text-sm text-slate-400">
                    Seluruh supplier yang tersimpan dalam sistem.
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
                    id="supplierSearch"
                    placeholder="Cari supplier..."
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


        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px]">

                <thead>

                    <tr class="border-b border-slate-100 bg-slate-50">

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Supplier
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Kontak
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Produk
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($suppliers as $supplier)

                        <tr
                            class="supplier-row border-b border-slate-100
                                   last:border-0
                                   transition-colors
                                   hover:bg-indigo-50/30"
                        >

                            {{-- NUMBER --}}
                            <td class="px-6 py-5">

                                <span
                                    class="inline-flex h-8 w-8 items-center
                                           justify-center rounded-lg
                                           bg-slate-100
                                           text-xs font-semibold
                                           text-slate-500"
                                >
                                    {{ $loop->iteration }}
                                </span>

                            </td>


                            {{-- SUPPLIER --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 shrink-0
                                               items-center justify-center
                                               rounded-xl
                                               bg-gradient-to-br
                                               from-indigo-500 to-violet-600
                                               text-sm font-bold text-white
                                               shadow-sm"
                                    >
                                        {{ strtoupper(substr($supplier->name, 0, 1)) }}
                                    </div>


                                    <div>

                                        <p class="supplier-name font-semibold text-slate-900">
                                            {{ $supplier->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            ID #{{ $supplier->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- CONTACT --}}
                            <td class="px-6 py-5">

                                <div class="space-y-1">

                                    @if($supplier->phone)

                                        <p class="flex items-center gap-2 text-sm text-slate-500">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 text-emerald-500"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.965-.852-1.091l-4.423-.986a1.125 1.125 0 0 0-1.173.417l-.97 1.293a1.125 1.125 0 0 1-1.21.38 12.035 12.035 0 0 1-7.263-7.263 1.125 1.125 0 0 1 .38-1.21l1.293-.97c.363-.272.54-.73.417-1.173L7.713 3.102A1.125 1.125 0 0 0 6.622 2.25H5.25A2.25 2.25 0 0 0 3 4.5v2.25Z"
                                                />
                                            </svg>

                                            {{ $supplier->phone }}

                                        </p>

                                    @endif


                                    @if($supplier->email)

                                        <p class="flex items-center gap-2 text-sm text-slate-500">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 text-indigo-500"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 8.25 12 14l9-5.75M4.5 19.5h15A1.5 1.5 0 0 0 21 18V6a1.5 1.5 0 0 0-1.5-1.5h-15A1.5 1.5 0 0 0 3 6v12a1.5 1.5 0 0 0 1.5 1.5Z"
                                                />
                                            </svg>

                                            {{ $supplier->email }}

                                        </p>

                                    @endif


                                    @if(!$supplier->phone && !$supplier->email)

                                        <span class="text-sm text-slate-400">
                                            Tidak ada kontak
                                        </span>

                                    @endif

                                </div>

                            </td>


                            {{-- PRODUCTS --}}
                            <td class="px-6 py-5">

                                @if($supplier->products->count() > 0)

                                    <span
                                        class="inline-flex items-center gap-2
                                               rounded-lg bg-indigo-50
                                               px-3 py-2
                                               text-xs font-semibold
                                               text-indigo-600"
                                    >

                                        {{ $supplier->products->count() }}
                                        Produk

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center
                                               rounded-lg bg-slate-100
                                               px-3 py-2
                                               text-xs font-semibold
                                               text-slate-500"
                                    >
                                        Belum ada produk
                                    </span>

                                @endif

                            </td>


                            {{-- ACTION --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-end gap-2">


                                    {{-- DETAIL --}}
                                    <a
                                        href="{{ route('suppliers.show', $supplier) }}"
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
                                               hover:text-indigo-700"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-[18px] w-[18px] transition-transform group-hover:scale-110"
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

                                            <circle cx="12" cy="12" r="2.5"/>
                                        </svg>

                                    </a>


                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('suppliers.edit', $supplier) }}"
                                        title="Edit supplier"
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
                                               hover:text-violet-700"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-[18px] w-[18px] transition-transform group-hover:scale-110"
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


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('suppliers.destroy', $supplier) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Hapus supplier"
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
                                                   hover:text-red-600"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-[18px] w-[18px] transition-transform group-hover:scale-110"
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

                        <tr>

                            <td colspan="5" class="px-6 py-16 text-center">

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
                                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm13 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="font-semibold text-slate-900">
                                        Belum ada supplier
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-400">
                                        Tambahkan supplier pertama ke dalam sistem.
                                    </p>

                                    <a
                                        href="{{ route('suppliers.create') }}"
                                        class="mt-5 inline-flex items-center gap-2
                                               rounded-xl
                                               bg-indigo-600
                                               px-4 py-2.5
                                               text-sm font-semibold text-white
                                               transition hover:bg-indigo-700"
                                    >
                                        Tambah Supplier
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


<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('supplierSearch');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        document.querySelectorAll('.supplier-row').forEach(function (row) {

            const text = row.textContent.toLowerCase();

            row.style.display = text.includes(keyword) ? '' : 'none';

        });

    });

});

</script>

@endsection