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
        .copy-right {margin-top: 2%;direction: rtl; font-size: 1rem;}

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
             .copy-right {margin-top: 5%; font-size: 0.8rem;}
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
  <footer class="backgroundMoreGrey pl-5 pr-5">
      <div class="row">
          <div class="followUs col-lg-3 col-md-3 col-sm-12">
             <h6 class="text-center">ما را در شبکه های اجتماعی دنبال کنید</h6>     
             <!-- <div class="network-flex"> -->
                    <div class="d-flex justify-content-around">
                        <a href="https://www.linkedin.com/company/hashbazaar" class="socialnet-flex">
                            <img src="{{URL::asset('img/icons/hashbazaar-linkedin.svg')}}" alt="linkedin"></a>

                        <a href="https://www.instagram.com/hashbazaar/" target="_blank" class="socialnet-flex">
                            <img src="{{URL::asset('img/icons/hashbazaar-instagram.svg')}}" alt="hashbazaar instagram"></a>
      
                        <a href="https://twitter.com/Hashbazaar_CMC" class="socialnet-flex" >
                            <img src="{{URL::asset('img/icons/hashbazaar-twitter.svg')}}" alt="Twitter"></a>
                    </div>
            <!-- </div> -->
          </div>
          <div class="col-lg-4 col-md-5 col-sm-12" style="text-align: right;color: white;">
            <div class="important-links row">
                <div class="col-md-5 col-sm-6" style="display: flex;flex-direction: column;">
                    <a href="{{route('aboutUs',['locale'=>session('locale')])}}">{{__('About')}}</a>
                    <a href="{{route('customerService',['locale'=>session('locale')])}}">{{__('FAQ')}}</a>
                </div>
                <div class="col-md-5 col-sm-6" style="display: flex;flex-direction: column;">
                    <a href="{{route('index',['locale'=>session('locale')])}}">{{__('Home')}}</a>
                    <a href="{{url('/cooperation')}}">همکاری سازمانی</a>
                    <a href="{{route('Blog',['locale'=>session('locale')])}}">{{__('Blog')}}</a>
                </div>
            </div>
          </div>
          <div class="contact-us col-lg-5 col-md-4 col-sm-12" style="text-align: right;">
              <h5 class="text-center">تماس با ما</h5> 
              <div class="tell">
                   <a href="tel:+989371869568" style="color:white; cursor:pointer">
                         0937 186 9568 &nbsp;<i class="fa fa-phone" aria-hidden="true"></i> 
                   </a>
              </div>
              <div class="" style="direction:rtl">
                   <i class="fa fa-map-marker" aria-hidden="true"></i>
                                تهران، میدان ونک، خیابان ملاصدرا، خیابان پردیس، پلاک ۷
               </div>
          </div>
      </div>
      <div class="container text-center copy-right">
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
                                    <a href="tel:+989371869568" style="color:white; cursor:pointer">
                                             0937 186 9568 &nbsp;<i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-7 col-sm-12" style="text-align:right">

                                <div class="" style="direction:rtl">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    تهران، ولنجک، دانشگاه شهید بهشتی، پارک علم و فناوری ، شرکت آوانس
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
