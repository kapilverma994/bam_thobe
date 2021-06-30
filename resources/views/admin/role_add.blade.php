@extends('admin.master')

@section('content')
<style>
.MultiCheckBox {
            border:1px solid #e2e2e2;
            padding: 5px;
            border-radius:4px;
            cursor:pointer;
        }

        .MultiCheckBox .k-icon{ 
            font-size: 15px;
            float: right;
            font-weight: bolder;
            margin-top: -7px;
            height: 10px;
            width: 14px;
            color:#787878;
        } 

        .MultiCheckBoxDetail {
            display:none;
            position:absolute;
            border:1px solid #e2e2e2;
            overflow-y:hidden;
        }

        .MultiCheckBoxDetailBody {
            overflow-y:scroll;
        }

            .MultiCheckBoxDetail .cont  {
                clear:both;
                overflow: hidden;
                padding: 2px;
            }

            .MultiCheckBoxDetail .cont:hover  {
                background-color:#cfcfcf;
            }

            .MultiCheckBoxDetailBody > div > div {
                float:left;
            }

        .MultiCheckBoxDetail>div>div:nth-child(1) {
        
        }

        .MultiCheckBoxDetailHeader {
            overflow:hidden;
            position:relative;
            height: 28px;
            background-color:#3d3d3d;
        }

            .MultiCheckBoxDetailHeader>input {
                position: absolute;
                top: 4px;
                left: 3px;
            }

            .MultiCheckBoxDetailHeader>div {
                position: absolute;
                top: 5px;
                left: 24px;
                color:#fff;
            }

            .MultiCheckBoxDetailHeader > input + div {
              padding-left: 17px;
            }
</style>
<div class="basic-form-area mg-b-15">



  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Add Role</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Role</li>
      </ol>
    </div>




        <div class="row">   
		<div class="col-sm-12 col-xs-12">
           @if(Session::has('success')) 
            {{Session::get('success')}}
            @endif </div>
        </div>
		
		
		    <div class="row">
        <div class="col-sm-12 col-xs-12">
          <div class="card">
            <div class="cardarea">
		

            <div class="basic-login-form-ad ">
              <div class="row">
                <div class="col-xs-12">
                  <div class="all-form-element-inner">
                    <form method="POST" action="{{url('add_role')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Name</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="name" value="{{old('name')}}"/>
                          @if($errors->has('name'))
                          {{$errors->first('name')}}
                          @endif </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Category</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="category" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Thobe management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="thobemanage" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Coupon management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="coupon" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Pin code management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="pincode" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Manage role</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="role" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Manage users</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="manageusers" value="1"/>
                           </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Manage orders</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="orders" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Manage CMS</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="cms" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Store management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="store" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Sliders</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="sliders" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Basic settings</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="basicsetting" value="1"/>
                          </div>
                      </div>

                      <div class="form-group-inner row">
                        <label class="col-md-2 col-sm-3 col-xs-12"> Measurement management</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                          <input type="checkbox" class="form-control" name="measurement" value="1"/>
                          </div>
                      </div>


                      <!-- <div class="form-group-inner row">
                  <label class="col-md-2 col-sm-3 col-xs-12"> Role</label>
                  <div class="col-md-6">
                    <select name="role[]" class="form-control" id="test">
                      <option value="1">Category</option>
                      <option value="2">Thobe management</option>
                      <option value="3">Coupon management</option>
                      <option value="4">Pin code management</option>
                      <option value="5">Manage role</option>
                      <option value="6">Manage users</option>
                      <option value="7">Manage orders</option>
                      <option value="8">Manage CMS</option>
                      <option value="9">Store management</option>
                      <option value="10">Sliders</option>
                      <option value="11">Basic settings</option>
                      <option value="12">Measurement management</option>
                      </select>
                    @if($errors->has('role'))
                    
                    {{$errors->first('role')}}
                    
                    @endif </div>
                    <div class="col-md-4">
                    <button class="btn btn-primary w-110" type="submit">Submit</button>
                  </div>
                </div> -->
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
   