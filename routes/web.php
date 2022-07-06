<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OperationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', OperationController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('clients', ClientController::class);
Route::resource('categories', CategoryController::class);
Route::resource('payments', PaymentController::class);
Route::resource('operations', OperationController::class);
Route::post('/operations/total', [OperationController::class, 'total'])->name('operations.total');

require __DIR__.'/auth.php';
