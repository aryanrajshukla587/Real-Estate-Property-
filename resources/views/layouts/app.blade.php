
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>
    @yield('title', 'RealState')
</title>


{{-- =====================================================
     GOOGLE FONT
====================================================== --}}

<link rel="preconnect" href="https://fonts.googleapis.com">

<link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
>

<link
    href="https://fonts.googleapis.com/css2?family=Exo:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
>


{{-- =====================================================
     FONT AWESOME
====================================================== --}}

{{-- 
    Font Awesome 6 CDN
    Supports:
    fa-solid fa-*
    fa-regular fa-*
    fa-brands fa-*
--}}

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
>


{{-- =====================================================
     TAILWIND CSS / VITE
====================================================== --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])


{{-- =====================================================
     BOOTSTRAP
====================================================== --}}

<link
    rel="stylesheet"
    href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}"
>


{{-- =====================================================
     THEMIFY ICONS
====================================================== --}}

<link
    rel="stylesheet"
    href="{{ asset('assets/fonts/themify-icons.css') }}"
>


{{-- =====================================================
     OWL CAROUSEL
====================================================== --}}

<link
    rel="stylesheet"
    href="{{ asset('assets/owlcarousel/css/owl.carousel.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/owlcarousel/css/owl.theme.css') }}"
>


{{-- =====================================================
     HILUX CSS
====================================================== --}}

<link
    rel="stylesheet"
    href="{{ asset('assets/css/fonts.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/prettyPhoto.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/animate.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/slick.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/menu.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/style.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/responsive.css') }}"
>


{{-- =====================================================
     CUSTOM LAYOUT CSS
====================================================== --}}

<style>

    /* =====================================================
       GLOBAL
    ====================================================== */

    html,
    body {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Exo', sans-serif;
    }

    main {
        width: 100%;
        min-height: 300px;
    }


    /* =====================================================
       FONT AWESOME FIX
    ====================================================== */

    /*
     * Make sure Font Awesome icons are visible
     * even if old project CSS contains conflicting
     * icon styles.
     */

    i.fa,
    i.fas,
    i.far,
    i.fab,
    i.fa-solid,
    i.fa-regular,
    i.fa-brands {
        font-style: normal;
        line-height: 1;
    }

    /*
     * Old Font Awesome class compatibility
     */

    .fa {
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
    }

    .fas,
    .fa-solid {
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
    }

    .far,
    .fa-regular {
        font-family: "Font Awesome 6 Free";
        font-weight: 400;
    }

    .fab,
    .fa-brands {
        font-family: "Font Awesome 6 Brands";
        font-weight: 400;
    }


    /* =====================================================
       STICKY HEADER
    ====================================================== */

    .sticky-wrapper {
        width: 100%;
        z-index: 9999;
    }

    .site-navbar {
        width: 100%;
        z-index: 9999;
        background: #0c3d48 !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .site-navigation {
        position: relative;
        z-index: 9999;
    }

    .site-menu {
        position: relative;
        z-index: 9999;
    }

    .site-menu > li {
        position: relative;
    }

    .site-menu .dropdown {
        z-index: 99999;
    }


    /* =====================================================
       LOGO
    ====================================================== */

    .site-logo img {
        max-width: 150px;
        height: auto;
    }


    /* =====================================================
       FOOTER
    ====================================================== */

    .footer-area {
        width: 100%;
        position: relative;
        z-index: 1;
    }

    .footer_social ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer_social ul li {
        display: inline-block;
    }


    /* =====================================================
       FOOTER ICONS
    ====================================================== */

    .footer_social i,
    .footer_contact i {
        display: inline-block;
    }


    /* =====================================================
       USER / OWNER / AGENT BUTTON
    ====================================================== */

    .realstate-user-menu {
        margin-left: 12px;

        width: auto !important;

        flex-shrink: 0;
    }

    .realstate-user-btn {
        display: inline-flex !important;

        align-items: center;
        justify-content: center;

        gap: 8px;

        width: max-content !important;
        min-width: max-content !important;
        max-width: none !important;

        padding: 10px 16px !important;

        border-radius: 30px;

        background: linear-gradient(
            135deg,
            #7c3aed,
            #c026d3
        );

        color: #ffffff !important;

        font-size: 13px;
        font-weight: 600;

        line-height: 1;

        text-decoration: none !important;

        white-space: nowrap;

        overflow: visible !important;

        box-shadow:
            0 8px 20px rgba(124, 58, 237, 0.25);

        transition:
            all 0.3s ease;
    }

    .realstate-user-btn i {
        font-size: 14px;

        flex-shrink: 0;

        color: #ffffff !important;
    }

    .realstate-user-btn:hover {
        color: #ffffff !important;

        transform: translateY(-2px);

        background: linear-gradient(
            135deg,
            #6d28d9,
            #a21caf
        );

        box-shadow:
            0 12px 28px rgba(124, 58, 237, 0.35);
    }


    /* =====================================================
       USER / OWNER / AGENT NAME
    ====================================================== */

    .realstate-user-name {

        display: inline-block;

        width: auto !important;

        max-width: none !important;

        overflow: visible !important;

        text-overflow: clip !important;

        white-space: nowrap;
    }


    /* =====================================================
       MOBILE USER BUTTON
    ====================================================== */

    @media (max-width: 1199px) {

        .realstate-user-menu {

            margin-left: 0;

            width: 100% !important;

            max-width: 100%;
        }

        .realstate-user-btn {

            display: flex !important;

            width: calc(100% - 30px) !important;

            max-width: calc(100% - 30px) !important;

            min-width: 0 !important;

            margin: 8px 15px;

            padding: 12px 16px !important;

            border-radius: 8px;

            justify-content: flex-start;

            box-sizing: border-box;
        }

        .realstate-user-name {

            display: block;

            min-width: 0;

            max-width: 100% !important;

            overflow: hidden !important;

            text-overflow: ellipsis !important;

            white-space: nowrap;
        }

    }


    /* =====================================================
       MOBILE NAVBAR
    ====================================================== */

    @media (max-width: 1199px) {

        .site-navbar {
            position: relative;
        }

    }


    /* =====================================================
       EXTRA LARGE NAME SUPPORT
       DESKTOP
    ====================================================== */

    @media (min-width: 1200px) {

        .realstate-user-btn {

            flex-shrink: 0;
        }

        .realstate-user-name {

            width: auto !important;

            max-width: none !important;
        }

    }

