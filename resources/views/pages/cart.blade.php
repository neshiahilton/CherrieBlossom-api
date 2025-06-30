{{-- resources/views/cart.blade.php --}}
@extends('layouts.app-public')
@section('title', 'Shopping Cart')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content text-center about-us-content_6">
            <h2>Shopping Cart</h2>
            <p class="mt-5">Ready to bloom? 
            <span class="text-color-secondary">Let’s wrap these beauties and send them your way.</span>
            </p>
        </div>
    </div>
</div>

<!-- Cart Page Layout -->
<div class="shop-page-area section-space--ptb_90">
    <div class="container">
        <div class="row">
            <!-- Cart Items Column -->
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div id="cart-items-container" class="cart-items-list">
                    <!-- Item list akan dimuat via JS -->
                </div>

                <!-- Empty Message -->
                <div id="cart-empty" class="text-center mt-5 d-none">
                    <p class="text-muted">Keranjang kamu kosong 🌸</p>
                    <a href="{{ route('plp') }}" class="btn btn-primary mt-3">Lihat Semua Produk</a>
                </div>
            </div>

            <!-- Cart Summary Column (Tanpa Kotak) -->
            <div class="col-lg-4 col-md-5 order-md-2 order-2">
                <h4 class="mb-4">Order Summary</h4>

                <div class="mb-3">
                    <label for="shipping-address" class="form-label">Address</label>
                    <textarea class="form-control" id="shipping-address" rows="3" placeholder="Masukkan alamat lengkap kamu"></textarea>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span id="cart-subtotal">Rp0</span>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span>Ongkir</span>
                    <span id="cart-shipping">Rp0</span>
                </div>

                <hr>

                <div class="mb-3 d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span id="cart-total">Rp0</span>
                </div>

                <button class="btn btn-success w-100" onclick="checkoutCart()">Checkout Sekarang</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addition_css')
<!-- Optional: custom CSS -->
@endsection

@section('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
@endsection
