@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Store</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Store</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xs-12"> @if(Session::has('success')) 
        
        {{Session::get('success')}}
        
        @endif </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <div class="card">
          <div class="cardarea">
            <div class="basic-login-form-ad">
            <div class="all-form-element-inner">
          <form method="POST" action="{{url('store_update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
            {{csrf_field()}}
                {{-- <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12">Pincode</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="hidden" class="form-control" name="id" value="{{$store->id}}"/>
                          <input type="text" class="form-control" name="pincode" value="{{$store->pincode}}"/>
                          @if($errors->has('pincode'))
                          {{$errors->first('pincode')}}
                          @endif </div>
                      </div> --}}
                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12">Store Name</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="name" value="{{$store->store_name}}"/>
                          @if($errors->has('name'))
                          {{$errors->first('name')}}
                          @endif </div>
                      </div>
                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12">Manager Name</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="manager_name" value="{{$store->manager_name}}"/>
                          @if($errors->has('manager_name'))
                          {{$errors->first('manager_name')}}
                          @endif </div>
                      </div>
                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12">Contact</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="contact" value="{{$store->contact}}"/>
                          @if($errors->has('contact'))
                          {{$errors->first('contact')}}
                          @endif </div>
                      </div>
                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Address</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="address" value="{{$store->address}}"/>
                          @if($errors->has('address'))
                          {{$errors->first('address')}}
                          @endif </div>
                      </div>
                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Image</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="file" class="form-control" name="image" value="{{old('image')}}"/>
                          @if($errors->has('image'))
                          {{$errors->first('image')}}
                          @endif </div>
                      </div>
                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Visit Charge</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="number" class="form-control" name="visit_charge"  value="{{$store->visit_charge}}"/>
                          @if($errors->has('visit_charge'))
                          {{$errors->first('visit_charge')}}
                          @endif </div>
                      </div>
                      <div class="form-group-inner row">
                        <div class="col-md-2 col-sm-3 col-xs-12"></div>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                                         <button class="btn btn-primary w-110" type="submit">Update</button>
                        </div>
                      </div>
          
		  
		  
		  </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

@endsection