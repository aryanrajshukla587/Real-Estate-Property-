@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')


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

                <h1>
                    Welcome, {{ $user->name }}
                </h1>

                <p>
                    Manage your property requests and track their status.
                </p>

            </div>

        </div>

    </div>

</section>

{{-- END SECTION TOP --}}



<style>

/* =====================================================
   USER DASHBOARD
====================================================== */

.user-dashboard {
    padding: 60px 0;
    background: #f8fafc;
    min-height: 700px;
}


/* =====================================================
   DASHBOARD CARD
====================================================== */

.dashboard-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 24px;
    border: 1px solid #e2e8f0;

    box-shadow:
        0 5px 20px rgba(15, 23, 42, 0.05);

    height: 100%;
}


/* =====================================================
   STAT CARD
====================================================== */

.stat-card {
    position: relative;
    overflow: hidden;
    transition: all .25s ease;
}

.stat-card:hover {
    transform: translateY(-5px);

    box-shadow:
        0 12px 28px rgba(15, 23, 42, 0.12);
}


.stat-icon {

    width: 52px;
    height: 52px;

    border-radius: 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f1f5f9;

    color: #7c3aed;

    font-size: 21px;

    margin-bottom: 16px;

    transition: .25s ease;
}


.stat-number {

    font-size: 29px;

    font-weight: 700;

    color: #1e293b;

    line-height: 1.2;
}


.stat-label {

    color: #64748b;

    font-size: 14px;

    margin-top: 6px;

    font-weight: 500;
}


/* =====================================================
   TOTAL REQUESTS
====================================================== */

.stat-total {
    border-top: 4px solid #7c3aed;
}

.stat-total .stat-icon {
    background: #ede9fe;
    color: #7c3aed;
}


/* =====================================================
   BUY REQUESTS
====================================================== */

.stat-buy {
    border-top: 4px solid #2563eb;
}

.stat-buy .stat-icon {
    background: #dbeafe;
    color: #2563eb;
}


/* =====================================================
   RENT REQUESTS
====================================================== */

.stat-rent {
    border-top: 4px solid #0891b2;
}

.stat-rent .stat-icon {
    background: #cffafe;
    color: #0891b2;
}


/* =====================================================
   PENDING REQUESTS
====================================================== */

.stat-pending {
    border-top: 4px solid #f59e0b;
}

.stat-pending .stat-icon {
    background: #fef3c7;
    color: #d97706;
}


/* =====================================================
   APPROVED
====================================================== */

.stat-approved {
    border-top: 4px solid #16a34a;
}

.stat-approved .stat-icon {
    background: #dcfce7;
    color: #16a34a;
}


/* =====================================================
   COMPLETED
====================================================== */

.stat-completed {
    border-top: 4px solid #4f46e5;
}

.stat-completed .stat-icon {
    background: #e0e7ff;
    color: #4f46e5;
}


/* =====================================================
   REJECTED
====================================================== */

.stat-rejected {
    border-top: 4px solid #dc2626;
}

.stat-rejected .stat-icon {
    background: #fee2e2;
    color: #dc2626;
}


/* =====================================================
   CANCELLED
====================================================== */

.stat-cancelled {
    border-top: 4px solid #6b7280;
}

.stat-cancelled .stat-icon {
    background: #e5e7eb;
    color: #4b5563;
}


/* =====================================================
   WELCOME CARD
====================================================== */

.welcome-card {

    background: linear-gradient(
        135deg,
        #7c3aed,
        #c026d3
    );

    color: #ffffff;

    border: none;

    box-shadow:
        0 10px 30px rgba(124, 58, 237, 0.18);
}


.welcome-card h2 {

    color: #ffffff;

    font-size: 25px;

    font-weight: 700;

    margin-bottom: 8px;
}


.welcome-card p {

    color: rgba(255,255,255,.85);

    margin: 0;

    line-height: 1.7;
}


/* =====================================================
   SECTION TITLE
====================================================== */

.section-title {

    font-size: 21px;

    font-weight: 700;

    color: #1e293b;

    margin-bottom: 20px;
}


/* =====================================================
   ACCOUNT INFO
====================================================== */

.info-list {

    list-style: none;

    padding: 0;

    margin: 0;
}


.info-list li {

    display: flex;

    justify-content: space-between;

    gap: 15px;

    padding: 12px 0;

    border-bottom: 1px solid #f1f5f9;

    font-size: 14px;
}


.info-list li:last-child {

    border-bottom: none;
}


.info-label {

    color: #64748b;
}


.info-value {

    color: #1e293b;

    font-weight: 600;

    text-align: right;

    word-break: break-word;
}


/* =====================================================
   EDIT PROFILE BUTTON
====================================================== */

.user-profile-btn {

    width: 100%;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border-radius: 9px;

    padding: 11px 16px;

    background: #ede9fe;

    color: #6d28d9;

    font-size: 14px;

    font-weight: 600;

    text-decoration: none;

    transition: all .25s ease;
}


.user-profile-btn:hover {

    background: #7c3aed;

    color: #ffffff;

    transform: translateY(-1px);

    text-decoration: none;
}


/* =====================================================
   LOGOUT BUTTON
====================================================== */

.user-logout-btn {

    width: 100%;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border: none;

    border-radius: 9px;

    padding: 11px 16px;

    background: #fee2e2;

    color: #b91c1c;

    font-size: 14px;

    font-weight: 600;

    cursor: pointer;

    transition: all .25s ease;
}


.user-logout-btn:hover {

    background: #dc2626;

    color: #ffffff;

    transform: translateY(-1px);
}


/* =====================================================
   TRANSACTION TABLE WRAPPER
====================================================== */

.transaction-table-wrapper {

    width: 100%;

    overflow-x: auto;
    overflow-y: hidden;

    -webkit-overflow-scrolling: touch;

    border-radius: 10px;

    scrollbar-width: thin;
}


/* =====================================================
   TRANSACTION TABLE
====================================================== */

.transaction-table {

    width: 100%;

    /*
     * Important:
     * Previously fixed large column widths were creating
     * unnecessary gaps between Registered By, Type,
     * Listed Price etc.
     */
    min-width: 0;

    border-collapse: separate;

    border-spacing: 0;

    background: #ffffff;
}


/* =====================================================
   TABLE HEADER
====================================================== */

.transaction-table th {

    padding: 14px 10px;

    text-align: left;

    font-size: 13px;

    font-weight: 600;

    color: #64748b;

    background: #f8fafc;

    border-bottom: 1px solid #e2e8f0;

    white-space: nowrap;
}


/* =====================================================
   TABLE DATA
====================================================== */

.transaction-table td {

    padding: 15px 10px;

    font-size: 14px;

    color: #334155;

    border-bottom: 1px solid #f1f5f9;

    vertical-align: middle;

    white-space: nowrap;
}


.transaction-table tbody tr {

    transition: background .2s ease;
}


.transaction-table tbody tr:hover {

    background: #fafafa;
}


.transaction-table tbody tr:last-child td {

    border-bottom: none;
}


/* =====================================================
   PROPERTY COLUMN
====================================================== */

.transaction-table th:first-child,
.transaction-table td:first-child {

    width: 190px;

    min-width: 190px;

    max-width: 210px;
}


.property-name {

    font-weight: 600;

    color: #1e293b;

    white-space: normal;

    line-height: 1.45;

    max-width: 200px;
}


/* =====================================================
   REGISTERED BY COLUMN
====================================================== */

.transaction-table th.registered-by-column,
.transaction-table td.registered-by-column {

    width: 165px;

    min-width: 165px;

    max-width: 175px;
}


/* =====================================================
   PROPERTY OWNER
====================================================== */

.property-owner {

    width: 100%;

    min-width: 0;

    max-width: 175px;

    white-space: normal;
}


