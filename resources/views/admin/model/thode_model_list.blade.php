@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Model List</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Model List</li>
      </ol>
    </div>
    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea">
          {{-- <a class="form-control dt-tb" href="{{url('thobe-model-add')}}">Add Model</a> --}}




            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Model Type</th>
                  <th>Price</th>
                  <th>Image</th>
                  {{-- <th>Color Code</th> --}}
                  <th>Date</th>
                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($model as $row)
              <tr>
                <td>{{ $i }}
                  <?php $i++; ?></td>
                <td>{{ $row->model_type }}</td>
                <td>{{ $row->price }}</td>
                <td><img src="public/uploads/model/{{ $row->image }}" height="30px" width="50px" /></td>
                {{-- <td>{{$row->color_code}}</td> --}}
                <td>{{ $row->created_at }}</td>
                <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->

                <td class="datatable-ct">
                  <a class="btn btn-primary" href="thobe-model-edit/{{$row->id}}">Edit</a> 
                  {{-- <a class="btn btn-danger" href="thobe-model-delete/{{$row->id}}">Delete</a> --}}
                </td>
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
