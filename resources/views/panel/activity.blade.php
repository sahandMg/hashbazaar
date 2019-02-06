<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>#BAZAAR - Activity</title>
    <link rel="stylesheet" href="{{URL::asset('css/contact-referral-activity-dashboard.css')}}">
    <script src="{{URL::asset('js/jquery-3.3.1.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('css/cssreset.css')}}">

</head>

<body>

<?php
$settings = DB::table('settings')->first();
foreach ($hashes as $key=> $hash){

    $remainedLife[$key] = floor((\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($hash->created_at)->addYears($hash->life)))/($hash->life * 365) * 100) ;
}

?>

<!-- Header -->
<header>



    <div id="header-div"> <a href="http://hashbazaar.com"><img class="Logo_header" src="{{URL::asset('img/Logo_header.svg')}}" alt="Logo_header"> </a></div>
    <div class="useraccount">

        <img class="user-img" src="{{URL::asset('../img/user-circle-solid.svg')}}" alt="">

        <div class="list">

            <ul>

                <li class="user-account-list" id="usericon">User Account</li>
                <li class="user-account-list" id="logouticon">Log Out</li>

            </ul>
        </div>

    </div>
</header>

<div id="activity-page">
    <q>Notice :</q>

    <ul id="activity-page_firstList">

        <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
        <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
        <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
    </ul>

    <blockquote>Recent Activities</blockquote>


    <div class="purchases">
        <q>Purchases</q>

        <div id="activity-page_secondList">
            @if(!$hashes->isEmpty())
                <div    id="activity-page_secondList_column">Hash Power
                    <ul>
                        @foreach($hashes as $hash)
                        <li>{{$hash->hash}} TH/S</li>
                            @endforeach
                    </ul>
                </div><br><br>

                <div id="activity-page_secondList_column">Started At
                    <ul>
                        @foreach($hashes as $hash)
                        <li>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}}</li>
                            @endforeach
                    </ul>

                </div><br><br>

                <div id="activity-page_secondList_column">Ends At
                    <ul>
                        @foreach($hashes as $hash)

                        <li>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}</li>

                        @endforeach
                    </ul>
                </div><br> <br>

                <div id="activity-page_secondList_column">Remains

                    <ul>
                        @foreach($hashes as $key => $hash)
                            <li>
                                <div style="width: 180px; margin: 0px auto">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%">
                                            <span class="title">{{$remainedLife[$key]}}%</span>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div><br> <br>
            @else
                <p> No Purchase !</p>
            @endif

        </div>

    </div>

    <div class="Transactions">
        <q>Transactions </q>
        <div id="activity-page_thirdList">
            <div id="activity-page_thirdList_column"> Date
                <ul>
                    <li>10 Sep 2018</li>
                    <li>10 Sep 2018</li>
                    <li>10 Sep 2018</li>

                </ul>
            </div>

            <div id="activity-page_thirdList_column"> BTC
                <ul>
                    <li>0.01</li>
                    <li>0.01</li>
                    <li>0.01</li>

                </ul>
            </div>

            <div id="activity-page_thirdList_column"> Address
                <ul>
                    <li>778dsadDSAB
                        Hhbjbdsa89dsax</li>
                    <li>778dsadDSAB
                        Hhbjbdsa89dsax</li>
                    <li>778dsadDSAB
                        Hhbjbdsa89dsax</li>
                </ul>
            </div>

            <div id="activity-page_thirdList_column"> Status
                <ul>
                    <li>Pending</li>
                    <li>Processed</li>
                    <li>Pending</li>
                </ul>
            </div>
        </div>
    </div>


    <hr class="activity-hr-footer" style="position: relative;">


</div>


<!-- Footer -->
<div>

    <div class="activity-footer-div">
        <p class="activity-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
        <img id="activity-footer-image" src="img/Logo_footer.svg" alt=""></div>

</div>

<!-- Container -->
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


<script>// ------------user account--------------------
    $(document).ready(function(){

        $('.user-img').click(function(){
            $('.list').toggle(500);
        })
    })

    // =---------------------------------------</script>
</body>

</html>
