@extends('layouts.app')

@section('title', 'Eagle Properties - Find Your Dream Property')

@section('content')

<style>

/* =========================================================
   PROPERTY CARDS - 3 COLUMN / EQUAL HEIGHT FIX
========================================================= */

.property-list-row {
    display: flex;
    flex-wrap: wrap;
}

.property-list-row > [class*="col-"] {
    display: flex;
    margin-bottom: 30px;
}

.property-list-row .property-card-link {
    display: flex !important;
    width: 100%;
    text-decoration: none;
    color: inherit;
}

.property-list-row .single_property {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.property-list-row .single_property_content {
    flex: 1;
}

@media (max-width: 991px) {

    .property-list-row > [class*="col-"] {
        margin-bottom: 25px;
    }

}

@media (max-width: 767px) {

    .property-list-row > [class*="col-"] {
        width: 100%;
    }

}


/* =========================================================
   MODERN PROPERTY TILE DESIGN
========================================================= */

.property-list-row .property-card-link {
    display: flex !important;
    width: 100%;
    height: 100%;
    text-decoration: none;
    color: inherit;
}

.property-list-row .property-card-modern {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 100%;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.property-list-row .property-card-modern:hover {
    transform: translateY(-7px);
    box-shadow: 0 16px 35px rgba(0, 0, 0, 0.14);
}

.property-list-row .property-card-modern > img {
    width: 100%;
    height: 245px;
    object-fit: cover;
    display: block;
    transition: transform 0.45s ease;
}

.property-list-row .property-card-modern:hover > img {
    transform: scale(1.04);
}

.property-list-row .property-card-modern .single_property_description {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px 15px;
    padding: 13px 15px;
    margin: 0;
    background: #fff;
    border-bottom: 1px solid #eee;
}

.property-list-row .property-card-modern .single_property_description span {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    line-height: 1.4;
    color: #666;
    white-space: nowrap;
}

.property-list-row .property-card-modern .single_property_description i {
    color: #f39c12;
}

.property-list-row .property-card-modern .single_property_content {
    padding: 18px 20px 12px;
    min-height: 125px;
}

.property-list-row .property-card-modern .single_property_content h4 {
    margin: 0 0 9px;
    font-size: 20px;
    line-height: 1.35;
    font-weight: 700;
    color: #222;
}

.property-list-row .property-card-modern .single_property_content p {
    margin: 0;
    font-size: 14px;
    line-height: 1.7;
    color: #777;
}

.property-list-row .property-card-modern .single_property_price {
    position: relative;
    margin-top: auto;
    padding: 14px 20px 17px;
    min-height: 72px;
    border-top: 1px solid #eee;
    background: #fafafa;
    font-size: 13px;
    color: #777;
}

.property-list-row .property-card-modern .single_property_price > span {
    display: block;
    margin-top: 5px;
    font-size: 19px;
    font-weight: 700;
    color: #222;
}

.property-list-row .property-card-modern .single_property_price > i {
    color: #f39c12;
    font-size: 12px;
}

@media (max-width: 767px) {

    .property-list-row .property-card-modern > img {
        height: 220px;
    }

}


/* =========================================================
   HOME SEARCH FORM
========================================================= */

.home-filter-box {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
}

.home-filter-form {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr auto;
    gap: 12px;
    align-items: end;
}

.home-filter-field label {
    display: block;
    margin-bottom: 7px;
    font-size: 13px;
    font-weight: 600;
    color: #444;
}

.home-filter-field input,
.home-filter-field select {
    width: 100%;
    height: 48px;
    padding: 0 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #fff;
    color: #333;
    font-size: 14px;
    outline: none;
    transition: 0.3s ease;
}

.home-filter-field input:focus,
.home-filter-field select:focus {
    border-color: #f39c12;
    box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.10);
}

.home-filter-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}

.home-filter-btn,
.home-clear-btn {
    height: 48px;
    padding: 0 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
    cursor: pointer;
    transition: 0.3s ease;
}

.home-filter-btn {
    border: none;
    background: #f39c12;
    color: #fff;
}

.home-filter-btn:hover {
    background: #222;
    color: #fff;
}

.home-clear-btn {
    background: #222;
    color: #fff !important;
}

