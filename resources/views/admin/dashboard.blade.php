@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-6">

{{-- =========================================================
PAGE HEADER
========================================================== --}}

<div>


<h1 class="text-2xl font-bold text-white">
    Dashboard
</h1>

<p class="mt-1 text-sm text-gray-400">
    Welcome to your RealState admin panel.
</p>


</div>

{{-- =========================================================
PROPERTY STAT CARDS
========================================================== --}}

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

{{-- =====================================================
TOTAL PROPERTIES
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-purple-500/20 bg-gradient-to-br from-purple-500/20 via-purple-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-purple-400/40 hover:shadow-xl hover:shadow-purple-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-purple-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-purple-300">
            Total Properties
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $totalProperties }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            All properties
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-purple-500 to-violet-600 text-white shadow-lg shadow-purple-900/40">

        <i class="fa-solid fa-building text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
PROPERTY TYPES
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-orange-500/20 bg-gradient-to-br from-orange-500/20 via-orange-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-orange-400/40 hover:shadow-xl hover:shadow-orange-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-orange-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-orange-300">
            Property Types
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $totalPropertyTypes }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Property categories
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white shadow-lg shadow-orange-900/40">

        <i class="fa-solid fa-layer-group text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
LOCATIONS
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-emerald-500/20 bg-gradient-to-br from-emerald-500/20 via-emerald-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-emerald-400/40 hover:shadow-xl hover:shadow-emerald-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-emerald-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-emerald-300">
            Locations
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $totalLocations }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Property locations
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-green-600 text-white shadow-lg shadow-emerald-900/40">

        <i class="fa-solid fa-location-dot text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
AGENTS
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-pink-500/20 bg-gradient-to-br from-pink-500/20 via-pink-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-pink-400/40 hover:shadow-xl hover:shadow-pink-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-pink-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-pink-300">
            Total Agents
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $totalAgents }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Registered agents
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-pink-500 to-rose-600 text-white shadow-lg shadow-pink-900/40">

        <i class="fa-solid fa-user-tie text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
AVAILABLE PROPERTIES
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-cyan-500/20 bg-gradient-to-br from-cyan-500/20 via-cyan-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-cyan-400/40 hover:shadow-xl hover:shadow-cyan-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-cyan-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-cyan-300">
            Available Properties
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $availableProperties }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Currently available
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-500 to-teal-500 text-white shadow-lg shadow-cyan-900/40">

        <i class="fa-solid fa-house-circle-check text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
FEATURED PROPERTIES
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-yellow-500/20 bg-gradient-to-br from-yellow-500/20 via-yellow-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-yellow-400/40 hover:shadow-xl hover:shadow-yellow-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-yellow-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-yellow-300">
            Featured Properties
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $featuredProperties }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Featured listings
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-yellow-500 to-amber-500 text-white shadow-lg shadow-yellow-900/40">

        <i class="fa-solid fa-star text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
FOR SALE
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-lime-500/20 bg-gradient-to-br from-lime-500/20 via-lime-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-lime-400/40 hover:shadow-xl hover:shadow-lime-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-lime-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-lime-300">
            For Sale
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $forSaleProperties }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Available properties for sale
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-lime-500 to-green-600 text-white shadow-lg shadow-lime-900/40">

        <i class="fa-solid fa-house text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
FOR RENT
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-blue-500/20 bg-gradient-to-br from-blue-500/20 via-blue-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-blue-400/40 hover:shadow-xl hover:shadow-blue-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-blue-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-blue-300">
            For Rent
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $forRentProperties }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Available properties for rent
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-900/40">

        <i class="fa-solid fa-key text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
SOLD PROPERTIES
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-red-500/20 bg-gradient-to-br from-red-500/20 via-red-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-red-400/40 hover:shadow-xl hover:shadow-red-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-red-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-red-300">
            Sold Properties
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $soldProperties }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Successfully sold properties
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-red-500 to-rose-600 text-white shadow-lg shadow-red-900/40">

        <i class="fa-solid fa-house-circle-xmark text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
