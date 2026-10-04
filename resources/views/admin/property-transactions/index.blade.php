@extends('admin.layouts.app')

@section('title', 'Property Requests')
@section('page-title', 'Property Requests')

@section('content')

<div class="space-y-6">


{{-- =====================================================
     PAGE HEADER
====================================================== --}}

<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

    <div>

        <h1 class="text-2xl font-bold text-white">
            Property Requests
        </h1>

        <p class="mt-1 text-sm text-gray-400">
            Manage property buy and rent requests submitted by users.
        </p>

    </div>

</div>


{{-- =====================================================
     MAIN STATS
====================================================== --}}

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

    {{-- TOTAL --}}
    <div class="rounded-2xl border border-purple-500/20 bg-gray-900/70 p-5 shadow-xl shadow-purple-900/10">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400">
                    Total Requests
                </p>

                <h2 class="mt-2 text-3xl font-bold text-white">
                    {{ $totalTransactions }}
                </h2>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                <i class="fa-solid fa-file-signature text-xl"></i>

            </div>

        </div>

    </div>


    {{-- PENDING --}}
    <div class="rounded-2xl border border-yellow-500/20 bg-gray-900/70 p-5 shadow-xl shadow-yellow-900/10">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400">
                    Pending
                </p>

                <h2 class="mt-2 text-3xl font-bold text-yellow-400">
                    {{ $pendingTransactions }}
                </h2>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-500/10 text-yellow-400">

                <i class="fa-solid fa-clock text-xl"></i>

            </div>

        </div>

    </div>


    {{-- APPROVED --}}
    <div class="rounded-2xl border border-blue-500/20 bg-gray-900/70 p-5 shadow-xl shadow-blue-900/10">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400">
                    Approved
                </p>

                <h2 class="mt-2 text-3xl font-bold text-blue-400">
                    {{ $approvedTransactions }}
                </h2>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                <i class="fa-solid fa-circle-check text-xl"></i>

            </div>

        </div>

    </div>


    {{-- COMPLETED --}}
    <div class="rounded-2xl border border-emerald-500/20 bg-gray-900/70 p-5 shadow-xl shadow-emerald-900/10">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400">
                    Completed
                </p>

                <h2 class="mt-2 text-3xl font-bold text-emerald-400">
                    {{ $completedTransactions }}
                </h2>

            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">

                <i class="fa-solid fa-check-double text-xl"></i>

            </div>

        </div>

    </div>

</div>


{{-- =====================================================
     SECONDARY STATS
====================================================== --}}

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

    {{-- REJECTED --}}
    <div class="rounded-2xl border border-red-500/20 bg-gray-900/70 p-5 shadow-xl shadow-red-900/10">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400">
                    Rejected Requests
                </p>

                <h2 class="mt-2 text-2xl font-bold text-red-400">
                    {{ $rejectedTransactions }}
                </h2>

            </div>

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-500/10 text-red-400">

                <i class="fa-solid fa-circle-xmark text-lg"></i>

            </div>

        </div>

    </div>


    {{-- CANCELLED --}}
    <div class="rounded-2xl border border-gray-500/20 bg-gray-900/70 p-5 shadow-xl shadow-gray-900/10">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400">
                    Cancelled Requests
                </p>

                <h2 class="mt-2 text-2xl font-bold text-gray-300">
                    {{ $cancelledTransactions }}
                </h2>

            </div>

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-500/10 text-gray-400">

                <i class="fa-solid fa-ban text-lg"></i>

            </div>

        </div>

    </div>


    {{-- BUY --}}
    <div class="rounded-2xl border border-orange-500/20 bg-gray-900/70 p-5 shadow-xl shadow-orange-900/10">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400">
                    Buy Requests
                </p>

                <h2 class="mt-2 text-2xl font-bold text-orange-400">
                    {{ $buyTransactions }}
                </h2>

            </div>

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400">

                <i class="fa-solid fa-house text-lg"></i>

            </div>

        </div>

    </div>


    {{-- RENT --}}
    <div class="rounded-2xl border border-cyan-500/20 bg-gray-900/70 p-5 shadow-xl shadow-cyan-900/10">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400">
                    Rent Requests
                </p>

                <h2 class="mt-2 text-2xl font-bold text-cyan-400">
                    {{ $rentTransactions }}
                </h2>

            </div>

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-500/10 text-cyan-400">

                <i class="fa-solid fa-key text-lg"></i>

            </div>

        </div>

    </div>

</div>


{{-- =====================================================
     FILTERS
====================================================== --}}

