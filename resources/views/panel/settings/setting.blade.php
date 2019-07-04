@extends('panel.master.layout')
@section('title')
    <title>{{__("Settings")}}</title>
@endsection
@section('content')


<div id="setting-page" class="panel-container " >
    <div class="setting-flex">
        <div class="flex-item one"><a href="#">{{__("User Information")}}</a></div>
        <div class="flex-item two"><a href="#">{{__("Wallet")}}</a></div>

    </div>
    @if(count($errors->all()) > 0)
        <ul>
            @include('formError')
        </ul>
      @endif
    @include('formMessage')
    @include('sessionError')

    <div class="setting-information" >
        <form onsubmit="submitForm(event)"  name="profile" action="{{route('setting')}}" method="post">

            <input type="hidden" name="_token" value="{{csrf_token()}}">

             <legend >{{__("User Information")}} </legend>


            <label id="textbefore">{{__("Username")}}
            <input type="text" name="text" id="text" style="font-size:1rem" value="{{Auth::guard('user')->user()->name}}" disabled="disabled">
            </label>

            <label id="textbefore">{{__("Email")}}
            <input type="email" name="email" id="email" style="font-size:1rem" value="{{Auth::guard('user')->user()->email}}" disabled="disabled"/>
            </label>


             <legend>{{__("Change Password")}}</legend>
            <label id="textbefore">{{__("Current Password")}}
            <input required type="password" name="password" id="cur-password" placeholder="{{__("Current Password")}}">  <br>
            </label>

            <label id="textbefore">{{__("New Password")}}
            <input required type="password" name="newpass" id="newpassword" placeholder="{{__("New Password")}}">
            </label>

            <label id="textbefore">{{__("Confirm Password")}}
            <input required type="password" name="confirm" id="Confirmpassword" placeholder="{{__("Confirm Password")}}">
            </label>

            <button id="userForm" type="submit" class="pandel-button">{{__("Submit")}}</button>
        </form>

    </div>
    <div class="wallet1 text-center" >

            <p class="text-center">{{__("Still Don’t Have a Bitcoin Wallet? Click")}} <a href="https://www.blockchain.com/" target="_blank" id="clickhear"
                style="color:orange;text-decoration: none;font-weight: bold;">‌{{__("Hear To Make One!")}}</a>
                </p>
                <h2 style="color:black" class="text-center">{{__("OR")}}</h2>
                <h2 class="text-center" style="color:black">{{__("Submit Your Wallet Address")}}</h2>

                 <form onsubmit="submitForm(event)"  id="setting-wallet" class="text-center" method="post" action="{{route('wallet')}}">
                     <input class="text-center" type="hidden" name="_token" value="{{csrf_token()}}">
                    <input required class="text-center" type="text" id="textwallet" name="wallet">
                    <button id="wallet" type="submit" class="buttonwallet text-center">{{__("Submit")}}</button>
                 </form>



        </div><!-- Wallet 1 -->



 <div class="make-wallet">

        <div class="title-flex2">
                <hr class="dashboard-hr2"/>
                <h2 class="dashboard-title2">{{__("Current Bitcoin Wallet Address")}}</h2>
                <hr class="dashboard-hr2"/>
        </div>


        <div class="address">
            @if(!is_null(Auth::guard('user')->user()->wallet))
                <div class="address-img">{!! QrCode::size(150)->generate(Auth::guard('user')->user()->wallet->addr) !!}</div>

            <div class="address-box">
                <input type="text" id="copyTarget" value="{{Auth::guard('user')->user()->wallet->addr}}" readonly>
                <div class="div-icons-flex">
                    <a href="https://blockstream.info/address/{{!is_null(Auth::guard('user')->user()->wallet)?Auth::guard('user')->user()->wallet->addr:null}}"><img class="icon" src="../img/Link.svg" alt="Link"></a>
                    <a class="coppyIcon" style="cursor: pointer;"><img class="icon" src="../img/Copy.svg" alt="Copy Link"></a>
                </div>
            </div>
            @endif
            <div class="change-address">

                <form onsubmit="submitForm(event)" action="{{route('editWallet')}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input required type="text" class="a2"  name="address"   placeholder="{{!is_null(Auth::guard('user')->user()->wallet)?Auth::guard('user')->user()->wallet->addr:'Your bitcoin wallet address'}}"><br>
                    <button id="editWallet" type="submit" class="pandel-button a4"  >{{__("Submit")}}</button>
                </form>

            </div>

        </div><!-- address -->

        <div class="title-flex2 a3">
                <hr class="dashboard-hr2"/>
                <h2 class="dashboard-title2">{{__("Need To Change Your Address ?")}}</h2>
                <hr class="dashboard-hr2"/>
        </div>

 </div>
