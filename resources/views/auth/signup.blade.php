<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="img/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/singup.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<form method="post" action="{{route('signup')}}" class="login100-form validate-form p-l-55 p-r-55 p-t-178">

					<ul>
						@foreach($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
					<br>
				<input type="hidden" name="_token" value="{{csrf_token()}}">
					<span class="login100-form-title">
						Sign Up
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter your name">
						<input class="input100" type="text" name="name" placeholder="name" value="{{Request::old('name')}}">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input email" data-validate = "Please enter email" >
						<input class="input100" type="email" name="email" placeholder="Email" value="{{Request::old('email')}}">
						<span class="focus-input100"></span>
					</div>
                    
                    <div class="wrap-input100 validate-input pass" data-validate = "Please enter password">
                            <input class="input100" type="password" name="password" placeholder="Password">
                            <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input pass" data-validate = "Please enter password">
                            <input class="input100" type="password" name="confirm_password" placeholder="Confirm password">
                            <span class="focus-input100"></span>
                    </div>






					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
                            Sign Up
                        </button>
					</div>

					<div class="container-socialnet">
						
						<a href="https://facebook.com" class="socialnet-flex" id="fb">
							<img src="/public/img/facebook.svg" alt=""></a>
						
						<a href="https://twitter.com" class="socialnet-flex" id="twttr">
							<img src="/public/img/twitter.svg" alt=""></a>
						
						<a href="https://plus.google.com/+googleplus" class="socialnet-flex" id="gp">
							<img src="/public/img/google-plus.svg" alt=""></a>

					</div>

					<div class="flex-col-c p-t-0 p-b-40">
						<span class="txt1 p-b-9">
                                do you have an account?
						</span>

						<a href="#" class="txt3">
							Log in now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>