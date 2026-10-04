@extends('layouts.app')

@section('title', 'Owner Dashboard')

@section('content')

{{-- =========================================================
     PAGE TOP HEADER
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
                <h1>Welcome, {{ $owner->name }}</h1>
                <p>Manage your properties and track your property activity.</p>
            </div>

        </div>
    </div>
</section>


<style>

/* =========================================================
   OWNER DASHBOARD
========================================================= */

.owner-dashboard {
    background: #f6f7fb;
    min-height: 700px;
    padding: 50px 0 70px;
}


/* =========================================================
   SESSION ALERTS
========================================================= */

.dashboard-alert {
    border: none;
    border-radius: 12px;
    padding: 14px 18px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 500;
    box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
}

.dashboard-alert.alert-success {
    background: #ecfdf5;
    color: #047857;
}

.dashboard-alert.alert-danger {
    background: #fef2f2;
    color: #b91c1c;
}

.dashboard-alert.alert-info {
    background: #eff6ff;
    color: #1d4ed8;
}


/* =========================================================
   MAIN DASHBOARD CARD
========================================================= */

.dashboard-card {
    background: #ffffff;
    border: 1px solid #e9edf3;
    border-radius: 18px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, .055);
    height: 100%;
}


/* =========================================================
   WELCOME CARD
========================================================= */

.welcome-card {
    position: relative;
    overflow: hidden;
    padding: 32px;
    min-height: 250px;
    background:
        radial-gradient(circle at 90% 10%, rgba(255,255,255,.18), transparent 25%),
        radial-gradient(circle at 70% 100%, rgba(255,255,255,.10), transparent 30%),
        linear-gradient(135deg, #6d28d9 0%, #7c3aed 45%, #c026d3 100%);
    border: none;
    color: #ffffff;
    box-shadow: 0 18px 45px rgba(124, 58, 237, .20);
}

.welcome-card::before {
    content: "";
    position: absolute;
    width: 180px;
    height: 180px;
    border: 1px solid rgba(255,255,255,.13);
    border-radius: 50%;
    right: -60px;
    top: -65px;
}

.welcome-card::after {
    content: "";
    position: absolute;
    width: 240px;
    height: 240px;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 50%;
    right: -100px;
    top: -95px;
}

.welcome-content {
    position: relative;
    z-index: 2;
}

.welcome-small-title {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 12px;
    margin-bottom: 18px;
    border-radius: 30px;
    background: rgba(255,255,255,.13);
    border: 1px solid rgba(255,255,255,.16);
    color: rgba(255,255,255,.95);
    font-size: 12px;
    font-weight: 600;
}

.welcome-small-title i {
    font-size: 11px;
}

.welcome-card h2 {
    margin: 0 0 10px;
    color: #ffffff;
    font-size: 28px;
    line-height: 1.25;
    font-weight: 750;
}

.welcome-card p {
    max-width: 680px;
    margin: 0;
    color: rgba(255,255,255,.84);
    font-size: 14px;
    line-height: 1.8;
}


/* =========================================================
   DASHBOARD ACTIONS
========================================================= */

.dashboard-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 25px;
}

.dashboard-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 10px 16px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 650;
    text-decoration: none;
    transition: all .25s ease;
}

.dashboard-action-btn:hover {
    text-decoration: none;
    transform: translateY(-2px);
}

.add-property-btn {
    background: #ffffff;
    color: #6d28d9;
    border: 1px solid rgba(255,255,255,.8);
}

.add-property-btn:hover {
    background: #f5f3ff;
    color: #5b21b6;
}

.properties-btn {
    background: #f8fafc;
    color: #334155;
    border: 1px solid #e2e8f0;
}

.properties-btn:hover {
    background: #ede9fe;
    color: #6d28d9;
    border-color: #ddd6fe;
}

.welcome-card .properties-btn {
    background: rgba(255,255,255,.12);
    border-color: rgba(255,255,255,.18);
    color: #ffffff;
}

