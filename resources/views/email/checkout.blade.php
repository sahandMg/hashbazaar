<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords"
          content="Bitcoin mining, scrypt mining, cloud mining, hosted mining"/>
    <meta name="description"
          content="Bitcoin is the digital gold of the future & HashBazaar is the most cost effective cloud mining company on the market. Mine bitcoin through the cloud, get started today!"/>
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <title>Checkout</title>
    <style>
        body , html{
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            max-width: 960px;
            margin: auto;
        }

        header {
            width: 100%;
            max-height: 80px;
            background-color: black;
            border-bottom: 3px solid orange;
        }

        header img {
            height: 40px;
            width: auto;
            padding: 15px
        }

        .container  {
            width: 70%;
            margin: 0 auto;
        }

        .container .text {
            margin:0 auto;
            display: block;
            width:60% !important;
            height: 100%;
        }

        .container  p{
            display: block;
            margin: 0;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        .container  h1{
            text-align: left;
            font-size: 2rem;
            margin:0; mso-line-height-rule:exactly;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        footer {
            height: 60px;
            background: black;
            text-align: center;
            margin: auto;
            width: 100%;
            border-top: 3px solid orange;
            margin-top: 120px;

        }

        footer a {
            display: inline-block;
            border-right: 1px solid orange;
            font-size: 1em;
            margin: auto;
            text-align: center;
            color: white;
            padding-left:2%;
            padding-right: 2%;
            margin-top: 7px;
            text-decoration: none;
        }

        @media screen and (max-width: 768px) {
            .container  h1{
                font-size: 1.5rem;
            }
        }
        @media screen and (max-width: 576px) {
            .container  {
                width: 90%;
                margin: auto;
            }
            .container p {
                font-size: 1em;
                margin-bottom: 8px;
            }

            footer a {
                display: inline-block;
                border-right: 1px solid orange;
                font-size: .8em;
                margin: auto;
                text-align: center;
                color: white;
                padding-right: 3%;
                margin-top: 7px;
                margin-left: 1% !important;
            }
        }

        @media screen and (max-width:375px) {
            .container .text {
                font-size: 1em;
                margin: 0 auto;
            }
            .container  h1{
                font-size: 1.2rem;
            }
            .container p {
                font-size: 0.9em;
                margin-bottom: 5px;
            }
        }
    </style>

</head>
<body>
<header>
    <div class="logo-header"><img src="{{asset('img/Logo_header.png')}}" alt="logo_header"></div>
</header>
<div class="container">

        <h1 style="text-align: right;">{{$user->name}} گرامی</h1>
        <p style="text-align: right;">  <span>{{$trans->code}} </span> کد تراکنش شما </p>
        <p style="text-align: right;">  <span>{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($trans->created_at))}} </span> : تاریخ  </p>
        <p style="text-align: right;">  مبلغ <span> {{$trans->amount_btc}}</span>  بیتکوین به کیف پول شما تحت آدرس </p>
        <p style="text-align: right;">  {{$user->wallet->addr}}    </p>
        <p style="text-align: right;">  .واریز شد    </p>


</div>

@include('email.master.footer')
</body>
</html>