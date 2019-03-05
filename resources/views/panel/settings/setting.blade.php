@extends('panel.master.layout')
@section('title')
    <title>Settings</title>
@endsection
@section('content')


<div id="setting-page" class="panel-container ">
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
        <form name="profile" action="{{route('setting')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
             <legend class="coppyIcon">User Information </legend>  

            <label id="textbefore">Name
            <input type="text" name="text" id="text" value="{{Auth::guard('user')->user()->name}}" disabled="disabled"> 
            </label>
            
            <label id="textbefore">Email
            <input type="email" name="email" id="email" value="{{Auth::guard('user')->user()->email}}" disabled="disabled"/> 
            </label>


             <legend>Password</legend> 
            <label id="textbefore">Current Password
            <input type="password" name="pass" id="cur-password" placeholder="Current Password">  <br>
            </label>

            <label id="textbefore">New Password
            <input type="password" name="newpass" id="newpassword" placeholder="New Password">
            </label>

            <label id="textbefore">Confirm Password
            <input type="password" name="confirm" id="Confirmpassword" placeholder="Confirm Password">
            </label>


            <input type="submit" value="Submit" class="pandel-button">
        </form>

    </div>

    <div class="wallet1 text-center" >

            <p class="text-center">Still Don’t Have a Bitcoin Wallet? Click <a href="https://www.blockchain.com/" target="_blank" id="clickhear"
                style="color:orange;text-decoration: none;font-weight: bold;">Hear</a> To Make One!
                </p>

                <h2 style="color:black" class="text-center">OR</h2>

                <h2 class="text-center" style="color:black">Submit Your Wallet Address</h2>


                
                 <form id="setting-wallet" class="text-center" method="post" action="{{route('wallet')}}">
                     <input class="text-center" type="hidden" name="_token" value="{{csrf_token()}}">
                    <input class="text-center" type="text" id="textwallet" name="wallet">
                    <input  type="submit" class="buttonwallet text-center" value="Submit">
                 </form>



        </div><!-- Wallet 1 -->


    
 <div class="make-wallet">

        <div class="title-flex2">
                <hr class="dashboard-hr2"/>
                <h1 class="dashboard-title2">Current Bitcoin Wallet Address</h1>
                <hr class="dashboard-hr2"/>
        </div> 

        
        <div class="address">

            <div class="address-img"><img  src="../img/SampleQR.svg" alt=""></div>

            <div class="address-box">
                <input type="text" placeholder="SDKnsdakndnj12n1k1lkmdsalm">

                <a><img class="icon" src="../img/Mail.svg" alt=""></a>
                <a><img class="icon" src="../img/Link.svg" alt=""></a>
                <a class="coppyIcon" style="cursor: pointer;"><img class="icon" src="../img/Copy.svg" alt=""></a>
            </div>

            <div class="change-address">
                    
        
                    <form action="">
                        <input type="text" id="copyTarget" value="SDKnsdakndnj12n1k1lkmdsalm" placeholder="SDKnsdakndnj12n1k1lkmdsalm"><br>
                        <input type="submit" class="pandel-button a4" value="Submit" >
                    </form>
            </div>

        </div><!-- address -->
         
        <div class="title-flex2 a3">
                <hr class="dashboard-hr2"/>
                <h1 class="dashboard-title2">Need To Change Your Address ?</h1>
                <hr class="dashboard-hr2"/>
        </div> 

 </div>
</div>

<script>
    // $.noConflict();
    console.log("setting wallet *******")
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
