@extends('remote.layout')
@section('title')

@endsection

@section('content')


<div class="au-card text-right" style="direction: rtl;">
 <div class="wrapper-custom col-lg-10 col-md-11 col-sm-12 mx-auto">
  <div class="contant">
    <a class="tab-custom" href="#no1">مینی کامپیوتر<i class="fa fa-angle-down" aria-hidden="true"></i></a>
    <div class="text-custom" id="no1" >
      <p>ابتدا کابل شبکه مینی کامپیوتر را متصل کنید.(دقت کنید به مودمی متصل کنید که ماینرها به آن وصل هستند. )</p>
      <p>سپس برق دستگاه را وصل کنید، پس از حدود 15 دقیقه، صفحه مانیتورینگ وضعیت ماینرها رو چک کنید. اطلاعات ماینرها قابله مشاهد است.</p>
      <img src="{{URL::asset('remoteDashboard/images/readmeImage.jpg')}}" style="width: 95%;display: block;margin: auto;">
      <br/>
      <p>اگر می خواهید شناسه ثبت شده در مینی کامپیوتر را تغییر دهید، با ما تماس بگیرید. </p>
      <br/>
    </div>
  </div>
  <div class="contant">
    <a class="tab-custom" href="#no2">Amir Sohel  <i class="fa fa-angle-down" aria-hidden="true"></i></a>
    
    
    <div class="text-custom" id="no2" >
       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus rerum corrupti, cumque quasi quae perspiciatis quo sit reprehenderit itaque dicta. Unde nobis ullam saepe, odit porro. Dicta beatae, nobis quasi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus rerum corrupti, cumque quasi quae perspiciatis quo sit reprehenderit itaque dicta. Unde nobis ullam saepe, odit porro. Dicta beatae, nobis quasi.</p>
    </div>
  </div>
    
    
    
  <div class="contant">
    <a class="tab-custom" href="#no3">Amit Agarwal <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
    <div class="text-custom" id="no3" >
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus rerum corrupti, cumque quasi quae perspiciatis quo sit reprehenderit itaque dicta. Unde nobis ullam saepe, odit porro. Dicta beatae, nobis quasi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus rerum corrupti, cumque quasi quae perspiciatis quo sit reprehenderit itaque dicta. Unde nobis ullam saepe, odit porro. Dicta beatae, nobis quasi.</p>
    </div>
  </div>
  <div class="contant">
    <a class="tab-custom" href="#no4">Puneet Sharma <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
    <div class="text-custom" id="no4" >
       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus rerum corrupti, cumque quasi quae perspiciatis quo sit reprehenderit itaque dicta. Unde nobis ullam saepe, odit porro. Dicta beatae, nobis quasi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus rerum corrupti, cumque quasi quae perspiciatis quo sit reprehenderit itaque dicta. Unde nobis ullam saepe, odit porro. Dicta beatae, nobis quasi.</p>
    </div>
  </div>
  <div class="contant">
    <a class="tab-custom" href="#no5">Mahesh Sharma <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
    <div class="text-custom" id="no5" >
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus rerum corrupti, cumque quasi quae perspiciatis quo sit reprehenderit itaque dicta. Unde nobis ullam saepe, odit porro. Dicta beatae, nobis quasi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus rerum corrupti, cumque quasi quae perspiciatis quo sit reprehenderit itaque dicta. Unde nobis ullam saepe, odit porro. Dicta beatae, nobis quasi.</p>
    </div>
  </div>
  
</div>

 </div>
 <br/>

 <style type="text/css">
 	.wrapper-custom
{
/*margin:20px auto;*/
}

.tab-custom
{
 background-image: -webkit-linear-gradient(left, #675DB9, #915BC0);
    background-image: -ms-linear-gradient(left, #675DB9, #915BC0);
  display:block;
  color:#fff;
  text-decoration:none;
  padding:20px;
  font-size: 1.6rem
  /*font-family: arial;*/
}

.text-custom {
  overflow:hidden;
  height:0px;
  transition: all 0.6s;
  font-family: arial;

}

.text-custom:target
{
	/*height:110px;*/
	height: 100%;
 transition: all 0.6s;}
 
 .wrapper-custom p {
    padding: 10px;
    margin: 0;
    font-size: 1.4rem;
  }

i.fa.fa-angle-down {
    float: left; margin-top: 6px;
}

.Direction-custom {
    transform: rotate(-182deg);
}
@media (max-width: 769px) {
    .au-card {
        padding: 10px 5px;
    }
    .wrapper-custom p {
      padding: 5px; font-size: 1.1rem;
    }
    .tab-custom
    {
      padding:20px;
      font-size: 1.3rem
    }
}
 </style>

 @include('remote/scripts')

@endsection