<!DOCTYPE html>
<html style="font-size: 100%" lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    @if(Config::get('app.locale') == 'fa')
      <meta name="keywords"
          content="ماینینگ بیت کوین، ماینینگ ابری بیت کوین، هاستینگ ماینر، هش بازار، اجاره فارم، فروش ماینر، خرید ماینر، ارز دیجیتال،  "/>
       <meta name="description"
          content="هش بازار سرویس ارائه خدمات ماینینگ ابری ( ماینینگ از راه دور ) است.هش بازار اقدام به بهرهبرداری از مزارع ماینینگ، در کانتینرهای امن، قابل حمل در مکان های مناسب و با اشغال فضای کمتر و چگالی دستگاه بیشتر نسبت به مزارع ماینینگ در زمینهای صنعتی و کشاورزی مینماید."/>
    @else
        <meta name="keywords"
          content="Bitcoin mining, scrypt mining, cloud mining, hosted mining, Hash Bazaar"/>
       <meta name="description"
          content="Bitcoin is the digital gold of the future & HashBazaar is the most cost effective cloud mining company on the market. Mine bitcoin through the cloud, get started today!"/>
    @endif
    
    <meta name="google-site-verification" content="roNqWp-CmbNsSN2R6ggCv2ubJwFNikEs_WJ7E2P3WDw" />
    @if(request()->path() === '/')
        <title>{{__('HashBazaar - Cloud Mining Company')}}</title>
    @else
        @yield('title')
    @endif

    <link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="{{URL::asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/theme.css')}}">
    <link rel="icon" href="{{URL::asset('img/favicon.ico')}}" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/util.css')}}">
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
    <script src="{{URL::asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{URL::asset('js/jquery.animate-colors.js')}}"></script>
    <script src="{{URL::asset('js/main.js')}}"></script>

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

<body id="page-top" style="background: white;display: flex;flex-direction: column;">
@if(Config::get('app.locale') == 'fa')
    <STYLE>
      @font-face {
        font-family: BYekanFont;
        src: url({{asset('fonts/BYekan.ttf')}});
      }
      * {
        font-family: BYekanFont;
      }
      h1, h2, h3, h4, h5, h6, div {
        font-family: BYekanFont;
      }
      th, a, p, input, button, legend, label {font-family: BYekanFont;}
      .btn {font-family: BYekanFont;}
    </STYLE>
 @endif
@include('master/navbar')
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

             $('.navbar-toggler').click(function(){
                console.log("navigation test");
                $('.navbar-collapse').toggle();
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

    .flags a#engUK {
        margin-left:10px;
    }

    .flags a#persianFA {
        border-left: 1px solid white;
        margin-left: 10px
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

        .flags a#engUK {
            margin-left:10px;
        }
</style>
@endif
</body>
</html>

