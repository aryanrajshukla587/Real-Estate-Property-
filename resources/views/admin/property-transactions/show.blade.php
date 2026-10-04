@extends('admin.layouts.app')

@section('title', 'Property Request Details')
@section('page-title', 'Request Details')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>

            <div class="mb-2">

                <a
                    href="{{ route('admin.property-transactions.index') }}"
                    class="inline-flex items-center gap-2 text-sm text-gray-400 transition hover:text-white"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Back to Property Requests

                </a>

            </div>

            <h1 class="text-2xl font-bold text-white">
                Property Request #{{ $transaction->id }}
            </h1>

            <p class="mt-1 text-sm text-gray-400">
                Review applicant information and manage this property request.
            </p>

        </div>


        {{-- CURRENT STATUS --}}

        <div>

            @if($transaction->status === 'pending')

                <span class="inline-flex items-center gap-2 rounded-full bg-yellow-500/10 px-4 py-2 text-sm font-semibold text-yellow-400">

                    <span class="h-2 w-2 rounded-full bg-yellow-400"></span>

                    Pending

                </span>


            @elseif($transaction->status === 'approved')

                <span class="inline-flex items-center gap-2 rounded-full bg-blue-500/10 px-4 py-2 text-sm font-semibold text-blue-400">

                    <span class="h-2 w-2 rounded-full bg-blue-400"></span>

                    Approved

                </span>


            @elseif($transaction->status === 'completed')

                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-4 py-2 text-sm font-semibold text-emerald-400">

                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>

                    Completed

                </span>


            @elseif($transaction->status === 'rejected')

                <span class="inline-flex items-center gap-2 rounded-full bg-red-500/10 px-4 py-2 text-sm font-semibold text-red-400">

                    <span class="h-2 w-2 rounded-full bg-red-400"></span>

                    Rejected

                </span>


            @elseif($transaction->status === 'cancelled')

                <span class="inline-flex items-center gap-2 rounded-full bg-gray-500/10 px-4 py-2 text-sm font-semibold text-gray-300">

                    <span class="h-2 w-2 rounded-full bg-gray-400"></span>

                    Cancelled

                </span>


            @else

                <span class="inline-flex items-center gap-2 rounded-full bg-gray-500/10 px-4 py-2 text-sm font-semibold text-gray-400">

                    <span class="h-2 w-2 rounded-full bg-gray-400"></span>

                    {{ ucfirst($transaction->status) }}

                </span>

            @endif

        </div>

    </div>



    {{-- =====================================================
         TOP GRID
    ====================================================== --}}

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- =================================================
             PROPERTY CARD
        ================================================== --}}

        <div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-900/70 shadow-xl lg:col-span-2">

            @php

                $photos = is_array($transaction->property?->photos)
                    ? $transaction->property->photos
                    : [];

                $mainPhoto = $photos[0] ?? null;

            @endphp


            {{-- PROPERTY IMAGE --}}

            @if($mainPhoto)

                <div class="h-64 w-full overflow-hidden bg-gray-950">

                    <img
                        src="{{ asset('storage/' . $mainPhoto) }}"
                        alt="{{ $transaction->property?->title }}"
                        class="h-full w-full object-cover"
                    >

                </div>

            @else

                <div class="flex h-64 w-full items-center justify-center bg-gray-950">

                    <div class="text-center text-gray-600">

                        <i class="fa-solid fa-house text-5xl"></i>

                        <p class="mt-3 text-sm">
                            No property image
                        </p>

                    </div>

                </div>

            @endif


            {{-- PROPERTY INFO --}}

            <div class="p-6">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Property
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-white">
                            {{ $transaction->property?->title ?? 'Property Deleted' }}
                        </h2>

                        @if($transaction->property?->address)

                            <p class="mt-2 flex items-center gap-2 text-sm text-gray-400">

                                <i class="fa-solid fa-location-dot text-purple-400"></i>

                                {{ $transaction->property->address }}

                            </p>

                        @endif

                    </div>


                    {{-- TYPE --}}

                    @if($transaction->type === 'buy')

                        <span class="inline-flex w-fit items-center gap-2 rounded-full bg-orange-500/10 px-4 py-2 text-sm font-semibold text-orange-400">

                            <i class="fa-solid fa-house"></i>

                            Buy Request

                        </span>

                    @else

                        <span class="inline-flex w-fit items-center gap-2 rounded-full bg-cyan-500/10 px-4 py-2 text-sm font-semibold text-cyan-400">

                            <i class="fa-solid fa-key"></i>

                            Rent Request

                        </span>

                    @endif

                </div>


                {{-- PROPERTY DETAILS --}}

                @if($transaction->property)

                    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4">


                        {{-- PRICE --}}

                        <div class="rounded-xl border border-gray-800 bg-gray-950/70 p-4">

                            <p class="text-xs text-gray-500">
                                Listed Price
                            </p>

                            <p class="mt-1 text-sm font-bold text-white">

                                ₹{{ number_format((float) $transaction->property->price, 2) }}

                            </p>

                        </div>


                        {{-- AREA --}}

                        <div class="rounded-xl border border-gray-800 bg-gray-950/70 p-4">

                            <p class="text-xs text-gray-500">
                                Area
                            </p>

                            <p class="mt-1 text-sm font-bold text-white">
                                {{ $transaction->property->area ?? '—' }}
                            </p>

                        </div>


                        {{-- BEDROOMS --}}

                        <div class="rounded-xl border border-gray-800 bg-gray-950/70 p-4">

                            <p class="text-xs text-gray-500">
                                Bedrooms
                            </p>

                            <p class="mt-1 text-sm font-bold text-white">
                                {{ $transaction->property->bedrooms ?? '—' }}
                            </p>

                        </div>


                        {{-- BATHROOMS --}}

                        <div class="rounded-xl border border-gray-800 bg-gray-950/70 p-4">

                            <p class="text-xs text-gray-500">
                                Bathrooms
                            </p>

                            <p class="mt-1 text-sm font-bold text-white">
                                {{ $transaction->property->bathrooms ?? '—' }}
                            </p>

                        </div>

                    </div>

                @endif


                {{-- VIEW PROPERTY --}}

                @if($transaction->property)

                    <div class="mt-6">

                        <a
                            href="{{ route('property.details', $transaction->property->slug) }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 rounded-xl border border-purple-500/30 bg-purple-500/10 px-4 py-2.5 text-sm font-semibold text-purple-400 transition hover:bg-purple-500/20 hover:text-purple-300"
                        >

                            <i class="fa-solid fa-arrow-up-right-from-square"></i>

                            View Property

                        </a>

                    </div>

                @endif

            </div>


            {{-- =================================================
                 PROPERTY OWNER
            ================================================== --}}

            @if($transaction->property?->owner)

                <div class="border-t border-gray-800 bg-gray-950/30 p-6">

                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        {{-- OWNER HEADER --}}

                        <div class="flex items-center gap-4">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                                <i class="fa-solid fa-user text-lg"></i>

                            </div>

                            <div>

                                <h3 class="font-semibold text-white">
                                    Property Owner
                                </h3>

                                <p class="mt-1 text-xs text-gray-500">
                                    Owner who listed this property.
                                </p>

                            </div>

                        </div>


                        {{-- OWNER BADGE --}}

                        <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-xs font-semibold text-emerald-400">

                            <i class="fa-solid fa-circle-check"></i>

                            Registered Owner

                        </span>

                    </div>


                    {{-- OWNER INFORMATION --}}

                    <div class="mt-5 rounded-xl border border-gray-800 bg-gray-900/60 p-5">

                        <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                            {{-- AVATAR --}}

                            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-purple-500/20 to-fuchsia-500/20 text-xl font-bold text-purple-400 ring-1 ring-purple-500/20">

                                {{ strtoupper(substr($transaction->property->owner->name ?? 'O', 0, 1)) }}

                            </div>


                            {{-- DETAILS --}}

                            <div class="grid flex-1 grid-cols-1 gap-4 sm:grid-cols-3">

                                {{-- NAME --}}

                                <div>

                                    <p class="text-xs uppercase tracking-wider text-gray-600">
                                        Full Name
                                    </p>

                                    <p class="mt-1 font-semibold text-white">
                                        {{ $transaction->property->owner->name }}
                                    </p>

                                </div>


                                {{-- EMAIL --}}

                                <div>

                                    <p class="text-xs uppercase tracking-wider text-gray-600">
                                        Email
                                    </p>

                                    @if($transaction->property->owner->email)

                                        <p class="mt-1 break-all text-sm text-gray-300">
                                            {{ $transaction->property->owner->email }}
                                        </p>

                                    @else

                                        <p class="mt-1 text-sm text-gray-600">
                                            Not provided
                                        </p>

                                    @endif

                                </div>


                                {{-- PHONE --}}

                                <div>

                                    <p class="text-xs uppercase tracking-wider text-gray-600">
                                        Phone
                                    </p>

                                    @if($transaction->property->owner->phone)

                                        <p class="mt-1 text-sm text-gray-300">
                                            {{ $transaction->property->owner->phone }}
                                        </p>

                                    @else

                                        <p class="mt-1 text-sm text-gray-600">
                                            Not provided
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endif

        </div>



        {{-- =================================================
             TRANSACTION SUMMARY
        ================================================== --}}

        <div class="rounded-2xl border border-gray-800 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-400">

                    <i class="fa-solid fa-file-signature text-lg"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-white">
                        Transaction Summary
                    </h2>

                    <p class="text-xs text-gray-500">
                        Request information
                    </p>

                </div>

            </div>


            <div class="mt-6 space-y-5">


                {{-- REQUEST ID --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Request ID
                    </p>

                    <p class="mt-1 font-semibold text-white">
                        #{{ $transaction->id }}
                    </p>

                </div>


                {{-- TRANSACTION TYPE --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Transaction Type
                    </p>

                    <p class="mt-1 font-semibold text-white">
                        {{ ucfirst($transaction->type) }}
                    </p>

                </div>


                {{-- LISTED PRICE --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Listed Price
                    </p>

                    <p class="mt-1 text-2xl font-bold text-emerald-400">

                        ₹{{ number_format((float) $transaction->amount, 2) }}

                    </p>

                </div>


                {{-- CUSTOMER OFFER --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Customer Offer
                    </p>

                    @if($transaction->offer_amount !== null)

                        <p class="mt-1 text-xl font-bold text-purple-400">

                            ₹{{ number_format((float) $transaction->offer_amount, 2) }}

                        </p>

                    @else

                        <p class="mt-1 text-sm font-medium text-gray-500">
                            Not offered
                        </p>

                    @endif

                </div>


                {{-- COUNTER OFFER --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Counter Offer
                    </p>

                    @if($transaction->counter_offer_amount !== null)

                        <p class="mt-1 text-xl font-bold text-amber-400">

                            ₹{{ number_format((float) $transaction->counter_offer_amount, 2) }}

                        </p>

                    @else

                        <p class="mt-1 text-sm font-medium text-gray-500">
                            Not offered yet
                        </p>

                    @endif

                </div>


                {{-- CREATED --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Request Submitted
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-300">

                        {{ $transaction->created_at->format('d M Y, h:i A') }}

                    </p>

                </div>


                {{-- UPDATED --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Last Updated
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-300">

                        {{ $transaction->updated_at->format('d M Y, h:i A') }}

                    </p>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         OFFER DETAILS
    ====================================================== --}}

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">


        {{-- LISTED PRICE --}}

        <div class="rounded-2xl border border-emerald-500/20 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                    <i class="fa-solid fa-tag"></i>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Listed Price
                    </p>

                    <p class="mt-1 text-xl font-bold text-emerald-400">
                        ₹{{ number_format((float) $transaction->amount, 2) }}
                    </p>

                </div>

            </div>

        </div>


        {{-- CUSTOMER OFFER --}}

        <div class="rounded-2xl border border-purple-500/20 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                    <i class="fa-solid fa-hand-holding-dollar"></i>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Customer Offer
                    </p>

                    @if($transaction->offer_amount !== null)

                        <p class="mt-1 text-xl font-bold text-purple-400">
                            ₹{{ number_format((float) $transaction->offer_amount, 2) }}
                        </p>

                    @else

                        <p class="mt-1 text-sm font-medium text-gray-500">
                            Not offered
                        </p>

                    @endif

                </div>

            </div>

        </div>


        {{-- COUNTER OFFER --}}

        <div class="rounded-2xl border border-amber-500/20 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-500/10 text-amber-400">

                    <i class="fa-solid fa-money-bill-transfer"></i>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Counter Offer
                    </p>

                    @if($transaction->counter_offer_amount !== null)

                        <p class="mt-1 text-xl font-bold text-amber-400">
                            ₹{{ number_format((float) $transaction->counter_offer_amount, 2) }}
                        </p>

                    @else

                        <p class="mt-1 text-sm font-medium text-gray-500">
                            Not offered yet
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         ADMIN COUNTER OFFER
    ====================================================== --}}

    @if(in_array($transaction->status, ['pending', 'approved']))

        <div class="rounded-2xl border border-amber-500/20 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-500/10 text-amber-400">

                        <i class="fa-solid fa-handshake text-lg"></i>

                    </div>

                    <div>

                        <h2 class="font-semibold text-white">
                            Counter Offer
                        </h2>

                        <p class="text-xs text-gray-500">
                            Send a counter price to the customer.
                        </p>

                    </div>

                </div>


                @if($transaction->counter_offer_amount !== null)

                    <div class="rounded-xl border border-amber-500/20 bg-amber-500/5 px-4 py-2">

                        <span class="text-xs text-gray-500">
                            Current Counter Offer
                        </span>

                        <div class="font-bold text-amber-400">

                            ₹{{ number_format((float) $transaction->counter_offer_amount, 2) }}

                        </div>

                    </div>

                @endif

            </div>


            <form
                action="{{ route('admin.property-transactions.counter-offer', $transaction) }}"
                method="POST"
                class="mt-6"
            >

                @csrf

                @method('PATCH')


                <div class="grid grid-cols-1 gap-5 md:grid-cols-3 md:items-end">


                    {{-- CUSTOMER OFFER --}}

                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-300">
                            Customer Offer
                        </label>

                        <div class="rounded-xl border border-gray-700 bg-gray-950 px-4 py-3 text-sm font-semibold text-purple-400">

                            @if($transaction->offer_amount !== null)

                                ₹{{ number_format((float) $transaction->offer_amount, 2) }}

                            @else

                                Not offered

                            @endif

                        </div>

                    </div>


                    {{-- COUNTER OFFER INPUT --}}

                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-300">
                            Counter Offer Amount
                        </label>

                        <div class="relative">

                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                ₹
                            </span>

                            <input
                                type="number"
                                name="counter_offer_amount"
                                value="{{ old('counter_offer_amount', $transaction->counter_offer_amount) }}"
                                min="1"
                                step="0.01"
                                max="999999999999.99"
                                required
                                placeholder="Enter counter offer"
                                class="w-full rounded-xl border border-gray-700 bg-gray-950 py-3 pl-9 pr-4 text-sm text-white placeholder-gray-600 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20"
                            >

                        </div>

                        @error('counter_offer_amount')

                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- BUTTON --}}

                    <div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-900/20 transition hover:from-amber-400 hover:to-orange-400"
                        >

                            <i class="fa-solid fa-paper-plane"></i>

                            {{ $transaction->counter_offer_amount !== null ? 'Update Counter Offer' : 'Send Counter Offer' }}

                        </button>

                    </div>

                </div>


                <div class="mt-4 flex items-start gap-3 rounded-xl border border-amber-500/10 bg-amber-500/5 px-4 py-3">

                    <i class="fa-solid fa-circle-info mt-0.5 text-amber-400"></i>

                    <p class="text-xs leading-5 text-gray-500">

                        The customer will be able to see this counter offer in their property request dashboard and request details.

                    </p>

                </div>

            </form>

        </div>

    @endif



    {{-- =====================================================
         APPLICANT + USER DETAILS
    ====================================================== --}}

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


        {{-- APPLICANT --}}

        <div class="rounded-2xl border border-gray-800 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-sky-500/10 text-sky-400">

                    <i class="fa-solid fa-user text-lg"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-white">
                        Applicant Details
                    </h2>

                    <p class="text-xs text-gray-500">
                        Information submitted with request
                    </p>

                </div>

            </div>


            <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">


                {{-- NAME --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Full Name
                    </p>

                    <p class="mt-1 font-medium text-white">
                        {{ $transaction->name }}
                    </p>

                </div>


                {{-- EMAIL --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Email
                    </p>

                    <p class="mt-1 break-all font-medium text-gray-300">
                        {{ $transaction->email }}
                    </p>

                </div>


                {{-- PHONE --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Phone
                    </p>

                    <p class="mt-1 font-medium text-gray-300">
                        {{ $transaction->phone }}
                    </p>

                </div>


                {{-- USER ACCOUNT --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        User Account
                    </p>

                    @if($transaction->user)

                        <p class="mt-1 font-medium text-white">
                            {{ $transaction->user->name }}
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            User ID: #{{ $transaction->user->id }}
                        </p>

                    @else

                        <p class="mt-1 text-red-400">
                            User not found
                        </p>

                    @endif

                </div>

            </div>

        </div>



        {{-- ADDRESS --}}

        <div class="rounded-2xl border border-gray-800 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                    <i class="fa-solid fa-location-dot text-lg"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-white">
                        Applicant Address
                    </h2>

                    <p class="text-xs text-gray-500">
                        Address provided by applicant
                    </p>

                </div>

            </div>


            <div class="mt-6 space-y-4">


                {{-- ADDRESS --}}

                <div>

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Address
                    </p>

                    <p class="mt-1 text-sm leading-6 text-gray-300">

                        {{ $transaction->address ?: 'Not provided' }}

                    </p>

                </div>


                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">


                    {{-- CITY --}}

                    <div>

                        <p class="text-xs uppercase tracking-wider text-gray-600">
                            City
                        </p>

                        <p class="mt-1 text-sm text-gray-300">
                            {{ $transaction->city ?: '—' }}
                        </p>

                    </div>


                    {{-- STATE --}}

                    <div>

                        <p class="text-xs uppercase tracking-wider text-gray-600">
                            State
                        </p>

                        <p class="mt-1 text-sm text-gray-300">
                            {{ $transaction->state ?: '—' }}
                        </p>

                    </div>


                    {{-- PINCODE --}}

                    <div>

                        <p class="text-xs uppercase tracking-wider text-gray-600">
                            Pincode
                        </p>

                        <p class="mt-1 text-sm text-gray-300">
                            {{ $transaction->pincode ?: '—' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         STATUS MANAGEMENT
    ====================================================== --}}

    @if($transaction->status === 'cancelled')

        {{-- CANCELLED REQUEST --}}

        <div class="rounded-2xl border border-gray-600/30 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gray-500/10 text-gray-400">

                        <i class="fa-solid fa-ban text-lg"></i>

                    </div>

                    <div>

                        <h2 class="font-semibold text-white">
                            Request Cancelled
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            This request was cancelled by the user.
                        </p>

                    </div>

                </div>


                <span class="inline-flex w-fit items-center gap-2 rounded-full bg-gray-500/10 px-4 py-2 text-sm font-semibold text-gray-300">

                    <span class="h-2 w-2 rounded-full bg-gray-400"></span>

                    Cancelled

                </span>

            </div>


            <div class="mt-5 rounded-xl border border-gray-700 bg-gray-950/50 px-4 py-4">

                <div class="flex items-start gap-3">

                    <i class="fa-solid fa-circle-info mt-0.5 text-gray-500"></i>

                    <p class="text-sm leading-6 text-gray-500">

                        This request is no longer active because the user cancelled it.
                        The admin cannot modify the status of a cancelled request.

                    </p>

                </div>

            </div>

        </div>


    @else

        {{-- NORMAL STATUS MANAGEMENT --}}

        <div class="rounded-2xl border border-indigo-500/20 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-400">

                        <i class="fa-solid fa-sliders text-lg"></i>

                    </div>

                    <div>

                        <h2 class="font-semibold text-white">
                            Manage Request
                        </h2>

                        <p class="text-xs text-gray-500">
                            Update the status of this property request.
                        </p>

                    </div>

                </div>


                {{-- STATUS DESCRIPTION --}}

                <div class="text-sm text-gray-400">

                    @if($transaction->status === 'pending')

                        Waiting for admin approval.

                    @elseif($transaction->status === 'approved')

                        Request approved. Transaction can now be completed.

                    @elseif($transaction->status === 'completed')

                        Transaction has been completed successfully.

                    @elseif($transaction->status === 'rejected')

                        This request has been rejected.

                    @endif

                </div>

            </div>


            <form
                action="{{ route('admin.property-transactions.update-status', $transaction) }}"
                method="POST"
                class="mt-6 space-y-5"
            >

                @csrf

                @method('PATCH')


                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                    {{-- STATUS --}}

                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-300">
                            Request Status
                        </label>

                        <select
                            name="status"
                            required
                            class="w-full rounded-xl border border-gray-700 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                            <option
                                value="pending"
                                {{ $transaction->status === 'pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="approved"
                                {{ $transaction->status === 'approved' ? 'selected' : '' }}
                            >
                                Approved
                            </option>

                            <option
                                value="rejected"
                                {{ $transaction->status === 'rejected' ? 'selected' : '' }}
                            >
                                Rejected
                            </option>

                            <option
                                value="completed"
                                {{ $transaction->status === 'completed' ? 'selected' : '' }}
                            >
                                Completed
                            </option>

                        </select>

                        <p class="mt-2 text-xs text-gray-600">

                            Completing a Buy request marks the property as Sold.
                            Completing a Rent request marks the property as Rented.

                        </p>

                    </div>


                    {{-- ADMIN NOTE --}}

                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-300">
                            Admin Note
                        </label>

                        <textarea
                            name="admin_note"
                            rows="4"
                            placeholder="Add an internal note about this request..."
                            class="w-full resize-none rounded-xl border border-gray-700 bg-gray-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >{{ old('admin_note', $transaction->admin_note) }}</textarea>

                    </div>

                </div>


                {{-- WARNING --}}

                <div class="flex items-start gap-3 rounded-xl border border-yellow-500/20 bg-yellow-500/5 px-4 py-4">

                    <i class="fa-solid fa-triangle-exclamation mt-0.5 text-yellow-400"></i>

                    <div>

                        <p class="text-sm font-medium text-yellow-400">
                            Important
                        </p>

                        <p class="mt-1 text-xs leading-5 text-gray-500">

                            If you select
                            <strong class="text-gray-400">
                                Completed
                            </strong>,

                            the related property's status will automatically change to

                            <strong class="text-gray-400">
                                Sold
                            </strong>

                            for Buy or

                            <strong class="text-gray-400">
                                Rented
                            </strong>

                            for Rent.

                        </p>

                    </div>

                </div>


                {{-- SUBMIT --}}

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('admin.property-transactions.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-700 bg-gray-800 px-5 py-3 text-sm font-semibold text-gray-300 transition hover:bg-gray-700 hover:text-white"
                    >

                        <i class="fa-solid fa-arrow-left"></i>

                        Back

                    </a>


                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-900/20 transition hover:from-indigo-400 hover:to-violet-500"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        Update Status

                    </button>

                </div>

            </form>

        </div>

    @endif



    {{-- =====================================================
         ADMIN NOTE DISPLAY
    ====================================================== --}}

    @if($transaction->admin_note)

        <div class="rounded-2xl border border-gray-800 bg-gray-900/70 p-6 shadow-xl">

            <div class="flex items-start gap-4">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-yellow-500/10 text-yellow-400">

                    <i class="fa-solid fa-note-sticky"></i>

                </div>

                <div>

                    <h3 class="font-semibold text-white">
                        Current Admin Note
                    </h3>

                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-400">
                        {{ $transaction->admin_note }}
                    </p>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection