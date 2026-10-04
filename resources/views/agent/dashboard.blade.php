@extends('agent.layouts.app')

@section('title', 'Agent Dashboard')
@section('page-title', 'Dashboard')

@section('content')

@php
    $agent = auth('agent')->user();
@endphp

<div class="space-y-6">


{{-- =========================================================
     PAGE HEADER
========================================================== --}}

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>

        <h1 class="text-2xl font-bold text-white">
            Welcome, {{ $agent->name }} 👋
        </h1>

        <p class="mt-1 text-sm text-gray-400">
            Manage your properties and track your listings.
        </p>

    </div>

    <a
        href="{{ route('agent.properties.create') }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-fuchsia-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-900/30 transition hover:-translate-y-0.5 hover:from-purple-500 hover:to-fuchsia-500"
    >

        <i class="fa-solid fa-plus"></i>

        Add Property

    </a>

</div>


{{-- =========================================================
     MAIN STAT CARDS
========================================================== --}}

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


    {{-- TOTAL PROPERTIES --}}

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
                    Properties in your portfolio
                </p>

            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-purple-500 to-violet-600 text-white shadow-lg shadow-purple-900/40">

                <i class="fa-solid fa-building text-xl"></i>

            </div>

        </div>

    </div>


    {{-- AVAILABLE --}}

    <div class="group relative overflow-hidden rounded-2xl border border-cyan-500/20 bg-gradient-to-br from-cyan-500/20 via-cyan-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-cyan-400/40 hover:shadow-xl hover:shadow-cyan-900/30">

        <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-cyan-500/10 blur-2xl"></div>

        <div class="relative flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-cyan-300">
                    Available
                </p>

                <h2 class="mt-2 text-3xl font-bold text-white">
                    {{ $availableProperties }}
                </h2>

                <p class="mt-2 text-xs text-gray-500">
                    Approved & currently available
                </p>

            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-500 to-teal-500 text-white shadow-lg shadow-cyan-900/40">

                <i class="fa-solid fa-house-circle-check text-xl"></i>

            </div>

        </div>

    </div>


    {{-- SOLD --}}

    <div class="group relative overflow-hidden rounded-2xl border border-red-500/20 bg-gradient-to-br from-red-500/20 via-red-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-red-400/40 hover:shadow-xl hover:shadow-red-900/30">

        <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-red-500/10 blur-2xl"></div>

        <div class="relative flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-red-300">
                    Sold
                </p>

                <h2 class="mt-2 text-3xl font-bold text-white">
                    {{ $soldProperties }}
                </h2>

                <p class="mt-2 text-xs text-gray-500">
                    Successfully sold
                </p>

            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-red-500 to-rose-600 text-white shadow-lg shadow-red-900/40">

                <i class="fa-solid fa-house-circle-xmark text-xl"></i>

            </div>

        </div>

    </div>


    {{-- PENDING APPROVAL --}}

    <div class="group relative overflow-hidden rounded-2xl border border-orange-500/20 bg-gradient-to-br from-orange-500/20 via-orange-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-orange-400/40 hover:shadow-xl hover:shadow-orange-900/30">

        <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-orange-500/10 blur-2xl"></div>

        <div class="relative flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-orange-300">
                    Pending Approval
                </p>

                <h2 class="mt-2 text-3xl font-bold text-white">
                    {{ $pendingProperties }}
                </h2>

                <p class="mt-2 text-xs text-gray-500">
                    Waiting for Super Admin review
                </p>

            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white shadow-lg shadow-orange-900/40">

                <i class="fa-solid fa-clock text-xl"></i>

            </div>

        </div>

    </div>


</div>