</style>


@stack('styles')


</head>


<body>


{{-- =====================================================
     MOBILE MENU
====================================================== --}}

<div class="site-mobile-menu site-navbar-target">

    <div class="site-mobile-menu-header">

        <div class="site-mobile-menu-close mt-3">

            <span class="icon-close2 js-menu-toggle"></span>

        </div>

    </div>

    <div class="site-mobile-menu-body"></div>

</div>


{{-- =====================================================
     HEADER
====================================================== --}}

<div class="sticky-wrapper">

<header
    class="site-navbar js-sticky-header site-navbar-target"
    role="banner"
>

    <div class="container">

        <div class="row align-items-center">


            {{-- =================================================
                 LOGO
            ================================================== --}}

            <div class="col-6 col-xl-2">

                <h1 class="mb-0 site-logo">

                    <a href="{{ route('home') }}">

                        <img
                            src="{{ asset('assets/img/logo.png') }}"
                            alt="RealState"
                        >

                    </a>

                </h1>

            </div>


            {{-- =================================================
                 DESKTOP NAVIGATION
            ================================================== --}}

            <div class="col-12 col-md-10 d-none d-xl-block">

                <nav
                    class="site-navigation position-relative text-right"
                    role="navigation"
                >

                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">


                        {{-- =================================================
                             HOME
                        ================================================== --}}

                        <li>

                            <a
                                href="{{ route('home') }}"
                                class="nav-link"
                            >
                                Home
                            </a>

                        </li>


                        {{-- =================================================
                             ABOUT
                        ================================================== --}}

                        <li>

                            <a
                                href="{{ route('about') }}"
                                class="nav-link"
                            >
                                About
                            </a>

                        </li>


                        {{-- =================================================
                             PROPERTY
                        ================================================== --}}

                        <li>

                            <a
                                href="{{ route('property') }}"
                                class="nav-link"
                            >
                                Property
                            </a>

                        </li>


                        {{-- =================================================
                             GALLERY
                        ================================================== --}}

                        <li>

                            <a
                                href="{{ route('gallery') }}"
                                class="nav-link"
                            >
                                Gallery
                            </a>

                        </li>


                        {{-- =================================================
                             PAGES
                        ================================================== --}}

                        <li class="has-children">

                            <a
                                href="#"
                                class="nav-link"
                            >
                                Pages
                            </a>

                            <ul class="dropdown">

                                <li>

                                    <a
                                        href="{{ url('/agent-profile/1') }}"
                                        class="nav-link"
                                    >
                                        Agent Profile
                                    </a>

                                </li>

                                <li>

                                    <a
                                        href="{{ route('login') }}"
                                        class="nav-link"
                                    >
                                        Login
                                    </a>

                                </li>

                                <li>

                                    <a
                                        href="{{ route('register') }}"
                                        class="nav-link"
                                    >
                                        Register
                                    </a>

                                </li>

                                <li>

                                    <a
                                        href="{{ route('faq') }}"
                                        class="nav-link"
                                    >
                                        FAQs
                                    </a>

                                </li>

                            </ul>

                        </li>


                        {{-- =================================================
                             BLOG
                        ================================================== --}}

                        <li>

                            <a
                                href="{{ route('blog') }}"
                                class="nav-link"
                            >
                                Blog
                            </a>

                        </li>


                        {{-- =================================================
                             CONTACT
                        ================================================== --}}

                        <li>

                            <a
                                href="{{ route('contact') }}"
                                class="nav-link"
                            >
                                Contact
                            </a>

                        </li>


                        {{-- =================================================
                             DYNAMIC USER / OWNER / AGENT BUTTON
                        ================================================== --}}

                        <li class="realstate-user-menu">


                            {{-- =================================================
                                 AGENT LOGIN
                            ================================================== --}}

                            @auth('agent')

                                @php
                                    $loggedInAgent = auth('agent')->user();
                                @endphp

                                <a
                                    href="{{ route('agent.dashboard') }}"
                                    class="realstate-user-btn"
                                >

                                    <i class="fa-solid fa-user"></i>

                                    <span class="realstate-user-name">
                                        {{ $loggedInAgent->name }}
                                    </span>

                                </a>


                            {{-- =================================================
                                 OWNER / USER LOGIN
                            ================================================== --}}

                            @elseif(auth('web')->check())

                                @php
                                    $loggedInUser = auth('web')->user();
                                @endphp


                                {{-- =========================================
                                     OWNER
                                ========================================== --}}

                                @if($loggedInUser->role === 'owner')

                                    <a
                                        href="{{ route('owner.dashboard') }}"
                                        class="realstate-user-btn"
                                    >

                                        <i class="fa-solid fa-user"></i>

                                        <span class="realstate-user-name">
                                            {{ $loggedInUser->name }}
                                        </span>

                                    </a>


                                {{-- =========================================
                                     NORMAL USER
                                ========================================== --}}

                                @else

                                    <a
                                        href="{{ route('user.dashboard') }}"
                                        class="realstate-user-btn"
                                    >

                                        <i class="fa-solid fa-user"></i>

                                        <span class="realstate-user-name">
                                            {{ $loggedInUser->name }}
                                        </span>

                                    </a>

                                @endif


                            {{-- =================================================
                                 NOT LOGGED IN
                            ================================================== --}}

                            @else

                                <a
                                    href="{{ route('login') }}"
                                    class="realstate-user-btn"
                                >

                                    <i class="fa-solid fa-user"></i>

                                    <span>
                                        Login
                                    </span>

                                </a>

                            @endauth


                        </li>


                    </ul>

                </nav>

            </div>


            {{-- =================================================
                 MOBILE MENU BUTTON
            ================================================== --}}

            <div
                class="col-6 d-inline-block d-xl-none ml-md-0 py-3"
                style="position: relative; top: 3px;"
            >

                <a
                    href="#"
                    class="site-menu-toggle js-menu-toggle float-right"
                >

                    <span class="icon-menu h3"></span>

                </a>

            </div>


        </div>

    </div>

