@extends('layouts.app')

@section('title', 'Register - Eagle Properties')

@section('content')

{{-- =========================================================
     REGISTER PAGE STYLES
========================================================= --}}

<style>
    /* =========================================================
       REGISTER PAGE
    ========================================================= */

    .rs-register-page {
        position: relative;
        min-height: 700px;
        padding: 75px 0 100px;
        background:
            linear-gradient(
                135deg,
                #f7f8fc 0%,
                #ffffff 50%,
                #f4f1ff 100%
            );
        overflow: hidden;
    }

    .rs-register-page::before {
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

    .rs-register-page::after {
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


    .rs-register-container {
        position: relative;
        z-index: 2;
        max-width: 1180px;
        margin: 0 auto;
    }


    /* =========================================================
       REGISTER WRAPPER
    ========================================================= */

    .rs-register-wrapper {
        max-width: 540px;
        margin: 0 auto;
    }


    /* =========================================================
       REGISTER CARD
    ========================================================= */

    .rs-register-card {
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


    /* =========================================================
       HEADER
    ========================================================= */

    .rs-register-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .rs-register-icon {
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

    .rs-register-header h2 {
        margin: 0 0 9px;
        color: #1e293b;
        font-size: 28px;
        font-weight: 700;
        line-height: 1.3;
    }

    .rs-register-header p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }


    /* =========================================================
       ALERTS
    ========================================================= */

    .rs-register-alert {
        border-radius: 12px;
        padding: 13px 15px;
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 1.5;
    }

    .rs-register-alert-success {
        color: #166534;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }

    .rs-register-alert-danger {
        color: #991b1b;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    .rs-register-alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    .rs-register-alert-danger li + li {
        margin-top: 4px;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .rs-register-form-group {
        margin-bottom: 18px;
    }

    .rs-register-label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
    }

    .rs-register-input-wrap {
        position: relative;
    }

    .rs-register-input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 15px;
        z-index: 2;
        pointer-events: none;
    }

    .rs-register-input,
    .rs-register-select {
        width: 100%;
        height: 52px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #f8fafc;
        color: #1e293b;
        font-size: 14px;
        outline: none;
        transition: all 0.25s ease;
        box-shadow: none !important;
    }

    .rs-register-input {
        padding: 0 48px 0 44px;
    }

    .rs-register-select {
        padding: 0 42px 0 44px;
        cursor: pointer;
        appearance: auto;
    }

    .rs-register-input::placeholder {
        color: #94a3b8;
    }

    .rs-register-input:hover,
    .rs-register-select:hover {
        border-color: #cbd5e1;
        background: #ffffff;
    }

    .rs-register-input:focus,
    .rs-register-select:focus {
        border-color: #8b5cf6;
        background: #ffffff;
        box-shadow:
            0 0 0 4px rgba(124, 58, 237, 0.09) !important;
    }


    /* =========================================================
       SHOW PASSWORD BUTTON
    ========================================================= */

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


    /* =========================================================
       PASSWORD HINT
    ========================================================= */

    .rs-password-hint {
        margin-top: 7px;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.5;
    }


    /* =========================================================
       SUBMIT BUTTON
    ========================================================= */

    .rs-register-button {
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

    .rs-register-button:hover {
        transform: translateY(-2px);
        box-shadow:
            0 14px 30px rgba(124, 58, 237, 0.28);
    }

    .rs-register-button:active {
        transform: translateY(0);
    }


    /* =========================================================
       LOGIN LINK
    ========================================================= */

    .rs-register-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 27px 0 22px;
        color: #94a3b8;
        font-size: 12px;
    }

    .rs-register-divider::before,
    .rs-register-divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }

    .rs-login-box {
        text-align: center;
        padding: 17px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
    }

    .rs-login-box p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
    }

    .rs-login-box a {
        color: #7c3aed;
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .rs-login-box a:hover {
        color: #5b21b6;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767px) {

        .rs-register-page {
            padding: 55px 15px 70px;
        }

        .rs-register-card {
            padding: 32px 24px 30px;
            border-radius: 20px;
        }

        .rs-register-header h2 {
            font-size: 25px;
        }

    }


    @media (max-width: 480px) {

        .rs-register-page {
            padding: 40px 12px 55px;
        }

        .rs-register-card {
            padding: 28px 18px 25px;
            border-radius: 18px;
        }

        .rs-register-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .rs-register-header {
            margin-bottom: 25px;
        }

        .rs-register-header h2 {
            font-size: 23px;
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

                <h1>Register Page</h1>

            </div>

        </div>

    </div>

</section>

{{-- END SECTION TOP --}}


{{-- =========================================================
     START REGISTER
========================================================= --}}

<section class="rs-register-page">

    <div class="container">

        <div class="rs-register-container">

            <div class="rs-register-wrapper">

                <div class="rs-register-card">


                    {{-- =================================================
                         REGISTER HEADER
                    ================================================== --}}

                    <div class="rs-register-header">

                        <div class="rs-register-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>

                        <h2>
                            Create Your Account
                        </h2>

                        <p>
                            Join us and discover your perfect property
                        </p>

                    </div>


                    {{-- =================================================
                         SUCCESS MESSAGE
                    ================================================== --}}

                    @if(session('success'))

                        <div class="rs-register-alert rs-register-alert-success">

                            <i class="fa fa-check-circle"></i>
                            &nbsp;
                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- =================================================
                         ERROR MESSAGE
                    ================================================== --}}

                    @if($errors->any())

                        <div class="rs-register-alert rs-register-alert-danger">

                            <ul>

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- =================================================
                         REGISTER FORM
                    ================================================== --}}

                    <form
                        action="{{ route('register.store') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- =================================================
                             NAME
                        ================================================== --}}

                        <div class="rs-register-form-group">

                            <label
                                for="name"
                                class="rs-register-label"
                            >
                                Full Name
                            </label>

                            <div class="rs-register-input-wrap">

                                <i class="fa fa-user rs-register-input-icon"></i>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="rs-register-input"
                                    placeholder="Enter your full name"
                                    value="{{ old('name') }}"
                                    autocomplete="name"
                                    required
                                >

                            </div>

                        </div>


                        {{-- =================================================
                             EMAIL
                        ================================================== --}}

                        <div class="rs-register-form-group">

                            <label
                                for="email"
                                class="rs-register-label"
                            >
                                Email Address
                            </label>

                            <div class="rs-register-input-wrap">

                                <i class="fa fa-envelope rs-register-input-icon"></i>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="rs-register-input"
                                    placeholder="Enter your email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    required
                                >

                            </div>

                        </div>


                        {{-- =================================================
                             ACCOUNT TYPE
                        ================================================== --}}

                        <div class="rs-register-form-group">

                            <label
                                for="role"
                                class="rs-register-label"
                            >
                                Account Type
                            </label>

                            <div class="rs-register-input-wrap">

                                <i class="fa fa-users rs-register-input-icon"></i>

                                <select
                                    name="role"
                                    id="role"
                                    class="rs-register-select"
                                    required
                                >

                                    <option value="">
                                        Select Account Type
                                    </option>

                                    <option
                                        value="user"
                                        {{ old('role') == 'user' ? 'selected' : '' }}
                                    >
                                        User
                                    </option>

                                    <option
                                        value="owner"
                                        {{ old('role') == 'owner' ? 'selected' : '' }}
                                    >
                                        Owner
                                    </option>

                                    <option
                                        value="agent"
                                        {{ old('role') == 'agent' ? 'selected' : '' }}
                                    >
                                        Agent
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- =================================================
                             PASSWORD
                        ================================================== --}}

                        <div class="rs-register-form-group">

                            <label
                                for="password"
                                class="rs-register-label"
                            >
                                Password
                            </label>

                            <div class="rs-register-input-wrap">

                                <i class="fa fa-lock rs-register-input-icon"></i>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="rs-register-input"
                                    placeholder="Create a password"
                                    autocomplete="new-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="rs-password-toggle"
                                    onclick="togglePassword('password', 'password-eye')"
                                    aria-label="Show password"
                                >
                                    <i
                                        class="fa fa-eye"
                                        id="password-eye"
                                    ></i>
                                </button>

                            </div>

                            <div class="rs-password-hint">
                                Use a strong password to keep your account secure.
                            </div>

                        </div>


                        {{-- =================================================
                             CONFIRM PASSWORD
                        ================================================== --}}

                        <div class="rs-register-form-group">

                            <label
                                for="password_confirmation"
                                class="rs-register-label"
                            >
                                Confirm Password
                            </label>

                            <div class="rs-register-input-wrap">

                                <i class="fa fa-lock rs-register-input-icon"></i>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="rs-register-input"
                                    placeholder="Confirm your password"
                                    autocomplete="new-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="rs-password-toggle"
                                    onclick="togglePassword('password_confirmation', 'confirm-password-eye')"
                                    aria-label="Show confirm password"
                                >
                                    <i
                                        class="fa fa-eye"
                                        id="confirm-password-eye"
                                    ></i>
                                </button>

                            </div>

                        </div>


                        {{-- =================================================
                             SUBMIT
                        ================================================== --}}

                        <button
                            class="rs-register-button"
                            type="submit"
                        >

                            <i class="fa fa-user-plus"></i>
                            &nbsp;
                            Create Account

                        </button>

                    </form>


                    {{-- =================================================
                         DIVIDER
                    ================================================== --}}

                    <div class="rs-register-divider">
                        OR
                    </div>


                    {{-- =================================================
                         LOGIN LINK
                    ================================================== --}}

                    <div class="rs-login-box">

                        <p>

                            Already have an account?

                            <a href="{{ route('login') }}">
                                Login Now
                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- END REGISTER --}}


{{-- =========================================================
     SHOW / HIDE PASSWORD SCRIPT
========================================================= --}}

<script>
    function togglePassword(inputId, iconId) {

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