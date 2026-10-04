@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')

<div class="owner-property-page">

    {{-- =========================================================
         PAGE HEADER — SAME AS OWNER DASHBOARD
    ========================================================== --}}

    <section class="section-top">

        <div class="container">

            <div class="col-lg-10 offset-lg-1 col-xs-12 text-center">

                <div class="section-top-title wow fadeInRight"
                     data-wow-duration="1s"
                     data-wow-delay="0.3s"
                     data-wow-offset="0">

                    <h1>
                        Edit Property
                    </h1>

                    <p>
                        Update your property information and manage its listing details.
                    </p>

                </div>

                <div class="mt-3">

                    <a
                        href="{{ route('owner.properties.index') }}"
                        class="property-back-btn"
                    >
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to Properties
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <div class="container py-4 py-lg-5">


        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}

        @if ($errors->any())

            <div class="alert property-error-alert mb-4">

                <div class="d-flex align-items-start gap-3">

                    <div class="property-alert-icon">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>

                    <div>

                        <h6 class="fw-bold mb-2">
                            Please fix the following errors:
                        </h6>

                        <ul class="mb-0 ps-3">

                            @foreach ($errors->all() as $error)

                                <li class="mb-1">
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =====================================================
             PROPERTY STATUS INFORMATION
        ====================================================== --}}

        <div class="property-status-notice mb-4">

            <div class="d-flex align-items-start gap-3">

                <div class="property-status-icon">

                    @if ($property->approval_status === 'approved')

                        <i class="fa-solid fa-circle-check"></i>

                    @elseif ($property->approval_status === 'rejected')

                        <i class="fa-solid fa-circle-xmark"></i>

                    @else

                        <i class="fa-solid fa-clock"></i>

                    @endif

                </div>

                <div>

                    <h6 class="fw-bold mb-1">

                        @if ($property->approval_status === 'approved')

                            Property Approved

                        @elseif ($property->approval_status === 'rejected')

                            Property Rejected

                        @else

                            Property Pending Approval

                        @endif

                    </h6>

                    <p class="mb-0">

                        @if ($property->approval_status === 'approved')

                            This property has been approved by the Super Admin.
                            You can update its information, availability and assigned Agent.

                        @elseif ($property->approval_status === 'rejected')

                            This property was not approved by the Super Admin.
                            You can update the information and make the necessary changes.

                        @else

                            This property is currently waiting for Super Admin review.
                            You can update the information before approval.

                        @endif

                    </p>

                </div>

            </div>

        </div>


        {{-- =========================================================
             MAIN FORM
        ========================================================== --}}

        <form
            action="{{ route('owner.properties.update', $property) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            {{-- =====================================================
                 BASIC INFORMATION
            ====================================================== --}}

            <div class="property-form-card mb-4">

                <div class="property-form-header">

                    <div class="property-section-icon purple">
                        <i class="fa-solid fa-house"></i>
                    </div>

                    <div>

                        <h5 class="mb-1">
                            Basic Information
                        </h5>

                        <p class="mb-0">
                            Update the main property information.
                        </p>

                    </div>

                </div>


                <div class="property-form-body">

                    <div class="row g-4">


                        {{-- TITLE --}}

                        <div class="col-12">

                            <label class="property-form-label">

                                Property Title

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title', $property->title) }}"
                                required
                                placeholder="e.g. Luxury 3 BHK Apartment"
                                class="form-control property-input"
                            >

                        </div>


                        {{-- PROPERTY TYPE --}}

                        <div class="col-md-6">

                            <label class="property-form-label">

                                Property Type

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="property_type_id"
                                required
                                class="form-select property-input"
                            >

                                <option value="">
                                    Select Property Type
                                </option>

                                @foreach ($propertyTypes as $type)

                                    <option
                                        value="{{ $type->id }}"
                                        @selected(old('property_type_id', $property->property_type_id) == $type->id)
                                    >
                                        {{ $type->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- LOCATION --}}

                        <div class="col-md-6">

                            <label class="property-form-label">

                                Location

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="location_id"
                                required
                                class="form-select property-input"
                            >

                                <option value="">
                                    Select Location
                                </option>

                                @foreach ($locations as $location)

                                    <option
                                        value="{{ $location->id }}"
                                        @selected(old('location_id', $property->location_id) == $location->id)
                                    >

                                        {{ $location->city }}

                                        @if (!empty($location->state))
                                            , {{ $location->state }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- ASSIGN AGENT --}}

                        <div class="col-md-6">

                            <label class="property-form-label">

                                Assign Agent

                                <span class="property-optional">
                                    (Optional)
                                </span>

                            </label>

                            <div class="property-input-icon-wrap">

                                <i class="fa-solid fa-user-tie"></i>

                                <select
                                    name="agent_id"
                                    class="form-select property-input property-input-with-icon"
                                >

                                    <option value="">
                                        No Agent Assigned
                                    </option>

                                    @foreach ($agents as $agent)

                                        <option
                                            value="{{ $agent->id }}"
                                            @selected(old('agent_id', $property->agent_id) == $agent->id)
                                        >

                                            {{ $agent->name }}

                                            @if (!empty($agent->email))
                                                — {{ $agent->email }}
                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <small class="property-help-text">

                                Assign a registered Agent to manage enquiries and follow-ups
                                for this property.

                            </small>

                        </div>


                        {{-- PURPOSE --}}

                        <div class="col-md-6">

                            <label class="property-form-label">

                                Purpose

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="purpose"
                                required
                                class="form-select property-input"
                            >

                                <option value="">
                                    Select Purpose
                                </option>

                                <option
                                    value="sale"
                                    @selected(old('purpose', $property->purpose) === 'sale')
                                >
                                    For Sale
                                </option>

                                <option
                                    value="rent"
                                    @selected(old('purpose', $property->purpose) === 'rent')
                                >
                                    For Rent
                                </option>

                            </select>

                        </div>


                        {{-- PRICE --}}

                        <div class="col-md-6">

                            <label class="property-form-label">

                                Price

                                <span class="text-danger">*</span>

                            </label>

                            <div class="property-input-icon-wrap">

                                <span class="property-currency">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    name="price"
                                    value="{{ old('price', $property->price) }}"
                                    min="0"
                                    step="0.01"
                                    required
                                    placeholder="5000000"
                                    class="form-control property-input property-input-with-currency"
                                >

                            </div>

                        </div>


                        {{-- ADDRESS --}}

                        <div class="col-12">

                            <label class="property-form-label">
                                Address
                            </label>

                            <input
                                type="text"
                                name="address"
                                value="{{ old('address', $property->address) }}"
                                placeholder="Enter complete property address"
                                class="form-control property-input"
                            >

                        </div>


                        {{-- DESCRIPTION --}}

                        <div class="col-12">

                            <label class="property-form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="6"
                                placeholder="Write detailed information about this property..."
                                class="form-control property-input property-textarea"
                            >{{ old('description', $property->description) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 PROPERTY DETAILS
            ====================================================== --}}

            <div class="property-form-card mb-4">

                <div class="property-form-header">

                    <div class="property-section-icon blue">
                        <i class="fa-solid fa-list-check"></i>
                    </div>

                    <div>

                        <h5 class="mb-1">
                            Property Details
                        </h5>

                        <p class="mb-0">
                            Update rooms, area and parking information.
                        </p>

                    </div>

                </div>


                <div class="property-form-body">

                    <div class="row g-4">


                        {{-- BEDROOMS --}}

                        <div class="col-sm-6 col-lg-3">

                            <label class="property-form-label">
                                Bedrooms
                            </label>

                            <div class="property-input-icon-wrap">

                                <i class="fa-solid fa-bed"></i>

                                <input
                                    type="number"
                                    name="bedrooms"
                                    value="{{ old('bedrooms', $property->bedrooms) }}"
                                    min="0"
                                    placeholder="3"
                                    class="form-control property-input property-input-with-icon"
                                >

                            </div>

                        </div>


                        {{-- BATHROOMS --}}

                        <div class="col-sm-6 col-lg-3">

                            <label class="property-form-label">
                                Bathrooms
                            </label>

                            <div class="property-input-icon-wrap">

                                <i class="fa-solid fa-bath"></i>

                                <input
                                    type="number"
                                    name="bathrooms"
                                    value="{{ old('bathrooms', $property->bathrooms) }}"
                                    min="0"
                                    placeholder="2"
                                    class="form-control property-input property-input-with-icon"
                                >

                            </div>

                        </div>


                        {{-- AREA --}}

                        <div class="col-sm-6 col-lg-3">

                            <label class="property-form-label">
                                Area
                            </label>

                            <div class="property-area-wrap">

                                <input
                                    type="number"
                                    name="area"
                                    value="{{ old('area', $property->area) }}"
                                    min="0"
                                    step="0.01"
                                    placeholder="1500"
                                    class="form-control property-input"
                                >

                                <span>
                                    sq.ft
                                </span>

                            </div>

                        </div>


                        {{-- GARAGES --}}

                        <div class="col-sm-6 col-lg-3">

                            <label class="property-form-label">
                                Garages
                            </label>

                            <div class="property-input-icon-wrap">

                                <i class="fa-solid fa-car"></i>

                                <input
                                    type="number"
                                    name="garages"
                                    value="{{ old('garages', $property->garages) }}"
                                    min="0"
                                    placeholder="1"
                                    class="form-control property-input property-input-with-icon"
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 EXISTING PROPERTY PHOTOS
            ====================================================== --}}

            <div class="property-form-card mb-4">

                <div class="property-form-header">

                    <div class="property-section-icon pink">
                        <i class="fa-solid fa-images"></i>
                    </div>

                    <div>

                        <h5 class="mb-1">
                            Existing Photos
                        </h5>

                        <p class="mb-0">
                            Manage photos already uploaded for this property.
                        </p>

                    </div>

                </div>


                <div class="property-form-body">

                    @php

                        $existingPhotos = is_array($property->photos)
                            ? $property->photos
                            : [];

                    @endphp


                    @if (count($existingPhotos) > 0)

                        <div class="row g-3">

                            @foreach ($existingPhotos as $photo)

                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                                    <div
                                        id="existing-photo-{{ md5($photo) }}"
                                        class="existing-photo-card"
                                    >

                                        <img
                                            src="{{ asset('storage/' . $photo) }}"
                                            alt="{{ $property->title }}"
                                        >


                                        {{-- DELETE BUTTON --}}

                                        <label
                                            class="photo-delete-btn"
                                            title="Remove / Restore this photo"
                                        >

                                            <input
                                                type="checkbox"
                                                name="delete_photos[]"
                                                value="{{ $photo }}"
                                                class="d-none"
                                                onchange="togglePhotoDelete(this)"
                                            >

                                            <i class="fa-solid fa-trash"></i>

                                        </label>


                                        {{-- DELETED LABEL --}}

                                        <div class="photo-deleted-label">

                                            <div class="text-center">

                                                <i class="fa-solid fa-trash-can"></i>

                                                <p>
                                                    Marked for removal
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="no-photos-box">

                            <div class="no-photos-icon">
                                <i class="fa-solid fa-image"></i>
                            </div>

                            <p class="mb-1 fw-semibold">
                                No photos uploaded
                            </p>

                            <small>
                                You can upload new photos below.
                            </small>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =====================================================
                 ADD NEW PROPERTY PHOTOS
            ====================================================== --}}

            <div class="property-form-card mb-4">

                <div class="property-form-header">

                    <div class="property-section-icon indigo">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>

                    <div>

                        <h5 class="mb-1">
                            Add New Photos
                        </h5>

                        <p class="mb-0">
                            Upload additional photos for this property.
                        </p>

                    </div>

                </div>


                <div class="property-form-body">

                    <label
                        for="photos"
                        class="photo-upload-box"
                    >

                        <div class="photo-upload-icon">
                            <i class="fa-solid fa-images"></i>
                        </div>

                        <h6>
                            Click to upload new property photos
                        </h6>

                        <p>
                            JPG, JPEG, PNG or WEBP
                        </p>

                        <small>
                            Maximum 5MB per image
                        </small>

                        <input
                            id="photos"
                            type="file"
                            name="photos[]"
                            accept=".jpg,.jpeg,.png,.webp"
                            multiple
                            class="d-none"
                        >

                    </label>


                    {{-- NEW PHOTO PREVIEW --}}

                    <div
                        id="photoPreview"
                        class="row g-3 mt-2"
                    ></div>

                </div>

            </div>


            {{-- =====================================================
                 PROPERTY SETTINGS
            ====================================================== --}}

            <div class="property-form-card mb-4">

                <div class="property-form-header">

                    <div class="property-section-icon orange">
                        <i class="fa-solid fa-sliders"></i>
                    </div>

                    <div>

                        <h5 class="mb-1">
                            Property Settings
                        </h5>

                        <p class="mb-0">
                            Manage availability and featured listing settings.
                        </p>

                    </div>

                </div>


                <div class="property-form-body">

                    <div class="row g-4">


                        {{-- AVAILABILITY STATUS --}}

                        <div class="col-md-6">

                            <label class="property-form-label">

                                Availability Status

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="status"
                                required
                                class="form-select property-input"
                            >

                                <option
                                    value="available"
                                    @selected(old('status', $property->status) === 'available')
                                >
                                    Available
                                </option>

                                <option
                                    value="sold"
                                    @selected(old('status', $property->status) === 'sold')
                                >
                                    Sold
                                </option>

                                <option
                                    value="rented"
                                    @selected(old('status', $property->status) === 'rented')
                                >
                                    Rented
                                </option>

                            </select>

                            <small class="property-help-text">

                                This controls whether the property is available, sold or rented.

                            </small>

                        </div>


                        {{-- CURRENT APPROVAL STATUS --}}

                        <div class="col-md-6">

                            <label class="property-form-label">
                                Approval Status
                            </label>


                            @if ($property->approval_status === 'approved')

                                <div class="property-status-card approved">

                                    <span class="property-status-card-icon">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </span>

                                    <div>

                                        <strong>
                                            Approved
                                        </strong>

                                        <small>
                                            Approved by Super Admin.
                                        </small>

                                    </div>

                                </div>

                            @elseif ($property->approval_status === 'rejected')

                                <div class="property-status-card rejected">

                                    <span class="property-status-card-icon">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </span>

                                    <div>

                                        <strong>
                                            Rejected
                                        </strong>

                                        <small>
                                            Not approved by Super Admin.
                                        </small>

                                    </div>

                                </div>

                            @else

                                <div class="property-status-card pending">

                                    <span class="property-status-card-icon">
                                        <i class="fa-solid fa-clock"></i>
                                    </span>

                                    <div>

                                        <strong>
                                            Pending Approval
                                        </strong>

                                        <small>
                                            Waiting for Super Admin review.
                                        </small>

                                    </div>

                                </div>

                            @endif

                        </div>


                        {{-- WEBSITE VISIBILITY --}}

                        <div class="col-md-6">

                            <label class="property-form-label">
                                Website Visibility
                            </label>


                            @if (
                                $property->approval_status === 'approved' &&
                                $property->is_active &&
                                $property->status === 'available'
                            )

                                <div class="property-status-card approved">

                                    <span class="property-status-card-icon">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>

                                    <div>

                                        <strong>
                                            Live on Website
                                        </strong>

                                        <small>
                                            Publicly visible.
                                        </small>

                                    </div>

                                </div>

                            @elseif ($property->approval_status === 'approved')

                                <div class="property-status-card neutral">

                                    <span class="property-status-card-icon">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </span>

                                    <div>

                                        <strong>
                                            Not Public
                                        </strong>

                                        <small>
                                            {{ ucfirst($property->status) }}
                                        </small>

                                    </div>

                                </div>

                            @elseif ($property->approval_status === 'rejected')

                                <div class="property-status-card rejected">

                                    <span class="property-status-card-icon">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </span>

                                    <div>

                                        <strong>
                                            Not Visible
                                        </strong>

                                        <small>
                                            Approval rejected.
                                        </small>

                                    </div>

                                </div>

                            @else

                                <div class="property-status-card pending">

                                    <span class="property-status-card-icon">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </span>

                                    <div>

                                        <strong>
                                            Not Visible Yet
                                        </strong>

                                        <small>
                                            Waiting for approval.
                                        </small>

                                    </div>

                                </div>

                            @endif

                        </div>


                        {{-- FEATURED --}}

                        <div class="col-md-6">

                            <label class="featured-property-option">

                                <input
                                    type="checkbox"
                                    name="is_featured"
                                    value="1"
                                    @checked(old('is_featured', $property->is_featured))
                                >

                                <span class="featured-checkbox">
                                    <i class="fa-solid fa-check"></i>
                                </span>

                                <span>

                                    <strong>
                                        Featured Property
                                    </strong>

                                    <small>
                                        Request this property to be shown as a featured listing.
                                        Final visibility is controlled by Super Admin.
                                    </small>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 ACTION BUTTONS
            ====================================================== --}}

            <div class="property-form-actions">

                <a
                    href="{{ route('owner.properties.index') }}"
                    class="property-cancel-btn"
                >

                    <i class="fa-solid fa-xmark"></i>

                    Cancel

                </a>

                <button
                    type="submit"
                    class="property-save-btn"
                >

                    <i class="fa-solid fa-floppy-disk"></i>

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</div>


