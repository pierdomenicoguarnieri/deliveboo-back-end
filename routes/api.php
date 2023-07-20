<?php

use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')
  ->prefix('restaurant')
  ->group(function(){
    Route::get('/', [RestaurantController::class, 'index']);
    Route::get('restaurant_detail/{slug}', [RestaurantController::class, 'getRestaurant']);
  });

Route::namespace('Api')
  ->prefix('type')
  ->group(function(){
    Route::get('/{name}', [TypeController::class, 'getByType']);
  });
