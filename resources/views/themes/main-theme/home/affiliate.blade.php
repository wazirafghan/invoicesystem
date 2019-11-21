@extends('themes.main-theme.layouts.master')
<?php
if(isset($settings['site_title'])) {
    $title = $settings['site_title'];
}else {
    $title = "no title";
}
?>
@section('title',$title)
@section('stylesheets')
    <style type="text/css">
        .page_heading {
            margin: 0;
            min-height: 250px;
            padding: 30px 0;
            background-size: cover;
            -webkit-background-size: cover;
            border-bottom: 1px solid #F1F1F1;
            text-align: center;
        }
        .page_heading h1{
            margin-top: 60px;
            margin-bottom: 0;
            font-size: 40px;
        }

        .page_heading h3{
            color: #525252;
            text-align: center;

        }
        .features{
            margin-top: 30px;
            text-align: center;
        }
        .heading{
            margin-top: 60px;
            padding: 20px 0;
            text-align: center;
        }
        .heading .inner_limit{
            max-width: 90%;
            padding: 0 20px;
            margin: 0 auto;
            overflow: hidden;
        }
        .heading span{
            position: relative;
            padding: 0 20px;
            background: #FFF;
            font-weight: 500;
        }
        .heading .inner_limit{
            border-bottom: 1px solid #313131;
        }

        .heading img{
            width: 100%;
            margin-top: 60px;
        }
        .heading label{
            text-align: left;
        }
        .question h3{
            font: bold 14px 'Open Sans Bold', 'Open Sans', 'Arial', sans-serif;
            font-size: 18px;
            color: #4099ff;

            padding: 15px 0;
            margin-top: 30px;
            text-align: left;

        }
        .question h3:hover{
            cursor: pointer;
        }
        .question p{
            text-align: left;
            display: none;
        }

        .rw{
            border-bottom: 1px solid #F1F1F1;
        }

    </style>
