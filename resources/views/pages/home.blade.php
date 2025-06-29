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
                            <h2>Where&nbsp;&nbsp;Every&nbsp;&nbsp;Petal<br>Whispers&nbsp;&nbsp;Love</h2>
                            <p>
                                <small>
                                    Finding the right flowers should be as beautiful as the flowers themselves.
                                    At Cherrie Blossom, we make it simple. We offer a fresh, curated selection
                                    of stunning blooms for every moment that matters. Whether you're celebrating
                                    love, friendship, or a special milestone, our modern arrangements are designed
                                    to deliver joy and beauty, straight from our hands to yours. &#127800;
                                </small>
                            </p>
                            <p class="mt-5">Let your feelings bloom.
                                <span class="text-color-secondary">Explore our collection today.</span>
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
                            <img src="{{asset('assets/images/banners/flower.png')}}" alt="" width="960px" height="580">
                            <div class="video-icon">
                                <a href="https://www.youtube.com/watch?v=QpeopRSgCUc" class="popup-youtube"><i
                                        class="linear-ic-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Video Area End -->

        <!-- Our Categories Area Start -->
        <div class="our-brand-area section-space--pb_90">
            <div class="container">
                <div class="brand-slider-active">
                    @php
                        $partner_count = 6;
                    @endphp
                    @for($i = 1; $i <= $partner_count; $i++)
                        <div class="col-lg-12">
                            <div class="single-brand-item">
                                <a href="#"><img src="{{ asset('assets/images/category/' . $i . '.png') }}"
                                        class="img-fluid" alt="Partner Images"></a>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <!-- Our Categories Area End -->

        <!-- Our Member Area Start -->
        <div class="our-member-area section-space--pb_120">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="member--box">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4">
                                    <div class="section-title small-mb__40 tablet-mb__40">
                                        <h4 class="section-title">Become a Bloom Insider!</h4>
                                        <p>Get exclusive offers, fresh arrival news, and enjoy 15% off your first order when you join.</p>
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
@php http_response_code(200); @endphp
