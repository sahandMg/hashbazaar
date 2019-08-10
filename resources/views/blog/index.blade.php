@extends('master.layout')
@section('title')
@if(App::getlocale() == 'fa')
<title>هش بازار | بلاگ</title>
@else
<title>Hashbazaar | Blog</title>
@endif
@endsection
@section('content')
<div class="blog-container">
    <div class="blog-grid-item one" onclick="rotate(this)" onmouseout="toBack(this)">
        <img class="blog-image frontside" src="{{URL::asset('img/swatch.jpg')}}" alt="">
        <img class="blog-image backside" src="{{URL::asset('img/funfair-balloons.jpg')}}" alt="">
    </div>
    <div>
        @foreach($posts as $post)
           <a href="{{route('showPost',[session('locale'),$post->slug])}}"> <li>{{$post->title}}</li></a>
        @endforeach
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
        <img src="{{URL::asset('img/minion.jpg')}}" class="blog-image frontside" alt="">
        <img class="blog-image backside" src="{{URL::asset('img/champagne-balloons.jpg')}}" alt="">

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
@include('master.footer')

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
@endsection
