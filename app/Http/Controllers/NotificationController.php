<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // public function getAllNotifications(){
    // $data=Notification::where('visiblity',1)->get();
    // if(!empty($data)){
    //     return response()->json(['status'=>'true','msg'=>'Notification Found !!','data'=>$data]);

    // }
    // }
    public function getAllNotificationsbyuser(Request $request){

        $user_token=$request->input('user_token')??'';
       if($user_token==""){
        $data=Notification::where('visiblity',1)->get();
        if(!empty($data)){
            return response()->json(['status'=>'true','msg'=>'Notification Found !!','data'=>$data]);

        }

       }

        $data=Notification::where(['user_token'=>$user_token,'visiblity'=>1])->get();

        if($data){
            return response()->json(['status'=>'true','msg'=>'Notification Found for the user!!','data'=>$data]);

        }

    }
}
