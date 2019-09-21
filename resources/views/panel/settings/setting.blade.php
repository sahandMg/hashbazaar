@extends('panel.master.layout')
@section('title')
@if(App::getlocale() == 'fa')
<title>هش بازار | تنطیمات</title>
@else
<title>Hashbazaar | Setting</title>
@endif
@endsection
@section('content')

<div class="container" style="direction: rtl;">
    <div class="d-flex justify-content-center" style="margin-bottom: 5%;">
      <button class="btnTab" id="walletTab">کیف پول</button>
      <button class="btnTab" id="changePasswordTab" style="border-right: 2px solid #727272;">تغییر رمز</button>  
    </div>
    <!-- wallet -->
    <div class="text-center" id="wallet">
     @if(!is_null(Auth::guard('user')->user()->wallet))
      <!--  current wallet -->
      <div id="walletAdress">
        
        <div class="title-flex2">
                <hr class="dashboard-hr2"/>
                <h2 class="dashboard-title2">{{__("Current Bitcoin Wallet Address")}}</h2>
                <hr class="dashboard-hr2"/>
        </div>

     
        <div class="address">
           
               <!--  <div class="address-img">{!! QrCode::size(150)->backgroundColor(255,253,232)->generate(Auth::guard('user')->user()->wallet->addr) !!}</div> -->

          <!--   <div class="address-box">
                <input type="text" id="copyTarget" value="{{Auth::guard('user')->user()->wallet->addr}}" readonly>
                <div class="div-icons-flex">
                    <a href="https://blockstream.info/address/{{!is_null(Auth::guard('user')->user()->wallet)?Auth::guard('user')->user()->wallet->addr:null}}"><img class="icon" src="{{URL::asset('img/Link.svg')}}" alt="Link"></a>
                    <a class="coppyIcon" style="cursor: pointer;"><img class="icon" src="{{URL::asset('img/Copy.svg')}}" alt="Copy Link"></a>
                </div>
            </div> -->
               <h4 class="text-center englishFont" style="font-size: 1.5rem;">{{Auth::guard('user')->user()->wallet->addr}}</h4>
            
           <!--  <div class="change-address">

                <form onsubmit="submitForm(event)" action="{{route('editWallet',['locale'=>session('locale')])}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input required type="text" class="a2"  name="address"   placeholder="{{!is_null(Auth::guard('user')->user()->wallet)?Auth::guard('user')->user()->wallet->addr:'Your bitcoin wallet address'}}"><br>
                    <button id="editWallet" type="submit" class="pandel-button a4"  >{{__("Submit")}}</button>
                </form>

            </div> -->
                <button id="changeWalletBtn" type="submit" class="pandel-button">تغییر آدرس</button>
               
        </div><!-- address -->

       </div>
       <!-- change wallet addrees -->
       <div id="changeWallet">
         <div class="title-flex2 a3">
                <hr class="dashboard-hr2"/>
                <h2 class="dashboard-title2">{{__("Need To Change Your Address ?")}}</h2>
                <hr class="dashboard-hr2"/>
         </div>

        <!-- enter wallet -->
        <div id="enterWallet">
         <!--  <h4>کیف پول ندارید؟ <a href="https://blockchain.info/">اینجا</a> کلیک کنید.</h4>
          <h1 class="my-4"><strong>یا</strong></h1>
          <h4 class="text-center" style="color:black">{{__("Submit Your Wallet Address")}}</h4>
          <br/> -->
         <form onsubmit="submitForm(event)"  id="setting-wallet" class="text-center" method="post" action="{{route('wallet',['locale'=>session('locale')])}}">
            <input class="text-center" type="hidden" name="_token" value="{{csrf_token()}}">
            <input required   class="input-borderBottom text-center" type="text" id="textwallet" name="wallet">
            <button id="wallet" type="submit" class="pandel-button">{{__("Submit")}}</button>
          </form>
        </div>   
      </div>
      <script type="text/javascript">
          $('#changeWallet').hide();
          $('#changeWalletBtn').click(function () {
            console.log("changeWalletBtn");
             $('#changeWallet').show();
             $('#walletAdress').hide();
         });
      </script>
      @else
        <div id="">
         <div class="title-flex2 a3">
                <hr class="dashboard-hr2"/>
                <h2 class="dashboard-title2">آدرس کیف پول</h2>
                <hr class="dashboard-hr2"/>
         </div>

        <!-- enter wallet -->
        <div id="enterWallet">
          <h4>کیف پول ندارید؟ <a href="https://blockchain.info/">اینجا</a> کلیک کنید.</h4>
          <h1 class="my-4"><strong>یا</strong></h1>
          <h4 class="text-center" style="color:black">{{__("Submit Your Wallet Address")}}</h4>
          <br/>
         <form onsubmit="submitForm(event)"  id="setting-wallet" class="text-center" method="post" action="{{route('wallet',['locale'=>session('locale')])}}">
            <input class="text-center" type="hidden" name="_token" value="{{csrf_token()}}">
            <input required   class="input-borderBottom text-center" type="text" id="textwallet" name="wallet">
            <button id="wallet" type="submit" class="pandel-button">{{__("Submit")}}</button>
          </form>
        </div>   
      </div>
      @endif
     
    </div>
    <!-- changePassword -->
     <div class="text-center" id="changePassword">
        <form onsubmit="submitForm(event)"  name="profile" action="{{route('setting',['locale'=>session('locale')])}}" method="post">

            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <legend>{{__("Change Password")}}</legend>

            <!-- <label>{{__("Current Password")}}</label> -->
            <input required class="input-borderBottom text-center my-2" type="password" name="password" placeholder="{{__("Current Password")}}"> 
            

            <!-- <label>{{__("New Password")}}</label> -->
            <input required class="input-borderBottom text-center my-2" type="password" name="newpass" placeholder="{{__("New Password")}}">
            

            <!-- <label>{{__("Confirm Password")}}</label> -->
            <input required class="input-borderBottom text-center my-2" type="password" name="confirm" placeholder="{{__("Confirm Password")}}">
            
            <button id="userForm" type="submit" class="pandel-button">{{__("Submit")}}</button>

        </form>
    </div>
</div>
<style type="text/css">
    .btnTab:hover {color: #ff9100;}
</style>

<script type="text/javascript">
    // for chossing plan
        $('#wallet').show();
        $('#changePassword').hide();
        $('#walletTab').addClass('active-tab');
        $('#changePasswordTab').removeClass('active-tab');
        $('#plankind').val(1); // one for plan classic

       $('#changePasswordTab').click(function () {
         console.log("planClassicBtn");
         $('#changePassword').show();
         $('#wallet').hide();
         $('#changePasswordTab').addClass('active-tab');
         $('#walletTab').removeClass('active-tab');
      });

      $('#walletTab').click(function () {
        console.log("planClassicZeroBtn");
        $('#wallet').show();
        $('#changePassword').hide();
        $('#walletTab').addClass('active-tab');
        $('#changePasswordTab').removeClass('active-tab');
      });
</script>
<br/><br/><br/>
@endsection
