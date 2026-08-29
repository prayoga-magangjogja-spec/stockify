@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-7">

        <div class="mb-2 flex items-center gap-2">
            <span class="h-2 w-2 rounded-full bg-indigo-600"></span>

            <span class="text-xs font-bold uppercase tracking-[0.15em] text-indigo-600">
                Manajemen Supplier
            </span>
        </div>

        <h1 class="text-3xl font-bold text-slate-900">
            Tambah Supplier
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Tambahkan supplier baru ke dalam sistem Stockify.
        </p>

    </div>


    {{-- FORM --}}
    <div class="max-w-5xl rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-indigo-50 text-indigo-600"
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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="font-bold text-slate-900">
                        Informasi Supplier
                    </h2>

                    <p class="text-sm text-slate-400">
                        Lengkapi informasi supplier di bawah ini.
                    </p>

                </div>

            </div>

        </div>


        <form
            action="{{ route('suppliers.store') }}"
            method="POST"
            class="p-6"
        >

            @csrf


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
                        value="{{ old('name') }}"
                        required
                        placeholder="Contoh: PT Sumber Makmur"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3
                               text-sm text-slate-900
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-indigo-500
                               focus:bg-white
                               focus:ring-4 focus:ring-indigo-100"
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
                        value="{{ old('phone') }}"
                        placeholder="Contoh: 081234567890"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3
                               text-sm text-slate-900
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-indigo-500
                               focus:bg-white
                               focus:ring-4 focus:ring-indigo-100"
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
                        value="{{ old('email') }}"
                        placeholder="supplier@email.com"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3
                               text-sm text-slate-900
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-indigo-500
                               focus:bg-white
                               focus:ring-4 focus:ring-indigo-100"
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
                        placeholder="Masukkan alamat lengkap supplier..."
                        class="w-full resize-none rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3
                               text-sm text-slate-900
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-indigo-500
                               focus:bg-white
                               focus:ring-4 focus:ring-indigo-100"
                    >{{ old('address') }}</textarea>

                    @error('address')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- BUTTON --}}
            <div
                class="mt-8 flex flex-col-reverse gap-3
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
                           bg-gradient-to-r from-indigo-600 to-violet-600
                           px-5 py-3
                           text-sm font-semibold text-white
                           shadow-lg shadow-indigo-200
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
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Simpan Supplier

                </button>

            </div>

        </form>

    </div>

</div>

@endsection