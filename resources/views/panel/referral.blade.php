<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hash Bazaar - Referral</title>
    <link rel="stylesheet" href="css/contact-referral-activity-dashboard.css">
        <script src="js/jquery-3.3.1.js"></script>
        <link rel="stylesheet" href="css/cssreset.css">
    <script>

    </script>
</head>

<body>
    <!-- Header -->
    <header>


        
               <div id="header-div"><a href="http://hashbazaar.com"> <img class="Logo_header" src="img/Logo_header.svg" alt="Logo_header"></a> </div>    
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
    <!-- Referral Page -->
    <div id="referral-page">
        <q>Notice :</q>

        <ul class="referral-page_firstList">

                <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
                <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
                <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
        </ul>

                <blockquote>My Referral ID : </blockquote>
                <p> &nbsp; &nbsp; KJDNSA39d987DSA</p>


                <dl>Total Benefits Till Now (USD) :</dl>
                <p>$ 100</p>

    <div class="referral-page_secondList">

            <div class="referral-page_secondList_column">Number of Sharing
                <ul><li>5</li></ul>
            </div>

            <div class="referral-page_secondList_column">Total Sharing Income (USD)
                    <ul><li>$ 12000</li></ul>

            </div>

            <div class="referral-page_secondList_column">My Benefit (USD)
                    <ul><li>$ 3000</li></ul>
            </div>




        </div>



        <hr class="referral-hr-footer" style="position: absolute;;">


    </div>


<!-- Footer -->
    <div>

        <div class="referral-footer-div">
                <p class="referral-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
             <img id="referral-footer-image" src="img/Logo_footer.svg" alt=""></div>

    </div>


    <!-- Container -->
    <div class="mainContainer">

            <!-- <a href="#" class="icon-menu"><img src="img/menu.png" alt=""></a>
            <a href="#" class="icon-menu-times"><img class="times-solid" src="img/times-solid.svg" alt=""></a> -->

        <nav class="container-referral">
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

        <nav class="container-referral2">
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
