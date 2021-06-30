<?php

namespace App\Http\Controllers;

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
use App\Models\Dictionary;
use Session;
use Validator;
use DB;
use Hash;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	return view('admin.course');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('')
                        ->withErrors($validator)
                        ->withInput();
        }
        $email=$request->email;
        $password=$request->password;
        $password=md5($password);
        $subadmin=Sub_admin::Where('email', $email)->where('password', $password)->where('type', 'admin')->get();
        if(count($subadmin)>0)
         {
            foreach ($subadmin as $row)
            {
                $adminid =  Session::put('id', $row->id);
                $fname =  Session::put('id', $row->fname);
                $lname =  Session::put('id', $row->lname);
                $phone =  Session::put('id', $row->phone);
                return view('admin/dashboard');
            }
         }
         else
         {
            redirect('');
         }
         die;
    }

    public function subject()
    {
    	$course=Course::all();
    	return view('admin.subject',compact('course'));
    }

    public function course_list()
    {
        $course=Course::all();
        return view('admin.course_list',compact('course'));
    }

    public function subject_list()
    {
        $subject=Subject::all();
        return view('admin.subject_list',compact('subject'));
    }

    public function students_list()
    {
        $student=Student::orderBy('id', 'DESC')->get();
        return view('admin.students_list',compact('student'));
    }

    public function category()
    {
        $category=Category::orderBy('id', 'DESC')->get();
        return view('admin.category',compact('category'));
    }
    public function category_add()
    {
        return view('admin.category_add');
    }
    public function add_categories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('category')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $categorydata= new Category();
        $categorydata->category_name=$request->category_name;
        $categorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('category')->with($notification);
    }
    public function category_edit($id)
    {
        $category=Category::findOrFail($id);
        return view('admin.category_edit',compact('category'));
    }

    public function category_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('category')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $categorydata= Category::find($request->id);
        $categorydata->category_name=$request->category_name;
        $categorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('category')->with($notification);
    }

    public function category_block($id,$status)
    {
        $categorydata= Category::find($id);
        if($status==1)
        {
            $categorydata->status=0;
            $categorydata->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $categorydata->status=1;
            $categorydata->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('category')->with($notification);
    }

    public function category_delete($id)
    {
        $category=Category::findOrFail($id);
        $category->delete();
        $notification = array(
    'message' => 'delete!', 
    'alert-type' => 'error'
);
        return redirect('category')->with($notification);
    }

    public function dictionary()
    {
        $dictionarie=Dictionary::orderBy('id', 'DESC')->get();
        return view('admin.dictionarie',compact('dictionarie'));
    }
    public function dictionary_add()
    {
        return view('admin.dictionary_add');
    }

    public function add_dictionary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'words' => 'required|unique:dictionaries',
            'meanings' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('dictionary')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $dictionarie= new Dictionary();
        $dictionarie->words=$request->words;
        $dictionarie->meanings=$request->meanings;
        $dictionarie->date=date('d-m-Y');
        $dictionarie->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);

return redirect('dictionary')->with($notification);
    }

    public function dictionary_edit($id)
    {
        $dictionarie=Dictionary::findOrFail($id);
        return view('admin.dictionary_edit',compact('dictionarie'));
    }

    public function dictionary_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'words' => 'required',
            'meanings' => 'required',
        ]);
