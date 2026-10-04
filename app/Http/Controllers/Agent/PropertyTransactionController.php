<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\PropertyTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyTransactionController extends Controller
{
    /**
     * Display property transaction requests
     * belonging only to the logged-in agent's properties.
     */
    public function index(Request $request)
    {
        $agent = auth('agent')->user();

        $query = PropertyTransaction::with([
            'user',
            'property.propertyType',
            'property.location',
            'property.agent',
        ])
        ->whereHas('property', function ($propertyQuery) use ($agent) {

            $propertyQuery->where(
                'agent_id',
                $agent->id
            );

        })
        ->latest();


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'email',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'phone',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('property', function ($propertyQuery) use ($search) {

                    $propertyQuery
                        ->where(
                            'title',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'address',
                            'like',
                            '%' . $search . '%'
                        );
                });
            });
        }


        /*
        |--------------------------------------------------------------------------
        | TYPE FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('type')) {

            $query->where(
                'type',
                $request->type
            );
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $transactions = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | AGENT-SPECIFIC COUNTS
        |--------------------------------------------------------------------------
        */

        $agentPropertiesQuery = function ($query) use ($agent) {

            $query->whereHas('property', function ($propertyQuery) use ($agent) {

                $propertyQuery->where(
                    'agent_id',
                    $agent->id
                );

            });
        };


        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $totalTransactions = PropertyTransaction::where(
            $agentPropertiesQuery
        )->count();


        /*
        |--------------------------------------------------------------------------
        | PENDING
        |--------------------------------------------------------------------------
        */

        $pendingTransactions = PropertyTransaction::where(
            $agentPropertiesQuery
        )
        ->where(
            'status',
            'pending'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | APPROVED
        |--------------------------------------------------------------------------
        */

        $approvedTransactions = PropertyTransaction::where(
            $agentPropertiesQuery
        )
        ->where(
            'status',
            'approved'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | COMPLETED
        |--------------------------------------------------------------------------
        */

        $completedTransactions = PropertyTransaction::where(
            $agentPropertiesQuery
        )
        ->where(
            'status',
            'completed'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | REJECTED
        |--------------------------------------------------------------------------
        */

        $rejectedTransactions = PropertyTransaction::where(
            $agentPropertiesQuery
        )
        ->where(
            'status',
            'rejected'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | CANCELLED
        |--------------------------------------------------------------------------
        */

        $cancelledTransactions = PropertyTransaction::where(
            $agentPropertiesQuery
        )
        ->where(
            'status',
            'cancelled'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | BUY
        |--------------------------------------------------------------------------
        */

        $buyTransactions = PropertyTransaction::where(
            $agentPropertiesQuery
        )
        ->where(
            'type',
            'buy'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | RENT
        |--------------------------------------------------------------------------
        */

        $rentTransactions = PropertyTransaction::where(
            $agentPropertiesQuery
        )
        ->where(
            'type',
            'rent'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'agent.property-transactions.index',
            compact(
                'transactions',
                'totalTransactions',
                'pendingTransactions',
                'approvedTransactions',
                'completedTransactions',
                'rejectedTransactions',
                'cancelledTransactions',
                'buyTransactions',
                'rentTransactions'
            )
        );
    }


    /**
     * Display a single transaction.
     */
    public function show(
        PropertyTransaction $transaction
    ) {
        $agent = auth('agent')->user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        if (
            !$transaction->property ||
            $transaction->property->agent_id !== $agent->id
        ) {

            abort(
                403,
                'You are not authorized to view this property request.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONSHIPS
        |--------------------------------------------------------------------------
        */

        $transaction->load([
            'user',
            'property.propertyType',
            'property.location',
            'property.agent',
        ]);


        return view(
            'agent.property-transactions.show',
            compact('transaction')
        );
    }


    /**
     * Update counter offer.
     */
    public function updateCounterOffer(
        Request $request,
        PropertyTransaction $transaction
    ) {
        $agent = auth('agent')->user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        if (
            !$transaction->property ||
            $transaction->property->agent_id !== $agent->id
        ) {

            abort(
                403,
                'You are not authorized to modify this property request.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'counter_offer_amount' => [
                'required',
                'numeric',
                'min:1',
                'max:999999999999.99',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | PROTECT FINAL STATUSES
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $transaction->status,
                [
                    'cancelled',
                    'completed',
                    'rejected',
                ]
            )
        ) {

            return back()->with(
                'error',
                'Counter offer cannot be modified for this request.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE COUNTER OFFER
        |--------------------------------------------------------------------------
        */

        $transaction->counter_offer_amount =
            $validated['counter_offer_amount'];

        $transaction->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'agent.property-transactions.show',
                $transaction
            )
            ->with(
                'success',
                'Counter offer updated successfully.'
            );
    }


    /**
     * Update transaction status.
     */
    public function updateStatus(
        Request $request,
        PropertyTransaction $transaction
    ) {
        $agent = auth('agent')->user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        if (
            !$transaction->property ||
            $transaction->property->agent_id !== $agent->id
        ) {

            abort(
                403,
                'You are not authorized to modify this property request.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'status' => [
                'required',
                'in:pending,approved,rejected,completed',
            ],

            'admin_note' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | CANCELLED REQUEST
        |--------------------------------------------------------------------------
        */

        if ($transaction->status === 'cancelled') {

            return back()->with(
                'error',
                'Cancelled requests cannot be modified.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | COMPLETED REQUEST
        |--------------------------------------------------------------------------
        */

        if ($transaction->status === 'completed') {

            return back()->with(
                'error',
                'Completed requests cannot be modified by an agent.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS + PROPERTY SYNC
        |--------------------------------------------------------------------------
        */

        try {

            DB::transaction(function () use (
                $transaction,
                $validated
            ) {

                /*
                |--------------------------------------------------------------------------
                | REFRESH TRANSACTION
                |--------------------------------------------------------------------------
                */

                $transaction->refresh();


                /*
                |--------------------------------------------------------------------------
                | LOCK PROPERTY
                |--------------------------------------------------------------------------
                */

                $property = $transaction
                    ->property()
                    ->lockForUpdate()
                    ->first();


                if (!$property) {

                    throw new \Exception(
                        'The related property no longer exists.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | COMPLETED
                |--------------------------------------------------------------------------
                */

                if ($validated['status'] === 'completed') {


                    /*
                    |--------------------------------------------------------------------------
                    | BUY
                    |--------------------------------------------------------------------------
                    */

                    if ($transaction->type === 'buy') {

                        if ($property->purpose !== 'sale') {

                            throw new \Exception(
                                'This property is not available for sale.'
                            );
                        }


                        /*
                        |------------------------------------------------------------------
                        | PROPERTY MUST BE AVAILABLE
                        |------------------------------------------------------------------
                        */

                        if ($property->status !== 'available') {

                            throw new \Exception(
                                'This property is no longer available.'
                            );
                        }


                        /*
                        |------------------------------------------------------------------
                        | MARK PROPERTY SOLD
                        |------------------------------------------------------------------
                        */

                        $property->update([
                            'status' => 'sold',
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | RENT
                    |--------------------------------------------------------------------------
                    */

                    elseif ($transaction->type === 'rent') {

                        if ($property->purpose !== 'rent') {

                            throw new \Exception(
                                'This property is not available for rent.'
                            );
                        }


                        /*
                        |------------------------------------------------------------------
                        | PROPERTY MUST BE AVAILABLE
                        |------------------------------------------------------------------
                        */

                        if ($property->status !== 'available') {

                            throw new \Exception(
                                'This property is no longer available.'
                            );
                        }


                        /*
                        |------------------------------------------------------------------
                        | MARK PROPERTY RENTED
                        |------------------------------------------------------------------
                        */

                        $property->update([
                            'status' => 'rented',
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | INVALID TRANSACTION TYPE
                    |--------------------------------------------------------------------------
                    */

                    else {

                        throw new \Exception(
                            'Invalid transaction type.'
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | UPDATE TRANSACTION
                    |--------------------------------------------------------------------------
                    */

                    $transaction->update([

                        'status' => 'completed',

                        'admin_note' =>
                            $validated['admin_note'] ?? null,

                    ]);
                }


                /*
                |--------------------------------------------------------------------------
                | PENDING / APPROVED / REJECTED
                |--------------------------------------------------------------------------
                */

                else {


                    /*
                    |--------------------------------------------------------------------------
                    | CHECK OTHER COMPLETED TRANSACTION
                    |--------------------------------------------------------------------------
                    */

                    $otherCompletedTransactionExists =
                        PropertyTransaction::where(
                            'property_id',
                            $property->id
                        )
                        ->where(
                            'status',
                            'completed'
                        )
                        ->where(
                            'id',
                            '!=',
                            $transaction->id
                        )
                        ->exists();


                    /*
                    |--------------------------------------------------------------------------
                    | MAKE PROPERTY AVAILABLE
                    |--------------------------------------------------------------------------
                    */

                    if (!$otherCompletedTransactionExists) {

                        $property->update([
                            'status' => 'available',
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | UPDATE TRANSACTION
                    |--------------------------------------------------------------------------
                    */

                    $transaction->update([

                        'status' => $validated['status'],

                        'admin_note' =>
                            $validated['admin_note'] ?? null,

                    ]);
                }
            });


        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'agent.property-transactions.index'
            )
            ->with(
                'success',
                'Property request status updated successfully.'
            );
    }
}