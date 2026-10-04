@extends('agent.layouts.app')

@section('title', 'Property Requests')

@section('page-title', 'Property Requests')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div class="flex items-center gap-4">

            <div
                class="flex h-14 w-14 shrink-0 items-center justify-center
                rounded-2xl
                bg-gradient-to-br from-indigo-500 to-violet-600
                text-white
                shadow-lg shadow-indigo-900/30"
            >
                <i class="fa-solid fa-file-signature text-xl"></i>
            </div>

            <div>
                <h2 class="text-2xl font-bold tracking-tight text-white">
                    Property Requests
                </h2>

                <p class="mt-1 text-sm text-gray-400">
                    Manage purchase and rental requests for your properties.
                </p>
            </div>

        </div>

    </div>


    {{-- =========================================================
         STAT CARDS
    ========================================================== --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- TOTAL --}}
        <div
            class="group relative overflow-hidden rounded-2xl
            border border-purple-500/20
            bg-slate-900/80 p-5
            shadow-xl shadow-black/10
            backdrop-blur-xl
            transition duration-300
            hover:-translate-y-1
            hover:border-purple-500/40"
        >

            <div
                class="absolute -right-8 -top-8 h-24 w-24
                rounded-full bg-purple-500/10 blur-2xl"
            ></div>

            <div class="relative flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-400">
                        Total Requests
                    </p>

                    <p class="mt-2 text-3xl font-bold text-white">
                        {{ $totalTransactions }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center
                    rounded-xl bg-purple-500/10
                    text-purple-400
                    transition group-hover:bg-purple-500/20"
                >
                    <i class="fa-solid fa-layer-group text-lg"></i>
                </div>

            </div>

        </div>


        {{-- PENDING --}}
        <div
            class="group relative overflow-hidden rounded-2xl
            border border-amber-500/20
            bg-slate-900/80 p-5
            shadow-xl shadow-black/10
            backdrop-blur-xl
            transition duration-300
            hover:-translate-y-1
            hover:border-amber-500/40"
        >

            <div
                class="absolute -right-8 -top-8 h-24 w-24
                rounded-full bg-amber-500/10 blur-2xl"
            ></div>

            <div class="relative flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-400">
                        Pending
                    </p>

                    <p class="mt-2 text-3xl font-bold text-amber-400">
                        {{ $pendingTransactions }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center
                    rounded-xl bg-amber-500/10
                    text-amber-400
                    transition group-hover:bg-amber-500/20"
                >
                    <i class="fa-solid fa-clock text-lg"></i>
                </div>

            </div>

        </div>


        {{-- APPROVED --}}
        <div
            class="group relative overflow-hidden rounded-2xl
            border border-emerald-500/20
            bg-slate-900/80 p-5
            shadow-xl shadow-black/10
            backdrop-blur-xl
            transition duration-300
            hover:-translate-y-1
            hover:border-emerald-500/40"
        >

            <div
                class="absolute -right-8 -top-8 h-24 w-24
                rounded-full bg-emerald-500/10 blur-2xl"
            ></div>

            <div class="relative flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-400">
                        Approved
                    </p>

                    <p class="mt-2 text-3xl font-bold text-emerald-400">
                        {{ $approvedTransactions }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center
                    rounded-xl bg-emerald-500/10
                    text-emerald-400
                    transition group-hover:bg-emerald-500/20"
                >
                    <i class="fa-solid fa-circle-check text-lg"></i>
                </div>

            </div>

        </div>


        {{-- COMPLETED --}}
        <div
            class="group relative overflow-hidden rounded-2xl
            border border-cyan-500/20
            bg-slate-900/80 p-5
            shadow-xl shadow-black/10
            backdrop-blur-xl
            transition duration-300
            hover:-translate-y-1
            hover:border-cyan-500/40"
        >

            <div
                class="absolute -right-8 -top-8 h-24 w-24
                rounded-full bg-cyan-500/10 blur-2xl"
            ></div>

            <div class="relative flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-400">
                        Completed
                    </p>

                    <p class="mt-2 text-3xl font-bold text-cyan-400">
                        {{ $completedTransactions }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center
                    rounded-xl bg-cyan-500/10
                    text-cyan-400
                    transition group-hover:bg-cyan-500/20"
                >
                    <i class="fa-solid fa-handshake text-lg"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTER BAR
    ========================================================== --}}

    <div
        class="rounded-2xl
        border border-purple-500/20
        bg-slate-900/80
        p-5
        shadow-xl shadow-black/10
        backdrop-blur-xl"
    >

        <form
            action="{{ route('agent.property-transactions.index') }}"
            method="GET"
        >

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">

                {{-- SEARCH --}}
                <div class="lg:col-span-6">

                    <label
                        class="mb-2 block text-xs font-semibold
                        uppercase tracking-wider text-gray-500"
                    >
                        Search Requests
                    </label>

                    <div class="relative">

                        <i
                            class="fa-solid fa-magnifying-glass
                            pointer-events-none absolute left-4 top-1/2
                            -translate-y-1/2 text-gray-500"
                        ></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Property, customer, email or phone..."
                            class="w-full rounded-xl
                            border border-purple-500/20
                            bg-slate-950/70
                            py-3 pl-11 pr-4
                            text-sm text-white
                            placeholder:text-gray-600
                            outline-none
                            transition
                            focus:border-purple-500/50
                            focus:ring-2 focus:ring-purple-500/10"
                        >

                    </div>

                </div>


                {{-- TYPE --}}
                <div class="lg:col-span-2">

                    <label
                        class="mb-2 block text-xs font-semibold
                        uppercase tracking-wider text-gray-500"
                    >
                        Type
                    </label>

                    <select
                        name="type"
                        class="w-full rounded-xl
                        border border-purple-500/20
                        bg-slate-950/70
                        px-4 py-3
                        text-sm text-white
                        outline-none
                        focus:border-purple-500/50"
                    >

                        <option value="">All Types</option>

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
                <div class="lg:col-span-2">

                    <label
                        class="mb-2 block text-xs font-semibold
                        uppercase tracking-wider text-gray-500"
                    >
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-xl
                        border border-purple-500/20
                        bg-slate-950/70
                        px-4 py-3
                        text-sm text-white
                        outline-none
                        focus:border-purple-500/50"
                    >

                        <option value="">All Status</option>

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
                <div class="flex items-end gap-2 lg:col-span-2">

                    <button
                        type="submit"
                        class="flex flex-1 items-center justify-center gap-2
                        rounded-xl
                        bg-gradient-to-r from-indigo-500 to-violet-600
                        px-4 py-3
                        text-sm font-semibold text-white
                        shadow-lg shadow-indigo-900/20
                        transition
                        hover:from-indigo-400
                        hover:to-violet-500"
                    >
                        <i class="fa-solid fa-filter"></i>
                        Filter
                    </button>

                    @if(request()->hasAny(['search', 'type', 'status']))

                        <a
                            href="{{ route('agent.property-transactions.index') }}"
                            class="flex h-11 w-11 shrink-0 items-center
                            justify-center rounded-xl
                            border border-gray-700
                            bg-slate-800
                            text-gray-400
                            transition
                            hover:bg-slate-700
                            hover:text-white"
                            title="Reset Filters"
                        >
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
         REQUESTS TABLE
    ========================================================== --}}

    <div
        class="overflow-hidden rounded-2xl
        border border-purple-500/20
        bg-slate-900/80
        shadow-xl shadow-black/10
        backdrop-blur-xl"
    >

        {{-- TABLE HEADER --}}
        <div
            class="flex flex-col gap-3
            border-b border-purple-500/10
            px-5 py-5
            sm:flex-row sm:items-center sm:justify-between"
        >

            <div>

                <h3 class="text-base font-semibold text-white">
                    Property Requests
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Showing
                    <span class="font-medium text-gray-300">
                        {{ $transactions->firstItem() ?? 0 }}
                    </span>
                    -
                    <span class="font-medium text-gray-300">
                        {{ $transactions->lastItem() ?? 0 }}
                    </span>
                    of
                    <span class="font-medium text-gray-300">
                        {{ $transactions->total() }}
                    </span>
                    requests
                </p>

            </div>

            <div
                class="inline-flex w-fit items-center gap-2
                rounded-full
                border border-emerald-500/20
                bg-emerald-500/10
                px-3 py-1.5
                text-xs font-medium text-emerald-400"
            >
                <i class="fa-solid fa-shield-halved"></i>
                Your Properties Only
            </div>

        </div>


        {{-- =====================================================
             DESKTOP TABLE
        ====================================================== --}}

        <div class="hidden overflow-x-auto xl:block">

            <table class="min-w-[1450px] w-full">

                <thead>

                    <tr
                        class="border-b border-purple-500/10
                        bg-slate-950/40"
                    >

                        <th
                            class="w-16 px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Request
                        </th>

                        <th
                            class="min-w-[280px] px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Request / Property
                        </th>

                        {{-- OWNER --}}
                        <th
                            class="min-w-[230px] px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Owner
                        </th>

                        <th
                            class="min-w-[220px] px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Applicant
                        </th>

                        <th
                            class="px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Type
                        </th>

                        <th
                            class="px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Listed Price
                        </th>

                        <th
                            class="px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Customer Offer
                        </th>

                        <th
                            class="px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Counter Offer
                        </th>

                        <th
                            class="px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Status
                        </th>

                        <th
                            class="px-5 py-4 text-left
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Date
                        </th>

                        <th
                            class="px-5 py-4 text-right
                            text-[11px] font-bold uppercase
                            tracking-wider text-gray-500"
                        >
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-purple-500/10">

                    @forelse($transactions as $transaction)

                        @php

                            $property = $transaction->property;

                            $owner = $property?->owner;

                            $customerName =
                                $transaction->name
                                ?? $transaction->user?->name
                                ?? 'Unknown Customer';

                            $customerEmail =
                                $transaction->email
                                ?? $transaction->user?->email
                                ?? 'No email';

                            $customerPhone =
                                $transaction->phone
                                ?? $transaction->user?->phone
                                ?? null;

                            $statusClasses = match($transaction->status) {

                                'pending' =>
                                    'border-amber-500/20 bg-amber-500/10 text-amber-400',

                                'approved' =>
                                    'border-emerald-500/20 bg-emerald-500/10 text-emerald-400',

                                'rejected' =>
                                    'border-red-500/20 bg-red-500/10 text-red-400',

                                'completed' =>
                                    'border-cyan-500/20 bg-cyan-500/10 text-cyan-400',

                                'cancelled' =>
                                    'border-gray-500/20 bg-gray-500/10 text-gray-400',

                                default =>
                                    'border-gray-500/20 bg-gray-500/10 text-gray-400',
                            };

                            $statusIcon = match($transaction->status) {

                                'pending' => 'fa-clock',

                                'approved' => 'fa-circle-check',

                                'rejected' => 'fa-circle-xmark',

                                'completed' => 'fa-handshake',

                                'cancelled' => 'fa-ban',

                                default => 'fa-circle-question',
                            };

                        @endphp


                        <tr
                            class="group transition
                            hover:bg-indigo-500/[0.035]"
                        >

                            {{-- NUMBER --}}
                            <td class="px-5 py-5 align-top">

                                <span
                                    class="inline-flex h-8 w-8 items-center
                                    justify-center rounded-lg
                                    bg-slate-800
                                    text-xs font-bold text-gray-400
                                    group-hover:bg-indigo-500/10
                                    group-hover:text-indigo-400"
                                >
                                    {{ $transaction->id }}
                                </span>

                            </td>


                            {{-- PROPERTY --}}
                            <td class="px-5 py-5 align-top">

                                <div class="flex gap-3">

                                    {{-- PROPERTY IMAGE --}}
                                    <div
                                        class="flex h-12 w-12 shrink-0
                                        items-center justify-center
                                        overflow-hidden rounded-xl
                                        border border-purple-500/20
                                        bg-slate-800"
                                    >

                                        @if($property && !empty($property->photos))

                                            @php

                                                $photos = is_array($property->photos)
                                                    ? $property->photos
                                                    : json_decode($property->photos, true);

                                                $firstPhoto = is_array($photos)
                                                    ? ($photos[0] ?? null)
                                                    : null;

                                            @endphp

                                            @if($firstPhoto)

                                                <img
                                                    src="{{ asset('storage/' . $firstPhoto) }}"
                                                    alt="{{ $property->title }}"
                                                    class="h-full w-full object-cover"
                                                >

                                            @else

                                                <i class="fa-solid fa-building text-indigo-400"></i>

                                            @endif

                                        @else

                                            <i class="fa-solid fa-building text-indigo-400"></i>

                                        @endif

                                    </div>


                                    <div class="min-w-0">

                                        <p
                                            class="max-w-[230px] truncate
                                            text-sm font-bold text-white"
                                        >
                                            {{ $property?->title ?? 'Property Unavailable' }}
                                        </p>

                                        <p
                                            class="mt-1 max-w-[250px]
                                            text-xs leading-5 text-gray-500"
                                        >
                                            <i
                                                class="fa-solid fa-location-dot
                                                mr-1 text-indigo-400"
                                            ></i>

                                            {{ $property?->address
                                                ?? $property?->location?->name
                                                ?? 'Location unavailable' }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                 OWNER DETAILS
                            ================================================== --}}

                            <td class="px-5 py-5 align-top">

                                @if($owner)

                                    <div class="min-w-[200px]">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-10 w-10 shrink-0
                                                items-center justify-center
                                                rounded-full
                                                bg-purple-500/10
                                                text-purple-400"
                                            >
                                                <i class="fa-solid fa-user-tie"></i>
                                            </div>

                                            <div class="min-w-0">

                                                <p
                                                    class="max-w-[170px] truncate
                                                    text-sm font-semibold text-white"
                                                >
                                                    {{ $owner->name }}
                                                </p>

                                                <p class="mt-0.5 text-[10px] text-purple-400">
                                                    Property Owner
                                                </p>

                                            </div>

                                        </div>


                                        @if(!empty($owner->email))

                                            <div
                                                class="mt-3 flex items-center gap-2
                                                text-xs text-gray-400"
                                            >

                                                <i
                                                    class="fa-solid fa-envelope
                                                    w-4 text-gray-500"
                                                ></i>

                                                <span class="max-w-[180px] truncate">
                                                    {{ $owner->email }}
                                                </span>

                                            </div>

                                        @endif


                                        @if(!empty($owner->phone))

                                            <div
                                                class="mt-1 flex items-center gap-2
                                                text-xs text-gray-400"
                                            >

                                                <i
                                                    class="fa-solid fa-phone
                                                    w-4 text-gray-500"
                                                ></i>

                                                <span>
                                                    {{ $owner->phone }}
                                                </span>

                                            </div>

                                        @endif

                                    </div>

                                @else

                                    <div class="flex items-center gap-2">

                                        <span
                                            class="flex h-9 w-9 items-center
                                            justify-center rounded-lg
                                            bg-gray-500/10
                                            text-gray-500"
                                        >
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


                            {{-- APPLICANT --}}
                            <td class="px-5 py-5 align-top">

                                <div class="flex gap-3">

                                    <div
                                        class="flex h-10 w-10 shrink-0
                                        items-center justify-center
                                        rounded-full
                                        bg-gradient-to-br
                                        from-purple-500 to-fuchsia-600
                                        text-sm font-bold uppercase
                                        text-white"
                                    >
                                        {{ strtoupper(substr($customerName, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p
                                            class="max-w-[170px] truncate
                                            text-sm font-semibold text-white"
                                        >
                                            {{ $customerName }}
                                        </p>

                                        <p
                                            class="mt-1 max-w-[190px] truncate
                                            text-xs text-gray-500"
                                        >
                                            {{ $customerEmail }}
                                        </p>

                                        @if($customerPhone)

                                            <p
                                                class="mt-1 text-xs text-gray-600"
                                            >
                                                <i class="fa-solid fa-phone mr-1"></i>
                                                {{ $customerPhone }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- TYPE --}}
                            <td class="px-5 py-5 align-top">

                                @if($transaction->type === 'buy')

                                    <span
                                        class="inline-flex items-center gap-2
                                        rounded-full
                                        border border-blue-500/20
                                        bg-blue-500/10
                                        px-3 py-1.5
                                        text-xs font-bold text-blue-400"
                                    >
                                        <i class="fa-solid fa-house"></i>
                                        Buy
                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-2
                                        rounded-full
                                        border border-pink-500/20
                                        bg-pink-500/10
                                        px-3 py-1.5
                                        text-xs font-bold text-pink-400"
                                    >
                                        <i class="fa-solid fa-key"></i>
                                        Rent
                                    </span>

                                @endif

                            </td>


                            {{-- LISTED PRICE --}}
                            <td class="px-5 py-5 align-top">

                                @if($property?->price)

                                    <p class="whitespace-nowrap text-sm font-bold text-white">
                                        ₹{{ number_format((float) $property->price, 2) }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-gray-600">
                                        Property Price
                                    </p>

                                @else

                                    <span class="text-xs text-gray-600">
                                        N/A
                                    </span>

                                @endif

                            </td>


                            {{-- CUSTOMER OFFER --}}
                            <td class="px-5 py-5 align-top">

                                <p
                                    class="whitespace-nowrap text-sm
                                    font-bold text-orange-400"
                                >
                                    ₹{{ number_format((float) $transaction->offer_amount, 2) }}
                                </p>

                                <p class="mt-1 text-[11px] text-gray-600">
                                    Customer Offer
                                </p>

                            </td>


                            {{-- COUNTER OFFER --}}
                            <td class="px-5 py-5 align-top">

                                @if($transaction->counter_offer_amount)

                                    <p
                                        class="whitespace-nowrap text-sm
                                        font-bold text-fuchsia-400"
                                    >
                                        ₹{{ number_format((float) $transaction->counter_offer_amount, 2) }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-gray-600">
                                        Agent Counter
                                    </p>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1
                                        rounded-lg
                                        bg-slate-800
                                        px-2 py-1
                                        text-[11px] text-gray-500"
                                    >
                                        <i class="fa-solid fa-minus"></i>
                                        Not set
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td class="px-5 py-5 align-top">

                                <span
                                    class="inline-flex items-center gap-2
                                    whitespace-nowrap
                                    rounded-full border
                                    px-3 py-1.5
                                    text-xs font-bold
                                    {{ $statusClasses }}"
                                >
                                    <i class="fa-solid {{ $statusIcon }}"></i>
                                    {{ ucfirst($transaction->status) }}
                                </span>

                            </td>


                            {{-- DATE --}}
                            <td class="whitespace-nowrap px-5 py-5 align-top">

                                <p class="text-sm font-medium text-gray-300">
                                    {{ $transaction->created_at?->format('d M Y') }}
                                </p>

                                <p class="mt-1 text-xs text-gray-600">
                                    {{ $transaction->created_at?->format('h:i A') }}
                                </p>

                            </td>


                            {{-- ACTION --}}
                            <td class="px-5 py-5 text-right align-top">

                                <a
                                    href="{{ route('agent.property-transactions.show', $transaction) }}"
                                    class="inline-flex items-center gap-2
                                    rounded-xl
                                    border border-indigo-500/20
                                    bg-indigo-500/10
                                    px-4 py-2.5
                                    text-xs font-bold text-indigo-400
                                    transition
                                    hover:border-indigo-500/40
                                    hover:bg-indigo-500/20
                                    hover:text-indigo-300"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="11"
                                class="px-5 py-20 text-center"
                            >

                                <div
                                    class="mx-auto flex h-20 w-20
                                    items-center justify-center
                                    rounded-3xl
                                    bg-indigo-500/10
                                    text-indigo-400"
                                >
                                    <i class="fa-solid fa-file-circle-xmark text-3xl"></i>
                                </div>

                                <h3 class="mt-5 text-lg font-bold text-white">
                                    No Property Requests Found
                                </h3>

                                <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                                    No purchase or rental requests match your
                                    current search and filters.
                                </p>

                                @if(request()->hasAny(['search', 'type', 'status']))

                                    <a
                                        href="{{ route('agent.property-transactions.index') }}"
                                        class="mt-5 inline-flex items-center gap-2
                                        rounded-xl
                                        bg-gradient-to-r
                                        from-indigo-500 to-violet-600
                                        px-5 py-3
                                        text-sm font-semibold text-white
                                        shadow-lg shadow-indigo-900/20"
                                    >
                                        <i class="fa-solid fa-rotate-left"></i>
                                        Clear Filters
                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             MOBILE / TABLET CARDS
        ====================================================== --}}

        <div class="divide-y divide-purple-500/10 xl:hidden">

            @forelse($transactions as $transaction)

                @php

                    $property = $transaction->property;

                    $owner = $property?->owner;

                    $customerName =
                        $transaction->name
                        ?? $transaction->user?->name
                        ?? 'Unknown Customer';

                    $customerEmail =
                        $transaction->email
                        ?? $transaction->user?->email
                        ?? 'No email';

                    $customerPhone =
                        $transaction->phone
                        ?? $transaction->user?->phone
                        ?? null;

                    $statusClasses = match($transaction->status) {

                        'pending' =>
                            'border-amber-500/20 bg-amber-500/10 text-amber-400',

                        'approved' =>
                            'border-emerald-500/20 bg-emerald-500/10 text-emerald-400',

                        'rejected' =>
                            'border-red-500/20 bg-red-500/10 text-red-400',

                        'completed' =>
                            'border-cyan-500/20 bg-cyan-500/10 text-cyan-400',

                        'cancelled' =>
                            'border-gray-500/20 bg-gray-500/10 text-gray-400',

                        default =>
                            'border-gray-500/20 bg-gray-500/10 text-gray-400',
                    };

                @endphp


                <div class="p-5">

                    {{-- CARD TOP --}}
                    <div class="flex items-start justify-between gap-4">

                        <div class="flex min-w-0 gap-3">

                            <div
                                class="flex h-12 w-12 shrink-0
                                items-center justify-center
                                rounded-xl
                                bg-indigo-500/10
                                text-indigo-400"
                            >
                                <i class="fa-solid fa-building"></i>
                            </div>

                            <div class="min-w-0">

                                <div class="flex items-center gap-2">

                                    <span class="text-[11px] font-bold text-gray-600">
                                        #{{ $transaction->id }}
                                    </span>

                                    @if($transaction->type === 'buy')

                                        <span
                                            class="rounded-full
                                            bg-blue-500/10
                                            px-2 py-1
                                            text-[10px] font-bold text-blue-400"
                                        >
                                            BUY
                                        </span>

                                    @else

                                        <span
                                            class="rounded-full
                                            bg-pink-500/10
                                            px-2 py-1
                                            text-[10px] font-bold text-pink-400"
                                        >
                                            RENT
                                        </span>

                                    @endif

                                </div>

                                <h4
                                    class="mt-1 truncate text-sm
                                    font-bold text-white"
                                >
                                    {{ $property?->title ?? 'Property Unavailable' }}
                                </h4>

                                <p
                                    class="mt-1 line-clamp-2
                                    text-xs text-gray-500"
                                >
                                    <i
                                        class="fa-solid fa-location-dot
                                        mr-1 text-indigo-400"
                                    ></i>

                                    {{ $property?->address
                                        ?? $property?->location?->name
                                        ?? 'Location unavailable' }}
                                </p>

                            </div>

                        </div>


                        <span
                            class="inline-flex shrink-0 items-center
                            rounded-full border
                            px-2.5 py-1
                            text-[10px] font-bold
                            {{ $statusClasses }}"
                        >
                            {{ ucfirst($transaction->status) }}
                        </span>

                    </div>


                    {{-- =================================================
                         OWNER DETAILS - MOBILE
                    ================================================== --}}

                    <div
                        class="mt-5 rounded-xl
                        border border-purple-500/10
                        bg-purple-500/[0.03] p-4"
                    >

                        <p
                            class="mb-3 text-[10px] font-bold uppercase
                            tracking-wider text-gray-600"
                        >
                            Property Owner
                        </p>


                        @if($owner)

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 shrink-0
                                    items-center justify-center
                                    rounded-full
                                    bg-purple-500/10
                                    text-purple-400"
                                >
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>

                                <div class="min-w-0">

                                    <p class="truncate text-sm font-semibold text-white">
                                        {{ $owner->name }}
                                    </p>

                                    @if(!empty($owner->email))

                                        <p class="mt-0.5 truncate text-xs text-gray-500">
                                            {{ $owner->email }}
                                        </p>

                                    @endif

                                    @if(!empty($owner->phone))

                                        <p class="mt-0.5 text-xs text-gray-600">
                                            <i class="fa-solid fa-phone mr-1"></i>
                                            {{ $owner->phone }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                        @else

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center
                                    justify-center rounded-full
                                    bg-gray-500/10 text-gray-500"
                                >
                                    <i class="fa-solid fa-user-slash"></i>
                                </div>

                                <div>

                                    <p class="text-sm font-medium text-gray-400">
                                        Not Assigned
                                    </p>

                                    <p class="mt-0.5 text-xs text-gray-600">
                                        No owner assigned
                                    </p>

                                </div>

                            </div>

                        @endif

                    </div>


                    {{-- CUSTOMER --}}
                    <div
                        class="mt-4 rounded-xl
                        border border-purple-500/10
                        bg-slate-950/40 p-4"
                    >

                        <p
                            class="mb-3 text-[10px] font-bold uppercase
                            tracking-wider text-gray-600"
                        >
                            Applicant
                        </p>

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center
                                justify-center rounded-full
                                bg-gradient-to-br
                                from-purple-500 to-fuchsia-600
                                text-sm font-bold uppercase text-white"
                            >
                                {{ strtoupper(substr($customerName, 0, 1)) }}
                            </div>

                            <div class="min-w-0">

                                <p class="truncate text-sm font-semibold text-white">
                                    {{ $customerName }}
                                </p>

                                <p class="truncate text-xs text-gray-500">
                                    {{ $customerEmail }}
                                </p>

                                @if($customerPhone)

                                    <p class="mt-1 text-xs text-gray-600">
                                        <i class="fa-solid fa-phone mr-1"></i>
                                        {{ $customerPhone }}
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- FINANCIAL DETAILS --}}
                    <div class="mt-4 grid grid-cols-3 gap-2">

                        <div
                            class="rounded-xl
                            border border-gray-800
                            bg-slate-950/40 p-3"
                        >

                            <p class="text-[10px] text-gray-600">
                                Listed Price
                            </p>

                            <p class="mt-1 text-xs font-bold text-white">
                                ₹{{ number_format((float) ($property?->price ?? 0), 0) }}
                            </p>

                        </div>


                        <div
                            class="rounded-xl
                            border border-orange-500/10
                            bg-orange-500/[0.03] p-3"
                        >

                            <p class="text-[10px] text-gray-600">
                                Customer
                            </p>

                            <p class="mt-1 text-xs font-bold text-orange-400">
                                ₹{{ number_format((float) $transaction->offer_amount, 0) }}
                            </p>

                        </div>


                        <div
                            class="rounded-xl
                            border border-fuchsia-500/10
                            bg-fuchsia-500/[0.03] p-3"
                        >

                            <p class="text-[10px] text-gray-600">
                                Counter
                            </p>

                            <p class="mt-1 text-xs font-bold text-fuchsia-400">

                                @if($transaction->counter_offer_amount)

                                    ₹{{ number_format((float) $transaction->counter_offer_amount, 0) }}

                                @else

                                    —

                                @endif

                            </p>

                        </div>

                    </div>


                    {{-- BOTTOM --}}
                    <div
                        class="mt-4 flex items-center
                        justify-between gap-3"
                    >

                        <p class="text-xs text-gray-600">

                            <i class="fa-regular fa-calendar mr-1"></i>

                            {{ $transaction->created_at?->format('d M Y, h:i A') }}

                        </p>


                        <a
                            href="{{ route('agent.property-transactions.show', $transaction) }}"
                            class="inline-flex items-center gap-2
                            rounded-xl
                            bg-gradient-to-r
                            from-indigo-500 to-violet-600
                            px-4 py-2.5
                            text-xs font-bold text-white
                            shadow-lg shadow-indigo-900/20"
                        >
                            <i class="fa-solid fa-eye"></i>
                            View Request
                        </a>

                    </div>

                </div>

            @empty

                <div class="px-5 py-16 text-center">

                    <div
                        class="mx-auto flex h-16 w-16
                        items-center justify-center
                        rounded-2xl
                        bg-indigo-500/10
                        text-indigo-400"
                    >
                        <i class="fa-solid fa-file-circle-xmark text-2xl"></i>
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-white">
                        No Property Requests
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        No requests were found.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if($transactions->hasPages())

            <div
                class="border-t border-purple-500/10
                px-5 py-4"
            >

                {{ $transactions->links() }}

            </div>

        @endif

    </div>

</div>

@endsection