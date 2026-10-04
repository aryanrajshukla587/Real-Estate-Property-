@extends('agent.layouts.app')

@section('title', 'Edit Property')
@section('page-title', 'Edit Property')

@section('content')

<div class="mx-auto max-w-6xl space-y-6">


{{-- PAGE HEADER --}}

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>

        <h1 class="text-2xl font-bold text-white">
            Edit Property
        </h1>

        <p class="mt-1 text-sm text-gray-400">
            Update your property information and photos.
        </p>

    </div>

    <a
        href="{{ route('agent.properties.index') }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-5 py-2.5 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
    >
        <i class="fa-solid fa-arrow-left"></i>
        Back to Properties
    </a>

</div>


{{-- VALIDATION ERRORS --}}

@if ($errors->any())

    <div class="rounded-2xl border border-red-500/20 bg-red-500/10 p-5">

        <div class="flex items-start gap-3">

            <div class="mt-0.5 text-red-400">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>

            <div>

                <h3 class="font-semibold text-red-300">
                    Please fix the following errors:
                </h3>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-200">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endif


{{-- APPROVAL STATUS INFORMATION --}}

@php

    $approvalStatus = $property->approval_status ?? 'pending';

    /*
    |--------------------------------------------------------------------------
    | PROPERTY OWNER
    |--------------------------------------------------------------------------
    |
    | Owner sirf tab show hoga jab property ke saath owner assigned ho.
    |
    */

    $propertyOwner = $property->owner ?? null;

    /*
    |--------------------------------------------------------------------------
    | FALLBACK
    |--------------------------------------------------------------------------
    |
    | Agar project me owner relationship ke badle user relationship
    | use ho raha hai to user ko owner maana jayega.
    |
    */

    if (!$propertyOwner && isset($property->user)) {
        $propertyOwner = $property->user;
    }

@endphp


@if ($approvalStatus === 'pending')

    <div class="rounded-2xl border border-amber-500/20 bg-amber-500/10 p-5">

        <div class="flex items-start gap-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-500/10 text-amber-400">

                <i class="fa-solid fa-clock"></i>

            </div>

            <div>

                <h3 class="font-semibold text-amber-300">
                    Waiting for Super Admin Approval
                </h3>

                <p class="mt-1 text-sm leading-6 text-amber-200/80">

                    This property is currently under review.
                    It will not be visible on the public website until the Super Admin approves it.

                </p>

            </div>

        </div>

    </div>

@elseif ($approvalStatus === 'approved')

    <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 p-5">

        <div class="flex items-start gap-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <div>

                <h3 class="font-semibold text-emerald-300">
                    Property Approved
                </h3>

                <p class="mt-1 text-sm leading-6 text-emerald-200/80">

                    This property has been approved by the Super Admin.
                    Its public visibility is controlled by the approval and active settings.

                </p>

            </div>

        </div>

    </div>

@elseif ($approvalStatus === 'rejected')

    <div class="rounded-2xl border border-red-500/20 bg-red-500/10 p-5">

        <div class="flex items-start gap-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-400">

                <i class="fa-solid fa-circle-xmark"></i>

            </div>

            <div>

                <h3 class="font-semibold text-red-300">
                    Property Rejected
                </h3>

                <p class="mt-1 text-sm leading-6 text-red-200/80">

                    This property has been rejected by the Super Admin.
                    Please update the property details if changes are required and contact the administrator for review.

                </p>

            </div>

        </div>

    </div>

@endif


{{-- =========================================================
     OWNER INFORMATION
========================================================== --}}

