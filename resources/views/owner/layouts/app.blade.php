<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
    @yield('title', 'Owner Dashboard')
</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- FONT AWESOME --}}
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
    onclick="toggleSidebar()"
></div>


{{-- =========================================================
     SIDEBAR
========================================================== --}}

<aside
    id="ownerSidebar"
    class="fixed inset-y-0 left-0 z-50 flex h-screen w-64 shrink-0
    -translate-x-full flex-col
    border-r border-purple-500/20
    bg-gradient-to-b from-slate-900 via-slate-900 to-purple-950
    transition-transform duration-300
    lg:sticky lg:top-0 lg:h-screen lg:translate-x-0"
>


    {{-- =====================================================
         LOGO
    ====================================================== --}}

    <div
        class="flex h-20 items-center justify-between border-b border-purple-500/20 px-6"
    >

        <a
            href="{{ route('owner.dashboard') }}"
            class="flex items-center gap-3"
        >

            {{-- LOGO ICON --}}

            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl
                bg-gradient-to-br from-purple-600 to-fuchsia-600
                text-white shadow-lg shadow-purple-900/30"
            >

                <i class="fa-solid fa-building"></i>

            </div>


            {{-- BRAND --}}

            <div>

                <h1 class="text-xl font-bold tracking-wide text-white">

                    Real<span class="text-fuchsia-400">State</span>

                </h1>

                <p
                    class="text-[10px] font-medium uppercase tracking-wider
                    text-purple-300/60"
                >

                    Owner Panel

                </p>

            </div>

        </a>


        {{-- MOBILE CLOSE --}}

        <button
            type="button"
            onclick="toggleSidebar()"
            class="text-gray-400 transition hover:text-fuchsia-400 lg:hidden"
        >

            <i class="fa-solid fa-xmark text-xl"></i>

        </button>

    </div>




    {{-- =====================================================
         NAVIGATION
    ====================================================== --}}

    <nav class="min-h-0 flex-1 overflow-y-auto px-3 py-5">


        {{-- =================================================
             MAIN MENU
        ================================================== --}}

        <div class="mb-2 px-4">

            <p
                class="text-xs font-semibold uppercase tracking-wider
                text-purple-300/60"
            >

                Main Menu

            </p>

        </div>


        {{-- =================================================
             DASHBOARD
        ================================================== --}}

        <a
            href="{{ route('owner.dashboard') }}"
            class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3
            text-sm font-medium transition

            {{ request()->routeIs('owner.dashboard')
                ? 'bg-gradient-to-r from-purple-600 to-fuchsia-600 text-white shadow-lg shadow-purple-900/30'
                : 'text-gray-400 hover:bg-purple-500/10 hover:text-fuchsia-300' }}"
        >

            <i class="fa-solid fa-gauge-high w-5"></i>

            <span>
                Dashboard
            </span>

        </a>




        {{-- =================================================
             PROPERTY MANAGEMENT
        ================================================== --}}

        <div class="mt-6 mb-2 px-4">

            <p
                class="text-xs font-semibold uppercase tracking-wider
                text-orange-300/60"
            >

                Property Management

            </p>

        </div>


        {{-- =================================================
             MY PROPERTIES
        ================================================== --}}

        <a
            href="{{ route('owner.properties.index') }}"
            class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3
            text-sm font-medium transition

            {{ request()->routeIs(
                'owner.properties.index',
                'owner.properties.show',
                'owner.properties.edit'
            )
                ? 'bg-gradient-to-r from-orange-500 to-amber-500 text-white shadow-lg shadow-orange-900/30'
                : 'text-gray-400 hover:bg-orange-500/10 hover:text-orange-300' }}"
        >

            <i class="fa-solid fa-building-circle-check w-5"></i>

            <span>
                My Properties
            </span>

        </a>


        {{-- =================================================
             ADD PROPERTY
        ================================================== --}}

        <a
            href="{{ route('owner.properties.create') }}"
            class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3
            text-sm font-medium transition

            {{ request()->routeIs('owner.properties.create')
                ? 'bg-gradient-to-r from-pink-500 to-rose-600 text-white shadow-lg shadow-pink-900/30'
                : 'text-gray-400 hover:bg-pink-500/10 hover:text-pink-300' }}"
        >

            <i class="fa-solid fa-plus w-5"></i>

            <span>
                Add Property
            </span>

        </a>




        {{-- =================================================
             TRANSACTION MANAGEMENT
        ================================================== --}}

        <div class="mt-6 mb-2 px-4">

            <p
                class="text-xs font-semibold uppercase tracking-wider
                text-indigo-300/60"
            >

                Transaction Management

            </p>

        </div>


        {{-- =================================================
             PROPERTY REQUESTS
        ================================================== --}}

        <a
            href="{{ route('owner.property-transactions.index') }}"
            class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3
            text-sm font-medium transition

            {{ request()->routeIs('agent.property-transactions.*')
                ? 'bg-gradient-to-r from-indigo-500 to-violet-600 text-white shadow-lg shadow-indigo-900/30'
                : 'text-gray-400 hover:bg-indigo-500/10 hover:text-indigo-300' }}"
        >

            <i class="fa-solid fa-file-signature w-5"></i>

            <span>
                Property Requests
            </span>

        </a>




        {{-- =================================================
             WEBSITE
        ================================================== --}}

        <div class="mt-6 mb-2 px-4">

            <p
                class="text-xs font-semibold uppercase tracking-wider
                text-emerald-300/60"
            >

                Website

            </p>

        </div>


        {{-- =================================================
             VIEW WEBSITE
        ================================================== --}}

        <a
            href="{{ route('home') }}"
            target="_blank"
            class="mb-1 flex items-center gap-3 rounded-xl px-4 py-3
            text-sm font-medium text-gray-400 transition
            hover:bg-emerald-500/10 hover:text-emerald-300"
        >

            <i class="fa-solid fa-globe w-5"></i>

            <span>
                View Website
            </span>

            <i
                class="fa-solid fa-arrow-up-right-from-square ml-auto
                text-xs text-gray-600"
            ></i>

        </a>




        {{-- =================================================
             SYSTEM
        ================================================== --}}

        <div class="mt-6 mb-2 px-4">

            <p
                class="text-xs font-semibold uppercase tracking-wider
                text-red-300/60"
            >

                System

            </p>

        </div>


        {{-- =================================================
             LOGOUT
        ================================================== --}}

        <form
            action="{{ route('logout') }}"
            method="POST"
            class="mt-1"
        >

            @csrf

            <button
                type="submit"
                class="flex w-full items-center gap-3 rounded-xl
                px-4 py-3 text-left text-sm font-medium
                text-gray-400 transition
                hover:bg-red-500/10 hover:text-red-400"
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
        class="sticky top-0 z-30 flex h-20 items-center justify-between
        border-b border-purple-500/20
        bg-slate-900/95
        px-4 backdrop-blur-xl
        sm:px-6"
    >


        {{-- =================================================
             LEFT
        ================================================== --}}

        <div class="flex items-center gap-4">


            {{-- MOBILE MENU --}}

            <button
                type="button"
                onclick="toggleSidebar()"
                class="flex h-10 w-10 items-center justify-center
                rounded-xl
                border border-purple-500/20
                bg-purple-500/10
                text-purple-300
                transition
                hover:bg-purple-500/20
                hover:text-white
                lg:hidden"
            >

                <i class="fa-solid fa-bars"></i>

            </button>


            {{-- PAGE TITLE --}}

            <div>

                <h1 class="text-lg font-semibold text-white sm:text-xl">

                    @yield('page-title', 'Dashboard')

                </h1>


                <p
                    class="hidden text-xs text-purple-300/60 sm:block"
                >

                    RealState Owner Panel

                </p>

            </div>

        </div>




        {{-- =================================================
             RIGHT
        ================================================== --}}

        <div class="flex items-center gap-3 sm:gap-5">


            {{-- =================================================
                 VIEW WEBSITE
            ================================================== --}}

            <a
                href="{{ route('home') }}"
                target="_blank"
                class="hidden items-center gap-2 rounded-xl
                border border-purple-500/20
                bg-purple-500/10
                px-4 py-2
                text-sm text-purple-300
                transition
                hover:bg-purple-500/20
                hover:text-white
                sm:flex"
            >

                <i class="fa-solid fa-globe"></i>

                Website

            </a>




            {{-- =================================================
                 OWNER USER
            ================================================== --}}

            <div class="flex items-center gap-3">


                {{-- NAME --}}

                <div class="hidden text-right sm:block">

                    <p class="text-sm font-medium text-white">

                        {{ auth('web')->user()->name }}

                    </p>

                    <p
                        class="text-xs capitalize text-fuchsia-400"
                    >

                        {{ auth('web')->user()->role }}

                    </p>

                </div>


                {{-- AVATAR --}}

                <div
                    class="flex h-10 w-10 items-center justify-center
                    rounded-full
                    bg-gradient-to-br from-purple-500 to-fuchsia-600
                    text-sm font-bold uppercase text-white
                    shadow-lg shadow-purple-900/30"
                >

                    {{ strtoupper(
                        substr(
                            auth('web')->user()->name,
                            0,
                            1
                        )
                    ) }}

                </div>

            </div>


        </div>

    </header>




    {{-- =====================================================
         PAGE CONTENT
    ====================================================== --}}

    <main
        class="relative flex-1 overflow-hidden
        bg-[#15131a]
        p-4 sm:p-6"
    >


        {{-- =================================================
             BACKGROUND GLOWS
        ================================================== --}}

        {{-- PURPLE --}}

        <div
            class="pointer-events-none absolute -left-32 -top-32
            h-80 w-80 rounded-full
            bg-purple-600/10 blur-3xl"
        ></div>


        {{-- PINK --}}

        <div
            class="pointer-events-none absolute right-0 top-20
            h-72 w-72 rounded-full
            bg-fuchsia-600/10 blur-3xl"
        ></div>


        {{-- ORANGE --}}

        <div
            class="pointer-events-none absolute bottom-0 left-1/3
            h-64 w-64 rounded-full
            bg-orange-500/5 blur-3xl"
        ></div>


        {{-- BLUE --}}

        <div
            class="pointer-events-none absolute right-1/4 bottom-1/4
            h-56 w-56 rounded-full
            bg-indigo-500/5 blur-3xl"
        ></div>




        {{-- =================================================
             CONTENT
        ================================================== --}}

        <div class="relative z-10">


            {{-- =================================================
                 SUCCESS MESSAGE
            ================================================== --}}

            @if(session('success'))

                <div
                    class="mb-5 rounded-xl
                    border border-emerald-500/20
                    bg-emerald-500/10
                    px-4 py-3
                    text-sm text-emerald-400"
                >

                    <div class="flex items-center gap-2">

                        <i class="fa-solid fa-circle-check"></i>

                        <span>
                            {{ session('success') }}
                        </span>

                    </div>

                </div>

            @endif




            {{-- =================================================
                 ERROR MESSAGE
            ================================================== --}}

            @if(session('error'))

                <div
                    class="mb-5 rounded-xl
                    border border-red-500/20
                    bg-red-500/10
                    px-4 py-3
                    text-sm text-red-400"
                >

                    <div class="flex items-center gap-2">

                        <i class="fa-solid fa-circle-exclamation"></i>

                        <span>
                            {{ session('error') }}
                        </span>

                    </div>

                </div>

            @endif




            {{-- =================================================
                 VALIDATION ERRORS
            ================================================== --}}

            @if($errors->any())

                <div
                    class="mb-5 rounded-xl
                    border border-red-500/20
                    bg-red-500/10
                    px-4 py-3
                    text-sm text-red-400"
                >

                    <div class="flex items-start gap-3">

                        <i
                            class="fa-solid fa-circle-exclamation mt-0.5"
                        ></i>

                        <div>

                            <p class="font-semibold">
                                Please fix the following errors:
                            </p>

                            <ul class="mt-2 list-disc space-y-1 pl-5">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif




            {{-- =================================================
                 PAGE CONTENT
            ================================================== --}}

            @yield('content')


        </div>


    </main>




    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <footer
        class="border-t border-purple-500/20
        bg-slate-900
        px-6 py-4"
    >

        <p
            class="text-center text-xs text-purple-300/50"
        >

            © {{ date('Y') }} RealState.
            All rights reserved.

        </p>

    </footer>


</div>


</div>




{{-- =========================================================
     SIDEBAR JAVASCRIPT
========================================================== --}}

<script>

function toggleSidebar() {

    const sidebar = document.getElementById('ownerSidebar');

    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !overlay) {
        return;
    }

    sidebar.classList.toggle('-translate-x-full');

    overlay.classList.toggle('hidden');

}


/*
|--------------------------------------------------------------------------
| Close sidebar automatically on desktop
|--------------------------------------------------------------------------
*/

window.addEventListener('resize', function () {

    const sidebar = document.getElementById('ownerSidebar');

    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !overlay) {
        return;
    }

    if (window.innerWidth >= 1024) {

        sidebar.classList.remove('-translate-x-full');

        overlay.classList.add('hidden');

    }

});

</script>


</body>

</html>