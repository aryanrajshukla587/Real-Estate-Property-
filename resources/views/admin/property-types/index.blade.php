@extends('admin.layouts.app')

@section('title', 'Property Types')
@section('page-title', 'Property Types')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="text-2xl font-bold text-white">
                Property Types
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                Manage all property types
            </p>
        </div>

        <a
            href="{{ route('admin.property-types.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-pink-500 to-rose-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-900/30 transition hover:from-pink-600 hover:to-rose-700">

            <i class="fa-solid fa-plus"></i>

            Add Property Type

        </a>

    </div>


    {{-- TABLE CARD --}}
    <div class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900/70 shadow-xl">

        {{-- CARD HEADER --}}
        <div class="border-b border-purple-500/20 px-5 py-4 sm:px-6">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-pink-500/10 text-pink-400">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <div>
                    <h3 class="font-semibold text-white">
                        Property Type List
                    </h3>

                    <p class="text-xs text-gray-500">
                        All available property categories
                    </p>
                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[800px] text-left">

                <thead class="border-b border-purple-500/20 bg-slate-950/50">

                    <tr>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            #
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Property Type
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Slug
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Properties
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Status
                        </th>

                        <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-purple-500/10">

                    @forelse($propertyTypes as $propertyType)

                        <tr class="transition hover:bg-purple-500/5">

                            {{-- NUMBER --}}
                            <td class="px-5 py-4 text-sm text-gray-500">
                                {{ $propertyTypes->firstItem() + $loop->index }}
                            </td>


                            {{-- NAME --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-pink-500/20 to-rose-600/20 text-pink-400">

                                        <i class="fa-solid fa-building"></i>

                                    </div>

                                    <div>

                                        <p class="font-medium text-white">
                                            {{ $propertyType->name }}
                                        </p>

                                        @if($propertyType->description)

                                            <p class="mt-1 max-w-xs truncate text-xs text-gray-500">
                                                {{ $propertyType->description }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- SLUG --}}
                            <td class="px-5 py-4">

                                <span class="rounded-lg bg-slate-800 px-3 py-1.5 text-xs text-gray-400">

                                    {{ $propertyType->slug }}

                                </span>

                            </td>


                            {{-- PROPERTIES --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-2 text-sm text-gray-300">

                                    <i class="fa-solid fa-building text-purple-400"></i>

                                    {{ $propertyType->properties_count ?? 0 }}

                                </div>

                            </td>


                            {{-- STATUS --}}
                            <td class="px-5 py-4">

                                @if($propertyType->is_active)

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-400">

                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                        Active

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1 text-xs font-medium text-red-400">

                                        <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- ACTIONS --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- VIEW --}}
                                    <a
                                        href="{{ route('admin.property-types.show', $propertyType) }}"
                                        title="View"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-blue-500/20 bg-blue-500/10 text-blue-400 transition hover:bg-blue-500/20 hover:text-blue-300">

                                        <i class="fa-solid fa-eye text-sm"></i>

                                    </a>


                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.property-types.edit', $propertyType) }}"
                                        title="Edit"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-amber-500/20 bg-amber-500/10 text-amber-400 transition hover:bg-amber-500/20 hover:text-amber-300">

                                        <i class="fa-solid fa-pen-to-square text-sm"></i>

                                    </a>


                                    {{-- DELETE --}}
                                    @if(($propertyType->properties_count ?? 0) == 0)

                                        <form
                                            action="{{ route('admin.property-types.destroy', $propertyType) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this property type?');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Delete"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg border border-red-500/20 bg-red-500/10 text-red-400 transition hover:bg-red-500/20 hover:text-red-300">

                                                <i class="fa-solid fa-trash text-sm"></i>

                                            </button>

                                        </form>

                                    @else

                                        <button
                                            type="button"
                                            title="Cannot delete: properties are using this type"
                                            disabled
                                            class="flex h-9 w-9 cursor-not-allowed items-center justify-center rounded-lg border border-gray-500/10 bg-gray-500/5 text-gray-600">

                                            <i class="fa-solid fa-lock text-sm"></i>

                                        </button>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-pink-500/10 text-pink-400">

                                    <i class="fa-solid fa-layer-group text-2xl"></i>

                                </div>

                                <h3 class="mt-4 text-lg font-semibold text-white">
                                    No Property Types Found
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Start by adding your first property type.
                                </p>

                                <a
                                    href="{{ route('admin.property-types.create') }}"
                                    class="mt-5 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-pink-500 to-rose-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:from-pink-600 hover:to-rose-700">

                                    <i class="fa-solid fa-plus"></i>

                                    Add Property Type

                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($propertyTypes->hasPages())

            <div class="border-t border-purple-500/20 px-5 py-4 sm:px-6">

                {{ $propertyTypes->links() }}

            </div>

        @endif

    </div>

</div>

@endsection