.owner-info {

    display: flex;

    align-items: center;

    gap: 7px;

    min-width: 0;
}


.owner-avatar {

    width: 34px;

    height: 34px;

    min-width: 34px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #ede9fe;

    color: #7c3aed;

    font-size: 14px;
}


.owner-details {

    min-width: 0;

    flex: 1;
}


.owner-name {

    font-size: 12px;

    font-weight: 700;

    color: #1e293b;

    line-height: 1.35;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
}


.owner-label {

    font-size: 10px;

    color: #94a3b8;

    margin-top: 2px;

    text-transform: capitalize;

    white-space: nowrap;
}


.owner-contact {

    display: flex;

    align-items: center;

    gap: 5px;

    margin-top: 5px;

    font-size: 10px;

    color: #64748b;

    max-width: 100%;

    min-width: 0;
}


.owner-contact span {

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

    min-width: 0;
}


.owner-contact i {

    width: 11px;

    min-width: 11px;

    text-align: center;
}


.owner-contact.email i {

    color: #2563eb;
}


.owner-contact.phone i {

    color: #16a34a;
}


/* =====================================================
   TYPE COLUMN
====================================================== */

.transaction-table th.transaction-type-column,
.transaction-table td.transaction-type-column {

    width: 75px;

    min-width: 75px;

    max-width: 85px;
}


.transaction-type {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-width: 55px;

    padding: 5px 9px;

    border-radius: 20px;

    font-size: 11px;

    font-weight: 600;
}


.transaction-buy {

    background: #ede9fe;

    color: #6d28d9;
}


.transaction-rent {

    background: #e0f2fe;

    color: #0369a1;
}


/* =====================================================
   PRICE COLUMNS
====================================================== */

.transaction-table th.price-column,
.transaction-table td.price-column {

    width: 105px;

    min-width: 105px;

    max-width: 115px;
}


/* =====================================================
   MY OFFER
====================================================== */

.transaction-table th.offer-column,
.transaction-table td.offer-column {

    width: 105px;

    min-width: 105px;

    max-width: 115px;
}


/* =====================================================
   COUNTER OFFER
====================================================== */

.transaction-table th.counter-column,
.transaction-table td.counter-column {

    width: 115px;

    min-width: 115px;

    max-width: 125px;
}


.counter-offer {

    color: #d97706;

    font-weight: 700;

    white-space: nowrap;
}


.counter-offer-empty {

    color: #94a3b8;

    font-size: 12px;

    font-weight: 500;

    white-space: nowrap;
}


/* =====================================================
   STATUS COLUMN
====================================================== */

.transaction-table th.status-column,
.transaction-table td.status-column {

    width: 95px;

    min-width: 95px;

    max-width: 105px;
}


.status-badge {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-width: 76px;

    padding: 5px 9px;

    border-radius: 20px;

    font-size: 11px;

    font-weight: 600;

    text-transform: capitalize;

    white-space: nowrap;
}


.status-pending {

    background: #fef3c7;

    color: #92400e;
}


.status-approved {

    background: #dcfce7;

    color: #166534;
}


.status-rejected {

    background: #fee2e2;

    color: #991b1b;
}


.status-completed {

    background: #dbeafe;

    color: #1e40af;
}


.status-cancelled {

    background: #e5e7eb;

    color: #374151;
}


/* =====================================================
   DATE COLUMN
====================================================== */

.transaction-table th.date-column,
.transaction-table td.date-column {

    width: 100px;

    min-width: 100px;

    max-width: 110px;
}


/* =====================================================
   ACTION COLUMN
====================================================== */

.transaction-table th.action-column,
.transaction-table td.action-column {

    width: 250px;

    min-width: 250px;

    max-width: 260px;
}


/* =====================================================
   ACTION BUTTON WRAPPER
====================================================== */

.request-actions {

    display: flex;

    align-items: center;

    justify-content: flex-start;

    gap: 6px;

    flex-wrap: nowrap;

    min-width: max-content;
}


