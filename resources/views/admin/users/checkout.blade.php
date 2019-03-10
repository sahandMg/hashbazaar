@extends('admin.master.header')
@section('content')

    <div id="checkout">


                @if(count($users) > 0)

                    <table class="table table-striped">

                        <thead>
                        <tr>
                            <td>id</td>
                            <td> name </td>
                            <td> email </td>
                            <td>amount(BTC)</td>
                            <td>status</td>
                            <td>checkout</td>
                        </tr>
                        </thead>

                        <tbody>
                        {{--@foreach($users as $key => $user)--}}
                            {{--<tr>--}}
                                {{--<td>{{$user->code}}</td>--}}
                                {{--<td>{{$user->name}}</td>--}}
                                {{--<td>{{$user->email}}</td>--}}
                                {{--@if(is_null($user->country))--}}
                                    {{--<td><img width="25" height="20" src="{{URL::asset('flags/error.svg')}}" alt=""></td>--}}
                                {{--@else--}}
                                    {{--<td><img width="25" height="20" src="{{URL::asset('flags/'.$user->country.'.svg')}}" alt=""></td>--}}
                                {{--@endif--}}

                                {{--<td>{{$user->minings->sum('mined_btc')}}</td>--}}

                                {{--@if($user->block == 1)--}}
                                    {{--<td> <button id={{$user->code}} @click="block" class="btn btn-danger"> Blocked </button> </td>--}}
                                {{--@else--}}
                                    {{--<td> <button id={{$user->code}} @click="block" class="btn btn-success"> Active </button> </td>--}}
                                {{--@endif--}}

                                {{--@if($user->minings->sum('mined_btc') >= 0.01)--}}
                                    {{--<td> <button id={{$user->code}} @click="pay" class="btn btn-success"> Pay </button> </td>--}}
                                {{--@else--}}
                                    {{--<td> <button disabled id={{$user->code}} @click="pay" class="btn btn-success"> Pay </button> </td>--}}
                                {{--@endif--}}

                            {{--</tr>--}}
                            <tr v-for="(user,key) in users">
                                <td>@{{user.code}}</td>
                                <td>@{{user.name}}</td>
                                <td>@{{user.email}}</td>
                                <td :id='key'>@{{user.pending}}</td>
                                <td v-if="user.block == 1"> <button :id='user.code' @click="block" class="btn btn-danger"> Blocked </button> </td>
                                <td v-else=""> <button :id='user.code' @click="block" class="btn btn-success"> Active </button> </td>
                                <td v-if="user.pending >= 0.01"> <button :id='user.code' @click="pay(user.code,key)" class="btn btn-success"> Pay </button> </td>
                                <td v-else=""> <button disabled :id='user.code' @click="pay" class="btn btn-success"> Pay </button> </td>
                            </tr>
                        {{--@endforeach--}}
                        </tbody>

                    </table>

                @else

                <h1> No User!</h1>
        @endif
    </div>
    <script>
        new Vue({
            el:'#checkout',
            data:{

                users:[],

            },
            created:function () {
               this.users = {!! DB::table('users')->get() !!}

            },
            methods:{
                pay:function (code,key) {


                    axios.post('{{route('redeem')}}',{'code':code}).then(function (response) {

                        var resp = response.data;
                        if(resp['type'] != 'error'){

                            document.getElementById(code).disable = true;
                            document.getElementById(key).innerHTML = 0;
                            alert(resp['body'])

                        }else{
                            alert(resp['body'])
                        }

                    })
                },
                block:function (e) {
                    var code = String(e.target.id)
                    console.log(this.$refs.code);
                    axios.get('{{route('blockUser')}}'+'?code='+e.target.id).then(function (response) {

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
            },

        })
    </script>
@endsection