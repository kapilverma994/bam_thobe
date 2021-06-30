@extends('admin.master')

@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Add Sub Category</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Sub Category</li>
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
              <form method="POST" action="{{url('add_sub_categories')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Category</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="category_id" class="form-control">
                      <option selected="true" disabled="disabled">-- Choose Sub Category --</option>
                      
                     
                          
	@foreach($category as $row)
	
                          
                          
                    
                      <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                      
                    
                          
                          
	@endforeach

                        
                        
                  
                    </select>
                    @if($errors->has('category_id'))
                    
                    {{$errors->first('category_id')}}
                    
                    @endif </div>
                </div>
                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Sub Category</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="sub_category" value="{{old('sub_category')}}" />
                    @if($errors->has('sub_category'))
                    {{$errors->first('sub_category')}}
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