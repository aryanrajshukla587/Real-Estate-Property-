
@extends('layouts.app')

@section('title', 'Properties - Eagle Properties')

@section('content')


{{-- =========================================================
     SECTION TOP
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

                <h1>Properties</h1>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     PROPERTY PAGE CSS
========================================================= --}}

<style>

/* =========================================================
   PROPERTY LISTING PAGE
========================================================= */

.rs-property-page {

    background: #f6f7fb;

    min-height: 100vh;

    padding: 50px 0 80px;

    color: #1f2937;

    font-family:
        Arial,
        Helvetica,
        sans-serif;
}


.rs-property-page *,
.rs-property-page *::before,
.rs-property-page *::after {

    box-sizing: border-box;

}


.rs-property-container {

    width:
        min(
            1180px,
            calc(100% - 40px)
        );

    margin: 0 auto;

}


/* =========================================================
   HEADER
========================================================= */

.rs-listing-header {

    margin-bottom: 35px;

}


.rs-listing-title {

    margin: 0 0 10px;

    font-size: 38px;

    font-weight: 800;

    color: #111827;

}


.rs-listing-subtitle {

    margin: 0;

    color: #6b7280;

    font-size: 15px;

}


/* =========================================================
   FILTER BOX
========================================================= */

.rs-filter-box {

    background: #ffffff;

    border-radius: 20px;

    padding: 25px;

    margin-bottom: 35px;

    box-shadow:
        0 10px 35px rgba(0, 0, 0, .06);

}


.rs-filter-form {

    display: grid;

    grid-template-columns:
        2fr
        1fr
        1fr
        1fr
        1fr
        1fr
        auto;

    gap: 12px;

    align-items: end;

}


.rs-filter-group {

    display: flex;

    flex-direction: column;

    gap: 7px;

    min-width: 0;

}


.rs-filter-label {

    font-size: 12px;

    font-weight: 700;

    color: #6b7280;

    text-transform: uppercase;

    letter-spacing: .5px;

}


.rs-filter-input,
.rs-filter-select {

    width: 100%;

    height: 46px;

    border: 1px solid #e5e7eb;

    border-radius: 10px;

    padding: 0 14px;

    outline: none;

    background: #fff;

    color: #374151;

    font-size: 14px;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;

}


.rs-filter-input:focus,
.rs-filter-select:focus {

    border-color: #7c3aed;

    box-shadow:
        0 0 0 3px rgba(124, 58, 237, .08);

}


.rs-filter-input::placeholder {

    color: #9ca3af;

}


/* =========================================================
   FILTER ACTIONS
========================================================= */

.rs-filter-actions {

    display: flex;

    align-items: center;

    gap: 8px;

}


/* =========================================================
   SEARCH BUTTON
========================================================= */

.rs-filter-btn {

    height: 46px;

    padding: 0 20px;

    border: none;

    border-radius: 10px;

    background: #7c3aed;

    color: #fff;

    font-size: 13px;

    font-weight: 700;

    cursor: pointer;

    text-decoration: none;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    white-space: nowrap;

    transition:
        background .2s ease,
        transform .2s ease;

}


.rs-filter-btn:hover {

    background: #5b21b6;

    color: #fff;

    transform: translateY(-1px);

}


/* =========================================================
   CLEAR FILTERS
========================================================= */

.rs-clear-btn {

    height: 46px;

    padding: 0 18px;

    border: 1px solid #e5e7eb;

    border-radius: 10px;

    background: #f9fafb;

    color: #6b7280;

    font-size: 13px;

    font-weight: 700;

    text-decoration: none;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    white-space: nowrap;

    transition:
        background .2s ease,
        border-color .2s ease,
        color .2s ease,
        transform .2s ease;

}


.rs-clear-btn:hover {

    background: #f3f4f6;

    border-color: #d1d5db;

    color: #111827;

    transform: translateY(-1px);

}


/* =========================================================
   SEARCH RESULTS ANCHOR
========================================================= */

#search-results {

    scroll-margin-top: 90px;

}


/* =========================================================
   RESULT COUNT
========================================================= */

.rs-result-count {

    margin-bottom: 20px;

    color: #6b7280;

    font-size: 14px;

}


.rs-result-count strong {

    color: #111827;

}


/* =========================================================
   PROPERTY GRID
========================================================= */

