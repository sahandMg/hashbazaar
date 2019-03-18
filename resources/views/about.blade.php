@extends('master.layout')
@section('content')
  
  <div class="container about-us-container" >
  	 <h1 class="text-center">About us</h1>
  	 <p>Hash Bazaar is a profitable bazaar for purchasing your favorite amount of hash power.</p>
  	 <p>It is a Cryptocurrency cloud mining service that enables you to become a miner in our mining farms without facing complex Challenges like Shipping costs, custom duties, delivery times, hardware setup, software setup, and considerable loud voice of mining and generated heat, hardware crash, slow down or completely breaks.</p>
  	 <p>We help our customers who wants to invest in mining. It’s not considered whether you know about bitcoin or not. We are your financial adviser and we set up your mining farms.</p>
  	 <p>Your share of profit from mining is estimated according to some parameters. You can find it from “Hash Bazaar” home page or from your panel. You could join us by purchasing just one therra hash power or more.</p>
  	  <p>We have some advantages about what we are offering you, the most important one is our ROI (Return on investment) suggestion. This profitable plan is made in the places where the electricity cost is low. Since the optimum locations we have considered to set up our mining farms.</p>
  </div>
 
 <style type="text/css">
 	.about-us-container {
 		color: black;
 		margin-top: 120px;
 	}
 	.about-us-container p {
 		margin-bottom: 25px;
 		text-align: justify;
 	}
 	@media screen and (max-width:768px) {
        .about-us-container h1 {
 		  font-size: 1.8rem;
 		  letter-spacing: 0.5px;
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


@include('master.footer')
@endsection