@extends('layouts.app')

@section('title', 'Contact Us - Eagle Properties')

@section('content')

{{-- =========================================================
     PROFESSIONAL CONTACT PAGE STYLES
========================================================= --}}

<style>

    /* =========================================================
       CONTACT PAGE
    ========================================================= */

    .rs-contact-page {
        position: relative;
        padding: 80px 0 90px;
        background:
            linear-gradient(
                135deg,
                #f8f9fc 0%,
                #ffffff 50%,
                #f5f1ff 100%
            );
        overflow: hidden;
    }


    .rs-contact-page::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        background: rgba(124, 58, 237, 0.07);
        filter: blur(10px);
        top: -220px;
        left: -170px;
    }


    .rs-contact-page::after {
        content: "";
        position: absolute;
        width: 430px;
        height: 430px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.06);
        filter: blur(10px);
        right: -200px;
        bottom: -220px;
    }


    .rs-contact-container {
        position: relative;
        z-index: 2;
        max-width: 1180px;
        margin: 0 auto;
    }


    /* =========================================================
       SECTION HEADER
    ========================================================= */

    .rs-contact-heading {
        text-align: center;
        margin-bottom: 45px;
    }


    .rs-contact-heading span {
        display: inline-block;
        margin-bottom: 10px;
        color: #7c3aed;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }


    .rs-contact-heading h2 {
        margin: 0 0 12px;
        color: #1e293b;
        font-size: 34px;
        font-weight: 700;
        line-height: 1.3;
    }


    .rs-contact-heading p {
        max-width: 620px;
        margin: 0 auto;
        color: #64748b;
        font-size: 14px;
        line-height: 1.8;
    }


    /* =========================================================
       MAIN GRID
    ========================================================= */

    .rs-contact-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.55fr) minmax(300px, 0.85fr);
        gap: 28px;
        align-items: stretch;
    }


    /* =========================================================
       CONTACT CARD
    ========================================================= */

    .rs-contact-form-card {
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid rgba(124, 58, 237, 0.10);
        border-radius: 24px;
        padding: 38px;
        box-shadow:
            0 20px 60px rgba(15, 23, 42, 0.07),
            0 5px 20px rgba(124, 58, 237, 0.04);
    }


    .rs-contact-form-header {
        margin-bottom: 28px;
    }


    .rs-contact-form-header h3 {
        margin: 0 0 7px;
        color: #1e293b;
        font-size: 22px;
        font-weight: 700;
    }


    .rs-contact-form-header p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
    }


    /* =========================================================
       ALERTS
    ========================================================= */

    .rs-contact-alert {
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 22px;
        font-size: 13px;
        line-height: 1.6;
    }


    .rs-contact-success {
        color: #166534;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }


    .rs-contact-error {
        color: #991b1b;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }


    .rs-contact-error ul {
        margin: 0;
        padding-left: 20px;
    }


    .rs-contact-error li + li {
        margin-top: 4px;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .rs-contact-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }


    .rs-contact-form-group {
        margin-bottom: 18px;
    }


    .rs-contact-form-group-full {
        grid-column: 1 / -1;
    }


    .rs-contact-label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
    }


    .rs-contact-input-wrap {
        position: relative;
    }


    .rs-contact-icon {
        position: absolute;
        left: 15px;
        top: 17px;
        color: #94a3b8;
        font-size: 14px;
        pointer-events: none;
        z-index: 2;
    }


    .rs-contact-input,
    .rs-contact-textarea {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #f8fafc;
        color: #1e293b;
        font-family: inherit;
        font-size: 14px;
        outline: none;
        transition: all 0.25s ease;
        box-shadow: none !important;
    }


    .rs-contact-input {
        height: 52px;
        padding: 0 15px 0 43px;
    }


    .rs-contact-textarea {
        min-height: 145px;
        padding: 15px 15px 15px 43px;
        resize: vertical;
        line-height: 1.6;
    }


    .rs-contact-input::placeholder,
    .rs-contact-textarea::placeholder {
        color: #94a3b8;
    }


    .rs-contact-input:hover,
    .rs-contact-textarea:hover {
        border-color: #cbd5e1;
        background: #ffffff;
    }


    .rs-contact-input:focus,
    .rs-contact-textarea:focus {
        border-color: #8b5cf6;
        background: #ffffff;
        box-shadow:
            0 0 0 4px rgba(124, 58, 237, 0.08) !important;
    }


    .rs-contact-error-text {
        display: block;
        margin-top: 6px;
        color: #dc2626;
        font-size: 11px;
    }


    /* =========================================================
       SUBMIT BUTTON
    ========================================================= */

    .rs-contact-submit {
        width: 100%;
        height: 52px;
        margin-top: 5px;
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


    .rs-contact-submit:hover {
        transform: translateY(-2px);
        box-shadow:
            0 14px 30px rgba(124, 58, 237, 0.28);
    }


    .rs-contact-submit:active {
        transform: translateY(0);
    }


    /* =========================================================
       INFORMATION CARD
    ========================================================= */

    .rs-contact-info-card {
        position: relative;
        height: 100%;
        overflow: hidden;
        border-radius: 24px;
        padding: 38px 30px;
        background:
            linear-gradient(
                145deg,
                #171226 0%,
                #251947 55%,
                #3b176d 100%
            );
        box-shadow:
            0 20px 60px rgba(15, 23, 42, 0.15);
    }


    .rs-contact-info-card::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(168, 85, 247, 0.15);
        filter: blur(5px);
        top: -90px;
        right: -80px;
    }


    .rs-contact-info-card::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.10);
        filter: blur(5px);
        bottom: -80px;
        left: -70px;
    }


    .rs-contact-info-content {
        position: relative;
        z-index: 2;
    }


    .rs-contact-info-header {
        margin-bottom: 32px;
    }


    .rs-contact-info-header span {
        display: inline-block;
        margin-bottom: 9px;
        color: #c4b5fd;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }


    .rs-contact-info-header h3 {
        margin: 0 0 9px;
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
    }


    .rs-contact-info-header p {
        margin: 0;
        color: rgba(255, 255, 255, 0.65);
        font-size: 13px;
        line-height: 1.7;
    }


    /* =========================================================
       INFORMATION ITEMS
    ========================================================= */

    .rs-contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 27px;
    }


    .rs-contact-info-icon {
        flex: 0 0 45px;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.10);
        border: 1px solid rgba(255, 255, 255, 0.10);
        color: #c4b5fd;
        font-size: 16px;
    }


    .rs-contact-info-item h4 {
        margin: 0 0 5px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
    }


    .rs-contact-info-item p {
        margin: 0;
        color: rgba(255, 255, 255, 0.65);
        font-size: 13px;
        line-height: 1.7;
    }


    .rs-contact-info-item a {
        color: rgba(255, 255, 255, 0.70);
        text-decoration: none;
        transition: color 0.2s ease;
    }


    .rs-contact-info-item a:hover {
        color: #ffffff;
    }


    /* =========================================================
       DIVIDER
    ========================================================= */

    .rs-contact-info-divider {
        height: 1px;
        margin: 25px 0;
        background: rgba(255, 255, 255, 0.10);
    }


    .rs-contact-note {
        color: rgba(255, 255, 255, 0.55);
        font-size: 11px;
        line-height: 1.7;
    }


    /* =========================================================
       MAP
    ========================================================= */

    .rs-contact-map {
        position: relative;
        height: 400px;
        overflow: hidden;
        background: #e2e8f0;
    }


    .rs-contact-map iframe {
        width: 100%;
        height: 100%;
        display: block;
        border: 0;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .rs-contact-page {
            padding: 65px 15px 75px;
        }


        .rs-contact-grid {
            grid-template-columns: 1fr;
        }


        .rs-contact-info-card {
            height: auto;
        }

    }


    @media (max-width: 767px) {

        .rs-contact-heading {
            margin-bottom: 32px;
        }


        .rs-contact-heading h2 {
            font-size: 28px;
        }


        .rs-contact-form-card {
            padding: 28px 22px;
            border-radius: 20px;
        }


        .rs-contact-info-card {
            padding: 30px 24px;
            border-radius: 20px;
        }


        .rs-contact-form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }


        .rs-contact-form-group-full {
            grid-column: auto;
        }

    }


    @media (max-width: 480px) {

        .rs-contact-page {
            padding: 45px 12px 55px;
        }


        .rs-contact-heading h2 {
            font-size: 25px;
        }


        .rs-contact-heading p {
            font-size: 13px;
        }


        .rs-contact-form-card {
            padding: 25px 17px;
        }


        .rs-contact-info-card {
            padding: 27px 20px;
        }


        .rs-contact-form-header h3 {
            font-size: 20px;
        }


        .rs-contact-map {
            height: 320px;
        }

    }