.home-clear-btn:hover {
    background: #f39c12;
    color: #fff !important;
}


/* =========================================================
   RESPONSIVE FILTER
========================================================= */

@media (max-width: 1200px) {

    .home-filter-form {
        grid-template-columns: repeat(3, 1fr);
    }

    .home-filter-actions {
        grid-column: span 3;
        justify-content: flex-end;
    }

}

@media (max-width: 900px) {

    .home-filter-form {
        grid-template-columns: repeat(2, 1fr);
    }

    .home-filter-actions {
        grid-column: span 2;
    }

}

@media (max-width: 600px) {

    .home-filter-box {
        padding: 18px;
    }

    .home-filter-form {
        grid-template-columns: 1fr;
    }

    .home-filter-actions {
        grid-column: span 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .home-filter-btn,
    .home-clear-btn {
        width: 100%;
    }

}

@media (max-width: 420px) {

    .home-filter-actions {
        grid-template-columns: 1fr;
    }

}


/* =========================================================
   SEARCH RESULT HEADER
========================================================= */

.home-search-result-header {
    margin-bottom: 35px;
}

.home-search-result-header h2 {
    margin-bottom: 10px;
}

.home-search-result-header p {
    color: #777;
    margin-bottom: 15px;
}

.home-search-clear {
    display: inline-block;
    padding: 9px 18px;
    border-radius: 5px;
    background: #f39c12;
    color: #fff !important;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: 0.3s ease;
}

.home-search-clear:hover {
    background: #222;
    color: #fff !important;
}

</style>

@php

$isFiltering = request()->hasAny([
'search',
'purpose',
'property_type_id',
'min_area',
'max_area',
'min_price',
'max_price',
]);

@endphp

<!-- =========================
     START HOME
========================= -->

<section
    id="home"
    class="home_bg"
    style="
        background-image: url('{{ asset('assets/img/bg/home-bg.jpg') }}');
        background-size: cover;
        background-position: center center;
    "
>


<div class="container">

    <div class="row">

        <div class="col-lg-10 offset-lg-1 col-sm-12 col-xs-12 text-center">

            <div class="hero-text">

                <h2>
                    Best Real Estate Deals
                </h2>

                <p>
                    Find your dream home, apartment, land or commercial
                    property with RealState.
                </p>

                <div class="home_btn">

                    <a
                        href="{{ route('about') }}"
                        class="app-btn wow bounceIn page-scroll home_btn_color_one"
                        data-wow-delay=".6s"
                    >
                        About Us
                    </a>

                    <a
                        href="{{ route('property') }}"
                        class="app-btn wow bounceIn page-scroll home_btn_color_two"
                        data-wow-delay=".8s"
                    >
                        Our Listing
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


</section>

<!-- END HOME -->

<!-- =========================
     START SEARCH
========================= -->

<div class="search_bar section-padding">


<div class="container">

    <div class="home-filter-box">

        <form
            method="GET"
            action="{{ route('home') }}"
            class="home-filter-form"
        >

            {{-- SEARCH --}}

            <div class="home-filter-field">

                <label>
                    Search
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search property or location..."
                >

            </div>


            {{-- PURPOSE --}}

            <div class="home-filter-field">

                <label>
                    Purpose
                </label>

                <select name="purpose">

                    <option value="">
                        All
                    </option>

                    <option
                        value="sale"
                        {{ request('purpose') == 'sale' ? 'selected' : '' }}
                    >
                        Sale
                    </option>

                    <option
                        value="rent"
                        {{ request('purpose') == 'rent' ? 'selected' : '' }}
                    >
                        Rent
                    </option>

                </select>

            </div>


            {{-- PROPERTY TYPE --}}

            <div class="home-filter-field">

                <label>
                    Property Type
                </label>

                <select name="property_type_id">

                    <option value="">
                        All
                    </option>

                    @foreach($propertyTypes as $type)

                        <option
                            value="{{ $type->id }}"
                            {{ request('property_type_id') == $type->id ? 'selected' : '' }}
                        >
                            {{ $type->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- MIN AREA --}}

            <div class="home-filter-field">

                <label>
                    Min Area
                </label>

                <input
                    type="number"
                    name="min_area"
                    value="{{ request('min_area') }}"
                    placeholder="Min Area in Sq.Ft."
                    min="0"
                    step="0.01"
                >

            </div>


            {{-- MAX AREA --}}

            <div class="home-filter-field">

                <label>
                    Max Area
                </label>

                <input
                    type="number"
                    name="max_area"
                    value="{{ request('max_area') }}"
                    placeholder="Max Area in Sq.Ft."
                    min="0"
                    step="0.01"
                >

            </div>


            {{-- PRICE --}}

            <div class="home-filter-field">

                <label>
                    Price
                </label>

                <input
                    type="number"
                    name="max_price"
                    value="{{ request('max_price') }}"
                    placeholder="Max Price"
                    min="0"
                    step="0.01"
                >

            </div>


            {{-- ACTIONS --}}

            <div class="home-filter-actions">

                <button
                    type="submit"
                    class="home-filter-btn"
                >
                    Search
                </button>

                <a
                    href="{{ route('home') }}"
                    class="home-clear-btn"
                >
                    Clear Filters
                </a>

            </div>

        </form>

    </div>

</div>


</div>

<!-- END SEARCH -->

@if($isFiltering)

<!-- =========================================================
     START SEARCH RESULTS
========================================================== -->

<section
    id="search-results"
    class="template_property"
>


<div class="container">

    <div class="section-title text-center wow zoomIn">

        <h2>
            Search Results
        </h2>

        <div></div>

    </div>


    <div class="home-search-result-header text-center">

        @if($filteredProperties->count() > 0)

            <p>

                {{ $filteredProperties->count() }}

                {{ $filteredProperties->count() == 1
                    ? 'property'
                    : 'properties'
                }}

                found matching your search.

            </p>

        @else

            <p>
                No properties found matching your selected filters.
            </p>

        @endif


        <a
            href="{{ route('home') }}"
            class="home-search-clear"
        >
            Clear Search
        </a>

    </div>


    <div class="row property-list-row">

        @forelse($filteredProperties as $property)

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                <a
                    href="{{ route('property.details', ['slug' => $property->slug]) }}"
                    class="property-card-link"
                >

                    <div class="single_property property-card-modern">

                        {{-- PROPERTY IMAGE --}}

                        @if(!empty($property->photos) && is_array($property->photos))

                            <img
                                src="{{ asset('storage/' . $property->photos[0]) }}"
                                class="img-fluid"
                                alt="{{ $property->title }}"
                            >

                        @else

                            <img
                                src="{{ asset('assets/img/property/1.jpg') }}"
                                class="img-fluid"
                                alt="{{ $property->title }}"
                            >

                        @endif


                        {{-- PROPERTY DETAILS --}}

                        <div class="single_property_description text-center">

                            {{-- AREA --}}

                            @if(!is_null($property->area) && $property->area !== '')

                                <span>

                                    <i class="fa fa-object-group"></i>

                                    {{ number_format($property->area) }}

                                    sq ft

                                </span>

                            @endif


                            {{-- BEDROOMS --}}

                            @if(!is_null($property->bedrooms) && $property->bedrooms !== '')

                                <span>

                                    <i class="fa fa-bed"></i>

                                    {{ $property->bedrooms }}

                                    {{ $property->bedrooms == 1
                                        ? 'Bedroom'
                                        : 'Bedrooms'
                                    }}

                                </span>

                            @endif


                            {{-- BATHROOMS --}}

                            @if(!is_null($property->bathrooms) && $property->bathrooms !== '')

                                <span>

                                    <i class="fa fa-star-o"></i>

                                    {{ $property->bathrooms }}

                                    {{ $property->bathrooms == 1
                                        ? 'Bath'
                                        : 'Baths'
                                    }}

                                </span>

                            @endif


                            {{-- GARAGES --}}

                            @if(!is_null($property->garages) && $property->garages !== '')

                                <span>

                                    <i class="fa fa-car"></i>

                                    {{ $property->garages }}

                                    {{ $property->garages == 1
                                        ? 'Garage'
                                        : 'Garages'
                                    }}

                                </span>

                            @endif

                        </div>


                        {{-- PROPERTY CONTENT --}}

                        <div class="single_property_content">

                            <h4>
                                {{ $property->title }}
                            </h4>

                            <p>

                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags(
                                        $property->description
                                        ?? 'Beautiful property with modern facilities and excellent location.'
                                    ),
                                    100
                                ) }}

                            </p>

                        </div>


                        {{-- PRICE --}}

                        <div class="single_property_price">

                            {{ $property->address }}

                            @if(!$property->address && $property->location)

                                {{ $property->location->city }}

                                @if($property->location->state)
                                    , {{ $property->location->state }}
                                @endif

                            @endif


                            <span>

                                ₹ {{ number_format((float) $property->price) }}

                                @if($property->purpose === 'rent')
                                    / Month
                                @endif

                            </span>


                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>

                        </div>

                    </div>

                </a>

            </div>

        @empty

            <div class="col-lg-12 text-center">

                <p>
                    No properties available for the selected filters.
                </p>

            </div>

        @endforelse

    </div>

