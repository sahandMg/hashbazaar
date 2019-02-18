@extends('panel.master.layout')
@section('content')
    <!-- Contact Page -->
    <div id="contact-page">

        <h1> Let Us know Your Questions!</h1>
        <form class="contact-page" action="">
            <input type="text" name="Name" id="Name" placeholder="Name">

            <input type="email" name="Email" id="Email" placeholder="Email">

            <textarea name="" id="" cols="30" rows="10"></textarea>
            <button class="pandel-button">Send</button>
        </form>


        <div id="footer-div">
            <hr class="contact-hr-footer">
            <div class="contact-footer-div" >
            <p class="contact-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
            <img id="contact-footer-image" src="{{URL::asset('img/Logo_footer.svg')}}" alt="">

            </div>
        </div>
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