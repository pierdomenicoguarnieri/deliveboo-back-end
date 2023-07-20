<?php

use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')
  ->prefix('restaurant')
  ->group(function(){
    Route::get('restaurant_detail/{slug}', [RestaurantController::class, 'getRestaurant']);
  });

Route::namespace('Api')
  ->prefix('type')
  ->group(function(){
    Route::get('/{name}', [TypeController::class, 'getByType']);
  });
