@extends('admin.layouts.app')

@section('title', 'Properties')
@section('page-title', 'Properties')

@section('content')

<div class="space-y-6">


{{-- =========================================================
     HEADER
========================================================== --}}

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>

        <h2 class="text-2xl font-bold text-white">
            Properties
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            Manage all properties listed in your system.
        </p>

    </div>


    <a
        href="{{ route('admin.properties.create') }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-900/30 transition hover:from-orange-600 hover:to-amber-600">

        <i class="fa-solid fa-plus"></i>

        Add Property

    </a>

</div>



{{-- =========================================================
     SEARCH / FILTER
========================================================== --}}

<div class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-5 shadow-xl">

    <form
        action="{{ route('admin.properties.index') }}"
        method="GET"
        class="grid gap-4 md:grid-cols-2 lg:grid-cols-5">


        {{-- SEARCH --}}

        <div>

            <label class="mb-2 block text-xs font-medium text-gray-400">
                Search
            </label>

            <div class="relative">

                <i
                    class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                </i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Property title..."
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 py-3 pl-11 pr-4 text-sm text-white placeholder-gray-600 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

            </div>

        </div>



        {{-- PROPERTY TYPE --}}

        <div>

            <label class="mb-2 block text-xs font-medium text-gray-400">
                Property Type
            </label>

            <select
                name="property_type_id"
                class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                <option value="">
                    All Types
                </option>

                @foreach($propertyTypes as $type)

                    <option
                        value="{{ $type->id }}"
                        @selected(request('property_type_id') == $type->id)>

                        {{ $type->name }}

                    </option>

                @endforeach

            </select>

        </div>



        {{-- LOCATION --}}

        <div>

            <label class="mb-2 block text-xs font-medium text-gray-400">
                Location
            </label>

            <select
                name="location_id"
                class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                <option value="">
                    All Locations
                </option>

                @foreach($locations as $location)

                    <option
                        value="{{ $location->id }}"
                        @selected(request('location_id') == $location->id)>

                        {{ $location->city }}

                    </option>

                @endforeach

            </select>

        </div>



        {{-- MARKET STATUS --}}

        <div>

            <label class="mb-2 block text-xs font-medium text-gray-400">
                Availability
            </label>

            <select
                name="status"
                class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                <option value="">
                    All Availability
                </option>

                <option
                    value="available"
                    @selected(request('status') === 'available')>

                    Available

                </option>

                <option
                    value="pending"
                    @selected(request('status') === 'pending')>

                    Pending

                </option>

                <option
                    value="sold"
                    @selected(request('status') === 'sold')>

                    Sold

                </option>

                <option
                    value="rented"
                    @selected(request('status') === 'rented')>

                    Rented

                </option>

            </select>

        </div>



        {{-- APPROVAL STATUS --}}

        <div>

            <label class="mb-2 block text-xs font-medium text-gray-400">
                Approval Status
            </label>

            <select
                name="approval_status"
                class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                <option value="">
                    All Approval Status
                </option>

                <option
                    value="pending"
                    @selected(request('approval_status') === 'pending')>

                    Pending Review

                </option>

                <option
                    value="approved"
                    @selected(request('approval_status') === 'approved')>

                    Approved

                </option>

                <option
                    value="rejected"
                    @selected(request('approval_status') === 'rejected')>

                    Rejected

                </option>

            </select>

        </div>



        {{-- BUTTONS --}}

        <div class="flex items-end gap-2 md:col-span-2 lg:col-span-5">

            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-xl bg-purple-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-purple-700">

                <i class="fa-solid fa-filter"></i>

                Filter

            </button>


            <a
                href="{{ route('admin.properties.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-gray-700 bg-slate-800 px-5 py-3 text-sm font-semibold text-gray-300 transition hover:bg-slate-700 hover:text-white">

                <i class="fa-solid fa-rotate-left"></i>

                Reset

            </a>

        </div>

    </form>

</div>



{{-- =========================================================
     TABLE
========================================================== --}}

