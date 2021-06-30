@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Category </h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Category </li>
      </ol>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <div class="datatable-dashv1-list custom-datatable-overright">
          <div class="card">
            <div class="cardarea">
              <?php
  $user = auth()->user();
  if($user->type == 'admin') {
?>
              <a class="form-control dt-tb" href="{{url('category-add')}}">Add Category</a>
              <?php } ?>
              <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th data-field="id">ID</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Image</th>
                    
                    <th data-field="action">Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                @foreach($category as $row)
                <tr>
                  <td>{{ $i }}
                    <?php $i++; ?></td>
                  <td>{{ $row->category_name }}</td>
                  <td>{{ $row->type }}</td>
                 <td> <?php if(!empty($row->image)){ ?><img src="public/uploads/category/{{ $row->image }}" height="30px" width="50px" /> <?php } ?></td>
                  <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->
                 
                  <td class="datatable-ct"><?php

	if($row->status==1)

	{

	?>
                    <a class="btn btn-success" href="category-block/{{$row->id}}/{{$row->status}}">Block</a>
                    <?php

	}

	else

	{

	?>
                    <a class="btn btn-warning" href="category-block/{{$row->id}}/{{$row->status}}">Unblock</a>
                    <?php

	}

	?>
                    <a class="btn btn-primary" href="category-edit/{{$row->id}}">Edit</a> <a class="btn btn-danger" href="category-delete/{{$row->id}}">Delete</a></td>
                  
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
</div>

@endsection 