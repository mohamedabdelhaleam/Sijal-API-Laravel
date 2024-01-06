<?php

use App\Http\Controllers\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


################## Start Category Routes ####################
Route::group(['prefix' => 'category'], function () {
    Route::get('', [CategoryController::class, 'getAllCategory']);
    Route::get('{categoryId}', [CategoryController::class, 'getSingleCategory']);
    Route::post('create', [CategoryController::class, 'createCategory']);
    Route::patch('update/{categoryId}', [CategoryController::class, 'updateCategory']);
    Route::delete('delete/{categoryId}', [CategoryController::class, 'deleteCategory']);
});
################## End Category Routes ######################