.request-actions form {

    display: inline-flex;

    align-items: center;

    margin: 0;

    padding: 0;
}


/* =====================================================
   COMMON ACTION BUTTON
====================================================== */

.request-action-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 5px;

    min-height: 33px;

    padding: 7px 10px;

    border-radius: 7px;

    font-size: 11px;

    font-weight: 600;

    line-height: 1;

    white-space: nowrap;

    text-decoration: none;

    flex-shrink: 0;

    transition:
        background .2s ease,
        color .2s ease,
        transform .2s ease,
        box-shadow .2s ease;
}


.request-action-btn:hover {

    text-decoration: none;

    transform: translateY(-1px);
}


.request-action-btn i {

    font-size: 10px;
}


/* =====================================================
   VIEW BUTTON
====================================================== */

.view-btn {

    background: #f1f5f9;

    color: #334155;

    border: 1px solid #e2e8f0;
}


.view-btn:hover {

    background: #7c3aed;

    color: #ffffff;

    border-color: #7c3aed;

    box-shadow:
        0 4px 10px rgba(124, 58, 237, .18);
}


/* =====================================================
   EDIT OFFER BUTTON
====================================================== */

.edit-offer-btn {

    background: #dbeafe;

    color: #1d4ed8;

    border: 1px solid #bfdbfe;
}


.edit-offer-btn:hover {

    background: #2563eb;

    color: #ffffff;

    border-color: #2563eb;

    box-shadow:
        0 4px 10px rgba(37, 99, 235, .18);
}


/* =====================================================
   CANCEL BUTTON
====================================================== */

.cancel-btn {

    background: #fee2e2;

    color: #b91c1c;

    border: 1px solid #fecaca;

    cursor: pointer;
}


.cancel-btn:hover {

    background: #dc2626;

    color: #ffffff;

    border-color: #dc2626;

    box-shadow:
        0 4px 10px rgba(220, 38, 38, .18);
}


/* =====================================================
   EMPTY STATE
====================================================== */

.empty-state {

    text-align: center;

    padding: 50px 20px;
}


.empty-state i {

    font-size: 45px;

    color: #cbd5e1;

    margin-bottom: 15px;
}


.empty-state h4 {

    color: #334155;

    font-weight: 600;

    margin-bottom: 8px;
}


.empty-state p {

    color: #64748b;

    margin-bottom: 20px;
}


/* =====================================================
   BROWSE BUTTON
====================================================== */

.browse-btn {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 11px 20px;

    border-radius: 8px;

    background: #7c3aed;

    color: #ffffff;

    text-decoration: none;

    font-size: 14px;

    font-weight: 600;

    transition: .2s ease;
}


.browse-btn:hover {

    background: #6d28d9;

    color: #ffffff;

    text-decoration: none;

    transform: translateY(-1px);
}


/* =====================================================
   ALERT
====================================================== */

.user-dashboard .alert {

    border-radius: 10px;

    margin-bottom: 20px;
}


/* =====================================================
   MOBILE
====================================================== */

@media (max-width: 767px) {

    .user-dashboard {

        padding: 40px 0;
    }


    .dashboard-card {

        padding: 20px;
    }


    .welcome-card {

        padding: 22px;
    }


    .welcome-card h2 {

        font-size: 22px;
    }


    .transaction-table-wrapper {

        overflow-x: auto;

        width: 100%;

        border-radius: 8px;
    }


    /*
     * Mobile par table scroll hogi,
     * lekin columns ke beech unnecessary gap nahi hoga.
     */
    .transaction-table {

        min-width: 1100px;
    }


    .request-actions {

        gap: 5px;

        flex-wrap: nowrap;
    }


    .request-action-btn {

        min-height: 32px;

        padding: 7px 9px;

        font-size: 10px;
    }


    .property-owner {

        max-width: 160px;
    }

}


