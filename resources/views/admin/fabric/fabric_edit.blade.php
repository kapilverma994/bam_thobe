@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Fabrics</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Fabrics</li>
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
              <form method="POST" action="{{url('fabric_update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Thobe Style</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="thobe_style_id" id="myInput" class="form-control">
                      
        
                      
	@foreach($thobe as $row)
	
                      
        
                      <option value="{{ $row->id }}" <?php echo $fabric->thobe_style_id==$row->id ? 'selected=" "':'';?>>{{ $row->name }}</option>
                      
        
                      
	@endforeach

                    
      
                    </select>
                    @if($errors->has('thobe_style_id'))
                    
                    {{$errors->first('thobe_style_id')}}
                    
                    @endif </div>
                </div>
                
                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Fabrics</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="hidden" class="form-control" name="id" value="{{$fabric->id}}"/>
                    <input type="text" class="form-control" name="fabrics" value="{{$fabric->fabrics}}"/>
                    @if($errors->has('fabrics'))
                    
                    {{$errors->first('fabrics')}}
                    
                    @endif </div>
                </div>

                <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Price</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="price" value="{{$fabric->price}}"/>
                    @if($errors->has('price'))
                    
                    {{$errors->first('price')}}
                    
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