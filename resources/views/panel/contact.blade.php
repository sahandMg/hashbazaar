@extends('panel.master.layout')
@section('title')
    <title>Contact Us</title>
@endsection
@section('content')
    <!-- Contact Page -->
    <div class="panel-container contact-container">
        <h1 class="text-center"> Let Us know Your Questions!</h1>
        <form class="contact-page" method="post" action="{{route('contact')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="name" id="Name" value="{{Auth::guard('user')->user()->name}}">

            <input type="hidden" name="email" id="Email" value="{{Auth::guard('user')->user()->email}}">

            <textarea name="message" id="" cols="30" rows="10" placeholder="Your message ..."></textarea>
            <button class="pandel-button">Send</button>
        </form>
    </div>
  
   <style type="text/css">
        .contact-container h1 {
            color: black;
        }
   </style>


    <script>
    
        // ------------user account--------------------

    
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list1').toggle(500);
            })
        })
        
         // =---------------------------------------
    </script>
@endsection