.welcome-card .properties-btn:hover {
    background: rgba(255,255,255,.2);
    color: #ffffff;
}

.requests-btn {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #dbeafe;
}

.requests-btn:hover {
    background: #2563eb;
    color: #ffffff;
    border-color: #2563eb;
}

.welcome-card .requests-btn {
    background: rgba(255,255,255,.12);
    border-color: rgba(255,255,255,.18);
    color: #ffffff;
}

.welcome-card .requests-btn:hover {
    background: rgba(255,255,255,.2);
    color: #ffffff;
}


/* =========================================================
   ACCOUNT CARD
========================================================= */

.account-card {
    padding: 27px;
}

.account-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-bottom: 18px;
    margin-bottom: 5px;
    border-bottom: 1px solid #f1f5f9;
}

.account-icon {
    width: 43px;
    height: 43px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ede9fe;
    color: #7c3aed;
    font-size: 17px;
}

.account-title {
    margin: 0;
    color: #1e293b;
    font-size: 17px;
    font-weight: 700;
}

.account-subtitle {
    margin: 2px 0 0;
    color: #94a3b8;
    font-size: 11px;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    padding: 11px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 13px;
}

.info-list li:last-child {
    border-bottom: none;
}

.info-label {
    color: #94a3b8;
    white-space: nowrap;
}

.info-value {
    color: #334155;
    font-weight: 650;
    text-align: right;
    word-break: break-word;
}

.account-type-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 9px;
    border-radius: 20px;
    background: #f3e8ff;
    color: #7e22ce;
    font-size: 11px;
    font-weight: 700;
}

.owner-logout-btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 10px 15px;
    border: 1px solid #fecaca;
    border-radius: 9px;
    background: #fef2f2;
    color: #b91c1c;
    font-size: 13px;
    font-weight: 650;
    cursor: pointer;
    transition: all .25s ease;
}

.owner-logout-btn:hover {
    background: #dc2626;
    border-color: #dc2626;
    color: #ffffff;
    transform: translateY(-1px);
}


/* =========================================================
   SECTION HEADER
========================================================= */

.dashboard-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 18px;
}

.section-heading {
    margin: 0;
    color: #1e293b;
    font-size: 19px;
    font-weight: 750;
}

.section-description {
    margin: 4px 0 0;
    color: #94a3b8;
    font-size: 12px;
}


/* =========================================================
   STAT CARDS
========================================================= */

.stat-card {
    position: relative;
    overflow: hidden;
    padding: 23px;
    transition: all .25s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(15, 23, 42, .10);
}

.stat-card::after {
    content: "";
    position: absolute;
    width: 85px;
    height: 85px;
    right: -35px;
    bottom: -35px;
    border-radius: 50%;
    background: rgba(148,163,184,.06);
}

