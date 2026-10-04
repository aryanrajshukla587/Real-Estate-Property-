<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OwnerPropertyController extends Controller
{
    /**
     * Display owner's properties.
     */
    public function index(Request $request)
    {
        $owner = $request->user();

        $properties = Property::with([
                'propertyType',
                'location',
                'agent',
            ])
            ->where('user_id', $owner->id)

            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%");
                });
            })

            ->when($request->property_type_id, function ($query, $type) {
                $query->where('property_type_id', $type);
            })

            ->when($request->location_id, function ($query, $location) {
                $query->where('location_id', $location);
            })

            ->when($request->purpose, function ($query, $purpose) {
                $query->where('purpose', $purpose);
            })

            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        $locations = Location::where(
            'is_active',
            true
        )
            ->orderBy('city')
            ->get();

        return view(
            'owner.properties.index',
            compact(
                'owner',
                'properties',
                'propertyTypes',
                'locations'
            )
        );
    }


    /**
     * Display pending properties.
     */
    public function pending(Request $request)
    {
        $owner = $request->user();

        $properties = Property::with([
                'propertyType',
                'location',
                'agent',
            ])
            ->where('user_id', $owner->id)
            ->where('approval_status', 'pending')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        $locations = Location::where(
            'is_active',
            true
        )
            ->orderBy('city')
            ->get();

        return view(
            'owner.properties.index',
            compact(
                'owner',
                'properties',
                'propertyTypes',
                'locations'
            )
        );
    }


    /**
     * Display active properties.
     */
    public function active(Request $request)
    {
        $owner = $request->user();

        $properties = Property::with([
                'propertyType',
                'location',
                'agent',
            ])
            ->where('user_id', $owner->id)
            ->where('approval_status', 'approved')
            ->where('status', 'available')
            ->where('is_active', true)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        $locations = Location::where(
            'is_active',
            true
        )
            ->orderBy('city')
            ->get();

        return view(
            'owner.properties.index',
            compact(
                'owner',
                'properties',
                'propertyTypes',
                'locations'
            )
        );
    }


    /**
     * Display rejected properties.
     */
    public function rejected(Request $request)
    {
        $owner = $request->user();

        $properties = Property::with([
                'propertyType',
                'location',
                'agent',
            ])
            ->where('user_id', $owner->id)
            ->where('approval_status', 'rejected')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        $locations = Location::where(
            'is_active',
            true
        )
            ->orderBy('city')
            ->get();

        return view(
            'owner.properties.index',
            compact(
                'owner',
                'properties',
                'propertyTypes',
                'locations'
            )
        );
    }


    /**
     * Show create property form.
     */
    public function create(Request $request)
    {
        $owner = $request->user();

        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        $locations = Location::where(
            'is_active',
            true
        )
            ->orderBy('city')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ACTIVE REGISTERED AGENTS
        |--------------------------------------------------------------------------
        |
        | Owner can optionally assign a registered Agent.
        |
        */

        $agents = User::where(
            'role',
            'agent'
        )
            ->orderBy('name')
            ->get();

        return view(
            'owner.properties.create',
            compact(
                'owner',
                'propertyTypes',
                'locations',
                'agents'
            )
        );
    }


    /**
     * Store a new property.
     *
     * New Owner property:
     *
     * user_id         = logged-in owner
     * agent_id        = optional assigned agent
     * approval_status = pending
     * status          = available
     * is_active       = false
     */
    public function store(Request $request)
    {
        $owner = $request->user();

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
                'max:1000',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'agent_id' => [
                'nullable',
                'integer',
                'exists:users,id',
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
        | VALIDATE ASSIGNED AGENT
        |--------------------------------------------------------------------------
        |
        | The selected user must actually be a registered Agent.
        |
        */

        $agentId = null;

        if (!empty($validated['agent_id'])) {

            $agent = User::where(
                'id',
                $validated['agent_id']
            )
                ->where(
                    'role',
                    'agent'
                )
                ->first();

            if (!$agent) {

                return back()
                    ->withErrors([
                        'agent_id' => 'The selected user is not a valid Agent.',
                    ])
                    ->withInput();
            }

            $agentId = $agent->id;
        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE UNIQUE SLUG
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug(
            $validated['title']
        );

        /*
        | If title produces an empty slug.
        */

        if (empty($slug)) {
            $slug = 'property';
        }

        $originalSlug = $slug;
        $counter = 1;

        while (
            Property::where(
                'slug',
                $slug
            )->exists()
        ) {

            $slug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | PROPERTY OWNERSHIP
        |--------------------------------------------------------------------------
        */

        $validated['user_id'] = $owner->id;

        $validated['agent_id'] = $agentId;


        /*
        |--------------------------------------------------------------------------
        | APPROVAL FLOW
        |--------------------------------------------------------------------------
        |
        | Owner cannot directly publish a property.
        |
        */

        $validated['approval_status'] = 'pending';

        $validated['status'] = 'available';

        $validated['is_active'] = false;

        $validated['is_featured'] =
            $request->boolean('is_featured');


        /*
        |--------------------------------------------------------------------------
        | PHOTOS
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

        $validated['slug'] = $slug;


        /*
        |--------------------------------------------------------------------------
        | CREATE PROPERTY
        |--------------------------------------------------------------------------
        */

        Property::create(
            $validated
        );


        return redirect()
            ->route('owner.properties.index')
            ->with(
                'success',
                'Property submitted successfully. It is now waiting for Super Admin approval.'
            );
    }


    /**
     * Display a single property.
     */
    public function show(
        Request $request,
        Property $property
    ) {
        $owner = $request->user();


        /*
        |--------------------------------------------------------------------------
        | OWNERSHIP CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $property->user_id !== $owner->id
        ) {
            abort(404);
        }


        $property->load([
            'propertyType',
            'location',
            'agent',
            'owner',
        ]);


        return view(
            'owner.properties.show',
            compact(
                'owner',
                'property'
            )
        );
    }


    /**
     * Show edit property form.
     */
    public function edit(
        Request $request,
        Property $property
    ) {
        $owner = $request->user();


        /*
        |--------------------------------------------------------------------------
        | OWNERSHIP CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $property->user_id !== $owner->id
        ) {
            abort(404);
        }


        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();


        $locations = Location::where(
            'is_active',
            true
        )
            ->orderBy('city')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | REGISTERED AGENTS
        |--------------------------------------------------------------------------
        */

        $agents = User::where(
            'role',
            'agent'
        )
            ->orderBy('name')
            ->get();


        return view(
            'owner.properties.edit',
            compact(
                'owner',
                'property',
                'propertyTypes',
                'locations',
                'agents'
            )
        );
    }


    /**
     * Update owner's property.
     *
     * Owner can change:
     * - property details
     * - assigned Agent
     * - photos
     * - availability status
     * - featured status
     *
     * Owner cannot directly change:
     * - user_id
     * - approval_status
     * - is_active
     */
    public function update(
        Request $request,
        Property $property
    ) {
        $owner = $request->user();


        /*
        |--------------------------------------------------------------------------
        | OWNERSHIP CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $property->user_id !== $owner->id
        ) {
            abort(404);
        }


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
                'max:1000',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'in:available,sold,rented',
            ],

            'agent_id' => [
                'nullable',
                'integer',
                'exists:users,id',
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
        | VALIDATE ASSIGNED AGENT
        |--------------------------------------------------------------------------
        */

        $agentId = null;

        if (!empty($validated['agent_id'])) {

            $agent = User::where(
                'id',
                $validated['agent_id']
            )
                ->where(
                    'role',
                    'agent'
                )
                ->first();

            if (!$agent) {

                return back()
                    ->withErrors([
                        'agent_id' => 'The selected user is not a valid Agent.',
                    ])
                    ->withInput();
            }

            $agentId = $agent->id;
        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE UNIQUE SLUG
        |--------------------------------------------------------------------------
        */

        $newSlug = Str::slug(
            $validated['title']
        );

        if (empty($newSlug)) {
            $newSlug = 'property';
        }

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

            $newSlug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | ASSIGNED AGENT
        |--------------------------------------------------------------------------
        */

        $validated['agent_id'] = $agentId;


        /*
        |--------------------------------------------------------------------------
        | FEATURED STATUS
        |--------------------------------------------------------------------------
        */

        $validated['is_featured'] =
            $request->boolean(
                'is_featured'
            );


        /*
        |--------------------------------------------------------------------------
        | EXISTING PHOTOS
        |--------------------------------------------------------------------------
        */

        $existingPhotos = is_array(
            $property->photos
        )
            ? $property->photos
            : [];


        /*
        |--------------------------------------------------------------------------
        | DELETE SELECTED PHOTOS
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
                | Only delete files that actually
                | belong to this property.
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


            $existingPhotos = array_values(
                array_diff(
                    $existingPhotos,
                    $deletePhotos
                )
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ADD NEW PHOTOS
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photos')) {

            foreach (
                $request->file('photos') as $photo
            ) {

                $existingPhotos[] =
                    $photo->store(
                        'properties',
                        'public'
                    );
            }
        }


        $validated['photos'] =
            $existingPhotos;

        $validated['slug'] =
            $newSlug;


        /*
        |--------------------------------------------------------------------------
        | RE-APPROVAL FLOW
        |--------------------------------------------------------------------------
        |
        | If the owner edits an existing property, we do not allow
        | the owner to bypass Super Admin review.
        |
        | The property goes back to:
        |
        | approval_status = pending
        | is_active       = false
        |
        */

        $validated['approval_status'] = 'pending';

        $validated['is_active'] = false;


        /*
        |--------------------------------------------------------------------------
        | DO NOT UPDATE user_id
        |--------------------------------------------------------------------------
        |
        | Ownership must always remain with the original Owner.
        |
        */


        /*
        |--------------------------------------------------------------------------
        | UPDATE PROPERTY
        |--------------------------------------------------------------------------
        */

        $property->update(
            $validated
        );


        return redirect()
            ->route('owner.properties.index')
            ->with(
                'success',
                'Property updated successfully and submitted again for Super Admin approval.'
            );
    }


    /**
     * Delete owner's property.
     */
    public function destroy(
        Request $request,
        Property $property
    ) {
        $owner = $request->user();


        /*
        |--------------------------------------------------------------------------
        | OWNERSHIP CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $property->user_id !== $owner->id
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE PROPERTY PHOTOS
        |--------------------------------------------------------------------------
        */

        $photos = is_array(
            $property->photos
        )
            ? $property->photos
            : [];


        foreach ($photos as $photo) {

            Storage::disk('public')
                ->delete($photo);
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE PROPERTY
        |--------------------------------------------------------------------------
        */

        $property->delete();


        return redirect()
            ->route('owner.properties.index')
            ->with(
                'success',
                'Property deleted successfully.'
            );
    }
}