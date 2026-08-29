@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- Header --}}
    <div class="mb-7">

        <div class="mb-2 flex items-center gap-2">
            <span class="h-2 w-2 rounded-full bg-indigo-600"></span>

            <span class="text-xs font-bold uppercase tracking-[0.15em] text-indigo-600">
                Manajemen Kategori
            </span>
        </div>

        <h1 class="text-3xl font-bold text-slate-900">
            Tambah Kategori
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Tambahkan kategori baru untuk mengelompokkan produk.
        </p>

    </div>


    {{-- Form Card --}}
    <div class="max-w-4xl rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Card Header --}}
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
                        Informasi Kategori
                    </h2>

                    <p class="text-sm text-slate-400">
                        Isi informasi kategori di bawah ini.
                    </p>
                </div>

            </div>

        </div>


        {{-- Form --}}
        <form
            action="{{ route('categories.store') }}"
            method="POST"
            class="p-6"
        >

            @csrf


            {{-- Nama --}}
            <div class="mb-6">

                <label
                    for="name"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Nama Kategori
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Elektronik"
                    required
                    class="w-full rounded-xl
                           border border-slate-200
                           bg-slate-50
                           px-4 py-3
                           text-sm text-slate-900
                           outline-none
                           transition-all duration-200
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


            {{-- Deskripsi --}}
            <div class="mb-6">

                <label
                    for="description"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    id="description"
                    rows="5"
                    placeholder="Masukkan deskripsi kategori..."
                    class="w-full resize-none rounded-xl
                           border border-slate-200
                           bg-slate-50
                           px-4 py-3
                           text-sm text-slate-900
                           outline-none
                           transition-all duration-200
                           placeholder:text-slate-400
                           focus:border-indigo-500
                           focus:bg-white
                           focus:ring-4 focus:ring-indigo-100"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Buttons --}}
            <div
                class="flex flex-col-reverse gap-3
                       border-t border-slate-100
                       pt-6
                       sm:flex-row sm:justify-end"
            >

                <a
                    href="{{ route('categories.index') }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl
                           border border-slate-200
                           bg-white
                           px-5 py-3
                           text-sm font-semibold text-slate-600
                           transition-all duration-200
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

                    Simpan Kategori

                </button>

            </div>

        </form>

    </div>

</div>

@endsection