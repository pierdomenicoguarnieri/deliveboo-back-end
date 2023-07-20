<?php

use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')
    ->prefix('restaurants')
    ->group(function() {
      Route::get('/', [RestaurantController::class, 'index']);
    });
