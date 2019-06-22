
<!DOCTYPE html>
<html style="font-size: 100%" lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="keywords"
          content="Bitcoin mining, scrypt mining, cloud mining, hosted mining, Hash Bazaar"/>
    <meta name="description"
          content="Bitcoin is the digital gold of the future & HashBazaar is the most cost effective cloud mining company on the market. Mine bitcoin through the cloud, get started today!"/>
    <meta name="google-site-verification" content="roNqWp-CmbNsSN2R6ggCv2ubJwFNikEs_WJ7E2P3WDw" />
    @if(request()->path() === '/')
        <title>Hash Bazaar - Cloud mining Company</title>
    @else
        @yield('title')
    @endif

    <!-- <link rel="icon" href="img/TabLogo.png"> -->
    <!-- <link rel="stylesheet" href="{{asset('css/blog.css')}}"> -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="{{asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('js/jquery.animate-colors.js')}}"></script>
<!--     <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('js/jquery.animate-colors.js')}}"></script>
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script> -->
    <!-- Hotjar Tracking Code for http://hashbazaar.com/ -->
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
</head>
  
<body id="page-top" style="background: white">
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
      .btn {font-family: BYekanFont;}
    </STYLE>
 @endif


<!-- class="masthead pb-3" -->
<header id="header" >
    {{-- navbar  ../../public/img/Logo_header.svg.svg.svg   --}}
    <div class="header-navbar">
        <div id="header-navbar-logo">
            <ul>
                <li class="navbar-list big"><a href="http://hashbazaar.com"><img class="navbar-small-logo" src="{{asset('img/Logo_header.svg')}}" alt="hash bazaar Logo"></a>
            </ul>
        </div>
        <div id="header-navbar-menu" >
            <ul>
                @if(Config::get('app.locale') == 'fa')
                <!-- <li class="navbar-list small1 a1"><a href="http://blog.hashbazaar.com">{{__('Blog')}}</a></li> -->
                <!-- <li class="navbar-list small1 a1"><a href="{{route('affiliate')}}">{{__('Affiliate')}}</a></li> -->
                <li class="navbar-list small1 a1"><a href="{{route('index')}}">{{__('Home')}}</a></li>
                <li class="navbar-list small1 a1"><a href="{{route('aboutUs')}}">{{__('About')}}</a></li>
                <li class="navbar-list small1 a1"><a href="{{route('customerService')}}">{{__('FAQ')}}</a></li>
                @else
                <li class="navbar-list small1 a1"><a href="{{route('index')}}">{{__('Home')}}</a></li>
                <li class="navbar-list small1 a1"><a href="{{route('aboutUs')}}">{{__('About')}}</a></li>
                <li class="navbar-list small1 a1"><a href="{{route('customerService')}}">{{__('FAQ')}}</a></li>
                <li class="navbar-list small1 a1"><a href="{{route('affiliate')}}">{{__('Affiliate')}}</a></li>
                <li class="navbar-list small1 a1"><a href="http://blog.hashbazaar.com">{{__('Blog')}}</a></li>
                @endif
                @if(Auth::guard('user')->check())
                    <li class="navbar-list small1 dashboard"><a href="{{route('dashboard')}}" >{{__('Dashboard')}}</a></li>
                @else
                <li class="navbar-list small1 signup"><a href="{{route('signup')}}" id="sg" >{{__('Sign Up')}}</a></li>
                <li class="navbar-list small1 login"><a href="{{route('login')}}" id="lg" >{{__('Log In')}}</a></li>
                
                @endif

                <li class="flags">
                    <div>
                        <a href="{{route('locale',['locale'=>'fa'])}}" id="persianFA"><img src="./flags/ir.svg" alt="Persian (FA)"></a>
                        <a href="{{route('locale',['locale'=>'en'])}}" id="engUK"><img src="./flags/uk.svg" alt="English (UK)"></a>
                    </div>
                </li>
            </ul>
            
        </div>
        <div class="navigation-menu">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </div>

</header>
@yield('content')

@if(Auth::guard('user')->check())
 
@endif



    <script type="text/javascript">
        
          window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";
        (function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";
            s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();

        var flag = 0 ;
        var isOpen = false;
        function hideMe(){
                $('#header-navbar-menu').hide();
                isOpen =false;
                $('.navigation-menu').removeClass('change');
                console.log('hide me function')
        }


        $(document).ready(function(){

             $('.navigation-menu').click(function(){
                console.log("navigation test");
                if(flag == 0) {
                  flag = 1 ;
                  $('#header-navbar-menu').show();
                  $('.navigation-menu').addClass( "change" );
                    isOpen =true;

                } else {
                  flag = 0 ;
                  $('#header-navbar-menu').hide();
                  $('.navigation-menu').removeClass( "change" );
                  isOpen =false;

                }
                
            });
            // determine lanuage
             var languageDetection = 'ir';
             if(languageDetection === 'ir') {

                    var block = $('.block');
                    var lang = $( ".select option:selected" ).attr('data-price');
                    if(lang) {
                        var temp = "./flags/"+lang;
                        block.css('background-image','url('+temp+')');
                    }

             }  else {
                    var block = $('.block');
                        var temp = "./flags/uk.svg";
                        block.css('background-image','url('+temp+')');
                }
                $('.select').change(function(){

                        var block = $('.block');
                        var lang = $( ".select option:selected" ).attr('data-price');
                        if(lang) {

                            var temp = "./flags/"+lang;
                            block.css('background-image','url('+temp+')');

                            {{--axios.get('{{route('changeLanguage')}}'+'?lang='+lang).then(function(response){--}}
                                {{--if(response.data == 200){--}}


                                {{--}--}}

                            {{--})--}}

                                window.location = {!! json_encode(request()->route('locale',['locale'=>'en'])) !!};
                        }
                });
           

       
       });


     </script>

@if(Config::get('app.locale') == 'fa')
<style type="text/css">
    #header-navbar-menu {
        text-align: right;
    }
    #header-navbar-menu ul li {
        padding-right: 20px;
    }
    
    .flags a {
        float:right
    }
    
    .flags a#persianFA {
        border-left: 1px solid white;
        margin-left: 10px
    }

    @media screen and (max-width:769px){
        .flags {
            margin-left: 95% !important
        }
    }
</style>
@else

<style type="text/css">
        .flags a {
            float:left;
        }

        .flags a#persianFA {
            border-right: 1px solid white;
            padding-right: 10px
        }

        @media screen and (max-width:421px){
            .flags {
                margin-left: 75% !important
            }
        }
</style>
@endif
</body>
</html>

