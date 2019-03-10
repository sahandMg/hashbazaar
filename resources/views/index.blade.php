@extends('master.layout')
@section('content')

    <!-- class="masthead pb-3" -->
    <?php
    $settings = DB::table('settings')->first();
          if(isset($code)){
              $user = DB::table('users')->where('code',$code)->first();
              $referralCode = DB::table('expired_codes')->where('code',$code)->first();

              if(!is_null($user) && is_null($referralCode)){
                  $name = $user->name;
              }
          }

    ?>
    <header id="header" >
       

        <div class="intro-body headerTheme">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-10 col-sm-11 mx-auto">
                        <h1 class="text-center">Bitcoin Investment</h1><img src="img/LOGO.svg">
                        <h3>JOIN OUR MINING FARMS</h3>
                        <h3 style="margin: 0px;">FILL YOUR POCKETS WITH BITCOIN</h3>
                        <a class="btn btn-link btn-circle js-scroll-trigger responsive-circle"
                           style="border-color: red;color: red" role="button"
                           href="#sharePlan"><i
                                    class="fa fa-angle-down animated"></i></a></div>
                </div>
            </div>
        </div>
    </header>
    <section  id="sharePlan" class="text-center" style="padding-top: 4%;color: #707070;">
        <div>
            <h3 class="fontTheme">choose your investment planS</h3>
        </div>
        <div class="container">
          <form action="{{route('signup')}}" method="get">
            <h5 id="demo"></h5>
            <div class="slidecontainer">
                <input name="hashPower" type="range" min="1" max="{{$settings->available_th}}" value="{{$settings->available_th/2}}" class="slider" id="myRange">
            </div>
            <div style="text-align: left;font-weight: 700;">
                <p>Hash allocation cost : <span id="cost"></span> dollar</p>
                <p>Maitanace fee: {{$settings->maintenance_fee_per_th_per_day}} dollar per Th/day</p>
                <small>(include all electricity, cooling, development, and servicing costs )</small>
                <p>Income : At this time We predict {{$settings->bitcoin_income_per_month_per_th}} BTC/month for every Th.</p>
                <small>(Changes may happen depends on bitcoin price and bitcoin network difficulty changes.)</small>
            </div>
            <div class="form-group fontTheme" style="margin-top: 2%;">
                <button class="btn  btn-primary round-button-com" type="submit" style="width: 120px">Buy</button>
            </div>
           </form>
        </div>
    </section>
    <section class="context-section backgroundGrey text-center pt-4 pb-4 advantages" style="color: #707070">
        <h2>Our Advantages</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h3 class="text-center"  style="color: #707070;">Working in the regions in which energy cost is in the lowest level</h3>
                    <img id="price" src="img/Pricing.svg">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 advantages-detail">
                    <h3>Other advantages:</h3>
                    <ul>
                        <li>
                            <h5>Instant mining</h5>
                            <p>Start mining immediately after confirming payment without any concerns and challenges.</p>
                        </li>
                        <li>
                            <h5>Daily withdrawal</h5>
                            <p>Withdraw your daily mining profit at 00:00 every day.</p>
                        </li>
                        <li>
                            <h5>Activity report</h5>
                            <p>Keep track of your transaction from your panel.</p>
                        </li>
                        <li>
                            <h5>Statistical details</h5>
                            <p>Track your real time mining output at any point from any location.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="text-center backgroundGrey">
        <div class="" style="background: white;padding-bottom:1px">
            <div class="col-lg-8 mx-auto">
                <h2 class="fontTheme m-3">Let us know your questions</h2>
            </div>
        </div>
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form method="POST" action="{{route('message')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group fontTheme"><input class="form-control" type="text" name="name"
                                                                 placeholder="name" id="nameTextBox"></div>
                        <div class="form-group fontTheme"><input class="form-control" type="email" name="email"
                                                                 placeholder="email" id="emailTextBox"></div>
                        <div class="form-group fontTheme"><textarea class="form-control mx-auto" name="message"
                                                                    placeholder="Message" id="messageTextBox"
                                                                    rows="5"></textarea></div>
                        <div class="form-group fontTheme">
                            <button class="btn  btn-primary round-button-com" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </section>
   @include('master.footer')
    <!-- The Modal -->
    <div id="myModal" class="modal" style="color: black;">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div>
                <h2 class="text-center">Welcome to Hashbazaar</h2>
                <br/>
                <h4 class="text-center">We help you to invest in bitcoin mining.</h4>
                <br/>
                <p class="text-center">You are invited by <b> {{isset($name)?$name:'noBody'}}</b> so you can utilize 10% discount for your first order.</p>
                <p class="text-center">Nice to have you in our cryptocurrency investment community.</p>
            </div>
        </div>

    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="{{asset('js/Bazar.js')}}"></script>
    <style type="text/css">
        p {
            margin: 0px;padding: 0px;padding-top: 5px;
        }
    </style>
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <script type="text/javascript">
        console.log("js run");
        var sliderValue = {!! \App\Setting::first()->usd_per_hash !!}
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value+' Th'; // Display the default slider value
        var cost = document.getElementById("cost"); cost.innerHTML = slider.value * sliderValue ;
        var hashInput = document.getElementById("hash");
        console.log("slider");console.log(slider.value);
        // hashInput.value = slider.value;
        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
            console.log("input change");
            output.innerHTML = this.value+' Th';
            cost.innerHTML = slider.value * sliderValue ;


        }

        // Get the modal
        var modal = document.getElementById('myModal');

        // blade if for detecting link

        if({!! json_encode(isset($name)) !!}){

            modal.style.display = "block";
        }

        // Get the button that opens the modal
        // var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        // btn.onclick = function() {
            // modal.style.display = "block";
            // window.location.href='http://hashbazaar.com/signup';
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        // document.getElementById("registerButton").addEventListener("click", registerButtonFunction);
        // function registerButtonFunction() {
        //   console.log("registerButton");
        //   document.getElementById("registerButton").disabled = true;
        // }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131063343-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-131063343-1');
    </script>
    <script>
        $(document).ready(function(){
            $('.navigation-menu').click(function(){
                $('#header-navbar-menu').toggle();
                $('.login').show();
                $('.signup').show();
                $('.navigation-menu').toggleClass('change');
            })
        });
    </script>


@endsection