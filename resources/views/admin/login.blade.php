@extends('master.layout')
@section('title')
    <title>Login</title>
@endsection
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                @include('formError')
                <form method="post" action="{{route('AdminLogin')}}" class="login100-form validate-form p-l-55 p-r-55 p-t-178">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li style="color: red;margin-bottom: 1%;">{{$error}}</li>
                        @endforeach
                    </ul>
                    @if(session()->has('error'))
                        <p style="color: red">{{session('error')}}</p>
                    @endif
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <span class="login100-form-title">
						{{__("Login")}}
					</span>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
                        <input class="input100" name="email" type="email"  value="{{Request::old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address">
                        <span class="focus-input100"></span>

                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Please enter password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                    </div>

                    <br><br><br>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            {{__("Login")}}
                        </button>
                    </div>
                    <br><br><br>

                </form>
            </div>
        </div>
    </div>

    @include('master.footer')
    <!--===============================================================================================-->
    <!-- <script src="vendor/jquery/jquery-3.2.1.min.js"></script> -->
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

@endsection