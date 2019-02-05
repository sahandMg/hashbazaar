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


    <div class="customerservice-category">

        <div class="category-button" onclick="changeColor()"><p>Lorem, ipsum.</p></div>
        <div class="category-button" onclick="changeColor()"><p>Lorem, ipsum.</p></div>
        <div class="category-button" onclick="changeColor()"><p>Lorem, ipsum.</p></div>
        <div class="category-button" onclick="changeColor()"><p>Lorem, ipsum.</p></div>

    </div>


    <div class="customerservice-questions">
        <ul class="question-list1">

            <li class="question-list100"><p class="question" id="1">Lorem ipsum dolor sit amet.</p>
                <p class="answer" id="answer1">Lorem ipsum dolor sit amet consectetur.

                </p>
            </li>
            <!-- --- -->
            <li class="question-list100"><p class="question" id="2">Lorem ipsum dolor sit amet.</p>
                <p class="answer" id="answer2">Lorem ipsum dolor sit amet consectetur.

                </p>
            </li>
            <!-- --- -->
            <li class="question-list100"><p class="question" id="3">Lorem ipsum dolor sit amet.</p>
                <p class="answer" id="answer3">Lorem ipsum dolor sit amet consectetur.

                </p>
            </li>
            <!-- --- -->
            <li class="question-list100"><p class="question" id="4">Lorem ipsum dolor sit amet.</p>
                <p class="answer" id="answer4">Lorem ipsum dolor sit amet consectetur.

                </p>
            </li>
        </ul>



    </div>

    <!-- --------------------------------------- -->

    <!-- <div class="customerservice-questions2">
           <ul class="question-list1">

               <li class="question-list100"><p class="question" id="1">Lorem ipsum dolor sit amet.</p>
                   <p class="answer" id="answer1">Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                   </p>
               </li>

               <li class="question-list100"><p class="question" id="2">Lorem ipsum dolor sit amet.</p>
                   <p class="answer" id="answer2">Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                   </p>
               </li>

               <li class="question-list100"><p class="question" id="3">Lorem ipsum dolor sit amet.</p>
                   <p class="answer" id="answer3">Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                   </p>
               </li>

               <li class="question-list100"><p class="question" id="4">Lorem ipsum dolor sit amet.</p>
                   <p class="answer" id="answer4">Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                           Lorem ipsum dolor sit amet consectetur.
                   </p>
               </li>
           </ul>



       </div>  -->

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

        $('.category-button').click(function(){

            $(this).css('background-color' , 'rgb(26, 26, 122)');

        })

        $('.category-button').mouseleave(function(){
            $(this).css('background-color' , 'rgb(235, 233, 233)');

        })


        $('.question-list100').click(function(){
            var id = $(this).attr("id");
            var answer = document.getElementById('#answer')
            $('#answer').toggle(300);
            $(this).css('height' , '150px');
            $(this).css('transition' , 'all .5s');
            $(this).css('color' , 'aqua')



        })

    })




</script>
</body>

</html>