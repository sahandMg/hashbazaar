<section  class="pt-4 pb-4 dashboardImage" style="padding-top: 4%;color: #707070;direction: rtl;">
 <div class="container text-center">
     @if($agent->isDesktop())
         <img class="img-fluid" alt="HashBazaar dashboard" src="{{URL::asset('img/dashboard-mac.png')}}">
     @elseif($agent->isTablet())
         <img class="img-fluid" alt="HashBazaar dashboard" src="{{URL::asset('img/dashboard-ipad.png')}}">
     @elseif($agent->isPhone())
         <img class="img-fluid" alt="HashBazaar dashboard" src="{{URL::asset('img/dashboard-iphone.png')}}">
     @endif

 </div> 
</section>
<style type="text/css">
  .dashboardImage img {
    max-height: 500px;
    width: auto;
  }
 @media screen and (max-width:768px){
  .dashboardImage img {
    max-height: 400px;
   }
 }
</style>
  @media screen and (max-width:420px){
  .dashboardImage img {
    max-height: 300px;
   }
 }
</style>