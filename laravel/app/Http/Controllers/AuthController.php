<?php

namespace App\Http\Controllers;

use App\Models\bill_payment;
use App\Models\bo;
use App\Models\Messages;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\deposit;
use App\Models\product1;
use Illuminate\Support\Facades\Session;


class AuthController
{
    public function dashboard(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $me = Messages::where('status', 1)->first();

            $deposite = deposit::where('username', $request->user()->username)->get();
            $totaldeposite = 0;
            foreach ($deposite as $depo){
                $totaldeposite += $depo->amount;

            }
            $bil2 = bo::where('username', $request->user()->username)->get();
            $bill = 0;
            foreach ($bil2 as $bill1){
                $bill += $bill1->amount;

            }
            return  view('dashboard', compact('user', 'totaldeposite', 'bill', 'deposite',  'me'));
        }
        return redirect("login")->withSuccess('You are not allowed to access');

    }
    public function bill(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);

            $bil2 = bo::where('username', $request->user()->username)->get();
            $bill = 0;
            foreach ($bil2 as $bill1){
                $bill += $bill1->amount;

            }
            return  view('allbill', compact('user',  'bill', 'bil2'));
        }
        return redirect("login")->withSuccess('You are not allowed to access');

    }
    public function select(Request  $request)
    {
        if(Auth::check()){
            $user = User::find($request->user()->id);


            return view('select', compact('user'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function buydata(Request  $request)
    {
        if(Auth::check()){
            $user = User::find($request->user()->id);
            $data = product1::where('status',1 )->where('product_type1', $request->id)->get();

            return view('buydata', compact('user', 'data'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function pre(Request $request)


    {
        $request->validate([
            'id' => 'required',
        ]);
        if(Auth::check()){
            $user = User::find($request->user()->id);
            $data = product1::where('id',$request->id )->get();

            return view('pre', compact('user', 'data'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function airtime(Request  $request)
    {
        if(Auth::check()){
            $user = User::find($request->user()->id);
            $data = product1::where('product_type',"airtime" )->get();

            return view('airtime', compact('user', 'data'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
