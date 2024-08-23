<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPartController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomPartController;
use App\Http\Controllers\WorkShopController;

//Auth For Both Owner/Worker
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/update-profile', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');
Route::post('/update-worker/{id}', [AuthController::class, 'updateUserById']);
Route::get('/user/{id}', [AuthController::class, 'show']);
Route::get('/workers', [AuthController::class, 'getWorkers'])->middleware('auth:sanctum');

//WorkShop
Route::prefix('workshop')->group(function () {
    Route::get('/list', [WorkShopController::class, 'list'])->middleware('auth:sanctum');
    Route::post('/store', [WorkShopController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/update/{id}', [WorkShopController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/show/{id}', [WorkShopController::class, 'show']);
    Route::put('/revert-status/{id}', [WorkShopController::class, 'revertStatus'])->middleware('auth:sanctum');
});

Route::prefix('material')->group(function () {
    Route::get('/list', [MaterialController::class, 'list']);
});

Route::prefix('part')->group(function () {
    Route::get('/list/{id}', [PartController::class, 'list']);
    Route::get('/list-by-color/{id}/{color}', [PartController::class, 'listByColor'])->middleware('auth:sanctum');;
    Route::post('/store', [PartController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/update/{id}', [PartController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/show/{id}', [PartController::class, 'show']);
    Route::delete('/delete/{id}', [PartController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::prefix('room')->group(function () {
    Route::get('/list/', [RoomController::class, 'list'])->middleware('auth:sanctum');
    Route::post('/store', [RoomController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/update/{id}', [RoomController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/show/{id}', [RoomController::class, 'show']);
    Route::delete('/delete/{id}', [RoomController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::prefix('room-part')->group(function () {
    Route::post('/store', [RoomPartController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/update/{id}', [RoomPartController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/show/{id}', [RoomPartController::class, 'show']);
    Route::delete('/delete/{id}', [RoomPartController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::prefix('order')->group(function () {
    Route::get('/list/{id}', [OrderController::class, 'list'])->middleware('auth:sanctum');
    Route::post('/store', [OrderController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/update/{id}', [OrderController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/show/{id}', [OrderController::class, 'show']);
});

Route::prefix('order-part')->group(function () {
    Route::post('/store', [OrderPartController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/update/{id}', [OrderPartController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/show/{id}', [OrderPartController::class, 'show']);
    Route::delete('/delete/{id}', [OrderPartController::class, 'destroy'])->middleware('auth:sanctum');
});
