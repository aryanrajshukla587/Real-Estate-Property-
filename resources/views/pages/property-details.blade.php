@extends('layouts.app')

@section('title', $property->title . ' - Eagle Properties')

@section('content')

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

                <h1>Property Details</h1>

            </div>
        </div>
    </div>
</section>
{{-- END SECTION TOP --}}


<style>

/* =========================================================
   REALSTATE PROPERTY DETAILS
   FULLY ISOLATED CSS
========================================================= */

.rsd-page {
    position: relative;
    z-index: 1;

    width: 100%;
    min-height: 100vh;

    background: #f5f7fb;
    color: #1f2937;

    padding: 115px 0 80px;
}

.rsd-page *,
.rsd-page *::before,
.rsd-page *::after {
    box-sizing: border-box;
}


/* =========================================================
   CONTAINER
========================================================= */

.rsd-container {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 1180px;

    margin: 0 auto;

    padding-left: 20px;
    padding-right: 20px;
}


/* =========================================================
   BACK BUTTON
========================================================= */

.rsd-back {
    position: relative;
    z-index: 5;

    display: inline-flex;

    align-items: center;
    gap: 9px;

    margin-bottom: 25px;

    padding: 10px 16px;

    background: #ffffff;

    border: 1px solid #e9e7f5;

    border-radius: 10px;

    color: #6d28d9 !important;

    text-decoration: none !important;

    font-size: 14px;
    font-weight: 700;

    box-shadow: 0 5px 18px rgba(15,23,42,.05);

    transition: all .25s ease;
}

.rsd-back:hover {
    color: #4c1d95 !important;

    background: #faf9ff;

    border-color: #ddd6fe;

    transform: translateX(-4px);

    box-shadow: 0 8px 25px rgba(109,40,217,.10);
}

.rsd-back-arrow {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: 25px;
    height: 25px;

    border-radius: 50%;

    background: #f3e8ff;

    color: #6d28d9;

    font-size: 15px;

    line-height: 1;
}


/* =========================================================
   MAIN PROPERTY CARD
========================================================= */

.rsd-property-card {
    position: relative;
    z-index: 2;

    width: 100%;

    background: #ffffff;

    border: 1px solid #edf0f5;

    border-radius: 24px;

    overflow: hidden;

    box-shadow:
        0 20px 60px rgba(15,23,42,.08);
}


/* =========================================================
   GALLERY
========================================================= */

.rsd-gallery {
    width: 100%;

    padding: 12px;

    background: #ffffff;
}


/* =========================================================
   MAIN IMAGE
========================================================= */

.rsd-gallery-main {
    position: relative;

    width: 100%;
    height: 510px;

    overflow: hidden;

    background: #f1f3f6;

    border-radius: 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    cursor: zoom-in;
}

.rsd-gallery-main img {
    width: 100%;
    height: 100%;

    display: block;

    object-fit: contain;

    opacity: 1;

    transform: scale(1);
    transform-origin: center center;

    transition:
        opacity .2s ease,
        transform .45s cubic-bezier(.2,.8,.2,1);

    will-change: transform;
}


/* =========================================================
   PURPOSE BADGE
========================================================= */

.rsd-purpose {
    position: absolute;

    top: 22px;
    left: 22px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 9px 17px;

    border-radius: 50px;

    background: #7c3aed;

    color: #ffffff;

    font-size: 12px;
    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .8px;

    box-shadow:
        0 8px 20px rgba(124,58,237,.30);
}


/* =========================================================
   PHOTO COUNT
========================================================= */

.rsd-photo-count {
    position: absolute;

    right: 22px;
    bottom: 22px;

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 9px 15px;

    border-radius: 50px;

    background: rgba(0,0,0,.72);

    color: #ffffff;

    font-size: 13px;
    font-weight: 600;

    backdrop-filter: blur(5px);
}


/* =========================================================
   EMPTY IMAGE
========================================================= */

.rsd-empty-image {
    width: 100%;
    height: 100%;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #f3f4f6,
            #e5e7eb
        );

    color: #9ca3af;

    font-size: 16px;

    font-weight: 600;
}


/* =========================================================
   THUMBNAILS
========================================================= */

.rsd-thumbnails {
    display: grid;

    grid-template-columns: repeat(5, 1fr);

    gap: 10px;

    margin-top: 10px;
}


