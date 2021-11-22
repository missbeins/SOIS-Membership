<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Membership') }}</title>
  
  <link href="{{ asset('css/homelogin.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
  
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body">
          <div class="logo mb-3 text-center">
						<img src="{{ asset('images/PUP_logo-transparent.png') }}" width="100px">
					</div>
					<div class="title heading mb-4 text-center mt-4">
						<h4>{{ __('Welcome to Membership') }}</h4>
					 </div>
           
          <form class="form-box px-3" method="POST" action="{{ route('login') }}">
            @csrf
           
            
              <div class="form-input">
                <span><i class="fa fa-envelope-o"></i></span>
                <input type="email"name="email" placeholder="Email Address" tabindex="10" value="{{ old('email') }}" required autocomplete="email" >  
               
              </div>
             

              <div class="form-input">
                <span><i class="fa fa-key"></i></span>
                <input type="password"name="password" placeholder="Password" required autocomplete="current-password">
               
              </div>
            
            

            <div class="mb-3">
              <button type="submit" class="btn btn-block text-uppercase">
                Login
              </button>
            </div>

            <div class="text-right">
              @if (Route::has('password.request'))
                  <a class="btn btn-link  " href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                  </a>
              @endif
              
            </div>

            <hr class="my-4">

            <div class="text-center mb-2">
              Don't have an account?
              <a href="{{ route('verify-applicant') }}" class="register-link">
                Register here
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>