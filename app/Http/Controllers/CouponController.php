<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Offer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date= Carbon::now()->format('Y-m-d');
        $collar=Coupon::all();
 
  
        return view('admin.coupons.index',compact('collar','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::where('status',1)->get();
       return view('admin.coupons.create',compact('products'));
    }


    public function pincode_status($type,$id){
        $res=Coupon::where('id',$id)->update(['status'=>$type]);
               if($res){
                $notification = array(
                    'message' => 'Coupon Updated Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
               }else{
                   return redirect()->back()->with('error','Oops Something Went Wrong!!');
               }

       }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//  

        $request->validate([

            "code" => "required",

"apply_on"=>'required',
        "price"=>'required',
            "cart_amount"=>'required|numeric',
            "expiry_date" => "required",
         'image'=>'mimes:png,jpg,jpeg'
        ]);
        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'offer' . time() . '.'  .$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/offer/';
            $image->move($location, $filename);
            $image = $filename;
        }
        if($request->products){
            $products=implode(',',$request->products);
        }


$off=new Coupon();
$off->cart_value=$request->cart_amount;
$off->image=$image;
$off->code=$request->code;
$off->type=$request->type;
$off->value=$request->price;
$off->product_id=$products??''; 
$off->coupon_wise=$request->apply_on;
$off->description=$request->description;
$off->expiry_date=$request->expiry_date;
$off->status=1;
$res=$off->save();
      if($res){
        $notification = array(
            'message' => 'Coupon Created Successfully!',
            'alert-type' => 'success'
        );
          return redirect()->route('coupons.index')->with($notification);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $off=Coupon::findorFail($id);
      $checkpro=explode(",",$off->product_id);
   
        $products=Product::where('status',1)->get();
        return view('admin.coupons.edit',compact('off','products','checkpro'));




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $request->validate([

          
             "code" => 'required|unique:coupons,code,'.$id,
             "apply_on"=>'required',
             "price"=>'required',
            "cart_amount"=>'required|numeric',
            "expiry_date" => "required",
            'image'=>'mimes:png,jpg,jpeg'

        ]);
        $off=Coupon::find($id);
      
        $image = $off->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'offer' . time() . '.'  .$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/offer/';
            $image->move($location, $filename);
            $image = $filename;
        }
        if($request->products){
            $products=implode(',',$request->products);
        }


        $off->cart_value=$request->cart_amount;
        $off->image=$image;
        $off->code=$request->code;
        $off->type=$request->type;
        $off->value=$request->price;
        $off->product_id=$products??''; 
        $off->coupon_wise=$request->apply_on;
        $off->description=$request->description;
        $off->expiry_date=$request->expiry_date;
        $off->status=1;
        $res=$off->save();
      if($res){
        $notification = array(
            'message' => 'Coupon Updated Successfully!',
            'alert-type' => 'success'
        );
          return redirect()->route('coupons.index')->with($notification);
      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

     $coupon=Coupon::find($id);
     $res=$coupon->delete();
     if($res){
        $notification = array(
            'message' => 'Deleted Successfully!',
            'alert-type' => 'success'
        );
         return redirect()->back()->with($notification);
     }else{
        $notification = array(
            'message' => 'Opps Something went Wrong!',
            'alert-type' => 'erros'
        );
        return redirect()->route('coupons.index')->with($notification);
     }
    }
}