RENTED PROPERTIES
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-violet-500/20 bg-gradient-to-br from-violet-500/20 via-violet-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-violet-400/40 hover:shadow-xl hover:shadow-violet-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-violet-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-violet-300">
            Rented Properties
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $rentedProperties }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Successfully rented properties
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 text-white shadow-lg shadow-violet-900/40">

        <i class="fa-solid fa-key text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
TOTAL PROPERTY VALUE
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-amber-500/20 bg-gradient-to-br from-amber-500/20 via-amber-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-amber-400/40 hover:shadow-xl hover:shadow-amber-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-amber-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-amber-300">
            Total Property Value
        </p>

        <h2 class="mt-2 text-2xl font-bold text-white">
            ₹{{ number_format($totalPropertyValue, 2) }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Combined property value
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-lg shadow-amber-900/40">

        <i class="fa-solid fa-indian-rupee-sign text-xl"></i>

    </div>

</div>


</div>



{{-- =====================================================
APPROVED PROPERTIES
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-emerald-500/20 bg-gradient-to-br from-emerald-500/20 via-emerald-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-emerald-400/40 hover:shadow-xl hover:shadow-emerald-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-emerald-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-emerald-300">
            Approved Properties
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $approvedProperties ?? 0 }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Approved by Super Admin
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-green-600 text-white shadow-lg shadow-emerald-900/40">

        <i class="fa-solid fa-circle-check text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
REJECTED PROPERTIES
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-red-500/20 bg-gradient-to-br from-red-500/20 via-red-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-red-400/40 hover:shadow-xl hover:shadow-red-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-red-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-red-300">
            Rejected Properties
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $rejectedProperties ?? 0 }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Properties not approved
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-red-500 to-rose-600 text-white shadow-lg shadow-red-900/40">

        <i class="fa-solid fa-circle-xmark text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
NEWSLETTER SUBSCRIBERS
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-sky-500/20 bg-gradient-to-br from-sky-500/20 via-sky-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-sky-400/40 hover:shadow-xl hover:shadow-sky-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-sky-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-sky-300">
            Newsletter Subscribers
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $totalNewsletterSubscribers }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Active subscribers
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-500 to-cyan-600 text-white shadow-lg shadow-sky-900/40">

        <i class="fa-solid fa-envelope text-xl"></i>

    </div>

</div>


</div>

{{-- =====================================================
CONTACT MESSAGES
====================================================== --}}

<div class="group relative overflow-hidden rounded-2xl border border-rose-500/20 bg-gradient-to-br from-rose-500/20 via-rose-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-rose-400/40 hover:shadow-xl hover:shadow-rose-900/30">


<div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-rose-500/10 blur-2xl"></div>

<div class="relative flex items-center justify-between">

    <div>

        <p class="text-sm font-medium text-rose-300">
            Contact Messages
        </p>

        <h2 class="mt-2 text-3xl font-bold text-white">
            {{ $totalContactMessages }}
        </h2>

        <p class="mt-2 text-xs text-gray-500">
            Total messages received
        </p>

    </div>

    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-rose-500 to-pink-600 text-white shadow-lg shadow-rose-900/40">

        <i class="fa-solid fa-comments text-xl"></i>

    </div>

</div>


</div>

</div>

{{-- =========================================================
PROPERTY REQUESTS
========================================================== --}}

<div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-900">


{{-- HEADER --}}

<div class="flex flex-col gap-3 border-b border-gray-800 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

    <div>

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 text-white shadow-lg shadow-purple-900/30">

                <i class="fa-solid fa-file-signature"></i>

            </div>

            <div>

                <h2 class="text-lg font-semibold text-white">
                    Property Requests
                </h2>

                <p class="text-sm text-gray-400">
                    Manage buy and rental requests
                </p>

            </div>

        </div>

    </div>


    @if(Route::has('admin.property-transactions.index'))

        <a
            href="{{ route('admin.property-transactions.index') }}"
            class="inline-flex w-fit items-center gap-2 rounded-lg bg-gradient-to-r from-purple-600 to-fuchsia-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-purple-900/20 transition hover:from-purple-500 hover:to-fuchsia-500">

            <i class="fa-solid fa-list-check"></i>

            View All Requests

        </a>

    @endif