/* =========================================================
   THUMB BUTTON
========================================================= */

.rsd-thumb {
    position: relative;

    width: 100%;
    height: 82px;

    overflow: hidden;

    display: flex;

    align-items: center;
    justify-content: center;

    padding: 0;
    margin: 0;

    background: #f1f3f6;

    border-radius: 12px;

    border: 2px solid transparent;

    cursor: pointer;

    transition: all .25s ease;

    outline: none;
}

.rsd-thumb:hover {
    border-color: #7c3aed;

    transform: translateY(-2px);
}

.rsd-thumb:focus {
    outline: none;
}

.rsd-thumb img {
    width: 100%;
    height: 100%;

    display: block;

    object-fit: contain;

    transition: transform .3s ease;
}

.rsd-thumb:hover img {
    transform: scale(1.04);
}


/* =========================================================
   ACTIVE THUMBNAIL
========================================================= */

.rsd-thumb.active {
    border-color: #7c3aed;

    box-shadow:
        0 0 0 2px rgba(124,58,237,.15);
}

.rsd-thumb.active img {
    transform: scale(1.02);
}


/* =========================================================
   PROPERTY INFORMATION
========================================================= */

.rsd-info {
    padding: 42px;
}


/* =========================================================
   TOP INFORMATION
========================================================= */

.rsd-info-top {
    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 25px;

    padding-bottom: 25px;

    border-bottom: 1px solid #edf0f5;
}


/* =========================================================
   TITLE
========================================================= */

.rsd-title {
    margin: 0 0 12px !important;

    color: #111827 !important;

    font-size: 38px !important;

    line-height: 1.15 !important;

    font-weight: 800 !important;

    letter-spacing: -.5px;
}


/* =========================================================
   LOCATION
========================================================= */

.rsd-location {
    margin: 0;

    display: flex;

    align-items: center;

    gap: 8px;

    color: #6b7280;

    font-size: 15px;

    line-height: 2.0;
}

.rsd-location i {
    color: #7c3aed;

    font-size: 16px;
}


/* =========================================================
   PRICE
========================================================= */

.rsd-price {
    flex-shrink: 0;

    color: #6d28d9;

    font-size: 32px;

    font-weight: 800;

    line-height: 1.2;

    white-space: nowrap;
}


/* =========================================================
   FEATURE GRID
========================================================= */

.rsd-features {
    display: grid;

    grid-template-columns: repeat(4, 1fr);

    gap: 12px;

    margin-top: 28px;
}

.rsd-feature {
    min-height: 90px;

    padding: 18px;

    background: #f8f7ff;

    border: 1px solid #eeeaff;

    border-radius: 15px;

    transition: all .25s ease;
}

.rsd-feature:hover {
    transform: translateY(-3px);

    background: #ffffff;

    box-shadow:
        0 10px 25px rgba(124,58,237,.08);

    border-color: #ddd6fe;
}

.rsd-feature-label {
    display: block;

    margin-bottom: 7px;

    color: #9ca3af;

    font-size: 11px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .7px;
}

.rsd-feature-value {
    display: block;

    color: #1f2937;

    font-size: 15px;

    font-weight: 700;

    line-height: 1.4;
}


/* =========================================================
   COMMON SECTION
========================================================= */

.rsd-section {
    margin-top: 35px;
}

.rsd-section-title {
    margin: 0 0 14px !important;

    color: #111827 !important;

    font-size: 21px !important;

    line-height: 1.3 !important;

    font-weight: 800 !important;
}


/* =========================================================
   ADDRESS
========================================================= */

.rsd-address {
    padding: 18px 20px;

    background: #fafafa;

    border-left: 4px solid #7c3aed;

    border-radius: 14px;

    color: #6b7280;

    font-size: 14px;

    line-height: 1.7;

    word-break: break-word;
}

.rsd-address i {
    color: #7c3aed;
}


/* =========================================================
   DESCRIPTION
========================================================= */

.rsd-description {
    margin: 0;

    color: #6b7280;

    font-size: 15px;

    line-height: 1.9;
}


/* =========================================================
   OWNER
========================================================= */

