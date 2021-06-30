@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Setting</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Setting</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xs-12"> @if(Session::has('success'))

        {{Session::get('success')}}

        @endif </div>
    </div>
    <div class="row">
        <div class="card">
          <div class="cardarea">
            <div class="basic-login-form-ad">
            <div class="all-form-element-inner">


          <form method="POST" action="{{route('setting.update',$setting->id)}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
            @method('PUT')
            {{csrf_field()}}


                <div class="form-group-inner row">
                    <label class="col-md-2 col-sm-3 col-xs-12">Website Title</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">

                  <input type="text" class="form-control" name="title" value="{{$setting->app_name}}" />
                  @if($errors->has('title'))

                  {{$errors->first('title')}}

                  @endif </div>
              </div>
              <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12">Contact Email</label>
                <div class="col-md-10 col-sm-9 col-xs-12">

              <input type="text" class="form-control" name="email" value="{{$setting->email}}" />
              @if($errors->has('email'))

              {{$errors->first('email')}}

              @endif </div>
          </div>
          <div class="form-group-inner row">
            <label class="col-md-2 col-sm-3 col-xs-12">Contact Phone</label>
            <div class="col-md-10 col-sm-9 col-xs-12">

          <input type="text" class="form-control" name="phone" value="{{$setting->phone}}" />
          @if($errors->has('phone'))

          {{$errors->first('phone')}}

          @endif </div>
      </div>

      <div class="form-group-inner row">
        <label class="col-md-2 col-sm-3 col-xs-12">Contact Address</label>
        <div class="col-md-10 col-sm-9 col-xs-12">
<textarea name="address" id="" class="form-control" cols="30" rows="10">{{$setting->address}}</textarea>

      @if($errors->has('address'))

      {{$errors->first('address')}}

      @endif </div>
  </div>

  <div class="form-group-inner row">
    <label class="col-md-2 col-sm-3 col-xs-12">Meta Tag</label>
    <div class="col-md-10 col-sm-9 col-xs-12">
<textarea name="meta_tag" id="" class="form-control" cols="30" rows="10">{{$setting->meta_tag}}</textarea>

  @if($errors->has('meta_tag'))

  {{$errors->first('meta_tag')}}

  @endif </div>
</div>

  <div class="form-group-inner row">
    <label class="col-md-2 col-sm-3 col-xs-12">GST NO</label>
    <div class="col-md-10 col-sm-9 col-xs-12">

  <input type="text" class="form-control" name="gst_no" value="{{$setting->gst_no}}" />
  @if($errors->has('gst_no'))

  {{$errors->first('gst_no')}}

  @endif </div>
</div>
            <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Logo</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="file" class="form-control" name="image" value="{{$setting->logo}}"/>
                          @if($errors->has('image'))
                          {{$errors->first('image')}}
                          @endif </div>

                </div>
                <div class="form-group-inner row">
                    <label class="col-md-2 col-sm-3 col-xs-12"> Public Key</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="public_key" value="{{$setting->public_key}}"/>
                      @if($errors->has('public_key'))
                      {{$errors->first('public_key')}}
                      @endif </div>

            </div>
            <div class="form-group-inner row">
                <label class="col-md-2 col-sm-3 col-xs-12"> Private Key</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="private_key" value="{{$setting->private_key}}"/>
                  @if($errors->has('private_key'))
                  {{$errors->first('private_key')}}
                  @endif </div>

        </div>

        <div class="form-group-inner row">
            <label class="col-md-2 col-sm-3 col-xs-12">Loyality Point Generate Amount</label>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="loyality_point" value="{{$setting->loyality_point}}"/>
              @if($errors->has('loyality_point'))
              {{$errors->first('loyality_point')}}
              @endif </div>

    </div>

    <div class="form-group-inner row">
            <label class="col-md-2 col-sm-3 col-xs-12">API KEY</label>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="apikey" value="{{$setting->apikey}}"/>
              @if($errors->has('apikey'))
              {{$errors->first('apikey')}}
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
