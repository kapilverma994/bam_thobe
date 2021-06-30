@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Role</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
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
          <form method="POST" action="{{url('role_update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12">Name</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="hidden" class="form-control" name="id" value="{{$role->id}}"/>
                          <input type="text" class="form-control" name="name" value="{{$role->name}}"/>
                          @if($errors->has('name'))
                          {{$errors->first('name')}}
                          @endif </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Category</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="category" value="1" <?php echo $role->category==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Thobe management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="thobemanage" value="1" <?php echo $role->thobemanage==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Coupon management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="coupon" value="1" <?php echo $role->coupon==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Pin code management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="pincode" value="1" <?php echo $role->pincode==1 ? 'checked=" "':'';?>/>
                         </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Manage role</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="role" value="1" <?php echo $role->role==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Manage users</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="manageusers" value="1" <?php echo $role->manageusers==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Manage orders</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="orders" value="1" <?php echo $role->orders==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Manage CMS</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="cms" value="1" <?php echo $role->cms==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Store management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="store" value="1" <?php echo $role->store==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Sliders</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="sliders" value="1" <?php echo $role->sliders==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Basic settings</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="basicsetting" value="1" <?php echo $role->basicsetting==1 ? 'checked=" "':'';?>/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Measurement management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="measurement" value="1" <?php echo $role->measurement==1 ? 'checked=" "':'';?>/>
                          </div>
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