.rsd-owner {
    margin-top: 35px;

    display: flex;

    align-items: center;

    gap: 18px;

    padding: 20px;

    background: #f0fdf4;

    border: 1px solid #dcfce7;

    border-radius: 17px;
}

.rsd-owner-avatar {
    width: 55px;
    height: 55px;

    flex: 0 0 55px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background:
        linear-gradient(
            135deg,
            #16a34a,
            #22c55e
        );

    color: #ffffff;

    font-size: 21px;

    font-weight: 800;

    text-transform: uppercase;
}

.rsd-owner-content {
    min-width: 0;
}

.rsd-owner-label {
    margin: 0 0 4px;

    color: #15803d;

    font-size: 11px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .7px;
}

.rsd-owner-name {
    margin: 0 0 4px;

    color: #111827;

    font-size: 17px;

    font-weight: 800;
}

.rsd-owner-email {
    margin: 0;

    color: #6b7280;

    font-size: 13px;

    word-break: break-word;
}

.rsd-owner-phone {
    margin: 3px 0 0;

    color: #6b7280;

    font-size: 13px;
}


/* =========================================================
   AGENT
========================================================= */

.rsd-agent {
    margin-top: 35px;

    display: flex;

    align-items: center;

    gap: 18px;

    padding: 20px;

    background: #faf9ff;

    border: 1px solid #eeeaff;

    border-radius: 17px;
}

.rsd-agent-avatar {
    width: 55px;
    height: 55px;

    flex: 0 0 55px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background:
        linear-gradient(
            135deg,
            #6d28d9,
            #a855f7
        );

    color: #ffffff;

    font-size: 21px;

    font-weight: 800;

    text-transform: uppercase;
}

.rsd-agent-name {
    margin: 0 0 4px;

    color: #111827;

    font-size: 17px;

    font-weight: 800;
}

.rsd-agent-email {
    margin: 0;

    color: #6b7280;

    font-size: 13px;
}

.rsd-agent-phone {
    margin: 3px 0 0;

    color: #6b7280;

    font-size: 13px;
}


/* =========================================================
   CONTACT / BUY / RENT BOX
========================================================= */

.rsd-contact {
    margin-top: 35px;

    padding: 25px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    background:
        linear-gradient(
            135deg,
            #4c1d95,
            #7c3aed
        );

    border-radius: 18px;

    color: #ffffff;

    box-shadow:
        0 15px 35px rgba(109,40,217,.20);
}

.rsd-contact h3 {
    margin: 0 0 6px !important;

    color: #ffffff !important;

    font-size: 20px !important;

    line-height: 1.3 !important;

    font-weight: 800 !important;
}

.rsd-contact p {
    margin: 0;

    color: rgba(255,255,255,.80);

    font-size: 14px;

    line-height: 1.6;
}


/* =========================================================
   BUY / RENT BUTTON
========================================================= */

.rsd-contact-btn {
    flex-shrink: 0;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px 22px;

    background: #ffffff;

    border-radius: 10px;

    color: #5b21b6 !important;

    text-decoration: none !important;

    font-size: 13px;

    font-weight: 800;

    white-space: nowrap;

    border: none;

    transition: all .25s ease;
}

.rsd-contact-btn:hover {
    color: #4c1d95 !important;

    transform: translateY(-2px);

    box-shadow:
        0 8px 20px rgba(0,0,0,.15);
}

.rsd-contact-btn i {
    font-size: 14px;
}


/* =========================================================
   RELATED PROPERTIES
========================================================= */

.rsd-related {
    position: relative;

    margin-top: 55px;
}

.rsd-related-heading {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-bottom: 22px;
}

.rsd-related-heading h2 {
    margin: 0 !important;

    color: #111827 !important;

    font-size: 27px !important;

    line-height: 1.3 !important;

    font-weight: 800 !important;
}

.rsd-related-heading span {
    color: #9ca3af;

    font-size: 13px;
}


/* =========================================================
   RELATED CARD
========================================================= */

.rsd-related-card {
    display: block;

    height: 100%;

    overflow: hidden;

    background: #ffffff;

    border: 1px solid #edf0f5;

    border-radius: 17px;

    text-decoration: none !important;

    box-shadow:
        0 8px 25px rgba(15,23,42,.05);

    transition: all .3s ease;
}

