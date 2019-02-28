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
    <script src="/public/js/jquery-3.3.1.js"></script>

    <script>

    </script>
</head>

<body>
    <!-- Header -->
    <header>


        
               <div><a href="http://hashbazaar.com"> <img class="Logo_header" src="../img/Logo_header.svg" alt="Logo_header"> </a></div>    
               <div class="useraccount">

                <img class="user-img" src="../img/user-circle-solid.svg" alt="">
    
                <div class="list1">

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


    </div> 



        <!-- Footer -->
    <div>

            <div class="make-wallet-footer-div">
                    <p class="make-wallet-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
                 <img id="make-wallet-footer-image" src="{{asset('img/Logo_footer.png')}}" alt=""></div>

            </div>

   

    <script>

        // ------------user account--------------------
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list1').toggle(500);
            })
        })
    
    // =---------------------------------------
    </script>
</body>

</html>