@if ($propertyOwner)

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                    <i class="fa-solid fa-user-tie"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Property Owner
                    </h2>

                    <p class="text-sm text-gray-400">
                        Owner assigned to this property.
                    </p>

                </div>

            </div>

        </div>


        <div class="grid gap-6 p-6 md:grid-cols-3">

            {{-- OWNER NAME --}}

            <div class="flex items-center gap-4 rounded-xl border border-white/10 bg-gray-950/50 p-4">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                    <i class="fa-solid fa-user"></i>

                </div>

                <div class="min-w-0">

                    <p class="text-xs font-medium uppercase tracking-wider text-gray-500">
                        Owner Name
                    </p>

                    <p class="mt-1 truncate text-sm font-semibold text-white">
                        {{ $propertyOwner->name ?? '—' }}
                    </p>

                </div>

            </div>


            {{-- OWNER EMAIL --}}

            @if (!empty($propertyOwner->email))

                <div class="flex items-center gap-4 rounded-xl border border-white/10 bg-gray-950/50 p-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                        <i class="fa-solid fa-envelope"></i>

                    </div>

                    <div class="min-w-0">

                        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">
                            Email Address
                        </p>

                        <p class="mt-1 truncate text-sm font-semibold text-white">
                            {{ $propertyOwner->email }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- OWNER PHONE --}}

            @if (!empty($propertyOwner->phone))

                <div class="flex items-center gap-4 rounded-xl border border-white/10 bg-gray-950/50 p-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-500/10 text-green-400">

                        <i class="fa-solid fa-phone"></i>

                    </div>

                    <div class="min-w-0">

                        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">
                            Phone Number
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white">
                            {{ $propertyOwner->phone }}
                        </p>

                    </div>

                </div>

            @endif

        </div>


        <div class="border-t border-white/10 bg-white/[0.02] px-6 py-4">

            <div class="flex items-center gap-2 text-xs text-gray-500">

                <i class="fa-solid fa-circle-info text-gray-600"></i>

                <span>
                    Owner assignment is managed by the property owner/admin.
                    You can view the owner details here but cannot change the assignment.
                </span>

            </div>

        </div>

    </div>

@endif


{{-- MAIN FORM --}}

<form
    action="{{ route('agent.properties.update', $property) }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6"
