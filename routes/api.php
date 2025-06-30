<?php

use Illuminate\Http\Request;
use App\Models\Bouquet;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BouquetController;
use App\Http\Controllers\API\WishlistController;

Route::prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('/whoami', function (Request $request) {
        return $request->user();
    })->middleware('auth:api');
});

Route::get('/bouquet/{id}', [BouquetController::class, 'show']);

Route::middleware('auth:api')->post('/auth/logout', [AuthController::class, 'logout']);

Route::resource('bouquet', BouquetController::class)
    ->only(['index', 'show']);

Route::resource('bouquet', BouquetController::class)
    ->except(['index', 'show'])
    ->middleware(['auth:api']);


// BUAT ROUTE GET YANG BEBAS LOGIN
Route::get('/wishlist', [WishlistController::class, 'index']);

Route::middleware('auth:api')->group(function () {
    Route::post('/wishlist', [WishlistController::class, 'store']);     // Add
    Route::delete('/wishlist/{bouquet_id}', [WishlistController::class, 'destroy']); // Remove
    Route::get('/wishlist/user', [WishlistController::class, 'userWishlist']); // Get user wishlist
});