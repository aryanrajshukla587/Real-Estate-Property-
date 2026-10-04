@extends('admin.layouts.app')

@section('title', 'Edit Property')
@section('page-title', 'Edit Property')

@section('content')

<div class="mx-auto max-w-6xl space-y-6">

    {{-- BACK --}}
    <a
        href="{{ route('admin.properties.index') }}"
        class="inline-flex items-center gap-2 text-sm text-gray-400 transition hover:text-white">

        <i class="fa-solid fa-arrow-left"></i>

        Back to Properties

    </a>


    {{-- HEADER --}}
    <div>

        <h2 class="text-2xl font-bold text-white">
            Edit Property
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            Update property information, images, availability and listing settings.
        </p>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="flex items-center gap-3 rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-5 py-4 text-emerald-400">

            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-500/10">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <span class="text-sm">
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ERROR MESSAGE --}}
    @if(session('error'))

        <div class="flex items-center gap-3 rounded-2xl border border-red-500/20 bg-red-500/10 px-5 py-4 text-red-400">

            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-500/10">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>

            <span class="text-sm">
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div class="rounded-2xl border border-red-500/30 bg-red-500/10 p-5">

            <div class="flex items-start gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-400">

                    <i class="fa-solid fa-circle-exclamation"></i>

                </div>

                <div>

                    <h3 class="text-sm font-semibold text-red-300">
                        Please fix the following errors
                    </h3>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-400">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
         OWNER DETAILS
    ========================================================== --}}
    @if($property->owner)

        <div class="overflow-hidden rounded-2xl border border-orange-500/20 bg-slate-900/70 shadow-xl">

            {{-- HEADER --}}
            <div class="border-b border-orange-500/20 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                        <i class="fa-solid fa-user"></i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-white">
                            Property Owner
                        </h3>

                        <p class="text-xs text-gray-500">
                            Owner details associated with this property.
                        </p>

                    </div>

                </div>

            </div>


            {{-- OWNER CONTENT --}}
            <div class="p-5 sm:p-6">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    {{-- OWNER PROFILE --}}
                    <div class="flex items-center gap-4">

                        {{-- AVATAR --}}
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-orange-500/10 text-lg font-bold text-orange-400">

                            {{ strtoupper(substr($property->owner->name ?? 'O', 0, 1)) }}

                        </div>


                        {{-- NAME --}}
                        <div class="min-w-0">

                            <h4 class="truncate text-base font-semibold text-white">

                                {{ $property->owner->name ?? 'Owner' }}

                            </h4>

                            <p class="mt-1 text-xs text-gray-500">

                                Property Owner

                            </p>

                        </div>

                    </div>


                    {{-- OWNER ID --}}
                    <div class="rounded-xl border border-purple-500/10 bg-slate-950/50 px-4 py-3">

                        <p class="text-[10px] uppercase tracking-wider text-gray-600">
                            Owner ID
                        </p>

                        <p class="mt-1 text-sm font-semibold text-gray-300">
                            #{{ $property->owner->id }}
                        </p>

                    </div>

                </div>


                {{-- OWNER INFORMATION --}}
                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">


                    {{-- NAME --}}
                    <div
                        class="rounded-xl border border-purple-500/10 bg-slate-950/50 p-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400">

                                <i class="fa-solid fa-user text-sm"></i>

                            </div>

                            <div class="min-w-0">

                                <p class="text-[11px] uppercase tracking-wide text-gray-600">
                                    Full Name
                                </p>

                                <p class="mt-1 truncate text-sm font-medium text-gray-200">

                                    {{ $property->owner->name ?? 'N/A' }}

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div
                        class="rounded-xl border border-purple-500/10 bg-slate-950/50 p-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400">

                                <i class="fa-solid fa-envelope text-sm"></i>

                            </div>

                            <div class="min-w-0">

                                <p class="text-[11px] uppercase tracking-wide text-gray-600">
                                    Email Address
                                </p>

                                <p class="mt-1 truncate text-sm font-medium text-gray-200">

                                    {{ $property->owner->email ?? 'N/A' }}

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- PHONE --}}
                    @if(!empty($property->owner->phone))

                        <div
                            class="rounded-xl border border-purple-500/10 bg-slate-950/50 p-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-purple-500/10 text-purple-400">

                                    <i class="fa-solid fa-phone text-sm"></i>

                                </div>

                                <div class="min-w-0">

                                    <p class="text-[11px] uppercase tracking-wide text-gray-600">
                                        Phone Number
                                    </p>

                                    <p class="mt-1 truncate text-sm font-medium text-gray-200">

                                        {{ $property->owner->phone }}

                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif


                </div>

            </div>

        </div>

    @endif


    {{-- FORM --}}
    <form
        action="{{ route('admin.properties.update', $property) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf
        @method('PUT')


        {{-- =========================================================
             BASIC INFORMATION
        ========================================================== --}}

        <div class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

            <div class="border-b border-purple-500/20 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                        <i class="fa-solid fa-building"></i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-white">
                            Basic Information
                        </h3>

                        <p class="text-xs text-gray-500">
                            Update basic property details.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-5 p-5 sm:grid-cols-2 lg:grid-cols-3 sm:p-6">


                {{-- TITLE --}}
                <div class="sm:col-span-2 lg:col-span-3">

                    <label
                        for="title"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Property Title

                        <span class="text-red-400">*</span>

                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $property->title) }}"
                        required
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    @error('title')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- PROPERTY TYPE --}}
                <div>

                    <label
                        for="property_type_id"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Property Type

                        <span class="text-red-400">*</span>

                    </label>

                    <select
                        id="property_type_id"
                        name="property_type_id"
                        required
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-gray-300 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                        <option value="">
                            Select Property Type
                        </option>

                        @foreach($propertyTypes as $type)

                            <option
                                value="{{ $type->id }}"
                                @selected(old('property_type_id', $property->property_type_id) == $type->id)>

                                {{ $type->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('property_type_id')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- LOCATION --}}
                <div>

                    <label
                        for="location_id"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Location

                        <span class="text-red-400">*</span>

                    </label>

                    <select
                        id="location_id"
                        name="location_id"
                        required
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-gray-300 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                        <option value="">
                            Select Location
                        </option>

                        @foreach($locations as $location)

                            <option
                                value="{{ $location->id }}"
                                @selected(old('location_id', $property->location_id) == $location->id)>

                                {{ $location->city }}

                                @if($location->state)

                                    - {{ $location->state }}

                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('location_id')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- AGENT --}}
                <div>

                    <label
                        for="agent_id"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Agent

                    </label>

                    <select
                        id="agent_id"
                        name="agent_id"
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-gray-300 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                        <option value="">
                            No Agent Assigned
                        </option>

                        @foreach($agents as $agent)

                            <option
                                value="{{ $agent->id }}"
                                @selected(old('agent_id', $property->agent_id) == $agent->id)>

                                {{ $agent->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('agent_id')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- PURPOSE --}}
                <div>

                    <label
                        for="purpose"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Purpose

                        <span class="text-red-400">*</span>

                    </label>

                    <select
                        id="purpose"
                        name="purpose"
                        required
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-gray-300 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                        <option value="">
                            Select Purpose
                        </option>

                        <option
                            value="sale"
                            @selected(old('purpose', $property->purpose) === 'sale')>

                            For Sale

                        </option>

                        <option
                            value="rent"
                            @selected(old('purpose', $property->purpose) === 'rent')>

                            For Rent

                        </option>

                    </select>

                    @error('purpose')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- DESCRIPTION --}}
                <div class="sm:col-span-2 lg:col-span-3">

                    <label
                        for="description"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Description

                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Describe the property..."
                        class="w-full resize-none rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">{{ old('description', $property->description) }}</textarea>

                    @error('description')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>



        {{-- =========================================================
             PROPERTY IMAGES
        ========================================================== --}}

        <div class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

            <div class="border-b border-purple-500/20 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-pink-500/10 text-pink-400">

                        <i class="fa-solid fa-images"></i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-white">
                            Property Images
                        </h3>

                        <p class="text-xs text-gray-500">
                            Manage existing images or add new images.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">


                {{-- EXISTING IMAGES --}}
                @if(!empty($property->photos) && is_array($property->photos))

                    <div class="mb-6">

                        <div class="mb-4 flex items-center justify-between">

                            <h4 class="text-sm font-semibold text-white">
                                Existing Images
                            </h4>

                            <span
                                class="rounded-full bg-purple-500/10 px-3 py-1 text-xs text-purple-300">

                                {{ count($property->photos) }}

                                {{ count($property->photos) == 1 ? 'Image' : 'Images' }}

                            </span>

                        </div>


                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                            @foreach($property->photos as $index => $photo)

                                <div
                                    class="group relative overflow-hidden rounded-xl border border-purple-500/20 bg-slate-950">

                                    {{-- IMAGE --}}
                                    <img
                                        src="{{ asset('storage/' . $photo) }}"
                                        alt="Property Image"
                                        class="h-40 w-full object-cover transition duration-300 group-hover:scale-105">


                                    {{-- IMAGE NAME + DELETE --}}
                                    <div
                                        class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/90 to-transparent p-3">

                                        <p class="mb-2 truncate text-xs text-gray-300">
                                            {{ basename($photo) }}
                                        </p>


                                        <label
                                            class="flex cursor-pointer items-center gap-2">

                                            <input
                                                type="checkbox"
                                                name="delete_photos[]"
                                                value="{{ $photo }}"
                                                class="h-4 w-4 rounded border-gray-600 bg-slate-800 text-red-500 focus:ring-red-500">

                                            <span class="text-xs font-medium text-red-300">
                                                Delete Image
                                            </span>

                                        </label>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @else

                    <div
                        class="mb-6 rounded-xl border border-dashed border-gray-700 bg-slate-950/40 p-8 text-center">

                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gray-800 text-gray-500">

                            <i class="fa-solid fa-image text-xl"></i>

                        </div>

                        <p class="mt-3 text-sm text-gray-400">
                            No images uploaded for this property.
                        </p>

                    </div>

                @endif


                {{-- UPLOAD NEW IMAGES --}}
                <div>

                    <label
                        for="photos"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Add New Images

                    </label>


                    <div
                        class="rounded-2xl border-2 border-dashed border-purple-500/30 bg-slate-950/50 p-6 transition hover:border-orange-500/50">

                        <div class="text-center">

                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500/10 text-orange-400">

                                <i class="fa-solid fa-cloud-arrow-up text-xl"></i>

                            </div>

                            <p class="mt-4 text-sm font-medium text-white">
                                Select property images
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                JPG, JPEG, PNG or WEBP · Maximum 5MB per image
                            </p>


                            <input
                                type="file"
                                id="photos"
                                name="photos[]"
                                multiple
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="mt-5 block w-full cursor-pointer rounded-xl border border-purple-500/20 bg-slate-900 px-4 py-3 text-sm text-gray-400 file:mr-4 file:rounded-lg file:border-0 file:bg-orange-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-orange-600">

                        </div>

                    </div>


                    @error('photos')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                    @error('photos.*')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- NEW IMAGE PREVIEW --}}
                <div
                    id="imagePreview"
                    class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                </div>


            </div>

        </div>



        {{-- =========================================================
             PROPERTY DETAILS
        ========================================================== --}}

        <div class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

            <div class="border-b border-purple-500/20 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                        <i class="fa-solid fa-house"></i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-white">
                            Property Details
                        </h3>

                        <p class="text-xs text-gray-500">
                            Update pricing, rooms, area and garage information.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-5 p-5 sm:grid-cols-2 lg:grid-cols-5 sm:p-6">


                {{-- PRICE --}}
                <div>

                    <label
                        for="price"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Price

                        <span class="text-red-400">*</span>

                    </label>

                    <div class="relative">

                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">

                            ₹

                        </span>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price', $property->price) }}"
                            step="0.01"
                            min="0"
                            required
                            class="w-full rounded-xl border border-purple-500/20 bg-slate-950 py-3 pl-9 pr-4 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    </div>

                    @error('price')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- BEDROOMS --}}
                <div>

                    <label
                        for="bedrooms"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Bedrooms

                    </label>

                    <input
                        type="number"
                        id="bedrooms"
                        name="bedrooms"
                        value="{{ old('bedrooms', $property->bedrooms) }}"
                        min="0"
                        placeholder="3"
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    @error('bedrooms')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- BATHROOMS --}}
                <div>

                    <label
                        for="bathrooms"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Bathrooms

                    </label>

                    <input
                        type="number"
                        id="bathrooms"
                        name="bathrooms"
                        value="{{ old('bathrooms', $property->bathrooms) }}"
                        min="0"
                        placeholder="2"
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    @error('bathrooms')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- AREA --}}
                <div>

                    <label
                        for="area"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Area (sq. ft.)

                    </label>

                    <input
                        type="number"
                        id="area"
                        name="area"
                        value="{{ old('area', $property->area) }}"
                        step="0.01"
                        min="0"
                        placeholder="1500"
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    @error('area')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- GARAGES --}}
                <div>

                    <label
                        for="garages"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Garages

                    </label>

                    <input
                        type="number"
                        id="garages"
                        name="garages"
                        value="{{ old('garages', $property->garages) }}"
                        min="0"
                        placeholder="1"
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    @error('garages')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- ADDRESS --}}
                <div class="sm:col-span-2 lg:col-span-5">

                    <label
                        for="address"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Property Address

                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Enter complete property address..."
                        class="w-full resize-none rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">{{ old('address', $property->address) }}</textarea>

                    @error('address')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>



        {{-- =========================================================
             LISTING SETTINGS
        ========================================================== --}}

        <div class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

            <div class="border-b border-purple-500/20 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                        <i class="fa-solid fa-sliders"></i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-white">
                            Listing Settings
                        </h3>

                        <p class="text-xs text-gray-500">
                            Manage availability, approval and website visibility.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">


                {{-- MARKET STATUS --}}
                <div>

                    <label
                        for="status"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Property Status

                        <span class="text-red-400">*</span>

                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-gray-300 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                        <option
                            value="available"
                            @selected(old('status', $property->status) === 'available')>

                            Available

                        </option>

                        <option
                            value="pending"
                            @selected(old('status', $property->status) === 'pending')>

                            Pending

                        </option>

                        <option
                            value="sold"
                            @selected(old('status', $property->status) === 'sold')>

                            Sold

                        </option>

                        <option
                            value="rented"
                            @selected(old('status', $property->status) === 'rented')>

                            Rented

                        </option>

                    </select>

                    <p class="mt-1.5 text-xs text-gray-600">
                        This controls the market availability of the property.
                    </p>

                    @error('status')

                        <p class="mt-1.5 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                {{-- APPROVAL STATUS --}}
                <div
                    class="rounded-xl border border-purple-500/10 bg-slate-950/50 p-4">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <span class="block text-sm font-medium text-white">
                                Approval Status
                            </span>

                            <span class="mt-1 block text-xs text-gray-500">
                                Controlled by Super Admin.
                            </span>

                        </div>


                        @if($property->approval_status === 'approved')

                            <span
                                class="inline-flex shrink-0 items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                                <i class="fa-solid fa-circle-check"></i>

                                Approved

                            </span>

                        @elseif($property->approval_status === 'rejected')

                            <span
                                class="inline-flex shrink-0 items-center gap-1.5 rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                                <i class="fa-solid fa-circle-xmark"></i>

                                Rejected

                            </span>

                        @else

                            <span
                                class="inline-flex shrink-0 items-center gap-1.5 rounded-full border border-amber-500/20 bg-amber-500/10 px-3 py-1 text-xs font-medium text-amber-400">

                                <i class="fa-solid fa-clock"></i>

                                Pending Review

                            </span>

                        @endif

                    </div>


                    <div class="mt-4 rounded-lg border border-purple-500/10 bg-slate-900/50 p-3">

                        @if($property->approval_status === 'approved')

                            <p class="text-xs leading-5 text-emerald-400/80">

                                <i class="fa-solid fa-circle-check mr-1"></i>

                                This property has been approved by Super Admin.

                            </p>

                        @elseif($property->approval_status === 'rejected')

                            <p class="text-xs leading-5 text-red-400/80">

                                <i class="fa-solid fa-circle-xmark mr-1"></i>

                                This property has been rejected and is not publicly visible.

                            </p>

                        @else

                            <p class="text-xs leading-5 text-amber-400/80">

                                <i class="fa-solid fa-clock mr-1"></i>

                                This property is waiting for Super Admin approval and is not publicly visible.

                            </p>

                        @endif

                    </div>

                </div>



                {{-- ACTIVE / WEBSITE VISIBILITY --}}
                <div
                    class="rounded-xl border border-purple-500/10 bg-slate-950/50 p-4">

                    <input
                        type="hidden"
                        name="is_active"
                        value="0">

                    <label class="flex cursor-pointer items-start gap-3">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', $property->is_active))
                            class="mt-0.5 h-4 w-4 rounded border-gray-600 bg-slate-800 text-emerald-500 focus:ring-emerald-500">

                        <div>

                            <span class="block text-sm font-medium text-white">
                                Active Property
                            </span>

                            <span class="mt-1 block text-xs leading-5 text-gray-500">
                                Controls whether the approved property can be shown on the website.
                            </span>

                        </div>

                    </label>

                    @if($property->approval_status !== 'approved')

                        <div class="mt-3 flex items-start gap-2 rounded-lg border border-amber-500/10 bg-amber-500/5 p-3">

                            <i class="fa-solid fa-circle-info mt-0.5 text-xs text-amber-400"></i>

                            <p class="text-[11px] leading-5 text-gray-500">

                                The property will remain hidden from the public website until it is approved.

                            </p>

                        </div>

                    @endif

                </div>



                {{-- FEATURED --}}
                <div
                    class="rounded-xl border border-purple-500/10 bg-slate-950/50 p-4">

                    <input
                        type="hidden"
                        name="is_featured"
                        value="0">

                    <label class="flex cursor-pointer items-start gap-3">

                        <input
                            type="checkbox"
                            name="is_featured"
                            value="1"
                            @checked(old('is_featured', $property->is_featured))
                            class="mt-0.5 h-4 w-4 rounded border-gray-600 bg-slate-800 text-amber-500 focus:ring-amber-500">

                        <div>

                            <span class="block text-sm font-medium text-white">
                                Featured Property
                            </span>

                            <span class="mt-1 block text-xs leading-5 text-gray-500">
                                Show this property as a featured listing.
                            </span>

                        </div>

                    </label>

                </div>


            </div>


            {{-- VISIBILITY SUMMARY --}}
            <div class="border-t border-purple-500/20 bg-slate-950/30 px-5 py-5 sm:px-6">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                        <i class="fa-solid fa-eye"></i>

                    </div>

                    <div>

                        <h4 class="text-sm font-semibold text-white">
                            Website Visibility
                        </h4>

                        <p class="mt-1 text-xs leading-5 text-gray-500">

                            A property is publicly visible only when it is

                            <span class="font-medium text-emerald-400">
                                Approved
                            </span>,

                            <span class="font-medium text-emerald-400">
                                Active
                            </span>

                            and

                            <span class="font-medium text-emerald-400">
                                Available
                            </span>.

                        </p>

                    </div>

                </div>

            </div>

        </div>



        {{-- =========================================================
             BUTTONS
        ========================================================== --}}

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('admin.properties.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-700 bg-slate-800 px-6 py-3 text-sm font-semibold text-gray-300 transition hover:bg-slate-700 hover:text-white">

                <i class="fa-solid fa-xmark"></i>

                Cancel

            </a>


            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-900/30 transition hover:from-orange-600 hover:to-amber-600">

                <i class="fa-solid fa-floppy-disk"></i>

                Update Property

            </button>

        </div>


    </form>


</div>


{{-- =========================================================
     IMAGE PREVIEW SCRIPT
========================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('photos');
    const preview = document.getElementById('imagePreview');

    if (!input || !preview) {
        return;
    }

    input.addEventListener('change', function () {

        preview.innerHTML = '';

        const files = Array.from(this.files);

        if (!files.length) {
            return;
        }

        files.forEach(function (file) {

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                const wrapper = document.createElement('div');

                wrapper.className =
                    'relative overflow-hidden rounded-xl border border-orange-500/20 bg-slate-950';

                wrapper.innerHTML = `

                    <img
                        src="${event.target.result}"
                        class="h-40 w-full object-cover"
                        alt="New Property Image">

                    <div class="absolute bottom-0 left-0 right-0 bg-black/70 px-3 py-2">

                        <p class="truncate text-xs text-gray-300">
                            ${file.name}
                        </p>

                    </div>

                `;

                preview.appendChild(wrapper);

            };

            reader.readAsDataURL(file);

        });

    });

});

</script>

@endsection