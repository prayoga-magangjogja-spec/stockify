@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- Header --}}
    <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <div class="mb-2 flex items-center gap-2">

                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                <span class="text-xs font-bold uppercase tracking-[0.15em] text-emerald-600">
                    Detail Kategori
                </span>

            </div>

            <h1 class="text-3xl font-bold text-slate-900">
                {{ $category->name }}
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap kategori dan produk di dalamnya.
            </p>

        </div>


        {{-- Actions --}}
        <div class="flex items-center gap-2">

            <a
                href="{{ route('categories.edit', $category) }}"
                class="inline-flex items-center gap-2
                       rounded-xl
                       bg-violet-50
                       border border-violet-200
                       px-4 py-2.5
                       text-sm font-semibold text-violet-600
                       transition-all duration-200
                       hover:bg-violet-100
                       hover:border-violet-300"
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
                        d="m16.86 3.49 3.65 3.65M4 20l4.15-.9L19.6 7.65a2.58 2.58 0 0 0-3.65-3.65L4.5 15.8 4 20Z"
                    />
                </svg>

                Edit

            </a>


            <a
                href="{{ route('categories.index') }}"
                class="inline-flex items-center gap-2
                       rounded-xl
                       bg-indigo-50
                       border border-indigo-200
                       px-4 py-2.5
                       text-sm font-semibold text-indigo-600
                       transition-all duration-200
                       hover:bg-indigo-100
                       hover:border-indigo-300"
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
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Kembali

            </a>

        </div>

    </div>


    {{-- =========================================================
        DETAIL CARD
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- INFO KATEGORI --}}
        <div
            class="rounded-2xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   lg:col-span-1"
        >

            <div class="p-6">

                {{-- Avatar --}}
                <div
                    class="mx-auto flex h-24 w-24
                           items-center justify-center
                           rounded-3xl
                           bg-gradient-to-br
                           from-indigo-500
                           to-violet-600
                           text-3xl font-bold text-white
                           shadow-lg shadow-indigo-200"
                >
                    {{ strtoupper(substr($category->name, 0, 1)) }}
                </div>


                <div class="mt-5 text-center">

                    <h2 class="text-xl font-bold text-slate-900">
                        {{ $category->name }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-400">
                        Kategori #{{ $category->id }}
                    </p>

                </div>


                {{-- Divider --}}
                <div class="my-6 border-t border-slate-100"></div>


                {{-- Description --}}
                <div>

                    <p
                        class="mb-2 text-xs font-bold uppercase
                               tracking-wider text-slate-400"
                    >
                        Deskripsi
                    </p>

                    <p class="text-sm leading-6 text-slate-500">
                        {{ $category->description ?: 'Tidak ada deskripsi untuk kategori ini.' }}
                    </p>

                </div>


                {{-- Created --}}
                <div class="mt-6">

                    <p
                        class="mb-2 text-xs font-bold uppercase
                               tracking-wider text-slate-400"
                    >
                        Dibuat
                    </p>

                    <p class="text-sm font-medium text-slate-700">
                        {{ $category->created_at?->format('d M Y, H:i') ?? '-' }}
                    </p>

                </div>


                {{-- Updated --}}
                <div class="mt-5">

                    <p
                        class="mb-2 text-xs font-bold uppercase
                               tracking-wider text-slate-400"
                    >
                        Terakhir diperbarui
                    </p>

                    <p class="text-sm font-medium text-slate-700">
                        {{ $category->updated_at?->format('d M Y, H:i') ?? '-' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PRODUK DALAM KATEGORI
        ====================================================== --}}
        <div
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   lg:col-span-2"
        >

            {{-- Header --}}
            <div
                class="flex items-center justify-between
                       border-b border-slate-100
                       px-6 py-5"
            >

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Produk
                    </h2>

                    <p class="mt-1 text-sm text-slate-400">
                        Produk yang menggunakan kategori ini.
                    </p>

                </div>


                <div
                    class="rounded-xl bg-indigo-50
                           px-3 py-2
                           text-sm font-bold text-indigo-600"
                >
                    {{ $category->products->count() }}
                </div>

            </div>


            {{-- Products --}}
            <div class="p-6">

                @if ($category->products->count() > 0)

                    <div class="space-y-3">

                        @foreach ($category->products as $product)

                            <div
                                class="flex items-center justify-between
                                       rounded-xl
                                       border border-slate-100
                                       bg-slate-50
                                       p-4
                                       transition-all duration-200
                                       hover:border-indigo-100
                                       hover:bg-indigo-50/40"
                            >

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 shrink-0
                                               items-center justify-center
                                               rounded-xl
                                               bg-indigo-50
                                               text-indigo-600"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
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

                                    </div>


                                    <div>

                                        <p class="font-semibold text-slate-900">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            SKU: {{ $product->sku }}
                                        </p>

                                    </div>

                                </div>


                                <div class="flex items-center gap-3">

                                    <div class="hidden text-right sm:block">

                                        <p class="text-xs text-slate-400">
                                            Stok
                                        </p>

                                        <p class="font-bold text-slate-900">
                                            {{ $product->stock }}
                                        </p>

                                    </div>


                                    <a
                                        href="{{ route('products.show', $product) }}"
                                        title="Lihat produk"
                                        class="flex h-9 w-9
                                               items-center justify-center
                                               rounded-lg
                                               border border-indigo-200
                                               bg-indigo-50
                                               text-indigo-600
                                               transition-all duration-200
                                               hover:bg-indigo-100
                                               hover:text-indigo-700"
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
                                                d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                            />
                                        </svg>

                                    </a>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    {{-- Empty --}}
                    <div class="py-12 text-center">

                        <div
                            class="mx-auto mb-4 flex h-16 w-16
                                   items-center justify-center
                                   rounded-2xl
                                   bg-slate-50
                                   text-slate-400"
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
                                    d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z"
                                />
                            </svg>

                        </div>


                        <h3 class="font-semibold text-slate-900">
                            Belum ada produk
                        </h3>


                        <p class="mt-1 text-sm text-slate-400">
                            Belum ada produk yang menggunakan kategori ini.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection