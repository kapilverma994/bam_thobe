<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\NotificationTrait;
use function GuzzleHttp\json_decode;
use Auth, Validator;
use App\Models\Notification;
use Carbon\Carbon;

class OrderController extends Controller
{

    use NotificationTrait;
    public function testingNotification()
    {
        $sender_data = Auth::user();
        $push_notification_sender = array();
        $push_notification_sender['device_token'] = $sender_data->device_token;
        $push_notification_sender['title'] = 'Testing notification';
        $push_notification_sender['notification'] = 'Testing notification body';

        // $notification_sender = array();
        // $notification_sender['user_id'] = $sender_data->id;
        // $notification_sender['txn_id'] = 'TESTNOTIFICATION123';
        // $notification_sender['title'] = 'Testing notification';
        // $notification_sender['notification'] = 'Testing notification body';
        // $notification = new notification();
        // $notification_id = $notification->makeNotifiaction($notification_sender);

        $push_notification_sender_result = $this->pushNotification($push_notification_sender);
        return response()->json(['message' => 'Testing notification', 'status' => true], $this->successStatus);
    }

    public function all_orders(){
 $orders=  Order::with('users','customer_address','custom_cart')->groupBy('order_number')->get();

// foreach($orders as $odd){
//     $pen=Order::where(['order_number'=>$odd->order_number])
//    ->where('pending_amount','!=',0) 
//     ->first();
   
//     $odd->pending=$pen;
// }



  return view('admin.orders.index',compact('orders'));
    }

    public function all_ongoing_orders(){
        $orders=Order::with('products','users')->where('status',1)->get();
        return view('admin.orders.ongoing_order',compact('orders'));
    }

    public function delay_order(){
       $date= Carbon::now()->format('Y-m-d');
       
          $orders=  Order::with('users','customer_address')->where('estimate_delivery','<',$date)->groupBy('order_number')->get();
     
      return view('admin.orders.delay_order',compact('orders'));
    }


    public function update_delivery_status(Request $request,$status,$id){
        // dd($request->status);
Order::where('id',$id)->update(['delivery_status'=>$status]);
$notification = array(
    'message' => 'Status Updated Successfully!',
    'alert-type' => 'success'
);
$order_data=Order::find($id);
$sender_data=User::where('token',$order_data->token)->first();


if($order_data->delivery_status==2){
$val="Packed";
}elseif($order_data->delivery_status==3){
$val="Shipped";
}elseif($order_data->delivery_status==4){
$val="Delivered";
}else{
    $val="";
}
if (isset($sender_data->device_token)) {
    $push_notification_sender = array();
    $push_notification_sender['device_token'] = $sender_data->device_token;
    $push_notification_sender['title'] = 'Order '.$val;
    $push_notification_sender['page_token'] = $order_data->sorder_number;
    $push_notification_sender['notification'] = 'Your order has been ' .$val;

// dd($push_notification_sender);
    $push_notification_sender_result = $this->pushNotification($push_notification_sender);
}
$notification_sender = array();
$notification_sender['user_token'] =$order_data->token;
$notification_sender['txn_id'] = $order_data->sorder_number;
$notification_sender['title'] = 'Order '.$val;
$notification_sender['notification'] = 'Your order has been ' .$val;
$notifications = new Notification();
$notification_id = $notifications->makeNotifiaction($notification_sender);
  return redirect()->back()->with($notification);
    }


    public function update_status($status,$id){
      DB::table('orders')->where('order_number',$id)->update(['status'=>$status]);

        $notification = array(
            'message' => 'Status Updated Successfully!',
            'alert-type' => 'success'
        );


        $order_data=Order::where('order_number',$id)->first();

        $sender_data=User::where('token',$order_data->token)->first();


      
        if($order_data->status==1){
            $val="Confirmed";  
        }
        elseif($order_data->status==2){
            $val="Cancelled";  
        }
        
        else{
            $val="";
        }
        if (isset($sender_data->device_token)) {
            $push_notification_sender = array();
            $push_notification_sender['device_token'] = $sender_data->device_token;
            $push_notification_sender['title'] = 'Order '.$val;
            $push_notification_sender['page_token'] = $order_data->order_number;
            $push_notification_sender['notification'] = 'Your order has been ' .$val;

        // dd($push_notification_sender);
            $push_notification_sender_result = $this->pushNotification($push_notification_sender);
        }
        $notification_sender = array();
        $notification_sender['user_token'] =$order_data->token;
        $notification_sender['txn_id'] = $order_data->order_number;
        $notification_sender['title'] = 'Order '.$val;
        $notification_sender['notification'] = 'Your order has been ' .$val;
        $notifications = new Notification();
        $notification_id = $notifications->makeNotifiaction($notification_sender);


          return redirect()->route('order_list')->with($notification);
    }

    public function suborderworkstatus(Request $request)
    {
        $idd = $request->id;
        $newid=explode(',', $idd);
        $res=DB::table('orders')->where('id',$newid[1])->update(['work_status'=>$newid[0]]);
    }
    public function view_detail($id=null){
$orders=Order::where('order_number',$id)->with('products','users','customer_gift_cart','custom_cart')->get();
return view('admin.orders.detail',compact('orders'));
    }
    public function total_order(){
        $orders=Order::latest()->groupBy('order_number')->get();
        return view('admin.orders.index',compact('orders'));
    }
    public function pending_order(){
        $orders=Order::latest()->where('status',0)->groupBy('order_number')->get();
        return view('admin.orders.index',compact('orders'));
    }
    public function confirm_order(){
        $orders=Order::latest()->where('status',1)->groupBy('order_number')->get();
        return view('admin.orders.index',compact('orders'));
    }
    public function cancel_order(){
        $orders=Order::latest()->where('status',2)->groupBy('order_number')->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function delivered_order(){
        $orders=Order::latest()->where('delivery_status',4)->groupBy('order_number')->get();
        return view('admin.orders.index',compact('orders'));
    }


}
