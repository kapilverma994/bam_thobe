@extends('admin.master')

@section('content')

<div class="basic-form-area mg-b-15">
<div class="container-fluid sparkline13-list">
  <div class="page-header">
    <h2 class="main-content-title">Edit Customer </h2>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"> Edit Customer</li>
    </ol>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12"> @if(Session::has('success')) 
      {{Session::get('success')}}
      @endif </div>
  </div>
  
  
        <div class="row">
        <div class="col-sm-12 col-xs-12">
<div class="card">
	

      <div class="cardarea">
    <div class="basic-login-form-ad">

        <div class="all-form-element-inner">
        <form method="POST" action="{{url('customer-update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" class="form-control" name="id" value="{{$user->id}}"/>
          <div class="form-group-inner row">
            <label class="col-md-2 col-sm-3 col-xs-12">Name</label>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="name" value="{{$user->name}}"/>
              @if($errors->has('name'))
              {{$errors->first('name')}}
              @endif </div>
          </div>
   
          <div class="form-group-inner row">
            <label class="col-md-2 col-sm-3 col-xs-12">Mobile No</label>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="mobile" value="{{$user->mobile}}" readonly/>
              @if($errors->has('mobile'))
              {{$errors->first('mobile')}}
              @endif </div>
          </div>
          <div class="form-group-inner row">
            <label class="col-md-2 col-sm-3 col-xs-12">Email</label>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="email" value="{{$user->email}}" readonly/>
              @if($errors->has('email'))
              {{$errors->first('email')}}
              @endif </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
    $(document).ready(function(){

     $('#myInput').bind('change keyup',function() {
  var id=$("#myInput").val();
    $.ajax({
        url: '{{ url('/add_questions_get_subcat') }}',
        type: 'POST',
        data: {
        	_token: '{{ csrf_token() }}',
            id: id
        },
        dataType: 'html',
        success: function(data)
        {
           $('#subdata').html(data);
        }
    });
});

    });

</script> 