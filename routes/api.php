<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

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


// API Testing
// Using API with Get Method
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);
Route::get('contact/list', [RouteController::class, 'contactList']);

// Using API with Post Method
Route::post('create/category', [RouteController::class, 'createCategory']);
Route::post('create/contact', [RouteController::class, 'createContact']);
Route::post('delete/category', [RouteController::class, 'deleteCategory']);
Route::post('category/detail', [RouteController::class, 'categoryDetail']);
Route::post('update/category', [RouteController::class, 'updateCategory']);
