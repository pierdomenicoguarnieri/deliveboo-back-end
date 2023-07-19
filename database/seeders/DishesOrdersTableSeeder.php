<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\DishOrder;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DishesOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $orders = Order::all();
      $restaurantsIds = Restaurant::all()->pluck('id')->toArray();

      foreach ($orders as $order) {
        $randRestaurantId = rand(1, count($restaurantsIds));
        $dish_array = Dish::where('restaurant_id', $randRestaurantId)->pluck('id')->toArray();

        for($i = 0; $i < rand(1, count($dish_array)); $i++){
          if($dish_array != null){
            $key = array_rand($dish_array, 1);
          }

          $order->dishes()->attach($dish_array[$key], ['quantity' => rand(1, 5)]);
          unset($dish_array[$key]);
          $dish_array = array_values($dish_array);
        }

        $order_pivot = DishOrder::where('order_id', $order->id)->get();
        $quantity_price = [];

        foreach($dish_array as $key => $dish){
          $single_dish = Dish::find($dish);
          $new_price = $single_dish->price * $order_pivot[$key]->quantity;
          array_push($quantity_price, $new_price);

        }
        $order->tot_order = array_sum($quantity_price);
        //dd($order, $new_price);
        $order->update();
      }
    }
}
