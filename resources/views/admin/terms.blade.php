@extends('admin.master')

@section('content')
<div class="data-table-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Terms of use</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Terms of use </li>
      </ol>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <div class="datatable-dashv1-list custom-datatable-overright">
          <div class="card">
            <div class="cardarea">
              <?php
  $user = auth()->user();
  
?>
              
              <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th data-field="id">ID</th>
                    <th>Content</th>
                    <?php
  if($user->type == 'admin') {
?>
                    <th data-field="action">Action</th>
                    <?php
}
?>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                @foreach($terms as $row)
                <tr>
                  <td>{{ $i }}
                    <?php $i++; ?></td>
                  <td>{{ $row->content }}</td>
                  
                  <!-- <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td> -->
                  <?php
  if($user->type == 'admin') {
?>
                  <td class="datatable-ct">

	
                    <a class="btn btn-primary" href="terms-edit/{{$row->id}}">Edit</a> </td>
                  <?php } ?>
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