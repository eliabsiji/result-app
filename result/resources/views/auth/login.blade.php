<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<title>:: Epic :: Login</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="{{ asset('assets/assets/plugins/bootstrap/css/bootstrap.min.css') }}" />

<!-- Core css -->
<link rel="stylesheet" href="{{ asset('assets/assets/css/style.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/asset/vendor/animate.css/animate.css')}}">

</head>
<body class="font-muli theme-cyan gradient animated slideInDown">

<div class="auth option2">
    <div class="auth_left">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <a class="header-brand" href="index.html"><i class="fa fa-graduation-cap brand-logo"></i></a>
                    <div class="card-title mt-3">Login to your account</div>

                </div>
             <form method="POST" action="{{ route('login') }}" >
                    @csrf
                <div class="form-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <label class="form-label"><a href="forgot-password.html" class="float-right small">I forgot password</a></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" />
                    <span class="custom-control-label">Remember me</span>
                    </label>
                </div>
                <div class="text-center">
                    <button type="submit"  class="btn btn-primary btn-block">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Start Main project js, jQuery, Bootstrap -->
<script src="{{ asset('assets/assets/bundles/lib.vendor.bundle.js')}}"></script>

<!-- Start project main js  and page js -->
<script src="{{ asset('assets/assets/js/core.js')}}"></script>
</body>
</html>
