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

        .pay_logo {
            font-family: Verdana, Tahoma;
            font-weight: bold;
            font-size: 26px;
        }
        .pay_logo .pay {
            color: #253b80;
        }

        .pay_logo .pay {
            color: #179bd7;
        }





        button {
            padding: 15px 30px;
            border: 1px solid #FF9933;
            border-radius: 5px;
            background-image: linear-gradient(#FFF0A8, #F9B421);
            margin: 0 auto;
            display: block;
            min-width: 138px;
            position: relative;
            margin-top: 30px;
        }

        title {
             font-size: 14px;
             color: #505050;
             vertical-align: baseline;
             text-shadow: 0px 1px 0px rgba(255, 255, 255, 0.6);
         }

        .paypal-logo {
            display: inline-block;
            text-shadow: 0px 1px 0px rgba(255, 255, 255, 0.6);
            font-size: 20px;
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
    @if(Session::has('error_message'))
        <div class="alert alert-danger">
            {{ Session::get('error_message') }}
        </div>
    @endif
    @if(Session::has('danger_message'))
        <div class="alert alert-danger">
            {{ Session::get('danger_message') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row bg-title">
            <!-- .page title -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Payment</h4> </div>
            <!-- /.page title -->
            <!-- .breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Payment</li>
                </ol>
            </div>
            <!-- /.breadcrumb -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Order Payment</h3>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
                            <form accept-charset="UTF-8" action="{{ route('processCheckoutPaypal') }}" class=""
                                  data-cc-on-file="false"
                                  data-stripe-publishable-key="pk_test_H0n8RftpV3rgITLNU4HpFqMs"
                                  id="payment-form" method="post">
                                {{ csrf_field() }}

                                <div class='form-row'>
                                    <div class='col-xs-12 form-group '>
                                        <label class='control-label'>Coupon Code</label> <input
                                            autocomplete='off' class='form-control card-number' placeholder="Enter Coupon Code for Discount or Leave it blank"
                                            type='text' name="coupon_code">

                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='col-md-12'>
                                        <div class='form-control total btn btn-info'>
                                            Total: <span class='amount'>{{session()->get('order_total')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='col-md-12 form-group'>
                                        <button class="paypal-button">
                                            <span class="paypal-button-title">
                                              Pay with
                                            </span>
                                            <span class="pay_logo">
                                              <i class="pay">Pay</i><i class="pal">Pal</i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='col-md-12 error form-group hide'>
                                        <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                    </div>
                                </div>
                            </form>
                            @if ((Session::has('success-message')))
                                <div class="alert alert-success col-md-12">{{
                                     Session::get('success-message') }}</div>
                            @endif @if ((Session::has('fail-message')))
                                <div class="alert alert-danger col-md-12">{{
                                      Session::get('fail-message') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row" style="margin-top: 50px">
                        <div class="col-sm-4">
                            <a href="{{route('user-dashboard')}}" class="btn btn-default">< Back</a>
                        </div>
                        @if($order->status == 0)
                        <div class="col-sm-4">
                            <img src="{{asset('uploads/pay_sec.png')}}" alt="">
                        </div>

                        @endif
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
        $(".paypal-button").click(function () {
            setTimeout(function(){
                $(this).attr("disabled","disabled"); }, 3000);

        });
    </script>
@endsection
