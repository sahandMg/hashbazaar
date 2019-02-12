@extends('panel.master.layout')
@section('content')
    <!-- Contact Page -->
    <div id="contact-page">

        <h1> Let Us know Your Questions!</h1>
        <form class="contact-page" action="">
            <input type="text" name="Name" id="Name" placeholder="Name">

            <input type="email" name="Email" id="Email" placeholder="Email">

            <textarea name="" id="" cols="30" rows="10"></textarea>

             <button><span style="color:white">Send</span></button>
        </form>
        <hr class="contact-hr-footer" >


        <div id="footer-div">
            <div class="contact-footer-div" >
            <p class="contact-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
            <img id="contact-footer-image" src="{{URL::asset('img/Logo_footer.svg')}}" alt="">

            </div>
        </div>
    </div>


    <!-- Container -->
    <div class="mainContainer">
          

        <nav class="container-contact">
            <ul class="mainList">
                <li class="navbar"> <a href="http://hashbazaar.com"><img class="Logo_In_NavBar" src="{{URL::asset('img/Logo_In_NavBar.svg')}}" alt="Logo_In_NavBar"></a>
                    <a href="" id="welcome">Welcome User</a> </li>
                    <li class="sub dashboard"> <a href="{{route('dashboard')}}" id="dashboard">Dashboard</a></li>
                    <li class="sub"> <a href="{{route('activity')}}" id="activity">Activity</a></li>
                    <li class="sub"> <a href="{{route('referral')}}" id="referral">Referral</a> </li>
                    <li class="sub"> <a href="{{route('setting')}}" id="setting">Setting</a></li>
                    <li class="sub"> <a href="{{route('contact')}}" id="contact">Contact</a></li>

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
@endsection