if ($validator->fails()) {
        $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('dictionary')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $dictionarie= Dictionary::find($request->id);
        $dictionarie->words=$request->words;
        $dictionarie->meanings=$request->meanings;
        $dictionarie->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('dictionary')->with($notification);
    }

    public function dictionary_block($id,$status)
    {
        $dictionarie= Dictionary::find($id);
        if($status==1)
        {
            $dictionarie->status=0;
            $dictionarie->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $dictionarie->status=1;
            $dictionarie->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('dictionary')->with($notification);
    }

    public function practice_block($id,$unpremium)
    {
        $dictionarie= Dictionary::find($id);
        if($unpremium==1)
        {
            $dictionarie->unpremium=0;
            $dictionarie->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $dictionarie->unpremium=1;
            $dictionarie->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('dictionary')->with($notification);
    }

    public function dictionary_delete($id)
    {
        $dictionarie=Dictionary::findOrFail($id);
        $dictionarie->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('dictionary')->with($notification);
    }

    public function permission()
    {
        $permission=Permission::join('sub_admins', 'permissions.sub_admin', '=', 'sub_admins.id')
                ->orderBy('permissions.id', 'DESC')
               ->get(['permissions.*', 'sub_admins.fname']);
        return view('admin.permission',compact('permission'));
    }
    public function permission_add()
    {
        $subadmin=Sub_admin::all();
        return view('admin.permission_add',compact('subadmin'));
    }

    public function add_permission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_admin' => 'required|unique:permissions',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('permission')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $permission= new Permission();
        $permission->sub_admin=$request->sub_admin;
        $permission->practice=$request->practice;
        $permission->mock=$request->mock;
        $permission->student=$request->student;
        $permission->date=date('d-m-Y');
        $permission->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);

return redirect('permission')->with($notification);
    }

    public function permission_edit($id)
    {
        $permission=Permission::findOrFail($id);
        $subadmin=Sub_admin::all();
        $subcategory=MockSubcategory::all();
        return view('admin.permission_edit',compact('permission','subadmin'));
    }

    public function permission_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_admin' => 'required',
        ]);
