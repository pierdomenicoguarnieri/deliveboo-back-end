<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Type;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = Restaurant::find(Auth::user()->restaurant_id);
        //$restaurant = Restaurant::where( $restaurant_from_user['id'], 'id');
        //dump($restaurant_from_user['id']);
        //dump($restaurant);
        //dump(Auth::user());

        return view('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        $types = Type::all();
        return view('admin.restaurants.create', compact('restaurant', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantRequest $request)
    {
        $form_data = $request->all();
        $new_restaurant = new Restaurant();

        $form_data['slug'] = Restaurant::generateSlug($form_data['name']);

        $new_restaurant->fill($form_data);
        $new_restaurant->save();

        $new_restaurant_id = Restaurant::where('slug', $new_restaurant->slug)->first();
        $update_user = User::find(Auth::user()->id);
        $update_user->restaurant_id = $new_restaurant_id->id;
        $update_user->update();


        return redirect()->route('admin.home', compact('new_restaurant'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {

        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $types = Type::all();

        return view('admin.restaurants.edit', compact('restaurant', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
