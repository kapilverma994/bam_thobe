@extends('admin.master')

@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Measurement List</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Measurement List</li>
      </ol>

    </div>

    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea">
            {{-- <button type="button" class="btn btn-primary form-control dt-tb" data-toggle="modal" data-target="#exampleModal">
                Add Pincode
              </button> --}}
          <a class="form-control dt-tb" href="{{route('measurement.create')}}">Add Measurement</a>




            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Name</th>
                  <th>Chest</th>
                  <th>Length</th>

                <th>Shoulder</th>
                <th>Sleeve</th>
                  <th>Status</th>

                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>

              @foreach($data as $row)
              <tr>
                <td>{{$loop->iteration}} </td>
                <td>{{ $row->name }} </td>
                <td>{{$row->chest}} cm</td>
                <td>{{$row->length}} cm</td>
                <td>{{$row->shoulder}} cm</td>
                <td>{{$row->sleeve}} cm</td>

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

                <td class="datatable-ct">
                    <form action="{{route('measurement.destroy',$row->id)}}" method="post" style="display: inline-block">
                        @method('delete')
@csrf
<button class="btn btn-danger" >Delete</button>
                    </form>
                    @if($row->status==1)
 <a class="btn btn-success" href="{{url('measurement/status/0',$row->id)}} ">Active</a>
 @else
 <a class="btn btn-warning" href="{{url('measurement/status/1',$row->id)}} ">Deactive</a>
 @endif
 <a class="btn btn-warning" href="{{route('measurement.edit',$row->id)}}">Edit</a>
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




