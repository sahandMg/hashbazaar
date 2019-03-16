@extends('master.layout')
@section('title')
    <title>FAQ</title>
@endsection
@section('content')
<style type="text/css">
    .faq-container {
        margin-top: 10%;color: black;
    }
    .faq-container h2 { margin-bottom: 2%; }
    .faq-section {
        cursor: pointer;
        background: rgb(235, 233, 233);
        height: 100px;
        margin-left: 4.16%;
        margin-right: 4.16%;
        position: relative;
    }
    .faq-question-list {
        border-bottom: 1px dashed black;
    }
    .faq-question {
        cursor: pointer;
    }
    .faq-section h4 {
         margin-top: 5%;
         font-size: 1.2rem;
         letter-spacing: 0.4px;
    }
    .faq-section img {
        width: 50px;
        position: absolute;
        top: 30px;
        right: 15px;
    }
    .faq-question-list-container {
        padding: 0px;
    }
    .faq-question-list h5 {
         margin-top: 2%;
    }    
    .faq-answer li {
        list-style: disc;
     }
     .faq-answer { margin-top: 1%; }
     .faq-answer ul {
        margin-bottom: 2%;
     }
     .faq-answer p { margin-bottom: 1%;}
    @media only screen and (max-width: 769px) {
      .faq-container {
          margin-top: 20%;
        }
    }
    @media only screen and (max-width: 576px) {
        .faq-container {
          margin-top: 20%;
        }
        .faq-container h2 {
          font-size: 1.5rem;
          letter-spacing: 0.8px;
        }
        .faq-section {
          width: 45%;  
          margin-left: 2.5%;
          margin-right: 2.5%;
          margin-top: 2%;
       }
       .faq-section h4 {
         font-size: 1rem;
       }
       .faq-question-list h5 {
         font-size: 1rem;
         margin-bottom: 25px;
       }
       .faq-question-list p {
         font-size: 0.9rem;
         margin-bottom: 10px;
       }
       .faq-answer li {
        font-size: 0.8rem;
       }
       .faq-answer ul {
        /*padding-left: 25px;*/
        margin-bottom: 10px;
       }
       .faq-section img {
        width: 50px;
        top: 35px;
       }
       .faq-question-list-container {
         padding-left: 5%;
       }
    }
    @media only screen and (max-width: 420px) {
        .faq-container {
          margin-top: 28%;
        }
        .faq-container h2 {
          font-size: 1.2rem;
          letter-spacing: 0.5px;
        }
        .faq-question-list h5 {
         font-size: 0.9rem;
         margin-bottom: 15px;
       }
       .faq-question-list p {
         font-size: 0.8rem;
       }
    }