</div>


</section>

<!-- END SEARCH RESULTS -->

@else

<!-- =========================================================
     START LATEST PROPERTY
========================================================== -->

<section class="template_property">


<div class="container">

    <div class="section-title text-center wow zoomIn">

        <h2>
            Latest For Sale
        </h2>

        <div></div>

    </div>


    <div class="row property-list-row">

        @forelse($latestProperties->where('purpose', 'sale') as $property)

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                <a
                    href="{{ route('property.details', ['slug' => $property->slug]) }}"
                    class="property-card-link"
                >

                    <div class="single_property property-card-modern">

                        {{-- PROPERTY IMAGE --}}

                        @if(!empty($property->photos) && is_array($property->photos))

                            <img
                                src="{{ asset('storage/' . $property->photos[0]) }}"
                                class="img-fluid"
                                alt="{{ $property->title }}"
                            >

                        @else

                            <img
                                src="{{ asset('assets/img/property/1.jpg') }}"
                                class="img-fluid"
                                alt="{{ $property->title }}"
                            >

                        @endif


                        {{-- PROPERTY DETAILS --}}

                        <div class="single_property_description text-center">

                            @if(!is_null($property->area) && $property->area !== '')

                                <span>

                                    <i class="fa fa-object-group"></i>

                                    {{ number_format($property->area) }}

                                    sq ft

                                </span>

                            @endif


                            @if(!is_null($property->bedrooms) && $property->bedrooms !== '')

                                <span>

                                    <i class="fa fa-bed"></i>

                                    {{ $property->bedrooms }}

                                    {{ $property->bedrooms == 1
                                        ? 'Bedroom'
                                        : 'Bedrooms'
                                    }}

                                </span>

                            @endif


                            @if(!is_null($property->bathrooms) && $property->bathrooms !== '')

                                <span>

                                    <i class="fa fa-star-o"></i>

                                    {{ $property->bathrooms }}

                                    {{ $property->bathrooms == 1
                                        ? 'Bath'
                                        : 'Baths'
                                    }}

                                </span>

                            @endif


                            @if(!is_null($property->garages) && $property->garages !== '')

                                <span>

                                    <i class="fa fa-car"></i>

                                    {{ $property->garages }}

                                    {{ $property->garages == 1
                                        ? 'Garage'
                                        : 'Garages'
                                    }}

                                </span>

                            @endif

                        </div>


                        {{-- PROPERTY CONTENT --}}

                        <div class="single_property_content">

                            <h4>
                                {{ $property->title }}
                            </h4>

                            <p>

                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags(
                                        $property->description
                                        ?? 'Beautiful property with modern facilities and excellent location.'
                                    ),
                                    100
                                ) }}

                            </p>

                        </div>


                        {{-- PRICE --}}

                        <div class="single_property_price">

                            {{ $property->address }}

                            @if(!$property->address && $property->location)

                                {{ $property->location->city }}

                                @if($property->location->state)
                                    , {{ $property->location->state }}
                                @endif

                            @endif


                            <span>

                                ₹ {{ number_format((float) $property->price) }}

                                @if($property->purpose === 'rent')
                                    / Month
                                @endif

                            </span>


                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>

                        </div>

                    </div>

                </a>

            </div>

        @empty

            <div class="col-lg-12 text-center">

                <p>
                    No properties available at the moment.
                </p>

            </div>

        @endforelse

    </div>


    @if($latestProperties->where('purpose', 'sale')->count() > 0)

        <div class="text-center mt-4">

            <a
                href="{{ route('property') }}"
                class="btn btn-serach-bg"
            >
                View All Properties
            </a>

        </div>

    @endif

