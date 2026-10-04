@extends('agent.layouts.app')

@section('title', 'My Properties')
@section('page-title', 'My Properties')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-white">
                My Properties
            </h1>

            <p class="mt-1 text-sm text-gray-400">
                Manage all properties added by you.
            </p>

        </div>


        <a
            href="{{ route('agent.properties.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-purple-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-600/20 transition hover:bg-purple-500"
        >

            <i class="fa-solid fa-plus"></i>

            Add Property

        </a>

    </div>


    {{-- =========================================================
         SEARCH / FILTER CARD
    ========================================================== --}}

    <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5 shadow-xl">

        <form
            action="{{ route('agent.properties.index') }}"
            method="GET"
            class="grid gap-4 lg:grid-cols-5"
        >

            {{-- SEARCH --}}

            <div class="lg:col-span-2">

                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Search Property
                </label>

                <div class="relative">

                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by property title..."
                        class="w-full rounded-xl border border-white/10 bg-gray-950/70 py-3 pl-11 pr-4 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                    >

                </div>

            </div>


            {{-- PROPERTY TYPE --}}

            <div>

                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Property Type
                </label>

                <select
                    name="property_type_id"
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

                    <option value="">
                        All Types
                    </option>

                    @foreach ($propertyTypes as $type)

                        <option
                            value="{{ $type->id }}"
                            @selected(request('property_type_id') == $type->id)
                        >
                            {{ $type->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- LOCATION --}}

            <div>

                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Location
                </label>

                <select
                    name="location_id"
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

                    <option value="">
                        All Locations
                    </option>

                    @foreach ($locations as $location)

                        <option
                            value="{{ $location->id }}"
                            @selected(request('location_id') == $location->id)
                        >

                            {{ $location->city }}

                            @if (!empty($location->state))
                                , {{ $location->state }}
                            @endif

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- AVAILABILITY STATUS --}}

            <div>

                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Availability
                </label>

                <select
                    name="status"
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

                    <option value="">
                        All Availability
                    </option>

                    <option
                        value="available"
                        @selected(request('status') === 'available')
                    >
                        Available
                    </option>

                    <option
                        value="sold"
                        @selected(request('status') === 'sold')
                    >
                        Sold
                    </option>

                    <option
                        value="rented"
                        @selected(request('status') === 'rented')
                    >
                        Rented
                    </option>

                </select>

            </div>


            {{-- PURPOSE --}}

            <div>

                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Purpose
                </label>

                <select
                    name="purpose"
                    class="w-full rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

                    <option value="">
                        All Purpose
                    </option>

                    <option
                        value="sale"
                        @selected(request('purpose') === 'sale')
                    >
                        For Sale
                    </option>

                    <option
                        value="rent"
                        @selected(request('purpose') === 'rent')
                    >
                        For Rent
                    </option>

                </select>

            </div>


            {{-- BUTTONS --}}

            <div class="flex items-end gap-3 lg:col-span-5">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-purple-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-purple-500"
                >

                    <i class="fa-solid fa-filter"></i>

                    Apply Filters

                </button>


                <a
                    href="{{ route('agent.properties.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
                >

                    <i class="fa-solid fa-rotate-left"></i>

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
         PROPERTY COUNT
    ========================================================== --}}

    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <p class="text-sm text-gray-400">

                Showing

                <span class="font-semibold text-white">
                    {{ $properties->count() }}
                </span>

                of

                <span class="font-semibold text-white">
                    {{ $properties->total() }}
                </span>

                properties

            </p>

        </div>

    </div>


    {{-- =========================================================
         PROPERTY TABLE
    ========================================================== --}}

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70 shadow-xl">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1500px] text-left">

                {{-- TABLE HEADER --}}

                <thead class="border-b border-white/10 bg-white/[0.02]">

                    <tr>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Property
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Type
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Location
                        </th>

                        {{-- OWNER --}}

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Owner
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Purpose
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Price
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Availability
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Approval
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Visibility
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Action
                        </th>

                    </tr>

                </thead>


                {{-- TABLE BODY --}}

                <tbody class="divide-y divide-white/5">

                    @forelse ($properties as $property)

                        <tr class="transition hover:bg-white/[0.02]">


                            {{-- =================================================
                                 PROPERTY
                            ================================================== --}}

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-4">

                                    {{-- PROPERTY IMAGE --}}

                                    <div class="h-16 w-24 shrink-0 overflow-hidden rounded-xl border border-white/10 bg-gray-950">

                                        @if (
                                            is_array($property->photos) &&
                                            count($property->photos) > 0
                                        )

                                            <img
                                                src="{{ asset('storage/' . $property->photos[0]) }}"
                                                alt="{{ $property->title }}"
                                                class="h-full w-full object-cover"
                                            >

                                        @else

                                            <div class="flex h-full w-full items-center justify-center text-gray-600">

                                                <i class="fa-solid fa-image text-xl"></i>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- PROPERTY DETAILS --}}

                                    <div class="min-w-0">

                                        <p class="max-w-xs truncate text-sm font-semibold text-white">
                                            {{ $property->title }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            Property #{{ $property->id }}
                                        </p>


                                        {{-- FEATURED --}}

                                        @if ($property->is_featured)

                                            <span class="mt-2 inline-flex items-center gap-1 rounded-full bg-yellow-500/10 px-2 py-1 text-[10px] font-medium text-yellow-400">

                                                <i class="fa-solid fa-star"></i>

                                                Featured

                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                 TYPE
                            ================================================== --}}

                            <td class="px-6 py-4">

                                <span class="text-sm text-gray-300">
                                    {{ $property->propertyType->name ?? '—' }}
                                </span>

                            </td>


                            {{-- =================================================
                                 LOCATION
                            ================================================== --}}

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2 text-sm text-gray-400">

                                    <i class="fa-solid fa-location-dot text-purple-400"></i>

                                    <span>
                                        {{ $property->location->city ?? '—' }}
                                    </span>

                                </div>

                            </td>


                            {{-- =================================================
                                 OWNER
                            ================================================== --}}

                            <td class="px-6 py-4">

                                @if ($property->owner)

                                    <div class="min-w-[190px]">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-purple-500/10 text-purple-400">

                                                <i class="fa-solid fa-user"></i>

                                            </div>

                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-semibold text-white">
                                                    {{ $property->owner->name }}
                                                </p>

                                                <p class="mt-0.5 truncate text-xs text-gray-500">
                                                    Owner
                                                </p>

                                            </div>

                                        </div>


                                        @if (!empty($property->owner->email))

                                            <div class="mt-3 flex items-center gap-2 text-xs text-gray-400">

                                                <i class="fa-solid fa-envelope w-4 text-gray-500"></i>

                                                <span class="max-w-[180px] truncate">
                                                    {{ $property->owner->email }}
                                                </span>

                                            </div>

                                        @endif


                                        @if (!empty($property->owner->phone))

                                            <div class="mt-1 flex items-center gap-2 text-xs text-gray-400">

                                                <i class="fa-solid fa-phone w-4 text-gray-500"></i>

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


                            {{-- =================================================
                                 PURPOSE
                            ================================================== --}}

                            <td class="px-6 py-4">

                                @if ($property->purpose === 'sale')

                                    <span class="inline-flex items-center gap-2 rounded-full border border-blue-500/20 bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-400">

                                        <i class="fa-solid fa-tag"></i>

                                        For Sale

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-2 rounded-full border border-cyan-500/20 bg-cyan-500/10 px-3 py-1 text-xs font-medium text-cyan-400">

                                        <i class="fa-solid fa-key"></i>

                                        For Rent

                                    </span>

                                @endif

                            </td>


                            {{-- =================================================
                                 PRICE
                            ================================================== --}}

                            <td class="px-6 py-4">

                                <span class="whitespace-nowrap text-sm font-semibold text-white">

                                    ₹{{ number_format((float) $property->price, 0) }}

                                </span>

                            </td>


                            {{-- =================================================
                                 AVAILABILITY STATUS
                            ================================================== --}}

                            <td class="px-6 py-4">

                                @php

                                    $statusClasses = match ($property->status) {

                                        'available' =>
                                            'bg-green-500/10 text-green-400 border-green-500/20',

                                        'sold' =>
                                            'bg-red-500/10 text-red-400 border-red-500/20',

                                        'rented' =>
                                            'bg-blue-500/10 text-blue-400 border-blue-500/20',

                                        default =>
                                            'bg-gray-500/10 text-gray-400 border-gray-500/20',

                                    };


                                    $statusLabel = match ($property->status) {

                                        'available' => 'Available',

                                        'sold' => 'Sold',

                                        'rented' => 'Rented',

                                        default => ucfirst($property->status ?? 'Unknown'),

                                    };

                                @endphp


                                <span
                                    class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-medium {{ $statusClasses }}"
                                >

                                    @if ($property->status === 'available')

                                        <i class="fa-solid fa-circle-check"></i>

                                    @elseif ($property->status === 'sold')

                                        <i class="fa-solid fa-circle-xmark"></i>

                                    @elseif ($property->status === 'rented')

                                        <i class="fa-solid fa-key"></i>

                                    @else

                                        <i class="fa-solid fa-circle-question"></i>

                                    @endif

                                    {{ $statusLabel }}

                                </span>

                            </td>


                            {{-- =================================================
                                 APPROVAL STATUS
                            ================================================== --}}

                            <td class="px-6 py-4">

                                @php

                                    $approvalStatus = $property->approval_status ?? 'pending';


                                    $approvalClasses = match ($approvalStatus) {

                                        'approved' =>
                                            'bg-green-500/10 text-green-400 border-green-500/20',

                                        'rejected' =>
                                            'bg-red-500/10 text-red-400 border-red-500/20',

                                        default =>
                                            'bg-amber-500/10 text-amber-400 border-amber-500/20',

                                    };


                                    $approvalLabel = match ($approvalStatus) {

                                        'approved' => 'Approved',

                                        'rejected' => 'Rejected',

                                        default => 'Pending Review',

                                    };

                                @endphp


                                <div class="flex flex-col items-start gap-1">

                                    <span
                                        class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-medium {{ $approvalClasses }}"
                                    >

                                        @if ($approvalStatus === 'approved')

                                            <i class="fa-solid fa-circle-check"></i>

                                        @elseif ($approvalStatus === 'rejected')

                                            <i class="fa-solid fa-circle-xmark"></i>

                                        @else

                                            <i class="fa-solid fa-clock"></i>

                                        @endif

                                        {{ $approvalLabel }}

                                    </span>


                                    @if ($approvalStatus === 'pending')

                                        <span class="text-[10px] text-gray-500">
                                            Waiting for Super Admin
                                        </span>

                                    @elseif ($approvalStatus === 'approved')

                                        <span class="text-[10px] text-green-500/70">
                                            Property approved
                                        </span>

                                    @elseif ($approvalStatus === 'rejected')

                                        <span class="text-[10px] text-red-400/70">
                                            Not approved
                                        </span>

                                    @endif

                                </div>

                            </td>


                            {{-- =================================================
                                 VISIBILITY
                            ================================================== --}}

                            <td class="px-6 py-4">

                                @if (
                                    $property->approval_status === 'approved' &&
                                    $property->is_active &&
                                    $property->status === 'available'
                                )

                                    <div class="flex flex-col items-start gap-1">

                                        <span class="inline-flex items-center gap-2 text-xs font-medium text-green-400">

                                            <span class="h-2 w-2 rounded-full bg-green-400"></span>

                                            Live on Website

                                        </span>

                                        <span class="text-[10px] text-gray-500">
                                            Publicly visible
                                        </span>

                                    </div>

                                @elseif ($property->approval_status === 'pending')

                                    <div class="flex flex-col items-start gap-1">

                                        <span class="inline-flex items-center gap-2 text-xs font-medium text-amber-400">

                                            <span class="h-2 w-2 rounded-full bg-amber-400"></span>

                                            Under Review

                                        </span>

                                        <span class="text-[10px] text-gray-500">
                                            Not public
                                        </span>

                                    </div>

                                @elseif ($property->approval_status === 'rejected')

                                    <div class="flex flex-col items-start gap-1">

                                        <span class="inline-flex items-center gap-2 text-xs font-medium text-red-400">

                                            <span class="h-2 w-2 rounded-full bg-red-400"></span>

                                            Not Published

                                        </span>

                                        <span class="text-[10px] text-gray-500">
                                            Approval rejected
                                        </span>

                                    </div>

                                @elseif (
                                    $property->approval_status === 'approved' &&
                                    $property->status !== 'available'
                                )

                                    <div class="flex flex-col items-start gap-1">

                                        <span class="inline-flex items-center gap-2 text-xs font-medium text-gray-400">

                                            <span class="h-2 w-2 rounded-full bg-gray-500"></span>

                                            Not Public

                                        </span>

                                        <span class="text-[10px] text-gray-500">
                                            {{ ucfirst($property->status) }}
                                        </span>

                                    </div>

                                @else

                                    <div class="flex flex-col items-start gap-1">

                                        <span class="inline-flex items-center gap-2 text-xs font-medium text-gray-500">

                                            <span class="h-2 w-2 rounded-full bg-gray-600"></span>

                                            Inactive

                                        </span>

                                        <span class="text-[10px] text-gray-600">
                                            Admin controlled
                                        </span>

                                    </div>

                                @endif

                            </td>


                            {{-- =================================================
                                 ACTION
                            ================================================== --}}

                            <td class="px-6 py-4 text-right">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- SHOW --}}

                                    <a
                                        href="{{ route('agent.properties.show', $property) }}"
                                        class="inline-flex items-center gap-2 rounded-xl border border-blue-500/20 bg-blue-500/10 px-4 py-2 text-xs font-semibold text-blue-400 transition hover:bg-blue-500/20 hover:text-blue-300"
                                        title="View Property"
                                    >

                                        <i class="fa-solid fa-eye"></i>

                                        Show

                                    </a>


                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route('agent.properties.edit', $property) }}"
                                        class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold text-gray-300 transition hover:bg-purple-600/10 hover:text-purple-400"
                                        title="Edit Property"
                                    >

                                        <i class="fa-solid fa-pen-to-square"></i>

                                        Edit

                                    </a>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- =================================================
                             EMPTY STATE
                        ================================================== --}}

                        <tr>

                            <td
                                colspan="10"
                                class="px-6 py-20 text-center"
                            >

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-purple-500/10 text-2xl text-purple-400">

                                    <i class="fa-solid fa-building"></i>

                                </div>


                                <h3 class="mt-5 text-lg font-semibold text-white">
                                    No Properties Found
                                </h3>


                                <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">

                                    You haven't added any properties yet,
                                    or no property matches your current filters.

                                </p>


                                <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row">


                                    @if (
                                        request()->filled('search') ||
                                        request()->filled('property_type_id') ||
                                        request()->filled('location_id') ||
                                        request()->filled('purpose') ||
                                        request()->filled('status')
                                    )

                                        <a
                                            href="{{ route('agent.properties.index') }}"
                                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
                                        >

                                            <i class="fa-solid fa-rotate-left"></i>

                                            Clear Filters

                                        </a>

                                    @endif


                                    <a
                                        href="{{ route('agent.properties.create') }}"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-purple-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-purple-500"
                                    >

                                        <i class="fa-solid fa-plus"></i>

                                        Add Property

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =========================================================
             PAGINATION
        ========================================================== --}}

        @if ($properties->hasPages())

            <div class="border-t border-white/10 px-6 py-5">

                {{ $properties->links() }}

            </div>

        @endif

    </div>

</div>

@endsection