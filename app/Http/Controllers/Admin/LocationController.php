<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display all locations.
     */
    public function index()
{
    $locations = Location::withCount('properties')
        ->latest()
        ->paginate(10);

    return view('admin.locations.index', compact('locations'));
}

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store location.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'city'      => 'required|string|max:100',
            'state'     => 'nullable|string|max:100',
            'country'   => 'required|string|max:100',
            'address'   => 'nullable|string',

            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Location::create($validated);

        return redirect()
            ->route('admin.locations.index')
            ->with('success', 'Location added successfully.');
    }

    /**
     * Display location details.
     */
    public function show(Location $location)
    {
        $location->loadCount('properties');

        return view('admin.locations.show', compact('location'));
    }

    /**
     * Show edit form.
     */
    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update location.
     */
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'city'      => 'required|string|max:100',
            'state'     => 'nullable|string|max:100',
            'country'   => 'required|string|max:100',
            'address'   => 'nullable|string',

            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $location->update($validated);

        return redirect()
            ->route('admin.locations.index')
            ->with('success', 'Location updated successfully.');
    }

    /**
     * Delete location.
     */
    public function destroy(Location $location)
    {
        if ($location->properties()->exists()) {
            return redirect()
                ->route('admin.locations.index')
                ->with(
                    'error',
                    'This location cannot be deleted because properties are using it.'
                );
        }

        $location->delete();

        return redirect()
            ->route('admin.locations.index')
            ->with('success', 'Location deleted successfully.');
    }
}