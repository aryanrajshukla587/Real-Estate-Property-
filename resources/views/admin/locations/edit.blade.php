@extends('admin.layouts.app')

@section('title', 'Edit Location')

@section('content')

<div class="mx-auto max-w-4xl space-y-6">

{{-- HEADER --}}
<div>

    <a
        href="{{ route('admin.locations.index') }}"
        class="mb-3 inline-flex items-center gap-2 text-sm text-gray-400 transition hover:text-white">

        <i class="fa-solid fa-arrow-left"></i>

        Back to Locations

    </a>

    <h1 class="text-2xl font-bold text-white">
        Edit Location
    </h1>

    <p class="mt-1 text-sm text-gray-400">
        Update location information.
    </p>

</div>


{{-- VALIDATION --}}
@if($errors->any())

    <div class="rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-3">

        <div class="mb-2 font-medium text-red-400">
            Please fix the following errors:
        </div>

        <ul class="list-inside list-disc text-sm text-red-400">

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


{{-- FORM --}}
<form
    action="{{ route('admin.locations.update', $location) }}"
    method="POST"
    class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900 shadow-xl">

    @csrf

    @method('PUT')


    <div class="space-y-6 p-6">


        {{-- LOCATION INFORMATION --}}
        <div>

            <h2 class="text-lg font-semibold text-white">
                Location Information
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Update country, state and city information.
            </p>

        </div>


        {{-- COUNTRY / STATE / CITY --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


            {{-- COUNTRY --}}
            <div>

                <label
                    for="country"
                    class="mb-2 block text-sm font-medium text-gray-300">

                    Country
                    <span class="text-red-400">*</span>

                </label>


                <select
                    id="country"
                    name="country"
                    required
                    class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-2.5 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">

                    <option value="">
                        Select Country
                    </option>

                    <option
                        value="India"
                        {{ old('country', $location->country) == 'India' ? 'selected' : '' }}>

                        India

                    </option>

                    <option
                        value="United States"
                        {{ old('country', $location->country) == 'United States' ? 'selected' : '' }}>

                        United States

                    </option>

                    <option
                        value="United Kingdom"
                        {{ old('country', $location->country) == 'United Kingdom' ? 'selected' : '' }}>

                        United Kingdom

                    </option>

                    <option
                        value="Canada"
                        {{ old('country', $location->country) == 'Canada' ? 'selected' : '' }}>

                        Canada

                    </option>

                    <option
                        value="Australia"
                        {{ old('country', $location->country) == 'Australia' ? 'selected' : '' }}>

                        Australia

                    </option>

                </select>


                @error('country')

                    <p class="mt-1 text-xs text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- STATE --}}
            <div>

                <label
                    for="state"
                    class="mb-2 block text-sm font-medium text-gray-300">

                    State
                    <span class="text-red-400">*</span>

                </label>


                <select
                    id="state"
                    name="state"
                    required
                    disabled
                    class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-2.5 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-50">

                    <option value="">
                        Select State
                    </option>

                </select>


                @error('state')

                    <p class="mt-1 text-xs text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- CITY --}}
            <div>

                <label
                    for="city"
                    class="mb-2 block text-sm font-medium text-gray-300">

                    City
                    <span class="text-red-400">*</span>

                </label>


                <select
                    id="city"
                    name="city"
                    required
                    disabled
                    class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-2.5 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-50">

                    <option value="">
                        Select City
                    </option>

                </select>


                @error('city')

                    <p class="mt-1 text-xs text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>


        </div>


        {{-- ADDRESS --}}
        <div>

            <label
                for="address"
                class="mb-2 block text-sm font-medium text-gray-300">

                Address

            </label>


            <textarea
                id="address"
                name="address"
                rows="3"
                placeholder="Enter complete address"
                class="w-full resize-none rounded-lg border border-gray-700 bg-gray-950 px-4 py-2.5 text-sm text-white placeholder-gray-500 outline-none transition focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">{{ old('address', $location->address) }}</textarea>


            @error('address')

                <p class="mt-1 text-xs text-red-400">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- COORDINATES --}}
        <div class="border-t border-gray-800 pt-6">


            <h2 class="text-lg font-semibold text-white">
                Map Coordinates
            </h2>


            <p class="mt-1 text-sm text-gray-500">
                Optional latitude and longitude.
            </p>


            <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">


                {{-- LATITUDE --}}
                <div>

                    <label
                        for="latitude"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Latitude

                    </label>


                    <input
                        type="number"
                        step="any"
                        id="latitude"
                        name="latitude"
                        value="{{ old('latitude', $location->latitude) }}"
                        placeholder="e.g. 28.6139"
                        class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-2.5 text-sm text-white placeholder-gray-500 outline-none transition focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">


                    @error('latitude')

                        <p class="mt-1 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- LONGITUDE --}}
                <div>

                    <label
                        for="longitude"
                        class="mb-2 block text-sm font-medium text-gray-300">

                        Longitude

                    </label>


                    <input
                        type="number"
                        step="any"
                        id="longitude"
                        name="longitude"
                        value="{{ old('longitude', $location->longitude) }}"
                        placeholder="e.g. 77.2090"
                        class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-2.5 text-sm text-white placeholder-gray-500 outline-none transition focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">


                    @error('longitude')

                        <p class="mt-1 text-xs text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


            </div>

        </div>


        {{-- STATUS --}}
        <div class="border-t border-gray-800 pt-6">


            <label class="flex cursor-pointer items-center gap-3">


                <input
                    type="hidden"
                    name="is_active"
                    value="0">


                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(old('is_active', $location->is_active))
                    class="h-4 w-4 rounded border-gray-600 bg-gray-800 text-indigo-600 focus:ring-2 focus:ring-indigo-500">


                <span>

                    <span class="block text-sm font-medium text-gray-300">
                        Active Location
                    </span>

                    <span class="block text-xs text-gray-500">
                        Allow this location to be used for properties.
                    </span>

                </span>


            </label>

        </div>


    </div>


    {{-- FOOTER --}}
    <div class="flex items-center justify-end gap-3 border-t border-gray-800 bg-gray-950/40 px-6 py-4">


        <a
            href="{{ route('admin.locations.index') }}"
            class="rounded-lg border border-gray-700 px-4 py-2.5 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">

            Cancel

        </a>


        <button
            type="submit"
            class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">

            <i class="fa-solid fa-check"></i>

            Update Location

        </button>


    </div>


