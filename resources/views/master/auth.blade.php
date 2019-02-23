<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="img/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!--===============================================================================================-->

    <link rel="icon" href="img/TabLogo.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.animate-colors.js"></script>

</head>
<body>
<header id="header" >
    {{-- navbar  ../../public/img/Logo_header.svg.svg.svg   --}}
    <div class="header-navbar">
        <div id="header-navbar-logo">
            <ul>
                <li class="navbar-list big"><img class="navbar-small-logo" src="{{asset('img/Logo_header.svg')}}" alt="Logo">
            </ul>
        </div>
        <div id="header-navbar-menu">
            <ul>
                <li class="navbar-list small"><a href="{{route('index')}}">Home</a></li>
                <li class="navbar-list small"><a href="#">About</a></li>
                <li class="navbar-list small"><a href="{{route('customerService')}}">FAQ</a></li>
                <li class="navbar-list small"><a href="{{route('blog')}}">Blog</a></li>
                @if(Auth::guard('user')->check())
                    <li class="navbar-list small signup"><a href="{{route('dashboard')}}" >Dashboard</a></li>
                @else
                    <li class="navbar-list small signup"><a href="{{route('signup')}}" >Sign Up</a></li>
                    <li class="navbar-list small login"><a href="{{route('login')}}" >Log In</a></li>
                @endif
            </ul>

        </div>


        <div class="navigation-menu">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </div>


    {{--  --}}

</header>
@yield('content')




</body>
</html>