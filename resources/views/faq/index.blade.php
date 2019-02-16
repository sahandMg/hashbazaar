@extends('master.layout')
@section('content')
<style type="text/css">
    .faq-container {
        margin-top: 10%;color: black;
    }
    .faq-section {
        cursor: pointer;
        background: rgb(235, 233, 233);
        height: 100px;
        margin-left: 4.16%;
        margin-right: 4.16%;
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


    @media only screen and (max-width: 576px) {
        .faq-container {
          margin-top: 20%;
        }
        .faq-container h2 {
          font-size: 1.5rem;
          letter-spacing: 0.8px;
        }
        .faq-section {
          width: 42%;  
          margin-left: 4%;
          margin-right: 4%;
          margin-top: 2%;
       }
       .faq-section h4 {
         font-size: 1rem;
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
    }
</style>  
                <div class="container faq-container">
                     <h2 class="text-center">Frequently asked questions</h2> 
                     <!-- customerservice-category  category-button one  -->
                    <div class="row">
                        <div class="col-md-3 faq-section" style="background-color: #e8ad2c;"><h4>Bitcoin</h4></div>
                        <div class="col-md-3 faq-section"><h4>Mining</h4></div>
                        <div class="col-md-3 faq-section"><h4>Hash Bazaar</h4></div>
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
                                  The new generation of transaction system is based on block chain. People needs crypto currencies to deal in this new system. Bitcoin as the most important crypto is a digital and global money system currency. It allows people to send or receive money  across the internet. For more Information read about it in Bloomberg.
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I have bitcoin in my wallet?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You can buy it from any online or offline bitcoin sellers.
                                  You can find a list of sellers from here.
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I invest on bitcoin?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You can be a trader in bitcoin stock market (Like other stock markets) or invest on setting up a mining farm.
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
                                  A lot of cryptocurrency transactions are made every day. Mining is the processing of making a cryptocurrency transaction valid.
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">How does mining make profit for the miner? </h5>
                                <div class="faq-answer">
                                 <p>
                                  The miner is rewarded in two ways:
                                  Transaction validation fee
                                  The new block mining reward
                                 </p>
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
                                  There are many Cryptocurrency cloud mining services working now. You can find a list of cloud mining services from here. 
                                 </p>
                                 <p>
                                  What differences are there between the Cryptocurrency cloud mining services?
                                  They are different from each other in expected return on investment and maintenance fees specially Energy fees.
                                 </p>
                                </div>
                            </li>  
                            <li class="faq-question-list">
                                <h5 class="faq-question">Where is “Hash Bazaar”? </h5>
                                <div class="faq-answer">
                                 <p>
                                  Hash Bazaar is the most profitable bazaar for purchasing your favorite hash power. 
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
                                 <ul>
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
                                  The incredible profit in Hash bazaar comes from the low electricity that we pay because the optimum locations that we consider to set up our farms or maybe from now on your farm..  
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
                                  Sign up with a valid email. We will guide you for the rest from your panel. 
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I start my mining?</h5>
                                <div class="faq-answer">
                                 <p>
                                  From your panel:
                                 </p>
                                 <p>
                                  Choose the amount of money you want to invest (Choose the amount of hash power you want to purchase)
                                 </p>
                                 <p>
                                  Pay your invoice with bitcoin (If you have no bitcoin you should buy it first from any online or offline merchant.)
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
                                  The predicted mining payout that can be found from your panel or other cryptocurrency calculator. 
                                 </p>
                                </div>
                            </li> 
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I pay the invoice?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You should pay it only with bitcoin.
                                 </p>
                                 <p>
                                  If you have no bitcoin you should buy it first from any online or offline merchant. You can find a list of sellers from here.
                                 </p>
                                </div>
                            </li> 
                            <li class="faq-question-list">
                                <h5 class="faq-question">What can I do if I have no bitcoin yet?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You should pay it only with bitcoin.
                                 </p>
                                 <p>
                                  If you have no bitcoin you should buy it first from any online or offline merchant. You can find a list of sellers from here.
                                 </p>
                                </div>
                            </li>   
                            <li class="faq-question-list">
                                <h5 class="faq-question">How can I find the predicted return from my panel?</h5>
                                <div class="faq-answer">
                                 <p>
                                  You can find it from your panel, Section …
                                 </p>
                                </div>
                            </li>
                            <li class="faq-question-list">
                                <h5 class="faq-question">What parameters is predicted return based on?</h5>
                                <div class="faq-answer">
                                  <ul>
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
                                  <p>You can withdraw your mining output at 00:00 every day.</p>
                                </div>
                            </li>                           
                        </ul>
                    </div>
                <!-- 
                    <div class="customerservice-questions2">
                           <ul class="question-list1">
                               <li class="question-list100">
                                  <p class="question" >Lorem ipsum dolor sit amet.2</p>
                                   <p class="answer" id="answer1">Lorem ipsum dolor sit amet consectetur2.
                                           Lorem ipsum dolor sit amet consectetur.2
                                           
                                   </p>
                               </li>
                
                               <li class="question-list100 101"><p class="question" >Lorem ipsum dolor sit amet.2</p>
                                   <p class="answer" id="answer3">Lorem ipsum dolor sit amet consectetur.
                                           Lorem ipsum dolor sit amet consectetur.12
                                           
                                   </p>
                               </li>
                               
                           </ul>
                    </div>  
                
                    <div class="customerservice-questions3">
                            <ul class="question-list1">
                
                                <li class="question-list100"><p class="question" id="1">Lorem ipsum dolor sit amet.2</p>
                                    <p class="answer" id="answer1">Lorem ipsum dolor sit amet consectetur2.
                                            Lorem ipsum dolor sit amet consectetur.2
                                            
                                    </p>
                                </li>
                
                                <li class="question-list100 101"><p class="question" id="2">Lorem ipsum dolor sit amet.2</p>
                                    <p class="answer" id="answer2">Lorem ipsum dolor sit amet consectetur.
                                            Lorem ipsum dolor sit amet consectetur.2
                                            
                                    </p>
                                </li>
                
                                <li class="question-list100 102"><p class="question" id="3">Lorem ipsum dolor sit amet.2</p>
                                    <p class="answer" id="answer3">Lorem ipsum dolor sit amet consectetur.
                                            Lorem ipsum dolor sit amet consectetur.2
                                            
                                    </p>
                                </li>
                                
                            </ul>
                    </div>  
                
                    <div class="customerservice-questions4">
                        <ul class="question-list1">
                
                            <li class="question-list100"><p class="question" id="1">Lorem ipsum dolor sit amet.2</p>
                                <p class="answer" id="answer1">Lorem ipsum dolor sit amet consectetur2.
                                        Lorem ipsum dolor sit amet consectetur.2
                                        
                                </p>
                            </li>
                
                            <li class="question-list100 101"><p class="question" id="2">Lorem ipsum dolor sit amet.2</p>
                                <p class="answer" id="answer2">Lorem ipsum dolor sit amet consectetur.
                                        Lorem ipsum dolor sit amet consectetur.2
                                        
                                </p>
                            </li>
                
                            <li class="question-list100 102"><p class="question" id="3">Lorem ipsum dolor sit amet.2</p>
                                <p class="answer" id="answer3">Lorem ipsum dolor sit amet consectetur.
                                        Lorem ipsum dolor sit amet consectetur.2
                                        
                                </p>
                            </li>
                
                            <li class="question-list100 103"><p class="question" id="4">Lorem ipsum dolor sit amet.2</p>
                                <p class="answer" id="answer3">Lorem ipsum dolor sit amet consectetur.
                                        Lorem ipsum dolor sit amet consectetur.2
                                        
                                </p>
                            </li>
                
                            
                        </ul>
                    </div>   -->
                 </div>

                </div>
                @include('master.footer')
                <script>
                
                
                    $.noConflict();
                
                    jQuery(document).ready(function ($) {
                        $('.faq-answer').hide();
                        $('.faq-customerservice-questions').hide();
                        $('.faq-questions-section').children().eq(1).show();

                        $('.faq-question').click(function(){
                            $('.faq-answer').hide();
                            $(this).parent().children().eq(1).show();
                         })
                          
                        $('.faq-section').click(function(){
                            $('.faq-section').css('background-color' , 'rgb(235, 233, 233)');
                            $(this).css('background-color' , '#e8ad2c');
                            var listItem = $(this);
                            $('.faq-customerservice-questions').hide();
                            $('.faq-questions-section').children().eq($(this).index()).show();
                            // $(this).parent().children().eq(1).show();
                         })
                
                        // $('.one').click(function(){
                
                        //     $('.one').css('background-color' , 'rgb(26, 26, 122)');
                        //     $('.one').css('border' , '4px solid rgb(235, 233, 233)');
                
                        //     $('.four').css('background-color', 'rgb(235, 233, 233)');
                        //     $('.two').css('background-color', 'rgb(235, 233, 233)');
                        //     $('.three').css('background-color', 'rgb(235, 233, 233)');
                
                        // })
                        
                        // $('.two').click(function(){
                
                        //     $('.two').css('background-color' , 'rgb(26, 26, 122)');
                        //     $('.two').css('border' , '4px solid rgb(235, 233, 233)');
                
                        //     $('.four').css('background-color', 'rgb(235, 233, 233)');
                        //     $('.one').css('background-color', 'rgb(235, 233, 233)');
                        //     $('.three').css('background-color', 'rgb(235, 233, 233)');
                
                        // })
                
                        // $('.three').click(function(){
                
                        //     $('.three').css('background-color' , 'rgb(26, 26, 122)');
                        //     $('.three').css('border' , '4px solid rgb(235, 233, 233)');
                
                        //     $('.four').css('background-color', 'rgb(235, 233, 233)');
                        //     $('.two').css('background-color', 'rgb(235, 233, 233)');
                        //     $('.one').css('background-color', 'rgb(235, 233, 233)');
                
                        // })
                
                        // $('.four').click(function(){
                
                        //     $('.four').css('background-color' , 'rgb(26, 26, 122)');
                        //     $('.four').css('border' , '4px solid rgb(235, 233, 233)');
                        //     $('.one').css('background-color', 'rgb(235, 233, 233)');
                        //     $('.two').css('background-color', 'rgb(235, 233, 233)');
                        //     $('.three').css('background-color', 'rgb(235, 233, 233)');
                
                        // })      
                        
                        // $('.one').click(function () {
                        //     $('.customerservice-questions').show(100);
                        //     $('.customerservice-questions4').hide(0);
                        //     $('.customerservice-questions3').hide();
                        //     $('.customerservice-questions2').hide(0);
                        // })
                
                        // $('.two').click(function () {
                        //     $('.customerservice-questions2').show(100);
                        //     $('.customerservice-questions4').hide(0);
                        //     $('.customerservice-questions3').hide();
                        //     $('.customerservice-questions').hide(0);
                        // })
                
                        // $('.three').click(function () {
                        //     $('.customerservice-questions3').show(100);
                        //     $('.customerservice-questions').hide(0);
                        //     $('.customerservice-questions2').hide(0);
                        //     $('.customerservice-questions4').hide(0);
                        // })
                          
                        // $('.four').click(function () {
                        //     $('.customerservice-questions4').show(100);
                        //     $('.customerservice-questions2').hide(0);
                        //     $('.customerservice-questions3').hide();
                        //     $('.customerservice-questions').hide(0);
                        // })
                
                        // $('.customerservice-questions .question-list100').click(function(){
                        //     var id = $(this).attr("id");
                        //     var answer = document.getElementById('#answer1');
                        //     $('#answer1').show(300);
                        //     $(this).css('height' , '150px');
                        //     $(this).css('transition' , 'all .5s');
                        //     $(this).css('font-weight' , 'bolder');
                        //     $(this).css('border-bottom' , 'transparent');

                        //     $('.question-list1 .question:after').css('display','none');
                        //     $('.question-list1 .question:before').css('display','block');
                
                        // })
                             
                    })
                
                
                
                
                </script>
@endsection