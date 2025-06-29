<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
Route::get('/', function () {
    return view('pages.home'); // atau 'home' tergantung file yang kamu punya
})->name('home');

=======
>>>>>>> 87acb19a53afffe166704ae86ca8b45675712237

Route::get('/cart', function () {
    return view('cart'); // Pastikan view 'cart.blade.php' ada di folder resources/views
})->name('cart');


<<<<<<< HEAD
Route::get('/bouquet', function () {
=======
Route::get('/', function () {
    return view('pages.home');
})->name('home');


Route::get('/book', function () {
>>>>>>> 87acb19a53afffe166704ae86ca8b45675712237
    return view('pages.plp');
})->name('plp');


<<<<<<< HEAD
Route::get('/bouquet/{id}', function () {
=======
Route::get('/book/{id}', function () {
>>>>>>> 87acb19a53afffe166704ae86ca8b45675712237
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





