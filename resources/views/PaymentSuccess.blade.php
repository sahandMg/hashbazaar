@extends('panel.master.layout')
@section('title')
    <title>Your Payment Successed</title>
@endsection
@section('content')
  
 <div class="panel-container" style="color: black;">
   <h2 class="text-center" style="margin-top: 2%;">PAYMENT SUCCESSFUL</h2>
   <div style="display: block;margin: 0 auto;">
     <img src="{{URL::asset('img/paymentSuccess.png')}}" />
   </div>
 </div>

@endsection