<?php

namespace App\Http\Controllers;
use App\Models\bo;
use App\Models\data;
use App\Models\Messages;
use App\Models\product1;
use App\Models\refer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EleController
{
    public function listelect()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mobile.primedata.com.ng/api/listelect',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => array('service' => 'electricity'),
            CURLOPT_HTTPHEADER => array(
                'apikey: PRIME6251e00adbc770.70038796'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        return $response;
        $data = json_decode($response, true);
        $plan= $data["data"];
        foreach ($plan as $pla) {
            $name = $pla['network'];
            $code = $pla['cat_id'];
//return $response;
            $bo = data::create([
                'plan_id' => 'electricity',
                'plan' => 'elect',
                'network' => $name,
                'amount' => '0',
                'tamount' => '0',
                'cat_id' => $code,
            ]);
        }
    }
    public function electric(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = product1::where('product_type', 'nepa')->get();

            return  view('elect', compact('user', 'tv'));

        }
        return redirect("login")->withSuccess('You are not allowed to access');

    }
    public function verifyelect(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = product1::where('id', $request->network)->first();

//return $tv;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL =>'https://test.mcd.5starcompany.com.ng/api/reseller/validate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('service' => 'electricity','coded' => $tv->networkcode,'phone' => $request->phone),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'

                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            return $response;
            $data = json_decode($response, true);
            $success= $data["success"];
            $name=$data["data"];
            if ($success = 1){
                $log=$name;
            }else{
                $log= "Unable to Identify meter Number";
            }
            $success=null;

            return view('payelect', compact('log', 'request', 'name', 'tv'));


        }
    }
    public function payelect(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = product1::where('id', $request->id)->first();


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
                $gt = $user->wallet - $request->amount;


                $user->wallet = $gt;
                $user->save();
                $resellerURL = 'https://app.mcd.5starcompany.com.ng/api/reseller/';


                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL =>$resellerURL.'pay',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('service' => 'electricity','coded' => $tv->networkcode,'phone' => $request->number,'amount' => $request->amount),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: mcd_key_LSZBmNAqN8XKmWhwxUnCMx12HCbR7Nlp'

                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
//                return $response;

                $data = json_decode($response, true);
                $success = $data["success"];


//                        return $response;
                if ($success == 1) {
                    $tran1 = $data["discountAmount"];
                    $tran2 = $data["token"];

                    $bo = bo::create([
                        'username' => $user->username,
                        'plan' => $tv->details,
                        'amount' => $request->amount,
                        'server_res' => $response,
                        'result' => $success,
                        'phone' => $request->number,
                        'refid' => $request->refid,
                        'discountamoun' => $tran1,
                        'token' => $tran2,
                    ]);


                    $name = $tv->product_type1;
                    $am = $tv->details."was Successful to";
                    $ph = $request->number."| Token:".$tran2;

                    $receiver = $user->email;
                    $admin = 'admin@primedata.com.ng';
                    $admin1 = 'primedata18@gmail.com';

//                    Mail::to($receiver)->send(new Emailtrans($bo));
//                    Mail::to($admin)->send(new Emailtrans($bo));
//                    Mail::to($admin1)->send(new Emailtrans($bo));

                    return view('bill', compact('user', 'name', 'am', 'ph', 'success'));


                }elseif ($success==0){
                    $zo=$user->balance+$tv->tamount;
                    $user->balance = $zo;
                    $user->save();

                    $name= $tv->product_type1;
                    $am= "NGN $request->amount Was Refunded To Your Wallet";
                    $ph=", Transaction fail";

                    return view('bill', compact('user', 'name', 'am', 'ph', 'success'));

                }
            }
        }
    }
}
