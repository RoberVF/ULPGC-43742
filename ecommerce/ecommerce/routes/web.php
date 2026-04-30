<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/terms-and-services', function () {
    return view('livewire.legit.terms-and-services');
})->name('terms-and-services');

Route::get('/privacy-policy', function () {
    return view('livewire.legit.privacy-policy');
})->name('privacy-policy');

Route::get('/cookies', function () {
    return view('livewire.legit.cookies');
})->name('cookies');

Route::get('/licenses', function () {
    return view('livewire.legit.licenses');
})->name('licenses');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('/wall', 'wall')->name('wall');

    Route::middleware('auth')->group(function () {
        Volt::route('/checkout', 'checkout')->name('checkout');
        Volt::route('/order-success', 'order-success')->name('order-success');
    });

    Route::middleware('client')->group(function () {
        Volt::route('/marketplace', 'marketplace')->name('marketplace');
    });

    Route::middleware('producer')->group(function () {
        Volt::route('/producer/dashboard', 'producers.dashboard')->name('producer.dashboard');
    });

    Route::middleware('seller')->group(function () {
        Volt::route('/seller/dashboard', 'sellers.dashboard')->name('seller.dashboard');
        Volt::route('/producer-market', 'sellers.producer-market')->name('producer.market');
    });

    Route::middleware('not_client')->group(function () {
        Volt::route('/wall', 'wall')->name('wall');
    });
});

require __DIR__ . '/auth.php';
