@extends('panel.master.layout')
@section('content')
    <!-- Contact Page -->
    <div id="contact-page">

        <h1> Let Us know Your Questions!</h1>
        <form class="contact-page" method="post" action="{{route('contact')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="name" id="Name" value="{{Auth::guard('user')->user()->name}}">

            <input type="hidden" name="email" id="Email" value="{{Auth::guard('user')->user()->email}}">

            <textarea name="message" id="" cols="30" rows="10" placeholder="Your message ..."></textarea>
            <button class="pandel-button">Send</button>
        </form>


        <div id="footer-div">
            <hr class="contact-hr-footer">
            <div class="contact-footer-div" >
            <p class="contact-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
            <img id="contact-footer-image" src="{{URL::asset('img/Logo_footer.png')}}" alt="">

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