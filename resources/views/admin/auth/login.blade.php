<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Admin Login | RealState
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FONT AWESOME --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>


<body class="min-h-screen bg-slate-950 text-white">


<div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10">


    {{-- =========================================================
         BACKGROUND GLOW
    ========================================================== --}}

    <div
        class="pointer-events-none absolute -left-40 -top-40 h-96 w-96 rounded-full bg-purple-600/20 blur-3xl">
    </div>

    <div
        class="pointer-events-none absolute -bottom-40 -right-40 h-96 w-96 rounded-full bg-orange-600/20 blur-3xl">
    </div>

    <div
        class="pointer-events-none absolute left-1/2 top-1/2 h-80 w-80 -translate-x-1/2 -translate-y-1/2 rounded-full bg-fuchsia-600/10 blur-3xl">
    </div>


    {{-- =========================================================
         LOGIN CARD
    ========================================================== --}}

    <div class="relative z-10 w-full max-w-md">


        {{-- BRAND --}}
        <div class="mb-8 text-center">

            <a
                href="{{ route('home') }}"
                class="inline-flex items-center gap-3">

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-purple-600 to-orange-500 shadow-xl shadow-purple-900/30">

                    <i class="fa-solid fa-house text-xl text-white"></i>

                </div>

                <div class="text-left">

                    <h1 class="text-2xl font-bold tracking-tight text-white">
                        Real<span class="text-orange-400">State</span>
                    </h1>

                    <p class="text-xs tracking-wider text-gray-500">
                        PROPERTY MANAGEMENT
                    </p>

                </div>

            </a>

        </div>


        {{-- =====================================================
             CARD
        ====================================================== --}}

        <div
            class="overflow-hidden rounded-3xl border border-purple-500/20 bg-slate-900/80 shadow-2xl shadow-black/40 backdrop-blur-xl">


            {{-- CARD TOP --}}
            <div
                class="border-b border-purple-500/10 bg-gradient-to-r from-purple-500/5 to-orange-500/5 px-6 py-7 sm:px-8">

                <div class="flex items-center gap-4">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                        <i class="fa-solid fa-user-shield text-lg"></i>

                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-white">
                            Admin Login
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Sign in to access your dashboard
                        </p>

                    </div>

                </div>

            </div>


            {{-- CARD BODY --}}
            <div class="p-6 sm:p-8">


                {{-- =================================================
                     SUCCESS MESSAGE
                ================================================== --}}

                @if(session('success'))

                    <div
                        class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3">

                        <i class="fa-solid fa-circle-check mt-0.5 text-emerald-400"></i>

                        <p class="text-sm text-emerald-300">
                            {{ session('success') }}
                        </p>

                    </div>

                @endif


                {{-- =================================================
                     ERROR MESSAGE
                ================================================== --}}

                @if(session('error'))

                    <div
                        class="mb-5 flex items-start gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">

                        <i class="fa-solid fa-circle-exclamation mt-0.5 text-red-400"></i>

                        <p class="text-sm text-red-300">
                            {{ session('error') }}
                        </p>

                    </div>

                @endif


                {{-- VALIDATION ERRORS --}}

                @if($errors->any())

                    <div
                        class="mb-5 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">

                        <div class="flex items-start gap-3">

                            <i
                                class="fa-solid fa-triangle-exclamation mt-0.5 text-red-400">
                            </i>

                            <div>

                                @foreach($errors->all() as $error)

                                    <p class="text-sm text-red-300">
                                        {{ $error }}
                                    </p>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     LOGIN FORM
                ================================================== --}}

                <form
                    action="{{ route('admin.login.submit') }}"
                    method="POST"
                    class="space-y-5">

                    @csrf


                    {{-- EMAIL --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-gray-300">

                            Email Address

                        </label>


                        <div class="relative">

                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">

                                <i class="fa-solid fa-envelope"></i>

                            </div>


                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="admin@example.com"
                                class="w-full rounded-xl border border-purple-500/20 bg-slate-950/70 py-3.5 pl-11 pr-4 text-sm text-white placeholder-gray-600 outline-none transition focus:border-orange-500/50 focus:ring-2 focus:ring-orange-500/10">

                        </div>

                        @error('email')

                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- PASSWORD --}}
                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-300">

                                Password

                            </label>

                        </div>


                        <div class="relative">

                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">

                                <i class="fa-solid fa-lock"></i>

                            </div>


                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                                class="w-full rounded-xl border border-purple-500/20 bg-slate-950/70 py-3.5 pl-11 pr-12 text-sm text-white placeholder-gray-600 outline-none transition focus:border-orange-500/50 focus:ring-2 focus:ring-orange-500/10">


                            {{-- SHOW PASSWORD --}}

                            <button
                                type="button"
                                id="togglePassword"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 transition hover:text-orange-400">

                                <i
                                    id="passwordIcon"
                                    class="fa-solid fa-eye">
                                </i>

                            </button>

                        </div>

                        @error('password')

                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- REMEMBER --}}
                    <div class="flex items-center">

                        <label class="inline-flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                class="h-4 w-4 rounded border-purple-500/30 bg-slate-950 text-orange-500 focus:ring-orange-500/20">

                            <span class="text-sm text-gray-400">
                                Remember me
                            </span>

                        </label>

                    </div>


                    {{-- LOGIN BUTTON --}}
                    <button
                        type="submit"
                        class="group flex w-full items-center justify-center gap-3 rounded-xl bg-gradient-to-r from-purple-600 to-orange-500 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-purple-900/20 transition duration-300 hover:from-purple-700 hover:to-orange-600 hover:shadow-orange-900/20">

                        <i
                            class="fa-solid fa-right-to-bracket transition-transform duration-300 group-hover:translate-x-1">
                        </i>

                        Sign In to Dashboard

                    </button>

                </form>


                {{-- =================================================
                     SECURITY INFO
                ================================================== --}}

                <div class="mt-6 flex items-center justify-center gap-2">

                    <i class="fa-solid fa-shield-halved text-xs text-emerald-500"></i>

                    <span class="text-xs text-gray-600">
                        Secure Admin Access
                    </span>

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="mt-6 text-center">

            <p class="text-xs text-gray-600">

                © {{ date('Y') }} RealState.
                All rights reserved.

            </p>

        </div>


        {{-- BACK TO WEBSITE --}}
        <div class="mt-4 text-center">

            <a
                href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 transition hover:text-orange-400">

                <i class="fa-solid fa-arrow-left"></i>

                Back to Website

            </a>

        </div>

    </div>

</div>


{{-- =============================================================
     SHOW / HIDE PASSWORD
============================================================= --}}

<script>

    const togglePassword = document.getElementById('togglePassword');

    const password = document.getElementById('password');

    const passwordIcon = document.getElementById('passwordIcon');


    togglePassword.addEventListener('click', function () {

        const isPassword = password.type === 'password';

        password.type = isPassword ? 'text' : 'password';

        passwordIcon.classList.toggle('fa-eye');

        passwordIcon.classList.toggle('fa-eye-slash');

    });

</script>

</body>

</html>