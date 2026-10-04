@extends('layouts.app')

@section('title', 'Property Requests')

@section('content')


{{-- =========================================================
     PAGE TOP HEADER
     SAME AS OWNER DASHBOARD
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
                    Property Requests
                </h1>

                <p>
                    Manage purchase and rental requests received for your properties.
                </p>

            </div>

        </div>
    </div>
</section>


<style>

/* =========================================================
   OWNER REQUESTS PAGE
========================================================= */

.owner-requests-page {
    background: #f8fafc;
    min-height: 100vh;
    padding: 60px 0 50px;
}


/* =========================================================
   PAGE CONTENT HEADER
========================================================= */

.requests-header {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    padding: 22px 24px;
    box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
}

.requests-header-icon {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #6366f1, #7c3aed);
    color: #fff;
    box-shadow: 0 8px 20px rgba(99, 102, 241, 0.18);
    flex-shrink: 0;
}


/* =========================================================
   BACK TO DASHBOARD
========================================================= */

.back-dashboard-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 44px;
    padding: 0 16px;
    border-radius: 10px;
    background: #fff;
    border: 1px solid #dbe1ea;
    color: #475569;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    transition: all .2s ease;
    white-space: nowrap;
}

.back-dashboard-btn:hover {
    background: #f8fafc;
    color: #4f46e5;
    border-color: #c7d2fe;
    transform: translateY(-1px);
}


/* =========================================================
   STAT CARDS
========================================================= */

.request-stat-card {
    position: relative;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
    transition: all .25s ease;
}

.request-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
}

.request-stat-card::after {
    content: "";
    position: absolute;
    width: 90px;
    height: 90px;
    right: -35px;
    top: -35px;
    border-radius: 50%;
    opacity: .07;
}

.stat-purple::after {
    background: #7c3aed;
}

.stat-amber::after {
    background: #f59e0b;
}

.stat-green::after {
    background: #10b981;
}

.stat-cyan::after {
    background: #06b6d4;
}


/* =========================================================
   STAT ICON
========================================================= */

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-purple .stat-icon {
    background: #f3e8ff;
    color: #7c3aed;
}

.stat-amber .stat-icon {
    background: #fef3c7;
    color: #d97706;
}

.stat-green .stat-icon {
    background: #d1fae5;
    color: #059669;
}

.stat-cyan .stat-icon {
    background: #cffafe;
    color: #0891b2;
}


/* =========================================================
   FILTER CARD
========================================================= */

.request-filter-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
}

.request-filter-card .form-control,
.request-filter-card .form-select {
    min-height: 46px;
    border-radius: 10px;
    border: 1px solid #dbe1ea;
    background: #fff;
    color: #1f2937;
    font-size: 14px;
    box-shadow: none;
}

.request-filter-card .form-control:focus,
.request-filter-card .form-select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, .10);
}

.request-filter-card .form-control::placeholder {
    color: #9ca3af;
}

.filter-label {
    margin-bottom: 8px;
    display: block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: #6b7280;
}

.filter-search {
    position: relative;
}

.filter-search i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    pointer-events: none;
}

.filter-search .form-control {
    padding-left: 42px;
}

.filter-btn {
    min-height: 46px;
    border: 0;
    border-radius: 10px;
    padding: 0 18px;
    background: linear-gradient(135deg, #6366f1, #7c3aed);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    transition: all .2s ease;
}

.filter-btn:hover {
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 7px 16px rgba(99, 102, 241, .20);
}

.reset-btn {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    border: 1px solid #dbe1ea;
    background: #fff;
    color: #6b7280;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all .2s ease;
}

.reset-btn:hover {
    background: #f8fafc;
    color: #4f46e5;
    border-color: #c7d2fe;
}


/* =========================================================
   REQUEST TABLE CARD
========================================================= */

.requests-table-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
}

.requests-table-header {
    padding: 20px;
    border-bottom: 1px solid #edf0f4;
}

.requests-table-wrapper {
    overflow-x: auto;
}

.requests-table {
    width: 100%;
    min-width: 1400px;
    border-collapse: separate;
    border-spacing: 0;
}

.requests-table thead th {
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
    padding: 15px 20px;
    color: #6b7280;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .07em;
    text-align: left;
    white-space: nowrap;
}

.requests-table tbody td {
    padding: 19px 20px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
    color: #374151;
}

.requests-table tbody tr {
    transition: background .2s ease;
}

.requests-table tbody tr:hover {
    background: #fafaff;
}


/* =========================================================
   REQUEST NUMBER
========================================================= */

.request-number {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #f3f4f6;
    color: #6b7280;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
}


/* =========================================================
   PROPERTY THUMBNAIL
========================================================= */

.property-thumb {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    overflow: hidden;
    background: #f1f5f9;
    border: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: #6366f1;
}

.property-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}


/* =========================================================
   AVATARS
========================================================= */

.customer-avatar,
.agent-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
}

.customer-avatar {
    background: linear-gradient(135deg, #8b5cf6, #d946ef);
}

.agent-avatar {
    background: linear-gradient(135deg, #6366f1, #7c3aed);
}


/* =========================================================
   TYPE / STATUS BADGES
========================================================= */

.type-badge,
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    border-radius: 999px;
    padding: 7px 12px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.type-buy {
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #dbeafe;
}

.type-rent {
    background: #fdf2f8;
    color: #db2777;
    border: 1px solid #fce7f3;
}

.status-pending {
    background: #fffbeb;
    color: #d97706;
    border: 1px solid #fde68a;
}

.status-approved {
    background: #ecfdf5;
    color: #059669;
    border: 1px solid #a7f3d0;
}

.status-rejected {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.status-completed {
    background: #ecfeff;
    color: #0891b2;
    border: 1px solid #a5f3fc;
}

.status-cancelled {
    background: #f3f4f6;
    color: #6b7280;
    border: 1px solid #e5e7eb;
}


/* =========================================================
   AGENT LABEL
========================================================= */

.agent-label {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-top: 5px;
    padding: 3px 8px;
    border-radius: 999px;
    background: #eef2ff;
    color: #4f46e5;
    font-size: 10px;
    font-weight: 700;
}

.not-assigned-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f3f4f6;
    color: #9ca3af;
    display: flex;
    align-items: center;
    justify-content: center;
}


/* =========================================================
   VIEW BUTTON
========================================================= */

.request-view-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 14px;
    border-radius: 10px;
    background: #eef2ff;
    border: 1px solid #e0e7ff;
    color: #4f46e5;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: all .2s ease;
    white-space: nowrap;
}

.request-view-btn:hover {
    background: #e0e7ff;
    color: #4338ca;
    border-color: #c7d2fe;
    text-decoration: none;
}


/* =========================================================
   MOBILE REQUEST CARDS
========================================================= */

.mobile-request-card {
    padding: 20px;
    border-bottom: 1px solid #edf0f4;
}

.mobile-request-card:last-child {
    border-bottom: 0;
}

.mobile-property-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: #eef2ff;
    color: #6366f1;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.mobile-info-box {
    margin-top: 15px;
    padding: 14px;
    border-radius: 12px;
    border: 1px solid #edf0f4;
    background: #fafbfc;
}

.mobile-info-title {
    margin-bottom: 10px;
    color: #9ca3af;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
}


/* =========================================================
   MOBILE FINANCIAL BOX
========================================================= */

.mobile-finance-box {
    padding: 12px;
    border-radius: 11px;
    border: 1px solid #edf0f4;
    background: #fafbfc;
}

.mobile-finance-box.customer {
    background: #fffaf5;
    border-color: #ffedd5;
}

.mobile-finance-box.counter {
    background: #fff7ff;
    border-color: #fae8ff;
}

.mobile-finance-label {
    color: #9ca3af;
    font-size: 10px;
}

.mobile-finance-value {
    margin-top: 4px;
    color: #111827;
    font-size: 12px;
    font-weight: 700;
}

.mobile-finance-box.customer .mobile-finance-value {
    color: #ea580c;
}

