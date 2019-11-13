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
        <button id="btn" onclick="send()" class="btn btn-primary btn-lg">Send To All</button>
    </div>
</div>

<script>
    function send() {
        document.getElementById('btn').innerHTML = 'Sending';
        axios.post("{!! route('sendNewsLetter',['locale'=>App::getLocale()]) !!}").then(function (response) {
            if(response.data == 200){
                document.getElementById('btn').innerHTML = 'Send To All';
                alert('done')
            }
        })
    }
</script>
@endsection