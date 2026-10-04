@extends('admin.layouts.app')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <h2 class="text-2xl font-bold text-white">
                Contact Messages
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                Manage messages received from your website.
            </p>
        </div>

    </div>


    {{-- STATS --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- TOTAL --}}
        <div class="rounded-2xl border border-purple-500/20 bg-slate-900 p-5 shadow-lg shadow-purple-900/10">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        Total Messages
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-white">
                        {{ $totalMessages }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-fuchsia-600 text-white">
                    <i class="fa-solid fa-envelope text-lg"></i>
                </div>

            </div>

        </div>


        {{-- NEW --}}
        <div class="rounded-2xl border border-blue-500/20 bg-slate-900 p-5 shadow-lg shadow-blue-900/10">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        New Messages
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-white">
                        {{ $newMessages }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 text-white">
                    <i class="fa-solid fa-bell text-lg"></i>
                </div>

            </div>

        </div>


        {{-- READ --}}
        <div class="rounded-2xl border border-amber-500/20 bg-slate-900 p-5 shadow-lg shadow-amber-900/10">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        Read
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-white">
                        {{ $readMessages }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 text-white">
                    <i class="fa-solid fa-envelope-open text-lg"></i>
                </div>

            </div>

        </div>


        {{-- REPLIED --}}
        <div class="rounded-2xl border border-emerald-500/20 bg-slate-900 p-5 shadow-lg shadow-emerald-900/10">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        Replied
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-white">
                        {{ $repliedMessages }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 text-white">
                    <i class="fa-solid fa-reply text-lg"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- SEARCH + FILTER --}}
    <div class="rounded-2xl border border-purple-500/20 bg-slate-900 p-5">

        <form
            method="GET"
            action="{{ route('admin.contact-messages.index') }}"
            class="grid grid-cols-1 gap-4 md:grid-cols-3"
        >

            {{-- SEARCH --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Search
                </label>

                <div class="relative">

                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Name, email or subject..."
                        class="w-full rounded-xl border border-white/10 bg-slate-800 py-3 pl-11 pr-4 text-sm text-white outline-none transition placeholder:text-gray-500 focus:border-purple-500"
                    >

                </div>

            </div>


            {{-- STATUS --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-300">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-xl border border-white/10 bg-slate-800 px-4 py-3 text-sm text-white outline-none focus:border-purple-500"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="new"
                        {{ request('status') === 'new' ? 'selected' : '' }}
                    >
                        New
                    </option>

                    <option
                        value="read"
                        {{ request('status') === 'read' ? 'selected' : '' }}
                    >
                        Read
                    </option>

                    <option
                        value="replied"
                        {{ request('status') === 'replied' ? 'selected' : '' }}
                    >
                        Replied
                    </option>

                </select>

            </div>


            {{-- BUTTON --}}
            <div class="flex items-end gap-2">

                <button
                    type="submit"
                    class="flex-1 rounded-xl bg-gradient-to-r from-purple-600 to-fuchsia-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-900/20 transition hover:scale-[1.01]"
                >
                    <i class="fa-solid fa-filter mr-2"></i>
                    Filter
                </button>

                <a
                    href="{{ route('admin.contact-messages.index') }}"
                    class="rounded-xl border border-white/10 bg-slate-800 px-5 py-3 text-sm font-semibold text-gray-300 transition hover:bg-slate-700 hover:text-white"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- TABLE --}}
    <div class="overflow-hidden rounded-2xl border border-purple-500/20 bg-slate-900">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="border-b border-white/10 bg-slate-800/60">

                    <tr>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            #
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Contact
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Subject
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Message
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Status
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Date
                        </th>

                        <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-white/5">

                    @forelse($messages as $message)

                        <tr class="transition hover:bg-white/[0.02]">

                            {{-- NUMBER --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-500">
                                {{ $messages->firstItem() + $loop->index }}
                            </td>


                            {{-- CONTACT --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-fuchsia-600 text-sm font-bold text-white">
                                        {{ strtoupper(substr($message->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-white">
                                            {{ $message->name }}
                                        </p>

                                        <p class="truncate text-xs text-gray-500">
                                            {{ $message->email }}
                                        </p>

                                        @if($message->phone)

                                            <p class="text-xs text-gray-500">
                                                {{ $message->phone }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- SUBJECT --}}
                            <td class="max-w-[180px] px-5 py-4">

                                <p class="truncate text-sm font-medium text-gray-300">
                                    {{ $message->subject ?: 'No Subject' }}
                                </p>

                            </td>


                            {{-- MESSAGE --}}
                            <td class="max-w-[280px] px-5 py-4">

                                <p class="line-clamp-2 text-sm text-gray-400">
                                    {{ $message->message }}
                                </p>

                            </td>


                            {{-- STATUS --}}
                            <td class="px-5 py-4">

                                @if($message->status === 'new')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-500/10 px-3 py-1.5 text-xs font-semibold text-blue-400">

                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-400"></span>

                                        New

                                    </span>

                                @elseif($message->status === 'read')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500/10 px-3 py-1.5 text-xs font-semibold text-amber-400">

                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>

                                        Read

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1.5 text-xs font-semibold text-emerald-400">

                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                        Replied

                                    </span>

                                @endif

                            </td>


                            {{-- DATE --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-400">

                                {{ $message->created_at->format('d M Y') }}

                                <div class="text-xs text-gray-600">
                                    {{ $message->created_at->format('h:i A') }}
                                </div>

                            </td>


                            {{-- ACTIONS --}}
                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">

                                    {{-- STATUS --}}
                                    <form
                                        action="{{ route('admin.contact-messages.update', $message) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('PUT')

                                        <select
                                            name="status"
                                            onchange="this.form.submit()"
                                            class="rounded-lg border border-white/10 bg-slate-800 px-3 py-2 text-xs text-gray-300 outline-none focus:border-purple-500"
                                        >

                                            <option
                                                value="new"
                                                {{ $message->status === 'new' ? 'selected' : '' }}
                                            >
                                                New
                                            </option>

                                            <option
                                                value="read"
                                                {{ $message->status === 'read' ? 'selected' : '' }}
                                            >
                                                Read
                                            </option>

                                            <option
                                                value="replied"
                                                {{ $message->status === 'replied' ? 'selected' : '' }}
                                            >
                                                Replied
                                            </option>

                                        </select>

                                    </form>


                                    {{-- REPLY --}}
                                    <button
                                        type="button"
                                        onclick="openReplyModal(
                                            {{ $message->id }},
                                            @js($message->name),
                                            @js($message->email),
                                            @js($message->subject)
                                        )"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-cyan-500/20 bg-cyan-500/10 text-cyan-400 transition hover:bg-cyan-500/20 hover:text-cyan-300"
                                        title="Reply"
                                    >
                                        <i class="fa-solid fa-reply"></i>
                                    </button>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('admin.contact-messages.destroy', $message) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this message?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-red-500/20 bg-red-500/10 text-red-400 transition hover:bg-red-500/20 hover:text-red-300"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-5 py-16 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-purple-500/10 text-purple-400">
                                        <i class="fa-solid fa-envelope-open text-2xl"></i>
                                    </div>

                                    <h3 class="text-lg font-semibold text-white">
                                        No Messages Found
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Contact messages will appear here.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($messages->hasPages())

            <div class="border-t border-white/10 px-5 py-4">
                {{ $messages->links() }}
            </div>

        @endif

    </div>

</div>


{{-- =========================================================
     REPLY MODAL
========================================================= --}}

<div
    id="replyModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/70 px-4 backdrop-blur-sm"
>

    <div
        class="w-full max-w-2xl overflow-hidden rounded-2xl border border-cyan-500/20 bg-slate-900 shadow-2xl shadow-cyan-900/20"
    >

        {{-- MODAL HEADER --}}
        <div class="flex items-center justify-between border-b border-white/10 px-6 py-5">

            <div>

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 text-white">
                        <i class="fa-solid fa-reply"></i>
                    </div>

                    <div>

                        <h3 class="text-lg font-bold text-white">
                            Reply to Contact
                        </h3>

                        <p class="text-xs text-gray-500">
                            Send an email reply to this customer.
                        </p>

                    </div>

                </div>

            </div>


            {{-- CLOSE --}}
            <button
                type="button"
                onclick="closeReplyModal()"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-white/10 hover:text-white"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>


        {{-- FORM --}}
        <form
            id="replyForm"
            method="POST"
            action=""
        >

            @csrf

            <div class="space-y-5 p-6">

                {{-- CUSTOMER --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    {{-- NAME --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-300">
                            Customer
                        </label>

                        <input
                            type="text"
                            id="replyCustomerName"
                            readonly
                            class="w-full rounded-xl border border-white/10 bg-slate-800 px-4 py-3 text-sm text-gray-300 outline-none"
                        >

                    </div>


                    {{-- EMAIL --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-300">
                            To
                        </label>

                        <input
                            type="email"
                            id="replyCustomerEmail"
                            readonly
                            class="w-full rounded-xl border border-white/10 bg-slate-800 px-4 py-3 text-sm text-gray-300 outline-none"
                        >

                    </div>

                </div>


                {{-- SUBJECT --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-300">
                        Subject
                    </label>

                    <input
                        type="text"
                        name="subject"
                        id="replySubject"
                        required
                        maxlength="255"
                        placeholder="Enter email subject..."
                        class="w-full rounded-xl border border-white/10 bg-slate-800 px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-500 focus:border-cyan-500"
                    >

                </div>


                {{-- MESSAGE --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-300">
                        Message
                    </label>

                    <textarea
                        name="message"
                        id="replyMessage"
                        rows="7"
                        required
                        placeholder="Write your reply..."
                        class="w-full resize-none rounded-xl border border-white/10 bg-slate-800 px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-500 focus:border-cyan-500"
                    ></textarea>

                </div>

            </div>


            {{-- MODAL FOOTER --}}
            <div class="flex flex-col-reverse gap-3 border-t border-white/10 bg-slate-800/30 px-6 py-4 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    onclick="closeReplyModal()"
                    class="rounded-xl border border-white/10 bg-slate-800 px-5 py-3 text-sm font-semibold text-gray-300 transition hover:bg-slate-700 hover:text-white"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-900/20 transition hover:scale-[1.01]"
                >
                    <i class="fa-solid fa-paper-plane mr-2"></i>
                    Send Reply
                </button>

            </div>

        </form>

    </div>

</div>


{{-- =========================================================
     REPLY MODAL JAVASCRIPT
========================================================= --}}

<script>

    function openReplyModal(id, name, email, subject) {

        const modal = document.getElementById('replyModal');

        const form = document.getElementById('replyForm');

        const customerName = document.getElementById('replyCustomerName');

        const customerEmail = document.getElementById('replyCustomerEmail');

        const replySubject = document.getElementById('replySubject');

        const replyMessage = document.getElementById('replyMessage');


        /*
        |--------------------------------------------------------------------------
        | FORM ACTION
        |--------------------------------------------------------------------------
        */

        form.action = "{{ url('admin/contact-messages') }}/" + id + "/reply";


        /*
        |--------------------------------------------------------------------------
        | CUSTOMER DETAILS
        |--------------------------------------------------------------------------
        */

        customerName.value = name;

        customerEmail.value = email;


        /*
        |--------------------------------------------------------------------------
        | SUBJECT
        |--------------------------------------------------------------------------
        */

        if (subject && subject.trim() !== '') {

            if (subject.toLowerCase().startsWith('re:')) {

                replySubject.value = subject;

            } else {

                replySubject.value = 'Re: ' + subject;

            }

        } else {

            replySubject.value = 'Reply to your contact message';

        }


        /*
        |--------------------------------------------------------------------------
        | MESSAGE RESET
        |--------------------------------------------------------------------------
        */

        replyMessage.value = '';


        /*
        |--------------------------------------------------------------------------
        | SHOW MODAL
        |--------------------------------------------------------------------------
        */

        modal.classList.remove('hidden');

        modal.classList.add('flex');


        /*
        |--------------------------------------------------------------------------
        | BODY SCROLL LOCK
        |--------------------------------------------------------------------------
        */

        document.body.classList.add('overflow-hidden');


        /*
        |--------------------------------------------------------------------------
        | FOCUS MESSAGE
        |--------------------------------------------------------------------------
        */

        setTimeout(() => {

            replyMessage.focus();

        }, 100);

    }


    function closeReplyModal() {

        const modal = document.getElementById('replyModal');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE WHEN CLICKING OUTSIDE
    |--------------------------------------------------------------------------
    */

    document.getElementById('replyModal').addEventListener('click', function (event) {

        if (event.target === this) {

            closeReplyModal();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | ESC KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            const modal = document.getElementById('replyModal');

            if (!modal.classList.contains('hidden')) {

                closeReplyModal();

            }

        }

    });

</script>

@endsection