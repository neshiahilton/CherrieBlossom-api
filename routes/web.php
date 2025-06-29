<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home'); // atau 'home' tergantung file yang kamu punya
})->name('home');


Route::get('/cart', function () {
    return view('cart'); // Pastikan view 'cart.blade.php' ada di folder resources/views
})->name('cart');


Route::get('/bouquet', function () {
    return view('pages.plp');
})->name('plp');


Route::get('/bouquet/{id}', function () {
    return view('pages.pdp');
})->name('pdp');


// Profile page
Route::get('/profile', function () {
    return view('profile'); // Pastikan ada file resources/views/profile.blade.php
})->name('profile');


// Logout dummy (sementara)
Route::get('/logout', function () {
    // Logika logout bisa kamu isi nanti, ini dummy redirect ke home
    return redirect('/');
})->name('logout');





