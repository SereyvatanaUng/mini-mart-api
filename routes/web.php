<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DocsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api-docs', [DocsController::class, 'index']);
Route::get('/api-docs.json', [DocsController::class, 'json']);