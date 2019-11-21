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
        .panel{
            text-align: center;
        }
        .common-list li{
            font-size: 17px;
        }
        .keypoint{
            padding-bottom: 25px;
            border-bottom: 1px solid #eeee;
        }
        .panel-heading{
            font-size: 22px !important;
        }
        .price{
            padding-top: 25px;
            padding-bottom: 25px;
        }
        .order_now{
            color: white !important;
        }

        .discount{
            margin: 15px 0px;
            background-color: #eeeeee;
            padding: 25px 0px;

        }
        .panel:hover{
            border: 2px solid #2cabe3;
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
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    @foreach($service_item->itemprices->chunk(2) as $itemPrices)
                    <div class="row">
                        @foreach($itemPrices as $price)
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="panel panel-themecolor">
                                    <div class="panel-heading">{{$price->title}}</div>
                                    <div class="panel-body">
                                        <div class="keypoint">

                                            <ul class="common-list">
                                                @foreach($price->keypoints as $keypoint)
                                                    <li><i class="fa fa-check blue-tick" ></i> {{$keypoint->description}}</li>
                                                @endforeach


                                            </ul>
                                        </div>
                                        <div class="price">
                                            <p>from</p>
                                            <h1>£{{$price->price}}</h1>
                                            <p>PER PLACEMENT</p>
                                        </div>
                                        <a href="{{url('services/place-order/'.$service_item->slug)}}" class="form-control btn btn-info order_now">ORDER NOW</a>
                                        @if(count($price->discounts)>0)
                                            <div class="row">
                                                <div class="row discount">
                                                    <label for="">BULK DISCOUNT</label>
                                                    <ul class="common-list">
                                                        <li>1 Placement  =  £{{$price->price}} per each </li>

                                                    @foreach($price->discounts as $discount)
                                                            <li>{{$discount->placement}} Placements  =  £{{$discount->price}} per each </li>
                                                    @endforeach


                                                    </ul>
                                                </div>
                                            </div>
                                        @endif



                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>

                    @endforeach
                </div>
            </div>

        </div>


        <!-- .row -->
        <!-- .right-sidebar -->

        <!-- /.right-sidebar -->
    </div>
@stop

@section('scripts')

@endsection
