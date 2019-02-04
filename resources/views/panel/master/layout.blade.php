<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>#BAZAAR - Activity</title>
    <link rel="stylesheet" href="css/contact-referral-activity-dashboard.css">
    <script src="js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="css/cssreset.css">
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="js/utils.js"></script>

</head>

<body>
<!-- Header -->
<header>


    <a href="http://hashbazaar.com">
        <div id="header-div"> <img class="Logo_header" src="img/Logo_header.svg" alt="Logo_header"> </div>    </a>
    <div class="useraccount">

        <img class="user-img" src="../img/user-circle-solid.svg" alt="">

        <div class="list">

            <ul>

                <li class="user-account-list" id="usericon">User Account</li>
                <li class="user-account-list" id="logouticon">Log Out</li>

            </ul>
        </div>

    </div>
</header>
@yield('content')


<div class="mainContainer">

    <!-- <a href="#" class="icon-menu"><img src="img/menu.png" alt=""></a>
    <a href="#" class="icon-menu-times"><img class="times-solid" src="img/times-solid.svg" alt=""></a> -->

    <nav class="container-activity">
        <ul class="mainList">

            <li class="navbar"> <a href=""><img class="Logo_In_NavBar" src="img/Logo_In_NavBar.svg" alt="Logo_In_NavBar"></a>
                <a href="" id="welcome">Welcome User</a> </li>


            <li class="sub dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
            <li class="sub"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
            <li class="sub"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
            <li class="sub"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
            <li class="sub"> <a href="{{route('contact')}}" id="contact">Contact</a></li>


        </ul>



    </nav>

    <nav class="container-activity2">
        <ul class="mainList2">

            <li class="sub2 dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
            <li class="sub2"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
            <li class="sub2"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
            <li class="sub2"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
            <li class="sub2"> <a href="{{route('contact')}}" id="contact">Contact</a></li>
        </ul>



    </nav>






</div>
</body>

</html>
