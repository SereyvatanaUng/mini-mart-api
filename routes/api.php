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
    // Public routes (no authentication required)
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']); // NEW: User signup
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    
    // Public product browsing (NO AUTH REQUIRED)
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/products/barcode/scan', [ProductController::class, 'getByBarcode']);
    
    // Public store layout browsing (NO AUTH REQUIRED)
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/sections', [SectionController::class, 'index']);
    Route::get('/shelves', [ShelfController::class, 'index']);
    
    // Public helper routes (NO AUTH REQUIRED)
    Route::get('/data/categories', [ProductController::class, 'getCategories']);
    Route::get('/data/sections', [ProductController::class, 'getSections']);
    Route::get('/data/sections/{sectionId}/shelves', [ProductController::class, 'getShelvesBySection']);

    // Protected routes (authentication required)
    Route::middleware('auth:sanctum')->group(function () {
        // Auth routes
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);
        Route::get('/profile', [AuthController::class, 'profile']);

        // Dashboard (Authenticated users only)
        Route::get('/dashboard/overview', [DashboardController::class, 'overview']);
        Route::get('/dashboard/sales-chart', [DashboardController::class, 'salesChart']);
        Route::get('/dashboard/top-products', [DashboardController::class, 'topProducts']);

        // Cashier management (Shop owner only)
        Route::apiResource('cashiers', CashierController::class);

        // Product management (Shop owner only for CUD, Read is public)
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);
        Route::get('/products/alerts/low-stock', [ProductController::class, 'getLowStockProducts']);

        // Category management (Shop owner only for CUD, Read is public)
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

        // Section management (Shop owner only for CUD, Read is public)
        Route::post('/sections', [SectionController::class, 'store']);
        Route::put('/sections/{id}', [SectionController::class, 'update']);
        Route::delete('/sections/{id}', [SectionController::class, 'destroy']);
        Route::post('/sections/{sectionId}/shelves', [SectionController::class, 'createShelf']);

        // Shelf management (Shop owner only for CUD, Read is public)
        Route::post('/shelves', [ShelfController::class, 'store']);
        Route::put('/shelves/{id}', [ShelfController::class, 'update']);
        Route::delete('/shelves/{id}', [ShelfController::class, 'destroy']);

        // Sales (Authenticated users for viewing, Cashiers+ for creating)
        Route::apiResource('sales', SaleController::class)->only(['index', 'store', 'show']);
        Route::get('/sales/summary/daily', [SaleController::class, 'dailySummary']);
    });
});