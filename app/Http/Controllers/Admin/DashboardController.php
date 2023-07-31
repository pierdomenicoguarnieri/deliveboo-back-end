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
    $sum = 0;
    $sum_formatted = 0;
    $restaurant  = (new Restaurant())->restaurantUser();
    if($restaurant != null){
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
        $sum += Order::where('id', $orderItem)->pluck('tot_order')->first();
        $sum_formatted = number_format($sum,2,',', '.');
        if($order != null && !in_array($order, $orders)){
          $orders[] = $order->toDateString();
        }
      }
      return view('admin.dashboard', compact('restaurant', 'dishes', 'orders', 'sum_formatted'));
    }else{
      return view('admin.dashboard', compact('restaurant'));
    }

  }
}
