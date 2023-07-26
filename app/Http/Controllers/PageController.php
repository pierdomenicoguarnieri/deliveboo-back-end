<?php

namespace App\Http\Controllers;

use App\Models\DishOrder;
use App\Models\Order;
use Braintree;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function index(){
    return redirect('http://localhost:5174/');
  }

  public function chekcoutForm(){
    $gateway = new Braintree\Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->ClientToken()->generate();
    $json = file_get_contents('data.js');
    $data = json_decode($json);

    return view('guest.checkout', compact('token', 'data'));
  }

  public function checkout(Request $request){
    $gateway = new Braintree\Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
            'firstName' => $request->user_name,
            'lastName' => $request->user_lastname,
            'email' => $request->user_email,
        ],
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success && $request->user_name && $request->user_lastname && $request->user_address && $request->user_telephone_number && $request->user_email) {
        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);
        $json = file_get_contents('data.js');
        $data = json_decode($json);
        $new_order = new Order();
        $new_order->user_name = $request->user_name;
        $new_order->user_lastname = $request->user_lastname;
        $new_order->user_address = $request->user_address;
        $new_order->user_telephone_number = $request->user_telephone_number;
        $new_order->user_email = $request->user_email;
        $new_order->tot_order = $data->total_price;
        $new_order->save();
        foreach ($data->dishes as $dish) {
          $new_order->dishes()->attach($dish->id, ['quantity' => $dish->counterQuantity]);
        }
        return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");
        return back()->withErrors('An error occurred with the message: '.$result->message);
    }
  }
}
