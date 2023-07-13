<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
  use HasFactory;

  public function orders(){
    return $this->belongsToMany(Order::class);
  }

  public function restaurant(){
    return $this->belongsTo(Restaurant::class);
  }

  protected $fillable = [
    'name',
    'price',
    'visible',
    'description',
    'ingredients',
    'is_vegan',
    'is_frozen',
    'is_gluten_free',
    'type',
    'image_path',
    'image_name'
  ];
}
