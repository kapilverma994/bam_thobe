@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Category</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
          <form method="POST" action="{{url('category_update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Type</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="cat_type" class="form-control">
                      <option selected="true" disabled="disabled">-- Choose Type --</option>
                          
                       <option value="special" <?php echo $category->type=='special' ? 'selected=" "':'';?>>Special</option>
                       <option value="normal" <?php echo $category->type=='normal' ? 'selected=" "':'';?>>Normal</option>
                    </select>
                    @if($errors->has('cat_type'))
                    
                    {{$errors->first('cat_type')}}
                    
                    @endif </div>
                </div>
                <div class="form-group-inner row">
                    <label class="col-md-2 col-sm-3 col-xs-12">Category Name</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="hidden" class="form-control" name="id" value="{{$category->id}}"/>
                  <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}" />
                  @if($errors->has('category_name'))
                  
                  {{$errors->first('category_name')}}
                  
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