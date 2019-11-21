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
    <div class="text-center">
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
    </div>
    <div class="container-fluid">
        <div class="row bg-title">
            <!-- .page title -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Invoices</h4> </div>
            <!-- /.page title -->
            <!-- .breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Invoices</li>
                </ol>
            </div>
            <!-- /.breadcrumb -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="invoice-heading" style="    margin: 8px 0 30px 0;">
                        <h3 class="box-title">Your Invoices
                            <span style="float: right"><a href="{{route('home')}}"><button style="background-color: #4f4f4f;border: none;color: #ffffff !important;padding: 6px 12px;border-radius: 3px;" >Create New Invoice</button></a></span>
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table color-table table-hover">
                            <thead>
                            <tr>
                                <th>Invoice Number</th>
                                <th>Invoice Title</th>
                                <th>Date</th>
                                <th>Total balance</th>
                                <th colspan="3" class="center" style="width: 20% !important;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach(Auth::user()->invoices as $invoice)
                                    <tr>
                                        <td><?php echo $invoice->invoice_num; ?></td>
                                        <td>{{$invoice->title}}</td>
                                        <td>{{$invoice->date}}</td>
                                        <td>{{$invoice->invoice_currency_option}}{{$invoice->total}}</td>
{{--                                        <td class="center"><a href="{{route("show-invoice",$invoice->id)}}" title="Invoice Summary" class="btn btn-ingo"><i class="fa fa-eye"></i></a></td>--}}
{{--                                        <td class="center"><a href="{{route("show-invoice-edit",$invoice->id)}}" title="Invoice Summary" class="btn btn-ingo"><i class="fa fa-edit"></i></a></td>--}}
{{--                                        <td class="center"><a href="{{route("show-invoice-delete",$invoice->id)}}" title="Invoice Summary" class="btn btn-ingo"><i class="fa fa-trash" aria-hidden="true"></i></a></td>--}}
{{--                                  --}}

                                        <td class="center"><a href="{{route("show-invoice",$invoice->id)}}" title="Invoice Summary" class="btn btn-ingo"><button type="button" class="btn_view_invoice">View Invoice</button></a></td>
                                        <td class="center"><a href="{{route("show-invoice-edit",$invoice->id)}}" title="Invoice Summary" class="btn btn-ingo"><button type="button" class="btn_edit_invoice">Edit Invoice</button></a></td>
                                        <td class="center"><a href="{{route("show-invoice-delete",$invoice->id)}}" title="Invoice Summary" class="btn btn-ingo"><button type="button" class="btn_delete_invoice">Delete Invoice</button></a></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
