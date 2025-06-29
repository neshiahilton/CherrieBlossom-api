<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
<<<<<<< HEAD
use App\Http\Controllers\API\BouquetController;
=======
use App\Http\Controllers\API\BookController;
>>>>>>> 87acb19a53afffe166704ae86ca8b45675712237

Route::prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('/whoami', function (Request $request) {
        return $request->user();
    })->middleware('auth:api');
});

<<<<<<< HEAD
Route::get('/bouquet/{id}', [BouquetController::class, 'show']);

Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::resource('bouquet', BouquetController::class)
    ->only(['index', 'show']);

Route::resource('bouquet', BouquetController::class)
=======

Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:api');







Route::resource('book', BookController::class)
    ->only(['index', 'show']);

Route::resource('book', BookController::class)
>>>>>>> 87acb19a53afffe166704ae86ca8b45675712237
    ->except(['index', 'show'])
    ->middleware(['auth:api']);
