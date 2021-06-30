<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }



    public function saveToken(Request $request)
    {
      
        User::where('type','admin')->update(['device_token'=>$request->token]);

        return response()->json(['token saved successfully.']);
    }

    public function sendNotification(Request $request)
    {
      
        $token = "eKj0IkWutrM:APA91bF5PqSV4_szxBLuFa3cH2vuB7O21xwqzrmmLNB3tN73GVmzDhV8vhiDWWW-t5xvDNIhEdN6kdzBUBV0FsiNSxwfwbYTyDyaE2JSzfDHKfx7lNf2BaNlX-_pB3sjKZ2G0ZaUwx89";
        $from = "AAAAfnchDvA:APA91bEzRs2gjQI9wg068_iYHnsruSzJ6ckaIqBlGTD8xMnkypuZiJxaB6zsOMSEmnybHDKBQIX35pVpcn0ZHjPh2cqM58ZZRe1t9m_bq0XzukUbGkEgqD0myFdDcTK9JxkyB20X-ewu";
        $msg = array
              (
                'body'  => $request->body,
                'title' => $request->title,
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        // dd($result);
        curl_close( $ch );
        return redirect()->back();




    }
}
