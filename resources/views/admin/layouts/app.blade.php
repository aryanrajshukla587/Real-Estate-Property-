<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
    @yield('title', 'Admin Dashboard')
</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>

</head>

<body class="bg-slate-950 text-gray-100">

<div class="min-h-screen flex">

{{-- =========================================================
MOBILE OVERLAY
========================================================== --}}

<div
    id="sidebarOverlay"
    class="fixed inset-0 z-40 hidden bg-black/70 backdrop-blur-sm lg:hidden"
    onclick="toggleSidebar()">
</div>

{{-- =========================================================
SIDEBAR
========================================================== --}}

<aside
    id="adminSidebar"
    class="fixed inset-y-0 left-0 z-50 flex h-screen w-64 shrink-0 -translate-x-full flex-col border-r border-purple-500/20 bg-gradient-to-b from-slate-900 via-slate-900 to-purple-950 transition-transform duration-300 lg:sticky lg:top-0 lg:h-screen lg:translate-x-0">

{{-- LOGO --}}

<div class="flex h-20 items-center justify-between border-b border-purple-500/20 px-6">

    <a
        href="{{ route('admin.dashboard') }}"
        class="text-xl font-bold tracking-wide text-white">

        Real<span class="text-fuchsia-400">State</span>

    </a>


    <button
        onclick="toggleSidebar()"
        class="text-gray-400 transition hover:text-fuchsia-400 lg:hidden">

        <i class="fa-solid fa-xmark text-xl"></i>

    </button>

</div>


{{-- =====================================================
     NAVIGATION
====================================================== --}}

<nav class="min-h-0 flex-1 overflow-y-auto px-3 py-5">


    {{-- =================================================
         DASHBOARD
    ================================================== --}}

    <a
        href="{{ route('admin.dashboard') }}"
        class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
        {{ request()->routeIs('admin.dashboard')
            ? 'bg-gradient-to-r from-purple-600 to-fuchsia-600 text-white shadow-lg shadow-purple-900/30'
            : 'text-gray-400 hover:bg-purple-500/10 hover:text-fuchsia-300' }}"
    >

        <i class="fa-solid fa-gauge w-5"></i>

        <span>
            Dashboard
        </span>

    </a>


    {{-- =====================================================
         PROPERTY MANAGEMENT
    ====================================================== --}}

    <div class="mt-6 mb-2 px-4">

        <p class="text-xs font-semibold uppercase tracking-wider text-purple-300/60">
            Property Management
        </p>

    </div>


    {{-- PROPERTIES --}}

    <a
        href="{{ route('admin.properties.index') }}"
        class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
        {{ request()->routeIs('admin.properties.*')
            ? 'bg-gradient-to-r from-orange-500 to-amber-500 text-white shadow-lg shadow-orange-900/30'
            : 'text-gray-400 hover:bg-orange-500/10 hover:text-orange-300' }}"
    >

        <i class="fa-solid fa-building w-5"></i>

        <span>
            Properties
        </span>

    </a>


    {{-- PROPERTY TYPES --}}

    <a
        href="{{ route('admin.property-types.index') }}"
        class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
        {{ request()->routeIs('admin.property-types.*')
            ? 'bg-gradient-to-r from-pink-500 to-rose-600 text-white shadow-lg shadow-pink-900/30'
            : 'text-gray-400 hover:bg-pink-500/10 hover:text-pink-300' }}"
    >

        <i class="fa-solid fa-layer-group w-5"></i>

        <span>
            Property Types
        </span>

    </a>


    {{-- LOCATIONS --}}

    <a
        href="{{ route('admin.locations.index') }}"
        class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
        {{ request()->routeIs('admin.locations.*')
            ? 'bg-gradient-to-r from-emerald-500 to-green-600 text-white shadow-lg shadow-emerald-900/30'
            : 'text-gray-400 hover:bg-emerald-500/10 hover:text-emerald-300' }}"
    >

        <i class="fa-solid fa-location-dot w-5"></i>

        <span>
            Locations
        </span>

    </a>


    {{-- =====================================================
         PEOPLE MANAGEMENT
    ====================================================== --}}

    <div class="mt-6 mb-2 px-4">

        <p class="text-xs font-semibold uppercase tracking-wider text-fuchsia-300/60">
            People Management
        </p>

    </div>


    {{-- AGENTS --}}

    <a
        href="{{ route('admin.agents.index') }}"
        class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
        {{ request()->routeIs('admin.agents.*')
            ? 'bg-gradient-to-r from-yellow-400 to-amber-500 text-white shadow-lg shadow-yellow-900/30'
            : 'text-gray-400 hover:bg-yellow-500/10 hover:text-yellow-300' }}"
    >

        <i class="fa-solid fa-user-tie w-5"></i>

        <span>
            Agents
        </span>

    </a>

    {{-- OWNERS --}}

