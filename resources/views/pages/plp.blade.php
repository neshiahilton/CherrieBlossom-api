@extends('layouts.app-public')
@section('title', 'Shop')
@section('content')
<div class="site-wrapper-reveal">
    <!-- Product Area Start -->
    <div class="product-wrapper section-space--ptb_90 border-bottom pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 order-md-1 order-md-2 small-mt__40">
                    <!-- Publishers Filter -->
                    <div class="shop-widget widget-shop-publishers mt-3">
                        <div class="product-filter">
                            <h6 class="mb-20">Publishers</h6>
                            <select class="_filter form-select form-select-sm" name="_publisher" onchange="getData()">
                                <option value="" selected>All</option>
                                <option value="putnam">Putnam</option>
                                <option value="harriman house">Harriman House</option>
                                <option value="balai pustaka">Balai Pustaka</option>
                                <option value="lentera dipantara">Lentera Dipantara</option>
                                <option value="pan books">Pan Books</option>
                                <option value="firefly books">Firefly Books</option>
                                <option value="gramedia">Gramedia</option>
                                <option value="scholastic">Scholastic</option>
                                <option value="harper">Harper</option>
                                <option value="dk children">DK Children</option>
                                <option value="bentang pustaka">Bentang Pustaka</option>
                                <option value="gagas media">Gagas Media</option>
                                <option value="grasindo">Grasindo</option>
                                <option value="marjin kiri">Marjin Kiri</option>
                            </select>
                        </div>
                    </div>

                    <!-- Color Filter -->
                    <div class="shop-widget widget-color">
                        <div class="product-filter">
                            <h6 class="mb-20">Color</h6>
                            <ul class="widget-nav-list">
                                <li><a href="#"><span class="swatch-color black"></span></a></li>
                                <li><a href="#"><span class="swatch-color green"></span></a></li>
                                <li><a href="#"><span class="swatch-color grey"></span></a></li>
                                <li><a href="#"><span class="swatch-color red"></span></a></li>
                                <li><a href="#"><span class="swatch-color white"></span></a></li>
                                <li><a href="#"><span class="swatch-color yellow"></span></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="shop-widget">
                        <div class="product-filter widget-price">
                            <h6 class="mb-20">Price</h6>
                            <ul class="widget-nav-list">
                                <li><a href="#">Under IDR 100K</a></li>
                                <li><a href="#">IDR 100-500K</a></li>
                                <li><a href="#">IDR 501-1000K</a></li>
                                <li><a href="#">Above IDR 1000K</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tags Filter -->
                    <div class="shop-widget">
                        <div class="product-filter">
                            <h6 class="mb-20">Tags</h6>
                            <div class="blog-tagcloud">
                                 <a href="#">Drone</a>
                                    <a href="#">Drone</a>
                                    <a href="#">FPV</a>
                                    <a href="#">Aerial Photography</a>
                                    <a href="#">Cinematic</a>
                                    <a href="#">4K Video</a>
                                    <a href="#">8K Video</a>
                                    <a href="#">DJI</a>
                                    <a href="#">Flight Time</a>
                                    <a href="#">Battery Life</a>
                                    <a href="#">GPS</a>
                                    <a href="#">Autonomous</a>
                                    <a href="#">Controller</a>
                                    <a href="#">FPV Goggles</a>
                                    <a href="#">Mapping</a>
                                    <a href="#">Survey</a>
                                    <a href="#">Payload</a>
                                    <a href="#">Brushless Motor</a>
                                    <a href="#">Propeller</a>
                                    <a href="#">Drone Show</a>
                                    <a href="#">Agriculture Drone</a>
                                    <a href="#">Thermal Camera</a>
                                    <a href="#">Drone Racing</a>
                                    <a href="#">No-Fly Zone</a>
                                    <a href="#">Drone Law</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product List Column -->
                <div class="col-lg-9 col-md-9 order-md-2 order-1">
                    <div class="row mb-5">
                        <div class="col-lg-6 col-md-8">
                            <div class="shop-toolbar__items shop-toolbar__item--left">
                                <div class="shop-toolbar__item shop-toolbar__item--result">
                                    <p class="result-count">
                                        Showing <span id="products_count_start"></span>–<span id="products_count_end"></span>
                                        of <span id="products_count_total"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="shop-toolbar__item">
                                <select class="_filter form-select form-select-sm" name="_sort_by" onchange="getData()">
                                    <option value="title_asc">Sort by A-Z</option>
                                    <option value="title_desc">Sort by Z-A</option>
                                    <option value="latest_publication">Sort by latest</option>
                                    <option value="latest_added">Sort by time added</option>
                                    <option value="price_asc">Sort by price: low to high</option>
                                    <option value="price_desc">Sort by price: high to low</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4">
                            <div class="header-right-search">
                                <div class="header-search-box">
                                    <input class="_filter search-field" name="_search" type="text"
                                        onkeypress="getDataOnEnter(event)" placeholder="Search by title or author...">
                                    <button class="search-icon"><i class="icon-magnifier"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product List Output -->
                    <div class="row" id="product-list"></div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-12">
                            <ul class="page-pagination text-center mt-40" id="product-list-pagination"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Area End -->
    </div>
</div>
@endsection

@section('addition_css')
@endsection

@section('addition_script')
    <script src="{{ asset('pages/js/plp.js') }}"></script>
@endsection
