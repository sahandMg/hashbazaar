@extends('admin.master.header')
@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>OrderID</th>
            <th>TH/S</th>
            <th>User</th>
            <th>Country</th>
            <th>Amount(BTC)</th>
            <th>Confirmed</th>
            <th>UnRecognised</th>
            <th>Processed</th>
            <th>Record Created</th>

        </tr>
        </thead>
        <tbody>

        @foreach($transactions as $transaction)
            <tr>
                <td>{{$transaction->paymentID}}</td>
                <td>{{$transaction->orderID}}</td>
                <?php
                $query = DB::table('bit_hashes')->where('order_id',$transaction->orderID)->first();
                if(!is_null($query)){
                    $query = $query->hash;
                }else{
                    $query ='Deleted';
                }
                ?>
                <td> {{$query}} </td>
                <td>{{$transaction->userID}}</td>
                <td><img width="25" height="20" src="../flags/{{strtolower(substr($transaction->countryID,0,2))}}.svg" alt="{{$transaction->countryID}}"></td>
                <td>{{$transaction->amount}}</td>
                <td>{{$transaction->txConfirmed}}</td>
                <td>{{$transaction->unrecognised}}</td>
                <td>{{$transaction->processed}}</td>
                <td>{{$transaction->recordCreated}}</td>
            </tr>
        @endforeach
        {{--<tr v-for="(transaction, index) in transactions">--}}
        {{--<td>@{{transaction.paymentID}}</td>--}}
        {{--<td>@{{transaction.orderID}}</td>--}}
        {{--<td>@{{transaction.userID}}</td>--}}
        {{--<td><img width="25" height="20" :src="flag" alt="">@{{ readFlag(transaction.countryID) }}</td>--}}
        {{--<td>@{{transaction.amount.toFixed(6)}}</td>--}}
        {{--<td id="confirmed">@{{transaction.txConfirmed}}</td>--}}
        {{--<td id="unrecognised">@{{transaction.unrecognised}}</td>--}}
        {{--<td id="processed">@{{transaction.processed}}</td>--}}
        {{--<td>@{{transaction.recordCreated}}</td>--}}
        {{--</tr>--}}


        </tbody>
    </table>
    {{ $transactions->links() }}
    </div>
    {{ $transactions->links() }}
    <script>

        new Vue({
            el:'.app',
            data:{
                transactions:[],
                flag:''

            },

            created:function () {

                this.getTrans()

            },
            methods:{

                getTrans:function () {

                    vm = this;


                    axios.get({!! json_encode(route('adminGetTransactions')) !!}).then(function (response) {

                        vm.transactions = response.data;

                    });

                    setTimeout(function () {

                        vm.getTrans()
                    },10000);
//
//                for(i=0 ; i< vm.transactions.length; i++){
//
//                    document.getElementById('confirmed'+i).innerHTML = vm.transactions[i]['txConfirmed'];
//                    document.getElementById('unrecognised'+i).innerHTML = vm.transactions[i]['unrecognised'];
//                    document.getElementById('processed'+i).innerHTML = vm.transactions[i]['processed'];
//                }
                },
                readFlag: function (country) {

                    this.flag = '../flags/'+country.substr(0,2).toLowerCase()+'.svg'

                }
            },

        });

    </script>

@endsection