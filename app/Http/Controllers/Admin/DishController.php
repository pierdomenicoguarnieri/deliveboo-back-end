<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DishRequest;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
  public function index()
  {
    $restaurant = Restaurant::find(Auth::user()->restaurant_id);
    $dishes = Dish::where('restaurant_id', $restaurant->id)->get();
    return view('admin.dishes.index', compact('dishes', 'restaurant'));
  }

  public function create()
  {
    $restaurant = Restaurant::find(Auth::user()->restaurant_id);
    $method = 'POST';
    $route  = route('admin.dishes.store');
    $dish   = null;
    return view('admin.dishes.create_edit', compact('method', 'route', 'dish', 'restaurant'));
  }

  public function store(DishRequest $request)
  {
    $form_data                    = $request->all();
    $form_data['visible']         = $request->has('visible');
    $form_data['is_vegan']        = $request->has('is_vegan');
    $form_data['is_frozen']       = $request->has('is_frozen');
    $form_data['is_gluten_free']  = $request->has('is_gluten_free');
    $form_data['is_lactose_free'] = $request->has('is_lactose_free');

    $new_dish = Dish::create($form_data);
    return redirect()->route('admin.dishes.show', $new_dish);
  }

  public function show(Dish $dish)
  {
    $restaurant = Restaurant::find(Auth::user()->restaurant_id);
    return view('admin.dishes.show', compact('dish', 'restaurant'));
  }

  public function edit(Dish $dish)
  {
    $restaurant = Restaurant::find(Auth::user()->restaurant_id);
    $method = 'PUT';
    $route  = route('admin.dishes.update', $dish);
    return view('admin.dishes.create_edit', compact('dish', 'method', 'route', 'restaurant'));
  }

  public function update(Request $request, Dish $dish)
  {
    $form_data                    = $request->all();
    $form_data['visible']         = $request->has('visible');
    $form_data['is_vegan']        = $request->has('is_vegan');
    $form_data['is_frozen']       = $request->has('is_frozen');
    $form_data['is_gluten_free']  = $request->has('is_gluten_free');
    $form_data['is_lactose_free'] = $request->has('is_lactose_free');

    $dish->update($form_data);
    return redirect()->route('admin.dishes.show', $dish);
  }

  public function destroy(Dish $dish)
  {
    $dish->delete();
    return redirect()->route('admin.dishes.index')->with('deleted','Dish deleted');
  }
}