{{-- =========================================================
     SECONDARY STAT CARDS
========================================================== --}}

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


    {{-- FOR SALE --}}

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

                <i class="fa-solid fa-tag text-xl"></i>

            </div>

        </div>

    </div>


    {{-- FOR RENT --}}

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


    {{-- FEATURED --}}

    <div class="group relative overflow-hidden rounded-2xl border border-yellow-500/20 bg-gradient-to-br from-yellow-500/20 via-yellow-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-yellow-400/40 hover:shadow-xl hover:shadow-yellow-900/30">

        <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-yellow-500/10 blur-2xl"></div>

        <div class="relative flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-yellow-300">
                    Featured
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


    {{-- RENTED --}}

    <div class="group relative overflow-hidden rounded-2xl border border-violet-500/20 bg-gradient-to-br from-violet-500/20 via-violet-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-violet-400/40 hover:shadow-xl hover:shadow-violet-900/30">

        <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-violet-500/10 blur-2xl"></div>

        <div class="relative flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-violet-300">
                    Rented
                </p>

                <h2 class="mt-2 text-3xl font-bold text-white">
                    {{ $rentedProperties }}
                </h2>

                <p class="mt-2 text-xs text-gray-500">
                    Successfully rented
                </p>

            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 text-white shadow-lg shadow-violet-900/40">

                <i class="fa-solid fa-key text-xl"></i>

            </div>

        </div>

    </div>


</div>


{{-- =========================================================
     QUICK OVERVIEW
========================================================== --}}

<div class="grid grid-cols-1 gap-5 md:grid-cols-3">


    {{-- TOTAL PORTFOLIO --}}

    <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5 shadow-xl">

        <div class="flex items-center gap-4">

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                <i class="fa-solid fa-chart-pie text-lg"></i>

            </div>

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-500">
                    Total Portfolio
                </p>

                <p class="mt-1 text-xl font-bold text-white">
                    {{ $totalProperties }} Properties
                </p>

            </div>

        </div>

    </div>


    {{-- SALE LISTINGS --}}

    <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5 shadow-xl">

        <div class="flex items-center gap-4">

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-lime-500/10 text-lime-400">

                <i class="fa-solid fa-house text-lg"></i>

            </div>

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-500">
                    Sale Listings
                </p>

                <p class="mt-1 text-xl font-bold text-white">
                    {{ $forSaleProperties }} Properties
                </p>

            </div>

        </div>

    </div>


    {{-- RENTAL LISTINGS --}}

    <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5 shadow-xl">

        <div class="flex items-center gap-4">

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                <i class="fa-solid fa-key text-lg"></i>

            </div>

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-500">
                    Rental Listings
                </p>

                <p class="mt-1 text-xl font-bold text-white">
                    {{ $forRentProperties }} Properties
                </p>

            </div>

        </div>

    </div>


</div>


{{-- =========================================================
     PROPERTY REQUESTS
========================================================== --}}

