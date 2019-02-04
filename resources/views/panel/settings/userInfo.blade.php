<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Hash Bazaar - Setting</title>
    <link rel="stylesheet" href="../css/setting2.css">
    <link rel="stylesheet" href="../css/cssreset.css">
    <script src="../js/jquery-3.3.1.js"></script>

    <script>

    </script>
</head>

<body>
    <!-- Header -->
    <header>


        
               <div><a href="http://hashbazaar.com"> <img class="Logo_header" src="../img/Logo_header.svg" alt="Logo_header"></a> </div>    
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


            <div class="flex-item-two flex-item"><a style="color:orange" href="{{route('changePassword')}}" class="change">Change Password</a></div>


            <div class="flex-item three"><a href="{{route('wallet')}}">Wallet</a></div>

        </div>

        <!-- User-Information -->
        <div class="User-Information">

                <hr class="setting-hr1" style="position: relative;top: 40px;">
                <p id="User-Information-title">Update Your Informations</p>
                <hr class="setting-hr2" style="position: relative;">

                <form class="setting" action="">
                    <input type="email" name="email" id="email" placeholder="user@example.com">

                    <input type="password" name="passowrd" id="password" placeholder="New Password">

                    <input type="password" name="passowrd" id="password-confirm" placeholder="Confirm">



                    <button><p>Submit</p></button>

                </form>



                <hr class="setting-hr-footer" style="position: relative;">

        </div>


        <!-- Footer -->
        <footer>

            <div class="setting-footer-div">
                    <p class="setting-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
                 <img id="setting-footer-image" src="img/Logo_footer.svg" alt=""></div>

        </footer>




    </div> <!-- id="setting-page" -->

    <!-- Container -->
    <div class="mainContainer">

        <nav class="container-setting">
            <ul class="mainList">
                <li class="navbar"> <a href="http://hashbazaar.com"><img class="Logo_In_NavBar" src="img/Logo_In_NavBar.svg" alt="Logo_In_NavBar"></a>
                    <a href="http://hashbazaar.com" id="welcome">Welcome User</a> </li>

                    <li class="sub dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
                    <li class="sub"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
                    <li class="sub"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
                    <li class="sub"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
                    <li class="sub"> <a href="{{route('contact')}}" id="contact">Contact</a></li>

            </ul>



        </nav>



        <nav class="container-setting2">
                <ul class="mainList2">

                    <li class="sub2 dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
                    <li class="sub2"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
                    <li class="sub2"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
                    <li class="sub2"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
                    <li class="sub2"> <a href="{{route('contact')}}" id="contact">Contact</a></li>
                </ul>



            </nav>











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
