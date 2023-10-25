<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', [TransactionController::class, 'index']);


Route::resource('transactions', TransactionController::class);
