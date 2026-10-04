<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Subscribe to newsletter
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'max:150',
            ],
        ]);


        $subscriber = NewsletterSubscriber::where(
            'email',
            $validated['email']
        )->first();


        /*
        |--------------------------------------------------------------------------
        | ALREADY SUBSCRIBED
        |--------------------------------------------------------------------------
        */

        if ($subscriber && $subscriber->status === 'subscribed') {

            return redirect()
                ->route('home')
                ->withInput()
                ->with(
                    'newsletter_error',
                    'This email is already subscribed.'
                )
                ->withFragment('newsletter');
        }


        /*
        |--------------------------------------------------------------------------
        | PREVIOUSLY UNSUBSCRIBED
        |--------------------------------------------------------------------------
        */

        if ($subscriber) {

            $subscriber->update([
                'status' => 'subscribed',
            ]);

            return redirect()
                ->route('home')
                ->with(
                    'newsletter_success',
                    'You have successfully subscribed again!'
                )
                ->withFragment('newsletter');
        }


        /*
        |--------------------------------------------------------------------------
        | NEW SUBSCRIBER
        |--------------------------------------------------------------------------
        */

        NewsletterSubscriber::create([
            'email'  => $validated['email'],
            'status' => 'subscribed',
        ]);


        return redirect()
            ->route('home')
            ->with(
                'newsletter_success',
                'You have successfully subscribed!'
            )
            ->withFragment('newsletter');
    }
}