@extends('panel.master.layout')
@section('title')
    <title>Hashbazaar | Referral</title>
@endsection
@section('content')

    <?php
    $user = Auth::guard('user')->user();
    $settings = \App\Setting::first();
    $sharings = \App\Sharing::get()->toArray();
    $total_hash_from_referral = \Illuminate\Support\Facades\DB::connection('mysql')->table('bit_hashes')
            ->where('referral_code',Auth::guard('user')->user()->code)
            ->where('confirmed',1)
            ->sum('hash');
    $benefit = \Illuminate\Support\Facades\DB::connection('mysql')->table('bit_hashes')
            ->where('order_id','referral')->where('user_id',Auth::guard('user')->id())->sum('hash')
    ?>
    <!-- Referral Page -->
    <div id="referral-page" class="panel-container"  onclick="hideMe()">

        <div class="referral-page_secondList">
            <div class="referral-page_secondList_column">Number of referrals
                <ul><li>{{$user->referral->total_sharing_num}}</li></ul>
            </div>
            <div class="referral-page_secondList_column">Total first referrals order
                <ul><li>{{$total_hash_from_referral}} Th</li></ul>
            </div>
            <div class="referral-page_secondList_column">My Benefit
                <ul><li>{{$benefit}} Th</li></ul>
            </div>
        </div>



        <blockquote>My Referral ID: </blockquote>
        <p class="myReferralId" id="copyTarget">{{$user->code}}<a class="coppyIcon" style="cursor: pointer;"><img class="icon" src="../img/Copy.svg" alt=""></a></p>

        <div class="ref-flex">
            <blockquote style="margin-top:0%">My Referral LINK: </blockquote>
            <p class="shareReferralId"  style="padding-left:1%">
         <span class="tooltip1" style="color:green"> http://hashbazaar.com/...
            <a style="margin-top:15%"
               class="tooltiptext"  id="copyTarget2"
               href="{{route('index',['code'=>$user->code])}}">{{route('index',['code'=>$user->code])}}</a></span>
                <a class="coppyIcon2" style="cursor: pointer;"><img class="icon" src="../img/Copy.svg" alt=""></a>
            </p>
        </div>

        <br/>
        <div class="container" style="min-width: 320px;color: black;padding: 0px;">
            <div class="row peymane-container">
                <div class="referal-left-text">
                    <h3 class="referal-code-text">Number of Referrals</h3>
                    <h3>100K</h3>
                    <h3>10K</h3>
                    <h3>1000</h3>
                    <h3>500</h3>
                </div>
                <div class="referal">
                    <div class="referal-level referal-level-1">
                    </div>
                    <div class="referal-level referal-level-2">
                    </div>
                    <div class="referal-level referal-level-3">
                    </div>
                    <div class="referal-level referal-level-4">
                    </div>
                    <div class="referal-level referal-level-5">
                    </div>
                </div>
                <div class="horizontal-lines-container">
                    <span class="referal-percent referal-percent-1">6.5%</span>
                    <div class="line line-vertical-1"></div>
                    <span class="referal-percent referal-percent-2">5.5%</span>
                    <div class="line line-vertical-2"></div>
                    <span class="referal-percent referal-percent-3">4.5%</span>
                    <div class="line line-vertical-3"></div>
                    <span class="referal-percent referal-percent-4">3.5%</span>
                    <div class="line line-vertical-4"></div>
                    <span class="referal-percent referal-percent-5">2.5%</span>
                    <div class="line line-vertical-5"></div>
                </div>
                <div  class="circle-output-container">
                    <div class="circle circle-1">
                        <h3 class="text-center">3TH</h3>
                    </div>
                    <p class="text-center">+</p>
                    <div class="circle circle-2">
                        <h3 class="text-center">3TH</h3>
                    </div>
                    <p class="text-center">+</p>
                    <div class="circle circle-3">
                        <h3 class="text-center">2TH</h3>
                    </div>
                    <p class="text-center">+</p>
                    <div class="circle circle-4">
                        <h3 class="text-center">1.5TH</h3>
                    </div>
                    <p class="text-center">+</p>
                    <div class="circle circle-5">
                        <h3 class="text-center">1TH</h3>
                    </div>
                    <p class="text-center">=</p>
                    <div class="circle circle-6">
                        <h3 class="text-center">7.5TH</h3>
                    </div>
                </div>
            </div>
            <br/>

            <div class="container yek" style="color: black;margin-top: 0px;">
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
                        <td>500 <   < 1000 </td>
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

                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>Banner Size (px)</th>
                        <th>Banner Download</th>
                    </tr>
                    </thead>
                    <tbody class="text-center" style="font-family:sans-serif">
                    <tr>
                        <td>120x600 </td>
                        <td><a href="{{route('banner',['name'=>'120_600_hashbazaar','locale'=>session('locale')])}}">Download here</a></td>
                    </tr>
                    <tr>
                        <td>728x90 </td>
                        <td><a href="{{route('banner',['name'=>'728_90_hashbazaar','locale'=>session('locale')])}}">Download here</a></td>
                    </tr>
                    <tr>
                        <td>300x250 </td>
                        <td><a href="{{route('banner',['name'=>'300_250_hashbazaar','locale'=>session('locale')])}}">Download here</a></td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <style>
        .circle-output-container {
            display: flex;
            flex-direction: column;
        }
        .circle-output-container p {margin: 0px;padding: 0;font-size: 20px;line-height: 1;}
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
            width: 60px;
            display: flex;
            flex-direction: column;
            text-align: center;
        }
        .referal-percent {
            margin-top: 17px;
            /*margin-left: 5px;*/
        }
        .line{
            width: 100%;
            background-color: #707070;
            /*margin-top: 49px;*/
            margin-bottom: 61px;
            height: 2px;
        }
        .circle-output-container .circle {
            width: 85px;
            height: 85px;
            border-radius: 42.5px;
            border: #707070 1px solid;
            margin-top: 0px;
            margin-bottom: 0px;
            margin-left: -1px;
            color: #707070;
        }
        .circle-output-container .circle-1 {margin-top: 0px;}
        .circle-output-container .circle-6 {color: black;border: black 1px solid;}
        .circle-output-container .circle h3 {
            margin-top: 30px;
            font-size: 1.1rem;
            letter-spacing: 0px;
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
        .referal-code-text {
            max-width: 90px;
            text-align: center;
        }
        @media screen and (max-width: 415px) {
            .referal-code-text {
                -ms-transform: rotate(-90deg);
                -webkit-transform: rotate(-90deg);
                transform: rotate(-90deg);
                margin-top: 0px !important;
                margin-right: -40px !important;
                margin-bottom: 77px !important;;
                max-width: 120px;
            }
            .peymane-container {
                max-width: 320px;
                margin-top: 30px;
            }
            .referal-left-text {
                margin-left: -30px;
            }
            .referal {
                width: 105px;
            }
        }
    </style>
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

    <script type="text/javascript">
        // total number of sharing
        var referalPeople = {!! $user->referral->total_sharing_num !!} ;
        var allTerraHash = 5000 ;
        // number of sharing in each level
        var level1NumCode = {!! $sharings[1]['sharing_number'] !!};
        var level2NumCode = {!! $sharings[2]['sharing_number'] !!};
        var level3NumCode = {!! $sharings[3]['sharing_number'] !!};
        {{--var level4NumCode = {!! $sharings[4]['sharing_number'] !!};--}}
        {{--var level5NumCode = {!! $sharings[5]['sharing_number'] !!};--}}
        // number of terrahsah power in each level
        var level1Hash = {!! $total_hash_from_referral !!}; var level2Hash = 0;
        var level3Hash = 0; var level4Hash = 0; var level5Hash = 0;
        // reward
        var level1Percent = {!! $sharings[1]['value'] !!};
        var level2Percent = {!! $sharings[2]['value'] !!};
        var level3Percent = {!! $sharings[3]['value'] !!};
        {{--var level4Percent = {!! $sharings[4]['value'] !!};--}}
        {{--var level5Percent = {!! $sharings[5]['value'] !!};--}}

        console.log("referalPeople");console.log(referalPeople);
        console.log("level1NumCode");console.log(level1NumCode);
        console.log("level2NumCode");console.log(level2NumCode);
        console.log("level3NumCode");console.log(level3NumCode);
        //     console.log("level4NumCode");console.log(level4NumCode);
        //     console.log("level5NumCode");console.log(level5NumCode);
        console.log("level1Hash");console.log(referalPeople);
        console.log("level1Percent");console.log(level1Percent);

        var level1ReferalHash = Math.floor(level1Hash*level1Percent).toFixed(1);
        var level2ReferalHash = Math.floor(level2Hash*level2Percent).toFixed(1);
        var level3ReferalHash = Math.floor(level3Hash*level3Percent).toFixed(1);
        //     var level4ReferalHash = Math.floor(level4Hash*level4Percent).toFixed(1);
        //     var level5ReferalHash = Math.floor(level5Hash*level5Percent).toFixed(1);
        console.log("level1ReferalHash");console.log(level1ReferalHash);
        console.log("level2ReferalHash");console.log(level2ReferalHash);
        console.log("level3ReferalHash");console.log(level3ReferalHash);
        //     console.log("level4ReferalHash");console.log(level4ReferalHash);
        //     console.log("level5ReferalHash");console.log(level5ReferalHash);
        var allReferalHash =Math.floor( parseFloat(level1ReferalHash) + parseFloat(level2ReferalHash) + parseFloat(level3ReferalHash) + parseFloat(level4ReferalHash) + parseFloat(level5ReferalHash) ).toFixed(1);
        // allReferalHash = allReferalHash.toFixed(1);
        console.log("allReferalHash");console.log(allReferalHash);
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

        //     function level1Full() {
        //         $(".referal-level-5").append(`<div><h3>`+level1NumCode+`, `+level1Hash+`TH</h3><div>`);
        //         $(".referal-level-5").css('background-color', '#FFEC19');
        //         $(".circle-5").css("border", "#FFEC19 solid 2px");
        //         $(".circle-5").css("color", "black");
        //         $(".referal-percent-5").css("color", "black");
        //         $(".referal-percent-5").css("font-weight", "700");
        //         $(".line-vertical-5").css('background-color', '#FFEC19');
        //         setCircleValue(5, level1ReferalHash);
        //     }
        //
        //     function level2Full() {
        //         $(".referal-level-4").append(`<div><h3>`+level2NumCode+`, `+level2Hash+`TH</h3><div>`);
        //         $(".referal-level-4").css('background-color', '#FFC100');
        //         $(".circle-4").css("border", "#FFC100 solid 2px");
        //         $(".circle-4").css("color", "black");
        //         $(".line-vertical-4").css('background-color', '#FFC100');
        //         $(".referal-percent-4").css("color", "black");
        //         $(".referal-percent-4").css("font-weight", "700");
        //         setCircleValue(4, level2ReferalHash);
        //     }

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
                console.log("level1");
                init();
                // not float, I want int
                if( (level1/referalPeople) > 3 ) {
                    height = 30; calculateMargin = 70;
                } else {  height = parseInt( (referalPeople*100) / level1 );calculateMargin = 100 - height; }
                // circle 5
//       $(".referal-level-5").append(`<div class="referal-number"><h3>`+referalPeople+`, `+level1Hash+`TH</h3><div>`);
//       $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
//       $(".referal-number").css('background-color', '#FFEC19');
//       $(".line-vertical-5").css('background-color', '#FFEC19');
//       $(".circle-5").css("border", "#FFEC19 solid 2px");
//       $(".circle-5").css("color", "black");
//       $(".referal-percent-5").css("color", "black");
//       $(".referal-percent-5").css("font-weight", "700");
//       setCircleValue(5, level1ReferalHash);
//       setCircleValue(6, allReferalHash);
            } else if( referalPeople <= level2) {
                console.log("level2");
                init();
                if( ((level2-level1)/level2NumCode) > 3 ) {
                    height = 30; calculateMargin = 70;
                } else {  height = parseInt( (level2NumCode*100) / (level2-level1) );calculateMargin = 100 - height; }
                // circle 5
                level1Full();
                // circle 4
//       $(".referal-level-4").append(`<div class="referal-number"><h3>`+level2NumCode+`, `+level2Hash+`TH</h3><div>`);
//       $(".referal-number").css( { marginTop : calculateMargin+"px", 'height': height+"px"} );
//       $(".referal-number").css('background-color', '#FFC100');
//       $(".line-vertical-4").css('background-color', '#FFC100');
//       $(".line-top-4").css('background-color', '#FFC100');
//       $(".circle-4").css("border", "#FFC100 solid 2px");
//       $(".circle-4").css("color", "black");
//       $(".referal-percent-4").css("color", "black");
//       $(".referal-percent-4").css("font-weight", "700");
//       setCircleValue(4, level2ReferalHash);
//       setCircleValue(6, allReferalHash);
            } else if( referalPeople <= level3) {
                console.log("level3");
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
                console.log("level5");
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
