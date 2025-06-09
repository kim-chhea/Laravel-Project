<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/user')->group(function(){
Route::post('/login',[AuthController::class , 'login']);
Route::post('/register',[AuthController::class , 'register']);
Route::delete('/logout',[AuthController::class , 'logout']);
});
