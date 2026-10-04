<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | SEARCH / FILTER
        |--------------------------------------------------------------------------
        */

        $isFiltering = $request->hasAny([
            'search',
            'purpose',
            'property_type_id',
            'min_area',
            'max_area',
            'min_price',
            'max_price',
        ]);


        $filteredProperties = collect();


        if ($isFiltering) {

            /*
            |--------------------------------------------------------------------------
            | FILTERED PROPERTY QUERY
            |--------------------------------------------------------------------------
            |
            | PUBLIC VISIBILITY RULE:
            |
            | approval_status = approved
            | is_active      = true
            | status         = available
            |
            | Pending / rejected / sold / rented properties
            | public search results mein nahi aayengi.
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
            | MINIMUM AREA
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
            | MAXIMUM AREA
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
            | MINIMUM PRICE
            |--------------------------------------------------------------------------
            */

            if ($request->filled('min_price')) {

                $query->where(
                    'price',
                    '>=',
                    $request->min_price
                );
            }


            /*
            |--------------------------------------------------------------------------
            | MAXIMUM PRICE
            |--------------------------------------------------------------------------
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
            | GET FILTERED RESULTS
            |--------------------------------------------------------------------------
            */

            $filteredProperties = $query
                ->latest()
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | LATEST PROPERTIES
        |--------------------------------------------------------------------------
        |
        | Home page par sirf publicly visible properties.
        |
        */

        $latestProperties = Property::with([
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
        )
        ->latest()
        ->take(6)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | LATEST RENT PROPERTIES
        |--------------------------------------------------------------------------
        |
        | Sirf approved + active + available rental properties.
        |
        */

        $latestRentProperties = Property::with([
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
            'purpose',
            'rent'
        )
        ->where(
            'status',
            'available'
        )
        ->latest()
        ->take(6)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | LOCATIONS
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
        | PROPERTY TYPES
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
        | AGENTS
        |--------------------------------------------------------------------------
        */

        $agents = User::where(
            'role',
            'agent'
        )
        ->latest()
        ->take(4)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | HOME PAGE
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.home',
            compact(
                'latestProperties',
                'latestRentProperties',
                'filteredProperties',
                'locations',
                'propertyTypes',
                'agents',
                'isFiltering'
            )
        );
    }
}
