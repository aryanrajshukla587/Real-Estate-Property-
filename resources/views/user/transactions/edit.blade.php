@extends('layouts.app')

@section('title', 'Edit Offer - Eagle Properties')

@section('content')

{{-- =========================================================
PAGE WRAPPER
========================================================= --}}

<div class="min-h-screen bg-gray-50">

{{-- =====================================================
TOP SECTION
====================================================== --}}

<section class="section-top">


<div class="container">

    <div class="col-lg-10 offset-lg-1 col-xs-12">

        <div
            class="section-top-title wow fadeInRight"
            data-wow-duration="1s"
            data-wow-delay="0.3s"
            data-wow-offset="0"
        >

            {{-- BACK --}}

            <a
                href="{{ route('user.transaction.show', $transaction) }}"
                class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-gray-600 transition hover:text-gray-900"
            >
                ← Back to Request
            </a>


            {{-- HEADER --}}

            <h1>
                Edit Your Offer
            </h1>

            <p>
                Update the amount you want to offer for this property.
            </p>

        </div>

    </div>

</div>


</section>

{{-- =====================================================
MAIN CONTENT
====================================================== --}}

<section class="py-10">


<div class="container">

    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">


        {{-- =================================================
             VALIDATION ERRORS
        ================================================== --}}

        @if ($errors->any())

            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

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

        @endif


        {{-- =================================================
             PROPERTY / OWNER DATA
        ================================================== --}}

        @php

            $property = $transaction->property ?? null;

            $photos = $property && is_array($property->photos)
                ? $property->photos
                : [];

            $mainPhoto = $photos[0] ?? null;


            /*
            |--------------------------------------------------------------------------
            | PROPERTY REGISTERED BY
            |--------------------------------------------------------------------------
            |
            | Agar property owner ne register ki hai:
            | user_id present hoga -> Owner show hoga.
            |
            | Agar property agent ne register ki hai:
            | user_id null + agent_id present -> Agent show hoga.
            |
            | Important:
            | agent_id sirf assigned agent ko represent nahi karega
            | agar user_id already present hai.
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


        {{-- =================================================
             MAIN GRID
        ================================================== --}}

        <div class="grid gap-8 lg:grid-cols-3">


            {{-- =================================================
                 LEFT COLUMN
            ================================================== --}}

            <div class="lg:col-span-1">


                {{-- =================================================
                     PROPERTY SUMMARY
                ================================================== --}}

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">


                    {{-- PROPERTY IMAGE --}}

                    <div class="h-56 overflow-hidden bg-gray-100">

                        @if ($mainPhoto)

                            <img
                                src="{{ asset('storage/' . $mainPhoto) }}"
                                alt="{{ $property?->title ?? 'Property' }}"
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

                        <span
                            class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                            {{ $transaction->type === 'buy'
                                ? 'bg-blue-100 text-blue-700'
                                : 'bg-purple-100 text-purple-700' }}"
                        >

                            {{ strtoupper($transaction->type) }}

                        </span>


                        {{-- PROPERTY TITLE --}}

                        <h2 class="mt-4 text-xl font-bold text-gray-900">

                            {{ $property?->title ?? 'Property' }}

                        </h2>


                        {{-- LOCATION --}}

                        @if ($property?->location)

                            <p class="mt-2 text-sm text-gray-500">

                                {{ $property->location->city }}

                                @if ($property->location->state)
                                    , {{ $property->location->state }}
                                @endif

                            </p>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     PROPERTY REGISTERED BY
                ================================================== --}}

                @if ($registeredBy)

                    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                        {{-- HEADER --}}

                        <div class="flex items-center justify-between gap-3">

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
                                class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
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
                 EDIT FORM
            ================================================== --}}

            <div class="lg:col-span-2">

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">


                    {{-- FORM HEADER --}}

                    <div class="mb-7">

                        <h2 class="text-xl font-bold text-gray-900">
                            Update Offer Amount
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            You can increase or decrease your offer while the request is pending.
                        </p>

                    </div>


                    {{-- =================================================
                         PRICE INFORMATION
                    ================================================== --}}

                    <div class="mb-6 grid gap-4 sm:grid-cols-2">


                        {{-- LISTED PRICE --}}

                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">

                            <p class="text-sm font-medium text-gray-500">
                                Listed Price
                            </p>

                            <p class="mt-1 text-2xl font-bold text-gray-900">

                                ₹{{ number_format((float) $transaction->amount, 2) }}

                            </p>

                        </div>


                        {{-- CURRENT OFFER --}}

                        <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

                            <p class="text-sm font-medium text-blue-600">
                                Current Offer
                            </p>

                            <p class="mt-1 text-2xl font-bold text-blue-700">

                                ₹{{ number_format(
                                    (float) ($transaction->offer_amount ?? $transaction->amount),
                                    2
                                ) }}

                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                         FORM
                    ================================================== --}}

                    <form
                        action="{{ route('user.transaction.update', $transaction) }}"
                        method="POST"
                        class="space-y-6"
                    >

                        @csrf

                        @method('PUT')


                        {{-- =================================================
                             OFFER AMOUNT
                        ================================================== --}}

                        <div>

                            <label
                                for="offer_amount"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >

                                Your New Offer Amount

                            </label>


                            <div class="relative">

                                <span
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-lg font-semibold text-gray-500"
                                >
                                    ₹
                                </span>


                                <input
                                    type="number"
                                    name="offer_amount"
                                    id="offer_amount"
                                    value="{{ old(
                                        'offer_amount',
                                        $transaction->offer_amount ?? $transaction->amount
                                    ) }}"
                                    min="1"
                                    step="0.01"
                                    required
                                    class="w-full rounded-xl border border-gray-300 bg-white py-3 pl-10 pr-4 text-lg font-semibold text-gray-900 outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                    placeholder="Enter your offer amount"
                                >

                            </div>


                            @error('offer_amount')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror


                            <p class="mt-2 text-xs text-gray-500">

                                Enter the amount you are willing to offer.
                                You can increase or decrease your previous offer.

                            </p>

                        </div>


                        {{-- =================================================
                             DIFFERENCE
                        ================================================== --}}

                        <div
                            id="offerDifferenceBox"
                            class="rounded-xl border border-gray-200 bg-gray-50 p-5"
                        >

                            <div class="flex items-center justify-between">

                                <span class="text-sm font-medium text-gray-500">
                                    Difference from Listed Price
                                </span>


                                <span
                                    id="offerDifference"
                                    class="text-lg font-bold text-gray-900"
                                >
                                    ₹0.00
                                </span>

                            </div>

                        </div>


                        {{-- =================================================
                             WARNING
                        ================================================== --}}

                        <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-4">

                            <div class="flex gap-3">

                                <div class="text-yellow-600">
                                    ⚠
                                </div>


                                <div>

                                    <p class="text-sm font-semibold text-yellow-800">
                                        Important
                                    </p>

                                    <p class="mt-1 text-sm leading-6 text-yellow-700">

                                        Changing your offer will update the amount shown
                                        to our admin team. Your request will remain pending
                                        until it is reviewed.

                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                             BUTTONS
                        ================================================== --}}

                        <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:justify-end">


                            {{-- CANCEL --}}

                            <a
                                href="{{ route('user.transaction.show', $transaction) }}"
                                class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                            >

                                Cancel

                            </a>


                            {{-- UPDATE --}}

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900/20"
                            >

                                Update Offer

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


</section>

</div>

{{-- =========================================================
OFFER DIFFERENCE JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const offerInput =
        document.getElementById('offer_amount');

    const differenceElement =
        document.getElementById('offerDifference');


    if (!offerInput || !differenceElement) {
        return;
    }


    const listedPrice =
        {{ (float) $transaction->amount }};


    function updateDifference() {

        const offer =
            parseFloat(offerInput.value) || 0;


        const difference =
            listedPrice - offer;


        const absoluteDifference =
            Math.abs(difference);


        differenceElement.textContent =
            '₹' + absoluteDifference.toLocaleString('en-IN', {

                minimumFractionDigits: 2,

                maximumFractionDigits: 2

            });


        {{-- LOWER THAN LISTED PRICE --}}

        if (difference > 0) {

            differenceElement.className =
                'text-lg font-bold text-orange-600';

            return;

        }


        {{-- HIGHER THAN LISTED PRICE --}}

        if (difference < 0) {

            differenceElement.className =
                'text-lg font-bold text-green-600';

            return;

        }


        {{-- SAME AS LISTED PRICE --}}

        differenceElement.className =
            'text-lg font-bold text-gray-900';

    }


    offerInput.addEventListener(
        'input',
        updateDifference
    );


    updateDifference();

});

</script>

@endsection
