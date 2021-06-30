@extends('admin.master')

@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
    <div class="page-header">
      <h2 class="main-content-title">Edit Privacy Policy</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Privacy Policy</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xs-12"> @if(Session::has('success')) 
        
        {{Session::get('success')}}
        
        @endif </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <div class="card">
        <div class="cardarea">
        <div class="basic-login-form-ad">
        <div class="all-form-element-inner">
        <form method="POST" action="{{url('privacy-update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
          {{csrf_field()}}
                
          <div class="form-group-inner row">
            <label class="col-md-2 col-sm-3 col-xs-12">Contents</label>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <input type="hidden" class="form-control" name="id" value="{{$privacy->id}}"/>
             <!-- <input type="text" class="form-control" name="content" value="{{$privacy->content}}"/> -->
			  
			  
			  <textarea id="editor"  name="content" >{{$privacy->content}}</textarea>
			  
			  
			  
			  
			  
			  
			  
			  
              @if($errors->has('sub_category'))
              
              {{$errors->first('sub_category')}}
              
              @endif </div>
          </div>
     
          <div class="form-group-inner row">
            <div class="col-md-2 col-sm-3 col-xs-12"></div>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <button class="btn btn-primary w-110" type="submit">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>







<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 
<Script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>


CKEDITOR.replace("content");
CKEDITOR.on("instanceReady", function (evt) {
  var editor = evt.editor;

  editor.on("change", function (e) {
    var contentSpace = editor.ui.space("contents");
    var ckeditorFrameCollection = contentSpace.$.getElementsByTagName("iframe");
    var ckeditorFrame = ckeditorFrameCollection[0];
    var innerDoc = ckeditorFrame.contentDocument;
    var innerDocTextAreaHeight = $(innerDoc.body).height();
    console.log(innerDocTextAreaHeight);
  });
});


</script>



<style>
.ck-editor__editable {
    min-height: 250px;
    max-height: 250px;
    overflow-y: auto;
}

.ck-editor__editable  ul {  margin-bottom:15px; padding-left:15px;}


.ck-editor__editable  ul li {
    list-style: disc inside !important;
    line-height: 25px;}

</sytle>


@endsection












