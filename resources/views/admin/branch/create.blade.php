@extends('admin.master')@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Add Branch</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Add Branch</li>
      </ol>
    </div>
	
	
	
    <div class="row"> @if(Session::has('success')) {{Session::get('success')}} @endif </div>

	
	
	
	    <div class="row">
        <div class="col-sm-12 col-xs-12">
    <div class="card">
      <div class="cardarea">
        <div class="basic-login-form-ad">
       
            <div class="all-form-element-inner">
            <form method="POST" action="{{route('branch.store')}}" class="form-horizontal form-label-left">
              {{csrf_field()}}
        
                <input type="hidden" id="latitude" name="latitude" value="">
                <input type="hidden" id="longitude" name="longitude" value="">
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Branch Name </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="name" value="{{old('name')}}" />
                  @if($errors->has('name')) {{$errors->first('name')}} @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Contact Number </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="mobile_no" value="{{old('mobile_no')}}" />
                  @if($errors->has('mobile_no')) {{$errors->first('mobile_no')}} @endif </div>
              </div>
              
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Address</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <textarea name="address"  class="form-control" onkeyup="getSourceLatLong(this.value)" id="" cols="10" rows="5"></textarea>
             
                  @if($errors->has('address')) {{$errors->first('address')}} @endif </div>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script>
        function getSourceLatLong(address) {
        console.log(address);
        var response = '';
        $.get('https://maps.googleapis.com/maps/api/geocode/json?address='+address+'&key=AIzaSyBcyqDtmrobvX9IRFIbjbnEslaGPbwvA30')
        .done(function(data, status){
            if(status == 'success') {
                if (data.results[0].geometry) {
                    $('#latitude').val(data.results[0].geometry.location.lat);
                    $('#longitude').val(data.results[0].geometry.location.lng);
                }
            } else {
                $.alert({
                    title: '<span style="color:red">Error</span>',
                    content: 'Oops! Something went wrong. Please try again.',
                });
            }
        })
        .fail(function(xhr, status, error) {
                $.alert({
                    title: '<span style="color:red">Error</span>',
                    content: 'Oops! Something went wrong. Please try again.',
                });
        });
        return response;
    }


  
        </script>
            
@endpush
