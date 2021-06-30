@extends('admin.master')

@section('content')
<div class="data-table-area mg-b-15">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="sparkline13-list">
<div class="sparkline13-hd">
<div class="main-sparkline13-hd">
	<br><br>
<h1>Subject <span class="table-project-n">List</h1>
</div>
</div>
<a class="form-control dt-tb" href="subject" style="width:140px;">Add Subject</a>
<div class="sparkline13-graph">
<div class="datatable-dashv1-list custom-datatable-overright">
<table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
<thead>
<tr>

<th data-field="id">ID</th>
<th data-field="name" data-editable="true">Name</th>
<th data-field="email" data-editable="true">Date</th>
<th data-field="action">Action</th>
</tr>
</thead>
<tbody>
	<?php $i=1; ?>
	@foreach($subject as $row)
<tr>

<td>{{ $i }} <?php $i++; ?></td>
<td>{{ $row->subjectt }}</td>
<td>{{ $row->created_at }}</td>
<td class="datatable-ct"><i class="fa fa-check"></i>
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
</div>
@endsection
