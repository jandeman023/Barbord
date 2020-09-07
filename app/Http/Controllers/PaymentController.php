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
        if (isset($_GET["start"]) && isset($_GET['amount']) && isset($_GET['userId'])) {
            $userId = $_GET['userId'];
            $amount = $_GET['amount'];
            $transactionCosts = 39;

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
            $arrArguments['amount'] = $amount + $transactionCosts;
            $arrArguments['ipAddress'] = $_SERVER['REMOTE_ADDR'];
            $arrArguments['finishUrl'] = 'https://bar-api.scoutingbrigitta.nl/api/v1/payment?process&amount=' . $amount . '&userId=' . $userId;
            $arrArguments['paymentOptionId'] = 10;

            # Prepare complete API URL
            $strUrl = $strUrl . http_build_query($arrArguments);

            # Get API result
            $strResult = @file_get_contents($strUrl);
            $jsonResult = json_decode($strResult, true);
            $paymentUrl = $jsonResult['transaction']['paymentURL'];
            return redirect($paymentUrl);
        }

        if (isset($_GET["process"]) && isset($_GET['amount']) && isset($_GET['userId']) && $_GET['orderStatusId'] == 100) {
            $request = new Request();
            $request->request->add([
                'id' => $_GET['userId'],
                'amount' => $_GET['amount'],
                'payOrderId' => $_GET['orderId']
            ]);
            return $this->store($request);
        }

        if (isset($_GET["process"]) && isset($_GET['amount']) && isset($_GET['userId']) && $_GET['orderStatusId'] !== 100) {
            return "Iets ging er mis. Of met de betaling of met het systeem. Wanneer er toch geld van uw bankerekening is afgehaald, contact dan de admin van dit barsysteem.";
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

        $id = $request->request->get('id');
        $amount = $request->request->get('amount');
        if ($request->request->get('payOrderId')) {
            $payOrderId = $request->request->get('payOrderId');

            if (Payment::where('pay_order_id', '=', $payOrderId)->exists()) {
                return "Uw nieuwe balance is al toegevoegd aan uw saldo.";
            }
        }

        $oldBalance = User::find($id)->balance;
        $newBalance = $oldBalance + $amount;

        $payment = new Payment;
        $payment->user_id = $id;
        $payment->old_balance = $oldBalance;
        $payment->new_balance = $newBalance;
        $payment->amount = $amount;
        if ($request->request->get('payOrderId')) {
            $payment->pay_order_id = $payOrderId;
        }
        $payment->save();

        $user = User::find($id);
        $user->balance = $newBalance;
        $user->save();

        if ($request->request->get('payOrderId')) {
            return "Uw betaalde bedrag is met succes toegevoegd aan uw saldo";
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
