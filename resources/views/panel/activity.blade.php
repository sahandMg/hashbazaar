@extends('panel.master.layout')
@section('content')
<?php
$settings = DB::table('settings')->first();
foreach ($hashes as $key=> $hash){

    $remainedLife[$key] = floor((\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($hash->created_at)->addYears($hash->life)))/($hash->life * 365) * 100) ;
}

?>


<div id="activity-page">

    <blockquote>Recent Activities</blockquote> 

    <div class="purchases">
        <q>Purchases</q>

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
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%">
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

                        <td> 
                            778dsadDSAB Hhbjbdsa89dsax
                        </td>

                        <td>
                            Pending                                
                        </td>

                    </tr>
         
                    
                 
                        <!-- <p id="no-hash"> NO Hash History</p> -->
                   
                          
                          
                </table>


    <hr class="activity-hr-footer" style="position: relative;"> 


</div> 


<!-- Footer -->
 <div id="footer-div">

    <div class="activity-footer-div">
        <p class="activity-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
        
        <img id="activity-footer-image" src="{{asset('img/Logo_footer.png')}}" alt="" ></div>
        {{-- {{asset('img/Logo_footer.png')}} --}}
</div> 

<!-- Container -->
@include('panel.master.sidebar')


<script>// ------------user account--------------------
    $(document).ready(function(){

        $('.user-img').click(function(){
            $('.list').toggle(500);
        })
    
                    var activitySecondListNumItems = $('.activity-page_secondList_column').length;
                    if( activitySecondListNumItems > 8){
                        $('#activity-page_secondList').css('overflow-y' , "scroll")
                    }
                    else {
                        $('#activity-page_secondList').css('overflow-y' , "hidden")

                    }


                    var activityThirdListNumItems = $('.activity-page_thirdList_column').length;
                    if( activityThirdListNumItems > 8){
                        $('#activity-page_thirdList').css('overflow-y' , "scroll")
                    }
                    else {
                        $('#activity-page_thirdList').css('overflow-y' , "hidden")

                    }

    })
    // =---------------------------------------</script>
@endsection