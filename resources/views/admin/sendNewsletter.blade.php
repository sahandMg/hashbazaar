@extends('admin.master.header')
@section('content')
    <style>
        .btn_added{
            text-align: center;
            margin: 50px 0;

        }
        .contain{

            width: 90%;
            margin: 100px auto;

        }
    </style>
</head>
<body>
<div class="contain">
    <h1 style="text-align: center">Send Newsletter</h1>
    <div class="btn_added">
        <button onclick="send()" class="btn btn-primary btn-lg">Send To All</button>
    </div>
</div>

<script>
    function send() {
        axios.post("{!! route('sendNewsLetter',['locale'=>App::getLocale()]) !!}").then(function (response) {
            if(response == 200){

                alert('done')
            }
        })
    }
</script>
@endsection