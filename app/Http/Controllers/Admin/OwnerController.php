<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class OwnerController extends Controller
{
    /**
     * Display registered property owners.
     */
    public function index()
    {
        $owners = User::query()
            ->where('role', 'owner')
            ->withCount('properties')
            ->latest()
            ->paginate(15);

        return view(
            'admin.owners.index',
            compact('owners')
        );
    }
}