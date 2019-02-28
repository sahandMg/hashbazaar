@extends('panel.master.layout')
@section('title')
    <title>Settings</title>
@endsection
@section('content')

<script src="../js/jquery-3.3.1.js"></script>
<!-- ---------------------------------------------------------------------------------------------- -->

<div id="setting-page">

    <div class="setting-flex">

        <div class="flex-item one"><a href="#">User Information</a></div>


        <div class="flex-item two"><a href="#">Wallet</a></div>

    </div>

    @if(count($errors->all()) > 0)

        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
             @endforeach
        </ul>
      @endif

    @if(session()->has('message'))
        <p>{{session('message')}}</p>
    @endif
    <div class="setting-information">
        <form action="{{route('setting')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <q>User Information </q> <br>

            <p id="textbefore">Name</p>
            <input type="text" name="text" id="text" value="{{Auth::guard('user')->user()->name}}" disabled="disabled"> <br>
            <p id="textbefore">Email</p>

            <input type="email" name="email" id="email" value="{{Auth::guard('user')->user()->email}}" disabled="disabled"> <br> <br> <br>

            <q>Password</q> <br>
            <p id="textbefore">Current Password</p>

            <input type="password" name="pass" id="cur-password" placeholder="Current Password"> <br>
            <p id="textbefore">New Password</p>

            <input type="password" name="newpass" id="newpassword" placeholder="New Password"> <br>
            <p id="textbefore">Confirm Password</p>

            <input type="password" name="confirm" id="Confirmpassword" placeholder="confirm Password">

            <input type="submit" value="Submit" class="pandel-button">
        </form>

    </div>

    <div class="wallet1">

            <p>Still Don’t Have a Bitcoin Wallet? Click <a href="https://www.blockchain.com/" target="_blank" id="clickhear"
                style="color:orange;text-decoration: none;font-weight: bold;">Hear</a> To Make One!
                </p>

                <q>OR</q>

                <blockquote>Change Your Wallet Address</blockquote>
                {{-- <form id="setting-wallet" action=""> --}}
                    <input type="text" id="textwallet">

                    <input type="button" class="buttonwallet" value="Submit">
                {{-- </form> --}}



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



<!-- Footer -->
<footer id="footer-div" >
        <hr id="setting-hr-footer">
        <p class="setting-footer-paragraph" style="color:black">© 2018 HashBazaar. All rights reserved</p>
        <img id="setting-footer-image" src="{{asset('img/Logo_footer.png')}}" alt="">

</footer>

<script>
    $.noConflict();

    jQuery(document).ready(function($){
        $('.one a').css('color','orange');


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
