<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function cartRequest(Request $request){
    $data = $request->all();
    $data_arr = [
      'restaurant_name' => $data['restaurantcart'],
      'total_price' => floatval($data['totalPrice']),
      'total_quantity' => intval($data['totalQuantity']),
      'dishes' => json_decode($data['arraydishes']),
    ];

    if (!file_exists('data.js'))
    {
      file_put_contents("data.js", json_encode($data_arr, JSON_PRETTY_PRINT));
    } else {
      unlink('data.js');
      file_put_contents("data.js", json_encode($data_arr, JSON_PRETTY_PRINT));
    }
    return response()->json(['success' => true]);
  }
}