</div>


{{-- REQUEST CARDS --}}

<div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2 lg:grid-cols-4">


    {{-- TOTAL REQUESTS --}}

    <div class="group rounded-2xl border border-purple-500/20 bg-purple-500/10 p-5 transition hover:-translate-y-1 hover:border-purple-400/40 hover:bg-purple-500/15">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-purple-300">
                    Total Requests
                </p>

                <h3 class="mt-2 text-3xl font-bold text-white">
                    {{ $totalRequests ?? 0 }}
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    All property requests
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500/20 text-purple-400">

                <i class="fa-solid fa-file-lines text-lg"></i>

            </div>

        </div>

    </div>


    {{-- PENDING REQUESTS --}}

    <div class="group rounded-2xl border border-yellow-500/20 bg-yellow-500/10 p-5 transition hover:-translate-y-1 hover:border-yellow-400/40 hover:bg-yellow-500/15">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-yellow-300">
                    Pending Requests
                </p>

                <h3 class="mt-2 text-3xl font-bold text-white">
                    {{ $pendingRequests ?? 0 }}
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Awaiting review
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-500/20 text-yellow-400">

                <i class="fa-solid fa-clock text-lg"></i>

            </div>

        </div>

    </div>


    {{-- APPROVED REQUESTS --}}

    <div class="group rounded-2xl border border-cyan-500/20 bg-cyan-500/10 p-5 transition hover:-translate-y-1 hover:border-cyan-400/40 hover:bg-cyan-500/15">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-cyan-300">
                    Approved
                </p>

                <h3 class="mt-2 text-3xl font-bold text-white">
                    {{ $approvedRequests ?? 0 }}
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Approved requests
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-500/20 text-cyan-400">

                <i class="fa-solid fa-circle-check text-lg"></i>

            </div>

        </div>

    </div>


    {{-- COMPLETED DEALS --}}

    <div class="group rounded-2xl border border-emerald-500/20 bg-emerald-500/10 p-5 transition hover:-translate-y-1 hover:border-emerald-400/40 hover:bg-emerald-500/15">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-emerald-300">
                    Completed Deals
                </p>

                <h3 class="mt-2 text-3xl font-bold text-white">
                    {{ $completedRequests ?? 0 }}
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Successfully completed
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500/20 text-emerald-400">

                <i class="fa-solid fa-handshake text-lg"></i>

            </div>

        </div>

    </div>


    {{-- BUY REQUESTS --}}

    <div class="group rounded-2xl border border-blue-500/20 bg-blue-500/10 p-5 transition hover:-translate-y-1 hover:border-blue-400/40 hover:bg-blue-500/15">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-blue-300">
                    Buy Requests
                </p>

                <h3 class="mt-2 text-3xl font-bold text-white">
                    {{ $buyRequests ?? 0 }}
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Property purchase requests
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-500/20 text-blue-400">

                <i class="fa-solid fa-cart-shopping text-lg"></i>

            </div>

        </div>

    </div>


    {{-- RENT REQUESTS --}}

    <div class="group rounded-2xl border border-indigo-500/20 bg-indigo-500/10 p-5 transition hover:-translate-y-1 hover:border-indigo-400/40 hover:bg-indigo-500/15">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-indigo-300">
                    Rent Requests
                </p>

                <h3 class="mt-2 text-3xl font-bold text-white">
                    {{ $rentRequests ?? 0 }}
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Property rental requests
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500/20 text-indigo-400">

                <i class="fa-solid fa-key text-lg"></i>

            </div>

        </div>

    </div>


    {{-- COUNTER OFFERS --}}

    <div class="group rounded-2xl border border-orange-500/20 bg-orange-500/10 p-5 transition hover:-translate-y-1 hover:border-orange-400/40 hover:bg-orange-500/15">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-orange-300">
                    Counter Offers
                </p>

                <h3 class="mt-2 text-3xl font-bold text-white">
                    {{ $counterOffers ?? 0 }}
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Requests with counter offer
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-500/20 text-orange-400">

                <i class="fa-solid fa-arrow-right-arrow-left text-lg"></i>

            </div>

        </div>

    </div>


    {{-- REJECTED REQUESTS --}}

    <div class="group rounded-2xl border border-red-500/20 bg-red-500/10 p-5 transition hover:-translate-y-1 hover:border-red-400/40 hover:bg-red-500/15">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-red-300">
                    Rejected
                </p>

                <h3 class="mt-2 text-3xl font-bold text-white">
                    {{ $rejectedRequests ?? 0 }}
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Rejected requests
                </p>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-500/20 text-red-400">

                <i class="fa-solid fa-circle-xmark text-lg"></i>

            </div>

        </div>

    </div>


