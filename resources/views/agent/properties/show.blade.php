@extends('agent.layouts.app')

@section('title', 'Property Details')
@section('page-title', 'Property Details')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">


{{-- =========================================================
     PAGE HEADER
========================================================== --}}

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>

        <div class="flex items-center gap-3">

            <a
                href="{{ route('agent.properties.index') }}"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-gray-400 transition hover:bg-white/10 hover:text-white"
                title="Back"
            >
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div>

                <h1 class="text-2xl font-bold text-white">
                    Property Details
                </h1>

                <p class="mt-1 text-sm text-gray-400">
                    View complete property information, owner details and listing status.
                </p>

            </div>

        </div>

    </div>


    <div class="flex flex-wrap gap-3">

        <a
            href="{{ route('agent.properties.edit', $property) }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-purple-600/20 transition hover:bg-purple-500"
        >
            <i class="fa-solid fa-pen-to-square"></i>
            Edit Property
        </a>

        <a
            href="{{ route('agent.properties.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-5 py-2.5 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
        >
            <i class="fa-solid fa-list"></i>
            All Properties
        </a>

    </div>

</div>


{{-- =========================================================
     SUCCESS MESSAGE
========================================================== --}}

@if (session('success'))

    <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 p-4">

        <div class="flex items-center gap-3">

            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <p class="text-sm font-medium text-emerald-300">
                {{ session('success') }}
            </p>

        </div>

    </div>

@endif


{{-- =========================================================
     PROPERTY HERO
========================================================== --}}

<div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

    <div class="grid lg:grid-cols-3">

        {{-- MAIN IMAGE --}}

        <div class="relative min-h-[280px] bg-gray-950 lg:col-span-2">

            @php

                $photos = is_array($property->photos)
                    ? $property->photos
                    : [];

                $mainPhoto = $photos[0] ?? null;

            @endphp


            @if ($mainPhoto)

                <img
                    src="{{ asset('storage/' . $mainPhoto) }}"
                    alt="{{ $property->title }}"
                    class="h-full min-h-[280px] w-full object-cover"
                >

            @else

                <div class="flex min-h-[280px] items-center justify-center">

                    <div class="text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white/5 text-2xl text-gray-600">

                            <i class="fa-solid fa-house"></i>

                        </div>

                        <p class="mt-4 text-sm text-gray-500">
                            No property image available
                        </p>

                    </div>

                </div>

            @endif


            {{-- IMAGE OVERLAY --}}

            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent p-6">

                <div class="flex flex-wrap items-center gap-2">

                    @if ($property->purpose === 'sale')

                        <span class="rounded-full bg-emerald-500/90 px-3 py-1 text-xs font-semibold text-white">
                            For Sale
                        </span>

                    @elseif ($property->purpose === 'rent')

                        <span class="rounded-full bg-blue-500/90 px-3 py-1 text-xs font-semibold text-white">
                            For Rent
                        </span>

                    @endif


                    @if ($property->status === 'available')

                        <span class="rounded-full bg-green-500/90 px-3 py-1 text-xs font-semibold text-white">
                            Available
                        </span>

                    @elseif ($property->status === 'sold')

                        <span class="rounded-full bg-red-500/90 px-3 py-1 text-xs font-semibold text-white">
                            Sold
                        </span>

                    @elseif ($property->status === 'rented')

                        <span class="rounded-full bg-orange-500/90 px-3 py-1 text-xs font-semibold text-white">
                            Rented
                        </span>

                    @endif


                    @if ($property->is_featured)

                        <span class="rounded-full bg-yellow-500/90 px-3 py-1 text-xs font-semibold text-white">
                            <i class="fa-solid fa-star mr-1"></i>
                            Featured
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- PROPERTY SUMMARY --}}

        <div class="flex flex-col justify-between p-6">

            <div>

                <div class="mb-4 flex items-start justify-between gap-4">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">
                            Property
                        </p>

                        <h2 class="mt-1 text-2xl font-bold text-white">
                            {{ $property->title }}
                        </h2>

                    </div>

                    @if ($property->is_featured)

                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-yellow-500/10 text-yellow-400">
                            <i class="fa-solid fa-star"></i>
                        </span>

                    @endif

                </div>


                {{-- PRICE --}}

                <div class="rounded-xl border border-purple-500/20 bg-purple-500/10 p-4">

                    <p class="text-xs text-gray-400">
                        Property Price
                    </p>

                    <p class="mt-1 text-2xl font-bold text-purple-300">
                        ₹{{ number_format((float) $property->price, 2) }}
                    </p>

                </div>


                {{-- LOCATION --}}

                <div class="mt-5 flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-500/10 text-red-400">

                        <i class="fa-solid fa-location-dot"></i>

                    </div>

                    <div>

                        <p class="text-xs text-gray-500">
                            Location
                        </p>

                        <p class="mt-0.5 text-sm font-medium text-gray-200">

                            @if ($property->location)

                                {{ $property->location->city }}

                                @if (!empty($property->location->state))
                                    , {{ $property->location->state }}
                                @endif

                            @else

                                Location not available

                            @endif

                        </p>

                    </div>

                </div>


                {{-- PROPERTY TYPE --}}

                <div class="mt-4 flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400">

                        <i class="fa-solid fa-building"></i>

                    </div>

                    <div>

                        <p class="text-xs text-gray-500">
                            Property Type
                        </p>

                        <p class="mt-0.5 text-sm font-medium text-gray-200">

                            {{ $property->propertyType->name ?? 'Not specified' }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- APPROVAL STATUS --}}

            <div class="mt-6">

                @php
                    $approvalStatus = $property->approval_status ?? 'pending';
                @endphp


                @if ($approvalStatus === 'approved')

                    <div class="flex items-center gap-3 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3">

                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>

                        <div>

                            <p class="text-sm font-semibold text-emerald-300">
                                Approved
                            </p>

                            <p class="text-xs text-gray-500">
                                Approved by Super Admin
                            </p>

                        </div>

                    </div>

                @elseif ($approvalStatus === 'rejected')

                    <div class="flex items-center gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">

                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-500/10 text-red-400">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </span>

                        <div>

                            <p class="text-sm font-semibold text-red-300">
                                Rejected
                            </p>

                            <p class="text-xs text-gray-500">
                                Rejected by Super Admin
                            </p>

                        </div>

                    </div>

                @else

                    <div class="flex items-center gap-3 rounded-xl border border-amber-500/20 bg-amber-500/10 px-4 py-3">

                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-500/10 text-amber-400">
                            <i class="fa-solid fa-clock"></i>
                        </span>

                        <div>

                            <p class="text-sm font-semibold text-amber-300">
                                Pending Approval
                            </p>

                            <p class="text-xs text-gray-500">
                                Waiting for Super Admin review
                            </p>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     PROPERTY INFORMATION + OWNER DETAILS
