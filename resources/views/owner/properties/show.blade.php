@extends('layouts.app')

@section('title', 'Property Details')

@section('content')

<style>

    /* =========================================================
       OWNER PROPERTY DETAILS
    ========================================================== */

    .owner-property-details {
        background: #f8fafc;
        min-height: 100vh;
        padding: 0 0 50px;
    }


    /* =========================================================
       PAGE HEADER — SAME AS DASHBOARD / EDIT PROPERTY
    ========================================================== */

    .property-details-top-header {
        padding-bottom: 35px;
    }

    .property-back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 10px 17px;
        border: 1px solid #e1e5eb;
        border-radius: 10px;
        background: #ffffff;
        color: #374151;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all .2s ease;
    }

    .property-back-btn:hover {
        background: #f5f6f8;
        color: #111827;
        border-color: #d5d9df;
    }


    /* =========================================================
       MAIN CARD
    ========================================================== */

    .property-details-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }


    /* =========================================================
       CARD HEADER
    ========================================================== */

    .property-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #eef0f3;
    }


    /* =========================================================
       ICON
    ========================================================== */

    .property-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }


    /* =========================================================
       DETAILS
    ========================================================== */

    .property-details-label {
        color: #64748b;
        font-size: 13px;
    }

    .property-details-value {
        color: #1e293b;
        font-size: 14px;
        font-weight: 600;
    }


    /* =========================================================
       MAIN IMAGE
    ========================================================== */

    .property-main-image {
        width: 100%;
        height: 480px;
        object-fit: cover;
        display: block;
    }

    .property-image-placeholder {
        height: 480px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
    }

    .property-image-placeholder i {
        font-size: 45px;
    }


    /* =========================================================
       BADGES
    ========================================================== */

    .property-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border-radius: 999px;
        padding: 7px 13px;
        font-size: 12px;
        font-weight: 700;
    }

    .property-status-approved {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }

    .property-status-pending {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .property-status-rejected {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .property-sale {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
    }

    .property-rent {
        background: #f5f3ff;
        color: #7c3aed;
        border: 1px solid #ede9fe;
    }

    .property-available {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #d1fae5;
    }

    .property-sold {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fee2e2;
    }

    .property-rented {
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid #fed7aa;
    }

    .property-type-badge {
        background: #f5f3ff;
        color: #7c3aed;
        border: 1px solid #ede9fe;
        border-radius: 8px;
        padding: 6px 11px;
        font-size: 12px;
        font-weight: 600;
    }


    /* =========================================================
       PROPERTY STATS
    ========================================================== */

    .property-stat {
        padding: 22px;
        border-right: 1px solid #eef0f3;
    }

    .property-stat:last-child {
        border-right: 0;
    }

    .property-stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }


    /* =========================================================
       PHOTO GRID
    ========================================================== */

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .property-photo {
        position: relative;
        display: block;
        height: 160px;
        overflow: hidden;
        border-radius: 12px;
        background: #f1f5f9;
        border: 1px solid #e5e7eb;
    }

    .property-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .3s ease;
    }

    .property-photo:hover img {
        transform: scale(1.05);
    }

    .property-photo-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(15, 23, 42, 0);
        transition: background .3s ease;
    }

    .property-photo:hover .property-photo-overlay {
        background: rgba(15, 23, 42, .45);
    }

    .photo-expand {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        color: #1e293b;
        opacity: 0;
        transform: scale(.75);
        transition: all .3s ease;
    }

    .property-photo:hover .photo-expand {
        opacity: 1;
        transform: scale(1);
    }

    .main-photo-label {
        position: absolute;
        left: 10px;
        top: 10px;
        background: #7c3aed;
        color: #fff;
        border-radius: 7px;
        padding: 5px 9px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
    }


    /* =========================================================
       VISIBILITY BOX
    ========================================================== */

    .visibility-box {
        border-radius: 12px;
        padding: 16px;
    }

    .visibility-live {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
    }

    .visibility-neutral {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .visibility-warning {
        background: #fffbeb;
        border: 1px solid #fde68a;
    }

    .visibility-danger {
        background: #fef2f2;
        border: 1px solid #fecaca;
    }


    /* =========================================================
       QUICK ACTION
    ========================================================== */

    .quick-action {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 11px;
        background: #fff;
        color: #475569;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all .2s ease;
    }

    .quick-action:hover {
        background: #f8fafc;
        color: #7c3aed;
        border-color: #ddd6fe;
    }


    /* =========================================================
       DESCRIPTION
    ========================================================== */

    .property-description {
        color: #475569;
        font-size: 14px;
        line-height: 1.9;
        white-space: pre-line;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 991px) {

        .property-main-image,
        .property-image-placeholder {
            height: 380px;
        }

        .property-stat {
            border-bottom: 1px solid #eef0f3;
        }

        .property-stat:nth-child(2n) {
            border-right: 0;
        }

        .photo-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

    }


    @media (max-width: 767px) {

        .property-details-top-header {
            padding-bottom: 25px;
        }

        .property-main-image,
        .property-image-placeholder {
            height: 280px;
        }

        .property-stat {
            border-right: 0;
        }

        .photo-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .property-photo {
            height: 140px;
        }

    }


    @media (max-width: 480px) {

        .photo-grid {
            grid-template-columns: 1fr 1fr;
        }

        .property-photo {
            height: 120px;
        }

        .property-card-header {
            padding: 17px;
        }

    }

</style>


<div class="owner-property-details">


    {{-- =========================================================
         PAGE HEADER — SAME AS OWNER DASHBOARD / EDIT PROPERTY
    ========================================================== --}}

    <section class="section-top property-details-top-header">

        <div class="container">

            <div class="col-lg-10 offset-lg-1 col-xs-12 text-center">

                <div class="section-top-title wow fadeInRight"
                     data-wow-duration="1s"
                     data-wow-delay="0.3s"
                     data-wow-offset="0">

                    <h1>
                        Property Details
                    </h1>

                    <p>
                        View complete information about your property.
                    </p>

                </div>


                

            </div>

        </div>

    </section>


    <div class="container">


        {{-- =========================================================
             OLD PAGE HEADER
             Retained as it was
        ========================================================== --}}

        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-4 mb-4">

            <div class="d-flex align-items-center gap-3">

                <a
                    href="{{ route('owner.properties.index') }}"
                    class="btn btn-light border rounded-3 d-flex align-items-center justify-content-center"
                    style="width:42px;height:42px;"
                    title="Back to Properties"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                </a>


                <div>

                    <h1 class="h3 fw-bold mb-1 text-dark">
                        Property Details
                    </h1>

                    <p class="text-muted mb-0">
                        View complete information about your property.
                    </p>

                </div>

            </div>


            <div class="d-flex flex-wrap gap-2">

                <a
                    href="{{ route('owner.properties.index') }}"
                    class="btn btn-light border rounded-3 px-4"
                >

                    <i class="fa-solid fa-list me-2"></i>

                    My Properties

                </a>


                <a
                    href="{{ route('owner.properties.edit', $property) }}"
                    class="btn btn-primary rounded-3 px-4"
                >

                    <i class="fa-solid fa-pen-to-square me-2"></i>

                    Edit Property

                </a>

            </div>

        </div>


        {{-- =========================================================
             SUCCESS MESSAGE
        ========================================================== --}}

        @if (session('success'))

            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="property-icon"
                        style="background:#ecfdf5;color:#059669;"
                    >

                        <i class="fa-solid fa-circle-check"></i>

                    </div>


                    <div>

                        <strong class="d-block">
                            Success
                        </strong>

                        <span>
                            {{ session('success') }}
                        </span>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
             PROPERTY APPROVAL STATUS
        ========================================================== --}}

        @php

            $approvalStatus = $property->approval_status ?? 'pending';

            $approvalTitle = match ($approvalStatus) {

                'approved' => 'Property Approved',

                'rejected' => 'Property Rejected',

                default => 'Property Pending Approval',

            };


            $approvalDescription = match ($approvalStatus) {

                'approved' =>
                    'This property has been approved by Super Admin and can be displayed according to its availability settings.',

                'rejected' =>
                    'This property was rejected by Super Admin. Please update the property information if changes are required.',

                default =>
                    'This property is waiting for Super Admin review.',

            };


            $approvalClass = match ($approvalStatus) {

                'approved' => 'property-status-approved',

                'rejected' => 'property-status-rejected',

                default => 'property-status-pending',

            };


            $approvalIcon = match ($approvalStatus) {

                'approved' => 'fa-circle-check',

                'rejected' => 'fa-circle-xmark',

                default => 'fa-clock',

            };

        @endphp


        <div class="property-details-card mb-4">

            <div class="p-4 p-md-5">

                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-4">


                    <div class="d-flex align-items-start gap-3">

                        <div
                            class="property-icon {{ $approvalClass }}"
                            style="width:48px;height:48px;"
                        >

                            <i class="fa-solid {{ $approvalIcon }}"></i>

                        </div>


                        <div>

                            <h2 class="h5 fw-bold text-dark mb-1">
                                {{ $approvalTitle }}
                            </h2>

                            <p
                                class="text-muted mb-0 small"
                                style="line-height:1.7;"
                            >
                                {{ $approvalDescription }}
                            </p>

                        </div>

                    </div>


                    <div class="flex-shrink-0">

                        <span class="property-badge {{ $approvalClass }}">

                            <span
                                style="
                                    width:8px;
                                    height:8px;
                                    border-radius:50%;
                                    background:currentColor;
                                "
                            ></span>

                            {{ $approvalStatus === 'approved'
                                ? 'Approved'
                                : ($approvalStatus === 'rejected'
                                    ? 'Rejected'
                                    : 'Pending Approval') }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             PHOTOS DATA
        ========================================================== --}}

        @php

            $photos = is_array($property->photos)
                ? $property->photos
                : [];

            $mainPhoto = count($photos) > 0
                ? $photos[0]
                : null;

        @endphp


        {{-- =========================================================
             MAIN PROPERTY CARD
        ========================================================== --}}

        <div class="property-details-card mb-4">


            {{-- PROPERTY IMAGE --}}

            <div class="position-relative overflow-hidden">

                @if ($mainPhoto)

                    <img
                        src="{{ asset('storage/' . $mainPhoto) }}"
                        alt="{{ $property->title }}"
                        class="property-main-image"
                    >

                @else

                    <div class="property-image-placeholder">

                        <div class="text-center">

                            <i class="fa-solid fa-image"></i>

                            <p class="mt-3 mb-0 text-muted small">
                                No property image available
                            </p>

                        </div>

                    </div>

                @endif


                {{-- PURPOSE BADGE --}}

                <div class="position-absolute top-0 start-0 p-3 p-md-4">

                    @if ($property->purpose === 'sale')

                        <span class="property-badge property-sale shadow-sm">

                            <i class="fa-solid fa-tag"></i>

                            For Sale

                        </span>

                    @else

                        <span class="property-badge property-rent shadow-sm">

                            <i class="fa-solid fa-key"></i>

                            For Rent

                        </span>

                    @endif

                </div>


                {{-- FEATURED BADGE --}}

                @if ($property->is_featured)

                    <div class="position-absolute top-0 end-0 p-3 p-md-4">

                        <span
                            class="property-badge shadow-sm"
                            style="
                                background:#fffbeb;
                                color:#b45309;
                                border:1px solid #fde68a;
                            "
                        >

                            <i class="fa-solid fa-star"></i>

                            Featured

                        </span>

                    </div>

                @endif

            </div>


            {{-- =====================================================
                 PROPERTY TITLE + PRICE
            ====================================================== --}}

            <div class="p-4 p-md-5 border-bottom">

                <div class="d-flex flex-column flex-lg-row align-items-lg-start justify-content-between gap-4">


                    <div class="min-w-0">


                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">

                            @if ($property->propertyType)

                                <span class="property-type-badge">

                                    {{ $property->propertyType->name }}

                                </span>

                            @endif


                            @if ($property->status === 'available')

                                <span class="property-badge property-available">

                                    <span
                                        style="
                                            width:7px;
                                            height:7px;
                                            border-radius:50%;
                                            background:currentColor;
                                        "
                                    ></span>

                                    Available

                                </span>

                            @elseif ($property->status === 'sold')

                                <span class="property-badge property-sold">

                                    <span
                                        style="
                                            width:7px;
                                            height:7px;
                                            border-radius:50%;
                                            background:currentColor;
                                        "
                                    ></span>

                                    Sold

                                </span>

                            @elseif ($property->status === 'rented')

                                <span class="property-badge property-rented">

                                    <span
                                        style="
                                            width:7px;
                                            height:7px;
                                            border-radius:50%;
                                            background:currentColor;
                                        "
                                    ></span>

                                    Rented

                                </span>

                            @endif

                        </div>


                        <h2 class="display-6 fw-bold text-dark mb-0">

                            {{ $property->title }}

                        </h2>


                        @if ($property->location)

                            <div class="d-flex align-items-start gap-2 mt-3 text-muted">

                                <i class="fa-solid fa-location-dot mt-1 text-primary"></i>

                                <span>

                                    {{ $property->location->city }}

                                    @if (!empty($property->location->state))

                                        , {{ $property->location->state }}

                                    @endif

                                    @if (!empty($property->location->country))

                                        , {{ $property->location->country }}

                                    @endif

                                </span>

                            </div>

                        @elseif ($property->address)

                            <div class="d-flex align-items-start gap-2 mt-3 text-muted">

                                <i class="fa-solid fa-location-dot mt-1 text-primary"></i>

                                <span>

                                    {{ $property->address }}

                                </span>

                            </div>

                        @endif

                    </div>


                    {{-- PRICE --}}

                    <div class="flex-shrink-0">

                        <p class="small text-uppercase fw-semibold text-muted mb-1">
                            Property Price
                        </p>

                        <p class="h2 fw-bold text-dark mb-0">

                            ₹{{ number_format((float) $property->price, 2) }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 PROPERTY DETAILS STATS
            ====================================================== --}}

            <div class="row g-0">


                {{-- BEDROOMS --}}

                <div class="col-6 col-md-3">

                    <div class="property-stat">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="property-stat-icon"
                                style="background:#eff6ff;color:#2563eb;"
                            >

                                <i class="fa-solid fa-bed"></i>

                            </div>


                            <div>

                                <p class="property-details-label mb-1">
                                    Bedrooms
                                </p>

                                <p class="property-details-value mb-0">

                                    {{ $property->bedrooms ?? '—' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- BATHROOMS --}}

                <div class="col-6 col-md-3">

                    <div class="property-stat">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="property-stat-icon"
                                style="background:#ecfeff;color:#0891b2;"
                            >

                                <i class="fa-solid fa-bath"></i>

                            </div>


                            <div>

                                <p class="property-details-label mb-1">
                                    Bathrooms
                                </p>

                                <p class="property-details-value mb-0">

                                    {{ $property->bathrooms ?? '—' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- AREA --}}

                <div class="col-6 col-md-3">

                    <div class="property-stat">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="property-stat-icon"
                                style="background:#ecfdf5;color:#059669;"
                            >

                                <i class="fa-solid fa-ruler-combined"></i>

                            </div>


                            <div>

                                <p class="property-details-label mb-1">
                                    Area
                                </p>

                                <p class="property-details-value mb-0">

                                    @if ($property->area)

                                        {{ number_format((float) $property->area, 2) }} sq.ft

                                    @else

                                        —

                                    @endif

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- GARAGES --}}

                <div class="col-6 col-md-3">

                    <div class="property-stat">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="property-stat-icon"
                                style="background:#fff7ed;color:#ea580c;"
                            >

                                <i class="fa-solid fa-car"></i>

                            </div>


                            <div>

                                <p class="property-details-label mb-1">
                                    Garages
                                </p>

                                <p class="property-details-value mb-0">

                                    {{ $property->garages ?? '—' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             TWO COLUMN CONTENT
        ========================================================== --}}

        <div class="row g-4">


            {{-- =====================================================
                 LEFT CONTENT
            ====================================================== --}}

            <div class="col-lg-8">


                {{-- =================================================
                     DESCRIPTION
                ================================================== --}}

                <div class="property-details-card mb-4">

                    <div class="property-card-header">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="property-icon"
                                style="background:#f5f3ff;color:#7c3aed;"
                            >

                                <i class="fa-solid fa-align-left"></i>

                            </div>


                            <div>

                                <h2 class="h5 fw-bold text-dark mb-1">
                                    Description
                                </h2>

                                <p class="small text-muted mb-0">
                                    Property information and details.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-4">

                        @if ($property->description)

                            <div class="property-description">

                                {{ $property->description }}

                            </div>

                        @else

                            <div class="text-center py-5">

                                <div
                                    class="property-icon mx-auto"
                                    style="background:#f8fafc;color:#94a3b8;"
                                >

                                    <i class="fa-solid fa-align-left"></i>

                                </div>

                                <p class="small text-muted mt-3 mb-0">

                                    No description has been added.

                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     ADDRESS
                ================================================== --}}

                @if ($property->address)

                    <div class="property-details-card mb-4">

                        <div class="property-card-header">

                            <div class="d-flex align-items-center gap-3">

                                <div
                                    class="property-icon"
                                    style="background:#fef2f2;color:#dc2626;"
                                >

                                    <i class="fa-solid fa-location-dot"></i>

                                </div>


                                <div>

                                    <h2 class="h5 fw-bold text-dark mb-1">
                                        Property Address
                                    </h2>

                                    <p class="small text-muted mb-0">
                                        Complete property location.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-4">

                            <div
                                class="rounded-3 p-4"
                                style="
                                    background:#f8fafc;
                                    border:1px solid #e5e7eb;
                                "
                            >

                                <div class="d-flex align-items-start gap-3">

                                    <div
                                        class="property-icon"
                                        style="background:#fef2f2;color:#dc2626;"
                                    >

                                        <i class="fa-solid fa-map-location-dot"></i>

                                    </div>


                                    <div>

                                        <p
                                            class="small text-secondary mb-2"
                                            style="line-height:1.7;"
                                        >

                                            {{ $property->address }}

                                        </p>


                                        @if ($property->location)

                                            <p class="small text-muted mb-0">

                                                {{ $property->location->city }}

                                                @if (!empty($property->location->state))

                                                    , {{ $property->location->state }}

                                                @endif

                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     PROPERTY PHOTOS
                ================================================== --}}

                <div class="property-details-card mb-4">

                    <div class="property-card-header">

                        <div class="d-flex align-items-center justify-content-between gap-3">

                            <div class="d-flex align-items-center gap-3">

                                <div
                                    class="property-icon"
                                    style="background:#fdf2f8;color:#db2777;"
                                >

                                    <i class="fa-solid fa-images"></i>

                                </div>


                                <div>

                                    <h2 class="h5 fw-bold text-dark mb-1">
                                        Property Photos
                                    </h2>

                                    <p class="small text-muted mb-0">
                                        Images uploaded for this property.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="badge rounded-pill"
                                style="background:#f1f5f9;color:#64748b;"
                            >

                                {{ count($photos) }}

                                {{ count($photos) === 1 ? 'Photo' : 'Photos' }}

                            </span>

                        </div>

                    </div>


                    <div class="p-4">

                        @if (count($photos) > 0)

                            <div class="photo-grid">

                                @foreach ($photos as $index => $photo)

                                    <a
                                        href="{{ asset('storage/' . $photo) }}"
                                        target="_blank"
                                        class="property-photo"
                                    >

                                        <img
                                            src="{{ asset('storage/' . $photo) }}"
                                            alt="{{ $property->title }} - Photo {{ $index + 1 }}"
                                        >


                                        <div class="property-photo-overlay">

                                            <div class="photo-expand">

                                                <i class="fa-solid fa-expand"></i>

                                            </div>

                                        </div>


                                        @if ($index === 0)

                                            <div class="main-photo-label">
                                                Main Photo
                                            </div>

                                        @endif

                                    </a>

                                @endforeach

                            </div>

                        @else

                            <div
                                class="text-center py-5 rounded-4"
                                style="
                                    background:#f8fafc;
                                    border:1px dashed #cbd5e1;
                                "
                            >

                                <div
                                    class="property-icon mx-auto"
                                    style="background:#fff;color:#94a3b8;"
                                >

                                    <i class="fa-solid fa-image"></i>

                                </div>


                                <p class="small fw-semibold text-secondary mt-3 mb-1">

                                    No photos uploaded

                                </p>


                                <p class="small text-muted mb-0">

                                    Add property photos from the edit page.

                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 RIGHT SIDEBAR
            ====================================================== --}}

            <div class="col-lg-4">


                {{-- =================================================
                     PROPERTY INFORMATION
                ================================================== --}}

                <div class="property-details-card mb-4">

                    <div class="property-card-header">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="property-icon"
                                style="background:#eff6ff;color:#2563eb;"
                            >

                                <i class="fa-solid fa-circle-info"></i>

                            </div>


                            <div>

                                <h2 class="h5 fw-bold text-dark mb-1">
                                    Property Information
                                </h2>

                                <p class="small text-muted mb-0">
                                    Listing information.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div>


                        {{-- PROPERTY TYPE --}}

                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 border-bottom">

                            <span class="property-details-label">
                                Property Type
                            </span>

                            <span class="property-details-value text-end">

                                {{ $property->propertyType->name ?? '—' }}

                            </span>

                        </div>


                        {{-- PURPOSE --}}

                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 border-bottom">

                            <span class="property-details-label">
                                Purpose
                            </span>

                            <span class="property-details-value text-end">

                                {{ $property->purpose === 'sale'
                                    ? 'For Sale'
                                    : 'For Rent' }}

                            </span>

                        </div>


                        {{-- STATUS --}}

                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 border-bottom">

                            <span class="property-details-label">
                                Availability
                            </span>

                            <span>

                                @if ($property->status === 'available')

                                    <span class="property-badge property-available">
                                        Available
                                    </span>

                                @elseif ($property->status === 'sold')

                                    <span class="property-badge property-sold">
                                        Sold
                                    </span>

                                @else

                                    <span class="property-badge property-rented">
                                        Rented
                                    </span>

                                @endif

                            </span>

                        </div>


                        {{-- CREATED --}}

                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 border-bottom">

                            <span class="property-details-label">
                                Listed On
                            </span>

                            <span class="property-details-value text-end">

                                {{ $property->created_at?->format('d M Y') ?? '—' }}

                            </span>

                        </div>


                        {{-- UPDATED --}}

                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3">

                            <span class="property-details-label">
                                Last Updated
                            </span>

                            <span class="property-details-value text-end">

                                {{ $property->updated_at?->format('d M Y') ?? '—' }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     WEBSITE VISIBILITY
                ================================================== --}}

                <div class="property-details-card mb-4">

                    <div class="property-card-header">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="property-icon"
                                style="background:#eef2ff;color:#4f46e5;"
                            >

                                <i class="fa-solid fa-eye"></i>

                            </div>


                            <div>

                                <h2 class="h5 fw-bold text-dark mb-1">
                                    Website Visibility
                                </h2>

                                <p class="small text-muted mb-0">
                                    Current public listing status.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-4">


                        @if (
                            $property->approval_status === 'approved' &&
                            $property->is_active &&
                            $property->status === 'available'
                        )

                            <div class="visibility-box visibility-live">

                                <div class="d-flex align-items-start gap-3">

                                    <div
                                        class="property-icon"
                                        style="
                                            width:38px;
                                            height:38px;
                                            background:#d1fae5;
                                            color:#059669;
                                        "
                                    >

                                        <i class="fa-solid fa-eye"></i>

                                    </div>


                                    <div>

                                        <p
                                            class="small fw-bold mb-1"
                                            style="color:#047857;"
                                        >
                                            Live on Website
                                        </p>

                                        <p class="small text-muted mb-0">
                                            This property is approved, active and available.
                                        </p>

                                    </div>

                                </div>

                            </div>


                        @elseif ($property->approval_status === 'approved')

                            <div class="visibility-box visibility-neutral">

                                <div class="d-flex align-items-start gap-3">

                                    <div
                                        class="property-icon"
                                        style="
                                            width:38px;
                                            height:38px;
                                            background:#e2e8f0;
                                            color:#64748b;
                                        "
                                    >

                                        <i class="fa-solid fa-eye-slash"></i>

                                    </div>


                                    <div>

                                        <p class="small fw-bold text-secondary mb-1">
                                            Not Public
                                        </p>

                                        <p class="small text-muted mb-0">

                                            The property is approved but currently
                                            {{ $property->status }}.

                                        </p>

                                    </div>

                                </div>

                            </div>


                        @elseif ($property->approval_status === 'rejected')

                            <div class="visibility-box visibility-danger">

                                <div class="d-flex align-items-start gap-3">

                                    <div
                                        class="property-icon"
                                        style="
                                            width:38px;
                                            height:38px;
                                            background:#fee2e2;
                                            color:#dc2626;
                                        "
                                    >

                                        <i class="fa-solid fa-eye-slash"></i>

                                    </div>


                                    <div>

                                        <p
                                            class="small fw-bold mb-1"
                                            style="color:#b91c1c;"
                                        >
                                            Not Visible
                                        </p>

                                        <p class="small text-muted mb-0">
                                            This property has not been approved.
                                        </p>

                                    </div>

                                </div>

                            </div>


                        @else

                            <div class="visibility-box visibility-warning">

                                <div class="d-flex align-items-start gap-3">

                                    <div
                                        class="property-icon"
                                        style="
                                            width:38px;
                                            height:38px;
                                            background:#fef3c7;
                                            color:#d97706;
                                        "
                                    >

                                        <i class="fa-solid fa-clock"></i>

                                    </div>


                                    <div>

                                        <p
                                            class="small fw-bold mb-1"
                                            style="color:#b45309;"
                                        >
                                            Waiting for Approval
                                        </p>

                                        <p class="small text-muted mb-0">
                                            Super Admin review is required before the property can become public.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     ASSIGNED AGENT
                ================================================== --}}

                <div class="property-details-card mb-4">

                    <div class="property-card-header">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="property-icon"
                                style="background:#f5f3ff;color:#7c3aed;"
                            >

                                <i class="fa-solid fa-user-tie"></i>

                            </div>


                            <div>

                                <h2 class="h5 fw-bold text-dark mb-1">
                                    Assigned Agent
                                </h2>

                                <p class="small text-muted mb-0">
                                    Agent managing this property.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-4">

                        @if ($property->agent)

                            <div class="d-flex align-items-center gap-3">

                                <div
                                    class="property-icon"
                                    style="
                                        width:50px;
                                        height:50px;
                                        border-radius:50%;
                                        background:#f5f3ff;
                                        color:#7c3aed;
                                    "
                                >

                                    <i class="fa-solid fa-user-tie"></i>

                                </div>


                                <div class="min-w-0">

                                    <p class="fw-semibold text-dark mb-1 text-truncate">

                                        {{ $property->agent->name }}

                                    </p>


                                    @if ($property->agent->email)

                                        <p class="small text-muted mb-0 text-truncate">

                                            {{ $property->agent->email }}

                                        </p>

                                    @endif

                                </div>

                            </div>

                        @else

                            <div
                                class="text-center p-4 rounded-3"
                                style="
                                    background:#f8fafc;
                                    border:1px dashed #cbd5e1;
                                "
                            >

                                <div
                                    class="property-icon mx-auto"
                                    style="background:#fff;color:#94a3b8;"
                                >

                                    <i class="fa-solid fa-user-slash"></i>

                                </div>


                                <p class="small fw-semibold text-secondary mt-3 mb-1">

                                    No Agent Assigned

                                </p>


                                <p class="small text-muted mb-0">

                                    You can assign an agent from the edit page.

                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     QUICK ACTIONS
                ================================================== --}}

                <div class="property-details-card mb-4">

                    <div class="property-card-header">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="property-icon"
                                style="background:#fff7ed;color:#ea580c;"
                            >

                                <i class="fa-solid fa-bolt"></i>

                            </div>


                            <div>

                                <h2 class="h5 fw-bold text-dark mb-1">
                                    Quick Actions
                                </h2>

                                <p class="small text-muted mb-0">
                                    Manage this property.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-4">

                        <div class="d-flex flex-column gap-2">


                            {{-- EDIT --}}

                            <a
                                href="{{ route('owner.properties.edit', $property) }}"
                                class="quick-action"
                            >

                                <span>

                                    <i
                                        class="fa-solid fa-pen-to-square me-2"
                                        style="color:#7c3aed;"
                                    ></i>

                                    Edit Property

                                </span>


                                <i class="fa-solid fa-chevron-right small text-muted"></i>

                            </a>


                            {{-- ALL PROPERTIES --}}

                            <a
                                href="{{ route('owner.properties.index') }}"
                                class="quick-action"
                            >

                                <span>

                                    <i
                                        class="fa-solid fa-list me-2"
                                        style="color:#2563eb;"
                                    ></i>

                                    All My Properties

                                </span>


                                <i class="fa-solid fa-chevron-right small text-muted"></i>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             BOTTOM ACTIONS
        ========================================================== --}}

        <div
            class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-between gap-3 mt-2 pt-4 border-top"
        >

            <a
                href="{{ route('owner.properties.index') }}"
                class="btn btn-light border rounded-3 px-4"
            >

                <i class="fa-solid fa-arrow-left me-2"></i>

                Back to Properties

            </a>


            <a
                href="{{ route('owner.properties.edit', $property) }}"
                class="btn btn-primary rounded-3 px-4"
            >

                <i class="fa-solid fa-pen-to-square me-2"></i>

                Edit Property

            </a>

        </div>


    </div>

</div>

@endsection