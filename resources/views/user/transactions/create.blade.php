@extends('layouts.app')

@section('title', ($type === 'buy' ? 'Buy Property' : 'Rent Property') . ' - Eagle Properties')

@section('content')

{{-- =========================================================
START SECTION TOP
========================================================= --}}

<section class="section-top">


<div class="container">

    <div class="col-lg-10 offset-lg-1 col-xs-12 text-center">

        <div
            class="section-top-title wow fadeInRight"
            data-wow-duration="1s"
            data-wow-delay="0.3s"
            data-wow-offset="0"
        >

            <h1>
                {{ $type === 'buy' ? 'Buy Property' : 'Rent Property' }}
            </h1>

            <p>
                Please provide your details to submit your
                {{ $type === 'buy' ? 'purchase' : 'rental' }} request.
            </p>

        </div>

    </div>

</div>


</section>

{{-- END SECTION TOP --}}

{{-- =========================================================
PROPERTY TRANSACTION PAGE
========================================================= --}}

<div class="property-transaction-page">


<div class="container">


    {{-- =====================================================
         BACK BUTTON
    ====================================================== --}}

    <div class="mb-5">

        <a
            href="{{ route('property.details', $property->slug) }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 transition hover:text-gray-900"
        >
            ← Back to Property
        </a>

    </div>


    {{-- =====================================================
         VALIDATION ERRORS
    ====================================================== --}}

    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

            <div class="flex items-start gap-3">

                <div class="text-red-600">
                    ⚠
                </div>

                <div>

                    <h3 class="font-semibold text-red-800">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">

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


    {{-- =====================================================
         PROPERTY REGISTERED BY LOGIC
    ====================================================== --}}

    @php

        /*
        |--------------------------------------------------------------------------
        | PROPERTY REGISTERED BY
        |--------------------------------------------------------------------------
        |
        | Owner registered property:
        |     user_id exists -> Owner
        |
        | Agent registered property:
        |     user_id is null + agent_id exists -> Agent
        |
        | Important:
        | agent_id alone does NOT mean Agent registered it.
        | If user_id exists, Owner will always be shown.
        |
        */

        $registeredBy = null;
        $registeredByType = null;

        if ($property?->user_id && $property?->owner) {

            $registeredBy = $property->owner;
            $registeredByType = 'Owner';

        } elseif (
            !$property?->user_id &&
            $property?->agent_id &&
            $property?->agent
        ) {

            $registeredBy = $property->agent;
            $registeredByType = 'Agent';

        }

    @endphp


    {{-- =====================================================
         MAIN GRID
    ====================================================== --}}

    <div class="grid gap-8 lg:grid-cols-3">


        {{-- =================================================
             LEFT COLUMN
        ================================================== --}}

        <div class="lg:col-span-1">


            {{-- =================================================
                 PROPERTY SUMMARY
            ================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                @php

                    $photos = is_array($property->photos)
                        ? $property->photos
                        : [];

                    $mainPhoto = $photos[0] ?? null;

                @endphp


                {{-- PROPERTY IMAGE --}}

                <div class="h-56 overflow-hidden bg-gray-100">

                    @if ($mainPhoto)

                        <img
                            src="{{ asset('storage/' . $mainPhoto) }}"
                            alt="{{ $property->title }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        <div class="flex h-full items-center justify-center text-gray-400">

                            No Image Available

                        </div>

                    @endif

                </div>


                {{-- PROPERTY INFO --}}

                <div class="p-6">


                    {{-- TYPE BADGE --}}

                    <div class="mb-3">

                        <span
                            class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                            {{ $type === 'buy'
                                ? 'bg-blue-100 text-blue-700'
                                : 'bg-purple-100 text-purple-700' }}"
                        >

                            {{ $type === 'buy' ? 'BUY PROPERTY' : 'RENT PROPERTY' }}

                        </span>

                    </div>


                    {{-- PROPERTY TITLE --}}

                    <h2 class="text-xl font-bold text-gray-900">

                        {{ $property->title }}

                    </h2>


                    {{-- LOCATION --}}

                    @if ($property->location)

                        <p class="mt-2 text-sm text-gray-500">

                            {{ $property->location->city }},

                            {{ $property->location->state }}

                        </p>

                    @endif


                    {{-- LISTED PROPERTY PRICE --}}

                    <div class="mt-5 border-t border-gray-100 pt-5">

                        <p class="text-sm text-gray-500">

                            {{ $type === 'buy'
                                ? 'Listed Property Price'
                                : 'Listed Rental Price' }}

                        </p>

                        <p class="mt-1 text-2xl font-bold text-gray-900">

                            ₹{{ number_format((float) $property->price, 2) }}

                        </p>

                    </div>


                    {{-- OFFER INFO --}}

                    <div class="mt-5 rounded-xl bg-purple-50 p-4">

                        <p class="text-xs font-semibold uppercase tracking-wide text-purple-600">

                            Customer Offer

                        </p>

                        <p class="mt-1 text-sm leading-5 text-purple-800">

                            You can submit your own offer amount for this property.

                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 PROPERTY REGISTERED BY
            ================================================== --}}

            @if ($registeredBy)

                <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">


                    {{-- HEADER --}}

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <h3 class="text-base font-bold text-gray-900">
                                Property Registered By
                            </h3>

                            <p class="mt-1 text-xs text-gray-500">
                                Property account details
                            </p>

                        </div>


                        {{-- TYPE BADGE --}}

                        <span
                            class="inline-flex shrink-0 rounded-full px-3 py-1 text-xs font-semibold
                            {{ $registeredByType === 'Owner'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-blue-100 text-blue-700' }}"
                        >

                            {{ $registeredByType }}

                        </span>

                    </div>


                    {{-- PERSON INFO --}}

                    <div class="mt-5 flex items-center gap-4">


                        {{-- AVATAR --}}

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full
                            {{ $registeredByType === 'Owner'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-blue-100 text-blue-700' }}
                            text-lg font-bold"
                        >

                            {{ strtoupper(substr($registeredBy->name ?? 'U', 0, 1)) }}

                        </div>


                        {{-- NAME --}}

                        <div class="min-w-0">

                            <p class="truncate text-base font-semibold text-gray-900">

                                {{ $registeredBy->name ?? 'N/A' }}

                            </p>

                            <p class="text-xs text-gray-500">

                                {{ $registeredByType }}

                            </p>

                        </div>

                    </div>


                    {{-- DETAILS --}}

                    <div class="mt-5 space-y-3 border-t border-gray-100 pt-5">


                        {{-- EMAIL --}}

                        @if (!empty($registeredBy->email))

                            <div class="flex items-start gap-3">

                                <span class="mt-0.5 text-gray-400">
                                    ✉
                                </span>

                                <div class="min-w-0">

                                    <p class="text-xs font-medium text-gray-400">
                                        Email
                                    </p>

                                    <p class="break-all text-sm font-medium text-gray-700">

                                        {{ $registeredBy->email }}

                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- PHONE --}}

                        @if (!empty($registeredBy->phone))

                            <div class="flex items-start gap-3">

                                <span class="mt-0.5 text-gray-400">
                                    ☎
                                </span>

                                <div>

                                    <p class="text-xs font-medium text-gray-400">
                                        Phone
                                    </p>

                                    <p class="text-sm font-medium text-gray-700">

                                        {{ $registeredBy->phone }}

                                    </p>

                                </div>

                            </div>

                        @endif


                    </div>

                </div>

            @endif

        </div>


        {{-- =================================================
             TRANSACTION FORM
        ================================================== --}}

        <div class="lg:col-span-2">

            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">


                {{-- FORM HEADER --}}

                <div class="mb-7">

                    <h2 class="text-xl font-bold text-gray-900">
                        Your Details
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        These details will be saved with your request.
                    </p>

                </div>


                {{-- =================================================
                     FORM
                ================================================== --}}

                <form
                    action="{{ route('property.transaction.store', $property) }}"
                    method="POST"
                    class="space-y-6"
                >

                    @csrf


                    {{-- TRANSACTION TYPE --}}

                    <input
                        type="hidden"
                        name="type"
                        value="{{ $type }}"
                    >


                    {{-- =================================================
                         NAME + EMAIL
                    ================================================== --}}

                    <div class="grid gap-5 md:grid-cols-2">


                        {{-- NAME --}}

                        <div>

                            <label
                                for="name"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >

                                Full Name

                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', auth()->user()->name) }}"
                                required
                                maxlength="255"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                placeholder="Enter your full name"
                            >

                            @error('name')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- EMAIL --}}

                        <div>

                            <label
                                for="email"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >

                                Email Address

                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', auth()->user()->email) }}"
                                required
                                maxlength="255"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                placeholder="Enter your email"
                            >

                            @error('email')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- =================================================
                         PHONE
                    ================================================== --}}

                    <div>

                        <label
                            for="phone"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >

                            Phone Number

                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            maxlength="20"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                            placeholder="Enter your phone number"
                        >

                        @error('phone')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                         CUSTOMER OFFER AMOUNT
                    ================================================== --}}

                    <div class="rounded-2xl border border-purple-200 bg-purple-50/50 p-5">


                        <div class="mb-4">

                            <h3 class="text-base font-bold text-gray-900">
                                Your Offer
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">

                                Enter the amount you are willing to
                                {{ $type === 'buy'
                                    ? 'pay for this property'
                                    : 'pay as rent' }}.

                            </p>

                        </div>


                        <div class="grid gap-5 md:grid-cols-2">


                            {{-- LISTED PRICE --}}

                            <div>

                                <label
                                    class="mb-2 block text-sm font-semibold text-gray-700"
                                >

                                    {{ $type === 'buy'
                                        ? 'Listed Property Price'
                                        : 'Listed Rental Price' }}

                                </label>

                                <div
                                    class="flex h-[50px] items-center rounded-xl border border-gray-200 bg-gray-100 px-4"
                                >

                                    <span class="mr-2 font-semibold text-gray-500">
                                        ₹
                                    </span>

                                    <span class="font-bold text-gray-800">

                                        {{ number_format((float) $property->price, 2) }}

                                    </span>

                                </div>

                            </div>


                            {{-- CUSTOMER OFFER --}}

                            <div>

                                <label
                                    for="offer_amount"
                                    class="mb-2 block text-sm font-semibold text-gray-700"
                                >

                                    Your Offer Amount

                                    <span class="text-red-500">*</span>

                                </label>


                                <div class="relative">

                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 font-semibold text-gray-500"
                                    >
                                        ₹
                                    </span>

                                    <input
                                        type="number"
                                        id="offer_amount"
                                        name="offer_amount"
                                        value="{{ old('offer_amount', $property->price) }}"
                                        required
                                        min="1"
                                        step="0.01"
                                        class="w-full rounded-xl border border-gray-300 bg-white py-3 pl-10 pr-4 text-sm font-semibold text-gray-900 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                                        placeholder="Enter your offer amount"
                                    >

                                </div>

                                @error('offer_amount')

                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- OFFER DIFFERENCE --}}

                        <div
                            id="offerDifference"
                            class="mt-4 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-600"
                        >

                            Enter your offer amount to see the difference.

                        </div>

                    </div>


                    {{-- =================================================
                         ADDRESS
                    ================================================== --}}

                    <div>

                        <label
                            for="address"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            maxlength="1000"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                            placeholder="Enter your complete address"
                        >{{ old('address') }}</textarea>

                        @error('address')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                         CITY + STATE
                    ================================================== --}}

                    <div class="grid gap-5 md:grid-cols-2">


                        {{-- CITY --}}

                        <div>

                            <label
                                for="city"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                City
                            </label>

                            <input
                                type="text"
                                id="city"
                                name="city"
                                value="{{ old('city') }}"
                                maxlength="100"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                placeholder="Enter city"
                            >

                            @error('city')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- STATE --}}

                        <div>

                            <label
                                for="state"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                State
                            </label>

                            <input
                                type="text"
                                id="state"
                                name="state"
                                value="{{ old('state') }}"
                                maxlength="100"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                placeholder="Enter state"
                            >

                            @error('state')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- =================================================
                         PINCODE
                    ================================================== --}}

                    <div>

                        <label
                            for="pincode"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Pincode
                        </label>

                        <input
                            type="text"
                            id="pincode"
                            name="pincode"
                            value="{{ old('pincode') }}"
                            maxlength="20"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                            placeholder="Enter pincode"
                        >

                        @error('pincode')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                         REQUEST SUMMARY
                    ================================================== --}}

                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">

                        <div class="grid gap-5 sm:grid-cols-3">


                            {{-- PROPERTY PRICE --}}

                            <div>

                                <p class="text-sm font-medium text-gray-500">
                                    Listed Price
                                </p>

                                <p class="mt-1 text-xl font-bold text-gray-900">

                                    ₹{{ number_format((float) $property->price, 2) }}

                                </p>

                            </div>


                            {{-- CUSTOMER OFFER --}}

                            <div>

                                <p class="text-sm font-medium text-gray-500">
                                    Your Offer
                                </p>

                                <p
                                    id="summaryOffer"
                                    class="mt-1 text-xl font-bold text-purple-700"
                                >

                                    ₹{{ number_format(
                                        (float) old('offer_amount', $property->price),
                                        2
                                    ) }}

                                </p>

                            </div>


                            {{-- STATUS --}}

                            <div class="sm:text-right">

                                <p class="text-sm font-medium text-gray-500">
                                    Request Status
                                </p>

                                <p class="mt-1 text-sm font-semibold text-yellow-600">
                                    Pending
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         SUBMIT
                    ================================================== --}}

                    <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs leading-5 text-gray-500">

                            Your request will be reviewed by our admin team.

                        </p>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900/20"
                        >

                            {{ $type === 'buy'
                                ? 'Submit Buy Request'
                                : 'Submit Rent Request' }}

                            <span>
                                →
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