.mobile-finance-box.counter .mobile-finance-value {
    color: #c026d3;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.requests-empty {
    padding: 70px 20px;
    text-align: center;
}

.requests-empty-icon {
    width: 72px;
    height: 72px;
    margin: 0 auto;
    border-radius: 20px;
    background: #eef2ff;
    color: #6366f1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}


/* =========================================================
   PAGINATION
========================================================= */

.requests-pagination {
    padding: 16px 20px;
    border-top: 1px solid #edf0f4;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1199.98px) {

    .desktop-request-table {
        display: none;
    }

}

@media (min-width: 1200px) {

    .mobile-request-cards {
        display: none;
    }

}

@media (max-width: 767.98px) {

    .owner-requests-page {
        padding: 40px 0 40px;
    }

    .requests-header {
        padding: 18px;
    }

    .requests-header .header-content {
        align-items: flex-start !important;
    }

    .requests-header .header-actions {
        width: 100%;
    }

    .back-dashboard-btn {
        width: 100%;
    }

}

@media (max-width: 575.98px) {

    .owner-requests-page {
        padding-top: 30px;
    }

    .requests-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
    }

    .request-stat-card {
        padding: 16px;
    }

    .request-filter-card {
        padding: 16px;
    }

    .requests-table-header {
        padding: 16px;
    }

}

</style>


{{-- =========================================================
     OWNER REQUESTS CONTENT
========================================================= --}}

