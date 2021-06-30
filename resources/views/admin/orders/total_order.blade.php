@extends('admin.master')
@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Order List</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Order List</li>
      </ol>

    </div>

    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea">
          {{-- <a class="form-control dt-tb" href="{{route('coupons.create')}}">Add Coupon</a> --}}




            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  <th data-field="id">ID</th>
                  <th>Order Number</th>
             
                  {{-- <th>Product Name </th> --}}
                  <th>Customer Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Payment Mode</th>
                  <th>Grand Total</th>

                  <th>status</th>


                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>

              @foreach($orders as $key=>$row)


              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $row->order_number }}</td>

                {{-- <td>{{ $row->products->title     }}</td> --}}


                <td>{{ $row->users->name }}</td>
                <td>{{$row->users->email}}</td>
                <td>{{$row->customer_address->address}}</td>
<td>
Cod
</td>
<td>
    {{$row->grand_total}}
</td>
<td>
    @if($row->status==1)
    <span class="label label-success">Accepted</span>
    @elseif($row->status==2)
    <span class="label label-danger">Rejected</span>
    @else
    <span class="label label-warning">Pending</span>
    @endif

</td>




                <td class="datatable-ct">
                    @if($row->status!=2)
<a href="{{url('update-status/1',$row->order_number)}}" class="btn btn-success">Accept</a>
@endif

<a href="{{url('update-status/2',$row->order_number)}}" class="btn btn-danger">Reject</a>
<a href="{{url('view-detail',$row->order_number)}}"    class="btn btn-primary">View Details</a>
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
