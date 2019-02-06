
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{URL::asset('css/contact-referral-activity-dashboard.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/cssreset.css')}}">
        <title>Hash Bazaar - Dashboard</title>
        <script src="{{URL::asset('js/jquery-3.3.1.js')}}"></script>

        <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="{{URL::asset('js/utils.js')}}"></script>
                    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
                     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    </head>

    <body>
    <?php
    $settings = DB::table('settings')->first();
            foreach ($hashes as $key=> $hash){

                $remainedLife[$key] = floor((\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($hash->created_at)->addYears($hash->life)))/($hash->life * 365) * 100) ;
            }

    ?>
        <!-- Header -->
        <header>

            <a href="http://hashbazaar.com">
                   <div id="header-div"> <img class="Logo_header" src="{{URL::asset('img/Logo_header.svg')}}" alt="Logo_header"> </div>    </a>

                   <div class="useraccount">

                        <img class="user-img" src="{{URL::asset('../img/user-circle-solid.svg')}}" alt="">

                        <div class="list">

                            <ul>

                                <a style="text-decoration: none;color: black" href="{{route('setting')}}"> <li class="user-account-list" id="usericon"> {{Auth::guard('user')->user()->name}}</li></a>
                                <a style="text-decoration: none;color:black" href="{{route('logout')}}"> <li class="user-account-list" id="logouticon"> Log Out </li></a>

                            </ul>
                        </div>

                    </div>
        </header>


        <!-- Dashboard Page -->
        <div id="dashboard-page">
            <!-- Circle -->
            <div id="dashboard-page-circle">
                <span id="circle-span">Total Mining</span>
                <p>&nbsp;<span id="miningBTC"><img src="/img/ajax-loader.gif" height="40" width="40"></span> &nbsp; <span style="color: orange; font-size: 30px">BTC</span> </p>
                <hr style="width: 84%; text-align:center; top: 40%; position: relative;">
                <p><span id="miningDollar"><img src="/img/ajax-loader.gif" height="40" width="40"></span> &nbsp; &nbsp; <span style="color: aqua; font-size: 30px">USD</span></p>

                <button id="redeem" disabled onclick="redeem()"> Redeem ! </button>


            </div>
            <!-- Hash History -->
            <hr class="dashboard-hr1-1">
            <hr class="dashboard-hr1"  style="position: relative;top: 130px;">
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
                                             <div style="width: 180px; margin: 0px auto">
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
                                <p> NO Hash History</p>
                            @endif
                        </div>

             </div>



            <!--   Buy hash power -->
            <hr  class="dashboard-hr11"  style="position: relative;top: 200px;">
            <p id="dashboard-title2">Buy Hash Power</p>
            <hr class="dashboard-hr22-2" style="position: relative;top:190px">

            <h5 id="demo"></h5>
            <div class="slidecontainer">
                @if($settings->available_th > 0)
                <form class="dashboard-page" method="post" action="{{route('payment')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="range" min="1" max="{{$settings->available_th}}" value="{{$settings->available_th/2}}" name="hash" class="slider" id="myRange">
                    <button type="submit"><p>Order</p></button></form>
                    @else
                    <p> TH Noy Available !</p>
                    @endif
            </div>




            <!-- Mining History -->

            <hr class="dashboard-hr111" style="position: relative;top: 420px;">
            <p id="dashboard-title3">Mining History</p>
            <!-- <hr class="dashboard-hr222" style="position: relative;top:560px;"> -->
            <hr class="dashboard-hr222-2" style="position: relative;top:410px">


            <div class="chart1" >
                    <canvas id="chart1"></canvas>
            </div>


            <hr class="dashboard-hr-footer" style="position: relative;left: -10px">
    </div>


        <!-- Footer -->
        <div id="footer-div">

            <div class="dashboard-footer-div">
                    <p class="dashboard-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
                 <img id="dashboard-footer-image" src="img/Logo_footer.svg" alt=""></div>

        </div>


        <!-- Main Container -->
        <div class="mainContainer">


            <nav class="container-dashboard">
                <ul class="mainList">
                    <li class="navbar"> <a href="http://hashbazaar.com"><img class="Logo_In_NavBar" src="img/Logo_In_NavBar.svg" alt="Logo_In_NavBar"></a>
                        <a href="" id="welcome">Welcome User</a> </li>
                    <li class="sub dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
                    <li class="sub"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
                    <li class="sub"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
                    <li class="sub"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
                    <li class="sub"> <a href="{{route('contact')}}" id="contact">Contact</a></li>

                </ul>



            </nav><!-- .container -->

            <nav class="container-dashboard2">
                    <ul class="mainList2">
                        <li class="sub2 dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
                        <li class="sub2"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
                        <li class="sub2"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
                        <li class="sub2"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
                        <li class="sub2"> <a href="{{route('contact')}}" id="contact">Contact</a></li>
                    </ul>



                </nav>


        </div>
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
                var dateFormat = 'YYYY DD MMM';
                // var dateFormat = 'MMMM DD YYYY';
                var date = moment('2019 03 Feb', dateFormat);
                var date2 = moment('2019 04 Feb', dateFormat);
                var dateTime = [];
                var data = [];
                var labels = [];
                

                // data.push({t: date.valueOf(),y: 0.52});
                //         labels.push(date);
                //         data.push({t: date2.valueOf(),y: 2.5});
                //         labels.push(date2);
            axios.get('{{route('chartData').'?user='. Auth::guard('user')->user()->code}}').then(function (response) {
               
                dateTime = response.data;
                console.log("data time");console.log(dateTime);
                console.log("template data");console.log(date.valueOf());
                if(dateTime !== 404){
                    // labels.push(moment('2019 05 Jan', dateFormat));
                    // data.push({t:moment('2019 05 Jan ', dateFormat).valueOf(),y: 0});
                    // labels.push(moment('2019 03 Feb', dateFormat));
                    // data.push({t:moment('2019 03 Feb', dateFormat).valueOf(),y: 0.442335});
                    // labels.push(moment('2019 04 Feb', dateFormat));
                    // data.push({t: moment('2019 04 Feb', dateFormat).valueOf(), y: 2.589362});
                        // data.push({t: date.valueOf(),y: dateTime[0].mined});
                        // labels.push(date);
                        // data.push({t: date2.valueOf(),y: dateTime[1].mined});
                        // labels.push(date2);
                        // var date5 = moment('2019 05 Jan ', dateFormat);
                        // var duration = moment.duration(2, 'days');
                        // console.log("date5");console.log(date5);
                        // console.log(date5.subtract(duration));
                        // console.log(date.add(duration) === moment('2013-06-19', 'YYYY-MM-DD')); // returns false, should be true
                    if(dateTime.length > 0) { 
                     var temp = moment(dateTime[0].time, dateFormat) ;
                     console.log(dateTime.length);console.log(moment().format('YYYY DD MMM'));
                     console.log("time");
                     for(var j=dateTime.length ; j < 31; j++) {
                        // console.log(moment('2019 05 Jan ', dateFormat).subtract(j, "days"));
                        console.log(moment().subtract('days', j).format('YYYY DD MMM'));
                        data.push({t: moment().subtract('days', j).format('YYYY DD MMM').valueOf(),y: 0});
                        labels.push(moment().subtract('days', j).format('YYYY DD MMM')); 
                     }   
                     for(var i=0 ; i < dateTime.length ; i++) {
                        // labels.push(moment('2019 03 Feb', dateFormat));
                        // data.push({t:moment('2019 03 Feb', dateFormat).valueOf(),y: 0.442335 });
                        // data.push({t:moment('2019 03 Feb', dateFormat).valueOf(), y: 27.96930236878253 });
                        // labels.push(moment('2019 04 Feb', dateFormat));
                        // data.push({t:moment('2019 04 Feb', dateFormat).valueOf(),y: 2.589362 });
                        // data.push({t:moment('2019 04 Feb', dateFormat).valueOf(), y: 28.96930236878253 });
                        // labels.push(moment('2019 05 Feb', dateFormat));
                        // data.push({t:moment('2019 05 Feb', dateFormat).valueOf(), y: 30.96930236878253 });
                        // console.log("real date");
                        console.log(moment(dateTime[i].time, dateFormat).format('YYYY DD MMM'));
                        data.push({t:moment(dateTime[i].time, dateFormat).valueOf(),y: dateTime[i].mined});
                        labels.push(moment(dateTime[i].time, dateFormat)); 
                     }
                    }
                }
            // });

//            labels.push(moment('April 01 2017', dateFormat));labels.push(moment('April 03 2017', dateFormat));labels.push(moment('April 04 2017', dateFormat));

//                data.push({t:moment('April 01 2017', dateFormat).valueOf(),y: 22});data.push({t:moment('April 03 2017', dateFormat).valueOf(),y: 28.96930236878253});data.push({t: moment('April 04 2017', dateFormat).valueOf(), y: 29.96930236878253});
                var ctx = document.getElementById('chart1').getContext('2d');
                if(window.screen.availWidth > 1024) {
                    ctx.canvas.parentNode.style.height = '300px';
                    ctx.canvas.parentNode.style.width = '700px';
                } else if(window.screen.availWidth > 726) {
                    ctx.canvas.parentNode.style.height = '200px';
                    ctx.canvas.parentNode.style.width = '600px';
                } else if(window.screen.availWidth > 400) {
                    ctx.canvas.parentNode.style.height = '300px';
                    ctx.canvas.parentNode.style.width = '400px';
                } else if(window.screen.availWidth > 300) {
                    ctx.canvas.parentNode.style.height = '200px';
                    ctx.canvas.parentNode.style.width = '300px';
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
    </body>

    </html>
