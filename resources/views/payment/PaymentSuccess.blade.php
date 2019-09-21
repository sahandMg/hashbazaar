@extends('panel.master.layout')
@section('title')
@if(App::getlocale() == 'fa')
<title>هش بازار | تراکنش موفق</title>
@else
<title>Hashbazaar | Payment</title>
@endif
@endsection
@section('content')

 <div class="panel-container" style="color: black;">
   <h2 class="text-center" style="margin-top: 2%;">{{__("PAYMENT SUCCESSFUL")}}</h2>
   <div class="text-center" style="display: block;margin: 0 auto;">
     <img width="250" height="250" src="{{asset('img/success.png')}}" />
   </div>
 </div>

@endsection