@endsection
@section('content')
    <?php
    if(isset($settings['logo'])) {
        $logo = $settings['logo'];
    }else {
        $logo = "placeholder.jpg";
    }
    if(isset($settings['contact_number'])) {
        $contact_number = $settings['contact_number'];
    }else {
        $contact_number = "111-2222-55555";
    }
    if(isset($settings['facebook_page_url'])) {
        $facebook_page_url = $settings['facebook_page_url'];
    }else {
        $facebook_page_url = "http://www.facebook.com/";
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
    if(isset($settings['address'])) {
        $address = $settings['address'];
    }else {
        $address = "loading.....";
    }
    if(isset($settings['email'])) {
        $email = $settings['email'];
    }else {
        $email = "loading.....";
    }
    if(isset($settings['site_key'])) {
        $site_key = $settings['site_key'];
    }else {
        $site_key = "6LdoXpIUAAAAAFBc1E9OOUkbPOJCzIQ8jX2-99Ua";
    }
    if(isset($settings['secret_key'])) {
        $secret_key = $settings['secret_key'];
    }else {
        $secret_key = "6LdoXpIUAAAAAIxbg_1LcghcCLK4QyQJrg3CtVW0";
    }
    if(isset($settings['get_in_touch'])) {
        $get_in_touch = $settings['get_in_touch'];
    }else {
        $get_in_touch = "loading.....";
    }
    ?>
    @if(Session::has('success_message'))
        <div class="alert alert-success">
            {{ Session::get('success_message') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @endif
    <div class="container-fluid">

        <!-- .row -->
        <div class="row" style="margin-top: 30px">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="page_heading">
                        <h1>The No.1 SEO Affiliate Program</h1>
                        <h3>Top Reasons To Join</h3>
                    </div>
                    <div class="features">
                        <div class="row">
                            <div class="col-md-6">
                                <img width="420" height="88" src="{{asset("uploads/1.png")}}" alt="">
                                <h3>10% Commission On All Sales</h3>
                                <p>We provide a competitive 10% commission on all sales, enabling affiliates to earn a great income from their efforts. </p>
                            </div>
                            <div class="col-md-6">
                                <img width="420" height="88" src="{{asset("uploads/2.png")}}" alt="">
                                <h3>It is Simple</h3>
                                <p>Easily use your refer link to earn commissions. Once a user clicks on the link and places an order, it will be tracked and your commission will be too.</p>
                            </div>
                            <div class="col-md-6">
                                <img width="420" height="88" src="{{asset("uploads/3.png")}}" alt="">
                                <h3>PayPal Payouts</h3>
                                <p>We use PayPal to make payments for affiliate payouts, which is done at the end of each month.</p>
                            </div>
                            <div class="col-md-6">
                                <img width="420" height="88" src="{{asset("uploads/4.png")}}" alt="">
                                <h3>Awesome Sales Follow Up</h3>
                                <p>We work closely with clients to ensure we have long-term rapports; this enables you to earn more.</p>
                            </div>

                        </div>


                    </div>

                    <div class="heading">
                        <div class="inner_limit">
                            <h2><span>Easily Track Sign Ups and Earnings</span></h2>

                        </div>

                        <img src="{{asset("uploads/earn.png")}}" width="100%" alt="">
                        <h3>Our simple-to-use affiliate panel allows you to easily see how you are performing.</h3>
                    </div>

                    <div class="heading">
                        <div class="inner_limit">
                            <h2><span>Manage and Track Your Payouts</span></h2>

                        </div>

                        <img src="{{asset("uploads/track.png")}}" width="100%" alt="">
                        <h3>Payments are made and finalized at the end of each month using PayPal.</h3>
                    </div>

                    <div class="heading">
                        <div class="inner_limit">
                            <h2><span>Ready to be Make some Money? Apply Below.</span></h2>

                        </div>
                        <form action="{{route("add-affiliate")}}" method="post">
                            @csrf
                            <div class="row" style="margin-top: 65px">
                                <div class="col-sm-12">
                                    <div class="col-sm-4 " style="">
                                        <label for="">Name*</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('f_name') ? 'has-error' : '' }}">
                                            <input type="text" name="f_name" class="form-control" placeholder="First name">
                                            <span class="text-danger">{{ $errors->first('f_name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('l_name') ? 'has-error' : '' }}">
                                            <input type="text" name="l_name" class="form-control" placeholder="Last name">
                                            <span class="text-danger">{{ $errors->first('l_name') }}</span>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="row form-group" style="margin-top: 35px">
                                <div class="col-sm-12">
                                    <div class="col-sm-4 " style="">
                                        <label for="">Your Email*</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <input type="text" name="email" class="form-control" placeholder="Email">
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('c_email') ? 'has-error' : '' }}">
                                            <input type="text" name="c_email" class="form-control" placeholder="Confirm Email">
                                            <span class="text-danger">{{ $errors->first('c_email') }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row form-group" style="margin-top: 35px">
                                <div class="col-sm-12">
                                    <div class="col-sm-4 " style="">
                                        <label for="">Your Password*</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group ">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row form-group" style="margin-top: 35px">
                                <div class="col-sm-12">
                                    <div class="col-sm-4 " style="">
                                        <label for="">Please explain how and where you might be planning to promote INETVENTURES's products and services.*</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                            <textarea name="description" placeholder="Remember to include links to any websites or blogs where you might promote INETVENTURES." class="form-control"  id="" cols="30" rows="10"></textarea>
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row form-group" style="margin-top: 35px">
                                <div class="col-sm-12">
                                    <div class="col-sm-10 " style="">
                                        <button type="submit" class="btn btn-info pull-right">APPLY</button>
                                    </div>


                                </div>

                            </div>
                        </form>

                    </div>

                    <div class="heading">
                        <div class="inner_limit">
                            <h2><span>Frequently Asked Questions</span></h2>

                        </div>

                        <div class="row question">
                            <div class="col-sm-10 col-sm-offset-1 rw">
                                <h3 class="ques">What is the INETVENTURES SEO Affiliate Program?</h3>
                                <p>The INETVENTURES SEO affiliate program is a way for you to earn money by promoting INETVENTURES products and services and sending customers our way.</p>
                            </div>

                        </div>

                        <div class="row question">
                            <div class="col-sm-10 col-sm-offset-1 rw">
                                <h3 class="ques">How does it work?</h3>
                                <p>In your account, you’ll get a unique affiliate tracking code which you can place in your blog reviews, social channels, video content descriptions or any marketing campaigns you conduct.
                                    <br>

                                    When someone clicks on that link and signs up for an account or places an order for our SEO services, you’ll be automatically tagged as the referrer and you’ll earn commission for every order that customer for their lifetime account.</p>
                            </div>

                        </div>

                        <div class="row question">
                            <div class="col-sm-10 col-sm-offset-1 rw">
                                <h3 class="ques">How much commission can I earn?</h3>
                                <p>With our industry leading SEO affiliate program you’ll get 10% of every single purchase a sign up you refer places for their lifetime. On average a client stays with INETVENTURES for more than 12 months, so you’ll earn commission from that client for every order, every month! This is a real opportunity where your commission is likely to grow each month the more customers you refer.</p>
                            </div>

                        </div>

                        <div class="row question">
                            <div class="col-sm-10 col-sm-offset-1 rw">
                                <h3 class="ques">How long do you track cookies for?</h3>
                                <p>Every customer you refer through your affiliate link will be tracked for 30 days. So if they don’t sign up day 1, but they do on day 28 then you’ll still be tracked as the referrer and you’ll earn commission on every purchase they make.</p>
                            </div>

                        </div>

                        <div class="row question">
                            <div class="col-sm-10 col-sm-offset-1 rw">
                                <h3 class="ques">Can I generate affiliate commissions from my own orders?</h3>
                                <p>No. This is pretty standard. Our system will detect commission that cross-references to other accounts based on IP, location and similar details.</p>
                            </div>

                        </div>



                    </div>

                </div>
            </div>
        </div>


        <!-- .row -->
        <!-- .right-sidebar -->

        <!-- /.right-sidebar -->
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $(".ques").click(function () {
            $(this).parent().find("p").toggle();

        });
    </script>
@endsection
