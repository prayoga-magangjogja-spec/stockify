<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - Stockify</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif;
        }
        .login-bg {
            background:
                radial-gradient(60rem 60rem at 110% -20%, rgba(124, 58, 237, 0.16), transparent 55%),
                radial-gradient(50rem 50rem at -15% 115%, rgba(79, 70, 229, 0.14), transparent 55%),
                #f4f6fb;
        }
    </style>

</head>


<body class="login-bg">

    <div class="flex flex-col items-center justify-center px-6 py-10 min-h-screen">

        {{-- LOGO --}}

        <a
            href="#"
            class="flex items-center gap-3 mb-8"
        >

            <span
                class="flex h-12 w-12 items-center justify-center rounded-2xl
                       bg-gradient-to-br from-indigo-600 to-violet-600
                       shadow-lg shadow-indigo-300/40"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                    />
                </svg>

            </span>

            <span class="text-2xl font-extrabold tracking-tight text-slate-900">
                Stockify
            </span>

        </a>


        {{-- CARD LOGIN --}}

        <div
            class="w-full max-w-md rounded-2xl border border-slate-200
                   bg-white shadow-xl shadow-slate-200/60"
        >

            <div class="p-7 sm:p-8">

                {{-- HEADING --}}

                <div class="mb-6">

                    <div class="mb-2 flex items-center gap-2">

                        <span class="h-2 w-2 rounded-full bg-indigo-600"></span>

                        <span class="text-xs font-bold uppercase tracking-[0.15em] text-indigo-600">
                            Selamat Datang
                        </span>

                    </div>

                    <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                        Masuk ke Stockify
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Silakan masuk menggunakan akun Anda.
                    </p>

                </div>


                {{-- ERROR --}}

                @if ($errors->any())

                    <div
                        class="mb-5 flex items-start gap-3 rounded-xl
                               border border-red-200 bg-red-50 p-4 text-sm"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"
                            />
                        </svg>

                        <ul class="list-inside list-disc space-y-1 text-red-600">
                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach
                        </ul>

                    </div>

                @endif


                {{-- FORM --}}

                <form
                    class="space-y-5"
                    method="POST"
                    action="{{ route('login') }}"
                >

                    @csrf


                    {{-- EMAIL --}}

                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Email
                        </label>

                        <div class="relative">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9 6 9-6" />
                            </svg>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                required
                                autofocus
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       py-3 pl-11 pr-4 text-sm text-slate-900
                                       placeholder:text-slate-400
                                       outline-none transition
                                       focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
                            >

                        </div>

                    </div>


                    {{-- PASSWORD --}}

                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Password
                        </label>

                        <div class="relative">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                                />
                            </svg>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       py-3 pl-11 pr-4 text-sm text-slate-900
                                       placeholder:text-slate-400
                                       outline-none transition
                                       focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
                            >

                        </div>

                    </div>


                    {{-- BUTTON --}}

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600
                               px-5 py-3 text-sm font-semibold text-white
                               shadow-lg shadow-indigo-200
                               transition-all duration-200
                               hover:-translate-y-0.5 hover:from-indigo-700 hover:to-violet-700
                               hover:shadow-xl hover:shadow-indigo-200"
                    >
                        Masuk
                    </button>

                </form>

            </div>

        </div>

        {{-- FOOTER --}}

        <p class="mt-8 text-xs text-slate-400">
            Aplikasi Manajemen Stok Barang &copy; Stockify
        </p>

    </div>

</body>

</html>
