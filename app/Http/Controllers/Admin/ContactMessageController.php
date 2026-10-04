<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    /**
     * Display contact messages.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $messages = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // Dashboard statistics
        $totalMessages = ContactMessage::count();

        $newMessages = ContactMessage::where(
            'status',
            'new'
        )->count();

        $readMessages = ContactMessage::where(
            'status',
            'read'
        )->count();

        $repliedMessages = ContactMessage::where(
            'status',
            'replied'
        )->count();

        return view(
            'admin.contact-messages.index',
            compact(
                'messages',
                'totalMessages',
                'newMessages',
                'readMessages',
                'repliedMessages'
            )
        );
    }


    /**
     * Send reply to contact message email.
     */
    public function reply(
        Request $request,
        ContactMessage $contactMessage
    ) {
        $validated = $request->validate([
            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'message' => [
                'required',
                'string',
            ],
        ]);

        // Send email
        Mail::raw(
            $validated['message'],
            function ($mail) use (
                $validated,
                $contactMessage
            ) {
                $mail
                    ->to($contactMessage->email)
                    ->subject($validated['subject']);
            }
        );

        // Mark message as replied
        $contactMessage->update([
            'status' => 'replied',
        ]);

        return redirect()
            ->route('admin.contact-messages.index')
            ->with(
                'success',
                'Reply sent successfully to ' .
                $contactMessage->email
            );
    }


    /**
     * Update message status.
     */
    public function update(
        Request $request,
        ContactMessage $contactMessage
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:new,read,replied',
            ],
        ]);

        $contactMessage->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.contact-messages.index')
            ->with(
                'success',
                'Message status updated successfully.'
            );
    }


    /**
     * Delete contact message.
     */
    public function destroy(
        ContactMessage $contactMessage
    ) {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with(
                'success',
                'Contact message deleted successfully.'
            );
    }
}
