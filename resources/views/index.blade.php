﻿@extends('master.layout')
@section('content')

    <!-- class="masthead pb-3" -->
    <?php
    $settings = DB::table('settings')->first();
    ?>
    <header id="header" >
        {{-- navbar  ../../public/img/Logo_header.svg.svg.svg   --}}
        {{--<div class="header-navbar">--}}
            {{--<div id="header-navbar-logo">--}}
                {{--<ul>--}}
                    {{--<li class="navbar-list big"><a href="http://hashbazaar.com"><img class="navbar-small-logo" src="{{asset('img/Logo_header.svg')}}" alt="Logo"></a>--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--<div id="header-navbar-menu">--}}
                {{--<ul>--}}
                    {{--<li class="navbar-list small"><a href="#">Home</a></li>--}}
                    {{--<li class="navbar-list small"><a href="#">About</a></li>--}}
                    {{--<li class="navbar-list small"><a href="{{route('customerService')}}"> FAQ</a></li>--}}
                    {{--<li class="navbar-list small"><a href="{{route('blog')}}">Blog</a></li>--}}
                    {{--@if(Auth::guard('user')->check())--}}
                        {{--<li class="navbar-list small signup"><a href="{{route('dashboard')}}" >Dashboard</a></li>--}}
                    {{--@else--}}
                        {{--<li class="navbar-list small signup"><a href="{{route('signup')}}" >Sign Up</a></li>--}}
                        {{--<li class="navbar-list small login"><a href="{{route('login')}}" >Log In</a></li>--}}
                    {{--@endif--}}
                {{--</ul>--}}

            {{--</div>--}}


            {{--<div class="navigation-menu">--}}
                {{--<div class="bar1"></div>--}}
                {{--<div class="bar2"></div>--}}
                {{--<div class="bar3"></div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--  --}}
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
            <h5 id="demo"></h5>
            <div class="slidecontainer">
                <input type="range" min="1" max="{{$settings->available_th}}" value="{{$settings->available_th/2}}" class="slider" id="myRange">
            </div>
            <div style="text-align: left;font-weight: 700;">
                <p>Hash allocation cost : <span id="cost"></span> dollar</p>
                <p>Maitanace fee: {{$settings->maintenance_fee_per_th_per_day}} dollar per Th/day</p>
                <small>(include all electricity, cooling, development, and servicing costs )</small>
                <p>Income : At this time We predict {{$settings->bitcoin_income_per_month_per_th}} BTC/month for every Th.</p>
                <small>(Changes may happen depends on bitcoin price and bitcoin network difficulty changes.)</small>
            </div>
            <div class="form-group fontTheme" style="margin-top: 2%;">
                <button id="myBtn" class="btn  btn-primary round-button-com" type="button" style="width: 120px">Buy</button>
            </div>
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
        <div class="row" style="background: white">
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
                <h2 class="text-center">You must register first </h2>
                <div class="form">
                    <form method="post" action="{{route('subscribe')}}" class="register-form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="text"  hidden name="hash" id="hash"/>
                        @if($errors->all())
                            @foreach($errors->all() as $error)
                                <span style="color: #ae5856;">{{$error}}</span><br>
                            @endforeach
                        @endif

                        <input type="text" name="name" placeholder="name"/>
                        <input type="text" name="email" placeholder="email address"/>
                        <!-- <span style="color: #ae5856;">error</span> -->
                        <input type="password" name="password" placeholder="password"/>
                        <!-- <span style="color: #ae5856;">error</span> -->
                        <input type="password" name='confirm_password' placeholder="type password again"/>
                        <button type="submit" id="registerButton">register</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- -------------- --}}


    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="js/Bazar.js"></script>
    <style type="text/css">
        p {
            margin: 0px;padding: 0px;padding-top: 5px;
        }
    </style>
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <script type="text/javascript">
        console.log("js run");
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value+' Th'; // Display the default slider value
        var cost = document.getElementById("cost"); cost.innerHTML = slider.value * 50 ;
        var hashInput = document.getElementById("hash");
        hashInput.value = slider.value;
        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
            console.log("input change");
            output.innerHTML = this.value+' Th';
            cost.innerHTML = slider.value * 50 ;
            hashInput.value = slider.value;
        }

        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
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