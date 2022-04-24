<?php

namespace App\Http\Controllers;

use App\Models\charp;
use App\Models\deposit;
use App\Models\setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FundController
{
    public function fund(Request  $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);

            $data2 = setting::get();
            $fund = deposit::where('username', $user->username)->get();


            return view('fund', compact('user',  'fund', 'data2' ));
        }
        return redirect("login")->withSuccess('You are not allowed to access');


    }
    public function tran($reference)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_c1c6b6dc537ee53fee2957d2bee5486370888a7a",
                "Cache-Control: no-cache",
            ),
        ));
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0)

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//             echo $response;
        }
//        return $response;
        $data = json_decode($response, true);
        $amount = $data["data"]["amount"] / 100;
        $auth = $data["data"]["authorization"]["authorization_code"];
// echo $auth;

        if (Auth::check()) {
            $user = Auth::user();
            $pt = $user->wallet;

            $depo = deposit::where('payment_ref', $reference)->first();
            if (isset($depo)) {
                return redirect("dashboard")->withSuccess('Duplicate Transaction');

            } else {
                $char = setting::first();
                $amount1 = $amount - $char->charges;


                $gt = $amount1 + $pt;
                $charp = charp::create([
                    'username' => $user->username,
                    'payment_ref' => $reference,
                    'amount' => $char->charges,
                    'iwallet' => $pt,
                    'fwallet' => $gt,
                ]);

                $deposit = deposit::create([
                    'username' => $user->username,
                    'payment_ref' => $reference,
                    'amount' => $amount,
                    'iwallet' => $pt,
                    'fwallet' => $gt,
                ]);
                $user->wallet = $gt;
                $user->save();
                return redirect("dashboard")->withSuccess('Payment Successful');
            }
        }
    }
}
