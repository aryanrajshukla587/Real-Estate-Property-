<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class OwnerDashboardController extends Controller
{
    /**
     * Owner Dashboard
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CURRENT OWNER
        |--------------------------------------------------------------------------
        */

        $owner = $request->user();


        /*
        |--------------------------------------------------------------------------
        | OWNER PROPERTIES BASE QUERY
        |--------------------------------------------------------------------------
        |
        | Sirf current logged-in owner ki properties.
        |
        */

        $properties = Property::where(
            'user_id',
            $owner->id
        );


        /*
        |--------------------------------------------------------------------------
        | PROPERTY COUNTS
        |--------------------------------------------------------------------------
        */

        // Total properties
        $totalProperties = (clone $properties)
            ->count();


        // Pending approval
        $pendingProperties = (clone $properties)
            ->where('approval_status', 'pending')
            ->count();


        // Active properties
        //
        // Approved
        // Available
        // Active
        //
        $activeProperties = (clone $properties)
            ->where('approval_status', 'approved')
            ->where('status', 'available')
            ->where('is_active', true)
            ->count();


        // Rejected properties
        $rejectedProperties = (clone $properties)
            ->where('approval_status', 'rejected')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | SALE / RENT COUNTS
        |--------------------------------------------------------------------------
        */

        // Properties listed for sale
        $forSaleProperties = (clone $properties)
            ->where('purpose', 'sale')
            ->count();


        // Properties listed for rent
        $forRentProperties = (clone $properties)
            ->where('purpose', 'rent')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | ASSIGNED AGENTS
        |--------------------------------------------------------------------------
        |
        | Unique agents assigned to owner's properties.
        |
        */

        $assignedAgents = (clone $properties)
            ->whereNotNull('agent_id')
            ->distinct('agent_id')
            ->count('agent_id');


        /*
        |--------------------------------------------------------------------------
        | RECENT PROPERTIES
        |--------------------------------------------------------------------------
        |
        | Latest 5 properties of the current owner.
        |
        | Relationships are eager loaded so Blade does not
        | generate unnecessary queries.
        |
        */

        $recentProperties = Property::with([
            'propertyType',
            'location',
            'agent',
        ])
            ->where(
                'user_id',
                $owner->id
            )
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PROPERTY ENQUIRIES
        |--------------------------------------------------------------------------
        |
        | Dedicated property_enquiries module abhi implement nahi hua.
        |
        | Jab PropertyEnquiry model/table ready hoga,
        | yahan dynamic count add kar denge.
        |
        */

        $propertyEnquiries = 0;


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD VIEW
        |--------------------------------------------------------------------------
        */

        return view('owner.dashboard', [

            'owner' => $owner,

            /*
             * Main property statistics
             */
            'totalProperties' => $totalProperties,

            'pendingProperties' => $pendingProperties,

            'activeProperties' => $activeProperties,

            'rejectedProperties' => $rejectedProperties,


            /*
             * Sale / Rent statistics
             */
            'forSaleProperties' => $forSaleProperties,

            'forRentProperties' => $forRentProperties,


            /*
             * Agent statistics
             */
            'assignedAgents' => $assignedAgents,


            /*
             * Enquiries
             */
            'propertyEnquiries' => $propertyEnquiries,


            /*
             * Recent properties
             */
            'recentProperties' => $recentProperties,
        ]);
    }
}