@extends('layouts.app')

@section('title', 'Add Property')

@section('content')

<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 col-xs-12 text-center">
            <div
                class="section-top-title wow fadeInRight"
                data-wow-duration="1s"
                data-wow-delay="0.3s"
                data-wow-offset="0"
            >
                <h1>Add Property</h1>
                <p>Add a new property for Super Admin approval.</p>
            </div>
        </div>
    </div>
</section>

<style>
/* =========================================================
   ADD PROPERTY PAGE
========================================================= */

.owner-property-page {
    padding: 60px 0;
    background: #f8fafc;
    min-height: 700px;
}

/* =========================================================
   PAGE HEADER
========================================================= */

.property-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 25px;
}

.property-page-title h2 {
    margin: 0;
    color: #1e293b;
    font-size: 25px;
    font-weight: 700;
}

.property-page-title p {
    margin: 6px 0 0;
    color: #64748b;
    font-size: 14px;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 17px;
    border-radius: 9px;
    background: #ffffff;
    color: #475569;
    border: 1px solid #e2e8f0;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .2s ease;
    white-space: nowrap;
}

.back-btn:hover {
    background: #7c3aed;
    color: #ffffff;
    border-color: #7c3aed;
    text-decoration: none;
    transform: translateY(-1px);
}

/* =========================================================
   ALERTS
========================================================= */

.property-alert {
    border-radius: 11px;
    padding: 15px 18px;
    margin-bottom: 20px;
}

.property-error-alert {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #991b1b;
}

.property-error-alert h4 {
    margin: 0 0 7px;
    color: #991b1b;
    font-size: 14px;
    font-weight: 700;
}

.property-error-alert ul {
    margin: 0;
    padding-left: 20px;
    font-size: 13px;
}

.property-error-alert li {
    margin-bottom: 3px;
}

/* =========================================================
   APPROVAL NOTICE
========================================================= */

.approval-notice {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 17px 19px;
    margin-bottom: 25px;
    border-radius: 12px;
    background: #fffbeb;
    border: 1px solid #fde68a;
}

.approval-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #fef3c7;
    color: #d97706;
    font-size: 17px;
}

.approval-notice h4 {
    margin: 0;
    color: #92400e;
    font-size: 15px;
    font-weight: 700;
}

.approval-notice p {
    margin: 5px 0 0;
    color: #a16207;
    font-size: 13px;
    line-height: 1.6;
}

/* =========================================================
   FORM CARD
========================================================= */

.property-form-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 25px;
    box-shadow: 0 5px 20px rgba(15, 23, 42, .05);
}

.form-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 24px;
    border-bottom: 1px solid #e2e8f0;
}

.form-card-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #ede9fe;
    color: #7c3aed;
    font-size: 17px;
}

.form-card-icon.blue {
    background: #dbeafe;
    color: #2563eb;
}

.form-card-icon.pink {
    background: #fce7f3;
    color: #db2777;
}

.form-card-icon.orange {
    background: #ffedd5;
    color: #ea580c;
}

.form-card-header h3 {
    margin: 0;
    color: #1e293b;
    font-size: 18px;
    font-weight: 700;
}

.form-card-header p {
    margin: 3px 0 0;
    color: #64748b;
    font-size: 13px;
}

.form-card-body {
    padding: 24px;
}

/* =========================================================
   FORM GRID
========================================================= */

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.form-grid.four-columns {
    grid-template-columns: repeat(4, minmax(0, 1fr));
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    display: block;
    margin-bottom: 7px;
    color: #334155;
    font-size: 13px;
    font-weight: 600;
}

.required {
    color: #dc2626;
}

.optional {
    color: #94a3b8;
    font-size: 11px;
    font-weight: 500;
}

/* =========================================================
   INPUTS
========================================================= */

.form-control-custom,
.form-select-custom {
    width: 100%;
    min-height: 44px;
    padding: 10px 13px;
    border: 1px solid #dbe2ea;
    border-radius: 9px;
    background: #ffffff;
    color: #1e293b;
    font-size: 13px;
    outline: none;
    transition: all .2s ease;
}

.form-control-custom::placeholder {
    color: #94a3b8;
}

.form-control-custom:focus,
.form-select-custom:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(124, 58, 237, .10);
}

.form-select-custom {
    cursor: pointer;
}

