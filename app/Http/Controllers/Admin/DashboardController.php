<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DishOrder;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index(){
    $restaurant  = Restaurant::find(Auth::user()->restaurant_id);
    $ordersArray = [];
    $orders      = [];
    $orders_ids  = [];
    $order_pivot = [];
    $restaurant  = (new Restaurant())->restaurantUser();
    $dishes      = $restaurant->dishes()->get();
    foreach($dishes as $dish){
      $order_pivot    = DishOrder::where('dish_id', $dish->id)->get();
      foreach ($order_pivot as $order) {
        if(!in_array($order->order_id, $orders_ids)){
          $orders_ids[] = $order->order_id;
        }
      }
    }

    asort($orders_ids);

    foreach($orders_ids as $orderItem){
      $order = Order::where('id', $orderItem)->pluck('created_at')->first();
      if($order != null && !in_array($order, $orders)){
        $orders[] = $order->toDateString();
      }
    }
    
    return view('admin.dashboard', compact('restaurant', 'orders'));
  }
}
