@extends('admin.master')

@section('content')

<div class="basic-form-area mg-b-15">
<div class="container-fluid">
<br><br>

<div class="row">
	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="sparkline12-list">
<div class="sparkline12-hd">
<div class="main-sparkline12-hd">
<h1></h1>
</div>
</div>
<div class="row">
	<div>
@if(Session::has('success')) 
	{{Session::get('success')}}
		@endif
	</div>
		
	</div>
<div class="sparkline12-graph">
<div class="basic-login-form-ad">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="all-form-element-inner">
<form method="POST" action="{{url('subjectsave')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
 {{csrf_field()}}
 <div class="form-group-inner">
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
<label class="login2 pull-right pull-right-pro">Select Course</label>
</div>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
<div class="form-select-list">
<select class="form-control custom-select-value" name="course_id">
	<option selected="true" disabled="disabled">-- Choose Course --</option>
	@foreach($course as $row)
	<option value="{{$row->id}}">{{$row->course_type}}</option>
 	@endforeach
</select>
@if($errors->has('course_id'))
	{{$errors->first('course_id')}}
@endif
</div>
</div>
</div>
</div>
<div class="form-group-inner">
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
<label class="login2 pull-right pull-right-pro">Subject</label>
</div>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
<input type="text" class="form-control" name="subjectt" value="{{old('subjectt')}}"/>
@if($errors->has('subjectt'))
	{{$errors->first('subjectt')}}
@endif
</div>
</div>
</div>

</div>
</div>
<div class="form-group-inner">
<div class="login-btn-inner">
<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-9">
<div class="login-horizental cancel-wp pull-left form-bc-ele">
<button class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
</div>
</div>
</div>
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
</div>
</div>

@endsection