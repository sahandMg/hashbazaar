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
            font-family: 'Times New Roman', Times, serif;
            font-size:20px;
            color: #000;
        }
        img {
            width:80%;
            margin-left:10%
        }

    </style>
    <div class="container">

   {!! $post->content_html !!}
</div>
    @include('master.footer')
@endsection