<a
    href="{{ route('admin.owners.index') }}"
    class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
    {{ request()->routeIs('admin.owners.*')
        ? 'bg-gradient-to-r from-cyan-500 to-teal-500 text-white shadow-lg shadow-cyan-900/30'
        : 'text-gray-400 hover:bg-cyan-500/10 hover:text-cyan-300' }}"
>

    <i class="fa-solid fa-house-user w-5"></i>

    <span>
        Owners
    </span>

</a>


    {{-- =====================================================
         COMMUNICATION
    ====================================================== --}}

    <div class="mt-6 mb-2 px-4">

        <p class="text-xs font-semibold uppercase tracking-wider text-purple-300/60">
            Communication
        </p>

    </div>


    {{-- NEWSLETTER SUBSCRIBERS --}}

    <a
        href="{{ route('admin.newsletter-subscribers.index') }}"
        class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
        {{ request()->routeIs('admin.newsletter-subscribers.*')
            ? 'bg-gradient-to-r from-sky-500 to-cyan-500 text-white shadow-lg shadow-sky-900/30'
            : 'text-gray-400 hover:bg-sky-500/10 hover:text-sky-300' }}"
    >

        <i class="fa-solid fa-envelope w-5"></i>

        <span>
            Newsletter Subscribers
        </span>

    </a>


    {{-- CONTACT MESSAGES --}}

    <a
        href="{{ route('admin.contact-messages.index') }}"
        class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
        {{ request()->routeIs('admin.contact-messages.*')
            ? 'bg-gradient-to-r from-rose-500 to-red-600 text-white shadow-lg shadow-red-900/30'
            : 'text-gray-400 hover:bg-red-500/10 hover:text-red-300' }}"
    >

        <i class="fa-solid fa-envelope-open-text w-5"></i>

        <span>
            Contact Messages
        </span>

    </a>


    {{-- =====================================================
         TRANSACTION MANAGEMENT
    ====================================================== --}}

    <div class="mt-6 mb-2 px-4">

        <p class="text-xs font-semibold uppercase tracking-wider text-indigo-300/60">
            Transaction Management
        </p>

    </div>


    {{-- PROPERTY REQUESTS --}}

    <a
        href="{{ route('admin.property-transactions.index') }}"
        class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
        {{ request()->routeIs('admin.property-transactions.*')
            ? 'bg-gradient-to-r from-indigo-500 to-violet-600 text-white shadow-lg shadow-indigo-900/30'
            : 'text-gray-400 hover:bg-indigo-500/10 hover:text-indigo-300' }}"
    >

        <i class="fa-solid fa-file-signature w-5"></i>

        <span>
            Property Requests
        </span>

    </a>


    {{-- =====================================================
         SYSTEM
    ====================================================== --}}

    <div class="mt-6 mb-2 px-4">

        <p class="text-xs font-semibold uppercase tracking-wider text-purple-300/60">
            System
        </p>

    </div>


    {{-- ADMIN LOGOUT --}}

    <form
        action="{{ route('admin.logout') }}"
        method="POST"
        class="mt-1"
    >

        @csrf

        <button
            type="submit"
            class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-medium text-gray-400 transition hover:bg-red-500/10 hover:text-red-400"
        >

            <i class="fa-solid fa-right-from-bracket w-5"></i>

            <span>
                Logout
            </span>

        </button>

    </form>


