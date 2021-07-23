@extends('admin.master')
@section('content')
<div class="container-fluid sparkline13-list">
  <div class="page-header">
    <h2 class="main-content-title tx-24 mg-b-5">BAMTHOBE DASHBOARD</h2>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"> Dashboard</li>
    </ol>
  </div>
  
 <div class="panela_section">
            <h3 class="title_sec"> Orders </h3>
            <div class="row">
              <div class="col-md-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$totalsale}}</h3>
                        <p>Total Sale</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{url('delivered/order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
               <div class="col-md-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$totalorder->count()}}</h3>
                            <p>Total Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document-text"></i>
                        </div>
                        <a href="{{url('total/order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                  <div class="small-box bg-danger">
                      <div class="inner">
                          <h3>{{$pendingorder}}</h3>
                          <p>Pending Orders</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-document-text"></i>
                      </div>
                      <a href="{{url('pending/order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$delay_order->count()}}</h3>
                        <p>Delay Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-document-text"></i>
                    </div>
                    <a href="{{url('delay-order-list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <div class="col-md-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $confirm_order}}</h3>
                            <p>Confirmed Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{url('confirm/order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                 <div class="col-md-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$cancel_order}}</h3>
                            <p>Cancelled Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{url('cancel/order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
				<div class="col-md-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$deliverd_order}}</h3>
                            <p>Delivered Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{url('delivered/order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
         


		  </div>



           
        </div>
  
  
  
  
  <!-- <div class="row home_card">
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 card-spacing">
                <div class="card-content">
                  <?php

      $date=date('d-m-Y');

      $today=DB::table('students')

      ->select('students.*')

      ->where('date',$date)

      ->where('status',1)

      ->count();

      ?>
                  <h5 class="font-15"> students registered today</h5>
                  <h2 class="mb-3 font-18">{{ $today }}</h2>
                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                </div>
              </div>
              <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img"> <img src="{{ asset('assets/img/icon/1.png') }}" alt="banner 01"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 card-spacing">
                <div class="card-content">
                  <?php

      $all=DB::table('students')

      ->select('students.*')

      ->where('status',1)

      ->count();

      ?>
                  <h5 class="font-15"> students on the platform</h5>
                  <h2 class="mb-3 font-18">{{ $all }}</h2>
                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                </div>
              </div>
              <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img"> <img src="{{ asset('assets/img/icon/2.png') }}" alt="banner 01"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 card-spacing">
                <div class="card-content">
                  <?php

      $premium=DB::table('students')

      ->select('students.*')

      ->where('student_type','premium')

      ->where('status',1)

      ->where('date',$date)

      ->count();

      ?>
                  <h5 class="font-15"> premium users registered today</h5>
                  <h2 class="mb-3 font-18">{{ $premium }}</h2>
                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                </div>
              </div>
              <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img"> <img src="{{ asset('assets/img/icon/6.png') }}" alt="banner 01"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 card-spacing">
                <div class="card-content">
                  <?php

      $premium=DB::table('students')

      ->select('students.*')

      ->where('student_type','premium')

      ->where('status',1)

      ->count();

      ?>
                  <h5 class="font-15"> premium users on the platform</h5>
                  <h2 class="mb-3 font-18">{{ $premium }}</h2>
                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                </div>
              </div>
              <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img"> <img src="{{ asset('assets/img/icon/5.png') }}" alt="banner 01"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 card-spacing">
                <div class="card-content">
                  <?php

      $premium=DB::table('students')

      ->select('students.*')

      ->where('student_type','standard')

      ->where('status',1)

      ->where('date',$date)

      ->count();

      ?>
                  <h5 class="font-15"> standard users registered today</h5>
                  <h2 class="mb-3 font-18">{{ $premium }}</h2>
                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                </div>
              </div>
              <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img"> <img src="{{ asset('assets/img/icon/8.png') }}" alt="banner 01"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 card-spacing">
                <div class="card-content">
                  <?php

      $premium=DB::table('students')

      ->select('students.*')

      ->where('student_type','standard')

      ->where('status',1)

      ->count();

      ?>
                  <h5 class="font-15"> standard users on the platform</h5>
                  <h2 class="mb-3 font-18">{{ $premium }}</h2>
                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                </div>
              </div>
              <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img"> <img src="{{ asset('assets/img/icon/7.png') }}" alt="banner 01"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 card-spacing">
                <div class="card-content">
                  <?php

      $premium=DB::table('students')

      ->select('students.*')

      ->where('student_type','standard')

      ->where('status',1)

      ->count();

      ?>
                  <h5 class="font-15"> Most practiced</h5>
                  <h2 class="mb-3 font-18">{{ 0 }}</h2>
                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                </div>
              </div>
              <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img"> <img src="{{ asset('assets/img/icon/4.png') }}" alt="banner 01"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 card-spacing">
                <div class="card-content">
                  <?php

      $premium=DB::table('students')

      ->select('students.*')

      ->where('student_type','standard')

      ->where('status',1)

      ->count();

      ?>
                  <h5 class="font-15"> New Average time spent</h5>
                  <h2 class="mb-3 font-18">{{ 0 }}</h2>
                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                </div>
              </div>
              <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img"> <img src="{{ asset('assets/img/icon/10.png') }}" alt="banner 01"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



<div class="row chartjs">







    
            <div class="col-lg-6">
			<h4 class="sub_heading">Time Spent Practicing</h4>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                </div>
                <div class="card-body">
                  <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                  </div>
              
                </div>
              </div>
            </div>




       
            <div class="col-lg-6">
						<h4 class="sub_heading">		Foundations of Supply Management</h4>
	
			
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>

                </div>
              </div>
            </div>





</div>
 -->
</div>


@endsection


</body>