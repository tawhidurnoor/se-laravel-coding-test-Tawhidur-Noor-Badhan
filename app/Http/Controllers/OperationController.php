<?php

namespace App\Http\Controllers;

use App\Services\HandelTransaction;
use Illuminate\Http\Request;

class OperationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    function deposit()
    {
        $transaction = new HandelTransaction();
        $transactions = $transaction->getTransaction('deposit');
        return view('deposit', [
            'transactions' => $transactions,
        ]);
    }

    function depositMoney(Request $request)
    {
        $handel_transaction = new HandelTransaction();
        $deposit = $handel_transaction->depositAmount($request->user_id, $request->deposit_amount);
        if ($deposit == "saved") {
            return redirect()->back()->with("message",  "Deposit Successfull");
        } else {
            return redirect()->back()->with("message",  "Deposit Unsuccessfull");
        }
    }

    function withdrawal()
    {
        $transaction = new HandelTransaction();
        $transactions = $transaction->getTransaction('withdrawal');
        return view('withdrawal', [
            'transactions' => $transactions,
        ]);
    }

    function withdrawalMoney(Request $request)
    {
        $handel_transaction = new HandelTransaction();
        $withdraw = $handel_transaction->withdrawAmount($request->user_id, $request->withdraw_amount);
        if ($withdraw == "saved") {
            return redirect()->back()->with("message",  "Withdrawn Successfull");
        } else {
            return redirect()->back()->with("message",  "Withdrawal Unsuccessfull");
        }
    }
}
