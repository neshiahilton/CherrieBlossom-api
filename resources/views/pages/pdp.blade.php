@extends('layouts.app-public')
@section('title', 'Product Detail')
@section('content')
<div class="site-wrapper-reveal">
    <div class="single-product-wrap section-space--pt_90 border-bottom pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images-2 slider-lg-image-2">
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="#" class="poppu-img product-img-main-href">
                                        <img src="#" class="img-fluid product-img-main-src" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-details-thumbs-2 slider-thumbs-2">
                            <!-- thumbnails akan diisi oleh JS -->
                        </div>
                    </div>
                    <!-- // Product Details Left -->
                </div>

                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    <div class="product-details-content">
                        <h5 class="font-weight--reguler mb-10" id="product-name"></h5>
                        <div class="quickview-ratting-review mb-10">
                            <div class="quickview-ratting-wrap">
                                <div class="quickview-ratting" id="product-review-stars"></div>
                                <a href="#" id="product-review-body-count"></a>
                            </div>
                        </div>

                        <h3 class="price" id="product-price"></h3>
                        <div class="stock mt-10" id="product-status-stock"></div>
                        <div class="quickview-paragraph mt-10">
                            <p id="product-description"></p>
                        </div>

                        <div class="quickview-action-wrap mt-30">
                            <div class="quickview-cart-box">
                                <div class="quickview-quality product-add-to-cart">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                    </div>
                                </div>
                                <div class="text-color-primary product-add-to-cart-is-disabled" style="display:none;font-size:10px">
                                    You may can't buy this item now, but keep it on your wishlist so we can remind you when in stock
                                </div>
                                <div class="quickview-button">
                                    <div class="quickview-cart button product-add-to-cart">
                                        <button type="button" class="btn--lg btn--black font-weight--reguler text-white">
                                            Add to cart
                                        </button>
                                    </div>
                                        <div class="quickview-wishlist button">
                                            <button class="btn btn-danger add-to-wishlist" data-id="{{ $bouquet->id }}">
                                                <i class="fa fa-heart"></i> Wishlist
                                            </button>
                                </div>
                            </div>
                        </div>

                        <div class="product_meta mt-30">
                            <div class="posted_in item_meta">
                                <span class="label">Category: </span>
                                <span id="product-category" class="text-color-primary"></span>
                            </div>
                            <div class="posted_in item_meta">
                                <span class="label">Flower Type: </span>
                                <span id="product-flower-type"></span>
                            </div>
                        </div>

                        <div class="product_socials section-space--mt_60">
                            <span class="label">Share this items :</span>
                            <ul class="helendo-social-share socials-inline">
                                <li><a class="share-facebook helendo-facebook" href="#" target="_blank"><i class="social_facebook"></i></a></li>
                                <li><a class="share-twitter helendo-twitter" href="#" target="_blank"><i class="social_twitter"></i></a></li>
                                <li><a class="share-instagram helendo-instagram" href="#" target="_blank"><i class="social_instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection

@section('addition_script')
<script src="{{ asset('pages/js/pdp.js') }}"></script>
@endsection
