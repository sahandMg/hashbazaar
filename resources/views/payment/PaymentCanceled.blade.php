@extends('panel.master.layout')
@section('title')
@if(App::getlocale() == 'fa')
<title>هش بازار | تراکنش ناموفق</title>
@else
<title>Hashbazaar | Payment</title>
@endif
@endsection
@section('content')

 <div class="panel-container" style="color: black;">
   <h2 class="text-center" style="margin-top: 2%;">{{__("Your Payment has been Canceled")}}</h2>
   <div style="display: block;margin: 0 auto;">
     <img width="250" height="250" src="{{asset('img/cancel.png')}}"/>
   </div>
 </div>

@endsection
