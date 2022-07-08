<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WBAPIController;

Route::get('/', function () { return view('index'); })->name('index');

Route::post('/api-get-incomes', [WBAPIController::class, 'getIncomes'])->name('api-get-incomes');
Route::post('/show-incomes', [WBAPIController::class, 'showIncomes'])->name('show-incomes');
Route::post('/send-incomes', [WBAPIController::class, 'sendIncomes'])->name('send-incomes');
Route::post('/api-get-stocks', [WBAPIController::class, 'getStocks'])->name('api-get-stocks');
Route::post('/show-stocks', [WBAPIController::class, 'showStocks'])->name('show-stocks');
Route::post('/send-stocks', [WBAPIController::class, 'sendStocks'])->name('send-stocks');
Route::post('/api-get-orders', [WBAPIController::class, 'getOrders'])->name('api-get-orders');
Route::post('/show-orders', [WBAPIController::class, 'showOrders'])->name('show-orders');
Route::post('/send-orders', [WBAPIController::class, 'sendOrders'])->name('send-orders');
Route::post('/api-get-sales', [WBAPIController::class, 'getSales'])->name('api-get-sales');
Route::post('/show-sales', [WBAPIController::class, 'showSales'])->name('show-sales');
Route::post('/send-sales', [WBAPIController::class, 'sendSales'])->name('send-sales');
Route::post('/api-get-sales-reports', [WBAPIController::class, 'getSalesReports'])->name('api-get-sales-reports');
Route::post('/show-sales-reports', [WBAPIController::class, 'showSalesReports'])->name('show-sales-reports');
Route::post('/send-sales-reports', [WBAPIController::class, 'sendSalesReports'])->name('send-sales-reports');
Route::post('/api-get-excises-reports', [WBAPIController::class, 'getExcisesReports'])->name('api-get-excises-reports');
Route::post('/show-excises-reports', [WBAPIController::class, 'showExcisesReports'])->name('show-excises-reports');
Route::post('/send-excises-reports', [WBAPIController::class, 'sendExcisesReports'])->name('send-excises-reports');