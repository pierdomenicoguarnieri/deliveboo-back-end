<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/checkout-form', [PageController::class, 'chekcoutForm'])->name('checkout-form');
Route::post('/checkout', [PageController::class, 'checkout'])->name('checkout');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])
  ->name('admin.')
  ->prefix('admin')
  ->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::resource('restaurants', RestaurantController::class);
    Route::post('/restore_restaurant/{restaurant}', [RestaurantController::class, 'restore_restaurant'])->withTrashed()->name('restore.restaurant');
    Route::resource('dishes', DishController::class)->withTrashed();
    Route::post('/restore_dish/{dish}', [DishController::class, 'restore_dish'])->withTrashed()->name('restore.dish');
    Route::get('/deleted_dishes', [DishController::class, 'deleted_dishes'])->name('deleted.dishes');
    Route::resource('orders', OrderController::class);
  });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