</div>


</section>

<!-- END LATEST PROPERTY -->

<!-- =========================================================
     START LATEST FOR RENT
========================================================== -->

<section class="template_property section-padding">


<div class="container">

    <div class="section-title text-center wow zoomIn">

        <h2>
            Latest For Rent
        </h2>

        <div></div>

    </div>


    <div class="row property-list-row">

        @forelse($latestRentProperties as $property)

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                <a
                    href="{{ route('property.details', ['slug' => $property->slug]) }}"
                    class="property-card-link"
                >

                    <div class="single_property property-card-modern">

                        {{-- PROPERTY IMAGE --}}

                        @if(!empty($property->photos) && is_array($property->photos))

                            <img
                                src="{{ asset('storage/' . $property->photos[0]) }}"
                                class="img-fluid"
                                alt="{{ $property->title }}"
                            >

                        @else

                            <img
                                src="{{ asset('assets/img/property/4.jpg') }}"
                                class="img-fluid"
                                alt="{{ $property->title }}"
                            >

                        @endif


                        {{-- PROPERTY DETAILS --}}

                        <div class="single_property_description text-center">

                            @if(!is_null($property->area) && $property->area !== '')

                                <span>

                                    <i class="fa fa-object-group"></i>

                                    {{ number_format($property->area) }}

                                    sq ft

                                </span>

                            @endif


                            @if(!is_null($property->bedrooms) && $property->bedrooms !== '')

                                <span>

                                    <i class="fa fa-bed"></i>

                                    {{ $property->bedrooms }}

                                    {{ $property->bedrooms == 1
                                        ? 'Bedroom'
                                        : 'Bedrooms'
                                    }}

                                </span>

                            @endif


                            @if(!is_null($property->bathrooms) && $property->bathrooms !== '')

                                <span>

                                    <i class="fa fa-star-o"></i>

                                    {{ $property->bathrooms }}

                                    {{ $property->bathrooms == 1
                                        ? 'Bath'
                                        : 'Baths'
                                    }}

                                </span>

                            @endif


                            @if(!is_null($property->garages) && $property->garages !== '')

                                <span>

                                    <i class="fa fa-car"></i>

                                    {{ $property->garages }}

                                    {{ $property->garages == 1
                                        ? 'Garage'
                                        : 'Garages'
                                    }}

                                </span>

                            @endif

                        </div>


                        {{-- PROPERTY CONTENT --}}

                        <div class="single_property_content">

                            <h4>
                                {{ $property->title }}
                            </h4>

                            <p>

                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags(
                                        $property->description
                                        ?? 'Comfortable rental property with excellent amenities.'
                                    ),
                                    100
                                ) }}

                            </p>

                        </div>


                        {{-- PRICE --}}

                        <div class="single_property_price">

                            {{ $property->address }}

                            @if(!$property->address && $property->location)

                                {{ $property->location->city }}

                                @if($property->location->state)
                                    , {{ $property->location->state }}
                                @endif

                            @endif


                            <span>

                                ₹ {{ number_format((float) $property->price) }}

                                / Month

                            </span>


                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>

                        </div>

                    </div>

                </a>

            </div>

        @empty

            <div class="col-lg-12 text-center">

                <p>
                    No rental properties available at the moment.
                </p>

            </div>

        @endforelse

    </div>


    @if($latestRentProperties->count() > 0)

        <div class="text-center mt-4">

            <a
                href="{{ route('property', ['purpose' => 'rent']) }}"
                class="btn btn-serach-bg"
            >
                View All Rentals
            </a>

        </div>

    @endif

