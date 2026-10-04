@extends('layouts.app')

@section('title', 'Login - Eagle Properties')

@section('content')

{{-- =========================================================
     LOGIN PAGE STYLES
========================================================= --}}

<style>
    .rs-login-page {
        position: relative;
        min-height: 620px;
        padding: 80px 0 100px;
        background:
            linear-gradient(
                135deg,
                #f7f8fc 0%,
                #ffffff 50%,
                #f4f1ff 100%
            );
        overflow: hidden;
    }

    .rs-login-page::before {
        content: "";
        position: absolute;
        width: 380px;
        height: 380px;
        border-radius: 50%;
        background: rgba(124, 58, 237, 0.08);
        filter: blur(5px);
        top: -170px;
        left: -140px;
    }

    .rs-login-page::after {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.06);
        filter: blur(10px);
        right: -180px;
        bottom: -190px;
    }

    .rs-login-container {
        position: relative;
        z-index: 2;
        max-width: 1180px;
        margin: 0 auto;
    }

    .rs-login-wrapper {
        max-width: 500px;
        margin: 0 auto;
    }

    .rs-login-card {
        position: relative;
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid rgba(124, 58, 237, 0.12);
        border-radius: 24px;
        padding: 42px 42px 38px;
        box-shadow:
            0 20px 60px rgba(15, 23, 42, 0.08),
            0 5px 20px rgba(124, 58, 237, 0.05);
        backdrop-filter: blur(12px);
    }

    .rs-login-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .rs-login-icon {
        width: 68px;
        height: 68px;
        margin: 0 auto 18px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(
            135deg,
            #7c3aed,
            #a855f7
        );
        color: #ffffff;
        font-size: 28px;
        box-shadow:
            0 12px 30px rgba(124, 58, 237, 0.25);
    }

    .rs-login-header h2 {
        margin: 0 0 9px;
        color: #1e293b;
        font-size: 28px;
        font-weight: 700;
        line-height: 1.3;
    }

    .rs-login-header p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .rs-login-alert {
        border-radius: 12px;
        padding: 13px 15px;
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 1.5;
    }

    .rs-login-alert-success {
        color: #166534;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }

    .rs-login-alert-danger {
        color: #991b1b;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    .rs-login-alert-danger div + div {
        margin-top: 5px;
    }

    .rs-login-form-group {
        margin-bottom: 20px;
    }

    .rs-login-label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
    }

    .rs-login-input-wrap {
        position: relative;
    }

    .rs-login-input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 15px;
        z-index: 2;
        pointer-events: none;
    }

    .rs-login-input {
        width: 100%;
        height: 52px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #f8fafc;
        color: #1e293b;
        padding: 0 15px 0 44px;
        font-size: 14px;
        outline: none;
        transition: all 0.25s ease;
        box-shadow: none !important;
    }

    /*
    |--------------------------------------------------------------------------
    | PASSWORD INPUT
    |--------------------------------------------------------------------------
    */

    .rs-login-password-input {
        padding-right: 48px;
    }

    .rs-login-input::placeholder {
        color: #94a3b8;
    }

    .rs-login-input:hover {
        border-color: #cbd5e1;
        background: #ffffff;
    }

    .rs-login-input:focus {
        border-color: #8b5cf6;
        background: #ffffff;
        box-shadow:
            0 0 0 4px rgba(124, 58, 237, 0.09) !important;
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW / HIDE PASSWORD
    |--------------------------------------------------------------------------
    */

    .rs-password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        padding: 0;
        background: transparent;
        color: #94a3b8;
        cursor: pointer;
        z-index: 3;
        transition: color 0.2s ease;
    }

    .rs-password-toggle:hover {
        color: #7c3aed;
    }

    .rs-password-toggle:focus {
        outline: none;
        color: #7c3aed;
    }

    .rs-password-toggle i {
        font-size: 15px;
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN OPTIONS
    |--------------------------------------------------------------------------
    */

    .rs-login-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 2px 0 24px;
    }

    .rs-remember {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        color: #64748b;
        font-size: 13px;
        cursor: pointer;
        font-weight: 400;
    }

    .rs-remember input {
        width: 16px;
        height: 16px;
        margin: 0;
        accent-color: #7c3aed;
        cursor: pointer;
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN BUTTON
    |--------------------------------------------------------------------------
    */

    .rs-login-button {
        width: 100%;
        height: 52px;
        border: 0;
        border-radius: 12px;
        background: linear-gradient(
            135deg,
            #7c3aed,
            #9333ea
        );
        color: #ffffff;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.2px;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow:
            0 10px 25px rgba(124, 58, 237, 0.22);
    }

    .rs-login-button:hover {
        transform: translateY(-2px);
        box-shadow:
            0 14px 30px rgba(124, 58, 237, 0.28);
    }

    .rs-login-button:active {
        transform: translateY(0);
    }


    /*
    |--------------------------------------------------------------------------
    | DIVIDER
    |--------------------------------------------------------------------------
    */

    .rs-login-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 27px 0 22px;
        color: #94a3b8;
        font-size: 12px;
    }

    .rs-login-divider::before,
    .rs-login-divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER BOX
    |--------------------------------------------------------------------------
    */

    .rs-register-box {
        text-align: center;
        padding: 17px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
    }

    .rs-register-box p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
    }

    .rs-register-box a {
        color: #7c3aed;
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .rs-register-box a:hover {
        color: #5b21b6;
    }


    /*
    |--------------------------------------------------------------------------
    | LOGGED USER
    |--------------------------------------------------------------------------
    */

    .rs-logged-user {
        text-align: center;
    }

    .rs-user-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(
            135deg,
            #7c3aed,
            #a855f7
        );
        color: #ffffff;
        font-size: 30px;
        box-shadow:
            0 12px 30px rgba(124, 58, 237, 0.25);
    }

    .rs-logged-user h2 {
        margin: 0 0 8px;
        color: #1e293b;
        font-size: 26px;
        font-weight: 700;
    }

    .rs-logged-user p {
        margin: 0 0 25px;
        color: #64748b;
        font-size: 14px;
    }

    .rs-logged-user .rs-secondary-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 48px;
        margin-bottom: 12px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.25s ease;
    }

    .rs-logged-user .rs-secondary-button:hover {
        background: #ffffff;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 767px) {

        .rs-login-page {
            padding: 55px 15px 70px;
        }

        .rs-login-card {
            padding: 32px 24px 30px;
            border-radius: 20px;
        }

        .rs-login-header h2 {
            font-size: 25px;
        }

    }


    @media (max-width: 480px) {

        .rs-login-page {
            padding: 40px 12px 55px;
        }

        .rs-login-card {
            padding: 28px 18px 25px;
            border-radius: 18px;
        }

        .rs-login-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .rs-login-header {
            margin-bottom: 25px;
        }

        .rs-login-header h2 {
            font-size: 23px;
        }

        .rs-login-options {
            align-items: flex-start;
        }

    }
