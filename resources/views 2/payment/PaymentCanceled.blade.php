@extends('panel.master.layout')
@section('title')
    <title>Payment canceled</title>
@endsection
@section('content')
  
 <div class="panel-container" style="color: black;">
   <h2 class="text-center" style="margin-top: 2%;">Your Payment has been Canceled</h2>
   <div style="display: block;margin: 0 auto;">
     <img width="250" height="250" src="{{asset('img/cancel.png')}}"/>
   </div>
 </div>

@endsection