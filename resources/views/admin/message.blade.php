@extends('admin.master.header')
@section('content')

    @include('formMessage')
    <?php
    $messages = \App\Message::orderBy('created_at','desc')->get();
    ?>

    <div class="container">
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Answer</th>
                <th>Delete</th>
            </tr>


            @foreach($messages as $message)

                <tr>
                    <td>{{$message->name}}</td>
                    <td>{{$message->email}}</td>
                    <td>{{$message->message}}</td>
                    <td><button onclick="openPanel({{json_encode($message->id)}})" id="{{$message->id}}" class="btn btn-primary"> Answer</button></td>
                    <td><button onclick="deleteMessage({{json_encode($message->id)}})" id="delete{{$message->id}}" class="btn btn-danger"> Delete</button></td>
                </tr>
             @endforeach
        </table>

        <div id="messagePanel" hidden>
            <form style="padding: 20px;" method="POST" action="{{route('AdminMessage')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input name="id" type="text" class="form-control" value="" id="email" aria-describedby="emailHelp" placeholder="ایمیل خود را وارد کنید">
                </div>

                <div class="form-group">
                    <label for="body"> Message</label>
                    <textarea style="text-align: right; direction: rtl"  name="body" type="text"  class="form-control"  aria-describedby="emailHelp" placeholder="متن پیام"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Send </button>

            </form>
        </div>

    </div>

    <script>
        function openPanel(id) {
            document.getElementById('email').value = id;
            document.getElementById('messagePanel').hidden = false
        }

        function deleteMessage(id) {
            axios.post('{!! (route('deleteMessage')) !!}',{'id':id}).then(function (response) {
                if(response.data == 200 ){

                    window.location.reload('{{ route('message')}}');
                }
            })

        }
    </script>
@endsection