@extends('admin.layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard </h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active">Dashboard </li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- ============================================================== -->
        <!-- Sales, finance & Expance widgets -->
        <!-- ============================================================== -->
        <!-- .row -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="white-box bg-theme-alt m-b-0">
                    <h3 class="box-title text-white">Sales</h3>
                    <div class="demo-container" style="height:140px;">
                        <div id="placeholder" class="demo-placeholder"></div>
                    </div>
                </div>

            </div>
            <!-- col-md-3 -->
            <div class="col-md-5 col-sm-12 col-lg-4" style="display: none">
                <div class="white-box">
                    <h3 class="box-title">Sales</h3>
                    <div id="morris-donut-chart" style="height:318px; padding-top: 50px;"></div>
                    <div class="row p-t-30">
                        <div class="col-xs-8 p-t-30">
                            <h3 class="font-medium">TOTAL SALES</h3>
                            <h5 class="text-muted m-t-0">160 sales monthly</h5>
                        </div>
                        <div class="col-xs-4 p-t-30">
                            <div class="circle-md pull-right circle bg-info"><i class="ti-shopping-cart"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row" style="display: none">
            <!-- col-md-3 -->
            <div class="col-md-12 col-lg-5">
                <div class="white-box">
                    <h3 class="box-title">Finance</h3>
                    <div id="diagram"></div>
                    <div class="get">
                        <div class="arc"> <span class="text">Aug</span>
                            <input type="hidden" class="percent" value="95" />
                            <input type="hidden" class="color" value="#53e69d" /> </div>
                        <div class="arc"> <span class="text">Sep</span>
                            <input type="hidden" class="percent" value="90" />
                            <input type="hidden" class="color" value="#ff7676" /> </div>
                        <div class="arc"> <span class="text">Oct</span>
                            <input type="hidden" class="percent" value="80" />
                            <input type="hidden" class="color" value="#88B8E6" /> </div>
                        <div class="arc"> <span class="text">Nov</span>
                            <input type="hidden" class="percent" value="53" />
                            <input type="hidden" class="color" value="#BEDBE9" /> </div>
                        <div class="arc"> <span class="text">Dec</span>
                            <input type="hidden" class="percent" value="45" />
                            <input type="hidden" class="color" value="#EDEBEE" /> </div>

                    </div>
                    <div class="row p-t-30">
                        <div class="col-xs-8">
                            <h1 class="font-medium m-t-0">56%</h1>
                            <h5 class="text-muted m-t-0">increase in Nov</h5>
                        </div>
                        <div class="col-xs-4">
                            <div class="circle-md pull-right circle bg-success"><i class="ti-stats-up"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- col-md-3 -->
        </div>
        <!-- ============================================================== -->
        <!-- Sales different chart widgets -->
        <!-- ============================================================== -->
        <!-- .row -->

        <!-- /.row -->
        <!-- ============================================================== -->
        <!-- Sales, weather & calander widgets -->
        <!-- ============================================================== -->
        <!-- .row -->
        <!-- /.row -->
        <!-- ============================================================== -->
        <!-- Recent comment, table & feed widgets -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Profile, & inbox widgets -->
        <!-- ============================================================== -->
        <!-- .row -->
        <!-- /.row -->
        <!-- ============================================================== -->
        <!-- To do list, & Feed widgets -->
        <!-- ============================================================== -->

    </div>
@endsection