</div>


</section>

<!-- END LATEST FOR RENT -->

@endif

<!-- =========================
     START GALLERY
========================= -->

<section id="gallery" class="works_area">


<div class="container">

    <div class="section-title text-center wow zoomIn">

        <h2>
            Gallery
        </h2>

        <div></div>

    </div>


    <div class="col-lg-12 text-center">

        <ul class="portfolio-filters">

            <li class="filter active" data-filter="all">
                All
            </li>

            <li class="filter" data-filter="bedroom">
                Bedroom
            </li>

            <li class="filter" data-filter="bathroom">
                Bathroom
            </li>

            <li class="filter" data-filter="kitchen">
                Kitchen
            </li>

            <li class="filter" data-filter="garage">
                Garage
            </li>

            <li class="filter" data-filter="basement">
                Basement
            </li>

        </ul>

    </div>


    <div class="row portfolio-items-list">

        @for($i = 1; $i <= 9; $i++)

            <div class="col-lg-4 col-sm-4 col-xs-12 mix
                {{ $i % 2 == 0
                    ? 'bedroom garage'
                    : 'bathroom kitchen'
                }}">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/' . $i . '.jpg') }}"
                            class="img-fluid"
                            alt="Property Gallery"
                        >

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/' . $i . '.jpg') }}"
                            >
                            </a>

                            <p>

                                <a href="{{ route('property') }}">
                                    Your Dream House
                                </a>

                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>

        @endfor

    </div>

