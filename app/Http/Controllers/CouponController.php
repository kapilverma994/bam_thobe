<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Offer;
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
        $collar=Offer::all();
        return view('admin.coupons.index',compact('collar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.coupons.create');
    }


    public function pincode_status($type,$id){
        $res=Offer::where('id',$id)->update(['status'=>$type]);
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


        $request->validate([

            "code" => "required",

            "price" => "required|numeric",
           
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

$off=new Offer();
$off->price=$request->price;
$off->image=$image;
$off->code=$request->code;
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


        $off=Offer::findorFail($id);
        return view('admin.coupons.edit',compact('off'));




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

            "code" => "required",

            "price" => "required|numeric",
      
            "expiry_date" => "required",
            'image'=>'mimes:png,jpg,jpeg'

        ]);
        $off=Offer::find($id);
        $image = $off->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'offer' . time() . '.'  .$image->getClientOriginalExtension();
            //$location = 'public/uloads/banner/' . $filename;
            $location = 'public/uploads/offer/';
            $image->move($location, $filename);
            $image = $filename;
        }


$off->price=$request->price;
$off->image=$image;
$off->code=$request->code;
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

     $coupon=Offer::find($id);
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
