<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\WarehouseApiController;
use App\Http\Controllers\Practica4Controller;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/nosotros', [PageController::class, 'about'])->name('about');
Route::get('/productores', [ProducerController::class, 'index'])->name('producers.index');
Route::get('/productos/{tipo?}', [ProductController::class, 'index'])->name('products.index');

Route::prefix('practica4')->group(function () {
    Route::get('/basico', [Practica4Controller::class, 'basico'])->name('p4.basico');
    Route::get('/sensores', [Practica4Controller::class, 'sensores'])->name('p4.sensores');
    Route::get('/graficos', [Practica4Controller::class, 'graficos'])->name('p4.graficos');
});

Route::prefix('api')->group(function () {
    Route::post('/sensors', [WarehouseApiController::class, 'store']);
    Route::get('/sensors/{seller_dni}', [WarehouseApiController::class, 'index']);
});
