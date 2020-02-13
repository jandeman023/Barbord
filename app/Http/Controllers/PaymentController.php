<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\User;
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        pay.nl integration
        if (isset($_GET["start"])) {
            # Setup API Url
            $payData['format'] = 'json';
            $payData['tokenid'] = 'AT-0052-2517';
            $payData['token'] = '92e21b7454fb01556b60a07fef9f5bec7420a80d';
            $payData['gateway'] = 'rest-api.pay.nl';
            $payData['namespace'] = 'Transaction';
            $payData['function'] = 'start';
            $payData['version'] = 'v14';

            $strUrl = 'http://' . $payData['tokenid'] . ':' . $payData['token'] . '@' . $payData['gateway'] . '/' . $payData['version'] . '/' . $payData['namespace'] . '/' .
                $payData['function'] . '/' . $payData['format'] . '?';

            # Add arguments
            $arrArguments = array();
            $arrArguments['serviceId'] = 'SL-6778-8391';
            $arrArguments['amount'] = 1234;
            $arrArguments['ipAddress'] = $_SERVER['REMOTE_ADDR'];
            $arrArguments['finishUrl'] = 'https://bar-new.scoutingbrigitta.nl/';
            $arrArguments['paymentOptionId'] = 10;

            # Prepare complete API URL
            $strUrl = $strUrl . http_build_query($arrArguments);

            # Get API result
            $strResult = @file_get_contents($strUrl);
            return $strResult;
        }
        return Payment::with('User:id,full_name')->orderByDesc('created_at')->get();
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
        $id = Input::get('id');
        $amount = Input::get('amount');

        $oldBalance = User::find($id)->balance;
        $newBalance = $oldBalance + $amount;

        $payment = new Payment;
        $payment->user_id = $id;
        $payment->old_balance = $oldBalance;
        $payment->new_balance = $newBalance;
        $payment->amount = $amount;
        $payment->save();

        $user = User::find($id);
        $user->balance = $newBalance;
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
