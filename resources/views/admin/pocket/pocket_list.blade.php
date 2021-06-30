@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Thobe Pocket List</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Pocket List</li>
      </ol>
    </div>
    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea">
          <a class="form-control dt-tb" href="{{url('thobe-pocket-add')}}">Add Pocket</a>




            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Thobe Style</th>
                  <th>Pocket </th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Visible Image</th>
                  <th>Date</th>
                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($pocket as $row)
              <tr>
                <td>{{ $i }}
                  <?php $i++; ?></td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->pocket }}</td>
                <td>{{ $row->price }}</td>
                <td><img src="public/uploads/pocket/{{ $row->image }}" height="30px" width="50px" /></td>
                <td><img src="public/uploads/pocket/{{ $row->visible_image }}" height="30px" width="50px" /></td>
                <td>{{ $row->created_at }}</td>
                <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->

                <td class="datatable-ct">
                  <a class="btn btn-primary" href="thobe-pocket-edit/{{$row->id}}">Edit</a> <a class="btn btn-danger" href="thobe-pocket-delete/{{$row->id}}">Delete</a></td>
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
