<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
<div id="app" class="container">

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>OrderID</th>
                <th>User</th>
                <th>Country</th>
                <th>Amount</th>
                <th>Confirmed</th>
                <th>UnRecognised</th>
                <th>Processed</th>
                <th>Record Created</th>

            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $key=>$transaction)

                <tr>
                    <td>{{$transaction->paymentID}}</td>
                    <td>{{$transaction->orderID}}</td>
                    <td>{{DB::table('users')->where('id',$transaction->userID)->first()->name}}</td>
                    <td>{{$transaction->countryID}}</td>
                    <td>{{$transaction->amount}}</td>
                    <td id="confirmed{{$key}}">{{$transaction->txConfirmed}}</td>
                    <td id="unrecognised{{$key}}">{{$transaction->unrecognised}}</td>
                    <td id="processed{{$key}}">{{$transaction->processed}}</td>
                    <td>{{$transaction->recordCreated}}</td>
                </tr>

            @endforeach
        </tbody>
    </table>

    <a href="{{route('main')}}"><button class="btn btn-primary">Back</button></a>
</div>

<script>

    new Vue({
        el:'#app',
        data:{
            transactions:[]
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

                for(i=0 ; i< vm.transactions.length; i++){

                    document.getElementById('confirmed'+i).innerHTML = vm.transactions[i]['txConfirmed'];
                    document.getElementById('unrecognised'+i).innerHTML = vm.transactions[i]['unrecognised'];
                    document.getElementById('processed'+i).innerHTML = vm.transactions[i]['processed'];
                }
            }
        }
    });

</script>

</body>
</html>