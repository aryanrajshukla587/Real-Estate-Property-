@extends('admin.layouts.app')

@section('title', $propertyType->name)
@section('page-title', 'Property Type Details')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

        <div>

            <a
                href="{{ route('admin.property-types.index') }}"
                class="mb-3 inline-flex items-center gap-2 text-sm text-gray-400 transition hover:text-white">

                <i class="fa-solid fa-arrow-left"></i>

                Back to Property Types

            </a>


            <div class="flex items-center gap-4">

                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-pink-500/20 to-rose-600/20 text-pink-400">

                    <i class="fa-solid fa-layer-group text-xl"></i>

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-white">
                        {{ $propertyType->name }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Property type details and information
                    </p>

                </div>

            </div>

        </div>


        {{-- ACTIONS --}}
        <div class="flex items-center gap-2">

            <a
                href="{{ route('admin.property-types.edit', $propertyType) }}"
                class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-900/20 transition hover:from-amber-600 hover:to-orange-700">

                <i class="fa-solid fa-pen-to-square"></i>

                Edit

            </a>


            @if(($propertyType->properties_count ?? 0) == 0)

                <form
                    action="{{ route('admin.property-types.destroy', $propertyType) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this property type?');">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm font-semibold text-red-400 transition hover:bg-red-500/20 hover:text-red-300">

                        <i class="fa-solid fa-trash"></i>

                        Delete

                    </button>

                </form>

            @endif

        </div>

    </div>


    {{-- MAIN GRID --}}
    <div class="grid gap-6 lg:grid-cols-3">


        {{-- INFORMATION --}}
        <div class="lg:col-span-2">

            <div class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

                <div class="border-b border-purple-500/20 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                            <i class="fa-solid fa-circle-info"></i>

                        </div>

                        <div>

                            <h3 class="font-semibold text-white">
                                Property Type Information
                            </h3>

                            <p class="text-xs text-gray-500">
                                Basic information about this property type
                            </p>

                        </div>

                    </div>

                </div>


                <div class="grid gap-6 p-5 sm:grid-cols-2 sm:p-6">


                    {{-- NAME --}}
                    <div>

                        <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                            Name
                        </p>

                        <p class="text-sm font-medium text-white">
                            {{ $propertyType->name }}
                        </p>

                    </div>


                    {{-- SLUG --}}
                    <div>

                        <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                            Slug
                        </p>

                        <p class="inline-block rounded-lg bg-slate-800 px-3 py-1.5 text-sm text-gray-300">
                            {{ $propertyType->slug }}
                        </p>

                    </div>


                    {{-- STATUS --}}
                    <div>

                        <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                            Status
                        </p>

                        @if($propertyType->is_active)

                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-xs font-medium text-emerald-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                Active

                            </span>

                        @else

                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1.5 text-xs font-medium text-red-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                Inactive

                            </span>

                        @endif

                    </div>


                    {{-- PROPERTY COUNT --}}
                    <div>

                        <p class="mb-1 text-xs uppercase tracking-wider text-gray-500">
                            Total Properties
                        </p>

                        <div class="flex items-center gap-2">

                            <i class="fa-solid fa-building text-purple-400"></i>

                            <span class="text-sm font-medium text-white">
                                {{ $propertyType->properties_count ?? 0 }}
                            </span>

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="sm:col-span-2">

                        <p class="mb-2 text-xs uppercase tracking-wider text-gray-500">
                            Description
                        </p>

                        @if($propertyType->description)

                            <p class="text-sm leading-6 text-gray-300">
                                {{ $propertyType->description }}
                            </p>

                        @else

                            <p class="text-sm italic text-gray-600">
                                No description added.
                            </p>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- SIDE CARDS --}}
        <div class="space-y-6">


            {{-- PROPERTY COUNT CARD --}}
            <div class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-6 shadow-xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-gray-400">
                            Properties
                        </p>

                        <p class="mt-2 text-3xl font-bold text-white">
                            {{ $propertyType->properties_count ?? 0 }}
                        </p>

                    </div>

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-500/10 text-purple-400">

                        <i class="fa-solid fa-building text-xl"></i>

                    </div>

                </div>

                <p class="mt-4 text-xs text-gray-500">
                    Properties using this type
                </p>

            </div>


            {{-- RECORD INFO --}}
            <div class="rounded-2xl border border-purple-500/20 bg-slate-900/70 p-6 shadow-xl">

                <div class="mb-5 flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-fuchsia-500/10 text-fuchsia-400">

                        <i class="fa-solid fa-clock"></i>

                    </div>

                    <h3 class="font-semibold text-white">
                        Record Information
                    </h3>

                </div>


                <div class="space-y-4">


                    {{-- ID --}}
                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            ID
                        </span>

                        <span class="text-sm font-medium text-gray-300">
                            #{{ $propertyType->id }}
                        </span>

                    </div>


                    {{-- CREATED --}}
                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Created
                        </span>

                        <span class="text-right text-sm text-gray-300">
                            {{ $propertyType->created_at?->format('d M Y, h:i A') }}
                        </span>

                    </div>


                    {{-- UPDATED --}}
                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Updated
                        </span>

                        <span class="text-right text-sm text-gray-300">
                            {{ $propertyType->updated_at?->format('d M Y, h:i A') }}
                        </span>

                    </div>


                    {{-- STATUS --}}
                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Status
                        </span>

                        @if($propertyType->is_active)

                            <span class="text-sm font-medium text-emerald-400">
                                Active
                            </span>

                        @else

                            <span class="text-sm font-medium text-red-400">
                                Inactive
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection