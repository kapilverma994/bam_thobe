@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Branch List</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Branch List</li>
      </ol>
    </div>
    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea"> 
          <a class="form-control dt-tb" href="{{route('branch.create')}}">Add Branch</a>
          
          
          
          
            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Brach Name</th>
                  <th>Branch Address</th>
               <th>Created At</th>
                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($branchs as $row)
              <tr>
                <td>{{ $i }}
                  <?php $i++; ?></td>
                <td>{{ $row->branch }}</td>
                <td>{{ $row->address }}</td>
          
                <td>{{ $row->created_at }}</td>                
         
                
                <td class="datatable-ct">
                  <a class="btn btn-primary" href="{{route('branch.edit',$row->id)}}">Edit</a>
                  <form action="{{route('branch.destroy',$row->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('Delete')
                    <button class="btn btn-danger">Delete</button>

                  </form>
                  
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