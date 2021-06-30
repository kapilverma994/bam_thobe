<!doctype html>

<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Dashboard | Bamthobe</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png')}}">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/educate-custon-icon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/morrisjs/morris.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/metisMenu/metisMenu.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/metisMenu/metisMenu-vertical.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/calendar/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/calendar/fullcalendar.print.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/editor/bootstrap-editable.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/editor/x-editor-style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/data-table/bootstrap-table.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/data-table/bootstrap-editable.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
<div class="left-sidebar-pro">
  <nav id="sidebar" class="">
    <div class="sidebar-header"> <a href="{{url('dashboard')}}">
	
	Bamthobe</a>

	</div>
    <div class="left-custom-menu-adp-wrap comment-scrollbar">
      <nav class="sidebar-nav left-sidebar-menu-pro">
        <ul class="metismenu" id="menu1">
		
		
          <?php
  $user = auth()->user();
  if($user->type == 'admin' || $user->type== 'sub_admin') {

    $permission=DB::table('roles')
                    ->select('roles.*')
                    ->where('name','Sub admin')
                    ->first();          
  ?>
            <li><a href="{{url('dashboard')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> <span class="mini-sub-pro">Dashboard </span></a></li>

             @if($user->type == 'admin' || $permission->category==1)
             <li><a href="{{route('branch.index')}}"><i class="fa fa-cogs" aria-hidden="true"></i> <span class="mini-sub-pro">Branch Management</span></a></li>

            <li class=""> <a class="has-arrow"><i class="fa fa-th-large" aria-hidden="true"></i><span class="mini-click-non">Manage Category</span></a>
              <ul class="submenu-angle" aria-expanded="true">
                <li><a href="{{url('category')}}"><span class="mini-sub-pro">Category</span></a></li>
                <li><a href="{{url('sub-category')}}"><span class="mini-sub-pro">Sub Category</span></a></li>
                <li><a href="{{url('product')}}"><span class="mini-sub-pro">Product</span></a></li>
                <li><a href="{{url('thobe-style')}}"><span class="mini-sub-pro">Thobe Style</span></a></li>
              </ul>
            </li>
            @endif

          {{-- <li class=""> <a class="has-arrow"><i class="fa fa-align-justify" aria-hidden="true"></i><span class="mini-click-non">Model Management</span></a>
            <ul class="submenu-angle" aria-expanded="true">
              <li><a href="{{url('model-list')}}"><span class="mini-sub-pro">Add Models</span></a></li>
              <li><a href="{{url('fabric-list')}}"><span class="mini-sub-pro">Fabric Management</span></a></li>
              <li><a href="{{url('buttons-list')}}"><span class="mini-sub-pro">Buttons Management</span></a></li>
            </ul>
          </li> --}}

          @if($user->type == 'admin' || $permission->thobemanage==1)
          <li class=""> <a class="has-arrow"><i class="fa fa-align-justify" aria-hidden="true"></i><span class="mini-click-non">Standard Thobe Management</span></a>
            <ul class="submenu-angle" aria-expanded="true">
              <li><a href="{{url('thobe-model-list')}}"><span class="mini-sub-pro">Add Models</span></a></li>
              <li><a href="{{url('thobe-fabric-list')}}"><span class="mini-sub-pro">Fabric Management</span></a></li>
              <li><a href="{{url('thobe-collar-list')}}"><span class="mini-sub-pro">Collar Style Management</span></a></li>
              <li><a href="{{url('thobe-buttons-list')}}"><span class="mini-sub-pro">Buttons Management</span></a></li>
              <li><a href="{{url('thobe-front-style-list')}}"><span class="mini-sub-pro">Front style Management</span></a></li>
              <li><a href="{{url('thobe-pocket-list')}}"><span class="mini-sub-pro">Pocket Management</span></a></li>
              <li><a href="{{url('thobe-cuff-list')}}"><span class="mini-sub-pro">Cuff Management</span></a></li>
            </ul>
          </li>
          @endif
          @if($user->type == 'admin' || $permission->coupon==1)
          <li class=""> <a class="has-arrow"><i class="fa fa-tag" aria-hidden="true"></i><span class="mini-click-non">Coupon Management</span></a>
            <ul class="submenu-angle" aria-expanded="true">
              <li><a href="{{route('coupons.index')}}"><span class="mini-sub-pro">Manage Coupon</span></a></li>

            </ul>
          </li>
          @endif
          @if($user->type == 'admin' || $permission->pincode==1)
          {{-- <li class=""> <a class="has-arrow"><i class="fa fa-truck" aria-hidden="true"></i><span class="mini-click-non">Pin code Management</span></a>
            <ul class="submenu-angle" aria-expanded="true">
              <li><a href="{{url('manage_pin')}}"><span class="mini-sub-pro">Manage Pin</span></a></li>

            </ul> --}}
          </li>
          @endif
          @if($user->type == 'admin' || $permission->role==1)
          <li><a href="{{url('role-management')}}"><i class="fa fa-child" aria-hidden="true"></i> <span class="mini-sub-pro">Manage Role</span></a></li>
          @endif
          @if($user->type == 'admin' || $permission->manageusers==1)
          <li class=""> <a class="has-arrow"><i class="fa fa-user" aria-hidden="true"></i><span class="mini-click-non">Manage Users</span></a>
            <ul class="submenu-angle" aria-expanded="true">
              <li><a href="{{url('customer-list')}}"><span class="mini-sub-pro">Customer</span></a></li>
              <li><a href="{{url('subadmin-list')}}"><span class="mini-sub-pro">Employees</span></a></li>
              
            </ul>
          </li>
          @endif
          @if($user->type == 'admin' || $permission->orders==1)
          <li class=""> <a class="has-arrow"><i class="fa fa-user" aria-hidden="true"></i><span class="mini-click-non">Manage Order</span></a>
            <ul class="submenu-angle" aria-expanded="true">
              <li><a href="{{url('order-list')}}"><span class="mini-sub-pro">Order  Management</span></a></li>
              {{-- <li><a href="{{url('ongoing-order')}}"><span class="mini-sub-pro">Ongoing Order</span></a></li> --}}

            </ul>
          </li>
          @endif
          @if($user->type == 'admin' || $permission->cms==1)
          <li class=""> <a class="has-arrow"><i class="fa fa-wrench" aria-hidden="true"></i><span class="mini-click-non">Manage CMS</span></a>
            <ul class="submenu-angle" aria-expanded="true">
              <li><a href="{{url('about_us')}}"><span class="mini-sub-pro">About Us</span></a></li>
              <li><a href="{{url('terms')}}"><span class="mini-sub-pro">Terms & Condition</span></a></li>
              <li><a href="{{url('privacy-policy')}}"><span class="mini-sub-pro">Privacy & Policy</span></a></li>
              <li><a href="{{url('faq')}}"><span class="mini-sub-pro">FAQ</span></a></li>
            </ul>
          </li>
          @endif
          @if($user->type == 'admin' || $permission->store==1)
         <li><a href="{{url('store-management')}}"><i class="fa fa-university" aria-hidden="true"></i> <span class="mini-sub-pro">Stores Management</span></a></li>
         @endif
         @if($user->type == 'admin' || $permission->sliders==1)
          <li><a href="{{url('slider')}}"><i class="fa fa-sliders" aria-hidden="true"></i> <span class="mini-sub-pro">Sliders</span></a></li>
          @endif
          @if($user->type == 'admin' || $permission->basicsetting==1)
          <li><a href="{{route('setting.edit',1)}}"><i class="fa fa-cogs" aria-hidden="true"></i> <span class="mini-sub-pro">Basic Settings</span></a></li>
          @endif
          @if($user->type == 'admin' || $permission->measurement==1)
          <li><a href="{{route('measurement.index')}}"><i class="fa fa-cogs" aria-hidden="true"></i> <span class="mini-sub-pro">Measurement Management</span></a></li>
          @endif
          <!-- <li><a href="{{url('permission')}}"><i class="fa fa-eye icon-wrap"></i><span class="mini-sub-pro">Permission</span></a></li> -->
          
          <!-- <li class=""> <a class="has-arrow"><i class="fa fa-file-text-o icon-wrap"></i><span class="mini-click-non">Content Add</span></a>
            <ul class="submenu-angle" aria-expanded="true">
              <li><a href="{{url('privacy')}}"><span class="mini-sub-pro">Privacy Policy</span></a></li>
              <li><a href="{{url('terms-of-use')}}"><span class="mini-sub-pro">Terms of use</span></a></li>
            </ul>
          </li> -->
          
          <?php
}
?>
          
        </ul>
      </nav>
    </div>
  </nav>
