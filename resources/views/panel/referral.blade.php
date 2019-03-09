@extends('panel.master.layout')
@section('title')
    <title>Referrals</title>
@endsection
@section('content')
    <!-- Referral Page -->
    <?php
            $user = Auth::guard('user')->user();

    ?>
    <div id="referral-page" class="panel-container " style="display: flex;flex-direction: column;">
        
        <div class="referral-page_secondList">
            <div class="referral-page_secondList_column">Number of Sharing
                <ul><li>{{$user->referral->total_sharing_num}}</li></ul>
            </div>
            <div class="referral-page_secondList_column">Total Sharing Income (USD)
              <ul><li>$ {{$user->referral->total_sharing_income}}</li></ul>
            </div>
            <div class="referral-page_secondList_column">My Benefit (USD)
                    <ul><li>$ {{$user->referral->user_income_share}}</li></ul>
            </div>
        </div>

        <blockquote>My Referral ID: </blockquote>
        <p class="myReferralId" id="copyTarget">{{$user->code}}
            <a class="coppyIcon" style="cursor: pointer;"><img class="icon" src="../img/Copy.svg" alt=""></a>
        </p>

        <blockquote style="margin-top:0%">My Referral LINK:</blockquote>
        <p class="shareReferralId" id="copyTarget2" style="padding-left:1%"> 
         <a href="{{route('index',['code'=>$user->code])}}">http://hashbazaar.com/share</a>
         <a class="coppyIcon2" style="cursor: pointer;"><img class="icon" src="../img/Copy.svg" alt=""></a>

        </p>

   

   <div class="container yek" style="color: black;margin-top: 50px;margin-bottom:1010px">
         <div class="container" style="max-height: 500px;padding: 0px;min-width: 310px;">
               <div class="row" style="max-width: 300px;margin: auto;">
                <div class="referal-left-text">
                   <h3></h3>
                   <h3>300</h3>
                   <h3>200</h3>
                   <h3>100</h3>
                </div>
                <div class="referal">
                  <div class="referal-level referal-level-4">
                  </div>
                  <div class="referal-level referal-level-3">
                  </div>
                  <div class="referal-level referal-level-2">
                  </div>
                  <div class="referal-level referal-level-1">
                  </div>
                </div>
                <div class="horizontal-lines-container">
                   <span class="referal-percent referal-percent-1">3%</span>
                   <div class="line line-vertical-1"></div>
                   <span class="referal-percent referal-percent-2">2%</span>
                   <div class="line line-vertical-2"></div>
                   <span class="referal-percent referal-percent-3">1.5%</span>
                   <div class="line line-vertical-3"></div>
                   <span class="referal-percent referal-percent-4">1%</span>
                   <div class="line line-vertical-4"></div>
                </div>
                <div  class="circle-output-container">
                  <div class="circle circle-1">
                     <h3 class="text-center">30TH</h3>
                  </div>
                  <div class="circle circle-2">
                     <h3 class="text-center">20TH</h3>
                  </div>
                  <div class="circle circle-3">
                     <h3 class="text-center">15TH</h3>
                  </div>
                  <div class="circle circle-4">
                     <h3 class="text-center">10TH</h3>
                  </div>
                </div>
               </div>
          
               
             </div>
          {{-- <div class="container" style="max-height: 500px;padding: 0px;">
               <div class="row" style="max-width: 300px;margin: auto;">
                <div class="referal-left-text">
                   <h3></h3>
                   <h3>300</h3>
                   <h3>200</h3>
                   <h3>100</h3>
                </div>
                <div class="referal">
                  <div class="referal-level referal-level-4">
                  </div>
                  <div class="referal-level referal-level-3">
                  </div>
                  <div class="referal-level referal-level-2">
                  </div>
                  <div class="referal-level referal-level-1">
                  </div>
                </div>
                <div class="horizontal-lines-container">
                   <span class="referal-percent referal-percent-1">3%</span>
                   <div class="line line-vertical-1"></div>
                   <span class="referal-percent referal-percent-2">2%</span>
                   <div class="line line-vertical-2"></div>
                   <span class="referal-percent referal-percent-3">1.5%</span>
                   <div class="line line-vertical-3"></div>
                   <span class="referal-percent referal-percent-4">1%</span>
                   <div class="line line-vertical-4"></div>
                </div>
                <div  class="circle-output-container">
                  <div class="circle circle-1">
                     <h3 class="text-center">30TH</h3>
                  </div>
                  <div class="circle circle-2">
                     <h3 class="text-center">20TH</h3>
                  </div>
                  <div class="circle circle-3">
                     <h3 class="text-center">15TH</h3>
                  </div>
                  <div class="circle circle-4">
                     <h3 class="text-center">10TH</h3>
                  </div>
                </div>
               </div>
             </div>  --}}
             <br/>

         <p>You can join our affiliate program through different ways. Share your dedicated referral code or link wherever you want.</p>
         <p>Your referral will get a 5% discount on their first purchase, and you will get a free hashpower upgrade as your affiliate reward from Hashbazaar depend on your level as the following table.</p>
         

         <table class="table table-bordered text-center">
            <thead style="font-weight:bold">
               <tr>
                  <th>Total number of referrals</th>
                  <th rowspan="2" class="text-center">Referral group</th>
                  <th>Your affiliate reward</th>
               </tr>
      
               <tr>
                  <th>Total Number of people used your referral code or link</th>
                  <th>% of referrals first order</th>
               </tr>
            </thead>
      
            <tbody class="text-center" style="font-family:sans-serif">
               <tr>
                  <td>0 <     < 500 </td>
                  <td>C</td>
                  <td>1%</td>
               </tr>
      
               <tr>
                  <td>500 <   < 100 </td>
                  <td>B</td>
                  <td>2%</td>
               </tr>
      
               <tr>
                  <td>1K <    < 10K</td>
                  <td>A</td>
                  <td>3%</td>
               </tr>
      
               <tr>
                  <td>10K <    < 100K </td>
                  <td>A+</td>
                  <td>4%</td>
               </tr>
      
               <tr>
                  <td>100K <    < 1M</td>
                  <td>A++</td>
                  <td>5%</td>
               </tr>
      
               <tr>
                  <td>< 1M</td>
                  <td>A++</td>
                  <td>10%</td>
               </tr>
            </tbody>
         </table>
      
         
         <p>For instance if you reach 100 referrals you will get 1% of total hash power that is purchased by them as your referral group “C”.</p>
         <p>If you reach 500 from now on your affiliate reward will be increased to 2%. In other words if you reach for instance 800 referrals, you will get 1% of total hash power that is purchased by 500 referrals from group “c”  and 2% of total hash power that is purchased by 300 referrals from group “B”. </p>
         <p>Note that all the affiliate rewards will be given by Hashbazaar to our promoters to encourage others to join the future of cryptocurrency transaction system and also gain profit from their investment.</p>
      </div>

