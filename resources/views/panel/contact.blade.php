@extends('panel.master.layout')
@section('title')
    <title>Contact Us</title>
@endsection
@section('content')
    <!-- Contact Page -->
    <div class="panel-container contact-container"  onclick="hideMe()">
        <h2 class="panel-header text-center"> {{__("LET US KNOW YOUR QUESTIONS")}}</h2>
        <form method="post" action="{{route('contact')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="name" id="Name" value="{{Auth::guard('user')->user()->name}}">
            <input type="hidden" name="email" id="Email" value="{{Auth::guard('user')->user()->email}}">
            <textarea class="form-control" rows="5" name="message" placeholder="{{__("Your message ...")}}"></textarea>
            <button class="pandel-button">{{__("Send")}}</button>
        </form>
        <br/><br/>
        <br/><br/><br/>
        <br/>
        <br/>
        <br/>
    </div>
  @if(Config::get('app.locale') == 'fa')
    <style type="text/css">
      .contact-container {direction: rtl;}
    </style>
   @endif
   <style type="text/css">
        /* .panel-header {
            margin-top: 2%;
            font-size: 2rem;
            color: #2e2d2d;
           font-weight: bold;
           font-family: sans-serif;
        }
        .contact-container form {
            width: 70%;
            margin: auto;
        }
        @media screen and (max-width:1024px) {
          .contact-container form {
            width: 70%;
          }
          .panel-header {
             font-size: 1.8rem;
           }
        }

        @media screen and (max-width:768px) {
          .contact-container form {
            width: 80%;
          }
          .panel-header {
             font-size: 1.5rem;
           }
        }
        @media screen and (max-width:415px) {
          .contact-container form {
            width: 90%;
          }
          .panel-header1 {
             margin-top: 4%;
             font-size: 1.1rem;
             letter-spacing: 0.5px
           }
        } */
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