{{-- =========================================================
     PAGE CSS
========================================================== --}}

<style>

.owner-property-page {
    background: #f8fafc;
    min-height: calc(100vh - 80px);
    padding-bottom: 30px;
}


/* =========================================================
   BACK TO PROPERTIES BUTTON
========================================================= */

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
   VALIDATION
========================================================= */

.property-error-alert {
    background: #fff5f5;
    border: 1px solid #fecaca;
    border-radius: 14px;
    color: #991b1b;
    padding: 18px 20px;
}

.property-alert-icon {
    color: #dc2626;
    font-size: 18px;
}

.property-error-alert h6 {
    color: #991b1b;
}

.property-error-alert li {
    font-size: 13px;
}


/* =========================================================
   PROPERTY STATUS NOTICE
========================================================= */

.property-status-notice {
    background: #faf7ff;
    border: 1px solid #e9d5ff;
    border-radius: 15px;
    padding: 18px 20px;
}

.property-status-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #f3e8ff;
    color: #9333ea;
}

.property-status-notice h6 {
    color: #7e22ce;
}

.property-status-notice p {
    color: #7c6f86;
    font-size: 13px;
    line-height: 1.6;
}


/* =========================================================
   FORM CARDS
========================================================= */

.property-form-card {
    background: #ffffff;
    border: 1px solid #e7ebf0;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(15, 23, 42, .04);
}

