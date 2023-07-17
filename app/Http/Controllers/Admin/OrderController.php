<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\DishOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $dishes_array = [];
      $orders_array = [];
      $i = 0;
      $restaurant = (new Restaurant())->restaurantUser();
      $dishes     = $restaurant->dishes()->get();
      foreach($dishes as $key => $dish){
        $order = DishOrder::where('dish_id', $dish->id)->get();
        if(!$order->isEmpty()){
          $dishes_array[$key] = $order;
        }
      }
      foreach($dishes_array as $dish_id){
        $order = $dish_id;
        foreach($order as $element){
          $i++;
          $result = Order::where('id', $element->order_id)->with('dishes')->get();
          if(!in_array( $result, $orders_array)){
            $orders_array[$i] = $result;
          }
        }
      }

      return view('admin.orders.index', compact('orders_array', 'restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
      $restaurant = (new Restaurant())->restaurantUser();
      //dd($order->id);
      //$order = Order::find($order->id)->with('dishes')->get();
      //dd($order );

      return view('admin.orders.show', compact('order', 'restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
