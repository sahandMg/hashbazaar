@extends('master.layout')
@section('title')
    @if(App::getlocale() == 'fa')
        <title>هش بازار |  </title>
    @else
        <title>Hashbazaar | Blog</title>
    @endif
@endsection
@section('content')
    <style>
        p {
            /*font-family: 'Times New Roman', Times, serif;*/
            font-size:20px;
            color: #000;
            text-align: justify;
        }
        img {
            width:80%;
            margin-left:10%
        }
        .blog-detail {
            margin-top: 150px;direction: rtl;text-align: right;
        }
        .blog-detail h1{color: black;}
        .blog-detail h3{color: black;font-size: 1.8rem;margin-bottom: 5px;}
        .blog-detail img {    margin: auto;display: block;}
        @media screen and (max-width:420px){
           .blog-detail {
             margin-top: 120px;
           }
           .blog-detail h1{font-size: 1.2rem;}
           .blog-detail h3 { font-size: 0.9rem; margin-bottom: 4px;}
           p {font-size: 0.8rem;}
        }
    </style>
    <div class="container blog-detail">
       <h1 class="text-center">{{ $post->title }}</h1>
       {!! $post->content_html !!}
    </div>
    @include('master.footer')
@endsection