</div>


</section>

<!-- END GALLERY -->

<!-- =========================
     START TESTIMONIAL
========================= -->

<section
    data-stellar-background-ratio="0.3"
    class="our_testimonial section-padding"
    style="
        background-image:url('{{ asset('assets/img/bg/testimonial-bg.jpg') }}');
        background-size:cover;
        background-position:center;
    "
>


<div class="container">

    <div class="row">

        <div class="col-lg-8 offset-lg-2 col-sm-12 col-xs-12 text-center">

            <div class="testimonial1-carousel">

                @for($i = 1; $i <= 3; $i++)

                    <div class="single-testimonial">

                        <img
                            src="{{ asset('assets/img/testimonial/' . $i . '.jpg') }}"
                            alt="Testimonial"
                        >

                        <h4>
                            Mark Richard
                        </h4>

                        <span>
                            Architecture
                        </span>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Fusce vitae risus nec dui
                            venenatis dignissim. Aenean vitae metus in
                            augue pretium ultrices.
                        </p>

                    </div>

                @endfor

            </div>

        </div>

    </div>

</div>


</section>

<!-- END TESTIMONIAL -->

<!-- =========================
     START NEWSLETTER
========================= -->

<section id="newsletter" class="newsletter section-padding">


<div class="container">

    <div class="row">

        <div class="col-lg-12">

            <div class="partner wow fadeInRight">

                @for($i = 1; $i <= 5; $i++)

                    <a href="#">

                        <img
                            src="{{ asset('assets/img/partner/' . $i . '.png') }}"
                            alt="Partner"
                        >

                    </a>

                @endfor


                @for($i = 1; $i <= 5; $i++)

                    <a href="#">

                        <img
                            src="{{ asset('assets/img/partner/' . $i . '.png') }}"
                            alt="Partner"
                        >

                    </a>

                @endfor

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-lg-6 offset-lg-3 col-sm-12 col-xs-12 text-center">

            <div class="signup_form">

                <h3 class="section-title-white">
                    Subscribe To Stay Updated
                </h3>


                @if(session('newsletter_success'))

                    <div
                        style="
                            margin: 15px 0;
                            padding: 12px 18px;
                            border-radius: 6px;
                            background: #d1fae5;
                            color: #065f46;
                            font-size: 14px;
                            font-weight: 600;
                        "
                    >

                        <i class="fa fa-check-circle"></i>

                        {{ session('newsletter_success') }}

                    </div>

                @endif


                @if(session('newsletter_error'))

                    <div
                        style="
                            margin: 15px 0;
                            padding: 12px 18px;
                            border-radius: 6px;
                            background: #fee2e2;
                            color: #991b1b;
                            font-size: 14px;
                            font-weight: 600;
                        "
                    >

                        <i class="fa fa-exclamation-circle"></i>

                        {{ session('newsletter_error') }}

                    </div>

                @endif


                @error('email')

                    <div
                        style="
                            margin: 15px 0;
                            padding: 12px 18px;
                            border-radius: 6px;
                            background: #fee2e2;
                            color: #991b1b;
                            font-size: 14px;
                            font-weight: 600;
                        "
                    >

                        <i class="fa fa-exclamation-circle"></i>

                        {{ $message }}

                    </div>

                @enderror


                <form
                    method="POST"
                    action="{{ route('newsletter.subscribe') }}"
                >

                    @csrf

                    <input
                        type="email"
                        placeholder="Enter Email"
                        id="mce-email"
                        class="form-control"
                        name="email"
                        value="{{ old('email') }}"
                        required
                    >

                    <span>

                        <button
                            class="btn btn-detault btn-light-bg"
                            name="subscribe"
                            type="submit"
                        >
                            Subscribe
                        </button>

                    </span>

                </form>

            </div>

        </div>

    </div>