</div>


</div>

{{-- =========================================================
RECENT PROPERTIES
========================================================== --}}

<div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-900">

{{-- HEADER --}}

<div class="flex flex-col gap-3 border-b border-gray-800 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">


<div>

    <h2 class="text-lg font-semibold text-white">
        Recent Properties
    </h2>

    <p class="text-sm text-gray-400">
        Recently added properties and their approval status
    </p>

</div>


<a
    href="{{ route('admin.properties.index') }}"
    class="inline-flex w-fit items-center gap-2 rounded-lg bg-gradient-to-r from-purple-600 to-fuchsia-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-purple-900/20 transition hover:from-purple-500 hover:to-fuchsia-500">

    <i class="fa-solid fa-building"></i>

    View All

</a>


</div>

@if($recentProperties->count())


<div class="overflow-x-auto">

    <table class="w-full min-w-[1100px] text-left">


        {{-- TABLE HEADER --}}

        <thead class="border-b border-gray-800 bg-gray-950">

            <tr>

                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Property
                </th>

                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Type
                </th>

                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Location
                </th>

                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Price
                </th>

                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Status
                </th>

                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Approval
                </th>

                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Visibility
                </th>

            </tr>

        </thead>


        {{-- TABLE BODY --}}

        <tbody class="divide-y divide-gray-800">

            @foreach($recentProperties as $property)

                <tr class="transition hover:bg-gray-800/50">


                    {{-- PROPERTY WITH PHOTO --}}

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('admin.properties.show', $property) }}"
                            class="group flex items-center gap-4">

                            {{-- PROPERTY IMAGE --}}

                            <div class="h-16 w-20 shrink-0 overflow-hidden rounded-xl border border-gray-700 bg-gray-800">

                                @php

                                    $propertyPhoto = null;

                                    if (
                                        is_array($property->photos)
                                        && count($property->photos)
                                    ) {

                                        $propertyPhoto = $property->photos[0];

                                    }

                                @endphp


                                @if($propertyPhoto)

                                    <img
                                        src="{{ asset('storage/' . ltrim($propertyPhoto, '/')) }}"
                                        alt="{{ $property->title }}"
                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-110">

                                @else

                                    <div class="flex h-full w-full items-center justify-center">

                                        <i class="fa-solid fa-house text-xl text-gray-600"></i>

                                    </div>

                                @endif
                                

                            </div>


                            {{-- PROPERTY INFO --}}

<div class="min-w-0 flex-1">

    {{-- PROPERTY TITLE --}}

    <p class="truncate font-medium text-white transition group-hover:text-purple-400">

        {{ $property->title }}

    </p>


    {{-- PROPERTY ID --}}

    <p class="mt-1 flex items-center gap-1 text-xs text-gray-500">

        <i class="fa-solid fa-hashtag"></i>

        {{ $property->id }}

    </p>


    {{-- OWNER DETAILS --}}

    @if($property->owner)

        <div class="mt-3">

            <div class="flex items-center gap-2">

                {{-- OWNER AVATAR --}}

                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-purple-500/10 text-xs font-bold text-purple-400">

                    {{ strtoupper(substr($property->owner->name ?? 'O', 0, 1)) }}

                </div>


                {{-- OWNER INFO --}}

                <div class="min-w-0">

                    <div class="flex items-center gap-2">

                        <span class="text-xs font-semibold text-gray-200">

                            {{ $property->owner->name }}

                        </span>

                        <span class="rounded-full bg-emerald-500/10 px-2 py-0.5 text-[9px] font-semibold text-emerald-400">

                            Owner

                        </span>

                    </div>


                    @if($property->owner->email)

                        <div class="mt-0.5 truncate text-[10px] text-gray-500">

                            {{ $property->owner->email }}

                        </div>

                    @endif


                    @if($property->owner->phone)

                        <div class="mt-0.5 text-[10px] text-gray-500">

                            {{ $property->owner->phone }}

                        </div>

                    @endif

                </div>

            </div>

        </div>

    @endif

