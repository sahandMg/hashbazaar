<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- <link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Miners Status</title>

</head>
<body>

<div class="container">
    @if(is_null($minerData))
        <h1> No Data Available</h1>
    @else
        <h2>{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($minerData->created_at))}}</h2>
        <br/>
         <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Ip</th>
            <th>Type</th>
            <th>Temp2</th>
            <th>Temp1</th>
            <th>Fan Speed</th>
            <th>Total Th</th>
            <th>Up time</th>
        </tr>
        </thead>
        <tbody>

        @for($i=0;$i<count($data);$i++)
            <tr>
                <td>{{$data[$i]['ip']}}</td>
                <td>{{$data[$i]['minerName']}}</td>
                <td>{{implode( ", ", $data[$i]['temp2'])}}</td>
                <td>{{implode( ", ", $data[$i]['temp1'])}}</td>
                <td>{{implode( ", ", $data[$i]['fanSpeeds'])}}</td>
                <td>{{$data[$i]['totalHashrate']}}</td>
                <td>{{$data[$i]['upTime']}}</td>
            </tr>
        @endfor


        </tbody>
    </table>
  </div>
    @endif
</div>

</body>
</html>