</div>

{{-- =========================================================
PAGE SPACING
========================================================= --}}

<style>

    .property-transaction-page {
        min-height: 700px;
        background: #f8fafc;
        padding: 45px 0 70px;
    }

</style>

{{-- =========================================================
OFFER AMOUNT JAVASCRIPT
========================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const offerInput =
        document.getElementById('offer_amount');

    const differenceBox =
        document.getElementById('offerDifference');

    const summaryOffer =
        document.getElementById('summaryOffer');


    if (!offerInput || !differenceBox) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | PROPERTY LISTED PRICE
    |--------------------------------------------------------------------------
    */

    const propertyPrice =
        {{ (float) $property->price }};


    /*
    |--------------------------------------------------------------------------
    | CURRENCY FORMATTER
    |--------------------------------------------------------------------------
    */

    function formatCurrency(amount) {

        return new Intl.NumberFormat('en-IN', {

            style: 'currency',

            currency: 'INR',

            maximumFractionDigits: 2

        }).format(amount);

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE OFFER INFORMATION
    |--------------------------------------------------------------------------
    */

    function updateOfferInformation() {

        const offer =
            parseFloat(offerInput.value) || 0;


        /*
        |--------------------------------------------------------------------------
        | UPDATE SUMMARY
        |--------------------------------------------------------------------------
        */

        if (summaryOffer) {

            summaryOffer.textContent =
                formatCurrency(offer);

        }


        /*
        |--------------------------------------------------------------------------
        | EMPTY OFFER
        |--------------------------------------------------------------------------
        */

        if (offer <= 0) {

            differenceBox.className =
                'mt-4 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-600';

            differenceBox.textContent =
                'Enter your offer amount to see the difference.';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | LOWER OFFER
        |--------------------------------------------------------------------------
        */

        if (offer < propertyPrice) {

            const difference =
                propertyPrice - offer;

            differenceBox.className =
                'mt-4 rounded-xl border border-orange-200 bg-orange-50 px-4 py-3 text-sm text-orange-700';

            differenceBox.innerHTML =
                'You are offering <strong>' +
                formatCurrency(difference) +
                '</strong> less than the listed price.';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | HIGHER OFFER
        |--------------------------------------------------------------------------
        */

        if (offer > propertyPrice) {

            const difference =
                offer - propertyPrice;

            differenceBox.className =
                'mt-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700';

            differenceBox.innerHTML =
                'Your offer is <strong>' +
                formatCurrency(difference) +
                '</strong> above the listed price.';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | SAME OFFER
        |--------------------------------------------------------------------------
        */

        differenceBox.className =
            'mt-4 rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-700';

        differenceBox.innerHTML =
            '<strong>Your offer matches the listed property price.</strong>';

    }


    /*
    |--------------------------------------------------------------------------
    | INPUT EVENT
    |--------------------------------------------------------------------------
    */

    offerInput.addEventListener(
        'input',
        updateOfferInformation
    );


    /*
    |--------------------------------------------------------------------------
    | INITIAL CALCULATION
    |--------------------------------------------------------------------------
    */

    updateOfferInformation();

});

</script>

@endpush

@endsection
