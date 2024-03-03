<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/index', [UserController::class, 'index']) ;
Route::post('/store', [UserController::class, 'store']) ;
Route::put('/update/{id}', [UserController::class, 'update']);//davidisillo mil fallas

//Welcome message
Route::get('/test', function () {
    return response()->json([
        'message' => 'Welcome to the API'
    ]);
});
