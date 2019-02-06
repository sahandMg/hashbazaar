
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <title>Payment Box</title>


    <!-- Bootstrap4 CSS - -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- Note - If your website not use Bootstrap4 CSS as main style, please use custom css style below and delete css line above.
    It isolate Bootstrap CSS to a particular class 'bootstrapiso' to avoid css conflicts with your site main css style -->
    <!-- <link rel="stylesheet" href="css/bootstrapcustom.min.css" crossorigin="anonymous"> -->


    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" crossorigin="anonymous"></script>
    <script src="{{URL::asset('js/support.min.js')}}" crossorigin="anonymous"></script>
             <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
                <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
                 <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- CSS for Payment Box -->
    <style>
        html { font-size: 14px; }
        @media (min-width: 768px) { html { font-size: 16px; } .tooltip-inner { max-width: 350px; } }
        .mncrpt .container { max-width: 980px; }
        .mncrpt .box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }
        img.radioimage-select { padding: 7px; border: solid 2px #ffffff; margin: 7px 1px; cursor: pointer; box-shadow: none; }
        img.radioimage-select:hover { border: solid 2px #a5c1e5; }
        img.radioimage-select.radioimage-checked { border: solid 2px #7db8d9; background-color: #f4f8fb; }
    </style>
</head>

<body>

<?php
$data = session('paymentData');
// Text above payment box
$custom_text  = "<p class='lead'>Demo Text - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>";
$custom_text .= "<p id='orderID' class='lead'>Your Transaction ID : </p>".$data['orderID'];
$box = $data['box'];
// Display payment box
echo $box->display_cryptobox_bootstrap($data['coins'], $data['def_coin'],$data['def_language'] , $custom_text, 70, 200, true, "default", "default", 250, "", "curl", true);
//echo $box->display_cryptobox_bootstrap($coins, $def_coin, $def_language, $custom_text, 70, 200, true, "default", "default", 250, "", "curl", true);

// You can setup method='curl' in function above and use code below on this webpage -
// if successful bitcoin payment received .... allow user to access your premium data/files/products, etc.
// if ($box->is_paid()) { ... your code here ... }


?>

<script>

    $(document).ready(function(){

        $('.user-img').click(function(){
            $('.list').toggle(500);
        });

        refresh();

    });

    var time;
    function refresh() {

        axios.get('{{route('checkPaymentReceived',['orderID'=>$data['orderID']])}}').then(function (response) {

            resp = response.data;
            console.log(resp);

            if(resp == 200){
                document.getElementById('refreshForm').submit();
                clearTimeout(time);

            }else{

                time = setTimeout(function () {
                    refresh()
                },5000);
            }
        });

    }



</script>

</body>
</html>