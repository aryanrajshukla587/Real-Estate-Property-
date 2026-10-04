<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display property listing.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | PROPERTY TYPES
        |--------------------------------------------------------------------------
        |
        | Active property types dropdown mein dynamically show honge.
        |
        */

        $propertyTypes = PropertyType::where(
            'is_active',
            true
        )
        ->orderBy('name')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | PROPERTY QUERY
        |--------------------------------------------------------------------------
        |
        | PUBLIC PROPERTY VISIBILITY RULE:
        |
        | 1. approval_status = approved
        | 2. is_active = true
        | 3. status = available
        |
        | Iske bina property public website par show nahi hogi.
        |
        */

        $query = Property::with([
            'propertyType',
            'location',
            'agent',
        ])
        ->where(
            'approval_status',
            'approved'
        )
        ->where(
            'is_active',
            true
        )
        ->where(
            'status',
            'available'
        );


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'address',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
                    'location',
                    function ($location) use ($search) {

                        $location->where(
                            'city',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'state',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'country',
                            'like',
                            "%{$search}%"
                        );
                    }
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | PURPOSE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('purpose')) {

            $query->where(
                'purpose',
                $request->purpose
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PROPERTY TYPE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('property_type_id')) {

            $query->where(
                'property_type_id',
                $request->property_type_id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MIN AREA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('min_area')) {

            $query->where(
                'area',
                '>=',
                $request->min_area
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MAX AREA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('max_area')) {

            $query->where(
                'area',
                '<=',
                $request->max_area
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MAX PRICE
        |--------------------------------------------------------------------------
        |
        | Filter mein sirf ek Price field hai.
        | Isko Maximum Price ke roop mein use kiya ja raha hai.
        |
        */

        if ($request->filled('max_price')) {

            $query->where(
                'price',
                '<=',
                $request->max_price
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $properties = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | FILTER CHECK
        |--------------------------------------------------------------------------
        |
        | Search/filter ke baad frontend result section par scroll karega.
        |
        */

        $isFiltering = $request->hasAny([
            'search',
            'purpose',
            'property_type_id',
            'min_area',
            'max_area',
            'max_price',
        ]);


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.property',
            compact(
                'properties',
                'propertyTypes',
                'isFiltering'
            )
        );
    }


    /**
     * Display property details.
     */
    public function show($slug)
    {
        /*
        |--------------------------------------------------------------------------
        | PROPERTY DETAILS
        |--------------------------------------------------------------------------
        |
        | Direct URL se bhi sirf approved + active + available
        | property hi access ho sakti hai.
        |
        | Isse pending/rejected/sold/rented property ka public
        | detail page bhi hide rahega.
        |
        */

        $property = Property::with([
            'propertyType',
            'location',
            'agent',
        ])
        ->where(
            'slug',
            $slug
        )
        ->where(
            'approval_status',
            'approved'
        )
        ->where(
            'is_active',
            true
        )
        ->where(
            'status',
            'available'
        )
        ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | RELATED PROPERTIES
        |--------------------------------------------------------------------------
        |
        | Related properties bhi public visibility rules follow karengi.
        |
        */

        $relatedProperties = Property::with([
            'propertyType',
            'location',
        ])
        ->where(
            'approval_status',
            'approved'
        )
        ->where(
            'is_active',
            true
        )
        ->where(
            'status',
            'available'
        )
        ->where(
            'id',
            '!=',
            $property->id
        )
        ->where(
            'property_type_id',
            $property->property_type_id
        )
        ->latest()
        ->take(4)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.property-details',
            compact(
                'property',
                'relatedProperties'
            )
        );
    }
}
