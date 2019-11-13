@if(Config::get('app.locale') == 'fa')
    <style>
        .footerrow {
            font-size: 1.6rem
        }
        .followUs img {
            height: 60px;

        }
        .followUs div {
            margin-top: 5%;
        }

        footer a {
            color: white;
        }
        .copy-right {padding: 1% 0;direction: rtl; font-size: 1rem;}

        @media screen and (max-width:769px){
          .followUs img {
            height: 40px;
           }
           .followUs h6 {
             font-size: 0.8rem;
           }
        }
        @media screen and (max-width:420px){
            .footerrow {
                font-size: 1.2rem
            }

            .ctr {
                margin-bottom: 5%
            }

             .tell {
                 text-align: center;

             }
             .copy-right {padding: 3% 0; font-size: 0.8rem;}
             .contact-us {margin-top: 5%;}
             .important-links div{
                width: 50%;text-align: center;
             }
             .important-links { margin-top: 5%; }
             .followUs div a {
                width: 33%;
              }
        }
    </style>
@endif
@if(Config::get('app.locale') == 'fa')
  <footer class="backgroundMoreGrey" style="padding: 0px;">
    <div class="container">
      <div class="row pt-2">
          <div class="col-lg-5 col-md-5 col-sm-12 my-3">
             <h5 class="text-center my-1">درباره ما</h5> 
             <p style="direction: rtl;text-align: justify;">هش بازار سرویس ارائه خدمات ماینینگ ابری ( ماینینگ از راه دور ) است که کاربران آن قادرند بدون درگیری با چالش هایی نظیر هزینه های فرآیند واردات تجهیزات، تاخیرهای زمانی دریافت تجهیزات، راه اندازی سخت افزار، صدای سرسام آور ماینینگ، گرمای قابل توجه ایجاد شده در اطراف تجهیزات و همچنین کندی، خرابی یا از کار افتادن دستگاه های ماینینگ، در صنعت ماینینگ وارد شوند و شروع به ماین کردن نمایند.</p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 my-3" style="text-align: right;color: white;">
            <h5 class="text-center my-1">لینک های مهم</h5> 
            <div class="important-links row">
                <div class="col-md-5 col-sm-6 text-center" style="display: flex;flex-direction: column;">
                    <a href="{{route('aboutUs',['locale'=>session('locale')])}}">{{__('About')}}</a>
                    <hr style="border-top: 1px solid #ff9100;margin-bottom: 0.5rem;margin-top: 0.5rem;"/>
                    <a href="{{route('customerService',['locale'=>session('locale')])}}">{{__('FAQ')}}</a>
                    <hr style="border-top: 1px solid #ff9100;margin-bottom: 0.5rem;margin-top: 0.5rem;"/>
                    <a href="https://farmyarapp.ir/landing/">فارم یار</a>
                </div>
                <div class="col-md-5 col-sm-6 text-center" style="display: flex;flex-direction: column;">
                    <a href="{{route('index',['locale'=>session('locale')])}}">{{__('Home')}}</a>
                    <hr style="border-top: 1px solid #ff9100;margin-bottom: 0.5rem;margin-top: 0.5rem;"/>
                    <a href="{{url('/cooperation')}}">همکاری سازمانی</a>
                    <hr style="border-top: 1px solid #ff9100;margin-bottom: 0.5rem;margin-top: 0.5rem;"/>
                    <a href="{{route('Blog',['locale'=>session('locale')])}}">{{__('Blog')}}</a>
                </div>
            </div>
          </div>
          <div class="contact-us col-lg-3 col-md-3 col-sm-12 my-3" style="text-align: right;">
              <h5 class="text-center my-1">تماس با ما</h5> 
              <div class="tell">
                  <a href="tel:+{{env('Phone_Number')}}" style="color:white; cursor:pointer">
                      {{env('Phone_Number')}} &nbsp;<i class="fa fa-phone" aria-hidden="true"></i>
                  </a>
              </div>
              <div class="" style="direction:rtl">
                   <i class="fa fa-map-marker" aria-hidden="true"></i>
                                تهران، ولنجک، دانشگاه شهید بهشتی، پارک علم و فناوری ، شرکت هش بازار
               </div>
          </div>
      </div>
     </div> 
       <h6 class="text-center my-2">ما را در شبکه های اجتماعی دنبال کنید</h6> 
       <div class="d-flex justify-content-around mx-auto col-lg-2 col-md-3 col-sm-6 mt-1">
          <a href="https://www.linkedin.com/company/hashbazaar" class="socialnet-flex">
             <img src="{{URL::asset('img/icons/hashbazaar-linkedin.svg')}}" alt="linkedin" style="height: 40px;">
          </a>
          <a href="https://www.instagram.com/hashbazaar/" target="_blank" class="socialnet-flex">
             <img src="{{URL::asset('img/icons/hashbazaar-instagram.svg')}}" alt="hashbazaar instagram" style="height: 40px;">
           </a>
          <a href="https://twitter.com/Hashbazaar_CMC" class="socialnet-flex" >
             <img src="{{URL::asset('img/icons/hashbazaar-twitter.svg')}}" alt="Twitter" style="height: 40px;">
          </a>
      </div>
      <div class="text-center copy-right mt-2" style="background-color: black;">
         <p>تمام حقوق مادی و معنوی آثار متعلق به هش بازار می باشد.</p>
      </div>
  </footer>
@else
<footer class="backgroundMoreGrey">
        @if(Config::get('app.locale') == 'fa')
            <div class="container ctr">
                    <div class="row footerrow">
                            <div class="col-md-5 col-sm-12">
                                <div class="tell">
                                    <a href="tel:+{{env('Phone_Number')}}" style="color:white; cursor:pointer">
                                        {{env('Phone_Number')}} &nbsp;<i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-7 col-sm-12" style="text-align:right">

                                <div class="" style="direction:rtl">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    تهران، ولنجک، دانشگاه شهید بهشتی، پارک علم و فناوری ، شرکت هش بازار
                                </div>
                            </div>
                    </div>
            </div>
        @endif
    <div class="container text-center" style="margin-top: 2%;">
        <p>© 2018 HashBazaar. All rights reserved</p>
    </div>
    <div class="network-flex">
        <ul>
        	                <li><a href="https://www.linkedin.com/company/hashbazaar" class="socialnet-flex">
                                <img src="{{URL::asset('img/icons/hashbazaar-linkedin.svg')}}" alt="linkedin">
                                </a></li>

                            <li> <a href="https://www.instagram.com/hashbazaar/" target="_blank" class="socialnet-flex">
                                <img src="{{URL::asset('img/icons/hashbazaar-instagram.svg')}}" alt="hashbazaar instagram">
                                </a> </li>
      
						    <li><a href="https://twitter.com/Hashbazaar_CMC" class="socialnet-flex" >
                                <img src="{{URL::asset('img/icons/hashbazaar-twitter.svg')}}" alt="Twitter">
                                </a></li>
        </ul>
    </div>   
</footer>
@endif
