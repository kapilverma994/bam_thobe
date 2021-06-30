@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Stores Management</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Stores Management</li>
      </ol>
    </div>
    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea"> 
          <a class="form-control dt-tb" href="{{url('store-add')}}">Add Stores</a>
            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <!-- <th>Pin code</th> -->
                  <th>Store Name</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>Image</th>
                  <th>Date</th>
                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($store as $row)
              <tr>
                <td>{{ $i }}
                  <?php $i++; 
                  $createdate=date("m-d-Y", strtotime($row->created_at));
                  ?></td>
                {{-- <td>{{ $row->pincode }}</td> --}}
                <td>{{ $row->store_name }}</td>
                <td>{{ $row->manager_name }}</td>
                <td>{{ $row->contact }}</td>
                <td>{{ $row->address }}</td>
                <td><img src="public/uploads/store/{{ $row->image }}" height="30px" width="50px" /></td>
                <td>{{ $createdate }}</td>
                
                <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->
                
                <td class="datatable-ct">
                  <a class="btn btn-primary" href="store-edit/{{$row->id}}">Edit</a> 
                  <a class="btn btn-danger" href="store-delete/{{$row->id}}" onclick="return confirm('Are you sure?')">Delete</a></td>
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