.rs-property-grid {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 25px;

}


/* =========================================================
   PROPERTY CARD
========================================================= */

.rs-property-card {

    background: #fff;

    border-radius: 20px;

    overflow: hidden;

    box-shadow:
        0 10px 35px rgba(0, 0, 0, .07);

    transition:
        transform .3s ease,
        box-shadow .3s ease;

}


.rs-property-card:hover {

    transform: translateY(-5px);

    box-shadow:
        0 18px 45px rgba(0, 0, 0, .12);

}


/* =========================================================
   IMAGE
========================================================= */

.rs-card-image-wrap {

    position: relative;

    width: 100%;

    height: 235px;

    background: #111827;

    overflow: hidden;

}


.rs-card-image {

    width: 100%;

    height: 100%;

    object-fit: cover;

    display: block;

    transition:
        transform .4s ease;

}


.rs-property-card:hover .rs-card-image {

    transform: scale(1.05);

}


.rs-card-no-image {

    width: 100%;

    height: 100%;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #9ca3af;

    font-size: 15px;

}


/* =========================================================
   PURPOSE BADGE
========================================================= */

.rs-card-purpose {

    position: absolute;

    top: 15px;

    left: 15px;

    padding: 7px 14px;

    border-radius: 50px;

    background: #7c3aed;

    color: #fff;

    font-size: 11px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .5px;

}


/* =========================================================
   STATUS BADGE
========================================================= */

.rs-card-status {

    position: absolute;

    top: 15px;

    right: 15px;

    padding: 7px 12px;

    border-radius: 50px;

    background: rgba(17, 24, 39, .85);

    color: #fff;

    font-size: 11px;

    font-weight: 700;

    text-transform: capitalize;

}


/* =========================================================
   PHOTO COUNT
========================================================= */

.rs-card-photo-count {

    position: absolute;

    right: 15px;

    bottom: 15px;

    padding: 6px 11px;

    border-radius: 50px;

    background: rgba(0, 0, 0, .7);

    color: #fff;

    font-size: 11px;

}


/* =========================================================
   CARD CONTENT
========================================================= */

.rs-card-content {

    padding: 22px;

}


.rs-card-title {

    margin: 0 0 9px;

    font-size: 20px;

    line-height: 1.3;

    font-weight: 800;

    color: #111827;

}


.rs-card-title a {

    color: inherit;

    text-decoration: none;

}


.rs-card-title a:hover {

    color: #7c3aed;

}


/* =========================================================
   LOCATION
========================================================= */

.rs-card-location {

    display: flex;

    align-items: center;

    gap: 6px;

    margin-bottom: 15px;

    color: #6b7280;

    font-size: 13px;

}


.rs-card-location-icon {

    color: #7c3aed;

}


/* =========================================================
   PRICE
========================================================= */

.rs-card-price {

    margin-bottom: 18px;

    font-size: 23px;

    font-weight: 800;

    color: #7c3aed;

}


.rs-card-price small {

    color: #6b7280;

    font-size: 12px;

    font-weight: 500;

}


/* =========================================================
   FEATURES
========================================================= */

.rs-card-features {

    display: flex;

    flex-wrap: wrap;

    gap: 8px;

    padding-bottom: 18px;

    border-bottom:
        1px solid #eeeef2;

}


.rs-card-feature {

    background: #f8f7ff;

    border:
        1px solid #eee9ff;

    border-radius: 8px;

    padding: 7px 10px;

    color: #4b5563;

    font-size: 12px;

    font-weight: 600;

}


/* =========================================================
   CARD FOOTER
========================================================= */

.rs-card-footer {

    padding-top: 18px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 10px;

}


.rs-card-type {

    color: #6b7280;

    font-size: 12px;

}


.rs-view-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 6px;

    padding: 10px 16px;

    border-radius: 9px;

    background: #7c3aed;

    color: #fff !important;

    text-decoration: none !important;

    font-size: 13px;

    font-weight: 700;

    transition:
        background .2s ease;

}


.rs-view-btn:hover {

    background: #5b21b6;

}


/* =========================================================
   EMPTY STATE
========================================================= */

.rs-empty {

    background: #fff;

    border-radius: 20px;

    padding: 70px 25px;

    text-align: center;

    box-shadow:
        0 10px 35px rgba(0, 0, 0, .06);

}


