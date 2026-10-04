@extends('admin.layouts.app')

@section('title', 'Location Details')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

{{-- HEADER --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>
        <a href="{{ route('admin.locations.index') }}"
   class="mb-3 inline-flex items-center gap-2 text-sm text-gray-400 transition hover:text-white">

    <i class="fa-solid fa-arrow-left"></i>

    Back to Locations
</a>

        <h1 class="text-2xl font-bold text-white">
            {{ $location->city }}
        </h1>

        <p class="mt-1 text-sm text-gray-400">
            Location details and property information.
        </p>
    </div>

    <div class="flex items-center gap-2">

        {{-- EDIT --}}
        <a href="{{ route('admin.locations.edit', $location) }}"
           class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
            <i class="bi bi-pencil"></i>
            Edit
        </a>

        {{-- DELETE --}}
        @if(($location->properties_count ?? 0) == 0)
            <form action="{{ route('admin.locations.destroy', $location) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this location?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-2.5 text-sm font-semibold text-red-400 transition hover:bg-red-500/20">
                    <i class="bi bi-trash"></i>
                    Delete
                </button>

            </form>
        @endif

    </div>

</div>


{{-- MAIN DETAILS --}}
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

    {{-- LOCATION CARD --}}
    <div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900 shadow-xl lg:col-span-2">

        <div class="border-b border-gray-800 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-500/10">
                    <i class="bi bi-geo-alt text-xl text-indigo-400"></i>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-white">
                        Location Information
                    </h2>

                    <p class="text-sm text-gray-500">
                        Basic location details
                    </p>
                </div>

            </div>

        </div>

        <div class="p-6">

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                {{-- CITY --}}
                <div>
                    <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                        City
                    </p>

                    <p class="text-sm font-semibold text-white">
                        {{ $location->city }}
                    </p>
                </div>

                {{-- STATE --}}
                <div>
                    <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                        State
                    </p>

                    <p class="text-sm font-semibold text-white">
                        {{ $location->state ?: '—' }}
                    </p>
                </div>

                {{-- COUNTRY --}}
                <div>
                    <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                        Country
                    </p>

                    <p class="text-sm font-semibold text-white">
                        {{ $location->country }}
                    </p>
                </div>

                {{-- STATUS --}}
                <div>
                    <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                        Status
                    </p>

                    @if($location->is_active)
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-500/10 px-3 py-1 text-xs font-medium text-green-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                            Inactive
                        </span>
                    @endif
                </div>

                {{-- ADDRESS --}}
                <div class="sm:col-span-2">

                    <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                        Address
                    </p>

                    <p class="text-sm leading-6 text-gray-300">
                        {{ $location->address ?: 'No address provided.' }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- PROPERTY COUNT --}}
    <div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900 shadow-xl">

        <div class="border-b border-gray-800 px-6 py-5">

            <h2 class="text-lg font-semibold text-white">
                Properties
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Properties assigned to this location.
            </p>

        </div>

        <div class="flex flex-col items-center justify-center px-6 py-10 text-center">

            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-500/10">
                <i class="bi bi-building text-2xl text-indigo-400"></i>
            </div>

            <p class="mt-4 text-4xl font-bold text-white">
                {{ $location->properties_count ?? 0 }}
            </p>

            <p class="mt-1 text-sm text-gray-500">
                Total Properties
            </p>

        </div>

    </div>

</div>


{{-- MAP COORDINATES --}}
<div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900 shadow-xl">

    <div class="border-b border-gray-800 px-6 py-5">

        <div class="flex items-center gap-3">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-500/10">
                <i class="bi bi-pin-map text-xl text-purple-400"></i>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-white">
                    Map Coordinates
                </h2>

                <p class="text-sm text-gray-500">
                    Geographic coordinates for this location.
                </p>
            </div>

        </div>

    </div>

    <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">

        {{-- LATITUDE --}}
        <div class="rounded-lg border border-gray-800 bg-gray-950/50 p-4">

            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                Latitude
            </p>

            <p class="font-mono text-sm text-white">
                {{ $location->latitude ?: 'Not provided' }}
            </p>

        </div>

        {{-- LONGITUDE --}}
        <div class="rounded-lg border border-gray-800 bg-gray-950/50 p-4">

            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                Longitude
            </p>

            <p class="font-mono text-sm text-white">
                {{ $location->longitude ?: 'Not provided' }}
            </p>

        </div>

    </div>

</div>


{{-- META INFORMATION --}}
<div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900 shadow-xl">

    <div class="border-b border-gray-800 px-6 py-5">

        <h2 class="text-lg font-semibold text-white">
            Additional Information
        </h2>

    </div>

    <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">

        {{-- ID --}}
        <div>
            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                Location ID
            </p>

            <p class="font-mono text-sm text-gray-300">
                #{{ $location->id }}
            </p>
        </div>

        {{-- CREATED --}}
        <div>
            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                Created At
            </p>

            <p class="text-sm text-gray-300">
                {{ $location->created_at?->format('d M Y, h:i A') ?? '—' }}
            </p>
        </div>

        {{-- UPDATED --}}
        <div>
            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                Last Updated
            </p>

            <p class="text-sm text-gray-300">
                {{ $location->updated_at?->format('d M Y, h:i A') ?? '—' }}
            </p>
        </div>

        {{-- LOCATION STATUS --}}
        <div>
            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">
                Current Status
            </p>

            @if($location->is_active)
                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-500/10 px-3 py-1 text-xs font-medium text-green-400">
                    <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>
                    Active
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">
                    <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                    Inactive
                </span>
            @endif

        </div>

    </div>

</div>

</div>

@endsection