.stat-icon {
    width: 48px;
    height: 48px;
    margin-bottom: 17px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.stat-number {
    color: #0f172a;
    font-size: 28px;
    line-height: 1.2;
    font-weight: 750;
}

.stat-label {
    margin-top: 5px;
    color: #64748b;
    font-size: 13px;
    font-weight: 500;
}


/* Total */

.stat-total {
    border-top: 3px solid #7c3aed;
}

.stat-total .stat-icon {
    background: #ede9fe;
    color: #7c3aed;
}


/* Active */

.stat-active {
    border-top: 3px solid #16a34a;
}

.stat-active .stat-icon {
    background: #dcfce7;
    color: #16a34a;
}


/* Pending */

.stat-pending {
    border-top: 3px solid #f59e0b;
}

.stat-pending .stat-icon {
    background: #fef3c7;
    color: #d97706;
}


/* Rejected */

.stat-rejected {
    border-top: 3px solid #dc2626;
}

.stat-rejected .stat-icon {
    background: #fee2e2;
    color: #dc2626;
}


/* Sale */

.stat-sale {
    border-top: 3px solid #2563eb;
}

.stat-sale .stat-icon {
    background: #dbeafe;
    color: #2563eb;
}


/* Rent */

.stat-rent {
    border-top: 3px solid #0891b2;
}

.stat-rent .stat-icon {
    background: #cffafe;
    color: #0891b2;
}


/* Agents */

.stat-agents {
    border-top: 3px solid #4f46e5;
}

.stat-agents .stat-icon {
    background: #e0e7ff;
    color: #4f46e5;
}


/* Enquiries */

.stat-enquiries {
    border-top: 3px solid #db2777;
}

.stat-enquiries .stat-icon {
    background: #fce7f3;
    color: #db2777;
}


/* =========================================================
   RECENT PROPERTIES CARD
========================================================= */

.recent-properties-card {
    overflow: hidden;
}

.recent-properties-header {
    padding: 23px 25px;
    border-bottom: 1px solid #eef2f7;
}

.view-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 13px;
    border-radius: 8px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 12px;
    font-weight: 650;
    text-decoration: none;
    transition: all .2s ease;
}

.view-all-btn:hover {
    background: #ede9fe;
    border-color: #ddd6fe;
    color: #6d28d9;
    text-decoration: none;
}


/* =========================================================
   PROPERTY TABLE
========================================================= */

.property-table-wrapper {
    width: 100%;
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
}

.property-table {
    width: 100%;
    min-width: 900px;
    border-collapse: separate;
    border-spacing: 0;
}

.property-table th {
    padding: 13px 15px;
    text-align: left;
    background: #f8fafc;
    color: #64748b;
    border-bottom: 1px solid #e2e8f0;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .35px;
    white-space: nowrap;
}

.property-table td {
    padding: 15px;
    color: #334155;
    border-bottom: 1px solid #f1f5f9;
    font-size: 12px;
    vertical-align: middle;
    white-space: nowrap;
}

.property-table tbody tr {
    transition: all .2s ease;
}

.property-table tbody tr:hover {
    background: #faf9ff;
}

.property-table tbody tr:last-child td {
    border-bottom: none;
}


/* =========================================================
   PROPERTY INFO
========================================================= */

.property-info {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 210px;
}

.property-icon {
    width: 43px;
    height: 43px;
    min-width: 43px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #ede9fe;
    color: #7c3aed;
    font-size: 17px;
}

.property-details {
    min-width: 0;
}

.property-title {
    max-width: 210px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #1e293b;
    font-size: 12px;
    font-weight: 700;
}

.property-location {
    max-width: 210px;
    margin-top: 3px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #94a3b8;
    font-size: 10px;
}


/* =========================================================
   TYPE BADGE
========================================================= */

.type-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 5px 9px;
    border-radius: 20px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 10px;
    font-weight: 650;
}


/* =========================================================
   PURPOSE BADGE
========================================================= */

.purpose-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 700;
    text-transform: capitalize;
}

.purpose-sale {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #dbeafe;
}

.purpose-rent {
    background: #ecfeff;
    color: #0e7490;
    border: 1px solid #cffafe;
}


/* =========================================================
   STATUS BADGES
========================================================= */

.status-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 700;
    text-transform: capitalize;
    white-space: nowrap;
}

.status-approved {
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #d1fae5;
}

.status-pending {
    background: #fffbeb;
    color: #b45309;
    border: 1px solid #fde68a;
}

.status-rejected {
    background: #fef2f2;
    color: #b91c1c;
    border: 1px solid #fecaca;
}

.status-available {
    background: #ecfdf5;
    color: #166534;
}

.status-sold {
    background: #f1f5f9;
    color: #475569;
}

.status-rented {
    background: #eff6ff;
    color: #0369a1;
}


/* =========================================================
   AGENT
========================================================= */

.agent-info {
    display: flex;
    align-items: center;
    gap: 8px;
}

