@extends('panel.master.layout')
@section('content')


    <!-- Setting Page -->

    <div id="setting-page">

        <div class="setting-flex">
            <div class="flex-item one"><a href="{{route('userInfo')}}">User Information</a>

            </div>


            <div class="flex-item-two flex-item"><a style="color:orange" href="{{route('changePassword')}}" class="change">Change Password</a></div>


            <div class="flex-item three"><a href="{{route('wallet')}}">Wallet</a></div>

        </div>




        <!-- Wallet 1 -->

        <div class="wallet1">

            <p>Still Don’t Have a Bitcoin Wallet? Click <a href="{{route('makeWallet')}}"
                style="color:orange;text-decoration: none;font-weight: bold;">Hear</a> To Make One!
                </p>

                <q>OR</q>

                <blockquote>Change Your Wallet Address</blockquote>
                <form id="setting-wallet" action="">
                <input type="text">


                <button></button>
                </form>



        </div><!-- Wallet 1 -->


    <hr class="setting-wallet-hr-footer" style="position: relative;">


    </div> <!-- id="setting-page" -->


        <!-- Footer -->


    </div>

    <script>

        // ------------user account--------------------
        $(document).ready(function(){
    
            $('.user-img').click(function(){
                $('.list').toggle(500);
            })
        })
    
    // =---------------------------------------
    </script>
@endsection