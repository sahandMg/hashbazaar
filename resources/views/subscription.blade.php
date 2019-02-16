@extends('master.layout')
@section('content')

            <div class="intro-body" >
                <div class="container"  style=" background : center no-repeat url('img/LOGO-Transparent.png'); background-size: contain">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                                    <h2 class="text-center fontTheme " style="text-transform: unset">Thanks for your registeration</h2>
                                    <h4 class="text-center fontTheme " style="text-transform: unset">Here is your invest ID</h4>
                                    <h5 class="text-center fontTheme " style="text-transform: unset">{{$code}}</h5>
                                    <h4 class="text-center fontTheme " style="text-transform: unset">Feel free to share it with your friends!</h4>
                                    <h3 class="text-center fontTheme " style="text-transform: unset">More Shares More Bonuses !</h3>
                                    <br/>
                                    <h5 class="text-center fontTheme " style="text-transform: unset">We will contact you soon
                                        for taking the next steps in the investment</h5>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <footer class="backgroundMoreGrey">
        <div class="container text-center" style="color: black">
            <p>© 2018 HashBazaar. All rights reserved</p>
        </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="js/subscription.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131063343-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131063343-1');
</script>
@endsection
