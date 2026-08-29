@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-7">

        <div class="mb-2 flex items-center gap-2">

            <span class="h-2 w-2 rounded-full bg-violet-500"></span>

            <span class="text-xs font-bold uppercase tracking-[0.15em] text-violet-600">
                Manajemen Supplier
            </span>

        </div>

        <h1 class="text-3xl font-bold text-slate-900">
            Edit Supplier
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Perbarui informasi supplier yang dipilih.
        </p>

    </div>


    {{-- FORM CARD --}}
    <div class="max-w-5xl rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-violet-50 text-violet-600"
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
                            d="m16.86 3.49 3.65 3.65M4 20l4.15-.9L19.6 7.65a2.58 2.58 0 0 0-3.65-3.65L4.5 15.8 4 20Z"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="font-bold text-slate-900">
                        Edit Informasi Supplier
                    </h2>

                    <p class="text-sm text-slate-400">
                        Perbarui data supplier sesuai kebutuhan.
                    </p>

                </div>

            </div>

        </div>


        <form
            action="{{ route('suppliers.update', $supplier) }}"
            method="POST"
            class="p-6"
        >

            @csrf
            @method('PUT')


            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- NAME --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Nama Supplier
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $supplier->name) }}"
                        required
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3
                               text-sm text-slate-900
                               outline-none
                               transition
                               focus:border-violet-500
                               focus:bg-white
                               focus:ring-4 focus:ring-violet-100"
                    >

                    @error('name')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- PHONE --}}
                <div>

                    <label
                        for="phone"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $supplier->phone) }}"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3
                               text-sm text-slate-900
                               outline-none
                               transition
                               focus:border-violet-500
                               focus:bg-white
                               focus:ring-4 focus:ring-violet-100"
                    >

                    @error('phone')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- EMAIL --}}
                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $supplier->email) }}"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3
                               text-sm text-slate-900
                               outline-none
                               transition
                               focus:border-violet-500
                               focus:bg-white
                               focus:ring-4 focus:ring-violet-100"
                    >

                    @error('email')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- ADDRESS --}}
                <div class="md:row-span-2">

                    <label
                        for="address"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Alamat
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="7"
                        class="w-full resize-none rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3
                               text-sm text-slate-900
                               outline-none
                               transition
                               focus:border-violet-500
                               focus:bg-white
                               focus:ring-4 focus:ring-violet-100"
                    >{{ old('address', $supplier->address) }}</textarea>

                    @error('address')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- INFO --}}
            <div
                class="mt-6 rounded-xl
                       border border-indigo-100
                       bg-indigo-50
                       px-4 py-3"
            >

                <div class="flex gap-3">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mt-0.5 h-5 w-5 shrink-0 text-indigo-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <circle cx="12" cy="12" r="9"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 10v6m0-9h.01"
                        />
                    </svg>

                    <p class="text-sm leading-6 text-indigo-700">
                        Perubahan data supplier tidak akan menghapus produk
                        yang sudah terhubung dengan supplier ini.
                    </p>

                </div>

            </div>


            {{-- BUTTON --}}
            <div
                class="mt-6 flex flex-col-reverse gap-3
                       border-t border-slate-100
                       pt-6
                       sm:flex-row sm:justify-end"
            >

                <a
                    href="{{ route('suppliers.index') }}"
                    class="inline-flex items-center justify-center
                           rounded-xl
                           border border-slate-200
                           bg-white
                           px-5 py-3
                           text-sm font-semibold text-slate-600
                           transition
                           hover:border-slate-300
                           hover:bg-slate-50"
                >
                    Batal
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl
                           bg-gradient-to-r from-violet-600 to-indigo-600
                           px-5 py-3
                           text-sm font-semibold text-white
                           shadow-lg shadow-violet-500/20
                           transition-all
                           hover:-translate-y-0.5
                           hover:shadow-xl"
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
                            d="m16.86 3.49 3.65 3.65M4 20l4.15-.9L19.6 7.65a2.58 2.58 0 0 0-3.65-3.65L4.5 15.8 4 20Z"
                        />
                    </svg>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection