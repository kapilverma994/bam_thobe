@extends('admin.master')
@section('content')


<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Add Coupon</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Add Coupon</li>
      </ol>
    </div>



    <div class="row"> @if(Session::has('success')) {{Session::get('success')}} @endif </div>




	    <div class="row">
        <div class="col-sm-12 col-xs-12">
    <div class="card">
      <div class="cardarea">
        <div class="basic-login-form-ad">

            <div class="all-form-element-inner">
            <form method="POST" action="{{route('coupons.store')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{csrf_field()}}


              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12"> Code </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="code" value="{{old('code')}}" placeholder="Enter Code" />
                  @if($errors->has('code')) <span class="text-danger"> {{$errors->first('code')}}</span>@endif </div>
              </div>

              <div class="form-group-inner row" >
                <label class="col-md-2 col-sm-3 col-xs-12"> Coupon Discount On </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
              
                  <select name="apply_on" id="apply_on"  class="form-control" id="" required onchange="func(this)">
<option value="blank">Choose Type</option>
<option value="product">Product</option>
<option value="customize">Customize</option>
<option value="card">Card</option>
                  </select>
                  @if($errors->has('type')) <span class="text-danger"> {{$errors->first('type')}}</span>@endif </div>
              </div>

              <div class="form-group-inner d-none row" id= "disc">
                <label class="col-md-2 col-sm-3 col-xs-12"> Type </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
              
                  <select name="type" class="form-control" id="" >
<option value="">Choose Type</option>
<option value="fixed">Fixed</option>
<option value="percentage">Percentage</option>
                  </select>
                  @if($errors->has('type')) <span class="text-danger"> {{$errors->first('type')}}</span>@endif </div>
              </div>

       


      
   <div class="form-group-inner row d-none " id="product" >
                <label class="col-md-2 col-sm-3 col-xs-12"> Choose Product </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
              
                  <select name="products[]" class="form-control js-example-basic-multiple" multiple="multiple" >
<option value="" class="">Choose Product</option>
@foreach($products as $pro)

<option value="{{$pro->id}}">{{$pro->title}}</option>
@endforeach

                  </select>
                  @if($errors->has('product')) <span class="text-danger"> {{$errors->first('product')}}</span>@endif 
                </div>

              </div>
          

        

            



              <div class="form-group-inner row" style="">
                <label class="col-md-2 col-sm-3 col-xs-12">Value </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="price" value="{{old('price')}}" placeholder="Enter Price" />
                  @if($errors->has('price')) <span class="text-danger"> {{$errors->first('price')}} </span> @endif </div>
              </div>


 <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Minimum Cart Amount </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="cart_amount" value="{{old('cart_amount')}}" placeholder="Enter Price" />
                  @if($errors->has('cart_amount')) <span class="text-danger"> {{$errors->first('cart_amount')}} </span> @endif </div>
              </div>

              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Description </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <textarea name="description" id="" class="form-control"  cols="30" rows="10"></textarea>
                  {{-- <input type="text" class="form-control" name="cart_value" value="{{old('cart_value')}}" placeholder="Minimum Cart Amount" /> --}}
                  @if($errors->has('description')) <span class="text-danger"> {{$errors->first('description')}} </span> @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Image</label>
                <div class="col-md-10 col-sm-9 col-xs-12">

                  <input type="file" class="form-control" name="image"   />
                  @if($errors->has('image')) <span class="text-danger">  {{$errors->first('image')}} </span> @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Choose Expiry Date</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="date" class="form-control" name="expiry_date" value="{{old('expiry_date')}}" placeholder="Enter Value" />
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
@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>


function func(event){
  if(event.value == "product"){
    document.getElementById("product").classList.remove("d-none")
    document.getElementById("disc").classList.remove("d-none")
  }
  else{
    document.getElementById("product").classList.add("d-none")
    document.getElementById("disc").classList.add("d-none")
  }
}
  </script>


<style>
  .js-example-basic-multiple {
    width: 500px !important;
    height: 100% !important;
}
.select2-container{    width: 100% !important;}

</style>
@endpush