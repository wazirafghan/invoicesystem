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
                    <form style="display: block" class="form-horizontal" id="recoverform" method="post" action="{{ route('password.email') }}">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            @csrf
                            <div class="col-xs-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" style="background-color: #4f4f4f">Reset</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12">
                        <a href="{{route('home')}}"><button class="btn  btn-block admin_reset_password">Back</button></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