</style>  
                <div class="container faq-container">
                     <h2 class="text-center">Frequently asked questions</h2> 
                     <!-- customerservice-category  category-button one  -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 faq-section" id="faqSection1" style="background-color: #e8ad2c;">
                          <h4>Bitcoin</h4>
                          <img src="img/bitcoin-faq.svg" />
                        </div>
                        <div class="col-lg-3 col-md-3 faq-section" id="faqSection2">
                           <h4>Mining</h4>
                           <img src="img/mining-faq.svg" />
                        </div>
                        <div class="col-lg-3 col-md-3 faq-section" id="faqSection3">
                          <h4>Hash Bazaar</h4>
                          <img src="img/wallet-btc.png" />
                        </div>
                    </div>
                    <br/><br/>
                 <div class="faq-questions-section">
                 <!-- Bitcoin -->
                    <div class="faq-customerservice-questions">
                        <ul class="faq-question-list-container" style="color: #696967">
                            <li class="faq-question-list">
                                <h5 class="faq-question">What is Bitcoin?</h5>
                                <div class="faq-answer">
                                 <p>
                                  The new generation of transaction system is based on block chain. People need crypto currencies to deal in this new system. Bitcoin as the most important crypto is a digital and global money system currency. It allows people to send or receive money  across the internet. For more Information read about it in <a href="http://blog.hashbazaar.com/">Our blog</a>.
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I have bitcoin in my wallet?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You can buy it from any online or offline bitcoin sellers.
                                  You can find a list of sellers from <a href="https://www.bitpremier.com/buy-bitcoins">here</a>.
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I invest on bitcoin?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You can be a trader in bitcoin stock market (Like other stock markets) or invest in setting up a mining farm.
                                 </p>
                                </div>
                            </li>                           
                        </ul>
                    </div>
                    <!-- Mining -->
                    <div class="faq-customerservice-questions">
                        <ul class="faq-question-list-container" style="color: #696967">
                            <li class="faq-question-list">
                                <h5 class="faq-question">What does mining really mean?</h5>
                                <div class="faq-answer">
                                 <p>
                                  A lot of cryptocurrency transactions are made every day. Mining is the process of making a cryptocurrency transaction valid.
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">How does mining make profit for the miner? </h5>
                                <div class="faq-answer">
                                 <p style="margin-bottom: 1%;"> The miner is rewarded in two ways:</p>
                                 <ul style="margin-bottom: 2%;margin-left: 2%;">
                                   <li>Transaction validation fee.</li>
                                   <li>The new block mining reward.</li>
                                 </ul>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">What does a cloud mining platform do?</h5>
                                <div class="faq-answer">
                                 <p>
                                  A Cryptocurrency cloud mining service enables you to become a miner without all difficulties that a solo miner has. It means you can remotely be the owner of a  special part of mining farm based on the amount of money that you want to invest. 
                                 </p>
                                </div>
                            </li> 
                            <li class="faq-question-list">
                                <h5 class="faq-question">What Cryptocurrency cloud mining services are working now?</h5>
                                <div class="faq-answer">
                                 <p>
                                  There are many Cryptocurrency cloud mining services working now, like genesis-mining, hashflare and so on. 
                                 </p>
                                </div>
                            </li> 
                            <li class="faq-question-list">
                                <h5 class="faq-question">What differences are there between the Cryptocurrency cloud mining services?</h5>
                                <div class="faq-answer">
                                 <p>They are different from each other in expected return on investment, maintenance fees and reliability.</p>
                                </div>
                            </li>  
                            <li class="faq-question-list">
                                <h5 class="faq-question">Where is “Hash Bazaar”? </h5>
                                <div class="faq-answer">
                                 <p>
                                  Hash Bazaar is profitable bazaar for purchasing your favorite hash power. 
                                 </p>
                                 <p>
                                  It is a Cryptocurrency cloud mining service that enables you to become a miner in our mining farms without having to deal with complex hardware and software setup. 
                                 </p>
                                 <p>
                                  You can make your investment plan in hash bazaar. Submit your order and then receive your mining profit as bitcoin. 
                                 </p>
                                </div>
                            </li>  
                            <li class="faq-question-list">
                                <h5 class="faq-question">Can I start mining myself?</h5>
                                <div class="faq-answer">
                                 <p>
                                  If you want to mine yourself consider the challenges that will be mentioned in following bullets: 
                                 </p>
                                 <ul style="margin-left: 2%;">
                                     <li>Shipping costs</li>
                                     <li>Customs duties</li>
                                     <li>Delivery times</li>
                                     <li>Hardware setup</li>
                                     <li>Software setup</li>
                                     <li>The considerable loud voice of mining</li>
                                     <li>The considerable heat generated around the Hardware</li>
                                     <li>Hardware crash, slow down or completely breaks (No 100% uptime guarantee)</li>
                                 </ul>
                                 <p>
                                  If you can handle all the above problems then just compare your solo profit with the profit that you can get from hashbazaar.  
                                 </p>
                                 <p>
                                  The better profit in Hash bazaar comes from the low electricity that we pay because the optimum locations that we consider to set up our farms or maybe from now on your farm..  
                                 </p>
                               </div>
                            </li>                           
                        </ul>
                    </div>
                    <!-- Hash Bazaar -->
                    <div class="faq-customerservice-questions">
                        <ul class="faq-question-list-container" style="color: #696967">
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I join to hash bazaar community?</h5>
                                <div class="faq-answer">
                                 <p>
                                  Sign up with a valid email. We will guide you for the rest from your dashboard. 
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I start my mining?</h5>
                                <div class="faq-answer">
                                 <p>
                                  From your dashboard:
                                 </p>
                                 <p>
                                  Choose the amount of money you want to invest (Choose the amount of hash power you want to purchase)
                                 </p>
                                 <p>
                                  Pay your invoice.
                                 </p>
                                 <p>
                                  And then your mining will be started.
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">What parameters should I consider to make my order?</h5>
                                <div class="faq-answer">
                                 <p>
                                  The amount of money you want to invest (The amount of hash power you want to purchase).
                                 </p>
                                 <p>
                                  The predicted mining payout. 
                                 </p>
                                </div>
                            </li> 
                           <!--  <li class="faq-question-list">
                                <h5 class="faq-question">How can I pay the invoice?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You should pay it only with bitcoin.
                                 </p>
                                 <p>
                                  If you have no bitcoin you should buy it first from any online or offline merchant. You can find a list of sellers from <a href="https://www.bitpremier.com/buy-bitcoins">here</a>.
                                 </p>
                                </div>
                            </li> --> 
                            <!-- <li class="faq-question-list">
                                <h5 class="faq-question">What can I do if I have no bitcoin yet?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You should pay it only with bitcoin.
                                 </p>
                                 <p>
                                  If you have no bitcoin you should buy it first from any online or offline merchant. You can find a list of sellers from <a href="https://www.bitpremier.com/buy-bitcoins">here</a>.
                                 </p>
                                </div>
                            </li>  -->  
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I find the predicted return?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You can use HashBazaar calculator and follow it from your dashboard or reffer to any other realiable international mining calculator.
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">What parameters is predicted return based on?</h5>
                                <div class="faq-answer">
                                  <ul style="margin-left: 2%;">
                                      <li>Mining difficulty</li>
                                      <li>Total network hash rate</li>
                                      <li>Blocks mined per day</li>
                                      <li>The block reward</li>
                                  </ul>
                                </div>
                            </li> 
                            <li class="faq-question-list">
                                <h5 class="faq-question">When Can I get my profit?</h5>
                                <div class="faq-answer">
                                  <p>Your mining output will be withdrawn as soon as increasing to 0.01BTC.</p>
                                </div>
                            </li>                           
                        </ul>
                    </div>
           
                 </div>

                </div>
                @include('master.footer')
                <script>
                
                
                    // $.noConflict();
                     
                    // jQuery(document).ready(function ($) {
                        $('.faq-answer').hide();
                        $('.faq-customerservice-questions').hide();
                        $('.faq-questions-section').children().eq(0).show();
                         console.log("js run");  
                        $('.faq-question').click(function(){
                           console.log(".faq-question");
                            $('.faq-answer').hide();
                            $(this).parent().children().eq(1).show();
                         });
                          
                        $('.faq-section').click(function(){
                            console.log("faq-section");
                            $('.faq-section').css('background-color' , 'rgb(235, 233, 233)');
                            $(this).css('background-color' , '#e8ad2c');
                            var listItem = $(this);
                            $('.faq-customerservice-questions').hide();
                            $('.faq-questions-section').children().eq($(this).index()).show();
                            $(this).parent().children().eq(1).show();
                         });

                        // $('#faqSection2').click(function(){
                        //       console.log("#faqSection2");
                        //  });
                
                
                
                
                </script>
@endsection