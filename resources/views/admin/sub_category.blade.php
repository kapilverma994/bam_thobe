@extends('admin.master')

@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Sub Category </h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Sub Category </li>
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
              <a class="form-control dt-tb" href="{{url('sub-category-add')}}">Add Sub Category</a>
              <?php } ?>
              <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th data-field="id">ID</th>
                    <th>Sub Category</th>
                    <th>Category</th>
                    <?php
  if($user->type == 'admin') {
?>
                    <th data-field="action">Action</th>
                    <?php
}
?>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                @foreach($subcategory as $row)
                <tr>
                  <td>{{ $i }}
                    <?php $i++; ?></td>
                  <td>{{ $row->sub_category }}</td>
                  <td>{{ $row->category_name }}</td>
                  
                  <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->
                  <?php
  if($user->type == 'admin') {
?>
                  <td class="datatable-ct"><?php

	if($row->status==1)

	{

	?>
                    <a class="btn btn-success" href="sub-category-block/{{$row->id}}/{{$row->status}}">Block</a>
                    <?php

	}

	else

	{

	?>
                    <a class="btn btn-warning" href="sub-category-block/{{$row->id}}/{{$row->status}}">Unblock</a>
                    <?php

	}

	?>
                    <a class="btn btn-primary" href="sub-category-edit/{{$row->id}}">Edit</a> <a class="btn btn-danger" href="sub-category-delete/{{$row->id}}">Delete</a></td>
                  <?php } ?>
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