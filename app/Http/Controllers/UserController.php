<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderUser;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET["topBuyers"])) {
            $orders = Order::with([
                'OrderItem.Product:id,name',
                'OrderUser.User:id,nickname'
            ])->orderByDesc('created_at')->get();
            $orderUsersArr = [];
            foreach ($orders as $orderUser) {
                foreach ($orderUser['OrderItem'] as $orderItem) {
                    array_push($orderUsersArr, $orderUser['OrderUser'][0]['user_id']);
                }
            }
            $counted = array_count_values($orderUsersArr);
            arsort($counted);
            $counted = array_slice($counted, 0, $_GET["topBuyers"], true);
            $counter = 1;
            foreach ($counted as $key=>$count) {
                $counted[$key] = $counter;
                $counter++;
            }
            return $counted;
        } elseif (isset($_GET['all'])) {
            return User::orderBy('nickname')->get();

        }

        return User::where('active', 1)->orderBy('nickname')->get();
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
        $user = new User;
        $user->nickname = Input::get('nickname');
        $user->full_name = Input::get('full_name');
        $user->balance = Input::get('balance');
        $user->alcohol_restriction = Input::get('alcohol_restriction');
        $user->email = Input::get('email');
        $user->group_id = Input::get('group_id');
        $user->password = bcrypt('1234');
        $user->save();
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
        $user = User::find($id);
        $user->active = Input::get('active');
        $user->nickname = Input::get('nickname');
        $user->full_name = Input::get('full_name');
        $user->balance = Input::get('balance');
        $user->alcohol_restriction = Input::get('alcohol_restriction');
        $user->email = Input::get('email');
        $user->group_id = Input::get('group_id');
        $user->save();
        return Input::all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
