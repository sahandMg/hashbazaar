@if(Config::get('app.locale') == 'fa')
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- Fontfaces CSS-->
    <!-- <link href="css/font-face.css" rel="stylesheet" media="all"> -->
    <link href="{{URL::asset('miningDashboard/vendor/font-awesome-4.7/css/font-awesome.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{URL::asset('miningDashboard/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{URL::asset('miningDashboard/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/css/theme.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('miningDashboard/css/main.css')}}" rel="stylesheet" media="all">
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
      th, a, p, input, button, legend, label, span {font-family: BYekanFont;}
      .englishFont {font-family: sans-serif;}
      .user-account-list a {font-family: BYekanFont;}
      .mainList a {font-family: BYekanFont;}
    </STYLE>
@else
    <link rel="icon" href="{{URL::asset('img/favicon.ico')}}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{URL::asset('css/contact-referral-activity-dashboard.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/cssreset.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/alertify.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/chartist.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="{{URL::asset('fonts/font-awesome.min.css')}}">
@endif