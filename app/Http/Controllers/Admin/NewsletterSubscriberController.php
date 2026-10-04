<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    /**
     * Display newsletter subscribers.
     */
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where('email', 'like', "%{$search}%");
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }


        /*
        |--------------------------------------------------------------------------
        | SUBSCRIBERS
        |--------------------------------------------------------------------------
        */

        $subscribers = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | COUNTS
        |--------------------------------------------------------------------------
        */

        $totalSubscribers = NewsletterSubscriber::count();

        $activeSubscribers = NewsletterSubscriber::where(
            'status',
            'subscribed'
        )->count();

        $unsubscribed = NewsletterSubscriber::where(
            'status',
            'unsubscribed'
        )->count();


        return view(
            'admin.newsletter-subscribers.index',
            compact(
                'subscribers',
                'totalSubscribers',
                'activeSubscribers',
                'unsubscribed'
            )
        );
    }


    /**
     * Update subscriber status.
     */
    public function update(Request $request, NewsletterSubscriber $newsletterSubscriber)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:subscribed,unsubscribed',
            ],
        ]);


        $newsletterSubscriber->update([
            'status' => $validated['status'],
        ]);


        return redirect()
            ->route('admin.newsletter-subscribers.index')
            ->with(
                'success',
                'Subscriber status updated successfully.'
            );
    }


    /**
     * Delete subscriber.
     */
    public function destroy(NewsletterSubscriber $newsletterSubscriber)
    {
        $newsletterSubscriber->delete();


        return redirect()
            ->route('admin.newsletter-subscribers.index')
            ->with(
                'success',
                'Subscriber deleted successfully.'
            );
    }
}
