<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\OrderUser;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->save();

        $totalPrice = 0;

        foreach (Input::get('products') as $item) {
            $itemPrice = Product::find($item)->price;
            $totalPrice = $totalPrice + $itemPrice;

            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item;
            $orderItem->product_price = $itemPrice;
            $orderItem->quantity = 1;
            $orderItem->save();
        }

        foreach (Input::get('users') as $user) {

            $oldBalance = User::find($user)->balance;
            $newBalance = $oldBalance - $totalPrice;

            $orderUser = new OrderUser;
            $orderUser->order_id = $order->id;
            $orderUser->user_id = $user;
            $orderUser->old_balance = $oldBalance;
            $orderUser->new_balance = $newBalance;
            $orderUser->save();
        }

        return Input::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
