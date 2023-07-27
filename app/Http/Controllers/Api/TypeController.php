<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
  public function getByType($name){
    $restaurants = Type::where('name', $name)->with('restaurants')->first();

    return response()->json($restaurants);
  }
}
