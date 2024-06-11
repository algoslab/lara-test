<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;



class TransactionsController extends Controller
{

    public function withdrawal_fee($user_type, $amount){
        if(date("l") != "Friday"){
            if($user_type == 'Individual'){
                $fee = 0.015; //percent
            }elseif($user_type == 'Business'){
                $fee = 0.025; //percent
            }else{
                echo "Something Wrong. Can't proceed!"; exit();
            }
        }else{
            $fee = 0.00; //percent
        }
        

        $max_fee = ($fee * $amount)/100;

        return $max_fee;
    }
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
        $data['fee'] = $this->withdrawal_fee(Auth::user()->account_type, $data['amount']); //Fee applies
        $data['date'] = date('Y-m-d');

        //dd($data);


        $user = User::find(Auth::user()->id);
        $current_balance = $user->balance - ($data['amount'] + $data['fee']);
        if($current_balance < 0){
            echo "Not Enough Balance!"; exit();
        }else{
            Transaction::create($data);
            $user->update(['balance' => $current_balance]);
        }
        
        return redirect()->back();
    }
}
