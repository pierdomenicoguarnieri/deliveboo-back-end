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
use Illuminate\Support\Facades\Storage;

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

        return view('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        $restaurant = Restaurant::find(Auth::user()->restaurant_id);
        $types = Type::all();
        $title = 'Registra il tuo ristorante!';
        $method = 'POST';
        $route  = route('admin.restaurants.store');
        $button = 'Crea';
        return view('admin.restaurants.create_edit', compact('restaurant', 'types', 'title', 'method', 'route', 'button', 'restaurant'));
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

        if(array_key_exists('image_path', $form_data)){

            $form_data['image_name'] = $request->file('image_path')->getClientOriginalName();
            $form_data['image_path'] = Storage::put('uploads/', $form_data['image_path']);
        }

        $new_restaurant->fill($form_data);
        $new_restaurant->save();

        if(array_key_exists('types', $form_data)){
            $new_restaurant->types()->attach($form_data['types']);
        }

        $new_restaurant_id = Restaurant::where('slug', $new_restaurant->slug)->first();
        $update_user = User::find(Auth::user()->id);
        $update_user->restaurant_id = $new_restaurant_id->id;
        $update_user->update();

        return redirect()->route('admin.restaurants.index', $new_restaurant);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find(Auth::user()->restaurant_id);

        if(!$restaurant){
            abort('404');
        }

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
        $restaurant = Restaurant::find(Auth::user()->restaurant_id);
        $types = Type::all();
        $title = 'Modifica il tuo ristorante!';
        $method = 'PUT';
        $route  = route('admin.restaurants.update', $restaurant);
        $button = 'Modifica';

        return view('admin.restaurants.create_edit', compact('restaurant', 'types', 'title', 'method', 'route', 'button'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $i
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantRequest $request, Restaurant $restaurant)
    {
        $form_data = $request->all();

        if($restaurant->name !== $form_data['name']){
            $form_data['slug']  = Restaurant::generateSlug($form_data['name']);
        }else{
            $form_data['slug']  = $restaurant->slug;
        }

        if(array_key_exists('image_path',$form_data)){

            if($restaurant->image_path){
                    Storage::disk('public')->delete($restaurant->image_path);
            }

            $form_data['image_name'] = $request->file('image_path')->getClientOriginalName();
            $form_data['image_path'] = Storage::put('uploads/', $form_data['image_path']);
        }

        if(array_key_exists('noimage', $form_data) && $restaurant->image_path) {
            Storage::disk('public')->delete($restaurant->image_path);
            $form_data['image_name'] = '';
            $form_data['image_path'] = '';
        }

        $restaurant->update($form_data);

        if(array_key_exists('types', $form_data)){
            $restaurant->types()->sync($form_data['types']);
        }else{
            $restaurant->types()->detach();
        }

        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if($restaurant->image_path){
            Storage::disk('public')->delete($restaurant->image_path);
        }

        $restaurant->delete();

        return redirect()->route('admin.dashboard')->with('deleted', "Il tuo ristorante: \" $restaurant->name \" è stato eliminato con successo!");
    }
}
