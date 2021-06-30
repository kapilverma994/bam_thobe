@extends('admin.master')@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Update Coupon</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Update Coupon</li>
      </ol>
    </div>



    <div class="row"> @if(Session::has('success')) {{Session::get('success')}} @endif </div>




	    <div class="row">
        <div class="col-sm-12 col-xs-12">
    <div class="card">
      <div class="cardarea">
        <div class="basic-login-form-ad">

            <div class="all-form-element-inner">
            <form method="POST" action="{{route('coupons.update',$off->id)}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{csrf_field()}}
@method('PUT')

              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12"> Code </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="code" value="{{$off->code}}" placeholder="Enter Code" />
                  @if($errors->has('code')) <span class="text-danger"> {{$errors->first('code')}}</span>@endif </div>
              </div>




              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Value </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="price" value="{{$off->price}}" placeholder="Enter Price" />
                  @if($errors->has('price')) <span class="text-danger"> {{$errors->first('price')}} </span> @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Description </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <textarea name="description" id="" class="form-control"  cols="30" rows="10">{{$off->description}}</textarea>
                  {{-- <input type="text" class="form-control" name="cart_value" value="{{old('cart_value')}}" placeholder="Minimum Cart Amount" /> --}}
                  @if($errors->has('description')) <span class="text-danger"> {{$errors->first('description')}} </span> @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Image</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <img src="{{asset('uploads/offer/'.$off->image)}}" height="100px" width="100px" alt="">
                  <input type="file" class="form-control" name="image" value="{{old('image')}}"  />
                  @if($errors->has('image')) <span class="text-danger">  {{$errors->first('image')}} </span> @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Choose Expiry Date</label>
                <div class="col-md-10 col-sm-9 col-xs-12">

                  <input type="date" class="form-control" name="expiry_date" value="{{$off->expiry_date}}" placeholder="Enter Value" />
                  @if($errors->has('expiry_date')) <span class="text-danger">  {{$errors->first('expiry_date')}} </span> @endif </div>
              </div>



              <div class="form-group-inner row">
                <div class="col-md-2 col-sm-3 col-xs-12"></div>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <button class="btn btn-primary w-110" type="submit">Submit</button>
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


