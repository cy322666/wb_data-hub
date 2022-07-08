<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WBAPIController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::post('/api-get-data',
    [WBAPIController::class, 'getAllData']
)->name('api-get-data');