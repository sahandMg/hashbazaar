@extends('panel.master.layout')
@section('content')
    <!-- Referral Page -->
    <div id="referral-page">
        <q>Notice :</q>

        <ul class="referral-page_firstList">

                <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
                <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
                <li>Appropriately harness low-risk high-yield “outside the box” thinking.</li>
        </ul>

                <blockquote>My Referral ID : </blockquote>
                <p> &nbsp; &nbsp; KJDNSA39d987DSA</p>


                <dl>Total Benefits Till Now (USD) :</dl>
                <p>$ 100</p>

    <div class="referral-page_secondList">

            <div class="referral-page_secondList_column">Number of Sharing
                <ul><li>5</li></ul>
            </div>

            <div class="referral-page_secondList_column">Total Sharing Income (USD)
                    <ul><li>$ 12000</li></ul>

            </div>

            <div class="referral-page_secondList_column">My Benefit (USD)
                    <ul><li>$ 3000</li></ul>
            </div>




        </div>



        <hr class="referral-hr-footer" style="position: absolute;;">


    </div>


<!-- Footer -->
    <div id="footer-div">

        <div class="referral-footer-div">
                <p class="referral-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
             <img id="referral-footer-image" src="{{URL::asset('img/Logo_footer.png')}}" alt=""></div>

    </div>


    <!-- Container -->


    <script>// ------------user account--------------------
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list').toggle(500);
            })
        })
        
         // =---------------------------------------</script>
@endsection