</style>


{{-- =========================================================
     START SECTION TOP
========================================================= --}}

<section class="section-top">

    <div class="container">

        <div class="col-lg-10 offset-lg-1 col-xs-12 text-center">

            <div class="section-top-title wow fadeInRight"
                 data-wow-duration="1s"
                 data-wow-delay="0.3s"
                 data-wow-offset="0">

                <h1>Login Page</h1>

            </div>

        </div>

    </div>

</section>

{{-- END SECTION TOP --}}


{{-- =========================================================
     START LOGIN
========================================================= --}}

<section class="rs-login-page">

    <div class="container">

        <div class="rs-login-container">

            <div class="rs-login-wrapper">

                <div class="rs-login-card">


                    {{-- =================================================
                         AGENT LOGGED IN
                    ================================================== --}}

                    @if(auth('agent')->check())

                        <div class="rs-logged-user">

                            <div class="rs-user-icon">
                                <i class="fa fa-user"></i>
                            </div>

                            <h2>
                                Welcome, {{ auth('agent')->user()->name }}
                            </h2>

                            <p>
                                You are logged in as an Agent.
                            </p>

                            <a
                                href="{{ route('agent.dashboard') }}"
                                class="rs-secondary-button"
                            >
                                <i class="fa fa-dashboard"></i>
                                &nbsp; Go to Agent Dashboard
                            </a>

                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    class="rs-login-button"
                                    type="submit"
                                >
                                    <i class="fa fa-sign-out"></i>
                                    &nbsp; Logout
                                </button>

                            </form>

                        </div>


                    {{-- =================================================
                         OWNER LOGGED IN
                    ================================================== --}}

                    @elseif(auth('web')->check() && auth('web')->user()->role === 'owner')

                        <div class="rs-logged-user">

                            <div class="rs-user-icon">
                                <i class="fa fa-home"></i>
                            </div>

                            <h2>
                                Welcome, {{ auth('web')->user()->name }}
                            </h2>

                            <p>
                                You are logged in as a Property Owner.
                            </p>

                            <a
                                href="{{ route('owner.dashboard') }}"
                                class="rs-secondary-button"
                            >
                                <i class="fa fa-dashboard"></i>
                                &nbsp; Go to Owner Dashboard
                            </a>

                            <form
                                action="{{ route('user.logout') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    class="rs-login-button"
                                    type="submit"
                                >
                                    <i class="fa fa-sign-out"></i>
                                    &nbsp; Logout
                                </button>

                            </form>

                        </div>


                    {{-- =================================================
                         NORMAL USER LOGGED IN
                    ================================================== --}}

                    @elseif(auth('web')->check())

                        <div class="rs-logged-user">

                            <div class="rs-user-icon">
                                <i class="fa fa-user"></i>
                            </div>

                            <h2>
                                Welcome, {{ auth('web')->user()->name }}
                            </h2>

                            <p>
                                You are successfully logged in.
                            </p>

                            <a
                                href="{{ route('home') }}"
                                class="rs-secondary-button"
                            >
                                <i class="fa fa-home"></i>
                                &nbsp; Go to Website
                            </a>

                            <form
                                action="{{ route('user.logout') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    class="rs-login-button"
                                    type="submit"
                                >
                                    <i class="fa fa-sign-out"></i>
                                    &nbsp; Logout
                                </button>

                            </form>

                        </div>


                    {{-- =================================================
                         LOGIN FORM
                    ================================================== --}}

                    @else


                        {{-- =================================================
                             LOGIN HEADER
                        ================================================== --}}

                        <div class="rs-login-header">

                            <div class="rs-login-icon">
                                <i class="fa fa-lock"></i>
                            </div>

                            <h2>
                                Welcome Back
                            </h2>

                            <p>
                                Sign in to your account to continue
                            </p>

                        </div>


                        {{-- =================================================
                             SUCCESS MESSAGE
                        ================================================== --}}

                        @if(session('success'))

                            <div class="rs-login-alert rs-login-alert-success">

                                <i class="fa fa-check-circle"></i>
                                &nbsp;
                                {{ session('success') }}

                            </div>

                        @endif


                        {{-- =================================================
                             ERROR MESSAGE
                        ================================================== --}}

                        @if($errors->any())

                            <div class="rs-login-alert rs-login-alert-danger">

                                @foreach($errors->all() as $error)

                                    <div>
                                        <i class="fa fa-exclamation-circle"></i>
                                        &nbsp;
                                        {{ $error }}
                                    </div>

                                @endforeach

                            </div>

                        @endif


                        {{-- =================================================
                             LOGIN FORM
                        ================================================== --}}

                        <form
                            action="{{ route('login.store') }}"
                            method="POST"
                        >

                            @csrf


                            {{-- =================================================
                                 EMAIL
                            ================================================== --}}

                            <div class="rs-login-form-group">

                                <label
                                    for="email"
                                    class="rs-login-label"
                                >
                                    Email Address
                                </label>

                                <div class="rs-login-input-wrap">

                                    <i class="fa fa-envelope rs-login-input-icon"></i>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="rs-login-input"
                                        placeholder="Enter your email"
                                        value="{{ old('email') }}"
                                        autocomplete="email"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- =================================================
                                 PASSWORD
                            ================================================== --}}

                            <div class="rs-login-form-group">

                                <label
                                    for="password"
                                    class="rs-login-label"
                                >
                                    Password
                                </label>

                                <div class="rs-login-input-wrap">

                                    <i class="fa fa-lock rs-login-input-icon"></i>

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="rs-login-input rs-login-password-input"
                                        placeholder="Enter your password"
                                        autocomplete="current-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="rs-password-toggle"
                                        onclick="toggleLoginPassword('password', 'login-password-eye')"
                                        aria-label="Show password"
                                    >
                                        <i
                                            class="fa fa-eye"
                                            id="login-password-eye"
                                        ></i>
                                    </button>

                                </div>

                            </div>


                            {{-- =================================================
                                 REMEMBER ME
                            ================================================== --}}

                            <div class="rs-login-options">

                                <label class="rs-remember">

                                    <input
                                        type="checkbox"
                                        name="remember"
                                        value="1"
                                    >

                                    <span>
                                        Remember Me
                                    </span>

                                </label>

                            </div>


                            {{-- =================================================
                                 LOGIN BUTTON
                            ================================================== --}}

                            <button
                                class="rs-login-button"
                                type="submit"
                            >

                                <i class="fa fa-sign-in"></i>
                                &nbsp;
                                Login to Account

                            </button>

                        </form>


                        {{-- =================================================
                             DIVIDER
                        ================================================== --}}

                        <div class="rs-login-divider">
                            OR
                        </div>


                        {{-- =================================================
                             REGISTER
                        ================================================== --}}

                        <div class="rs-register-box">

                            <p>

                                Don't have an account?

                                <a href="{{ route('register') }}">
                                    Register Now
                                </a>

                            </p>

                        </div>


                    @endif

                </div>

            </div>

        </div>

    </div>

</section>

{{-- END LOGIN --}}


{{-- =========================================================
     SHOW / HIDE PASSWORD SCRIPT
========================================================= --}}

<script>
    function toggleLoginPassword(inputId, iconId) {

        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (!input || !icon) {
            return;
        }

        if (input.type === "password") {

            input.type = "text";

            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");

        } else {

            input.type = "password";

            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");

        }
    }
</script>

@endsection