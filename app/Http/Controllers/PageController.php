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
    if(file_exists('data.json')){
      $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
      ]);

      $token = $gateway->ClientToken()->generate();
      $json = file_get_contents('data.json');
      $data = json_decode($json);

      return view('guest.checkout', compact('token', 'data'));
    }else{
      return redirect('http://localhost:5174/error404');
    }
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

    if ($result->success) {
      $errors = PageController::convalidaForm($request);
      if(count($errors) == 0){
        // header("Location: transaction.php?id=" . $transaction->id);
        $json = file_get_contents('data.json');
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

        $data_arr = [
          'token' => $data->token
        ];

        if(file_exists('data.json')){
          unlink('data.json');
          file_put_contents("token.json", json_encode($data_arr, JSON_PRETTY_PRINT));
        }

        return redirect('http://localhost:5174/payment-success');
      }else{
        return back()->withErrors($errors);
      }
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }
        return back()->withErrors('An error occurred with the message: '.$result->message);
        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");
    }
  }

  public function convalidaForm($request){
    $errors = [];

    if(strlen($request->user_name) === 0) $errors['user_name'] = 'Il nome è un campo obbligatorio';
    if(strlen($request->user_name) < 5) $errors['user_name'] = 'Il nome deve avere almeno 5 caratteri';
    if(strlen($request->user_name) > 255) $errors['user_name'] = 'Il nome può avere un massimo di 255 caratteri';
    if(strlen($request->user_lastname) === 0) $errors['user_lastname'] = 'Il cognome è un campo obbligatorio';
    if(strlen($request->user_lastname) < 5) $errors['user_lastname'] = 'Il cognome deve avere almeno 5 caratteri';
    if(strlen($request->user_lastname) > 255) $errors['user_lastname'] = 'Il cognome può avere un massimo di 255 caratteri';
    if(strlen($request->user_email) === 0) $errors['user_email'] = 'L\'email è un campo obbligatorio';
    if(strlen($request->user_email) < 5) $errors['user_email'] = 'L\'email deve avere almeno 5 caratteri';
    if(strlen($request->user_email) > 255) $errors['user_email'] = 'L\'email deve avere un massimo di 255 caratteri';
    if(strlen($request->user_address) === 0) $errors['user_address'] = 'L\'indirizzo è un campo obbligatorio';
    if(strlen($request->user_address) < 5) $errors['user_address'] = 'L\'indirizzo deve avere almeno 5 caratteri';
    if(strlen($request->user_address) > 255) $errors['user_address'] = 'L\'indirizzo può avere un massimo di 255 caratteri';
    if(strlen($request->user_telephone_number) === '') $errors['user_telephone_number'] = 'Il numero di telefono è un campo obbligatorio';
    if((int)$request->user_telephone_number < 1000000000) $errors['user_telephone_number'] = 'Il numero di telefono deve essere di 10 cifre';
    if((int)$request->user_telephone_number > 9999999999) $errors['user_telephone_number'] = 'Il numero di telefono deve essere di 10 cifre';

    return $errors;
  }
}
