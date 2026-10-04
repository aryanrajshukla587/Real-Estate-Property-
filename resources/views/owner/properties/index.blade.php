@extends('layouts.app')

@section('title', 'My Properties')

@section('content')

<div class="owner-properties-page">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 col-xs-12 text-center">

                <div
                    class="section-top-title wow fadeInRight"
                    data-wow-duration="1s"
                    data-wow-delay="0.3s"
                    data-wow-offset="0"
                >
                    <h1>My Properties</h1>

                    <p>
                        Manage all properties added by you.
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}
    <section class="owner-properties-content">

        <div class="container">


            {{-- =================================================
                 FILTER CARD
            ================================================== --}}
            <div class="properties-filter-card">

                <form
                    action="{{ route('owner.properties.index') }}"
                    method="GET"
                >

                    <div class="properties-filter-grid">


                        {{-- SEARCH --}}
                        <div class="property-filter-field search-field">

                            <label for="property-search">
                                Search Property
                            </label>

                            <div class="property-search-wrapper">

                                <i class="fa-solid fa-magnifying-glass"></i>

                                <input
                                    id="property-search"
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search by property title..."
                                >

                            </div>

                        </div>


                        {{-- PROPERTY TYPE --}}
                        <div class="property-filter-field">

                            <label for="property-type">
                                Property Type
                            </label>

                            <select
                                id="property-type"
                                name="property_type_id"
                            >

                                <option value="">
                                    All Types
                                </option>

                                @foreach($propertyTypes as $type)

                                    <option
                                        value="{{ $type->id }}"
                                        {{ (string) request('property_type_id') === (string) $type->id ? 'selected' : '' }}
                                    >
                                        {{ $type->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- LOCATION --}}
                        <div class="property-filter-field">

                            <label for="property-location">
                                Location
                            </label>

                            <select
                                id="property-location"
                                name="location_id"
                            >

                                <option value="">
                                    All Locations
                                </option>

                                @foreach($locations as $location)

                                    <option
                                        value="{{ $location->id }}"
                                        {{ (string) request('location_id') === (string) $location->id ? 'selected' : '' }}
                                    >
                                        {{ $location->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- STATUS --}}
                        <div class="property-filter-field">

                            <label for="property-status">
                                Status
                            </label>

                            <select
                                id="property-status"
                                name="status"
                            >

                                <option value="">
                                    All Status
                                </option>

                                <option
                                    value="available"
                                    {{ request('status') === 'available' ? 'selected' : '' }}
                                >
                                    Available
                                </option>

                                <option
                                    value="sold"
                                    {{ request('status') === 'sold' ? 'selected' : '' }}
                                >
                                    Sold
                                </option>

                                <option
                                    value="rented"
                                    {{ request('status') === 'rented' ? 'selected' : '' }}
                                >
                                    Rented
                                </option>

                            </select>

                        </div>


                        {{-- PURPOSE --}}
                        <div class="property-filter-field">

                            <label for="property-purpose">
                                Purpose
                            </label>

                            <select
                                id="property-purpose"
                                name="purpose"
                            >

                                <option value="">
                                    All Purpose
                                </option>

                                <option
                                    value="sale"
                                    {{ request('purpose') === 'sale' ? 'selected' : '' }}
                                >
                                    For Sale
                                </option>

                                <option
                                    value="rent"
                                    {{ request('purpose') === 'rent' ? 'selected' : '' }}
                                >
                                    For Rent
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- FILTER BUTTONS --}}
                    <div class="properties-filter-actions">

                        <button
                            type="submit"
                            class="properties-apply-btn"
                        >
                            <i class="fa-solid fa-filter"></i>
                            Apply Filters
                        </button>

                        <a
                            href="{{ route('owner.properties.index') }}"
                            class="properties-reset-btn"
                        >
                            <i class="fa-solid fa-rotate-left"></i>
                            Reset
                        </a>

                    </div>

                </form>

            </div>


            {{-- =================================================
                 RESULT BAR
            ================================================== --}}
            <div class="properties-result-bar">

                <div class="properties-result-info">

                    <h3>
                        My Properties
                    </h3>

                    <p>
                        Showing
                        <strong>{{ $properties->total() }}</strong>
                        {{ $properties->total() == 1 ? 'property' : 'properties' }}
                    </p>

                </div>


                <div class="properties-result-actions">

                    {{-- BACK TO DASHBOARD --}}
                    <a
                        href="{{ route('owner.dashboard') }}"
                        class="back-dashboard-btn"
                    >
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to Dashboard
                    </a>


                    {{-- ADD PROPERTY --}}
                    <a
                        href="{{ route('owner.properties.create') }}"
                        class="add-property-btn"
                    >
                        <i class="fa-solid fa-plus"></i>
                        Add Property
                    </a>

                </div>

            </div>


            {{-- =================================================
                 PROPERTY TABLE
            ================================================== --}}
            <div class="properties-table-card">

                @if($properties->count())

                    <div class="table-responsive">

                        <table class="table properties-table align-middle">

                            <thead>

                                <tr>
                                    <th>Property</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    <th>Purpose</th>
                                    <th>Price</th>
                                    <th>Availability</th>
                                    <th>Assigned Agent</th>
                                    <th>Approval</th>
                                    <th>Visibility</th>
                                    <th class="text-center">Action</th>
                                </tr>

                            </thead>


                            <tbody>

                                @foreach($properties as $property)

                                    <tr>

                                        {{-- PROPERTY --}}
                                        <td>

                                            <div class="property-info">

                                                <div class="property-image">

                                                    @if(!empty($property->photos) && isset($property->photos[0]))

                                                        <img
                                                            src="{{ asset('storage/' . $property->photos[0]) }}"
                                                            alt="{{ $property->title }}"
                                                        >

                                                    @else

                                                        <div class="property-image-placeholder">
                                                            <i class="fa-solid fa-house"></i>
                                                        </div>

                                                    @endif

                                                </div>


                                                <div class="property-details">

                                                    <a
                                                        href="{{ route('owner.properties.show', $property) }}"
                                                        class="property-title"
                                                    >
                                                        {{ $property->title }}
                                                    </a>

                                                    <span class="property-id">
                                                        Property #{{ $property->id }}
                                                    </span>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- TYPE --}}
                                        <td>
                                            <span class="table-text">
                                                {{ $property->propertyType->name ?? 'N/A' }}
                                            </span>
                                        </td>


                                        {{-- LOCATION --}}
                                        <td>
                                            <span class="table-text">
                                                {{ $property->location->name ?? 'N/A' }}
                                            </span>
                                        </td>


                                        {{-- PURPOSE --}}
                                        <td>

                                            @if($property->purpose === 'sale')

                                                <span class="purpose-badge purpose-sale">
                                                    <i class="fa-solid fa-tag"></i>
                                                    For Sale
                                                </span>

                                            @elseif($property->purpose === 'rent')

                                                <span class="purpose-badge purpose-rent">
                                                    <i class="fa-solid fa-key"></i>
                                                    For Rent
                                                </span>

                                            @else

                                                <span class="purpose-badge purpose-other">
                                                    {{ ucfirst($property->purpose ?? 'N/A') }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- PRICE --}}
                                        <td>

                                            <div class="property-price">

                                                @if($property->price !== null)

                                                    ₹{{ number_format((float) $property->price, 0) }}

                                                @else

                                                    <span class="text-muted">
                                                        N/A
                                                    </span>

                                                @endif

                                            </div>

                                        </td>


                                        {{-- AVAILABILITY --}}
                                        <td>

                                            @if($property->status === 'available')

                                                <span class="status-badge status-available">
                                                    <span class="status-dot"></span>
                                                    Available
                                                </span>

                                            @elseif($property->status === 'sold')

                                                <span class="status-badge status-sold">
                                                    <span class="status-dot"></span>
                                                    Sold
                                                </span>

                                            @elseif($property->status === 'rented')

                                                <span class="status-badge status-rented">
                                                    <span class="status-dot"></span>
                                                    Rented
                                                </span>

                                            @else

                                                <span class="status-badge status-other">
                                                    {{ ucfirst($property->status ?? 'N/A') }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- ASSIGNED AGENT --}}
                                        <td>

                                            @if($property->agent)

                                                <div class="agent-info">

                                                    <div class="agent-avatar">
                                                        {{ strtoupper(substr($property->agent->name, 0, 1)) }}
                                                    </div>

                                                    <div class="agent-details">

                                                        <span class="agent-name">
                                                            {{ $property->agent->name }}
                                                        </span>

                                                    </div>

                                                </div>

                                            @else

                                                <span class="not-assigned">
                                                    <i class="fa-solid fa-user-slash"></i>
                                                    Not Assigned
                                                </span>

                                            @endif

                                        </td>


                                        {{-- APPROVAL --}}
                                        <td>

                                            @if($property->approval_status === 'approved')

                                                <span class="approval-badge approval-approved">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    Approved
                                                </span>

                                            @elseif($property->approval_status === 'pending')

                                                <span class="approval-badge approval-pending">
                                                    <i class="fa-solid fa-clock"></i>
                                                    Pending
                                                </span>

                                            @elseif($property->approval_status === 'rejected')

                                                <span class="approval-badge approval-rejected">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                    Rejected
                                                </span>

                                            @else

                                                <span class="approval-badge approval-other">
                                                    {{ ucfirst($property->approval_status ?? 'N/A') }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- VISIBILITY --}}
                                        <td>

                                            @if(
                                                $property->approval_status === 'approved' &&
                                                $property->is_active &&
                                                $property->status === 'available'
                                            )

                                                <div class="visibility-status visibility-public">

                                                    <i class="fa-solid fa-globe"></i>

                                                    <div>
                                                        <strong>Live on Website</strong>
                                                        <small>Publicly visible</small>
                                                    </div>

                                                </div>

                                            @elseif($property->approval_status === 'pending')

                                                <div class="visibility-status visibility-pending">

                                                    <i class="fa-solid fa-hourglass-half"></i>

                                                    <div>
                                                        <strong>Under Review</strong>
                                                        <small>Not public</small>
                                                    </div>

                                                </div>

                                            @elseif($property->approval_status === 'rejected')

                                                <div class="visibility-status visibility-rejected">

                                                    <i class="fa-solid fa-eye-slash"></i>

                                                    <div>
                                                        <strong>Not Published</strong>
                                                        <small>Approval rejected</small>
                                                    </div>

                                                </div>

                                            @elseif(
                                                $property->approval_status === 'approved' &&
                                                $property->status !== 'available'
                                            )

                                                <div class="visibility-status visibility-unavailable">

                                                    <i class="fa-solid fa-eye-slash"></i>

                                                    <div>
                                                        <strong>Not Public</strong>
                                                        <small>Sold or Rented</small>
                                                    </div>

                                                </div>

                                            @else

                                                <div class="visibility-status visibility-inactive">

                                                    <i class="fa-solid fa-eye-slash"></i>

                                                    <div>
                                                        <strong>Inactive</strong>
                                                        <small>Admin controlled</small>
                                                    </div>

                                                </div>

                                            @endif

                                        </td>


                                        {{-- ACTION --}}
                                        <td>

                                            <div class="property-actions">

                                                <a
                                                    href="{{ route('owner.properties.show', $property) }}"
                                                    class="property-action-btn view-btn"
                                                    title="View Property"
                                                >
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>

                                                <a
                                                    href="{{ route('owner.properties.edit', $property) }}"
                                                    class="property-action-btn edit-btn"
                                                    title="Edit Property"
                                                >
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    {{-- =================================================
                         EMPTY STATE
                    ================================================== --}}
                    <div class="properties-empty-state">

                        <div class="empty-icon">
                            <i class="fa-solid fa-house-circle-exclamation"></i>
                        </div>

                        <h3>
                            No Properties Found
                        </h3>

                        <p>

                            @if(request()->hasAny([
                                'search',
                                'property_type_id',
                                'location_id',
                                'status',
                                'purpose'
                            ]))

                                No properties match your current filters.

                            @else

                                You have not added any properties yet.

                            @endif

                        </p>


                        @if(request()->hasAny([
                            'search',
                            'property_type_id',
                            'location_id',
                            'status',
                            'purpose'
                        ]))

                            <a
                                href="{{ route('owner.properties.index') }}"
                                class="reset-empty-btn"
                            >
                                <i class="fa-solid fa-rotate-left"></i>
                                Clear Filters
                            </a>

                        @else

                            <a
                                href="{{ route('owner.properties.create') }}"
                                class="reset-empty-btn"
                            >
                                <i class="fa-solid fa-plus"></i>
                                Add Your First Property
                            </a>

                        @endif

                    </div>

                @endif

            </div>


            {{-- =================================================
                 PAGINATION
            ================================================== --}}
            @if($properties->hasPages())

                <div class="properties-pagination">

                    {{ $properties->withQueryString()->links() }}

                </div>

            @endif

        </div>

    </section>

