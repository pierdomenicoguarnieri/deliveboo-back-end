<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => 'required | max:255',
      'price' => 'required | integer | min:0,00 | max:999,99',
      'description' => 'min:200 | max:1500',
      'ingredients' => 'min:100 | max:1000',
      'type' => 'max:50',
      'image_path' => 'max:255',
      'image_name' => 'max:255',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Il nome è obbligatorio',
      'name.max' => 'Il nome può avere massimo 255 caratteri',
      'price.required' => 'Il prezzo è obbligatorio',
      'price.integer' => 'Il prezzo deve essere un numero',
      'price.min' => 'Il prezzo non può essere negativo',
      'price.max' => 'Il prezzo non può essere superiore a 999,99',
      'description.min' => 'La descrizione deve essere di almeno 200 caratteri',
      'description.max' => 'La descrizione non può superare i 1500 caratteri',
      'ingredients.min' => 'Gli ingredienti devono avere almeno 100 caratteri',
      'ingredients.max' => 'Gli ingredienti non possono superare i 1000 caratteri',
      'type.max' => 'Il tipo non può superare i 50 caratteri',
      'image_path.max' => 'Il path dell\'immagine non può superare i 255 caratteri',
      'image_name.max' => 'Il nome dell\'immagine non può superare i 255 caratteri',
    ];
  }
}
