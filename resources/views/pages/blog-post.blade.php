@extends('layouts.app')

@section('title', 'Blog Post - Eagle Properties')

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
     START BLOG POST
========================================================= --}}
<section class="blog_post section-padding">

    <div class="container">

        <div class="row">

            {{-- =================================================
                 LEFT CONTENT
            ================================================== --}}
            <div class="col-md-8 col-sm-12 col-xs-12">

                <div class="blog_post_left">

                    {{-- Blog Image --}}
                    <div class="home_blog_img">

                        <img
                            src="{{ asset('assets/img/blog/blog-1.jpg') }}"
                            class="img-fluid"
                            alt="Blog Image"
                        >

                    </div>


                    {{-- Blog Content --}}
                    <div class="home_blog blog-post-blog">

                        <div class="single_blog_content">

                            <p>
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a
                                type specimen book.

                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a
                                type specimen book.

                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a
                                type specimen book.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     COMMENTS
                ================================================== --}}
                <div class="comments_part">

                    <h3 class="blog_head_title">
                        Comments
                    </h3>


                    <div class="single_comment">

                        <img
                            src="{{ asset('assets/img/blog/c1.jpg') }}"
                            alt="Masum Billah"
                        >

                        <h4>
                            Masum Billah
                        </h4>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Praesent ultricies quam nisi, vel gravida enim accumsan id.
                            Praesent justo quam, auctor et lorem in, pulvinar ornare orci.
                            Duis dapibus urna purus, eget facilisis nisi tincidunt semper.
                        </p>

                    </div>

                </div>
                {{-- END COMMENTS --}}


                {{-- =================================================
                     COMMENT FORM
                ================================================== --}}
                <div class="comment_form">

                    <h3 class="blog_head_title">
                        Add a Comment
                    </h3>


                    <form
                        class="form"
                        name="enq"
                        method="POST"
                        action="#"
                    >

                        @csrf

                        <div class="row">

                            {{-- Name --}}
                            <div class="form-group col-md-6">

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    id="first-name"
                                    placeholder="Name"
                                    value="{{ old('name') }}"
                                    required
                                >

                            </div>


                            {{-- Email --}}
                            <div class="form-group col-md-6">

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    id="email"
                                    placeholder="Email"
                                    value="{{ old('email') }}"
                                    required
                                >

                            </div>


                            {{-- Message --}}
                            <div class="form-group col-md-12 mbnone">

                                <textarea
                                    rows="6"
                                    name="message"
                                    class="form-control"
                                    id="description"
                                    placeholder="Your Message"
                                    required
                                >{{ old('message') }}</textarea>

                            </div>


                            {{-- Submit --}}
                            <div class="col-md-12">

                                <div class="actions">

                                    <input
                                        type="submit"
                                        value="Send message"
                                        name="submit"
                                        id="submitButton"
                                        class="btn btn-lg btn-blog-bg"
                                        title="Submit Your Message!"
                                    >

                                </div>

                            </div>

                        </div>

                    </form>

                </div>
                {{-- END COMMENT FORM --}}

            </div>
            {{-- END LEFT CONTENT --}}


            {{-- =================================================
                 RIGHT SIDEBAR
            ================================================== --}}
            <div class="col-md-4 col-sm-12 col-xs-12">

                {{-- Search --}}
                <div class="search wow fadeInRight">

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Enter Keyword Here & Search..."
                    >

                </div>


                {{-- Categories --}}
                <div class="categories wow fadeInRight">

                    <h4 class="blog_sidebar_title">
                        Categories
                    </h4>

                    <ul>

                        <li>
                            <a href="#">
                                <i class="fa fa-caret-right"></i>
                                Apartment
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-caret-right"></i>
                                Condo
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-caret-right"></i>
                                Single Family Home
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-caret-right"></i>
                                Studio
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-caret-right"></i>
                                Villa
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-caret-right"></i>
                                Marketing
                            </a>
                        </li>

                    </ul>

                </div>


                {{-- Tag Cloud --}}
                <div class="tag">

                    <h4 class="blog_sidebar_title">
                        Tag cloud
                    </h4>

                    <a href="#">Apartment</a>
                    <a href="#">Condo</a>
                    <a href="#">Studio</a>
                    <a href="#">All project</a>
                    <a href="#">Villa</a>
                    <a href="#">Marketing</a>

                </div>

            </div>
            {{-- END SIDEBAR --}}

        </div>

    </div>

</section>
{{-- END BLOG POST --}}

@endsection