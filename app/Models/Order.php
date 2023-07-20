<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
  use HasFactory;

  public function dishes()
  {
    return $this->belongsToMany(Dish::class);
  }
}
