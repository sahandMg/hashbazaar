@extends('master.layout')
@section('content')

    <!-- class="masthead pb-3" -->
    <?php
    $settings = DB::table('settings')->first();
          if(isset($code)){
              $user = DB::table('users')->where('code',$code)->first();
              if(!is_null($user)){
                  $name = $user->name;
              }
          }

    ?>
    <header id="header" >
       

        <div class="intro-body headerTheme">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-10 col-sm-11 mx-auto">
                        <h1 class="text-center">{{__('BITCOIN INVESTMENT')}}</h1><img src="img/LOGO.svg">
                        <h3>{{__('JOIN OUR MINING FARMS')}}</h3>
                        <br>
                        <h3 style="margin: 0px;">{{__('FILL YOUR POCKETS WITH BITCOIN')}}</h3>
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
            <h3 class="fontTheme">{{__('CHOOSE YOUR INVESTMENT PLAN')}}</h3>
        </div>
        <div class="container">
          <form action="{{route('signup')}}" method="get">
            <h5 id="demo"></h5>
            <div class="slidecontainer">
                <input name="hashPower" type="range" min="1" max="{{$settings->available_th}}" value="{{$settings->available_th/2}}" class="slider" id="myRange">
            </div>
            <div class="invest-plan" style="font-weight: 700;">
                <p>{{__("Hash allocation cost :")}} <span id="cost"></span> {{__("dollar")}} </p>
                <p>{{__('Maintenance fee')}}: {{$settings->maintenance_fee_per_th_per_day}} {{__('dollar per Th/day')}}</p>
                <small>{{__("(include all electricity, cooling, development, and servicing costs )")}}</small>
                <p>{{__('Income : At this time We predict')}} {{$settings->bitcoin_income_per_month_per_th}} {{__('BTC/month per Th')}}</p>
                <small>{{__("(May be changed depends on bitcoin price and bitcoin network difficulty)")}}</small>
            </div>
            <div class="form-group fontTheme" style="margin-top: 2%;">
                <button class="btn btn-primary round-button-com" onclick="btnDisable()" type="submit" style="width: 120px">{{__('BUY')}}</button>
            </div>
           </form>
        </div>
    </section>
  @if(Config::get('app.locale') == 'fa')
  <section class="context-section backgroundGrey text-center pt-4 pb-4 advantages" style="color: #707070"  >
  </section>
  @else
    <section class="context-section backgroundGrey text-center pt-4 pb-4 advantages" style="color: #707070"  >
        <h2>Our Advantages</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h3 class="text-center"  style="color: #707070;">Working in the regions in which energy cost is low</h3>
                    <img id="price" alt="electricity price" src="img/Pricing.jpg" style="width: 100%;height: auto;">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 advantages-detail">
                    <h3>{{__('OTHER ADVANTAGES: ')}}</h3>
                    <ul>
                    
                        <li>
                            <h5>{{__("INSTANT MINING")}}</h5>
                            <p>{{__('Start mining immediately after confirming payment without any concerns and challenges.')}}</p>
                        </li>
                        <li>
                            <h5>{{__('DAILY WITHDRAWAL')}}</h5>
                            <p>{{__("Your mining output will be withdrawn as soon as increasing to 0.01 BTC.")}}</p>
                        </li>
                        <li>
                            <h5>{{__("ACTIVITY REPORT")}}</h5>
                            <p>{{__("Keep track of your transaction from your panel.")}}</p>
                        </li>
                        <li>
                            <h5>{{(__('STATISTICAL DETAILS'))}}</h5>
                            <p>{{__("Track your real time mining output at any point from any location.")}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
  @endif  
    <section id="contact" class="text-center backgroundGrey" >
        <div class="" style="background: white;padding-bottom:1px">
            <div class="col-lg-8 mx-auto">
                <h2 class="fontTheme m-3">{{__('LET US KNOW YOUR QUESTIONS')}}</h2>
            </div>
        </div>
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form class="contact-form" method="POST" action="{{route('message')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group fontTheme"><input class="form-control" type="text" name="name"
                                                                 placeholder="{{__('name')}}" id="nameTextBox"></div>
                        <div class="form-group fontTheme"><input class="form-control" type="email" name="email"
                                                                 placeholder="{{__('email')}}" id="emailTextBox"></div>
                        <div class="form-group fontTheme"><textarea class="form-control mx-auto" name="message"
                                                                    placeholder="{{__('Message')}}" id="messageTextBox"
                                                                    rows="5"></textarea></div>
                        <div class="form-group fontTheme">
                            <button class="btn btn-primary round-button-com" type="submit">{{__('SUBMIT')}}</button>
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
                <p class="text-center">You are invited by <b> {{isset($name)?$name:'noBody'}}</b> so you can utilize {{$settings->sharing_discount * 100}}% discount for your first order.</p>
                <p class="text-center">Nice to have you in our cryptocurrency investment community.</p>
            </div>
        </div>

    </div>
    @if(Config::get('app.locale') == 'fa')
    <style type="text/css">
      .invest-plan {
         text-align: right;
      }
      .contact-form {direction: rtl;}

      
    </style>
    @else
    <style type="text/css">
      .invest-plan {
         text-align: left;
      }
    </style>
    @endif
    <style type="text/css">
        .advantages h2 {margin-bottom: 3%;}
        .advantages-detail h5 {margin-top: 3%;font-size: 1.1rem;}
       /* .advantages-detail {
            margin-top: 3%;
        }*/
         .pace {
  -webkit-pointer-events: none;
  pointer-events: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.pace-inactive {
  display: none;
}

.pace .pace-progress {
  background: #29d;
  position: fixed;
  z-index: 2000;
  top: 0;
  right: 100%;
  width: 100%;
  height: 2px;
}

.pace .pace-progress-inner {
  display: block;
  position: absolute;
  right: 0px;
  width: 100px;
  height: 100%;
  box-shadow: 0 0 10px #29d, 0 0 5px #29d;
  opacity: 1.0;
  -webkit-transform: rotate(3deg) translate(0px, -4px);
  -moz-transform: rotate(3deg) translate(0px, -4px);
  -ms-transform: rotate(3deg) translate(0px, -4px);
  -o-transform: rotate(3deg) translate(0px, -4px);
  transform: rotate(3deg) translate(0px, -4px);
}

.pace .pace-activity {
  display: block;
  position: fixed;
  z-index: 2000;
  top: 15px;
  right: 15px;
  width: 14px;
  height: 14px;
  border: solid 2px transparent;
  border-top-color: #29d;
  border-left-color: #29d;
  border-radius: 10px;
  -webkit-animation: pace-spinner 400ms linear infinite;
  -moz-animation: pace-spinner 400ms linear infinite;
  -ms-animation: pace-spinner 400ms linear infinite;
  -o-animation: pace-spinner 400ms linear infinite;
  animation: pace-spinner 400ms linear infinite;
}

@-webkit-keyframes pace-spinner {
  0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}
@-moz-keyframes pace-spinner {
  0% { -moz-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -moz-transform: rotate(360deg); transform: rotate(360deg); }
}
@-o-keyframes pace-spinner {
  0% { -o-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -o-transform: rotate(360deg); transform: rotate(360deg); }
}
@-ms-keyframes pace-spinner {
  0% { -ms-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -ms-transform: rotate(360deg); transform: rotate(360deg); }
}
@keyframes pace-spinner {
  0% { transform: rotate(0deg); transform: rotate(0deg); }
  100% { transform: rotate(360deg); transform: rotate(360deg); }
}

    </style>
    <!-- <script data-pace-options='{ "ajax": false }' src="{{asset('js/pace.js')}}"></script> -->
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


        function btnDisable(){
            console.log("btnDisable");
        }



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
            // pace options
            // Pace.options = {
            //  ajax: false
            // }
            // Pace.start();

            $('.navigation-menu').click(function(){
                $('#header-navbar-menu').toggle();
                $('.login').show();
                $('.signup').show();
                $('.navigation-menu').toggleClass('change');
            })
        });
    </script>


@endsection