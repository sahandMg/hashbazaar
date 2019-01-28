<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>#BAZAAR - Contact</title>
    <link rel="stylesheet" href="css/contact-referral-activity-dashboard.css">
    <link rel="stylesheet" href="css/cssreset.css">
    <script>

    </script>
</head>

<body>
    <!-- Header -->
    <header>


               <div> <img class="Logo_header" src="img/Logo_header.svg" alt="Logo_header"> </div>

    </header>

    <!-- Contact Page -->
    <div id="contact-page">

        <h1> Let Us know Your Questions!</h1>
        <form class="contact-page" action="">
            <input type="text" name="Name" id="Name" placeholder="Name">

            <input type="email" name="Email" id="Email" placeholder="Email">

            <textarea name="" id="" cols="30" rows="10"></textarea>

             <button><span style="color:white">Send</span></button>
        </form>
        <hr class="contact-hr-footer" style="position: relative;">

    </div>

    <!-- Footer -->
    <div id="footer-div">

        <div class="contact-footer-div">
                <p class="contact-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
             <img id="contact-footer-image" src="img/Logo_footer.svg" alt=""></div>

    </div>

    <!-- Container -->
    <div class="mainContainer">
            <!-- <a href="#" class="icon-menu"><img src="img/menu.png" alt=""></a>
            <a href="#" class="icon-menu-times"><img class="times-solid" src="img/times-solid.svg" alt=""></a> -->


        <nav class="container-contact">
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



        <nav class="container-contact2">
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
