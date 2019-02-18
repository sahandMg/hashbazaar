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

        <div id="activity-page_secondList">
            @if(!$hashes->isEmpty())
                <div    class="activity-page_secondList_column">Hash Power
                    <ul>
                        @foreach($hashes as $hash)
                        <li>{{$hash->hash}} TH/S</li>
                            @endforeach
                    </ul>
                </div><br><br>

                <div class="activity-page_secondList_column">Started At
                    <ul>
                        @foreach($hashes as $hash)
                        <li>{{\Carbon\Carbon::parse($hash->created_at)->format('M d Y')}}</li>
                            @endforeach
                    </ul>

                </div><br><br>

                <div class="activity-page_secondList_column">Ends At
                    <ul>
                        @foreach($hashes as $hash)

                        <li>{{\Carbon\Carbon::parse($hash->created_at)->addYears(2)->format('M d Y')}}</li>

                        @endforeach
                    </ul>
                </div><br> <br>

                <div class="activity-page_secondList_column">Remains
                    {{-- style="width: 180px; margin: 0px auto" --}}
                    <ul>
                        @foreach($hashes as $key => $hash)
                            <li>
                                <div class="remain" >
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$remainedLife[$key]}}" aria-valuemin="0" aria-valuemax="100" style="max-width: {{$remainedLife[$key]}}%">
                                            <span class="title">{{$remainedLife[$key]}}%</span>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div><br> <br>
            @else
                <p id="nopur"> No Purchase !</p>
            @endif

        </div>

    </div>

    <div class="Transactions">
        <q>Transactions </q>
        <div id="activity-page_thirdList">
            <div class="activity-page_thirdList_column"> Date
                <ul>
                    <li>10 Sep 2018</li>

                </ul>
            </div>

            <div class="activity-page_thirdList_column"> BTC
                <ul>
                    <li>0.01</li>

                </ul>
            </div>

            <div class="activity-page_thirdList_column"> Address
                <ul>
                    <li>778dsadDSAB
                        Hhbjbdsa89dsax</li>
                </ul>
            </div>

            <div class="activity-page_thirdList_column"> Status
                <ul>
                    <li>Pending</li>
                </ul>
            </div>

            
        </div>
    </div>


    <hr class="activity-hr-footer" style="position: relative;">


</div>


<!-- Footer -->
<div id="footer-div">

    <div class="activity-footer-div">
        <p class="activity-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
        <img id="activity-footer-image" src="img/Logo_footer.svg" alt="" ></div>

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