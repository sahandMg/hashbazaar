@extends('master.layout')
@section('title')
    @if(App::getlocale() == 'fa')
        <title> هش بازار | {{$post->title}} </title>
    @else
        <title>Hashbazaar | Blog</title>
    @endif
@endsection
@section('content')
    <style>
        .blog-detail p {
            /*font-family: 'Times New Roman', Times, serif;*/
            font-size:20px;
            color: #000;
            text-align: justify;direction: rtl;
        }
        img {
            width:80%;
            margin-left:10%
        }
        .blog-detail {
            margin-top: 100px;direction: rtl;text-align: right;
        }
        .blog-detail h1{color: black;}
        .blog-detail h3{color: black;font-size: 1.8rem;margin-bottom: 5px;}
        .blog-detail img {    margin: auto;display: block;}
        @media screen and (max-width:420px){
           .blog-detail {
             margin-top: 40px;
           }
           .blog-detail h1{font-size: 1.2rem;}
           .blog-detail h3 { font-size: 0.9rem; margin-bottom: 4px;}
           .blog-detail p {font-size: 0.8rem;}
        }

        td {color: black;}
        table {color: black;}
        th {color: black;}
    </style>
    <div class="container blog-detail">
       <h1 class="text-center">{{ $post->title }}</h1>
       {!! $post->content_html !!}
    </div>
    
<!--     <script type="application/ld+json">
{ "@context": "https://schema.org", 
 "@type": "Article",
 "headline": `{{ $post->title }}`,
 "image": 'Sahand',
 "author": "Hashbazaar", 
 "keywords": `{{ $post->title }}`, 
"publisher": {
    "@type": "Organization",
    "name": "Hashbazaar",
    "logo": {
      "@type": "ImageObject",
      "url": "Sahand - https://google.com/logo.jpg" 
    }
  },
 "url": "http://www.example.com",
   "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://www.hashbazaar.com"
  },
 "datePublished": "Sahand - 2015-09-20",
 "dateCreated": "Sahand - 2015-09-20",
 "dateModified": "Sahand - 2015-09-20",
 "description": `{{ $post->excerpt }}`,
 "articleBody": `{{ $post->excerpt }}`
 }
</script> -->
    @include('master.footer')
@endsection