</style>


{{-- =========================================================
     START SECTION TOP
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

                <h1>Contact</h1>

            </div>

        </div>

    </div>

</section>

{{-- END SECTION TOP --}}


{{-- =========================================================
     START CONTACT
========================================================= --}}

<section class="rs-contact-page">

    <div class="container">

        <div class="rs-contact-container">


            {{-- =====================================================
                 CONTACT HEADING
            ====================================================== --}}

            <div class="rs-contact-heading">

                <span>Get In Touch</span>

                <h2>
                    We'd Love To Hear From You
                </h2>

                <p>
                    Have a question about a property or need help
                    finding your perfect home? Send us a message and
                    our team will get back to you shortly.
                </p>

            </div>


            {{-- =====================================================
                 MAIN CONTACT GRID
            ====================================================== --}}

            <div class="rs-contact-grid">


                {{-- =================================================
                     CONTACT FORM
                ================================================== --}}

                <div class="rs-contact-form-card">

                    <div class="rs-contact-form-header">

                        <h3>
                            Send Us A Message
                        </h3>

                        <p>
                            Fill in the details below and our team
                            will contact you as soon as possible.
                        </p>

                    </div>


                    {{-- SUCCESS MESSAGE --}}

                    @if(session('success'))

                        <div class="rs-contact-alert rs-contact-success">

                            <i class="fa fa-check-circle"></i>
                            &nbsp;

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- VALIDATION ERRORS --}}

                    @if($errors->any())

                        <div class="rs-contact-alert rs-contact-error">

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
                         FORM
                    ================================================== --}}

                    <form
                        id="contact-form"
                        method="POST"
                        action="{{ route('contact.store') }}"
                    >

                        @csrf


                        <div class="rs-contact-form-row">


                            {{-- NAME --}}

                            <div class="rs-contact-form-group">

                                <label
                                    for="contact-name"
                                    class="rs-contact-label"
                                >
                                    Full Name
                                </label>

                                <div class="rs-contact-input-wrap">

                                    <i class="fa fa-user rs-contact-icon"></i>

                                    <input
                                        type="text"
                                        id="contact-name"
                                        name="name"
                                        class="rs-contact-input"
                                        placeholder="Enter your full name"
                                        value="{{ old('name') }}"
                                        autocomplete="name"
                                        required
                                    >

                                </div>

                                @error('name')

                                    <small class="rs-contact-error-text">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- EMAIL --}}

                            <div class="rs-contact-form-group">

                                <label
                                    for="contact-email"
                                    class="rs-contact-label"
                                >
                                    Email Address
                                </label>

                                <div class="rs-contact-input-wrap">

                                    <i class="fa fa-envelope rs-contact-icon"></i>

                                    <input
                                        type="email"
                                        id="contact-email"
                                        name="email"
                                        class="rs-contact-input"
                                        placeholder="Enter your email"
                                        value="{{ old('email') }}"
                                        autocomplete="email"
                                        required
                                    >

                                </div>

                                @error('email')

                                    <small class="rs-contact-error-text">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- PHONE --}}

                            <div class="rs-contact-form-group">

                                <label
                                    for="contact-phone"
                                    class="rs-contact-label"
                                >
                                    Phone Number
                                </label>

                                <div class="rs-contact-input-wrap">

                                    <i class="fa fa-phone rs-contact-icon"></i>

                                    <input
                                        type="text"
                                        id="contact-phone"
                                        name="phone"
                                        class="rs-contact-input"
                                        placeholder="Enter your phone number"
                                        value="{{ old('phone') }}"
                                        autocomplete="tel"
                                    >

                                </div>

                                @error('phone')

                                    <small class="rs-contact-error-text">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- SUBJECT --}}

                            <div class="rs-contact-form-group">

                                <label
                                    for="contact-subject"
                                    class="rs-contact-label"
                                >
                                    Subject
                                </label>

                                <div class="rs-contact-input-wrap">

                                    <i class="fa fa-pencil rs-contact-icon"></i>

                                    <input
                                        type="text"
                                        id="contact-subject"
                                        name="subject"
                                        class="rs-contact-input"
                                        placeholder="What is this about?"
                                        value="{{ old('subject') }}"
                                    >

                                </div>

                                @error('subject')

                                    <small class="rs-contact-error-text">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- MESSAGE --}}

                            <div class="rs-contact-form-group rs-contact-form-group-full">

                                <label
                                    for="contact-message"
                                    class="rs-contact-label"
                                >
                                    Your Message
                                </label>

                                <div class="rs-contact-input-wrap">

                                    <i class="fa fa-comment rs-contact-icon"></i>

                                    <textarea
                                        id="contact-message"
                                        name="message"
                                        class="rs-contact-textarea"
                                        placeholder="Write your message here..."
                                        required
                                    >{{ old('message') }}</textarea>

                                </div>

                                @error('message')

                                    <small class="rs-contact-error-text">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- SUBMIT --}}

                            <div class="rs-contact-form-group rs-contact-form-group-full">

                                <button
                                    type="submit"
                                    id="submitButton"
                                    class="rs-contact-submit"
                                >

                                    <i class="fa fa-paper-plane"></i>
                                    &nbsp;
                                    Send Message

                                </button>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- =================================================
                     CONTACT INFORMATION
                ================================================== --}}

                <div class="rs-contact-info-card">

                    <div class="rs-contact-info-content">


                        <div class="rs-contact-info-header">

                            <span>Contact Information</span>

                            <h3>
                                Let's Talk
                            </h3>

                            <p>
                                Our team is here to help you with
                                properties, enquiries and any other
                                questions you may have.
                            </p>

                        </div>


                        {{-- LOCATION --}}

                        <div class="rs-contact-info-item">

                            <div class="rs-contact-info-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>

                            <div>

                                <h4>
                                    Our Location
                                </h4>

                                <p>
                                    2369 Robinson Lane Jackson,
                                    <br>
                                    OH 45640
                                </p>

                            </div>

                        </div>


                        {{-- PHONE --}}

                        <div class="rs-contact-info-item">

                            <div class="rs-contact-info-icon">
                                <i class="fa fa-phone"></i>
                            </div>

                            <div>

                                <h4>
                                    Call Us
                                </h4>

                                <p>

                                    <a href="tel:+12163287141">
                                        (+1) 216-328-7141
                                    </a>

                                </p>

                            </div>

                        </div>


                        {{-- EMAIL --}}

                        <div class="rs-contact-info-item">

                            <div class="rs-contact-info-icon">
                                <i class="fa fa-envelope"></i>
                            </div>

                            <div>

                                <h4>
                                    Email Us
                                </h4>

                                <p>

                                    <a href="mailto:admin@example.com">
                                        admin@example.com
                                    </a>

                                </p>

                            </div>

                        </div>


                        <div class="rs-contact-info-divider"></div>


                        <p class="rs-contact-note">

                            We usually respond to enquiries as quickly
                            as possible. Please make sure your contact
                            details are correct so we can reach you.

                        </p>

                    </div>

                </div>


            </div>

        </div>

    </div>

</section>

{{-- END CONTACT --}}


{{-- =========================================================
     START MAP
========================================================= --}}

<div class="rs-contact-map">

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.957183635167!2d-74.00402768559431!3d40.71895904512855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2598a1316e7a7%3A0x47bb20eb6074b3f0!2sNew%20Work%20City%20-%20(CLOSED)!5e0!3m2!1sbn!2sbd!4v1600305497356!5m2!1sbn!2sbd"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Our Location"
    ></iframe>

</div>

{{-- END MAP --}}

@endsection