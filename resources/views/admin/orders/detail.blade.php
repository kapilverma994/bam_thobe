@extends('admin.master')
@section('content')
<style>
  .datatable-ct{
    white-space: nowrap;
  }

</style>
@php 
 function getattr($table,$cond,$val,$attr){
  return $value=DB::table($table)->where($cond,$val)->value($attr);
}

@endphp
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">SubOrder List</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> SubOrder List</li>
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
                  <th>SubOrder Number</th>

                  <th>Product Number</th>
           <th>Product Name </th>
           <th>Product Description</th>
      
           <th>Image</th>
           <th>Quantity</th>
                  {{-- <th>Customer Name</th>
                  <th>Email</th> --}}
                  {{-- <th>Payment Mode</th> --}}
                  {{-- <th>Price</th> --}}

                  <th>Delivery status</th>
                  <th>Work status</th>


                  <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>

              @foreach($orders as $key=>$row)


              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $row->sorder_number }}</td>
                <td>{{$row->products->sku??''}}</td>
@if($row->product_id!=0)

<td>{{ $row->products->title }}</td>
<td>{{$row->products->description}}</td>
               

               <td> <img src="{{asset('uploads/product/'.$row->products->image)}}" width="50px" height="50px" alt="{{$row->products->image }}"></td>

@endif
@if ($row->gift_id!=0)
<td>Gift Card</td>
<td>
  <p>To: {{$row->customer_gift_cart->g_to}}</p>
  <p>From: {{$row->customer_gift_cart->g_from}}</p>
  <p>Date: {{$row->customer_gift_cart->date}}</p>
  <p>Message:{{$row->customer_gift_cart->message}}</p>

  <p>Mobile :{{$row->customer_gift_cart->mobile}}</p>
  <p>Time :{{$row->customer_gift_cart->time}}</p>
</td>
<td></td>
@endif


@if($row->thobe_id!=0)

<td>Customize  Product</td>

<td>Booking Id :{{$row->custom_cart->booking_id}}

<p>Fabric : {{getattr('fabric_managements','id',$row->custom_cart->fabric,'fabrics')}}</p>
<p>Collar :{{getattr('collar_managements','id',$row->custom_cart->collar,'collar_style')}}</p>
<p>Cuffs : {{getattr('cuff_managements','id',$row->custom_cart->cuff,'cuff')}}</p> 

<p>Pocket :{{getattr('pocket_managements','id',$row->custom_cart->pocket,'pocket')}} </p>
<p>Button : {{getattr('thobe_button_managments','id',$row->custom_cart->button,'buttons')}}  </p>
<p>Side Pocket : {{$row->custom_cart->side_pocket}}</p>
<p>Side Pocket  : {{$row->custom_cart->side_pocket_2}}</p>
<p>Measurement :  {{$row->custom_cart->measurement}}</p>

</td>
<td></td>
@endif


                {{-- <td>{{ $row->users->name }}</td>
                <td>{{$row->users->email}}</td> --}}
{{-- <td>
Cod
</td> --}}
{{-- <td>
    {{$row->products->cost}}
</td> --}}
<td>{{$row->o_quantity}}</td>
<td>
    @if($row->delivery_status==1)
    <span class="label label-danger">Pending</span>
    @elseif($row->delivery_status==2)

    <span class="label label-warning">Packed</span>
    @elseif($row->delivery_status==3)

    <span class="label label-primary">Shipped</span>
    @elseif($row->delivery_status==4)

    <span class="label label-success">Delivered</span>
    @else
    <span class="label label-danger">Pending</span>
    @endif

</td>
<td>

 
  @if ($row->work_status==1)
   Cutting
  @elseif($row->work_status==2)
  Sewing
  @else
  QC  
  @endif
</td>
  {{-- <td>
    <select name="categories_id" id="myInput" class="form-control" >
        <option selected="true" disabled="disabled">-- Choose status --</option>
        <option value="1,<?php echo $row->id;?>" <?php echo $row->work_status==1 ? 'selected=" "':'';?>>Cutting</option>
        <option value="2,<?php echo $row->id;?>" <?php echo $row->work_status==2 ? 'selected=" "':'';?>>Sewing</option>
        <option value="3,<?php echo $row->id;?>" <?php echo $row->work_status==3 ? 'selected=" "':'';?>>QC</option>
   </select>
  </td> --}}

                <td class="datatable-ct">
                    @if($row->status==1)
                    @if($row->delivery_status!=2 && $row->delivery_status!=3 && $row->delivery_status!=4 )
<a href="{{url('update_delivery/2',$row->id)}}" class="btn btn-warning">Packed</a>
@endif
@if($row->delivery_status!=3 && $row->delivery_status!=4 )
<a href="{{url('update_delivery/3',$row->id)}}" class="btn btn-primary">Shipped </a>
@endif

<a href="{{url('update_delivery/4',$row->id)}}"    class="btn btn-success">Deliverd</a>
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
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
    $(document).ready(function(){

     $('#myInput').bind('change keyup',function() {
  var id=$("#myInput").val();
  //alert(id);
    $.ajax({
        url: '{{ url('/suborderworkstatus') }}',
        type: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
            id: id
        },
        dataType: 'html',
        success: function(data)
        {
          //alert(data);
           //$('#subdata').html(data);
           window.location.reload();
        }
    });
});

    });

</script>
