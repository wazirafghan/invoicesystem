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
        .center{
            text-align: center;
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
    if(isset($settings['publishable_key'])) {
        $publishable_key = $settings['publishable_key'];
    }else {
        $publishable_key = "";
    }
    ?>
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
                            <form accept-charset="UTF-8" action="{{ route('processCheckout') }}" class="require-validation"
                                  data-cc-on-file="false"
                                  data-stripe-publishable-key="{{$publishable_key}}"
                                  id="payment-form" method="post">
                                {{ csrf_field() }}
                                <div class='form-row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>Name on Card</label> <input
                                            class='form-control' size='4' type='text'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='col-xs-12 form-group card required'>
                                        <label class='control-label'>Card Number</label> <input
                                            autocomplete='off' class='form-control card-number' size='20'
                                            type='text'>
                                    </div>
                                </div>
                                <div class='form-row'>
                                    <div class='col-xs-4 form-group cvc required'>
                                        <label class='control-label'>CVC</label> <input
                                            autocomplete='off' class='form-control card-cvc'
                                            placeholder='ex. 311' size='4' type='text'>
                                    </div>
                                    <div class='col-xs-4 form-group expiration required'>
                                        <label class='control-label'>Expiration</label> <input
                                            class='form-control card-expiry-month' placeholder='MM' size='2'
                                            type='text'>
                                    </div>
                                    <div class='col-xs-4 form-group expiration required'>
                                        <label class='control-label'> </label> <input
                                            class='form-control card-expiry-year' placeholder='YYYY'
                                            size='4' type='text'>
                                    </div>
                                </div>
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
                                        <button class='form-control btn btn-primary submit-button'
                                                type='submit' style="margin-top: 10px;">Pay »</button>
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
                            <img src="{{asset('uploads/stripe.png')}}" width="100%" alt="">
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
    <script>
        $(function() {
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(e.target).closest('form'),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid         = true;

                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault(); // cancel on first error
                    }
                });
            });
        });

        $(function() {
            var $form = $("#payment-form");

            $form.on('submit', function(e) {
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        })
    </script>
    <cfoutput>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDyeh6lPdPY-BAnF2uEqnQW3d7p1CpSK0M&sensor=false&region=SA&components=country:SA"></script>
    </cfoutput>
    <script type="text/javascript">
        //<![CDATA[

        // global "map" variable
        var map = null;
        var marker = null;


        function initialize() {

            // the location of the initial pin
            var myLatlng = new google.maps.LatLng({{auth()->user()->lat}},{{auth()->user()->lng}});

            // create the map
            var myOptions = {
                zoom: 7,
                center: myLatlng,
                mapTypeControl: false,
                mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                navigationControl: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'Your location'
            });


        }

        //]]>

        $(document).ready( function () {
            initialize();
        });
    </script>
@endsection
