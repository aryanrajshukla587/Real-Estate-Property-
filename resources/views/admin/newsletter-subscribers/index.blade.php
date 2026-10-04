@extends('admin.layouts.app')

@section('title', 'Newsletter Subscribers')
@section('page-title', 'Newsletter Subscribers')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-white">
                Newsletter Subscribers
            </h1>

            <p class="mt-1 text-sm text-gray-400">
                Manage users who subscribed to your newsletter.
            </p>

        </div>

    </div>


    

    {{-- =========================================================
         SUMMARY CARDS
    ========================================================== --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">


        {{-- TOTAL --}}

        <div
            class="rounded-2xl border border-purple-500/20 bg-slate-900 p-5 shadow-lg"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-400">
                        Total Subscribers
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-white">
                        {{ $totalSubscribers }}
                    </h3>

                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400"
                >
                    <i class="fa fa-users"></i>
                </div>

            </div>

        </div>


        {{-- ACTIVE --}}

        <div
            class="rounded-2xl border border-green-500/20 bg-slate-900 p-5 shadow-lg"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-400">
                        Active Subscribers
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-white">
                        {{ $activeSubscribers }}
                    </h3>

                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-500/10 text-green-400"
                >
                    <i class="fa fa-check"></i>
                </div>

            </div>

        </div>


        {{-- UNSUBSCRIBED --}}

        <div
            class="rounded-2xl border border-red-500/20 bg-slate-900 p-5 shadow-lg"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-400">
                        Unsubscribed
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-white">
                        {{ $unsubscribed }}
                    </h3>

                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-500/10 text-red-400"
                >
                    <i class="fa fa-user-times"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTER
    ========================================================== --}}

    <div
        class="rounded-2xl border border-purple-500/20 bg-slate-900 p-5 shadow-lg"
    >

        <form
            method="GET"
            action="{{ route('admin.newsletter-subscribers.index') }}"
            class="grid grid-cols-1 gap-4 md:grid-cols-3"
        >


            {{-- SEARCH --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Search Email
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Enter email..."
                    class="w-full rounded-xl border border-gray-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500"
                >

            </div>


            {{-- STATUS --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-xl border border-gray-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none transition focus:border-purple-500"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="subscribed"
                        {{ request('status') === 'subscribed' ? 'selected' : '' }}
                    >
                        Subscribed
                    </option>

                    <option
                        value="unsubscribed"
                        {{ request('status') === 'unsubscribed' ? 'selected' : '' }}
                    >
                        Unsubscribed
                    </option>

                </select>

            </div>


            {{-- BUTTONS --}}

            <div class="flex items-end gap-3">

                <button
                    type="submit"
                    class="rounded-xl bg-purple-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-purple-700"
                >
                    <i class="fa fa-search mr-1"></i>
                    Search
                </button>


                <a
                    href="{{ route('admin.newsletter-subscribers.index') }}"
                    class="rounded-xl border border-gray-700 bg-slate-950 px-5 py-3 text-sm font-semibold text-gray-300 transition hover:bg-slate-800"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
         TABLE
    ========================================================== --}}

    <div
        class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900 shadow-lg"
    >

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-800">

                <thead class="bg-slate-950">

                    <tr>

                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400"
                        >
                            #
                        </th>

                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400"
                        >
                            Email
                        </th>

                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400"
                        >
                            Status
                        </th>

                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400"
                        >
                            Subscribed On
                        </th>

                        <th
                            class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-400"
                        >
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-800">

                    @forelse($subscribers as $subscriber)

                        <tr class="transition hover:bg-slate-800/50">


                            {{-- NUMBER --}}

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-400">

                                {{ $subscribers->firstItem() + $loop->index }}

                            </td>


                            {{-- EMAIL --}}

                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-500/10 text-purple-400"
                                    >
                                        <i class="fa fa-envelope"></i>
                                    </div>

                                    <div>

                                        <p class="text-sm font-medium text-white">
                                            {{ $subscriber->email }}
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            Subscriber
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- STATUS --}}

                            <td class="whitespace-nowrap px-6 py-4">

                                @if($subscriber->status === 'subscribed')

                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-400"
                                    >

                                        <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>

                                        Subscribed

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-400"
                                    >

                                        <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                        Unsubscribed

                                    </span>

                                @endif

                            </td>


                            {{-- DATE --}}

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-400">

                                {{ $subscriber->created_at->format('d M Y') }}

                                <span class="text-xs text-gray-600">
                                    {{ $subscriber->created_at->format('h:i A') }}
                                </span>

                            </td>


                            {{-- ACTIONS --}}

                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex justify-end gap-2">


                                    {{-- STATUS TOGGLE --}}

                                    <form
                                        method="POST"
                                        action="{{ route('admin.newsletter-subscribers.update', $subscriber) }}"
                                    >

                                        @csrf
                                        @method('PUT')

                                        @if($subscriber->status === 'subscribed')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="unsubscribed"
                                            >

                                            <button
                                                type="submit"
                                                title="Unsubscribe"
                                                class="rounded-lg border border-yellow-500/20 bg-yellow-500/10 px-3 py-2 text-yellow-400 transition hover:bg-yellow-500/20"
                                            >
                                                <i class="fa fa-ban"></i>
                                            </button>

                                        @else

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="subscribed"
                                            >

                                            <button
                                                type="submit"
                                                title="Subscribe"
                                                class="rounded-lg border border-green-500/20 bg-green-500/10 px-3 py-2 text-green-400 transition hover:bg-green-500/20"
                                            >
                                                <i class="fa fa-check"></i>
                                            </button>

                                        @endif

                                    </form>


                                    {{-- DELETE --}}

                                    <form
                                        method="POST"
                                        action="{{ route('admin.newsletter-subscribers.destroy', $subscriber) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this subscriber?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete"
                                            class="rounded-lg border border-red-500/20 bg-red-500/10 px-3 py-2 text-red-400 transition hover:bg-red-500/20"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-16 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <div
                                        class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-purple-500/10 text-2xl text-purple-400"
                                    >
                                        <i class="fa fa-envelope-o"></i>
                                    </div>

                                    <h3 class="text-lg font-semibold text-white">
                                        No Subscribers Found
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Newsletter subscribers will appear here.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if($subscribers->hasPages())

            <div class="border-t border-gray-800 px-6 py-4">

                {{ $subscribers->links() }}

            </div>

        @endif

    </div>

</div>

@endsection