.rsd-related-card:hover {
    transform: translateY(-6px);

    border-color: #e5e7eb;

    box-shadow:
        0 18px 40px rgba(15,23,42,.11);
}


/* =========================================================
   RELATED IMAGE
========================================================= */

.rsd-related-image {
    position: relative;

    height: 190px;

    overflow: hidden;

    background: #f1f3f6;

    display: flex;

    align-items: center;
    justify-content: center;
}

.rsd-related-image img {
    width: 100%;
    height: 100%;

    display: block;

    object-fit: contain;

    transition: transform .4s ease;
}

.rsd-related-card:hover .rsd-related-image img {
    transform: scale(1.03);
}


/* =========================================================
   RELATED BODY
========================================================= */

.rsd-related-body {
    padding: 17px;
}

.rsd-related-title {
    margin: 0 0 7px !important;

    overflow: hidden;

    color: #111827 !important;

    font-size: 16px !important;

    line-height: 1.4 !important;

    font-weight: 800 !important;

    display: -webkit-box;

    -webkit-line-clamp: 2;

    -webkit-box-orient: vertical;
}

.rsd-related-location {
    margin: 0 0 10px;

    color: #9ca3af;

    font-size: 12px;

    line-height: 1.5;
}

.rsd-related-location i {
    color: #7c3aed;
}

.rsd-related-price {
    margin: 0;

    color: #6d28d9;

    font-size: 18px;

    font-weight: 800;
}


/* =========================================================
   BOOTSTRAP ROW FIX
========================================================= */

.rsd-related .row {
    margin-left: -10px;
    margin-right: -10px;
}

