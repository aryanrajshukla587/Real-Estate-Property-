<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyTransaction;

class DashboardController extends Controller
{
    /**
     * Agent Dashboard
     */
    public function index()
    {
        // =====================================================
        // LOGGED-IN AGENT
        // =====================================================

        $agentId = auth('agent')->id();


        // =====================================================
        // BASIC PROPERTY STATISTICS
        // =====================================================

        // Total properties added by this agent.
        // Includes pending, approved and rejected properties.
        $totalProperties = Property::where(
            'agent_id',
            $agentId
        )->count();


        // =====================================================
        // PROPERTY APPROVAL STATISTICS
        // =====================================================

        // Properties waiting for Super Admin approval.
        $pendingProperties = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
            'approval_status',
            'pending'
        )
        ->count();


        // Properties approved by Super Admin.
        $approvedProperties = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
            'approval_status',
            'approved'
        )
        ->count();


        // Properties rejected by Super Admin.
        $rejectedProperties = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
            'approval_status',
            'rejected'
        )
        ->count();


        // =====================================================
        // PROPERTY STATUS STATISTICS
        // =====================================================
        //
        // IMPORTANT:
        // `status` is market status.
        //
        // `approval_status` is admin approval status.
        //
        // Therefore:
        //
        // Available = approved + active + available
        // Sold      = approved + sold
        // Rented    = approved + rented
        //
        // =====================================================


        // Available Properties
        $availableProperties = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
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


        // Sold Properties
        $soldProperties = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
            'approval_status',
            'approved'
        )
        ->where(
            'status',
            'sold'
        )
        ->count();


        // Rented Properties
        $rentedProperties = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
            'approval_status',
            'approved'
        )
        ->where(
            'status',
            'rented'
        )
        ->count();


        // =====================================================
        // PROPERTY PURPOSE STATISTICS
        // =====================================================

        // Available properties for Sale
        $forSaleProperties = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
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


        // Available properties for Rent
        $forRentProperties = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
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


        // =====================================================
        // FEATURED PROPERTIES
        // =====================================================
        //
        // Featured count only includes properties that are:
        //
        // approved
        // active
        // available
        // featured
        //
        // =====================================================

        $featuredProperties = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
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


        // =====================================================
        // TOTAL PORTFOLIO VALUE
        // =====================================================
        //
        // Portfolio value represents currently approved
        // and active inventory.
        //
        // =====================================================

        $totalPropertyValue = Property::where(
            'agent_id',
            $agentId
        )
        ->where(
            'approval_status',
            'approved'
        )
        ->where(
            'is_active',
            true
        )
        ->sum('price');


        // =====================================================
        // PROPERTY REQUEST BASE QUERY
        // =====================================================
        //
        // PropertyTransaction does NOT need an agent_id.
        //
        // Agent is identified through:
        //
        // PropertyTransaction
        //        ↓
        //     property
        //        ↓
        //    agent_id
        //
        // =====================================================

        $agentTransactions = PropertyTransaction::whereHas(
            'property',
            function ($query) use ($agentId) {

                $query->where(
                    'agent_id',
                    $agentId
                );

            }
        );


        // =====================================================
        // PROPERTY REQUEST STATISTICS
        // =====================================================

        // Total Requests
        $totalRequests = (clone $agentTransactions)
            ->count();


        // Pending Requests
        $pendingRequests = (clone $agentTransactions)
            ->where(
                'status',
                'pending'
            )
            ->count();


        // Approved Requests
        $approvedRequests = (clone $agentTransactions)
            ->where(
                'status',
                'approved'
            )
            ->count();


        // Completed Deals
        $completedRequests = (clone $agentTransactions)
            ->where(
                'status',
                'completed'
            )
            ->count();


        // Buy Requests
        $buyRequests = (clone $agentTransactions)
            ->where(
                'type',
                'buy'
            )
            ->count();


        // Rent Requests
        $rentRequests = (clone $agentTransactions)
            ->where(
                'type',
                'rent'
            )
            ->count();


        // =====================================================
        // COUNTER OFFERS
        // =====================================================
        //
        // A transaction is considered a counter-offer
        // when counter_offer_amount has been filled.
        //
        // =====================================================

        $counterOffers = (clone $agentTransactions)
            ->whereNotNull(
                'counter_offer_amount'
            )
            ->count();


        // =====================================================
        // REJECTED REQUESTS
        // =====================================================

        $rejectedRequests = (clone $agentTransactions)
            ->where(
                'status',
                'rejected'
            )
            ->count();


        // =====================================================
        // RECENT PROPERTIES
        // =====================================================

        $recentProperties = Property::with([
            'propertyType',
            'location',
        ])
        ->where(
            'agent_id',
            $agentId
        )
        ->latest()
        ->take(5)
        ->get();


        // =====================================================
        // DASHBOARD VIEW
        // =====================================================

        return view(
            'agent.dashboard',
            compact(

                // -------------------------------------------------
                // PROPERTY STATISTICS
                // -------------------------------------------------

                'totalProperties',

                'availableProperties',
                'soldProperties',
                'rentedProperties',

                // -------------------------------------------------
                // APPROVAL STATISTICS
                // -------------------------------------------------

                'pendingProperties',
                'approvedProperties',
                'rejectedProperties',

                // -------------------------------------------------
                // PROPERTY PURPOSE
                // -------------------------------------------------

                'forSaleProperties',
                'forRentProperties',

                // -------------------------------------------------
                // FEATURED
                // -------------------------------------------------

                'featuredProperties',

                // -------------------------------------------------
                // PORTFOLIO
                // -------------------------------------------------

                'totalPropertyValue',

                // -------------------------------------------------
                // PROPERTY REQUESTS
                // -------------------------------------------------

                'totalRequests',
                'pendingRequests',
                'approvedRequests',
                'completedRequests',
                'buyRequests',
                'rentRequests',
                'counterOffers',
                'rejectedRequests',

                // -------------------------------------------------
                // RECENT PROPERTIES
                // -------------------------------------------------

                'recentProperties'
            )
        );
    }
}