.property-form-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 20px 24px;
    border-bottom: 1px solid #edf0f4;
}

.property-form-header h5 {
    color: #172033;
    font-size: 17px;
    font-weight: 700;
}

.property-form-header p {
    color: #7a8391;
    font-size: 13px;
}

.property-form-body {
    padding: 24px;
}


/* =========================================================
   SECTION ICONS
========================================================= */

.property-section-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.property-section-icon.purple {
    background: #f3e8ff;
    color: #9333ea;
}

.property-section-icon.blue {
    background: #eff6ff;
    color: #2563eb;
}

.property-section-icon.pink {
    background: #fdf2f8;
    color: #db2777;
}

.property-section-icon.indigo {
    background: #eef2ff;
    color: #4f46e5;
}

.property-section-icon.orange {
    background: #fff7ed;
    color: #ea580c;
}


/* =========================================================
   FORM FIELDS
========================================================= */

.property-form-label {
    display: block;
    margin-bottom: 8px;
    color: #374151;
    font-size: 13px;
    font-weight: 600;
}

.property-optional {
    color: #9ca3af;
    font-weight: 400;
}

.property-input {
    min-height: 46px;
    border: 1px solid #dfe4ea !important;
    border-radius: 10px !important;
    background: #ffffff !important;
    color: #1f2937 !important;
    font-size: 14px !important;
    box-shadow: none !important;
    transition: all .2s ease;
}

