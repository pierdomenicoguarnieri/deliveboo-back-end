<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
  use HasFactory;
  use SoftDeletes;

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
    'is_lactose_free',
    'type',
    'image_path',
    'image_name'
  ];

  protected $dates = ['deleted_at'];
}
