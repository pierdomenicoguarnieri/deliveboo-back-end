<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
  {
    return [
      'user_name' => 'required|min:2|max:255',
      'user_lastame' => 'required|min:2|max:255',
      'user_address' => 'required|min:5|max:255',
      'user_telephone_number' => 'required|numeric|min:1000000000|max:9999999999',
      'user_email' => 'required|email|min:5|max:255',
    ];
  }

  public function messages()
  {
    return [
      'user_name.required' => 'Il nome è obbligatorio',
      'user_name.max' => 'Il nome può avere massimo :max caratteri',
      'user_name.min' => 'Il nome deve avere almeno :min caratteri',
      'user_lastame.required' => 'Il cognome è obbligatorio',
      'user_lastame.max' => 'Il cognome può avere massimo :max caratteri',
      'user_lastame.min' => 'Il cognome deve avere almeno :min caratteri',
      'user_address.required' => 'L\'indirizzo è obbligatorio',
      'user_address.max' => 'L\'indirizzo può avere massimo :max caratteri',
      'user_address.min' => 'L\'indirizzo deve avere almeno :min caratteri',
      'user_telephone_number.required' => 'Il numero di telefono è richiesto',
      'user_telephone_number.numeric' => 'Il numero di telefono deve essere un numero',
      'user_telephone_number.min' => 'Il numero di telefono deve essere di 10 cifre',
      'user_telephone_number.max' => 'Il numero di telefono deve essere di 10 cifre',
      'user_email.required' => 'L\'email è obbligatoria',
      'user_email.max' => 'L\'email può avere massimo :max caratteri',
      'user_email.min' => 'L\'email deve avere almeno :min caratteri',
      'user_email.email' => 'L\'email deve avere un formato corretto',
    ];
  }
}