</div>


   

    <script>// ------------user account--------------------
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list1').toggle(500);
            })
        })
            
         console.log("copy Target 1 *******")
         $( ".coppyIcon" ).click(function() {
            console.log("coppyIcon click");
            alertify.success('Referral Code Copy To Clipboard');
            copyToClipboard(document.getElementById("copyTarget"));
         });

         console.log("copy Target 1  *******")
         $( ".coppyIcon2" ).click(function() {
            console.log("coppyIcon2 click");
            alertify.success('Referral LINK Copy To Clipboard');
            copyToClipboard(document.getElementById("copyTarget2"));
         });
      function copyToClipboard(elem) {
            // create hidden text element, if it doesn't already exist
         var targetId = "_hiddenCopyText_";
         var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
         var origSelectionStart, origSelectionEnd;
         if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
         } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                  var target = document.createElement("textarea");
                  target.style.position = "absolute";
                  target.style.left = "-9999px";
                  target.style.top = "0";
                  target.id = targetId;
                  document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
         }
         // select the content
         var currentFocus = document.activeElement;
         target.focus();
         target.setSelectionRange(0, target.value.length);
         
         // copy the selection
         var succeed;
         try {
               succeed = document.execCommand("copy");
         } catch(e) {
            succeed = false;
         }
         // restore original focus
         if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
         }
         
         if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
         } else {
            // clear temporary content
            target.textContent = "";
         }
         return succeed;
      }
        
         // =---------------------------------------</script>

          <style type="text/css">
          .icon {
            width: 35px;
            height: 35px;
            margin-top: -10px;
            padding: 5px;
         }
       .circle-output-container {
        display: flex;
        flex-direction: column; 
       }
       .vertical-line  {
          height: 2px;
          background-color: black;
          -ms-transform: rotate(90deg); /* IE 9 */
          -webkit-transform: rotate(90deg); /* Safari */
          transform: rotate(90deg); /* Standard syntax */
          margin-left: -50px;
       }
       .line-top-1 {
          margin-top: 99px;
          width: 100px;
          /*background-color: red;*/
       }
       .line-top-2 {
          margin-top: 73px;
          width: 50px;
          margin-left: -25px;
          /*background-color: blue;*/
       }
       .line-top-3 {
          margin-top: 48px;
          width: 50px;
          margin-left: -25px;
          /*background-color: black;*/
       }
       .line-top-4 {
          margin-top: 72.5px;
          width: 100px;
          /*background-color: green;*/
       }
       .line-top-5 {
          height: 2px;
          background-color: black;
          width: 30px;
          margin-top: -100px;
       }
      .horizontal-lines-container {
        width: 80px;
        display: flex;
        flex-direction: column; 
        text-align: center;
      }
      .referal-percent {
        margin-top: 25px;
        /*margin-left: 5px;*/
      }
      .line{
        width: 80px;
        background-color: #707070;
        /*margin-top: 49px;*/
        margin-bottom: 49px;
        height: 2px;
      }
      .circle {
        width: 70px;
        height: 70px;
        border-radius: 35px;
        border: #707070 1px solid;
        margin-top: 16px;
        margin-bottom: 14px;
        margin-left: -1px;
        color: #707070;
      }
      .circle h3 {
        margin-top: 20px;
        font-size: 1.2rem;
      } 
      .referal-left-text {
          display: flex;
          flex-direction: column;
          padding-right: 4px;
          text-align: right;
       }
       .referal-left-text h3 {
         margin: 0px; padding: 0px;font-size: 1rem;
         margin-bottom: 85.5px;
         color: black;
       }
      .referal-level {
        height: 100px;
        width: 100px;
        text-align: center;
      }
     .referal-level h3 {
        font-size: 1.1rem;
     }
     .referal {
        display: flex;
        flex-direction: column;
        border-bottom: black 1px solid;
        border-left: black 1px solid;
        border-right: black 1px solid;
        width: 105px;
        padding: 1.5px;
     }
     .referal-level-4 {
        /*background-color: green;*/
     }
     .referal-level-3 {
        /*background-color: blue;*/
     }
     .referal-level-2 {
        /*background-color: brown;*/
     }
     .referal-level-1 {
        /*background-color: yellow;*/
     }
   </style>
   <script type="text/javascript">
     var referalPeople = 0 ;
     var allTerraHash = 0 ;
     var heightEachLevel = 100 ;
     var level1 = 100;
     var level2 = 200;
     var level3 = 300;
     var level4 = 400;
     var offsetForDiv = 30;
     var calculateMargin;
     var height; var offsetForDivTemp;
     
     $(".btn-plus").click(function(){
        referalPeople = referalPeople + 10;
        refresh();
      });
     $(".btn-mines").click(function(){
        referalPeople = referalPeople - 1;
        refresh();
      });

     function refresh() {
      $(".referal-level").empty();
      if(referalPeople <= level1) {
       if(referalPeople < 30) {
        calculateMargin = level1 - (referalPeople+offsetForDiv) ;
        } else { calculateMargin = level1 - (referalPeople) ;  }
       height = heightEachLevel - calculateMargin;
       $(".referal-level-1").append(`<div class="referal-number"><h3>`+referalPeople+`, `+allTerraHash+`TH</h3><div>`);
       $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
       $(".referal-number").css('background-color', '#FFEC19');
       $(".line-vertical-4").css('background-color', '#FFEC19');
       $(".line-top-4").css('background-color', '#FFEC19');
       $(".line-top-3").css('background-color', '#FFEC19');
       $(".line-top-5").css('background-color', '#FFEC19');
       $(".circle-4").css("border", "#FFEC19 solid 2px"); 
       $(".circle-4").css("color", "black"); 
       $(".referal-percent-4").css("color", "black"); 
       $(".referal-percent-4").css("font-weight", "700");
      } else if( referalPeople <= level2) {
       if(referalPeople < 30+level1) {
        calculateMargin = level2 - (referalPeople+offsetForDiv) ;
       } else { calculateMargin = level2 - (referalPeople) ;  }
       height = heightEachLevel - calculateMargin;
       $(".referal-level-1").css('background-color', '#FFEC19');
       $(".referal-level-2").append(`<div class="referal-number"><h3>`+referalPeople+`, `+allTerraHash+`TH</h3><div>`);
       $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
       $(".referal-number").css('background-color', '#FFC100');
       $(".line-vertical-3").css('background-color', '#FFC100');
       $(".line-top-3").css('background-color', '#FFC100');
       $(".line-top-5").css('background-color', '#FFC100');
       $(".circle-3").css("border", "#FFC100 solid 2px"); 
       $(".circle-3").css("color", "black"); 
       $(".referal-percent-3").css("color", "black"); 
       $(".referal-percent-3").css("font-weight", "700");
      } else if( referalPeople <= level3) {
       if(referalPeople < 30+level2) {
        calculateMargin = level3 - (referalPeople+offsetForDiv) ;
       } else { calculateMargin = level3 - (referalPeople) ;  }
       height = heightEachLevel - calculateMargin;
       $(".referal-level-1").css('background-color', '#FFEC19');
       $(".referal-level-2").css('background-color', '#FFC100');
       $(".referal-level-3").append(`<div class="referal-number"><h3>`+referalPeople+`, `+allTerraHash+`TH</h3><div>`);
       $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
       $(".referal-number").css('background-color', '#FF9800');
       $(".line-vertical-2").css('background-color', '#FF9800');
       $(".line-top-2").css('background-color', '#FF9800');
       $(".line-top-5").css('background-color', '#FF9800');
       $(".circle-2").css("border", "#FF9800 solid 2px"); 
       $(".circle-2").css("color", "black"); 
       $(".referal-percent-2").css("color", "black");
       $(".referal-percent-2").css("font-weight", "700");
      } else {
       $(".referal-level-1").css('background-color', '#FFEC19');
       $(".referal-level-2").css('background-color', '#FFC100');
       $(".referal-level-3").css('background-color', '#FF9800');
       $(".referal-level-4").append(`<div class="referal-number"><h3>`+referalPeople+`, `+allTerraHash+`TH</h3><div>`);
       $(".referal-number").css( { marginTop : 30+"px", 'height': "70px"} );
       $(".referal-number").css('background-color', '#FF5607');
       $(".line-vertical-1").css('background-color', '#FF5607');
       $(".line-top-1").css('background-color', '#FF5607');
       $(".line-top-2").css('background-color', '#FF5607');
       $(".line-top-5").css('background-color', '#FF5607');
       $(".circle-1").css("border", "#FF5607 solid 2px"); 
       $(".circle-1").css("color", "black"); 
       $(".referal-percent-1").css("color", "black"); 
       $(".referal-percent-1").css("font-weight", "700");
      }
     }
     refresh();

   </script>
@endsection