@extends('panel.master.layout')
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
                <hr style="width: 84%; text-align:center; margin-top: 02%; ">
                <p><span id="miningDollar"><img src="{{URL::asset('/img/ajax-loader.gif')}}" height="40" width="40"></span> &nbsp; &nbsp; <span style="color: aqua;">USD</span></p>

                <button id="redeem" disabled onclick="redeem()"> Redeem ! </button>


            </div>
            <!-- Hash History -->
            <hr class="dashboard-hr1">
            <p id="dashboard-title">Hash History</p>
            <hr class="dashboard-hr2-2">

           <div class="Hash-History">

                        <div id="Hash-History-list">
                            @if(!$hashes->isEmpty())
                            <div id="Hash-History_column"> Hash Power
                                <ul>
                                   @foreach($hashes as $hash)
                                    <li>{{$hash->hash}} TH/S</li>
                                    @endforeach
                                </ul>
                            </div>


                            <div id="Hash-History_column"> Started at
                                    <ul>
                                        @foreach($hashes as $hash)
                                            <li>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}} </li>
                                        @endforeach

                                    </ul>
                            </div>

                            <div id="Hash-History_column"> Ends at
                                    <ul>
                                        @foreach($hashes as $hash)
                                            <li>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}</li>
                                        @endforeach

                                    </ul>
                             </div>

                            <div id="Hash-History_column"> Remain
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
                             </div>
                            @else
                                <p id="no-hash"> NO Hash History</p>
                            @endif
                        </div>

             </div>



            <!--   Buy hash power -->
            <hr  class="dashboard-hr11">
            <p id="dashboard-title2">Buy Hash Power</p>
            <hr class="dashboard-hr22-2">

            <h5 id="demo"></h5>
            <div class="slidecontainer">
                @if($settings->available_th > 0)
                <form class="dashboard-page" method="post" action="{{route('payment')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="range" min="1" max="{{$settings->available_th}}" value="{{$settings->available_th/2}}" name="hash" class="slider" id="myRange">
                    <button type="submit"><p>Order</p></button></form>
                    @else
                    <p> TH Not Available !</p>
                    @endif
            </div>




            <!-- Mining History -->

            <hr class="dashboard-hr111" >
            <p id="dashboard-title3">Mining History</p>
            <hr class="dashboard-hr222-2" >

{{-- 
            <div class="chart1" >
                    <canvas id="chart1"></canvas>
            </div> --}}


            <hr class="dashboard-hr-footer" style="left: -10px">
    </div>

    {{-- Footer --}}
    <div id="footer-div">
            <div class="dashboard-footer-div" >
            <p class="dashboard-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
            <img id="dashboard-footer-image" src="{{URL::asset('img/Logo_footer.svg')}}" alt="">

        </div>
    </div>
    <!-- Container -->
    <div class="mainContainer">

{{-- 
        <nav class="container">

            <ul class="mainList">

                <li class="navbar"> <a href="http://hashbazaar.com"><img class="Logo_In_NavBar" src="{{URL::asset('img/Logo_In_NavBar.svg')}}" alt="Logo_In_NavBar"></a>
                    <a href="" id="welcome">Welcome User</a> </li>
                <li class="sub dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
                <li class="sub"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
                <li class="sub"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
                <li class="sub"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
                <li class="sub"> <a href="{{route('contact')}}" id="contact">Contact</a></li>

            </ul>

        </nav> --}}




    </div>


    

        <!-- Main Container -->

        <style type="text/css">
.progress {    border: 1px solid;}
.progress-bar {
    background-color: #ff9100;
    text-align: center;
    color: white;
  width: 0;
  -webkit-animation: progress 1.5s ease-in-out forwards;
          animation: progress 1.5s ease-in-out forwards;
}
.progress-bar .title {
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
                        $('.list').toggle(500);
                    });


                });

                var user = {!! json_encode(\Illuminate\Support\Facades\Auth::guard('user')->user()->code) !!}

                function redeem(id) {

                    axios.get('{{route('redeem')}}'+'?user='+user).then(function (response) {

                        console.log(response.data)
                    })
                }


                 // =---------------------------------------

                axios.post({!! json_encode('totalEarn') !!},{'user':user}).then(function (response) {
//                     console.log(id);
//                     console.log(response.data);
                    // console.log("response.data");
                    if(response.data[0] == 0){

                        document.getElementById('miningBTC').innerHTML = 0;
                        document.getElementById('miningDollar').innerHTML = 0;
                    }else{


                        document.getElementById('miningBTC').innerHTML = response.data[0].toFixed(8);
                        document.getElementById('miningDollar').innerHTML = response.data[1].toFixed(8);
                        var minimum_redeem = {!! json_encode($settings->minimum_redeem) !!}
                        if(response.data[0] >= minimum_redeem){
                            document.getElementById('redeem').disabled = false;
                        }
                        // console.log(response.data);
                    }

                });
                    var slider = document.getElementById("myRange");
                    var output = document.getElementById("demo");
                    output.innerHTML = slider.value+' Th';
                    // Display the default slider value
                    // var cost = document.getElementById("cost");

                    slider.oninput = function() {
                            console.log("input change");
                        output.innerHTML = this.value+' Th';
                        // cost.innerHTML = slider.value * 50 ;
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
                if(window.screen.availWidth > 1024) {
                    ctx.canvas.parentNode.style.height = '300px';
                    ctx.canvas.parentNode.style.width = '700px';
                } else if(window.screen.availWidth < 768) {
                    ctx.canvas.parentNode.style.height = '200px';
                    ctx.canvas.parentNode.style.width = '600px';
                } else if(window.screen.availWidth < 414) {
                    ctx.canvas.parentNode.style.height = '300px';
                    ctx.canvas.parentNode.style.width = '300px';
                } else if(window.screen.availWidth < 320) {
                    ctx.canvas.parentNode.style.height = '200px';
                    ctx.canvas.parentNode.style.width = '280px';
                } else {
                    ctx.canvas.parentNode.style.height = '300px';
                    ctx.canvas.parentNode.style.width = '700px';
                }


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