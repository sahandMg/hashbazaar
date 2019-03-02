<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/contact-referral-activity-dashboard.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/cssreset.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="../fonts/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="{{URL::asset('css/theme.css')}}"> -->
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon"/>
        @yield('title')
    <script src="{{URL::asset('js/jquery-3.3.1.js')}}"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="{{URL::asset('js/utils.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
<header>

    <div id="header-div">
        <a href=""> <img class="Logo_header" src="{{URL::asset('img/Logo_header.svg')}}" alt="Logo_header"></a> 
    </div>
    <div class="useraccount">
        <div class="navigation-menu test2" id="responsive-nav">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div class="list1">
            <ul>
                <li class="user-account-list sub2"> <a href="{{route('dashboard')}}" id="dashboard2">Dashboard</a></li>
                <li class="user-account-list sub2"> <a href="{{route('activity')}}" id="activity2">Activity</a></li>
                <li class="user-account-list sub2"> <a href="{{route('referral')}}" id="referral2">Referral</a> </li>
                <li class="user-account-list sub2"> <a href="{{route('setting')}}" id="setting2">Setting</a></li>
                <li class="user-account-list sub2"> <a href="{{route('contact')}}" id="contact2">Contact</a></li>
                <li class="user-account-list sub2" id="logouticon"><a href="{{route('logout')}}">Log Out</a></li>
            </ul>
        </div>
    </div>
    
</header>



@yield('content')

   <hr/> 
   <footer>
       <p class="text-center">© 2018 HashBazaar. All rights reserved</p>
       <img class="test2" src="{{URL::asset('img/Logo_footer.png')}}" alt="HashBazaar">
   </footer>

    <!-- Container -->
    <style type="text/css">
       .panel-container {
         margin-top: 125px;   
         margin-left: 370px;
         display: flex;flex-direction: column;
       }
       @media screen and (max-width:1024px) {
          .panel-container {
            margin-left: 280px;
          }
        }

        @media screen and (max-width:768px) {
          .panel-container {
            margin-left: 0px;
          }
        }
        @media screen and (max-width:415px) {
          .panel-container {
            margin-left: 0px;
            margin-top: 85px;  
          }
        }
        footer img {
            width: auto;
            height: 60px;
            margin-left: 2%;
        }
        footer p {  margin-bottom: 2% ;color: black;font-size: 1.2rem;}
        footer {
            margin-left: 370px;
            padding: 0px;
        }

        @media screen and (max-width:1024px) {
          footer img {
            height: 40px;
          }
          footer {
            margin-left: 280px;
          }
        }

        @media screen and (max-width:768px) {
          footer {
            margin: 0px;
            padding-bottom: 2%;
          }
          footer img {
            height: 40px;
          }
        }

        @media screen and (max-width: 414px) {
          footer p {  margin-bottom: 2% ;color: black;font-size: 0.9rem;}
          footer {
            padding-bottom: 4%;
          }
          footer img {
            height: 30px;
            margin-left: 4%;
          }
        }
    </style>


<!-- Container -->
<div class="mainContainer">
    <nav class="container1">
        <ul class="mainList">
            
            <li class="navbar"> <a href="http://hashbazaar.com"><img class="Logo_In_NavBar" src="{{URL::asset('img/Logo_In_NavBar.svg')}}" alt="Logo_In_NavBar"></a>
                <a href="" id="welcome">{{Auth::guard('user')->user()->name}}</a> </li>
            <li class="sub dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
            <li class="sub"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
            <li class="sub"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
            <li class="sub"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
            <li class="sub"> <a href="{{route('contact')}}" id="contact1">Contact</a></li>
            <li class="sub"> <a href="{{route('logout')}}" id="logouticon2">Log Out</a></li>

        </ul>

    </nav>




</div>

    <script type="text/javascript">
          window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";
        (function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";
            s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            console.log("dashboard");
            $('.navigation-menu').click(function(){
              console.log("navigation-menu");
                $('#header-navbar-menu').toggle();
                $('.useraccount .list1').toggle();
                $('.navigation-menu').toggleClass('change');
            })
            $('h1').click(function(){
              console.log("h1 click");
            })
        });
        $(document).ready(function(){
         $(".test2").on('click', function () {
            console.log("div click");
          });
        });
         // console.log("js run af sdafa ");
         // var myEl = document.getElementById('test');
         // console.log(myEl);
         // myEl.addEventListener('click', function(event) {
         //       console.log("js run af sdafa asdfsdf ");
         //       alert('Hello world');
         //    });
    </script>
</body>
</html>