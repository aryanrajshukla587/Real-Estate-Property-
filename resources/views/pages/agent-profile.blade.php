@extends('layouts.app')

@section('title', 'Agent Profile - Eagle Properties')

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

                <h1>Agent Profile</h1>

            </div>

        </div>

    </div>

</section>
{{-- END SECTION TOP --}}


{{-- =========================================================
     START AGENT PROFILE
========================================================= --}}
<section class="template_agent">

    <div class="container">

        <div class="row">

            <div class="col-lg-10 offset-lg-1 col-sm-12 col-xs-12">


                {{-- =================================================
                     AGENT 1
                ================================================== --}}
                <div class="single_agent">

                    <div class="single_agent_image">

                        <img
                            src="{{ asset('assets/img/team/1.png') }}"
                            class="img-fluid"
                            alt="Thelma Banker"
                        />

                    </div>

                    <div class="single_agent_content">

                        <h4>Thelma Banker</h4>

                        <h5>Real estate agents</h5>

                        <h6>
                            Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and
                            scrambled it to make a type specimen book.
                        </h6>

                        <p>
                            <i class="fa fa-envelope-o"></i>
                            yourmail@gmail.com
                        </p>

                        <p>
                            <i class="fa fa-phone"></i>
                            (+123) 123 123 123
                        </p>

                        <p>
                            <i class="fa fa-plane"></i>
                            www.yourdomainname.com
                        </p>

                        <p>
                            <i class="fa fa-skype"></i>
                            skype.address
                        </p>

                    </div>

                    <div class="agent_social">

                        <ul class="list-inline">

                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>
                {{-- END AGENT 1 --}}


                {{-- =================================================
                     AGENT 2
                ================================================== --}}
                <div class="single_agent">

                    <div class="single_agent_image">

                        <img
                            src="{{ asset('assets/img/team/2.png') }}"
                            class="img-fluid"
                            alt="Kallu Mastan"
                        />

                    </div>

                    <div class="single_agent_content">

                        <h4>Kallu Mastan</h4>

                        <h5>Real estate agents</h5>

                        <h6>
                            Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and
                            scrambled it to make a type specimen book.
                        </h6>

                        <p>
                            <i class="fa fa-envelope-o"></i>
                            yourmail@gmail.com
                        </p>

                        <p>
                            <i class="fa fa-phone"></i>
                            (+123) 123 123 123
                        </p>

                        <p>
                            <i class="fa fa-plane"></i>
                            www.yourdomainname.com
                        </p>

                        <p>
                            <i class="fa fa-skype"></i>
                            skype.address
                        </p>

                    </div>

                    <div class="agent_social">

                        <ul class="list-inline">

                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>
                {{-- END AGENT 2 --}}


                {{-- =================================================
                     AGENT 3
                ================================================== --}}
                <div class="single_agent">

                    <div class="single_agent_image">

                        <img
                            src="{{ asset('assets/img/team/3.png') }}"
                            class="img-fluid"
                            alt="Keno Sha"
                        />

                    </div>

                    <div class="single_agent_content">

                        <h4>Keno Sha</h4>

                        <h5>Real estate agents</h5>

                        <h6>
                            Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and
                            scrambled it to make a type specimen book.
                        </h6>

                        <p>
                            <i class="fa fa-envelope-o"></i>
                            yourmail@gmail.com
                        </p>

                        <p>
                            <i class="fa fa-phone"></i>
                            (+123) 123 123 123
                        </p>

                        <p>
                            <i class="fa fa-plane"></i>
                            www.yourdomainname.com
                        </p>

                        <p>
                            <i class="fa fa-skype"></i>
                            skype.address
                        </p>

                    </div>

                    <div class="agent_social">

                        <ul class="list-inline">

                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>
                {{-- END AGENT 3 --}}


                {{-- =================================================
                     AGENT 4
                ================================================== --}}
                <div class="single_agent">

                    <div class="single_agent_image">

                        <img
                            src="{{ asset('assets/img/team/4.png') }}"
                            class="img-fluid"
                            alt="Digbaji Kha"
                        />

                    </div>

                    <div class="single_agent_content">

                        <h4>Digbaji Kha</h4>

                        <h5>Real estate agents</h5>

                        <h6>
                            Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and
                            scrambled it to make a type specimen book.
                        </h6>

                        <p>
                            <i class="fa fa-envelope-o"></i>
                            yourmail@gmail.com
                        </p>

                        <p>
                            <i class="fa fa-phone"></i>
                            (+123) 123 123 123
                        </p>

                        <p>
                            <i class="fa fa-plane"></i>
                            www.yourdomainname.com
                        </p>

                        <p>
                            <i class="fa fa-skype"></i>
                            skype.address
                        </p>

                    </div>

                    <div class="agent_social">

                        <ul class="list-inline">

                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>
                {{-- END AGENT 4 --}}


            </div>

        </div>

    </div>

</section>
{{-- END AGENT PROFILE --}}

@endsection