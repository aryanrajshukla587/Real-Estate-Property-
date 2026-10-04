@extends('layouts.app')

@section('title', 'Blog - Eagle Properties')

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

                <h1>Blog Post</h1>

            </div>

        </div>

    </div>

</section>
{{-- END SECTION TOP --}}


{{-- =========================================================
     START BLOG
========================================================= --}}
<section class="blog-page section-padding">

    <div class="container">

        <div class="row">

            {{-- =================================================
                 BLOG CONTENT
            ================================================== --}}
            <div class="col-lg-8 col-sm-12 col-xs-12">

                {{-- BLOG 1 --}}
                <div class="single_blog_page">

                    <a href="{{ url('/blog') }}">
                        <img
                            src="{{ asset('assets/img/blog/blog-1.jpg') }}"
                            class="img-fluid"
                            alt="Team you want to work with"
                        >
                    </a>

                    <h2>
                        <a href="{{ url('/blog-post') }}">
                            Team you want to work with mistake runners
                        </a>
                    </h2>

                    <span>
                        <a href="#">Leave a Comment</a>
                    </span>

                    <span>
                        <a href="#">Product Design</a>
                    </span>

                    <span>
                        By <a href="#">theme_ocean</a>
                    </span>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Fusce vitae risus nec dui venenatis dignissim.
                        Aenean vitae metus in augue pretium ultrices.
                        Fusce vitae risus nec dui venenatis dignissim.
                        Aenean vitae metus in augue pretium ultrices.
                    </p>

                    <a
                        class="single_blog_page_btn"
                        href="{{ url('/blog-post') }}"
                    >
                        Read More
                    </a>

                </div>


                {{-- BLOG 2 --}}
                <div class="single_blog_page">

                    <a href="{{ url('/blog') }}">
                        <img
                            src="{{ asset('assets/img/blog/blog-2.jpg') }}"
                            class="img-fluid"
                            alt="Lights winged seasons"
                        >
                    </a>

                    <h2>
                        <a href="{{ url('/blog-post') }}">
                            Lights winged seasons fish abundantly evening
                        </a>
                    </h2>

                    <span>
                        <a href="#">Leave a Comment</a>
                    </span>

                    <span>
                        <a href="#">Product Design</a>
                    </span>

                    <span>
                        By <a href="#">theme_ocean</a>
                    </span>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Fusce vitae risus nec dui venenatis dignissim.
                        Aenean vitae metus in augue pretium ultrices.
                        Fusce vitae risus nec dui venenatis dignissim.
                        Aenean vitae metus in augue pretium ultrices.
                    </p>

                    <a
                        class="single_blog_page_btn"
                        href="{{ url('/blog-post') }}"
                    >
                        Read More
                    </a>

                </div>


                {{-- BLOG 3 --}}
                <div class="single_blog_page">

                    <a href="{{ url('/blog') }}">
                        <img
                            src="{{ asset('assets/img/blog/blog-3.jpg') }}"
                            class="img-fluid"
                            alt="Winged moved stars"
                        >
                    </a>

                    <h2>
                        <a href="{{ url('/blog-post') }}">
                            Winged moved stars, food creature seed night
                        </a>
                    </h2>

                    <span>
                        <a href="#">Leave a Comment</a>
                    </span>

                    <span>
                        <a href="#">Product Design</a>
                    </span>

                    <span>
                        By <a href="#">theme_ocean</a>
                    </span>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Fusce vitae risus nec dui venenatis dignissim.
                        Aenean vitae metus in augue pretium ultrices.
                        Fusce vitae risus nec dui venenatis dignissim.
                        Aenean vitae metus in augue pretium ultrices.
                    </p>

                    <a
                        class="single_blog_page_btn"
                        href="{{ url('/blog-post') }}"
                    >
                        Read More
                    </a>

                </div>


                {{-- =================================================
                     PAGINATION
                ================================================== --}}
                <div id="pagination">

                    <nav>

                        <ul class="pagination blog_pagination">

                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <li>
                                <a href="#">1</a>
                            </li>

                            <li>
                                <a href="#">2</a>
                            </li>

                            <li>
                                <a href="#">3</a>
                            </li>

                            <li>
                                <a href="#">4</a>
                            </li>

                            <li>
                                <a href="#">5</a>
                            </li>

                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>

                        </ul>

                    </nav>

                </div>

            </div>
            {{-- END BLOG CONTENT --}}


            {{-- =================================================
                 SIDEBAR
            ================================================== --}}
            <div class="col-lg-4 col-sm-12 col-xs-12">

                {{-- SEARCH --}}
                <div class="blog_search">

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Type & Press Enter"
                    >

                </div>


                {{-- MOST READ --}}
                <div class="latest_blog">

                    <h4 class="blog_sidebar_title">
                        Most read
                    </h4>


                    <div class="single_latest_blog">

                        <a href="#">
                            <h4>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Fusce vitae risus nec dui venenatis dignissim.
                            </h4>
                        </a>

                    </div>


                    <div class="single_latest_blog">

                        <a href="#">
                            <h4>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Fusce vitae risus nec dui venenatis dignissim.
                            </h4>
                        </a>

                    </div>


                    <div class="single_latest_blog">

                        <a href="#">
                            <h4>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Fusce vitae risus nec dui venenatis dignissim.
                            </h4>
                        </a>

                    </div>


                    <div class="single_latest_blog">

                        <a href="#">
                            <h4>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Fusce vitae risus nec dui venenatis dignissim.
                            </h4>
                        </a>

                    </div>

                </div>


                {{-- CATEGORIES --}}
                <div class="categories">

                    <h4 class="blog_sidebar_title">
                        Categories
                    </h4>

                    <ul>

                        <li>
                            <a href="#">
                                <i class="ti-arrow-right"></i>
                                Photography
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="ti-arrow-right"></i>
                                Business
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="ti-arrow-right"></i>
                                Responsive Design
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="ti-arrow-right"></i>
                                Web Design
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="ti-arrow-right"></i>
                                Branding
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="ti-arrow-right"></i>
                                Marketing
                            </a>
                        </li>

                    </ul>

                </div>


                {{-- ADVERTISEMENT --}}
                <div class="advertisement_post">

                    <h4 class="blog_sidebar_title">
                        Advertisement
                    </h4>

                    <a href="#">

                        <img
                            src="{{ asset('assets/img/blog/banner_3.jpg') }}"
                            class="img-responsive"
                            alt="Advertisement"
                        >

                    </a>

                </div>


                {{-- TAG CLOUD --}}
                <div class="tag">

                    <h4 class="blog_sidebar_title">
                        Tag cloud
                    </h4>

                    <a href="#">Design</a>
                    <a href="#">Development</a>
                    <a href="#">Seo</a>
                    <a href="#">Responsive</a>
                    <a href="#">Photography</a>
                    <a href="#">How to build</a>
                    <a href="#">All project</a>
                    <a href="#">Clean Design</a>

                </div>

            </div>
            {{-- END SIDEBAR --}}

        </div>

    </div>

</section>
{{-- END BLOG --}}

@endsection