</div>
<div class="all-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="logo-pro"> <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="logo icon" /></a> </div>
      </div>
    </div>
  </div>
  <div class="header-advance-area">
    <div class="header-top-area">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="header-top-wraper">
              <div class="row">
                <div class="col-md-4">
                  <div class="menu-switcher-pro">
                    <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn"> <i class="educate-icon educate-nav"></i> </button>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="header-right-info">
                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                      <li class="nav-item">
                      <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"> <img src="http://projects.adsandurl.com/scm/public/assets/img/product/pro4.jpg" alt="" /> <span class="admin-name"><?php echo $user->name; ?></span> <i class="fa fa-angle-down edu-icon edu-down-arrow"></i> </a>
                      <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                        </li>
                        <li>
                          <form action="{{url('logout')}}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Log Out</button>
                          </form>
                        </li>
                      </ul>
                    </ul>

                    <style>

.dropdown-header-top{
                        
                        top: 43px !important; text-align:center !important;
                    
                       
                        right: 0!important;
                        width: 110px !important;
                        left: inherit !important;
                    }

                    </style>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @yield('content')
  <div class="footer-copyright-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="footer-copy-right">
         <p> 2021 © BAMTHOBE &nbsp; Design &amp; Develop by  <a href="https://www.adsnurl.com" target="_blank">adsandurl</a> </p>
					
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script> 
<!-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('assets/js/wow.min.js') }}"></script> 
<script src="{{ asset('assets/js/jquery-price-slider.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script> 
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script> 
<script src="{{ asset('assets/js/counterup/jquery.counterup.min.js') }}"></script> 
<script src="{{ asset('assets/js/counterup/waypoints.min.js') }}"></script> 
<script src="{{ asset('assets/js/counterup/counterup-active.js') }}"></script> 
<script src="{{ asset('assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script> 
<script src="{{ asset('assets/js/scrollbar/mCustomScrollbar-active.js') }}"></script> 
<script src="{{ asset('assets/js/metisMenu/metisMenu.min.js') }}"></script> 
<script src="{{ asset('assets/js/metisMenu/metisMenu-active.js') }}"></script> 
<script src="{{ asset('assets/js/morrisjs/raphael-min.js') }}"></script> 
<script src="{{ asset('assets/js/morrisjs/morris.js') }}"></script> 
<script src="{{ asset('assets/js/morrisjs/morris-active.js') }}"></script> 
<script src="{{ asset('assets/js/sparkline/jquery.sparkline.min.js') }}"></script> 
<script src="{{ asset('assets/js/sparkline/jquery.charts-sparkline.js') }}"></script> 
<script src="{{ asset('assets/js/sparkline/sparkline-active.js') }}"></script> 
<script src="{{ asset('assets/js/calendar/moment.min.js') }}"></script> 
<script src="{{ asset('assets/js/calendar/fullcalendar.min.js') }}"></script> 
<script src="{{ asset('assets/js/calendar/fullcalendar-active.js') }}"></script> 
<script src="{{ asset('assets/js/plugins.js') }}"></script> 
<script src="{{ asset('assets/js/main.js') }}"></script>
<!--<script src="{{ asset('assets/js/tawk-chat.js') }}"></script>  -->
<script src="{{ asset('assets/js/data-table/bootstrap-table.js') }}"></script> 
<script src="{{ asset('assets/js/data-table/tableExport.js') }}"></script> 
<script src="{{ asset('assets/js/data-table/data-table-active.js') }}"></script> 
<script src="{{ asset('assets/js/data-table/bootstrap-table-editable.js') }}"></script> 
<script src="{{ asset('assets/js/data-table/bootstrap-editable.js') }}"></script> 
<script src="{{ asset('assets/js/data-table/bootstrap-table-resizable.js') }}"></script> 
<script src="{{ asset('assets/js/data-table/colResizable-1.5.source.js') }}"></script> 
<script src="{{ asset('assets/js/data-table/bootstrap-table-export.js') }}"></script> 
<script src="{{ asset('assets/js/editable/jquery.mockjax.js') }}"></script> 
<script src="{{ asset('assets/js/editable/mock-active.js') }}"></script> 
<script src="{{ asset('assets/js/editable/select2.js') }}"></script> 
<script src="{{ asset('assets/js/editable/moment.min.js') }}"></script> 
<script src="{{ asset('assets/js/editable/bootstrap-datetimepicker.js') }}"></script> 
<script src="{{ asset('assets/js/editable/bootstrap-editable.js') }}"></script> 
<script src="{{ asset('assets/js/editable/xediable-active.js') }}"></script> 
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script> 
<!-- <script async src="http://demo.mbrcables.com/alzaeem-web/assets/admin/css/toastr.min.css"></script> --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> 