.rsd-related .row > [class*="col-"] {
    padding-left: 10px;
    padding-right: 10px;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .rsd-page {
        padding: 100px 0 65px;
    }

    .rsd-gallery-main {
        height: 430px;
    }

    .rsd-info {
        padding: 30px;
    }

    .rsd-features {
        grid-template-columns: repeat(2, 1fr);
    }

    .rsd-title {
        font-size: 31px !important;
    }

    .rsd-price {
        font-size: 27px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px) {

    .rsd-page {
        padding: 90px 0 50px;
    }

    .rsd-container {
        padding-left: 12px;
        padding-right: 12px;
    }

    .rsd-back {
        margin-bottom: 18px;

        padding: 9px 13px;

        font-size: 13px;
    }

    .rsd-gallery {
        padding: 8px;
    }

    .rsd-gallery-main {
        height: 300px;

        border-radius: 14px;

        cursor: default;
    }

    .rsd-purpose {
        top: 15px;
        left: 15px;

        padding: 8px 13px;

        font-size: 11px;
    }

    .rsd-photo-count {
        right: 15px;
        bottom: 15px;

        padding: 8px 12px;

        font-size: 12px;
    }

    .rsd-thumbnails {
        grid-template-columns: repeat(4, 1fr);

        gap: 7px;
    }

    .rsd-thumb {
        height: 65px;

        border-radius: 9px;
    }

    .rsd-info {
        padding: 25px 20px;
    }

    .rsd-info-top {
        flex-direction: column;

        gap: 15px;

        padding-bottom: 20px;
    }

    .rsd-title {
        font-size: 27px !important;
    }

    .rsd-price {
        font-size: 25px;
    }

    .rsd-features {
        grid-template-columns: 1fr 1fr;

        gap: 9px;

        margin-top: 22px;
    }

    .rsd-feature {
        min-height: 82px;

        padding: 14px;
    }

    .rsd-feature-label {
        font-size: 10px;
    }

    .rsd-feature-value {
        font-size: 14px;
    }

    .rsd-section {
        margin-top: 28px;
    }

    .rsd-section-title {
        font-size: 19px !important;
    }

    .rsd-description {
        font-size: 14px;

        line-height: 2.0;
    }

    .rsd-owner {
        margin-top: 28px;

        padding: 17px;

        gap: 13px;
    }

    .rsd-agent {
        margin-top: 28px;

        padding: 17px;

        gap: 13px;
    }

    .rsd-contact {
        margin-top: 28px;

        flex-direction: column;

        align-items: flex-start;

        padding: 21px;
    }

    .rsd-contact-btn {
        width: 100%;
    }

    .rsd-related {
        margin-top: 40px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .rsd-page {
        padding: 82px 0 45px;
    }

    .rsd-gallery-main {
        height: 250px;
    }

    .rsd-features {
        grid-template-columns: 1fr 1fr;
    }

    .rsd-thumbnails {
        grid-template-columns: repeat(3, 1fr);
    }

    .rsd-related-heading {
        align-items: flex-start;

        flex-direction: column;

        gap: 5px;
    }

    .rsd-related-heading h2 {
        font-size: 24px !important;
    }

}


/* =========================================================
   VERY SMALL SCREEN
========================================================= */

@media (max-width: 360px) {

    .rsd-title {
        font-size: 24px !important;
    }

    .rsd-price {
        font-size: 22px;
    }

    .rsd-features {
        grid-template-columns: 1fr;
    }

    .rsd-gallery-main {
        height: 220px;
    }

}

</style>


{{-- =========================================================
     PAGE
========================================================= --}}

<div class="rsd-page">

    <div class="rsd-container">


        {{-- =====================================================
             BACK TO PREVIOUS PAGE
        ====================================================== --}}

        <a
            href="{{ url()->previous() }}"
            class="rsd-back"
        >

            <span class="rsd-back-arrow">
                ←
            </span>

            <span>
                Back
            </span>

        </a>


        {{-- =====================================================
             MAIN PROPERTY CARD
        ====================================================== --}}

        <div class="rsd-property-card">


            {{-- =================================================
                 GALLERY
            ================================================== --}}

            <div class="rsd-gallery">

                @php

                    $photos = is_array($property->photos)
                        ? $property->photos
                        : [];

                    $mainPhoto = $photos[0] ?? null;

                @endphp


                {{-- =================================================
                     MAIN IMAGE
                ================================================== --}}

                <div
                    class="rsd-gallery-main"
                    id="rsdGalleryMain"
                >

                    @if($mainPhoto)

                        <img
                            id="rsdMainImage"
                            src="{{ asset('storage/' . $mainPhoto) }}"
                            alt="{{ $property->title }}"
                        >

                    @else

                        <div class="rsd-empty-image">

                            No Property Image Available

                        </div>

                    @endif


                    {{-- PURPOSE --}}

                    <span class="rsd-purpose">

                        {{ ucfirst($property->purpose) }}

                    </span>


                    {{-- PHOTO COUNT --}}

                    @if(count($photos) > 0)

                        <span class="rsd-photo-count">

                            📷 {{ count($photos) }} Photos

                        </span>

                    @endif

                </div>


                {{-- =================================================
                     THUMBNAILS
                ================================================== --}}

                @if(count($photos) > 1)

                    <div class="rsd-thumbnails">

                        @foreach($photos as $index => $photo)

                            <button
                                type="button"
                                class="rsd-thumb {{ $index === 0 ? 'active' : '' }}"
                                onclick="changePropertyImage(
                                    '{{ asset('storage/' . $photo) }}',
                                    this
                                )"
                                aria-label="View property image {{ $index + 1 }}"
                            >

                                <img
                                    src="{{ asset('storage/' . $photo) }}"
                                    alt="{{ $property->title }} - Image {{ $index + 1 }}"
                                >

                            </button>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- =================================================
                 PROPERTY INFORMATION
            ================================================== --}}

            <div class="rsd-info">


                {{-- =================================================
                     TITLE + LOCATION + PRICE
                ================================================== --}}

                <div class="rsd-info-top">

                    <div>

                        <h1 class="rsd-title">

                            {{ $property->title }}

                        </h1>


                        <p class="rsd-location">

                            <i class="fa fa-map-marker"></i>

                            <span>

                                {{ $property->location?->city ?? 'Location' }}

                                @if($property->location?->state)

                                    , {{ $property->location->state }}

                                @endif

                                @if($property->location?->country)

                                    , {{ $property->location->country }}

                                @endif

                            </span>

                        </p>

                    </div>


                    <div class="rsd-price">

                        ₹{{ number_format($property->price) }}

                        @if($property->purpose === 'rent')

                            <small
                                style="
                                    font-size: 14px;
                                    color: #9ca3af;
                                    font-weight: 600;
                                "
                            >
                                / month
                            </small>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     FEATURES
                     Sirf wahi fields show hongi jinmein value hai.
                ================================================== --}}

                <div class="rsd-features">


                    {{-- PROPERTY TYPE --}}

                    @if($property->propertyType?->name)

                        <div class="rsd-feature">

                            <span class="rsd-feature-label">
                                Property Type
                            </span>

                            <span class="rsd-feature-value">

                                {{ $property->propertyType->name }}

                            </span>

                        </div>

                    @endif


                    {{-- AREA --}}

                    @if(!is_null($property->area) && $property->area !== '')

                        <div class="rsd-feature">

                            <span class="rsd-feature-label">
                                Area
                            </span>

                            <span class="rsd-feature-value">

                                {{ number_format($property->area, 2) }} Sqft

                            </span>

                        </div>

                    @endif


                    {{-- BEDROOMS --}}

                    @if(!is_null($property->bedrooms) && $property->bedrooms !== '')

                        <div class="rsd-feature">

                            <span class="rsd-feature-label">
                                Bedrooms
                            </span>

                            <span class="rsd-feature-value">

                                {{ $property->bedrooms }}

                            </span>

                        </div>

                    @endif


                    {{-- BATHROOMS --}}

                    @if(!is_null($property->bathrooms) && $property->bathrooms !== '')

                        <div class="rsd-feature">

                            <span class="rsd-feature-label">
                                Bathrooms
                            </span>

                            <span class="rsd-feature-value">

                                {{ $property->bathrooms }}

                            </span>

                        </div>

                    @endif


                    {{-- GARAGES --}}

                    @if(!is_null($property->garages) && $property->garages !== '')

                        <div class="rsd-feature">

                            <span class="rsd-feature-label">
                                Garages
                            </span>

                            <span class="rsd-feature-value">

                                {{ $property->garages }}

                            </span>

                        </div>

                    @endif


                    {{-- STATUS --}}

                    @if($property->status)

                        <div class="rsd-feature">

                            <span class="rsd-feature-label">
                                Status
                            </span>

                            <span class="rsd-feature-value">

                                {{ ucfirst($property->status) }}

                            </span>

                        </div>

                    @endif


                    {{-- PURPOSE --}}

                    @if($property->purpose)

                        <div class="rsd-feature">

                            <span class="rsd-feature-label">
                                Purpose
                            </span>

                            <span class="rsd-feature-value">

                                {{ ucfirst($property->purpose) }}

                            </span>

                        </div>

                    @endif


                    {{-- FEATURED --}}

                    <div class="rsd-feature">

                        <span class="rsd-feature-label">
                            Listing
                        </span>

                        <span class="rsd-feature-value">

                            {{ $property->is_featured
                                ? 'Featured Property'
                                : 'Regular Listing'
                            }}

                        </span>

                    </div>


                </div>


                {{-- =================================================
                     ADDRESS
                ================================================== --}}

                @if($property->address)

                    <div class="rsd-section">

                        <h2 class="rsd-section-title">

                            Property Address

                        </h2>


                        <div class="rsd-address">

                            <i class="fa fa-map-marker"></i>

                            &nbsp;

                            {{ $property->address }}

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     DESCRIPTION
                ================================================== --}}

                @if($property->description)

                    <div class="rsd-section">

                        <h2 class="rsd-section-title">

                            Property Description

                        </h2>


                        <p class="rsd-description">

                            {!! nl2br(e($property->description)) !!}

                        </p>

                    </div>

                @endif


                {{-- =================================================
                     OWNER
                     Owner available hone par hi section show hoga.
                ================================================== --}}

                @if($property->user_id && $property->owner)

                    <div class="rsd-owner">

                        {{-- OWNER AVATAR --}}

                        <div class="rsd-owner-avatar">

                            {{ strtoupper(
                                substr($property->owner->name, 0, 1)
                            ) }}

                        </div>


                        {{-- OWNER DETAILS --}}

                        <div class="rsd-owner-content">

                            <p class="rsd-owner-label">
                                Property Owner
                            </p>

                            <p class="rsd-owner-name">

                                {{ $property->owner->name }}

                            </p>


                            @if($property->owner->email)

                                <p class="rsd-owner-email">

                                    <i class="fa fa-envelope"></i>

                                    &nbsp;

                                    {{ $property->owner->email }}

                                </p>

                            @endif


                            @if($property->owner->phone)

                                <p class="rsd-owner-phone">

                                    <i class="fa fa-phone"></i>

                                    &nbsp;

                                    {{ $property->owner->phone }}

                                </p>

                            @endif

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     AGENT
                ================================================== --}}

                @if($property->agent)

                    <div class="rsd-agent">


                        <div class="rsd-agent-avatar">

                            {{ strtoupper(
                                substr($property->agent->name, 0, 1)
                            ) }}

                        </div>


                        <div>

                            <p class="rsd-agent-name">

                                {{ $property->agent->name }}

                            </p>


                            @if($property->agent->email)

                                <p class="rsd-agent-email">

                                    <i class="fa fa-envelope"></i>

                                    &nbsp;

                                    {{ $property->agent->email }}

                                </p>

                            @endif


                            @if($property->agent->phone)

                                <p class="rsd-agent-phone">

                                    <i class="fa fa-phone"></i>

                                    &nbsp;

                                    {{ $property->agent->phone }}

                                </p>

                            @endif

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     BUY / RENT CONTACT BOX
                ================================================== --}}

                <div class="rsd-contact">

                    <div>

                        <h3>
                            Interested in this Property?
                        </h3>


                        <p>

                            @if(
                                $property->purpose === 'sale'
                                &&
                                $property->status === 'available'
                            )

                                Buy this property by submitting a purchase request.

                            @elseif(
                                $property->purpose === 'rent'
                                &&
                                $property->status === 'available'
                            )

                                Rent this property by submitting a rental request.

                            @elseif($property->status === 'sold')

                                This property has already been sold.

                            @elseif($property->status === 'rented')

                                This property is currently rented.

                            @else

                                This property is currently unavailable.

                            @endif

                        </p>

                    </div>


                    {{-- =================================================
                         BUY NOW
                    ================================================== --}}

                    @if(
                        $property->purpose === 'sale'
                        &&
                        $property->status === 'available'
                    )

                        <a
                            href="{{ route('property.buy', $property) }}"
                            class="rsd-contact-btn"
                        >

                            <i class="fa fa-paper-plane"></i>

                            Enquire Now

                            <span>→</span>

                        </a>


                    {{-- =================================================
                         RENT NOW
                    ================================================== --}}

                    @elseif(
                        $property->purpose === 'rent'
                        &&
                        $property->status === 'available'
                    )

                        <a
                            href="{{ route('property.rent', $property) }}"
                            class="rsd-contact-btn"
                        >

                            <i class="fa fa-home"></i>

                            Rent Now

                            <span>→</span>

                        </a>


                    {{-- =================================================
                         UNAVAILABLE
                    ================================================== --}}

                    @else

                        <span
                            class="rsd-contact-btn"
                            style="
                                opacity: .6;
                                cursor: not-allowed;
                                pointer-events: none;
                            "
                        >

                            {{ ucfirst($property->status) }}

                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
             RELATED PROPERTIES
        ====================================================== --}}

        @if($relatedProperties->count())

            <div class="rsd-related">


                <div class="rsd-related-heading">

                    <h2>
                        Related Properties
                    </h2>

                    <span>
                        You may also like these properties
                    </span>

                </div>


                <div class="row">

                    @foreach($relatedProperties as $related)

                        <div class="col-lg-3 col-md-6 mb-4">


                            <a
                                href="{{ route(
                                    'property.details',
                                    ['slug' => $related->slug]
                                ) }}"
                                class="rsd-related-card"
                            >


                                {{-- =================================================
                                     RELATED IMAGE
                                ================================================== --}}

                                <div class="rsd-related-image">

                                    @if(
                                        !empty($related->photos)
                                        &&
                                        is_array($related->photos)
                                        &&
                                        isset($related->photos[0])
                                    )

                                        <img
                                            src="{{ asset(
                                                'storage/' . $related->photos[0]
                                            ) }}"
                                            alt="{{ $related->title }}"
                                        >

                                    @else

                                        <img
                                            src="{{ asset(
                                                'assets/img/property/1.jpg'
                                            ) }}"
                                            alt="{{ $related->title }}"
                                        >

                                    @endif

                                </div>


                                {{-- =================================================
                                     RELATED BODY
                                ================================================== --}}

                                <div class="rsd-related-body">


                                    <h3 class="rsd-related-title">

                                        {{ $related->title }}

                                    </h3>


                                    <p class="rsd-related-location">

                                        <i class="fa fa-map-marker"></i>

                                        {{ $related->location?->city ?? 'Location' }}

                                        @if($related->location?->state)

                                            , {{ $related->location->state }}

                                        @endif

                                    </p>


                                    <p class="rsd-related-price">

                                        ₹{{ number_format($related->price) }}

                                    </p>

                                </div>


                            </a>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

    </div>

