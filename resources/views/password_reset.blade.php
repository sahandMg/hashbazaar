@extends('master.layout')
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
						Reset Password
					</span>

                    <div class="wrap-input100 validate-input m-b-26 login100" style="color: black">
                           <span>...</span> 
                    </div>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
                        <input class="input100" name="email" type="email"  value="{{Request::old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address">
						<span class="focus-input100"></span>
					</div>

					

					<div class="container-login100-form-btn p-t-5 p-b-36">
						<button class="login100-form-btn">
							Send Email
						</button>
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
@endsection