========================================================== --}}

<div class="grid gap-6 lg:grid-cols-3">


    {{-- =====================================================
         PROPERTY DETAILS
    ====================================================== --}}

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl lg:col-span-2">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                    <i class="fa-solid fa-list-check"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Property Information
                    </h2>

                    <p class="text-sm text-gray-400">
                        Complete details of this property.
                    </p>

                </div>

            </div>

        </div>


        <div class="grid gap-5 p-6 sm:grid-cols-2">


            {{-- BEDROOMS --}}

            <div class="rounded-xl border border-white/10 bg-gray-950/50 p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-500/10 text-purple-400">

                        <i class="fa-solid fa-bed"></i>

                    </div>

                    <div>

                        <p class="text-xs text-gray-500">
                            Bedrooms
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white">
                            {{ $property->bedrooms ?? 'N/A' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- BATHROOMS --}}

            <div class="rounded-xl border border-white/10 bg-gray-950/50 p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400">

                        <i class="fa-solid fa-bath"></i>

                    </div>

                    <div>

                        <p class="text-xs text-gray-500">
                            Bathrooms
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white">
                            {{ $property->bathrooms ?? 'N/A' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- AREA --}}

            <div class="rounded-xl border border-white/10 bg-gray-950/50 p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-500/10 text-green-400">

                        <i class="fa-solid fa-ruler-combined"></i>

                    </div>

                    <div>

                        <p class="text-xs text-gray-500">
                            Area
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white">

                            @if (!empty($property->area))
                                {{ number_format((float) $property->area, 2) }} sq.ft
                            @else
                                N/A
                            @endif

                        </p>

                    </div>

                </div>

            </div>


            {{-- GARAGES --}}

            <div class="rounded-xl border border-white/10 bg-gray-950/50 p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-500/10 text-orange-400">

                        <i class="fa-solid fa-car"></i>

                    </div>

                    <div>

                        <p class="text-xs text-gray-500">
                            Garages
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white">
                            {{ $property->garages ?? 'N/A' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- PURPOSE --}}

            <div class="rounded-xl border border-white/10 bg-gray-950/50 p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-500/10 text-cyan-400">

                        <i class="fa-solid fa-bullseye"></i>

                    </div>

                    <div>

                        <p class="text-xs text-gray-500">
                            Purpose
                        </p>

                        <p class="mt-1 text-sm font-semibold capitalize text-white">
                            {{ $property->purpose === 'sale' ? 'For Sale' : 'For Rent' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- STATUS --}}

            <div class="rounded-xl border border-white/10 bg-gray-950/50 p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-pink-500/10 text-pink-400">

                        <i class="fa-solid fa-signal"></i>

                    </div>

                    <div>

                        <p class="text-xs text-gray-500">
                            Status
                        </p>

                        <p class="mt-1 text-sm font-semibold capitalize text-white">
                            {{ $property->status ?? 'N/A' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- ADDRESS --}}

            <div class="rounded-xl border border-white/10 bg-gray-950/50 p-4 sm:col-span-2">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red-500/10 text-red-400">

                        <i class="fa-solid fa-map-location-dot"></i>

                    </div>

                    <div>

                        <p class="text-xs text-gray-500">
                            Full Address
                        </p>

                        <p class="mt-1 text-sm font-medium leading-6 text-white">

                            {{ $property->address ?: 'Address not provided' }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- DESCRIPTION --}}

            <div class="rounded-xl border border-white/10 bg-gray-950/50 p-4 sm:col-span-2">

                <p class="text-xs text-gray-500">
                    Description
                </p>

                <p class="mt-2 whitespace-pre-line text-sm leading-7 text-gray-300">

                    {{ $property->description ?: 'No description provided.' }}

                </p>

            </div>

        </div>

    </div>


    {{-- =====================================================
         OWNER DETAILS
    ====================================================== --}}

    @php

        /*
        |--------------------------------------------------------------------------
        | OWNER DETECTION
        |--------------------------------------------------------------------------
        |
        | Property ka owner normally user_id ke through connected hai.
        | Agar relationship available hai to use use karenge.
        | Agar owner assigned nahi hai to poora section hide rahega.
        |
        */

        $propertyOwner = $property->owner ?? null;

        if (!$propertyOwner && isset($property->user)) {
            $propertyOwner = $property->user;
        }

    @endphp


    @if ($propertyOwner)

        <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

            <div class="border-b border-white/10 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                        <i class="fa-solid fa-user"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-semibold text-white">
                            Owner Details
                        </h2>

                        <p class="text-sm text-gray-400">
                            Property owner information.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                {{-- OWNER AVATAR --}}

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-500/10 text-xl font-bold text-emerald-400">

                        {{ strtoupper(substr($propertyOwner->name ?? 'O', 0, 1)) }}

                    </div>

                    <div class="min-w-0">

                        <p class="text-lg font-semibold text-white">
                            {{ $propertyOwner->name ?? 'Owner' }}
                        </p>

                        <p class="mt-0.5 text-xs uppercase tracking-wider text-gray-500">
                            Property Owner
                        </p>

                    </div>

                </div>


                {{-- OWNER INFORMATION --}}

                <div class="mt-6 space-y-4">


                    {{-- EMAIL --}}

                    @if (!empty($propertyOwner->email))

                        <div class="flex items-start gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400">

                                <i class="fa-solid fa-envelope"></i>

                            </div>

                            <div class="min-w-0">

                                <p class="text-xs text-gray-500">
                                    Email
                                </p>

                                <p class="mt-1 break-all text-sm text-gray-200">
                                    {{ $propertyOwner->email }}
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- PHONE --}}

                    @if (!empty($propertyOwner->phone))

                        <div class="flex items-start gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-500/10 text-green-400">

                                <i class="fa-solid fa-phone"></i>

                            </div>

                            <div>

                                <p class="text-xs text-gray-500">
                                    Phone
                                </p>

                                <p class="mt-1 text-sm text-gray-200">
                                    {{ $propertyOwner->phone }}
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- ROLE --}}

                    @if (!empty($propertyOwner->role))

                        <div class="flex items-start gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-purple-500/10 text-purple-400">

                                <i class="fa-solid fa-user-tag"></i>

                            </div>

                            <div>

                                <p class="text-xs text-gray-500">
                                    Role
                                </p>

                                <p class="mt-1 text-sm font-medium capitalize text-gray-200">
                                    {{ $propertyOwner->role }}
                                </p>

                            </div>

                        </div>

                    @endif


                </div>


                {{-- OWNER STATUS --}}

                <div class="mt-6 rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4">

                    <div class="flex items-center gap-3">

                        <i class="fa-solid fa-circle-check text-emerald-400"></i>

                        <p class="text-xs leading-5 text-emerald-300">
                            This property is assigned to the owner shown above.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    @endif

