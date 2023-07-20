<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
  public function index()
  {
    $restaurants = Restaurant::all();
    $types = Type::all();
    return response()->json(compact('restaurants', 'types'));
  }
}
