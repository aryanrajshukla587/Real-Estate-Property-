@extends('layouts.app')

@section('title', 'RealState - Find Your Dream Property')

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

                <h1>About Page</h1>

            </div>

        </div>
    </div>
</section>
{{-- END SECTION TOP --}}


{{-- =========================================================
     START ABOUT US
========================================================= --}}
<section id="about" class="about-us section-padding">

    <div class="container">

        <div class="section-title text-center wow zoomIn">

            <h2>About us</h2>

            <div></div>

        </div>


        <div class="row">

            {{-- LEFT CONTENT --}}
            <div class="col-lg-6 col-sm-12 col-xs-12">

                <div class="about-us-content">

                    <h2>About Our Agency</h2>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Excepturi perferendis magnam ea necessitatibus, officiis
                        voluptas odit! Aperiam omnis, cupiditate laudantium velit
                        nostrum, exercitationem accusamus, possimus soluta illo.
                        Lorem ipsum dolor sit. Cupiditate laudantium velit nostrum.
                    </p>


                    <ul>

                        <li>
                            <i class="fa fa-check"></i>
                            Excepturi perferendis magnam ea necessitatibus
                        </li>

                        <li>
                            <i class="fa fa-check"></i>
                            Aperiam omnis, cupiditate laudantium
                        </li>

                        <li>
                            <i class="fa fa-check"></i>
                            Exercitationem accusamus, possimus soluta.
                        </li>

                        <li>
                            <i class="fa fa-check"></i>
                            Lorem ipsum dolor sit amet ea necessitatibus
                        </li>

                    </ul>


                    <a href="#">
                        Read More
                    </a>

                </div>

            </div>


            {{-- RIGHT IMAGE --}}
            <div class="col-lg-6 col-sm-12 col-xs-12">

                <div class="about_img">

                    <img src="{{ asset('assets/img/2.jpg') }}"
                         class="img-fluid"
                         alt="About Us">

                </div>

            </div>

        </div>

    </div>

</section>
{{-- END ABOUT US --}}




{{-- =========================================================
     START TEAM
========================================================= --}}
<section id="team" class="our_team section-padding">

    <div class="container">

        <div class="section-title text-center wow zoomIn">

            <h2>Professional team</h2>

            <div></div>

        </div>


        <div class="row text-center">


            {{-- =================================================
                 TEAM 1
            ================================================== --}}
            <div class="col-lg-3 col-sm-3 col-xs-12">

                <div class="single_team">

                    <img src="{{ asset('assets/img/team/team-1.jpg') }}"
                         class="img-fluid"
                         alt="Juthi Ahmed">


                    <h3>Juthi Ahmed</h3>

                    <p>Co Founder</p>


                    <ul class="list-inline">

                        <li>
                            <a href="#" class="st-facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="st-twitter">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="st-instagram">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>


            {{-- =================================================
                 TEAM 2
            ================================================== --}}
            <div class="col-lg-3 col-sm-3 col-xs-12">

                <div class="single_team">

                    <img src="{{ asset('assets/img/team/team-2.jpg') }}"
                         class="img-fluid"
                         alt="Masum Billah">


                    <h3>Masum Billah</h3>

                    <p>Co Founder</p>


                    <ul class="list-inline">

                        <li>
                            <a href="#" class="st-facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="st-twitter">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="st-instagram">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>


            {{-- =================================================
                 TEAM 3
            ================================================== --}}
            <div class="col-lg-3 col-sm-3 col-xs-12">

                <div class="single_team">

                    <img src="{{ asset('assets/img/team/team-3.jpg') }}"
                         class="img-fluid"
                         alt="Syed Ekram">


                    <h3>Syed Ekram</h3>

                    <p>Co Founder</p>


                    <ul class="list-inline">

                        <li>
                            <a href="#" class="st-facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="st-twitter">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="st-instagram">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>


            {{-- =================================================
                 TEAM 4
            ================================================== --}}
            <div class="col-lg-3 col-sm-3 col-xs-12">

                <div class="single_team">

                    <img src="{{ asset('assets/img/team/team-4.jpg') }}"
                         class="img-fluid"
                         alt="Hanjala Haque">


                    <h3>Hanjala Haque</h3>

                    <p>Co Founder</p>


                    <ul class="list-inline">

                        <li>
                            <a href="#" class="st-facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="st-twitter">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="st-instagram">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- END TEAM --}}


@endsection