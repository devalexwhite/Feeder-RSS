<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

Route::middleware([
    'auth:sanctum'
])
    ->controller(FeedController::class)
    ->name('feeds.')
    ->group(function () {
        Route::get('/feeds', 'index')->name('index');
        Route::get('/feeds/create', 'create')->name('create');
        Route::post('/feeds/store', 'store')->name('store');
        Route::get('/feeds/{feed}', 'show')->name('show');
        Route::get('/feeds/{feed}/edit', 'edit')->name('edit');
        Route::post('/feeds/{feed}/update', 'update')->name('update');
        Route::get('/feeds/{feed}/parse', 'parse')->name('parse');
    });