<div class="owner-requests-page">

    <div class="container">


        {{-- =========================================================
             PAGE CONTENT HEADER
        ========================================================== --}}

        <div class="requests-header mb-4">

            <div class="header-content d-flex align-items-center justify-content-between gap-4 flex-wrap">


                {{-- LEFT --}}

                <div class="d-flex align-items-center gap-3">

                    <div class="requests-header-icon">

                        <i class="fa-solid fa-file-signature"></i>

                    </div>

                    <div>

                        <h2 class="mb-1 fw-bold text-dark">
                            Property Requests
                        </h2>

                        <p class="mb-0 text-muted">
                            Manage purchase and rental requests received for your properties.
                        </p>

                    </div>

                </div>


                {{-- RIGHT --}}

                <div class="header-actions">

                    <a
                        href="{{ route('owner.dashboard') }}"
                        class="back-dashboard-btn"
                    >

                        <i class="fa-solid fa-arrow-left"></i>

                        Back to Dashboard

                    </a>

                </div>

            </div>

        </div>


        {{-- =========================================================
             STAT CARDS
        ========================================================== --}}

        <div class="row g-3 mb-4">


            {{-- TOTAL --}}

            <div class="col-12 col-sm-6 col-xl-3">

                <div class="request-stat-card stat-purple h-100">

                    <div class="d-flex align-items-center justify-content-between position-relative">

                        <div>

                            <p class="mb-1 text-muted small fw-medium">
                                Total Requests
                            </p>

                            <p class="mb-0 fs-2 fw-bold text-dark">
                                {{ $totalTransactions }}
                            </p>

                        </div>

                        <div class="stat-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- PENDING --}}

            <div class="col-12 col-sm-6 col-xl-3">

                <div class="request-stat-card stat-amber h-100">

                    <div class="d-flex align-items-center justify-content-between position-relative">

                        <div>

                            <p class="mb-1 text-muted small fw-medium">
                                Pending
                            </p>

                            <p class="mb-0 fs-2 fw-bold text-warning">
                                {{ $pendingTransactions }}
                            </p>

                        </div>

                        <div class="stat-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- APPROVED --}}

            <div class="col-12 col-sm-6 col-xl-3">

                <div class="request-stat-card stat-green h-100">

                    <div class="d-flex align-items-center justify-content-between position-relative">

                        <div>

                            <p class="mb-1 text-muted small fw-medium">
                                Approved
                            </p>

                            <p class="mb-0 fs-2 fw-bold text-success">
                                {{ $approvedTransactions }}
                            </p>

                        </div>

                        <div class="stat-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- COMPLETED --}}

            <div class="col-12 col-sm-6 col-xl-3">

                <div class="request-stat-card stat-cyan h-100">

                    <div class="d-flex align-items-center justify-content-between position-relative">

                        <div>

                            <p class="mb-1 text-muted small fw-medium">
                                Completed
                            </p>

                            <p class="mb-0 fs-2 fw-bold text-info">
                                {{ $completedTransactions }}
                            </p>

                        </div>

                        <div class="stat-icon">
                            <i class="fa-solid fa-handshake"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             FILTER BAR
        ========================================================== --}}

        <div class="request-filter-card mb-4">

            <form
                action="{{ route('owner.property-transactions.index') }}"
                method="GET"
            >

                <div class="row g-3">


                    {{-- SEARCH --}}

                    <div class="col-12 col-lg-6">

                        <label class="filter-label">
                            Search Requests
                        </label>

                        <div class="filter-search">

                            <i class="fa-solid fa-magnifying-glass"></i>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Property, customer, email or phone..."
                                class="form-control"
                            >

                        </div>

                    </div>


                    {{-- TYPE --}}

                    <div class="col-12 col-sm-6 col-lg-2">

                        <label class="filter-label">
                            Type
                        </label>

                        <select name="type" class="form-select">

                            <option value="">
                                All Types
                            </option>

                            <option
                                value="buy"
                                @selected(request('type') === 'buy')
                            >
                                Buy
                            </option>

                            <option
                                value="rent"
                                @selected(request('type') === 'rent')
                            >
                                Rent
                            </option>

                        </select>

                    </div>


                    {{-- STATUS --}}

                    <div class="col-12 col-sm-6 col-lg-2">

                        <label class="filter-label">
                            Status
                        </label>

                        <select name="status" class="form-select">

                            <option value="">
                                All Status
                            </option>

                            <option
                                value="pending"
                                @selected(request('status') === 'pending')
                            >
                                Pending
                            </option>

                            <option
                                value="approved"
                                @selected(request('status') === 'approved')
                            >
                                Approved
                            </option>

                            <option
                                value="rejected"
                                @selected(request('status') === 'rejected')
                            >
                                Rejected
                            </option>

                            <option
                                value="completed"
                                @selected(request('status') === 'completed')
                            >
                                Completed
                            </option>

                            <option
                                value="cancelled"
                                @selected(request('status') === 'cancelled')
                            >
                                Cancelled
                            </option>

                        </select>

                    </div>


                    {{-- BUTTONS --}}

                    <div class="col-12 col-lg-2 d-flex align-items-end gap-2">

                        <button
                            type="submit"
                            class="filter-btn flex-grow-1"
                        >

                            <i class="fa-solid fa-filter me-2"></i>

                            Filter

                        </button>


                        @if(request()->hasAny(['search', 'type', 'status']))

                            <a
                                href="{{ route('owner.property-transactions.index') }}"
                                class="reset-btn"
                                title="Reset Filters"
                            >

                                <i class="fa-solid fa-rotate-left"></i>

                            </a>

                        @endif

                    </div>

                </div>

            </form>

        </div>


        {{-- =========================================================
             REQUESTS TABLE
        ========================================================== --}}

        <div class="requests-table-card">


            {{-- TABLE HEADER --}}

            <div class="requests-table-header">

                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">

                    <div>

                        <h3 class="mb-1 fs-6 fw-bold text-dark">
                            Property Requests
                        </h3>

                        <p class="mb-0 small text-muted">

                            Showing

                            <span class="fw-semibold text-dark">
                                {{ $transactions->firstItem() ?? 0 }}
                            </span>

                            -

                            <span class="fw-semibold text-dark">
                                {{ $transactions->lastItem() ?? 0 }}
                            </span>

                            of

                            <span class="fw-semibold text-dark">
                                {{ $transactions->total() }}
                            </span>

                            requests

                        </p>

                    </div>


                    <div
                        class="d-inline-flex align-items-center gap-2 rounded-pill
                        border border-success-subtle bg-success-subtle
                        px-3 py-2 small fw-semibold text-success"
                    >

                        <i class="fa-solid fa-shield-halved"></i>

                        Your Properties Only

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 DESKTOP TABLE
            ====================================================== --}}

            <div class="desktop-request-table requests-table-wrapper">

                <table class="requests-table">

                    <thead>

                        <tr>

                            <th>
                                Request
                            </th>

                            <th style="min-width: 280px;">
                                Property
                            </th>

                            <th style="min-width: 220px;">
                                Applicant
                            </th>

                            <th style="min-width: 180px;">
                                Assigned Agent
                            </th>

                            <th>
                                Type
                            </th>

                            <th>
                                Listed Price
                            </th>

                            <th>
                                Customer Offer
                            </th>

                            <th>
                                Counter Offer
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Date
                            </th>

                            <th class="text-end">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($transactions as $transaction)

                            @php

                                $property = $transaction->property;

                                $customerName =
                                    $transaction->name
                                    ?? $transaction->user?->name
                                    ?? 'Unknown Customer';

                                $customerEmail =
                                    $transaction->email
                                    ?? $transaction->user?->email
                                    ?? 'No email';

                                $customerPhone =
                                    $transaction->phone
                                    ?? $transaction->user?->phone
                                    ?? null;

                                $assignedAgent = $property?->agent;

                                $statusClasses = match($transaction->status) {

                                    'pending' => 'status-pending',

                                    'approved' => 'status-approved',

                                    'rejected' => 'status-rejected',

                                    'completed' => 'status-completed',

                                    'cancelled' => 'status-cancelled',

                                    default => 'status-cancelled',

                                };

                                $statusIcon = match($transaction->status) {

                                    'pending' => 'fa-clock',

                                    'approved' => 'fa-circle-check',

                                    'rejected' => 'fa-circle-xmark',

                                    'completed' => 'fa-handshake',

                                    'cancelled' => 'fa-ban',

                                    default => 'fa-circle-question',

                                };

                            @endphp


                            <tr>


                                {{-- REQUEST NUMBER --}}

                                <td>

                                    <span class="request-number">
                                        {{ $transaction->id }}
                                    </span>

                                </td>


                                {{-- PROPERTY --}}

                                <td>

                                    <div class="d-flex gap-3">

                                        <div class="property-thumb">

                                            @if($property && !empty($property->photos))

                                                @php

                                                    $photos = is_array($property->photos)
                                                        ? $property->photos
                                                        : json_decode($property->photos, true);

                                                    $firstPhoto = is_array($photos)
                                                        ? ($photos[0] ?? null)
                                                        : null;

                                                @endphp

                                                @if($firstPhoto)

                                                    <img
                                                        src="{{ asset('storage/' . $firstPhoto) }}"
                                                        alt="{{ $property->title }}"
                                                    >

                                                @else

                                                    <i class="fa-solid fa-building"></i>

                                                @endif

                                            @else

                                                <i class="fa-solid fa-building"></i>

                                            @endif

                                        </div>


                                        <div class="min-w-0">

                                            <p
                                                class="mb-1 text-truncate fw-bold text-dark"
                                                style="max-width:230px;"
                                            >
                                                {{ $property?->title ?? 'Property Unavailable' }}
                                            </p>

                                            <p
                                                class="mb-0 small text-muted"
                                                style="max-width:250px;"
                                            >

                                                <i class="fa-solid fa-location-dot me-1 text-primary"></i>

                                                {{ $property?->address
                                                    ?? $property?->location?->name
                                                    ?? 'Location unavailable' }}

                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- APPLICANT --}}

                                <td>

                                    <div class="d-flex gap-3">

                                        <div class="customer-avatar">

                                            {{ strtoupper(substr($customerName, 0, 1)) }}

                                        </div>


                                        <div class="min-w-0">

                                            <p
                                                class="mb-1 text-truncate fw-semibold text-dark"
                                                style="max-width:170px;"
                                            >
                                                {{ $customerName }}
                                            </p>

                                            <p
                                                class="mb-1 text-truncate small text-muted"
                                                style="max-width:190px;"
                                            >
                                                {{ $customerEmail }}
                                            </p>

                                            @if($customerPhone)

                                                <p class="mb-0 small text-secondary">

                                                    <i class="fa-solid fa-phone me-1"></i>

                                                    {{ $customerPhone }}

                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- ASSIGNED AGENT --}}

                                <td>

                                    @if($assignedAgent)

                                        <div class="d-flex align-items-center gap-3">

                                            <div class="agent-avatar">

                                                {{ strtoupper(
                                                    substr(
                                                        $assignedAgent->name,
                                                        0,
                                                        1
                                                    )
                                                ) }}

                                            </div>


                                            <div class="min-w-0">

                                                <p
                                                    class="mb-1 text-truncate fw-semibold text-dark"
                                                    style="max-width:150px;"
                                                >
                                                    {{ $assignedAgent->name }}
                                                </p>

                                                <p
                                                    class="mb-0 text-truncate small text-muted"
                                                    style="max-width:170px;"
                                                >
                                                    {{ $assignedAgent->email }}
                                                </p>

                                                <span class="agent-label">

                                                    <i class="fa-solid fa-user-tie"></i>

                                                    Assigned Agent

                                                </span>

                                            </div>

                                        </div>

                                    @else

                                        <div class="d-flex align-items-center gap-2">

                                            <span class="not-assigned-icon">

                                                <i class="fa-solid fa-user-slash"></i>

                                            </span>

                                            <div>

                                                <p class="mb-1 small fw-semibold text-secondary">
                                                    Not Assigned
                                                </p>

                                                <p
                                                    class="mb-0"
                                                    style="font-size:10px;color:#9ca3af;"
                                                >
                                                    Owner managed
                                                </p>

                                            </div>

                                        </div>

                                    @endif

                                </td>


                                {{-- TYPE --}}

                                <td>

                                    @if($transaction->type === 'buy')

                                        <span class="type-badge type-buy">

                                            <i class="fa-solid fa-house"></i>

                                            Buy

                                        </span>

                                    @else

                                        <span class="type-badge type-rent">

                                            <i class="fa-solid fa-key"></i>

                                            Rent

                                        </span>

                                    @endif

                                </td>


                                {{-- LISTED PRICE --}}

                                <td>

                                    @if($property?->price)

                                        <p class="mb-1 fw-bold text-dark text-nowrap">

                                            ₹{{ number_format(
                                                (float) $property->price,
                                                2
                                            ) }}

                                        </p>

                                        <p
                                            class="mb-0"
                                            style="font-size:11px;color:#9ca3af;"
                                        >
                                            Property Price
                                        </p>

                                    @else

                                        <span class="small text-muted">
                                            N/A
                                        </span>

                                    @endif

                                </td>


                                {{-- CUSTOMER OFFER --}}

                                <td>

                                    <p
                                        class="mb-1 fw-bold text-nowrap"
                                        style="color:#ea580c;"
                                    >

                                        ₹{{ number_format(
                                            (float) $transaction->offer_amount,
                                            2
                                        ) }}

                                    </p>

                                    <p
                                        class="mb-0"
                                        style="font-size:11px;color:#9ca3af;"
                                    >
                                        Customer Offer
                                    </p>

                                </td>


                                {{-- COUNTER OFFER --}}

                                <td>

                                    @if($transaction->counter_offer_amount)

                                        <p
                                            class="mb-1 fw-bold text-nowrap"
                                            style="color:#c026d3;"
                                        >

                                            ₹{{ number_format(
                                                (float) $transaction->counter_offer_amount,
                                                2
                                            ) }}

                                        </p>

                                        <p
                                            class="mb-0"
                                            style="font-size:11px;color:#9ca3af;"
                                        >
                                            Counter Offer
                                        </p>

                                    @else

                                        <span class="badge rounded-pill bg-light text-secondary border">

                                            <i class="fa-solid fa-minus me-1"></i>

                                            Not set

                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    <span class="status-badge {{ $statusClasses }}">

                                        <i class="fa-solid {{ $statusIcon }}"></i>

                                        {{ ucfirst($transaction->status) }}

                                    </span>

                                </td>


                                {{-- DATE --}}

                                <td>

                                    <p class="mb-1 fw-medium text-dark text-nowrap">

                                        {{ $transaction->created_at?->format('d M Y') }}

                                    </p>

                                    <p class="mb-0 small text-muted">

                                        {{ $transaction->created_at?->format('h:i A') }}

                                    </p>

                                </td>


                                {{-- ACTION --}}

                                <td class="text-end">

                                    <a
                                        href="{{ route(
                                            'owner.property-transactions.show',
                                            $transaction
                                        ) }}"
                                        class="request-view-btn"
                                    >

                                        <i class="fa-solid fa-eye"></i>

                                        View

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="11">

                                    <div class="requests-empty">

                                        <div class="requests-empty-icon">

                                            <i class="fa-solid fa-file-circle-xmark"></i>

                                        </div>

                                        <h3 class="mt-4 mb-2 fs-5 fw-bold text-dark">
                                            No Property Requests Found
                                        </h3>

                                        <p
                                            class="mx-auto mb-0 text-muted small"
                                            style="max-width:430px;"
                                        >
                                            No purchase or rental requests match
                                            your current search and filters.
                                        </p>

                                        @if(request()->hasAny([
                                            'search',
                                            'type',
                                            'status'
                                        ]))

                                            <a
                                                href="{{ route(
                                                    'owner.property-transactions.index'
                                                ) }}"
                                                class="filter-btn d-inline-flex align-items-center mt-4 text-decoration-none"
                                            >

                                                <i class="fa-solid fa-rotate-left me-2"></i>

                                                Clear Filters

                                            </a>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                 MOBILE / TABLET CARDS
            ====================================================== --}}

            <div class="mobile-request-cards">

                @forelse($transactions as $transaction)

                    @php

                        $property = $transaction->property;

                        $customerName =
                            $transaction->name
                            ?? $transaction->user?->name
                            ?? 'Unknown Customer';

                        $customerEmail =
                            $transaction->email
                            ?? $transaction->user?->email
                            ?? 'No email';

                        $assignedAgent = $property?->agent;

                        $statusClasses = match($transaction->status) {

                            'pending' => 'status-pending',

                            'approved' => 'status-approved',

                            'rejected' => 'status-rejected',

                            'completed' => 'status-completed',

                            'cancelled' => 'status-cancelled',

                            default => 'status-cancelled',

                        };

                    @endphp


                    <div class="mobile-request-card">


                        {{-- CARD TOP --}}

                        <div class="d-flex align-items-start justify-content-between gap-3">

                            <div class="d-flex min-w-0 gap-3">

                                <div class="mobile-property-icon">

                                    <i class="fa-solid fa-building"></i>

                                </div>


                                <div class="min-w-0">

                                    <div class="d-flex align-items-center gap-2">

                                        <span
                                            class="small fw-bold text-secondary"
                                            style="font-size:10px;"
                                        >
                                            #{{ $transaction->id }}
                                        </span>

                                        @if($transaction->type === 'buy')

                                            <span class="badge rounded-pill bg-primary-subtle text-primary">
                                                BUY
                                            </span>

                                        @else

                                            <span class="badge rounded-pill bg-danger-subtle text-danger">
                                                RENT
                                            </span>

                                        @endif

                                    </div>

                                    <h4
                                        class="mt-1 mb-1 text-truncate fs-6 fw-bold text-dark"
                                    >
                                        {{ $property?->title ?? 'Property Unavailable' }}
                                    </h4>

                                    <p class="mb-0 small text-muted">

                                        <i class="fa-solid fa-location-dot me-1 text-primary"></i>

                                        {{ $property?->address
                                            ?? $property?->location?->name
                                            ?? 'Location unavailable' }}

                                    </p>

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <span class="status-badge {{ $statusClasses }}">

                                {{ ucfirst($transaction->status) }}

                            </span>

                        </div>


                        {{-- ASSIGNED AGENT --}}

                        <div class="mobile-info-box">

                            <p class="mobile-info-title">
                                Assigned Agent
                            </p>

                            @if($assignedAgent)

                                <div class="d-flex align-items-center gap-3">

                                    <div class="agent-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $assignedAgent->name,
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>

                                    <div class="min-w-0">

                                        <p class="mb-1 text-truncate small fw-semibold text-dark">
                                            {{ $assignedAgent->name }}
                                        </p>

                                        <p class="mb-0 text-truncate small text-muted">
                                            {{ $assignedAgent->email }}
                                        </p>

                                    </div>

                                </div>

                            @else

                                <div class="d-flex align-items-center gap-3">

                                    <div class="not-assigned-icon">

                                        <i class="fa-solid fa-user-slash"></i>

                                    </div>

                                    <div>

                                        <p class="mb-1 small fw-semibold text-secondary">
                                            Not Assigned
                                        </p>

                                        <p class="mb-0 small text-muted">
                                            Owner managed
                                        </p>

                                    </div>

                                </div>

                            @endif

                        </div>


                        {{-- CUSTOMER --}}

                        <div class="mobile-info-box">

                            <p class="mobile-info-title">
                                Applicant
                            </p>

                            <div class="d-flex align-items-center gap-3">

                                <div class="customer-avatar">

                                    {{ strtoupper(
                                        substr(
                                            $customerName,
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>

                                <div class="min-w-0">

                                    <p class="mb-1 text-truncate small fw-semibold text-dark">
                                        {{ $customerName }}
                                    </p>

                                    <p class="mb-0 text-truncate small text-muted">
                                        {{ $customerEmail }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- FINANCIAL DETAILS --}}

                        <div class="mt-3 row g-2">


                            {{-- LISTED PRICE --}}

                            <div class="col-4">

                                <div class="mobile-finance-box h-100">

                                    <p class="mobile-finance-label mb-0">
                                        Listed Price
                                    </p>

                                    <p class="mobile-finance-value mb-0">

                                        ₹{{ number_format(
                                            (float) ($property?->price ?? 0),
                                            0
                                        ) }}

                                    </p>

                                </div>

                            </div>


                            {{-- CUSTOMER OFFER --}}

                            <div class="col-4">

                                <div class="mobile-finance-box customer h-100">

                                    <p class="mobile-finance-label mb-0">
                                        Customer
                                    </p>

                                    <p class="mobile-finance-value mb-0">

                                        ₹{{ number_format(
                                            (float) $transaction->offer_amount,
                                            0
                                        ) }}

                                    </p>

                                </div>

                            </div>


                            {{-- COUNTER --}}

                            <div class="col-4">

                                <div class="mobile-finance-box counter h-100">

                                    <p class="mobile-finance-label mb-0">
                                        Counter
                                    </p>

                                    <p class="mobile-finance-value mb-0">

                                        @if($transaction->counter_offer_amount)

                                            ₹{{ number_format(
                                                (float) $transaction->counter_offer_amount,
                                                0
                                            ) }}

                                        @else

                                            —

                                        @endif

                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- BOTTOM --}}

                        <div class="mt-3 d-flex align-items-center justify-content-between gap-3">

                            <p class="mb-0 small text-muted">

                                <i class="fa-regular fa-calendar me-1"></i>

                                {{ $transaction->created_at?->format(
                                    'd M Y, h:i A'
                                ) }}

                            </p>


                            <a
                                href="{{ route(
                                    'owner.property-transactions.show',
                                    $transaction
                                ) }}"
                                class="request-view-btn"
                            >

                                <i class="fa-solid fa-eye"></i>

                                View Request

                            </a>

                        </div>

                    </div>

                @empty

                    <div class="requests-empty">

                        <div class="requests-empty-icon">

                            <i class="fa-solid fa-file-circle-xmark"></i>

                        </div>

                        <h3 class="mt-4 mb-2 fs-5 fw-bold text-dark">
                            No Property Requests
                        </h3>

                        <p class="mb-0 small text-muted">
                            No requests were found.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- =====================================================
                 PAGINATION
            ====================================================== --}}

            @if($transactions->hasPages())

                <div class="requests-pagination">

                    {{ $transactions->links() }}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection