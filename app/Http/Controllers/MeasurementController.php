<?php

namespace App\Http\Controllers;
use App\Models\Measurment;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Measurment::all();
        return view('admin.measurement.index',compact('data'));
    }


    public function measurement_status($type,$id){
        $res=Measurment::where('id',$id)->update(['status'=>$type]);
               if($res){
                $notification = array(
                    'message' => 'Updated Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
               }else{
                   return redirect()->back()->with('error','Oops Something Went Wrong!!');
               }

       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('admin.measurement.create');
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
         'name'=>'required',
         'length'=>'required',
         'chest'=>'required',
         'shoulder'=>'required',
         'sleeve'=>'required',
     ]);
     $data=new Measurment();
    $data->name=$request->name;
    $data->length=$request->length;
    $data->chest=$request->chest;
    $data->shoulder=$request->shoulder;
    $data->sleeve=$request->sleeve;
    $data->status=1;
    $res= $data->save();

     if($res){
        $notification = array(
            'message' => 'Shop Created Successfully!',
            'alert-type' => 'success'
        );
         return redirect()->route('measurement.index')->with($notification);
     }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Measurment::findorfail($id);
        return view('admin.measurement.edit',compact('data'));
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
            'name'=>'required',
            'length'=>'required',
            'chest'=>'required',
            'shoulder'=>'required',
            'sleeve'=>'required',
        ]);
        $data=Measurment::findorfail($id);
        $data->name=$request->name;
        $data->length=$request->length;
        $data->chest=$request->chest;
        $data->shoulder=$request->shoulder;
        $data->sleeve=$request->sleeve;
       $res= $data->save();
        if($res){
            $notification = array(
                'message' => 'Shop Updated Successfully!',
                'alert-type' => 'success'
            );
             return redirect()->route('measurement.index')->with($notification);

    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $data=Measurment::findorfail($id);
     $data->delete();
     $notification = array(
        'message' => 'Deleted Successfully!',
        'alert-type' => 'success'
    );
     return redirect()->back()->with($notification);
    }
}
