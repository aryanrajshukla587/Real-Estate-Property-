<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyTypeController extends Controller
{
    /**
     * Display all property types.
     */
    public function index()
    {
        $propertyTypes = PropertyType::latest()->paginate(10);

        return view('admin.property-types.index', compact('propertyTypes'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.property-types.create');
    }

    /**
     * Store property type.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:property_types,name',
            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
        ]);

        $slug = Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;

        while (PropertyType::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        PropertyType::create([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'description' => $validated['description'] ?? null,
            'is_active'   => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.property-types.index')
            ->with('success', 'Property type added successfully.');
    }

    /**
     * Display property type.
     */
    public function show(PropertyType $propertyType)
    {
        $propertyType->loadCount('properties');

        return view('admin.property-types.show', compact('propertyType'));
    }

    /**
     * Show edit form.
     */
    public function edit(PropertyType $propertyType)
    {
        return view('admin.property-types.edit', compact('propertyType'));
    }

    /**
     * Update property type.
     */
    public function update(Request $request, PropertyType $propertyType)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:property_types,name,' . $propertyType->id,
            ],

            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
        ]);

        $slug = Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;

        while (
            PropertyType::where('slug', $slug)
                ->where('id', '!=', $propertyType->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $propertyType->update([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'description' => $validated['description'] ?? null,
            'is_active'   => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.property-types.index')
            ->with('success', 'Property type updated successfully.');
    }

    /**
     * Delete property type.
     */
    public function destroy(PropertyType $propertyType)
    {
        if ($propertyType->properties()->exists()) {
            return redirect()
                ->route('admin.property-types.index')
                ->with('error', 'This property type cannot be deleted because properties are using it.');
        }

        $propertyType->delete();

        return redirect()
            ->route('admin.property-types.index')
            ->with('success', 'Property type deleted successfully.');
    }
}