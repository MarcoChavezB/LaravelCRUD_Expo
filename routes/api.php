<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/authenticate', function (Request $request) {
    return response()->json(['error' => 'Token inválido'], 401);

})->name('error');

Route::post('/store', [UserController::class, 'store']) ;
Route::post('/login', [UserController::class, 'login']) ;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/index', [UserController::class, 'index']) ;
    Route::put('/update/{id}', [UserController::class, 'update']);//davidisillo mil fallas
    Route::delete('/delete/{id}',[UserController::class,'destroy']);

});
//Welcome message
Route::get('/test', function () {
    return response()->json([
        'message' => 'Welcome to the API'
    ]);
});
