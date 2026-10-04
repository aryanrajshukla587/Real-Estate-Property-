<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyTransactionController extends Controller
{
    /**
     * ============================================================
     * BUY PROPERTY
     * ============================================================
     */
    public function buy(Property $property)
    {
        return $this->showTransactionForm($property, 'buy');
    }


    /**
     * ============================================================
     * RENT PROPERTY
     * ============================================================
     */
    public function rent(Property $property)
    {
        return $this->showTransactionForm($property, 'rent');
    }


    /**
     * ============================================================
     * SHOW BUY / RENT FORM
     * ============================================================
     */
    private function showTransactionForm(
        Property $property,
        string $type
    ) {
        /*
        |--------------------------------------------------------------------------
        | Check Property Active
        |--------------------------------------------------------------------------
        */

        if (!$property->is_active) {
            return redirect()
                ->route(
                    'property.details',
                    $property->slug
                )
                ->with(
                    'error',
                    'This property is currently unavailable.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Transaction Type
        |--------------------------------------------------------------------------
        */

        if (
            ($type === 'buy' && $property->purpose !== 'sale') ||
            ($type === 'rent' && $property->purpose !== 'rent')
        ) {
            return redirect()
                ->route(
                    'property.details',
                    $property->slug
                )
                ->with(
                    'error',
                    'This action is not available for this property.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Property Availability
        |--------------------------------------------------------------------------
        */

        if ($property->status !== 'available') {
            return redirect()
                ->route(
                    'property.details',
                    $property->slug
                )
                ->with(
                    'error',
                    'This property is no longer available.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Existing Active Transaction
        |--------------------------------------------------------------------------
        */

        $existingTransaction = PropertyTransaction::where(
                'user_id',
                Auth::id()
            )
            ->where(
                'property_id',
                $property->id
            )
            ->where(
                'type',
                $type
            )
            ->whereIn(
                'status',
                [
                    'pending',
                    'approved',
                ]
            )
            ->first();

        if ($existingTransaction) {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $existingTransaction
                )
                ->with(
                    'info',
                    'You already have an active request for this property.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Show Transaction Form
        |--------------------------------------------------------------------------
        */

        return view(
            'user.transactions.create',
            compact(
                'property',
                'type'
            )
        );
    }


    /**
     * ============================================================
     * STORE BUY / RENT REQUEST
     * ============================================================
     */
    public function store(
        Request $request,
        Property $property
    ) {
        /*
        |--------------------------------------------------------------------------
        | Validate Request
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'type' => [
                'required',
                'in:buy,rent',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            'offer_amount' => [
                'required',
                'numeric',
                'min:1',
                'max:999999999999.99',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'state' => [
                'nullable',
                'string',
                'max:100',
            ],

            'pincode' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Check Transaction Type Against Property
        |--------------------------------------------------------------------------
        */

        if (
            ($validated['type'] === 'buy' &&
                $property->purpose !== 'sale') ||

            ($validated['type'] === 'rent' &&
                $property->purpose !== 'rent')
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid transaction type for this property.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Property Availability
        |--------------------------------------------------------------------------
        */

        if (
            !$property->is_active ||
            $property->status !== 'available'
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'This property is no longer available.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Existing Active Transaction
        |--------------------------------------------------------------------------
        */

        $existingTransaction = PropertyTransaction::where(
                'user_id',
                Auth::id()
            )
            ->where(
                'property_id',
                $property->id
            )
            ->where(
                'type',
                $validated['type']
            )
            ->whereIn(
                'status',
                [
                    'pending',
                    'approved',
                ]
            )
            ->first();

        if ($existingTransaction) {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $existingTransaction
                )
                ->with(
                    'info',
                    'You already have an active request for this property.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Create Transaction
        |--------------------------------------------------------------------------
        */

        $transaction = PropertyTransaction::create([

            'user_id' => Auth::id(),

            'property_id' => $property->id,

            'type' => $validated['type'],

            'amount' => $property->price,

            'offer_amount' => $validated['offer_amount'],

            'counter_offer_amount' => null,

            'name' => $validated['name'],

            'email' => $validated['email'],

            'phone' => $validated['phone'],

            'address' => $validated['address'] ?? null,

            'city' => $validated['city'] ?? null,

            'state' => $validated['state'] ?? null,

            'pincode' => $validated['pincode'] ?? null,

            'status' => 'pending',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect To Transaction Details
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'user.transaction.show',
                $transaction
            )
            ->with(
                'success',
                $validated['type'] === 'buy'
                    ? 'Your purchase request has been submitted successfully.'
                    : 'Your rental request has been submitted successfully.'
            );
    }


    /**
     * ============================================================
     * TRANSACTION DETAILS
     * ============================================================
     */
    public function show(
        PropertyTransaction $transaction
    ) {
        /*
        |--------------------------------------------------------------------------
        | Security Check
        |--------------------------------------------------------------------------
        */

        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Related Data
        |--------------------------------------------------------------------------
        */

        $transaction->load([
            'property.propertyType',
            'property.location',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Transaction Details View
        |--------------------------------------------------------------------------
        */

        return view(
            'user.transactions.show',
            compact('transaction')
        );
    }


    /**
     * ============================================================
     * EDIT PENDING CUSTOMER OFFER
     * ============================================================
     */
    public function edit(
        PropertyTransaction $transaction
    ) {
        /*
        |--------------------------------------------------------------------------
        | Security Check
        |--------------------------------------------------------------------------
        */

        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Only Pending Requests Can Be Edited
        |--------------------------------------------------------------------------
        */

        if ($transaction->status !== 'pending') {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $transaction
                )
                ->with(
                    'error',
                    'Only pending requests can be edited.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Property
        |--------------------------------------------------------------------------
        */

        if (!$transaction->property) {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $transaction
                )
                ->with(
                    'error',
                    'Property information could not be found.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Property Availability
        |--------------------------------------------------------------------------
        */

        if (
            !$transaction->property->is_active ||
            $transaction->property->status !== 'available'
        ) {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $transaction
                )
                ->with(
                    'error',
                    'This property is no longer available.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Load Related Data
        |--------------------------------------------------------------------------
        */

        $transaction->load([
            'property.propertyType',
            'property.location',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Show Edit Page
        |--------------------------------------------------------------------------
        */

        return view(
            'user.transactions.edit',
            compact('transaction')
        );
    }


    /**
     * ============================================================
     * UPDATE CUSTOMER OFFER AMOUNT
     * ============================================================
     */
    public function update(
        Request $request,
        PropertyTransaction $transaction
    ) {
        /*
        |--------------------------------------------------------------------------
        | Security Check
        |--------------------------------------------------------------------------
        */

        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Only Pending Requests Can Be Updated
        |--------------------------------------------------------------------------
        */

        if ($transaction->status !== 'pending') {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $transaction
                )
                ->with(
                    'error',
                    'Only pending requests can be edited.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validate New Customer Offer
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'offer_amount' => [
                'required',
                'numeric',
                'min:1',
                'max:999999999999.99',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Check Property
        |--------------------------------------------------------------------------
        */

        if (!$transaction->property) {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $transaction
                )
                ->with(
                    'error',
                    'Property information could not be found.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Property Availability
        |--------------------------------------------------------------------------
        */

        if (
            !$transaction->property->is_active ||
            $transaction->property->status !== 'available'
        ) {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $transaction
                )
                ->with(
                    'error',
                    'This property is no longer available.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Update Customer Offer
        |--------------------------------------------------------------------------
        |
        | counter_offer_amount is NOT changed here.
        | It belongs to Admin.
        |
        */

        $transaction->update([
            'offer_amount' => $validated['offer_amount'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'user.transaction.show',
                $transaction
            )
            ->with(
                'success',
                'Your offer amount has been updated successfully.'
            );
    }


    /**
     * ============================================================
     * CANCEL PENDING REQUEST
     * ============================================================
     */
    public function cancel(
        Request $request,
        PropertyTransaction $transaction
    ) {
        /*
        |--------------------------------------------------------------------------
        | Security Check
        |--------------------------------------------------------------------------
        */

        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Only Pending Transactions Can Be Cancelled
        |--------------------------------------------------------------------------
        */

        if ($transaction->status !== 'pending') {
            return back()
                ->with(
                    'error',
                    'Only pending requests can be cancelled.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Cancel Transaction
        |--------------------------------------------------------------------------
        */

        $transaction->update([
            'status' => 'cancelled',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'user.transaction.show',
                $transaction
            )
            ->with(
                'success',
                'Your property request has been cancelled successfully.'
            );
    }


    /**
     * ============================================================
     * DEAL DONE / COMPLETE TRANSACTION
     * ============================================================
     */
    public function complete(
        Request $request,
        PropertyTransaction $transaction
    ) {
        /*
        |--------------------------------------------------------------------------
        | Security Check
        |--------------------------------------------------------------------------
        */

        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Only Approved Transactions Can Be Completed
        |--------------------------------------------------------------------------
        */

        if ($transaction->status !== 'approved') {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $transaction
                )
                ->with(
                    'error',
                    'Only approved transactions can be marked as deal done.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Property
        |--------------------------------------------------------------------------
        */

        if (!$transaction->property) {
            return redirect()
                ->route(
                    'user.transaction.show',
                    $transaction
                )
                ->with(
                    'error',
                    'The related property could not be found.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Complete Transaction + Update Property
        |--------------------------------------------------------------------------
        */

        try {

            DB::transaction(function () use ($transaction) {

                /*
                |--------------------------------------------------------------------------
                | Lock Property
                |--------------------------------------------------------------------------
                */

                $property = $transaction
                    ->property()
                    ->lockForUpdate()
                    ->first();


                if (!$property) {
                    throw new \Exception(
                        'The related property could not be found.'
                    );
                }


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


                    if ($property->status !== 'available') {
                        throw new \Exception(
                            'This property is no longer available.'
                        );
                    }


                    /*
                    |------------------------------------------------------------------
                    | MARK PROPERTY AS SOLD
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

                if ($transaction->type === 'rent') {

                    if ($property->purpose !== 'rent') {
                        throw new \Exception(
                            'This property is not available for rent.'
                        );
                    }


                    if ($property->status !== 'available') {
                        throw new \Exception(
                            'This property is no longer available.'
                        );
                    }


                    /*
                    |------------------------------------------------------------------
                    | MARK PROPERTY AS RENTED
                    |------------------------------------------------------------------
                    */

                    $property->update([
                        'status' => 'rented',
                    ]);
                }


                /*
                |--------------------------------------------------------------------------
                | MARK TRANSACTION AS COMPLETED
                |--------------------------------------------------------------------------
                */

                $transaction->update([
                    'status' => 'completed',
                ]);
            });


        } catch (\Exception $e) {

            return redirect()
                ->route(
                    'user.transaction.show',
                    $transaction
                )
                ->with(
                    'error',
                    $e->getMessage()
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SUCCESS MESSAGE
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'user.transaction.show',
                $transaction
            )
            ->with(
                'success',
                $transaction->type === 'buy'
                    ? 'Deal completed successfully. The property has been marked as sold.'
                    : 'Deal completed successfully. The property has been marked as rented.'
            );
    }
}
