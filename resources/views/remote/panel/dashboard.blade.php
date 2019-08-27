@extends('remote.layout')
@section('content')

    
<div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-select-all"></i>
                                            </div>
                                            <div class="text">
                                                <h2>112</h2>
                                                <span>تعداد دستگاه ها</span>
                                            </div>
                                        </div>
                                        <br/>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-receipt"></i>
                                            </div>
                                            <div class="text">
                                                <h2>121.5 TH</h2>
                                                <span>مجموع کل نرخ هش</span>
                                            </div>
                                        </div>
                                        <br/>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2>105</h2>
                                                <span>تعداد دستگاه های فعال</span>
                                            </div>
                                        </div>
                                        <br/>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <!-- <i class="fa fa-address-book"></i> -->
                                                <img src="{{URL::asset('remoteDashboard/images/bitcoin.svg')}}" style="height: 60px;">
                                            </div>
                                            <div class="text">
                                                <h2 style="direction: rtl;">10250 دلار</h2>
                                                <span>قیمت بیت کوین</span>
                                            </div>
                                        </div>
                                        <br/>
                                        <!-- <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

   <br/>
   <div class="au-card text-right" style="direction: rtl;">
     <h3>با دادن اطلاعان Pool ، API خود می توانید وضعیت استخراج را در این جا مشاهد کنید و همچنین در صورت قطع شدن ماینرها، ایمیل و پیامک هشدار دریافت کنید.</h3>
     <br/>
     <div class="form-group text-center col-lg-3 col-md-4 col-sm-10 mx-auto">
       <label for="sel1">انتخاب POOL</label>
       <select class="form-control" id="selectPool">
         <option value="Antpool">Antpool</option>
         <option value="F2Pool">F2Pool</option>
         <option value="SlushPool">SlushPool</option>
       </select>
     </div>
     <hr/>
     <div id="Antpool">
        <form class="poolForm col-lg-4 col-md-5 col-sm-11 mx-auto">
          <div class="form-group">
           <label>user id:</label>
           <input type="text" class="form-control">
          </div>
          <div class="form-group">
           <label>API key:</label>
           <input type="text" class="form-control">
          </div>
          <div class="form-group">
           <label>nonce:</label>
           <input type="text" class="form-control">
          </div>
          <div class="form-group">
           <label>secret:</label>
           <input type="text" class="form-control">
          </div>
          <div class="text-center"> 
            <button class="btn btn-success">ثبت</button>
          </div>
        </form>
     </div>
     <div id="F2Pool">
        <form class="poolForm col-lg-4 col-md-5 col-sm-11 mx-auto">
          <div class="form-group">
           <label>user name:</label>
           <input type="text" class="form-control">
          </div>
          <div class="text-center"> 
            <button class="btn btn-success">ثبت</button>
          </div>
        </form>
     </div>
     <div id="SlushPool">
        <form class="poolForm col-lg-4 col-md-5 col-sm-11 mx-auto">
          <div class="form-group">
           <label>Token:</label>
           <input type="text" class="form-control">
          </div>
          <div class="text-center"> 
            <button class="btn btn-success">ثبت</button>
          </div>
        </form>
     </div>
   </div>
   <br/><br/><br/>
<style type="text/css">
  .poolForm {
     
  }
</style>

   @include('remote/scripts')
   <script type="text/javascript">
     function hideAllForms() {
      $('#Antpool').hide();$('#F2Pool').hide();$('#SlushPool').hide();
     }

var selectPool = document.getElementById("selectPool");

// activities.addEventListener("click", function() {
//     var options = activities.querySelectorAll("option");
//     var count = options.length;
//     if(typeof(count) === "undefined" || count < 2)
//     {
//         addActivityItem();
//     }
// });
hideAllForms();
$('#Antpool').show();

selectPool.addEventListener("change", function() {
  // console.log("")
  hideAllForms();
  $('#'+selectPool.value).show();
});
      
   </script>
@endsection