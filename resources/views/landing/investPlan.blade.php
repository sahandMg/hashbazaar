 <section  id="sharePlan" class="backgroundGrey pt-4 pb-4 " style="padding-top: 4%;color: #707070;">
       <div class="text-center mb-4">
            <h3 class="fontTheme">{{__('CHOOSE YOUR INVESTMENT PLAN')}}</h3>
        </div>
        <div class="container" style="direction: rtl;">
          <div class="d-flex flex-wrap invest-plan">
            <!-- <div class="col-md-4 col-sm-12"> -->
              <div class="ContentSmallSize py-2 px-3">
                <h4 class="text-center mb-2">هاستینگ ماینر</h4>
                <h5 class="text-center mb-2">(واگذاری دستگاه)</h5>
                <p style="text-align: justify;">بسته به نوع دستگاه بین 30 تا 40 درصد از درآمد بیت کوین حاصله بابت هاستینگ (هزینه برق، نگهداری و سرویس دستگاه) کسر می شود و مابقی به کیف پول شما واریز می گردد.</p>
                <hr/>
                <p style="text-align: justify;">تفاوت مذکور در مورد درصد کسر شده با توجه به نسبت توان پردازش دستگاه به میزان مصرف برق آن تعیین می گردد.</p>
                <div class="text-center mt-3 mb-1">
                   <button class="btn btn-primary round-button-com" onclick="getDevices(event)"  type="button"  style="width: 120px;background-color: #ff9100;color: white;">واگذاری دستگاه</button>
                </div>
              </div>
            <!-- </div>
            <div class="col-md-4 col-sm-12"> -->
              <div class="ContentSmallSize py-2">
                <h4 class="text-center mb-2">ماینینگ ابری بیت کوین</h4>
                <h5 class="text-center mb-2">طرح کلاسیک</h5>
                <div class="p-3" style="background-color: #ff9100;color: white">
                  <h5 class="text-center"><strong>{{$settings->usd_toman * $settings->usd_per_hash}} تومان</strong></h6>
                </div>
                <h6 class="text-center mt-2">برای هر تراهش</h6>
                <!-- <p class="text-center">1 تراهش = </p> -->
                <hr/>
                <h6 class="text-center mb-2"><a href="#meitenanceFee" class="meitenanceFeeClick" style="color: #ff9100;">هزینه نگهداری</a></h6>
                <div class="p-3" style="background-color: #ff9100;color: white">
                 <!--  <h5 class="text-center"><strong>{{ round($settings->maintenance_fee_per_th_per_day * $settings->usd_toman)}} تومان</strong></h5> -->
                 <h5 class="text-center"><strong>30 درصد درآمد</strong></h5>
                </div>
                <!-- <h6 class="text-center mt-2">برای هر روز به ازای هر تراهش</h6> -->
                <hr/>
                <h6 class="text-center mb-2">مدت قرار داد</h6>
                <!-- <p>:  </p> -->
                <div class="p-3" style="background-color: #ff9100;color: white">
                  <h5 class="text-center"><strong>{{$settings->hash_life}} ماه</strong></h5>
                </div>
                <hr/>
                <p class="px-2">برای سفارش بیش از 100 تراهش به قسمت <a href="{{url('/cooperation')}}" style="color: #ff9100;">همکاری سازمانی سایت</a> مراجعه فرمائید.</p>
                <div class="text-center mt-1 mb-1">
                  <a class="btn btn-primary round-button-com"   href="{{route('signup',['locale'=>session('locale')]).'?plan=classic'}}" style="width: 120px;background-color: #ff9100;color: white;">خرید</a>
                </div>
              </div>
            <!-- </div> -->
            <!-- <div class="col-md-4 col-sm-12"> -->
              <div class="ContentSmallSize py-2">
                <h4 class="text-center mb-2">ماینینگ ابری بیت کوین</h4>
                <h5 class="text-center mb-2">طرح کلاسیک صفر</h5>
                <div class="p-3" style="background-color: #ff9100;color: white">
                  <h5 class="text-center"><strong>{{$settings->usd_toman * $settings->usd_per_hash + round($settings->maintenance_fee_per_th_per_day * $settings->usd_toman * env('contractDays'))}} تومان</strong></h6>
                </div>
                <h6 class="text-center mt-2">برای هر تراهش</h6>
                <hr/>
                <h6 class="text-center mb-2"><a href="#meitenanceFee" class="meitenanceFeeClick" style="color: #ff9100;">هزینه نگهداری</a></h6>
                <div class="p-3" style="background-color: #ff9100;color: white">
                  <h5 class="text-center"><strong>صفر تومان</strong></h5>
                </div>
                <!-- <h6 class="text-center mt-2">برای هر روز به ازای هر تراهش</h6> -->
                <hr/>
                <h6 class="text-center mb-2">مدت قرار داد</h6>
                <div class="p-3" style="background-color: #ff9100;color: white">
                  <h5 class="text-center"><strong>{{$settings->hash_life}} ماه</strong></h5>
                </div>
                <hr/>
                <p class="px-2">برای سفارش بیش از 100 تراهش به قسمت <a href="{{url('/cooperation')}}"  style="color: #ff9100;">همکاری سازمانی سایت</a> مراجعه فرمائید.</p>
                <div class="text-center mt-1 mb-1">
                  <a class="btn btn-primary round-button-com"  href="{{route('signup',['locale'=>session('locale')]).'?plan=classic0'}}" style="width: 120px;background-color: #ff9100;color: white;">خرید</a>
                </div>
              </div>
            <!-- </div> -->
          </div>
        </div>
    </section>