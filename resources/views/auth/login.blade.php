@extends('master.layout')
@section('title')
	<title>Login</title>
@endsection
@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="post" action="{{route('login')}}" class="login100-form validate-form p-l-55 p-r-55 p-t-178">
				    <ul>
						@foreach($errors->all() as $error)
							<li style="color: red;margin-bottom: 1%;">{{$error}}</li>
						@endforeach
					</ul>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
						<span class="login100-form-title">
						Log In
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
                        <input class="input100" name="email" type="email"  value="{{Request::old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Please enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							Forgot
						</span>

						<a href="{{route('passwordReset')}}" class="txt2">
							Password?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Log in
						</button>
					</div>

					<div class="container-socialnet">
						
						{{-- <a href="https://facebook.com" class="socialnet-flex" id="fb"><img src="img/icons/facebook.svg" alt=""></a>
						
						<a href="https://twitter.com" class="socialnet-flex" id="twttr"><img src="img/icons/twitter.svg" alt=""></a> --}}
						
						{{-- <a href="https://plus.google.com/+googleplus" class="socialnet-flex" id="gp"><img src="../../../public/img/googleicon.png" alt=""></a> --}}
						{{-- <a href="{{route('redirectToProvider')}}" class="socialnet-flex" id="gp"><img src="img/icons/googleicon.png" alt=""></a> --}}

						<a href="#" class="socialnet-flex" id="gp">
							<img src="img/icons/googleicon.png" alt=""></a>
						{{-- alt="Join With Google Account" --}}
					</div>

					<div class="flex-col-c p-t-0 p-b-40">
						<span class="txt1 p-b-9">
							Don’t have an account?
						</span>

						<a href="{{route('signup')}}" class="txt3">
							Sign up now
						</a>
					</div>
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