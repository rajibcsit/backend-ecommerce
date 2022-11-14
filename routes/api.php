<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\Auth\UserController;


Route::post('/login', [UserController::class, 'login']);
Route::post('/registration', [UserController::class, 'registration']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/category',                         [CategoryController::class, 'index']);
    Route::post('/category',                        [CategoryController::class, 'create']);
    Route::get('/category/{id}',                    [CategoryController::class, 'show']);
    Route::get('/category/{id}',                    [CategoryController::class, 'edit']);
    Route::post('/category/{id}',                   [CategoryController::class, 'update']);
    Route::delete('/category/{id}',                 [CategoryController::class, 'destroy']);

    Route::get('/supplier',                         [SupplierController::class, 'index']);
    Route::post('/supplier',                        [SupplierController::class, 'create']);
    Route::get('/supplier/{id}',                    [SupplierController::class, 'show']);
    Route::get('/supplier/{id}',                    [SupplierController::class, 'edit']);
    Route::post('/supplier/{id}',                   [SupplierController::class, 'update']);
    Route::delete('/supplier/{id}',                 [SupplierController::class, 'destroy']);

    Route::get('/product',                         [ProductController::class, 'index']);
    Route::post('/product',                        [ProductController::class, 'create']);
    Route::get('/product/{id}',                    [ProductController::class, 'show']);
    Route::get('/product/{id}',                    [ProductController::class, 'edit']);
    Route::post('/product/{id}',                   [ProductController::class, 'update']);
    Route::delete('/product/{id}',                 [ProductController::class, 'destroy']);
});