.form-textarea {
    min-height: 135px;
    resize: vertical;
    line-height: 1.6;
}

/* =========================================================
   INPUT WITH ICON
========================================================= */

.input-icon-wrapper {
    position: relative;
}

.input-icon-wrapper .input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 13px;
    pointer-events: none;
}

.input-icon-wrapper .form-control-custom,
.input-icon-wrapper .form-select-custom {
    padding-left: 39px;
}

/* =========================================================
   PRICE
========================================================= */

.price-wrapper {
    position: relative;
}

.price-symbol {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-size: 14px;
    font-weight: 600;
    pointer-events: none;
}

.price-wrapper .form-control-custom {
    padding-left: 32px;
}

/* =========================================================
   AREA
========================================================= */

.area-wrapper {
    position: relative;
}

.area-unit {
    position: absolute;
    right: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 11px;
    pointer-events: none;
}

.area-wrapper .form-control-custom {
    padding-right: 62px;
}

/* =========================================================
   HELP TEXT
========================================================= */

.form-help {
    margin: 6px 0 0;
    color: #94a3b8;
    font-size: 11px;
    line-height: 1.5;
}

/* =========================================================
   PHOTO UPLOAD
========================================================= */

.photo-upload-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 190px;
    padding: 30px 20px;
    border: 2px dashed #dbe2ea;
    border-radius: 12px;
    background: #f8fafc;
    text-align: center;
    cursor: pointer;
    transition: all .2s ease;
}

.photo-upload-box:hover {
    border-color: #a78bfa;
    background: #faf5ff;
}

.photo-upload-icon {
    width: 58px;
    height: 58px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    border-radius: 14px;
    background: #ede9fe;
    color: #7c3aed;
    font-size: 22px;
    transition: transform .2s ease;
}

.photo-upload-box:hover .photo-upload-icon {
    transform: translateY(-2px);
}

.photo-upload-box h4 {
    margin: 0;
    color: #334155;
    font-size: 14px;
    font-weight: 700;
}

.photo-upload-box p {
    margin: 5px 0 0;
    color: #94a3b8;
    font-size: 12px;
}

.photo-upload-box .photo-limit {
    color: #cbd5e1;
    font-size: 11px;
}

#photos {
    display: none;
}

/* =========================================================
   PHOTO PREVIEW
========================================================= */

.photo-preview {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 12px;
    margin-top: 18px;
}

.photo-preview-item {
    position: relative;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    background: #ffffff;
}

.photo-preview-item img {
    display: block;
    width: 100%;
    height: 115px;
    object-fit: cover;
}

.photo-preview-name {
    padding: 7px 8px;
    color: #64748b;
    font-size: 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* =========================================================
   SETTING BOX
========================================================= */

.setting-box {
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 68px;
    padding: 12px 14px;
    border-radius: 10px;
}

.setting-box.pending {
    background: #fffbeb;
    border: 1px solid #fde68a;
}

.setting-box.hidden {
    background: #fef2f2;
    border: 1px solid #fecaca;
}

.setting-icon {
    width: 35px;
    height: 35px;
    min-width: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

.setting-box.pending .setting-icon {
    background: #fef3c7;
    color: #d97706;
}

.setting-box.hidden .setting-icon {
    background: #fee2e2;
    color: #dc2626;
}

.setting-content strong {
    display: block;
    font-size: 13px;
}

.setting-box.pending .setting-content strong {
    color: #92400e;
}

.setting-box.hidden .setting-content strong {
    color: #991b1b;
}

.setting-content span {
    display: block;
    margin-top: 2px;
    color: #94a3b8;
    font-size: 11px;
}

/* =========================================================
   FEATURED CHECKBOX
========================================================= */

.featured-option {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 14px;
    border-radius: 10px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
}

.featured-option input {
    width: 16px;
    height: 16px;
    margin-top: 2px;
    accent-color: #7c3aed;
}

.featured-option label {
    cursor: pointer;
}

.featured-title {
    display: block;
    color: #334155;
    font-size: 13px;
    font-weight: 600;
}

.featured-description {
    display: block;
    margin-top: 3px;
    color: #94a3b8;
    font-size: 11px;
    line-height: 1.5;
}

/* =========================================================
   FORM ACTIONS
========================================================= */

.form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 5px;
}

.form-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 44px;
    padding: 10px 20px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .2s ease;
}

