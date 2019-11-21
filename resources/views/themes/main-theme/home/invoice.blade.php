<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">

@include('themes.main-theme.includes.head')

<body class="fix-sidebar">
<!-- Preloader -->
@include('themes.main-theme.includes.preloader')
<div id="wrapper">
    @include('themes.main-theme.includes.header')
    @section("stylesheets")
        <style type="text/css">
            .services a{
                font-size: 17px;
            }
            .services a:hover{
                color: white;
                background-color: #2cabe3;
            }
            .invoice-title {
                margin: 0 0 0 13px;
            }
            img{
                width:120px !important;
            }


        </style>
    @endsection
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="text-center">
            {{--    error    --}}
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            {{--    error    --}}
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
        </div>
    <!-- end of the header -->
        <section id="main">
            <div class="container">
                <div class="row">



                    <div class="col-lg-9">
                        <div class="invoice-action pre_edit" id="invoice-action-nav">
                            <div class="btn btn-group pre_edit">
                                <button type="button" disabled class="btn btn-default preview">Preview</button>
                                <a href="{{route("show-invoice-edit",$invoice->id)}}"><button type="button" class="btn btn-secondary edit" >Edit</button>
                                </a>
                            </div>
                            <div class="btn btn-action">
                                <button type="button" disabled class="btn btn-default record-payment"
                                        title="Record  a payment from your client">Record  Payment</button>
                                <button title="Download a PDF copy of the invoice to your device" class="btn btn-download "><span>PDF</span></button>
                                <button type="button" style="visibility: hidden;"  class="btn btn-secondary email-invoice">Email Invoice</button>
                            </div>
                        </div>
                        <!-- end of the invoice action -->
                        <div class="invoice-container">
                            <div class="invoice-detail div_color"  style="background-color: {{$invoice->color_code}}" >
                                &nbsp;
                            </div>
                            <div class="invoice-detail-body">
                                <form method="post" id="form" action="{{route('invoice-store')}}"  enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="white-box">

                                                <div class="row" style="margin-bottom:20px;padding:0 15px 0 15px;">
                                                    <div class="invoice-title">
                                                        <p><h1>{{$invoice->title}}</h1></p>
                                                    </div>
                                                    <div style="float: right" id="invoice_logo_img">
                                                        <img
                                                         src="{{asset('uploads/service/'.$invoice->uploadedImages)}}" alt="" border="0">
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
                                                                <td>{{$invoice->from_address}}</td>
                                                            </tr>
{{--                                                            <tr>--}}
{{--                                                                <td> {{$invoice->from_business_num}}</td>--}}
{{--                                                                <td></td>--}}
{{--                                                            </tr>--}}
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
                                                            </tr>
                                                            <tr>
                                                                <td>{{$invoice->to_address}}</td>
                                                            </tr>
{{--                                                            <tr>--}}
{{--                                                                <td>{{$invoice->to_phone}}</td>--}}
{{--                                                            </tr>--}}
                                                        </table>

                                                    </div>
                                                    <div class="col-sm-12 col-12" style="margin-top:40px;margin-bottom: 20px">
                                                        <table class="table-no-bordered">
                                                            <tr>
                                                                <td>Invoice #:{{$invoice->invoice_num}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Date:{{$invoice->date}}</td>
                                                            </tr>
                                                        </table >
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th style="padding:10px 0 10px 10px;width: 65% !important; background-color:{{$invoice->color_code}}">Description </th>
                                                            <th style="width: 10% !important; background-color:{{$invoice->color_code}}">Unit Price</th>
                                                            <th style="width: 10% !important; background-color:{{$invoice->color_code}}">Qty</th>
                                                            <th class="center" style="width: 15% !important; background-color:{{$invoice->color_code}}">Amount</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php $net_total = 0; @endphp

                                                        @foreach($invoice->items as $item)
                                                            <tr class="table-active" style="background-color:#efefef">
                                                                <td>{{$item->description}}</td>
                                                                <td>{{$invoice->invoice_currency_option}}  {{$item->rate}}</td>
                                                                <td>{{$item->qty}}</td>
                                                                <td class="center">{{$invoice->invoice_currency_option}}<?php echo $sub_total = $item->qty * $item->rate;?></td>
                                                                @php $net_total = $net_total + $sub_total; @endphp
                                                            </tr>

                                                        @endforeach
                                                        <tr >
                                                            <td style="text-align: right;"></td>
                                                            <td><label for="">Sub Total</label></td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="center"><label for="">{{$invoice->invoice_currency_option}} {{$net_total}}</label></td>
                                                        </tr>
                                                        <tr style="border-top: 2px solid #1b1b1b;width: 70% !important;">
                                                            <td  style="text-align: right;">
                                                                </td>
                                                            <td><label for="">Discount({{$invoice->discount_rate_percent}}%)</label></td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="center"><label for="">{{$invoice->invoice_currency_option}} {{$invoice->discount}} </label></td>
                                                        </tr>
                                                        <tr>
                                                            <td  style="text-align: right;"></td>
                                                            <td><label for="">Tax({{$invoice->tax_rate_percent}}%)</label></td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="center"><label for="">{{$invoice->invoice_currency_option}} {{$invoice->tax}} </label></td>
                                                        </tr>

                                                        <tr >
                                                            <td style="text-align: right;"></td>
                                                            <td><label for="">Total</label></td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="center"><label for="">{{$invoice->invoice_currency_option}} {{($invoice->total)}}</label></td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </form>
                                    <!-- end of the form -->
                            </div><!-- end of body -->
                        </div><!-- end of the container -->
                        <div class="invoice-footer d-print-none">

                        </div>
                        <!-- end of the invoice footer -->

                    </div>   <!-- end of col-3 -->
                    <div class="col-lg-3 d-print-none">
                        <div class="invoice-sidebar">
                            <div class="invoice-settings">
                                <div class="pre_email_sec">
                                    <h4>Preview via Email</h4>

                                    <div style="margin-bottom: 8px;">
                                        <div class="text-with-icon">
                                            <input type="text" id="self-email" name="self-email" class="self-email" autocomplete="email" placeholder="name@business.com" value="">
                                        </div>
                                    </div>

                                    <button type="button" id="btn-s-e" class="btn btn-prime btn-block btn-send-email-preview" disabled>Send</button>
                                </div><!-- end of the email preview -->
                                <div class="invoice-delete-hidden">
                                    <h4>
                                        Color
                                    </h4>
                                    <div class="color-select" name="color-select">
                                        <div color="#333333"  class="color-select-option selected" style="background-color: rgb(51, 51, 51); color:blue"">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                             class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.2060-36.20l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.99726.207-9.99736.2040l36.20336.204c9.9979.9979.99726.206 036.204l-294.4294.401c-9.9989.997-26.2079.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#333" style="background-color: rgb(85, 85, 85); ">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                             class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                  d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.9
                                            97-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36
                                            .204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26
                                            207 9.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option"  color="#455a64" style="background-color: rgb(69, 90, 100);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                             class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206
                                            0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.
                                            596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36
                                            .204l-294.4 294.401c-9.998   9.997-26.207 9.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#5d4037" style="background-color: rgb(93, 64, 55);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c
                                            9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.9
                                            97 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9
                                            .997-26.207 9.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div  class="color-select-option" color="#c62828"  style="background-color: rgb(198, 40, 40);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                             class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997
                                            -9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.
                                            69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26
                                            .206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#d81b60"  style="background-color: rgb(216, 27, 96);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                             class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.9
                                            97-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 31
                                            2.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997
                                            26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#7b1fa2" style="background-color: rgb(123, 31, 162);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                             class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9
                                            .997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192
                                                312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.9
                                                97 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204
                                                -.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#4527a0" style="background-color: rgb(69, 39, 160);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26
                                            207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.
                                            997-26.207 9.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#283593" style="background-color: rgb(40, 53, 147);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option"  color="#1565c0" style="background-color: rgb(21, 101, 192);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#0277bd" style="background-color: rgb(2, 119, 189);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#00695c" style="background-color: rgb(0, 105, 92);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.2
                                            06 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095
                                            72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206
                                            0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#2e7d32" style="background-color: rgb(46, 125, 50);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.
                                            204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997
                                            26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.
                                            998 9.997-26.207 9.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="color-select-option" color="#558b2f" style="background-color: rgb(85, 139, 47);">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36
                                            .204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997
                                            26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-
                                            9.998 9.997-26.207 9.997-36.204-.001z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <!-- end of color select -->
                                <div id="invoice-details-about">
                                    <h4>Tax</h4>
                                    <table>
                                        <tr class="taxt-r">
                                            <td style="width:50%; padding-bottom: 10px">
                                                <lable>Type</lable>
                                            </td>
                                            <td style="width:50%; padding-bottom: 10px">
                                                <div >
                                                    <select  id="type" name="tax_status" >
                                                        <option  value="Deducted" class="type-opt"  >Deducted</option>
                                                        <option  value="on-totle" class="type-opt" >On Total</option>
                                                        <option  value="per-item" class="type-opt" >Per Item</option>
                                                        <option  value="none" class="type-opt">None</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="dim">
                                            <td style="width:50% ; padding-bottom: 10px">
                                                label
                                            </td>
                                            <td style="width:50%; padding-bottom: 10px">
                                                <input id="invoice-tax-label" class="invoice-tax-label-input" name="invoiceTaxLabel" type="text" value="Tax">
                                            </td>
                                        </tr>
                                        <tr class="dim">
                                            <td style="width:50%; padding-bottom: 10px">
                                                Rate
                                            </td>
                                            <td style="width:50%; padding-bottom: 10px">
                                                <input type="number" class="tax-rate" id="invoice-tax-rate-percent" min="1" max="100" placeholder="0.00%" step="any" value="{{$invoice->tax_rate_percent}}">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <h4>Discount</h4>
                                <div id="invoice-details-percent">
                                    <table>
                                        <tr>
                                            <td style="width:50%; padding-bottom: 10px">
                                                Type
                                            </td>
                                            <td style="width:50%; padding-bottom: 10px">
                                                <div >
                                                    <select name="type" id="type1">
                                                        <option name="none" value="none" class="type-opt">None</option>
                                                        <option name="per-item" value="per-item" class="type-opt">Per Item</option>
                                                        <option name="percent" value="percent" class="type-opt">Percent</option>|
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="dim1">
                                            <td style="width:50%; padding-bottom: 10px">
                                                Percent
                                            </td>
                                            <td style="width:50%; padding-bottom: 10px">
                                            <span>
                                                <span class="react-numeric-input" style="position: relative; display: inline-block;">
                                                    <input type="number" class="discount-input" min="1" max="100" placeholder="0.00%" step="any" value="{{$invoice->discount_rate_percent}}" id="invoice-discount-percent">
                                                </span>
                                            </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <h4>CURRENCY</h4>
                                <div class="wrapper">

                                    <label class="sr-only" for="inlineFormInputGroup">Amount</label>
                                    <div class="input-group currency-inp ">
                                        <div class="input-group-addon currency-symbol">$ </div>
                                        <div class="input-group-addon currency-addon">

                                            <select class="currency-selector">
                                                <option data-symbol="$" data-placeholder="0.00" selected>USD</option>
                                                <option data-symbol="€" data-placeholder="0.00">EUR</option>
                                                <option data-symbol="£" data-placeholder="0.00">GBP</option>
                                                <option data-symbol="¥" data-placeholder="0">JPY</option>
                                                <option data-symbol="$" data-placeholder="0.00">CAD</option>
                                                <option data-symbol="$" data-placeholder="0.00">AUD</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <h4>Option</h4>
                                <div id="invoice-details-option">
                                    <button class="btn btn-secondary btn-lg btn-block">
                                        <span>Get Link</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   <!-- end of col-3 -->
                </form>
            </div>  <!-- end of the row -->
    </div>  <!-- end of the container -->
    </section>
    <!--end of the main section   -->


    <!-- /.container-fluid -->
    @include('themes.main-theme.includes.footer')

{{--    @endsection--}}
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<script>
    $(document).ready(function(){
        window.onscroll = function() {myFunction()};

        var header = document.getElementById("invoice-action-nav");
        var sticky = header.offsetTop;

        function myFunction() {

            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    });
</script>
<!-- jQuery -->
@include('themes.main-theme.includes.scripts')
</body>
</html>
