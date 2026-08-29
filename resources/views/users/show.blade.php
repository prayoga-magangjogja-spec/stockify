@extends('layouts.app')

@section('title', 'Detail User - Stockify')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-7">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-7">

        <div>

            <div class="flex items-center gap-2 text-sm text-slate-400 mb-2">

                <a href="{{ route('users.index') }}"
                   class="hover:text-indigo-600 transition">
                    Manajemen User
                </a>

                <span>/</span>

                <span class="text-slate-600">
                    Detail User
                </span>

            </div>

            <h1 class="text-3xl font-bold text-slate-900">
                Detail User
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap pengguna Stockify.
            </p>

        </div>


        <div class="flex items-center gap-3">

            <a href="{{ route('users.index') }}"
               class="inline-flex items-center justify-center gap-2
                      px-5 py-3 rounded-xl
                      border border-slate-200
                      bg-white
                      text-sm font-semibold
                      text-slate-700
                      hover:bg-slate-50
                      transition shadow-sm">

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


            <a href="{{ route('users.edit', $user) }}"
               class="inline-flex items-center justify-center gap-2
                      px-5 py-3 rounded-xl
                      bg-indigo-600
                      text-white
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
                          d="M15.232 5.232l3.536 3.536M4 20h4l10.768-10.768a2.5 2.5 0 00-3.536-3.536L4.464 16.464A2.5 2.5 0 004 18.232V20z"/>

                </svg>

                Edit User

            </a>

        </div>

    </div>


    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


        {{-- PROFILE CARD --}}
        <div class="bg-white rounded-2xl
                    border border-slate-200
                    shadow-sm
                    p-7">

            <div class="flex flex-col items-center text-center">

                {{-- AVATAR --}}
                <div class="w-24 h-24 rounded-2xl
                            bg-indigo-50
                            border border-indigo-100
                            flex items-center justify-center
                            mb-5">

                    <span class="text-3xl font-bold text-indigo-600">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>

                </div>


                <h2 class="text-xl font-bold text-slate-900">
                    {{ $user->name }}
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $user->email }}
                </p>


                {{-- ROLE --}}
                @php
                    $roleClass = match($user->role) {
                        'Admin' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                        'Staff Gudang' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                        'Manajer Gudang' => 'bg-sky-50 text-sky-600 border-sky-100',
                        default => 'bg-slate-50 text-slate-600 border-slate-100',
                    };
                @endphp

                <span class="mt-4 inline-flex items-center gap-2
                             px-4 py-2 rounded-full
                             border text-xs font-semibold
                             {{ $roleClass }}">

                    <span class="w-2 h-2 rounded-full bg-current"></span>

                    {{ $user->role }}

                </span>

            </div>


            {{-- PROFILE INFO --}}
            <div class="mt-7 pt-6 border-t border-slate-100 space-y-4">

                <div class="flex items-center justify-between">

                    <span class="text-sm text-slate-500">
                        User ID
                    </span>

                    <span class="text-sm font-semibold text-slate-800">
                        #{{ $user->id }}
                    </span>

                </div>


                <div class="flex items-center justify-between">

                    <span class="text-sm text-slate-500">
                        Status
                    </span>

                    <span class="inline-flex items-center gap-2
                                 text-sm font-semibold text-emerald-600">

                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                        Aktif

                    </span>

                </div>

            </div>

        </div>


        {{-- DETAIL CARD --}}
        <div class="lg:col-span-2">

            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm overflow-hidden">


                {{-- HEADER --}}
                <div class="px-7 py-6 border-b border-slate-100">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 rounded-xl
                                    bg-indigo-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-indigo-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M5.121 17.804A9 9 0 1118.88 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-900">
                                Informasi Akun
                            </h2>

                            <p class="text-sm text-slate-500">
                                Detail informasi akun pengguna.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- INFORMATION --}}
                <div class="p-7">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- NAMA --}}
                        <div class="rounded-xl
                                    border border-slate-100
                                    bg-slate-50
                                    p-5">

                            <p class="text-xs font-semibold
                                      uppercase tracking-wider
                                      text-slate-400 mb-2">

                                Nama Lengkap

                            </p>

                            <p class="text-base font-semibold
                                      text-slate-900">

                                {{ $user->name }}

                            </p>

                        </div>


                        {{-- EMAIL --}}
                        <div class="rounded-xl
                                    border border-slate-100
                                    bg-slate-50
                                    p-5">

                            <p class="text-xs font-semibold
                                      uppercase tracking-wider
                                      text-slate-400 mb-2">

                                Email

                            </p>

                            <div class="flex items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-indigo-500 flex-shrink-0"
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

                                <p class="text-base font-semibold
                                          text-slate-900 break-all">

                                    {{ $user->email }}

                                </p>

                            </div>

                        </div>


                        {{-- ROLE --}}
                        <div class="rounded-xl
                                    border border-slate-100
                                    bg-slate-50
                                    p-5">

                            <p class="text-xs font-semibold
                                      uppercase tracking-wider
                                      text-slate-400 mb-2">

                                Role

                            </p>

                            <p class="text-base font-semibold
                                      text-slate-900">

                                {{ $user->role }}

                            </p>

                        </div>


                        {{-- USER ID --}}
                        <div class="rounded-xl
                                    border border-slate-100
                                    bg-slate-50
                                    p-5">

                            <p class="text-xs font-semibold
                                      uppercase tracking-wider
                                      text-slate-400 mb-2">

                                ID User

                            </p>

                            <p class="text-base font-semibold
                                      text-slate-900">

                                #{{ $user->id }}

                            </p>

                        </div>


                        {{-- CREATED --}}
                        <div class="rounded-xl
                                    border border-slate-100
                                    bg-slate-50
                                    p-5">

                            <p class="text-xs font-semibold
                                      uppercase tracking-wider
                                      text-slate-400 mb-2">

                                Terdaftar

                            </p>

                            <p class="text-base font-semibold
                                      text-slate-900">

                                {{ $user->created_at?->format('d/m/Y') ?? '-' }}

                            </p>

                            @if($user->created_at)
                                <p class="text-xs text-slate-400 mt-1">
                                    {{ $user->created_at->format('H:i') }} WIB
                                </p>
                            @endif

                        </div>


                        {{-- UPDATED --}}
                        <div class="rounded-xl
                                    border border-slate-100
                                    bg-slate-50
                                    p-5">

                            <p class="text-xs font-semibold
                                      uppercase tracking-wider
                                      text-slate-400 mb-2">

                                Terakhir Diperbarui

                            </p>

                            <p class="text-base font-semibold
                                      text-slate-900">

                                {{ $user->updated_at?->format('d/m/Y') ?? '-' }}

                            </p>

                            @if($user->updated_at)
                                <p class="text-xs text-slate-400 mt-1">
                                    {{ $user->updated_at->format('H:i') }} WIB
                                </p>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DANGER ZONE --}}
    <div class="mt-6">

        <div class="bg-white rounded-2xl
                    border border-red-100
                    shadow-sm p-6">

            <div class="flex flex-col md:flex-row
                        md:items-center
                        md:justify-between
                        gap-5">

                <div>

                    <h3 class="text-sm font-bold text-slate-900">
                        Hapus User
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Menghapus user akan menghilangkan akun tersebut
                        dari sistem Stockify.
                    </p>

                </div>


                <form action="{{ route('users.destroy', $user) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   px-5 py-3
                                   rounded-xl
                                   border border-red-200
                                   bg-red-50
                                   text-sm font-semibold
                                   text-red-600
                                   hover:bg-red-100
                                   transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h10"/>

                        </svg>

                        Hapus User

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection