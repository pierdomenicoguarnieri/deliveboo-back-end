<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $restaurant = Restaurant::find(Auth::user()->restaurant_id);
        $dishes = Dish::all();
        return view('admin.dishes.index', compact('dishes', 'restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $restaurant = Restaurant::find(Auth::user()->restaurant_id);
        $method = 'POST';
        $route  = route('admin.dishes.store');
        $dish   = null;
        return view('admin.dishes.create_edit', compact('method', 'route', 'dish', 'restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
      $restaurant = Restaurant::find(Auth::user()->restaurant_id);
        return view('admin.dishes.show', compact('dish', 'restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
      $restaurant = Restaurant::find(Auth::user()->restaurant_id);
        $method = 'PUT';
        $route  = route('admin.dishes.update', $dish);
        return view('admin.dishes.create_edit', compact('dish', 'method', 'route', 'restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('admin.dishes.index')->with('deleted','Il piatto è stato eliminato con successo!');
    }
}
