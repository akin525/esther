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
use Illuminate\Support\Facades\Mail;

class TvController
{
    public function listtv(Request $request)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mobile.primedata.com.ng/api/listtv',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => array(),
            CURLOPT_HTTPHEADER => array(
                'apikey: PRIME624fee6e546747.77054028'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        return $response;
        $data = json_decode($response, true);
        $plan= $data["data"];
        foreach ($plan as $pla) {
            $id = $pla['plan_id'];
            $name = $pla['network'];
            $amount = $pla['amount'];
            $code = $pla['cat_id'];
//return $response;
            $bo = data::create([
                'plan_id' => $id,
                'plan' => 'tv',
                'network' => $name,
                'amount' => $amount,
                'tamount' => $amount,
                'cat_id' => $code,
            ]);
        }
    }

    public function verifytv(Request $request)
    {
//        return $request;
        $ve=product1::where('product_type1', $request->network)->first();
//        return $request;
        $pla=product1::where('product_type1',  $request->network)->get();
//return $ve;
        $resellerURL = 'https://app.mcd.5starcompany.com.ng/api/reseller/';



        $curl = curl_init();


        curl_setopt_array($curl, array(

            CURLOPT_URL => $resellerURL.'validate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('service' => 'tv','coded' => $ve->product_type1,'phone' => $request->phone),
            CURLOPT_HTTPHEADER => array(
                'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
            )));
        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
//return $response;
        $data = json_decode($response, true);
        $success= $data["details"]['Customer_Name'];
        if ($success){
            $log=$success;
        }else{
            $log= "Unable to Identify IUC Number";
        }
        return view('tvp', compact('log', 'request', 've', 'request', 'pla'));


    }
    public function process(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = data::where('id', $request->id)->first();

            return  view('selecttv', compact('user', 'request'));

        }
        return redirect("login")->withSuccess('You are not allowed to access');

    }
    public function tv(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = data::where('plan', 'tv')->get();
            return  view('tv', compact('user', 'tv'));

        }return redirect("login")->withSuccess('You are not allowed to access');

    }

    public function paytv(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = product1::where('id', $request->pid)->first();

//return $tv;
            if ($user->wallet < $tv->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $tv->amount . " from your wallet. Your wallet balance is NGN $user->wallet. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                return view('bill', compact('user', 'mg'));

            }
            if ($tv->amount < 0) {

                $mg = "error transaction";
                return view('bill', compact('user', 'mg'));

            }
            $bo = bo::where('refid', $request->refid)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                return view('bill', compact('user', 'mg'));

            } else {
                $gt = $user->wallet - $tv->tamount;


                $user->wallet = $gt;
                $user->save();

                $resellerURL = 'https://mobile.primedata.com.ng/api/';

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $resellerURL.'pay',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('service' => 'tv','coded' => $tv->networkcode,'phone' => $request->number),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: mcd_key_LSZBmNAqN8XKmWhwxUnCMx12HCbR7Nlp'

                    )
                ));

                $response = curl_exec($curl);

                curl_close($curl);
//                    echo $response;
//                return $response;
                $data = json_decode($response, true);
                $success = $data["success"];
//                $tran1 = $data["discountAmount"];

//                        return $response;
                if ($data['success']==1) {

                    $bo = bo::create([
                        'username' => $user->username,
                        'plan' => $tv->details,
                        'amount' => $tv->amount,
                        'server_res' => $response,
                        'result' => 1,
                        'phone' => $request->number,
                        'refid' => $request->refid,
                    ]);

                    $success=1;
                    $name = $tv->product_type1;
                    $am = $tv->details."was Successful to";
                    $ph = $request->number;




                    return view('bill', compact('user', 'name', 'am', 'ph', 'success'));


                }else{
                    $success=0;

                    $zo=$user->wallet+$tv->amount;
                    $user->wallet = $zo;
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
