@extends('admin.layouts.app')

@section('title', 'Owners')

@section('page-title', 'Owners')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-white">
                Owners
            </h1>

            <p class="mt-1 text-sm text-slate-400">
                Manage registered property owners.
            </p>

        </div>


        <div class="flex items-center gap-3">

            <div class="rounded-xl border border-slate-700 bg-slate-800/70 px-4 py-2.5">

                <div class="flex items-center gap-2">

                    <i class="fa-solid fa-house-user text-purple-400"></i>

                    <span class="text-sm text-slate-300">
                        Total Owners
                    </span>

                    <span class="font-bold text-white">
                        {{ $owners->total() }}
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="flex items-center gap-3 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-emerald-400">

            <i class="fa-solid fa-circle-check"></i>

            <span class="text-sm">
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
         ERROR MESSAGE
    ========================================================== --}}

    @if(session('error'))

        <div class="flex items-center gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-red-400">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span class="text-sm">
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
         OWNERS TABLE
    ========================================================== --}}

    <div class="overflow-hidden rounded-2xl border border-slate-700 bg-slate-900 shadow-xl">


        {{-- =====================================================
             TABLE HEADER
        ====================================================== --}}

        <div class="border-b border-slate-700 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                    <i class="fa-solid fa-house-user"></i>

                </div>


                <div>

                    <h2 class="font-semibold text-white">
                        Registered Owners
                    </h2>

                    <p class="text-sm text-slate-400">
                        Users registered with owner account type.
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
             RESPONSIVE TABLE
        ====================================================== --}}

        <div class="overflow-x-auto">

            <table class="w-full min-w-[750px] text-left">


                {{-- TABLE HEADER --}}

                <thead class="border-b border-slate-700 bg-slate-800/50">

                    <tr>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            #
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Owner
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Email
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Properties
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Account Type
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Joined
                        </th>

                    </tr>

                </thead>


                {{-- =================================================
                     TABLE BODY
                ================================================== --}}

                <tbody class="divide-y divide-slate-800">

                    @forelse($owners as $owner)

                        <tr class="transition hover:bg-slate-800/50">


                            {{-- NUMBER --}}

                            <td class="px-6 py-4 text-sm text-slate-400">

                                {{ $owners->firstItem() + $loop->index }}

                            </td>


                            {{-- OWNER --}}

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">


                                    {{-- AVATAR --}}

                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-purple-500/10 text-purple-400">

                                        {{ strtoupper(substr($owner->name ?? 'O', 0, 1)) }}

                                    </div>


                                    {{-- OWNER INFO --}}

                                    <div class="min-w-0">

                                        <div class="truncate font-medium text-white">

                                            {{ $owner->name }}

                                        </div>

                                        <div class="text-xs text-slate-500">

                                            Owner ID #{{ $owner->id }}

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}

                            <td class="px-6 py-4">

                                @if($owner->email)

                                    <div class="flex items-center gap-2 text-sm text-slate-300">

                                        <i class="fa-solid fa-envelope text-slate-500"></i>

                                        <span class="truncate">
                                            {{ $owner->email }}
                                        </span>

                                    </div>

                                @else

                                    <span class="text-sm text-slate-600">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- PROPERTIES --}}

                            <td class="px-6 py-4">

                                <div class="inline-flex items-center gap-2 rounded-lg bg-purple-500/10 px-3 py-1.5">

                                    <i class="fa-solid fa-building text-xs text-purple-400"></i>

                                    <span class="text-sm font-semibold text-purple-300">

                                        {{ $owner->properties_count ?? 0 }}

                                    </span>

                                    <span class="text-xs text-slate-500">

                                        {{ ($owner->properties_count ?? 0) == 1 ? 'Property' : 'Properties' }}

                                    </span>

                                </div>

                            </td>


                            {{-- ACCOUNT TYPE --}}

                            <td class="px-6 py-4">

                                <span class="inline-flex items-center gap-2 rounded-full border border-purple-500/20 bg-purple-500/10 px-3 py-1.5 text-xs font-medium text-purple-400">

                                    <i class="fa-solid fa-house-user"></i>

                                    Owner

                                </span>

                            </td>


                            {{-- JOINED --}}

                            <td class="px-6 py-4">

                                <div class="text-sm text-slate-300">

                                    {{ $owner->created_at?->format('d M Y') ?? '—' }}

                                </div>

                                <div class="text-xs text-slate-500">

                                    {{ $owner->created_at?->format('h:i A') ?? '' }}

                                </div>

                            </td>


                        </tr>

                    @empty


                        {{-- EMPTY STATE --}}

                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">


                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-800 text-slate-500">

                                    <i class="fa-solid fa-house-user text-2xl"></i>

                                </div>


                                <h3 class="mt-4 text-lg font-semibold text-white">

                                    No Owners Found

                                </h3>


                                <p class="mt-1 text-sm text-slate-500">

                                    No users have registered as an owner yet.

                                </p>


                            </td>

                        </tr>


                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if($owners->hasPages())

            <div class="border-t border-slate-700 px-6 py-4">

                {{ $owners->links() }}

            </div>

        @endif


    </div>

</div>

@endsection