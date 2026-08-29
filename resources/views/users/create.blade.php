@extends('layouts.app')

@section('title', 'Tambah User - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-7">

    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-7">

        <div>
            <div class="flex items-center gap-2 text-sm text-slate-400 mb-2">
                <a href="{{ route('users.index') }}"
                   class="hover:text-indigo-600 transition">
                    Manajemen User
                </a>

                <span>/</span>

                <span class="text-slate-600">
                    Tambah User
                </span>
            </div>

            <h1 class="text-3xl font-bold text-slate-900">
                Tambah User
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Tambahkan pengguna baru ke dalam sistem Stockify.
            </p>
        </div>

        <a href="{{ route('users.index') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-3
                  rounded-xl border border-slate-200 bg-white
                  text-sm font-semibold text-slate-700
                  hover:bg-slate-50 transition shadow-sm">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15 19l-7-7 7-7"/>
            </svg>

            Kembali
        </a>

    </div>


    {{-- FORM --}}
    <div class="max-w-4xl">

        <form action="{{ route('users.store') }}"
              method="POST">

            @csrf

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- CARD HEADER --}}
                <div class="px-7 py-6 border-b border-slate-100">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-indigo-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-indigo-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M18 9a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M3 20a6 6 0 0112 0"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M16 11a4 4 0 014 4v5"/>
                            </svg>

                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-slate-900">
                                Informasi User
                            </h2>

                            <p class="text-sm text-slate-500">
                                Masukkan data pengguna dengan lengkap.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- FORM BODY --}}
                <div class="p-7 space-y-6">

                    {{-- NAMA --}}
                    <div>
                        <label for="name"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Lengkap
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Contoh: Budi Santoso"
                               class="w-full rounded-xl border border-slate-200
                                      px-4 py-3 text-sm text-slate-800
                                      placeholder:text-slate-400
                                      focus:border-indigo-500 focus:ring-4
                                      focus:ring-indigo-100 outline-none
                                      transition
                                      @error('name') border-red-400 @enderror">

                        @error('name')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- EMAIL --}}
                    <div>
                        <label for="email"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Email
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 pl-4
                                        flex items-center pointer-events-none">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-slate-400"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M3 8l9 6 9-6"/>
                                    <rect x="3"
                                          y="5"
                                          width="18"
                                          height="14"
                                          rx="2"/>
                                </svg>

                            </div>

                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="contoh@email.com"
                                   class="w-full rounded-xl border border-slate-200
                                          pl-12 pr-4 py-3 text-sm text-slate-800
                                          placeholder:text-slate-400
                                          focus:border-indigo-500 focus:ring-4
                                          focus:ring-indigo-100 outline-none
                                          transition
                                          @error('email') border-red-400 @enderror">

                        </div>

                        @error('email')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- ROLE --}}
                    <div>
                        <label for="role"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Role
                        </label>

                        <select id="role"
                                name="role"
                                class="w-full rounded-xl border border-slate-200
                                       px-4 py-3 text-sm text-slate-800
                                       bg-white
                                       focus:border-indigo-500 focus:ring-4
                                       focus:ring-indigo-100 outline-none
                                       transition
                                       @error('role') border-red-400 @enderror">

                            <option value="">
                                Pilih Role
                            </option>

                            <option value="Admin"
                                {{ old('role') == 'Admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="Staff Gudang"
                                {{ old('role') == 'Staff Gudang' ? 'selected' : '' }}>
                                Staff Gudang
                            </option>

                            <option value="Manajer Gudang"
                                {{ old('role') == 'Manajer Gudang' ? 'selected' : '' }}>
                                Manajer Gudang
                            </option>

                        </select>

                        @error('role')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- PASSWORD --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label for="password"
                                   class="block text-sm font-semibold text-slate-700 mb-2">
                                Password
                            </label>

                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="Minimal 8 karakter"
                                   class="w-full rounded-xl border border-slate-200
                                          px-4 py-3 text-sm text-slate-800
                                          placeholder:text-slate-400
                                          focus:border-indigo-500 focus:ring-4
                                          focus:ring-indigo-100 outline-none
                                          transition
                                          @error('password') border-red-400 @enderror">

                            @error('password')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <div>
                            <label for="password_confirmation"
                                   class="block text-sm font-semibold text-slate-700 mb-2">
                                Konfirmasi Password
                            </label>

                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Ulangi password"
                                   class="w-full rounded-xl border border-slate-200
                                          px-4 py-3 text-sm text-slate-800
                                          placeholder:text-slate-400
                                          focus:border-indigo-500 focus:ring-4
                                          focus:ring-indigo-100 outline-none
                                          transition">
                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="px-7 py-5 bg-slate-50
                            border-t border-slate-100
                            flex flex-col-reverse sm:flex-row
                            sm:justify-end gap-3">

                    <a href="{{ route('users.index') }}"
                       class="inline-flex items-center justify-center
                              px-5 py-3 rounded-xl
                              border border-slate-200
                              bg-white text-sm font-semibold
                              text-slate-700
                              hover:bg-slate-50 transition">

                        Batal
                    </a>

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   px-6 py-3 rounded-xl
                                   bg-indigo-600 text-white
                                   text-sm font-semibold
                                   hover:bg-indigo-700
                                   shadow-lg shadow-indigo-200
                                   transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 4v16m8-8H4"/>
                        </svg>

                        Simpan User

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection