<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{





    public function manage_faq(){
        $data=Setting::find(1);

        return view('admin.faq',compact('data'));
    }


    public function update_faq(Request $request){
        $request->validate([
            'faq'=>'required',
        ]);
        $set=Setting::find($request->id);
    $set->faq=$request->faq;
    $res=$set->save();
    if($res){
        $notification = array(
            'message' => 'Faq Updated Successfully!',
            'alert-type' => 'success'
        );
          return redirect()->route('faq')->with($notification);
    }

    }



    public function manage_policy(){
        $data=Setting::find(1);

        return view('admin.privacy_policy',compact('data'));
    }


    public function update_policy(Request $request){
        $request->validate([
            'policy'=>'required',
        ]);
        $set=Setting::find($request->id);
    $set->privacy=$request->policy;
    $res=$set->save();
    if($res){
        $notification = array(
            'message' => 'Privacy & Policy  Updated Successfully!',
            'alert-type' => 'success'
        );
          return redirect()->route('policy')->with($notification);
    }

    }




public function manage_terms(){
    $data=Setting::find(1);

    return view('admin.terms_condition',compact('data'));
}


public function update_terms(Request $request){
    $request->validate([
        'terms'=>'required',
    ]);
    $set=Setting::find($request->id);
$set->terms=$request->terms;
$res=$set->save();
if($res){
    $notification = array(
        'message' => 'Terms & Condition  Updated Successfully!',
        'alert-type' => 'success'
    );
      return redirect()->route('terms')->with($notification);
}

}



public function manage_about(){
    $data=Setting::find(1);

    return view('admin.about_us',compact('data'));
}



public function update_about(Request $request ){
    $request->validate([
        'about_us'=>'required',
    ]);
$set=Setting::find($request->id);
$set->about_us=$request->about_us;
$res=$set->save();
if($res){
    $notification = array(
        'message' => 'About Us Updated Successfully!',
        'alert-type' => 'success'
    );
      return redirect()->route('about_us')->with($notification);
}
}



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       $setting=Setting::where('id',$id)->first();

       return view('admin.setting',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     $request->validate([
        "title" =>'required',
        "email" => 'required|email',
        "phone" => 'required|digits:10',
        "address" => 'required',
        "meta_tag" =>'required',
        "gst_no" => 'required',
        "public_key" =>'required',
        "private_key" => 'required',
        "loyality_point" =>'required|numeric',
        "apikey" =>'required',
        'buffer_date'=>'required|numeric',

     ]);
  $set=Setting::find($id);
  $set->app_name=$request->title;
  $set->buffer_date=$request->buffer_date;
  $set->email=$request->email;
  $set->phone=$request->phone;
  $set->address=$request->address;
  $set->meta_tag=$request->meta_tag;
  $set->gst_no=$request->gst_no;
  $set->public_key=$request->public_key;
  $set->private_key=$request->private_key;
  $set->apikey=$request->apikey;

  $image = $set->logo;
  if ($request->hasFile('image')) {
      $image = $request->file('image');
      $filename = 'logo' . time() . '.' . $image->getClientOriginalExtension();


      $location = 'public/uploads/logo/';
      $image->move($location, $filename);
      $image = $filename;
      

  }
  $set->logo=$image;
 $res=$set->save();
 if($res){
    $notification = array(
        'message' => 'Setting Updated Successfully!',
        'alert-type' => 'success'
    );
      return redirect()->route('setting.edit',1)->with($notification);

 }

    }



}
