<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/main_style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <title>Login</title>
</head>
<?php $settings = \App\Setting::pluck('value','name')->toArray(); $logo = isset($settings['logo'])?$settings['logo']:''; ?>

<body style="background-color: #444444">
<section id="login-register" >
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-register">

                    <div class="login-heading text-center">
                        <a href="javascript:void(0)" class="text-center db"><img src="{{asset("uploads/$logo")}}" alt="Home" width="150px" /></a>
                    </div>

                    <form  id="loginform" method="post" action="{{ route('register') }}">
                        <h3 class="head title text-center">Register Now</h3><small>Create your account and enjoy</small>
                        @csrf
                        <div class="form-group">
                            <label for="name">Name </label>
                            <input id="name" type="text" placeholder="Name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email </label>
                            <input id="email" type="email"  placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                                @if(isset($_GET['affiliate']))
                                    <input type="hidden" name="code" value="{{$_GET['affiliate']}}">
                                @endif
                        </div>
                        <div class="form-group text-center m-t-20">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" style="background-color: #4f4f4f">Sign Up</button>
                        </div>
                        <div class="form-group m-b-0">
                            <p>Already have an account? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Sign In</b></a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
