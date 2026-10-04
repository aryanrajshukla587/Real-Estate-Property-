@extends('layouts.app')

@section('title', 'Edit Profile - Eagle Properties')

@section('content')

{{-- =========================================================
PAGE TOP
========================================================= --}}

<section class="section-top">


<div class="container">

    <div class="col-lg-10 offset-lg-1 col-xs-12 text-center">

        <div
            class="section-top-title wow fadeInRight"
            data-wow-duration="1s"
            data-wow-delay="0.3s"
            data-wow-offset="0"
        >

            <h1>
                Edit Profile
            </h1>

            <p>
                Update your account information.
            </p>

        </div>

    </div>

</div>


</section>

{{-- =========================================================
PROFILE SECTION
========================================================= --}}

<div class="user-profile-page">


<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-7 col-md-9 col-sm-12">


            {{-- =================================================
                 SUCCESS MESSAGE
            ================================================== --}}

            @if(session('success'))

                <div
                    class="profile-alert profile-alert-success"
                >

                    <span class="profile-alert-icon">
                        ✓
                    </span>

                    <p>
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- =================================================
                 VALIDATION ERRORS
            ================================================== --}}

            @if($errors->any())

                <div
                    class="profile-alert profile-alert-error"
                >

                    <span class="profile-alert-icon">
                        !
                    </span>

                    <div>

                        <p class="profile-error-title">
                            Please fix the following errors:
                        </p>

                        <ul class="profile-error-list">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif


            {{-- =================================================
                 PROFILE CARD
            ================================================== --}}

            <div class="profile-card">

                {{-- CARD HEADER --}}

                <div class="profile-card-header">

                    <div class="profile-icon">

                        <i class="fa fa-user"></i>

                    </div>

                    <div>

                        <h2>
                            Personal Information
                        </h2>

                        <p>
                            Keep your profile information up to date.
                        </p>

                    </div>

                </div>


                {{-- FORM --}}

                <form
                    action="{{ route('user.profile.update') }}"
                    method="POST"
                    class="profile-form"
                >

                    @csrf

                    @method('PUT')


                    {{-- =================================================
                         FULL NAME
                    ================================================== --}}

                    <div class="profile-form-group">

                        <label for="name">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Enter your full name"
                            required
                        >

                        @error('name')

                            <span class="profile-field-error">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- =================================================
                         EMAIL
                    ================================================== --}}

                    <div class="profile-form-group">

                        <label for="email">
                            Email Address
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            placeholder="Enter your email address"
                            required
                        >

                        @error('email')

                            <span class="profile-field-error">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- =================================================
                         ACCOUNT TYPE
                    ================================================== --}}

                    <div class="profile-account-type">

                        <div>

                            <span class="profile-small-label">
                                Account Type
                            </span>

                            <span class="profile-account-value">
                                User Account
                            </span>

                        </div>

                        <i class="fa fa-user-circle"></i>

                    </div>


                    {{-- =================================================
                         BUTTONS
                    ================================================== --}}

                    <div class="profile-form-actions">

                        <a
                            href="{{ route('user.dashboard') }}"
                            class="profile-cancel-btn"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="profile-save-btn"
                        >

                            <i class="fa fa-check"></i>

                            Save Changes

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


</div>

{{-- =========================================================
PROFILE PAGE CSS
========================================================= --}}

<style>

.user-profile-page {
    padding: 70px 0;
    background: #f8fafc;
    min-height: 500px;
}


/* =========================================================
   ALERTS
========================================================= */

.profile-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 18px;
    margin-bottom: 20px;
    border-radius: 12px;
    font-size: 14px;
}

.profile-alert p {
    margin: 0;
}

.profile-alert-success {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #047857;
}

.profile-alert-error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #b91c1c;
}

.profile-alert-icon {
    width: 24px;
    height: 24px;
    min-width: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-weight: 700;
}

.profile-alert-success .profile-alert-icon {
    background: #d1fae5;
    color: #047857;
}

.profile-alert-error .profile-alert-icon {
    background: #fee2e2;
    color: #b91c1c;
}

.profile-error-title {
    font-weight: 600;
    margin-bottom: 5px !important;
}

.profile-error-list {
    margin: 0;
    padding-left: 18px;
}


/* =========================================================
   PROFILE CARD
========================================================= */

.profile-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    padding: 35px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
}


/* =========================================================
   CARD HEADER
========================================================= */

.profile-card-header {
    display: flex;
    align-items: center;
    gap: 15px;
    padding-bottom: 25px;
    margin-bottom: 30px;
    border-bottom: 1px solid #f1f5f9;
}

.profile-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: #ede9fe;
    color: #7c3aed;
    font-size: 21px;
}

.profile-card-header h2 {
    margin: 0 0 5px;
    font-size: 21px;
    font-weight: 700;
    color: #111827;
}

.profile-card-header p {
    margin: 0;
    font-size: 13px;
    color: #6b7280;
}


/* =========================================================
   FORM
========================================================= */

.profile-form-group {
    margin-bottom: 24px;
}

.profile-form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
}

.profile-form-group input {
    width: 100%;
    height: 50px;
    padding: 0 15px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    background: #ffffff;
    color: #111827;
    font-size: 14px;
    outline: none;
    transition: all .25s ease;
    box-sizing: border-box;
}

.profile-form-group input::placeholder {
    color: #9ca3af;
}

.profile-form-group input:focus {
    border-color: #7c3aed;
    box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.10);
}

.profile-field-error {
    display: block;
    margin-top: 7px;
    color: #dc2626;
    font-size: 12px;
}


/* =========================================================
   ACCOUNT TYPE
========================================================= */

.profile-account-type {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 15px 16px;
    margin-top: 5px;
    margin-bottom: 30px;
    border: 1px solid #e5e7eb;
    border-radius: 11px;
    background: #f8fafc;
}

.profile-small-label {
    display: block;
    margin-bottom: 3px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: #9ca3af;
}

.profile-account-value {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
}

.profile-account-type > i {
    font-size: 24px;
    color: #7c3aed;
}


/* =========================================================
   ACTION BUTTONS
========================================================= */

.profile-form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 5px;
}

.profile-cancel-btn,
.profile-save-btn {
    min-height: 46px;
    padding: 0 22px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s ease;
    cursor: pointer;
}

.profile-cancel-btn {
    border: 1px solid #d1d5db;
    background: #ffffff;
    color: #4b5563;
}

.profile-cancel-btn:hover {
    background: #f3f4f6;
    color: #111827;
}

.profile-save-btn {
    border: 1px solid #7c3aed;
    background: #7c3aed;
    color: #ffffff;
}

.profile-save-btn:hover {
    background: #6d28d9;
    border-color: #6d28d9;
    color: #ffffff;
    transform: translateY(-1px);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 575px) {

    .user-profile-page {
        padding: 45px 0;
    }

    .profile-card {
        padding: 22px;
        border-radius: 14px;
    }

    .profile-card-header {
        align-items: flex-start;
    }

    .profile-card-header h2 {
        font-size: 18px;
    }

    .profile-form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .profile-cancel-btn,
    .profile-save-btn {
        width: 100%;
    }

}

</style>

@endsection
