<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('my/profile', [UserController::class, 'myProfile']);
    Route::post('update/user', [UserController::class, 'updateUser']);

    Route::post('add/category', [CategoryController::class, 'addCategory']);
    Route::post('update/category/{categoryId}', [CategoryController::class, 'updateCategory']);
    Route::get('get/category', [CategoryController::class, 'getCategory']);

    Route::post('add/product', [ProductController::class, 'addProduct']);
    Route::post('update/product/{productId}', [ProductController::class, 'updateProduct']);
    Route::get('get/product', [ProductController::class, 'getProduct']);
    Route::get('search/product', [ProductController::class, 'searchProduct']);
    Route::get('between/product', [ProductController::class, 'betweenProduct']);

    Route::post('add/product/variant', [ProductVariantController::class, 'addProductVariant']);
    Route::post('update/product/variant/{productVariantId}', [ProductVariantController::class, 'updateProductVariant']);
    Route::get('get/product/variant', [ProductVariantController::class, 'getProductVariant']);
    Route::get('get/discount/product', [ProductVariantController::class, 'getDiscountProduct']);
    Route::post('discount/{productVariantId}', [ProductVariantController::class, 'discount']);

    Route::post('sale/product/{productVariantId}', [ReportController::class, 'saleProduct']);
    Route::get('get/sale/product', [ReportController::class, 'getSaleProduct']);
    Route::get('report', [ReportController::class, 'report']);
    Route::delete('delete', [ReportController::class, 'delete']);
});
