@extends('admin.layouts.app')

@section('title', $property->title)
@section('page-title', 'Property Details')

@section('content')

<div class="space-y-6">


{{-- =========================================================
     HEADER
========================================================== --}}

<div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

    <div>

        <a
            href="{{ route('admin.properties.index') }}"
            class="mb-4 inline-flex items-center gap-2 text-sm text-gray-400 transition hover:text-white">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Properties

        </a>


        <div class="flex items-start gap-4">

            <div
                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500/20 to-amber-500/20 text-orange-400">

                <i class="fa-solid fa-house text-xl"></i>

            </div>


            <div>

                <div class="flex flex-wrap items-center gap-2">

                    <h2 class="text-2xl font-bold text-white">
                        {{ $property->title }}
                    </h2>


                    @if($property->is_featured)

                        <span
                            class="rounded-lg bg-amber-500/10 px-2.5 py-1 text-xs font-semibold text-amber-400">

                            FEATURED

                        </span>

                    @endif


                    {{-- APPROVAL BADGE --}}

                    @if($property->approval_status === 'approved')

                        <span
                            class="inline-flex items-center gap-1.5 rounded-lg border border-emerald-500/20 bg-emerald-500/10 px-2.5 py-1 text-xs font-semibold text-emerald-400">

                            <i class="fa-solid fa-circle-check"></i>

                            APPROVED

                        </span>

                    @elseif($property->approval_status === 'rejected')

                        <span
                            class="inline-flex items-center gap-1.5 rounded-lg border border-red-500/20 bg-red-500/10 px-2.5 py-1 text-xs font-semibold text-red-400">

                            <i class="fa-solid fa-circle-xmark"></i>

                            REJECTED

                        </span>

                    @else

                        <span
                            class="inline-flex items-center gap-1.5 rounded-lg border border-amber-500/20 bg-amber-500/10 px-2.5 py-1 text-xs font-semibold text-amber-400">

                            <i class="fa-solid fa-clock"></i>

                            PENDING REVIEW

                        </span>

                    @endif

                </div>


                <p class="mt-1 text-sm text-gray-400">
                    Property #{{ $property->id }}
                </p>

            </div>

        </div>

    </div>


    {{-- =====================================================
         ACTIONS
    ====================================================== --}}

    <div class="flex flex-wrap items-center gap-2">


        {{-- APPROVE --}}

        @if($property->approval_status !== 'approved')

            <form
                action="{{ route('admin.properties.approve', $property) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to approve this property? It will become live on the website if it is available and active.');">

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-2.5 text-sm font-semibold text-emerald-400 transition hover:bg-emerald-500/20">

                    <i class="fa-solid fa-check"></i>

                    Approve

                </button>

            </form>

        @endif


        {{-- REJECT --}}

        @if($property->approval_status !== 'rejected')

            <form
                action="{{ route('admin.properties.reject', $property) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to reject this property? It will not be visible on the website.');">

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm font-semibold text-red-400 transition hover:bg-red-500/20">

                    <i class="fa-solid fa-xmark"></i>

                    Reject

                </button>

            </form>

        @endif


        {{-- EDIT --}}

        <a
            href="{{ route('admin.properties.edit', $property) }}"
            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-900/20 transition hover:from-amber-600 hover:to-orange-700">

            <i class="fa-solid fa-pen-to-square"></i>

            Edit

        </a>


        {{-- DELETE --}}

        <form
            action="{{ route('admin.properties.destroy', $property) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete this property?');">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm font-semibold text-red-400 transition hover:bg-red-500/20">

                <i class="fa-solid fa-trash"></i>

                Delete

            </button>

        </form>

    </div>

</div>



{{-- =========================================================
     APPROVAL / VISIBILITY STATUS
========================================================== --}}

