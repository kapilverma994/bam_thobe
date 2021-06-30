<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $branchs=Branch::all();

        return view('admin.branch.index',compact('branchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branch.create');
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
           'address'=>'required'
       ]);
       $bra=new Branch();
       $bra->branch=$request->name;
       $bra->address=$request->address;
       $bra->lat=$request->latitude;
       $bra->lng=$request->longitude;
       $bra->save();
       $notification = array(
        'message' => 'Branch Created Successfully!',
        'alert-type' => 'success'
    );
       return redirect()->route('branch.index')->with($notification);
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
   $branch=Branch::findorFail($id);
return view('admin.branch.edit',compact('branch'));
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
            'address'=>'required'
        ]);
        $branch=Branch::findorfail($id);
        $branch->branch=$request->name;
        $branch->address=$request->address;
        $branch->save();
        $notification = array(
            'message' => 'Branch Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('branch.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch=Branch::findorfail($id)->delete();
        $notification = array(
            'message' => 'Branch Deleted Successfully!',
            'alert-type' => 'success'
        );
return redirect()->back()->with($notification);        
    }
}
