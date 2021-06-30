@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Terms & Condition</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Terms & Condition</li>
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
          <form method="POST" action="{{url('terms_update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
            {{csrf_field()}}


                <div class="form-group-inner row">
                    <label class="col-md-2 col-sm-3 col-xs-12">Terms & Condition</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="hidden" class="form-control" name="id" value="{{$data->id}}"/>
                  <textarea name="terms" id="" class="form-control" cols="30" rows="10">{{$data->terms}}</textarea>

                  @if($errors->has('terms'))

                  {{$errors->first('terms')}}

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