<script src="{{ asset('assets/js/chart/Chart.min.js') }}"></script> 
<script src="{{ asset('assets/js/chart/chart-area-demo.js') }}"></script> 
<script src="{{ asset('assets/js/chart/chart-bar-demo.js') }}"></script> 
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@yield('custom_script')
<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



  gtag('config', 'UA-23581568-13');

</script> 
<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
  @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif


 $(document).ready(function () {
            $("#test").CreateMultiCheckBox({ width: '230px', defaultText : 'Select Below', height:'250px' });
        });

                $(document).ready(function () {
                  $(document).on("click", ".MultiCheckBox", function () {
                      var detail = $(this).next();
                      detail.show();
                  });

            $(document).on("click", ".MultiCheckBoxDetailHeader input", function (e) {
                e.stopPropagation();
                var hc = $(this).prop("checked");
                $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", hc);
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
            });

            $(document).on("click", ".MultiCheckBoxDetailHeader", function (e) {
                var inp = $(this).find("input");
                var chk = inp.prop("checked");
                inp.prop("checked", !chk);
                $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", !chk);
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
            });

            $(document).on("click", ".MultiCheckBoxDetail .cont input", function (e) {
                e.stopPropagation();
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();

                var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
                $(".MultiCheckBoxDetailHeader input").prop("checked", val);
            });

            $(document).on("click", ".MultiCheckBoxDetail .cont", function (e) {
                var inp = $(this).find("input");
                var chk = inp.prop("checked");
                inp.prop("checked", !chk);

                var multiCheckBoxDetail = $(this).closest(".MultiCheckBoxDetail");
                var multiCheckBoxDetailBody = $(this).closest(".MultiCheckBoxDetailBody");
                multiCheckBoxDetail.next().UpdateSelect();

                var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
                $(".MultiCheckBoxDetailHeader input").prop("checked", val);
            });

            $(document).mouseup(function (e) {
                var container = $(".MultiCheckBoxDetail");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.hide();
                }
            });
        });

        var defaultMultiCheckBoxOption = { width: '220px', defaultText: 'Select Below', height: '200px' };

        jQuery.fn.extend({
            CreateMultiCheckBox: function (options) {

                var localOption = {};
                localOption.width = (options != null && options.width != null && options.width != undefined) ? options.width : defaultMultiCheckBoxOption.width;
                localOption.defaultText = (options != null && options.defaultText != null && options.defaultText != undefined) ? options.defaultText : defaultMultiCheckBoxOption.defaultText;
                localOption.height = (options != null && options.height != null && options.height != undefined) ? options.height : defaultMultiCheckBoxOption.height;

                this.hide();
                this.attr("multiple", "multiple");
                var divSel = $("<div class='MultiCheckBox'>" + localOption.defaultText + "<span class='k-icon k-i-arrow-60-down'><svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='sort-down' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' class='svg-inline--fa fa-sort-down fa-w-10 fa-2x'><path fill='currentColor' d='M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z' class=''></path></svg></span></div>").insertBefore(this);
                divSel.css({ "width": localOption.width });

                var detail = $("<div class='MultiCheckBoxDetail'><div class='MultiCheckBoxDetailHeader'><input type='checkbox' class='mulinput' value='-1982' /><div>Select All</div></div><div class='MultiCheckBoxDetailBody'></div></div>").insertAfter(divSel);
                detail.css({ "width": parseInt(options.width) + 10, "max-height": localOption.height });
                var multiCheckBoxDetailBody = detail.find(".MultiCheckBoxDetailBody");

                this.find("option").each(function () {
                    var val = $(this).attr("value");

                    if (val == undefined)
                        val = '';

                    multiCheckBoxDetailBody.append("<div class='cont'><div><input type='checkbox' class='mulinput' value='" + val + "' /></div><div>" + $(this).text() + "</div></div>");
                });

                multiCheckBoxDetailBody.css("max-height", (parseInt($(".MultiCheckBoxDetail").css("max-height")) - 28) + "px");
            },
            UpdateSelect: function () {
                var arr = [];

                this.prev().find(".mulinput:checked").each(function () {
                    arr.push($(this).val());
                });

                this.val(arr);
            },
        });
</script>
</body>
</html>