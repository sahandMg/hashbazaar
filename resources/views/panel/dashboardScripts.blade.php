<script type="text/javascript">
     var user = {!! json_encode(\Illuminate\Support\Facades\Auth::guard('user')->user()->code) !!};
	 axios.post({!! json_encode(route('totalEarn',['locale'=>session('locale')])) !!},{'user':user}).then(function (response) {
	 	           console.log("total earn axios");
	 	           console.log(response);
                    $('.ajax-loader').hide();
                    if(response.data[0] == 0){
                        document.getElementById('miningBTC').innerHTML = 0;
                        document.getElementById('miningDollar').innerHTML = 0;
                        document.getElementById('miningBTC2').innerHTML = 0;
                        document.getElementById('miningDollar2').innerHTML = 0;
                    } else {
                      var miningBTC = response.data[0].toFixed(8);
                      var miningDollar = response.data[1].toFixed(8);
                      var userPendingBtc = response.data[2].toFixed(8);
                      var userPendingUsd = userPendingBtc * miningDollar/miningBTC;
                        document.getElementById('miningBTC').innerHTML = miningBTC;
                        document.getElementById('miningDollar').innerHTML = miningDollar;
                        document.getElementById('miningBTC2').innerHTML = userPendingBtc;
                        document.getElementById('miningDollar2').innerHTML = userPendingUsd.toFixed(8);
                        var minimum_redeem = {!! json_encode($settings->minimum_redeem) !!}
                        if(response.data[0] >= minimum_redeem){
                            // document.getElementById('redeem').disabled = false;
                        }
                    }
     });
</script>
<!-- buy hash power part -->
<script type="text/javascript">

    function order(){
        document.getElementById('orderBtn').disabled = true
    }
  // console.log("**** price toman *******");
  var dollarToToman = parseInt({!! $settings->usd_toman !!});
  // console.log(dollarToToman);
   // // ------------ scroll for many data in table  --------------------
                $(document).ready(function(){
                    $('.user-img').click(function(){
                        $('.list1').toggle(500);
                    });
                    var numItems = $('.Hash-History .table tr').length;
                    if( numItems > 3)
                    {
                        $('.Hash-History').css('overflow-y' , "scroll");
//                    console.log("numItems > 3");
                    } else {
                        $('.Hash-History').css('overflow-y' , "hidden");
//                        console.log("numItems < 3");
                    }
                });
                // for get profit
                var user = {!! json_encode(\Illuminate\Support\Facades\Auth::guard('user')->user()->code) !!}
                function redeem(id) {
                    axios.get('{{route('redeem',['locale'=>session('locale')])}}'+'?user='+user).then(function (response) {
//                        console.log(response.data)
                    })
                };
                 // referal code
                var activateDiscount = {!! $apply_discount !!};// $apply_discount == 0 Or 1
                var discount = {!! $discount !!}
                var thPrice = {!! $settings->usd_per_hash !!};
                var thPriceAfterCode ;
                var slider = document.getElementById("myRange");
//                console.log("*******slider*********");console.log(slider);
                var hiddenRange = document.getElementById("hiddenRange");
                hiddenRange.value = slider.value;
                var output = document.getElementById("demo");
                var costAfterCode = document.getElementById("doReferalCode");
                var cost = document.getElementById('cost');
                var resp = [];
                // for checking referal code
                function sendCode() {
                    var code = document.getElementById('referralCode').value;
                    document.getElementById('code').disabled = true;
                    axios.post('{{route('SendCode',['locale'=>session('locale')])}}',{referralCode:code}).then(function (response) {
                         resp = response.data;
                        if(resp['type'] == 'error'){
                            alertify.error(resp['body']);
                            $('#doReferalCode').hide()
                        }else{
                            alertify.success(resp['body']);
                            document.getElementById('hiddenCodeValue').value = code;
                            document.getElementById('discount').value = resp['discount'];
                            thPriceAfterCode = dollarToToman * {!! $settings->usd_per_hash !!} *  (1 - resp['discount'] );
                            costAfterCode.innerHTML =   " - "+ (slider.value * (thPrice-thPriceAfterCode ) ) + " dollar" + " = " +(slider.value * thPriceAfterCode) + "dollar" ;
//                            console.log(thPrice);
                            activateDiscount = 1;
                            $('#doReferalCode').show()
                        }
                    });
                };
                var planType = {!! Auth::guard('user')->user()->plan->id!!}
                output.innerHTML = slider.value+' Th';
                if(planType == 3){
                    cost.innerHTML = dollarToToman * slider.value * thPrice + parseInt({!! $settings->maintenance_fee_per_th_per_day*$settings->usd_toman * env('contractDays') !!});
                }else if(planType == 2){
                    cost.innerHTML = dollarToToman * slider.value * thPrice
                }
                    if(activateDiscount == 1){
                        $('#doReferalCode').show()
                        // check if custom code applied or not
                        if({!! json_encode($discount == 0) !!}){
                            thPriceAfterCode = dollarToToman * {!! $settings->usd_per_hash !!} * (1 - resp['discount'] );
                            costAfterCode.innerHTML =   " - "+ (dollarToToman * slider.value * (thPrice-thPriceAfterCode) ) + " dollar" + " = " +(dollarToToman * slider.value * thPriceAfterCode) + "dollar" ;

                        }else{
                            thPriceAfterCode = {!! $settings->usd_per_hash * (1 - $discount) !!};
                            costAfterCode.innerHTML =   " - "+ (dollarToToman * slider.value * (thPrice-thPriceAfterCode) ) + " dollar" + " = " +(dollarToToman * slider.value * thPriceAfterCode) + "dollar" ;
                        }
                    }
                    else
                    $('#doReferalCode').hide()

                    // Display the default slider value
