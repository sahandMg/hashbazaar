
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/contact-referral-activity-dashboard.css">
        <link rel="stylesheet" href="css/cssreset.css">
        <title>Hash Bazaar - Dashboard</title>
        <script src="../../../public/js/jquery-3.3.1.js"></script>

         <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="js/utils.js"></script>
    </head>

    <body>
        <!-- Header -->
        <header>


            <a href="http://hashbazaar.com">
                   <div id="header-div"> <img class="Logo_header" src="img/Logo_header.svg" alt="Logo_header"> </div>    </a>
                  
                   <div class="useraccount">

                        <img class="user-img" src="../img/user-circle-solid.svg" alt="">
            
                        <div class="list">

                            <ul>

                                <li class="user-account-list" id="usericon">User Account</li>
                                <li class="user-account-list" id="logouticon">Log Out</li>
            
                            </ul>
                        </div>

                    </div>
        </header>


        <!-- Dashboard Page -->
        <div id="dashboard-page">
            <!-- Circle -->
            <div id="dashboard-page-circle">
                <span id="circle-span">Total Mining</span>
                <p id="mining">&nbsp;0 &nbsp; <span style="color: orange; font-size: 30px">BTC</span> </p>
                <hr style="width: 84%; text-align:center; top: 40%; position: relative;">
                <p>36000.321 &nbsp; &nbsp; <span style="color: aqua; font-size: 30px">USD</span></p>

            </div>
            <!-- Hash History -->
            <hr class="dashboard-hr1-1">
            <hr class="dashboard-hr1"  style="position: relative;top: 130px;">
            <p id="dashboard-title">Hash History</p>
            <hr class="dashboard-hr2-2">

           <div class="Hash-History">
                <div id="Hash-History-list">
                    <div id="Hash-History_column"> Hash Power
                        <ul>
                            <li>14 TH/S</li>
                            <li>5 TH/S</li>

                        </ul>
                    </div>

                    <div id="Hash-History_column"> Started at
                            <ul>
                                <li>12 Sep 2018</li>
                                <li>12 Sep 2038</li>

                            </ul>
                    </div>

                    <div id="Hash-History_column"> Ends at
                            <ul>
                                <li>12 Sep 2020</li>
                                <li>12 Sep 2040</li>

                            </ul>
                     </div>

                    <div id="Hash-History_column"> Remain
                             <ul class="remain">
                                <li style="top: 25px"><div>80%</div></li>
                                <li style="top: 15px"><div>40%</div></li>
                            </ul>
                     </div>
                </div>
             </div>



            <!--   Buy hash power -->
            <hr  class="dashboard-hr11"  style="position: relative;top: 200px;">
            <p id="dashboard-title2">Buy Hash Power</p>
            <hr class="dashboard-hr22-2" style="position: relative;top:190px">

            <h5 id="demo"></h5>
            <div class="slidecontainer">
                <form class="dashboard-page" method="post" action="{{route('payment')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="range" min="1" max="100" value="50" name="hash" class="slider" id="myRange">
                    <button type="submit"><p>Order</p></button></form>
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
                <script>

                    
                // ------------user account--------------------
                $(document).ready(function(){
            
                    $('.user-img').click(function(){
                        $('.list').toggle(500);
                    })
                })
                
                // --------------------------------------------
                
                axios.get({!! json_encode('totalEarn') !!}).then(function (response) {
                    console.log("totalEarn");
                    console.log(document.getElementById('mining').innerHTML);
                    document.getElementById('mining').InnerHTML = response.data;
                    console.log(response.data);
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
                        }

                    //    ==================================chart==============
                    var dateFormat = 'MMMM DD YYYY';
            var date = moment('April 01 2017', dateFormat);
            var data = [];
            var labels = [];labels.push(moment('April 01 2017', dateFormat));labels.push(moment('April 03 2017', dateFormat));labels.push(moment('April 04 2017', dateFormat));
            data.push({t:moment('April 01 2017', dateFormat).valueOf(),y: 27.96930236878253});data.push({t:moment('April 03 2017', dateFormat).valueOf(),y: 28.96930236878253});data.push({t: moment('April 04 2017', dateFormat).valueOf(), y: 29.96930236878253});
            var ctx = document.getElementById('chart1').getContext('2d');
            ctx.canvas.parentNode.style.height = '300px';
            ctx.canvas.parentNode.style.width = '700px';

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
                    </script>
    </body>

    </html>
