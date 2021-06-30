@extends('admin.master')

@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Shipping List</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Shipping List</li>
      </ol>

    </div>

    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea">
            {{-- <button type="button" class="btn btn-primary form-control dt-tb" data-toggle="modal" data-target="#exampleModal">
                Add Pincode
              </button> --}}
          <a class="form-control dt-tb" data-toggle="modal" data-target="#exampleModal"  href="#">Add Pincode</a>




            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Pincode</th>
                  <th>Status</th>

                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>

              @foreach($pin as $row)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $row->pin_code }}</td>
                <td>
                  @if($row->status==1)
                  <span class="label label-success">Active</span>
                  @else
                  <span class="label label-danger">Inactive</span>
                  @endif
              </td>
         
                {{-- <input type="checkbox" name="toggle" onchange="toggle()" value="{{$row->id}}"  {{$row->status==1 ?'checked':''}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-size="xs"> --}}

           
                  {{-- <td>
                    <input type="checkbox" name="toggle" onchange="toggle()" value="{{$row->id}}" {{$row->status==1 ?'checked':''}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-size="xs">

                  </td> --}}

                {{-- <td>
                    @if($row->status==1)
                  <span class="label label-success"> Active</span>

                    @else
                    <span class="label label-danger"> Inactive</span>

                    @endif
                </td> --}}


<td>

 <a href="{{url('pincode-delete',$row->id)}}" class="btn btn-danger"> Delete</a>

 @if($row->status==1)
 <a class="btn btn-success" href="{{url('pincode/status/0',$row->id)}} ">Active</a>
 @else 
 <a class="btn btn-warning" href="{{url('pincode/status/1',$row->id)}} ">Deactive</a>
 @endif
    
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




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{url('add-pin')}}" method="post">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Pincode</h5>
          <button type="button" class="close btn-danger text-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" placeholder="Enter Pincode" class="form-control" name="pincode">
          @error('pincode')
         <span class="text-danger"> {{$message}}</span>

          @enderror

        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
    </div>
  </div>


@endsection




