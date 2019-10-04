@extends('panel.master.layout')

@section('title')
@if(App::getlocale() == 'fa')
<title>هش بازار | میزکار </title>
@else
<title>Hashbazaar | Dashboard</title>
@endif
@endsection
@section('content')
@if(App::getlocale() == 'fa')
<?php
    $settings = DB::connection('mysql')->table('settings')->first();
            foreach ($hashes as $key=> $hash){
                if($hash->plan_id == 1)
                    $remainedLife[$key] = 100;
                else{
                    $remainedLife[$key] = floor((\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($hash->created_at)->addDays(env('contract_time'))))/(env('contract_time')) * 100) ;
                }

            }
    $codes = DB::connection('mysql')->table('expired_codes')->where('user_id',Auth::guard('user')->id())->where('used',0)->first();
            $AppliedCode = isset($codes->code)?$codes->code:null;
    $planIds = Auth::guard('user')->user()->plans->pluck('plan_id')->toArray();
    ?>
<!-- Dashboard Page dashboard-page -->
<div class="container" style="direction: rtl;">
 <!-- Circle -->
  <div class="d-flex justify-content-around flex-wrap">
    <div class="col-lg-6 col-md-6 col-sm-11">
      <div class="circle-container">
        <h2 class="text-center mb-2">{{__("Total Earn")}}</h2>
        <div class="text-center ajax-loader">
          <img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40">
        </div>
        <div class="text-center" style="direction: ltr;"><span class="englishFont" id="miningBTC"></span><span style="color: orange;"> BTC </span></div>
        <div class="text-center mx-auto col-lg-9 col-md-10 col-sm-11">
          <hr/>
        </div>
        <div class="text-center ajax-loader">
          <img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40">
        </div>
        <div class="text-center" style="direction: ltr;"><span id="miningDollar" class="englishFont"></span><span style="color: #0BDB83;"> USD </span></div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-11">
      <div class="circle-container">
        <h2 class="text-center mb-2">{{__("Pending Payment")}}</h2>
        <div class="text-center ajax-loader">
          <img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40">
        </div>
        <div class="text-center" style="direction: ltr;">&nbsp;<span class="englishFont" id="miningBTC2"></span> <span style="color: orange;">BTC</span></div>
        <div class="text-center mx-auto col-lg-9 col-md-10 col-sm-11">
          <hr/>
        </div>
        <div class="text-center ajax-loader">
          <img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40">
        </div>
        <div class="text-center" style="direction: ltr;"><span class="englishFont" id="miningDollar2"></span> <span style="color: #0BDB83;">USD</span></div>
      </div>
    </div>
  </div>
  <!-- Hash History -->
  <div class="d-flex justify-content-center  title-container">
    <hr class="flex-grow-1" />
    <h3 class="px-2">{{__("Hash History")}}</h3>
    <hr class="flex-grow-1" />
  </div>
  <div class="table-responsive">
    <table class="table text-center">
    @if(!$hashes->isEmpty())
          <thead>
            <tr style="font-weight:bold">
              <th style="min-width: 150px;">{{__("Hash Power")}}</th>
              <th style="min-width: 150px;">{{__("Started at")}}</th>
              <th style="min-width: 150px;">{{__("Ends at")}}</th>
              <th style="min-width: 150px;">{{__("Remain")}}</th>
            </tr>
          </thead>
          <tbody >
            @foreach($hashes as $key=> $hash)
                @if(Config::get('app.locale') == 'fa')
            <tr>
              <td>
                <span>{{$hash->hash}} تراهش </span>
                @if($hash->order_id == 'referral')
                <div class="box reward"></div>
                @endif
              </td>

          <td>

              <span>  {{  \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($hash->created_at))->format('Y/m/d')}}  </span>

            </td>

            <td>

                <span>  {{  \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($hash->created_at)->addDays(env('contract_time')))->format('Y/m/d')}}  </span>

            </td>

            <td>

                    <div class="remain">
                        <div class="progress1">
                            <div class="progress-bar1" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%;width: {{$remainedLife[$key]}}%;">
                                <span class="title">{{$remainedLife[$key]}}%</span>

                            </div>
                        </div>
                    </div>

          </td>
        </tr>
            @else
                    <tr>
                        <td>
                            <span>{{$hash->hash}}TH/S</span>
                            @if($hash->order_id == 'referral')
                                <div class="box reward"></div>
                            @endif
                        </td>

                        <td>

                            <span>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}}    </span>

                        </td>

                        <td>

                            <span>{{\Carbon\Carbon::parse($hash->created_at)->addMonths(env('contract_time'))->format('M d Y')}}   </span>

                        </td>

                        <td>

                            <div class="remain">
                                <div class="progress1">
                                    <div class="progress-bar1" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%;width: {{$remainedLife[$key]}}%;">
                                        <span class="title">{{$remainedLife[$key]}}%</span>

                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
            @endif
        @endforeach
      </tbody>

      @else
        <h6 id="no-hash" class="text-center" > {{__("NO Hash History")}}</h6>
      @endif

    </table>
  </div>
  <!--   Buy hash power -->
  <div class="d-flex justify-content-center  title-container">
    <hr class="flex-grow-1" />
    <h3 class="px-2">{{__("Buy Hash Power")}}</h3>
    <hr class="flex-grow-1" />
  </div>
