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
        <div id="dashboard-page">
            <!-- Circle -->
             <div id="dashboard-page-circle">
                <span id="circle-span">Total Mining</span>
                <p>&nbsp;<span id="miningBTC"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> &nbsp; <span style="color: orange;">BTC</span> </p>
                <hr style="width: 84%; text-align:center;">
                <p><span id="miningDollar"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> &nbsp; &nbsp; <span style="color: aqua;">USD</span></p>

                <button id="redeem" disabled onclick="redeem()"> Redeem ! </button>


            </div>

            <div id="dashboard-page-circle2">
                <span id="circle-span">Daily Mining</span>
                <p>&nbsp;<span id="miningBTC2"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> &nbsp; <span style="color: orange;">BTC</span> </p>
                <hr style="width: 84%; text-align:center;">
                <p><span id="miningDollar2"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> &nbsp; &nbsp; <span style="color: aqua;">USD</span></p>

                <button id="redeem" disabled onclick="redeem()"> Redeem ! </button>


            </div> 
            <!-- Hash History -->
            
            <hr class="dashboard-hr1">
            <p id="dashboard-title">Hash History</p>
            <hr class="dashboard-hr2-2"> 

            <div class="Hash-History">

                <table id="Hash-History-list">
                    @if(!$hashes->isEmpty())

                    <tr>
                        <th class="Hash-History_column"> 
                            Hash Power  
                        </th>

                        <th class="Hash-History_column"> 
                            Started at
                           
                        </th>

                        <th class="Hash-History_column"> 
                            Ends at
                            
                        </th>

                        <th class="Hash-History_column"> 
                            Remain
                            
                        </th>

                    </tr>

                    <tr>

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
                                            <div class="progress-bar1" role="progressbar1" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%">
                                                <span class="title">{{$remainedLife[$key]}}%</span>

                                            </div>
                                        </div>
                                    </div>

                                
                                    @endforeach

                                
                        </td>

                    </tr>
                    
       
                    @else
                        <p id="no-hash"> NO Hash History</p>
                    @endif
                           
       
                </table>

             </div> 
        {{-- <div class="Hash-History_column"> Hash Power
                        <ul>
                            @foreach($hashes as $hash)
                            <li>{{$hash->hash}} TH/S</li>
                             @endforeach 
                        </ul>
                    </div> --}}


                    {{-- <div class="Hash-History_column"> Started at
                        <ul>
                            @foreach($hashes as $hash)
                                <li>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}} </li>
                                @endforeach

                            </ul>
                    </div> --}}

                    {{-- <div class="Hash-History_column"> Ends at
                        <ul>
                             @foreach($hashes as $hash)
                            <li>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}</li>
                            @endforeach

                        </ul>
                    </div> --}}

                    {{-- <div class="Hash-History_column"> Remain
                        <ul>
                            @foreach($hashes as $key => $hash)

                            <li>
                                <div class="remain">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%">
                                            <span class="title">{{$remainedLife[$key]}}%</span>

                                        </div>
                                    </div>
                                </div>

                            </li>

                            @endforeach

                        </ul>
                    </div> --}}


            <!--   Buy hash power -->
            <hr  class="dashboard-hr11">
            <p id="dashboard-title2">Buy Hash Power</p>
            <hr class="dashboard-hr22-2">
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
                       <input id='referralCode' type="text" name="referralCode" style="margin-top:5px" class="aplybtn1text">
      
                          <button type="button" onclick="sendCode()" class="btn btn-primary"> Apply </button>
      
                         {{-- </form> --}}
                    <button class="pandel-button" type="submit">Order</button>
                 </form>
                @else
                  <p> TH Not Available !</p>
                @endif
            </div>


            <!-- Mining History -->
            <hr class="dashboard-hr111" >
            <p id="dashboard-title3">Mining History</p>
            <hr class="dashboard-hr222-2" >


            <div class="chart-container" >
                    <canvas id="chart1"></canvas>
            </div> 


             <hr class="dashboard-hr-footer" style="left: -10px"> 
    </div>

    {{-- Footer --}}
    <div id="footer-div">
            <div class="dashboard-footer-div" >
                <p class="dashboard-footer-paragraph" style="color:black">© 2018 HashBazaar. All rights reserved</p>
                <img id="dashboard-footer-image" src="{{URL::asset('img/Logo_footer.png')}}" alt="">

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

