<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $orders = config('orders');

      foreach($orders as $order) {
        $new_order = new Order();
        $new_order->user_name = $order['user_name'];
        $new_order->user_lastname = $order['user_lastname'];
        $new_order->user_address = $order['user_address'];
        $new_order->user_telephone_number = $order['user_telephone_number'];
        $new_order->user_email = $order['user_email'];
        $new_order->tot_order = $order['tot_order'];
        $new_order->save();
      }
    }
}