<div>
  <div class="d-flex justify-content-center" style="margin-bottom: 5%;">
      <button class="btnTab" id="planClassicBtn">طرح کلاسیک</button>
      <button class="btnTab" id="planClassicZeroBtn">طرح کلاسیک صفر</button>
  </div>
  <div>
    <h5 id="demo" class="text-center"></h5>
    <div class="slidecontainer">
       @if(count($errors->all()) > 0)
         <ul>@foreach($errors as $error)<li>{{$error}}</li>@endforeach</ul>
       @endif
       @include('sessionError')
       @if($settings->available_th > 0)
           <input type="hidden" id="plankind" value="1"/>
           <input type="hidden" id="thpricew" value="50"/>
           <input type="range" min="1" max="100" value="{{isset($hashPower)?$hashPower:$settings->available_th/2}}" name="hash" class="slider" id="myRange"/>
           <div class="buy-hashpower-text" style="font-weight: 700;padding-bottom:10px">
              <p style="color:black">{{__("Hash allocation cost :")}} <span id="cost"></span> {{__("dollar")}}
               <span id="doReferalCode" style="animation-iteration-count:infinite;padding:2px"></span>
              </p>

{{--              @if(in_array('2',$planIds))--}}
                    <!-- <p class="planClassic" style="color:black">{{__('Maintenance fee')}}:  {{ round($settings->maintenance_fee_per_th_per_day*$settings->usd_toman)}} تومان {{__('dollar per Th/day')}}</p> -->
                    <p class="planClassic" style="color:black">{{__('Maintenance fee')}}: 30 درصد از درآمد روزانه، کسر می شود. </p>
              {{--@endif--}}
              <p class="planClassicZero" style="color:black">هزینه نگهداری: 0 تومان برای هر روز به ازای هر تراهش</p>
              <small style="color: #707070;">{{__("(include all electricity, cooling, development, and servicing costs )")}}</small>
              <!-- <p style="color:black">{{__('Income : At this time We predict')}} {{$settings->bitcoin_income_per_month_per_th}} {{__('BTC/month per Th')}}</p>
              <small  style="color: #707070;">{{__("(May be changed depends on bitcoin price and bitcoin network difficulty)")}}</small> -->
            </div>
            <!-- <div id="referralDiv">
                 <label id="referralLabel" for="referralCode">کد ارجاع:</label>
                 <input required id='referralCode' type="text" placeholder="{{$AppliedCode}}" name="referralCode" style="margin-top:5px" class="aplybtn1text"/>
                 <button id="code" type="button" onclick="sendCode()" class="btn btn-primary aplybtn"> درخواست </button>
            </div> -->
                @if($settings->paystar_active == 1)
                    <form onsubmit="order()" class="dashboard-page" method="post" action="{{route('PaystarPaying',['locale'=>session('locale')])}}">
                @elseif($settings->zarrin_active == 1)
                    <form onsubmit="order()" class="dashboard-page" method="post" action="{{route('ZarrinPalPaying',['locale'=>session('locale')])}}">
                @elseif($settings->zibal_active == 1)
                            <form onsubmit="order()" class="dashboard-page" method="post" action="{{route('ZibalPaying',['locale'=>session('locale')])}}">
                @endif
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
              @if($apply_discount == 1)

                      <input id="discount" type="hidden" name="discount" value="{{$discount}}"/>

              @else
                      <input id="discount" type="hidden" name="discount" value="0"/>
              @endif
                <input id='hiddenCodeValue' type="hidden" name="code" style="margin-top:5px" value="{{$AppliedCode}}" />
                <input type="range" hidden min="1" max="{{$settings->available_th}}" value="{{$settings->available_th/2}}" name="hash" class="slider" id="hiddenRange"/>
                    <input type="hidden" name="plan" value="2" id="planType"/>
                <button id="orderBtn" class="pandel-button" type="submit">{{__("Order")}}</button>
                    </form>
        @else
             <p style="color: black;text-align: center;"> {{__("TH Not Available !")}}</p>
        @endif
    </div>
  </div>
 </div>
  <!-- Mining History -->
  <div class="d-flex justify-content-center title-container">
    <hr class="flex-grow-1" />
    <h3 class="px-2">{{__("Mining History")}}</h3>
    <hr class="flex-grow-1" />
  </div>
  <div>
    <div class="ct-chart">
    </div>
  </div>
</div>

<br/><br/><br/><br/>

<style type="text/css">
   .ct-series-a .ct-area, .ct-series-a .ct-slice-donut-solid, .ct-series-a .ct-slice-pie {
      fill: #ff9100;
  }
  .ct-series-a .ct-bar, .ct-series-a .ct-line, .ct-series-a .ct-point, .ct-series-a .ct-slice-donut {
      stroke: #ff9100;
  }
  .ct-label { color: black; }

  .ct-area {
    stroke: none;
    fill-opacity: .1;
  }
</style>
  @include('panel/dashboardScripts')
@else

@endif
@endsection