<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">


    {{-- APPROVAL STATUS --}}

    <div
        class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-5 shadow-xl">

        <div class="flex items-center gap-4">

            <div
                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                @if($property->approval_status === 'approved')
                    bg-emerald-500/10 text-emerald-400
                @elseif($property->approval_status === 'rejected')
                    bg-red-500/10 text-red-400
                @else
                    bg-amber-500/10 text-amber-400
                @endif">

                @if($property->approval_status === 'approved')

                    <i class="fa-solid fa-circle-check"></i>

                @elseif($property->approval_status === 'rejected')

                    <i class="fa-solid fa-circle-xmark"></i>

                @else

                    <i class="fa-solid fa-clock"></i>

                @endif

            </div>


            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Approval Status
                </p>


                @if($property->approval_status === 'approved')

                    <p class="mt-1 text-sm font-semibold text-emerald-400">
                        Approved
                    </p>

                @elseif($property->approval_status === 'rejected')

                    <p class="mt-1 text-sm font-semibold text-red-400">
                        Rejected
                    </p>

                @else

                    <p class="mt-1 text-sm font-semibold text-amber-400">
                        Pending Review
                    </p>

                @endif

            </div>

        </div>

    </div>


    {{-- WEBSITE VISIBILITY --}}

    <div
        class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-5 shadow-xl">

        <div class="flex items-center gap-4">

            <div
                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                @if(
                    $property->approval_status === 'approved'
                    && $property->is_active
                    && $property->status === 'available'
                )
                    bg-emerald-500/10 text-emerald-400
                @else
                    bg-gray-500/10 text-gray-400
                @endif">

                @if(
                    $property->approval_status === 'approved'
                    && $property->is_active
                    && $property->status === 'available'
                )

                    <i class="fa-solid fa-eye"></i>

                @else

                    <i class="fa-solid fa-eye-slash"></i>

                @endif

            </div>


            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Website Visibility
                </p>


                @if(
                    $property->approval_status === 'approved'
                    && $property->is_active
                    && $property->status === 'available'
                )

                    <p class="mt-1 text-sm font-semibold text-emerald-400">
                        Live on Website
                    </p>

                @elseif($property->approval_status === 'pending')

                    <p class="mt-1 text-sm font-semibold text-amber-400">
                        Not Public
                    </p>

                @elseif($property->approval_status === 'rejected')

                    <p class="mt-1 text-sm font-semibold text-red-400">
                        Not Public
                    </p>

                @else

                    <p class="mt-1 text-sm font-semibold text-gray-400">
                        Not Public
                    </p>

                @endif

            </div>

        </div>

    </div>


    {{-- MARKET STATUS --}}

    <div
        class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-5 shadow-xl">

        <div class="flex items-center gap-4">

            <div
                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                <i class="fa-solid fa-tag"></i>

            </div>


            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Market Status
                </p>

                <p class="mt-1 text-sm font-semibold capitalize text-white">
                    {{ $property->status }}
                </p>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     WEBSITE VISIBILITY MESSAGE
========================================================== --}}

@if($property->approval_status === 'pending')

    <div
        class="flex items-start gap-4 rounded-2xl border border-amber-500/20 bg-amber-500/5 p-5">

        <div
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-500/10 text-amber-400">

            <i class="fa-solid fa-clock"></i>

        </div>

        <div>

            <h3 class="text-sm font-semibold text-amber-300">
                Property is waiting for approval
            </h3>

            <p class="mt-1 text-xs leading-5 text-gray-500">

                This property was submitted for review and is currently
                <span class="font-medium text-amber-400">
                    not publicly visible
                </span>.
                Approve it to make it eligible for website visibility.

            </p>

        </div>

    </div>

@elseif($property->approval_status === 'rejected')

    <div
        class="flex items-start gap-4 rounded-2xl border border-red-500/20 bg-red-500/5 p-5">

        <div
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-400">

            <i class="fa-solid fa-circle-xmark"></i>

        </div>

        <div>

            <h3 class="text-sm font-semibold text-red-300">
                Property has been rejected
            </h3>

            <p class="mt-1 text-xs leading-5 text-gray-500">

                This property is currently
                <span class="font-medium text-red-400">
                    not publicly visible
                </span>.
                You can review the property information and approve it if it meets the required criteria.

            </p>

        </div>

    </div>