.rs-empty-icon {

    font-size: 45px;

    margin-bottom: 15px;

}


.rs-empty-title {

    margin: 0 0 8px;

    font-size: 22px;

    font-weight: 800;

    color: #111827;

}


.rs-empty-text {

    margin: 0;

    color: #6b7280;

}


/* =========================================================
   PAGINATION
========================================================= */

.rs-pagination {

    margin-top: 40px;

}


.rs-pagination nav {

    display: flex;

    justify-content: center;

}


/* =========================================================
   RESPONSIVE - 1400
========================================================= */

@media(max-width: 1400px) {

    .rs-filter-form {

        grid-template-columns:
            repeat(4, 1fr);

    }


    .rs-filter-actions {

        grid-column: span 4;

        justify-content: flex-end;

    }

}


/* =========================================================
   RESPONSIVE - 1200
========================================================= */

@media(max-width: 1200px) {

    .rs-property-grid {

        grid-template-columns:
            repeat(3, 1fr);

    }

}


/* =========================================================
   RESPONSIVE - 1000
========================================================= */

@media(max-width: 1000px) {

    .rs-filter-form {

        grid-template-columns:
            repeat(2, 1fr);

    }


    .rs-filter-actions {

        grid-column: span 2;

        justify-content: flex-start;

    }


    .rs-property-grid {

        grid-template-columns:
            repeat(2, 1fr);

    }

}


/* =========================================================
   RESPONSIVE - 650
========================================================= */

@media(max-width: 650px) {

    .rs-property-page {

        padding: 30px 0 50px;

    }


    .rs-property-container {

        width:
            min(
                calc(100% - 24px),
                1180px
            );

    }


    .rs-listing-title {

        font-size: 30px;

    }


    .rs-filter-box {

        padding: 18px;

    }


    .rs-filter-form {

        grid-template-columns: 1fr;

    }


    .rs-filter-actions {

        grid-column: auto;

        width: 100%;

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 10px;

    }


    .rs-filter-actions .rs-filter-btn,
    .rs-filter-actions .rs-clear-btn {

        width: 100%;

    }


    .rs-property-grid {

        grid-template-columns: 1fr;

    }


    .rs-card-image-wrap {

        height: 230px;

    }

}


/* =========================================================
   RESPONSIVE - 420
========================================================= */

@media(max-width: 420px) {

    .rs-filter-actions {

        grid-template-columns: 1fr;

    }

}

</style>


{{-- =========================================================
     PROPERTY PAGE
========================================================= --}}

