<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyTransaction;
use Illuminate\Http\Request;

class PropertyTransactionController extends Controller
{
    /**
     * Display all property transactions.
     */
    public function index(Request $request)
    {
        $query = PropertyTransaction::query()
            ->with([
                'user',
                'property.owner',
                'property.propertyType',
                'property.location',
                'property.agent',
            ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')

                    ->orWhereHas('property', function ($propertyQuery) use ($search) {

                        $propertyQuery
                            ->where('title', 'like', '%' . $search . '%')
                            ->orWhere('address', 'like', '%' . $search . '%');

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
        | COUNTS
        |--------------------------------------------------------------------------
        */

        $totalTransactions = PropertyTransaction::count();

        $pendingTransactions = PropertyTransaction::where(
            'status',
            'pending'
        )->count();

        $approvedTransactions = PropertyTransaction::where(
            'status',
            'approved'
        )->count();

        $completedTransactions = PropertyTransaction::where(
            'status',
            'completed'
        )->count();

        $rejectedTransactions = PropertyTransaction::where(
            'status',
            'rejected'
        )->count();

        $cancelledTransactions = PropertyTransaction::where(
            'status',
            'cancelled'
        )->count();

        $buyTransactions = PropertyTransaction::where(
            'type',
            'buy'
        )->count();

        $rentTransactions = PropertyTransaction::where(
            'type',
            'rent'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | RETURN INDEX VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.property-transactions.index',
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
     * Display transaction details.
     */
    public function show($id)
    {
        /*
        |--------------------------------------------------------------------------
        | GET TRANSACTION
        |--------------------------------------------------------------------------
        |
        | Explicitly transaction ID se record fetch kar rahe hain.
        | Isse route model binding ki wajah se hone wali problem avoid hogi.
        |
        */

        $transaction = PropertyTransaction::with([
            'user',
            'property.owner',
            'property.propertyType',
            'property.location',
            'property.agent',
        ])->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | RETURN SHOW VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.property-transactions.show',
            compact('transaction')
        );
    }

    /**
     * Delete transaction.
     */
    public function destroy($id)
    {
        /*
        |--------------------------------------------------------------------------
        | FIND TRANSACTION
        |--------------------------------------------------------------------------
        */

        $transaction = PropertyTransaction::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | DELETE
        |--------------------------------------------------------------------------
        */

        $transaction->delete();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.property-transactions.index')
            ->with(
                'success',
                'Property transaction deleted successfully.'
            );
    }
}
