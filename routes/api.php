<?php

use App\Http\Controllers\Post\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})
     ->middleware('auth:sanctum');

Route::apiResource('/posts', PostController::class)
     ->only('index', 'store');
