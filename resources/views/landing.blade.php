<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <form style="padding: 20px;" method="POST" action="{{route('subscribe')}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label for="name">نام کاربری</label>
            <input name="name" type="name" value="{{Request::old('name')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام کاربری خود را وارد کنید">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">ایمیل</label>
            <input name="email" type="email" class="form-control" value="{{Request::old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل خود را وارد کنید">
        </div>
        <label for="plan1"> < 0.5 BTC </label>
        <input id="plan2" type="radio" name="plan" value="lt0.5">
        <br>
        <label for="plan2"> 0.5-1 BTC </label>
        <input id="plan2" type="radio" name="plan" value="0.5-1">
        <br>
        <label for="plan3"> 1-2 BTC </label>
        <input id="plan3" type="radio" name="plan" value="1-2">
        <br>
        <label for="plan4"> 2 > BTC </label>
        <input id="plan4" type="radio" name="plan" value="gt2">

        <br>

        <label for="period1"> 1 month </label>
        <input id="period1" type="radio" name="period" value="1m">
        <br>
        <label for="period2"> 3 month </label>
        <input id="period2" type="radio" name="period" value="3m">
        <br>
        <label for="period3"> 6 month </label>
        <input id="period3" type="radio" name="period" value="6m">
        <br>
        <label for="period4"> 1 year </label>
        <input id="period4" type="radio" name="period" value="1y">

        <br>
        <button type="submit" class="btn btn-primary">ثبت نام </button>

    </form>
    
     <form style="padding: 20px;" method="POST" action="{{route('message')}}">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
           <div class="form-group">
             <label for="name">نام کاربری</label>
             <input name="name" type="name" value="{{Request::old('name')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام کاربری خود را وارد کنید">
           </div>
     
           <div class="form-group">
             <label for="exampleInputEmail1">ایمیل</label>
             <input name="email" type="email" class="form-control" value="{{Request::old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل خود را وارد کنید">
           </div>

         <textarea name="message" id="" cols="30" rows="10"></textarea>
            <button type="submit" class="btn btn-primary">ثبت نام </button>
     
           </form>
    
    
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
