<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/contact-referral-activity-dashboard.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/cssreset.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
    <title>Hash Bazaar - Dashboard</title>
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


    <div id="header-div"> <a href="http://hashbazaar.com"> <img class="Logo_header" src="{{URL::asset('img/Logo_header.svg')}}" alt="Logo_header"></a> </div>
    <div class="useraccount">

        <img class="user-img" src="{{URL::asset('../img/user-circle-solid.svg')}}" alt="">

        <div class="list">

            <ul>
                <li class="user-account-list sub2"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
                <li class="user-account-list sub2"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
                <li class="user-account-list sub2"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
                <li class="user-account-list sub2"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
                <li class="user-account-list sub2"> <a href="{{route('contact')}}" id="contact">Contact</a></li>
                <li class="user-account-list" id="usericon">User Account</li>
                <li class="user-account-list" id="logouticon">Log Out</li>

            </ul>
        </div>

    </div>
</header>



@yield('content')




<!-- Container -->
<div class="mainContainer">


    <nav class="container">

        <ul class="mainList">
            
            <li class="navbar"> <a href="http://hashbazaar.com"><img class="Logo_In_NavBar" src="{{URL::asset('img/Logo_In_NavBar.svg')}}" alt="Logo_In_NavBar"></a>
                <a href="" id="welcome">Welcome User</a> </li>
            <li class="sub dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
            <li class="sub"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
            <li class="sub"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
            <li class="sub"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
            <li class="sub"> <a href="{{route('contact')}}" id="contact">Contact</a></li>

        </ul>

    </nav>




</div>


</body>
</html>