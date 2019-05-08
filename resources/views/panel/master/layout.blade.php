<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/contact-referral-activity-dashboard.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/cssreset.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/alertify.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/chartist.min.css')}}">
    {{--<link rel="stylesheet" href="{{URL::asset('css/chartist.min.css')}}">--}}
    {{--<link type="text/css" rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}"> --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="../fonts/font-awesome.min.css">
    {{-- <link rel="stylesheet" href="{{URL::asset('css/theme.css')}}">  --}}
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon"/>
    @yield('title')
    <script src="{{URL::asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{URL::asset('js/chartist.min.js')}}"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="{{URL::asset('js/utils.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{URL::asset('js/alertify.min.js')}}"></script>
    <script>
      (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1240497,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <style>
        .activeLink a{
            color:white !important;

        }
    </style>
    @if(Config::get('app.locale') == 'fa')
    <STYLE>
      @font-face {
        font-family: BYekanFont;
        src: url({{asset('fonts/BYekan.ttf')}});
      }
      * {
        font-family: BYekanFont;
      }
      h1, h2, h3, h4, h5, h6 {
        font-family: BYekanFont;
      }
      th, a, p, input, button, legend, label {font-family: BYekanFont;}
      .user-account-list a {font-family: BYekanFont;}
      .mainList a {font-family: BYekanFont;}
   /*   #dashboard:before {
        font-family: BYekanFont;
     }

    #activity:before {
       font-family: BYekanFont; 
    }

    #contact1:before {
        font-family: BYekanFont;
    }

    #setting:before {
      font-family: BYekanFont;
    }

    #referral:before {
        font-family: BYekanFont;
    }

    #logouticon2:before{
      font-family: BYekanFont;
    }*/

    </STYLE>
   @endif
</head>

<body>

<header>

    <div id="header-div">
        <a href="http://hashbazaar.com"> <img class="Logo_header" src="{{URL::asset('img/Logo_header.svg')}}" alt="Logo_header"></a>
    </div>
    <div class="navigation-menu" >
        <div class="bar1 test2"></div>
        <div class="bar2 test2"></div>
        <div class="bar3 test2"></div>
    </div>
    <div class="useraccount">
        <div class="list1"  id="useraccounthide">
            <ul>
                <li class="user-account-list sub2"> <a href="{{route('dashboard')}}" id="dashboard2">{{__("Dashboard")}}</a></li>
                <li class="user-account-list sub2"> <a href="{{route('activity')}}" id="activity2">{{__("Activity")}}</a></li>
            @if(Config::get('app.locale') == 'fa')
            @else
                <li class="user-account-list sub2"> <a href="{{route('referral')}}" id="referral2">{{__("Referral")}}</a> </li>
            @endif    
                <li class="user-account-list sub2"> <a href="{{route('setting')}}" id="setting2">{{__("Setting")}}</a></li>
                <li class="user-account-list sub2"> <a href="{{route('contact')}}" id="contact2">{{__("Contact")}}</a></li>
                <li class="user-account-list sub2" id="logouticon"><a href="{{route('logout')}}" >{{__("Log Out")}}</a></li>


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


    header {
        display: flex;
        display: -ms-flexbox;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-flexbox;
        flex-flow: row nowrap
    }

    #header-div {
        flex: 1;
    }

    .navigation-menu {
        flex: 1;
        z-index: 11111111;
        position: absolute;
        right: 100px
    }

    /*  */
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
        .navigation-menu {
            right: 50px
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
            <li class="{{request()->route()->getName() =='dashboard'?'sub dashboard activeLink':'sub dashboard'}}"> <a href="{{route('dashboard')}}" id="dashboard">{{__("Dashboard")}}</a></li>
            <li class="{{request()->route()->getName() =='activity'?'sub dashboard activeLink':'sub dashboard'}}"> <a href="{{route('activity')}}" id="activity">{{__("Activity")}}</a></li>
        @if(Config::get('app.locale') == 'fa')
        @else    
            <li class="{{request()->route()->getName() =='referral'?'sub activeLink':'sub'}}"> <a href="{{route('referral')}}" id="referral">{{__("Referral")}}</a> </li>
        @endif     
            <li class="{{request()->route()->getName() =='setting'?'sub activeLink':'sub'}}"> <a href="{{route('setting')}}" id="setting">{{__("Setting")}}</a></li>
            <li class="{{request()->route()->getName() =='contact'?'sub activeLink':'sub'}}"> <a href="{{route('contact')}}" id="contact1">{{__("Contact")}}</a></li>
            <li class="sub"> <a href="{{route('logout')}}" id="logouticon2">{{__("Log Out")}}</a></li>

        </ul>

    </nav>




</div>
<script>
    var isOpen = false;

    function hideMe(){
        document.getElementById('useraccounthide').style.display = 'none';
        isOpen =false;
        $('.navigation-menu').removeClass('change');
        console.log('hide me function')
        
    }
    $(document).ready(function(){
        $('.mainContainer nav ul li a').click(function(){
            $(this).addClass('activelink')
        })
    })

  

</script>
{{-- <script type="text/javascript">
    window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";
    (function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";
        s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
</script>

<script type="text/javascript">
    $(document).ready(function(){
        console.log("dashboard");
        $('.navigation-menu').click(function(){
            console.log("navigation-menu");
            $('#header-navbar-menu').toggle(1);
            $('.useraccount .list1').toggle(1);
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
</script> --}}
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
                $('#header-navbar-menu').toggle(1);
                $('.useraccount .list1').toggle(1);
                $('.navigation-menu').toggleClass('change');
                isOpen =true;
            })
            $('h1').click(function(){
              console.log("h1 click");
            });

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