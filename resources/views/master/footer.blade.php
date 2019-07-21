

@if(Config::get('app.locale') == 'fa')
<style>
    .footerrow {
        font-size: 1.6rem
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
    }
</style>
@endif

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

                                تهران، میدان ونک، خیابان ملاصدرا، خیابان پردیس، پلاک ۷
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
                                <img src="{{URL::asset('img/icons/linkedin.png')}}" alt="linkedin"></a></li>

                            <li> <a href="https://www.instagram.com/hashbazaar/" target="_blank" class="socialnet-flex">
                                <img src="{{URL::asset('img/icons/insta.svg')}}" alt="hashbazaar instagram"></a> </li>
      
						    <li><a href="https://twitter.com/Hashbazaar_CMC" class="socialnet-flex" >
                                <img src="{{URL::asset('img/icons/tweet.svg')}}" alt="Twitter"></a></li>
        </ul>
    </div>   
</footer>