</div>


</section>

<!-- END NEWSLETTER -->

<!-- =========================
     START BLOG
========================= -->

<section id="blog" class="fresh-news section-padding">


<div class="container">

    <div class="section-title text-center">

        <h2>
            Latest News
        </h2>

        <div></div>

    </div>


    <div class="row">

        {{-- BLOG 1 --}}

        <div class="col-lg-4 col-sm-4 col-xs-12">

            <div class="single_blog">

                <div class="blog_img">

                    <a href="{{ route('blog') }}">

                        <img
                            src="{{ asset('assets/img/blog/blog-1.jpg') }}"
                            class="img-fluid"
                            alt="Blog"
                        >

                    </a>


                    <div class="post-date">

                        <span class="date">
                            15
                        </span>

                        <span class="month">
                            Sep
                        </span>

                    </div>

                </div>


                <div class="blog_content">

                    <h3>

                        <a href="{{ route('blog') }}">
                            Team You Want To Work With Mistake Runners
                        </a>

                    </h3>


                    <p>
                        Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Fusce vitae risus nec dui
                        venenatis dignissim.
                    </p>

                </div>

            </div>

        </div>


        {{-- BLOG 2 --}}

        <div class="col-lg-4 col-sm-4 col-xs-12">

            <div class="single_blog">

                <div class="blog_img">

                    <a href="{{ route('blog') }}">

                        <img
                            src="{{ asset('assets/img/blog/blog-2.jpg') }}"
                            class="img-fluid"
                            alt="Blog"
                        >

                    </a>


                    <div class="post-date">

                        <span class="date">
                            16
                        </span>

                        <span class="month">
                            Sep
                        </span>

                    </div>

                </div>


                <div class="blog_content">

                    <h3>

                        <a href="{{ route('blog') }}">
                            Lights Winged Seasons Fish Abundantly Evening
                        </a>

                    </h3>


                    <p>
                        Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Fusce vitae risus nec dui
                        venenatis dignissim.
                    </p>

                </div>

            </div>

        </div>


        {{-- BLOG 3 --}}

        <div class="col-lg-4 col-sm-4 col-xs-12">

            <div class="single_blog">

                <div class="blog_img">

                    <a href="{{ route('blog') }}">

                        <img
                            src="{{ asset('assets/img/blog/blog-3.jpg') }}"
                            class="img-fluid"
                            alt="Blog"
                        >

                    </a>


                    <div class="post-date">

                        <span class="date">
                            17
                        </span>

                        <span class="month">
                            Sep
                        </span>

                    </div>

                </div>


                <div class="blog_content">

                    <h3>

                        <a href="{{ route('blog') }}">
                            Winged Moved Stars, Food Creature Seed Night
                        </a>

                    </h3>


                    <p>
                        Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Fusce vitae risus nec dui
                        venenatis dignissim.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


</section>

<!-- END BLOG -->

{{-- =========================================================
AUTO SCROLL TO SEARCH RESULTS AFTER FILTERING
========================================================== --}}

@if($isFiltering)

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchResults =
        document.getElementById('search-results');

    if (searchResults) {

        setTimeout(function () {

            const headerOffset = 80;

            const elementPosition =
                searchResults.getBoundingClientRect().top;

            const offsetPosition =
                elementPosition +
                window.pageYOffset -
                headerOffset;

            window.scrollTo({

                top: offsetPosition,

                behavior: 'smooth'

            });

        }, 150);

    }

});

</script>

@endif

@endsection
