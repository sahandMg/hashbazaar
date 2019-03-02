@extends('panel.master.layout')
@section('title')
    <title>Contact Us</title>
@endsection
@section('content')
    <!-- Contact Page -->
    <div class="panel-container contact-container">
        <h1 class="text-center"> Let Us know Your Questions!</h1>
        <form method="post" action="{{route('contact')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="name" id="Name" value="{{Auth::guard('user')->user()->name}}">
            <input type="hidden" name="email" id="Email" value="{{Auth::guard('user')->user()->email}}">
            <textarea class="form-control" rows="5" name="message" placeholder="Your message ..."></textarea>
            <button class="pandel-button">Send</button>
        </form>
        <br/><br/>
        <br/><br/><br/>
        <br/>
        <br/>
        <br/>
    </div>
  
   <style type="text/css">
        .contact-container h1 {
            margin-top: 2%;
            color: black;
            font-size: 2rem;
        }
        .contact-container form {
            width: 70%;
            margin: auto;
        }
        @media screen and (max-width:1024px) {
          .contact-container form {
            width: 70%;
          }
          .contact-container h1 {
             font-size: 1.8rem;
           }
        }

        @media screen and (max-width:768px) {
          .contact-container form {
            width: 80%;
          }
          .contact-container h1 {
             font-size: 1.5rem;
           }
        }
        @media screen and (max-width:415px) {
          .contact-container form {
            width: 90%;
          }
          .contact-container h1 {
             margin-top: 4%;
             font-size: 1.1rem;
             letter-spacing: 0.5px
           }
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