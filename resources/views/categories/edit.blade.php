@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- Header --}}
    <div class="mb-7">

        <div class="mb-2 flex items-center gap-2">
            <span class="h-2 w-2 rounded-full bg-violet-500"></span>

            <span class="text-xs font-bold uppercase tracking-[0.15em] text-violet-600">
                Manajemen Kategori
            </span>
        </div>

        <h1 class="text-3xl font-bold text-slate-900">
            Edit Kategori
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Perbarui informasi kategori yang dipilih.
        </p>

    </div>


    {{-- Form Card --}}
    <div class="max-w-4xl rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Card Header --}}
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
                        Edit Informasi
                    </h2>

                    <p class="text-sm text-slate-400">
                        Ubah data kategori sesuai kebutuhan.
                    </p>

                </div>

            </div>

        </div>


        {{-- Form --}}
        <form
            action="{{ route('categories.update', $category) }}"
            method="POST"
            class="p-6"
        >

            @csrf
            @method('PUT')


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
                    value="{{ old('name', $category->name) }}"
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
                           focus:border-violet-500
                           focus:bg-white
                           focus:ring-4 focus:ring-violet-100"
                >{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Info --}}
            <div
                class="mb-6 rounded-xl
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
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 10v6m0-9h.01"
                        />
                    </svg>

                    <p class="text-sm leading-6 text-indigo-700">
                        Mengubah kategori tidak akan mengubah data produk
                        yang sudah tersimpan.
                    </p>

                </div>

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
                           bg-gradient-to-r from-violet-600 to-indigo-600
                           px-5 py-3
                           text-sm font-semibold text-white
                           shadow-lg shadow-violet-500/20
                           transition-all duration-200
                           hover:-translate-y-0.5
                           hover:shadow-xl hover:shadow-violet-500/30"
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