@extends('admin.layouts.app')

@section('title', 'Agents')

@section('page-title', 'Agents')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-white">
                Agents
            </h1>

            <p class="mt-1 text-sm text-slate-400">
                Manage registered property agents.
            </p>

        </div>


        <div class="flex items-center gap-3">

            <div class="rounded-xl border border-slate-700 bg-slate-800/70 px-4 py-2.5">

                <div class="flex items-center gap-2">

                    <i class="fa-solid fa-user-tie text-blue-400"></i>

                    <span class="text-sm text-slate-300">
                        Total Agents
                    </span>

                    <span class="font-bold text-white">
                        {{ $agents->total() }}
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
         AGENTS TABLE
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-700 bg-slate-900 shadow-xl">


        {{-- Table Header --}}
        <div class="border-b border-slate-700 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                    <i class="fa-solid fa-user-tie"></i>

                </div>


                <div>

                    <h2 class="font-semibold text-white">
                        Registered Agents
                    </h2>

                    <p class="text-sm text-slate-400">
                        Users registered with agent account type.
                    </p>

                </div>

            </div>

        </div>


        {{-- Responsive Table --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[850px] text-left">

                <thead class="border-b border-slate-700 bg-slate-800/50">

                    <tr>

                        {{-- # --}}
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            #
                        </th>


                        {{-- Agent --}}
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Agent
                        </th>


                        {{-- Email --}}
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Email
                        </th>


                        {{-- Properties --}}
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Properties
                        </th>


                        {{-- Account Type --}}
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Account Type
                        </th>


                        {{-- Joined --}}
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Joined
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-800">

                    @forelse($agents as $agent)

                        <tr class="transition hover:bg-slate-800/50">


                            {{-- =================================================
                                 Number
                            ================================================== --}}
                            <td class="px-6 py-4 text-sm text-slate-400">

                                {{ $agents->firstItem() + $loop->index }}

                            </td>


                            {{-- =================================================
                                 Agent
                            ================================================== --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">


                                    {{-- Avatar --}}
                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-500/10 text-blue-400">

                                        <i class="fa-solid fa-user"></i>

                                    </div>


                                    {{-- Agent Information --}}
                                    <div>

                                        <div class="font-medium text-white">
                                            {{ $agent->name }}
                                        </div>

                                        <div class="text-xs text-slate-500">
                                            Agent ID #{{ $agent->id }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                 Email
                            ================================================== --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2 text-sm text-slate-300">

                                    <i class="fa-solid fa-envelope text-slate-500"></i>

                                    <span>
                                        {{ $agent->email }}
                                    </span>

                                </div>

                            </td>


                            {{-- =================================================
                                 Properties
                            ================================================== --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400">

                                        <i class="fa-solid fa-building"></i>

                                    </div>


                                    <div>

                                        <div class="font-semibold text-white">

                                            {{ $agent->properties_count ?? 0 }}

                                        </div>

                                        <div class="text-xs text-slate-500">

                                            {{ ($agent->properties_count ?? 0) == 1 ? 'Property' : 'Properties' }}

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                 Account Type
                            ================================================== --}}
                            <td class="px-6 py-4">

                                <span class="inline-flex items-center gap-2 rounded-full border border-blue-500/20 bg-blue-500/10 px-3 py-1.5 text-xs font-medium text-blue-400">

                                    <i class="fa-solid fa-user-tie"></i>

                                    Agent

                                </span>

                            </td>


                            {{-- =================================================
                                 Joined
                            ================================================== --}}
                            <td class="px-6 py-4">

                                <div class="text-sm text-slate-300">

                                    {{ $agent->created_at?->format('d M Y') }}

                                </div>

                                <div class="text-xs text-slate-500">

                                    {{ $agent->created_at?->format('h:i A') }}

                                </div>

                            </td>

                        </tr>


                    @empty


                        {{-- =================================================
                             EMPTY STATE
                        ================================================== --}}
                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-800 text-slate-500">

                                    <i class="fa-solid fa-user-tie text-2xl"></i>

                                </div>


                                <h3 class="mt-4 text-lg font-semibold text-white">
                                    No Agents Found
                                </h3>


                                <p class="mt-1 text-sm text-slate-500">
                                    No users have registered as an agent yet.
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
        @if($agents->hasPages())

            <div class="border-t border-slate-700 px-6 py-4">

                {{ $agents->links() }}

            </div>

        @endif


    </div>

</div>

@endsection