.agent-avatar {
    width: 29px;
    height: 29px;
    min-width: 29px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #e0e7ff;
    color: #4f46e5;
    font-size: 11px;
}

.agent-name {
    max-width: 125px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #334155;
    font-size: 11px;
    font-weight: 650;
}


/* =========================================================
   PROPERTY ACTIONS
========================================================= */

.property-actions {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: nowrap;
}

.property-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    min-height: 31px;
    padding: 6px 9px;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 650;
    text-decoration: none;
    transition: all .2s ease;
}

.property-action-btn:hover {
    text-decoration: none;
    transform: translateY(-1px);
}

.view-btn {
    background: #f8fafc;
    color: #475569;
    border: 1px solid #e2e8f0;
}

.view-btn:hover {
    background: #7c3aed;
    border-color: #7c3aed;
    color: #ffffff;
}

.edit-btn {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #dbeafe;
}

.edit-btn:hover {
    background: #2563eb;
    border-color: #2563eb;
    color: #ffffff;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    padding: 65px 20px;
    text-align: center;
}

.empty-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 17px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    color: #cbd5e1;
    font-size: 28px;
}

.empty-state h4 {
    margin: 0 0 7px;
    color: #334155;
    font-size: 17px;
    font-weight: 700;
}

.empty-state p {
    margin: 0 0 20px;
    color: #94a3b8;
    font-size: 13px;
}


/* =========================================================
   ENQUIRY INFORMATION
========================================================= */

.enquiry-notice {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-top: 20px;
    padding: 14px 16px;
    border-radius: 11px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    color: #64748b;
    font-size: 12px;
    line-height: 1.6;
}

.enquiry-notice i {
    margin-top: 2px;
    color: #db2777;
    font-size: 16px;
}


/* =========================================================
   QUICK OVERVIEW LABEL
========================================================= */

.stats-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
}

.stats-heading-icon {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #ede9fe;
    color: #7c3aed;
    font-size: 14px;
}

.stats-heading h3 {
    margin: 0;
    color: #1e293b;
    font-size: 18px;
    font-weight: 750;
}

.stats-heading p {
    margin: 2px 0 0;
    color: #94a3b8;
    font-size: 11px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991px) {

    .owner-dashboard {
        padding: 40px 0 55px;
    }

    .welcome-card {
        min-height: auto;
    }

    .account-card {
        min-height: auto;
    }

}


@media (max-width: 767px) {

    .owner-dashboard {
        padding: 30px 0 45px;
    }

    .welcome-card {
        padding: 25px;
        border-radius: 15px;
    }

    .welcome-card h2 {
        font-size: 23px;
    }

    .welcome-card p {
        font-size: 13px;
    }

    .dashboard-actions {
        flex-direction: column;
    }

    .dashboard-action-btn {
        width: 100%;
    }

    .account-card {
        padding: 22px;
    }

    .stat-card {
        padding: 20px;
    }

    .stat-number {
        font-size: 25px;
    }

    .dashboard-section-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .view-all-btn {
        align-self: flex-start;
    }

    .property-table {
        min-width: 900px;
    }

}


@media (max-width: 575px) {

    .owner-dashboard {
        padding: 25px 0 40px;
    }

    .welcome-card {
        padding: 22px;
    }

    .welcome-card h2 {
        font-size: 21px;
    }

    .account-card {
        padding: 20px;
    }

    .section-heading {
        font-size: 17px;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        margin-bottom: 14px;
    }

    .stat-number {
        font-size: 24px;
    }

    .enquiry-notice {
        font-size: 11px;
    }

}

</style>


{{-- =========================================================
     DASHBOARD CONTENT
========================================================= --}}