</div>
@if(Config::get('app.locale') == 'fa')
    <style type="text/css">
      .setting-information {direction: rtl;text-align: right;}
      .setting-information input#text {
         margin-left: 0;
      }
      .setting-information #textbefore {
        margin-left: 0;
      }
    </style>
 @endif
<script>
    // $.noConflict();
    function submitForm(){
        document.getElementById('userForm').disabled = true;
        document.getElementById('editWallet').disabled = true;
        document.getElementById('wallet').disabled = true;
    }

    console.log("setting wallet *******")
    var wallet = {!! json_encode(Auth::guard('user')->user()->wallet) !!}
    $( ".coppyIcon" ).click(function() {
       console.log("coppyIcon click");
       alertify.success('Wallet address copy to clipboard');
       copyToClipboard(document.getElementById("copyTarget"));
    });

    // document.getElementById("copyButton").addEventListener("click", function() {

    // });

function copyToClipboard(elem) {
      // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
          succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
 }
    $(document).ready(function(){
        $('.two a').css('color','orange');


        $('.one').click(function(){
            $('.setting-information').show();
            $('.wallet1').hide();
            $('.make-wallet').hide()

            $('.one a').css('color','orange');
            $('.two a').css('color','#2e2d2d')


        })


        $('.two').click(function(){

            $('.setting-information').hide();
            if(wallet !== null){
                $('.wallet1').hide();
                $('.make-wallet').show()
            }else{

                $('.wallet1').show();
                $('.make-wallet').hide()
            }
            $('.two a').css('color','orange');
            $('.one a').css('color','#2e2d2d');

        })



        //============ wallet ===============
        console.log(wallet!== null )
        $('.setting-information').hide();

        if(wallet !== null){
            $('.wallet1').hide();
            $('.make-wallet').show()
        }else{

            $('.wallet1').show();
            $('.make-wallet').hide()
        }



    })

</script>

@if(Config::get('app.locale') == 'fa')

    <style type="text/css">
         #setting-page .setting-flex .flex-item a {
            font-size:2rem;
        }
        #dashboard-title2 {
            font-size: 1.5rem !important
        }

        .setting-information  {
            margin-top: 5%;
            direction: rtl;
            text-align: right
        }
        .setting-information label {
            margin-right: 3%
        }

        .setting-information input#text {
            margin-right: 21%;
        }

        .setting-information input#email {
            margin-right: 26%;
        }


        .setting-information input#cur-password {
            margin-right: 16.7%;
        }

        .setting-information input#newpassword {
            margin-right: 17%;
        }

        .setting-information input#Confirmpassword {
            margin-right: 16.7%;
        }
        @media screen and (max-width:1025px){
            .setting-information input#email {
                margin-right: 35%;
            }

            .make-wallet .dashboard-title2 {
                font-size: 1.9rem !important;
                flex: 2;
                text-align: center !important
            }

        }
        @media screen and (max-width:769px){
            .setting-information  {
                margin-left: 0%;
            }

            .make-wallet .dashboard-title2 {
                font-size: 1.9rem !important;
                flex: 2
            }

        }

        @media screen and (max-width:415px){
            .make-wallet .dashboard-title2 {
                font-size: 1.1rem !important;
                flex: 3
            }
            #dashboard-title2 {
              font-size: 1.5rem !important
            }

            .setting-information input#text {
                margin-right: 5% !important
            }
            .setting-information input#email {
                margin-bottom: 20px;
                margin-right: 22% !important
            }
            .setting-information input#text {
                margin-bottom: 20px;
                margin-right: 14%
            }

            .setting-information input#cur-password {
                margin-right: 22%;
            }

            .setting-information input#newpassword {
                margin-right: 22%;
            }

            .setting-information input#Confirmpassword {
                margin-right: 22%;
            }



        }

        @media screen and (max-width:321px){
            .setting-information input#text {
                margin-right: 21% !important
            }
            .make-wallet #dashboard-title2 {
                /* font-size: 2.5rem !important */
            }
        }

    </style>

