@extends('layouts.app-public')
@section('title', 'Home')
@section('content')
    <div class="site-wrapper-reveal">
        <div class="hero-box-area">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <!-- Hero Slider Area Start -->
                        <div class="hero-area" id="product-preview">
                        </div>
                        <!-- Hero Slider Area End -->
                    </div>
                </div>
            </div>
        </div>

        <div class="about-us-area section-space--ptb_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-us-content_6 text-center">
                            <h2>Scooping&nbsp;&nbsp;Up&nbsp;&nbsp;Great<br>Reads</h2>
                            <p>
                                <small>
                                    Tired of searching for your next great read? Let us do the scooping.
                                    At Expert Spoon, we serve up a delicious menu of books, expertly chosen for every taste.
                                    From spicy thrillers and sweet romances to hearty classics and fresh non-fiction, our 
                                    shelves are stocked with stories that will satisfy your literary cravings. Our passionate 
                                    team is here to help you find the perfect ingredient for your imagination. 
                                    Stop by and see what we're serving today! &#10084;
                                </small>
                            </p>
                            <p class="mt-5">Ready to dig in?
                                <span class="text-color-secondary">Your next favorite story is waiting.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner Video Area Start -->
        <div class="banner-video-area overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-video-box">
                            <img src="{{asset('assets/images/library.jpg')}}" alt="" width="962px" height="578">
                            <div class="video-icon">
                                <a href="https://youtu.be/z8UUYS4bIfw" class="popup-youtube"><i
                                        class="linear-ic-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Video Area End -->

        <!-- Our Brand Area Start -->
        <div class="our-brand-area section-space--pb_90">
            <div class="container">
                <div class="brand-slider-active">
                    @php
                        $partner_count = 6;
                    @endphp
                    @for($i = 1; $i <= $partner_count; $i++)
                        <div class="col-lg-12">
                            <div class="single-brand-item">
                                <a href="#"><img src="{{ asset('assets/images/brand/partnerb' . $i . '.jpg') }}"
                                        class="img-fluid" alt="Partner Images"></a>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <!-- Our Brand Area End -->

        <!-- Our Member Area Start -->
        <div class="our-member-area section-space--pb_120">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="member--box">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4">
                                    <div class="section-title small-mb__40 tablet-mb__40">
                                        <h4 class="section-title">Join the community!</h4>
                                        <p>Become one of the member and get discount 50% off</p>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-8">
                                    <div class="member-wrap">
                                        <form action="#" class="member--two">
                                            <input class="input-box" type="text" placeholder="Your email address">
                                            <button class="submit-btn"><i class="icon-arrow-right"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Member Area End -->

    </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('pages/js/home.js')}}"></script>
@endsection