<div class="space-y-4">


    {{-- SECTION HEADER --}}

    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-lg font-semibold text-white">
                Property Requests
            </h2>

            <p class="text-sm text-gray-400">
                Track buyer and rental requests for your properties.
            </p>

        </div>


        @if(Route::has('agent.property-transactions.index'))

            <a
                href="{{ route('agent.property-transactions.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-purple-400 transition hover:text-purple-300"
            >

                View All Requests

                <i class="fa-solid fa-arrow-right text-xs"></i>

            </a>

        @endif

    </div>


    {{-- REQUEST TILES --}}

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


        {{-- TOTAL REQUESTS --}}

        <div class="group relative overflow-hidden rounded-2xl border border-indigo-500/20 bg-gradient-to-br from-indigo-500/20 via-indigo-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-indigo-400/40 hover:shadow-xl hover:shadow-indigo-900/30">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-indigo-500/10 blur-2xl"></div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-indigo-300">
                        Total Requests
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-white">
                        {{ $totalRequests ?? 0 }}
                    </h2>

                    <p class="mt-2 text-xs text-gray-500">
                        All property requests
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white shadow-lg shadow-indigo-900/40">

                    <i class="fa-solid fa-file-signature text-xl"></i>

                </div>

            </div>

        </div>


        {{-- PENDING REQUESTS --}}

        <div class="group relative overflow-hidden rounded-2xl border border-amber-500/20 bg-gradient-to-br from-amber-500/20 via-amber-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-amber-400/40 hover:shadow-xl hover:shadow-amber-900/30">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-amber-500/10 blur-2xl"></div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-amber-300">
                        Pending Requests
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-white">
                        {{ $pendingRequests ?? 0 }}
                    </h2>

                    <p class="mt-2 text-xs text-gray-500">
                        Waiting for action
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 text-white shadow-lg shadow-amber-900/40">

                    <i class="fa-solid fa-hourglass-half text-xl"></i>

                </div>

            </div>

        </div>


        {{-- APPROVED REQUESTS --}}

        <div class="group relative overflow-hidden rounded-2xl border border-emerald-500/20 bg-gradient-to-br from-emerald-500/20 via-emerald-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-emerald-400/40 hover:shadow-xl hover:shadow-emerald-900/30">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-emerald-500/10 blur-2xl"></div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-emerald-300">
                        Approved
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-white">
                        {{ $approvedRequests ?? 0 }}
                    </h2>

                    <p class="mt-2 text-xs text-gray-500">
                        Approved requests
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-green-600 text-white shadow-lg shadow-emerald-900/40">

                    <i class="fa-solid fa-circle-check text-xl"></i>

                </div>

            </div>

        </div>


        {{-- COMPLETED DEALS --}}

        <div class="group relative overflow-hidden rounded-2xl border border-green-500/20 bg-gradient-to-br from-green-500/20 via-green-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-green-400/40 hover:shadow-xl hover:shadow-green-900/30">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-green-500/10 blur-2xl"></div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-green-300">
                        Completed Deals
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-white">
                        {{ $completedRequests ?? 0 }}
                    </h2>

                    <p class="mt-2 text-xs text-gray-500">
                        Successfully completed
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-lg shadow-green-900/40">

                    <i class="fa-solid fa-handshake text-xl"></i>

                </div>

            </div>

        </div>


        {{-- BUY REQUESTS --}}

        <div class="group relative overflow-hidden rounded-2xl border border-sky-500/20 bg-gradient-to-br from-sky-500/20 via-sky-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-sky-400/40 hover:shadow-xl hover:shadow-sky-900/30">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-sky-500/10 blur-2xl"></div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-sky-300">
                        Buy Requests
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-white">
                        {{ $buyRequests ?? 0 }}
                    </h2>

                    <p class="mt-2 text-xs text-gray-500">
                        Purchase requests
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-500 to-cyan-600 text-white shadow-lg shadow-sky-900/40">

                    <i class="fa-solid fa-cart-shopping text-xl"></i>

                </div>

            </div>

        </div>


        {{-- RENT REQUESTS --}}

        <div class="group relative overflow-hidden rounded-2xl border border-blue-500/20 bg-gradient-to-br from-blue-500/20 via-blue-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-blue-400/40 hover:shadow-xl hover:shadow-blue-900/30">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-blue-500/10 blur-2xl"></div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-blue-300">
                        Rent Requests
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-white">
                        {{ $rentRequests ?? 0 }}
                    </h2>

                    <p class="mt-2 text-xs text-gray-500">
                        Rental requests
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-900/40">

                    <i class="fa-solid fa-key text-xl"></i>

                </div>

            </div>

        </div>


        {{-- COUNTER OFFERS --}}

        <div class="group relative overflow-hidden rounded-2xl border border-fuchsia-500/20 bg-gradient-to-br from-fuchsia-500/20 via-fuchsia-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-fuchsia-400/40 hover:shadow-xl hover:shadow-fuchsia-900/30">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-fuchsia-500/10 blur-2xl"></div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-fuchsia-300">
                        Counter Offers
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-white">
                        {{ $counterOffers ?? 0 }}
                    </h2>

                    <p class="mt-2 text-xs text-gray-500">
                        Offers requiring attention
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-fuchsia-500 to-pink-600 text-white shadow-lg shadow-fuchsia-900/40">

                    <i class="fa-solid fa-comments-dollar text-xl"></i>

                </div>

            </div>

        </div>


        {{-- REJECTED REQUESTS --}}

        <div class="group relative overflow-hidden rounded-2xl border border-rose-500/20 bg-gradient-to-br from-rose-500/20 via-rose-500/5 to-gray-900 p-5 transition duration-300 hover:-translate-y-1 hover:border-rose-400/40 hover:shadow-xl hover:shadow-rose-900/30">

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-rose-500/10 blur-2xl"></div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-rose-300">
                        Rejected
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-white">
                        {{ $rejectedRequests ?? 0 }}
                    </h2>

                    <p class="mt-2 text-xs text-gray-500">
                        Rejected requests
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-rose-500 to-red-600 text-white shadow-lg shadow-rose-900/40">

                    <i class="fa-solid fa-circle-xmark text-xl"></i>

                </div>

            </div>

        </div>


    </div>

