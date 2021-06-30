@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Role Management</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Role Management</li>
      </ol>
    </div>
    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea"> 
          <a class="form-control dt-tb" href="{{url('role-add')}}">Add Role</a>
            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Thobe management</th>
                  <th>Coupon management</th>
                  <th>Pin code management</th>
                  <th>Manage role</th>
                  <th>Manage users</th>
                  <th>Manage orders</th>
                  <th>Manage CMS</th>
                  <th>Store management</th>
                  <th>Sliders</th>
                  <th>Basic settings</th>
                  <th>Measurement management</th>
                  <th>Date</th>
                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($role as $row)
              <tr>
                <td>{{ $i }}
                  <?php $i++; ?></td>
                <td>{{ $row->name }}</td>
                <td>@if($row->category == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->thobemanage == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->coupon == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->pincode == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->role == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->manageusers == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->orders == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->cms == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->store == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->sliders == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->basicsetting == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>@if($row->measurement == 1) <i class="fa fa-check" style="font-size:30px;color:green"></i> @else <i class="fa fa-close" style="font-size:30px;color:red"></i> @endif </td>
                <td>{{ $row->created_at }}</td>
                
                <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->
                
                <td class="datatable-ct">
                  <a class="btn btn-primary" href="role-edit/{{$row->id}}">Edit</a> 
                  <a class="btn btn-danger" href="role-delete/{{$row->id}}" onclick="return confirm('Are you sure?')">Delete</a></td>
              </tr>
              @endforeach
                </tbody>
              
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 