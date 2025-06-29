@extends('layouts.app-public')
@section('title', 'Shop')
@section('content')
<div class="site-wrapper-reveal">
    <!-- Product Area Start -->
    <div class="product-wrapper section-space--ptb_90 border-bottom pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 order-md-1 order-md-2 small-mt__40">
                    <!-- Category Filter -->
                    <div class="shop-widget widget-shop-publishers mt-3">
                        <div class="product-filter">
                            <h6 class="mb-20">Flower Type</h6>
                            <select class="_filter form-select form-select-sm" name="type" onchange="getData()">
                                <option value="" selected>All Types</option>
                                <option value="roses">Roses</option>
                                <option value="lilies">Lilies</option>
                                <option value="sunflowers">Sunflowers</option>
                                <option value="mixed">Mixed Bouquets</option>
                            </select>
                        </div>
                    </div>

                    <!-- Color Filter -->
                    <div class="shop-widget widget-color">
                        <div class="product-filter">
                            <h6 class="mb-20">Color</h6>
                            <ul class="widget-nav-list" id="color-filter">
                                <li><a href="#" class="swatch-filter" data-color="red"><span class="swatch-color red"></span></a></li>
                                <li><a href="#" class="swatch-filter" data-color="orange"><span class="swatch-color orange"></span></a></li>
                                <li><a href="#" class="swatch-filter" data-color="yellow"><span class="swatch-color yellow"></span></a></li>
                                <li><a href="#" class="swatch-filter" data-color="blue"><span class="swatch-color blue"></span></a></li>
                                <li><a href="#" class="swatch-filter" data-color="purple"><span class="swatch-color purple"></span></a></li>
                                <li><a href="#" class="swatch-filter" data-color="pink"><span class="swatch-color pink"></span></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="shop-widget">
                        <div class="product-filter widget-price">
                            <h6 class="mb-20">Price Range</h6>
                            <ul class="widget-nav-list" id="price-range-filter">
                                <li><a href="#" class="price-filter" data-range="under_100">Under IDR 100K</a></li>
                                <li><a href="#" class="price-filter" data-range="100_250">IDR 100K–250K</a></li>
                                <li><a href="#" class="price-filter" data-range="250_500">IDR 250K–500K</a></li>
                                <li><a href="#" class="price-filter" data-range="above_500">Above IDR 500K</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="shop-widget">
                        <div class="product-filter">
                            <h6 class="mb-20">Category</h6>
                            <div class="blog-tagcloud" id="category-filter">
                                <a href="#" class="category-filter" data-category="Romantic">Romantic</a>
                                <a href="#" class="category-filter" data-category="Greeting">Greeting</a>
                                <a href="#" class="category-filter" data-category="Anniversary">Anniversary</a>
                                <a href="#" class="category-filter" data-category="Graduation">Graduation</a>
                                <a href="#" class="category-filter" data-category="Valentine's">Valentine's</a>
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
                                    <option value="name_asc">Sort by A-Z</option>
                                    <option value="name_desc">Sort by Z-A</option>
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
                                        onkeypress="getDataOnEnter(event)" placeholder="Search by flower name or type...">
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
