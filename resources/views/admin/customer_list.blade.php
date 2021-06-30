@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Customer</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Customer</li>
      </ol>
    </div>
    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea"> 
          
            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Date</th>
                  <th>Last order date</th>
                  <th>Total order</th>
                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($user as $row)
              <tr>
                <td>{{ $i }}
                  <?php $i++; 
                  $createdate=date("m-d-Y", strtotime($row->created_at));
                  $orderdate=null;
                  if($row->lastdate)
                  {
                    $orderdate=date("m-d-Y", strtotime($row->lastdate));
                  }
                  $totalorder='';
                  if(!empty($row->totalorder))
                  {
                    $totalorder=$row->totalorder;
                  }
                  ?></td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->mobile }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $createdate }}</td>
                <td>{{ $orderdate }}</td>
                <td>{{ $totalorder }}</td>
                
                <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->
                
                <td class="datatable-ct"><?php

	if($row->status==1)

	{

	?>
                  <a class="btn btn-success" href="customer-block/{{$row->id}}/{{$row->status}}">Block</a>
                  <?php

	}

	else

	{

	?>
                  <a class="btn btn-warning" href="customer-block/{{$row->id}}/{{$row->status}}">Unblock</a>
                  <?php

	}

	?>
                  <a class="btn btn-primary" href="customer-edit/{{$row->id}}">Edit</a> 
                  <a class="btn btn-danger" href="customer-delete/{{$row->id}}" onclick="return confirm('Are you sure?')">Delete</a></td>
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