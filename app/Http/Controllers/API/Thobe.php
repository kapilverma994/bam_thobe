<?php
/**
 * File name: UserAPIController.php
 * Last modified: 2020.06.11 at 12:09:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */
namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Student;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Measurment;
use App\Models\Review;
use App\Models\Cart;
use App\Models\Gift;
use App\Models\Loyality;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Gift_cart;
use App\Models\Thobe_cart;
use App\Models\Thobe_Button_management;
use App\Models\Thobe_fabric_management;
use App\Models\Collar_managment;
use App\Models\Pocket;
use App\Models\Cuff;
use App\Models\Thobe_Add_Model;
use App\Models\Front_style;
use App\Models\Setting;
use App\Models\Terms;
use Validator;
use DB;
use Hash;
use Mail;
use App\Traits\ApiResponseHelper;
use Image;

class Thobe extends Controller
{
   use ApiResponseHelper;
    /**
     * Register User
     * @param token
     * @return message
     * author:Kundan Kuamr
     * Date:05/01/2020
     */
    
    public function apikey()
    {
        $setting = Setting::all();
      
        if(!empty($setting))
        {   
            foreach ($setting as $row)
            {
              $apikey=$row->apikey;
            }
            return $this->successResponse($apikey, 'API KEY!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'API KEY empty!', $this->failed());
        }
        
    }

    public function termsandcondition()
    {
        $terms = Setting::all();
      
        if(!empty($terms))
        {   
            
            return $this->successResponse($terms, 'Terms and condition!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'Terms and condition empty!', $this->failed());
        }
        
    }

    public function fabric()
    {
        $fabric = Thobe_fabric_management::select('*')->where(['status'=>1])->get();
      
        if(!empty($fabric))
        {   
          $url = url("/");
            foreach ($fabric as $row)
            {
              $row->image=$url.'/public/uploads/fabric/'.$row->image;
            }
            return $this->successResponse($fabric, 'Fabric get successfully!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'fabric empty!', $this->failed());
        }
        
    }

    public function contact_us(Request $request)
    {

$validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'mobile' => ['required'],
            'message' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }
        
                  $contact  = new Contact;
                    $contact->name = $request->name;
                    $contact->email = $request->email;
                    $contact->mobile = $request->mobile;
                    $contact->message = $request->message;
                    $contact->save();
                    $name=$request->name;
                    $email=$request->email;
                    $mobile=$request->mobile;
                    $message=$request->message;
                    $emailto='mail4upky.com';
    Mail::send('contact_us', ['email'=>$email,'firstname'=>$name,'mobile'=>$mobile,'messaget'=>$message], function ($m) use ($email,$name,$mobile,$message) {
                $m->from('kundan.adsandurl@gmail.com', 'Support');
                $m->to($email,$name)->subject('Contact us Successfully Send');
                });
    $user=(object) array();
           return $this->successResponse($user, ' Contact us successfully!', $this->success());
        
    }

    public function collar()
    {
        $collar = Collar_managment::select('*')->where(['status'=>1])->get();
      
        if(!empty($collar))
        {   
          $url = url("/");
            foreach ($collar as $row)
            {
              $row->image=$url.'/public/uploads/collar/'.$row->image;
              $row->visible_image=$url.'/public/uploads/collar/'.$row->visible_image;
            }
            return $this->successResponse($collar, 'Collar get successfully!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'Collar empty!', $this->failed());
        }
        
    }

    public function cuffs()
    {
        $cuff = Cuff::select('*')->where(['status'=>1])->get();
      
        if(!empty($cuff))
        {   
          $url = url("/");
            foreach ($cuff as $row)
            {
              $row->image=$url.'/public/uploads/cuff/'.$row->image;
              $row->visible_image=$url.'/public/uploads/cuff/'.$row->visible_image;
            }
            return $this->successResponse($cuff, 'Cuffs get successfully!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'Cuffs empty!', $this->failed());
        }
        
    }

    public function thobe_model()
    {
        $model = Thobe_Add_model::select('*')->where(['status'=>1])->get();
      
        if(!empty($model))
        {   
          $url = url("/");
            foreach ($model as $row)
            {
              $row->image=$url.'/public/uploads/model/'.$row->image;
              // $row->visible_image=$url.'/public/uploads/model/'.$row->visible_image;
            }
            return $this->successResponse($model, 'Thobe Model get successfully!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'Thobe Model empty!', $this->failed());
        }
        
    }
    public function branch()
    {
        $branch = Branch::all();
      
        if(!empty($branch))
        {   
            return $this->successResponse($branch, 'Branch get successfully!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'Branch empty!', $this->failed());
        }
        
    }

    public function measurments()
    {
        $measurments = Measurment::all();
      
        if(!empty($measurments))
        {   
            return $this->successResponse($measurments, 'Measurments get successfully!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'Measurments empty!', $this->failed());
        }
        
    }
    public function loyalitys()
    {
      $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            //$loyalitys = Loyality::all();
            $loyalitys = Loyality::select('*')->where(['token'=>$token,'status'=>1])->get();
          
            if(!empty($loyalitys))
            {   
              $points=0;
                  $points=$points+$user->loyality_point;
                $sdata=array('total_points'=>$points,'list'=>$loyalitys);
                return $this->successResponse($sdata, 'Loyality get successfully!', $this->success());
            }
            else
            {
              $data=array();
              return $this->errResponse($data, 'Loyality empty!', $this->failed());
            }
        }
        else
        {
          $user=array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function loyalitys_apply()
    {
      $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            $cart = Cart::where(['token'=>$token,'status'=>1])->update(
                            [
                              'points_price' =>$user->loyality_point,
                            ]);
            $update = User::where(['token'=>$token])->update(
                            [
                              'loyality_point' =>0,
                            ]);
            return $this->successResponse($user, 'Loyality apply successfully!', $this->success());
            
        }
        else
        {
          $user=array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function pocket()
    {
        $pocket = Pocket::select('*')->where(['status'=>1])->get();
      
        if(!empty($pocket))
        {   
          $url = url("/");
            foreach ($pocket as $row)
            {
              $row->image=$url.'/public/uploads/pocket/'.$row->image;
              $row->visible_image=$url.'/public/uploads/pocket/'.$row->visible_image;
            }
            return $this->successResponse($pocket, 'Pocket get successfully!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'Pocket empty!', $this->failed());
        }
        
    }

    public function button()
    {
        $button = Thobe_Button_management::select('*')->where(['status'=>1])->get();
      
        if(!empty($button))
        {   
          $url = url("/");
            foreach ($button as $row)
            {
              $row->image=$url.'/public/uploads/button/'.$row->image;
              $row->visible_image=$url.'/public/uploads/button/'.$row->visible_image;
            }
            return $this->successResponse($button, 'Button get successfully!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'Button empty!', $this->failed());
        }
        
    }

    public function placket()
    {
        $placket = Front_style::select('*')->where(['status'=>1])->get();
      
        if(!empty($placket))
        {   
          $url = url("/");
            foreach ($placket as $row)
            {
              $row->image=$url.'/public/uploads/front_style/'.$row->image;
              $row->visible_image=$url.'/public/uploads/front_style/'.$row->visible_image;
            }
            return $this->successResponse($placket, 'Placket get successfully!', $this->success());
        }
        else
        {
          $data=array();
          return $this->errResponse($data, 'Placket empty!', $this->failed());
        }
        
    }

    public function thobe_cart(Request $request)
    {
         $headers = apache_request_headers();
         $token=$headers['Authorization'];

         $validator = Validator::make($request->all(), [
            'fabric' => ['required'],
            'collar' => ['required'],
            'cuffs' => ['required'],
            'pocket' => ['required'],
            'placket' => ['required'],
            'button' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }

         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
          $image = '';
          if ($request->hasFile('image')) {
              $image = $request->file('image');
              $filename = 'thobeimage' . time() . '.' . $image->getClientOriginalExtension();
              //$location = 'public/uloads/banner/' . $filename;
              $location = 'public/uploads/thobeimage/';
              $image->move($location, $filename);
              $image = $filename;
          }

          $bookingid = rand(1000,9999);
                    $cart  = new Thobe_cart;
                    $cart->fabric = $request->fabric;
                    $cart->image=$image;
                    $cart->collar = $request->collar;
                    $cart->cuffs = $request->cuffs;
                    $cart->pocket = $request->pocket;
                    $cart->placket = $request->placket;
                    $cart->button = $request->button;
                    $cart->side_pocket = $request->side_pocket;
                    $cart->side_pocket_2 = $request->side_pocket_2;
                    $cart->measurement = $request->measurement;
                    $cart->name = $request->name;
                    $cart->mobile = $request->mobile;
                    $cart->booking_id = $bookingid;
                    $cart->date = $request->date;
                    $cart->branch = $request->branch;
                    $cart->measurement_type = $request->measurement_type;
                    $cart->home_address = $request->address;
                    $cart->token = $token;
                    $cart->save();
                $user = Thobe_cart::select('*')->where(['token'=>$token])->orderBy('id', 'DESC')->first();
                return $this->successResponse($user, ' Thobe add to cart successfully!', $this->success());
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
        
    }

    public function ongoing_appointment()
    {
         $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            // $thobe = Thobe_cart::select('*')->where(['status'=>1,'token'=>$token,'older_status'=>0])->orderBy('id','DESC')->get();
          $thobe=Thobe_cart::leftjoin('branches', 'thobe_carts.branch', '=', 'branches.id')
                ->where('thobe_carts.status',1)
                ->where('thobe_carts.older_status',0)
                ->where('thobe_carts.token',$token)
                ->orderBy('thobe_carts.id', 'DESC')
               ->get(['thobe_carts.*', 'branches.branch','branches.address']);
            $sdata=array();
            foreach ($thobe as $row)
            {
              if($row->measurement_type==0)
              {
                $measurement_type='branch';
                $sdata[]=array('id'=>$row->id,'type'=>$measurement_type,'booking_id'=>$row->booking_id,'store_name'=>$row->branch,'date'=>$row->date,'store_address'=>$row->address,'name'=>$row->name,'mobile'=>$row->mobile,'home_address'=>'');
              }
              else
              {
                $haddress = Address::select('*')->where(['id'=>$row->home_address])->first();
                $addresshome='';
                if(!empty($haddress))
                {
                  $addresshome=$haddress->address;
                }
                $measurement_type='home';
                $sdata[]=array('id'=>$row->id,'type'=>$measurement_type,'booking_id'=>$row->booking_id,'store_name'=>$row->branch,'date'=>$row->date,'store_address'=>'','name'=>$row->name,'mobile'=>$row->mobile,'home_address'=>$addresshome);
              }
              
            }
            return $this->successResponse($sdata, ' Ongoing appointment successfully!', $this->success());
        }
        else
        {
          $user=array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function older_appointment()
    {
         $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            // $thobe = Thobe_cart::select('*')->where(['status'=>1,'token'=>$token,'older_status'=>1])->orderBy('id','DESC')->get();
          $thobe=Thobe_cart::leftjoin('branches', 'thobe_carts.branch', '=', 'branches.id')
                ->where('thobe_carts.status',1)
                ->where('thobe_carts.older_status',1)
                ->where('thobe_carts.token',$token)
                ->orderBy('thobe_carts.id', 'DESC')
               ->get(['thobe_carts.*', 'branches.branch','branches.address']);
            $sdata=array();
            foreach ($thobe as $row)
            {
              if($row->measurement_type==0)
              {
                $measurement_type='branch';
                $sdata[]=array('id'=>$row->id,'type'=>$measurement_type,'booking_id'=>$row->booking_id,'store_name'=>$row->branch,'date'=>$row->date,'store_address'=>$row->address,'name'=>$row->name,'mobile'=>$row->mobile,'home_address'=>'');
              }
              else
              {
                $haddress = Address::select('*')->where(['id'=>$row->home_address])->first();
                $addresshome='';
                if(!empty($haddress))
                {
                  $addresshome=$haddress->address;
                }
                $measurement_type='home';
                $sdata[]=array('id'=>$row->id,'type'=>$measurement_type,'booking_id'=>$row->booking_id,'store_name'=>$row->branch,'date'=>$row->date,'store_address'=>'','name'=>$row->name,'mobile'=>$row->mobile,'home_address'=>$addresshome);
              }
              
            }
            return $this->successResponse($sdata, ' Older appointment successfully!', $this->success());
        }
        else
        {
          $user=array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function request_invoice(Request $request) 
    {
        $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $validator = Validator::make($request->all(), [
            'order_no' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401); 
        }
        $order_no = $request->order_no;
         $user = User::select('*')->where(['token'=>$token])->first();

        if(!empty($user))
        {
          $userr=$user->email;
          if(empty($userr))
          {
            return $this->successResponse($user, ' Email id empty!', $this->success());
          }
          $name=$user->name;
          $order_no=$order_no;
           Mail::send('request_invoice', ['email'=>$userr,'firstname'=>$name,'order_no'=>$order_no], function ($m) use ($userr,$name,$order_no) {
                $m->from('kundan.adsandurl@gmail.com', 'Support');
                $m->to($userr,$name)->subject('Invoice Successfully Send');
                });
           return $this->successResponse($user, ' Invoice successfully!', $this->success());
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }
 }