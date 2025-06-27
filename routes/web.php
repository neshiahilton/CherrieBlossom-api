<?php

use Illuminate\Support\Facades\Route;


Route::get('/cart', function () {
    return view('cart'); // Pastikan view 'cart.blade.php' ada di folder resources/views
})->name('cart');


Route::get('/', function () {
    return view('pages.home');
})->name('home');


Route::get('/book', function () {
    return view('pages.plp');
})->name('plp');


Route::get('/book/{id}', function () {
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





