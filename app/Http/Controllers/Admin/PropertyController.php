<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    /**
     * Display all properties.
     */
    public function index(Request $request)
    {
        $properties = Property::with([
            'propertyType',
            'location',
            'agent',
        ])
        ->when($request->search, function ($query, $search) {

            $query->where(
                'title',
                'like',
                "%{$search}%"
            );

        })
        ->when($request->property_type_id, function ($query, $type) {

            $query->where(
                'property_type_id',
                $type
            );

        })
        ->when($request->location_id, function ($query, $location) {

            $query->where(
                'location_id',
                $location
            );

        })
        ->when($request->purpose, function ($query, $purpose) {

            $query->where(
                'purpose',
                $purpose
            );

        })
        ->when($request->status, function ($query, $status) {

            $query->where(
                'status',
                $status
            );

        })
        ->when($request->approval_status, function ($query, $approvalStatus) {

            $query->where(
                'approval_status',
                $approvalStatus
            );

        })
        ->latest()
        ->paginate(10)
        ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Property Types
        |--------------------------------------------------------------------------
        */

        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
        ->orderBy('name')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Locations
        |--------------------------------------------------------------------------
        */

        $locations = Location::where(
            'is_active',
            true
        )
        ->orderBy('city')
        ->get();


        return view(
            'admin.properties.index',
            compact(
                'properties',
                'propertyTypes',
                'locations'
            )
        );
    }


    /**
     * Show create form.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Property Types
        |--------------------------------------------------------------------------
        */

        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
        ->orderBy('name')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Locations
        |--------------------------------------------------------------------------
        */

        $locations = Location::where(
            'is_active',
            true
        )
        ->orderBy('city')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Agents
        |--------------------------------------------------------------------------
        */

        $agents = User::where(
            'role',
            'agent'
        )
        ->orderBy('name')
        ->get();


        return view(
            'admin.properties.create',
            compact(
                'propertyTypes',
                'locations',
                'agents'
            )
        );
    }


    /**
     * Store a newly created property.
     *
     * Admin-created properties are considered
     * already approved because they are created
     * directly by Super Admin.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'property_type_id' => [
                'required',
                'exists:property_types,id',
            ],

            'agent_id' => [
                'nullable',
                'exists:users,id',
            ],

            'location_id' => [
                'required',
                'exists:locations,id',
            ],

            'purpose' => [
                'required',
                'in:sale,rent',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'area' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'bedrooms' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'bathrooms' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'garages' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'in:available,sold,rented',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'photos' => [
                'nullable',
                'array',
            ],

            'photos.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Verify Selected Agent
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['agent_id'])) {

            $agentExists = User::where(
                'id',
                $validated['agent_id']
            )
            ->where(
                'role',
                'agent'
            )
            ->exists();


            if (!$agentExists) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'agent_id' => 'Selected user is not a valid agent.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Generate Unique Slug
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug(
            $validated['title']
        );

        $originalSlug = $slug;
        $counter = 1;


        while (
            Property::where(
                'slug',
                $slug
            )->exists()
        ) {

            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }


        $validated['slug'] = $slug;


        /*
        |--------------------------------------------------------------------------
        | Admin Created Property
        |--------------------------------------------------------------------------
        |
        | Since Super Admin is creating this property directly,
        | it does not need to wait for approval.
        |
        */

        $validated['approval_status'] = 'approved';


        /*
        |--------------------------------------------------------------------------
        | Checkbox Values
        |--------------------------------------------------------------------------
        */

        $validated['is_featured'] = $request->boolean(
            'is_featured'
        );

        $validated['is_active'] = $request->boolean(
            'is_active'
        );


        /*
        |--------------------------------------------------------------------------
        | Upload Property Photos
        |--------------------------------------------------------------------------
        */

        $photoPaths = [];

        if ($request->hasFile('photos')) {

            foreach (
                $request->file('photos') as $photo
            ) {

                $photoPaths[] = $photo->store(
                    'properties',
                    'public'
                );
            }
        }


        $validated['photos'] = $photoPaths;


        /*
        |--------------------------------------------------------------------------
        | Create Property
        |--------------------------------------------------------------------------
        */

        Property::create(
            $validated
        );


        return redirect()
            ->route('admin.properties.index')
            ->with(
                'success',
                'Property and photos added successfully.'
            );
    }


    /**
     * Display property details.
     */
    public function show(Property $property)
    {
        $property->load([
            'propertyType',
            'location',
            'agent',
        ]);


        return view(
            'admin.properties.show',
            compact('property')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(Property $property)
    {
        /*
        |--------------------------------------------------------------------------
        | Property Types
        |--------------------------------------------------------------------------
        */

        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
        ->orderBy('name')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Locations
        |--------------------------------------------------------------------------
        */

        $locations = Location::where(
            'is_active',
            true
        )
        ->orderBy('city')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Agents
        |--------------------------------------------------------------------------
        */

        $agents = User::where(
            'role',
            'agent'
        )
        ->orderBy('name')
        ->get();


        return view(
            'admin.properties.edit',
            compact(
                'property',
                'propertyTypes',
                'locations',
                'agents'
            )
        );
    }


    /**
     * Update property.
     */
    public function update(
        Request $request,
        Property $property
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'property_type_id' => [
                'required',
                'exists:property_types,id',
            ],

            'agent_id' => [
                'nullable',
                'exists:users,id',
            ],

            'location_id' => [
                'required',
                'exists:locations,id',
            ],

            'purpose' => [
                'required',
                'in:sale,rent',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'area' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'bedrooms' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'bathrooms' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'garages' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Market Availability
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                'in:available,sold,rented',
            ],

            /*
            |--------------------------------------------------------------------------
            | Featured
            |--------------------------------------------------------------------------
            */

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | Public Visibility
            |--------------------------------------------------------------------------
            */

            'is_active' => [
                'nullable',
                'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | New Photos
            |--------------------------------------------------------------------------
            */

            'photos' => [
                'nullable',
                'array',
            ],

            'photos.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | Delete Existing Photos
            |--------------------------------------------------------------------------
            */

            'delete_photos' => [
                'nullable',
                'array',
            ],

            'delete_photos.*' => [
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Verify Selected Agent
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['agent_id'])) {

            $agentExists = User::where(
                'id',
                $validated['agent_id']
            )
            ->where(
                'role',
                'agent'
            )
            ->exists();


            if (!$agentExists) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'agent_id' => 'Selected user is not a valid agent.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Generate Unique Slug
        |--------------------------------------------------------------------------
        */

        $newSlug = Str::slug(
            $validated['title']
        );

        $originalSlug = $newSlug;
        $counter = 1;


        while (
            Property::where(
                'slug',
                $newSlug
            )
            ->where(
                'id',
                '!=',
                $property->id
            )
            ->exists()
        ) {

            $newSlug = $originalSlug . '-' . $counter;

            $counter++;
        }


        $validated['slug'] = $newSlug;


        /*
        |--------------------------------------------------------------------------
        | Checkbox Values
        |--------------------------------------------------------------------------
        */

        $validated['is_featured'] = $request->boolean(
            'is_featured'
        );

        $validated['is_active'] = $request->boolean(
            'is_active'
        );


        /*
        |--------------------------------------------------------------------------
        | IMPORTANT:
        | Approval Status
        |--------------------------------------------------------------------------
        |
        | We intentionally DO NOT accept approval_status
        | from the edit request.
        |
        | Approval must be handled using:
        |
        | approve()
        | reject()
        |
        | This prevents accidental approval-status changes
        | through the normal edit form.
        |
        */


        /*
        |--------------------------------------------------------------------------
        | Existing Photos
        |--------------------------------------------------------------------------
        */

        $existingPhotos = is_array(
            $property->photos
        )
            ? $property->photos
            : [];


        /*
        |--------------------------------------------------------------------------
        | Delete Selected Existing Photos
        |--------------------------------------------------------------------------
        */

        $deletePhotos = $request->input(
            'delete_photos',
            []
        );


        if (!empty($deletePhotos)) {

            foreach (
                $deletePhotos as $photo
            ) {

                /*
                |--------------------------------------------------------------------------
                | Security:
                | Only delete photos belonging to this property.
                |--------------------------------------------------------------------------
                */

                if (
                    in_array(
                        $photo,
                        $existingPhotos,
                        true
                    )
                ) {

                    Storage::disk('public')
                        ->delete($photo);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Remove deleted photos from JSON
            |--------------------------------------------------------------------------
            */

            $existingPhotos = array_values(
                array_diff(
                    $existingPhotos,
                    $deletePhotos
                )
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Upload New Photos
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photos')) {

            foreach (
                $request->file('photos') as $photo
            ) {

                $existingPhotos[] = $photo->store(
                    'properties',
                    'public'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Save Updated Photos
        |--------------------------------------------------------------------------
        */

        $validated['photos'] = $existingPhotos;


        /*
        |--------------------------------------------------------------------------
        | Update Property
        |--------------------------------------------------------------------------
        */

        $property->update(
            $validated
        );


        return redirect()
            ->route('admin.properties.index')
            ->with(
                'success',
                'Property updated successfully.'
            );
    }


    /**
     * Approve property.
     *
     * Once approved:
     *
     * approval_status = approved
     * is_active       = true
     *
     * If old market status was "pending",
     * convert it to "available".
     */
    public function approve(Property $property)
    {
        /*
        |--------------------------------------------------------------------------
        | Make sure legacy pending market status
        | does not remain after approval.
        |--------------------------------------------------------------------------
        */

        $marketStatus = $property->status === 'pending'
            ? 'available'
            : $property->status;


        $property->update([

            'approval_status' => 'approved',

            'status' => $marketStatus,

            'is_active' => true,

        ]);


        return redirect()
            ->route('admin.properties.index')
            ->with(
                'success',
                'Property approved successfully and is now live on the website.'
            );
    }


    /**
     * Reject property.
     *
     * Once rejected:
     *
     * approval_status = rejected
     * is_active       = false
     */
    public function reject(Property $property)
    {
        $property->update([

            'approval_status' => 'rejected',

            'is_active' => false,

        ]);


        return redirect()
            ->route('admin.properties.index')
            ->with(
                'success',
                'Property rejected successfully. It will not be visible on the website.'
            );
    }


    /**
     * Delete property.
     */
    public function destroy(Property $property)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Property Images From Storage
        |--------------------------------------------------------------------------
        */

        if (!empty($property->photos)) {

            foreach (
                $property->photos as $photo
            ) {

                if ($photo) {

                    Storage::disk('public')
                        ->delete($photo);
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Property
        |--------------------------------------------------------------------------
        */

        $property->delete();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.properties.index')
            ->with(
                'success',
                'Property deleted successfully.'
            );
    }
}