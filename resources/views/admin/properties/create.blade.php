@extends('admin.layouts.app')

@section('title', 'Add Property')
@section('page-title', 'Add Property')

@section('content')

<div class="mx-auto max-w-6xl space-y-6">

`
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
        Add Property
    </h2>

    <p class="mt-1 text-sm text-gray-400">
        Add a new property to your real estate listings.
    </p>

</div>


{{-- VALIDATION ERRORS --}}
@if ($errors->any())

    <div class="rounded-2xl border border-red-500/30 bg-red-500/10 p-5">

        <div class="flex items-start gap-3">

            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-400">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>

            <div class="flex-1">

                <h3 class="text-sm font-semibold text-red-300">
                    Please fix the following errors
                </h3>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-400">

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


{{-- SUCCESS MESSAGE --}}
@if (session('success'))

    <div class="rounded-2xl border border-emerald-500/30 bg-emerald-500/10 p-5">

        <div class="flex items-center gap-3">

            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <p class="text-sm font-medium text-emerald-300">
                {{ session('success') }}
            </p>

        </div>

    </div>

@endif


{{-- =========================================================
     FORM
========================================================== --}}

<form
    action="{{ route('admin.properties.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6">

    @csrf


    {{-- =========================================================
         BASIC INFORMATION
    ========================================================== --}}

    <div
        class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

        {{-- HEADER --}}

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
                        Enter the main property details.
                    </p>

                </div>

            </div>

        </div>


        {{-- CONTENT --}}

        <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">


            {{-- PROPERTY TITLE --}}

            <div class="sm:col-span-2">

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
                    value="{{ old('title') }}"
                    placeholder="e.g. Luxury 3 BHK Apartment"
                    required
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

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
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    <option value="">
                        Select Property Type
                    </option>

                    @foreach($propertyTypes as $type)

                        <option
                            value="{{ $type->id }}"
                            @selected(old('property_type_id') == $type->id)>

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
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    <option value="">
                        Select Location
                    </option>

                    @foreach($locations as $location)

                        <option
                            value="{{ $location->id }}"
                            @selected(old('location_id') == $location->id)>

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
                        value="{{ old('price') }}"
                        min="0"
                        step="0.01"
                        placeholder="5000000"
                        required
                        class="w-full rounded-xl border border-purple-500/20 bg-slate-950 py-3 pl-9 pr-4 text-sm text-white placeholder-gray-600 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                </div>

                @error('price')

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
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    <option value="">
                        No Agent Assigned
                    </option>

                    @foreach($agents as $agent)

                        <option
                            value="{{ $agent->id }}"
                            @selected(old('agent_id') == $agent->id)>

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
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    <option value="">
                        Select Purpose
                    </option>

                    <option
                        value="sale"
                        @selected(old('purpose') === 'sale')>

                        For Sale

                    </option>

                    <option
                        value="rent"
                        @selected(old('purpose') === 'rent')>

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

            <div class="sm:col-span-2">

                <label
                    for="description"
                    class="mb-2 block text-sm font-medium text-gray-300">

                    Description

                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    placeholder="Describe the property..."
                    class="w-full resize-none rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">{{ old('description') }}</textarea>

                @error('description')

                    <p class="mt-1.5 text-xs text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>

    </div>


    {{-- =========================================================
         PROPERTY DETAILS
    ========================================================== --}}

    <div
        class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

        {{-- HEADER --}}

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
                        Add size and room information.
                    </p>

                </div>

            </div>

        </div>


        {{-- CONTENT --}}

        <div class="grid gap-5 p-5 sm:grid-cols-3 sm:p-6">


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
                    value="{{ old('bedrooms') }}"
                    min="0"
                    placeholder="3"
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20">

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
                    value="{{ old('bathrooms') }}"
                    min="0"
                    placeholder="2"
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20">

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
                    value="{{ old('area') }}"
                    min="0"
                    step="0.01"
                    placeholder="1500"
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20">

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
                    value="{{ old('garages') }}"
                    min="0"
                    placeholder="1"
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20">

                @error('garages')

                    <p class="mt-1.5 text-xs text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- ADDRESS --}}

            <div class="sm:col-span-3">

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
                    class="w-full resize-none rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20">{{ old('address') }}</textarea>

                @error('address')

                    <p class="mt-1.5 text-xs text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>

    </div>


    {{-- =========================================================
         PROPERTY PHOTOS
    ========================================================== --}}

    <div
        class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

        {{-- HEADER --}}

        <div class="border-b border-purple-500/20 px-5 py-5 sm:px-6">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-pink-500/10 text-pink-400">

                    <i class="fa-solid fa-images"></i>

                </div>

                <div>

                    <h3 class="font-semibold text-white">
                        Property Photos
                    </h3>

                    <p class="text-xs text-gray-500">
                        Upload multiple images of the property.
                    </p>

                </div>

            </div>

        </div>


        {{-- CONTENT --}}

        <div class="p-5 sm:p-6">

            <label
                for="photos"
                class="mb-2 block text-sm font-medium text-gray-300">

                Property Images

            </label>


            {{-- FILE INPUT --}}

            <input
                type="file"
                id="photos"
                name="photos[]"
                multiple
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                class="block w-full cursor-pointer rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-gray-300 outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-purple-500/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-purple-400 hover:file:bg-purple-500/20 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">


            <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1">

                <p class="text-xs text-gray-500">
                    JPG, JPEG, PNG or WEBP
                </p>

                <p class="text-xs text-gray-500">
                    Maximum 5MB per image
                </p>

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


            {{-- IMAGE PREVIEW --}}

            <div
                id="imagePreview"
                class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
            </div>

        </div>

    </div>


    {{-- =========================================================
         LISTING SETTINGS
    ========================================================== --}}

    <div
        class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

        {{-- HEADER --}}

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
                        Set market status, featured status and website visibility.
                    </p>

                </div>

            </div>

        </div>


        {{-- CONTENT --}}

        <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">


            {{-- STATUS --}}

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
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20">

                    <option
                        value="available"
                        @selected(old('status', 'available') === 'available')>

                        Available

                    </option>

                    <option
                        value="sold"
                        @selected(old('status') === 'sold')>

                        Sold

                    </option>

                    <option
                        value="rented"
                        @selected(old('status') === 'rented')>

                        Rented

                    </option>

                    <option
                        value="pending"
                        @selected(old('status') === 'pending')>

                        Pending

                    </option>

                </select>

                <p class="mt-1.5 text-xs text-gray-600">
                    This is the market/listing status of the property.
                </p>

                @error('status')

                    <p class="mt-1.5 text-xs text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- FEATURED --}}

            <div class="flex items-end">

                <div
                    class="w-full rounded-xl border border-purple-500/10 bg-slate-950/50 p-4">

                    <input
                        type="hidden"
                        name="is_featured"
                        value="0">

                    <label
                        class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="is_featured"
                            value="1"
                            @checked(old('is_featured'))
                            class="h-4 w-4 rounded border-gray-600 bg-slate-800 text-orange-500 focus:ring-orange-500">

                        <div>

                            <span class="block text-sm font-medium text-white">
                                Featured Property
                            </span>

                            <span class="block text-xs text-gray-500">
                                Highlight this property on the website.
                            </span>

                        </div>

                    </label>

                </div>

            </div>


            {{-- ACTIVE --}}

            <div class="sm:col-span-2">

                <div
                    class="rounded-xl border border-emerald-500/10 bg-emerald-500/5 p-4">

                    <input
                        type="hidden"
                        name="is_active"
                        value="0">

                    <label
                        class="flex cursor-pointer items-start gap-3">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', true))
                            class="mt-0.5 h-4 w-4 rounded border-gray-600 bg-slate-800 text-emerald-500 focus:ring-emerald-500">

                        <div>

                            <span class="block text-sm font-medium text-white">
                                Active Listing
                            </span>

                            <span class="block text-xs text-gray-500">
                                Allow this property to appear as an active listing on the website.
                            </span>

                        </div>

                    </label>

                </div>

            </div>


            {{-- ADMIN APPROVAL INFORMATION --}}

            <div class="sm:col-span-2">

                <div
                    class="rounded-xl border border-emerald-500/20 bg-emerald-500/5 p-4">

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                            <i class="fa-solid fa-circle-check"></i>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-emerald-300">
                                Admin-created property
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                Properties created directly by Super Admin are automatically marked as
                                <span class="font-medium text-emerald-400">Approved</span>.
                                Website visibility still depends on the property being active and available.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         BUTTONS
    ========================================================== --}}

    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

        {{-- CANCEL --}}

        <a
            href="{{ route('admin.properties.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-700 bg-slate-800 px-6 py-3 text-sm font-semibold text-gray-300 transition hover:bg-slate-700 hover:text-white">

            <i class="fa-solid fa-xmark"></i>

            Cancel

        </a>


        {{-- SAVE --}}

        <button
            type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-900/30 transition hover:from-orange-600 hover:to-amber-600">

            <i class="fa-solid fa-floppy-disk"></i>

            Save Property

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

        files.forEach(function (file) {

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                const wrapper = document.createElement('div');

                wrapper.className =
                    'relative overflow-hidden rounded-xl border border-purple-500/20 bg-slate-950';

                wrapper.innerHTML = `
                    <img
                        src="${event.target.result}"
                        class="h-40 w-full object-cover"
                        alt="Property Preview">

                    <div class="absolute bottom-0 left-0 right-0 bg-black/60 px-3 py-2">

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
