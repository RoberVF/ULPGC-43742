<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/nosotros', [PageController::class, 'about'])->name('about');
Route::get('/productores', [ProducerController::class, 'index'])->name('producers.index');
Route::get('/productos/{tipo?}', [ProductController::class, 'index'])->name('products.index');