</div>


{{-- =========================================================
     RECENT PROPERTIES
========================================================== --}}

<div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-900 shadow-xl">


    {{-- HEADER --}}

    <div class="flex flex-col gap-4 border-b border-gray-800 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-lg font-semibold text-white">
                Recent Properties
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                Your latest property listings and approval status.
            </p>

        </div>


        <a
            href="{{ route('agent.properties.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-purple-600 to-fuchsia-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-purple-900/20 transition hover:from-purple-500 hover:to-fuchsia-500"
        >

            View All

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>


    @if($recentProperties->count())


    {{-- TABLE --}}

    <div class="overflow-x-auto">

        <table class="w-full min-w-[1350px] text-left">


            {{-- TABLE HEADER --}}

            <thead class="border-b border-gray-800 bg-gray-950">

                <tr>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Property
                    </th>

                    {{-- OWNER --}}

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Owner
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Type
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Location
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Purpose
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Price
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Availability
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Approval
                    </th>

                </tr>

            </thead>


            {{-- TABLE BODY --}}

            <tbody class="divide-y divide-gray-800">

                @foreach($recentProperties as $property)

                    <tr class="transition hover:bg-gray-800/50">


                        {{-- PROPERTY --}}

                        <td class="px-6 py-4">

                            <div class="flex items-center gap-4">


                                {{-- IMAGE --}}

                                <div class="h-14 w-20 shrink-0 overflow-hidden rounded-xl border border-gray-800 bg-gray-950">

                                    @if(is_array($property->photos) && count($property->photos) > 0)

                                        <img
                                            src="{{ asset('storage/' . $property->photos[0]) }}"
                                            alt="{{ $property->title }}"
                                            class="h-full w-full object-cover"
                                        >

                                    @else

                                        <div class="flex h-full w-full items-center justify-center text-gray-600">

                                            <i class="fa-solid fa-image"></i>

                                        </div>

                                    @endif

                                </div>


                                {{-- PROPERTY INFO --}}

                                <div class="min-w-0">

                                    <p class="max-w-xs truncate text-sm font-semibold text-white">

                                        {{ $property->title }}

                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">

                                        #{{ $property->id }}

                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- =================================================
                             OWNER
                        ================================================== --}}

                        <td class="px-6 py-4">

                            @if($property->owner)

                                <div class="min-w-[210px]">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-purple-500/10 text-purple-400">

                                            <i class="fa-solid fa-user"></i>

                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-white">

                                                {{ $property->owner->name }}

                                            </p>

                                            <p class="mt-0.5 text-xs text-gray-500">
                                                Property Owner
                                            </p>

                                        </div>

                                    </div>


                                    {{-- OWNER EMAIL --}}

                                    @if(!empty($property->owner->email))

                                        <div class="mt-2 flex items-center gap-2 text-xs text-gray-500">

                                            <i class="fa-solid fa-envelope w-3 text-blue-400"></i>

                                            <span class="truncate">
                                                {{ $property->owner->email }}
                                            </span>

                                        </div>

                                    @endif


                                    {{-- OWNER PHONE --}}

                                    @if(!empty($property->owner->phone))

                                        <div class="mt-1 flex items-center gap-2 text-xs text-gray-500">

                                            <i class="fa-solid fa-phone w-3 text-emerald-400"></i>

                                            <span>
                                                {{ $property->owner->phone }}
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            @else

                                <div class="flex items-center gap-2">

                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-500/10 text-gray-500">

                                        <i class="fa-solid fa-user-slash"></i>

                                    </span>

                                    <div>

                                        <p class="text-xs font-medium text-gray-400">
                                            Not Assigned
                                        </p>

                                        <p class="mt-0.5 text-[10px] text-gray-600">
                                            No owner
                                        </p>

                                    </div>

                                </div>

                            @endif

                        </td>


                        {{-- TYPE --}}

                        <td class="px-6 py-4 text-sm text-gray-400">

                            {{ $property->propertyType->name ?? '—' }}

                        </td>


                        {{-- LOCATION --}}

                        <td class="px-6 py-4">

                            <span class="inline-flex items-center gap-2 text-sm text-gray-400">

                                <i class="fa-solid fa-location-dot text-purple-400"></i>

                                {{ $property->location->city ?? '—' }}

                            </span>

                        </td>


                        {{-- PURPOSE --}}

                        <td class="px-6 py-4">

                            @if($property->purpose === 'sale')

                                <span class="inline-flex rounded-full border border-lime-500/20 bg-lime-500/10 px-3 py-1 text-xs font-medium text-lime-400">

                                    <i class="fa-solid fa-tag mr-1.5"></i>

                                    Sale

                                </span>

                            @else

                                <span class="inline-flex rounded-full border border-blue-500/20 bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-400">

                                    <i class="fa-solid fa-key mr-1.5"></i>

                                    Rent

                                </span>

                            @endif

                        </td>


                        {{-- PRICE --}}

                        <td class="px-6 py-4">

                            <span class="whitespace-nowrap text-sm font-semibold text-white">

                                ₹{{ number_format((float) $property->price, 0) }}

                            </span>

                        </td>


                        {{-- AVAILABILITY --}}

                        <td class="px-6 py-4">

                            @if($property->status === 'available')

                                <span class="inline-flex items-center rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                    Available

                                </span>


                            @elseif($property->status === 'sold')

                                <span class="inline-flex items-center rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                    Sold

                                </span>


                            @elseif($property->status === 'rented')

                                <span class="inline-flex items-center rounded-full border border-violet-500/20 bg-violet-500/10 px-3 py-1 text-xs font-medium text-violet-400">

                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-violet-400"></span>

                                    Rented

                                </span>


                            @else

                                <span class="inline-flex items-center rounded-full border border-gray-500/20 bg-gray-500/10 px-3 py-1 text-xs font-medium text-gray-400">

                                    {{ ucfirst($property->status ?? 'Unknown') }}

                                </span>

                            @endif

                        </td>


                        {{-- APPROVAL STATUS --}}

                        <td class="px-6 py-4">

                            @if($property->approval_status === 'approved')

                                <div class="flex flex-col items-start gap-1">

                                    <span class="inline-flex items-center rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                                        <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                        Approved

                                    </span>

                                    <span class="text-[11px] text-gray-600">
                                        Live after availability check
                                    </span>

                                </div>


                            @elseif($property->approval_status === 'rejected')

                                <div class="flex flex-col items-start gap-1">

                                    <span class="inline-flex items-center rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                                        <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                        Rejected

                                    </span>

                                    <span class="text-[11px] text-gray-600">
                                        Not visible publicly
                                    </span>

                                </div>


                            @else

                                <div class="flex flex-col items-start gap-1">

                                    <span class="inline-flex items-center rounded-full border border-orange-500/20 bg-orange-500/10 px-3 py-1 text-xs font-medium text-orange-400">

                                        <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-orange-400"></span>

                                        Pending Review

                                    </span>

                                    <span class="text-[11px] text-gray-600">
                                        Waiting for Super Admin
                                    </span>

                                </div>

                            @endif

                        </td>


                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>


    @else


    {{-- EMPTY STATE --}}

    <div class="px-6 py-16 text-center">

        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-purple-500/10 text-purple-400">

            <i class="fa-solid fa-building text-2xl"></i>

        </div>


        <h3 class="mt-4 text-lg font-semibold text-white">

            No Properties Yet

        </h3>


        <p class="mt-2 text-sm text-gray-400">

            Start by adding your first property.

        </p>


        <a
            href="{{ route('agent.properties.create') }}"
            class="mt-5 inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-purple-600 to-fuchsia-600 px-5 py-2.5 text-sm font-medium text-white shadow-lg shadow-purple-900/20 transition hover:from-purple-500 hover:to-fuchsia-500"
        >

            <i class="fa-solid fa-plus"></i>

            Add Property

        </a>

    </div>

    @endif


</div>


</div>

@endsection