<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;

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

Route::get('/', [UserController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/ditail/{id}', [UserController::class, 'detail'])->name('detail');
    Route::post('/cart/add', [ItemController::class, 'add'])->name('cart.add');
    Route::get('/cart', [ItemController::class, 'index'])->name('cart.index');
    Route::get('/address', [UserController::class, 'address']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/address/edit', [UserController::class, 'edit'])->name('edit');
    Route::post('/address/update', [UserController::class, 'updateAddress'])->name('address.update');
    Route::get('/purchase', [ItemController::class, 'purchase']);
    Route::post('/purchase/confirm', [ItemController::class, 'confirm'])->name('purchase.confirm');
    Route::post('/purchase/complete', [ItemController::class, 'complete'])->name('purchase.complete');
    Route::get('/sell', [ItemController::class, 'sell']);
});

