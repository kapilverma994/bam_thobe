@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Sliders </h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Sliders </li>
      </ol>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <div class="datatable-dashv1-list custom-datatable-overright">
          <div class="card">
            <div class="cardarea">
              
              <a class="form-control dt-tb" href="{{url('slider-add')}}">Add Sliders</a>
              
              <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th data-field="id">ID</th>
                    <th>Main title</th>
                    <th>Sub title</th>
                    <th>Short title</th>
                    <th>Image</th>
                    
                    <th data-field="action">Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                @foreach($slider as $row)
                <tr>
                  <td>{{ $i }}
                    <?php $i++; ?></td>
                  <td>{{ $row->main_title }}</td>
                  <td>{{ $row->sub_title }}</td>
                  <td>{{ $row->short_title }}</td>
                  <td><img src="public/uploads/sliders/{{ $row->image }}" height="30px" width="50px" /></td>
                  
                  <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->
                 
                  <td class="datatable-ct">
                    <a class="btn btn-primary" href="slider-edit/{{$row->id}}">Edit</a> <a class="btn btn-danger" href="slider-delete/{{$row->id}}">Delete</a></td>
                  
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