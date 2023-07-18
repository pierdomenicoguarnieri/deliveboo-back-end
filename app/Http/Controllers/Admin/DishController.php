<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DishRequest;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
  public function index()
  {
    $restaurant = (new Restaurant())->restaurantUser();

    if(isset($_GET['search'])){
      $tosearch   = $_GET['search'];
      $dishes     = $restaurant->dishes()->where('name', 'like', "%$tosearch%")->paginate(10);
    }else{
      $dishes     = $restaurant->dishes()->paginate(10);
    }

    return view('admin.dishes.index', compact('dishes', 'restaurant'));
  }

  public function create()
  {
    $restaurant = Restaurant::find(Auth::user()->restaurant_id);
    $title      = 'Crea un nuovo piatto';
    $method     = 'POST';
    $route      = route('admin.dishes.store');
    $dish       = null;
    return view('admin.dishes.create_edit', compact('restaurant', 'title', 'method', 'route', 'dish'));
  }

  public function data_bool($request)
  {
    $form_data                    = $request->all();
    $form_data['visible']         = $request->has('visible');
    $form_data['is_vegan']        = $request->has('is_vegan');
    $form_data['is_frozen']       = $request->has('is_frozen');
    $form_data['is_gluten_free']  = $request->has('is_gluten_free');
    $form_data['is_lactose_free'] = $request->has('is_lactose_free');
    return $form_data;
  }

  public function store(DishRequest $request)
  {
    $form_data = $this->data_bool($request);
    if (array_key_exists('image', $form_data))
    {
      $form_data['image_name'] = $request->file('image')->getClientOriginalName();
      $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
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
    $title      = 'Modifica il piatto: "' . $dish->name . '"';
    $method     = 'PUT';
    $route      = route('admin.dishes.update', $dish);
    return view('admin.dishes.create_edit', compact('dish', 'method', 'title','route', 'restaurant'));
  }

  public function update(DishRequest $request, Dish $dish)
  {
    $form_data = $this->data_bool($request);
    if(array_key_exists('image',$form_data))
    {
      if($dish->image_path)
      {
        Storage::disk('public')->delete($dish->image_path);
      }
      $form_data['image_name'] = $request->file('image')->getClientOriginalName();
      $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
    }
    if(array_key_exists('noImage', $form_data) && $dish->image_path)
    {
      Storage::disk('public')->delete($dish->image_path);
      $form_data['image_name'] = '';
      $form_data['image_path'] = '';
    }
    $dish->update($form_data);
    return redirect()->route('admin.dishes.show', $dish);
  }

  public function destroy(Dish $dish)
  {
    $dish->delete();
    return redirect()->route('admin.dishes.index');
  }

  // public function deleted_dish()
  // {
  //   $dish = Dish::onlyTrashed()->get();
  //   dd($dish);
  // }
}




/***********************************************************************************
*                     _____                            _____                       *
*                   //     \\   ||       //\\        //     \\                     *
*                  //           ||      //  \\      //       \\                    *
*                 ((            ||     //    \\    ((         ))                   *
*                  \\           ||    //======\\    \\       //                    *
*                   \\_____//   ||   //        \\    \\_____//                     *
*                                                                                  *
***********************************************************************************/
