<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/main_style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <title>Password reset</title>
</head>
<?php $settings = \App\Setting::pluck('value','name')->toArray(); $logo = isset($settings['logo'])?$settings['logo']:''; ?>

<body style="background-color: #444444">
<section id="login-register" >
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-register">

                    <form  method="post" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}"">

                    <a href="javascript:void(0)" class="text-center db"><img src="{{asset('admin/plugins/images/admin-logo-dark.png')}}" alt="Home" /><br/><img src="{{asset('admin/plugins/images/admin-text-dark.png')}}" alt="Home" /></a>
                    @csrf
                        <div class="form-group">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input id="email" placeholder="Email Address" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
