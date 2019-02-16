@extends('master.layout')
@section('content')
                {{--<!DOCTYPE html>--}}
                {{--<html lang="en">--}}
                {{--<head>--}}
                    {{--<meta charset="UTF-8">--}}
                    {{--<meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
                    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
                    {{--<link rel="stylesheet" href="css/customer-service.css">--}}
                    {{--<title>FAQ</title>--}}
                    {{--<script src="js/jquery-3.3.1.js"></script>--}}
                    {{--<script src="js/jquery.animate-colors.js"></script>--}}


                {{--</head>--}}
                {{--<body>--}}

                <div class="customerservice-container">
                
                
                    <div class="customerservice-category">
                
                        <div class="category-button one " onclick="changeColor()"><p>List1</p></div>
                        <div class="category-button two" onclick="changeColor()"><p>List2</p></div>
                        <div class="category-button three" onclick="changeColor()"><p>List3</p></div>
                        <div class="category-button four" onclick="changeColor()"><p>List4</p></div>
                
                    </div>
                
                
                    <div class="customerservice-questions">
                        <ul class="question-list1" style="color: #696967">
                
                            <li class="question-list100">
                                <p class="question" id="1">Lorem ipsum dolor sit amet.</p>
                                <p class="answer" id="answer1">Lorem ipsum dolor sit amet consectetur.
                                       
                                </p>
                            </li>
                            <!-- --- -->
                           
                        </ul>
                
                
                
                    </div>
                
                    <!-- --------------------------------------- -->
                
                    <div class="customerservice-questions2">
                           <ul class="question-list1">
                
                               <li class="question-list100"><p class="question" >Lorem ipsum dolor sit amet.2</p>
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
                    <!-- --------------------------------------- -->
                
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
                    <!-- --------------------------------------- -->
                
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
                
                
                
                    </div>  
                
                </div>
                @include('master.footer')
                <script>
                
                
                    $.noConflict();
                
                    jQuery(document).ready(function ($) {
                        $('.customerservice-questions2').hide();
                        $('.customerservice-questions3').hide();
                        $('.customerservice-questions4').hide();
                
                        $('.question2').click(function(){
                
                            $('.answer2').show(500);
                
                        })
                
                        $('.one').click(function(){
                
                            $('.one').css('background-color' , 'rgb(26, 26, 122)');
                            $('.one').css('border' , '4px solid rgb(235, 233, 233)');
                
                            $('.four').css('background-color', 'rgb(235, 233, 233)');
                            $('.two').css('background-color', 'rgb(235, 233, 233)');
                            $('.three').css('background-color', 'rgb(235, 233, 233)');
                
                        })
                        
                        $('.two').click(function(){
                
                            $('.two').css('background-color' , 'rgb(26, 26, 122)');
                            $('.two').css('border' , '4px solid rgb(235, 233, 233)');
                
                            $('.four').css('background-color', 'rgb(235, 233, 233)');
                            $('.one').css('background-color', 'rgb(235, 233, 233)');
                            $('.three').css('background-color', 'rgb(235, 233, 233)');
                
                        })
                
                        $('.three').click(function(){
                
                            $('.three').css('background-color' , 'rgb(26, 26, 122)');
                            $('.three').css('border' , '4px solid rgb(235, 233, 233)');
                
                            $('.four').css('background-color', 'rgb(235, 233, 233)');
                            $('.two').css('background-color', 'rgb(235, 233, 233)');
                            $('.one').css('background-color', 'rgb(235, 233, 233)');
                
                        })
                
                        $('.four').click(function(){
                
                            $('.four').css('background-color' , 'rgb(26, 26, 122)');
                            $('.four').css('border' , '4px solid rgb(235, 233, 233)');
                            $('.one').css('background-color', 'rgb(235, 233, 233)');
                            $('.two').css('background-color', 'rgb(235, 233, 233)');
                            $('.three').css('background-color', 'rgb(235, 233, 233)');
                
                        })      
                        
                        $('.one').click(function () {
                            $('.customerservice-questions').show(100);
                            $('.customerservice-questions4').hide(0);
                            $('.customerservice-questions3').hide();
                            $('.customerservice-questions2').hide(0);
                        })
                
                        $('.two').click(function () {
                            $('.customerservice-questions2').show(100);
                            $('.customerservice-questions4').hide(0);
                            $('.customerservice-questions3').hide();
                            $('.customerservice-questions').hide(0);
                        })
                
                        $('.three').click(function () {
                            $('.customerservice-questions3').show(100);
                            $('.customerservice-questions').hide(0);
                            $('.customerservice-questions2').hide(0);
                            $('.customerservice-questions4').hide(0);
                        })
                          
                        $('.four').click(function () {
                            $('.customerservice-questions4').show(100);
                            $('.customerservice-questions2').hide(0);
                            $('.customerservice-questions3').hide();
                            $('.customerservice-questions').hide(0);
                        })
                
                        $('.customerservice-questions .question-list100').click(function(){
                            var id = $(this).attr("id");
                            var answer = document.getElementById('#answer1');
                            $('#answer1').show(300);
                            $(this).css('height' , '150px');
                            $(this).css('transition' , 'all .5s');
                            $(this).css('font-weight' , 'bolder');
                            $(this).css('border-bottom' , 'transparent');

                            $('.question-list1 .question:after').css('display','none');
                            $('.question-list1 .question:before').css('display','block');
                
                        })
                
                
                      
                
                      
                
                
                
                
                
                
                
                
                
                
                
                    })
                
                
                
                
                </script>
@endsection