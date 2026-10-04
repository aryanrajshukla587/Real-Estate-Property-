@extends('layouts.app')

@section('title',
    ($transaction->type === 'buy' ? 'Purchase Request' : 'Rental Request')
    . ' - Eagle Properties'
)

@section('content')

<div class="min-h-screen bg-gray-50">


    {{-- =========================================================
         TOP SECTION
    ========================================================== --}}

    <section class="section-top">

        <div class="container">

            <div class="col-lg-10 offset-lg-1 col-xs-12">

                <div
                    class="section-top-title wow fadeInRight"
                    data-wow-duration="1s"
                    data-wow-delay="0.3s"
                    data-wow-offset="0"
                >

                    {{-- BACK TO DASHBOARD --}}

                    <a
                        href="{{ route('user.dashboard') }}"
                        class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-gray-600 transition hover:text-gray-900"
                    >
                        ← Back to Dashboard
                    </a>


                    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Request #{{ $transaction->id }}
                            </p>

                            <h1 class="mt-1">

                                {{ $transaction->type === 'buy'
                                    ? 'Purchase Request'
                                    : 'Rental Request' }}

                            </h1>

                        </div>


                        {{-- STATUS BADGE --}}

                        @php

                            $statusClasses = match (strtolower(trim($transaction->status))) {

                                'pending' =>
                                    'bg-yellow-100 text-yellow-700 border-yellow-200',

                                'approved' =>
                                    'bg-blue-100 text-blue-700 border-blue-200',

                                'rejected' =>
                                    'bg-red-100 text-red-700 border-red-200',

                                'completed' =>
                                    'bg-green-100 text-green-700 border-green-200',

                                'cancelled' =>
                                    'bg-gray-100 text-gray-600 border-gray-300',

                                default =>
                                    'bg-gray-100 text-gray-700 border-gray-200',

                            };


                            $currentStatus =
                                strtolower(trim($transaction->status));


                            $listedAmount =
                                (float) $transaction->amount;


                            $offerAmount =
                                (float) (
                                    $transaction->offer_amount
                                    ?? $transaction->amount
                                );


                            $counterOfferAmount =
                                $transaction->counter_offer_amount !== null
                                    ? (float) $transaction->counter_offer_amount
                                    : null;


                            $difference =
                                $listedAmount - $offerAmount;


                            /*
                            |--------------------------------------------------------------------------
                            | PROPERTY REGISTERED BY LOGIC
                            |--------------------------------------------------------------------------
                            |
                            | Owner registered property:
                            |     user_id exists -> Owner
                            |
                            | Agent registered property:
                            |     user_id is null + agent_id exists -> Agent
                            |
                            | IMPORTANT:
                            |     agent_id alone does NOT mean Agent registered
                            |     the property because an Owner property can
                            |     later be assigned to an Agent.
                            |
                            */

                            $property = $transaction->property ?? null;

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


                        <span
                            class="inline-flex w-fit items-center rounded-full border px-4 py-2 text-sm font-semibold {{ $statusClasses }}"
                        >
                            {{ ucfirst($transaction->status) }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <section class="py-10">

        <div class="container">

            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">


                {{-- =========================================================
                     SUCCESS / INFO / ERROR MESSAGE
                ========================================================== --}}

                @if(session('success'))

                    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4">

                        <div class="flex items-center gap-3">

                            <span class="text-lg text-green-600">
                                ✓
                            </span>

                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                @endif


                @if(session('info'))

                    <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-4">

                        <div class="flex items-center gap-3">

                            <span class="text-lg text-blue-600">
                                ⓘ
                            </span>

                            <p class="text-sm font-medium text-blue-800">
                                {{ session('info') }}
                            </p>

                        </div>

                    </div>

                @endif


                @if(session('error'))

                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                        <div class="flex items-center gap-3">

                            <span class="text-lg text-red-600">
                                !
                            </span>

                            <p class="text-sm font-medium text-red-800">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                @endif



                {{-- =========================================================
                     MAIN GRID
                ========================================================== --}}

                <div class="grid gap-8 lg:grid-cols-3">


                    {{-- =====================================================
                         PROPERTY CARD
                    ====================================================== --}}

                    <div class="lg:col-span-1">

                        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">


                            {{-- PROPERTY IMAGE --}}

                            @php

                                $photos = is_array($transaction->property->photos)
                                    ? $transaction->property->photos
                                    : [];

                                $mainPhoto = $photos[0] ?? null;

                            @endphp


                            <div class="h-56 overflow-hidden bg-gray-100">

                                @if($mainPhoto)

                                    <img
                                        src="{{ asset('storage/' . $mainPhoto) }}"
                                        alt="{{ $transaction->property->title }}"
                                        class="h-full w-full object-cover"
                                    >

                                @else

                                    <div class="flex h-full items-center justify-center text-sm text-gray-400">
                                        No Image Available
                                    </div>

                                @endif

                            </div>



                            {{-- PROPERTY DETAILS --}}

                            <div class="p-6">

                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    {{ $transaction->type === 'buy'
                                        ? 'bg-blue-100 text-blue-700'
                                        : 'bg-purple-100 text-purple-700' }}"
                                >

                                    {{ $transaction->type === 'buy'
                                        ? 'BUY PROPERTY'
                                        : 'RENT PROPERTY' }}

                                </span>



                                <h2 class="mt-4 text-xl font-bold text-gray-900">

                                    {{ $transaction->property->title }}

                                </h2>



                                @if($transaction->property->location)

                                    <p class="mt-2 text-sm text-gray-500">

                                        {{ $transaction->property->location->city }}

                                        @if($transaction->property->location->state)
                                            ,
                                            {{ $transaction->property->location->state }}
                                        @endif

                                    </p>

                                @endif



                                {{-- PRICE INFORMATION --}}

                                <div class="mt-5 border-t border-gray-100 pt-5">


                                    {{-- LISTED PRICE --}}

                                    <p class="text-sm text-gray-500">

                                        {{ $transaction->type === 'buy'
                                            ? 'Listed Property Price'
                                            : 'Listed Rental Price' }}

                                    </p>

                                    <p class="mt-1 text-2xl font-bold text-gray-900">

                                        ₹{{ number_format(
                                            $listedAmount,
                                            2
                                        ) }}

                                    </p>



                                    {{-- CUSTOMER OFFER --}}

                                    <div class="mt-4 rounded-xl bg-purple-50 p-4">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-purple-600">
                                            Your Offer
                                        </p>

                                        <p class="mt-1 text-xl font-bold text-purple-700">

                                            ₹{{ number_format(
                                                $offerAmount,
                                                2
                                            ) }}

                                        </p>

                                    </div>



                                    {{-- COUNTER OFFER --}}

                                    <div class="mt-4 rounded-xl border border-blue-200 bg-blue-50 p-4">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                                            Counter Offer
                                        </p>

                                        @if($counterOfferAmount !== null)

                                            <p class="mt-1 text-xl font-bold text-blue-700">

                                                ₹{{ number_format(
                                                    $counterOfferAmount,
                                                    2
                                                ) }}

                                            </p>

                                            <p class="mt-1 text-xs text-blue-600">
                                                Offer received from Eagle Properties.
                                            </p>

                                        @else

                                            <p class="mt-1 text-sm font-semibold text-gray-500">
                                                Not offered yet
                                            </p>

                                            <p class="mt-1 text-xs text-gray-400">
                                                Admin has not submitted a counter offer yet.
                                            </p>

                                        @endif

                                    </div>



                                    {{-- DIFFERENCE --}}

                                    @if($difference > 0)

                                        <div class="mt-3 rounded-xl border border-orange-200 bg-orange-50 p-3">

                                            <p class="text-xs font-medium text-orange-700">

                                                Your offer is

                                                <strong>
                                                    ₹{{ number_format(
                                                        abs($difference),
                                                        2
                                                    ) }}
                                                </strong>

                                                below the listed price.

                                            </p>

                                        </div>

                                    @elseif($difference < 0)

                                        <div class="mt-3 rounded-xl border border-green-200 bg-green-50 p-3">

                                            <p class="text-xs font-medium text-green-700">

                                                Your offer is

                                                <strong>
                                                    ₹{{ number_format(
                                                        abs($difference),
                                                        2
                                                    ) }}
                                                </strong>

                                                above the listed price.

                                            </p>

                                        </div>

                                    @else

                                        <div class="mt-3 rounded-xl border border-blue-200 bg-blue-50 p-3">

                                            <p class="text-xs font-medium text-blue-700">
                                                Your offer matches the listed price.
                                            </p>

                                        </div>

                                    @endif

                                </div>



                                {{-- VIEW PROPERTY --}}

                                <a
                                    href="{{ route(
                                        'property.details',
                                        $transaction->property->slug
                                    ) }}"
                                    class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-300 px-4 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                                >

                                    View Property

                                    <span>
                                        →
                                    </span>

                                </a>

                            </div>

                        </div>

                    </div>



                    {{-- =====================================================
                         TRANSACTION DETAILS
                    ====================================================== --}}

                    <div class="space-y-8 lg:col-span-2">


                        {{-- =================================================
                             REQUEST STATUS
                        ================================================== --}}

                        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                            <h2 class="text-xl font-bold text-gray-900">
                                Request Status
                            </h2>


                            <div class="mt-6">

                                @php

                                    $statusDescription = match ($currentStatus) {

                                        'pending' =>
                                            'Your request has been submitted and is waiting for admin review.',

                                        'approved' =>
                                            'Your request has been approved by the admin. Please complete the deal when you are ready.',

                                        'rejected' =>
                                            'Your request has been rejected by the admin. Please contact us if you need more information.',

                                        'completed' =>
                                            $transaction->type === 'buy'
                                                ? 'Your property purchase has been completed successfully.'
                                                : 'Your property rental has been completed successfully.',

                                        'cancelled' =>
                                            'You cancelled this request. This transaction is no longer active.',

                                        default =>
                                            'Your request is currently being processed.',

                                    };

                                @endphp


                                <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">

                                    <div class="flex items-start gap-4">


                                        {{-- STATUS ICON --}}

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border font-bold {{ $statusClasses }}"
                                        >

                                            @if($currentStatus === 'completed')

                                                ✓

                                            @elseif($currentStatus === 'rejected')

                                                !

                                            @elseif($currentStatus === 'approved')

                                                ✓

                                            @elseif($currentStatus === 'cancelled')

                                                ×

                                            @else

                                                …

                                            @endif

                                        </div>



                                        {{-- STATUS TEXT --}}

                                        <div>

                                            <p class="font-semibold text-gray-900">
                                                {{ ucfirst($transaction->status) }}
                                            </p>

                                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                                {{ $statusDescription }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- =================================================
                             OFFER SUMMARY
                        ================================================== --}}

                        <div class="rounded-2xl border border-purple-200 bg-white p-6 shadow-sm sm:p-8">

                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <h2 class="text-xl font-bold text-gray-900">
                                        Offer Summary
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Details of your submitted property offer.
                                    </p>

                                </div>


                                <span
                                    class="inline-flex w-fit rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700"
                                >
                                    Customer Offer
                                </span>

                            </div>



                            <div class="mt-6 grid gap-5 md:grid-cols-3">


                                {{-- LISTED PRICE --}}

                                <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        Listed Price
                                    </p>

                                    <p class="mt-2 text-xl font-bold text-gray-900">

                                        ₹{{ number_format(
                                            $listedAmount,
                                            2
                                        ) }}

                                    </p>

                                </div>



                                {{-- CUSTOMER OFFER --}}

                                <div class="rounded-xl border border-purple-200 bg-purple-50 p-5">

                                    <p class="text-xs font-semibold uppercase tracking-wide text-purple-600">
                                        Your Offer
                                    </p>

                                    <p class="mt-2 text-xl font-bold text-purple-700">

                                        ₹{{ number_format(
                                            $offerAmount,
                                            2
                                        ) }}

                                    </p>

                                </div>



                                {{-- COUNTER OFFER --}}

                                <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

                                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                                        Counter Offer
                                    </p>

                                    @if($counterOfferAmount !== null)

                                        <p class="mt-2 text-xl font-bold text-blue-700">

                                            ₹{{ number_format(
                                                $counterOfferAmount,
                                                2
                                            ) }}

                                        </p>

                                    @else

                                        <p class="mt-2 text-base font-semibold text-gray-500">
                                            Not offered yet
                                        </p>

                                    @endif

                                </div>



                                {{-- DIFFERENCE --}}

                                <div class="rounded-xl border border-gray-200 bg-gray-50 p-5 md:col-span-3">

                                    <div class="flex items-center justify-between gap-4">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                            Difference
                                        </p>


                                        <p
                                            class="text-xl font-bold
                                            {{ $difference > 0
                                                ? 'text-orange-600'
                                                : ($difference < 0
                                                    ? 'text-green-600'
                                                    : 'text-blue-600') }}"
                                        >

                                            @if($difference > 0)

                                                -₹{{ number_format(
                                                    abs($difference),
                                                    2
                                                ) }}

                                            @elseif($difference < 0)

                                                +₹{{ number_format(
                                                    abs($difference),
                                                    2
                                                ) }}

                                            @else

                                                ₹0.00

                                            @endif

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- =================================================
                             APPLICANT DETAILS
                        ================================================== --}}

                        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                            <h2 class="text-xl font-bold text-gray-900">
                                Applicant Details
                            </h2>


                            <div class="mt-6 grid gap-6 sm:grid-cols-2">


                                {{-- NAME --}}

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        Full Name
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        {{ $transaction->name }}
                                    </p>

                                </div>



                                {{-- EMAIL --}}

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        Email
                                    </p>

                                    <p class="mt-1 break-all text-sm font-medium text-gray-900">
                                        {{ $transaction->email }}
                                    </p>

                                </div>



                                {{-- PHONE --}}

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        Phone
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        {{ $transaction->phone }}
                                    </p>

                                </div>



                                {{-- REQUEST TYPE --}}

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        Request Type
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">

                                        {{ $transaction->type === 'buy'
                                            ? 'Buy Property'
                                            : 'Rent Property' }}

                                    </p>

                                </div>



                                {{-- ADDRESS --}}

                                <div class="sm:col-span-2">

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        Address
                                    </p>

                                    <p class="mt-1 text-sm leading-6 text-gray-900">

                                        {{ $transaction->address ?: 'Not provided' }}

                                    </p>

                                </div>



                                {{-- CITY --}}

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        City
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        {{ $transaction->city ?: 'Not provided' }}
                                    </p>

                                </div>



                                {{-- STATE --}}

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        State
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        {{ $transaction->state ?: 'Not provided' }}
                                    </p>

                                </div>



                                {{-- PINCODE --}}

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        Pincode
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        {{ $transaction->pincode ?: 'Not provided' }}
                                    </p>

                                </div>

                            </div>

                        </div>



                        {{-- =================================================
                             PROPERTY REGISTERED BY
                        ================================================== --}}

                        @if($registeredBy)

                            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                                    <div>

                                        <h2 class="text-xl font-bold text-gray-900">
                                            Property Registered By
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-500">
                                            Details of the account that registered this property.
                                        </p>

                                    </div>


                                    {{-- TYPE BADGE --}}

                                    <span
                                        class="inline-flex w-fit items-center rounded-full px-3 py-1 text-xs font-semibold
                                        {{ $registeredByType === 'Owner'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-blue-100 text-blue-700' }}"
                                    >

                                        {{ $registeredByType }}

                                    </span>

                                </div>



                                {{-- REGISTERED USER DETAILS --}}

                                <div class="mt-6 rounded-xl border border-gray-200 bg-gray-50 p-5">

                                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center">


                                        {{-- AVATAR --}}

                                        <div
                                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full
                                            {{ $registeredByType === 'Owner'
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-blue-100 text-blue-700' }}
                                            text-lg font-bold"
                                        >

                                            {{ strtoupper(
                                                substr(
                                                    $registeredBy->name ?? 'U',
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        </div>



                                        {{-- DETAILS --}}

                                        <div class="min-w-0 flex-1">

                                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                                {{ $registeredByType }}
                                            </p>

                                            <p class="mt-1 text-lg font-bold text-gray-900">
                                                {{ $registeredBy->name ?? 'N/A' }}
                                            </p>



                                            <div class="mt-2 flex flex-col gap-1 text-sm text-gray-500 sm:flex-row sm:flex-wrap sm:gap-x-5">


                                                {{-- EMAIL --}}

                                                @if($registeredBy->email)

                                                    <span class="break-all">
                                                        {{ $registeredBy->email }}
                                                    </span>

                                                @endif



                                                {{-- PHONE --}}

                                                @if($registeredBy->phone)

                                                    <span>
                                                        {{ $registeredBy->phone }}
                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif



                        {{-- =================================================
                             TRANSACTION INFORMATION
                        ================================================== --}}

                        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                            <h2 class="text-xl font-bold text-gray-900">
                                Transaction Information
                            </h2>


                            <div class="mt-6 divide-y divide-gray-100">


                                {{-- REQUEST ID --}}

                                <div class="flex items-center justify-between gap-4 py-4">

                                    <span class="text-sm text-gray-500">
                                        Request ID
                                    </span>

                                    <span class="text-sm font-semibold text-gray-900">
                                        #{{ $transaction->id }}
                                    </span>

                                </div>



                                {{-- PROPERTY --}}

                                <div class="flex items-center justify-between gap-4 py-4">

                                    <span class="text-sm text-gray-500">
                                        Property
                                    </span>

                                    <span class="max-w-xs text-right text-sm font-semibold text-gray-900">

                                        {{ $transaction->property->title }}

                                    </span>

                                </div>



                                {{-- TYPE --}}

                                <div class="flex items-center justify-between gap-4 py-4">

                                    <span class="text-sm text-gray-500">
                                        Type
                                    </span>

                                    <span class="text-sm font-semibold text-gray-900">

                                        {{ ucfirst($transaction->type) }}

                                    </span>

                                </div>



                                {{-- LISTED PRICE --}}

                                <div class="flex items-center justify-between gap-4 py-4">

                                    <span class="text-sm text-gray-500">
                                        Listed Property Price
                                    </span>

                                    <span class="text-sm font-semibold text-gray-900">

                                        ₹{{ number_format(
                                            $listedAmount,
                                            2
                                        ) }}

                                    </span>

                                </div>



                                {{-- CUSTOMER OFFER --}}

                                <div class="flex items-center justify-between gap-4 py-4">

                                    <span class="text-sm font-semibold text-purple-600">
                                        Your Offer Amount
                                    </span>

                                    <span class="text-sm font-bold text-purple-700">

                                        ₹{{ number_format(
                                            $offerAmount,
                                            2
                                        ) }}

                                    </span>

                                </div>



                                {{-- COUNTER OFFER --}}

                                <div class="flex items-center justify-between gap-4 py-4">

                                    <span class="text-sm font-semibold text-blue-600">
                                        Counter Offer Amount
                                    </span>

                                    @if($counterOfferAmount !== null)

                                        <span class="text-sm font-bold text-blue-700">

                                            ₹{{ number_format(
                                                $counterOfferAmount,
                                                2
                                            ) }}

                                        </span>

                                    @else

                                        <span class="text-sm font-medium text-gray-400">
                                            Not offered yet
                                        </span>

                                    @endif

                                </div>



                                {{-- OFFER DIFFERENCE --}}

                                <div class="flex items-center justify-between gap-4 py-4">

                                    <span class="text-sm text-gray-500">
                                        Price Difference
                                    </span>

                                    <span
                                        class="text-sm font-semibold
                                        {{ $difference > 0
                                            ? 'text-orange-600'
                                            : ($difference < 0
                                                ? 'text-green-600'
                                                : 'text-blue-600') }}"
                                    >

                                        @if($difference > 0)

                                            -₹{{ number_format(
                                                abs($difference),
                                                2
                                            ) }}

                                        @elseif($difference < 0)

                                            +₹{{ number_format(
                                                abs($difference),
                                                2
                                            ) }}

                                        @else

                                            ₹0.00

                                        @endif

                                    </span>

                                </div>



                                {{-- SUBMITTED DATE --}}

                                <div class="flex items-center justify-between gap-4 py-4">

                                    <span class="text-sm text-gray-500">
                                        Submitted On
                                    </span>

                                    <span class="text-right text-sm font-semibold text-gray-900">

                                        {{ $transaction->created_at->format(
                                            'd M Y, h:i A'
                                        ) }}

                                    </span>

                                </div>



                                {{-- UPDATED DATE --}}

                                <div class="flex items-center justify-between gap-4 py-4">

                                    <span class="text-sm text-gray-500">
                                        Last Updated
                                    </span>

                                    <span class="text-right text-sm font-semibold text-gray-900">

                                        {{ $transaction->updated_at->format(
                                            'd M Y, h:i A'
                                        ) }}

                                    </span>

                                </div>

                            </div>

                        </div>



                        {{-- =================================================
                             ADMIN NOTE
                        ================================================== --}}

                        @if($transaction->admin_note)

                            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                                <h2 class="text-xl font-bold text-gray-900">
                                    Admin Note
                                </h2>


                                <div class="mt-5 rounded-xl border border-gray-200 bg-gray-50 p-5">

                                    <p class="whitespace-pre-line text-sm leading-6 text-gray-700">

                                        {{ $transaction->admin_note }}

                                    </p>

                                </div>

                            </div>

                        @endif



                        {{-- =================================================
                             ACTIONS
                        ================================================== --}}

                        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                            <h2 class="text-xl font-bold text-gray-900">
                                Actions
                            </h2>


                            <div class="mt-5 flex flex-col gap-3 sm:flex-row">


                                {{-- BACK TO DASHBOARD --}}

                                <a
                                    href="{{ route('user.dashboard') }}"
                                    style="
                                        background-color: #ffffff !important;
                                        color: #374151 !important;
                                        border: 1px solid #d1d5db !important;
                                        display: inline-flex !important;
                                        align-items: center !important;
                                        justify-content: center !important;
                                        text-decoration: none !important;
                                    "
                                    class="gap-2 rounded-xl px-5 py-3 text-sm font-semibold transition hover:bg-gray-50"
                                >

                                    ← Back to Dashboard

                                </a>



                                {{-- EDIT OFFER --}}

                                @if($currentStatus === 'pending')

                                    <a
                                        href="{{ route(
                                            'user.transaction.edit',
                                            $transaction
                                        ) }}"
                                        style="
                                            background-color: #2563eb !important;
                                            color: #ffffff !important;
                                            border: 1px solid #2563eb !important;
                                            display: inline-flex !important;
                                            align-items: center !important;
                                            justify-content: center !important;
                                            text-decoration: none !important;
                                        "
                                        class="gap-2 rounded-xl px-5 py-3 text-sm font-semibold shadow-md transition"
                                        onmouseover="this.style.backgroundColor='#1d4ed8'"
                                        onmouseout="this.style.backgroundColor='#2563eb'"
                                    >

                                        <span
                                            style="
                                                color: #ffffff !important;
                                                font-size: 16px;
                                                line-height: 1;
                                            "
                                        >
                                            ✎
                                        </span>

                                        <span style="color: #ffffff !important;">
                                            Edit Offer
                                        </span>

                                    </a>

                                @endif



                                {{-- CANCEL REQUEST --}}

                                @if($currentStatus === 'pending')

                                    <form
                                        action="{{ route(
                                            'user.transaction.cancel',
                                            $transaction
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to cancel this request?');"
                                    >

                                        @csrf

                                        @method('PATCH')


                                        <button
                                            type="submit"
                                            style="
                                                background-color: #dc2626 !important;
                                                color: #ffffff !important;
                                                border: 1px solid #dc2626 !important;
                                            "
                                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold transition hover:opacity-90 sm:w-auto"
                                        >

                                            <span style="color:#ffffff !important;">
                                                ×
                                            </span>

                                            <span style="color:#ffffff !important;">
                                                Cancel Request
                                            </span>

                                        </button>

                                    </form>

                                @endif



                                {{-- DEAL DONE --}}

                                @if($currentStatus === 'approved')

                                    <form
                                        action="{{ route(
                                            'user.transaction.complete',
                                            $transaction
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to mark this deal as completed? This action cannot be undone.');"
                                    >

                                        @csrf

                                        @method('PATCH')


                                        <button
                                            type="submit"
                                            style="
                                                background-color: #16a34a !important;
                                                color: #ffffff !important;
                                                border: 1px solid #16a34a !important;
                                            "
                                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold shadow-md transition hover:opacity-90 sm:w-auto"
                                        >

                                            <span style="color:#ffffff !important;">
                                                ✓
                                            </span>

                                            <span style="color:#ffffff !important;">
                                                Deal Done
                                            </span>

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection