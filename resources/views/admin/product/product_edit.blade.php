@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Product</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
              <form method="POST" action="{{url('product_update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Category</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="category_id" id="myInput" class="form-control">
                      
        
                      
	@foreach($category as $row)
	
                      
        
                      <option value="{{ $row->id }}" <?php echo $product->category_id==$row->id ? 'selected=" "':'';?>>{{ $row->category_name }}</option>
                      
        
                      
	@endforeach

                    
      
                    </select>
                    @if($errors->has('category_id'))
                    
                    {{$errors->first('category_id')}}
                    
                    @endif </div>
                </div>
                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Sub Category</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="sub_category_id" id="subdata" class="form-control">
                      <option selected="true" disabled="disabled">-- Choose Sub Category --</option>
        
                      
	@foreach($subcategory as $row)
	
                      
        
                      <option value="{{ $row->id }}" <?php echo $product->sub_category_id==$row->id ? 'selected=" "':'';?>>{{ $row->sub_category }}</option>
                      
        
                      
	@endforeach

                    
      
                    </select>
                    @if($errors->has('sub_category_id'))
                    
                    {{$errors->first('sub_category_id')}}
                    
                    @endif </div>
                </div>
                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Ability to set product</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="featured" class="form-control">
                      <option selected="true" disabled="disabled">-- Select Ability --</option>
  
                        <option value="trending" <?php echo $product->featured=='trending' ? 'selected=" "':'';?>>trending</option>
                        <option value="featured" <?php echo $product->featured=='featured' ? 'selected=" "':'';?>>featured</option>
                         </select>
                     </div>
                </div> 
                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Title</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="hidden" class="form-control" name="id" value="{{$product->id}}"/>
                    <input type="text" class="form-control" name="title" value="{{$product->title}}"/>
                    @if($errors->has('title'))
                    
                    {{$errors->first('title')}}
                    
                    @endif </div>
                </div>

                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Description</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="description" value="{{$product->description}}"/>
                    @if($errors->has('description'))
                    
                    {{$errors->first('description')}}
                    
                    @endif </div>
                </div>
                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Cost</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="cost" value="{{$product->cost}}"/>
                    @if($errors->has('cost'))
                    
                    {{$errors->first('cost')}}
                    
                    @endif </div>
                </div>
                <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Image</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="file" class="form-control" name="image[]" multiple value="{{old('image')}}"/>
                          @if($errors->has('image'))
                          {{$errors->first('image')}}
                          @endif </div>
                          
                </div>                
               
                
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
@endsection 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
    $(document).ready(function(){

     $('#myInput').bind('change keyup',function() {
  var id=$("#myInput").val();
    $.ajax({
        url: '{{ url('/cat_get_subcat') }}',
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