<div class="rounded-2xl border border-gray-800 bg-gray-900/70 p-5 shadow-xl">

    <div class="mb-5">

        <h2 class="text-lg font-semibold text-white">
            Search & Filter
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Find requests by applicant, property, type or status.
        </p>

    </div>


    <form
        action="{{ route('admin.property-transactions.index') }}"
        method="GET"
        class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4"
    >

        {{-- SEARCH --}}
        <div class="lg:col-span-2">

            <label class="mb-2 block text-sm font-medium text-gray-300">
                Search
            </label>

            <div class="relative">

                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Name, email, phone or property..."
                    class="w-full rounded-xl border border-gray-700 bg-gray-950 py-3 pl-11 pr-4 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
                >

            </div>

        </div>


        {{-- TYPE --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-gray-300">
                Transaction Type
            </label>

            <select
                name="type"
                class="w-full rounded-xl border border-gray-700 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
            >

                <option value="">
                    All Types
                </option>

                <option
                    value="buy"
                    {{ request('type') === 'buy' ? 'selected' : '' }}
                >
                    Buy
                </option>

                <option
                    value="rent"
                    {{ request('type') === 'rent' ? 'selected' : '' }}
                >
                    Rent
                </option>

            </select>

        </div>


        {{-- STATUS --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-gray-300">
                Status
            </label>

            <select
                name="status"
                class="w-full rounded-xl border border-gray-700 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20"
            >

                <option value="">
                    All Status
                </option>

                <option
                    value="pending"
                    {{ request('status') === 'pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="approved"
                    {{ request('status') === 'approved' ? 'selected' : '' }}
                >
                    Approved
                </option>

                <option
                    value="rejected"
                    {{ request('status') === 'rejected' ? 'selected' : '' }}
                >
                    Rejected
                </option>

                <option
                    value="completed"
                    {{ request('status') === 'completed' ? 'selected' : '' }}
                >
                    Completed
                </option>

                <option
                    value="cancelled"
                    {{ request('status') === 'cancelled' ? 'selected' : '' }}
                >
                    Cancelled
                </option>

            </select>

        </div>


        {{-- BUTTONS --}}
        <div class="flex flex-col gap-2 sm:flex-row lg:col-span-4">

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-fuchsia-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-900/20 transition hover:from-purple-500 hover:to-fuchsia-500"
            >

                <i class="fa-solid fa-filter"></i>

                Apply Filters

            </button>


            <a
                href="{{ route('admin.property-transactions.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-700 bg-gray-800 px-5 py-3 text-sm font-semibold text-gray-300 transition hover:bg-gray-700 hover:text-white"
            >

                <i class="fa-solid fa-rotate-left"></i>

                Reset

            </a>

        </div>

    </form>

</div>


{{-- =====================================================
     TRANSACTIONS TABLE
====================================================== --}}

<div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-900/70 shadow-xl">


    {{-- TABLE HEADER --}}

    <div class="flex flex-col gap-3 border-b border-gray-800 px-5 py-5 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-lg font-semibold text-white">
                Property Requests
            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Showing
                {{ $transactions->firstItem() ?? 0 }}

                -

                {{ $transactions->lastItem() ?? 0 }}

                of
                {{ $transactions->total() }}

                requests

            </p>

        </div>

    </div>


    {{-- =================================================
         DESKTOP TABLE
    ================================================== --}}

    <div class="hidden overflow-x-auto lg:block">

        <table class="w-full text-left">

            <thead class="border-b border-gray-800 bg-gray-950/60">

                <tr>

                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Request
                    </th>

                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Property
                    </th>

                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Applicant
                    </th>

                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Type
                    </th>

                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Listed Price
                    </th>

                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Customer Offer
                    </th>

                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Counter Offer
                    </th>

                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Status
                    </th>

                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Date
                    </th>

                    <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Action
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-800">

                @forelse($transactions as $transaction)

                    <tr class="transition hover:bg-gray-800/40">


                        {{-- REQUEST --}}

                        <td class="whitespace-nowrap px-5 py-4">

                            <div class="font-semibold text-white">
                                #{{ $transaction->id }}
                            </div>

                            <div class="mt-1 text-xs text-gray-500">
                                {{ $transaction->created_at->format('d M Y') }}
                            </div>

                        </td>


                        {{-- PROPERTY WITH PHOTO --}}

                        <td class="min-w-[340px] px-5 py-4">

                            @if($transaction->property)

                                @php
                                    $property = $transaction->property;

                                    $photos = is_array($property->photos)
                                        ? $property->photos
                                        : json_decode($property->photos ?? '[]', true);

                                    $firstPhoto = is_array($photos)
                                        ? ($photos[0] ?? null)
                                        : null;
                                @endphp

                                <div class="flex items-start gap-3">

                                    {{-- PHOTO --}}

                                    <div class="h-16 w-20 shrink-0 overflow-hidden rounded-xl border border-gray-700 bg-gray-950 shadow-lg">

                                        @if($firstPhoto)

                                            <img
                                                src="{{ asset('storage/' . $firstPhoto) }}"
                                                alt="{{ $property->title }}"
                                                class="h-full w-full object-cover"
                                                loading="lazy"
                                            >

                                        @else

                                            <div class="flex h-full w-full items-center justify-center text-gray-600">

                                                <i class="fa-solid fa-house text-xl"></i>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- PROPERTY INFO --}}

                                    <div class="min-w-0">

                                        <div class="font-semibold text-white">
                                            {{ $property->title }}
                                        </div>

                                        @if($property->address)

                                            <div class="mt-1 flex max-w-[230px] items-center gap-1.5 truncate text-xs text-gray-500">

                                                <i class="fa-solid fa-location-dot shrink-0 text-purple-400"></i>

                                                <span class="truncate">
                                                    {{ $property->address }}
                                                </span>

                                            </div>

                                        @endif


                                        {{-- OWNER DETAILS --}}

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

                            @else

                                <div class="flex items-center gap-3">

                                    <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-xl border border-red-500/20 bg-red-500/5 text-red-400">

                                        <i class="fa-solid fa-house-circle-xmark text-xl"></i>

                                    </div>

                                    <span class="text-sm text-red-400">
                                        Property Deleted
                                    </span>

                                </div>

                            @endif

                        </td>


                        {{-- APPLICANT --}}

                        <td class="min-w-[190px] px-5 py-4">

                            <div class="font-medium text-white">
                                {{ $transaction->name }}
                            </div>

                            <div class="mt-1 text-xs text-gray-500">
                                {{ $transaction->email }}
                            </div>

                            <div class="mt-1 text-xs text-gray-500">
                                {{ $transaction->phone }}
                            </div>

                        </td>


                        {{-- TYPE --}}

                        <td class="px-5 py-4">

                            @if($transaction->type === 'buy')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-500/10 px-3 py-1.5 text-xs font-semibold text-orange-400">

                                    <i class="fa-solid fa-house"></i>

                                    Buy

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-cyan-500/10 px-3 py-1.5 text-xs font-semibold text-cyan-400">

                                    <i class="fa-solid fa-key"></i>

                                    Rent

                                </span>

                            @endif

                        </td>


                        {{-- LISTED PRICE --}}

                        <td class="whitespace-nowrap px-5 py-4">

                            <span class="font-semibold text-white">

                                ₹{{ number_format((float) $transaction->amount, 2) }}

                            </span>

                        </td>


                        {{-- CUSTOMER OFFER --}}

                        <td class="whitespace-nowrap px-5 py-4">

                            @if($transaction->offer_amount !== null)

                                <span class="font-semibold text-purple-400">

                                    ₹{{ number_format((float) $transaction->offer_amount, 2) }}

                                </span>

                            @else

                                <span class="text-sm text-gray-500">
                                    Not offered
                                </span>

                            @endif

                        </td>


                        {{-- COUNTER OFFER --}}

                        <td class="whitespace-nowrap px-5 py-4">

                            @if($transaction->counter_offer_amount !== null)

                                <span class="font-semibold text-amber-400">

                                    ₹{{ number_format((float) $transaction->counter_offer_amount, 2) }}

                                </span>

                            @else

                                <span class="text-sm text-gray-500">
                                    Not offered
                                </span>

                            @endif

                        </td>


                        {{-- STATUS --}}

                        <td class="px-5 py-4">

                            @if($transaction->status === 'pending')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-500/10 px-3 py-1.5 text-xs font-semibold text-yellow-400">

                                    <span class="h-1.5 w-1.5 rounded-full bg-yellow-400"></span>

                                    Pending

                                </span>


                            @elseif($transaction->status === 'approved')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-500/10 px-3 py-1.5 text-xs font-semibold text-blue-400">

                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-400"></span>

                                    Approved

                                </span>


                            @elseif($transaction->status === 'completed')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1.5 text-xs font-semibold text-emerald-400">

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                    Completed

                                </span>


                            @elseif($transaction->status === 'rejected')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-500/10 px-3 py-1.5 text-xs font-semibold text-red-400">

                                    <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                    Rejected

                                </span>


                            @elseif($transaction->status === 'cancelled')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-500/10 px-3 py-1.5 text-xs font-semibold text-gray-300">

                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                    Cancelled

                                </span>


                            @else

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-500/10 px-3 py-1.5 text-xs font-semibold text-gray-400">

                                    {{ ucfirst($transaction->status) }}

                                </span>

                            @endif

                        </td>


                        {{-- DATE --}}

                        <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-400">

                            {{ $transaction->created_at->format('d M Y') }}

                            <div class="mt-1 text-xs text-gray-600">

                                {{ $transaction->created_at->format('h:i A') }}

                            </div>

                        </td>


                        {{-- ACTION --}}

                        <td class="px-5 py-4 text-right">

                            <a
                                href="{{ route('admin.property-transactions.show', $transaction) }}"
                                class="inline-flex items-center gap-2 rounded-lg border border-indigo-500/30 bg-indigo-500/10 px-3 py-2 text-xs font-semibold text-indigo-400 transition hover:bg-indigo-500/20 hover:text-indigo-300"
                            >

                                <i class="fa-solid fa-eye"></i>

                                View

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="10"
                            class="px-5 py-16 text-center"
                        >

                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-800 text-gray-500">

                                <i class="fa-solid fa-file-circle-xmark text-2xl"></i>

                            </div>

                            <h3 class="mt-4 text-lg font-semibold text-white">
                                No property requests found
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Try changing your search or filter criteria.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- =================================================
         MOBILE / TABLET CARDS
    ================================================== --}}

    <div class="divide-y divide-gray-800 lg:hidden">

        @forelse($transactions as $transaction)

            <div class="p-5">


                <div class="flex items-start justify-between gap-4">

                    <div>

                        <div class="text-sm font-bold text-white">
                            Request #{{ $transaction->id }}
                        </div>

                        <div class="mt-1 text-xs text-gray-500">
                            {{ $transaction->created_at->format('d M Y, h:i A') }}
                        </div>

                    </div>


                    {{-- STATUS --}}

                    @if($transaction->status === 'pending')

                        <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-400">
                            Pending
                        </span>

                    @elseif($transaction->status === 'approved')

                        <span class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-400">
                            Approved
                        </span>

                    @elseif($transaction->status === 'completed')

                        <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-400">
                            Completed
                        </span>

                    @elseif($transaction->status === 'rejected')

                        <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-400">
                            Rejected
                        </span>

                    @elseif($transaction->status === 'cancelled')

                        <span class="rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold text-gray-300">
                            Cancelled
                        </span>

                    @endif

                </div>


                {{-- =================================================
                     PROPERTY WITH PHOTO
                ================================================== --}}

                <div class="mt-5">

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Property
                    </p>

                    @if($transaction->property)

                        @php
                            $property = $transaction->property;

                            $photos = is_array($property->photos)
                                ? $property->photos
                                : json_decode($property->photos ?? '[]', true);

                            $firstPhoto = is_array($photos)
                                ? ($photos[0] ?? null)
                                : null;
                        @endphp

                        <div class="mt-2 flex items-start gap-3">

                            {{-- PHOTO --}}

                            <div class="h-20 w-24 shrink-0 overflow-hidden rounded-xl border border-gray-700 bg-gray-950 shadow-lg">

                                @if($firstPhoto)

                                    <img
                                        src="{{ asset('storage/' . $firstPhoto) }}"
                                        alt="{{ $property->title }}"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="flex h-full w-full items-center justify-center text-gray-600">

                                        <i class="fa-solid fa-house text-xl"></i>

                                    </div>

                                @endif

                            </div>


                            {{-- PROPERTY INFO --}}

                            <div class="min-w-0">

                                <p class="font-semibold text-white">

                                    {{ $property->title }}

                                </p>

                                @if($property->address)

                                    <p class="mt-1 flex items-start gap-1.5 text-xs text-gray-500">

                                        <i class="fa-solid fa-location-dot mt-0.5 shrink-0 text-purple-400"></i>

                                        <span class="line-clamp-2">
                                            {{ $property->address }}
                                        </span>

                                    </p>

                                @endif

                            </div>

                        </div>


                        {{-- =================================================
                             OWNER DETAILS
                        ================================================== --}}

                        @if($property->owner)

                            <div class="mt-4 rounded-xl border border-purple-500/20 bg-purple-500/5 p-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-purple-500/10 text-purple-400">

                                        <i class="fa-solid fa-user"></i>

                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <div class="flex flex-wrap items-center gap-2">

                                            <p class="text-sm font-semibold text-white">
                                                {{ $property->owner->name }}
                                            </p>

                                            <span class="rounded-full bg-emerald-500/10 px-2 py-0.5 text-[10px] font-semibold text-emerald-400">
                                                Registered Owner
                                            </span>

                                        </div>

                                        @if($property->owner->email)

                                            <p class="mt-1 flex items-center gap-1.5 text-xs text-gray-500">

                                                <i class="fa-solid fa-envelope text-purple-400"></i>

                                                {{ $property->owner->email }}

                                            </p>

                                        @endif

                                        @if($property->owner->phone)

                                            <p class="mt-1 flex items-center gap-1.5 text-xs text-gray-500">

                                                <i class="fa-solid fa-phone text-purple-400"></i>

                                                {{ $property->owner->phone }}

                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @endif

                    @else

                        <div class="mt-2 flex items-center gap-3">

                            <div class="flex h-20 w-24 shrink-0 items-center justify-center rounded-xl border border-red-500/20 bg-red-500/5 text-red-400">

                                <i class="fa-solid fa-house-circle-xmark text-xl"></i>

                            </div>

                            <p class="text-sm text-red-400">
                                Property Deleted
                            </p>

                        </div>

                    @endif

                </div>


                {{-- APPLICANT --}}

                <div class="mt-4">

                    <p class="text-xs uppercase tracking-wider text-gray-600">
                        Applicant
                    </p>

                    <p class="mt-1 font-medium text-gray-200">
                        {{ $transaction->name }}
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $transaction->email }}
                    </p>

                    @if($transaction->phone)

                        <p class="mt-1 text-sm text-gray-500">
                            {{ $transaction->phone }}
                        </p>

                    @endif

                </div>


                {{-- TYPE --}}

                <div class="mt-4">

                    @if($transaction->type === 'buy')

                        <span class="rounded-full bg-orange-500/10 px-3 py-1 text-xs font-semibold text-orange-400">

                            <i class="fa-solid fa-house mr-1"></i>

                            Buy

                        </span>

                    @else

                        <span class="rounded-full bg-cyan-500/10 px-3 py-1 text-xs font-semibold text-cyan-400">

                            <i class="fa-solid fa-key mr-1"></i>

                            Rent

                        </span>

                    @endif

                </div>


                {{-- =================================================
                     MOBILE PRICE DETAILS
                ================================================== --}}

                <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3">

                    {{-- LISTED PRICE --}}

                    <div class="rounded-xl border border-gray-800 bg-gray-950/60 p-3">

                        <p class="text-xs text-gray-500">
                            Listed Price
                        </p>

                        <p class="mt-1 font-bold text-white">
                            ₹{{ number_format((float) $transaction->amount, 2) }}
                        </p>

                    </div>


                    {{-- CUSTOMER OFFER --}}

                    <div class="rounded-xl border border-purple-500/20 bg-purple-500/5 p-3">

                        <p class="text-xs text-gray-500">
                            Customer Offer
                        </p>

                        @if($transaction->offer_amount !== null)

                            <p class="mt-1 font-bold text-purple-400">
                                ₹{{ number_format((float) $transaction->offer_amount, 2) }}
                            </p>

                        @else

                            <p class="mt-1 text-sm font-medium text-gray-500">
                                Not offered
                            </p>

                        @endif

                    </div>


                    {{-- COUNTER OFFER --}}

                    <div class="rounded-xl border border-amber-500/20 bg-amber-500/5 p-3">

                        <p class="text-xs text-gray-500">
                            Counter Offer
                        </p>

                        @if($transaction->counter_offer_amount !== null)

                            <p class="mt-1 font-bold text-amber-400">
                                ₹{{ number_format((float) $transaction->counter_offer_amount, 2) }}
                            </p>

                        @else

                            <p class="mt-1 text-sm font-medium text-gray-500">
                                Not offered
                            </p>

                        @endif

                    </div>

                </div>


                {{-- ACTION --}}

                <div class="mt-5">

                    <a
                        href="{{ route('admin.property-transactions.show', $transaction) }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-500/10 px-4 py-3 text-sm font-semibold text-indigo-400 transition hover:bg-indigo-500/20"
                    >

                        <i class="fa-solid fa-eye"></i>

                        View Request

                    </a>

                </div>

            </div>

        @empty

            <div class="px-5 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-800 text-gray-500">

                    <i class="fa-solid fa-file-circle-xmark text-2xl"></i>

                </div>

                <h3 class="mt-4 text-lg font-semibold text-white">
                    No property requests found
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    No requests match your current filters.
                </p>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}

    @if($transactions->hasPages())

        <div class="border-t border-gray-800 px-5 py-5">

            {{ $transactions->links() }}

        </div>

    @endif

</div>


</div>

@endsection