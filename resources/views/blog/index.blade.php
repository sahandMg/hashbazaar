@extends('master.layout')
@section('title')
@if(App::getlocale() == 'fa')
<title>هش بازار | بلاگ</title>
@else
<title>Hashbazaar | Blog</title>
@endif
@endsection
@section('content')

<div class="container">
  <div class="row">
        @foreach($posts as $post)
          <article class="ContentSmallSize" style="background-color: white;">
              <a href="{{route('showPost',[session('locale'),$post->slug])}}">
              <figure>
               <img  height="225px" width="100%" src={{ image.path }} alt={{ $post->title }} />
               <!-- <figcaption style="right: 0">{{ post.title }}</figcaption> -->
              </figure>
              <div>
               <h3 style="color: black;">{{ $post->title }}</h3>
               <p style="color: black;">{{ $post->summary|raw }}</p>
               <span style="color: black;"><time>{{ $post->published_at|date('M d, Y') }}</time></span>
              </div>
              </a>
          </article>
        @endforeach
   </div>
</div>
@include('master.footer')
<style type="text/css">
    .ContentSmallSize {
    flex: 0 1 calc(25% - 1em);
    text-align: right;
    margin-bottom: 1%;
    background-color: white;
    color: black;
}

.ContentSmallSize:hover {
    top: -2px;
    /*box-shadow: 0 4px 5px rgba(0,0,0,0.2);*/
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}

@media screen and (max-width: 768px) {
    .ContentSmallSize {
        flex: 0 1 calc(50% - 1em);
    }
}
@media screen and (max-width: 600px) {
    .ContentSmallSize {
        flex: 0 1 calc(100% - 1.5em);
        margin-bottom: 4%;
    }
}
@media screen and (max-width: 414px) {
    .ContentSmallSize h3 {
        font-size: 1.3rem;
}
    .ContentSmallSize p {
        font-size: 1rem;
    }
}

.ContentSmallSize figure {
   position: relative;
}
.ContentSmallSize figcaption {
    position: absolute;
    top: 180px;
    color: white;
    background-color: black;
    padding: 4px 8px;
    font-size: 100%;
    font-weight: 400;
}
.ContentSmallSize h3 {
    color: black;
}
.ContentSmallSize span {
    color: #999999;
}
.ContentSmallSize p {
    color: black;
}
.ContentSmallSize div {
    padding: 1% 2%;
}


</style>
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
