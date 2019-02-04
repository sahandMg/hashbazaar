<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/customer-service.css">
    <title>Document</title>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.animate-colors.js"></script>

  
</head>
<body>
    <div class="customerservice-container">

        <div class="customerservice-banner"> 
            <h1>Lorem ipsum dolor sit amet.</h1>
            <h2>
            Lorem ipsum dolor sit amet 
            consectetur adipisicing elit. Distinctio, sequi?
            </h2>
        </div>

        <div class="customerservice-grid-item">
            <div class="top-questions-list">
            <blockquote>Top questions</blockquote>

                <ul class="top-questions-list-ul">

                    <li class="question-list question1">
                        Lorem ipsum dolor sit amet.

                    

                    </li>

                    <li class="question-list answer1" >
                                    Lorem ipsum dolor, sit amet co.
                                    nsectetur adipisicing elit. Placeat, perspiciatis.
                                    nsectetur adipisicing elit. Placeat, perspiciatis.
                                    nsectetur adipisicing elit. Placeat, perspiciatis.
                                    nsectetur adipisicing elit. Placeat, perspiciatis.
                                    nsectetur adipisicing elit. Placeat, perspiciatis.
                                    nsectetur adipisicing elit. Placeat, perspiciatis.
            
                    </li>
                </ul>
            </div>



            <div class="customerservice-category">
                <div class="category-bar">
    
                        <div class="category-button-flex"><a href="">Bitcoin</a></div>
                        <div class="category-button-flex"><a href="">Bitcoin</a></div>
                        <div class="category-button-flex"><a href="">Bitcoin</a></div>

                    
                </div>
                <p class="p1">Frequently asked questions</p>

                <ul class="category-list">

                        <li class="category-list-ul-li question2">
                            Lorem ipsum dolor sit 
        
                        </li>
        
                        <li class="category-list-ul-li answer2" >
                                Lorem ipsum dolor, sit amet co.
                                nsectetur adipisicing elit. Placeat, perspiciatis.
                                nsectetur adipisicing elit. Placeat, perspiciatis.
                                nsectetur adipisicing elit. Placeat, perspiciatis.
                                nsectetur adipisicing elit. Placeat, perspiciatis.
                                nsectetur adipisicing elit. Placeat, perspiciatis.
                                nsectetur adipisicing elit. Placeat, perspiciatis.
        
                        </li>


                        
                    </ul>



            </div>
        </div>
    </div>
   
    <script>
    
    $.noConflict();

    jQuery(document).ready(function ($) { 
        $('.question1').click(function(){

            $('.answer1').toggle(500);

        })

        $('.question2').click(function(){

            $('.answer2').toggle(500);

        })


     })
    
    
    
    
    </script>
</body>

</html>