</style>
                <script>



                // ------------user account--------------------
                $(document).ready(function(){

                    $('.user-img').click(function(){
                        $('.list1').toggle(500);
                    });
                    
                    var numItems = $('#Hash-History-list tr').length;



                    if( numItems > 2)
                        $('#Hash-History-list').css('overflow-y' , "scroll");

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
                var activateDiscount = 0;
                var thPrice = {!! $settings->usd_per_hash !!}
                {{--function sendCode() {--}}

                    {{--var code = document.getElementById('referralCode').value;--}}

                    {{--axios.post('{{route('SendCode')}}',{referralCode:code}).then(function (response) {--}}

                        {{--var resp = response.data--}}
                        {{--if(resp['type'] == 'error'){--}}
                            {{--alert(resp['body'])--}}

                        {{--}else{--}}

                            {{--alert(resp['body']);--}}

                            {{--thPrice = {!! $settings->usd_per_hash * (1 - $settings->sharing_discount) !!}--}}
                            {{--activateDiscount = 1;--}}
                        {{--}--}}

                    {{--});--}}
                {{--}--}}

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
                    cost.innerHTML = slider.value * thPrice ;
                    // Display the default slider value
                    
                    slider.oninput = function() {
                            console.log("input change");
                        output.innerHTML = this.value+' Th';
                        cost.innerHTML = slider.value;
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

                if(dateTime !== 404){

                    for(i=0 ; i < dateTime.length ; i++){

                        data.push({t:moment(dateTime[i].time, dateFormat).valueOf(),y: dateTime[i].mined});

                        labels.push(moment(dateTime[i].time, dateFormat));

                    }
                }


//            labels.push(moment('April 01 2017', dateFormat));labels.push(moment('April 03 2017', dateFormat));labels.push(moment('April 04 2017', dateFormat));

//                data.push({t:moment('April 01 2017', dateFormat).valueOf(),y: 22});data.push({t:moment('April 03 2017', dateFormat).valueOf(),y: 28.96930236878253});data.push({t: moment('April 04 2017', dateFormat).valueOf(), y: 29.96930236878253});
                var ctx = document.getElementById('chart1').getContext('2d');
               var chartContainer = document.getElementById('chartContainer');
                console.log(screen.width);
                var screenWidth = screen.width ;
                // if(screenWidth > 1024) {
                //     console.log(" > 1024");
                //     ctx.canvas.parentNode.style.height = '300px';
                //     ctx.canvas.parentNode.style.width = '700px';
                //     // chartContainer.style.width = "700px";
                //     // chartContainer.style.height = "300px";
                // } else if(screenWidth > 767) {
                //     console.log(" > 768");
                //     ctx.canvas.parentNode.style.height = '250px';
                //     ctx.canvas.parentNode.style.width = '650px';
                //     // chartContainer.style.width = "600px";
                //     // chartContainer.style.height = "200px";
                // } else if(screenWidth > 413) {
                //     console.log(" > 414");
                //     ctx.canvas.parentNode.style.height = '300px';
                //     ctx.canvas.parentNode.style.width = '300px';
                //     // chartContainer.style.width = "300px";
                //     // chartContainer.style.height = "300px";
                // } else if(screenWidth > 300) {
                //     console.log(" > 320");
                //     ctx.canvas.parentNode.style.height = '200px';
                //     ctx.canvas.parentNode.style.width = '280px';
                //     // chartContainer.style.width = "280px";
                //     // chartContainer.style.height = "200px";
                // } else {
                //     console.log("else");
                //     ctx.canvas.parentNode.style.height = '300px';
                //     ctx.canvas.parentNode.style.width = '700px';
                //     // chartContainer.style.width = "700px";
                //     // chartContainer.style.height = "300px";
                // }

                var color = Chart.helpers.color;
                var cfg = {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Your revenue',
                            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                            borderColor: window.chartColors.red,
                            data: data,
                            type: 'line',
                            pointRadius: 0,
                            fill: false,
                            lineTension: 0,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                type: 'time',
                                distribution: 'series',
                                ticks: {
                                    source: 'labels'
                                }
                            }],
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'USD ($)'
                                }
                            }]
                        }
                    }
                };
                var chart = new Chart(ctx, cfg);


            });

                    </script>
@endsection