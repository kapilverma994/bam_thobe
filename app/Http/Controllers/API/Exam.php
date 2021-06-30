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
use App\Models\Course;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Category;
use App\Models\MockCategory;
use App\Models\MockSubcategory;
use App\Models\Sub_category;
use App\Models\Question;
use App\Models\MockQuestion;
use App\Models\Sub_admin;
use App\Models\User;
use App\Models\Permission;
use App\Models\Package;
use App\Models\Dictionary;
use Validator;
use DB;
use Hash;
use Mail;
use App\Traits\ApiResponseHelper;

class Exam extends Controller
{
   use ApiResponseHelper;
    /**
     * Register User
     * @param token
     * @return message
     * author:Kundan Kuamr
     * Date:05/01/2020
     */

    public function practice_time(Request $request)
    {
    	$headers = apache_request_headers();
        $token=$headers['Authorization'];
        
        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {
           $update = Student::where('token', $token)->update(
            [
              'practice_minute' =>$request->time,
            ]);
           if(!empty($update))
           {
                $student_data = Student::select('*')->where(['token'=>$token])->first();
                return $this->successResponse($student_data, 'Practice time inserted successfully!', $this->success());
           }
           else
           {
                return $this->successResponse($get_student, 'Practice time inserted not successfully!', $this->failed());
           }
        }
        else
        {
            return $this->successResponse($get_student, 'Token Does not match!', $this->failed());
        }
    }

    public function course()
    {
      $headers = apache_request_headers();
        $token=$headers['Authorization'];
        
        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {
                $category = Category::select('*')->where(['status'=>1])->get();
                foreach ($category as $row)
                {
                    $question = Question::select('*')->where(['categories_id'=>$row->id,'status'=>1,'unpremium'=>1])->get();
                    $qs=count($question);
                    $row->total_question=$qs;
                    $row->read_question=0;
                }
                return $this->successResponse($category, 'Course get successfully!', $this->success());
        }
        else
        {
            return $this->successResponse($get_student, 'Token Does not match!', $this->failed());
        }
    }

    public function subject($id)
    {
      $headers = apache_request_headers();
        $token=$headers['Authorization'];
        
        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {
                $subcategory = Sub_category::select('*')->where(['category_id'=>$id,'status'=>1])->get();
                return $this->successResponse($subcategory, 'Subject get successfully!', $this->success());
        }
        else
        {
            return $this->successResponse($get_student, 'Token Does not match!', $this->failed());
        }
    }

    public function question($id)
    {
      $headers = apache_request_headers();
        $token=$headers['Authorization'];
        
        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {
                $question = Question::select('*')->where(['sub_categories_id'=>$id,'status'=>1,'unpremium'=>1])->get();
                
                foreach ($question as $row)
                {
                    $option=array();
                    $option=array(
                      ['id'=>1,'option'=>$row->optionf],
                      ['id'=>2,'option'=>$row->options],
                      ['id'=>3,'option'=>$row->optiont],
                      ['id'=>4,'option'=>$row->optionfo]
                      );
                    $row->option=$option;
                }
                return $this->successResponse($question, 'Question get successfully!', $this->success());
        }
        else
        {
            return $this->successResponse($get_student, 'Token Does not match!', $this->failed());
        }
    }

    public function answer($sid,$qid,$aid)
    {
      $headers = apache_request_headers();
        $token=$headers['Authorization'];
        
        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {
                $question = Question::select('*')->where(['id'=>$qid,'status'=>1,'unpremium'=>1])->first();
                $option=0;
                
                      $option=$question->answer;
                    
                return $this->successResponse($option, 'Correct answer get successfully!', $this->success());
        }
        else
        {
            return $this->successResponse($get_student, 'Token Does not match!', $this->failed());
        }
    }
}