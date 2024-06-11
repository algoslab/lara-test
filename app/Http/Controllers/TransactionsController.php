<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;



class TransactionsController extends Controller
{
    public function transactions(){

        $user = User::find(Auth::user()->id);
        return view('transactions.index', compact('user'));
    }

    public function deposit_show(){
        $deposits = Transaction::where(['user_id' => Auth::user()->id, 'transaction_type' => 'deposit'])->get();
        return view('transactions.deposit', compact('deposits'));
    }

    public function deposit_post(Request $request){
       $data = $request->validate([
            'amount' => 'required'
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['transaction_type'] = 'deposit';
        $data['fee'] = 0.00; //No fee for deposit.
        $data['date'] = date('Y-m-d');

        Transaction::create($data);
        $user = User::find(Auth::user()->id);
        $total = $user->balance + $data['amount'];
        $user->update(['balance' => $total]);
        return redirect()->back();
    }

    public function withdraw_show(){
        $widthdraws = Transaction::where(['user_id' => Auth::user()->id, 'transaction_type' => 'withdrawal'])->get();
        return view('transactions.withdrawal', compact('widthdraws'));
    }

    public function withdraw_post(Request $request){
       $data = $request->validate([
            'amount' => 'required'
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['transaction_type'] = 'withdrawal';
        $data['fee'] = 0.00; //Fee applies
        $data['date'] = date('Y-m-d');



        Transaction::create($data);
        $user = User::find(Auth::user()->id);
        $total = $user->balance - $data['amount'];
        $user->update(['balance' => $total]);
        return redirect()->back();
    }
}
