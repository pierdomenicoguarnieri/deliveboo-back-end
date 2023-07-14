<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\DishOrder;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishesOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dish_array = [];
      $orders = Order::all();
      foreach ($orders as $order) {
        $dishes = Dish::all();
        foreach($dishes as $dish){
          array_push($dish_array, $dish->id);
        }
        for($i = 0; $i < rand(1, 10); $i++){
          $key = array_rand($dish_array, 1);
          $order->dishes()->attach($dish_array[$key]);
          unset($dish_array[$key]);
          $dish_array = array_values($dish_array);
        }
      }
    }
}
