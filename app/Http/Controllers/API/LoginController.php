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
use App\Models\Cart;
use App\Models\Thobe_cart;
use Validator;
use DB;
use Hash;
use Mail;
use App\Traits\ApiResponseHelper;
use Image;

class LoginController extends Controller
{
   use ApiResponseHelper;
    /**
     * Register User
     * @param token
     * @return message
     * author:Kundan Kuamr
     * Date:05/01/2020
     */


    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'mobile' => ['required'],
            'password' => ['required','confirmed','min:6'],
            'password_confirmation' => ['required','min:6'],
        ]);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }
            $otp=$this->otpgenrate();
            $usermobile = User::select('*')->where(['mobile'=>$request->mobile])->first();
            $useremail = User::select('*')->where(['email'=>$request->email])->first();
            if(!empty($usermobile))
            {
                if($usermobile->verified==1)
                {
                    return $this->errResponse($usermobile, 'All ready mobile registerd!', $this->failed());
                }
                else
                {
                        $this->otp($request->mobile,$otp);
                        User:: where('mobile',$request->mobile)
                          ->update(['otp'=> $otp]);
                        return $this->successResponse($usermobile, 'registration successfully!', $this->success());
                }
            }
             if(!empty($useremail))
             {
                if($useremail->verified==1)
                {
                    return $this->errResponse($useremail, 'All ready email registerd!', $this->failed());
                }
                else
                {
                        $this->otp($useremail->mobile,$otp);
                        User:: where('mobile',$useremail->mobile)
                          ->update(['otp'=> $otp]);
                        return $this->successResponse($useremail, 'registration successfully!', $this->success());
                }
             }
             $device_token=$request->device_token;
             if(empty($device_token))
             {
                $device_token='';
             }
                         $token = bin2hex(openssl_random_pseudo_bytes(64));
                         $user  = new User ;
                         $user->name = $request->name;
                         $user->email = $request->email;
                         $user->mobile = $request->mobile;
                         $user->token = $token;
                         $user->device_token=$device_token;
                         $user->otp = $otp;
                         $user->type = 'user';
                         $user->password = Hash::make($request->password);
                         $userdata = $user->save();
                         $user_data = User::select('*')->where(['email'=>$request->email])->first();
                         $this->otp($request->mobile,$otp);
                        return $this->successResponse($user_data, 'registration successfully!', $this->success());      
    }
     public function otpgenrate()
  {
      $random_str = '0123456789';
      $shuffle_str = str_shuffle($random_str);
      return $otp = substr($shuffle_str, 0, 4);
  }
  public function otp($mobile,$otp)
  {
        $authKey = "309952Aq8MczyMxu5e03001fP1";
$senderId = "ADSURL";
$messageMsg = urlencode("Your OTP is $otp tVbZIwq0taG");
$postData = array(
  'authkey' => $authKey,
  'mobiles' => $mobile,
  'message' => $messageMsg,
  'sender' => $senderId,
  'route' => 4,
  'country' => 91
);
$url = "http://api.msg91.com/api/sendhttp.php";
$ch = curl_init();
curl_setopt_array($ch, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $postData
));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$output = curl_exec($ch);
if (curl_errno($ch)) {
  echo 'error:' . curl_error($ch);
}
curl_close($ch);
    }

    public function otp_verified(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required'],
            'otp' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }
            
             $user = User::select('*')->where(['mobile'=>$request->mobile,'verified'=>0])->first();
             if(!empty($user))
             {
                if($user->otp==$request->otp)
                {
                    User::where('mobile', $request->mobile)->update(['verified' => 1]);
                    return $this->successResponse('', 'Successfully otp verified!', $this->success());
                }
                else
                {
                  return $this->errResponse('', 'OTP not matched!', $this->failed());
                }
             }
             else
             {
                return $this->errResponse('', 'All ready verified!', $this->failed());
             }
             
    }

    public function reset_otp_verified(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required'],
            'otp' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }
            
             $user = User::select('*')->where(['mobile'=>$request->mobile])->first();
             if(!empty($user))
             {
                if($user->otp==$request->otp)
                {
                    User::where('mobile', $request->mobile)->update(['verified' => 1]);
                    return $this->successResponse('', 'Successfully otp verified!', $this->success());
                }
                else
                {
                  return $this->errResponse('', 'OTP not matched!', $this->failed());
                }
             }
             else
             {
                return $this->errResponse('', 'Mobile number not verified!', $this->failed());
             }
             
    }

    function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401); 
        }

        $get_user = User::select('*')->where(['mobile'=>$request->mobile])->first();

        if($get_user) {
                $otp=$this->otpgenrate();
                $mobile = $request->mobile;
                User:: where('mobile',$mobile)
                          ->update(['otp'=> $otp]);
                  $this->otp($mobile,$otp);
                 return $this->successResponse($otp, 'Your otp has been sent on your mobile !', $this->success());
        } else {

                 return $this->errResponse('', 'Invalid mobile!', $this->failed());  
        } 
    }

    function reset_password(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => ['required'],
            'password' => ['required','confirmed','min:6'],
            'password_confirmation' => ['required','min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401); 
        }
        $get_user_otp = User::select('*')->where(['mobile'=>$request->mobile])->first();

        if($get_user_otp) {

            User:: where('mobile',$request->mobile)
                           // ->update(['password_validate'=> $password_validate,'password'=>$original_password]);
                            ->update(['password'=> Hash::make($request->password)]);

                return $this->successResponse($get_user_otp, 'Your password reset successfully !', $this->success());
             
        }
        else {
              $get_user_otp=array();
                return $this->errResponse($get_user_otp, 'Invalid credentials !', $this->failed());  
        } 

    }

    public function login(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'mobile' => ['required'],
        'password' => ['required'],
        ]); 
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation());            
        }
        
            $token = bin2hex(openssl_random_pseudo_bytes(64));

            //User::where('mobile', $request->mobile)->update(['token' => $token]);

            $user = User::select('*')->where(['mobile'=>$request->mobile,'verified'=>1])->first();

            if($user) { 
                if(Hash::check($request->password,$user->password)) {
                    $user_data = User::select('*')->where(['mobile'=>$request->mobile])->first();
                    $cartcheck = Cart::select('*')->where(['token'=>$user_data->token,'status'=>1])->sum('quantity');
                    $cartcheckthobe = Thobe_cart::select('*')->where(['token'=>$user_data->token,'status'=>1])->sum('quantity');
                    $user_data->total_cart=$cartcheck+$cartcheckthobe;
                    $url = url("/");
                    if($user_data->image==NULL){
                        $user_data->image=$url.'/public/uploads/user/user_avatar.png';  
                    }else{
                        $user_data->image=$url.'/public/uploads/user/'.$user_data->image;
                    }
                
                    $device_token=$request->device_token;
             if(empty($device_token))
             {
                $device_token='';
             }
                    $update = User::where(['token'=>$token])->update(
                            [
                              'device_token' =>$device_token,
                            ]);
                    return $this->successResponse($user_data, 'User login successfully!', $this->success());                           
                } else { 
                  $user = (object) array();
                     return $this->errResponse($user, 'Enter valid password!', $this->failed());                   
                }
            } else  {
              $user = (object) array();
                     return $this->errResponse($user, 'mobile number not verified!', $this->failed());  
           }
      
    
    }

    public function update_profile(Request $request)
    {
        $headers = apache_request_headers();
        $token=$headers['Authorization'];

        $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            
            if($user->email!=$request->email)
            {
                $get_email = User::select('*')->where(['email'=>$request->email])->first();
                if(!empty($get_email))
                {
                    return $this->errResponse($user, 'Email Id allready exits!', $this->failed());
                }
            }  
           $image=$user->image;
            if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'profile'.time().'.'.$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/user/';
            $image->move($location, $filename);
            $image=$filename;
        }

           $update = User::where('token', $token)->update(
            [
              'name' =>$request->name,
              'email' =>$request->email,
              'gender' =>$request->gender,
              'image' =>$image,
            ]);
           if(!empty($update))
           {
                $user_data = User::select('*')->where(['token'=>$token])->first();
                return $this->successResponse($user_data, 'User update successfully!', $this->success());
           }
           else
           {
                return $this->errResponse($user, 'User update not successfully!', $this->failed());
           }
        }
        else
        {
          $user=(object) array();
            return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function add_address(Request $request)
    {
      $headers = apache_request_headers();
        $token=$headers['Authorization'];
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'home_type' => ['required'],
            'address' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }

        $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            $address  = new Address;
            $address->name = $request->name;
             $address->user_id = $token;
             $address->address = $request->address;
             $address->home_type = $request->home_type;
             $address->lat = $request->lat;
             $address->lng = $request->lng;
             $addressdata = $address->save();

             return $this->successResponse($user, 'Address add successfully!', $this->success());
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function update_address(Request $request)
    {
      $headers = apache_request_headers();
        $token=$headers['Authorization'];
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'home_type' => ['required'],
            'address' => ['required'],
            'address_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }

        $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            $update = Address::where('id', $request->address_id)->update(
            [
              'name' =>$request->name,
              'home_type' =>$request->home_type,
              'address' =>$request->address,
              'lat' =>$request->lat,
              'lng' =>$request->lng,
            ]);

             return $this->successResponse($user, 'Address update successfully!', $this->success());
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function get_profile()
    {
        $headers = apache_request_headers();
        $token=$headers['Authorization'];
        $get_user = User::select('*')->where(['token'=>$token])->first();
        $url = url("/");
        if(!empty($get_user))
        {               if( $get_user->image==NULL){
            $get_user->image=$url.'/public/uploads/user/user_avatar.png';  
        }else{
            $get_user->image=$url.'/public/uploads/user/'.$get_user->image;
        }
              
                $cartcheck = Cart::select('*')->where(['token'=>$get_user->token,'status'=>1])->sum('quantity');
                $cartcheckthobe = Thobe_cart::select('*')->where(['token'=>$get_user->token,'status'=>1])->sum('quantity');
                    $get_user->total_cart=$cartcheck+$cartcheckthobe;    
            return $this->successResponse($get_user, 'User data get successfully!', $this->success());
        }
        else
        {
            $get_user=(object) array();
            return $this->errResponse($get_user, 'Token Does not match!', $this->failed());
        }
    }

    public function get_address()
    {
        $headers = apache_request_headers();
        $token=$headers['Authorization'];
        $address = Address::select('*')->where(['user_id'=>$token])->get();
        if(!empty($address))
        {                     
            return $this->successResponse($address, 'User address get successfully!', $this->success());
        }
        else
        {
          $address=array();
            return $this->errResponse($address, 'Token Does not match!', $this->failed());
        }
    }

}