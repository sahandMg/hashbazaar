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

@foreach($errors->all() as $error)
    <ul>
        <li>
            {{$error}}
        </li>
    </ul>
@endforeach
 <form style="padding: 20px;" method="POST" action="{{route('login')}}">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
       <div class="form-group">
         <label for="exampleInputEmail1">ایمیل</label>
         <input name="email" type="email" class="form-control" value="{{Request::old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل خود را وارد کنید">
       </div>

       <div class="form-group">
         <label for="exampleInputPassword1">رمز</label>
         <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="رمز">
       </div>

        <button type="submit" class="btn btn-primary">ثبت نام </button>

       </form>

</body>
</html>