@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Sub Admin</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Sub Admin</li>
      </ol>
    </div>
    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea"> 
          <a class="form-control dt-tb" href="{{url('subadmin-add')}}">Add Sub Admin</a>
          
          
          
          
            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  {{-- <th>Password</th> --}}
                  <th>Role</th>
                  <th>Date</th>
                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($user as $row)
              <tr>
                <td>{{ $i }}
                  <?php $i++; ?></td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                {{-- <td>{{ $row->password_show }}</td> --}}
                <td>
                <?php
                $role=explode(',', $row->role_id);
                foreach ($role as $rrow)
                {
                    $rolename=DB::table('roles')
                    ->select('roles.*')
                    ->where('id',$rrow)
                    ->first();
                ?>
                  {{ $rolename->name }} ,
                <?php
                }
                ?>
                </td>
                <td>{{ $row->created_at }}</td>
                
                <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->
                
                <td class="datatable-ct">
                  <a class="btn btn-primary" href="subadmin-edit/{{$row->id}}">Edit</a> <a class="btn btn-danger" href="subadmin-delete/{{$row->id}}">Delete</a></td>
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