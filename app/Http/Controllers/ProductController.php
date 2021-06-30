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
use App\Models\Product;
use App\Models\Thobe_style;
use App\Models\Add_model;
use App\Models\Button_management;
use App\Models\Pocket;
use App\Models\Cuff;


use App\Models\Fabric_management;

use App\Models\Permission;
use App\Models\Collar_managment;
use App\Models\Thobe_Button_management;
use App\Models\Thobe_fabric_management;
use App\Models\Thobe_Add_Model;
use App\Models\Front_style;
use Session;
use Validator;
use DB;
use Hash;

class ProductController extends Controller
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

    public function product()
    {
        //$product=Product::orderBy('id', 'DESC')->get();

        $product = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            ->orderBy('products.id', 'DESC')
            ->get(['products.*', 'categories.category_name', 'sub_categories.sub_category']);

        return view('admin.product.product_list', compact('product'));
    }

    public function cat_get_subcat(Request $request)
    {
        $id = $request->id;
        $sub = DB::table('sub_categories')->where('category_id', $id)->get();

        echo '<option disabled selected value>--Select Sub Category--</option>';

        if (!empty($sub)) {
            foreach ($sub as $r) {
                echo ' <option value=' . $r->id . '>' . $r->sub_category . '</option>';
            }
        }
    }

    public function product_add()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        $subcategory = Sub_category::orderBy('id', 'DESC')->get();
        return view('admin.product.product_add', compact('category', 'subcategory'));
    }

    public function add_product(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'cost' => 'required',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        $image = '';
        if ($request->file('image')) {
            $image = $request->file('image');
            $i=1;
            foreach ($image as $file) {
                $name = $file->getClientOriginalName();
                $filename = $i.'product' . time() . '.' . $file->getClientOriginalName();
                $location = 'public/uploads/product/';
                $file->move($location, $filename);
                $images[] = $filename;
                $i++;
            }
        }

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->featured = $request->featured;
        $product->image = implode("|", $images);
        $product->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('product')->with($notification);
    }



    public function product_delete($id)
    {

        $product = Product::findOrFail($id);
        $product->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('product')->with($notification);
    }

    public function product_edit($id)
    {

        $product = Product::findOrFail($id);
        $category = Category::orderBy('id', 'DESC')->get();
        $subcategory = Sub_category::orderBy('id', 'DESC')->get();
        return view('admin.product.product_edit', compact('product', 'category', 'subcategory'));
    }

    public function product_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'cost' => 'required',

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        $image = '';
        if ($request->file('image')) {
            $image = $request->file('image');
            foreach ($image as $file) {
                $name = $file->getClientOriginalName();
                $filename = 'product' . time() . '.' . $file->getClientOriginalName();
                $location = 'public/uploads/product/';
                $file->move($location, $filename);
                $images[] = $filename;
            }
        }
        $product = Product::find($request->id);
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->featured = $request->featured;
        if (!empty($image)) {
            $product->image = implode("|", $images);
        }
        $product->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('product')->with($notification);
    }


    public function thobe_style()
    {
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();

        return view('admin.thobe_style.thobe_list', compact('thobe'));
    }


    public function thobe_add()
    {
        return view('admin.thobe_style.thobe_add');
    }

    public function add_thobe(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $thobe = new Thobe_style();
        $thobe->name = $request->name;
        $thobe->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-style')->with($notification);
    }



    public function thobe_delete($id)
    {
        $thobe = Thobe_style::findOrFail($id);
        $thobe->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('thobe-style')->with($notification);
    }

    public function thobe_edit($id)
    {

        $thobe = Thobe_style::findOrFail($id);
        return view('admin.thobe_style.thobe_edit', compact('thobe'));
    }

    public function thobe_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $thobe = Thobe_style::find($request->id);
        $thobe->name = $request->name;
        $thobe->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-style')->with($notification);
    }

    public function model_list()
    {
        $model = Add_model::orderBy('id', 'DESC')->get();

        return view('admin.model.model_list', compact('model'));
    }




    public function model_add()
    {
        return view('admin.model.model_add');
    }



    public function add_model(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'model_type' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'model' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/model/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $model = new Add_model();
        $model->model_type = $request->model_type;
        $model->price = $request->price;
        $model->image = $image;
        $model->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('model-list')->with($notification);
    }



    public function model_delete($id)
    {
        $model = Add_model::findOrFail($id);
        $model->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('model-list')->with($notification);
    }
    public function model_edit($id)
    {

        $model = Add_model::findOrFail($id);
        return view('admin.model.model_edit', compact('model'));
    }
    public function model_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'model_type' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'model' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/model/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $model = Add_model::find($request->id);
        $model->model_type = $request->model_type;
        $model->price = $request->price;
        if (!empty($image)) {
            $model->image = $image;
        }

        $model->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('model-list')->with($notification);
    }









    public function fabric_list()
    {
        //$fabric=Fabric_management::orderBy('id', 'DESC')->get();
        $fabric = Fabric_management::join('thobe_styles', 'fabric_managements.thobe_style_id', '=', 'thobe_styles.id')
            ->orderBy('fabric_managements.id', 'DESC')
            ->get(['fabric_managements.*', 'thobe_styles.name']);
        return view('admin.fabric.fabric_list', compact('fabric'));
    }


    public function fabric_add()
    {
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.fabric.fabric_add', compact('thobe'));
    }


    public function add_fabric(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'fabrics' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'fabric' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/fabric/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $fabric = new Fabric_management();
        $fabric->thobe_style_id = $request->thobe_style_id;
        $fabric->fabrics = $request->fabrics;
        $fabric->price = $request->price;
        $fabric->image = $image;
        $fabric->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('fabric-list')->with($notification);
    }

    public function fabric_delete($id)
    {
        $fabric = Fabric_management::findOrFail($id);
        $fabric->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('fabric-list')->with($notification);
    }



    public function fabric_edit($id)
    {

        $fabric = Fabric_management::findOrFail($id);
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.fabric.fabric_edit', compact('thobe', 'fabric'));
    }



    public function fabric_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'fabrics' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'model' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/model/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $fabric = Fabric_management::find($request->id);
        $fabric->thobe_style_id = $request->thobe_style_id;
        $fabric->fabrics = $request->fabrics;
        $fabric->price = $request->price;
        if (!empty($image)) {
            $fabric->image = $image;
        }

        $fabric->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('fabric-list')->with($notification);
    }





    public function buttons_list()
    {
        //$fabric=Fabric_management::orderBy('id', 'DESC')->get();
        $button = Button_management::join('thobe_styles', 'button_managements.thobe_style_id', '=', 'thobe_styles.id')
            ->orderBy('button_managements.id', 'DESC')
            ->get(['button_managements.*', 'thobe_styles.name']);
        return view('admin.buttons.button_list', compact('button'));
    }



    public function buttons_add()
    {
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.buttons.button_add', compact('thobe'));
    }
    public function thobe_buttons_add()
    {
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.buttons.thobe_button_add', compact('thobe'));
    }




    public function add_buttons(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'buttons' => 'required',
            'attributess' => 'required',
            'image' => 'required',
           
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'button' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/button/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $fabric = new Button_management();
        $fabric->thobe_style_id = $request->thobe_style_id;
        $fabric->buttons = $request->buttons;
        $fabric->image = $image;
      
        $fabric->attributes = $request->attributess;
        $fabric->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('buttons-list')->with($notification);
    }



    public function buttons_delete($id)
    {
        $buttons = Button_management::findOrFail($id);
        $buttons->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('buttons-list')->with($notification);
    }

    public function buttons_edit($id)
    {

        $button = Button_management::findOrFail($id);
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.buttons.button_edit', compact('thobe', 'button'));
    }


    public function buttons_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'buttons' => 'required',
            'attributess' => 'required',
           
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'button' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/button/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $button = Button_management::find($request->id);
        $button->thobe_style_id = $request->thobe_style_id;
        $button->buttons = $request->buttons;
        // $button->description=$request->description;
        $button->attributes = $request->attributess;
        if (!empty($image)) {
            $button->image = $image;
        }

        $button->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('buttons-list')->with($notification);
    }


    //Standar thobe style managment
    public function thobe_collar_list()

    {

        //$fabric=Fabric_management::orderBy('id', 'DESC')->get();
        $collar = Collar_managment::join('thobe_styles', 'collar_managements.thobe_style_id', '=', 'thobe_styles.id')
            ->orderBy('collar_managements.id', 'DESC')
            ->get(['collar_managements.*', 'thobe_styles.name']);
        return view('admin.collar.collar_list', compact('collar'));
    }
    public function thobe_collar_add()
    {
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.collar.collar_add', compact('thobe'));
    }


    public function thobe_add_collar(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'collar' => 'required',
            'price' => 'required',
            'image' => 'required',
            'visible_image'=>'required',    
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
     
        if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'collar' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/collar/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'collar' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/collar/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $collar = new Collar_managment();
        $collar->thobe_style_id = $request->thobe_style_id;
        $collar->collar_style = $request->collar;
        $collar->price = $request->price;
        $collar->image = $image;
        $collar->visible_image=$vimage;
        $collar->description=$request->description;
        $collar->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-collar-list')->with($notification);
    }


    public function thobe_collar_delete($id)
    {
        $collar = Collar_managment::findOrFail($id);
        $collar->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('thobe-collar-list')->with($notification);
    }



    public function thobe_collar_edit($id)
    {

        $collar =  Collar_managment::findOrFail($id);
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.collar.collar_edit', compact('thobe', 'collar'));
    }


    public function thobe_collar_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'collar' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }



        if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'collar' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/collar/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'collar' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/collar/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $collar = Collar_managment::find($request->id);
        $collar->thobe_style_id = $request->thobe_style_id;
        $collar->description=$request->description;
        $collar->collar_style = $request->collar;
        $collar->price = $request->price;
        if (!empty($image)) {
            $collar->image = $image;
        }
        if (!empty($vimage)) {
            $collar->visible_image = $vimage;
        }

        $collar->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-collar-list')->with($notification);
    }


    public function thobe_model_list()
    {

        $model = Thobe_Add_Model::orderBy('id', 'DESC')->get();

        return view('admin.model.thode_model_list', compact('model'));
    }


    public function thobe_add_model(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'model_type' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'model' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/model/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $model = new Thobe_Add_model();
        $model->model_type = $request->model_type;
        $model->price = $request->price;
        $model->color_code=$request->color_code;
        $model->image = $image;
        $model->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-model-list')->with($notification);
    }
    public function thobe_model_add()
    {
        return view('admin.model.thobe_model_add');
    }

    public function thobe_model_delete($id)
    {
        $model = Thobe_Add_model::findOrFail($id);
        $model->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('thobe-model-list')->with($notification);
    }


    public function thobe_model_edit($id)
    {

        $model = Thobe_Add_model::findOrFail($id);
        return view('admin.model.thobe_model_edit', compact('model'));
    }



    public function thobe_model_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'model_type' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'model' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/model/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $model = Thobe_Add_model::find($request->id);
        $model->model_type = $request->model_type;
        $model->color_code=$request->color_code;
        $model->price = $request->price;
        if (!empty($image)) {
            $model->image = $image;
        }

        $model->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-model-list')->with($notification);
    }

    public function  thobe_fabric_list()
    {
        $fabric = Thobe_fabric_management::join('thobe_styles', 'thobe_fabric_managements.thobe_style_id', '=', 'thobe_styles.id')
            ->orderBy('thobe_fabric_managements.id', 'DESC')
            ->get(['thobe_fabric_managements.*', 'thobe_styles.name']);
        return view('admin.fabric.thobe_fabric_list', compact('fabric'));
    }
    public function thobe_fabric_add()
    {
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.fabric.thobe_fabric_add', compact('thobe'));
    }


    public function thobe_add_fabric(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'fabrics' => 'required',
            'price' => 'required',
            'quantity'=>'required',
            'type'=>'required',
            'image' => 'required',
            'color_code'=>'required',
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'fabric' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/fabric/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $fabric = new Thobe_fabric_management();
        $fabric->thobe_style_id = $request->thobe_style_id;
        $fabric->fabrics = $request->fabrics;
        $fabric->price = $request->price;
        $fabric->quantity=$request->quantity;
        $fabric->color_code=$request->color_code;
        $fabric->type=$request->type;
        $fabric->description=$request->description;
        $fabric->image = $image;
        $fabric->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-fabric-list')->with($notification);
    }

    public function thobe_fabric_delete($id)
    {
        $fabric = Thobe_fabric_management::findOrFail($id);
        $fabric->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('thobe-fabric-list')->with($notification);
    }


    public function thobe_fabric_edit($id)
    {

        $fabric = Thobe_fabric_management::findOrFail($id);
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.fabric.thobe_fabric_edit', compact('thobe', 'fabric'));
    }


    public function thobe_fabric_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'fabrics' => 'required',
            'price' => 'required',
            'description'=>'required',
            'type'=>'required',
            'color_code'=>'required'
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'fabric' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/fabric/';
            $image->move($location, $filename);
            $image = $filename;
        }

        $fabric = Thobe_fabric_management::find($request->id);
        $fabric->thobe_style_id = $request->thobe_style_id;
        $fabric->fabrics = $request->fabrics;
        $fabric->type=$request->type;
        $fabric->quantity=$request->quantity;
        $fabric->color_code=$request->color_code;
        $fabric->description=$request->description;
        $fabric->price = $request->price;
        if (!empty($image)) {
            $fabric->image = $image;
        }

        $fabric->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-fabric-list')->with($notification);
    }


    public function thobe_buttons_list()
    {
        //$fabric=Fabric_management::orderBy('id', 'DESC')->get();
        $button = Thobe_Button_management::join('thobe_styles', 'thobe_button_managments.thobe_style_id', '=', 'thobe_styles.id')
            ->orderBy('thobe_button_managments.id', 'DESC')
            ->get(['thobe_button_managments.*', 'thobe_styles.name']);
        return view('admin.buttons.thobe_button_list', compact('button'));
    }

    public function thobe_add_buttons(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'buttons' => 'required',
            'attributess' => 'required',
            'visible_image'=>'required',
            'image' => 'required',
            'description'=>'required',
            'price'=>'required'
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'button' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/button/';
            $image->move($location, $filename);
            $image = $filename;
        }
        if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'button' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/button/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

        $fabric = new Thobe_Button_management();
        $fabric->thobe_style_id = $request->thobe_style_id;
        $fabric->buttons = $request->buttons;
        $fabric->image = $image;
        $fabric->visible_image=$vimage;
        $fabric->price=$request->price;
        $fabric->description=$request->description;
        $fabric->attributes = $request->attributess;
        $fabric->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-buttons-list')->with($notification);
    }
    public function thobe_buttons_delete($id)
    {
        $buttons = Thobe_Button_management::findOrFail($id);
        $buttons->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('thobe-buttons-list')->with($notification);
    }



    public function thobe_buttons_edit($id)
    {

        $button = Thobe_Button_management::findOrFail($id);
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.buttons.thobe_button_edit', compact('thobe', 'button'));
    }


    public function thobe_buttons_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'buttons' => 'required',
            'attributess' => 'required',
            'description'=>'required',
            'price'=>'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'button' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/button/';
            $image->move($location, $filename);
            $image = $filename;
        }
        if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'button' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/button/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

        $button = Thobe_Button_management::find($request->id);
        $button->thobe_style_id = $request->thobe_style_id;
        $button->description=$request->description;
        $button->buttons = $request->buttons;
        $button->price=$request->price;
        $button->attributes = $request->attributess;
        if (!empty($image)) {
            $button->image = $image;
        }
        if (!empty($vimage)) {
            $button->visible_image = $vimage;
        }
        $button->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-buttons-list')->with($notification);
    }






    public function thobe_front_style_list()

    {

        //$fabric=Fabric_management::orderBy('id', 'DESC')->get();
        $style = Front_style::join('thobe_styles', 'front_style_managements.thobe_style_id', '=', 'thobe_styles.id')
            ->orderBy('front_style_managements.id', 'DESC')
            ->get(['front_style_managements.*', 'thobe_styles.name']);
        return view('admin.front_style.style_list', compact('style'));
    }
    public function thobe_front_style_add()
    {
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.front_style.style_add', compact('thobe'));
    }


    public function thobe_add_front_style(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'style' => 'required',
            'price' => 'required',
            'image' => 'required',
            'visible_image'=>'required',
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'front_style' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/front_style/';
            $image->move($location, $filename);
            $image = $filename;
        }
        if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'front_style' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/front_style/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

        $collar = new Front_style();
        $collar->thobe_style_id = $request->thobe_style_id;
        $collar->style = $request->style;
        $collar->price = $request->price;
        $collar->visible_image=$vimage;
        $collar->description=$request->description;
        $collar->image = $image;
        $collar->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-front-style-list')->with($notification);
    }


    public function thobe_front_style_delete($id)
    {
        $collar = Front_style::findOrFail($id);
        $collar->delete();
        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'error'
        );
        return redirect('thobe-front-style-list')->with($notification);
    }



    public function thobe_front_style_edit($id)
    {

        $style =  Front_style::findOrFail($id);
        $thobe = Thobe_style::orderBy('id', 'DESC')->get();
        return view('admin.front_style.style_edit', compact('thobe', 'style'));
    }


    public function thobe_front_style_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'thobe_style_id' => 'required',
            'style' => 'required',
            'price' => 'required',
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'all field required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'front_style' . time() . '.' . $image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/front_style/';
            $image->move($location, $filename);
            $image = $filename;
        }
        if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'front_style' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/front_style/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

        $collar = Front_style::find($request->id);
        $collar->thobe_style_id = $request->thobe_style_id;
        $collar->description=$request->description;
        $collar->style = $request->style;
        $collar->price = $request->price;
        if (!empty($image)) {
            $collar->image = $image;
        }
        if (!empty($vimage)) {
            $collar->visible_image = $vimage;
        }


        $collar->save();
        $notification = array(
            'message' => 'Successfully!',
            'alert-type' => 'success'
        );
        return redirect('thobe-front-style-list')->with($notification);
    }




    public function getshipping(){
        
        $pin=DB::table('shipping_area')->orderBy('id', 'DESC')->get();
        return view('admin.shipping.pincode',compact('pin'));
    }
    public function add_pincode(Request $request){
        $request->validate([
            'pincode'=>'required|max:6|min:6',
        ]);

  $res=DB::table('shipping_area')->insert(['pin_code'=>$request->pincode,'status'=>1]);
if($res){
    $notification = array(
        'message' => 'Pincode Added Successfully!',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
}

    }



    public function pincode_status($type,$id){
        $res=DB::table('shipping_area')->where('id',$id)->update(['status'=>$type]);
               if($res){
                $notification = array(
                    'message' => 'Pincode Updated Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
               }else{
                   return redirect()->back()->with('error','Oops Something Went Wrong!!');
               }
       
       }


    

       public function pincode_delete($id){

$res=DB::table('shipping_area')->where('id',$id)->delete();
if($res){
    $notification = array(
        'message' => 'Deleted',
        'alert-type' => 'error'
    );
    return redirect()->back()->with($notification);

}
       }





       public function thobe_pocket_list()

       {

           //$fabric=Fabric_management::orderBy('id', 'DESC')->get();
           $pocket = Pocket::join('thobe_styles', 'pocket_managements.thobe_style_id', '=', 'thobe_styles.id')
               ->orderBy('pocket_managements.id', 'DESC')
               ->get(['pocket_managements.*', 'thobe_styles.name']);
           return view('admin.pocket.pocket_list', compact('pocket'));
       }
       public function thobe_pocket_add()
       {
           $thobe = Thobe_style::orderBy('id', 'DESC')->get();
           return view('admin.pocket.pocket_add', compact('thobe'));
       }


       public function thobe_add_pocket(Request $request)
       {

           $validator = Validator::make($request->all(), [
               'thobe_style_id' => 'required',
               'pocket' => 'required',
               'price' => 'required',
               'image' => 'required',
               'visible_image'=>'required',
               'description'=>'required',
           ]);

           if ($validator->fails()) {
               $notification = array(
                   'message' => 'all field required!',
                   'alert-type' => 'error'
               );
               return redirect()->back()->withErrors($validator)
                   ->withInput();
           }

           $image = '';
           if ($request->hasFile('image')) {
               $image = $request->file('image');
               $filename = 'pocket' . time() . '.' . $image->getClientOriginalExtension();
               //$location = 'public/uloads/banner/' . $filename;
               $location = 'public/uploads/pocket/';
               $image->move($location, $filename);
               $image = $filename;
           }
           if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'pocket' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/pocket/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

           $pocket = new Pocket();
           $pocket->thobe_style_id = $request->thobe_style_id;
           $pocket->pocket = $request->pocket;
           $pocket->price = $request->price;
           $pocket->image = $image;
           $pocket->visible_image=$vimage;
           $pocket->description=$request->description;
           $pocket->save();
           $notification = array(
               'message' => 'Successfully!',
               'alert-type' => 'success'
           );
           return redirect('thobe-pocket-list')->with($notification);
       }


       public function thobe_pocket_delete($id)
       {
           $pocket = Pocket::findOrFail($id);
           $pocket->delete();
           $notification = array(
               'message' => 'Deleted!',
               'alert-type' => 'error'
           );
           return redirect('thobe-pocket-list')->with($notification);
       }



       public function thobe_pocket_edit($id)
       {

           $pocket =  Pocket::findOrFail($id);
           $thobe = Thobe_style::orderBy('id', 'DESC')->get();
           return view('admin.pocket.pocket_edit', compact('thobe', 'pocket'));
       }


       public function thobe_pocket_update(Request $request)
       {

           $validator = Validator::make($request->all(), [
               'thobe_style_id' => 'required',
               'pocket' => 'required',
               'price' => 'required',
               'description'=>'required',
           ]);

           if ($validator->fails()) {
               $notification = array(
                   'message' => 'all field required!',
                   'alert-type' => 'error'
               );
               return redirect()->back()->withErrors($validator)
                   ->withInput();
           }

           $image = '';
           if ($request->hasFile('image')) {
               $image = $request->file('image');
               $filename = 'pocket' . time() . '.' . $image->getClientOriginalExtension();
               //$location = 'public/uloads/banner/' . $filename;
               $location = 'public/uploads/pocket/';
               $image->move($location, $filename);
               $image = $filename;
           }
           if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'pocket' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/pocket/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

           $pocket = Pocket::find($request->id);
           $pocket->thobe_style_id = $request->thobe_style_id;
           $pocket->pocket = $request->pocket;
           $pocket->description=$request->description;
           $pocket->price = $request->price;
           if (!empty($image)) {
               $pocket->image = $image;
           }
           if (!empty($vimage)) {
            $pocket->visible_image = $vimage;
        }
           $pocket->save();
           $notification = array(
               'message' => 'Successfully!',
               'alert-type' => 'success'
           );
           return redirect('thobe-pocket-list')->with($notification);
       }



       public function thobe_cuff_list()

       {

           //$fabric=Fabric_management::orderBy('id', 'DESC')->get();
           $cuff = cuff::join('thobe_styles', 'cuff_managements.thobe_style_id', '=', 'thobe_styles.id')
               ->orderBy('cuff_managements.id', 'DESC')
               ->get(['cuff_managements.*', 'thobe_styles.name']);
           return view('admin.cuff.cuff_list', compact('cuff'));
       }
       public function thobe_cuff_add()
       {
           $thobe = Thobe_style::orderBy('id', 'DESC')->get();
           return view('admin.cuff.cuff_add', compact('thobe'));
       }


       public function thobe_add_cuff(Request $request)
       {

           $validator = Validator::make($request->all(), [
               'thobe_style_id' => 'required',
               'cuff' => 'required',
               'price' => 'required',
               'image' => 'required',
               'visible_image'=>'required',
               'description'=>'required',
           ]);

           if ($validator->fails()) {
               $notification = array(
                   'message' => 'all field required!',
                   'alert-type' => 'error'
               );
               return redirect()->back()->withErrors($validator)
                   ->withInput();
           }

           if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'cuff' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/cuff/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

           $image = '';
           if ($request->hasFile('image')) {
               $image = $request->file('image');
               $filename = 'cuff' . time() . '.' . $image->getClientOriginalExtension();
               //$location = 'public/uloads/banner/' . $filename;
               $location = 'public/uploads/cuff/';
               $image->move($location, $filename);
               $image = $filename;
           }

           $cuff = new Cuff();
           $cuff->thobe_style_id = $request->thobe_style_id;
           $cuff->cuff = $request->cuff;
           $cuff->price = $request->price;
           $cuff->image = $image;
           $cuff->visible_image=$vimage;
           $cuff->description=$request->description;
           $cuff->save();
           $notification = array(
               'message' => 'Successfully!',
               'alert-type' => 'success'
           );
           return redirect('thobe-cuff-list')->with($notification);
       }


       public function thobe_cuff_delete($id)
       {
           $cuff = Cuff::findOrFail($id);
           $cuff->delete();
           $notification = array(
               'message' => 'Deleted!',
               'alert-type' => 'error'
           );
           return redirect('thobe-cuff-list')->with($notification);
       }



       public function thobe_cuff_edit($id)
       {

           $cuff =  Cuff::findOrFail($id);
           $thobe = Thobe_style::orderBy('id', 'DESC')->get();
           return view('admin.cuff.cuff_edit', compact('thobe', 'cuff'));
       }


       public function thobe_cuff_update(Request $request)
       {

           $validator = Validator::make($request->all(), [
               'thobe_style_id' => 'required',
               'cuff' => 'required',
               'price' => 'required',
               'description'=>'required',
           ]);

           if ($validator->fails()) {
               $notification = array(
                   'message' => 'all field required!',
                   'alert-type' => 'error'
               );
               return redirect()->back()->withErrors($validator)
                   ->withInput();
           }
           
           if ($request->hasFile('visible_image')) {
            $vimage = $request->file('visible_image');
            $vfilename = 'cuff' . hexdec(uniqid()). '.' . $vimage->getClientOriginalExtension();
      
            //$location = 'public/uloads/banner/' . $filename;
         
            $location1 = 'public/uploads/cuff/';
            $vimage->move($location1, $vfilename);
            $vimage = $vfilename;
        }

           $image = '';
           if ($request->hasFile('image')) {
               $image = $request->file('image');
               $filename = 'cuff' . time() . '.' . $image->getClientOriginalExtension();
               //$location = 'public/uloads/banner/' . $filename;
               $location = 'public/uploads/cuff/';
               $image->move($location, $filename);
               $image = $filename;
           }

           $cuff = Cuff::find($request->id);
           $cuff->thobe_style_id = $request->thobe_style_id;
           $cuff->cuff = $request->cuff;
           $cuff->description=$request->description;
           $cuff->price = $request->price;
           if (!empty($image)) {
               $cuff->image = $image;
           }
           if (!empty($vimage)) {
            $cuff->visible_image = $vimage;
        }

           $cuff->save();
           $notification = array(
               'message' => 'Successfully!',
               'alert-type' => 'success'
           );
           return redirect('thobe-cuff-list')->with($notification);
       }


}
