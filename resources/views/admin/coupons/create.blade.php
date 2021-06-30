@extends('admin.master')@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Add Coupon</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Add Coupon</li>
      </ol>
    </div>



    <div class="row"> @if(Session::has('success')) {{Session::get('success')}} @endif </div>




	    <div class="row">
        <div class="col-sm-12 col-xs-12">
    <div class="card">
      <div class="cardarea">
        <div class="basic-login-form-ad">

            <div class="all-form-element-inner">
            <form method="POST" action="{{route('coupons.store')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{csrf_field()}}


              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12"> Code </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="code" value="{{old('code')}}" placeholder="Enter Code" />
                  @if($errors->has('code')) <span class="text-danger"> {{$errors->first('code')}}</span>@endif </div>
              </div>




              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Value </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="price" value="{{old('price')}}" placeholder="Enter Price" />
                  @if($errors->has('price')) <span class="text-danger"> {{$errors->first('price')}} </span> @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Description </label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <textarea name="description" id="" class="form-control"  cols="30" rows="10"></textarea>
                  {{-- <input type="text" class="form-control" name="cart_value" value="{{old('cart_value')}}" placeholder="Minimum Cart Amount" /> --}}
                  @if($errors->has('description')) <span class="text-danger"> {{$errors->first('description')}} </span> @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Image</label>
                <div class="col-md-10 col-sm-9 col-xs-12">

                  <input type="file" class="form-control" name="image"   />
                  @if($errors->has('image')) <span class="text-danger">  {{$errors->first('image')}} </span> @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Choose Expiry Date</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="date" class="form-control" name="expiry_date" value="{{old('expiry_date')}}" placeholder="Enter Value" />
                  @if($errors->has('expiry_date')) <span class="text-danger">  {{$errors->first('expiry_date')}} </span> @endif </div>
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
        function preview_images()
        {
            document.getElementById("image_preview").innerHTML = "";
            var total_file=document.getElementById("images").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
            }
        }
    </script>
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
