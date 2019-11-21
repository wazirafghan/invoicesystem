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
    ?>
    @if(Session::has('error_message'))
        <div class="alert alert-danger">
            {{ Session::get('error_message') }}
        </div>
    @endif
    @if(Session::has('success_message'))
        <div class="alert alert-success">
            {{ Session::get('success_message') }}
        </div>
    @endif


    <div class="container-fluid">
        <div class="row bg-title">
            <!-- .page title -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Summary</h4> </div>
            <!-- /.page title -->
            <!-- .breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Summary</li>
                </ol>
            </div>
            <!-- /.breadcrumb -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title" style="text-align: center">Invoice Summary</h3>

                    <div class="row" style="margin-bottom:20px;padding:0 15px 0 15px;">
                        <div>
                            <p><h3>{{$invoice->title}}</h3></p>
                        </div>
                        <div class="col-sm-4 col-6">
                            <h4>from</h4>
                            <table class="table-no-bordered">
                                <tr>
                                    <td>{{$invoice->from_name}}</td>
                                </tr>
                                <tr>
                                    <td>{{$invoice->from_email}}</td>
                                </tr>
                                <tr>
                                    <td>Phone: {{$invoice->from_phone}}</td>
                                </tr>
                                <tr>
                                    <td>Business Number {{$invoice->from_business_num}}</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4 col-6">
                            <h4>To</h4>
                            <table class="table-no-bordered">
                                <tr>
                                    <td>{{$invoice->to_name}}</td>
                                </tr>
                                <tr>
                                    <td>{{$invoice->to_email}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>{{$invoice->to_phone}}</td>
                                    <td></td>
                                </tr>
                            </table>

                        </div>
                        <div class="col-sm-12 col-12" style="margin-top:20px">
                            <table class="table-no-bordered">
                                <tr>
                                    <td>Invoice #: {{$invoice->invoice_num}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Date: {{$invoice->date}}</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table color-table table-info">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Detail</th>
                                <th>Unit Price (&pound;)</th>
                                <th>Qty</th>
                                <th class="center">Amount (&pound;)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $net_total = 0; @endphp
                            @foreach($invoice->items as $item)
                                <tr>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->detail}}</td>
                                    <td>{{$item->rate}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td class="center">&pound;<?php echo $sub_total = $item->qty * $item->rate;?></td>
                                    @php $net_total = $net_total + $sub_total; @endphp
                                </tr>

                            @endforeach
                            <tr >
                                <td colspan="4" style="text-align: right"><label for="">Sub Total</label></td>
                                <td class="center"><label for="">{{$net_total}}</label></td>
                            </tr>
                            <tr style="border-top: 2px solid #1b1b1b;">
                                <td colspan="4" style="text-align: right"><label for="">Discount</label></td>
                                <td class="center"><label for="">{{$invoice->discount}} </label></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right"><label for="">Tax</label></td>
                                <td class="center"><label for="">{{$invoice->tax}} </label></td>
                            </tr>

                            <tr >
                                <td colspan="4" style="text-align: right"><label for="">Total</label></td>
                                <td class="center"><label for="">{{round($invoice->total)}}</label></td>
                            </tr>

                            </tbody>
                        </table>
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

@endsection