<div class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">


    {{-- TABLE HEADER --}}

    <div class="border-b border-purple-500/20 px-5 py-4 sm:px-6">

        <div class="flex items-center gap-3">

            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                <i class="fa-solid fa-building"></i>

            </div>

            <div>

                <h3 class="font-semibold text-white">
                    Property List
                </h3>

                <p class="text-xs text-gray-500">
                    Manage properties, owners and approval status
                </p>

            </div>

        </div>

    </div>



    {{-- TABLE --}}

    <div class="overflow-x-auto">

        <table class="w-full min-w-[1650px] text-left">

            <thead class="border-b border-purple-500/20 bg-slate-950/50">

                <tr>


                    {{-- NUMBER --}}

                    <th
                        class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">

                        #

                    </th>



                    {{-- PROPERTY --}}

                    <th
                        class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">

                        Property

                    </th>



                    {{-- TYPE --}}

                    <th
                        class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">

                        Type

                    </th>



                    {{-- LOCATION --}}

                    <th
                        class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">

                        Location

                    </th>



                    {{-- PRICE --}}

                    <th
                        class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">

                        Price

                    </th>



                    {{-- AGENT --}}

                    <th
                        class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">

                        Agent

                    </th>



                    {{-- MARKET STATUS --}}

                    <th
                        class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">

                        Availability

                    </th>



                    {{-- APPROVAL --}}

                    <th
                        class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">

                        Approval

                    </th>



                    {{-- VISIBILITY --}}

                    <th
                        class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">

                        Visibility

                    </th>



                    {{-- ACTIONS --}}

                    <th
                        class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-400">

                        Actions

                    </th>

                </tr>

            </thead>



            <tbody class="divide-y divide-purple-500/10">


                @forelse($properties as $property)


                    <tr class="transition hover:bg-purple-500/5">


                        {{-- =================================================
                             NUMBER
                        ================================================== --}}

                        <td class="px-5 py-4 text-sm text-gray-500">

                            {{ $properties->firstItem() + $loop->index }}

                        </td>



                        {{-- =================================================
                             PROPERTY + OWNER
                        ================================================== --}}

                        <td class="px-5 py-4">

                            <div class="flex items-start gap-3">


                                {{-- PROPERTY IMAGE --}}

                                <div
                                    class="h-16 w-20 shrink-0 overflow-hidden rounded-xl border border-purple-500/20 bg-slate-950">

                                    @if(
                                        !empty($property->photos) &&
                                        is_array($property->photos) &&
                                        !empty($property->photos[0])
                                    )

                                        <img
                                            src="{{ asset('storage/' . $property->photos[0]) }}"
                                            alt="{{ $property->title }}"
                                            class="h-full w-full object-cover transition duration-300 hover:scale-110">

                                    @else

                                        <div
                                            class="flex h-full w-full items-center justify-center bg-gradient-to-br from-orange-500/20 to-amber-500/20 text-orange-400">

                                            <i class="fa-solid fa-house text-lg"></i>

                                        </div>

                                    @endif

                                </div>



                                {{-- PROPERTY DETAILS --}}

                                <div class="min-w-0 flex-1">


                                    {{-- PROPERTY TITLE --}}

                                    <div class="flex items-center gap-2">

                                        <p
                                            class="max-w-[260px] truncate font-semibold text-white">

                                            {{ $property->title }}

                                        </p>


                                        @if($property->is_featured)

                                            <span
                                                title="Featured"
                                                class="text-amber-400">

                                                <i class="fa-solid fa-star text-xs"></i>

                                            </span>

                                        @endif

                                    </div>



                                    {{-- PROPERTY ADDRESS --}}

                                    @if($property->address)

                                        <p
                                            class="mt-1 flex max-w-[300px] items-center gap-1.5 truncate text-xs text-gray-500">

                                            <i class="fa-solid fa-location-dot shrink-0 text-purple-400"></i>

                                            <span class="truncate">
                                                {{ $property->address }}
                                            </span>

                                        </p>

                                    @endif



                                    {{-- PHOTO COUNT --}}

                                    @if(
                                        !empty($property->photos) &&
                                        is_array($property->photos)
                                    )

                                        <p
                                            class="mt-1 flex items-center gap-1 text-xs text-gray-600">

                                            <i class="fa-solid fa-images"></i>

                                            {{ count($property->photos) }}

                                            {{ count($property->photos) == 1 ? 'photo' : 'photos' }}

                                        </p>

                                    @endif



                                    {{-- =================================================
                                         OWNER DETAILS
                                         ONLY IF OWNER EXISTS
                                    ================================================== --}}

                                    @if($property->owner)

                                            <div class="mt-3 border-t border-gray-800 pt-2">

                                                <div class="flex items-center gap-2">

                                                    <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-purple-500/10 text-xs font-bold text-purple-400">

                                                        {{ strtoupper(substr($property->owner->name ?? 'O', 0, 1)) }}

                                                    </div>

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

                            </div>

                        </td>



                        {{-- =================================================
                             TYPE
                        ================================================== --}}

                        <td class="px-5 py-4">

                            <span class="text-sm text-gray-300">

                                {{ $property->propertyType->name ?? '—' }}

                            </span>

                        </td>



                        {{-- =================================================
                             LOCATION
                        ================================================== --}}

                        <td class="px-5 py-4">

                            <div
                                class="flex items-center gap-2 text-sm text-gray-300">

                                <i
                                    class="fa-solid fa-location-dot text-emerald-400">
                                </i>

                                {{ $property->location->city ?? '—' }}

                            </div>

                        </td>



                        {{-- =================================================
                             PRICE
                        ================================================== --}}

                        <td class="px-5 py-4">

                            <span class="font-semibold text-white">

                                ₹{{ number_format($property->price, 2) }}

                            </span>

                        </td>



                        {{-- =================================================
                             AGENT
                        ================================================== --}}

                        <td class="px-5 py-4">

                            @if($property->agent)

                                <div class="flex items-center gap-2">

                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-500/20 text-xs font-semibold text-purple-300">

                                        {{ strtoupper(substr($property->agent->name, 0, 1)) }}

                                    </div>

                                    <span class="text-sm text-gray-300">

                                        {{ $property->agent->name }}

                                    </span>

                                </div>

                            @else

                                <span class="text-sm text-gray-600">
                                    Admin
                                </span>

                            @endif

                        </td>



                        {{-- =================================================
                             MARKET STATUS
                        ================================================== --}}

                        <td class="px-5 py-4">

                            @if($property->status === 'available')

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-emerald-400">
                                    </span>

                                    Available

                                </span>


                            @elseif($property->status === 'pending')

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full border border-amber-500/20 bg-amber-500/10 px-3 py-1 text-xs font-medium text-amber-400">

                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-amber-400">
                                    </span>

                                    Pending

                                </span>


                            @elseif($property->status === 'sold')

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-red-400">
                                    </span>

                                    Sold

                                </span>


                            @elseif($property->status === 'rented')

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full border border-blue-500/20 bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-400">

                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-blue-400">
                                    </span>

                                    Rented

                                </span>


                            @else

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full border border-gray-500/20 bg-gray-500/10 px-3 py-1 text-xs font-medium text-gray-400">

                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-gray-400">
                                    </span>

                                    Unknown

                                </span>

                            @endif

                        </td>



                        {{-- =================================================
                             APPROVAL STATUS
                        ================================================== --}}

                        <td class="px-5 py-4">

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

                        </td>



                        {{-- =================================================
                             VISIBILITY
                        ================================================== --}}

                        <td class="px-5 py-4">

                            @if(
                                $property->approval_status === 'approved' &&
                                $property->is_active &&
                                $property->status === 'available'
                            )

                                <div class="flex flex-col gap-1">

                                    <span
                                        class="inline-flex w-fit items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                                        <span
                                            class="h-1.5 w-1.5 rounded-full bg-emerald-400">
                                        </span>

                                        Live

                                    </span>

                                    <span
                                        class="text-[11px] text-gray-600">

                                        Publicly visible

                                    </span>

                                </div>


                            @elseif($property->approval_status === 'pending')

                                <div class="flex flex-col gap-1">

                                    <span
                                        class="inline-flex w-fit items-center gap-1.5 rounded-full border border-amber-500/20 bg-amber-500/10 px-3 py-1 text-xs font-medium text-amber-400">

                                        <i class="fa-solid fa-eye-slash"></i>

                                        Not Public

                                    </span>

                                    <span
                                        class="text-[11px] text-gray-600">

                                        Awaiting approval

                                    </span>

                                </div>


                            @elseif($property->approval_status === 'rejected')

                                <div class="flex flex-col gap-1">

                                    <span
                                        class="inline-flex w-fit items-center gap-1.5 rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                                        <i class="fa-solid fa-eye-slash"></i>

                                        Not Public

                                    </span>

                                    <span
                                        class="text-[11px] text-gray-600">

                                        Approval rejected

                                    </span>

                                </div>


                            @elseif(
                                $property->approval_status === 'approved' &&
                                $property->status !== 'available'
                            )

                                <div class="flex flex-col gap-1">

                                    <span
                                        class="inline-flex w-fit items-center gap-1.5 rounded-full border border-gray-500/20 bg-gray-500/10 px-3 py-1 text-xs font-medium text-gray-400">

                                        <i class="fa-solid fa-eye-slash"></i>

                                        Not Public

                                    </span>

                                    <span
                                        class="text-[11px] text-gray-600">

                                        Sold / Rented

                                    </span>

                                </div>


                            @elseif(!$property->is_active)

                                <div class="flex flex-col gap-1">

                                    <span
                                        class="inline-flex w-fit items-center gap-1.5 rounded-full border border-gray-500/20 bg-gray-500/10 px-3 py-1 text-xs font-medium text-gray-400">

                                        <i class="fa-solid fa-eye-slash"></i>

                                        Not Public

                                    </span>

                                    <span
                                        class="text-[11px] text-gray-600">

                                        Inactive

                                    </span>

                                </div>


                            @else

                                <div class="flex flex-col gap-1">

                                    <span
                                        class="inline-flex w-fit items-center gap-1.5 rounded-full border border-gray-500/20 bg-gray-500/10 px-3 py-1 text-xs font-medium text-gray-400">

                                        <i class="fa-solid fa-eye-slash"></i>

                                        Not Public

                                    </span>

                                    <span
                                        class="text-[11px] text-gray-600">

                                        Inactive

                                    </span>

                                </div>

                            @endif

                        </td>



                        {{-- =================================================
                             ACTIONS
                        ================================================== --}}

                        <td class="px-5 py-4">

                            <div
                                class="flex items-center justify-end gap-2">


                                {{-- APPROVE --}}

                                @if($property->approval_status !== 'approved')

                                    <form
                                        action="{{ route('admin.properties.approve', $property) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to approve this property? It will become visible on the website if it is available.');">

                                        @csrf

                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            title="Approve Property"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-emerald-500/20 bg-emerald-500/10 text-emerald-400 transition hover:bg-emerald-500/20">

                                            <i class="fa-solid fa-check text-sm"></i>

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
                                            title="Reject Property"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-red-500/20 bg-red-500/10 text-red-400 transition hover:bg-red-500/20">

                                            <i class="fa-solid fa-xmark text-sm"></i>

                                        </button>

                                    </form>

                                @endif



                                {{-- VIEW --}}

                                <a
                                    href="{{ route('admin.properties.show', $property) }}"
                                    title="View Property"
                                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-blue-500/20 bg-blue-500/10 text-blue-400 transition hover:bg-blue-500/20">

                                    <i class="fa-solid fa-eye text-sm"></i>

                                </a>



                                {{-- EDIT --}}

                                <a
                                    href="{{ route('admin.properties.edit', $property) }}"
                                    title="Edit Property"
                                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-amber-500/20 bg-amber-500/10 text-amber-400 transition hover:bg-amber-500/20">

                                    <i class="fa-solid fa-pen-to-square text-sm"></i>

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
                                        title="Delete Property"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-red-500/20 bg-red-500/10 text-red-400 transition hover:bg-red-500/20">

                                        <i class="fa-solid fa-trash text-sm"></i>

                                    </button>

                                </form>

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
                            class="px-6 py-16 text-center">

                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-500/10 text-orange-400">

                                <i class="fa-solid fa-building text-2xl"></i>

                            </div>


                            <h3
                                class="mt-4 text-lg font-semibold text-white">

                                No Properties Found

                            </h3>


                            <p
                                class="mt-1 text-sm text-gray-500">

                                No properties match your current filters.

                            </p>


                            <a
                                href="{{ route('admin.properties.create') }}"
                                class="mt-5 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:from-orange-600 hover:to-amber-600">

                                <i class="fa-solid fa-plus"></i>

                                Add Property

                            </a>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>



    {{-- =========================================================
         PAGINATION
    ========================================================== --}}

    @if($properties->hasPages())

        <div
            class="border-t border-purple-500/20 px-5 py-4 sm:px-6">

            {{ $properties->withQueryString()->links() }}

        </div>

    @endif

</div>


</div>

@endsection