@elseif(
    $property->approval_status === 'approved'
    && (!$property->is_active || $property->status !== 'available')
)

    <div
        class="flex items-start gap-4 rounded-2xl border border-gray-500/20 bg-gray-500/5 p-5">

        <div
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-500/10 text-gray-400">

            <i class="fa-solid fa-eye-slash"></i>

        </div>

        <div>

            <h3 class="text-sm font-semibold text-gray-300">
                Property is approved but not publicly visible
            </h3>

            <p class="mt-1 text-xs leading-5 text-gray-500">

                The property is approved, but website visibility requires
                <span class="font-medium text-emerald-400">
                    Active
                </span>
                status and
                <span class="font-medium text-emerald-400">
                    Available
                </span>
                market status.

            </p>

        </div>

    </div>

@endif



{{-- =========================================================
     PROPERTY PHOTOS
========================================================== --}}

<div
    class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

    <div class="border-b border-purple-500/20 px-5 py-5 sm:px-6">

        <div class="flex items-center gap-3">

            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                <i class="fa-solid fa-images"></i>

            </div>

            <div>

                <h3 class="font-semibold text-white">
                    Property Photos
                </h3>

                <p class="text-xs text-gray-500">

                    {{ !empty($property->photos) && is_array($property->photos) ? count($property->photos) : 0 }}

                    {{ !empty($property->photos) && is_array($property->photos) && count($property->photos) == 1 ? 'photo' : 'photos' }}

                </p>

            </div>

        </div>

    </div>


    <div class="p-5 sm:p-6">

        @if(!empty($property->photos) && is_array($property->photos))

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                @foreach($property->photos as $photo)

                    <div
                        class="group relative overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-800">

                        <img
                            src="{{ asset('storage/' . $photo) }}"
                            alt="{{ $property->title }}"
                            class="h-48 w-full object-cover transition duration-500 group-hover:scale-110">


                        <div
                            class="absolute inset-0 flex items-center justify-center bg-black/0 transition group-hover:bg-black/40">

                            <a
                                href="{{ asset('storage/' . $photo) }}"
                                target="_blank"
                                class="scale-75 rounded-xl bg-white/10 px-4 py-2 text-sm font-semibold text-white opacity-0 backdrop-blur-sm transition group-hover:scale-100 group-hover:opacity-100">

                                <i class="fa-solid fa-expand mr-1"></i>

                                View

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="flex flex-col items-center justify-center py-12 text-center">

                <div
                    class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-800 text-gray-600">

                    <i class="fa-solid fa-image text-2xl"></i>

                </div>

                <p class="text-sm font-medium text-gray-400">
                    No photos uploaded
                </p>

                <p class="mt-1 text-xs text-gray-600">
                    You can add photos by editing this property.
                </p>

            </div>

        @endif

    </div>

</div>



{{-- =========================================================
     SUMMARY CARDS
========================================================== --}}

<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


    {{-- PRICE --}}

    <div
        class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-5 shadow-xl">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Price
                </p>

                <p class="mt-2 text-xl font-bold text-white">
                    ₹{{ number_format($property->price, 2) }}
                </p>

                <p class="mt-1 text-xs text-gray-500">
                    {{ $property->purpose === 'rent' ? 'For Rent' : 'For Sale' }}
                </p>

            </div>

            <div
                class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                <i class="fa-solid fa-indian-rupee-sign"></i>

            </div>

        </div>

    </div>


    {{-- AREA --}}

    <div
        class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-5 shadow-xl">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Area
                </p>

                <p class="mt-2 text-xl font-bold text-white">

                    {{ $property->area ? number_format($property->area, 2) : '—' }}

                </p>

                @if($property->area)

                    <p class="text-xs text-gray-500">
                        SQFT
                    </p>

                @endif

            </div>

            <div
                class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                <i class="fa-solid fa-ruler-combined"></i>

            </div>

        </div>

    </div>


    {{-- ROOMS --}}

    <div
        class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-5 shadow-xl">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Rooms
                </p>

                <p class="mt-2 text-xl font-bold text-white">

                    {{ $property->bedrooms ?? 0 }}

                    <span class="text-sm font-normal text-gray-500">
                        Beds
                    </span>

                </p>

                <p class="text-xs text-gray-500">
                    {{ $property->bathrooms ?? 0 }} Bathrooms
                </p>

            </div>

            <div
                class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                <i class="fa-solid fa-bed"></i>

            </div>

        </div>

    </div>


    {{-- MARKET STATUS --}}

    <div
        class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-5 shadow-xl">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Status
                </p>

                <p class="mt-2 text-lg font-bold capitalize text-white">
                    {{ $property->status }}
                </p>

                <p class="text-xs text-gray-500">
                    {{ $property->purpose === 'rent' ? 'For Rent' : 'For Sale' }}
                </p>

            </div>

            <div
                class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                <i class="fa-solid fa-tag"></i>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     MAIN CONTENT
