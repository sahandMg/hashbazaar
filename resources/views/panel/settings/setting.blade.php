@extends('panel.master.layout')
@section('content')

<script src="../js/jquery-3.3.1.js"></script>
<!-- ---------------------------------------------------------------------------------------------- -->

<div id="setting-page">

    <div class="setting-flex">

        <div class="flex-item one"><a href="#">User Information</a></div>


        <div class="flex-item two"><a href="#">Wallet</a></div>

    </div>


    <div class="setting-information">
        <form action="">
            <q>User Information </q> <br>

            <p id="textbefore">Name</p>
            <input type="text" name="text" id="text" placeholder="Name"> <br>
            <p id="textbefore">Email</p>

            <input type="email" name="email" id="email" placeholder="user@example.com"> <br> <br> <br>

            <q>Password</q> <br>
            <p id="textbefore">Current Password</p>

            <input type="password" name="curpass" id="cur-password" placeholder="Current Password"> <br>
            <p id="textbefore">New Password</p>

            <input type="password" name="newpass" id="newpassword" placeholder="Current Password"> <br>
            <p id="textbefore">Confirm Password</p>

            <input type="password" name="Confirmpassword" id="Confirmpassword" placeholder="confirm Password">

            <input type="button" value="Submit" class="pandel-button" >
        </form>

    </div>

    <div class="wallet1">

            <p>Still Don’t Have a Bitcoin Wallet? Click <a href="https://bitcoin.org/en/getting-started" id="clickhear"
                style="color:orange;text-decoration: none;font-weight: bold;">Hear</a> To Make One!
                </p>

                <q>OR</q>

                <blockquote>Change Your Wallet Address</blockquote>
                <form id="setting-wallet" action="">
                <input type="text" id="textwallet">

                <input type="button" class="pandel-button ws" value="Submit" >
                </form>



        </div><!-- Wallet 1 -->


    
        <div class="make-wallet">

                <p id="make-wallet-title">Current Bitcoin Wallet Address</p>


                <div class="address">

                    <div class="address-img"><img  src="../img/SampleQR.svg" alt=""></div>

                    <div class="address-box">
                            <input type="text" placeholder="SDKnsdakndnj12n1k1lkmdsalm">

                         <a href="mail-icon"><img class="icon" src="../img/Mail.svg" alt=""></a>
                        <a href="link-icon"><img class="icon" src="../img/Link.svg" alt=""></a>
                         <a href="copy-icon"><img class="icon" src="../img/Copy.svg" alt=""></a>
                    </div>

                    <div class="change-address">

                        <form action="">
                        <input type="text" placeholder="SDKnsdakndnj12n1k1lkmdsalm"><br>

                        <input type="submit" class="pandel-button" value="Submit" >
                        </form>
                    </div>



                </div><!-- address -->

                <p id="make-wallet-title2">Need To Change Your Address ?</p>
    </div>


<!-- ---------------------------------------------------------------------------------------------- -->

<!-- Container -->
{{--<div class="mainContainer">--}}


    {{--<nav class="container">--}}

        {{--<ul class="mainList">--}}

            {{--<li class="navbar"> <a href="http://hashbazaar.com"><img class="Logo_In_NavBar" src="{{URL::asset('../img/Logo_In_NavBar.svg')}}" alt="Logo_In_NavBar"></a>--}}
                {{--<a href="" id="welcome">Welcome User</a> </li>--}}
            {{--<li class="sub dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>--}}
            {{--<li class="sub"> <a href="{{route('activity')}}" id="activity">Activity</a></li>--}}
            {{--<li class="sub"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>--}}
            {{--<li class="sub"> <a href="{{route('setting')}}" id="setting">Setting</a></li>--}}
            {{--<li class="sub"> <a href="{{route('contact')}}" id="contact">Contact</a></li>--}}

        {{--</ul>--}}

    {{--</nav>--}}




{{--</div>--}}
<!-- Footer -->
<footer id="footer-div" >
        <hr id="setting-hr-footer">
        <p class="setting-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
        <img id="setting-footer-image" src="../img/Logo_footer.svg" alt="">

</footer>

<script>
    $.noConflict();

    jQuery(document).ready(function($){

        $('.one').click(function(){
            $('.setting-information').show();
            $('.wallet1').hide();
            $('.make-wallet').hide()

            $('.one a').css('color','orange');
            $('.two a').css('color','#2e2d2d')


        })


        $('.two').click(function(){
            $('.setting-information').hide();
            $('.wallet1').show();
            $('.make-wallet').hide()

            $('.two a').css('color','orange');
            $('.one a').css('color','#2e2d2d');

        })



        $('#clickhear').click(function(){
            $('.setting-information').hide();
            $('.wallet1').hide();
            $('.make-wallet').show()

            $('.two a').css('color','orange');
            $('.one a').css('color','#2e2d2d');

        })
    })

</script>
@endsection
