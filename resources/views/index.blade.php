<!DOCTYPE html>
<html style="font-size: 100%">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="keywords"
          content="Bitcoin mining, scrypt mining, cloud mining, hosted mining"/>
    <meta name="description"
          content="Bitcoin is the digital gold of the future & HashBazaar is the most cost effective cloud mining company on the market. Mine bitcoin through the cloud, get started today!"/>
    <meta name="google-site-verification" content="roNqWp-CmbNsSN2R6ggCv2ubJwFNikEs_WJ7E2P3WDw" />    
    <title>Hash Bazar</title>
    <link rel="icon" href="img/TabLogo.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
    <link rel="stylesheet" href="css/theme.css">
</head>

<body id="page-top" style="background: white">
<!-- class="masthead pb-3" -->
<header id="header" >
    {{-- navbar  ../../public/img/Logo_header.svg.svg.svg   --}}
    <div class="header-navbar">
        <div id="header-navbar-logo"> 
            <ul>
                <li class="navbar-list big"><img class="navbar-small-logo" src="{{asset('img/Logo_header.svg')}}" alt="Logo">
            </ul>
        </div>
        <div id="header-navbar-menu"> 
            <ul>
                <li class="navbar-list small"><a href="#">Home</a></li>
                <li class="navbar-list small"><a href="#">About</a></li>
                <li class="navbar-list small"><a href="{{route('customerService')}}">Customer Service</a></li>
                <li class="navbar-list small"><a href="{{route('blog')}}">Blog</a></li>
                <li class="navbar-list small signup"><a href="#" >Sign Up</a></li>
                <li class="navbar-list small login"><a href="{{route('login')}}" >Log In</a></li>
            </ul>
            
        </div>

            
            <div class="navigation-menu">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
            </div>
    </div>


    {{--  --}}
    <div class="intro-body headerTheme">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-10 col-sm-11 mx-auto">
                    <h1 class="text-center">Bitcoin Investment</h1><img src="img/LOGO.svg">
                    <h3>JOIN OUR MINING FARMS</h3>
                    <h3 style="margin: 0px;">FILL YOUR POCKETS WITH BITCOIN</h3>
                    <a class="btn btn-link btn-circle js-scroll-trigger responsive-circle"
                                                                  style="border-color: red;color: red" role="button"
                                                                  href="#sharePlan"><i
                        class="fa fa-angle-down animated"></i></a></div>
            </div>
        </div>
    </div>
</header>
<section id="sharePlan" class="text-center" style="padding-top: 2%;color: #707070;">
    <div>
       <h3 class="fontTheme">choose your investment planS</h3>
    </div>
    <div class="container">
    <h5 id="demo"></h5>
    <div class="slidecontainer">
        <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
    </div>
    <div style="text-align: left;font-weight: 700;">
      <p>Hash allocation cost : <span id="cost"></span> dollar</p>
      <p>Maitanace fee: 0.5 dollar per Th/day</p>
      <small>(include all electricity, cooling, development, and servicing costs )</small>
      <p>Income : At this time We predict 0.1 BTC/month for every Th.</p>
      <small>(Changes may happen depends on bitcoin price and bitcoin network difficulty changes.)</small>
    </div>
       <div class="form-group fontTheme" style="margin-top: 2%;">
                <button id="myBtn" class="btn  btn-primary round-button-com" type="button" style="width: 120px">Buy</button>
        </div>
    </div>
</section>
<section id="priceCompare" class="context-section backgroundGrey text-center pt-3 pb-3">
    <h2 style="color: #707070">Our advantage is low cost !</h2>
    <div class="container"><img id="price" src="img/Pricing.svg"></div>
</section>
<section id="contact" class="text-center backgroundGrey">
    <div class="row" style="background: white">
        <div class="col-lg-8 mx-auto">
            <h2 class="fontTheme m-3">Let us know your questions</h2>
        </div>
    </div>
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <form method="POST" action="{{route('message')}}">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group fontTheme"><input class="form-control" type="text" name="name"
                                                             placeholder="name" id="nameTextBox"></div>
                    <div class="form-group fontTheme"><input class="form-control" type="email" name="email"
                                                             placeholder="email" id="emailTextBox"></div>
                    <div class="form-group fontTheme"><textarea class="form-control mx-auto" name="message"
                                                                placeholder="Message" id="messageTextBox"
                                                                rows="5"></textarea></div>
                    <div class="form-group fontTheme">
                        <button class="btn  btn-primary round-button-com" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<footer class="backgroundMoreGrey">
    <div class="container text-center">
        <p>© 2018 HashBazaar. All rights reserved</p>
    </div>
</footer>

<!-- The Modal -->
<div id="myModal" class="modal" style="color: black;">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div>
        <h2 class="text-center">You must register first </h2>
        <div class="form">
         <form method="post" action="{{route('subscribe')}}" class="register-form">
           <input type="hidden" name="_token" value="{{csrf_token()}}">
           <input type="text"  hidden name="hash" id="hash"/>
@if($errors->all())
    @foreach($errors->all() as $error)
    <span style="color: #ae5856;">{{$error}}</span><br>
    @endforeach
@endif

            <input type="text" name="name" placeholder="name"/>
           <input type="text" name="email" placeholder="email address"/>
           <!-- <span style="color: #ae5856;">error</span> -->
           <input type="password" name="password" placeholder="password"/>
           <!-- <span style="color: #ae5856;">error</span> -->
           <input type="password" name='confirm_password' placeholder="type password again"/>
           <button type="submit" id="registerButton">register</button>
        </form>
        </div>
    </div>
  </div>

</div>

{{-- -------------- --}}
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";
(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";
s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="js/Bazar.js"></script>
<style type="text/css">
    p {
        margin: 0px;padding: 0px;padding-top: 5px;
    }
</style>
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<script type="text/javascript">
  console.log("js run");
   var slider = document.getElementById("myRange");
  var output = document.getElementById("demo");
output.innerHTML = slider.value+' Th'; // Display the default slider value
var cost = document.getElementById("cost"); cost.innerHTML = slider.value * 50 ;
var hashInput = document.getElementById("hash");
hashInput.value = slider.value;
// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
    console.log("input change");
  output.innerHTML = this.value+' Th';
  cost.innerHTML = slider.value * 50 ;
  hashInput.value = slider.value;
}

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// document.getElementById("registerButton").addEventListener("click", registerButtonFunction);
// function registerButtonFunction() {
//   console.log("registerButton");
//   document.getElementById("registerButton").disabled = true;
// }
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131063343-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131063343-1');
</script>

<script>
        $(document).ready(function(){
        
        $('.navigation-menu').click(function(){
            
            $('#header-navbar-menu').toggle();
            $('.login').show();
            $('.signup').show();
            $('.navigation-menu').toggleClass('change');

        
        })
        


        })
        
        </script>
</body>

</html>