</div>


{{-- =========================================================
     IMAGE SWITCH + MOUSE ZOOM SCRIPT
========================================================= --}}

<script>

/*
|--------------------------------------------------------------------------
| PROPERTY IMAGE SWITCH
|--------------------------------------------------------------------------
*/

function changePropertyImage(imageUrl, thumbnail)
{
    const mainImage =
        document.getElementById('rsdMainImage');

    if (!mainImage) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Reset zoom before changing image
    |--------------------------------------------------------------------------
    */

    mainImage.style.transformOrigin = 'center center';

    mainImage.style.transform = 'scale(1)';


    /*
    |--------------------------------------------------------------------------
    | Fade out
    |--------------------------------------------------------------------------
    */

    mainImage.style.opacity = '0';


    /*
    |--------------------------------------------------------------------------
    | Change image after fade
    |--------------------------------------------------------------------------
    */

    setTimeout(function () {

        mainImage.src = imageUrl;

        mainImage.style.opacity = '1';

    }, 150);


    /*
    |--------------------------------------------------------------------------
    | Remove active class from all thumbnails
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.rsd-thumb')
        .forEach(function (thumb) {

            thumb.classList.remove('active');

        });


    /*
    |--------------------------------------------------------------------------
    | Active clicked thumbnail
    |--------------------------------------------------------------------------
    */

    if (thumbnail) {
        thumbnail.classList.add('active');
    }
}