.property-input:focus {
    border-color: #a855f7 !important;
    box-shadow: 0 0 0 3px rgba(168, 85, 247, .10) !important;
}

.property-input::placeholder {
    color: #9ca3af;
}

.property-textarea {
    min-height: 145px;
    resize: vertical;
}

.property-input-icon-wrap {
    position: relative;
}

.property-input-icon-wrap > i {
    position: absolute;
    z-index: 2;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 14px;
    pointer-events: none;
}

.property-input-with-icon {
    padding-left: 42px !important;
}

.property-currency {
    position: absolute;
    z-index: 2;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 15px;
    font-weight: 600;
    pointer-events: none;
}

.property-input-with-currency {
    padding-left: 36px !important;
}

.property-area-wrap {
    position: relative;
}

.property-area-wrap span {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 11px;
    font-weight: 500;
    pointer-events: none;
}

.property-area-wrap .property-input {
    padding-right: 58px !important;
}

.property-help-text {
    display: block;
    margin-top: 7px;
    color: #8a93a1;
    font-size: 11px;
    line-height: 1.5;
}


/* =========================================================
   EXISTING PHOTOS
========================================================= */

.existing-photo-card {
    position: relative;
    height: 145px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    border-radius: 11px;
    background: #f8fafc;
    transition: all .25s ease;
}

