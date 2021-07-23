<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Terms;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Role;
use App\Models\Sub_category;
use App\Models\Sub_admin;
use App\Models\User;
use App\Models\Order;
use App\Models\Permission;
use Carbon\Carbon;
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

public function index() {
    $date= Carbon::now()->format('Y-m-d');
       
    $delay_order=  Order::with('users','customer_address')->where('estimate_delivery','<',$date)->groupBy('order_number')->get();
    $totalorder=Order::groupBy('order_number')->get();
    $pendingorder=Order::where('status','0')->groupBy('order_number')->get();
    $pendingorder=count($pendingorder);
    $packed_order=Order::where('delivery_status','2')->groupBy('order_number')->get();
    $packed_order=count($packed_order);
    $shipped_order=Order::where('delivery_status','3')->groupBy('order_number')->get();
    $shipped_order=count($shipped_order);
    $deliverd_order= Order::where('delivery_status','4')->groupBy('order_number')->get();
    $deliverd_order=count($deliverd_order);
    $confirm_order=Order::where('status','1')->groupBy('order_number')->get();
    $confirm_order=count($confirm_order);
 
$sale[]=Order::where(['status'=>1,'delivery_status'=>4])->groupBy('order_number')->pluck('grand_total')->toArray();

$totalsale=array_sum($sale[0]);

    $cancel_order=Order::where('status','2')->groupBy('order_number')->get();
    $cancel_order=count($cancel_order); 
    $total_user=User::where('type','user')->count();
    return view('admin/dashboard',compact('totalorder','totalsale','delay_order','pendingorder','shipped_order','packed_order','deliverd_order','total_user','confirm_order','cancel_order'));
}
    /**
     * Show the application dashboard.
     *
    * @return \Illuminate\Contracts\Support\Renderable
     */

    public function students_list()
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            $permissions=DB::table('permissions')
            ->select('permissions.*')
            ->where('sub_admin',$user->sub_admin_id)
            ->first();
                if(!empty($permissions))
                {
                  if($permissions->student== 0)
                  {
                    return redirect('dashboard');
                  }
                }
                else
                {
                    return redirect('dashboard');
                }
        }
                //$student=Student::orderBy('id', 'DESC')->get();
                $student=Student::join('packages', 'students.package', '=', 'packages.id')
                ->orderBy('students.id', 'DESC')
               ->get(['students.*', 'packages.month']);
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
            'cat_type' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            //return redirect()->back()->withErrors($validator)
                        //->withInput(); 
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }
        $image='';
            if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'category'.time().'.'.$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/category/';
            $image->move($location, $filename);
            $image=$filename;
        }
        $categorydata= new Category();
        $categorydata->category_name=$request->category_name;
        $categorydata->type=$request->cat_type;
        $categorydata->$image;
        $categorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('category')->with($notification);
    }
    public function category_edit($id)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $category=Category::findOrFail($id);
        return view('admin.category_edit',compact('category'));
    }

    public function category_update(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'cat_type' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }
        $image='';
            if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'category'.time().'.'.$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/category/';
            $image->move($location, $filename);
            $image=$filename;
        }
        $categorydata= Category::find($request->id);
        $categorydata->category_name=$request->category_name;
        $categorydata->type=$request->cat_type;
        if(!empty($image))
        {
            $categorydata->image=$image;    
        }
        $categorydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('category')->with($notification);
    }

    public function category_block($id,$status)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
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
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $category=Category::findOrFail($id);
        $category->delete();
        $notification = array(
    'message' => 'delete!', 
    'alert-type' => 'error'
);
        return redirect('category')->with($notification);
    }

    public function slider()
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            $permissions=DB::table('permissions')
            ->select('permissions.*')
            ->where('sub_admin',$user->sub_admin_id)
            ->first();
                if(!empty($permissions))
                {
                  if($permissions->practice== 0)
                  {
                    return redirect('dashboard');
                  }
                }
                else
                {
                    return redirect('dashboard');
                }
        }
        $slider=Slider::orderBy('id', 'DESC')->get();
        return view('admin.slider',compact('slider'));
    }

    public function slider_add()
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        return view('admin.slider_add');
    }
    public function add_slider(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:png,jpeg,jpg,gif'
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            //return redirect()->back()->withErrors($validator)
                        //->withInput(); 
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }
        $image='';
            if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'slider'.time().'.'.$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/sliders/';
            $image->move($location, $filename);
            $image=$filename;
        }
        $slider= new Slider();
        $slider->main_title=$request->main_title;
        $slider->sub_title=$request->sub_title;
        $slider->short_title=$request->short_title;
        $slider->image=$image;
        $slider->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('slider')->with($notification);
    }
    public function slider_edit($id)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $slider=Slider::findOrFail($id);
        return view('admin.slider_edit',compact('slider'));
    }

    public function slider_update(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        
        $image='';
            if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'slider'.time().'.'.$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/sliders/';
            $image->move($location, $filename);
            $image=$filename;
        }
        $sliderdata= Slider::find($request->id);
        $sliderdata->main_title=$request->main_title;
        $sliderdata->sub_title=$request->sub_title;
        $sliderdata->short_title=$request->short_title;
        if(!empty($image))
        {
            $sliderdata->image=$image;    
        }
        
        $sliderdata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('slider')->with($notification);
    }

    public function slider_block($id,$status)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
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
        return redirect('slider')->with($notification);
    }

    public function slider_delete($id)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $slider=Slider::findOrFail($id);
        $slider->delete();
        $notification = array(
    'message' => 'delete!', 
    'alert-type' => 'error'
);
        return redirect('slider')->with($notification);
    }

     public function privacy()
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            $permissions=DB::table('permissions')
            ->select('permissions.*')
            ->where('sub_admin',$user->sub_admin_id)
            ->first();
                if(!empty($permissions))
                {
                  if($permissions->practice== 0)
                  {
                    return redirect('dashboard');
                  }
                }
                else
                {
                    return redirect('dashboard');
                }
        }
        $privacy=Privacy::orderBy('id', 'DESC')->get();
        return view('admin.privacy',compact('privacy'));
    }

    public function privacy_edit($id)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $privacy=Privacy::findOrFail($id);
        return view('admin.privacy_edit',compact('privacy'));
    }

    public function privacy_update(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $privacydata= Privacy::find($request->id);
        $privacydata->content=$request->content;
        $privacydata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('privacy')->with($notification);
    }


    public function termsofuse()
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            $permissions=DB::table('permissions')
            ->select('permissions.*')
            ->where('sub_admin',$user->sub_admin_id)
            ->first();
                if(!empty($permissions))
                {
                  if($permissions->practice== 0)
                  {
                    return redirect('dashboard');
                  }
                }
                else
                {
                    return redirect('dashboard');
                }
        }
        $terms=Terms::orderBy('id', 'DESC')->get();
        return view('admin.terms',compact('terms'));
    }

    public function terms_edit($id)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $terms=Terms::findOrFail($id);
        return view('admin.terms_edit',compact('terms'));
    }

    public function terms_update(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $termsdata= Terms::find($request->id);
        $termsdata->content=$request->content;
        $termsdata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('terms-of-use')->with($notification);
    }
    public function permission()
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $permission=Permission::join('sub_admins', 'permissions.sub_admin', '=', 'sub_admins.id')
                ->orderBy('permissions.id', 'DESC')
               ->get(['permissions.*', 'sub_admins.fname']);
        return view('admin.permission',compact('permission'));
    }
    public function permission_add()
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $subadmin=Sub_admin::all();
        return view('admin.permission_add',compact('subadmin'));
    }

    public function add_permission(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'sub_admin' => 'required|unique:permissions',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $permission= new Permission();
        $permission->sub_admin=$request->sub_admin;
        $permission->practice=$request->practice;
        $permission->mock=$request->mock;
        $permission->student=$request->student;
        $permission->package=$request->package;
        $permission->dictionary=$request->dictionary;
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
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $permission=Permission::findOrFail($id);
        $subadmin=Sub_admin::all();
        $subcategory=MockSubcategory::all();
        return view('admin.permission_edit',compact('permission','subadmin'));
    }

    public function permission_update(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'sub_admin' => 'required',
        ]);
