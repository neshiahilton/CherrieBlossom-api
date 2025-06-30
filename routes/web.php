<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\API\BouquetController;
use App\Http\Controllers\API\ProfileController;
use App\Models\Bouquet;


Route::get('/', function () {
    return view('pages.home'); // atau 'home' tergantung file yang kamu punya
})->name('home');

// WISHLIST
Route::get('/wishlist', function () {
    return view('pages.wishlist');
})->name('wishlist');

// CART
Route::get('/cart', function () {
    return view('pages.cart'); // Pastikan view 'cart.blade.php' ada di folder resources/views
})->name('cart');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/bouquet', function () {
    return view('pages.plp');
})->name('plp');


Route::get('/bouquet/{id}', function ($id) {
    $bouquet = Bouquet::findOrFail($id);
    return view('pages.pdp', compact('bouquet'));
})->name('pdp');

// Logout dummy (sementara)
Route::get('/logout', function () {
    // Logika logout bisa kamu isi nanti, ini dummy redirect ke home
    return redirect('/');
})->name('logout');