</div>


{{-- =========================================================
     PHOTOS GALLERY
========================================================== --}}

@if (count($photos) > 0)

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-pink-500/10 text-pink-400">

                        <i class="fa-solid fa-images"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-semibold text-white">
                            Property Photos
                        </h2>

                        <p class="text-sm text-gray-400">
                            {{ count($photos) }} photo{{ count($photos) > 1 ? 's' : '' }} available.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <div class="grid grid-cols-2 gap-4 p-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">

            @foreach ($photos as $index => $photo)

                <div class="group relative overflow-hidden rounded-xl border border-white/10 bg-gray-950">

                    <img
                        src="{{ asset('storage/' . $photo) }}"
                        alt="{{ $property->title }} Photo {{ $index + 1 }}"
                        class="h-40 w-full object-cover transition duration-500 group-hover:scale-110"
                    >

                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent px-3 pb-3 pt-8">

                        <p class="text-xs font-medium text-white">
                            Photo {{ $index + 1 }}
                        </p>

                    </div>

                    <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition duration-300 group-hover:opacity-100">

                        <a
                            href="{{ asset('storage/' . $photo) }}"
                            target="_blank"
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20"
                            title="View Full Image"
                        >
                            <i class="fa-solid fa-expand"></i>
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

@endif


{{-- =========================================================
     LISTING INFORMATION
========================================================== --}}

