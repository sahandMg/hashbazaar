<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
             <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
                <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
                 <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
             <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>List</title>
</head>
<body>
<?php

?>
    <div class="container" id="app">

        @if(count($users) > 0)

            <table class="table table-striped">

                <thead>
                <tr>
                    <td>id</td>
                    <td> name </td>
                    <td> email </td>
                    <td> country </td>
                    <td>amount(BTC)</td>
                    <td>register at </td>
                    <td>login at</td>
                    <td>status</td>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{$user->code}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @if(is_null($user->country))
                            <td><img width="25" height="20" src="{{URL::asset('flags/error.svg')}}" alt=""></td>
                        @else
                            <td><img width="25" height="20" src="{{URL::asset('flags/'.$user->country.'.svg')}}" alt=""></td>
                        @endif

                            <td>{{$user->minings->sum('mined_btc')}}</td>

                        @if(\Carbon\Carbon::now()->diffInDays($user->created_at) > 720)
                            <td>{{\Carbon\Carbon::now()->diffInMonths($user->created_at)}} Months ago</td>

                        @elseif(\Carbon\Carbon::now()->diffInDays($user->created_at) > 1)
                            <td>{{\Carbon\Carbon::now()->diffInDays($user->created_at)}} Days ago</td>

                        @elseif(\Carbon\Carbon::now()->diffInMinutes($user->created_at) > 60)
                            <td>{{\Carbon\Carbon::now()->diffInHours($user->created_at)}} Hours ago</td>



                        @else
                            <td>{{\Carbon\Carbon::now()->diffInMinutes($user->created_at)}} Minutes ago</td>


                        @endif

                        @if(\Carbon\Carbon::now()->diffInDays($user->updated_at) > 720)
                            <td>{{\Carbon\Carbon::now()->diffInMonths($user->updated_at)}} Months ago</td>

                        @elseif(\Carbon\Carbon::now()->diffInDays($user->updated_at) > 1)
                            <td>{{\Carbon\Carbon::now()->diffInDays($user->updated_at)}} Days ago</td>

                        @elseif(\Carbon\Carbon::now()->diffInMinutes($user->updated_at) > 60)
                            <td>{{\Carbon\Carbon::now()->diffInHours($user->updated_at)}} Hours ago</td>



                        @else
                            <td>{{\Carbon\Carbon::now()->diffInMinutes($user->updated_at)}} Minutes ago</td>


                        @endif
                        @if($user->block == 1)
                            <td> <button id={{$user->code}} @click="block" class="btn btn-danger"> Blocked </button> </td>
                        @else
                            <td> <button id={{$user->code}} @click="block" class="btn btn-success"> Active </button> </td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>

            </table>

        @else

            <h1> No User!</h1>
        @endif
    </div>
<script>
    new Vue({
        el:'#app',
        data:{

        },
        methods:{

            block:function (e) {


                axios.get('{{route('blockUser')}}?code='+e.target.id).then(function (response) {

                    if(e.target.className == 'btn btn-danger'){

                        e.target.innerHTML = 'Active';
                        e.target.className = 'btn btn-success';

                    }else{

                        e.target.innerHTML = 'Blocked';
                        e.target.className = 'btn btn-danger';
                    }

//
                })
            }
        }
    })
</script>
</body>
</html>