</header>

</div>


{{-- =====================================================
     PAGE CONTENT
====================================================== --}}

<main>

    @yield('content')

</main>


{{-- =====================================================
     FOOTER
====================================================== --}}

<footer class="footer-area">

<div class="container">


    {{-- =================================================
         SOCIAL
    ================================================== --}}

    <div class="row">

        <div class="col-lg-12 text-center">

            <div class="footer_social">

                <ul>

                    <li>

                        <a
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Facebook"
                            href="#"
                        >

                            <i class="fa-brands fa-facebook-f"></i>

                        </a>

                    </li>

                    <li>

                        <a
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Instagram"
                            href="#"
                        >

                            <i class="fa-brands fa-instagram"></i>

                        </a>

                    </li>

                    <li>

                        <a
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Google"
                            href="#"
                        >

                            <i class="fa-brands fa-google"></i>

                        </a>

                    </li>

                    <li>

                        <a
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Linkedin"
                            href="#"
                        >

                            <i class="fa-brands fa-linkedin-in"></i>

                        </a>

                    </li>

                    <li>

                        <a
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Youtube"
                            href="#"
                        >

                            <i class="fa-brands fa-youtube"></i>

                        </a>

                    </li>

                    <li>

                        <a
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Skype"
                            href="#"
                        >

                            <i class="fa-brands fa-skype"></i>

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </div>


    {{-- =================================================
         FOOTER COLUMNS
    ================================================== --}}

    <div class="row footer-padding">


        {{-- =================================================
             CONTACT
        ================================================== --}}

        <div class="col-lg-3 col-sm-3 col-xs-12">

            <div class="single_footer">

                <h4>
                    Contact Us
                </h4>

                <div class="footer_contact">

                    <ul>

                        <li>

                            <i class="fa-solid fa-rocket"></i>

                            <span>
                                3481 Melrose Place,
                                Beverly Hills, CA 90210
                            </span>

                        </li>

                        <li>

                            <i class="fa-solid fa-phone"></i>

                            <span>
                                Call Us - (+1) 517 397 7100
                            </span>

                        </li>

                        <li>

                            <i class="fa-solid fa-fax"></i>

                            <span>
                                Fax - (+12) 123 1234
                            </span>

                        </li>

                        <li>

                            <i class="fa-solid fa-envelope"></i>

                            <span>
                                info@example.com
                            </span>

                        </li>

                    </ul>

                </div>

            </div>

        </div>


        {{-- =================================================
             CUSTOMER SERVICE
        ================================================== --}}

        <div class="col-lg-3 col-sm-3 col-xs-12">

            <div class="single_footer">

                <h4>
                    Customer Service
                </h4>

                <div class="footer_contact">

                    <ul>

                        <li>

                            <a href="#">
                                My Account
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                Order History
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                FAQ
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                Specials
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                Help Center
                            </a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>


        {{-- =================================================
             HELPFUL LINKS
        ================================================== --}}

        <div class="col-lg-3 col-sm-3 col-xs-12">

            <div class="single_footer">

                <h4>
                    Helpful Link
                </h4>

                <div class="footer_contact">

                    <ul>

                        <li>

                            <a href="{{ route('about') }}">
                                About Us
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                Customer Service
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                Company
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                Investor Relations
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                Advanced Search
                            </a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>


        {{-- =================================================
             WHY CHOOSE US
        ================================================== --}}

        <div class="col-lg-3 col-sm-3 col-xs-12">

            <div class="single_footer">

                <h4>
                    Why Choose Us
                </h4>

                <div class="footer_contact">

                    <ul>

                        <li>

                            <a href="#">
                                Shopping Guide
                            </a>

                        </li>

                        <li>

                            <a href="{{ route('blog') }}">
                                Blog
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                Company
                            </a>

                        </li>

                        <li>

                            <a href="#">
                                Investor Relations
                            </a>

                        </li>

                        <li>

                            <a href="{{ route('contact') }}">
                                Contact Us
                            </a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>


    </div>


    {{-- =================================================
         COPYRIGHT
    ================================================== --}}

    <div class="row text-center">

        <div class="col-lg-12 col-sm-12 col-xs-12 wow zoomIn">

            <p class="footer_copyright">

                RealState &copy; {{ date('Y') }}

                All Rights Reserved.

                Distributed by

                <a
                    href="#"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Eagle Properties
                </a>

            </p>

        </div>

    </div>


</div>

</footer>


{{-- =====================================================
     JAVASCRIPT
====================================================== --}}

<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>

<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/modernizr-2.8.3.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>

<script src="{{ asset('assets/js/menu.js') }}"></script>

<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>

<script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>

<script src="{{ asset('assets/js/slick.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.mixitup.js') }}"></script>

<script src="{{ asset('assets/js/jquery.prettyPhoto.js') }}"></script>

<script src="{{ asset('assets/js/scrolltopcontrol.js') }}"></script>

<script src="{{ asset('assets/js/wow.min.js') }}"></script>

<script src="{{ asset('assets/js/scripts.js') }}"></script>

@stack('scripts')


</body>

</html>