//                console.log(document.getElementById('discount').value)
                    slider.oninput = function() {
//                        console.log(resp)
                        refershThPrice();
                     };

                     function refershThPrice() {
                      hiddenRange.value = slider.value; //this.value;
                        output.innerHTML = slider.value+' Th'; //this.value+' Th';
                        if(activateDiscount == 1){

                            if({!! json_encode($discount == 0) !!}){

                                thPriceAfterCode = dollarToToman *  {!! $settings->usd_per_hash !!} *  (1 - resp['discount'] );;
                                costAfterCode.innerHTML =   " - "+ (dollarToToman * slider.value * (thPrice-thPriceAfterCode) ) + " dollar" + " = " +( dollarToToman * slider.value * thPriceAfterCode) + "dollar" ;

                            } else {

                                thPriceAfterCode = dollarToToman * {!! $settings->usd_per_hash * (1 - $discount) !!};
                                costAfterCode.innerHTML =   " - "+ (dollarToToman * slider.value * (thPrice-thPriceAfterCode) ) + " dollar" + " = " +(dollarToToman * slider.value * thPriceAfterCode) + "dollar" ;
                            }

                        }
                        if(planType == 3){
                            cost.innerHTML = dollarToToman * slider.value * thPrice + parseInt({!! $settings->maintenance_fee_per_th_per_day*$settings->usd_toman * env('contractDays') !!});
                        }else if(planType == 2){
                            cost.innerHTML = dollarToToman * slider.value * thPrice
                        }
                     }

            
	 // for chossing plan
        $('.planClassic').show();
        $('.planClassicZero').hide();
        $('#planClassicBtn').addClass('borderBottom');
        $('#planClassicZeroBtn').removeClass('borderBottom');
        $('#plankind').val(1); // one for plan classic
        console.log("thprice");console.log(thPrice);
       $('#planClassicBtn').click(function () {
         console.log("planClassicBtn");
         $('.planClassic').show();
         $('.planClassicZero').hide();
         $('#planClassicBtn').addClass('borderBottom');
         $('#planClassicZeroBtn').removeClass('borderBottom');
         $('#plankind').val(1);// one for plan classic
         thPrice = 70;
         refershThPrice();
      });

      $('#planClassicZeroBtn').click(function () {
        console.log("planClassicZeroBtn");
        $('.planClassicZero').show();
        $('.planClassic').hide();
        $('#planClassicZeroBtn').addClass('borderBottom');
        $('#planClassicBtn').removeClass('borderBottom');
        $('#plankind').val(2);// one for plan classic
        thPrice = 104;
        refershThPrice();
      });
</script>
<!-- for charts  -->
<script type="text/javascript">
	         var dateFormat = 'YYYY DD MMMM';
                // var date = moment('April 01 2017', dateFormat);
                var dateTime = [];
                var data = [];
                var labels = [];
            axios.get('{{route('chartData',['locale'=>session('locale')]).'?user='. Auth::guard('user')->user()->code}}').then(function (response) {

                console.log("chart data axios");
                console.log(response);
                dateTime = response.data;
                var timeLabels= [];
                var data= [];
                if(dateTime !== 404){
                  if(window.innerWidth > 500){
                    for(i=0 ; i < dateTime.length ; i++){
                        timeLabels.push(dateTime[i].time);
                        data.push(dateTime[i].mined);
                    }
                  } else {
//                    console.log("window.innerWidth : "+window.innerWidth)
                    for(i=0 ; i < dateTime.length ; i++){
                        if( i%5 ===0) {
                          timeLabels.push(dateTime[i].time);
                        } else {
                          timeLabels.push("");
                        }
                        data.push(dateTime[i].mined);
                    }
                  }
                }
                var data2D = [];data2D.push(data);
                new Chartist.Line('.ct-chart', {
                  labels: timeLabels,
                   series: data2D
                }, {
                    low: 0,
                    showArea: true
                });
            });
</script>