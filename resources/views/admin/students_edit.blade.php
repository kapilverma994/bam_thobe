@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Mock Question</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Mock Question</li>
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
            <form method="POST" action="{{url('student_update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{csrf_field()}}
            <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12">Type</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="student_type" class="form-control">
                      <option value="standard" <?php echo 'standard'==$student->student_type ? 'selected=" "':'';?>>standard</option>
                      <option value="premium" <?php echo 'premium'==$student->student_type ? 'selected=" "':'';?>>premium</option>
                    </select>
                    @if($errors->has('student_type'))
                    
                    {{$errors->first('student_type')}}
                    
                    @endif </div>
                </div>
           
            <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12">Package</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="package" class="form-control">
                      <option selected="true" disabled="disabled">-- Choose Package --</option>
                      
	@foreach($package as $row)
	
                      <option value="{{$row->id}}" <?php echo $row->id==$student->package ? 'selected=" "':'';?>>{{$row->month}} ({{$row->price}})</option>
                      
	@endforeach

                    </select>
                    @if($errors->has('student_type'))
                    
                    {{$errors->first('student_type')}}
                    
                    @endif </div>
                </div>
       
            <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12">Full Name</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="hidden" class="form-control" name="id" value="{{$student->id}}"/>
                    <input type="text" class="form-control" name="name" value="{{$student->name}}"/>
                    @if($errors->has('name'))
                    
                    {{$errors->first('name')}}
                    
                    @endif </div>
                </div>
         
            <!-- <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12">Mobile</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="mobile" value="{{$student->mobile}}"/>
                    @if($errors->has('mobile'))
                    
                    {{$errors->first('mobile')}}
                    
                    @endif </div>
                </div> -->
         
            <!-- <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12">Address</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="address" value="{{$student->address}}"/>
                    @if($errors->has('address'))
                    
                    {{$errors->first('address')}}
                    
                    @endif </div>
                </div> -->
          
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