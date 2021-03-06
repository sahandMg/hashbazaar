<!DOCTYPE html>
<html lang="en">
<head>

    @yield('title')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <!-- <link rel="icon" type="image/png" href="img/icons/favicon.ico"/> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"> -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!--===============================================================================================-->

    <!-- <link rel="icon" href="img/TabLogo.png"> -->
    <link rel="stylesheet" href="../../../public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
    <link rel="stylesheet" href="css/theme.css">
    <!-- <link rel="icon" href="img/favicon.ico" type="image/x-icon"/> -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.animate-colors.js"></script>

</head>
<body style="background-color: white;">
{{--<header id="header" >--}}
    {{-- navbar  ../../public/img/Logo_header.svg.svg.svg   --}}
    {{--<div class="header-navbar">--}}
        {{--<div id="header-navbar-logo">--}}
            {{--<ul>--}}
                {{--<li class="navbar-list big"><a href="http://hashbazaar.com"><img class="navbar-small-logo" src="{{asset('img/Logo_header.svg')}}" alt="Logo"></a>--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--<div id="header-navbar-menu">--}}
            {{--<ul>--}}
                {{--<li class="navbar-list small1"><a href="{{route('index')}}">Home</a></li>--}}
                {{--<li class="navbar-list small1"><a href="#">About</a></li>--}}
                {{--<li class="navbar-list small1"><a href="{{route('customerService')}}">FAQ</a></li>--}}
                {{--<li class="navbar-list small1 a1"><a href="{{route('affiliate')}}">Affiliate</a></li>--}}
                {{--<li class="navbar-list small1"><a href="http://blog.hashbazaar.com/">Blog</a></li>--}}
                {{--@if(Auth::guard('user')->check())--}}
                    {{--<li class="navbar-list small1 signup"><a href="{{route('dashboard')}}" >Dashboard</a></li>--}}
                {{--@else--}}
                    {{--<li class="navbar-list small1 signup"><a href="{{route('signup')}}" >Sign Up</a></li>--}}
                    {{--<li class="navbar-list small1 login"><a href="{{route('login')}}" >Log In</a></li>--}}
                   {{----}}
                {{--@endif--}}
            {{--</ul>--}}

        {{--</div>--}}


        {{--<div class="navigation-menu">--}}
            {{--<div class="bar1"></div>--}}
            {{--<div class="bar2"></div>--}}
            {{--<div class="bar3"></div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="http://hashbazaar.com">
            <img class="navbar-small-logo" src="{{asset('img/Logo_header.svg')}}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('customerService')}}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://blog.hashbazaar.com/">Blog</a>
                </li>
                @if(Auth::guard('user')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('signup')}}">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Log In</a>
                    </li>

                @endif

            </ul>
        </div>
    </nav>

    {{--  --}}

{{--</header>--}}
@yield('content')

<script type="text/javascript">
          window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";
        (function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";
            s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();

            $(document).ready(function(){
            $('.navigation-menu').click(function(){
                $('#header-navbar-menu').toggle();
                $('.login').show();
                $('.signup').show();
                $('.navigation-menu').toggleClass('change');
            })
        });
     </script>


</body>
</html>