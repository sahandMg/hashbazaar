@extends('panel.master.layout')
@section('title')
    <title>Referrals</title>
@endsection
@section('content')
    
    <?php
            $user = Auth::guard('user')->user();

    ?>
<!-- Referral Page -->
<div id="referral-page" class="panel-container">
        
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

   <div class="ref-flex">
      <blockquote style="margin-top:0%">My Referral LINK: </blockquote>
      <p class="shareReferralId" id="copyTarget2" style="padding-left:1%"> 
         <a href="{{route('index',['code'=>$user->code])}}">{{route('index',['code'=>$user->code])}}</a>
         <a class="coppyIcon2" style="cursor: pointer;"><img class="icon" src="../img/Copy.svg" alt=""></a>
      </p>
   </div>

   <div class="container yek" style="color: black;margin-top: 50px;">
      <br/>
      <p>You can join our affiliate program through different ways. Share your dedicated referral code or link wherever you want.</p>
      <p>Your referral will get a 3% discount on their first purchase, and you will get a free hashpower upgrade as your affiliate reward from Hashbazaar depend on your level as the following table.</p>
   
      <table class="table table-bordered text-center">
         <thead>
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
               <td>2.5%</td>
            </tr>

            <tr>
               <td>500 <   < 100 </td>
               <td>B</td>
               <td>3.5%</td>
            </tr>

            <tr>
               <td>1K <    < 10K</td>
               <td>A</td>
               <td>4.5%</td>
            </tr>

            <tr>
               <td>10K <    < 100K </td>
               <td>A+</td>
               <td>5.5%</td>
            </tr>

            <tr>
               <td>100K <    </td>
               <td>A++</td>
               <td>6.5%</td>
            </tr>
         </tbody>
      </table>

      <p>For instance if you reach 100 referrals you will get 2.5% of total hash power that is purchased by them as your referral group “C”.</p>
      <p>If you reach 500 from now on your affiliate reward will be increased to 3.5%. In other words if you reach for instance 800 referrals, you will get 2.5% of total hash power that is purchased by 500 referrals from group “C”  and 3.5% of total hash power that is purchased by 300 referrals from group “B”. </p>
      <p>Note that all the affiliate rewards will be given by Hashbazaar to our promoters to encourage others to join the future of cryptocurrency transaction system and also gain profit from their investment.</p>
   </div>

</div>
   

<script>
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
        
