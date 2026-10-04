<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyTransaction;
use App\Models\PropertyType;
use App\Models\Location;
use App\Models\User;
use App\Models\NewsletterSubscriber;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | PROPERTY COUNTS
        |--------------------------------------------------------------------------
        |
        | Total Properties:
        | Admin ke database mein saari properties.
        |
        | Available / Sale / Rent / Featured:
        | Sirf approved + active properties ko public inventory maana jayega.
        |
        */

        $totalProperties = Property::count();


        /*
        |--------------------------------------------------------------------------
        | APPROVAL STATUS COUNTS
        |--------------------------------------------------------------------------
        */

        $pendingProperties = Property::where(
            'approval_status',
            'pending'
        )->count();

        $approvedProperties = Property::where(
            'approval_status',
            'approved'
        )->count();

        $rejectedProperties = Property::where(
            'approval_status',
            'rejected'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | PUBLIC / ACTIVE PROPERTY COUNTS
        |--------------------------------------------------------------------------
        */

        $availableProperties = Property::where(
            'approval_status',
            'approved'
        )
        ->where(
            'is_active',
            true
        )
        ->where(
            'status',
            'available'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | SOLD PROPERTIES
        |--------------------------------------------------------------------------
        */

        $soldProperties = Property::where(
            'approval_status',
            'approved'
        )
        ->where(
            'status',
            'sold'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | RENTED PROPERTIES
        |--------------------------------------------------------------------------
        */

        $rentedProperties = Property::where(
            'approval_status',
            'approved'
        )
        ->where(
            'status',
            'rented'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | FEATURED PROPERTIES
        |--------------------------------------------------------------------------
        |
        | Featured ka matlab public featured listing.
        | Isliye approved + active + available hona zaroori hai.
        |
        */

        $featuredProperties = Property::where(
            'approval_status',
            'approved'
        )
        ->where(
            'is_active',
            true
        )
        ->where(
            'status',
            'available'
        )
        ->where(
            'is_featured',
            true
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | PROPERTY PURPOSE
        |--------------------------------------------------------------------------
        |
        | Sirf publicly available properties.
        |
        */

        $forSaleProperties = Property::where(
            'approval_status',
            'approved'
        )
        ->where(
            'is_active',
            true
        )
        ->where(
            'purpose',
            'sale'
        )
        ->where(
            'status',
            'available'
        )
        ->count();


        $forRentProperties = Property::where(
            'approval_status',
            'approved'
        )
        ->where(
            'is_active',
            true
        )
        ->where(
            'purpose',
            'rent'
        )
        ->where(
            'status',
            'available'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | PROPERTY TYPES
        |--------------------------------------------------------------------------
        */

        $totalPropertyTypes = PropertyType::count();


        /*
        |--------------------------------------------------------------------------
        | LOCATIONS
        |--------------------------------------------------------------------------
        */

        $totalLocations = Location::count();


        /*
        |--------------------------------------------------------------------------
        | AGENTS
        |--------------------------------------------------------------------------
        */

        $totalAgents = User::where(
            'role',
            'agent'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PROPERTY VALUE
        |--------------------------------------------------------------------------
        |
        | Dashboard inventory value:
        | Approved + active properties only.
        |
        */

        $totalPropertyValue = Property::where(
            'approval_status',
            'approved'
        )
        ->where(
            'is_active',
            true
        )
        ->sum('price');


        /*
        |--------------------------------------------------------------------------
        | PROPERTY TRANSACTION COUNTS
        |--------------------------------------------------------------------------
        |
        | Admin dashboard par saare property requests count honge.
        |
        */

        $totalRequests = PropertyTransaction::count();


        $pendingRequests = PropertyTransaction::where(
            'status',
            'pending'
        )->count();


        $approvedRequests = PropertyTransaction::where(
            'status',
            'approved'
        )->count();


        $completedRequests = PropertyTransaction::where(
            'status',
            'completed'
        )->count();


        $buyRequests = PropertyTransaction::where(
            'type',
            'buy'
        )->count();


        $rentRequests = PropertyTransaction::where(
            'type',
            'rent'
        )->count();


        $counterOffers = PropertyTransaction::whereNotNull(
            'counter_offer_amount'
        )->count();


        $rejectedRequests = PropertyTransaction::where(
            'status',
            'rejected'
        )->count();


        $cancelledTransactions = PropertyTransaction::where(
            'status',
            'cancelled'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | NEWSLETTER SUBSCRIBERS
        |--------------------------------------------------------------------------
        */

        $totalNewsletterSubscribers = NewsletterSubscriber::count();


        /*
        |--------------------------------------------------------------------------
        | CONTACT MESSAGES
        |--------------------------------------------------------------------------
        */

        $totalContactMessages = ContactMessage::count();


        /*
        |--------------------------------------------------------------------------
        | RECENT PROPERTIES
        |--------------------------------------------------------------------------
        |
        | Agent relationship bhi load kar rahe hain taaki dashboard
        | par property owner/agent information available rahe.
        |
        */

        $recentProperties = Property::with([
            'propertyType',
            'location',
            'agent',
        ])
        ->latest()
        ->take(10)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'totalProperties',

                'totalPropertyTypes',
                'totalLocations',
                'totalAgents',

                'availableProperties',
                'featuredProperties',
                'forSaleProperties',
                'forRentProperties',
                'soldProperties',
                'rentedProperties',

                'pendingProperties',
                'approvedProperties',
                'rejectedProperties',

                'totalRequests',
                'pendingRequests',
                'approvedRequests',
                'completedRequests',
                'buyRequests',
                'rentRequests',
                'counterOffers',
                'rejectedRequests',
                'cancelledTransactions',

                'totalPropertyValue',

                'totalNewsletterSubscribers',
                'totalContactMessages',

                'recentProperties'
            )
        );
    }
}
