<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index(){
    $restaurant = Restaurant::find(Auth::user()->restaurant_id);
    return view('admin.dashboard', compact('restaurant'));
  }
}