.existing-photo-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .3s ease;
}

.existing-photo-card:hover img {
    transform: scale(1.05);
}


/* =========================================================
   DELETE / RESTORE PHOTO BUTTON
========================================================= */

.photo-delete-btn {
    position: absolute;
    top: 9px;
    right: 9px;

    /*
    IMPORTANT:
    Button overlay ke upar rahega,
    isliye selected photo ko dobara click
    karke unselect kiya ja sakta hai.
    */
    z-index: 5;

    width: 32px;
    height: 32px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: rgba(17, 24, 39, .78);
    color: #f87171;

    cursor: pointer;

    transition: all .2s ease;
}

.photo-delete-btn:hover {
    background: #dc2626;
    color: #ffffff;
}


/* =========================================================
   DELETED LABEL
========================================================= */

.photo-deleted-label {
    position: absolute;
    inset: 0;

    display: none;
    align-items: center;
    justify-content: center;

    background: rgba(127, 29, 29, .84);
    color: #ffffff;

    /*
    IMPORTANT:
    Ye overlay clicks ko block nahi karega.
    Isse delete button par dobara click karke
    checkbox uncheck kiya ja sakta hai.
    */
    pointer-events: none;
}

.photo-deleted-label i {
    font-size: 20px;
    color: #fca5a5;
}

