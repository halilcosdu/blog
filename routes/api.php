<?php

use App\Http\Controllers\Api\UserSearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User search for mentions - no auth required for better UX
Route::get('/users/search', [UserSearchController::class, 'search'])
    ->name('api.users.search');
