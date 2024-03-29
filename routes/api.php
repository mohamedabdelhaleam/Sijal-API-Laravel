<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


################## Start Auth Routes ####################
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
################## End Auth Routes ######################

################## Start User Routes ####################
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'user'
], function () {
    Route::get('', [UserController::class, 'getAllUsers']);
    Route::patch('update', [UserController::class, 'update']);
    Route::delete('delete', [UserController::class, 'delete']);
});
################## End User Routes ######################

################## Start Category Routes ####################
Route::group(['prefix' => 'category'], function () {
    Route::get('', [CategoryController::class, 'getAllCategory']);
    Route::get('{categoryId}', [CategoryController::class, 'getSingleCategory']);
    Route::post('create', [CategoryController::class, 'createCategory']);
    Route::patch('update/{categoryId}', [CategoryController::class, 'updateCategory']);
    Route::delete('delete/{categoryId}', [CategoryController::class, 'deleteCategory']);
});
################## End Category Routes ######################

################## Start Product Routes ####################
Route::group(['prefix' => 'product'], function () {
    Route::get('', [ProductController::class, 'getAllProduct']);
    Route::get('{productId}', [ProductController::class, 'getSingleProduct']);
    Route::post('create', [ProductController::class, 'createProduct']);
    Route::patch('update/{productId}', [ProductController::class, 'updateProduct']);
    Route::delete('delete/{productId}', [ProductController::class, 'deleteProduct']);
});
################## End Product Routes ######################

################## Start Cart Routes ####################
Route::group([
    'prefix' => 'cart'
], function () {
    Route::get('', [CartController::class, 'getCart']);
    Route::post('addProduct', [CartController::class, 'addProductToCart']);
    Route::delete('removeProduct/{productId}', [CartController::class, 'removeProductInCart']);
    Route::delete('removeAllProduct', [CartController::class, 'removeAllProductInCart']);
    Route::patch('updateProductQuantity/{productId}', [CartController::class, 'updateProductQuantityInCart']);
});
################## End Cart Routes ######################

################## Start Cart Routes ####################
Route::group([
    'prefix' => 'orders'
], function () {
    Route::get('', [OrderController::class, 'getOrder']);
    Route::get('products', [OrderController::class, 'getOrdersWithProducts']);
    Route::get('createOrder', [OrderController::class, 'createOrder']);
    Route::get('changeStatus/{orderId}', [OrderController::class, 'changeStatus']);
    Route::get('deleteOrder', [OrderController::class, 'deleteOrder']);
});
################## End Cart Routes ######################
