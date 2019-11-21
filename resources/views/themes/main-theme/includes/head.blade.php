<?php
if(isset($settings['theme_color'])) {
    $theme_color = $settings['theme_color'];
}else {
    $theme_color = "#c73c1c";
}
if(isset($settings['favicon'])) {
    $favicon = $settings['favicon'];
}else {
    $favicon = "img/favicon.ico";
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset("uploads/$favicon")}}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{asset("uploads/$favicon")}}">
    <title>@yield('title')</title>

    <meta  name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('theme/css/theme.css') }}">

    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/main_style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/plugins/bower_components/sweetalert/sweetalert.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("admin/plugins/bower_components/sweetalert/sweetalert.css")}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!--  -->



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

    @yield('stylesheets')
</head>