/*
|--------------------------------------------------------------------------
| MOUSE POSITION ZOOM
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {

    const gallery =
        document.getElementById('rsdGalleryMain');

    const image =
        document.getElementById('rsdMainImage');


    /*
    |--------------------------------------------------------------------------
    | Agar image available nahi hai to script stop
    |--------------------------------------------------------------------------
    */

    if (!gallery || !image) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Mouse Move
    |--------------------------------------------------------------------------
    */

    gallery.addEventListener('mousemove', function (event) {

        /*
        |----------------------------------------------------------------------
        | Mobile/touch devices par zoom nahi
        |----------------------------------------------------------------------
        */

        if (window.matchMedia('(hover: none)').matches) {
            return;
        }


        const rect =
            gallery.getBoundingClientRect();


        /*
        |----------------------------------------------------------------------
        | Mouse position calculate
        |----------------------------------------------------------------------
        */

        const x =
            ((event.clientX - rect.left) / rect.width) * 100;

        const y =
            ((event.clientY - rect.top) / rect.height) * 100;


        /*
        |----------------------------------------------------------------------
        | Keep position between 0 and 100
        |----------------------------------------------------------------------
        */

        const safeX =
            Math.max(0, Math.min(100, x));

        const safeY =
            Math.max(0, Math.min(100, y));


        /*
        |----------------------------------------------------------------------
        | Zoom origin mouse position par set
        |----------------------------------------------------------------------
        */

        image.style.transformOrigin =
            safeX + '% ' + safeY + '%';


        /*
        |----------------------------------------------------------------------
        | Zoom
        |----------------------------------------------------------------------
        */

        image.style.transform =
            'scale(1.18)';

    });


    /*
    |--------------------------------------------------------------------------
    | Mouse Enter
    |--------------------------------------------------------------------------
    */

    gallery.addEventListener('mouseenter', function () {

        if (window.matchMedia('(hover: none)').matches) {
            return;
        }

        image.style.transform =
            'scale(1.18)';

    });


    /*
    |--------------------------------------------------------------------------
    | Mouse Leave
    |--------------------------------------------------------------------------
    */

    gallery.addEventListener('mouseleave', function () {

        image.style.transformOrigin =
            'center center';

        image.style.transform =
            'scale(1)';

    });

});

</script>


@endsection