</div>


<style>

    /* =========================================================
       PAGE
    ========================================================== */

    .owner-properties-page {
        width: 100%;
        min-height: 100vh;
        background: #f7f8fb;
    }


    /* =========================================================
       THEME HEADER
    ========================================================== */

    .owner-properties-page .section-top {
        width: 100%;
    }

    .owner-properties-page .section-top-title h1 {
        margin-bottom: 8px;
    }

    .owner-properties-page .section-top-title p {
        margin-bottom: 0;
    }


    /* =========================================================
       CONTENT
    ========================================================== */

    .owner-properties-content {
        width: 100%;
        padding: 42px 0 60px;
    }


    /* =========================================================
       FILTER CARD
    ========================================================== */

    .properties-filter-card {
        width: 100%;
        padding: 24px;
        margin-bottom: 28px;
        background: #ffffff;
        border: 1px solid #e8ebf0;
        border-radius: 14px;
        box-shadow: 0 5px 20px rgba(23, 32, 51, 0.04);
    }


    /* =========================================================
       FILTER GRID
    ========================================================== */

    .properties-filter-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
        gap: 18px;
        width: 100%;
    }


    /* =========================================================
       FILTER FIELD
    ========================================================== */

    .property-filter-field {
        min-width: 0;
        width: 100%;
    }

    .property-filter-field label {
        display: block;
        width: 100%;
        margin: 0 0 8px;
        color: #273142;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.4;
    }


    /* =========================================================
       SEARCH
    ========================================================== */

    .property-search-wrapper {
        position: relative;
        width: 100%;
    }

    .property-search-wrapper > i {
        position: absolute;
        top: 50%;
        left: 14px;
        z-index: 2;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 13px;
        pointer-events: none;
    }

    .property-search-wrapper input {
        display: block;
        width: 100%;
        height: 44px;
        margin: 0;
        padding: 0 14px 0 39px;
        background: #ffffff;
        border: 1px solid #dfe4ea;
        border-radius: 8px;
        outline: none;
        color: #374151;
        font-family: inherit;
        font-size: 13px;
        line-height: 44px;
        box-sizing: border-box;
        box-shadow: none;
    }

    .property-search-wrapper input::placeholder {
        color: #9ca3af;
    }

    .property-search-wrapper input:focus {
        border-color: #9333ea;
        box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.08);
    }


    /* =========================================================
       SELECTS
       Completely scoped to this page
    ========================================================== */

    .property-filter-field select {
        display: block;
        width: 100%;
        height: 44px;
        min-height: 44px;
        margin: 0;
        padding: 0 38px 0 13px;

        background-color: #ffffff;
        background-image:
            linear-gradient(45deg, transparent 50%, #6b7280 50%),
            linear-gradient(135deg, #6b7280 50%, transparent 50%);
        background-position:
            calc(100% - 16px) 18px,
            calc(100% - 11px) 18px;
        background-size: 5px 5px, 5px 5px;
        background-repeat: no-repeat;

        border: 1px solid #dfe4ea;
        border-radius: 8px;

        outline: none;
        color: #374151;
        font-family: inherit;
        font-size: 13px;
        font-weight: 400;

        line-height: 44px;
        box-sizing: border-box;

        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;

        box-shadow: none;
    }

    .property-filter-field select:hover {
        border-color: #cfd5dd;
    }

    .property-filter-field select:focus {
        border-color: #9333ea;
        box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.08);
    }

    .property-filter-field select option {
        padding: 8px 12px;
        background: #ffffff;
        color: #374151;
        font-family: inherit;
        font-size: 13px;
        font-weight: 400;
    }


    /* =========================================================
       FILTER ACTIONS
    ========================================================== */

    .properties-filter-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
    }

    .properties-apply-btn,
    .properties-reset-btn {
        height: 42px;
        min-height: 42px;
        padding: 0 17px;
        border-radius: 8px;

        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        font-family: inherit;
        font-size: 13px;
        font-weight: 600;

        text-decoration: none;
        white-space: nowrap;

        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .properties-apply-btn {
        border: 1px solid #9333ea;
        background: #9333ea;
        color: #ffffff;
        cursor: pointer;
    }

    .properties-apply-btn:hover {
        border-color: #7e22ce;
        background: #7e22ce;
        color: #ffffff;
    }

    .properties-reset-btn {
        border: 1px solid #dfe4ea;
        background: #ffffff;
        color: #4b5563;
    }

    .properties-reset-btn:hover {
        border-color: #cfd5dd;
        background: #f8fafc;
        color: #1f2937;
    }


    /* =========================================================
       RESULT BAR
    ========================================================== */

    .properties-result-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 18px;
    }

    .properties-result-info {
        min-width: 0;
    }

    .properties-result-info h3 {
        margin: 0 0 4px;
        color: #172033;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.3;
    }

    .properties-result-info p {
        margin: 0;
        color: #6b7280;
        font-size: 13px;
        line-height: 1.5;
    }

    .properties-result-info p strong {
        color: #374151;
        font-weight: 700;
    }


    /* =========================================================
       RESULT ACTIONS
    ========================================================== */

    .properties-result-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }


    /* BACK TO DASHBOARD */

    .back-dashboard-btn {
        height: 42px;
        min-height: 42px;
        padding: 0 16px;

        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        border: 1px solid #dfe4ea;
        border-radius: 8px;

        background: #ffffff;
        color: #4b5563;

        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;

        transition: all 0.2s ease;
    }

    .back-dashboard-btn:hover {
        background: #f8fafc;
        border-color: #cbd2da;
        color: #1f2937;
        transform: translateY(-1px);
    }


    /* ADD PROPERTY */

    .add-property-btn {
        height: 42px;
        min-height: 42px;
        padding: 0 17px;

        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        border: 1px solid #9333ea;
        border-radius: 8px;

        background: #9333ea;
        color: #ffffff;

        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;

        transition: all 0.2s ease;
    }

    .add-property-btn:hover {
        background: #7e22ce;
        border-color: #7e22ce;
        color: #ffffff;
        transform: translateY(-1px);
    }


    /* =========================================================
       TABLE CARD
    ========================================================== */

    .properties-table-card {
        width: 100%;
        overflow: hidden;

        background: #ffffff;
        border: 1px solid #e9edf3;
        border-radius: 14px;

        box-shadow: 0 5px 20px rgba(23, 32, 51, 0.04);
    }

    .properties-table {
        min-width: 1250px;
        margin: 0;
    }

    .properties-table thead th {
        padding: 15px 16px;
        background: #f8f9fb;
        border-bottom: 1px solid #e7ebf0;

        color: #6b7280;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        white-space: nowrap;
    }

    .properties-table tbody td {
        padding: 17px 16px;
        border-bottom: 1px solid #edf0f3;

        color: #374151;
        font-size: 13px;
        vertical-align: middle;
    }

    .properties-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .properties-table tbody tr {
        transition: background 0.2s ease;
    }

    .properties-table tbody tr:hover {
        background: #fcfcfd;
    }


    /* =========================================================
       PROPERTY
    ========================================================== */

    .property-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 230px;
    }

    .property-image {
        width: 58px;
        height: 58px;
        flex: 0 0 58px;

        overflow: hidden;
        border-radius: 9px;
        background: #f1f3f6;
    }

    .property-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .property-image-placeholder {
        width: 100%;
        height: 100%;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #9ca3af;
        font-size: 19px;
    }

    .property-details {
        min-width: 0;
    }

    .property-title {
        display: block;
        max-width: 190px;

        overflow: hidden;

        color: #1f2937;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.35;

        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .property-title:hover {
        color: #9333ea;
    }

    .property-id {
        display: block;
        margin-top: 3px;
        color: #9ca3af;
        font-size: 11px;
    }

    .table-text {
        color: #4b5563;
        white-space: nowrap;
    }

    .property-price {
        color: #172033;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================================
       PURPOSE
    ========================================================== */

    .purpose-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;

        padding: 6px 9px;

        border-radius: 6px;

        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .purpose-sale {
        background: #f3e8ff;
        color: #7e22ce;
    }

    .purpose-rent {
        background: #ede9fe;
        color: #6d28d9;
    }

    .purpose-other {
        background: #f3f4f6;
        color: #6b7280;
    }


    /* =========================================================
       STATUS
    ========================================================== */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 6px 9px;

        border-radius: 6px;

        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-available {
        background: #ecfdf3;
        color: #15803d;
    }

    .status-sold {
        background: #fef2f2;
        color: #dc2626;
    }

    .status-rented {
        background: #fff7ed;
        color: #ea580c;
    }

    .status-other {
        background: #f3f4f6;
        color: #6b7280;
    }


    /* =========================================================
       AGENT
    ========================================================== */

    .agent-info {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 145px;
    }

    .agent-avatar {
        width: 30px;
        height: 30px;
        flex: 0 0 30px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;
        background: #f3e8ff;
        color: #7e22ce;

        font-size: 11px;
        font-weight: 700;
    }

    .agent-details {
        min-width: 0;
    }

    .agent-name {
        display: block;
        max-width: 105px;

        overflow: hidden;

        color: #374151;
        font-size: 12px;
        font-weight: 600;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .not-assigned {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        color: #9ca3af;
        font-size: 12px;
        white-space: nowrap;
    }


    /* =========================================================
       APPROVAL
    ========================================================== */

    .approval-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 6px 9px;

        border-radius: 6px;

        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .approval-approved {
        background: #ecfdf3;
        color: #15803d;
    }

    .approval-pending {
        background: #fffbeb;
        color: #b45309;
    }

    .approval-rejected {
        background: #fef2f2;
        color: #dc2626;
    }

    .approval-other {
        background: #f3f4f6;
        color: #6b7280;
    }


    /* =========================================================
       VISIBILITY
    ========================================================== */

    .visibility-status {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 125px;
    }

    .visibility-status > i {
        width: 28px;
        height: 28px;
        flex: 0 0 28px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 7px;
        font-size: 11px;
    }

    .visibility-status strong {
        display: block;
        font-size: 11px;
        font-weight: 700;
        line-height: 1.2;
    }

    .visibility-status small {
        display: block;
        margin-top: 2px;

        color: #9ca3af;
        font-size: 10px;
        line-height: 1.2;
        white-space: nowrap;
    }

    .visibility-public {
        color: #15803d;
    }

    .visibility-public > i {
        background: #ecfdf3;
        color: #15803d;
    }

    .visibility-pending {
        color: #b45309;
    }

    .visibility-pending > i {
        background: #fffbeb;
        color: #b45309;
    }

    .visibility-rejected {
        color: #dc2626;
    }

    .visibility-rejected > i {
        background: #fef2f2;
        color: #dc2626;
    }

    .visibility-unavailable,
    .visibility-inactive {
        color: #6b7280;
    }

    .visibility-unavailable > i,
    .visibility-inactive > i {
        background: #f3f4f6;
        color: #6b7280;
    }


    /* =========================================================
       ACTIONS
    ========================================================== */

    .property-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .property-action-btn {
        width: 32px;
        height: 32px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 7px;

        font-size: 12px;
        text-decoration: none;

        transition: all 0.2s ease;
    }

    .view-btn {
        background: #f3e8ff;
        color: #7e22ce;
    }

    .view-btn:hover {
        background: #e9d5ff;
        color: #6b21a8;
    }

    .edit-btn {
        background: #f3f4f6;
        color: #4b5563;
    }

    .edit-btn:hover {
        background: #e5e7eb;
        color: #1f2937;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .properties-empty-state {
        padding: 70px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 18px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;
        background: #f3e8ff;
        color: #9333ea;

        font-size: 27px;
    }

    .properties-empty-state h3 {
        margin: 0 0 8px;

        color: #172033;
        font-size: 20px;
        font-weight: 700;
    }

    .properties-empty-state p {
        max-width: 480px;
        margin: 0 auto 22px;

        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
    }

    .reset-empty-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        min-height: 42px;
        padding: 0 18px;

        border: 1px solid #9333ea;
        border-radius: 8px;

        background: #9333ea;
        color: #ffffff;

        font-size: 13px;
        font-weight: 600;
        text-decoration: none;

        transition: all 0.2s ease;
    }

    .reset-empty-btn:hover {
        background: #7e22ce;
        border-color: #7e22ce;
        color: #ffffff;
    }


    /* =========================================================
       PAGINATION
    ========================================================== */

    .properties-pagination {
        display: flex;
        justify-content: center;
        margin-top: 25px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1199.98px) {

        .properties-filter-grid {
            grid-template-columns: 1.5fr 1fr 1fr;
        }

        .search-field {
            grid-column: span 3;
        }

    }


    @media (max-width: 767.98px) {

        .owner-properties-content {
            padding: 30px 0 45px;
        }

        .properties-filter-card {
            padding: 18px;
            border-radius: 10px;
        }

        .properties-filter-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .search-field {
            grid-column: auto;
        }

        .properties-filter-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .properties-apply-btn,
        .properties-reset-btn {
            width: 100%;
        }

        .properties-result-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .properties-result-actions {
            width: 100%;
            justify-content: stretch;
        }

        .back-dashboard-btn,
        .add-property-btn {
            flex: 1;
        }

        .properties-table-card {
            border-radius: 10px;
        }

    }


    @media (max-width: 575.98px) {

        .owner-properties-content .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .properties-result-actions {
            flex-direction: column;
        }

        .back-dashboard-btn,
        .add-property-btn {
            width: 100%;
            flex: none;
        }

        .properties-empty-state {
            padding: 55px 18px;
        }

    }

</style>

@endsection
