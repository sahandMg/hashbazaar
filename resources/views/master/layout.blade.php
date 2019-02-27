
<!DOCTYPE html>
<html style="font-size: 100%">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="keywords"
          content="Bitcoin mining, scrypt mining, cloud mining, hosted mining"/>
    <meta name="description"
          content="Bitcoin is the digital gold of the future & HashBazaar is the most cost effective cloud mining company on the market. Mine bitcoin through the cloud, get started today!"/>
    <meta name="google-site-verification" content="roNqWp-CmbNsSN2R6ggCv2ubJwFNikEs_WJ7E2P3WDw" />
    @if(request()->path() === '/')
        <title>Hash Bazaar</title>
    @else
        @yield('title')
    @endif
    <link rel="icon" href="img/TabLogo.png">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/customer-service.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.animate-colors.js"></script>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.animate-colors.js"></script>
    <script src="../../../public/js/jquery-3.3.1.js"></script>

</head>

<body id="page-top" style="background: white" >
<!-- class="masthead pb-3" -->
<header id="header" >
    {{-- navbar  ../../public/img/Logo_header.svg.svg.svg   --}}
    <div class="header-navbar">
        <div id="header-navbar-logo">
            <ul>
                <li class="navbar-list big"><a href="http://hashbazaar.com"><img class="navbar-small-logo" src="{{asset('img/Logo_header.svg')}}" alt="Logo"></a>
            </ul>
        </div>
        <div id="header-navbar-menu">
            <ul>
                <li class="navbar-list small a"><a href="{{route('index')}}">Home</a></li>
                <li class="navbar-list small a"><a href="#">About</a></li>
                <li class="navbar-list small a"><a href="{{route('customerService')}}">FAQ</a></li>
                <li class="navbar-list small a"><a href="http://blog.hashbazaar.com">Blog</a></li>
                @if(Auth::guard('user')->check())
                    <li class="navbar-list small dashboard"><a href="{{route('dashboard')}}" >Dashboard</a></li>
                @else
                <li class="navbar-list small signup"><a href="{{route('signup')}}" id="sg" >Sign Up</a></li>
                <li class="navbar-list small login"><a href="{{route('login')}}" id="lg" >Log In</a></li>
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

@if(Auth::guard('user')->check())
 <style>
     #header-navbar-menu {
         height: 390px
     }

     @media screen and (max-width:420px){
        #header-navbar-menu {
         height: 300px;
         border-bottom-left-radius: 5%;
         border-bottom-right-radius: 5%

        }
     }
     @media screen and (max-width:375px){
        #header-navbar-menu {
         height: 300px !important;
         border-bottom-left-radius: 5%;
         border-bottom-right-radius: 5%

        }
     }
 </style>
@endif
    <script type="text/javascript">
          window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";
        (function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";
            s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();



        $(document).ready(function(){
             $('.navigation-menu').click(function(){
                console.log("navigation");
                $('#header-navbar-menu').toggle();
                $('.login').show();
                $('.signup').show();
                $('.navigation-menu').toggleClass('change');
            });

//            $(document).ready(function(){
//                $('.navigation-menu').click(function(){
//                $('.navigation-menu').toggleClass('change');
//                $('#header-navbar-menu').toggle(9990000000000000000)
//                // $('.login').show();
//                // $('.signup').show();
//                })


//            $(document).ready(function(){
//                $('.navigation-menu').click(function(){
//                $('.navigation-menu').toggleClass('change');
//                $('#header-navbar-menu').toggle(9990000000000000000)
//                // $('.login').show();
//                // $('.signup').show();
//                })
//
//        });
     </script>

</body>
</html>