>

    @csrf
    @method('PUT')


    {{-- BASIC INFORMATION --}}

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                    <i class="fa-solid fa-house"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Basic Information
                    </h2>

                    <p class="text-sm text-gray-400">
                        Update the main property details.
                    </p>

                </div>

            </div>

        </div>


        <div class="grid gap-6 p-6 md:grid-cols-2">


            {{-- TITLE --}}

            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-medium text-gray-300">

                    Property Title

                    <span class="text-red-400">*</span>

                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $property->title) }}"
                    required
                    placeholder="e.g. Luxury 3 BHK Apartment"
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

            </div>


            {{-- PROPERTY TYPE --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">

                    Property Type

                    <span class="text-red-400">*</span>

                </label>

                <select
                    name="property_type_id"
                    required
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

                    <option value="">
                        Select Property Type
                    </option>

                    @foreach ($propertyTypes as $type)

                        <option
                            value="{{ $type->id }}"
                            @selected(
                                old(
                                    'property_type_id',
                                    $property->property_type_id
                                ) == $type->id
                            )
                        >

                            {{ $type->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- LOCATION --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">

                    Location

                    <span class="text-red-400">*</span>

                </label>

                <select
                    name="location_id"
                    required
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

                    <option value="">
                        Select Location
                    </option>

                    @foreach ($locations as $location)

                        <option
                            value="{{ $location->id }}"
                            @selected(
                                old(
                                    'location_id',
                                    $property->location_id
                                ) == $location->id
                            )
                        >

                            {{ $location->city }}

                            @if (!empty($location->state))
                                , {{ $location->state }}
                            @endif

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- PURPOSE --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">

                    Purpose

                    <span class="text-red-400">*</span>

                </label>

                <select
                    name="purpose"
                    required
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

                    <option value="">
                        Select Purpose
                    </option>

                    <option
                        value="sale"
                        @selected(
                            old(
                                'purpose',
                                $property->purpose
                            ) === 'sale'
                        )
                    >
                        For Sale
                    </option>

                    <option
                        value="rent"
                        @selected(
                            old(
                                'purpose',
                                $property->purpose
                            ) === 'rent'
                        )
                    >
                        For Rent
                    </option>

                </select>

            </div>


            {{-- PRICE --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">

                    Price

                    <span class="text-red-400">*</span>

                </label>

                <div class="relative">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
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
                        class="w-full rounded-xl border border-white/10 bg-gray-950/70 py-3 pl-9 pr-4 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                    >

                </div>

            </div>


            {{-- ADDRESS --}}

            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Address
                </label>

                <input
                    type="text"
                    name="address"
                    value="{{ old('address', $property->address) }}"
                    placeholder="Enter complete property address"
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

            </div>


            {{-- DESCRIPTION --}}

            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="6"
                    placeholder="Write detailed information about this property..."
                    class="w-full resize-none rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >{{ old('description', $property->description) }}</textarea>

            </div>

        </div>

    </div>


    {{-- PROPERTY DETAILS --}}

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                    <i class="fa-solid fa-list-check"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Property Details
                    </h2>

                    <p class="text-sm text-gray-400">
                        Update rooms, area and parking information.
                    </p>

                </div>

            </div>

        </div>


        <div class="grid gap-6 p-6 sm:grid-cols-2 lg:grid-cols-4">


            {{-- BEDROOMS --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Bedrooms
                </label>

                <div class="relative">

                    <i class="fa-solid fa-bed absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>

                    <input
                        type="number"
                        name="bedrooms"
                        value="{{ old('bedrooms', $property->bedrooms) }}"
                        min="0"
                        placeholder="3"
                        class="w-full rounded-xl border border-white/10 bg-gray-950/70 py-3 pl-11 pr-4 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                    >

                </div>

            </div>


            {{-- BATHROOMS --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Bathrooms
                </label>

                <div class="relative">

                    <i class="fa-solid fa-bath absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>

                    <input
                        type="number"
                        name="bathrooms"
                        value="{{ old('bathrooms', $property->bathrooms) }}"
                        min="0"
                        placeholder="2"
                        class="w-full rounded-xl border border-white/10 bg-gray-950/70 py-3 pl-11 pr-4 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                    >

                </div>

            </div>


            {{-- AREA --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Area
                </label>

                <div class="relative">

                    <input
                        type="number"
                        name="area"
                        value="{{ old('area', $property->area) }}"
                        min="0"
                        step="0.01"
                        placeholder="1500"
                        class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 pr-16 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                    >

                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-gray-500">
                        sq.ft
                    </span>

                </div>

            </div>


            {{-- GARAGES --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Garages
                </label>

                <div class="relative">

                    <i class="fa-solid fa-car absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>

                    <input
                        type="number"
                        name="garages"
                        value="{{ old('garages', $property->garages) }}"
                        min="0"
                        placeholder="1"
                        class="w-full rounded-xl border border-white/10 bg-gray-950/70 py-3 pl-11 pr-4 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                    >

                </div>

            </div>

        </div>

    </div>


    {{-- EXISTING PHOTOS --}}

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-pink-500/10 text-pink-400">

                    <i class="fa-solid fa-images"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Existing Photos
                    </h2>

                    <p class="text-sm text-gray-400">
                        Select photos you want to remove.
                    </p>

                </div>

            </div>

        </div>


        <div class="p-6">

            @if (is_array($property->photos) && count($property->photos) > 0)

                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">

                    @foreach ($property->photos as $photo)

                        <label class="group relative block cursor-pointer">

                            <input
                                type="checkbox"
                                name="delete_photos[]"
                                value="{{ $photo }}"
                                class="peer absolute left-3 top-3 z-20 h-5 w-5 rounded border-gray-500 bg-gray-900 text-red-600 focus:ring-red-500"
                            >

                            <div class="overflow-hidden rounded-xl border border-white/10 bg-gray-950 transition peer-checked:border-red-500 peer-checked:ring-2 peer-checked:ring-red-500/30">

                                <img
                                    src="{{ asset('storage/' . $photo) }}"
                                    alt="Property Photo"
                                    class="h-40 w-full object-cover transition duration-300 group-hover:scale-105"
                                >

                                <div class="absolute inset-x-0 bottom-0 bg-black/70 px-3 py-2">

                                    <p class="text-xs text-gray-300">
                                        Select to delete
                                    </p>

                                </div>

                                <div class="pointer-events-none absolute inset-0 flex items-center justify-center bg-red-900/40 opacity-0 transition peer-checked:opacity-100">

                                    <div class="rounded-full bg-red-500 px-3 py-2 text-xs font-semibold text-white">

                                        <i class="fa-solid fa-trash mr-1"></i>

                                        Delete

                                    </div>

                                </div>

                            </div>

                        </label>

                    @endforeach

                </div>

                <p class="mt-4 text-xs text-gray-500">
                    Deleting a photo will also remove it from storage.
                </p>

            @else

                <div class="rounded-2xl border border-dashed border-white/10 bg-gray-950/30 px-6 py-12 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/5 text-gray-600">

                        <i class="fa-solid fa-image text-xl"></i>

                    </div>

                    <p class="mt-4 text-sm font-medium text-gray-300">
                        No photos uploaded
                    </p>

                    <p class="mt-1 text-xs text-gray-600">
                        Upload new photos below.
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- NEW PHOTOS --}}

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                    <i class="fa-solid fa-cloud-arrow-up"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Add New Photos
                    </h2>

                    <p class="text-sm text-gray-400">
                        Upload additional property images.
                    </p>

                </div>

            </div>

        </div>


        <div class="p-6">

            <label
                for="photos"
                class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-white/10 bg-gray-950/40 px-6 py-12 text-center transition hover:border-purple-500/50 hover:bg-purple-500/5"
            >

                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-purple-500/10 text-2xl text-purple-400 transition group-hover:scale-110">

                    <i class="fa-solid fa-images"></i>

                </div>

                <h3 class="font-semibold text-white">
                    Click to upload new photos
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    JPG, JPEG, PNG or WEBP
                </p>

                <p class="mt-1 text-xs text-gray-600">
                    Maximum 5MB per image
                </p>

                <input
                    id="photos"
                    type="file"
                    name="photos[]"
                    accept=".jpg,.jpeg,.png,.webp"
                    multiple
                    class="hidden"
                >

            </label>


            <div
                id="photoPreview"
                class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"
            ></div>

        </div>

    </div>


    {{-- PROPERTY SETTINGS --}}

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                    <i class="fa-solid fa-sliders"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Property Settings
                    </h2>

                    <p class="text-sm text-gray-400">
                        Manage property availability and approval information.
                    </p>

                </div>

            </div>

        </div>


        <div class="grid gap-6 p-6 md:grid-cols-2">


            {{-- MARKET STATUS --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">

                    Property Status

                    <span class="text-red-400">*</span>

                </label>

                <select
                    name="status"
                    required
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

                    <option
                        value="available"
                        @selected(
                            old(
                                'status',
                                $property->status
                            ) === 'available'
                        )
                    >
                        Available
                    </option>

                    <option
                        value="sold"
                        @selected(
                            old(
                                'status',
                                $property->status
                            ) === 'sold'
                        )
                    >
                        Sold
                    </option>

                    <option
                        value="rented"
                        @selected(
                            old(
                                'status',
                                $property->status
                            ) === 'rented'
                        )
                    >
                        Rented
                    </option>

                </select>

                <p class="mt-2 text-xs text-gray-500">
                    This controls the market availability of your property.
                </p>

            </div>


            {{-- APPROVAL STATUS --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Approval Status
                </label>

                @if ($approvalStatus === 'approved')

                    <div class="flex items-center gap-3 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3">

                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400">

                            <i class="fa-solid fa-circle-check"></i>

                        </span>

                        <div>

                            <p class="text-sm font-semibold text-emerald-300">
                                Approved
                            </p>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Approved by Super Admin.
                            </p>

                        </div>

                    </div>

                @elseif ($approvalStatus === 'rejected')

                    <div class="flex items-center gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">

                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-500/10 text-red-400">

                            <i class="fa-solid fa-circle-xmark"></i>

                        </span>

                        <div>

                            <p class="text-sm font-semibold text-red-300">
                                Rejected
                            </p>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Rejected by Super Admin.
                            </p>

                        </div>

                    </div>

                @else

                    <div class="flex items-center gap-3 rounded-xl border border-amber-500/20 bg-amber-500/10 px-4 py-3">

                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-500/10 text-amber-400">

                            <i class="fa-solid fa-clock"></i>

                        </span>

                        <div>

                            <p class="text-sm font-semibold text-amber-300">
                                Pending Approval
                            </p>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Waiting for Super Admin review.
                            </p>

                        </div>

                    </div>

                @endif

                <p class="mt-2 text-xs text-gray-500">
                    Approval status can only be changed by Super Admin.
                </p>

            </div>


            {{-- FEATURED --}}

            <div class="md:col-span-2">

                <label class="flex cursor-pointer items-start gap-3">

                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        @checked(
                            old(
                                'is_featured',
                                $property->is_featured
                            )
                        )
                        class="mt-1 h-4 w-4 rounded border-gray-600 bg-gray-800 text-purple-600 focus:ring-purple-500"
                    >

                    <span>

                        <span class="block text-sm font-medium text-white">
                            Featured Property
                        </span>

                        <span class="mt-1 block text-xs text-gray-500">

                            Request this property to be shown as a featured listing.
                            Final featured visibility is controlled by Super Admin.

                        </span>

                    </span>

                </label>

            </div>


            {{-- WEBSITE VISIBILITY --}}

            <div class="md:col-span-2">

                @if ($approvalStatus === 'approved' && $property->is_active)

                    <div class="flex items-start gap-3 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-4">

                        <div class="mt-0.5 text-emerald-400">

                            <i class="fa-solid fa-eye"></i>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-emerald-300">
                                Property is currently visible
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-400">
                                Your property has been approved and is currently active on the website.
                            </p>

                        </div>

                    </div>

                @elseif ($approvalStatus === 'approved' && !$property->is_active)

                    <div class="flex items-start gap-3 rounded-xl border border-gray-500/20 bg-gray-500/10 px-4 py-4">

                        <div class="mt-0.5 text-gray-400">

                            <i class="fa-solid fa-eye-slash"></i>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-gray-300">
                                Property is currently hidden
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                This property has been approved but is currently disabled by Super Admin.
                            </p>

                        </div>

                    </div>

                @elseif ($approvalStatus === 'rejected')

                    <div class="flex items-start gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-4">

                        <div class="mt-0.5 text-red-400">

                            <i class="fa-solid fa-eye-slash"></i>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-red-300">
                                Property is not visible
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                Rejected properties are not displayed on the public website.
                            </p>

                        </div>

                    </div>

                @else

                    <div class="flex items-start gap-3 rounded-xl border border-amber-500/20 bg-amber-500/10 px-4 py-4">

                        <div class="mt-0.5 text-amber-400">

                            <i class="fa-solid fa-eye-slash"></i>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-amber-300">
                                Property is not visible yet
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                The property will become visible on the website only after Super Admin approval.
                            </p>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ACTION BUTTONS --}}

    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

        <a
            href="{{ route('agent.properties.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
        >

            <i class="fa-solid fa-xmark"></i>

            Cancel

        </a>


        <button
            type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-600/20 transition hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-950"
        >

            <i class="fa-solid fa-floppy-disk"></i>

            Update Property

        </button>

    </div>

</form>


</div>

{{-- PHOTO PREVIEW SCRIPT --}}

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


                wrapper.className =
                    'group relative overflow-hidden rounded-xl border border-white/10 bg-gray-950';


                const image = document.createElement('img');


                image.src = event.target.result;


                image.className =
                    'h-32 w-full object-cover transition duration-300 group-hover:scale-105';


                const overlay = document.createElement('div');


                overlay.className =
                    'absolute inset-x-0 bottom-0 bg-black/60 px-2 py-2';


                const name = document.createElement('p');


                name.className =
                    'truncate text-xs text-gray-200';


                name.textContent = file.name;


                overlay.appendChild(name);


                wrapper.appendChild(image);

                wrapper.appendChild(overlay);


                preview.appendChild(wrapper);

            };


            reader.readAsDataURL(file);

        });

    });

});

</script>

@endsection
