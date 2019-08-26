@extends('remote.layout')
@section('content')

    
<div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-select-all"></i>
                                            </div>
                                            <div class="text">
                                                <h2>112</h2>
                                                <span>تعداد دستگاه ها</span>
                                            </div>
                                        </div>
                                        <br/>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-receipt"></i>
                                            </div>
                                            <div class="text">
                                                <h2>121.5 TH</h2>
                                                <span>مجموع کل نرخ هش</span>
                                            </div>
                                        </div>
                                        <br/>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2>105</h2>
                                                <span>تعداد دستگاه های فعال</span>
                                            </div>
                                        </div>
                                        <br/>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <!-- <i class="fa fa-address-book"></i> -->
                                                <img src="{{URL::asset('remoteDashboard/images/bitcoin.svg')}}" style="height: 60px;">
                                            </div>
                                            <div class="text">
                                                <h2 style="direction: rtl;">10250 دلار</h2>
                                                <span>قیمت بیت کوین</span>
                                            </div>
                                        </div>
                                        <br/>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

   <br/>
   
   @include('remote/scripts')
@endsection