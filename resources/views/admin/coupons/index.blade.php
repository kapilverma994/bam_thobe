@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Coupon List</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Coupon List</li>
      </ol>

    </div>

    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea">
          <a class="form-control dt-tb" href="{{route('coupons.create')}}">Add Coupon</a>




            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Image</th>
                  <th>Coupon Code</th>
                  <th>Coupon Value </th>
<th>Description</th>

                  <th>Expiry Date</th>
                  <th>Status</th>
                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>

              @foreach($collar as $row)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td><img src="public/uploads/offer/{{ $row->image }}" height="30px" width="50px" /></td>
                <td>{{ $row->code }}</td>
                <td>{{ $row->price }}</td>
                <td>{{$row->description}}</td>

                <td>{{ $row->expiry_date }}</td>
                <td>
                    @if($row->status==1)
                    <span class="label label-success">Active</span>
                    @else
                    <span class="label label-danger">Inactive</span>
                    @endif
                </td>


                <td class="datatable-ct">
                    <form action="{{route('coupons.destroy',$row->id)}}" method="post" style="display: inline-block">
                        @method('delete')
@csrf
<button class="btn btn-danger" >Delete</button>
                    </form>
                    @if($row->status==1)
 <a class="btn btn-success" href="{{url('coupon/status/0',$row->id)}} ">Active</a>
 @else
 <a class="btn btn-warning" href="{{url('coupon/status/1',$row->id)}} ">Deactive</a>
 @endif
 <a class="btn btn-warning" href="{{route('coupons.edit',$row->id)}}">Edit</a>
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