<div class="rs-property-page">

    <div class="rs-property-container">


        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="rs-listing-header">

            <h1 class="rs-listing-title">

                Properties

            </h1>

            <p class="rs-listing-subtitle">

                Find your perfect property from our latest listings.

            </p>

        </div>


        {{-- =====================================================
             FILTER BOX
        ====================================================== --}}

        <div class="rs-filter-box">

            <form
                action="{{ route('property') }}"
                method="GET"
                class="rs-filter-form"
            >


                {{-- =================================================
                     SEARCH
                ================================================== --}}

                <div class="rs-filter-group">

                    <label class="rs-filter-label">

                        Search

                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="rs-filter-input"
                        placeholder="Search property or location..."
                    >

                </div>


                {{-- =================================================
                     PURPOSE
                ================================================== --}}

                <div class="rs-filter-group">

                    <label class="rs-filter-label">

                        Purpose

                    </label>

                    <select
                        name="purpose"
                        class="rs-filter-select"
                    >

                        <option value="">

                            All

                        </option>

                        <option
                            value="sale"
                            {{ request('purpose') === 'sale' ? 'selected' : '' }}
                        >

                            Sale

                        </option>

                        <option
                            value="rent"
                            {{ request('purpose') === 'rent' ? 'selected' : '' }}
                        >

                            Rent

                        </option>

                    </select>

                </div>


                {{-- =================================================
                     PROPERTY TYPE
                ================================================== --}}

                <div class="rs-filter-group">

                    <label class="rs-filter-label">

                        Property Type

                    </label>

                    <select
                        name="property_type_id"
                        class="rs-filter-select"
                    >

                        <option value="">

                            All

                        </option>

                        @foreach($propertyTypes as $propertyType)

                            <option
                                value="{{ $propertyType->id }}"
                                {{ (string) request('property_type_id') === (string) $propertyType->id ? 'selected' : '' }}
                            >

                                {{ $propertyType->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =================================================
                     MIN AREA
                ================================================== --}}

                <div class="rs-filter-group">

                    <label class="rs-filter-label">

                        Min Area

                    </label>

                    <input
                        type="number"
                        name="min_area"
                        value="{{ request('min_area') }}"
                        class="rs-filter-input"
                        placeholder="Min Area in Sq.Ft."
                        min="0"
                        step="0.01"
                    >

                </div>


                {{-- =================================================
                     MAX AREA
                ================================================== --}}

                <div class="rs-filter-group">

                    <label class="rs-filter-label">

                        Max Area

                    </label>

                    <input
                        type="number"
                        name="max_area"
                        value="{{ request('max_area') }}"
                        class="rs-filter-input"
                        placeholder="Max Area in Sq.Ft."
                        min="0"
                        step="0.01"
                    >

                </div>


                {{-- =================================================
                     PRICE
                ================================================== --}}

                <div class="rs-filter-group">

                    <label class="rs-filter-label">

                        Price

                    </label>

                    <input
                        type="number"
                        name="max_price"
                        value="{{ request('max_price') }}"
                        class="rs-filter-input"
                        placeholder="Max Price"
                        min="0"
                        step="0.01"
                    >

                </div>


                {{-- =================================================
                     ACTION BUTTONS
                ================================================== --}}

                <div class="rs-filter-actions">

                    <button
                        type="submit"
                        class="rs-filter-btn"
                    >

                        Search

                    </button>


                    <a
                        href="{{ route('property') }}"
                        class="rs-clear-btn"
                    >

                        Clear Filters

                    </a>

                </div>


            </form>

        </div>


        {{-- =====================================================
             SEARCH RESULTS
        ====================================================== --}}

        <div id="search-results">


            {{-- =================================================
                 RESULT COUNT
            ================================================== --}}

            <div class="rs-result-count">

                Showing

                <strong>

                    {{ $properties->count() }}

                </strong>

                of

                <strong>

                    {{ $properties->total() }}

                </strong>

                properties

            </div>


            {{-- =================================================
                 PROPERTY GRID
            ================================================== --}}

            @if($properties->count())


                <div class="rs-property-grid">


                    @foreach($properties as $property)


                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | PHOTOS
                            |--------------------------------------------------------------------------
                            */

                            $photos = is_array($property->photos)
                                ? $property->photos
                                : [];

                            $mainPhoto = $photos[0] ?? null;


                            /*
                            |--------------------------------------------------------------------------
                            | LOCATION
                            |--------------------------------------------------------------------------
                            */

                            $locationParts = [];

                            if ($property->location?->city) {

                                $locationParts[] =
                                    $property->location->city;

                            }

                            if ($property->location?->state) {

                                $locationParts[] =
                                    $property->location->state;

                            }

                            $locationText = count($locationParts)
                                ? implode(', ', $locationParts)
                                : 'Location not available';


                            /*
                            |--------------------------------------------------------------------------
                            | PUBLIC VISIBILITY
                            |--------------------------------------------------------------------------
                            */

                            $isPubliclyVisible =
                                $property->approval_status === 'approved'
                                && $property->is_active
                                && $property->status === 'available';

                        @endphp


                        {{-- =================================================
                             PROPERTY CARD
                        ================================================== --}}

                        <div class="rs-property-card">


                            {{-- =================================================
                                 IMAGE
                            ================================================== --}}

                            <div class="rs-card-image-wrap">


                                @if($mainPhoto)

                                    <img
                                        src="{{ asset('storage/' . $mainPhoto) }}"
                                        alt="{{ $property->title }}"
                                        class="rs-card-image"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="rs-card-no-image">

                                        No Property Image

                                    </div>

                                @endif


                                {{-- PURPOSE BADGE --}}

                                @if($property->purpose)

                                    <div class="rs-card-purpose">

                                        {{ ucfirst($property->purpose) }}

                                    </div>

                                @endif


                                {{-- MARKET STATUS BADGE --}}

                                <div class="rs-card-status">

                                    {{ ucfirst($property->status ?? 'available') }}

                                </div>


                                {{-- PHOTO COUNT --}}

                                @if(count($photos) > 0)

                                    <div class="rs-card-photo-count">

                                        📷
                                        {{ count($photos) }}

                                    </div>

                                @endif

                            </div>


                            {{-- =================================================
                                 CARD CONTENT
                            ================================================== --}}

                            <div class="rs-card-content">


                                {{-- TITLE --}}

                                <h2 class="rs-card-title">

                                    <a
                                        href="{{ route(
                                            'property.details',
                                            ['slug' => $property->slug]
                                        ) }}"
                                    >

                                        {{ $property->title }}

                                    </a>

                                </h2>


                                {{-- LOCATION --}}

                                <div class="rs-card-location">

                                    <span class="rs-card-location-icon">

                                        📍

                                    </span>

                                    <span>

                                        {{ $locationText }}

                                    </span>

                                </div>


                                {{-- PRICE --}}

                                <div class="rs-card-price">

                                    ₹{{ number_format(
                                        (float) $property->price,
                                        0
                                    ) }}

                                    @if($property->purpose === 'rent')

                                        <small>

                                            / month

                                        </small>

                                    @endif

                                </div>


                                {{-- =================================================
                                     FEATURES
                                ================================================== --}}

                                <div class="rs-card-features">


                                    {{-- AREA --}}

                                    @if(!is_null($property->area))

                                        <span class="rs-card-feature">

                                            📐

                                            {{ number_format(
                                                (float) $property->area,
                                                0
                                            ) }}

                                            Sqft

                                        </span>

                                    @endif


                                    {{-- BEDROOMS --}}

                                    @if(!is_null($property->bedrooms))

                                        <span class="rs-card-feature">

                                            🛏

                                            {{ $property->bedrooms }}

                                            {{ $property->bedrooms == 1
                                                ? 'Bed'
                                                : 'Beds'
                                            }}

                                        </span>

                                    @endif


                                    {{-- BATHROOMS --}}

                                    @if(!is_null($property->bathrooms))

                                        <span class="rs-card-feature">

                                            🛁

                                            {{ $property->bathrooms }}

                                            {{ $property->bathrooms == 1
                                                ? 'Bath'
                                                : 'Baths'
                                            }}

                                        </span>

                                    @endif


                                    {{-- GARAGES --}}

                                    @if(!is_null($property->garages))

                                        <span class="rs-card-feature">

                                            🚗

                                            {{ $property->garages }}

                                            {{ $property->garages == 1
                                                ? 'Garage'
                                                : 'Garages'
                                            }}

                                        </span>

                                    @endif


                                </div>


                                {{-- =================================================
                                     CARD FOOTER
                                ================================================== --}}

                                <div class="rs-card-footer">


                                    <div class="rs-card-type">

                                        {{ $property->propertyType?->name ?? 'Property' }}

                                    </div>


                                    <a
                                        href="{{ route(
                                            'property.details',
                                            ['slug' => $property->slug]
                                        ) }}"
                                        class="rs-view-btn"
                                    >

                                        View Details →

                                    </a>


                                </div>


                            </div>

                        </div>


                    @endforeach


                </div>


                {{-- =====================================================
                     PAGINATION
                ====================================================== --}}

                <div class="rs-pagination">

                    {{ $properties->links() }}

                </div>


            @else


                {{-- =====================================================
                     EMPTY STATE
                ====================================================== --}}

                <div class="rs-empty">

                    <div class="rs-empty-icon">

                        🏠

                    </div>

                    <h2 class="rs-empty-title">

                        No Properties Found

                    </h2>

                    <p class="rs-empty-text">

                        Try changing your search or filter options.

                    </p>

                </div>


            @endif


        </div>

    </div>

</div>


{{-- =========================================================
     AUTO SCROLL AFTER SEARCH / FILTER
========================================================= --}}

@if(
    request()->hasAny([
        'search',
        'purpose',
        'property_type_id',
        'min_area',
        'max_area',
        'min_price',
        'max_price',
    ])
)

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchResults =
        document.getElementById('search-results');


    if (!searchResults) {

        return;

    }


    setTimeout(function () {

        const headerOffset = 80;


        const elementPosition =
            searchResults.getBoundingClientRect().top;


        const offsetPosition =
            elementPosition +
            window.pageYOffset -
            headerOffset;


        window.scrollTo({

            top: offsetPosition,

            behavior: 'smooth'

        });

    }, 150);

});

</script>

@endif


@endsection

