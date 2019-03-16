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
    $codes = DB::table('expired_codes')->where('user_id',Auth::guard('user')->id())->where('used',0)->first();
            $AppliedCode = isset($codes->code)?$codes->code:null;
    ?>
<!-- Dashboard Page -->
<div id="dashboard-page" class="panel-container "  onclick="hideMe()">
  <!-- Circle -->
  <div class="circle-container">
    <div id="dashboard-page-circle" >
      <h2 id="circle-span" class="text-center">Total Earn</h2>
      <p>&nbsp;<span id="miningBTC"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> <span style="color: orange;">BTC</span></p>
      <hr style="width: 84%; text-align:center;">
      <p><span id="miningDollar"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> <span style="color: aqua;">USD</span></p>
      <!-- {{-- <button id="redeem" disabled onclick="redeem()"> Redeem ! </button> --}} -->
    </div>
    <div id="dashboard-page-circle2">
      <h2 id="circle-span" class="text-center">Pending Payment</h2>
      <p>&nbsp;<span id="miningBTC2"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> <span style="color: orange;">BTC</span></p>
      <hr style="width: 84%; text-align:center;">
      <p><span id="miningDollar2"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> <span style="color: aqua;">USD</span></p>
      <!-- {{-- <button id="redeem" disabled onclick="redeem()"> Redeem ! </button> --}} -->
    </div> 
  </div>
  <!-- Hash History -->
  <div class="title-flex" >
    <hr class="dashboard-hr"/>
    <h3 class="dashboard-title hash">Hash History</h3>
    <hr class="dashboard-hr"/>
  </div> 
  <div class="Hash-History">

    <table class="table custom-table" style="color: black;">
      @if(!$hashes->isEmpty())
      <thead>
        <tr style="font-weight:bold">
          <th>Hash Power</th>
          <th>Started at</th>
          <th>Ends at</th>
          <th>Remain</th>
        </tr>
      </thead>
      <tbody >
        @foreach($hashes as $key=> $hash)
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

                <span>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}   </span>

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
        @endforeach
      </tbody>
                       

                        {{--@else--}}
                            {{--<p id="no-hash"> NO Hash History</p>--}}
                        {{--@endif--}}

                {{--</table>--}}

            {{--</div> --}}


            {{--<!--   Buy hash power -->--}}
            {{--<div class="title-flex">--}}
                {{--<hr  class="dashboard-hr"/>--}}

                {{--<h3 class="dashboard-title">Buy Hash Power</h3>--}}

                {{--<hr  class="dashboard-hr"/>--}}
            {{--</div>--}}
            {{--<h5 id="demo"></h5>--}}
            {{--<div class="slidecontainer">--}}
                {{--@if(count($errors->all()) > 0)--}}
                    {{--<ul>--}}
                        {{--@foreach($errors as $error)--}}
                            {{--<li>{{$error}}</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--@endif--}}
                {{--@include('sessionError')--}}
                {{--@if($settings->available_th > 0)--}}

                {{--<!-- <form class="dashboard-page" method="post" action="{{route('payment')}}"> -->--}}
                    {{--<!-- <input type="hidden" name="_token" value="{{csrf_token()}}"> -->--}}
                    {{--<input type="hidden" id="thpricew" value="50">--}}
                    {{--<input type="range" min="1" max="{{$settings->available_th}}" value="{{isset($hashPower)?$hashPower:$settings->available_th/2}}" name="hash" class="slider" id="myRange">--}}
                    {{--<div class="buy-hashpower-text" style="text-align: left;font-weight: 700;padding-bottom:10px">--}}

                      {{--<p style="color:black">Hash allocation cost : <span id="cost"></span> dollar--}}
                         {{--<span id="doReferalCode" style="animation-iteration-count:infinite;padding:2px"></span>--}}
                      {{--</p>--}}
                      {{--<p style="color:black">Maitanace fee: {{$settings->maintenance_fee_per_th_per_day}} dollar per Th/day</p>--}}
                      {{--<small style="color: #707070;">(include all electricity, cooling, development, and servicing costs )</small>--}}
                      {{--<p style="color:black">Income : At this time We predict {{$settings->bitcoin_income_per_month_per_th}} BTC/month for every Th.</p>--}}
                      {{--<small  style="color: #707070;">(Changes may happen depends on bitcoin price and bitcoin network difficulty changes.)</small>--}}
                    {{--</div>--}}
                    {{--<p class="rfrcode">Referral Code:</p>--}}
                    {{--<input id='referralCode' type="text" name="referralCode" style="margin-top:5px" class="aplybtn1text"/>--}}
                    {{--<button type="button" onclick="sendCode()" class="btn btn-primary aplybtn"> Apply </button>--}}


                    {{--<button id="orderBtn" class="pandel-button" type="submit">Order</button>--}}
                 {{--<!-- </form> -->--}}
                {{--@else--}}
                  {{--<p> TH Not Available !</p>--}}
                {{--@endif--}}
            {{--</div>--}}


            {{--<!-- Mining History -->--}}
            {{--<div class="title-flex">--}}

                {{--<hr class="dashboard-hr" >--}}
                {{--<h3 class="dashboard-title min">Mining History</h3>--}}
                {{--<hr class="dashboard-hr" >--}}

            {{--</div> --}}
          {{--<div style="margin-right: 20px;">--}}
            {{--<div class="ct-chart">--}}
                    {{--<!-- <canvas id="chart1"></canvas> chart-container -->--}}
            {{--</div> --}}
          {{--</div>--}}


      @else
        <h6 id="no-hash" > NO Hash History</h6>
      @endif

    </table>

  </div>
  <!--   Buy hash power -->
  <div class="title-flex">
    <hr class="dashboard-hr"/>
    <h3 class="dashboard-title">Buy Hash Power</h3>
    <hr class="dashboard-hr"/>
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
    @include('sessionError')
    @if($settings->available_th > 0)

    <!-- <form class="dashboard-page" method="post" action="{{route('payment')}}"> -->
    <!-- <input type="hidden" name="_token" value="{{csrf_token()}}"> -->
    <input type="hidden" id="thpricew" value="50">
    <input type="range" min="1" max="{{$settings->available_th}}" value="{{isset($hashPower)?$hashPower:$settings->available_th/2}}" name="hash" class="slider" id="myRange">
    <div class="buy-hashpower-text" style="text-align: left;font-weight: 700;padding-bottom:10px">
      <p style="color:black">Hash allocation cost : <span id="cost"></span> dollar
        <span id="doReferalCode" style="animation-iteration-count:infinite;padding:2px"></span>
      </p>
      <p style="color:black">Maintenance fee: {{$settings->maintenance_fee_per_th_per_day}} dollar per Th/day</p>
      <small style="color: #707070;">(include all electricity, cooling, development, and servicing costs )</small>
      <p style="color:black">Income : At this time We predict {{$settings->bitcoin_income_per_month_per_th}} BTC/month per Th.</p>
      <small  style="color: #707070;">(May be changed depends on bitcoin price and bitcoin network difficulty.)</small>

    </div>
    <p class="rfrcode">Referral Code:</p>
    <input id='referralCode' type="text" placeholder="{{$AppliedCode}}" name="referralCode" style="margin-top:5px" class="aplybtn1text"/>
    <button type="button" onclick="sendCode()" class="btn btn-primary aplybtn"> Apply </button>
    <button id="orderBtn" class="pandel-button" type="submit">Order</button>
    <!-- </form> -->
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
  <!-- The Modal -->
  <div id="myModal" class="modal" style="color: black;">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div>
          <br/>
          <p class="text-center">You have to pay your invoice with bitcoin. If you do not have , you can purchase it from this <a href="https://www.bitpremier.com/buy-bitcoins"> list</a>.</p>
          <br/><br/>
          <form class="dashboard-page" method="post" action="{{route('payment')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
              @if($apply_discount == 1)
              <input type="hidden" name="discount" value="{{$settings->sharing_discount}}">
              @else
                  <input type="hidden" name="discount" value="0">
              @endif
            <input id='hiddenCodeValue' type="hidden" name="code" style="margin-top:5px" value="{{$AppliedCode}}" >
            <input type="range" hidden min="1" max="{{$settings->available_th}}" value="{{$settings->available_th/2}}" name="hash" class="slider" id="hiddenRange">
            <button class="pandel-button" type="submit">Continue</button>
          </form>
      </div>
    </div>
  </div>
    <!-- The Modal First message-->
    <div id="modalFirstTime" class="modal" style="color: black;">
        <!-- Modal content -->
        <div class="modal-content">
            <span id="close" class="close">&times;</span>
            <div class="text-center">
                <br/>
                <h2> Welcome to Hash Bazaar </h2>
                <br/>
                <p>Thanks for your registration. From now on you join our community.</p>
                <p>It means you have the permission to invest in Hash Bazaar by yourself and use your Investment ID as your referral code to invite your friends. More friends, more bonuses. You can find our reward program from your panel.</p>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
        // Get the modal
        var modal = document.getElementById('myModal');
        var modalFirstTime = document.getElementById('modalFirstTime');
        // just first time
        if({!! json_encode(session()->has('pop')) !!}){

            modalFirstTime.style.display = "block";
            {!! json_encode(session()->forget('pop'))!!}
        }else{

        modal.style.display = "none";
        }



        var orderBtn = document.getElementById('orderBtn');
        orderBtn.onclick = function() {
            modal.style.display = "block";
        }
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        var span2 = document.getElementsByClassName("close")[1];

        span2.onclick = function() {
            modalFirstTime.style.display = "none";
        }


        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }


        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            if (event.target == modalFirstTime) {
                modalFirstTime.style.display = "none";
            }
        }
