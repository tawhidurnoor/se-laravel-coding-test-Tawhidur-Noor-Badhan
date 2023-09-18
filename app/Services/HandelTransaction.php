<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HandelTransaction
{
    function getTransaction($transaction_type)
    {

        $transacition = Transaction::where('user_id', Auth::user()->id);

        if ($transaction_type != 'all') {
            $transacition = $transacition->where('transaction_type', $transaction_type);
        }

        return $transacition->get();
    }

    function depositAmount($user_id, $amount){

        $user = User::findOrFail($user_id);

        $transacition = new Transaction();
        $transacition->user_id = $user_id;
        $transacition->transaction_type = 'deposit';
        $transacition->amount = $amount;
        $transacition->fee = 0;

        if ($transacition->save()) {
            $user->balance = $user->balance + $amount;
            $user->save();
            return "saved";
        } else {
            return "error";
        }
        
    }

    function withdrawAmount($user_id, $amount){
        $user = User::findOrFail($user_id);

        $transacition = new Transaction();
        $transacition->user_id = $user_id;
        $transacition->transaction_type = 'withdrawal';
        $transacition->amount = $amount;
        $transacition->fee = $this->feeCalculator($user_id, $amount);

        if ($transacition->save()) {
            $user->balance = $user->balance - ($amount + $transacition->fee);
            $user->save();
            return "saved";
        } else {
            return "error";
        }

    }

    function feeCalculator($user_id, $amount){
        $user = User::findOrFail($user_id);
        $withdrawl_rate = ($user->account_type == 'business') ? 0.025 : 0.015;

        if(date('l') == "Friday"){
            return 0;
        }else{
            if($amount > 1000){
                $currentMonth = now()->format('Y-m-d');
                $this_months_withdrawl = Transaction::where('date', 'like', $currentMonth . '%')
                ->where('transaction_type', 'withdrawal')
                ->where('amount', '>', 0)
                ->sum('amount');
                if($this_months_withdrawl <= 5000){
                    return 0;
                }else{
                    if($user->account_type == 'business' && $this_months_withdrawl > 50000){
                        $withdrawl_rate = 0.015;
                    }
                    return ($this_months_withdrawl - 5000) * ($withdrawl_rate / 100);
                }

            }else{
                return 0;
            }
        }
    }
}