</script>

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
       .circle-output-container p {margin: 0px;padding: 0;font-size: 20px;}
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
        margin-top: 0px;
        margin-bottom: 0px;
        margin-left: -1px;
        color: #707070;
      }
      .circle-1 {margin-top: 16px;}
      .circle-6 {color: black;border: black 1px solid;}
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
         margin-bottom: 80px;
       }
      .referal-level {
        height: 100px;
        width: 100%;
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
      width: 205px;
      padding: 1.5px;
      height: 504.5px;
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
     .peymane-container {
          max-width: 500px;margin: auto;
     }
     @media screen and (max-width: 415px) {
      .referal-code-text {
         -ms-transform: rotate(-90deg);
         -webkit-transform: rotate(-90deg);
         transform: rotate(-90deg);
         margin-top: 0px !important;
         margin-right: -40px !important;
         margin-bottom: 77px !important;;
      }
      .peymane-container {
          max-width: 320px;
            margin-top: 30px;
      }
      .referal-left-text {
        margin-left: -40px;
      }
      .referal {
        width: 105px;
      }
     }
</style>

<script type="text/javascript">
     var referalPeople = 101000 ;
     var allTerraHash = 5000 ;
     var level1NumCode = 500; var level2NumCode = 500;
     var level3NumCode = 9000; var level4NumCode = 90000; var level5NumCode = 1000;
     var level1Hash = 100; var level2Hash = 200;
     var level3Hash = 400; var level4Hash = 800; var level5Hash = 1600;
     var level1Percent = 0.025; var level2Percent = 0.035; var level3Percent = 0.045; 
     var level4Percent = 0.055; var level5Percent = 0.065; 
     var level1ReferalHash = parseInt(level1Hash*level1Percent);
     var level2ReferalHash = parseInt(level2Hash*level2Percent);
     var level3ReferalHash = parseInt(level3Hash*level3Percent);
     var level4ReferalHash = parseInt(level4Hash*level4Percent);
     var level5ReferalHash = parseInt(level5Hash*level5Percent);
     var allReferalHash = level1ReferalHash + level2ReferalHash + level3ReferalHash + level4ReferalHash + level5ReferalHash ;
     var heightEachLevel = 100 ;
     // for visualiztion
     var level1 = 500;
     var level2 = 1000;
     var level3 = 10000;
     var level4 = 100000;
     // var level5 = 500;
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
     function init() {
       $(".circle h3").html("0 TH");
     }

     function setCircleValue(circleNum, circleValue) {
         $(".circle-"+circleNum+" h3").html(circleValue+"TH");
     }
     
     function level1Full() {
         $(".referal-level-5").append(`<div><h3>`+level1NumCode+`, `+level1Hash+`TH</h3><div>`);
         $(".referal-level-5").css('background-color', '#FFEC19');
         $(".circle-5").css("border", "#FFEC19 solid 2px");
         $(".circle-5").css("color", "black");
         $(".referal-percent-5").css("color", "black");
         $(".referal-percent-5").css("font-weight", "700");
         $(".line-vertical-5").css('background-color', '#FFEC19');
         setCircleValue(5, level1ReferalHash);
     }

     function level2Full() {
         $(".referal-level-4").append(`<div><h3>`+level2NumCode+`, `+level2Hash+`TH</h3><div>`);
         $(".referal-level-4").css('background-color', '#FFC100');
         $(".circle-4").css("border", "#FFC100 solid 2px");
         $(".circle-4").css("color", "black");
         $(".line-vertical-4").css('background-color', '#FFC100');
         $(".referal-percent-4").css("color", "black");
         $(".referal-percent-4").css("font-weight", "700");
         setCircleValue(4, level2ReferalHash);
     }

     function level3Full() {
         $(".referal-level-3").append(`<div><h3>`+level3NumCode+`, `+level3Hash+`TH</h3><div>`);
         $(".referal-level-3").css('background-color', '#FF9800');
         $(".circle-3").css("border", "#FF9800 solid 2px");
         $(".circle-3").css("color", "black");
         $(".line-vertical-3").css('background-color', '#FF9800');
         $(".referal-percent-3").css("color", "black");
         $(".referal-percent-3").css("font-weight", "700");
         setCircleValue(3, level3ReferalHash);
     }

     function level4Full() {
         $(".referal-level-2").append(`<div><h3>`+level4NumCode+`, `+level4Hash+`TH</h3><div>`);
         $(".referal-level-2").css('background-color', '#e45a1b');
         $(".circle-2").css("border", "#e45a1b solid 2px");
         $(".circle-2").css("color", "black");
         $(".line-vertical-2").css('background-color', '#e45a1b');
         $(".referal-percent-2").css("color", "black");
         $(".referal-percent-2").css("font-weight", "700");
         setCircleValue(2, level4ReferalHash);
     }
     
     function refresh() {
      $(".referal-level").empty();
      if(referalPeople <= level1) {
        init();
        // not float, I want int
       if( (level1/level1NumCode) > 3 ) {
           height = 30; calculateMargin = 70;
        } else {  height = parseInt( (level1NumCode*100) / level1 );calculateMargin = 100 - height; }
       // circle 5
       $(".referal-level-5").append(`<div class="referal-number"><h3>`+level1NumCode+`, `+level1Hash+`TH</h3><div>`);
       $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
       $(".referal-number").css('background-color', '#FFEC19');
       $(".line-vertical-5").css('background-color', '#FFEC19');
       $(".circle-5").css("border", "#FFEC19 solid 2px"); 
       $(".circle-5").css("color", "black"); 
       $(".referal-percent-5").css("color", "black"); 
       $(".referal-percent-5").css("font-weight", "700");
       setCircleValue(5, level1ReferalHash);
       setCircleValue(6, allReferalHash);
      } else if( referalPeople <= level2) {
        init();
          if( ((level2-level1)/level2NumCode) > 3 ) {
              height = 30; calculateMargin = 70;
          } else {  height = parseInt( (level2NumCode*100) / (level2-level1) );calculateMargin = 100 - height; }
       // circle 5
        level1Full();
       // circle 4
       $(".referal-level-4").append(`<div class="referal-number"><h3>`+level2NumCode+`, `+level2Hash+`TH</h3><div>`);
       $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
       $(".referal-number").css('background-color', '#FFC100');
       $(".line-vertical-4").css('background-color', '#FFC100');
       $(".line-top-4").css('background-color', '#FFC100');
       $(".circle-4").css("border", "#FFC100 solid 2px"); 
       $(".circle-4").css("color", "black"); 
       $(".referal-percent-4").css("color", "black"); 
       $(".referal-percent-4").css("font-weight", "700");
       setCircleValue(4, level2ReferalHash);
       setCircleValue(6, allReferalHash);
      } else if( referalPeople <= level3) {
        init();
          if( ((level3-level2)/level3NumCode) > 3 ) {
              height = 30; calculateMargin = 70;
          } else {  height = parseInt( (level3NumCode*100) / (level3-level2) );calculateMargin = 100 - height; }
       // circle 5
        level1Full();
       // circle 4
        level2Full();
       // circle 3
       $(".referal-level-3").append(`<div class="referal-number"><h3>`+level3NumCode+`, `+level3Hash+`TH</h3><div>`);
       $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
       $(".referal-number").css('background-color', '#FF9800');
       $(".line-vertical-3").css('background-color', '#FF9800');
       $(".line-top-3").css('background-color', '#FF9800');
       $(".circle-3").css("border", "#FF9800 solid 2px");
       $(".circle-3").css("color", "black");
       $(".referal-percent-3").css("color", "black");
       $(".referal-percent-3").css("font-weight", "700");
          setCircleValue(3, level3ReferalHash);
          setCircleValue(6, allReferalHash);
      } else if( referalPeople <= level4) {
          console.log("level4");
          console.log(referalPeople);console.log(level4);
          init();
          if( ((level4-level3)/level4NumCode) > 3 ) {
              height = 30; calculateMargin = 70;
          } else {  height = parseInt( (level4NumCode*100) / (level4-level3) );calculateMargin = 100 - height; }
          // circle 5
          level1Full();
          // circle 4
          level2Full();
          // circle 3
          level3Full();
          // circle 2
          $(".referal-level-2").append(`<div class="referal-number"><h3>`+level4NumCode+`, `+level4Hash+`TH</h3><div>`);
          $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
          $(".referal-number").css('background-color', '#e45a1b');
          $(".line-vertical-2").css('background-color', '#e45a1b');
          $(".line-top-2").css('background-color', '#e45a1b');
          $(".circle-2").css("border", "#e45a1b solid 2px");
          $(".circle-2").css("color", "black");
          $(".referal-percent-2").css("color", "black");
          $(".referal-percent-2").css("font-weight", "700");
          setCircleValue(2, level4ReferalHash);
          setCircleValue(6, allReferalHash);
      } else {
        init();
          // circle 5
          level1Full();
          // circle 4
          level2Full();
          // circle 3
          level3Full();
          // circle 2
          level4Full();
      //          if( ((level5-level4)/level5NumCode) > 3 ) {
         height = 40; calculateMargin = 60;
      //          } else {  height = parseInt( (level5NumCode*100) / (level5-level4) );calculateMargin = 100 - height; }
       // circle 1
       $(".referal-level-1").append(`<div class="referal-number"><h3>`+level5NumCode+`, `+level5Hash+`TH</h3><div>`);
       $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
       $(".referal-number").css('background-color', '#dc1c17');
       $(".line-vertical-1").css('background-color', '#dc1c17');
       $(".line-top-1").css('background-color', '#dc1c17');
       $(".circle-1").css("border", "#dc1c17 solid 2px");
       $(".circle-1").css("color", "black"); 
       $(".referal-percent-1").css("color", "black"); 
       $(".referal-percent-1").css("font-weight", "700");
          setCircleValue(1, level5ReferalHash);
          setCircleValue(6, allReferalHash);
      }

     }
     refresh();
    
</script>
@endsection