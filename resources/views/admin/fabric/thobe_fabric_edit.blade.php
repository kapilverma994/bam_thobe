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
              <form method="POST" action="{{url('thobe-fabric-update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
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
                  <label class="col-md-2 col-sm-3 col-xs-12"> Choose Type</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="type" id="myInput" class="form-control">
                      <option selected="true" disabled="disabled">-- Choose Type --</option>

                    

                        <option value="Summer" {{$fabric->type=="Summer"?'selected':''}} >Summer</option>
                        <option value="Winter" {{$fabric->type=="Winter"?'selected':''}}>Winter</option>

                    
                    </select>
                    @if($errors->has('type'))

                    {{$errors->first('type')}}

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
                  <label class="col-md-2 col-sm-3 col-xs-12">Color Code </label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="color_code" value="{{$fabric->color_code}}" />
                    @if($errors->has('color_code')) {{$errors->first('color_code')}} @endif </div>
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
                  <label class="col-md-2 col-sm-3 col-xs-12">Quantity</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <input type="number" class="form-control"  name="quantity" value="{{$fabric->quantity}}" />
                    @if($errors->has('quantity')) {{$errors->first('quantity')}} @endif </div>
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
                  <label class="col-md-2 col-sm-3 col-xs-12"> Description</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                <textarea name="description" class="form-control" id="" cols="30" rows="10">{{$fabric->description}}</textarea>
                    @if($errors->has('description'))
                    {{$errors->first('description')}}
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
