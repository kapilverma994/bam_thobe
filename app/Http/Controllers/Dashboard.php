<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Terms;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Store;
use App\Models\Role;
use App\Models\Sub_admin;
use App\Models\User;
use App\Models\Permission;
use Session;
use Validator;
use DB;
use Hash;
class Dashboard extends Controller
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

    public function store_management()
    {
        $store=Store::orderBy('id', 'DESC')->get();
        return view('admin.store_list',compact('store'));
    }

    public function store_add()
    {
        return view('admin.store_add');
    }

    public function add_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:png,jpeg,jpg,gif',
          
            'name' => 'required',
            'manager_name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'visit_charge'=>'numeric'
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
            $location = 'public/uploads/store/';
            $image->move($location, $filename);
            $image=$filename;
        }
        $store= new Store();
        $store->pincode=$request->pincode??'000';
        $store->store_name=$request->name;
        $store->manager_name=$request->manager_name;
        $store->contact=$request->contact;
        $store->address=$request->address;
        $store->visit_charge=$request->visit_charge;
        $store->image=$image;
        $store->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('store-management')->with($notification);
    }

    public function store_edit($id)
    {
        $store=Store::findOrFail($id);
        return view('admin.store_edit',compact('store'));
    }

    public function store_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
       
            'name' => 'required',
            'manager_name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'visit_charge'=>'numeric',
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
            $filename = 'slider'.time().'.'.$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/store/';
            $image->move($location, $filename);
            $image=$filename;
        }
        $store= Store::find($request->id);
        $store->pincode=$request->pincode??'000';
        $store->store_name=$request->name;
        $store->manager_name=$request->manager_name;
        $store->contact=$request->contact;
        $store->visit_charge=$request->visit_charge;
        $store->address=$request->address;
        if(!empty($image))
        {
        	$store->image=$image;
        }
        $store->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('store-management')->with($notification);
    }

     public function store_delete($id)
    {
        $store=Store::findOrFail($id);
        $store->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('store-management')->with($notification);
    }


     public function role_management()
    {
        $role=Role::orderBy('id', 'DESC')->get();
        return view('admin.role_list',compact('role'));
    }

    public function role_add()
    {
        return view('admin.role_add');
    }

    public function add_role(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
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
        

        $role= new Role();
        $role->name=$request->name;
        $role->category=$request->category;
        $role->thobemanage=$request->thobemanage;
        $role->coupon=$request->coupon;
        $role->pincode=$request->pincode;
        $role->manageusers=$request->manageusers;
        $role->orders=$request->orders;
        $role->cms=$request->cms;
        $role->store=$request->store;
        $role->sliders=$request->sliders;
        $role->basicsetting=$request->basicsetting;
        $role->measurement=$request->measurement;
        $role->role=$request->role;
        
        $role->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('role-management')->with($notification);
    }

    public function role_edit($id)
    {
        $role=Role::findOrFail($id);
        return view('admin.role_edit',compact('role'));
    }

    public function role_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
    'message' => 'all field required!', 
    'alert-type' => 'error'
);
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }
        
        $role= Role::find($request->id);
        $role->name=$request->name;
        $role->category=$request->category;
        $role->thobemanage=$request->thobemanage;
        $role->coupon=$request->coupon;
        $role->pincode=$request->pincode;
        $role->manageusers=$request->manageusers;
        $role->orders=$request->orders;
        $role->cms=$request->cms;
        $role->store=$request->store;
        $role->sliders=$request->sliders;
        $role->basicsetting=$request->basicsetting;
        $role->measurement=$request->measurement;
        $role->role=$request->role;
        $role->save();
        $notification = array(
    'message' => 'Successfully!', 
    'alert-type' => 'success'
);
        return redirect('role-management')->with($notification);
    }

     public function role_delete($id)
    {
        $role=Role::findOrFail($id);
        $role->delete();
        $notification = array(
    'message' => 'Deleted!', 
    'alert-type' => 'error'
);
        return redirect('role-management')->with($notification);
    }
}