<!DOCTYPE html>
<html style="font-size: 100%">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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
    <div class="intro-body headerTheme">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-10 col-sm-11 mx-auto">
                    <h1 class="text-center">Bitcoin Investment</h1><img src="img/LOGO.svg">
                    <h3>JOIN OUR MINING FARMS</h3>
                    <h3 style="margin: 0px;">FILL YOUR POCKETS WITH BITCOIN</h3>
                    <a class="btn btn-link btn-circle js-scroll-trigger"
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
           <input type="text" name="email" placeholder="email address"/>
           <input type="text"  hidden name="hash" id="hash"/>
           <input type="password" name="password" placeholder="password"/>
           <input type="password" name='confirm_password' placeholder="type password again"/>
           <button type="Submit">register</button>
        </form>
        </div>
    </div>
  </div>

</div>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="js/Bazar.js"></script>
<style type="text/css">
    p {
        margin: 0px;padding: 0px;padding-top: 5px;
    }
</style>
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
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131063343-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131063343-1');
</script>
</body>

</html>