/* =====================================================
   TABLET
====================================================== */

@media (min-width: 768px) and (max-width: 1199px) {

    .transaction-table {

        min-width: 1100px;
    }

}


/* =====================================================
   SMALL SCREEN
====================================================== */

@media (max-width: 575px) {

    .transaction-table {

        min-width: 1100px;
    }

}


/* =====================================================
   IMPORTANT:
   REMOVE DEFAULT EXTRA SPACING FROM TABLE CELLS
====================================================== */

.transaction-table th,
.transaction-table td {

    box-sizing: border-box;
}


/*
 * Prevent Bootstrap/theme CSS from adding unwanted
 * spacing or width to action forms.
 */
.transaction-table form {

    margin-bottom: 0;
}


/*
 * Keep table text compact.
 */
.transaction-table td.price-column,
.transaction-table td.offer-column,
.transaction-table td.counter-column,
.transaction-table td.status-column,
.transaction-table td.date-column {

    white-space: nowrap;
}

</style>



{{-- =========================================================
     START USER DASHBOARD
========================================================= --}}

<section class="user-dashboard">

    <div class="container">


        {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif


        {{-- =====================================================
             ERROR MESSAGE
        ====================================================== --}}

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif


        {{-- =====================================================
             INFO MESSAGE
        ====================================================== --}}

        @if(session('info'))

            <div class="alert alert-info">

                {{ session('info') }}

            </div>

        @endif



        {{-- =====================================================
             WELCOME + ACCOUNT
        ====================================================== --}}

        <div class="row mb-4">


            {{-- =================================================
                 WELCOME CARD
            ================================================== --}}

            <div class="col-lg-8 mb-4 mb-lg-0">

                <div class="dashboard-card welcome-card">

                    <h2>

                        Hello, {{ $user->name }} 👋

                    </h2>


                    <p>

                        Your property activity is available here.
                        You can check your buy and rent requests,
                        their current status, and property details.

                    </p>

                </div>

            </div>



            {{-- =================================================
                 ACCOUNT CARD
            ================================================== --}}

            <div class="col-lg-4">

                <div class="dashboard-card">

                    <h3 class="section-title">

                        My Account

                    </h3>


                    <ul class="info-list">


                        {{-- NAME --}}

                        <li>

                            <span class="info-label">

                                Name

                            </span>


                            <span class="info-value">

                                {{ $user->name }}

                            </span>

                        </li>



                        {{-- EMAIL --}}

                        <li>

                            <span class="info-label">

                                Email

                            </span>


                            <span class="info-value">

                                {{ $user->email }}

                            </span>

                        </li>



                        {{-- ACCOUNT TYPE --}}

                        <li>

                            <span class="info-label">

                                Account Type

                            </span>


                            <span class="info-value">

                                User

                            </span>

                        </li>


                    </ul>



                    {{-- =================================================
                         EDIT PROFILE
                    ================================================== --}}

                    <div style="margin-top: 15px;">

                        <a
                            href="{{ route('user.profile.edit') }}"
                            class="user-profile-btn"
                        >

                            <i class="fa fa-pencil"></i>

                            Edit Profile

                        </a>

                    </div>



                    {{-- =================================================
                         LOGOUT
                    ================================================== --}}

                    <div style="margin-top: 12px;">

                        <form
                            action="{{ route('user.logout') }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="user-logout-btn"
                            >

                                <i class="fa fa-sign-out"></i>

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
             MAIN STAT CARDS
        ====================================================== --}}

        <div class="row mb-4">


            {{-- TOTAL REQUESTS --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-total">

                    <div class="stat-icon">

                        <i class="fa fa-list"></i>

                    </div>


                    <div class="stat-number">

                        {{ $totalTransactions }}

                    </div>


                    <div class="stat-label">

                        Total Requests

                    </div>

                </div>

            </div>



            {{-- BUY REQUESTS --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-buy">

                    <div class="stat-icon">

                        <i class="fa fa-shopping-cart"></i>

                    </div>


                    <div class="stat-number">

                        {{ $buyRequests }}

                    </div>


                    <div class="stat-label">

                        Buy Requests

                    </div>

                </div>

            </div>



            {{-- RENT REQUESTS --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-rent">

                    <div class="stat-icon">

                        <i class="fa fa-home"></i>

                    </div>


                    <div class="stat-number">

                        {{ $rentRequests }}

                    </div>


                    <div class="stat-label">

                        Rent Requests

                    </div>

                </div>

            </div>



            {{-- PENDING REQUESTS --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-pending">

                    <div class="stat-icon">

                        <i class="fa fa-clock-o"></i>

                    </div>


                    <div class="stat-number">

                        {{ $pendingRequests }}

                    </div>


                    <div class="stat-label">

                        Pending Requests

                    </div>

                </div>

            </div>


        </div>



        {{-- =====================================================
             STATUS CARDS
        ====================================================== --}}

        <div class="row mb-5">


            {{-- APPROVED --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-approved">

                    <div class="stat-icon">

                        <i class="fa fa-check"></i>

                    </div>


                    <div class="stat-number">

                        {{ $approvedRequests }}

                    </div>


                    <div class="stat-label">

                        Approved Requests

                    </div>

                </div>

            </div>



            {{-- COMPLETED --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-completed">

                    <div class="stat-icon">

                        <i class="fa fa-check-circle"></i>

                    </div>


                    <div class="stat-number">

                        {{ $completedRequests }}

                    </div>


                    <div class="stat-label">

                        Completed Requests

                    </div>

                </div>

            </div>



            {{-- REJECTED --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-rejected">

                    <div class="stat-icon">

                        <i class="fa fa-times"></i>

                    </div>


                    <div class="stat-number">

                        {{ $rejectedRequests }}

                    </div>


                    <div class="stat-label">

                        Rejected Requests

                    </div>

                </div>

            </div>



            {{-- CANCELLED --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-cancelled">

                    <div class="stat-icon">

                        <i class="fa fa-ban"></i>

                    </div>


                    <div class="stat-number">

                        {{ $cancelledRequests ?? 0 }}

                    </div>


                    <div class="stat-label">

                        Cancelled Requests

                    </div>

                </div>

            </div>


        </div>



        {{-- =====================================================
             MY PROPERTY REQUESTS
        ====================================================== --}}

        <div class="dashboard-card">

            <h3 class="section-title">

                My Property Requests

            </h3>


            @if($transactions->count())


                {{-- =================================================
                     CHECK WHETHER ANY REGISTERED BY PERSON EXISTS
                ================================================== --}}

                @php

                    $hasRegisteredBy = $transactions->contains(function ($transaction) {

                        $property = $transaction->property;

                        if (!$property) {
                            return false;
                        }

                        return
                            $property->owner !== null ||
                            $property->agent !== null ||
                            $property->admin !== null;

                    });

                @endphp


                <div class="transaction-table-wrapper">

                    <table class="transaction-table">


                        {{-- =================================================
                             TABLE HEAD
                        ================================================== --}}

                        <thead>

                            <tr>

                                <th>
                                    Property
                                </th>


                                {{-- REGISTERED BY --}}

                                @if($hasRegisteredBy)

                                    <th class="registered-by-column">
                                        Registered By
                                    </th>

                                @endif


                                <th class="transaction-type-column">
                                    Type
                                </th>


                                <th class="price-column">
                                    Listed Price
                                </th>


                                <th class="offer-column">
                                    My Offer
                                </th>


                                <th class="counter-column">
                                    Counter Offer
                                </th>


                                <th class="status-column">
                                    Status
                                </th>


                                <th class="date-column">
                                    Date
                                </th>


                                <th class="action-column">
                                    Action
                                </th>

                            </tr>

                        </thead>



                        {{-- =================================================
                             TABLE BODY
                        ================================================== --}}

                        <tbody>


                            @foreach($transactions as $transaction)

                                @php

                                    /*
                                    |----------------------------------------------------------
                                    | PROPERTY
                                    |----------------------------------------------------------
                                    */

                                    $property = $transaction->property;


                                    /*
                                    |----------------------------------------------------------
                                    | LISTED PRICE
                                    |----------------------------------------------------------
                                    */

                                    $listedAmount = (float) $transaction->amount;


                                    /*
                                    |----------------------------------------------------------
                                    | USER OFFER
                                    |----------------------------------------------------------
                                    */

                                    $offerAmount = (float) (
                                        $transaction->offer_amount
                                        ?? $transaction->amount
                                    );


                                    /*
                                    |----------------------------------------------------------
                                    | DIFFERENCE
                                    |----------------------------------------------------------
                                    */

                                    $difference = $listedAmount - $offerAmount;


                                    /*
                                    |----------------------------------------------------------
                                    | COUNTER OFFER
                                    |----------------------------------------------------------
                                    */

                                    $counterOfferAmount =
                                        $transaction->counter_offer_amount !== null
                                            ? (float) $transaction->counter_offer_amount
                                            : null;


                                    /*
                                    |----------------------------------------------------------
                                    | REGISTERED BY
                                    |----------------------------------------------------------
                                    */

                                    $registeredBy = null;

                                    $registeredByType = null;


                                    /*
                                    |----------------------------------------------------------
                                    | OWNER
                                    |----------------------------------------------------------
                                    */

                                    if ($property?->owner) {

                                        $registeredBy = $property->owner;

                                        $registeredByType = 'Owner';

                                    }


                                    /*
                                    |----------------------------------------------------------
                                    | AGENT
                                    |----------------------------------------------------------
                                    */

                                    elseif ($property?->agent) {

                                        $registeredBy = $property->agent;

                                        $registeredByType = 'Agent';

                                    }


                                    /*
                                    |----------------------------------------------------------
                                    | ADMIN
                                    |----------------------------------------------------------
                                    */

                                    elseif ($property?->admin) {

                                        $registeredBy = $property->admin;

                                        $registeredByType = 'Admin';

                                    }

                                @endphp


                                <tr>


                                    {{-- =====================================
                                         PROPERTY
                                    ====================================== --}}

                                    <td>

                                        <div class="property-name">

                                            {{ $property?->title ?? 'Property' }}

                                        </div>


                                        @if($property?->location)

                                            <small style="color:#64748b;">

                                                {{ $property->location->city ?? '' }}

                                                @if($property->location->state)

                                                    ,

                                                    {{ $property->location->state }}

                                                @endif

                                            </small>

                                        @endif

                                    </td>



                                    {{-- =====================================
                                         REGISTERED BY
                                    ====================================== --}}

                                    @if($hasRegisteredBy)

                                        <td class="registered-by-column">

                                            @if($registeredBy)

                                                <div class="property-owner">

                                                    <div class="owner-info">


                                                        {{-- AVATAR --}}

                                                        <div class="owner-avatar">

                                                            <i class="fa fa-user"></i>

                                                        </div>



                                                        {{-- NAME + TYPE --}}

                                                        <div class="owner-details">

                                                            <div class="owner-name">

                                                                {{ $registeredBy->name ?? 'N/A' }}

                                                            </div>


                                                            <div class="owner-label">

                                                                Property {{ $registeredByType }}

                                                            </div>

                                                        </div>

                                                    </div>



                                                    {{-- EMAIL --}}

                                                    @if(!empty($registeredBy->email))

                                                        <div class="owner-contact email">

                                                            <i class="fa fa-envelope"></i>

                                                            <span>

                                                                {{ $registeredBy->email }}

                                                            </span>

                                                        </div>

                                                    @endif



                                                    {{-- PHONE --}}

                                                    @if(!empty($registeredBy->phone))

                                                        <div class="owner-contact phone">

                                                            <i class="fa fa-phone"></i>

                                                            <span>

                                                                {{ $registeredBy->phone }}

                                                            </span>

                                                        </div>

                                                    @endif

                                                </div>

                                            @else

                                                <span style="color:#94a3b8;">
                                                    —
                                                </span>

                                            @endif

                                        </td>

                                    @endif



                                    {{-- =====================================
                                         TYPE
                                    ====================================== --}}

                                    <td class="transaction-type-column">

                                        @if($transaction->type === 'buy')

                                            <span class="transaction-type transaction-buy">

                                                Buy

                                            </span>

                                        @else

                                            <span class="transaction-type transaction-rent">

                                                Rent

                                            </span>

                                        @endif

                                    </td>



                                    {{-- =====================================
                                         LISTED PRICE
                                    ====================================== --}}

                                    <td class="price-column">

                                        ₹{{ number_format($listedAmount, 2) }}

                                    </td>



                                    {{-- =====================================
                                         MY OFFER
                                    ====================================== --}}

                                    <td class="offer-column">

                                        <strong style="color:#1e293b;">

                                            ₹{{ number_format($offerAmount, 2) }}

                                        </strong>

                                    </td>



                                    {{-- =====================================
                                         COUNTER OFFER
                                    ====================================== --}}

                                    <td class="counter-column">

                                        @if($counterOfferAmount !== null)

                                            <strong class="counter-offer">

                                                ₹{{ number_format($counterOfferAmount, 2) }}

                                            </strong>

                                        @else

                                            <span class="counter-offer-empty">

                                                Not offered

                                            </span>

                                        @endif

                                    </td>



                                    {{-- =====================================
                                         STATUS
                                    ====================================== --}}

                                    <td class="status-column">

                                        <span
                                            class="status-badge status-{{ $transaction->status }}"
                                        >

                                            {{ str_replace('-', ' ', $transaction->status) }}

                                        </span>

                                    </td>



                                    {{-- =====================================
                                         DATE
                                    ====================================== --}}

                                    <td class="date-column">

                                        {{ $transaction->created_at->format('d M Y') }}

                                    </td>



                                    {{-- =====================================
                                         ACTION
                                    ====================================== --}}

                                    <td class="action-column">

                                        <div class="request-actions">


                                            {{-- =================================
                                                 VIEW
                                            ================================== --}}

                                            <a
                                                href="{{ route('user.transaction.show', $transaction) }}"
                                                class="request-action-btn view-btn"
                                            >

                                                <i class="fa fa-eye"></i>

                                                View

                                            </a>



                                            {{-- =================================
                                                 EDIT OFFER
                                            ================================== --}}

                                            @if($transaction->status === 'pending')

                                                <a
                                                    href="{{ route('user.transaction.edit', $transaction) }}"
                                                    class="request-action-btn edit-offer-btn"
                                                >

                                                    <i class="fa fa-pencil"></i>

                                                    Edit Offer

                                                </a>

                                            @endif



                                            {{-- =================================
                                                 CANCEL
                                            ================================== --}}

                                            @if($transaction->status === 'pending')

                                                <form
                                                    action="{{ route('user.transaction.cancel', $transaction) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to cancel this request?');"
                                                >

                                                    @csrf

                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="request-action-btn cancel-btn"
                                                    >

                                                        <i class="fa fa-times"></i>

                                                        Cancel

                                                    </button>

                                                </form>

                                            @endif


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

                <div class="empty-state">

                    <i class="fa fa-home"></i>


                    <h4>

                        No Property Requests Yet

                    </h4>


                    <p>

                        You haven't submitted any buy or rent requests yet.

                    </p>


                    <a
                        href="{{ route('property') }}"
                        class="browse-btn"
                    >

                        Browse Properties

                        <i class="fa fa-arrow-right"></i>

                    </a>

                </div>


            @endif


        </div>


    </div>

</section>

{{-- END USER DASHBOARD --}}



@endsection