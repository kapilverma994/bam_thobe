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
use App\Models\Student;
use Validator;
use DB;
use Hash;
use Mail;
use App\Traits\ApiResponseHelper;
use  Image;

class StudentsApi extends Controller
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
            'email' => ['required','email','unique:students'],
            'username' => ['required','unique:students'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }
             $token = bin2hex(openssl_random_pseudo_bytes(64));
             $student  = new Student ;
             $student->name = $request->name;
             $student->email = $request->email;
             $student->username = $request->username;
             $student->token = $token;
             $student->password = Hash::make($request->password);
             $student->device_token = $request->device_token;
             $student->date = date('d-m-Y');
             $user = $student->save();
             $user_data = Student::select('*')->where(['email'=>$request->email])->first();
             if(!empty($user_data->practice_day))
                    {
                        $practice_day=explode(',',$user_data->practice_day);
                        $user_data->practice_day=$practice_day;
                    }
                    else
                    {
                        $user_data->practice_day=array();
                    }

                    if(!empty($user_data->choose_option))
                    {
                        $choose_option=explode(',',$user_data->choose_option);
                        $user_data->choose_option=$choose_option;
                    }
                    else
                    {
                        $user_data->choose_option=array();
                    }
             // $response = array('error_code' =>0, 'message' => 'registration successfully!');
             return $this->successResponse($user_data, 'registration successfully!', $this->success()); 
    }

    public function login(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'email' => ['required', 'email'],
        'password' => ['required'],
        ]); 
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation());            
        }
        if($request->email) {
            $token = bin2hex(openssl_random_pseudo_bytes(64));

            Student::where('email', $request->email)->update(['token' => $token]);

            $user = Student::select('*')->where(['email'=>$request->email,'status'=>1])->first();

            if($user) { 
                if(Hash::check($request->password,$user->password)) {
                    $user_data = Student::select('*')->where(['email'=>$request->email])->first();

                    if(!empty($user_data->name) && !empty($user_data->title) && !empty($user_data->exam_date) && !empty($user_data->practice_day) && !empty($user_data->practice_time) && !empty($user_data->choose_option))
                    {
                        $user_data->personalization="true";
                    }
                    else
                    {
                        $user_data->personalization="false";
                    }

                    if(!empty($user_data->practice_day))
                    {
                        $practice_day=explode(',',$user_data->practice_day);
                        $user_data->practice_day=$practice_day;
                    }
                    else
                    {
                        $user_data->practice_day=array();
                    }

                    if(!empty($user_data->choose_option))
                    {
                        $choose_option=explode(',',$user_data->choose_option);
                        $user_data->choose_option=$choose_option;
                    }
                    else
                    {
                        $user_data->choose_option=array();
                    }
                    
                                         
                    return $this->successResponse($user_data, 'User retrieved successfully!', $this->success());                           
                } else { 
                     return $this->successResponse($user=null, 'Enter valid password!', $this->failed());                   
                }
            } else  {
                     return $this->successResponse($user, 'Email or password does not match!', $this->failed());  
           }
       }
    
    }

    public function personalization(Request $request)
    {
        $headers = apache_request_headers();
        $token=$headers['Authorization'];
        
        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {
           $update = Student::where('token', $token)->update(
            [
              'name' =>$request->name,
              'title' =>$request->title,
              'exam_date' =>$request->exam_date,
              'practice_day' =>$request->practice_day,
              'practice_time' =>$request->practice_time,
              'choose_option' =>$request->choose_option,
            ]);
           if(!empty($update))
           {
                $student_data = Student::select('*')->where(['token'=>$token])->first();
                return $this->successResponse($student_data, 'Student update successfully!', $this->success());
           }
           else
           {
                return $this->successResponse($get_student, 'Student update not successfully!', $this->failed());
           }
        }
        else
        {
            return $this->successResponse($get_student, 'Token Does not match!', $this->failed());
        }
    }

    public function update_profile(Request $request)
    {
        $headers = apache_request_headers();
        $token=$headers['Authorization'];

        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {
            
            if($get_student->email!=$request->email)
            {
                $get_email = Student::select('*')->where(['email'=>$request->email])->first();
                if(!empty($get_email))
                {
                    return $this->successResponse('0', 'Email Id allready exits!', $this->failed());
                }
            }  
           $image=$get_student->image;
            if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'profile'.time().'.'.$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/student/';
            $image->move($location, $filename);
            $image=$filename;
        }

           $update = Student::where('token', $token)->update(
            [
              'name' =>$request->name,
              'lastname' =>$request->lastname,
              'email' =>$request->email,
              'title' =>$request->title,
              'image' =>$image,
            ]);
           if(!empty($update))
           {
                $student_data = Student::select('*')->where(['token'=>$token])->first();
                return $this->successResponse($student_data, 'Student update successfully!', $this->success());
           }
           else
           {
                return $this->successResponse($get_student, 'Student update not successfully!', $this->failed());
           }
        }
        else
        {
            return $this->successResponse($get_student, 'Token Does not match!', $this->failed());
        }
    }

    public function get_profile()
    {
        $headers = apache_request_headers();
        $token=$headers['Authorization'];
        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {        if(!empty($get_student->practice_day))
                {
                     $practice_day=explode(',',$get_student->practice_day);
                     $get_student->practice_day=$practice_day;
                }
                else
                {
                    $get_student->practice_day=array();
                }
                if(!empty($get_student->choose_option))
                {
                    $choose_option=explode(',',$get_student->choose_option);
                    $get_student->choose_option=$choose_option; 
                }
                else
                {
                    $get_student->choose_option=array();
                }
                
            return $this->successResponse($get_student, 'Student data get successfully!', $this->success());
        }
        else
        {
            return $this->successResponse($get_user, 'Token Does not match!', $this->failed());
        }
    }

    function forgot_password(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401); 
        }

        $get_user = Student::select('*')->where(['email'=>$request->email])->first();

        if($get_user) {
                $random_str = '0123456789';
                $shuffle_str = str_shuffle($random_str);
                $password_validate = substr($shuffle_str, 0, 4);
               // $original_password = Hash::make($password_validate);

                $messageMsg = urlencode("Your Password is: $password_validate");
                $user = $request->email;
                $name = $get_user->name;
                $message = $password_validate;
                Mail::send('forgot_password', ['email'=>$user,'firstname'=>$name,'otp'=>$password_validate], function ($m) use ($user,$name,$password_validate) {
                $m->from('kundan.adsandurl@gmail.com', 'Support');
                $m->to($user,$name)->subject('Registration Successfully');
                });
                Student:: where('email',$request->email)
                           // ->update(['password_validate'=> $password_validate,'password'=>$original_password]);
                            ->update(['password_validate'=> $password_validate]);

                 return $this->successResponse($password_validate, 'Your otp has been sent on your email !', $this->success());
        } else {

                 return $this->successResponse($get_user, 'Invalid email!', $this->failed());  
        } 
    }

    function verify_otp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'otp' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401); 
        }

        $get_user = Student::select('*')->where(['email'=>$request->email,'password_validate'=>$request->otp])->first();

        if($get_user) {

            return $this->successResponse(0, 'User verified successfully !', $this->success());

        } else {
                return $this->successResponse($get_user, 'Invalid credentials !', $this->failed());  
        } 
    }

    function reset_password(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
            'confirm_password' => ['required'],
            'otp' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401); 
        }
        $get_user_otp = Student::select('*')->where(['email'=>$request->email,'password_validate'=>$request->otp])->first();

        if($get_user_otp) {
        if($request->password  === $request->confirm_password) {

            $get_user = Student::select('*')->where(['email'=>$request->email])->first();

            Student:: where('email',$request->email)
                           // ->update(['password_validate'=> $password_validate,'password'=>$original_password]);
                            ->update(['password'=> Hash::make($request->password)]);
            if($get_user) {

                return $this->successResponse(0, 'Your password reset successfully !', $this->success());
            } else {

                return $this->successResponse($get_user, 'Invalid email !', $this->failed());  
            } 

        } else {
            return $this->successResponse(0, 'Password Does not match!', $this->failed()); 
        }  
        }
        else {
                return $this->successResponse($get_user_otp, 'Invalid credentials !', $this->failed());  
        } 

    }

}