<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome/4.7.0/css/font-awesome.min.css') }}"/>
    <title>Login - {{ config('app.name') }}</title>
    <script>
        function genericFunctions() {
            mainMenuAffixLogo();
        }
    </script>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>{{ 'KFC! Admin' }}</h1>
    </div>
    <div class="login-box">
        <form class="login-form" action="{{ route('admin.loginotp.post') }}" method="POST" role="form">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            <div class="form-group">
                <label class="control-label" for="otp">OTP</label>
                <input class="form-control" type="text" id="otp" name="otp" placeholder="OTP" autofocus value="">
            </div>
            <div class="form-group btn-container">
                <input type="hidden" id="email" name="email" value="{{ \Illuminate\Support\Facades\Session::get('email') }}">
                <input type="hidden" id="password" name="password" value="{{ \Illuminate\Support\Facades\Session::get('password') }}">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>GO</button>
            </div>
        </form>
    </div>
</section>
<script src="{{ asset('public/backend/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('public/backend/js/popper.min.js') }}"></script>
<script src="{{ asset('public/backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/backend/js/main.js') }}"></script>
<script src="{{ asset('public/backend/js/plugins/pace.min.js') }}"></script>
<script>
    console.log('%c aamra infotainment Limited \n Frontend Developed by Md. Jusim Uddin Tawhid ', 'background: #000; font-weight:500; color: #fff');
</script>
</body>
</html>