@else

    <style type="text/css">


        .title-flex2 .dashboard-title2 {
            flex: 2;
        }
        .dashboard-hr2 {
            flex: 1 !important
        }


        #setting-page .setting-flex .flex-item a {
            font-size:1.3rem;
        }
        .setting-information  {
            margin-top: 5%;
            direction: ltr;
            text-align: left;
            font-size:1.2rem
        }
        .setting-information label {
            margin-left: 3%
        }

        .setting-information input#text {
            margin-left: 20%;
        }

        .setting-information input#email {
            margin-left: 26%;
        }


        .setting-information input#cur-password {
            margin-left: 10.4%;
        }

        .setting-information input#newpassword {
            margin-left: 14.7%;
        }

        .setting-information input#Confirmpassword {
            margin-left: 10%;
        }

        @media screen and (max-width:1025px){
            .setting-information input#text {
                margin-left: 41%;
            }

            .setting-information input#email {
                margin-left: 31%;
            }


            .setting-information input#cur-password {
                margin-left: 10.4%;
            }

            .setting-information input#newpassword {
                margin-left: 16%;
            }

            .setting-information input#Confirmpassword {
                margin-left: 9.7%;
            }
        }

        @media screen and (max-width:768px){
            .setting-information  {
                margin-left: 0%;
            }
        }

        @media screen and (max-width:415px){

            .title-flex2 .dashboard-title2 {
                flex: 6;
                font-size: 1rem !important
            }
            .dashboard-hr2 {
                flex:0.8 !important
            }

            .setting-information input#text {
                margin-bottom: 20px;
                margin-left: 22% !important
            }
            .setting-information input#email {
                margin-bottom: 20px;
                margin-left: 8.5% !important
            }

            .setting-information input#cur-password {
                margin-left: 22%;
            }

            .setting-information input#newpassword {
                margin-left: 22%;
            }

            .setting-information input#Confirmpassword {
                margin-left: 22%;
            }

        }

        @media screen and (max-width:376px) {
            .title-flex2 .dashboard-title2 {
                flex: 7;
                font-size: 1rem !important
            }
            .dashboard-hr2 {
                flex:0.5 !important
            }

            .setting-information input#text {
                margin-bottom: 20px;
                margin-left:15% !important
            }
            .setting-information input#email {
                margin-bottom: 20px;
                margin-left: 0.5% !important
            }
        }
        @media screen and (max-width:321px){


            .title-flex2 .dashboard-title2 {
                flex: 7;
                font-size: 12px !important
            }
            .dashboard-hr2 {
                flex:0.5 !important
            }

            .setting-information input#text {
                margin-bottom: 20px;
                margin-left: 14.5% !important;
                width: 200px;
            }
            .setting-information input#email {
                margin-bottom: 20px;
                width: 200px;
                margin-left: 1.5% !important;
            }

            .setting-information input#cur-password {
                width: 200px;
                margin-left: 16%;
            }

            .setting-information input#newpassword {
                width: 200px;
                margin-left: 16%;
            }

            .setting-information input#Confirmpassword {
                width: 200px;
                margin-left: 16%;
            }
        }

    </style>

@endif
@endsection
