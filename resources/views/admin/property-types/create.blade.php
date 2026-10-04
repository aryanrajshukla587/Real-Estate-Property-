@extends('admin.layouts.app')

@section('title', 'Add Property Type')
@section('page-title', 'Add Property Type')

@section('content')

<div class="mx-auto max-w-4xl space-y-6">

    {{-- BACK --}}
    <a
        href="{{ route('admin.property-types.index') }}"
        class="inline-flex items-center gap-2 text-sm text-gray-400 transition hover:text-white">

        <i class="fa-solid fa-arrow-left"></i>

        Back to Property Types

    </a>


    {{-- HEADER --}}
    <div>

        <h2 class="text-2xl font-bold text-white">
            Add Property Type
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            Create a new property category.
        </p>

    </div>


    {{-- FORM CARD --}}
    <div class="rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

        <div class="border-b border-purple-500/20 px-5 py-5 sm:px-6">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-pink-500/10 text-pink-400">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <div>

                    <h3 class="font-semibold text-white">
                        Property Type Information
                    </h3>

                    <p class="text-xs text-gray-500">
                        Enter the details of the property type.
                    </p>

                </div>

            </div>

        </div>


        <form
            action="{{ route('admin.property-types.store') }}"
            method="POST"
            class="space-y-6 p-5 sm:p-6">

            @csrf


            {{-- NAME --}}
            <div>

                <label
                    for="name"
                    class="mb-2 block text-sm font-medium text-gray-300">

                    Property Type Name
                    <span class="text-red-400">*</span>

                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. Apartment, Villa, Plot"
                    required
                    class="w-full rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20">

                @error('name')

                    <p class="mt-1.5 text-xs text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- DESCRIPTION --}}
            <div>

                <label
                    for="description"
                    class="mb-2 block text-sm font-medium text-gray-300">

                    Description

                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Enter a short description..."
                    class="w-full resize-none rounded-xl border border-purple-500/20 bg-slate-950 px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20">{{ old('description') }}</textarea>

                @error('description')

                    <p class="mt-1.5 text-xs text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- STATUS --}}
            <div class="rounded-xl border border-purple-500/10 bg-slate-950/50 p-4">

                <input
                    type="hidden"
                    name="is_active"
                    value="0">

                <label class="flex cursor-pointer items-center gap-3">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked(old('is_active', true))
                        class="h-4 w-4 rounded border-gray-600 bg-slate-800 text-pink-500 focus:ring-pink-500">

                    <div>

                        <span class="block text-sm font-medium text-white">
                            Active Property Type
                        </span>

                        <span class="block text-xs text-gray-500">
                            This property type will be available for properties.
                        </span>

                    </div>

                </label>

            </div>


            {{-- BUTTONS --}}
            <div class="flex flex-col-reverse gap-3 border-t border-purple-500/20 pt-6 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('admin.property-types.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-700 bg-slate-800 px-5 py-3 text-sm font-semibold text-gray-300 transition hover:bg-slate-700 hover:text-white">

                    <i class="fa-solid fa-xmark"></i>

                    Cancel

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-pink-500 to-rose-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-900/30 transition hover:from-pink-600 hover:to-rose-700">

                    <i class="fa-solid fa-check"></i>

                    Save Property Type

                </button>

            </div>

        </form>

    </div>

</div>

@endsection