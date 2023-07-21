<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\Dish;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
  public function index(){
    $restaurants = Restaurant::with('types')->get();
    foreach($restaurants as $restaurant){
      $restaurant->image_path = asset('storage/' . $restaurant->image_path);
    }
    $types = Type::all();

    return response()->json(compact('restaurants', 'types'));
  }

  public function getRestaurant($slug){
    $restaurant = Restaurant::where('slug', $slug)->with('dishes')->first();

    $restaurant->image_path = asset('storage/' . $restaurant->image_path);

    foreach($restaurant->dishes as $dish){
      $dish->image_path = asset('storage/' . $dish->image_path);
    }

    return response()->json($restaurant);
  }

  //Add for Cart

  public function cartDishes($id)
  {
      $idArray = [];
      foreach (explode(',', $id) as $dish_id) {
          $idArray[] = $dish_id;
      }

      $dishes = [];

      foreach ($idArray as $id) {
          $plates[] = Dish::where('id', $id)->first();
      }
      $restaurant = Restaurant::where('id', $dishes[0]->restaurant_id)->first();

      return response()->json(compact('dishes', 'restaurant'));
  }

}