</form>

</div>


{{-- =========================================================
     COUNTRY → STATE → CITY
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const countrySelect = document.getElementById('country');

    const stateSelect = document.getElementById('state');

    const citySelect = document.getElementById('city');


    /*
    |--------------------------------------------------------------------------
    | OLD / DATABASE VALUES
    |--------------------------------------------------------------------------
    */

    const selectedCountry = @json(old('country', $location->country));

    const selectedState = @json(old('state', $location->state));

    const selectedCity = @json(old('city', $location->city));


    /*
    |--------------------------------------------------------------------------
    | LOCATION DATA
    |--------------------------------------------------------------------------
    */

    const locations = {

        "India": {

            "Uttar Pradesh": [
                "Agra",
                "Aligarh",
                "Auraiya",
                "Ayodhya",
                "Bareilly",
                "Etawah",
                "Farrukhabad",
                "Firozabad",
                "Ghaziabad",
                "Gorakhpur",
                "Jhansi",
                "Kanpur",
                "Lucknow",
                "Mathura",
                "Meerut",
                "Moradabad",
                "Noida",
                "Prayagraj",
                "Varanasi"
            ],

            "Delhi": [
                "New Delhi",
                "Delhi"
            ],

            "Maharashtra": [
                "Mumbai",
                "Pune",
                "Nagpur",
                "Nashik",
                "Thane"
            ],

            "Rajasthan": [
                "Jaipur",
                "Jodhpur",
                "Udaipur",
                "Kota",
                "Ajmer"
            ],

            "Gujarat": [
                "Ahmedabad",
                "Surat",
                "Vadodara",
                "Rajkot",
                "Gandhinagar"
            ],

            "Madhya Pradesh": [
                "Bhopal",
                "Indore",
                "Gwalior",
                "Jabalpur",
                "Ujjain"
            ],

            "Karnataka": [
                "Bengaluru",
                "Mysuru",
                "Mangaluru",
                "Hubballi"
            ],

            "Tamil Nadu": [
                "Chennai",
                "Coimbatore",
                "Madurai",
                "Salem",
                "Tiruchirappalli"
            ],

            "West Bengal": [
                "Kolkata",
                "Howrah",
                "Durgapur",
                "Siliguri"
            ],

            "Bihar": [
                "Patna",
                "Gaya",
                "Muzaffarpur",
                "Bhagalpur"
            ]

        },


        "United States": {

            "California": [
                "Los Angeles",
                "San Diego",
                "San Francisco",
                "San Jose",
                "Sacramento"
            ],

            "Texas": [
                "Houston",
                "Dallas",
                "Austin",
                "San Antonio",
                "Fort Worth"
            ],

            "New York": [
                "New York City",
                "Buffalo",
                "Rochester",
                "Albany"
            ]

        },


        "United Kingdom": {

            "England": [
                "London",
                "Manchester",
                "Birmingham",
                "Liverpool",
                "Leeds"
            ],

            "Scotland": [
                "Edinburgh",
                "Glasgow",
                "Aberdeen"
            ],

            "Wales": [
                "Cardiff",
                "Swansea",
                "Newport"
            ]

        },


        "Canada": {

            "Ontario": [
                "Toronto",
                "Ottawa",
                "Mississauga",
                "Hamilton"
            ],

            "Quebec": [
                "Montreal",
                "Quebec City",
                "Laval"
            ],

            "British Columbia": [
                "Vancouver",
                "Victoria",
                "Surrey"
            ]

        },


        "Australia": {

            "New South Wales": [
                "Sydney",
                "Newcastle",
                "Wollongong"
            ],

            "Victoria": [
                "Melbourne",
                "Geelong",
                "Ballarat"
            ],

            "Queensland": [
                "Brisbane",
                "Gold Coast",
                "Cairns"
            ]

        }

    };


    /*
    |--------------------------------------------------------------------------
    | LOAD STATES
    |--------------------------------------------------------------------------
    */

    function loadStates(country, selectedState = '') {

        stateSelect.innerHTML = `
            <option value="">
                Select State
            </option>
        `;

        citySelect.innerHTML = `
            <option value="">
                Select City
            </option>
        `;

        citySelect.disabled = true;


        if (!country || !locations[country]) {

            stateSelect.disabled = true;

            return;

        }


        stateSelect.disabled = false;


        Object.keys(locations[country]).forEach(function (state) {

            const option = document.createElement('option');

            option.value = state;

            option.textContent = state;


            if (state === selectedState) {

                option.selected = true;

            }


            stateSelect.appendChild(option);

        });


        if (selectedState) {

            loadCities(
                country,
                selectedState,
                selectedCity
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | LOAD CITIES
    |--------------------------------------------------------------------------
    */

    function loadCities(
        country,
        state,
        selectedCityValue = ''
    ) {

        citySelect.innerHTML = `
            <option value="">
                Select City
            </option>
        `;


        if (
            !country ||
            !state ||
            !locations[country] ||
            !locations[country][state]
        ) {

            citySelect.disabled = true;

            return;

        }


        citySelect.disabled = false;


        locations[country][state].forEach(function (city) {

            const option = document.createElement('option');

            option.value = city;

            option.textContent = city;


            if (city === selectedCityValue) {

                option.selected = true;

            }


            citySelect.appendChild(option);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | COUNTRY CHANGE
    |--------------------------------------------------------------------------
    */

    countrySelect.addEventListener('change', function () {

        loadStates(this.value);

    });


    /*
    |--------------------------------------------------------------------------
    | STATE CHANGE
    |--------------------------------------------------------------------------
    */

    stateSelect.addEventListener('change', function () {

        loadCities(
            countrySelect.value,
            this.value
        );

    });


    /*
    |--------------------------------------------------------------------------
    | LOAD EXISTING LOCATION
    |--------------------------------------------------------------------------
    */

    if (selectedCountry) {

        countrySelect.value = selectedCountry;

        loadStates(
            selectedCountry,
            selectedState
        );

    }

});

</script>

@endsection
