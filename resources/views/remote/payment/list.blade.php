<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<?php
$setting = App\Setting::first();
?>

    <h2 class="title-1 m-b-25 text-right" style="direction: rtl;">لیست تراکنش ها</h2>
    @if(count($transactions) > 0)
    <div class="table-responsive table--no-card m-b-40" style="direction: rtl;">
        <table class="table table-borderless table-striped table-earning">
            <thead>
            <tr class="text-center">
                <th>تاریخ</th>
                {{--<th>تعداد دستگاه</th>--}}
                {{--<th>مدت زمان</th>--}}
                <th>مبلغ پرداختی</th>
                <th>نوع</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
            <tr class="text-center">
                <td>{{\Morilog\Jalali\Jalalian::fromCarbon(Carbon\Carbon::parse($transaction->created_at))->format('d m Y')}}</td>
                <td>{{$transaction->amount}} تومان</td>
                @if(!is_null($transaction->hardware))
                <td>خرید سخت افزار</td>
                 @elseif(!is_null($transaction->subscription))
                <td>خرید اشتراک</td>
                  @endif
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else

        <h2 class="title-1 m-b-25 text-right" style="direction: rtl;">تراکنشی موجود نیست</h2>
    @endif
</body>
</html>