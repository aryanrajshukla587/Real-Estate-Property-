@extends('admin.layouts.app')

@section('title', 'Locations')

@section('content')

<div class="space-y-6">

{{-- HEADER --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-white">Locations</h1>
        <p class="mt-1 text-sm text-gray-400">
            Manage property locations.
        </p>
    </div>

    <a href="{{ route('admin.locations.create') }}"
       class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
        <i class="bi bi-plus-lg"></i>
        Add Location
    </a>
</div>



{{-- TABLE --}}
<div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900 shadow-xl">

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-400">

            <thead class="border-b border-gray-800 bg-gray-950/60 text-xs uppercase text-gray-400">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">City</th>
                    <th class="px-6 py-4">State</th>
                    <th class="px-6 py-4">Country</th>
                    <th class="px-6 py-4">Properties</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-800">

                @forelse($locations as $location)

                    <tr class="transition hover:bg-gray-800/50">

                        <td class="whitespace-nowrap px-6 py-4 text-gray-500">
                            {{ $locations->firstItem() + $loop->index }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-semibold text-white">
                                {{ $location->city }}
                            </div>

                            @if($location->address)
                                <div class="mt-1 max-w-xs truncate text-xs text-gray-500">
                                    {{ $location->address }}
                                </div>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            {{ $location->state ?: '—' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $location->country }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="rounded-full bg-indigo-500/10 px-2.5 py-1 text-xs font-medium text-indigo-400">
                                {{ $location->properties_count ?? $location->properties()->count() }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            @if($location->is_active)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-500/10 px-2.5 py-1 text-xs font-medium text-green-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-500/10 px-2.5 py-1 text-xs font-medium text-red-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">

    {{-- VIEW --}}
    <a href="{{ route('admin.locations.show', $location) }}"
       title="View"
       class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-700 text-gray-400 transition hover:border-indigo-500 hover:bg-indigo-500/10 hover:text-indigo-400">

        <i class="fa-solid fa-eye"></i>

    </a>

    {{-- EDIT --}}
    <a href="{{ route('admin.locations.edit', $location) }}"
       title="Edit"
       class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-700 text-gray-400 transition hover:border-yellow-500 hover:bg-yellow-500/10 hover:text-yellow-400">

        <i class="fa-solid fa-pen-to-square"></i>

    </a>

    {{-- DELETE --}}
    <form action="{{ route('admin.locations.destroy', $location) }}"
          method="POST"
          onsubmit="return confirm('Are you sure you want to delete this location?');">

        @csrf
        @method('DELETE')

        <button type="submit"
                title="Delete"
                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-700 text-gray-400 transition hover:border-red-500 hover:bg-red-500/10 hover:text-red-400">

            <i class="fa-solid fa-trash"></i>

        </button>

    </form>

</div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-gray-800">
                                    <i class="bi bi-geo-alt text-2xl text-gray-500"></i>
                                </div>

                                <h3 class="text-base font-semibold text-white">
                                    No Locations Found
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Start by adding your first location.
                                </p>

                                <a href="{{ route('admin.locations.create') }}"
                                   class="mt-4 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                    <i class="bi bi-plus-lg"></i>
                                    Add Location
                                </a>
                            </div>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>

    {{-- PAGINATION --}}
    @if($locations->hasPages())
        <div class="border-t border-gray-800 px-6 py-4">
            {{ $locations->links() }}
        </div>
    @endif

</div>

</div>

@endsection
