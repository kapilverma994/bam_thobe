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
use App\Models\Answer;
use Validator;
use DB;
use Hash;
use Mail;
use App\Traits\ApiResponseHelper;

class MockExam extends Controller
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
                $category = MockCategory::select('*')->where(['status'=>1])->get();
                foreach ($category as $row)
                {
                    $question = MockQuestion::select('*')->where(['categories_id'=>$row->id,'status'=>1,'unpremium'=>1])->get();
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
                $subcategory = MockSubcategory::select('*')->where(['category_id'=>$id,'status'=>1])->get();
                foreach ($subcategory as $row)
                {
                    $question = MockQuestion::select('*')->where(['sub_categories_id'=>$row->id,'status'=>1])->get();
                    $total=count($question);
                    $row->question=$total;

                    $answer = Answer::select('*')->where(['token'=>$token,'sub_category'=>$row->id,'status'=>1])->get();
                    $ans=count($answer);
                    $perc=0;
                    if(!empty($ans))
                    {
                        $perc=($ans*100)/$total;
                    }
                    $row->percentage=round($perc);
                }
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
                $question = MockQuestion::select('*')->where(['sub_categories_id'=>$id,'status'=>1,'unpremium'=>1])->get();
                
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

    public function reset($subject_id)
    {
      $headers = apache_request_headers();
        $token=$headers['Authorization'];
        
        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {
                $update = Answer::where('token', $token)->where('sub_category',$subject_id)->update(
            [
              'status' =>0,
            ]);
                return $this->successResponse(0, 'Reset successfully!', $this->success());
        }
        else
        {
            return $this->successResponse($get_student, 'Token Does not match!', $this->failed());
        }
    }

    public function answer(Request $request)
    {
      $headers = apache_request_headers();
        $token=$headers['Authorization'];

        $sid=$request->subject_id;
        $qid=$request->question_id;
        $aid=$request->answer;
        $get_student = Student::select('*')->where(['token'=>$token])->first();
        if(!empty($get_student))
        {       
                $question=explode(',',$qid);
                $answer=explode(',',$aid);
                $useranswer=0;
                foreach ($question as $row)
                {
                    $question = MockQuestion::select('*')->where(['id'=>$row,'status'=>1,'unpremium'=>1])->first();
                    $result=0;
                    $cans=$answer[$useranswer];
                    
                    if($cans==$question->answer)
                    {
                        $result=1;
                    }
                    $answerdata= new Answer();
                    $answerdata->sub_category=$sid;
                    $answerdata->question=$qid;
                    $answerdata->user_answer=$aid;
                    $answerdata->correct_answer=$question->answer;
                    $answerdata->result=$result;
                    $answerdata->token=$token;
                    $answerdata->date=date('d-m-Y');
                    $answerdata->save();
                    $useranswer++;
                }
                return $this->successResponse(0, 'Answer successfully!', $this->success());
        }
        else
        {
            return $this->successResponse($get_student, 'Token Does not match!', $this->failed());
        }
    }
}