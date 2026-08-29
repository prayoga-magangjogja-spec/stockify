<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Akses Ditolak - Stockify</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-[#f6f8fc] flex items-center justify-center antialiased">


    <div class="w-full max-w-lg px-6 py-10">


        <div class="p-8 text-center bg-white border border-slate-200 rounded-2xl shadow-xl shadow-slate-200/60 sm:p-10">


            {{-- ICON --}}

            <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6
                        bg-gradient-to-br from-indigo-500 to-violet-600
                        rounded-2xl shadow-lg shadow-indigo-200">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-9 w-9 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                    />
                </svg>

            </div>


            {{-- ERROR CODE --}}

            <h1 class="text-6xl font-extrabold tracking-tight text-slate-900">
                403
            </h1>


            {{-- TITLE --}}

            <h2 class="mt-3 text-2xl font-bold text-slate-900">
                Akses Ditolak
            </h2>


            {{-- DESCRIPTION --}}

            <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                Anda tidak memiliki izin untuk mengakses halaman ini.
                Hubungi Administrator jika Anda merasa ini adalah kesalahan.
            </p>


            {{-- USER ROLE --}}

            @auth

                <div class="p-5 mt-7 text-left bg-slate-50 border border-slate-100 rounded-xl">

                    <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                        Login sebagai
                    </p>

                    <p class="mt-1.5 font-semibold text-slate-900">
                        {{ auth()->user()->name }}
                    </p>

                    <span class="inline-flex items-center gap-2 px-3 py-1.5 mt-3 text-xs font-bold
                                 text-indigo-700 bg-indigo-50 border border-indigo-100 rounded-full">

                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>

                        {{ auth()->user()->role }}

                    </span>

                </div>

            @endauth


            {{-- BUTTON --}}

            <div class="flex flex-col gap-3 mt-8 sm:flex-row sm:justify-center">


                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl
                           bg-gradient-to-r from-indigo-600 to-violet-600
                           px-5 py-3
                           text-sm font-semibold text-white
                           shadow-lg shadow-indigo-200
                           transition-all duration-200
                           hover:-translate-y-0.5
                           hover:from-indigo-700 hover:to-violet-700
                           hover:shadow-xl hover:shadow-indigo-200"
                >
                    Kembali ke Dashboard
                </a>


                <button
                    type="button"
                    onclick="history.back()"
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7" /></svg> Kembali
                </button>


            </div>


            {{-- BRAND --}}

            <div class="pt-6 mt-8 border-t border-slate-100">

                <p class="text-sm font-bold text-slate-900">
                    Stockify
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Aplikasi Manajemen Stok Barang
                </p>

            </div>


        </div>

    </div>


</body>

</html>