.photo-deleted-label p {
    margin: 6px 0 0;
    color: #fecaca;
    font-size: 11px;
    font-weight: 700;
}

.existing-photo-card.photo-marked-delete {
    opacity: .65;
    box-shadow: 0 0 0 2px rgba(220, 38, 38, .3);
}


/* =========================================================
   NO PHOTOS
========================================================= */

.no-photos-box {
    padding: 42px 20px;
    text-align: center;
    border: 1px dashed #dce1e7;
    border-radius: 14px;
    background: #fafbfc;
}

.no-photos-icon {
    width: 54px;
    height: 54px;
    margin: 0 auto 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    background: #f1f3f5;
    color: #9ca3af;
    font-size: 19px;
}

.no-photos-box p {
    color: #4b5563;
    font-size: 13px;
}

.no-photos-box small {
    color: #9ca3af;
    font-size: 11px;
}


/* =========================================================
   PHOTO UPLOAD
========================================================= */

.photo-upload-box {
    min-height: 225px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px 20px;
    text-align: center;
    border: 2px dashed #dfe4ea;
    border-radius: 15px;
    background: #fafbfc;
    cursor: pointer;
    transition: all .25s ease;
}

.photo-upload-box:hover {
    border-color: #c084fc;
    background: #fcfaff;
}

