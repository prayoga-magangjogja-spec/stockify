@extends('layouts.app')

@section('title', 'Detail Supplier')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <div class="mb-2 flex items-center gap-2">

                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                <span class="text-xs font-bold uppercase tracking-[0.15em] text-emerald-600">
                    Detail Supplier
                </span>

            </div>

            <h1 class="text-3xl font-bold text-slate-900">
                {{ $supplier->name }}
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap supplier dan produk yang disediakan.
            </p>

        </div>


        <div class="flex items-center gap-2">

            <a
                href="{{ route('suppliers.edit', $supplier) }}"
                class="inline-flex items-center gap-2
                       rounded-xl
                       border border-violet-200
                       bg-violet-50
                       px-4 py-2.5
                       text-sm font-semibold text-violet-600
                       transition
                       hover:border-violet-300
                       hover:bg-violet-100"
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
                href="{{ route('suppliers.index') }}"
                class="inline-flex items-center gap-2
                       rounded-xl
                       border border-indigo-200
                       bg-indigo-50
                       px-4 py-2.5
                       text-sm font-semibold text-indigo-600
                       transition
                       hover:border-indigo-300
                       hover:bg-indigo-100"
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


    {{-- CONTENT --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- SUPPLIER INFO --}}
        <div
            class="rounded-2xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   lg:col-span-1"
        >

            <div class="p-6">

                {{-- AVATAR --}}
                <div
                    class="mx-auto flex h-24 w-24
                           items-center justify-center
                           rounded-3xl
                           bg-gradient-to-br
                           from-indigo-500 to-violet-600
                           text-3xl font-bold text-white
                           shadow-lg shadow-indigo-200"
                >
                    {{ strtoupper(substr($supplier->name, 0, 1)) }}
                </div>


                <div class="mt-5 text-center">

                    <h2 class="text-xl font-bold text-slate-900">
                        {{ $supplier->name }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-400">
                        Supplier #{{ $supplier->id }}
                    </p>

                </div>


                <div class="my-6 border-t border-slate-100"></div>


                {{-- PHONE --}}
                <div class="mb-5">

                    <p class="mb-2 text-xs font-bold uppercase tracking-wider text-slate-400">
                        Nomor Telepon
                    </p>

                    @if($supplier->phone)

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center
                                       rounded-lg bg-emerald-50 text-emerald-500"
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
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.965-.852-1.091l-4.423-.986a1.125 1.125 0 0 0-1.173.417l-.97 1.293a1.125 1.125 0 0 1-1.21.38 12.035 12.035 0 0 1-7.263-7.263 1.125 1.125 0 0 1 .38-1.21l1.293-.97c.363-.272.54-.73.417-1.173L7.713 3.102A1.125 1.125 0 0 0 6.622 2.25H5.25A2.25 2.25 0 0 0 3 4.5v2.25Z"
                                    />
                                </svg>

                            </div>

                            <span class="text-sm font-medium text-slate-700">
                                {{ $supplier->phone }}
                            </span>

                        </div>

                    @else

                        <span class="text-sm text-slate-400">
                            Tidak tersedia
                        </span>

                    @endif

                </div>


                {{-- EMAIL --}}
                <div class="mb-5">

                    <p class="mb-2 text-xs font-bold uppercase tracking-wider text-slate-400">
                        Email
                    </p>

                    @if($supplier->email)

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center
                                       rounded-lg bg-indigo-50 text-indigo-500"
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
                                        d="M3 8.25 12 14l9-5.75M4.5 19.5h15A1.5 1.5 0 0 0 21 18V6a1.5 1.5 0 0 0-1.5-1.5h-15A1.5 1.5 0 0 0 3 6v12a1.5 1.5 0 0 0 1.5 1.5Z"
                                    />
                                </svg>

                            </div>

                            <span class="break-all text-sm font-medium text-slate-700">
                                {{ $supplier->email }}
                            </span>

                        </div>

                    @else

                        <span class="text-sm text-slate-400">
                            Tidak tersedia
                        </span>

                    @endif

                </div>


                {{-- ADDRESS --}}
                <div>

                    <p class="mb-2 text-xs font-bold uppercase tracking-wider text-slate-400">
                        Alamat
                    </p>

                    <p class="text-sm leading-6 text-slate-500">
                        {{ $supplier->address ?: 'Alamat belum tersedia.' }}
                    </p>

                </div>


                {{-- DATE --}}
                <div class="mt-6 border-t border-slate-100 pt-5">

                    <p class="text-xs text-slate-400">
                        Supplier ditambahkan
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">
                        {{ $supplier->created_at?->format('d M Y, H:i') ?? '-' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- PRODUCTS --}}
        <div
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   lg:col-span-2"
        >

            <div
                class="flex items-center justify-between
                       border-b border-slate-100
                       px-6 py-5"
            >

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Produk dari Supplier
                    </h2>

                    <p class="mt-1 text-sm text-slate-400">
                        Produk yang terhubung dengan supplier ini.
                    </p>

                </div>


                <div
                    class="rounded-xl bg-indigo-50
                           px-3 py-2
                           text-sm font-bold text-indigo-600"
                >
                    {{ $supplier->products->count() }}
                </div>

            </div>


            <div class="p-6">

                @if($supplier->products->count() > 0)

                    <div class="space-y-3">

                        @foreach($supplier->products as $product)

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
                                               rounded-xl bg-indigo-50
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


                                <div class="flex items-center gap-4">

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
                                        class="flex h-9 w-9 items-center justify-center
                                               rounded-lg
                                               border border-indigo-200
                                               bg-indigo-50
                                               text-indigo-600
                                               transition
                                               hover:bg-indigo-100"
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
                            Belum ada produk yang menggunakan supplier ini.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection