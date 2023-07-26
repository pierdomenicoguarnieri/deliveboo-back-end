<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function cartRequest(Request $request){
    $data = $request->all();
    $data_arr = [
      'token' => $data['token'],
      'restaurant_name' => $data['restaurantcart'],
      'total_price' => floatval($data['totalPrice']),
      'total_quantity' => intval($data['totalQuantity']),
      'dishes' => json_decode($data['arraydishes']),
    ];

    if (!file_exists('data.json'))
    {
      file_put_contents("data.json", json_encode($data_arr, JSON_PRETTY_PRINT));
    } else {
      unlink('data.json');
      file_put_contents("data.json", json_encode($data_arr, JSON_PRETTY_PRINT));
    }
    return response()->json(['success' => true]);
  }

  public function checkPayment(Request $request){
    $data = $request->all();

    if(file_exists('token.json')){
      $json = file_get_contents('token.json');

      $data_json = json_decode($json);

      if($data == $data_json->token){
        return response()->json(['success' => true]);
      }else{
        return response()->json(['success' => false]);
      }
    }else{
      return response()->json(['success' => false]);
    }
  }
}
