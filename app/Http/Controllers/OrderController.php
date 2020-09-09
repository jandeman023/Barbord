<?php

namespace App\Http\Controllers;

use App\Mail\LowBalance;
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
        if (isset($_GET["count"])) {
            return Order::with([
                'OrderItem.Product:id,name',
                'OrderUser.User:id,nickname'
            ])->orderByDesc('created_at')->take($_GET["count"])->get();
        } elseif (isset($_GET['csv'])) {
            $orders = Order::with([
                'OrderItem.Product:id,name',
                'OrderUser.User:id,nickname'
            ])->orderByDesc('created_at')->get();

            foreach ($orders as $order) {
                $orderItems = [];
                foreach ($order['OrderItem'] as $orderItem) {
                    array_push($orderItems, $orderItem['product']['name']);
                }
                $order['OrderItem'] = $orderItems;

                $orderUsers = [];
                foreach ($order['OrderUser'] as $orderUser) {
                    array_push($orderUsers, $orderUser['user']['nickname']);
                }
                $order['OrderUser'] = $orderUsers;
            }
            unset($orders['order_item']);
            return ($orders);
        } elseif (isset($_GET['totalProductsOrdered'])) {
            $count = 0;
            $orders = Order::withCount(['OrderItem', 'OrderUser'])->get();
            foreach ($orders as $order) {
                $totalProductsOrdered = $order->order_item_count * $order->order_user_count;
                $count = $count + $totalProductsOrdered;
            }
            return $count;
        } elseif (isset($_GET['monthlyChart'])) {
            $orders = Order::withCount(['OrderItem', 'OrderUser'])->get();

            $orders = $orders->map(function ($order) {
                return [
                    'order_item_count' => $order->order_item_count,
                    'order_user_count' => $order->order_user_count,
                    'date' => $order->created_at->format('Y-m')
                ];
            });

            $orderArray = [];
            foreach ($orders as $order) {
                if (array_key_exists($order['date'], $orderArray)) {
                    $orderArray[$order['date']] = $orderArray[$order['date']] + ($order['order_item_count'] * $order['order_user_count']);
                } else {
                    $orderArray[$order['date']] = ($order['order_item_count'] * $order['order_user_count']);
                }
            }

            $labels = array_keys($orderArray);
            $series = array_values($orderArray);

            $data = [];
            array_push($data, $labels);
            array_push($data, $series);

            return $data;

        } elseif (isset($_GET['productChart'])) {
            $orders = Order::withCount('OrderUser')->with('products')->get();

            $productArray = [];

            foreach ($orders as $order) {
                foreach ($order->products as $product) {
                    if (array_key_exists($product->name, $productArray)) {
                        $productArray[$product->name] = $productArray[$product->name] + 1;
                    } else {
                        $productArray[$product->name] = 1;
                    }
                }
            }

            arsort($productArray);

            $labels = array_keys($productArray);
            $series = array_values($productArray);

            $data = [];
            array_push($data, $labels);
            array_push($data, $series);

            return $data;

        }

        return Order::with([
            'OrderItem.Product:id,name',
            'OrderUser.User:id,nickname'
        ])->orderByDesc('created_at')->get();

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = Input::get('products');
        $users = Input::get('users');
        if (isset($products) && isset($users)) {
            if (count($products) === 0 || count($users) === 0) {
                return response()->json([
                    'message' => 'Producten of users zijn niet ingevuld!'
                ], 405);
            } else {
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

//                    if ($oldBalance < 10 && $newBalance > 10) {
//                        return $user->email;
//                        Mail::to($request->user())->send(new LowBalance());
//                    }

                    $flight = User::find($user);
                    $flight->balance = $newBalance;
                    $flight->save();

                    $orderUser = new OrderUser;
                    $orderUser->order_id = $order->id;
                    $orderUser->user_id = $user;
                    $orderUser->old_balance = $oldBalance;
                    $orderUser->new_balance = $newBalance;
                    $orderUser->save();
                }
                return Input::all();
            }
        } else {
            return response()->json([
                'message' => 'Page Not Found. If error persists, contact Jan'
            ], 405);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
