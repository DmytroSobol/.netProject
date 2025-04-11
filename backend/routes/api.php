<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    OrderController,
    CartController,
    WishlistController,
    CategoryController,
    GoodController
};

// Publiczne zapytania
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Towary i kategorie
Route::get('/goods', [GoodController::class, 'index']);
Route::get('/goods/{good}', [GoodController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'getGoodsByCategory']);

// Chronione zapytania
Route::middleware('auth:sanctum')->group(function () {

    // Autoryzacja
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::put('/user', [AuthController::class, 'updateUser']);

    // Zamówienia
    Route::prefix('user/orders')->middleware('CheckUserAccess')->group(function () {
        Route::get('/', [OrderController::class, 'indexByUser']);
        Route::get('{order}', [OrderController::class, 'showByUser']);
        Route::post('/', [OrderController::class, 'storeByUser']);
        Route::put('{order}', [OrderController::class, 'updateByUser']);
        Route::delete('{order}', [OrderController::class, 'destroyByUser']);

        Route::post('{order}/pay', [OrderController::class, 'pay']);
        Route::post('{order}/cancel', [OrderController::class, 'cancel']);
        Route::post('{order}/confirm', [OrderController::class, 'confirm']);
        Route::post('{order}/return', [OrderController::class, 'return']);
    });

    // Koszyk
    Route::prefix('user/cart')->middleware('CheckUserAccess')->group(function () {
        Route::get('/', [CartController::class, 'show']);
        Route::delete('/', [CartController::class, 'destroy']);
        Route::post('/add', [CartController::class, 'addItem']);
        Route::post('/remove', [CartController::class, 'removeItem']);
    });

    // Wishlist
    Route::prefix('user/wishlist')->middleware('CheckUserAccess')->group(function () {
        Route::get('/', [WishlistController::class, 'show']);
        Route::delete('/', [WishlistController::class, 'destroy']);
        Route::post('/add', [WishlistController::class, 'addItem']);
        Route::post('/remove', [WishlistController::class, 'removeItem']);
    });
});

// Fallback
Route::fallback(function () {
    return response()->json([
        'message' => 'Resource not found'
    ], 404);
});
