﻿@extends('master.layout')
@section('title')
    @if(App::getlocale() == 'fa')
        <title>هش بازار | صفحه اصلی</title>
    @else
        <title>Hashbazaar | Home </title>
    @endif
@endsection
@section('content')
    <!-- class="masthead pb-3" -->
    <?php
    $settings = DB::connection('mysql')->table('settings')->first();
          if(isset($code)){
              $user = DB::connection('mysql')->table('users')->where('code',$code)->first();
              if(!is_null($user)){
                  $name = $user->name;
              }
          }

    ?>
    <header id="header" >


        <div class="intro-body headerTheme">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-10 col-sm-11 mx-auto">
                        <h1 class="text-center">{{__('BITCOIN INVESTMENT')}}</h1><img src="{{URL::asset('img/LOGO.svg')}}">
                        <h3>{{__('JOIN OUR MINING FARMS')}}</h3>
                        <br>
                        <h3 style="margin: 0px;">{{__('FILL YOUR POCKETS WITH BITCOIN')}}</h3>
                        <a class="btn btn-link btn-circle js-scroll-trigger responsive-circle"
                           style="border-color: red;color: red" role="button"
                           href="#sharePlan"><i class="fa fa-angle-down animated"></i></a></div>
                </div>
            </div>
        </div>
    </header>
    <section  id="sharePlan" class="backgroundGrey pt-4 pb-4 " style="padding-top: 4%;color: #707070;">
       <div class="text-center mb-4">
            <h3 class="fontTheme">{{__('CHOOSE YOUR INVESTMENT PLAN')}}</h3>
        </div>
        <div class="container" style="direction: rtl;">
          <div class="d-flex flex-wrap invest-plan">
            <!-- <div class="col-md-4 col-sm-12"> -->
              <div class="ContentSmallSize p-4">
                <h4 class="text-center mb-2">واگذاری دستگاه</h4>
                <p>بسته به نوع دستگاه بین 30 تا 40 درصد از درآمد بیت کوین حاصله بابت هاستینگ (هزینه برق، نگهداری و سرویس دستگاه) کسر می شود و مابقی به کیف پول شما واریز می گردد.</p>
                <hr/>
                <p>تفاوت مذکور در مورد درصد کسر شده با توجه به نسبت توان پردازش دستگاه به میزان مصرف برق آن تعیین می گردد.</p>
                <div class="text-center mt-1 mb-1">
                   <button class="btn btn-primary round-button-com" onclick="getDevices(event)"  type="button" style="width: 120px">واگذاری دستگاه</button>
                </div>
              </div>
            <!-- </div>
            <div class="col-md-4 col-sm-12"> -->
              <div class="ContentSmallSize py-2">
                <h4 class="text-center mb-2">طرح کلاسیک</h4>
                <div class="p-3" style="background-color: #ff9100;color: white">
                  <h5 class="text-center"><strong>{{$settings->usd_toman * $settings->usd_per_hash}} تومان</strong></h6>
                </div>
                <h6 class="text-center mt-2">برای یک تراهش</h6>
                <!-- <p class="text-center">1 تراهش = </p> -->
                <hr/>
                <h6 class="text-center mb-2">هزینه نگهداری</h6>
                <div class="p-3" style="background-color: #ff9100;color: white">
                  <h5 class="text-center"><strong>{{ round($settings->maintenance_fee_per_th_per_day * $settings->usd_toman)}} تومان</strong></h5>
                </div>
                <h6 class="text-center mt-2">برای هر روز به ازای هر تراهش</h6>
                <hr/>
                <h6 class="text-center mb-2">مدت قرار داد</h6>
                <!-- <p>:  </p> -->
                <div class="p-3" style="background-color: #ff9100;color: white">
                  <h5 class="text-center"><strong>{{$settings->hash_life}} سال</strong></h5>
                </div>
                <hr/>
                <p class="px-2">برای سفارش بیش از 100 تراهش به قسمت <a href="{{url('/cooperation')}}" style="color: #ff9100;">همکاری سازمانی سایت</a> مراجعه فرمائید.</p>
                <div class="text-center mt-1 mb-1">
                  <a class="btn btn-primary round-button-com"   href="{{route('signup',['locale'=>session('locale')]).'?plan=classic'}}" style="width: 120px;background-color: #ff9100;color: white;">خرید</a>
                </div>
              </div>
            <!-- </div> -->
            <!-- <div class="col-md-4 col-sm-12"> -->
              <div class="ContentSmallSize p-4">
                <h4 class="text-center mb-2">طرح کلاسیک صفر</h4>
                <p class="text-center">1 تراهش = {{$settings->usd_toman * $settings->usd_per_hash + round($settings->maintenance_fee_per_th_per_day * $settings->usd_toman * env('contractDays'))}} تومان</p>
                <hr/>
                <p>هزینه نگهداری: صفر تومان</p>
                <hr/>
                <p>مدت قرار داد: {{$settings->hash_life}} سال </p>
                <hr/>
                <p>برای سفارش بیش از 100 تراهش به قسمت <a href="{{url('/cooperation')}}">همکاری سازمانی سایت</a> مراجعه فرمائید.</p>
                <div class="text-center mt-1 mb-1">
                  <a class="btn btn-primary round-button-com"  href="{{route('signup',['locale'=>session('locale')]).'?plan=classic0'}}" style="width: 120px">خرید</a>
                </div>
              </div>
            <!-- </div> -->
          </div>
        </div>
    </section>
    <section class="context-section pb-4 pt-4 pl-4 pr-4 our-features" style="color:#696967;">
        <div class="row">
            <div class="col-md-4 col-sm-12 text-center pb-4">
                <!-- <h5 class="text-center">scalability</h5> -->
                <img src="img/8Asset 2.svg"  />
                <p>راه اندازی سریع</p>
            </div>
            <div class="col-md-4 col-sm-12 text-center pb-4">
                <img src="img/deposit-and-withdrawals.svg"  />
                <p>واریز سریع سود کسب شده</p>
            </div>
            <div class="col-md-4 col-sm-12 text-center pb-4">
                <img src="img/hashbazaar-asic.svg"  />
                <p >استفاده از جدید ترین سخت افزارها</p>
            </div>
             <div class="col-md-4 col-sm-12 text-center pb-4">
                <img src="img/security.svg"  />
                <p>تضمین امنیت سرویس های ما</p>
            </div>
             <div class="col-md-4 col-sm-12 text-center pb-4">
                <img src="img/statistic.svg"  />
                <p >مشاهد سود روزانه در پنل کاربر</p>
            </div>
            <div class="col-md-4 col-sm-12 text-center pb-4">
                <img src="img/group.svg"  />
                <p>دارای تیم فنی مجرب</p>
            </div>
        </div>
    </section>
    <!-- <section  id="sharePlan" class="text-center" style="padding-top: 4%;color: #707070;">
        <div>
            <h3 class="fontTheme">{{__('CHOOSE YOUR INVESTMENT PLAN')}}</h3>
        </div>
        <div class="container">
          <form action="{{route('signup',['locale'=>session('locale')])}}" method="get">
            <h5 id="demo"></h5>
            <div class="slidecontainer">
                <input name="hashPower" type="range" min="1" max="{{$settings->available_th}}" value="{{$settings->available_th/2}}" class="slider" id="myRange">
            </div>
            <div class="invest-plan" style="font-weight: 700;">
                <p>{{__("Hash allocation cost :")}} <span id="cost"></span> {{__("dollar")}} </p>

                @if(Config::get('app.locale') == 'fa')
                    <p >{{__('Maintenance fee')}}: {{$settings->maintenance_fee_per_th_per_day}} دلار ({{ $settings->maintenance_fee_per_th_per_day*$settings->usd_toman}} تومان) {{__('dollar per Th/day')}}</p>
                @else
                    <p >{{__('Maintenance fee')}}: {{$settings->maintenance_fee_per_th_per_day}} {{__('dollar per Th/day')}}</p>
                @endif

                <small>{{__("(include all electricity, cooling, development, and servicing costs )")}}</small>
                <p>{{__('Income : At this time We predict')}} {{$settings->bitcoin_income_per_month_per_th}} {{__('BTC/month per Th')}}</p>
                <small>{{__("(May be changed depends on bitcoin price and bitcoin network difficulty)")}}</small>
            </div>
            <div class="form-group fontTheme" style="margin-top: 2%;">
                <button class="btn btn-primary round-button-com" onclick="btnHidden(event)"  type="submit" style="width: 120px">{{__('BUY')}}</button>
                <button id="sending" class="btn btn-primary round-button-com"  hidden  type="button" style="width: 120px">{{__('Sending ...')}}</button>
            </div>
           </form>
        </div>
    </section> -->
  @if(Config::get('app.locale') == 'fa')
  <section class="context-section backgroundGrey text-center pt-4 pb-4 advantages" style="color: #707070;padding: 2%;"  >

    @if(strpos($_SERVER['HTTP_USER_AGENT'],'Mobile')== false)
      <img id="price" alt="electricity price" src="{{URL::asset('img/workflow.png')}}" style="width: 100%;height: auto;" />
    @else
          <img id="price" alt="electricity price" src="{{URL::asset('img/workflow_small.png')}}" style="width: 100%;height: auto;" />
    @endif

  </section>
  @else
    <section class="context-section backgroundGrey text-center pt-4 pb-4 advantages" style="color: #707070"  >
        <h2>Our Advantages</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h3 class="text-center"  style="color: #707070;">Working in the regions in which energy cost is low</h3>
                    <img id="price" alt="electricity price" src="{{URL::asset('img/Pricing.jpg')}}" style="width: 100%;height: auto;">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 advantages-detail">
                    <h3>{{__('OTHER ADVANTAGES: ')}}</h3>
                    <ul>

                        <li>
                            <h5>{{__("INSTANT MINING")}}</h5>
                            <p>{{__('Start mining immediately after confirming payment without any concerns and challenges.')}}</p>
                        </li>
                        <li>
                            <h5>{{__('DAILY WITHDRAWAL')}}</h5>
                            <p>{{__("Your mining output will be withdrawn as soon as increasing to 0.01 BTC.")}}</p>
                        </li>
                        <li>
                            <h5>{{__("ACTIVITY REPORT")}}</h5>
                            <p>{{__("Keep track of your transaction from your panel.")}}</p>
                        </li>
                        <li>
                            <h5>{{(__('STATISTICAL DETAILS'))}}</h5>
                            <p>{{__("Track your real time mining output at any point from any location.")}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
  @endif
    <section class="context-section invest-comparision text-center pt-4 pb-4 pr-4 pl-4" style="direction: rtl;color: #707070;">
        <h3>مقایسه سرمایه گذاری در ماینینگ با سایر فرصت ها</h3>
        <div class="row mt-4">  
          <div class="col-md-5 col-sm-12 ">
              <p>بازده سرمایه گذاری در صنعت ماینینگ علی رغم حیات کوتاه آن نسبت به سایر فرصت های سرمایه گذاری معمول در داخل کشور بسیار قابل توجه است. برای مقایسه ی بازده سرمایه گذاری در این صنعت در مقایسه با سایر فرصت های سرمایه گذاری ، اقدام به جمع آوری داده های مربوطه از بانک مرکزی جمهوری اسلامی ایران و محاسبه ی میانگین نرخ بازده سرمایه گذاری این موارد شده است. نتایج تحلیل این داده ها در نمودار رو به رو در فاصله سال های 1370 تا 1396 ارائه شده است.</p>
          </div>
          <div class="col-md-7 col-sm-12 text-center">
            <img src="img/hashbazaar-chart.png">
          </div>
        </div>
    </section>
    <section class="partners context-section pb-4 pt-4 pl-4 pr-4 backgroundGrey text-center">
        <h3>همکاران ما</h3>
        <div class="row">
            <div class="col-md-4 col-sm-12">

                <img src="img/farabi_icon.png"  />
                <!-- <p >شتاب دهنده فارابی</p> -->
            </div>
            <div class="col-md-4 col-sm-12">
                <img src="{{URL::asset('img/tadbir.svg')}}" />
                <!-- <p >کارگزاری تدبیرگران فردا</p> -->
            </div>
            <div class="col-md-4 col-sm-12">
                <img src="{{URL::asset('img/rayanHamAfza.png')}}"  />
            </div>
        </div>
    </section>
    <section id="contact" class="text-center backgroundGrey" >
        <div class="" style="background: white;padding-bottom:1px">
            <div class="col-lg-8 mx-auto">
                <h2 class="fontTheme m-3">{{__('LET US KNOW YOUR QUESTIONS')}}</h2>
            </div>
        </div>
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    @include('formError')
                    <form id="contactForm" class="contact-form" onsubmit="checkForm()" method="POST" action="{{route('message',['locale'=>session('locale')])}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group fontTheme"><input pattern='[a-zA-Z0-9 آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+'  required class="form-control" type="text" name="name"
                                                                 placeholder="{{__('name')}}" id="nameTextBox"></div>
                        <div class="form-group fontTheme"><input  required class="form-control" type="email" name="email"
                                                                 placeholder="{{__('email')}}" id="emailTextBox"></div>
                        <div class="form-group fontTheme"><textarea required class="form-control mx-auto" name="message"
                                                                    placeholder="{{__('Message')}}" id="messageTextBox"
                                                                    rows="5"></textarea></div>

                        <div class="form-group fontTheme">  <a onclick="refreshCaptcha(event)" style="cursor: pointer;">{{Captcha::img()}}</a></div>

                        <div class="form-group fontTheme"><input  required class="form-control" type="text" name="captcha"
                                                                  placeholder="{{__('Security Code')}}" id="emailTextBox"></div>

                        <div class="form-group fontTheme">
                            <button id="submit" class="btn btn-primary round-button-com" type="submit">{{__('SUBMIT')}}</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
   @include('master.footer')
    <!-- The Modal -->
    <div id="myModal" class="modal" style="color: black;">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="welcomeHashBazaar">
                <h2 class="text-center">Welcome to Hashbazaar</h2>
                <br/>
                <h4 class="text-center">We help you to invest in bitcoin mining.</h4>
                <br/>
                <p class="text-center">You are invited by <b> {{isset($name)?$name:'noBody'}}</b> so you can utilize {{$settings->sharing_discount * 100}}% discount for your first order.</p>
                <p class="text-center">Nice to have you in our cryptocurrency investment community.</p>
            </div>
            <div id="hosting" style="direction: rtl;text-align: right;">
                <h4 class="text-center">لطفا اطلاعات زیر را کامل کنید تا کارشناسان ما در اسرع وقت با شما تماس بگیرند یا با شماره 09371869568 تماس بگیرید.</h4>
                <form method="post" action="{{route('shareOrder',['locale'=>App::getLocale()])}}">
                    @include('formError')
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="form-group">
                     <label >نام :</label>
                     <input type="text" class="form-control" required name="name">
                  </div>
                    <div class="form-group">
                        <label >ایمیل</label>
                        <input type="text" class="form-control" required name="email">
                    </div>
                    <div class="form-group">
                     <label >شماره تلفن :</label>
                     <input type="text" class="form-control" required name="phone">
                  </div> 
                  <div class="form-group">
                     <label >نوع و تعداد دستگاه ها :</label>
                     <textarea class="form-control" rows="4" required name="body"></textarea>
                  </div> 
                  <div class="text-center mt-1 mb-1">
                     <button class="btn btn-primary round-button-com" type="submit" style="width: 120px">ثبت</button>
                </div>
                </form>
            </div>
        </div>

    </div>
<style type="text/css">

        .partners h3 {margin-bottom: 3%;}
        .partners img {height: 80px;}
    .posts {margin-top: 120px;}
    .ContentSmallSize {
    flex: 0 1 calc(30% - 1em);
    text-align: right;
    margin-bottom: 1%;
    background-color: white;
    color: black;
}

.ContentSmallSize:hover {
    top: -2px;
    /*box-shadow: 0 4px 5px rgba(0,0,0,0.2);*/
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}
 .invest-plan {
    -ms-flex-pack: justify!important;
    justify-content: space-between!important;
  }

.invest-comparision img {
    width: 100%; height: auto;
}
.invest-comparision p {margin-top: 60px; text-align: justify;}
@media screen and (max-width: 768px) {
    .ContentSmallSize {
        flex: 0 1 calc(50% - 1em);
    }
}
@media screen and (max-width: 600px) {
    .ContentSmallSize {
        flex: 0 1 calc(100% - 1.5em);
        margin-bottom: 4%;
    }
}
@media screen and (max-width: 420px) {
    .partners img {height: 60px; margin-top: 5px;}
    .invest-comparision p {margin-top: 0px;}
    .ContentSmallSize h3 {
        font-size: 1.3rem;
    }
    .ContentSmallSize p {
        font-size: 1rem;
    }
    .invest-plan {
      justify-content: center!important;
    }
}

.ContentSmallSize figure {
   position: relative;
}
.ContentSmallSize figcaption {
    position: absolute;
    top: 180px;
    color: white;
    background-color: black;
    padding: 4px 8px;
    font-size: 100%;
    font-weight: 400;
}
.ContentSmallSize h3 {
    color: black;
}
.ContentSmallSize span {
    color: #999999;
}
.ContentSmallSize p {
    color: black;
}
.ContentSmallSize div {
    padding: 1% 2%;
}


</style>
    @if(Config::get('app.locale') == 'fa')
    <style type="text/css">
      .invest-plan {
         text-align: right;
      }
      .contact-form {direction: rtl;}
      .our-features img {
        height: 80px;
      }
    </style>
    {{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKHJZWvRnxUssy8NuqB_nuE3bvKkhxHlM&callback=initMap"--}}
            {{--type="text/javascript"></script>--}}
    <script type="text/javascript">
      // console.log("js run");
        var dollarToToman = parseInt({!! $settings->usd_toman !!});
        var sliderValue = {!! \App\Setting::first()->usd_per_hash !!} * dollarToToman;
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value+' Th'; // Display the default slider value
        var cost = document.getElementById("cost"); cost.innerHTML = slider.value * sliderValue ;
        var hashInput = document.getElementById("hash");
//        console.log("slider");console.log(slider.value);
        // hashInput.value = slider.value;
        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
//            console.log("input change");
            output.innerHTML = this.value+' Th';
            cost.innerHTML = slider.value * sliderValue ;
        }
    </script>
    @else
    <style type="text/css">
      .invest-plan {
         text-align: left;
      }

    </style>
    <script type="text/javascript">
      // console.log("js run");
        var sliderValue = {!! \App\Setting::first()->usd_per_hash !!}
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value+' Th'; // Display the default slider value
        var cost = document.getElementById("cost"); cost.innerHTML = slider.value * sliderValue ;
        var hashInput = document.getElementById("hash");
//        console.log("slider");console.log(slider.value);
        // hashInput.value = slider.value;
        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
//            console.log("input change");
            output.innerHTML = this.value+' Th';
            cost.innerHTML = slider.value * sliderValue ;
        }
    </script>
    @endif
    <style type="text/css">
       
        .advantages h2 {margin-bottom: 3%;}
        .advantages-detail h5 {margin-top: 3%;font-size: 1.1rem;}
       /* .advantages-detail {
            margin-top: 3%;
        }*/
         .pace {
  -webkit-pointer-events: none;
  pointer-events: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.pace-inactive {
  display: none;
}

.pace .pace-progress {
  background: #29d;
  position: fixed;
  z-index: 2000;
  top: 0;
  right: 100%;
  width: 100%;
  height: 2px;
}

.pace .pace-progress-inner {
  display: block;
  position: absolute;
  right: 0px;
  width: 100px;
  height: 100%;
  box-shadow: 0 0 10px #29d, 0 0 5px #29d;
  opacity: 1.0;
  -webkit-transform: rotate(3deg) translate(0px, -4px);
  -moz-transform: rotate(3deg) translate(0px, -4px);
  -ms-transform: rotate(3deg) translate(0px, -4px);
  -o-transform: rotate(3deg) translate(0px, -4px);
  transform: rotate(3deg) translate(0px, -4px);
}

.pace .pace-activity {
  display: block;
  position: fixed;
  z-index: 2000;
  top: 15px;
  right: 15px;
  width: 14px;
  height: 14px;
  border: solid 2px transparent;
  border-top-color: #29d;
  border-left-color: #29d;
  border-radius: 10px;
  -webkit-animation: pace-spinner 400ms linear infinite;
  -moz-animation: pace-spinner 400ms linear infinite;
  -ms-animation: pace-spinner 400ms linear infinite;
  -o-animation: pace-spinner 400ms linear infinite;
  animation: pace-spinner 400ms linear infinite;
}

@-webkit-keyframes pace-spinner {
  0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}
@-moz-keyframes pace-spinner {
  0% { -moz-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -moz-transform: rotate(360deg); transform: rotate(360deg); }
}
@-o-keyframes pace-spinner {
  0% { -o-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -o-transform: rotate(360deg); transform: rotate(360deg); }
}
@-ms-keyframes pace-spinner {
  0% { -ms-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -ms-transform: rotate(360deg); transform: rotate(360deg); }
}
@keyframes pace-spinner {
  0% { transform: rotate(0deg); transform: rotate(0deg); }
  100% { transform: rotate(360deg); transform: rotate(360deg); }
}

    </style>
    <!-- <script data-pace-options='{ "ajax": false }' src="{{asset('js/pace.js')}}"></script> -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="{{asset('js/Bazar.js')}}"></script>
    <style type="text/css">
        p {
            margin: 0px;padding: 0px;padding-top: 5px;
        }
    </style>
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <script type="text/javascript">
        function refreshCaptcha(e){
            var element = e;
            axios.get('captcha-refresh').then(function(response){
                element.target.src = response.data

            });
        }

        function btnHidden(e){
            e.target.hidden = true
            e.target.nextElementSibling.hidden = false
        }
        function checkForm() {
            document.getElementById('submit').disabled = true;
        }

        // Get the modal
        var modal = document.getElementById('myModal');

        // blade if for detecting link

        if({!! json_encode(isset($name)) !!}){
            $('#hosting').hide();
            modal.style.display = "block";
        }

        // Get the button that opens the modal
        // var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        // btn.onclick = function() {
            // modal.style.display = "block";
            // window.location.href='http://hashbazaar.com/signup';
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function getDevices(event) {
            $('#welcomeHashBazaar').hide();
            $('#hosting').show();
            modal.style.display = "block";
        }
        // document.getElementById("registerButton").addEventListener("click", registerButtonFunction);
        // function registerButtonFunction() {
        //   console.log("registerButton");
        //   document.getElementById("registerButton").disabled = true;
        // }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131063343-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-131063343-1');
    </script>
    <script>
        $(document).ready(function(){
            // pace options
            // Pace.options = {
            //  ajax: false
            // }
            // Pace.start();

            $('.navigation-menu').click(function(){
                $('#header-navbar-menu').toggle();
                $('.login').show();
                $('.signup').show();
                $('.navigation-menu').toggleClass('change');
            })
        });
    </script>


@endsection
