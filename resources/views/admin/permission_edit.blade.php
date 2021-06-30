@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Permission</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
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
                <form method="POST" action="{{url('permission-update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group-inner row">
                    <div class="col-md-2 col-sm-3 col-xs-12">
                      <input type="hidden" class="form-control" name="id" value="{{$permission->id}}"/>
                      <label >Sub Admin</label>
                    </div>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                      <select name="sub_admin" class="form-control">
                        <option selected="true" disabled="disabled">-- Choose sub admin --</option>
                                
	@foreach($subadmin as $row)                
                        <option value="{{ $row->id }}" <?php echo $permission->sub_admin==$row->id ? 'selected=" "':'';?>>{{ $row->fname }}</option>
                           
	@endforeach
                      </select>
                      @if($errors->has('sub_admin'))
                      
                      {{$errors->first('sub_admin')}}
                      
                      @endif </div>
                  </div>
                  <div class="form-group-inner row">
                    <label class="col-md-2 col-sm-3 col-xs-12">Practice test</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                      <input type="checkbox" class="form-control" value="1" name="practice" <?php echo $permission->practice==1 ? 'checked=" "':'';?>/>
                      @if($errors->has('practice'))
                      {{$errors->first('practice')}}
                      @endif </div>
                  </div>
                  <div class="form-group-inner row">
                    <label class="col-md-2 col-sm-3 col-xs-12">Mock exams</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                      <input type="checkbox" class="form-control" value="1" name="mock" <?php echo $permission->mock==1 ? 'checked=" "':'';?>/>
                      @if($errors->has('mock'))
                      {{$errors->first('mock')}}
                      @endif </div>
                  </div>
                  <div class="form-group-inner row">
                    <label class="col-md-2 col-sm-3 col-xs-12">Students</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                      <input type="checkbox" class="form-control" value="1" name="student" <?php echo $permission->student==1 ? 'checked=" "':'';?>/>
                      @if($errors->has('student'))
                      {{$errors->first('student')}}
                      @endif </div>
                  </div>
                  <div class="form-group-inner row">
                    <label class="col-md-2 col-sm-3 col-xs-12">Package</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                      <input type="checkbox" class="form-control" value="1" name="package" <?php echo $permission->package==1 ? 'checked=" "':'';?>/>
                      @if($errors->has('package'))
                      {{$errors->first('package')}}
                      @endif </div>
                  </div>
                  <div class="form-group-inner row">
                    <label class="col-md-2 col-sm-3 col-xs-12">Dictionary</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                      <input type="checkbox" class="form-control" value="1" name="dictionary" <?php echo $permission->dictionary==1 ? 'checked=" "':'';?>/>
                      @if($errors->has('dictionary'))
                      {{$errors->first('dictionary')}}
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
</div>
</div>
@endsection