if ($validator->fails()) {
        $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('permission')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $permission= Permission::find($request->id);
        $permission->sub_admin=$request->sub_admin;
        $permission->practice=$request->practice;
        $permission->mock=$request->mock;
        $permission->student=$request->student;
        $permission->date=date('d-m-Y');
        $permission->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('permission')->with($notification);
    }

    public function permission_block($id,$status)
    {
        $permission= Permission::find($id);
        if($status==1)
        {
            $permission->status=0;
            $permission->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $permission->status=1;
            $permission->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('permission')->with($notification);
    }

    public function permission_delete($id)
    {
        $permission=Permission::findOrFail($id);
        $permission->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('permission')->with($notification);
    }

    public function mock_category()
    {
        $category=MockCategory::orderBy('id', 'DESC')->get();
        return view('admin.mock_category',compact('category'));
    }
    public function mock_category_add()
    {
        return view('admin.mock_category_add');
    }
    public function mock_add_categories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('mock-category')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $categorydata= new MockCategory();
        $categorydata->category_name=$request->category_name;
        $categorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('mock-category')->with($notification);
    }
    public function mock_category_edit($id)
    {
        $category=MockCategory::findOrFail($id);
        return view('admin.mock_category_edit',compact('category'));
    }

    public function mock_category_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
        }

        $categorydata= MockCategory::find($request->id);
        $categorydata->category_name=$request->category_name;
        $categorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('mock-category')->with($notification);
    }

    public function mock_category_block($id,$status)
    {
        $categorydata= MockCategory::find($id);
        if($status==1)
        {
            $categorydata->status=0;
            $categorydata->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $categorydata->status=1;
            $categorydata->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('mock-category')->with($notification);
    }

    public function mock_category_delete($id)
    {
        $category=MockCategory::findOrFail($id);
        $category->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('mock-category')->with($notification);
    }

    public function sub_category()
    {
        //$subcategory=Sub_category::all();
        $subcategory=Sub_category::join('categories', 'sub_categories.category_id', '=', 'categories.id')
        ->orderBy('sub_categories.id', 'DESC')
               ->get(['sub_categories.*', 'categories.category_name']);

        return view('admin.sub_category',compact('subcategory'));
    }
    public function sub_category_add()
    {
        $category=Category::all();
        return view('admin.sub_category_add',compact('category'));
    }
    public function add_sub_categories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('sub-category')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $subcategorydata= new Sub_category();
        $subcategorydata->category_id=$request->category_id;
        $subcategorydata->sub_category=$request->sub_category;
        $subcategorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('sub-category')->with($notification);
    }

    public function sub_category_edit($id)
    {
        $subcategory=Sub_category::findOrFail($id);
        $category=Category::all();
        return view('admin.sub_category_edit',compact('subcategory','category'));
    }

    public function sub_category_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('sub-category')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $subcategorydata= Sub_category::find($request->id);
        $subcategorydata->category_id=$request->category_id;
        $subcategorydata->sub_category=$request->sub_category;
        $subcategorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('sub-category')->with($notification);
    }

    public function sub_category_block($id,$status)
    {
        $subcategorydata= Sub_category::find($id);
        if($status==1)
        {
            $subcategorydata->status=0;
            $subcategorydata->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $subcategorydata->status=1;
            $subcategorydata->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('sub-category')->with($notification);
    }

    public function sub_category_delete($id)
    {
        $subcategory=Sub_category::findOrFail($id);
        $subcategory->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('sub-category')->with($notification);
    }


    public function mock_sub_category()
    {
        //$subcategory=Sub_category::all();
        $subcategory=MockSubcategory::join('mock_categories', 'mock_subcategories.category_id', '=', 'mock_categories.id')
        ->orderBy('mock_subcategories.id', 'DESC')
               ->get(['mock_subcategories.*', 'mock_categories.category_name']);

        return view('admin.mock_sub_category',compact('subcategory'));
    }
    public function mock_sub_category_add()
    {
        $category=MockCategory::all();
        return view('admin.mock_sub_category_add',compact('category'));
    }
    public function mock_add_sub_categories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('mock-sub-category')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $subcategorydata= new MockSubcategory();
        $subcategorydata->category_id=$request->category_id;
        $subcategorydata->sub_category=$request->sub_category;
        $subcategorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('mock-sub-category')->with($notification);
    }

    public function mock_sub_category_edit($id)
    {
        $subcategory=MockSubcategory::findOrFail($id);
        $category=MockCategory::all();
        return view('admin.mock_sub_category_edit',compact('subcategory','category'));
    }

    public function mock_sub_category_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('mock-sub-category')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $subcategorydata= MockSubcategory::find($request->id);
        $subcategorydata->category_id=$request->category_id;
        $subcategorydata->sub_category=$request->sub_category;
        $subcategorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('mock-sub-category')->with($notification);
    }

    public function mock_sub_category_block($id,$status)
    {
        $subcategorydata= MockSubcategory::find($id);
        if($status==1)
        {
            $subcategorydata->status=0;
            $subcategorydata->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $subcategorydata->status=1;
            $subcategorydata->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('mock-sub-category')->with($notification);
    }

    public function mock_sub_category_delete($id)
    {
        $subcategory=MockSubcategory::findOrFail($id);
        $subcategory->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('mock-sub-category')->with($notification);
    }

    public function questions()
    {
        //$question=Question::all();
        $question=Question::join('categories', 'questions.categories_id', '=', 'categories.id')
        ->join('sub_categories', 'questions.sub_categories_id', '=', 'sub_categories.id')
        ->orderBy('questions.id', 'DESC')
        ->get(['questions.*', 'categories.category_name','sub_categories.sub_category']);
        return view('admin.questions',compact('question'));
    }

    public function questions_add()
    {
        $category=Category::all();
        $subcategory=Sub_category::all();
        return view('admin.questions_add',compact('category','subcategory'));
    }

    public function add_questions_get_subcat(Request $request)
    {
        $id = $request->id;
        $sub=DB::table('sub_categories')->where('category_id',$id)->get(); 

        echo '<option disabled selected value>--Select Sub Category--</option>';

                                        if(!empty($sub))
                                        {
                                         foreach($sub as $r)
                                         {
                                            echo ' <option value='.$r->id.'>'.$r->sub_category.'</option>';
                                         }
                                        }
    }

    public function add_questions(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'categories_id' => 'required',
            'sub_categories_id' => 'required',
            'question' => 'required',
            'optionf' => 'required',
            'options' => 'required',
            'optiont' => 'required',
            'optionfo' => 'required',
            'answer' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('questions')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }
        $questiondata= new Question();
        $questiondata->categories_id=$request->categories_id;
        $questiondata->sub_categories_id=$request->sub_categories_id;
        $questiondata->question=$request->question;
        $questiondata->optionf=$request->optionf;
        $questiondata->options=$request->options;
        $questiondata->optiont=$request->optiont;
        $questiondata->optionfo=$request->optionfo;
        $questiondata->answer=$request->answer;
        $questiondata->date=date('d-m-Y');
        $questiondata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('questions')->with($notification);
    }

    public function questions_edit($id)
    {
        $question=Question::findOrFail($id);
        $category=Category::all();
        $subcategory=Sub_category::all();
        return view('admin.questions_edit',compact('question','category','subcategory'));
    }

    public function questions_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories_id' => 'required',
            'sub_categories_id' => 'required',
            'question' => 'required',
            'optionf' => 'required',
            'options' => 'required',
            'optiont' => 'required',
            'optionfo' => 'required',
            'answer' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('questions')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $questiondata= Question::find($request->id);
        $questiondata->categories_id=$request->categories_id;
        $questiondata->sub_categories_id=$request->sub_categories_id;
        $questiondata->question=$request->question;
        $questiondata->optionf=$request->optionf;
        $questiondata->options=$request->options;
        $questiondata->optiont=$request->optiont;
        $questiondata->optionfo=$request->optionfo;
        $questiondata->answer=$request->answer;
        $questiondata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('questions')->with($notification);
    }

    public function questions_block($id,$status)
    {
        $question= Question::find($id);
        if($status==1)
        {
            $question->status=0;
            $question->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $question->status=1;
            $question->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'error'
);
        }
        return redirect('questions')->with($notification);
    }

    public function questions_delete($id)
    {
        $question=Question::findOrFail($id);
        $question->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('questions')->with($notification);
    }


    public function mock_questions()
    {
        //$question=Question::all();
        $question=MockQuestion::join('mock_categories', 'mock_questions.categories_id', '=', 'mock_categories.id')
        ->join('mock_subcategories', 'mock_questions.sub_categories_id', '=', 'mock_subcategories.id')
        ->orderBy('mock_questions.id', 'DESC')
        ->get(['mock_questions.*', 'mock_categories.category_name','mock_subcategories.sub_category']);
        return view('admin.mock_questions',compact('question'));
    }

    public function mock_questions_add()
    {
        $category=MockCategory::all();
        $subcategory=MockSubcategory::all();
        return view('admin.mock_questions_add',compact('category','subcategory'));
    }

    public function mock_add_questions_get_subcat(Request $request)
    {
        $id = $request->id;
        $sub=DB::table('mock_subcategories')->where('category_id',$id)->get(); 

        echo '<option disabled selected value>--Select Sub Category--</option>';

                                        if(!empty($sub))
                                        {
                                         foreach($sub as $r)
                                         {
                                            echo ' <option value='.$r->id.'>'.$r->sub_category.'</option>';
                                         }
                                        }
    }

    public function mock_add_questions(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'categories_id' => 'required',
            'sub_categories_id' => 'required',
            'question' => 'required',
            'optionf' => 'required',
            'options' => 'required',
            'optiont' => 'required',
            'optionfo' => 'required',
            'answer' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('mock-questions')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }
        $questiondata= new MockQuestion();
        $questiondata->categories_id=$request->categories_id;
        $questiondata->sub_categories_id=$request->sub_categories_id;
        $questiondata->question=$request->question;
        $questiondata->optionf=$request->optionf;
        $questiondata->options=$request->options;
        $questiondata->optiont=$request->optiont;
        $questiondata->optionfo=$request->optionfo;
        $questiondata->answer=$request->answer;
        $questiondata->date=date('d-m-Y');
        $questiondata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('mock-questions')->with($notification);
    }

    public function mock_questions_edit($id)
    {
        $question=MockQuestion::findOrFail($id);
        $category=MockCategory::all();
        $subcategory=MockSubcategory::all();
        return view('admin.mock_questions_edit',compact('question','category','subcategory'));
    }

    public function mock_questions_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories_id' => 'required',
            'sub_categories_id' => 'required',
            'question' => 'required',
            'optionf' => 'required',
            'options' => 'required',
            'optiont' => 'required',
            'optionfo' => 'required',
            'answer' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('mock-questions')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $questiondata= MockQuestion::find($request->id);
        $questiondata->categories_id=$request->categories_id;
        $questiondata->sub_categories_id=$request->sub_categories_id;
        $questiondata->question=$request->question;
        $questiondata->optionf=$request->optionf;
        $questiondata->options=$request->options;
        $questiondata->optiont=$request->optiont;
        $questiondata->optionfo=$request->optionfo;
        $questiondata->answer=$request->answer;
        $questiondata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('mock-questions')->with($notification);
    }

    public function mock_questions_block($id,$status)
    {
        $question= MockQuestion::find($id);
        if($status==1)
        {
            $question->status=0;
            $question->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $question->status=1;
            $question->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('mock-questions')->with($notification);
    }

    public function mock_questions_delete($id)
    {
        $question=MockQuestion::findOrFail($id);
        $question->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('mock-questions')->with($notification);
    }

    public function students_edit($id)
    {
        $student=Student::findOrFail($id);
        return view('admin.students_edit',compact('student'));
    }

    public function student_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'student_type' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('students_list')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $studentdata= Student::find($request->id);
        $studentdata->student_type=$request->student_type;
        $studentdata->name=$request->name;
        $studentdata->lastname=$request->lastname;
        $studentdata->mobile=$request->mobile;
        $studentdata->address=$request->address;
        $studentdata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('students_list')->with($notification);
    }

    public function students_block($id,$status)
    {
        $studentdata= Student::find($id);
        if($status==1)
        {
            $studentdata->status=0;
            $studentdata->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $studentdata->status=1;
            $studentdata->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('students_list')->with($notification);
    }

    public function students_delete($id)
    {
        $student=Student::findOrFail($id);
        $student->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('students_list')->with($notification);
    }

    public function subadmin_list()
    {
        $subadmin=Sub_admin::orderBy('id', 'DESC')->get();
        return view('admin.subadmin_list',compact('subadmin'));
    }

    public function subadmin_add()
    {
        return view('admin.subadmin_add');
    }

    public function add_admin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:sub_admins',
            'email' => 'required|unique:users',
            'password' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('subadmin-list')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }
        $password = Hash::make($request->password);
        //$password=$request->password;
        $subadmin= new Sub_admin();
        $subadmin->fname=$request->fname;
        $subadmin->lname=$request->lname;
        $subadmin->phone=$request->phone;
        $subadmin->email=$request->email;
        $subadmin->password=$password;
        $subadmin->address=$request->address;
        $subadmin->type='subadmin';
        $subadmin->date=date('d-m-Y');
        $subadmin->save();
        $id=$subadmin->id;
        $user= new User();
        $user->name=$request->fname;
        $user->type='subadmin';
        $user->email=$request->email;
        $user->password=$password;
        $user->sub_admin_id=$id;
        $user->save();

        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('subadmin-list')->with($notification);
    }

    public function subadmin_block($id,$status)
    {
        $subadmin= Sub_admin::find($id);
        if($status==1)
        {
            $subadmin->status=0;
            $subadmin->save();
        $notification = array(
    'message' => 'Block!', 
    'alert-type' => 'error'
);
        }
        else
        {
            $subadmin->status=1;
            $subadmin->save();
        $notification = array(
    'message' => 'Unblock!', 
    'alert-type' => 'success'
);
        }
        return redirect('subadmin-list')->with($notification);
    }

    public function subadmin_delete($id)
    {
        $subadmin=Sub_admin::findOrFail($id);
        $subadmin->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('subadmin-list')->with($notification);
    }

    public function subadmin_edit($id)
    {
        $subadmin=Sub_admin::findOrFail($id);
        return view('admin.subadmin_edit',compact('subadmin'));
    }

    public function subadmin_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'error!', 
    'alert-type' => 'error'
);
            return redirect('subadmin-list')
                        ->withErrors($validator)
                        ->withInput()->with($notification);
        }

        $subadmin= Sub_admin::find($request->id);
        $subadmin->fname=$request->fname;
        $subadmin->lname=$request->lname;
        $subadmin->phone=$request->phone;
        $subadmin->address=$request->address;
        $subadmin->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('subadmin-list')->with($notification);
    }

    public function coursesave(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'course' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('course')
                        ->withErrors($validator)
                        ->withInput();
        }

    	$coursedata= new Course();
    	$coursedata->course_type=$request->course;
    	$coursedata->save();
    	Session::flash('success', 'cource added Successfully.');
    	return redirect('course');
    }

    public function subjectsave(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'subjectt' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('subject')
                        ->withErrors($validator)
                        ->withInput();
        }

    	$subjectdata= new Subject();
    	$subjectdata->course_id=$request->course_id;
    	$subjectdata->subjectt=$request->subjectt;
    	$subjectdata->save();
    	Session::flash('success', 'subject added Successfully.');
    	return redirect('subject');
    }

    public function logout()
    {
    	$this->middleware('guest')->except('logout');
    	return redirect('');
    }
}
