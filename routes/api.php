<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
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
//user route
Route::prefix('/allizo')->group(function(){
Route::apiResource('/users',UserController::class);
//location route
Route::get('/locations',[LocationController::class,'index']);//admin
Route::get('/locations/{id}',[LocationController::class,'show']);//user
Route::post('/locations',[LocationController::class,'store']);//both
Route::put('/locations/{id}',[LocationController::class,'update']);//user can edit their own locations
Route::delete('/locations/{id}',[LocationController::class,'destroy']);//both

//role route
Route::get('/roles', [RoleController::class, 'index']); // View all roles
Route::get('/roles/{id}', [RoleController::class, 'show']); // View one role
Route::post('/roles', [RoleController::class, 'store']); // Create role (optional)
Route::put('/roles/{id}', [RoleController::class, 'update']); // Update role (optional)
Route::delete('/roles/{id}', [RoleController::class, 'destroy']); // Delete role

// User-Role Management
Route::post('/users/{userId}/roles/{roleId}', [RoleController::class, 'assignRole']); // Assign role to user
Route::delete('/users/{userId}/roles/{roleId}', [RoleController::class, 'removeRole']); // Remove role from user

//Review
Route::get('/reviews',[ReviewController::class,'index']);
Route::get('/reviews/{id}',[ReviewController::class,'show']);
Route::post('/reviews',[ReviewController::class,'store']);
Route::put('/reviews/{id}',[ReviewController::class,'update']);
Route::delete('/reviews/{id}',[ReviewController::class,'destroy']);

//view reviews base on service
Route::get('/services/{serviceId}/reviews',[ReviewController::class,'reviewBaseOnId']);
//review to service
Route::post('/services/{seviceId}/reviews',[ReviewController::class,'review']);

//categories route
Route::get('/categories', [CategoryController::class, 'index']); 
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']); 
Route::put('/categories/{id}', [CategoryController::class, 'update']); 
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

//
//service route
Route::get('/services', [ServiceController::class, 'index']); 
Route::get('/services/{id}', [ServiceController::class, 'show']);
Route::post('/services', [ServiceController::class, 'store']); 
Route::put('/services/{id}', [ServiceController::class, 'update']); 
Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

//Route cart
Route::get('/carts', [CartController::class, 'index']); 
Route::get('/carts/{id}', [CartController::class, 'show']);
Route::post('/carts', [CartController::class, 'store']); 
Route::put('/carts/{id}', [CartController::class, 'update']); 
Route::delete('/carts/{id}', [CartController::class, 'destroy']);
//cart managements
Route::post('/cart/{cartId}/service', [CartController::class, 'addToCart']);
Route::put('/cart/update', [CartController::class, 'updateQuantity']);
Route::delete('/cart/remove', [CartController::class, 'removeService']);
});



