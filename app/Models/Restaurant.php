<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Restaurant extends Model
{
  use HasFactory;

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function types(){
    return $this->belongsToMany(Type::class);
  }

  public function dishes(){
    return $this->hasMany(Dish::class);
  }

  public static function generateSlug($str){
    $slug = Str::slug($str, '-');
    $original_slug = $slug;

    $slug_exixts = Restaurant::where('slug', $slug)->first();
    $c = 1;
    while($slug_exixts){
      $slug = $original_slug . '-' . $c;
      $slug_exixts = Restaurant::where('slug', $slug)->first();
      $c++;
    }

    return $slug;
  }

  protected $fillable = [
    'name',
    'slug',
    'email',
    'address',
    'piva',
    'telephone_number',
    'image_path',
    'image_name',
    'rating'
  ];
}
