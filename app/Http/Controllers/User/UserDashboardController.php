<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = $user->propertyTransactions()
            ->with([
                'property.propertyType',
                'property.location',
            ])
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $totalTransactions = $transactions->count();


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION TYPE
        |--------------------------------------------------------------------------
        */

        $buyRequests = $transactions
            ->where('type', 'buy')
            ->count();

        $rentRequests = $transactions
            ->where('type', 'rent')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $pendingRequests = $transactions
            ->where('status', 'pending')
            ->count();

        $approvedRequests = $transactions
            ->where('status', 'approved')
            ->count();

        $completedRequests = $transactions
            ->where('status', 'completed')
            ->count();

        $rejectedRequests = $transactions
            ->where('status', 'rejected')
            ->count();

        $cancelledRequests = $transactions
            ->where('status', 'cancelled')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'user.dashboard',
            compact(
                'user',
                'transactions',

                'totalTransactions',

                'buyRequests',
                'rentRequests',

                'pendingRequests',
                'approvedRequests',
                'completedRequests',
                'rejectedRequests',
                'cancelledRequests'
            )
        );
    }
}