<section class="owner-dashboard">

    <div class="container">


        {{-- =====================================================
             SESSION MESSAGES
        ====================================================== --}}

        @if(session('success'))

            <div class="alert alert-success dashboard-alert">
                <i class="fa fa-check-circle mr-1"></i>
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger dashboard-alert">
                <i class="fa fa-exclamation-circle mr-1"></i>
                {{ session('error') }}
            </div>

        @endif


        @if(session('info'))

            <div class="alert alert-info dashboard-alert">
                <i class="fa fa-info-circle mr-1"></i>
                {{ session('info') }}
            </div>

        @endif



        {{-- =====================================================
             WELCOME + ACCOUNT
        ====================================================== --}}

        <div class="row mb-5">


            {{-- =================================================
                 WELCOME
            ================================================== --}}

            <div class="col-lg-8 mb-4 mb-lg-0">

                <div class="dashboard-card welcome-card">

                    <div class="welcome-content">

                        <div class="welcome-small-title">
                            <i class="fa fa-home"></i>
                            Owner Workspace
                        </div>


                        <h2>
                            Hello, {{ $owner->name }} 👋
                        </h2>


                        <p>
                            Welcome to your owner dashboard. Manage your properties,
                            monitor approval status, check assigned agents and keep
                            track of your property activity from one place.
                        </p>


                        <div class="dashboard-actions">

                            <a
                                href="{{ route('owner.properties.create') }}"
                                class="dashboard-action-btn add-property-btn"
                            >
                                <i class="fa fa-plus"></i>
                                Add Property
                            </a>


                            <a
                                href="{{ route('owner.properties.index') }}"
                                class="dashboard-action-btn properties-btn"
                            >
                                <i class="fa fa-building"></i>
                                My Properties
                            </a>


                            <a
                                href="{{ route('owner.property-transactions.index') }}"
                                class="dashboard-action-btn requests-btn"
                            >
                                <i class="fa fa-list"></i>
                                Property Requests
                            </a>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 ACCOUNT
            ================================================== --}}

            <div class="col-lg-4">

                <div class="dashboard-card account-card">

                    <div class="account-header">

                        <div class="account-icon">
                            <i class="fa fa-user"></i>
                        </div>

                        <div>

                            <h3 class="account-title">
                                My Account
                            </h3>

                            <p class="account-subtitle">
                                Account information
                            </p>

                        </div>

                    </div>


                    <ul class="info-list">

                        <li>

                            <span class="info-label">
                                Name
                            </span>

                            <span class="info-value">
                                {{ $owner->name }}
                            </span>

                        </li>


                        <li>

                            <span class="info-label">
                                Email
                            </span>

                            <span class="info-value">
                                {{ $owner->email }}
                            </span>

                        </li>


                        <li>

                            <span class="info-label">
                                Account Type
                            </span>

                            <span class="info-value">

                                <span class="account-type-badge">
                                    <i class="fa fa-user"></i>
                                    Owner
                                </span>

                            </span>

                        </li>

                    </ul>


                    <div style="margin-top:15px;">

                        <form
                            action="{{ route('user.logout') }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="owner-logout-btn"
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
             PROPERTY OVERVIEW HEADING
        ====================================================== --}}

        <div class="stats-heading">

            <div class="stats-heading-icon">
                <i class="fa fa-bar-chart"></i>
            </div>

            <div>

                <h3>
                    Property Overview
                </h3>

                <p>
                    Quick summary of your property portfolio
                </p>

            </div>

        </div>



        {{-- =====================================================
             MAIN PROPERTY STATISTICS
        ====================================================== --}}

        <div class="row mb-4">


            {{-- Total --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-total">

                    <div class="stat-icon">
                        <i class="fa fa-building"></i>
                    </div>

                    <div class="stat-number">
                        {{ $totalProperties }}
                    </div>

                    <div class="stat-label">
                        Total Properties
                    </div>

                </div>

            </div>



            {{-- Active --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-active">

                    <div class="stat-icon">
                        <i class="fa fa-check-circle"></i>
                    </div>

                    <div class="stat-number">
                        {{ $activeProperties }}
                    </div>

                    <div class="stat-label">
                        Active Properties
                    </div>

                </div>

            </div>



            {{-- Pending --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-pending">

                    <div class="stat-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>

                    <div class="stat-number">
                        {{ $pendingProperties }}
                    </div>

                    <div class="stat-label">
                        Pending Properties
                    </div>

                </div>

            </div>



            {{-- Rejected --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-rejected">

                    <div class="stat-icon">
                        <i class="fa fa-times-circle"></i>
                    </div>

                    <div class="stat-number">
                        {{ $rejectedProperties }}
                    </div>

                    <div class="stat-label">
                        Rejected Properties
                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
             SECONDARY STATISTICS
        ====================================================== --}}

        <div class="row mb-5">


            {{-- For Sale --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-sale">

                    <div class="stat-icon">
                        <i class="fa fa-tag"></i>
                    </div>

                    <div class="stat-number">
                        {{ $forSaleProperties }}
                    </div>

                    <div class="stat-label">
                        Properties For Sale
                    </div>

                </div>

            </div>



            {{-- For Rent --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-rent">

                    <div class="stat-icon">
                        <i class="fa fa-home"></i>
                    </div>

                    <div class="stat-number">
                        {{ $forRentProperties }}
                    </div>

                    <div class="stat-label">
                        Properties For Rent
                    </div>

                </div>

            </div>



            {{-- Assigned Agents --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-agents">

                    <div class="stat-icon">
                        <i class="fa fa-users"></i>
                    </div>

                    <div class="stat-number">
                        {{ $assignedAgents }}
                    </div>

                    <div class="stat-label">
                        Assigned Agents
                    </div>

                </div>

            </div>



            {{-- Enquiries --}}

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="dashboard-card stat-card stat-enquiries">

                    <div class="stat-icon">
                        <i class="fa fa-envelope"></i>
                    </div>

                    <div class="stat-number">
                        {{ $propertyEnquiries }}
                    </div>

                    <div class="stat-label">
                        Property Enquiries
                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
             RECENT PROPERTIES
        ====================================================== --}}

        <div class="dashboard-card recent-properties-card">


            {{-- Header --}}

            <div class="recent-properties-header">

                <div class="dashboard-section-header mb-0">

                    <div>

                        <h3 class="section-heading">
                            Recent Properties
                        </h3>

                        <p class="section-description">
                            Your latest property listings
                        </p>

                    </div>


                    <a
                        href="{{ route('owner.properties.index') }}"
                        class="view-all-btn"
                    >
                        View All
                        <i class="fa fa-arrow-right"></i>
                    </a>

                </div>

            </div>



            {{-- =================================================
                 PROPERTY LIST
            ================================================== --}}

            @if($recentProperties->count())


                <div class="property-table-wrapper">

                    <table class="property-table">

                        <thead>

                            <tr>

                                <th>
                                    Property
                                </th>

                                <th>
                                    Type
                                </th>

                                <th>
                                    Purpose
                                </th>

                                <th>
                                    Price
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Agent
                                </th>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @foreach($recentProperties as $property)

                                <tr>


                                    {{-- =================================================
                                         PROPERTY
                                    ================================================== --}}

                                    <td>

                                        <div class="property-info">

                                            <div class="property-icon">
                                                <i class="fa fa-home"></i>
                                            </div>


                                            <div class="property-details">

                                                <div class="property-title">
                                                    {{ $property->title ?? 'Property' }}
                                                </div>


                                                @if($property->location)

                                                    <div class="property-location">

                                                        {{ $property->location->city ?? '' }}

                                                        @if($property->location->state)
                                                            , {{ $property->location->state }}
                                                        @endif

                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    </td>



                                    {{-- =================================================
                                         TYPE
                                    ================================================== --}}

                                    <td>

                                        <span class="type-badge">

                                            {{ $property->propertyType->name ?? 'N/A' }}

                                        </span>

                                    </td>



                                    {{-- =================================================
                                         PURPOSE
                                    ================================================== --}}

                                    <td>

                                        @if($property->purpose === 'sale')

                                            <span class="purpose-badge purpose-sale">
                                                <i class="fa fa-tag"></i>
                                                Sale
                                            </span>

                                        @elseif($property->purpose === 'rent')

                                            <span class="purpose-badge purpose-rent">
                                                <i class="fa fa-home"></i>
                                                Rent
                                            </span>

                                        @else

                                            <span class="type-badge">
                                                {{ ucfirst($property->purpose ?? 'N/A') }}
                                            </span>

                                        @endif

                                    </td>



                                    {{-- =================================================
                                         PRICE
                                    ================================================== --}}

                                    <td>

                                        <strong style="color:#1e293b; font-size:12px;">

                                            ₹{{ number_format((float) ($property->price ?? 0), 2) }}

                                        </strong>

                                    </td>



                                    {{-- =================================================
                                         STATUS
                                    ================================================== --}}

                                    <td>

                                        @if($property->approval_status === 'approved')

                                            <span class="status-badge status-approved">
                                                <i class="fa fa-check"></i>
                                                Approved
                                            </span>

                                        @elseif($property->approval_status === 'pending')

                                            <span class="status-badge status-pending">
                                                <i class="fa fa-clock-o"></i>
                                                Pending
                                            </span>

                                        @elseif($property->approval_status === 'rejected')

                                            <span class="status-badge status-rejected">
                                                <i class="fa fa-times"></i>
                                                Rejected
                                            </span>

                                        @else

                                            <span class="status-badge">
                                                {{ ucfirst($property->approval_status ?? 'N/A') }}
                                            </span>

                                        @endif

                                    </td>



                                    {{-- =================================================
                                         AGENT
                                    ================================================== --}}

                                    <td>

                                        @if($property->agent)

                                            <div class="agent-info">

                                                <div class="agent-avatar">
                                                    <i class="fa fa-user"></i>
                                                </div>

                                                <div class="agent-name">
                                                    {{ $property->agent->name }}
                                                </div>

                                            </div>

                                        @else

                                            <span style="color:#94a3b8;">
                                                Not Assigned
                                            </span>

                                        @endif

                                    </td>



                                    {{-- =================================================
                                         DATE
                                    ================================================== --}}

                                    <td>

                                        <span style="color:#64748b; font-size:11px;">

                                            {{ $property->created_at?->format('d M Y') }}

                                        </span>

                                    </td>



                                    {{-- =================================================
                                         ACTIONS
                                    ================================================== --}}

                                    <td>

                                        <div class="property-actions">

                                            <a
                                                href="{{ route('owner.properties.show', $property) }}"
                                                class="property-action-btn view-btn"
                                            >
                                                <i class="fa fa-eye"></i>
                                                View
                                            </a>


                                            <a
                                                href="{{ route('owner.properties.edit', $property) }}"
                                                class="property-action-btn edit-btn"
                                            >
                                                <i class="fa fa-pencil"></i>
                                                Edit
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

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="fa fa-building"></i>
                    </div>

                    <h4>
                        No Properties Yet
                    </h4>

                    <p>
                        You haven't added any properties yet.
                        Start by creating your first property listing.
                    </p>


                    <a
                        href="{{ route('owner.properties.create') }}"
                        class="dashboard-action-btn add-property-btn"
                        style="background:#7c3aed; color:#ffffff;"
                    >
                        <i class="fa fa-plus"></i>
                        Add Your First Property
                    </a>

                </div>


            @endif


        </div>



        {{-- =====================================================
             ENQUIRY INFORMATION
        ====================================================== --}}

        <div class="enquiry-notice">

            <i class="fa fa-info-circle"></i>

            <span>
                Property enquiry management will be available here once
                the dedicated property enquiry module is implemented.
            </span>

        </div>


    </div>

</section>

@endsection