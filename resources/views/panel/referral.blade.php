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
        <q>Notice :</q>
        <ul class="referral-page_firstList">
            <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
            <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
            <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
        </ul>
        <blockquote>My Referral ID : </blockquote>
        <p>{{$user->code}}</p>
        <dl>Total Benefits Till Now (USD) :</dl>
        <p>$ {{$user->referral->total_benefit}}</p>
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





    </div>


   

    <script>// ------------user account--------------------
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list1').toggle(500);
            })
        })
        
         // =---------------------------------------</script>
@endsection