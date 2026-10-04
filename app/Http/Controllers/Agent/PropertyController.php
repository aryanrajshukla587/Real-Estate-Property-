<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    /**
     * Display agent's own properties.
     */
    public function index(Request $request)
    {
        $agentId = auth('agent')->id();

        $properties = Property::with([
            'propertyType',
            'location',
            'owner',
        ])
            ->where('agent_id', $agentId)

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
            'agent.properties.index',
            compact(
                'properties',
                'propertyTypes',
                'locations'
            )
        );
    }


    /**
     * Show create property form.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Active Property Types
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
        | Active Locations
        |--------------------------------------------------------------------------
        */

        $locations = Location::where(
            'is_active',
            true
        )
            ->orderBy('city')
            ->get();


        return view(
            'agent.properties.create',
            compact(
                'propertyTypes',
                'locations'
            )
        );
    }


    /**
     * Store new property.
     *
     * IMPORTANT:
     *
     * Agent does NOT control:
     *
     * - owner / user_id
     * - approval_status
     * - is_active
     *
     * New agent property:
     *
     * user_id          = null
     * agent_id         = logged-in agent
     * approval_status  = pending
     * status           = available
     * is_active        = false
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Property Information
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

            'is_featured' => [
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
        | Automatically Assign Logged-in Agent
        |--------------------------------------------------------------------------
        */

        $validated['agent_id'] = auth('agent')->id();


        /*
        |--------------------------------------------------------------------------
        | OWNER
        |--------------------------------------------------------------------------
        |
        | Agent-created property does not have an owner initially.
        |
        | Owner can be assigned later through the appropriate
        | owner/admin assignment flow.
        |
        */

        $validated['user_id'] = null;


        /*
        |--------------------------------------------------------------------------
        | APPROVAL WORKFLOW
        |--------------------------------------------------------------------------
        */

        $validated['approval_status'] = 'pending';


        /*
        |--------------------------------------------------------------------------
        | MARKET AVAILABILITY
        |--------------------------------------------------------------------------
        */

        $validated['status'] = 'available';


        /*
        |--------------------------------------------------------------------------
        | PUBLIC VISIBILITY
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] = false;


        /*
        |--------------------------------------------------------------------------
        | Featured Checkbox
        |--------------------------------------------------------------------------
        */

        $validated['is_featured'] = $request->boolean(
            'is_featured'
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

        Property::create($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('agent.properties.index')
            ->with(
                'success',
                'Property submitted successfully. It is now waiting for Super Admin approval.'
            );
    }


    /**
     * Display a single property.
     *
     * Agent can view ONLY his own property.
     */
    public function show(Property $property)
    {
        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | Agent can view ONLY his own property.
        |
        */

        if (
            $property->agent_id !== auth('agent')->id()
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Property Relationships
        |--------------------------------------------------------------------------
        |
        | owner = properties.user_id
        |
        */

        $property->load([
            'propertyType',
            'location',
            'owner',
        ]);


        return view(
            'agent.properties.show',
            compact('property')
        );
    }


    /**
     * Show edit form for agent's own property.
     */
    public function edit(Property $property)
    {
        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | Agent can edit ONLY his own property.
        |
        */

        if (
            $property->agent_id !== auth('agent')->id()
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Owner
        |--------------------------------------------------------------------------
        |
        | Owner is read-only for Agent.
        |
        */

        $property->load('owner');


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
            'agent.properties.edit',
            compact(
                'property',
                'propertyTypes',
                'locations'
            )
        );
    }


    /**
     * Update agent's own property.
     *
     * Agent CAN update:
     *
     * - Property information
     * - Market availability
     * - Featured status
     * - Photos
     *
     * Agent CANNOT update:
     *
     * - user_id / owner
     * - agent_id
     * - approval_status
     * - is_active
     */
    public function update(
        Request $request,
        Property $property
    ) {

        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | Agent can update ONLY his own property.
        |
        */

        if (
            $property->agent_id !== auth('agent')->id()
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Property Information
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
            | MARKET AVAILABILITY
            |--------------------------------------------------------------------------
            |
            | Approval status is separate.
            |
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
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | Agent cannot change the assigned agent.
        |
        */

        $validated['agent_id'] = $property->agent_id;


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | user_id is NOT accepted from request.
        |
        | Existing owner assignment remains unchanged.
        |
        */

        unset(
            $validated['user_id']
        );


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | approval_status is NOT accepted from request.
        |
        | Existing approval status remains unchanged.
        |
        */

        unset(
            $validated['approval_status']
        );


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | is_active is NOT accepted from request.
        |
        | Existing public visibility remains unchanged.
        |
        */

        unset(
            $validated['is_active']
        );


        /*
        |--------------------------------------------------------------------------
        | Featured Checkbox
        |--------------------------------------------------------------------------
        */

        $validated['is_featured'] = $request->boolean(
            'is_featured'
        );


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
            | Remove deleted photos from JSON array
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
        | Save Photos
        |--------------------------------------------------------------------------
        */

        $validated['photos'] = $existingPhotos;


        /*
        |--------------------------------------------------------------------------
        | Update Property
        |--------------------------------------------------------------------------
        |
        | Owner, approval_status and is_active remain untouched.
        |
        */

        $property->update($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('agent.properties.index')
            ->with(
                'success',
                'Property updated successfully.'
            );
    }
}