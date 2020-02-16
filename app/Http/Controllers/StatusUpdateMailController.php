<?php

namespace App\Http\Controllers;

use App\Mail\StatusUpdate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StatusUpdateMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with([
            'orders' => function ($orders) {
                $orders->whereBetween('orders.created_at',
                    [Carbon::now()->startOfMonth()->subMonth(), Carbon::now()->firstOfMonth()]);
            },
            'orders.products'
        ])->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new StatusUpdate($user));
        }

        return "mails has been send";
    }
}
