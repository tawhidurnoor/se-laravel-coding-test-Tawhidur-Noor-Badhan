<?php

namespace App\Http\Controllers;

use App\Services\HandelTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $transaction = new HandelTransaction();
            $transactions = $transaction->getTransaction('all');
            return view('index_li',[
                'transactions' => $transactions,
            ]);
        } else {
            return view('index');
        }
    }

    function users() {
        return view('auth.register');
    }
}
