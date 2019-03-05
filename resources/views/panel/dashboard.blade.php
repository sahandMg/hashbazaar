@extends('panel.master.layout')
@section('title')
    <title>Dashboard</title>
@endsection
@section('content')
    <?php
    $settings = DB::table('settings')->first();
            foreach ($hashes as $key=> $hash){

                $remainedLife[$key] = floor((\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($hash->created_at)->addYears($hash->life)))/($hash->life * 365) * 100) ;
            }

    ?>
    <!-- Dashboard Page -->
        <div id="dashboard-page" class="panel-container ">
            <!-- Circle -->
             <div class="circle-container">

                <div id="dashboard-page-circle" >
                    <span id="circle-span" class="text-center">Total Mining</span>
                    <p>&nbsp;<span id="miningBTC"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> &nbsp; <span style="color: orange;">BTC</span> </p>
                    <hr style="width: 84%; text-align:center;">
                    <p><span id="miningDollar"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> &nbsp; &nbsp; <span style="color: aqua;">USD</span></p>
    
                    {{-- <button id="redeem" disabled onclick="redeem()"> Redeem ! </button> --}}
    
    
                </div>
    
                <div id="dashboard-page-circle2">
                    <span id="circle-span">Daily Mining</span>
                    <p>&nbsp;<span id="miningBTC2"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> &nbsp; <span style="color: orange;">BTC</span> </p>
                    <hr style="width: 84%; text-align:center;">
                    <p><span id="miningDollar2"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> &nbsp; &nbsp; <span style="color: aqua;">USD</span></p>
    
                    {{-- <button id="redeem" disabled onclick="redeem()"> Redeem ! </button> --}}
    
    
                </div> 


             </div>
            <!-- Hash History -->
            
            <div class="title-flex">
            
                    <hr class="dashboard-hr"/>
                    <h1 class="dashboard-title hash">Hash History</h1>
                    <hr class="dashboard-hr"/>
            
            </div> 

            <div class="Hash-History">

                    <table class="table custom-table" style="color: black;">
                            @if(!$hashes->isEmpty())
                          <thead>
                            <tr style="height:70px !important;font-weight:bold">
                                <th>Hash Power</th>
                                <th>Started at</th>
                                <th>Ends at</th>
                                <th>Remain</th>
                             </tr>
                           </thead>
                           <tbody >
                            <tr style="height:80px !important">
                                <td>
                                    @foreach($hashes as $hash)
                                        <span>{{$hash->hash}}TH/S</span>
                                    @endforeach         
                                </td>
                                <td>
                                    @foreach($hashes as $hash)
                                       <span>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}}    </span> 
                                        @endforeach
                                </td>
                                <td> 
                                        @foreach($hashes as $hash)
                                        <span>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}   </span>
                                        @endforeach
                                </td>
            
                                <td>
                                    @foreach($hashes as $key => $hash)
                                            <div class="remain">
                                                <div class="progress1">
                                                    <div class="progress-bar1" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%;width: {{$remainedLife[$key]}}%;">
                                                        <span class="title">{{$remainedLife[$key]}}%</span>
            
                                                    </div>
                                                </div>
                                            </div>  
                                      @endforeach    
                                </td>
                            </tr>
                           </tbody>



                {{--<table id="Hash-History-list">--}}
                    {{--@if(!$hashes->isEmpty())--}}

                    {{--<tr>--}}
                        {{--<th class="Hash-History_column"> --}}
                            {{--Hash Power  --}}
                        {{--</th>--}}

                        {{--<th class="Hash-History_column"> --}}
                            {{--Started at--}}
                           {{----}}
                        {{--</th>--}}

                        {{--<th class="Hash-History_column"> --}}
                            {{--Ends at--}}

                    {{--<table class="table custom-table" style="color: black;">--}}
                            {{--@if(!$hashes->isEmpty())--}}
                          {{--<thead >--}}
                            {{--<tr style="font-weight:bolder;">--}}
                                {{--<th>Hash Power</th>--}}
                                {{--<th>Started at</th>--}}
                                {{--<th>Ends at</th>--}}
                                {{--<th>Remain</th>--}}
                             {{--</tr>--}}
                           {{--</thead>--}}
                           {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--@foreach($hashes as $hash)--}}
                                        {{--<span>{{$hash->hash}}TH/S</span>--}}
                                    {{--@endforeach         --}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--@foreach($hashes as $hash)--}}
                                       {{--<span>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}}    </span> --}}
                                        {{--@endforeach--}}
                                {{--</td>--}}
                                {{--<td> --}}
                                        {{--@foreach($hashes as $hash)--}}
                                        {{--<span>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}   </span>--}}
                                        {{--@endforeach--}}
                                {{--</td>--}}
            {{----}}
                                {{--<td>--}}
                                    {{--@foreach($hashes as $key => $hash)--}}
                                            {{--<div class="remain">--}}
                                                {{--<div class="progress1">--}}
                                                    {{--<div class="progress-bar1" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%;width: {{$remainedLife[$key]}}%;">--}}
                                                        {{--<span class="title">{{$remainedLife[$key]}}%</span>--}}
            {{----}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>  --}}
                                      {{--@endforeach    --}}
                                {{--</td>--}}
                            {{--</tr>--}}
                           {{--</tbody> --}}


                            
                        {{--</th>--}}

                        <th class="Hash-History_column"> 
                            Remain
                            
                        </th>

                        </tr>
                            @foreach($hashes as $key => $hash)
                        <tr>


                                <td>
                                    <span>{{$hash->hash}}TH/S</span>
                                </td>
                                <td>
                                    <span>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}}    </span>
                                </td>
                                <td>
                                    <span>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}   </span>
                                </td>


                                <td>
                                    <div class="remain">
                                        <div class="progress1">
                                            <div class="progress-bar1" role="progressbar1" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%">
                                                <span class="title">{{$remainedLife[$key]}}%</span>

                                            </div>
                                        </div>
                                    </div>

                                </td>
                        </tr>
                            @endforeach

                        @else
                            <p id="no-hash"> NO Hash History</p>
                        @endif



                </table>

            </div> 


            <!--   Buy hash power -->
            <div class="title-flex">
                <hr  class="dashboard-hr"/>

                <h1 class="dashboard-title">Buy Hash Power</h1>

                <hr  class="dashboard-hr"/>
            </div>
            <h5 id="demo"></h5>
            <div class="slidecontainer">
                @if(count($errors->all()) > 0)
                    <ul>
                        @foreach($errors as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                @if(session()->has('error'))
                    <p>{{session('error')}}</p>
                  @endif
                @if($settings->available_th > 0)
                <form class="dashboard-page" method="post" action="{{route('payment')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="range" min="1" max="{{$settings->available_th}}" value="{{$settings->available_th/2}}" name="hash" class="slider" id="myRange">
                    <div style="text-align: left;font-weight: 700;padding-bottom:10px">
                      <p style="color:black">Hash allocation cost : <span id="cost"></span> dollar</p>
                      <p style="color:black">Maitanace fee: {{$settings->maintenance_fee_per_th_per_day}} dollar per Th/day</p>
                      <small>(include all electricity, cooling, development, and servicing costs )</small>
                      <p style="color:black">Income : At this time We predict {{$settings->bitcoin_income_per_month_per_th}} BTC/month for every Th.</p>
                      <small >(Changes may happen depends on bitcoin price and bitcoin network difficulty changes.)</small>
                    </div>
                    <p class="rfrcode">Referral Code:</p>
                    {{-- <form style="padding: 20px;" method="POST" action="{{route('dashboard')}}"> --}}
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

<<<<<<< HEAD

                       <input id='referralCode' type="text" name="referralCode" style="margin-top:5px" class="aplybtn1text">

                       {{--<input id='referralCode' type="text" name="referralCode" class="aplybtn1text" style="margin-top:5px" >--}}

=======
                       <input id='referralCode' type="text" name="referralCode" style="margin-top:5px" class="aplybtn1text">
>>>>>>> 899b2b6a833cfd001750a57f6a05940e227ca638
                       <input id='hiddenCodeValue' type="hidden" name="code" style="margin-top:5px" >

                          <button type="button" onclick="sendCode()" class="btn btn-primary aplybtn"> Apply </button>


                         {{-- </form> --}}
                    <button class="pandel-button" type="submit">Order</button>
                 </form>
                @else
                  <p> TH Not Available !</p>
                @endif
            </div>


            <!-- Mining History -->
            <div class="title-flex">

                <hr class="dashboard-hr" >
                <h3 class="dashboard-title min">Mining History</h3>
                <hr class="dashboard-hr" >

            </div> 
          <div style="margin-right: 20px;">
            <div class="ct-chart">
                    <!-- <canvas id="chart1"></canvas> chart-container -->
            </div> 
          </div>

    </div>
   

        <style type="text/css">

         .dashboard-page p {
          margin: 0px;padding: 0px;padding-top: 5px; font-size: 18px;line-height: 1.6;
         }
         .dashboard-page small {
            color: #707070;
         }
        .chart-container {
            direction: rtl;
            position: relative;
            /*display: block;*/
            /*margin: auto;*/
            /*margin: 0px; */
          /*  height: 40vh;*/
            /*width: 65vw;*/
            /*height: 500px !important;*/
            margin-top: 5%;
         }

         @media screen and (max-width:414px) {
           .dashboard-page p {
             padding-top: 5px; font-size: 15px;line-height: 1.4;
           }
           .dashboard-page small {
             font-size: 13px;
            }
         }
         canvas#chart1 {
            margin: auto;
         }

         @media screen and (min-width:320px) {
           .chart-container {
               height: 250px !important;
            }
            canvas#chart1 {
                width: 310px !important;
            
            }
         }
         @media screen and (min-width:370px) {
           .chart-container {
               height: 250px !important;
              
            }
            canvas#chart1 {
                width: 350px !important;
               
            }
         }
         @media screen and (min-width:414px) {
            .chart-container {
               height: 300px !important;
              /*width: 50vw;*/
            }
            canvas#chart1 {
                width: 350px !important;
                height: 220px;
            }
         }
         @media screen and (min-width:526px) {
            .chart-container {
              height: 300px !important;
              /*width: 400px;*/
            }
            canvas#chart1 {
                width: 480px !important;
            }
         }
         @media screen and (min-width:768px) {
            .chart-container {
              height: 300px !important;
              /*width: 400px;*/
            }
            canvas#chart1 {
                width: 600px !important;
            }
         }

         @media screen and (min-width:868px) {
            .chart-container {
              height: 300px !important;
              /*width: 400px;*/
            }
            canvas#chart1 {
                width: 540px !important;
            }
         }
         @media screen and (min-width:1024px) {
            .chart-container {
               height: 340px !important;
              /*width: 50vw;*/
            }
            canvas#chart1 {
                width: 570px !important;
            }
         }
         @media screen and (min-width:1224px) {
            canvas#chart1 {
                width: 840px !important;
            }
         }
         @media screen and (min-width:1324px) {
            canvas#chart1 {
                width: 850px !important;
            }
        
         }

