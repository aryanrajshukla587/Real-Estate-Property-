<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\PropertyTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerPropertyTransactionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | OWNER TRANSACTION QUERY
    |--------------------------------------------------------------------------
    |
    | Owner ko sirf unhi transactions ka access milega
    | jinki property logged-in owner ki hai.
    |
    */

    private function ownerTransactions(Request $request)
    {
        $owner = $request->user();

        return PropertyTransaction::query()
            ->whereHas('property', function ($query) use ($owner) {

                $query->where(
                    'user_id',
                    $owner->id
                );

            })
            ->with([
                'user',
                'property.propertyType',
                'property.location',
                'property.agent',
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | LOGGED-IN OWNER
        |--------------------------------------------------------------------------
        */

        $owner = $request->user();


        /*
        |--------------------------------------------------------------------------
        | BASE QUERY
        |--------------------------------------------------------------------------
        */

        $query = $this->ownerTransactions($request);


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
            ->latest()
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | OWNER-SPECIFIC TRANSACTION COUNTS
        |--------------------------------------------------------------------------
        */

        $ownerPropertiesQuery = function ($query) use ($owner) {

            $query->whereHas('property', function ($propertyQuery) use ($owner) {

                $propertyQuery->where(
                    'user_id',
                    $owner->id
                );

            });
        };


        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $totalTransactions = PropertyTransaction::where(
            $ownerPropertiesQuery
        )->count();


        /*
        |--------------------------------------------------------------------------
        | PENDING
        |--------------------------------------------------------------------------
        */

        $pendingTransactions = PropertyTransaction::where(
            $ownerPropertiesQuery
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
            $ownerPropertiesQuery
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
            $ownerPropertiesQuery
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
            $ownerPropertiesQuery
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
            $ownerPropertiesQuery
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
            $ownerPropertiesQuery
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
            $ownerPropertiesQuery
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
            'owner.property-transactions.index',
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


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        PropertyTransaction $transaction
    ) {

        $owner = auth('web')->user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */

        if (
            !$transaction->property ||
            $transaction->property->user_id !== $owner->id
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


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'owner.property-transactions.show',
            compact('transaction')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE COUNTER OFFER
    |--------------------------------------------------------------------------
    */

    public function updateCounterOffer(
        Request $request,
        PropertyTransaction $transaction
    ) {

        $owner = auth('web')->user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */

        if (
            !$transaction->property ||
            $transaction->property->user_id !== $owner->id
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
        | SAVE COUNTER OFFER
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
                'owner.property-transactions.show',
                $transaction
            )
            ->with(
                'success',
                'Counter offer updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        PropertyTransaction $transaction
    ) {

        $owner = auth('web')->user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */

        if (
            !$transaction->property ||
            $transaction->property->user_id !== $owner->id
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
        | CANCELLED PROTECTION
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
        | COMPLETED PROTECTION
        |--------------------------------------------------------------------------
        */

        if ($transaction->status === 'completed') {

            return back()->with(
                'error',
                'Completed requests cannot be modified by an owner.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATABASE TRANSACTION
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
                | LOCK RELATED PROPERTY
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
                    | BUY TRANSACTION
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
                    | RENT TRANSACTION
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
                    | INVALID TYPE
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
                'owner.property-transactions.index'
            )
            ->with(
                'success',
                'Property request status updated successfully.'
            );
    }
}