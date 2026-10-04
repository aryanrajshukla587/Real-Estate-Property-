<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AgentController extends Controller
{
    /**
     * Display all registered agents.
     */
    public function index()
    {
        $agents = User::query()
            ->where('role', 'agent')
            ->withCount('assignedProperties as properties_count')
            ->latest()
            ->paginate(10);

        return view(
            'admin.agents.index',
            compact('agents')
        );
    }
}