.progress1 {    border: 1px solid;}
.progress-bar1 {
    background-color: #ff9100;
    text-align: center;
    color: white;
  width: 0;
  -webkit-animation: progress 1.5s ease-in-out forwards;
          animation: progress 1.5s ease-in-out forwards;
}
.progress-bar1 .title {
  opacity: 0;
  -webkit-animation: show 0.35s forwards ease-in-out 0.5s;
          animation: show 0.35s forwards ease-in-out 0.5s;
}

@-webkit-keyframes progress {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}

@keyframes progress {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}
@-webkit-keyframes show {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
@keyframes show {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
.ct-series-a .ct-area, .ct-series-a .ct-slice-donut-solid, .ct-series-a .ct-slice-pie {
    fill: #ff9100;
}
.ct-series-a .ct-bar, .ct-series-a .ct-line, .ct-series-a .ct-point, .ct-series-a .ct-slice-donut {
    stroke: #ff9100;
}
.ct-label { color: black; }
</style>

<script>
      
                // ------------user account--------------------
                $(document).ready(function(){

                    $('.user-img').click(function(){
                        $('.list1').toggle(500);
                    });
                    
                    var numItems = $('.table tr').length;



                    // if( numItems > 2)
                    //     $('#Hash-History-list').css('overflow-y' , "scroll");

                    // alert($('#Hash-History-list tr').length);
//                    console.log($('#Hash-History-list tr').length)



                    
                    if( numItems > 3)
                    {
                        $('.Hash-History').css('overflow-y' , "scroll");
                    console.log("numItems > 3");
                    } else {
                        $('.Hash-History').css('overflow-y' , "hidden");
                    console.log("numItems < 3");
                        
                    }
                    
                });

                var user = {!! json_encode(\Illuminate\Support\Facades\Auth::guard('user')->user()->code) !!}

                function redeem(id) {

                    axios.get('{{route('redeem')}}'+'?user='+user).then(function (response) {

                        console.log(response.data)
                    })
                };
                var activateDiscount = {!! $apply_discount !!};// $apply_discount == 0 Or 1
                var thPrice = {!! $settings->usd_per_hash !!}
                function sendCode() {

                    var code = document.getElementById('referralCode').value;

                    axios.post('{{route('SendCode')}}',{referralCode:code}).then(function (response) {

                        var resp = response.data;
                        if(resp['type'] == 'error'){
                            alert(resp['body'])

                        }else{

                            alert(resp['body']);
                            document.getElementById('hiddenCodeValue').value = code;
                            thPrice = {!! $settings->usd_per_hash * (1 - $settings->sharing_discount) !!}
                            activateDiscount = 1;
                        }

                    });
                };

                 // =---------------------------------------

                axios.post({!! json_encode('totalEarn') !!},{'user':user}).then(function (response) {
//                     console.log(id);
//                     console.log(response.data);
                    // console.log("response.data");
                    if(response.data[0] == 0){

                        document.getElementById('miningBTC').innerHTML = 0;
                        document.getElementById('miningDollar').innerHTML = 0;
                        document.getElementById('miningBTC2').innerHTML = 0;
                        document.getElementById('miningDollar2').innerHTML = 0;
                    }else{
                    var miningBTC = response.data[0].toFixed(8);
                    var miningDollar = response.data[1].toFixed(8);
                    var userPendingBtc = {!! Auth::guard('user')->user()->pending !!};
                    var userPendingUsd = userPendingBtc * miningDollar/miningBTC;
                        document.getElementById('miningBTC').innerHTML = miningBTC;
                        document.getElementById('miningDollar').innerHTML = miningDollar;
                        document.getElementById('miningBTC2').innerHTML = userPendingBtc.toFixed(8);
                        document.getElementById('miningDollar2').innerHTML = userPendingUsd.toFixed(8);
                        var minimum_redeem = {!! json_encode($settings->minimum_redeem) !!}
                        if(response.data[0] >= minimum_redeem){
                            document.getElementById('redeem').disabled = false;
                        }
                        // console.log(response.data);
                    }

                });


                    var slider = document.getElementById("myRange");
                    var output = document.getElementById("demo");
                    var cost = document.getElementById("cost");
                    output.innerHTML = slider.value+' Th';
                    if(activateDiscount == 1){

                        thPrice = {!! $settings->usd_per_hash * (1 - $settings->sharing_discount) !!}
                    }
                    cost.innerHTML = slider.value * thPrice ;
                    // Display the default slider value
                    
                    slider.oninput = function() {
                        output.innerHTML = this.value+' Th';
                        if(activateDiscount == 1){

                            thPrice = {!! $settings->usd_per_hash * (1 - $settings->sharing_discount) !!}
                        }
                        cost.innerHTML = slider.value  * thPrice;
                        };

                    //    ==================================chart==============
                var dateFormat = 'YYYY DD MMMM';
                var date = moment('April 01 2017', dateFormat);
                var dateTime = [];
                var data = [];
                var labels = [];
            axios.get('{{route('chartData').'?user='. Auth::guard('user')->user()->code}}').then(function (response) {
                

                dateTime = response.data;
                console.log(dateTime);
                var timeLabels= [];
                var data= [];
                if(dateTime !== 404){
                    for(i=0 ; i < dateTime.length ; i++){
                        timeLabels.push(dateTime[i].time);
                        data.push(dateTime[i].mined);
                    }
                }
                var data2D = [];data2D.push(data);
                new Chartist.Line('.ct-chart', {
                  labels: timeLabels,
                   series: data2D
                }, {
                    low: 0,
                    showArea: true
                });
            });

</script>
@endsection