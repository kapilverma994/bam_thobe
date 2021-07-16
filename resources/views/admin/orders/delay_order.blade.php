@extends('admin.master')
@section('content')
<style>
  .datatable-ct{
    white-space: nowrap;
  }
</style>
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Delay Order List</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Delay Order List</li>
      </ol>

    </div>

    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div class="card">
          <div class="cardarea">
      




            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <thead>
                <tr>
                  {{-- <th data-field="id">S.no</th> --}}
                  <th>Order Number</th>
                  {{-- <th>Product Name </th> --}}
              
                  <th>Customer Name</th>
                 <th>Customer Mobile Number</th>
                  {{-- <th>Address</th>  --}}
                  <th>Payment Mode</th>
                  <th>Grand Total</th>
                  <th>Pending Amount</th>
                  <th>Order Date</th>
         

                  <th>Status</th>


                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>

              @foreach($orders as $key=>$row)


              <tr>
                {{-- <td>{{$loop->iteration}}</td> --}}
                <td>{{ $row->order_number }}</td>
               

                {{-- <td>{{ $row->products->title     }}</td> --}}


                <td>{{ $row->users->name }}</td>
                <td>{{$row->users->mobile}}</td>
                {{-- <td>{{$row->users->email}}</td>
                <td>{{$row->customer_address->address}}</td> --}}
<td>
Cod
</td>
<td>
    {{$row->grand_total}}
</td>

<td>100</td>
<td>
    {{$row->created_at}}
</td>

<td>
    @if($row->status==1)
    <span class="label label-success">Accepted</span>
    @elseif($row->status==2)
    <span class="label label-info">Factory</span>
    @elseif($row->status==0)
    <span class="label label-warning">Created</span>
    @elseif($row->status==3)
    <span class="label label-primary">Sewing</span>
    @elseif($row->status==4)
    <span class="label label-success">Finishing</span>
    @elseif($row->status==5)
    <span class="label label-success">Ready</span>
    @elseif($row->status==6)
    <span class="label label-success">Completed</span>
    @elseif($row->status==7)
    <span class="label label-warning">Defective</span>
    @else 
    <span class="label label-warning">Rejected</span>
    @endif

</td>



                <td   class="datatable-ct">
                     @if($row->status!=2)
<a href="{{url('update-status/1',$row->order_number)}}" title="Accept" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
@endif 

 <a href="{{url('update-status/2',$row->order_number)}}"  title="Reject" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a> 
<a href="{{url('view-detail',$row->order_number)}}"   title="View"  class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
