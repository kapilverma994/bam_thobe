@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Sliders</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Sliders</li>
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
          <form method="POST" action="{{url('slider_update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Main title</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="hidden" class="form-control" name="id" value="{{$slider->id}}"/>
                          <input type="text" class="form-control" name="main_title" value="{{$slider->main_title}}"/>
                          @if($errors->has('main_title'))
                          {{$errors->first('main_title')}}
                          @endif </div>
                      </div>
                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Sub title</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="sub_title" value="{{$slider->sub_title}}"/>
                          @if($errors->has('sub_title'))
                          {{$errors->first('sub_title')}}
                          @endif </div>
                      </div>
                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Short title</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="short_title" value="{{$slider->short_title}}"/>
                          @if($errors->has('short_title'))
                          {{$errors->first('short_title')}}
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