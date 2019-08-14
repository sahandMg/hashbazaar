<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Miners Status</title>

        <?php


        ?>
</head>
<body>

    <div class="container">
        <h2><td style="font-weight:bold ">{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($minerData->created_at))}}</td></h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>Ip</td>
                <td>Type</td>
                <td>Temp2</td>
                <td>Temp1</td>
            </tr>
            </thead>
            <tbody>

                @for($i=0;$i<count(unserialize($minerData->data));$i++)
                    <tr>
                        <td>{{unserialize($minerData->data)[$i]['ip']}}</td>
                        <td>{{unserialize($minerData->data)[$i]['minerName']}}</td>
                        <td>{{implode( ", ", unserialize($minerData->data)[$i]['temp2'])}}</td>
                        <td>{{implode( ", ", unserialize($minerData->data)[$i]['temp1'])}}</td>
                    </tr>
                @endfor


            </tbody>
        </table>

    </div>

</body>
</html>