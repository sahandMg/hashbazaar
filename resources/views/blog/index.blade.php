<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/blog.css">

    <title>Document</title>
</head>
<body>
<div class="blog-container">
    <div class="blog-grid-item one" onclick="rotate(this)" onmouseout="toBack(this)">
        <img class="blog-image frontside" src="img/swatch.jpg" alt="">
        <img class="blog-image backside" src="img/funfair-balloons.jpg" alt="">


    </div>


    <div class="blog-grid-item two">
        <a href="#" class="blog-title">Lorem ipsum dolor sit
            Quam, ab vero atque minus nemo</a>
        <p><a class="blog-category">Category/.....</a> <br>
            <span class="blog-date">sep 2018</span></p>
        <p class="blog-post">
            ae dolor velit, rerum exercitationem molestias dolores, quae tempora. Eum dolore,
            labore iure laudantium officia corporis, excepturi perferendis aliquid maiores
            similique in magllitia?</p>
        <a class="blog-readmore">Read more...</a></div>


    <div class="blog-grid-item three" onclick="rotate(this)" onmouseout="toBack(this)">
        <img src="img/minion.jpg" class="blog-image frontside" alt="">
        <img class="blog-image backside" src="img/champagne-balloons.jpg" alt="">

    </div>


    <div class="blog-grid-item four">
        <a href="#" class="blog-title">Lorem ipsum dolor sit
            Quam, ab vero atque minus nemo
        </a>
        <p><a class="blog-category">Category/.....</a> <br>
            <span class="blog-date">sep 2018</span></p>
        <p class="blog-post">
            ae dolor velit, rerum exercitationem molestias dolores, quae tempora. Eum dolore,
            labore iure laudantium officia corporis, excepturi perferendis aliquid maiores
            similique in magllitia?
        </p>
        <a class="blog-readmore">Read more...</a></div>

</div>

<script>

    function rotate(obj) {
        obj.style.transform="rotateY(-180deg)";
        obj.firstElementChild.style.zIndex='1';
        obj.lastElementChild.style.zIndex='2';
        obj.style.transition ="all 2s"

    }
    function toBack(obj) {
        obj.style.transform="rotateY(0deg)";
        obj.firstElementChild.style.zIndex='2';
        obj.lastElementChild.style.zIndex='1';
        obj.style.transition ="all 2s"

    }



</script>
</body>
</html>