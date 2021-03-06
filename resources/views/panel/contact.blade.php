@extends('panel.master.layout')
@section('title')
@if(App::getlocale() == 'fa')
<title>هش بازار | تماس با ما</title>
@else
<title>Hashbazaar | Contanct</title>
@endif
@endsection
@section('content')
    <!-- Contact Page -->
    <div class="container"  onclick="hideMe()">
        <h2 class="panel-header text-center"> {{__("LET US KNOW YOUR QUESTIONS")}}</h2>
        <br/>
        <div class="text-center" style="direction: rtl;"> @include('formMessage')</div>
        <form class="col-lg-8 col-md-9 col-sm-11 mx-auto" style="direction: rtl;" onsubmit="submitForm()" method="post" action="{{route('contact',['locale'=>session('locale')])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="name" id="Name" value="{{Auth::guard('user')->user()->name}}">
            <input type="hidden" name="email" id="Email" value="{{Auth::guard('user')->user()->email}}">
            <textarea required class="form-control" rows="5" name="message" placeholder="{{__("Your message ...")}}"></textarea>
            <button id="send" class="pandel-button">{{__("Send")}}</button>
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

    <script>
        // ------------user account--------------------

        $(document).ready(function(){

            $('.user-img').click(function(){
                $('.list1').toggle(500);
            })
        });

        function submitForm() {
            document.getElementById('send').disabled = true
        }

         // =---------------------------------------
    </script>
@endsection
