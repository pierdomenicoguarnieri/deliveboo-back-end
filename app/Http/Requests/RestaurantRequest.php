<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'required|min:5|max:255',
      'email' => 'required|email|min:5|max:255',
      'address' => 'required|min:5|max:255',
      'piva' => 'required|numeric|min:10000000000|max:99999999999',
      'telephone_number' => 'required'
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Il nome è un campo richiesto',
      'name.min' => 'Il nome deve avere almeno :min caratteri',
      'name.max' => 'Il nome può avere al massimo :max caratteri',
      'email.required' => 'L\'email è un campo richiesto',
      'email.email' => 'L\'email non è del formato corretto',
      'email.min' => 'L\'email deve avere almeno :min caratteri',
      'email.max' => 'L\'email può avere al massimo :max caratteri',
      'address.required' => 'L\'indirizzo è un campo richiesto',
      'address.min' => 'L\'indirizzo deve avere almeno :min caratteri',
      'address.max' => 'L\'indirizzo può avere al massimo :max caratteri',
      'piva.required' => 'La Partita IVA è un campo richiesto',
      'piva.numeric' => 'La Partita IVA non è del formato corretto',
      'piva.min' => 'La Partita IVA deve avere un valore minimo di :min',
      'piva.max' => 'L\'email può avere un valore massimo di :max',
      'telephone_number.required' => 'Il telefono è un campo richiesto',
    ];
  }
}