if ($validator->fails()) {
        $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $permission= Permission::find($request->id);
        $permission->sub_admin=$request->sub_admin;
        $permission->practice=$request->practice;
        $permission->dictionary=$request->dictionary;
        $permission->package=$request->package;
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
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
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
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $permission=Permission::findOrFail($id);
        $permission->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('permission')->with($notification);
    }

    public function sub_category()
    {
        //$subcategory=Sub_category::all();
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            $permissions=DB::table('permissions')
            ->select('permissions.*')
            ->where('sub_admin',$user->sub_admin_id)
            ->first();
                if(!empty($permissions))
                {
                  if($permissions->practice== 0)
                  {
                    return redirect('dashboard');
                  }
                }
                else
                {
                    return redirect('dashboard');
                }
        }
        $subcategory=Sub_category::join('categories', 'sub_categories.category_id', '=', 'categories.id')
        ->orderBy('sub_categories.id', 'DESC')
               ->get(['sub_categories.*', 'categories.category_name']);

        return view('admin.sub_category',compact('subcategory'));
    }
    public function sub_category_add()
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $category=Category::all();
        return view('admin.sub_category_add',compact('category'));
    }
    public function add_sub_categories(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
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
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $subcategory=Sub_category::findOrFail($id);
        $category=Category::all();
        return view('admin.sub_category_edit',compact('subcategory','category'));
    }

    public function sub_category_update(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
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
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
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
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $subcategory=Sub_category::findOrFail($id);
        $subcategory->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('sub-category')->with($notification);
    }

    public function students_edit($id)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $package=Package::all();
        $student=Student::findOrFail($id);
        return view('admin.students_edit',compact('student','package'));
    }

    public function student_update(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'student_type' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $studentdata= Student::find($request->id);
        $studentdata->student_type=$request->student_type;
        $studentdata->package=$request->package;
        $studentdata->name=$request->name;
        $studentdata->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('students-list')->with($notification);
    }

    public function students_block($id,$status)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
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
        return redirect('students-list')->with($notification);
    }

    public function students_delete($id)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $student=Student::findOrFail($id);
        $student->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('students-list')->with($notification);
    }

    public function subadmin_list()
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $user=User::where('type','sub_admin')->orderBy('id', 'DESC')->get();
        return view('admin.subadmin_list',compact('user'));
    }

    public function subadmin_add()
    {
        $role=Role::orderBy('id', 'DESC')->get();
        return view('admin.subadmin_add',compact('role'));
    }

    public function add_admin(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }
        $password = Hash::make($request->password);
        $role_id=implode(',',$role=$request->role_id);
        $subadmin= new User();
        $subadmin->name=$request->name;
        $subadmin->email=$request->email;
        $subadmin->password=$password;
        $subadmin->password_show=$request->password;
        $subadmin->role_id=$role_id;
        $subadmin->type='sub_admin';
        $subadmin->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('subadmin-list')->with($notification);
    }

   

    public function subadmin_delete($id)
    {
        
        $subadmin=User::findOrFail($id);
        $subadmin->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('subadmin-list')->with($notification);
    }

    public function subadmin_edit($id)
    {
        
        $subadmin=User::findOrFail($id);
        $role=Role::orderBy('id', 'DESC')->get();
        return view('admin.subadmin_edit',compact('subadmin','role'));
    }

    public function subadmin_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }
        $role_id=implode(',',$role=$request->role_id);
        $subadmin= User::find($request->id);
        $subadmin->role_id=$role_id;
        $subadmin->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('subadmin-list')->with($notification);
    }

    public function customer_list()
    {
        $user=User::where('type','user')->orderBy('id', 'DESC')->get();
   
        foreach ($user as $row)
        {
            $totalorder=Order::where('token',$row->token)->count();
            $lastdate=Order::where('token',$row->token)->orderBy('id', 'DESC')->first();
            $row->totalorder=$totalorder;
       
            $row->lastdate=$lastdate->created_at??'';
        }
    //   dd($user);
        
        return view('admin.customer_list',compact('user'));
    }
    public function customer_block($id,$status)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $categorydata= User::find($id);
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
        return redirect('customer-list')->with($notification);
    }
    public function customer_delete($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        $notification = array(
        'message' => 'Deleted!', 
        'alert-type' => 'error'
        );
        return redirect('customer-list')->with($notification);
    }

    public function customer_edit($id)
    {
        
        $user=User::findOrFail($id);
        return view('admin.customer_edit',compact('user'));
    }

    public function customer_update(Request $request)
    {
        $user = auth()->user();
        if($user->type=='subadmin')
        {
            return redirect('dashboard');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $user= User::find($request->id);
        $user->name=$request->name;
        $user->mobile=$request->mobile;
        $user->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('customer-list')->with($notification);
    }

    public function logout()
    {
    	$this->guard()->logut();
    	return redirect('');
    }
}