.photo-upload-icon {
    width: 60px;
    height: 60px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    background: #f3e8ff;
    color: #9333ea;
    font-size: 22px;
    transition: transform .25s ease;
}

.photo-upload-box:hover .photo-upload-icon {
    transform: scale(1.06);
}

.photo-upload-box h6 {
    margin-bottom: 7px;
    color: #1f2937;
    font-size: 14px;
    font-weight: 700;
}

.photo-upload-box p {
    margin-bottom: 3px;
    color: #6b7280;
    font-size: 12px;
}

.photo-upload-box small {
    color: #9ca3af;
    font-size: 11px;
}


/* =========================================================
   NEW PHOTO PREVIEW
========================================================= */

.new-photo-preview {
    position: relative;
    height: 130px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    border-radius: 11px;
    background: #f8fafc;
}

.new-photo-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.new-photo-preview-name {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 7px 8px;
    background: rgba(17, 24, 39, .72);
    color: #ffffff;
    font-size: 10px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}


/* =========================================================
   STATUS CARDS
========================================================= */

.property-status-card {
    min-height: 68px;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: 11px;
    border: 1px solid;
}

.property-status-card-icon {
    width: 34px;
    height: 34px;
    min-width: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

.property-status-card strong {
    display: block;
    font-size: 13px;
}

.property-status-card small {
    display: block;
    margin-top: 3px;
    color: #8a93a1;
    font-size: 10px;
}

.property-status-card.approved {
    background: #f0fdf4;
    border-color: #bbf7d0;
}

.property-status-card.approved .property-status-card-icon {
    background: #dcfce7;
    color: #16a34a;
}

.property-status-card.approved strong {
    color: #15803d;
}

.property-status-card.rejected {
    background: #fef2f2;
    border-color: #fecaca;
}

.property-status-card.rejected .property-status-card-icon {
    background: #fee2e2;
    color: #dc2626;
}

.property-status-card.rejected strong {
    color: #b91c1c;
}

.property-status-card.pending {
    background: #fffbeb;
    border-color: #fde68a;
}

.property-status-card.pending .property-status-card-icon {
    background: #fef3c7;
    color: #d97706;
}

.property-status-card.pending strong {
    color: #b45309;
}

.property-status-card.neutral {
    background: #f8fafc;
    border-color: #e5e7eb;
}

.property-status-card.neutral .property-status-card-icon {
    background: #f1f5f9;
    color: #64748b;
}

.property-status-card.neutral strong {
    color: #475569;
}


/* =========================================================
   FEATURED PROPERTY
========================================================= */

.featured-property-option {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px;
    border: 1px solid #e1e5eb;
    border-radius: 11px;
    background: #ffffff;
    cursor: pointer;
    transition: all .2s ease;
}

.featured-property-option:hover {
    border-color: #c084fc;
    background: #fcfaff;
}

.featured-property-option input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.featured-checkbox {
    width: 20px;
    height: 20px;
    min-width: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    background: #ffffff;
    color: #ffffff;
    font-size: 10px;
    transition: all .2s ease;
}

.featured-property-option input:checked + .featured-checkbox {
    border-color: #9333ea;
    background: #9333ea;
}

.featured-property-option strong {
    display: block;
    color: #374151;
    font-size: 13px;
}

.featured-property-option small {
    display: block;
    margin-top: 5px;
    color: #8a93a1;
    font-size: 11px;
    line-height: 1.5;
}


/* =========================================================
   ACTION BUTTONS
========================================================= */

.property-form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 22px;
}