</div>

                        </a>

                    </td>


                    {{-- TYPE --}}

                    <td class="px-6 py-4 text-sm text-gray-400">

                        {{ $property->propertyType->name ?? '—' }}

                    </td>


                    {{-- LOCATION --}}

                    <td class="px-6 py-4 text-sm text-gray-400">

                        <span class="inline-flex items-center gap-2">

                            <i class="fa-solid fa-location-dot text-emerald-400"></i>

                            {{ $property->location->city ?? '—' }}

                        </span>

                    </td>


                    {{-- PRICE --}}

                    <td class="px-6 py-4 text-sm font-medium text-white">

                        ₹{{ number_format((float) $property->price, 2) }}

                    </td>


                    {{-- MARKET STATUS --}}

                    <td class="px-6 py-4">

                        @if($property->status === 'available')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                Available

                            </span>

                        @elseif($property->status === 'sold')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                Sold

                            </span>

                        @elseif($property->status === 'rented')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-violet-500/10 px-3 py-1 text-xs font-medium text-violet-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-violet-400"></span>

                                Rented

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-medium text-yellow-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-yellow-400"></span>

                                {{ ucfirst($property->status ?? 'Unknown') }}

                            </span>

                        @endif

                    </td>


                    {{-- APPROVAL STATUS --}}

                    <td class="px-6 py-4">

                        @if($property->approval_status === 'approved')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                Approved

                            </span>

                        @elseif($property->approval_status === 'rejected')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                Rejected

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-medium text-yellow-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-yellow-400"></span>

                                Pending Review

                            </span>

                        @endif

                    </td>


                    {{-- VISIBILITY --}}

                    <td class="px-6 py-4">

                        @if(
                            $property->approval_status === 'approved'
                            && $property->is_active
                            && $property->status === 'available'
                        )

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                                <i class="fa-solid fa-globe text-[10px]"></i>

                                Live

                            </span>

                        @elseif($property->approval_status === 'pending')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-medium text-yellow-400">

                                <i class="fa-solid fa-clock text-[10px]"></i>

                                Not Public

                            </span>

                        @elseif($property->approval_status === 'rejected')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                                <i class="fa-solid fa-ban text-[10px]"></i>

                                Not Public

                            </span>

                        @elseif($property->status !== 'available')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-500/10 px-3 py-1 text-xs font-medium text-gray-400">

                                <i class="fa-solid fa-house-circle-xmark text-[10px]"></i>

                                Not Public

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-500/10 px-3 py-1 text-xs font-medium text-gray-400">

                                <i class="fa-solid fa-eye-slash text-[10px]"></i>

                                Not Public

                            </span>

                        @endif

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

<div class="px-6 py-12 text-center">

    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-purple-500/10">

        <i class="fa-solid fa-house text-2xl text-purple-400"></i>

    </div>


    <h3 class="mt-4 text-lg font-semibold text-white">

        No Properties Yet

    </h3>


    <p class="mt-2 text-sm text-gray-400">

        Start by adding your first property.

    </p>


    <a
        href="{{ route('admin.properties.create') }}"
        class="mt-5 inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-purple-600 to-fuchsia-600 px-5 py-2.5 text-sm font-medium text-white shadow-lg shadow-purple-900/20 transition hover:from-purple-500 hover:to-fuchsia-500">

        <i class="fa-solid fa-plus"></i>

        Add Property

    </a>

</div>


@endif

</div>

</div>

@endsection