========================================================== --}}

<div class="grid gap-6 lg:grid-cols-3">


    {{-- PROPERTY INFORMATION --}}

    <div class="lg:col-span-2">

        <div
            class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

            <div
                class="border-b border-purple-500/20 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-white">
                            Property Information
                        </h3>

                        <p class="text-xs text-gray-500">
                            Complete property details
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-6 p-5 sm:grid-cols-2 sm:p-6">


                {{-- PROPERTY TYPE --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Property Type
                    </p>

                    <p class="text-sm font-medium text-white">

                        {{ $property->propertyType?->name ?? '—' }}

                    </p>

                </div>


                {{-- LOCATION --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Location
                    </p>

                    <div class="flex items-center gap-2">

                        <i class="fa-solid fa-location-dot text-emerald-400"></i>

                        <span class="text-sm font-medium text-white">

                            {{ $property->location?->city ?? '—' }}

                            @if($property->location?->state)

                                , {{ $property->location->state }}

                            @endif

                        </span>

                    </div>

                </div>


                {{-- PURPOSE --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Listing Type
                    </p>

                    <p class="text-sm font-medium text-white">

                        {{ $property->purpose === 'rent' ? 'For Rent' : 'For Sale' }}

                    </p>

                </div>


                {{-- AGENT --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Agent
                    </p>

                    <div class="flex items-center gap-2">

                        <i class="fa-solid fa-user-tie text-amber-400"></i>

                        <span class="text-sm font-medium text-white">

                            {{ $property->agent?->name ?? 'Not Assigned' }}

                        </span>

                    </div>

                </div>


                {{-- APPROVAL STATUS --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Approval Status
                    </p>


                    @if($property->approval_status === 'approved')

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                            <i class="fa-solid fa-circle-check"></i>

                            Approved

                        </span>

                    @elseif($property->approval_status === 'rejected')

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                            <i class="fa-solid fa-circle-xmark"></i>

                            Rejected

                        </span>

                    @else

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full border border-amber-500/20 bg-amber-500/10 px-3 py-1 text-xs font-medium text-amber-400">

                            <i class="fa-solid fa-clock"></i>

                            Pending Review

                        </span>

                    @endif

                </div>


                {{-- BEDROOMS --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Bedrooms
                    </p>

                    <p class="text-sm font-medium text-white">
                        {{ $property->bedrooms ?? 0 }}
                    </p>

                </div>


                {{-- BATHROOMS --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Bathrooms
                    </p>

                    <p class="text-sm font-medium text-white">
                        {{ $property->bathrooms ?? 0 }}
                    </p>

                </div>


                {{-- GARAGES --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Garages
                    </p>

                    <p class="text-sm font-medium text-white">
                        {{ $property->garages ?? 0 }}
                    </p>

                </div>


                {{-- AREA --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Area
                    </p>

                    <p class="text-sm font-medium text-white">

                        {{ $property->area ? number_format($property->area, 2) : '—' }}

                        @if($property->area)
                            sqft
                        @endif

                    </p>

                </div>


                {{-- PRICE --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Price
                    </p>

                    <p class="text-sm font-semibold text-emerald-400">

                        ₹{{ number_format($property->price, 2) }}

                    </p>

                </div>


                {{-- STATUS --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Market Status
                    </p>

                    <p class="text-sm font-medium capitalize text-white">

                        {{ $property->status }}

                    </p>

                </div>


                {{-- ACTIVE --}}

                <div>

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Active
                    </p>

                    @if($property->is_active)

                        <span class="text-sm font-medium text-emerald-400">
                            Yes
                        </span>

                    @else

                        <span class="text-sm font-medium text-red-400">
                            No
                        </span>

                    @endif

                </div>


                {{-- ADDRESS --}}

                <div class="sm:col-span-2">

                    <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                        Address
                    </p>

                    <div class="flex items-start gap-2">

                        <i class="fa-solid fa-location-dot mt-1 text-orange-400"></i>

                        <p class="text-sm leading-6 text-gray-300">

                            {{ $property->address ?: 'No address added.' }}

                        </p>

                    </div>

                </div>


                {{-- DESCRIPTION --}}

                <div class="sm:col-span-2">

                    <p class="mb-2 text-xs uppercase tracking-wider text-gray-500">
                        Description
                    </p>

                    @if($property->description)

                        <p class="whitespace-pre-line text-sm leading-7 text-gray-300">
                            {{ $property->description }}
                        </p>

                    @else

                        <p class="text-sm italic text-gray-600">
                            No description added.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         SIDE INFORMATION
    ====================================================== --}}

    <div class="space-y-6">


        {{-- =================================================
             OWNER INFORMATION
             ONLY SHOW IF OWNER EXISTS
        ================================================== --}}

        @if($property->owner)

            <div
                class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

                {{-- HEADER --}}

                <div class="border-b border-purple-500/20 px-5 py-5">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                            <i class="fa-solid fa-user"></i>

                        </div>

                        <div>

                            <h3 class="font-semibold text-white">
                                Owner Information
                            </h3>

                            <p class="text-xs text-gray-500">
                                Property listed by owner
                            </p>

                        </div>

                    </div>

                </div>


                {{-- OWNER PROFILE --}}

                <div class="p-5">

                    <div class="flex items-center gap-4">

                        {{-- AVATAR --}}

                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-purple-500/30 to-indigo-500/30 text-lg font-bold text-purple-300">

                            {{ strtoupper(substr($property->owner->name ?? 'O', 0, 1)) }}

                        </div>


                        {{-- NAME --}}

                        <div class="min-w-0">

                            <p class="truncate text-base font-semibold text-white">

                                {{ $property->owner->name }}

                            </p>

                            <p class="mt-1 text-xs text-purple-400">

                                Property Owner

                            </p>

                        </div>

                    </div>


                    {{-- OWNER DETAILS --}}

                    <div class="mt-5 space-y-4 border-t border-purple-500/10 pt-5">


                        {{-- EMAIL --}}

                        @if($property->owner->email)

                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400">

                                    <i class="fa-solid fa-envelope text-sm"></i>

                                </div>

                                <div class="min-w-0">

                                    <p class="text-[11px] uppercase tracking-wider text-gray-600">
                                        Email
                                    </p>

                                    <p class="mt-1 break-all text-sm text-gray-300">
                                        {{ $property->owner->email }}
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- PHONE --}}

                        @if($property->owner->phone)

                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400">

                                    <i class="fa-solid fa-phone text-sm"></i>

                                </div>

                                <div>

                                    <p class="text-[11px] uppercase tracking-wider text-gray-600">
                                        Phone
                                    </p>

                                    <p class="mt-1 text-sm text-gray-300">
                                        {{ $property->owner->phone }}
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- OWNER ID --}}

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-500/10 text-orange-400">

                                <i class="fa-solid fa-id-card text-sm"></i>

                            </div>

                            <div>

                                <p class="text-[11px] uppercase tracking-wider text-gray-600">
                                    Owner ID
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-300">
                                    #{{ $property->owner->id }}
                                </p>

                            </div>

                        </div>


                        {{-- MEMBER SINCE --}}

                        @if($property->owner->created_at)

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-fuchsia-500/10 text-fuchsia-400">

                                    <i class="fa-solid fa-calendar text-sm"></i>

                                </div>

                                <div>

                                    <p class="text-[11px] uppercase tracking-wider text-gray-600">
                                        Member Since
                                    </p>

                                    <p class="mt-1 text-sm text-gray-300">

                                        {{ $property->owner->created_at->format('d M Y') }}

                                    </p>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        @endif



        {{-- =================================================
             PROPERTY STATUS
        ================================================== --}}

        <div
            class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-6 shadow-xl">

            <div class="mb-5 flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                    <i class="fa-solid fa-signal"></i>

                </div>

                <h3 class="font-semibold text-white">
                    Property Status
                </h3>

            </div>


            <div class="space-y-4">


                {{-- APPROVAL --}}

                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Approval
                    </span>


                    @if($property->approval_status === 'approved')

                        <span class="text-sm font-medium text-emerald-400">
                            Approved
                        </span>

                    @elseif($property->approval_status === 'rejected')

                        <span class="text-sm font-medium text-red-400">
                            Rejected
                        </span>

                    @else

                        <span class="text-sm font-medium text-amber-400">
                            Pending Review
                        </span>

                    @endif

                </div>


                {{-- ACTIVE --}}

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Active
                    </span>

                    @if($property->is_active)

                        <span class="text-sm font-medium text-emerald-400">
                            Yes
                        </span>

                    @else

                        <span class="text-sm font-medium text-red-400">
                            No
                        </span>

                    @endif

                </div>


                {{-- FEATURED --}}

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Featured
                    </span>

                    @if($property->is_featured)

                        <span class="text-sm font-medium text-amber-400">
                            Yes
                        </span>

                    @else

                        <span class="text-sm font-medium text-gray-500">
                            No
                        </span>

                    @endif

                </div>


                {{-- MARKET STATUS --}}

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Market Status
                    </span>

                    <span class="text-sm font-medium capitalize text-white">
                        {{ $property->status }}
                    </span>

                </div>


                {{-- PURPOSE --}}

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Purpose
                    </span>

                    <span class="text-sm font-medium text-white">

                        {{ $property->purpose === 'rent' ? 'Rent' : 'Sale' }}

                    </span>

                </div>


                {{-- VISIBILITY --}}

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Website
                    </span>


                    @if(
                        $property->approval_status === 'approved'
                        && $property->is_active
                        && $property->status === 'available'
                    )

                        <span class="text-sm font-medium text-emerald-400">
                            Live
                        </span>

                    @else

                        <span class="text-sm font-medium text-gray-500">
                            Not Public
                        </span>

                    @endif

                </div>

            </div>

        </div>



        {{-- =================================================
             RECORD INFO
        ================================================== --}}

        <div
            class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-6 shadow-xl">

            <div class="mb-5 flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-fuchsia-500/10 text-fuchsia-400">

                    <i class="fa-solid fa-clock"></i>

                </div>

                <h3 class="font-semibold text-white">
                    Record Information
                </h3>

            </div>


            <div class="space-y-4">


                {{-- ID --}}

                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        ID
                    </span>

                    <span class="text-sm font-medium text-gray-300">
                        #{{ $property->id }}
                    </span>

                </div>


                {{-- CREATED --}}

                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Created
                    </span>

                    <span class="text-right text-sm text-gray-300">

                        {{ $property->created_at?->format('d M Y, h:i A') }}

                    </span>

                </div>


                {{-- UPDATED --}}

                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Updated
                    </span>

                    <span class="text-right text-sm text-gray-300">

                        {{ $property->updated_at?->format('d M Y, h:i A') }}

                    </span>

                </div>


                {{-- PHOTO COUNT --}}

                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Photos
                    </span>

                    <span class="text-sm font-medium text-purple-400">

                        {{ !empty($property->photos) && is_array($property->photos) ? count($property->photos) : 0 }}

                    </span>

                </div>

            </div>

        </div>



        {{-- =================================================
             QUICK ACTION
        ================================================== --}}

        <div
            class="rounded-2xl border border-orange-500/20 bg-orange-500/5 p-5">

            <p class="text-sm font-medium text-orange-300">
                Need to update this property?
            </p>

            <a
                href="{{ route('admin.properties.edit', $property) }}"
                class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500/10 px-4 py-3 text-sm font-semibold text-orange-400 transition hover:bg-orange-500/20">

                <i class="fa-solid fa-pen-to-square"></i>

                Edit Property

            </a>

        </div>


    </div>

</div>


</div>

@endsection