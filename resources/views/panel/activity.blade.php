@extends('panel.master.layout')
@section('title')
@if(App::getlocale() == 'fa')
<title>هش بازار | تراکنش ها</title>
@else
<title>Hashbazaar | Activities</title>
@endif
@endsection
@section('content')
<?php
$settings = DB::connection('mysql')->table('settings')->first();
$hashes = App\BitHash::where('user_id',Auth::guard('user')->id())->where('confirmed',1)->orderBy('created_at','desc')->get();
$trans = DB::connection('mysql')->table('transactions')->where('user_id',Auth::guard('user')->id())->orderBy('created_at','desc')->get();
foreach ($hashes as $key=> $hash){

    if($hash->plan_id == 1)
        $remainedLife[$key] = 100;
    else{
        $remainedLife[$key] = floor((\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($hash->created_at)->addDays(env('contract_time'))))/(env('contract_time')) * 100) ;
    }
}

?>

<!-- <div  class="panel-container activity-container" style="direction: rtl;"> -->
<div class="container text-center" style="direction: rtl;">
    <!-- <h2 class="text-center">{{__("Recent Activities")}}</h2> -->
    <!-- <div class="container"> -->
     <div class="d-flex justify-content-center  title-container">
       <hr class="flex-grow-1" />
       <h3 class="px-2">{{__("Purchases")}}</h3>
       <hr class="flex-grow-1" />
     </div>

    <!-- <br> -->
      <div class="table-responsive"  id="activity-page_secondList">
        <table class="table" style="color: black;">
                @if(!$hashes->isEmpty())
              <thead>
                <tr>
                    <th style="min-width: 150px;">{{__("Hash Power")}}</th>
                    <th style="min-width: 150px;">{{__("Started at")}}</th>
                    <th style="min-width: 150px;">{{__("Ends at")}}</th>
                    <th style="min-width: 200px;">{{__("Remain")}}</th>
                 </tr>
               </thead>
               <tbody>
               @foreach($hashes as $key=>$hash)
                   @if(Config::get('app.locale') == 'fa')
                <tr>
                    <td>

                            <span>{{$hash->hash}} تراهش</span>

                    </td>
                    <td>

                        <span>  {{  \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($hash->created_at))->format('Y/m/d')}}   </span>

                    </td>
                    <td>

                        <span>  {{  \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($hash->created_at)->addDays(env('contract_time')))->format('Y/m/d')}}  </span>

                    </td>

                    <td>

                        <div class="remain">
                            <div class="progress1">
                                <div class="progress-bar1" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%;width: {{$remainedLife[$key]}}%;">
                                    <span class="title">{{$remainedLife[$key]}}%</span>

                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @else
                       <tr>
                           <td>

                               <span>{{$hash->hash}}TH/S</span>

                           </td>
                           <td>

                               <span>  {{  \Carbon\Carbon::parse($hash->created_at)->format('Y/m/d')}}   </span>

                           </td>
                           <td>

                               <span>  {{  \Carbon\Carbon::parse($hash->created_at)->format('Y/m/d')}}  </span>

                           </td>

                           <td>

                               <div class="remain">
                                   <div class="progress1">
                                       <div class="progress-bar1" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%;width: {{$remainedLife[$key]}}%;">
                                           <span class="title">{{$remainedLife[$key]}}%</span>

                                       </div>
                                   </div>
                               </div>

                           </td>
                       </tr>

                @endif
               @endforeach
               </tbody>


                @else
                    <h6 id="nopur" class="text-center" style="color: black;"> {{__("NO Purchases")}}</h6>
                @endif


            </table>
        </div>

    <!-- </div> -->

    <div class="purchases">
      <div class="d-flex justify-content-center  title-container">
        <hr class="flex-grow-1" />
        <h3 class="px-2">{{__("Transactions")}}</h3>
        <hr class="flex-grow-1" />
       </div>
        @if(!is_null($trans))
            <div class="container" id="activity-page_thirdList">

                <table  class="table custom-table" style="color: black;">
                    <thead  style="font-weight:bold">
                    @if(Config::get('app.locale')== 'fa')
                        <tr>
                            <th class="Transactions_column" style="min-width: 150px;"> {{__("TransId")}} </th>
                            <th class="Transactions_column" style="min-width: 150px;"> {{__("Date")}} </th>
                            <th class="Transactions_column" style="min-width: 150px;"> مبلغ </th>
                            <th class="Transactions_column" style="min-width: 150px;">{{__("Status")}}</th>
                            <th class="Transactions_column" style="min-width: 150px;">{{__("in/out")}}</th>

                        </tr>
                    @else

                        <tr>
                            <th class="Transactions_column" style="min-width: 150px;"> {{__("TransId")}} </th>
                            <th class="Transactions_column" style="min-width: 150px;"> {{__("Date")}} </th>
                            <th class="Transactions_column" style="min-width: 150px;"> BTC </th>
                            <th class="Transactions_column" style="min-width: 150px;">{{__("Address")}}</th>
                            <th class="Transactions_column" style="min-width: 150px;">{{__("Status")}}</th>
                            <th class="Transactions_column" style="min-width: 150px;">{{__("in/out")}}</th>

                        </tr>
                    @endif
                    </thead>
                    <tbody>
                    @if(Config::get('app.locale')== 'fa')
                        @foreach($trans as $item)
                            <tr>
                                <td>
                                    {{$item->code}}
                                </td>
                                <td>
                                    {{  \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($item->created_at))->format('Y/m/d')}}
                                </td>

                                <td>
                                @if($item->checkout == 'in')

                                        {{$item->amount_btc}} BTC
                                @else
                                         {{$item->amount_toman}} تومان
                                @endif
                                </td>

                                <td>
                                    @if($item->status == 'paid')
                                        <span style="color: green">پرداخت شده</span>
                                    @else
                                        <span style="color: red">پرداخت نشده</span>
                                    @endif
                                </td>

                                <td>
                                    @if($item->checkout == 'in')
                                        <span style="color: green">دریافتی</span>
                                    @else
                                        <span style="color: deepskyblue">پرداختی</span>
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    @else
                        @foreach($trans as $item)
                            <tr>
                                <td>
                                    {{$item->code}}
                                </td>

                                <td>
                                    {{\Carbon\Carbon::parse($item->created_at)->format('M/d/Y')}}
                                </td>

                                <td>

                                    @if(is_null($item->amount_btc))
                                        --
                                    @else
                                        {{$item->amount_btc}}
                                    @endif
                                </td>

                                <td class="tooltip1">

                                    @if(is_null($item->addr))
                                        --
                                    @else
                                        <span class="tooltiptext">{{$item->addr}}</span>
                                    @endif
                                </td>

                                <td>
                                    @if($item->status == 'paid')
                                        <span style="color: green">{{$item->status}}</span>
                                    @else
                                        <span style="color: red">{{$item->status}}</span>
                                    @endif
                                </td>

                                <td>
                                    {{$item->checkout}}
                                </td>

                            </tr>
                        @endforeach
                    @endif

                    </tbody>


                    </table>
        @else

            <h6 id="no-hash"> {{__("NO Hash History")}}</h6>
       @endif


        </div>
    </div>
</div>
<br/><br/><br/>

<script>// ------------user account--------------------
    $(document).ready(function(){

        $('.user-img').click(function(){
            $('.list1').toggle(500);
        });
                  
                    var activitySecondListNumItems = $('#activity-page_secondList .table tr').length;
                    var activityThirdListNumItems = $('#activity-page_thirdList .table tr').length;
                    console.log("activitySecondListNumItems");console.log(activitySecondListNumItems);
                    console.log("activityThirdListNumItems");console.log(activityThirdListNumItems);
                    if( activitySecondListNumItems > 4){
                        $('#activity-page_secondList').css('overflow-y' , "scroll")
                        console.log("activitySecondListNumItems scroll");
                    }
                    else {
                        $('#activity-page_secondList').css('overflow-y' , "hidden")
                        console.log("activitySecondListNumItems hidden");
                    };

                    if( activityThirdListNumItems > 3){
                        $('#activity-page_thirdList').css('overflow-y' , "scroll");
                        console.log("activityThirdListNumItems scroll");
                    }
                    else {
                        $('#activity-page_thirdList').css('overflow-y' , "hidden");
                        console.log("activityThirdListNumItems hidden");

                    }




    })
</script>
@endsection
