@extends('remote.layout')
@section('title')

@endsection

@section('content')
   <div class="au-card text-right" style="direction: rtl;">
       <div class="alert alert-danger">
         <p>پراخت شما با مشکل مواجه شده است.</p>
         <p>اگر پولی از حساب شما کسر شده است در 48 ساعت به شما باز می گردد.</p>
         <p>شماره تراکنش: <strong>12564875</strong></p> 
         <p>طفا دوباره فرآیند خرید را تکرار نمایید.</p>
       </div>
   </div>
   <br/><br/>
 @include('remote/scripts')
   <script type="text/javascript">
    
   </script>
@endsection