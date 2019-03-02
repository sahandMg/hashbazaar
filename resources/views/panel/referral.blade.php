@extends('panel.master.layout')
@section('title')
    <title>Referrals</title>
@endsection
@section('content')
    <!-- Referral Page -->
    <?php
            $user = Auth::guard('user')->user();

    ?>
    <div id="referral-page"  style="display: flex;flex-direction: column;">
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



        <!-- <hr class="referral-hr-footer" style="position: absolute;;"> -->


    </div>


<!-- Footer -->
    <!-- <div id="footer-div">
        <div class="referral-footer-div">
            <p class="referral-footer-paragraph" style="color:black">© 2018 HashBazaar. All rights reserved</p>
            <img id="referral-footer-image" src="{{URL::asset('img/Logo_footer.png')}}" alt="">
        </div>
    </div> -->
   <hr/> 
   <footer>
       <p class="text-center">© 2018 HashBazaar. All rights reserved</p>
       <img src="{{URL::asset('img/Logo_footer.png')}}" alt="HashBazaar">
   </footer>

    <!-- Container -->
    <style type="text/css">
        footer img {
            width: auto;
            height: 60px;
            margin-left: 2%;
        }
        footer p {  margin-bottom: 2% ;color: black;font-size: 1.2rem;}
        footer {
            margin-left: 370px;
            padding: 0px;
        }

        @media screen and (max-width:1024px) {
          footer img {
            height: 60px;
          }
          footer {
            margin-left: 280px;
          }
        }

        @media screen and (max-width:768px) {
          footer {
            margin: 0px;
            padding-bottom: 2%;
          }
          footer img {
            height: 40px;
          }
        }

        @media screen and (max-width: 414px) {
          footer p {  margin-bottom: 2% ;color: black;font-size: 0.9rem;}
          footer {
            padding-bottom: 4%;
          }
          footer img {
            height: 30px;
            margin-left: 4%;
          }
        }
    </style>

    <script>// ------------user account--------------------
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list1').toggle(500);
            })
        })
        
         // =---------------------------------------</script>
@endsection