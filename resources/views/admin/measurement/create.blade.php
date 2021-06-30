@extends('admin.master')

@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Create Measurement</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Measurement </li>
      </ol>

    </div>

    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea">
            {{-- <button type="button" class="btn btn-primary form-control dt-tb" data-toggle="modal" data-target="#exampleModal">
                Add Pincode
              </button> --}}




<form action="{{route('measurement.store')}}" method="post">
    @csrf

    <div class="form-group-inner row">
        <label class="col-md-2 col-sm-3 col-xs-12">Create Measurement </label>
        <div class="col-md-10 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="name" value="" placeholder="Enter Shop Name" />
          @if($errors->has('expiry_date')) <span class="text-danger">  {{$errors->first('expiry_date')}} </span> @endif </div>
      </div>
      <div class="form-group-inner row">
        <label class="col-md-2 col-sm-3 col-xs-12">Length </label>
        <div class="col-md-10 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="length" value="" placeholder="Enter length" />
          @if($errors->has('length')) <span class="text-danger">  {{$errors->first('length')}} </span> @endif </div>
      </div>
      <div class="form-group-inner row">
        <label class="col-md-2 col-sm-3 col-xs-12">Chest </label>
        <div class="col-md-10 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="chest" value="" placeholder="Enter chest" />
          @if($errors->has('chest')) <span class="text-danger">  {{$errors->first('chest')}} </span> @endif </div>
      </div>
      <div class="form-group-inner row">
        <label class="col-md-2 col-sm-3 col-xs-12">Shoulder </label>
        <div class="col-md-10 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="shoulder" value="" placeholder="Enter shoulder " />
          @if($errors->has('shoulder')) <span class="text-danger">  {{$errors->first('shoulder')}} </span> @endif </div>
      </div>
      <div class="form-group-inner row">
        <label class="col-md-2 col-sm-3 col-xs-12">Sleeve </label>
        <div class="col-md-10 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="sleeve" value="" placeholder="Enter sleeve" />
          @if($errors->has('sleeve')) <span class="text-danger">  {{$errors->first('sleeve')}} </span> @endif </div>
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




<!-- Modal -->

@endsection




