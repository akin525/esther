<?php

namespace App\Http\Controllers;

use App\Mail\Emailtrans;
use App\Models\bo;
use App\Models\data;
use App\Models\product1;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AirtimeController
{
    public function airtime(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        if (Auth::check()) {
            $user = User::find($request->user()->id);


            if ($user->wallet < $request->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $user->wallet. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                return view('bill', compact('user', 'mg'));

            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                return view('bill', compact('user', 'mg'));

            }
            $bo = bo::where('refid', $request->refid)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                return view('bill', compact('user', 'mg'));

            } else {
                $user = User::find($request->user()->id);
                $bt = product1::where("id", $request->id)->first();
//return $bt;

                $gt = $user->wallet - $request->amount;


                $user->wallet = $gt;
                $user->save();


                $resellerURL = 'https://app.mcd.5starcompany.com.ng/api/reseller/';
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://test.mcd.5starcompany.com.ng/api/reseller/pay',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('service' => 'airtime', 'coded' => $bt->networkcode, 'phone' => $request->number, 'amount' => $request->amount, 'reseller_price' => $request->amount),

                    CURLOPT_HTTPHEADER => array(
                        'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
                    )));

                $response = curl_exec($curl);

                curl_close($curl);
//                    echo $response;
//    return;
                $data = json_decode($response, true);
                $success = $data["success"];
                $tran1 = $data["discountAmount"];

//                        return $response;
                if ($success == 1) {

                    $bo = bo::create([
                        'username' => $user->username,
                        'plan' => $bt->tittle,
                        'amount' => $request->amount,
                        'server_res' => $response,
                        'result' => $success,
                        'phone' => $request->number,
                        'refid' => $request->refid,
                        'discountamoun' => $tran1,
                    ]);


                    $name = $bt->plan;
                    $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                    $ph = $request->number;

                    $receiver = $user->email;
                    $admin = 'admin@primedata.com.ng';
                    $admin2= 'primedata18@gmail.com';


                    return view('bill', compact('user', 'name', 'am', 'ph', 'success'));

                } elseif ($success == 0) {
                    $zo = $user->balance + $request->amount;
                    $user->balance = $zo;
                    $user->save();

                    $name = $bt->plan;
                    $am = "NGN $request->amount Was Refunded To Your Wallet";
                    $ph = ", Transaction fail";

                    return view('bill', compact('user', 'name', 'am', 'ph', 'success'));

                }
            }
        }
    }
}