.property-cancel-btn,
.property-save-btn {
    min-height: 45px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .2s ease;
}

.property-cancel-btn {
    border: 1px solid #dfe4ea;
    background: #ffffff;
    color: #4b5563;
}

.property-cancel-btn:hover {
    background: #f5f6f8;
    color: #1f2937;
}

.property-save-btn {
    border: 1px solid #9333ea;
    background: #9333ea;
    color: #ffffff;
    box-shadow: 0 5px 14px rgba(147, 51, 234, .18);
}

.property-save-btn:hover {
    border-color: #7e22ce;
    background: #7e22ce;
    color: #ffffff;
    transform: translateY(-1px);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 767.98px) {

    .property-form-header {
        padding: 17px;
    }

    .property-form-body {
        padding: 17px;
    }

    .property-form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .property-cancel-btn,
    .property-save-btn {
        width: 100%;
    }

    .existing-photo-card {
        height: 125px;
    }

    .property-back-btn {
        width: auto;
    }

}

</style>


{{-- =========================================================
     PHOTO PREVIEW + DELETE SCRIPT
========================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('photos');
    const preview = document.getElementById('photoPreview');


    /*
    |--------------------------------------------------------------------------
    | NEW PHOTO PREVIEW
    |--------------------------------------------------------------------------
    */

    if (input && preview) {

        input.addEventListener('change', function () {

            preview.innerHTML = '';

            const files = Array.from(this.files);


            files.forEach(function (file) {

                if (!file.type.startsWith('image/')) {
                    return;
                }


                const reader = new FileReader();


                reader.onload = function (event) {

                    const column = document.createElement('div');

                    column.className =
                        'col-6 col-sm-4 col-md-3 col-lg-2';


                    const wrapper = document.createElement('div');

                    wrapper.className =
                        'new-photo-preview';


                    const image = document.createElement('img');

                    image.src = event.target.result;


                    const overlay = document.createElement('div');

                    overlay.className =
                        'new-photo-preview-name';

                    overlay.textContent = file.name;


                    wrapper.appendChild(image);

                    wrapper.appendChild(overlay);

                    column.appendChild(wrapper);

                    preview.appendChild(column);

                };


                reader.readAsDataURL(file);

            });

        });

    }

});


/*
|--------------------------------------------------------------------------
| EXISTING PHOTO DELETE / UNDELETE TOGGLE
|--------------------------------------------------------------------------
*/

function togglePhotoDelete(checkbox) {

    const photoWrapper =
        checkbox.closest('.existing-photo-card');


    if (!photoWrapper) {
        return;
    }


    const deletedLabel =
        photoWrapper.querySelector('.photo-deleted-label');


    if (checkbox.checked) {

        /*
        |--------------------------------------------------------------
        | PHOTO MARKED FOR DELETION
        |--------------------------------------------------------------
        */

        photoWrapper.classList.add(
            'photo-marked-delete'
        );


        if (deletedLabel) {

            deletedLabel.style.display = 'flex';

        }


    } else {

        /*
        |--------------------------------------------------------------
        | PHOTO RESTORED / UNSELECTED
        |--------------------------------------------------------------
        */

        photoWrapper.classList.remove(
            'photo-marked-delete'
        );


        if (deletedLabel) {

            deletedLabel.style.display = 'none';

        }

    }

}

</script>

@endsection