@extends('panel.master.layout')
@section('title')
    <title>Referrals</title>
@endsection
@section('content')
    <!-- Referral Page -->
    <?php
            $user = Auth::guard('user')->user();

    ?>
    <div id="referral-page">
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



        <hr class="referral-hr-footer" style="position: absolute;;">


    </div>


<!-- Footer -->
    <div id="footer-div">

        <div class="referral-footer-div">
                <p class="referral-footer-paragraph" style="color:black">© 2018 HashBazaar. All rights reserved</p>
             <img id="referral-footer-image" src="{{URL::asset('img/Logo_footer.png')}}" alt=""></div>

    </div>


    <!-- Container -->


    <script>// ------------user account--------------------
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list1').toggle(500);
            })
        })
        
         // =---------------------------------------</script>
@endsection