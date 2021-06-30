<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Login | Bamthobe</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,500;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
<style>
body { font-family: 'DM Sans', sans-serif; background-color: #babaef; min-height: 100vh; }

.brand-wrapper h3 { font-family: 'DM Sans', sans-serif; text-transform: uppercase; font-weight:600; }
.brand-wrapper { margin-bottom: 19px; }
.login-card { border: 0; border-radius: 27.5px; box-shadow: 0 10px 30px 0 rgba(172, 168, 168, 0.43); overflow: hidden; }
.login-card-img { border-radius: 0; position: absolute; width: 100%; height: 100%; -o-object-fit: cover; object-fit: cover; }
.login-card .card-body { padding: 85px 60px 60px; }
 @media (max-width: 422px) {
 .login-card .card-body {
 padding: 35px 24px;
}
}
.login-card-description { font-size: 20px; color: #737373; font-weight: normal; margin-bottom: 23px; }
.login-card form { max-width: 326px; }
.login-card .form-control { border: 1px solid #d5dae2; padding: 15px 25px; margin-bottom: 20px; min-height: 45px; font-size: 13px; line-height: 15; font-weight: normal; }
 .login-card .form-control::-webkit-input-placeholder {
 color: #919aa3;
}
 .login-card .form-control::-moz-placeholder {
 color: #919aa3;
}
 .login-card .form-control:-ms-input-placeholder {
 color: #919aa3;
}
 .login-card .form-control::-ms-input-placeholder {
 color: #919aa3;
}
 .login-card .form-control::placeholder {
 color: #919aa3;
}
.login-card .login-btn { padding: 13px 20px 12px; background-color: #000; border-radius: 4px; font-size: 17px; font-weight: bold; line-height: 20px; color: #fff; margin-bottom: 24px; }
.login-card .login-btn:hover { border: 1px solid #000; background-color: transparent; color: #000; }
.login-card .forgot-password-link { font-size: 14px; color: #919aa3; margin-bottom: 12px; display:inline-block;     color: #777; }
.login-card-footer-text { font-size: 16px; color: #656565; margin-bottom: 60px; }
 @media (max-width: 767px) {
 .login-card-footer-text {
 margin-bottom: 24px;
}
}
.login-card-footer-nav a { font-size: 14px; color: #919aa3; }
span.error-report { font-size: 12px; color: red; position: absolute; bottom: -23px; }
.form-group { margin-bottom: 30px; position: relative; }

.text-reset {
color: #0f0f31 !important;}
</style>
</head>
<body>
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
  <div class="container">
    <div class="card login-card">
      <div class="row no-gutters">
        <div class="col-md-5"> <img src="{{ asset('assets/img/kan3.jpg') }}" alt="login" class="login-card-img"> </div>
        <div class="col-md-7">
          <div class="card-body">
            <div class="brand-wrapper">
              <h3> Bamthobe</h3>
            </div>
            <p class="login-card-description">Sign into your account</p>
            <form method="POST" action="{{url('/admin/login')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label class="control-label"  class="sr-only">
                Username
                </label>
                <input type="text" placeholder="example@gmail.com" title="Please enter you username" name="email" value="{{old('email')}}" class="form-control">
                <span class="error-report"> @if($errors->has('email'))
                
                {{$errors->first('email')}}
                
                @endif</span> </div>
              <div class="form-group">
                <label class="control-label"class="sr-only">
                Password
                </label>
                <input type="password" title="Please enter your password" placeholder="******" name="password" value="{{old('password')}}" class="form-control">
                <span class="error-report"> @if($errors->has('password'))
                
                {{$errors->first('password')}}
                
                @endif </span> </div>
              <button class="btn btn-block login-btn mb-">Login</button>
            </form>
            <a href="#" class="forgot-password-link mb-4">Forgot password?</a>

            <nav class="login-card-footer-nav"> <a href="#!">2021 © Bamthobe.</a> <a href="#!">
Design &amp Develop by adsandurl</a> </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>