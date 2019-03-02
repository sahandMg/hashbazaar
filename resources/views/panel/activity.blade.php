@extends('panel.master.layout')
@section('title')
    <title>Activity</title>
@endsection
@section('content')
<?php
$settings = DB::table('settings')->first();
foreach ($hashes as $key=> $hash){

    $remainedLife[$key] = floor((\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($hash->created_at)->addYears($hash->life)))/($hash->life * 365) * 100) ;
}

?>


<div  class="panel-container activity-container">
    <h2 class="text-center">Recent Activities</h2> 
    <div class="purchases">
        <q>Purchases</q>
      <div class="container">
        <table id="Hash-History-list">
                @if(!$hashes->isEmpty())

                <tr>
                    <th class="Hash-History_column"> 
                        Hash Power  
                    </th>

                    <th class="Hash-History_column"> 
                        Started at
                       
                    </th>

                    <th class="Hash-History_column"> 
                        Ends at
                        
                    </th>

                    <th class="Hash-History_column"> 
                        Remain
                        
                    </th>

                </tr>

                <tr>

                    <td>
                        @foreach($hashes as $hash)
                            <span>{{$hash->hash}}TH/S</span>
                        @endforeach
                            
                    </td>

                    <td>
                        @foreach($hashes as $hash)
                        
                            <span>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}}    </span> 
                            @endforeach

                    </td>

                    <td> 
                            @foreach($hashes as $hash)

                            <span>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}   </span>
                            @endforeach

                    </td>

                    <td>
                        @foreach($hashes as $key => $hash)
                            

                            
                                <div class="remain">
                                    <div class="progress1">
                                        <div class="progress-bar1" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%;width: {{$remainedLife[$key]}}%;">
                                            <span class="title">{{$remainedLife[$key]}}%</span>

                                        </div>
                                    </div>
                                </div>

                            
                                @endforeach

                            
                    </td>

                </tr>
                
                

                @else
                    <p id="no-hash"> NO Purchases</p>
                @endif
                       
   
            </table>
        </div>
        
    </div> 

    <div class="Transactions">
        <q>Transactions </q>
        <div id="activity-page_thirdList">

            <table id="Transactions-list" >
                    <tr>
                        <th class="Transactions_column"> 
                            Date  
                        </th>

                        <th class="Transactions_column"> 
                            BTC 
                           
                        </th>

                        <th class="Transactions_column"> 
                            Address
                            
                        </th>

                        <th class="Transactions_column"> 
                            Status
                            
                        </th>

                    </tr>

                    <tr>

                        <td>
                            10 Sep 2018
                        </td>

                        <td>
                            0.01  
                        </td>

                        <td class="tooltip1"> 
                            778dsad...
                            
                            <span class="tooltiptext">778dsadDSAB Hhbjbdsa89dsax</span>

                        </td>

                        <td>
                            Pending                                
                        </td>

                    </tr>
         
                 
                        <!-- <p id="no-hash"> NO Hash History</p> -->
                   
                          
                          
                </table>




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
    
                    var activitySecondListNumItems = $('#Transactions-list tr').length;
                    if( activitySecondListNumItems > 3){
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
      </style>
@endsection