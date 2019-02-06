<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hash Bazaar - Referral</title>
    <link rel="stylesheet" href="{{URL::asset('css/contact-referral-activity-dashboard.css')}}">
        <script src="{{URL::asset('js/jquery-3.3.1.js')}}"></script>
        <link rel="stylesheet" href="{{URL::asset('css/cssreset.css')}}">
    <script>

    </script>
</head>

<body>
  @include('panel.master.navbar')
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
    <div>

        <div class="referral-footer-div">
                <p class="referral-footer-paragraph">© 2018 HashBazaar. All rights reserved</p>
             <img id="referral-footer-image" src="{{URL::asset('img/Logo_footer.svg')}}" alt=""></div>

    </div>


    <!-- Container -->
    @include('panel.master.sidebar')

    <script>// ------------user account--------------------
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list').toggle(500);
            })
        })
        
         // =---------------------------------------</script>
</body>

</html>
