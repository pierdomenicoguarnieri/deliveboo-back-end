<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function cartRequest(Request $request){
    $data = $request->all();
    if($data != []){
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

    return response()->json(['success' => false]);
  }

  public function checkPayment(Request $request){
    $data = $request->all();

    if(file_exists('token.json')){
      $json_token = file_get_contents('token.json');
      $json_data = file_get_contents('data.json');
      $json_transaction = file_get_contents('transaction_id.json');
      $json_neworder = file_get_contents('neworder_id.json');

      $token_json = json_decode($json_token);
      $data_json = json_decode($json_data);
      $transaction_json = json_decode($json_transaction);
      $neworder_json = json_decode($json_neworder);

      if($data['token'] == $token_json->token){
        unlink('token.json');
        unlink('data.json');
        unlink('transaction_id.json');
        unlink('neworder_id.json');
        return response()->json(['success' => true, 'data' => $data_json, 'transaction_id' => $transaction_json->transaction_id, 'neworder_id' => $neworder_json->neworder_id]);
      }else{
        return response()->json(['success' => false]);
      }
    }else{
      return response()->json(['success' => false]);
    }
  }
}
