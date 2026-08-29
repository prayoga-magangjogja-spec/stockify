@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')

<div class="min-h-screen bg-[#f7f9fc] px-6 py-6 lg:px-8">

    {{-- =========================================================
        ALERT
    ========================================================== --}}

    @if(session('success'))
        <div class="mb-5 flex items-center gap-3 rounded-2xl
                    border border-emerald-200 bg-emerald-50
                    px-5 py-4 text-sm font-semibold text-emerald-700">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5 shrink-0"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7" />
            </svg>

            <span>{{ session('success') }}</span>

        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 flex items-center gap-3 rounded-2xl
                    border border-red-200 bg-red-50
                    px-5 py-4 text-sm font-semibold text-red-700">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5 shrink-0"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z" />
            </svg>

            <span>{{ session('error') }}</span>

        </div>
    @endif


    {{-- =========================================================
        HEADER
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
                Manajemen User
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola pengguna dan hak akses yang tersedia di Stockify.
            </p>

        </div>

        <a href="{{ route('users.create') }}"
           class="inline-flex items-center justify-center gap-2
                  rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600
                  px-5 py-3 text-sm font-semibold text-white
                  shadow-lg shadow-indigo-200
                  transition-all duration-200
                  hover:-translate-y-0.5 hover:from-indigo-700 hover:to-violet-700
                  hover:shadow-xl hover:shadow-indigo-200">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 4v16m8-8H4" />
            </svg>

            Tambah User

        </a>

    </div>


    {{-- =========================================================
        STATISTICS
    ========================================================== --}}

    @php
        $totalUsers = $users->count();
        $totalAdmin = $users->where('role', 'Admin')->count();
        $totalStaff = $users->where('role', 'Staff Gudang')->count();
    @endphp

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">

        {{-- Total User --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm
                    transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total User
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $totalUsers }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Pengguna terdaftar
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-indigo-50 text-indigo-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Administrator --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm
                    transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Administrator
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $totalAdmin }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Pengguna dengan akses admin
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-violet-50 text-violet-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z" />
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 12l2 2 4-4" />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Staff Gudang --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm
                    transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Staff Gudang
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $totalStaff }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Pengguna operasional gudang
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-emerald-50 text-emerald-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        DATA USER
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- CARD HEADER --}}
        <div class="flex flex-col gap-3 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>

                </div>

                <div>

                    <h2 class="font-bold text-slate-900">
                        Data User
                    </h2>

                    <p class="text-sm text-slate-500">
                        Daftar seluruh pengguna yang terdaftar di Stockify.
                    </p>

                </div>

            </div>

            <div class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-sm font-semibold text-slate-600">

                <span class="font-bold text-indigo-600">
                    {{ $totalUsers }}
                </span>

                User

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] text-left text-sm">

                <thead>

                    <tr class="border-b border-slate-100 bg-slate-50 text-xs font-bold uppercase tracking-wider text-slate-500">

                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            User
                        </th>

                        <th class="px-6 py-4">
                            Email
                        </th>

                        <th class="px-6 py-4">
                            Role
                        </th>

                        <th class="px-6 py-4">
                            Terdaftar
                        </th>

                        <th class="px-6 py-4">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($users as $index => $user)

                        <tr class="transition hover:bg-indigo-50/40">

                            {{-- NO --}}
                            <td class="px-6 py-4">

                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">
                                    {{ $index + 1 }}
                                </span>

                            </td>


                            {{-- USER --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                                                border border-indigo-100 bg-indigo-50 text-sm font-extrabold text-indigo-600">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate font-semibold text-slate-900">
                                            {{ $user->name }}
                                        </p>

                                        <p class="text-xs text-slate-400">
                                            ID #{{ $user->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2.5">

                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-500">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">
                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9 6 9-6" />
                                        </svg>

                                    </span>

                                    <span class="truncate text-slate-600">
                                        {{ $user->email }}
                                    </span>

                                </div>

                            </td>


                            {{-- ROLE --}}
                            <td class="px-6 py-4">

                                @php
                                    $roleBadge = match($user->role) {
                                        'Admin' => 'bg-violet-50 text-violet-700 ring-violet-200',
                                        'Staff Gudang' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                        default => 'bg-sky-50 text-sky-700 ring-sky-200',
                                    };
                                    $roleDot = match($user->role) {
                                        'Admin' => 'bg-violet-600',
                                        'Staff Gudang' => 'bg-emerald-600',
                                        default => 'bg-sky-600',
                                    };
                                @endphp

                                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-bold ring-1 {{ $roleBadge }}">

                                    <span class="h-1.5 w-1.5 rounded-full {{ $roleDot }}"></span>

                                    {{ $user->role }}

                                </span>

                            </td>


                            {{-- TERDAFTAR --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2.5">

                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-500">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" />
                                        </svg>

                                    </span>

                                    <div>

                                        <p class="text-sm font-semibold text-slate-800">
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </p>

                                        <p class="text-xs text-slate-400">
                                            {{ $user->created_at->format('H:i') }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- AKSI --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('users.show', $user) }}"
                                       title="Lihat detail"
                                       class="flex h-9 w-9 items-center justify-center rounded-lg border border-indigo-200 bg-indigo-50 text-indigo-600 transition hover:bg-indigo-600 hover:text-white">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>

                                    </a>


                                    {{-- EDIT --}}
                                    <a href="{{ route('users.edit', $user) }}"
                                       title="Edit user"
                                       class="flex h-9 w-9 items-center justify-center rounded-lg border border-amber-200 bg-amber-50 text-amber-600 transition hover:bg-amber-500 hover:text-white">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4z" />
                                        </svg>

                                    </a>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('users.destroy', $user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Hapus user"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 transition hover:bg-red-600 hover:text-white"
                                        >

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-4 w-4"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v5M14 11v5" />
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-400">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-8 w-8"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="1.5">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>

                                    </div>

                                    <h3 class="font-semibold text-slate-900">
                                        Belum ada user
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Belum terdapat pengguna yang terdaftar di Stockify.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- FOOTER --}}
        <div class="flex flex-col gap-2 border-t border-slate-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

            <p class="text-sm text-slate-500">

                Menampilkan

                <span class="font-semibold text-slate-700">
                    {{ $totalUsers }}
                </span>

                user

            </p>

            <p class="text-xs text-slate-400">
                User terbaru berada di bagian paling atas.
            </p>

        </div>

    </div>

</div>

@endsection
