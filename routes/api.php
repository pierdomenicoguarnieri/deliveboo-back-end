<?php

use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')
  ->prefix('restaurants')
  ->group(function(){
    Route::get('/', [RestaurantController::class, 'index']);
    Route::get('restaurant-detail/{slug}', [RestaurantController::class, 'getRestaurant']);
  });

Route::namespace('Api')
  ->prefix('type')
  ->group(function(){
    Route::get('/{name}', [TypeController::class, 'getByType']);
  });