.cancel-property-btn {
    background: #ffffff;
    color: #475569;
    border: 1px solid #dbe2ea;
}

.cancel-property-btn:hover {
    background: #f1f5f9;
    color: #334155;
    text-decoration: none;
}

.submit-property-btn {
    border: none;
    background: #7c3aed;
    color: #ffffff;
    cursor: pointer;
    box-shadow: 0 5px 14px rgba(124, 58, 237, .20);
}

.submit-property-btn:hover {
    background: #6d28d9;
    color: #ffffff;
    transform: translateY(-1px);
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991px) {

    .form-grid.four-columns {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .photo-preview {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }
}

@media (max-width: 767px) {

    .owner-property-page {
        padding: 40px 0;
    }

    .property-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .back-btn {
        width: 100%;
    }

    .form-grid,
    .form-grid.four-columns {
        grid-template-columns: 1fr;
    }

    .form-card-header,
    .form-card-body {
        padding: 18px;
    }

    .photo-preview {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .form-action-btn {
        width: 100%;
    }
}

@media (max-width: 575px) {

    .owner-property-page {
        padding: 30px 0;
    }

    .photo-preview {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .approval-notice {
        padding: 14px;
    }
}
</style>

<section class="owner-property-page">


<div class="container">

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="property-page-header">

        <div class="property-page-title">

            <h2>
                Add Property
            </h2>

            <p>
                Add a new property for Super Admin approval.
            </p>

        </div>

        <a
            href="{{ route('owner.dashboard') }}"
            class="back-btn"
        >
            <i class="fa fa-arrow-left"></i>
            Back to Dashboard
        </a>

    </div>


    {{-- =====================================================
         VALIDATION ERRORS
    ====================================================== --}}

    @if ($errors->any())

        <div class="property-alert property-error-alert">

            <h4>
                <i class="fa fa-exclamation-circle"></i>
                Please fix the following errors:
            </h4>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         APPROVAL INFORMATION
    ====================================================== --}}

    <div class="approval-notice">

        <div class="approval-icon">
            <i class="fa fa-clock-o"></i>
        </div>

        <div>

            <h4>
                Property Approval Required
            </h4>

            <p>
                After you submit this property, it will be reviewed by the
                Super Admin. The property will become visible on the website
                only after it is approved.
            </p>

        </div>

    </div>


    {{-- =====================================================
         MAIN FORM
    ====================================================== --}}

    <form
        action="{{ route('owner.properties.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- =================================================
             BASIC INFORMATION
        ================================================== --}}

        <div class="property-form-card">

            <div class="form-card-header">

                <div class="form-card-icon">
                    <i class="fa fa-home"></i>
                </div>

                <div>

                    <h3>
                        Basic Information
                    </h3>

                    <p>
                        Enter the main property details.
                    </p>

                </div>

            </div>


            <div class="form-card-body">

                <div class="form-grid">

                    {{-- TITLE --}}

                    <div class="form-group full-width">

                        <label class="form-label">
                            Property Title
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            placeholder="e.g. Luxury 3 BHK Apartment"
                            class="form-control-custom"
                        >

                    </div>


                    {{-- PROPERTY TYPE --}}

                    <div class="form-group">

                        <label class="form-label">
                            Property Type
                            <span class="required">*</span>
                        </label>

                        <select
                            name="property_type_id"
                            required
                            class="form-select-custom"
                        >

                            <option value="">
                                Select Property Type
                            </option>

                            @foreach ($propertyTypes as $type)

                                <option
                                    value="{{ $type->id }}"
                                    @selected(old('property_type_id') == $type->id)
                                >
                                    {{ $type->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- LOCATION --}}

                    <div class="form-group">

                        <label class="form-label">
                            Location
                            <span class="required">*</span>
                        </label>

                        <select
                            name="location_id"
                            required
                            class="form-select-custom"
                        >

                            <option value="">
                                Select Location
                            </option>

                            @foreach ($locations as $location)

                                <option
                                    value="{{ $location->id }}"
                                    @selected(old('location_id') == $location->id)
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

                    <div class="form-group">

                        <label class="form-label">
                            Assign Agent
                            <span class="optional">(Optional)</span>
                        </label>

                        <div class="input-icon-wrapper">

                            <i class="fa fa-user input-icon"></i>

                            <select
                                name="agent_id"
                                class="form-select-custom"
                            >

                                <option value="">
                                    No Agent Assigned
                                </option>

                                @foreach ($agents as $agent)

                                    <option
                                        value="{{ $agent->id }}"
                                        @selected(old('agent_id') == $agent->id)
                                    >
                                        {{ $agent->name }}

                                        @if (!empty($agent->email))
                                            — {{ $agent->email }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <p class="form-help">
                            You can optionally assign a registered Agent to manage this property.
                        </p>

                    </div>


                    {{-- PURPOSE --}}

                    <div class="form-group">

                        <label class="form-label">
                            Purpose
                            <span class="required">*</span>
                        </label>

                        <select
                            name="purpose"
                            required
                            class="form-select-custom"
                        >

                            <option value="">
                                Select Purpose
                            </option>

                            <option
                                value="sale"
                                @selected(old('purpose') === 'sale')
                            >
                                For Sale
                            </option>

                            <option
                                value="rent"
                                @selected(old('purpose') === 'rent')
                            >
                                For Rent
                            </option>

                        </select>

                    </div>


                    {{-- PRICE --}}

                    <div class="form-group">

                        <label class="form-label">
                            Price
                            <span class="required">*</span>
                        </label>

                        <div class="price-wrapper">

                            <span class="price-symbol">
                                ₹
                            </span>

                            <input
                                type="number"
                                name="price"
                                value="{{ old('price') }}"
                                min="0"
                                step="0.01"
                                required
                                placeholder="5000000"
                                class="form-control-custom"
                            >

                        </div>

                    </div>


                    {{-- ADDRESS --}}

                    <div class="form-group full-width">

                        <label class="form-label">
                            Address
                        </label>

                        <input
                            type="text"
                            name="address"
                            value="{{ old('address') }}"
                            placeholder="Enter complete property address"
                            class="form-control-custom"
                        >

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="form-group full-width">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="6"
                            placeholder="Write detailed information about this property..."
                            class="form-control-custom form-textarea"
                        >{{ old('description') }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
             PROPERTY DETAILS
        ================================================== --}}

        <div class="property-form-card">

            <div class="form-card-header">

                <div class="form-card-icon blue">
                    <i class="fa fa-list"></i>
                </div>

                <div>

                    <h3>
                        Property Details
                    </h3>

                    <p>
                        Add rooms, area and parking information.
                    </p>

                </div>

            </div>


            <div class="form-card-body">

                <div class="form-grid four-columns">

                    {{-- BEDROOMS --}}

                    <div class="form-group">

                        <label class="form-label">
                            Bedrooms
                        </label>

                        <div class="input-icon-wrapper">

                            <i class="fa fa-bed input-icon"></i>

                            <input
                                type="number"
                                name="bedrooms"
                                value="{{ old('bedrooms') }}"
                                min="0"
                                placeholder="3"
                                class="form-control-custom"
                            >

                        </div>

                    </div>


                    {{-- BATHROOMS --}}

                    <div class="form-group">

                        <label class="form-label">
                            Bathrooms
                        </label>

                        <div class="input-icon-wrapper">

                            <i class="fa fa-bath input-icon"></i>

                            <input
                                type="number"
                                name="bathrooms"
                                value="{{ old('bathrooms') }}"
                                min="0"
                                placeholder="2"
                                class="form-control-custom"
                            >

                        </div>

                    </div>


                    {{-- AREA --}}

                    <div class="form-group">

                        <label class="form-label">
                            Area
                        </label>

                        <div class="area-wrapper">

                            <input
                                type="number"
                                name="area"
                                value="{{ old('area') }}"
                                min="0"
                                step="0.01"
                                placeholder="1500"
                                class="form-control-custom"
                            >

                            <span class="area-unit">
                                sq.ft
                            </span>

                        </div>

                    </div>


                    {{-- GARAGES --}}

                    <div class="form-group">

                        <label class="form-label">
                            Garages
                        </label>

                        <div class="input-icon-wrapper">

                            <i class="fa fa-car input-icon"></i>

                            <input
                                type="number"
                                name="garages"
                                value="{{ old('garages') }}"
                                min="0"
                                placeholder="1"
                                class="form-control-custom"
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
             PROPERTY PHOTOS
        ================================================== --}}

        <div class="property-form-card">

            <div class="form-card-header">

                <div class="form-card-icon pink">
                    <i class="fa fa-picture-o"></i>
                </div>

                <div>

                    <h3>
                        Property Photos
                    </h3>

                    <p>
                        Upload multiple photos of your property.
                    </p>

                </div>

            </div>


            <div class="form-card-body">

                <label
                    for="photos"
                    class="photo-upload-box"
                >

                    <div class="photo-upload-icon">
                        <i class="fa fa-cloud-upload"></i>
                    </div>

                    <h4>
                        Click to upload property photos
                    </h4>

                    <p>
                        JPG, JPEG, PNG or WEBP
                    </p>

                    <p class="photo-limit">
                        Maximum 5MB per image
                    </p>

                    <input
                        id="photos"
                        type="file"
                        name="photos[]"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                    >

                </label>


                <div
                    id="photoPreview"
                    class="photo-preview"
                ></div>

            </div>

        </div>


        {{-- =================================================
             PROPERTY SETTINGS
        ================================================== --}}

        <div class="property-form-card">

            <div class="form-card-header">

                <div class="form-card-icon orange">
                    <i class="fa fa-sliders"></i>
                </div>

                <div>

                    <h3>
                        Property Settings
                    </h3>

                    <p>
                        Your property will be reviewed before going live.
                    </p>

                </div>

            </div>


            <div class="form-card-body">

                <div class="form-grid">


                    {{-- APPROVAL STATUS --}}

                    <div class="form-group">

                        <label class="form-label">
                            Approval Status
                        </label>

                        <div class="setting-box pending">

                            <div class="setting-icon">
                                <i class="fa fa-clock-o"></i>
                            </div>

                            <div class="setting-content">

                                <strong>
                                    Pending Approval
                                </strong>

                                <span>
                                    Super Admin will review this property.
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- VISIBILITY --}}

                    <div class="form-group">

                        <label class="form-label">
                            Website Visibility
                        </label>

                        <div class="setting-box hidden">

                            <div class="setting-icon">
                                <i class="fa fa-eye-slash"></i>
                            </div>

                            <div class="setting-content">

                                <strong>
                                    Not Visible Yet
                                </strong>

                                <span>
                                    It will become visible after approval.
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- FEATURED --}}

                    <div class="form-group full-width">

                        <div class="featured-option">

                            <input
                                id="is_featured"
                                type="checkbox"
                                name="is_featured"
                                value="1"
                                @checked(old('is_featured'))
                            >

                            <label for="is_featured">

                                <span class="featured-title">
                                    Featured Property
                                </span>

                                <span class="featured-description">
                                    Request this property to be shown as a featured listing.
                                    Final visibility is controlled by Super Admin.
                                </span>

                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
             ACTION BUTTONS
        ================================================== --}}

        <div class="form-actions">

            <a
                href="{{ route('owner.properties.index') }}"
                class="form-action-btn cancel-property-btn"
            >
                <i class="fa fa-times"></i>
                Cancel
            </a>


            <button
                type="submit"
                class="form-action-btn submit-property-btn"
            >
                <i class="fa fa-paper-plane"></i>
                Submit for Approval
            </button>

        </div>

    </form>

</div>


</section>

{{-- =========================================================
PHOTO PREVIEW SCRIPT
========================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('photos');
    const preview = document.getElementById('photoPreview');

    if (!input || !preview) {
        return;
    }


    input.addEventListener('change', function () {

        preview.innerHTML = '';

        const files = Array.from(this.files);


        files.forEach(function (file) {

            if (!file.type.startsWith('image/')) {
                return;
            }


            const reader = new FileReader();


            reader.onload = function (event) {

                const wrapper = document.createElement('div');

                wrapper.className = 'photo-preview-item';


                const image = document.createElement('img');

                image.src = event.target.result;

                image.alt = file.name;


                const name = document.createElement('div');

                name.className = 'photo-preview-name';

                name.textContent = file.name;


                wrapper.appendChild(image);
                wrapper.appendChild(name);

                preview.appendChild(wrapper);

            };


            reader.readAsDataURL(file);

        });

    });

});

</script>

@endsection
