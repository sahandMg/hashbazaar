<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/jquery-3.3.1.js"></script>
        <title>Hash Bazaar - Make Wallet</title>
    <link rel="stylesheet" href="../css/setting-make wallet.css">
    <link rel="stylesheet" href="../css/cssreset.css">
    <script>

    </script>
</head>

<body>
    <!-- Header -->
    <header>


        
               <div><a href="http://hashbazaar.com"> <img class="Logo_header" src="../img/Logo_header.svg" alt="Logo_header"> </a></div>    
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


    <!-- Setting Page -->

    <div id="setting-page">

        <div class="setting-flex">

            <div class="flex-item one"><a href="{{route('userInfo')}}">User Information</a>



            </div>



            {{--<div class="flex-item-two flex-item"><a style="color:orange" href="{{route('changePassword')}}" class="change">Change Password</a></div>--}}


            {{--<div class="flex-item three"><a href="{{route('wallet')}}">Wallet</a></div>--}}

            <div class="flex-item-two flex-item"><a href="{{route('changePassword')}}" class="change">Change Password</a></div>


            <div class="flex-item three"><a style="color:orange" href="{{route('wallet')}}">Wallet</a></div>


        </div>



        <!-- Make wallet -->

        <div class="make-wallet">

            <hr class="make-wallet-hr1" style="position: relative;top: 116px;">
            <p id="make-wallet-title">Current Bitcoin Wallet Address</p>
            <hr class="make-wallet-hr2" style="position: relative;top:70px;">


            <div class="address">

                <div class="address-img"><img  src="img/SampleQR.svg" alt=""></div>

                <div class="address-box">
                        <input type="text" placeholder="SDKnsdakndnj12n1k1lkmdsalm">

                     <a href="mail-icon"><img class="icon" src="../img/Mail.svg" alt=""></a>
                    <a href="link-icon"><img class="icon" src="../img/Link.svg" alt=""></a>
                     <a href="copy-icon"><img class="icon" src="../img/Copy.svg" alt=""></a>
                </div>

                <div class="change-address">
                    <input type="text" placeholder="SDKnsdakndnj12n1k1lkmdsalm"><br>

                </div>



            </div><!-- address -->

            <hr class="make-wallet-hr111" style="position: relative;top: 316px;width: 24%;left: -280px;">
            <hr class="make-wallet-hr11" style="position: relative;top: 316px;">
            <p id="make-wallet-title2">Need To Change Your Address ?</p>
            <hr class="make-wallet-hr22" style="position: relative;top:270px;">
            <hr class="make-wallet-hr222" >


            <form id="setting-make-wallet" action=""><button><p>Submit</p></button></form>

        </div> <!-- make-wallet -->
    <hr class="make-wallet-hr-footer" style="position: relative;top: 570px">


    </div> <!-- id="setting-page" -->



        <!-- Footer -->
    <div>

            <div class="make-wallet-footer-div">
                    <p class="make-wallet-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
                 <img id="make-wallet-footer-image" src="img/Logo_footer.svg" alt=""></div>

            </div>

    <!-- Container -->
    <div class="mainContainer">

            <!-- <a href="#" class="icon-menu"><img src="img/menu.png" alt=""></a>
            <a href="#" class="icon-menu-times"><img class="times-solid" src="img/times-solid.svg" alt=""></a> -->


        <nav class="container-setting-make-wallet">
            <ul class="mainList">
                <ul class="mainList">
                    <li class="navbar"> <a href="http://hashbazaar.com"><img class="Logo_In_NavBar" src="img/Logo_In_NavBar.svg" alt="Logo_In_NavBar"></a>
                        <a href="" id="welcome">Welcome User</a> </li>
                        <li class="sub dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
                        <li class="sub"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
                        <li class="sub"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
                        <li class="sub"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
                        <li class="sub"> <a href="{{route('contact')}}" id="contact">Contact</a></li>
    
                </ul>



        </nav>


        <nav class="container-setting-make-wallet2">
            <ul class="mainList2">

                <li class="sub2 dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
                <li class="sub2"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
                <li class="sub2"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
                <li class="sub2"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
                <li class="sub2"> <a href="{{route('contact')}}" id="contact">Contact</a></li>
            </ul>










    </div>

    <script>

        // ------------user account--------------------
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list').toggle(500);
            })
        })
    
    // =---------------------------------------
    </script>
</body>

</html>
