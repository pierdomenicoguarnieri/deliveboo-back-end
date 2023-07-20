<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Restaurant;
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
      $ordersArray = [];
      $orders = [];
      $restaurant = (new Restaurant())->restaurantUser();
      $dishes     = $restaurant->dishes()->get();
      foreach($dishes as $dish){
        $order_pivot    = DishOrder::where('dish_id', $dish->id)->first();
        $ordersArray[] = $order_pivot;

      }

      foreach($ordersArray as $orderItem){
        $order = Order::where('id', $orderItem?->order_id)->with('dishes')->first();
        if($order != null && !in_array($order, $orders)){
          $orders[] = $order;
        }
      }

     //$restaurant = (new Restaurant())->restaurantUser();
     //$dishes     = $restaurant->dishes()->get();
      //$order    = DishOrder::where('dish_id', $dish->id)->first();



      return view('admin.orders.index', compact('orders', 'ordersArray', 'restaurant'));
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
      $order_pivot = DishOrder::where('order_id', $order->id)->get();

      return view('admin.orders.show', compact('order', 'order_pivot', 'restaurant'));
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