<div class="grid gap-6 md:grid-cols-3">


    {{-- CREATED --}}

    <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5 shadow-xl">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                <i class="fa-solid fa-calendar-plus"></i>

            </div>

            <div>

                <p class="text-xs text-gray-500">
                    Listed On
                </p>

                <p class="mt-1 text-sm font-semibold text-white">

                    {{ $property->created_at?->format('d M Y') ?? 'N/A' }}

                </p>

            </div>

        </div>

    </div>


    {{-- UPDATED --}}

    <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5 shadow-xl">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                <i class="fa-solid fa-clock-rotate-left"></i>

            </div>

            <div>

                <p class="text-xs text-gray-500">
                    Last Updated
                </p>

                <p class="mt-1 text-sm font-semibold text-white">

                    {{ $property->updated_at?->format('d M Y') ?? 'N/A' }}

                </p>

            </div>

        </div>

    </div>


    {{-- VISIBILITY --}}

    <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5 shadow-xl">

        <div class="flex items-center gap-3">

            @if ($approvalStatus === 'approved' && $property->is_active && $property->status === 'available')

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                    <i class="fa-solid fa-eye"></i>

                </div>

                <div>

                    <p class="text-xs text-gray-500">
                        Website Visibility
                    </p>

                    <p class="mt-1 text-sm font-semibold text-emerald-300">
                        Live
                    </p>

                </div>

            @else

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-500/10 text-gray-400">

                    <i class="fa-solid fa-eye-slash"></i>

                </div>

                <div>

                    <p class="text-xs text-gray-500">
                        Website Visibility
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-300">
                        Not Public
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>


{{-- =========================================================
     ACTIONS
========================================================== --}}

<div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-6 sm:flex-row sm:justify-end">

    <a
        href="{{ route('agent.properties.index') }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
    >

        <i class="fa-solid fa-arrow-left"></i>

        Back to Properties

    </a>


    <a
        href="{{ route('agent.properties.edit', $property) }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-600/20 transition hover:bg-purple-500"
    >

        <i class="fa-solid fa-pen-to-square"></i>

        Edit Property

    </a>

</div>


</div>

@endsection
