<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DishRequest;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
  public function index()
  {
    $restaurant = (new Restaurant())   ->restaurantUser();
    $dishes     = $restaurant->dishes()->get();

    return view('admin.dishes.index', compact('dishes', 'restaurant'));
  }

  public function create()
  {
    $restaurant = (new Restaurant())->restaurantUser();
    $method     = 'POST';
    $route      = route('admin.dishes.store');
    $dish       = null;

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

    if (array_key_exists('image', $form_data))
    {
      $form_data['image_name'] = $request->file('image')->getClientOriginalName();
      $form_data['image_path'] = Storage::put('uploads/', $form_data['image']);
    }

    $restaurant = (new Restaurant())->restaurantUser();
    $new_dish   = new Dish($form_data);
    $new_dish->restaurant()->associate($restaurant->id);
    $new_dish->save();

    return redirect()->route('admin.dishes.show', $new_dish);
  }

  public function show(Dish $dish)
  {
    $restaurant = (new Restaurant())->restaurantuser();

    return view('admin.dishes.show', compact('dish', 'restaurant'));
  }

  public function edit(Dish $dish)
  {
    $restaurant = (new Restaurant())->restaurantuser();
    $method     = 'PUT';
    $route      = route('admin.dishes.update', $dish);

    return view('admin.dishes.create_edit', compact('dish', 'method', 'route', 'restaurant'));
  }

  public function update(DishRequest $request, Dish $dish)
  {
    $form_data                    = $request->all();
    $form_data['visible']         = $request->has('visible');
    $form_data['is_vegan']        = $request->has('is_vegan');
    $form_data['is_frozen']       = $request->has('is_frozen');
    $form_data['is_gluten_free']  = $request->has('is_gluten_free');
    $form_data['is_lactose_free'] = $request->has('is_lactose_free');

    if(array_key_exists('image',$form_data))
    {

      if($dish->image_path)
      {
        Storage::disk('public')->delete($dish->image_path);
      }

      $form_data['image_name'] = $request->file('image')->getClientOriginalName();
      $form_data['image_path'] = Storage::put('uploads/', $form_data['image']);
    }

    if(array_key_exists('noImage', $form_data) && $dish->image_path)
    {
        Storage::disk('public')->delete($dish->image_path);
        $form_data['image_original_name'] = '';
        $form_data['image_path']          = '';
    }
    $dish->update($form_data);

    return redirect()->route('admin.dishes.show', $dish);
  }

  public function destroy(Dish $dish)
  {
    $dish->delete();

    return redirect()->route('admin.dishes.index')->with('deleted','Piatto eliminato');
  }
}

/**********************************************************************************
*                     _____                            _____                      *
*                   //     \\   ||       //\\        //     \\                    *
*                  //           ||      //  \\      //       \\                   *
*                 ((            ||     //    \\    ((         ))                  *
*                  \\           ||    //======\\    \\       //                   *
*                   \\_____//   ||   //        \\    \\_____//                    *
*                                                                                 *
***********************************************************************************/
