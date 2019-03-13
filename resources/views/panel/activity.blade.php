@extends('panel.master.layout')
@section('title')
    <title>Activity</title>
@endsection
@section('content')
<?php
$settings = DB::table('settings')->first();
$hashes = App\BitHash::where('user_id',Auth::guard('user')->id())->where('confirmed',1)->get();
$trans = DB::table('transactions')->where('user_id',Auth::guard('user')->id())->get();
foreach ($hashes as $key=> $hash){

    $remainedLife[$key] = floor((\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($hash->created_at)->addYears($hash->life)))/($hash->life * 365) * 100) ;
}

?>


<div  class="panel-container activity-container">
    <h2 class="text-center">Recent Activities</h2> 
    <div class="purchases">
        <h2>Purchases</h2>
        <br>
      <div class="container pur">
        <table class="table custom-table" style="color: black;">
                @if(!$hashes->isEmpty())
              <thead>
                <tr  style="height:70px !important">
                    <th>Hash Power</th>
                    <th>Started at</th>
                    <th>Ends at</th>
                    <th>Remain</th>
                 </tr>
               </thead>
               <tbody>
               @foreach($hashes as $hash)
                <tr>
                    <td>

                            <span>{{$hash->hash}}TH/S</span>

                    </td>
                    <td>

                           <span>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}}    </span>

                    </td>
                    <td>

                            <span>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}   </span>

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
               @endforeach
               </tbody> 
                

                @else
                    <h6 id="no-hash" style="color: black;"> NO Purchases</h6>
                @endif
                       
   
            </table>
        </div>
        
    </div> 

    <div class="purchases">
        <h2>Transactions </h2>
        @if(!is_null($trans))
            <div class="container">

                <table  class="table custom-table" style="color: black;">
                    <thead  style="font-weight:bold">
                        <tr  style="height:90px !important">
                            <th class="Transactions_column"> Date </th>
                            <th class="Transactions_column"> BTC </th>
                            <th class="Transactions_column">Address</th>
                            <th class="Transactions_column">Status</th>
                            <th class="Transactions_column">in/out</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trans as $item)
                            <tr>

                                <td>
                                   {{\Carbon\Carbon::parse($item->created_at)->format('M d Y')}}
                                </td>

                                <td>
                                    {{$item->amount_btc}}
                                </td>

                                <td class="tooltip1">
                                    778dsad...

                                    <span class="tooltiptext">{{$item->addr}}</span>

                                </td>

                                <td>
                                    {{$item->status}}
                                </td>

                                <td>
                                    {{$item->checkout}}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>


                    </table>
        @else

            <h6 id="no-hash"> NO Hash History</h6>
       @endif


        </div> 
    </div> 
</div>


<!-- Container -->
{{-- @include('panel.master.sidebar') --}}


<script>// ------------user account--------------------
    $(document).ready(function(){

        $('.user-img').click(function(){
            $('.list1').toggle(500);
        })
    
                    var activitySecondListNumItems = $('.container .table tr').length;
                    var activityThirdListNumItems = $('#activity-page_thirdList .table tr').length;

                    if( activitySecondListNumItems > 4){
                        $('.container').css('overflow-y' , "scroll")
                    }
                    else {
                        $('.container').css('overflow-y' , "hidden")

                    };

                    if( activityThirdListNumItems > 3){
                        $('#activity-page_thirdList').css('overflow-y' , "scroll")
                    }
                    else {
                        $('#activity-page_thirdList').css('overflow-y' , "hidden")

                    }


                      

    })
    // =---------------------------------------</script>
    <style type="text/css">
        .progress-bar1 .title {
          opacity: 1;
        }
        .activity-container h2 {
            margin-top: 4%;
        }
        .custom-table thead  {
            border-bottom: 30px !important;
            font-weight: bolder;
        }
        .custom-table th{
            border-top: 0px;
        }

        /* @media screen and (max-width:414px){
            .container .custom-table th:nth-of-type(2) ,
            .container .custom-table td:nth-of-type(2) {
                display: none
            }
        } */
      </style>
@endsection