</script>

<style type="text/css">

  .modal-content p {
    font-size: 20px;
  }
  .buy-hashpower-text p{
    margin-bottom: 0px;
  }
  .buy-hashpower-text small{
    font-size: 86%;
  }
  .modal {
  overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  .modal-content {
    width: 80%;
    margin: auto;
    margin-top: 20%;
    padding: 2%;
  } 
  .custom-table th {
    border-top: 0
  }
  .dashboard-page p {
    margin: 0px;padding: 0px;padding-top: 5px; font-size: 18px;line-height: 1.6;
  }
  .dashboard-page small {
    color: #707070;
  }
  .chart-container {
    direction: rtl;
    position: relative;
    margin-top: 5%;
  }

  @media screen and (max-width:415px) {
           .dashboard-page p {
             padding-top: 5px; font-size: 15px;line-height: 1.4;
           }
           .dashboard-page small {
             font-size: 13px;
            }
           .modal-content {
             width: 95%;
             padding: 2%;
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
  @-webkit-keyframes myanimate {
    0% {
      -webkit-text-shadow: 0 0 0px orange;
      text-shadow: 0 0 0px orange;
      box-shadow: 0 0 0px orange;
    }

    50% {
      -webkit-text-shadow: 0 0 4px orange;
      text-shadow: 0 0 4px orange;
      box-shadow: 0 0 4px orange;
      border-right: 2px solid orange;
      border-left: 2px solid orange;
    }

    100% {
      -webkit-text-shadow: 0 0 0px orange;
      text-shadow: 0 0 0px orange;
      box-shadow: 0 0 0px orange;
    }
  }

  @keyframes myanimate {
    0% {
      -webkit-text-shadow: 0 0 0px orange;
                          text-shadow: 0 0 0px orange;
                          box-shadow: 0 0 0px orange;
    }

    50% {
      -webkit-text-shadow: 0 0 3px orange;
                          text-shadow: 0 0 3px orange;
                          box-shadow: 0 0 6px orange;
    }

    100% {
      -webkit-text-shadow: 0 0 0px orange;
                          text-shadow: 0 0 0px orange;
                          box-shadow: 0 0 0px orange;
    }

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
      
                // // ------------ scroll for many data in table  --------------------
                $(document).ready(function(){

                    $('.user-img').click(function(){
                        $('.list1').toggle(500);
                    });
                    
                    var numItems = $('.Hash-History .table tr').length;
                    
                    if( numItems > 3)
                    {
                        $('.Hash-History').css('overflow-y' , "scroll");
                    console.log("numItems > 3");
                    } else {
                        $('.Hash-History').css('overflow-y' , "hidden");
                    console.log("numItems < 3");
                        
                    }
                    
                });
                // for get profit
                var user = {!! json_encode(\Illuminate\Support\Facades\Auth::guard('user')->user()->code) !!}

                function redeem(id) {

                    axios.get('{{route('redeem')}}'+'?user='+user).then(function (response) {

                        console.log(response.data)
                    })
                };
                 // referal code
                var activateDiscount = {!! $apply_discount !!};// $apply_discount == 0 Or 1
                var thPrice = {!! $settings->usd_per_hash !!};
                var thPriceAfterCode ;
                var slider = document.getElementById("myRange");
                var hiddenRange = document.getElementById("hiddenRange");
                hiddenRange.value = slider.value;
                var output = document.getElementById("demo");
                var costAfterCode = document.getElementById("doReferalCode");
                var cost = document.getElementById('cost');
                // for checking referal code
                function sendCode() {

                    var code = document.getElementById('referralCode').value;

                    axios.post('{{route('SendCode')}}',{referralCode:code}).then(function (response) {

                        var resp = response.data;
                        if(resp['type'] == 'error'){
                            alertify.error(resp['body']);
                            $('#doReferalCode').hide()
                        }else{
                            alertify.success(resp['body']);
                            document.getElementById('hiddenCodeValue').value = code;
                            thPriceAfterCode = {!! $settings->usd_per_hash * (1 - $settings->sharing_discount) !!};
                            costAfterCode.innerHTML =   " - "+ (slider.value * (thPrice-thPriceAfterCode ) ) + " dollar" + " = " +(slider.value * thPriceAfterCode) + "dollar" ;
                            console.log(thPrice);
                            activateDiscount = 1;
                            $('#doReferalCode').show()
                        }

                    });
                };

                 output.innerHTML = slider.value+' Th';
                cost.innerHTML = slider.value * thPrice ;
                    if(activateDiscount == 1){
                        $('#doReferalCode').show()
                        thPriceAfterCode = {!! $settings->usd_per_hash * (1 - $settings->sharing_discount) !!};
                        costAfterCode.innerHTML =   " - "+ (slider.value * (thPrice-thPriceAfterCode) ) + " dollar" + " = " +(slider.value * thPriceAfterCode) + "dollar" ;
                    }
                    else
                    $('#doReferalCode').hide()
                    
                    // Display the default slider value
                    
                    slider.oninput = function() {
                        hiddenRange.value = this.value;
                        output.innerHTML = this.value+' Th';
                        if(activateDiscount == 1){
                            thPriceAfterCode = {!! $settings->usd_per_hash * (1 - $settings->sharing_discount) !!};
                            costAfterCode.innerHTML =   " - "+ (slider.value * (thPrice-thPriceAfterCode) ) + " dollar" + " = " +(slider.value * thPriceAfterCode) + "dollar" ;
                        }
                        cost.innerHTML = slider.value  * thPrice;
                        };

                  // for geting total earn

                axios.post({!! json_encode('totalEarn') !!},{'user':user}).then(function (response) {
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