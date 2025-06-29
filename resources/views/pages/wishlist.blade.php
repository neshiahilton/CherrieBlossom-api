@extends('layouts.app-public') {{-- Ganti sesuai layout kamu --}}

@section('title', 'Wishlist')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content text-center about-us-content_6">
            <h2>Wishlist</h2>
            <p class="mt-5">Let your feelings bloom.
            <span class="text-color-secondary">Explore our collection today.</span>
            </p>
        </div>
    </div>
</div>

<!-- Wishlist Page Layout -->
<div class="shop-page-area section-space--ptb_90">
    <div class="container">
        <div class="row">
            <!-- Sidebar Column (optional, kosongkan) -->
            <div class="col-lg-3 col-md-3 order-md-1 order-2">
                {{-- Kosong atau bisa tambahkan promo/banner dsb --}}
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
                    </div>

                    <div class="col-lg-6 col-md-4">
                        <div class="header-right-search">
                            <div class="header-search-box">
                                <input class="_filter search-field" name="_search" type="text"
                                    onkeypress="searchWishlistOnEnter(event)"
                                    placeholder="Search wishlist...">
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

                <!-- Empty Message -->
                <div id="wishlist-empty" class="text-center mt-5 d-none">
                    <p class="text-muted">Wishlist kamu kosong 🌸</p>
                    <a href="{{ route('plp') }}" class="btn btn-primary mt-3">Lihat Semua Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addition_css')
@endsection

@section('scripts')
<script src="{{ asset('js/wishlist.js') }}"></script>
@endsection
