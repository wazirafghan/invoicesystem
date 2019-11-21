<?php
$settings = \App\Setting::pluck('value','name')->toArray();
if(isset($settings['logo'])) {
    $logo = $settings['logo'];
}else {
    $logo = "logo.png";
}
if(isset($settings['lg_logo'])) {
    $lg_logo = $settings['lg_logo'];
}else {
    $lg_logo = "placeholder.jpg";
}
if(isset($settings['contact_number'])) {
    $contact_number = $settings['contact_number'];
}else {
    $contact_number = "111-2222-55555";
}
if(isset($settings['facebook_page_url'])) {
    $facebook_url = $settings['facebook_page_url'];
}else {
    $facebook_url = "http://www.facebook.com/";
}
if(isset($settings['twitter_url'])) {
    $twitter_url = $settings['twitter_url'];
}else {
    $twitter_url = "http://www.twitter.com/";
}
if(isset($settings['linkedin_url'])) {
    $linkedin_url = $settings['linkedin_url'];
}else {
    $linkedin_url = "http://www.linkedin.com/";
}
if(isset($settings['contact_info'])) {
    $contact_info = $settings['contact_info'];
}else {
    $contact_info = "loading.....";
}
if(isset($settings['email'])) {
    $email = $settings['email'];
}else {
    $email = "loading.....";
}
if(isset($settings['theme_color'])) {
    $theme_color = $settings['theme_color'];
}else {
    $theme_color = "#000";
}
?>
@section('stylesheets')

@endsection


<!-- Header -->

<!-- header -->
<header style="background-color: #444;">
    <div class="container">
        <div class="row" style="padding:0 15px 0 15px;">
            <div class="topnav" id="myTopnav">
                <!-- <a href="#"><span id="logo-img-hd"><img src="images/logo.png"></span>Invoice Simple</a> -->
                <!-- Logo -->
                <a href="{{route('home')}}" class="navbar-brand">
                    @if(File::exists('uploads/'.$logo))
                        <img class="logo-small" alt="Porto" width="140px" src="{{asset('uploads/'.$logo)}}">
                    @else
                        <img class="logo-small" alt="Porto" width="80%"  src="{{asset('uploads/logo.png')}}">
                    @endif
                </a>
                <a href="{{route('user-dashboard')}}" class="active">Invoices</a>
                <a href="#">estimates</a>
                <a href="#">clients</a>
                <a href="#">items</a>
                <a href="#">settings</a>

                <div style="float:right">
                    @if (Auth::check())
                <a href="{{route('logout')}}" title="logout" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                   title="Your Invoices" class="btn-register"><i class="fa fa-sign-out full-right"></i>  Sign Out </a>

                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    @else
                </div>
                    <div class="hd-rtt" style="float: right">
                        <!-- <a href="{{url("/login")}}" style="color:white !important"></span>Login </a>
                        <a href={{url("/register")}}" class="btn btn-light" id="sigup-button"></span> Sign Up</a> -->

                        <a href="{{url("/login")}}" title="Login"><i class="fa fa-sign-in full-right"></i> SIGN IN </a>

                        <a href="{{url("/register")}}" title="Register Here" class="btn-register" id="sigup-button"><i class="fa fa-user full-right"></i>  SIGN UP </a>
                    </div>
                @endif
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </div>
</header>