</nav>


</aside>


{{-- =========================================================
MAIN AREA
========================================================== --}}

<div class="flex min-h-screen min-w-0 flex-1 flex-col">


{{-- =====================================================
     TOP HEADER
====================================================== --}}

<header
    class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-purple-500/20 bg-slate-900/95 px-4 backdrop-blur-xl sm:px-6">


    {{-- LEFT --}}

    <div class="flex items-center gap-4">


        {{-- MOBILE MENU --}}

        <button
            onclick="toggleSidebar()"
            class="flex h-10 w-10 items-center justify-center rounded-xl border border-purple-500/20 bg-purple-500/10 text-purple-300 transition hover:bg-purple-500/20 hover:text-white lg:hidden">

            <i class="fa-solid fa-bars"></i>

        </button>


        <div>

            <h1 class="text-lg font-semibold text-white sm:text-xl">

                @yield('page-title', 'Dashboard')

            </h1>


            <p class="hidden text-xs text-purple-300/60 sm:block">

                RealState Administration

            </p>

        </div>


    </div>


    {{-- RIGHT --}}

    <div class="flex items-center gap-3">


        {{-- ADMIN USER --}}

        @if(auth('admin')->check())

            <div class="hidden text-right sm:block">

                <p class="text-sm font-medium text-white">

                    {{ auth('admin')->user()->name }}

                </p>


                <p class="text-xs capitalize text-fuchsia-400">

                    {{ auth('admin')->user()->role }}

                </p>

            </div>


            {{-- AVATAR --}}

            <div
                class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-fuchsia-600 text-sm font-bold text-white shadow-lg shadow-purple-900/30">

                {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}

            </div>

        @endif


    </div>


</header>


{{-- =====================================================
     PAGE CONTENT
====================================================== --}}

<main
    class="relative flex-1 overflow-hidden bg-[#15131a] p-4 sm:p-6">


{{-- PURPLE GLOW --}}

<div
    class="pointer-events-none absolute -left-32 -top-32 h-80 w-80 rounded-full bg-purple-600/10 blur-3xl">
</div>


{{-- PINK GLOW --}}

<div
    class="pointer-events-none absolute right-0 top-20 h-72 w-72 rounded-full bg-fuchsia-600/10 blur-3xl">
</div>


{{-- ORANGE GLOW --}}

<div
    class="pointer-events-none absolute bottom-0 left-1/3 h-64 w-64 rounded-full bg-orange-500/5 blur-3xl">
</div>


{{-- CONTENT --}}

<div class="relative z-10">


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div
            class="mb-5 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-400">

            <div class="flex items-center gap-2">

                <i class="fa-solid fa-circle-check"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    {{-- ERROR MESSAGE --}}

    @if(session('error'))

        <div
            class="mb-5 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-400">

            <div class="flex items-center gap-2">

                <i class="fa-solid fa-circle-exclamation"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        </div>

    @endif


    @yield('content')

</div>


</main>


{{-- =====================================================
     FOOTER
====================================================== --}}

<footer
    class="border-t border-purple-500/20 bg-slate-900 px-6 py-4">

    <p class="text-center text-xs text-purple-300/50">

        © {{ date('Y') }} RealState. All rights reserved.

    </p>

</footer>


</div>

</div>


{{-- =========================================================
SIDEBAR JAVASCRIPT
========================================================= --}}

<script>

function toggleSidebar() {

    const sidebar = document.getElementById('adminSidebar');

    const overlay = document.getElementById('sidebarOverlay');

    sidebar.classList.toggle('-translate-x-full');

    overlay.classList.toggle('hidden');

}

</script>


</body>

</html>
