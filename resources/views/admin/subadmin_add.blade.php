@extends('admin.master')@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Form</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Form</li>
      </ol>
    </div>
	
	
	
    <div class="row"> @if(Session::has('success')) {{Session::get('success')}} @endif </div>

	
	
	
	    <div class="row">
        <div class="col-sm-12 col-xs-12">
    <div class="card">
      <div class="cardarea">
        <div class="basic-login-form-ad">
       
            <div class="all-form-element-inner">
            <form method="POST" action="{{url('add-admin')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Name </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="name" value="{{old('name')}}" />
                  @if($errors->has('name')) {{$errors->first('name')}} @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Email</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="email" value="{{old('email')}}" />
                  @if($errors->has('email')) {{$errors->first('email')}} @endif </div>
              </div>
              
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Password</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="password" class="form-control" name="password" value="{{old('password')}}" />
                  @if($errors->has('password')) {{$errors->first('password')}} @endif </div>
              </div>
              <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Role</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="role_id[]" class="form-control" multiple>
                      <option selected="true" disabled="disabled">-- Select Role --</option>
                        
                      @foreach($role as $row)
  
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                         
                      @endforeach

                    </select>
                    @if($errors->has('role_id'))
                    
                    {{$errors->first('role_id')}}
                    
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
$(document).ready(function() {
	$('#myInput').bind('change keyup', function() {
		var id = $("#myInput").val();
		$.ajax({
			url: '{{ url(' / add_questions_get_subcat ') }}',
			type: 'POST',
			data: {
				_token: '{{ csrf_token() }}',
				id: id
			},
			dataType: 'html',
			success: function(data) {
				$('#subdata').html(data);
			}
		});
	});
});
</script>