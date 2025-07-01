<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CashierController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\API\ShelfController;
use App\Http\Controllers\API\DashboardController;

Route::prefix('v1')->group(function () {
    // Public routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // Auth routes
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);
        Route::get('/profile', [AuthController::class, 'profile']);

        // Dashboard
        Route::get('/dashboard/overview', [DashboardController::class, 'overview']);
        Route::get('/dashboard/sales-chart', [DashboardController::class, 'salesChart']);
        Route::get('/dashboard/top-products', [DashboardController::class, 'topProducts']);

        // Cashier management (Shop owner only)
        Route::apiResource('cashiers', CashierController::class);

        // Product management
        Route::apiResource('products', ProductController::class);
        Route::get('/products/barcode/scan', [ProductController::class, 'getByBarcode']);
        Route::get('/products/alerts/low-stock', [ProductController::class, 'getLowStockProducts']);

        // Category management
        Route::apiResource('categories', CategoryController::class);

        // Section management
        Route::apiResource('sections', SectionController::class);
        Route::post('/sections/{sectionId}/shelves', [SectionController::class, 'createShelf']);

        // Shelf management
        Route::apiResource('shelves', ShelfController::class);

        // Sales
        Route::apiResource('sales', SaleController::class)->only(['index', 'store', 'show']);
        Route::get('/sales/summary/daily', [SaleController::class, 'dailySummary']);

        // Helper routes
        Route::get('/data/categories', [ProductController::class, 'getCategories']);
        Route::get('/data/sections', [ProductController::class, 'getSections']);
        Route::get('/data/sections/{sectionId}/shelves', [ProductController::class, 'getShelvesBySection']);
    });
});