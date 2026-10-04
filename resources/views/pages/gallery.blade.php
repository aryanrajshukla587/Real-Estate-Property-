@extends('layouts.app')

@section('title', 'Gallery - Eagle Properties')

@section('content')

{{-- =========================================================
     START SECTION TOP
========================================================= --}}
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 col-xs-12 text-center">

            <div class="section-top-title wow fadeInRight"
                 data-wow-duration="1s"
                 data-wow-delay="0.3s"
                 data-wow-offset="0">

                <h1>Gallery</h1>

            </div>

        </div>
    </div>
</section>
{{-- END SECTION TOP --}}


{{-- =========================================================
     START GALLERY
========================================================= --}}
<section id="gallery" class="works_area">

    <div class="container">

        {{-- SECTION TITLE --}}
        <div class="section-title text-center wow zoomIn">
            <h2>Gallery</h2>
            <div></div>
        </div>


        {{-- =================================================
             GALLERY FILTERS
        ================================================== --}}
        <div class="col-lg-12 text-center">

            <ul class="portfolio-filters">

                <li class="filter active" data-filter="all">
                    all
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


        {{-- =================================================
             GALLERY ITEMS
        ================================================== --}}
        <div class="row portfolio-items-list">


            {{-- IMAGE 1 --}}
            <div class="col-lg-4 col-sm-4 col-xs-12 mix bathroom kitchen garage">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/1.jpg') }}"
                            class="img-fluid"
                            alt="Your Dream House"
                        />

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/1.jpg') }}"
                            ></a>

                            <p>
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#projectModal"
                                >
                                    Your Dream House
                                </a>
                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>


            {{-- IMAGE 2 --}}
            <div class="col-lg-4 col-sm-4 col-xs-12 mix bedroom garage">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/2.jpg') }}"
                            class="img-fluid"
                            alt="Your Dream House"
                        />

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/2.jpg') }}"
                            ></a>

                            <p>
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#projectModal"
                                >
                                    Your Dream House
                                </a>
                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>


            {{-- IMAGE 3 --}}
            <div class="col-lg-4 col-sm-4 col-xs-12 mix bathroom">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/3.jpg') }}"
                            class="img-fluid"
                            alt="Your Dream House"
                        />

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/3.jpg') }}"
                            ></a>

                            <p>
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#projectModal"
                                >
                                    Your Dream House
                                </a>
                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>


            {{-- IMAGE 4 --}}
            <div class="col-lg-4 col-sm-4 col-xs-12 mix garage kitchen">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/4.jpg') }}"
                            class="img-fluid"
                            alt="Your Dream House"
                        />

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/4.jpg') }}"
                            ></a>

                            <p>
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#projectModal"
                                >
                                    Your Dream House
                                </a>
                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>


            {{-- IMAGE 5 --}}
            <div class="col-lg-4 col-sm-4 col-xs-12 mix bedroom">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/5.jpg') }}"
                            class="img-fluid"
                            alt="Your Dream House"
                        />

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/5.jpg') }}"
                            ></a>

                            <p>
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#projectModal"
                                >
                                    Your Dream House
                                </a>
                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>


            {{-- IMAGE 6 --}}
            <div class="col-lg-4 col-sm-4 col-xs-12 mix bathroom kitchen">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/6.jpg') }}"
                            class="img-fluid"
                            alt="Your Dream House"
                        />

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/6.jpg') }}"
                            ></a>

                            <p>
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#projectModal"
                                >
                                    Your Dream House
                                </a>
                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>


            {{-- IMAGE 7 --}}
            <div class="col-lg-4 col-sm-4 col-xs-12 mix basement garage">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/7.jpg') }}"
                            class="img-fluid"
                            alt="Your Dream House"
                        />

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/7.jpg') }}"
                            ></a>

                            <p>
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#projectModal"
                                >
                                    Your Dream House
                                </a>
                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>


            {{-- IMAGE 8 --}}
            <div class="col-lg-4 col-sm-4 col-xs-12 mix bedroom basement">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/8.jpg') }}"
                            class="img-fluid"
                            alt="Your Dream House"
                        />

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/8.jpg') }}"
                            ></a>

                            <p>
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#projectModal"
                                >
                                    Your Dream House
                                </a>
                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>


            {{-- IMAGE 9 --}}
            <div class="col-lg-4 col-sm-4 col-xs-12 mix bedroom basement">

                <div class="grid">

                    <figure class="effect-apollo">

                        <img
                            src="{{ asset('assets/img/portfolio/9.jpg') }}"
                            class="img-fluid"
                            alt="Your Dream House"
                        />

                        <figcaption>

                            <a
                                class="prettyPhoto image_zoom"
                                href="{{ asset('assets/img/portfolio/9.jpg') }}"
                            ></a>

                            <p>
                                <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#projectModal"
                                >
                                    Your Dream House
                                </a>
                            </p>

                        </figcaption>

                    </figure>

                </div>

            </div>


        </div>
        {{-- END ROW --}}

    </div>
    {{-- END CONTAINER --}}

</section>
{{-- END GALLERY --}}

@endsection