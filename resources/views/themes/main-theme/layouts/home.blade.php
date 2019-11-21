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

            <div class="col-lg-9 cl-stiky">
                <div class="invoice-action" id="invoice-action-nav">
                    <div class="btn btn-group pre_edit">
                        <a href="#">
                            <button type="button" class="btn btn-default preview">Preview</button>
                        </a>
                        <button type="button" disabled class="btn btn-secondary edit" >Edit</button>
                    </div>
                    <div class="btn btn-action">
                        <button type="button" disabled class="btn btn-default record-payment"
                            title="Record  a payment from your client">Record  Payment</button>
                       <a href=""><button title="Download a PDF copy of the invoice to your device" class="btn btn-download " ><span> PDF</span></button></a>
                        <button type="button"  class="btn btn-secondary email-invoice save " >Email Invoice</button>
                    </div>
                </div>
                <!-- end of the invoice action -->
                <div class="invoice-container">
                    <div class="alert alert-success" style="display:none"></div>
                    <div class="invoice-detail div_color"  style="background-color: #333333" value="rgb(51, 51, 51)">
                        &nbsp;
                    </div>
                    <div class="invoice-detail-body">
                        <div class="logo_image" style="float: right">
                            <form action="{{ route('invoice-image') }}" file="true" enctype ='multipart/form-data' class ='dropzone' id ='imageUpload' value="{{ old('uploadedImages') }}">
                                {{ csrf_field() }}
                            </form>
                        </div>
                      <form method="post"   id="form" action="{{route('invoice-store')}}"  enctype="multipart/form-data">
                        @csrf
                          <div class="files">

                          </div>
                         <input type="hidden" name="total" class="total_num required"  value="0">
                         <input type="hidden" name="tax" class="tax-rate-amount-no"  value="0">
                         <input type="hidden" name="color_code" class="color_code"   value="#333333">
                         <input type="hidden" name="discount" class="discount-amount-no required"  value="0">
                         <input type="hidden" name="amount" class="localized-number amount required"  value="0">
                         <input type="hidden" name="invoice_currency_option" class="invoice_currency_option required"  value="£">
                         <input type="hidden" name="tax_rate_percent" class="tax_rate_percent required"  value="">
                         <input type="hidden" name="discount_rate_percent" class="discount_rate_percent required"  value="">
                          <input type="hidden" name="invoice_email_status" class="invoice_email_status"  value="0">



                          <div class="invoice-detail-title content-block">
                            <div class="invoice-title">
                                <h2>
                                    <input  type="text" name="title" id="title"  class="required"  value="{{old('title')}}" placeholder="Invoice" >
                                </h2>
                            </div>
                            <div class="invoice-logo">

                            </div>
                        </div>    <!-- end of the invoice logo -->

                        <!-- end of the detail-body -->
                        <div class="invoice-detail-header content-block">
                            <div class="row">
                                <div class="col-md invoice-address invoice-address-company">
                                    <div class="col-md-6">
                                        <h3>From</h3>

                                        <div class="form-group lable-wrapper">
                                            <label class="lable-input" for="formGroupExampleInput">Name</label>
                                            <input type="text" class="form-control required"placeholder="Bussiness Name" name="from_name" value="{{old('from_name')}}" id="from_name" >
                                        </div>
                                        <div class="form-group lable-wrapper">
                                            <label class="lable-input" for="formGroupExampleInput">Email</label>
                                            <input type="text" class="form-control required" value="{{old('from_email')}}" placeholder="name@bussiness.com" name="from_email" id="from_email" >
                                        </div>
                                        <div class="form-group lable-wrapper">
                                            <label class="lable-input" for="formGroupExampleInput">Address</label>
                                            <input type="text" class="form-control required"  placeholder="Street" name="from_address" value="{{old('from_address')}}" id="from_address">
                                        </div>
{{--                                        <div class="form-group lable-wrapper">--}}
{{--                                            <label class="lable-input" for="formGroupExampleInput">Phone</label>--}}
{{--                                            <input type="text" class="form-control required"  placeholder="1-541-754-3010" name="from_phone" value="{{old('from_phone')}}" id="from_phone">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group lable-wrapper">--}}
{{--                                            <label class="lable-input" for="formGroupExampleInput">Business Number</label>--}}
{{--                                            <input type="text" class="form-control required"  placeholder="E.g 123 455 123" name="from_business_num" value="{{old('from_business_num')}}" id="from_business_num">--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="col-md-6">
                                        <h3>To</h3>
                                            <div class="form-group lable-wrapper">
                                                <label class="lable-input" for="formGroupExampleInput">Name</label>
                                                <input type="text" class="form-control required"placeholder="Bussiness Name" name="to_name" value="{{old('to_name')}}" id="to_name">
                                            </div>
                                            <div class="form-group lable-wrapper">
                                                <label class="lable-input" for="formGroupExampleInput">Email</label>
                                                <input type="text" class="form-control required" placeholder="name@bussiness.com" name="to_email" value="{{old('to_email')}}" id="to_email">
                                            </div>
                                            <div class="form-group lable-wrapper">
                                                <label class="lable-input" for="formGroupExampleInput">Address</label>
                                                <input type="text" class="form-control required"  placeholder="Street" name="to_address" value="{{old('to_address')}}" id="to_address">
                                            </div>
{{--                                            <div class="form-group lable-wrapper">--}}
{{--                                                <label class="lable-input" for="formGroupExampleInput">Phone</label>--}}
{{--                                                <input type="text" class="form-control required"  placeholder="1-541-754-3010" name="to_phone" value="{{old('to_phone')}}" id="to_phone">--}}
{{--                                            </div>--}}
                                    <!-- Your second column here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end of the invoice detail header  -->
                        <hr class="divider lite margin">
                        <div class="invoice-detail-terms content-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group lable-wrapper">
                                        <label class="lable-input " for="formGroupExampleInput">Number</label>
                                        <input type="text" class="form-control required"  placeholder="INV00002" name="invoice_num" value="INV0002" id="invoice_num">
                                    </div>
                                    <div class="form-group lable-wrapper">
                                        <label class="lable-input " for="formGroupExampleInput">Date</label>
                                        <input type="date" class="form-control required"  placeholder="Oct 2,2019"  name="date" value="{{old('date')}}" id="date">
                                    </div>
                                    <!-- <div class="form-group lable-wrapper">
                                        <label class="lable-input" for="formGroupExampleInput">Terms</label>
                                        <input type="text" class="form-control"  placeholder="Due On Receipt">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- end of the invoice detail Term -->
                        <div class="invoice-item-list content-block">
                            <table class="table tbl-invoice">
                                <thead class="black white-text">
                                    <tr class="tb_head_row">
                                        <th>&nbsp;</th>
                                        <th rowspan="5" style="width: 40%"> Description</th>
                                        <th>Rate</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                        <th>Tax</th>
                                    </tr>
                                </thead>
                                <tbody class="main_tbody">
                                    <tr data-duplicate="demo" class="item">
                                        <td class="item-row-actions">
                                        <div class="confirm-delete-button">
                                            <button type="button" title="Remove Item" data-duplicate-remove="demo" class="btn btn-remove"  style="border-color: rgb(51, 51, 51); color: rgb(51, 51, 51);">
                                                <svg id="btn-remove_svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                                            </button>
                                        </div>
                                        </td>
                                        <td class="item-row-summary">
                                        <span class="item-row-name">
                                            <div class="item-suggest">
                                                <div role="combobox" aria-haspopup="listbox" aria-owns="react-autowhatever-1" aria-expanded="false" class="react-autosuggest__container">
                                                    <input type="text" name="description[]"   value="" aria-autocomplete="list" aria-controls="react-autowhatever-1" class="react-autosuggest__input required" id="invoice-item-code" placeholder="Item Description" >
                                                    <div id="react-autowhatever-1" role="listbox" class="react-autosuggest__suggestions-container">
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                        <span class="item-row-description">
                                            <textarea class="item-description-input required"  name="detail[]"  placeholder="Additional details" style="min-height: 80px; height: 63px;"></textarea>
                                        </span>
                                        </td>
                                        <td data-label="Price" class="item-row-rate">
                                        <span class="react-numeric-input">
                                            <input type="number" class="rate required" name="rate[]" placeholder="0.00"    value="0">
                                        </span>
                                        </td>
                                        <td data-label="Quantity" class="item-row-quantity">
                                        <span class="react-numeric-input">
                                            <input type="number" class="qty required" name="qty[]" placeholder="0" value="1"   step="any">
                                        </span>
                                        </td>
                                        <td class="item-row-amount">
                                        <span class="currency_change curr_p">£</span>
                                        <span class="localized-number amount required" id="amount" value="1" name="amount">0.00</span>
                                        </td>
                                        <td class="item-row-tax checkbox-input-tax">
                                            <!-- <div class="checkbox checkbox22">
                                                <input type="checkbox" id="checkbox2" name="checkbox" value="" checked >
                                                <label for="checkbox2"><span></span></label>
                                        </div> -->
                                        <input type="checkbox"  class="checkbox2"  name="tax_check[]" value="1" checked>
                                        <input type="hidden"  class="checkbox22"  name="new_tax_box[]" value="0" checked>

                                    </td>
                                    </tr>
                                </tbody>
                                <tr id="hiderow" class="add-mar">
                                    <td colspan="6" id="add-td">
                                        <button type="button" title="Add  Item" data-duplicate-add="demo" class="btn btn-add"  style="border-color: rgb(51, 51, 51); color: rgb(51, 51, 51);">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- end of the invoice item list -->
                        <hr class="divider margin hr-list" style="background-color: rgb(51, 51, 51);">
                        <div class="invoice-totals-container content-block">
                            <div class="invoice-totals-row invoice-summary-subtotal desktop">
                                <div class="invoice-summary-label">Subtotal</div>
                                <div class="invoice-summary-value">
                                    <span class="currency">
                                    <span class="currency_change">£</span> <span class="localized-number sub_total" >0.00</span>
                                    </span>
                                </div>
                            </div>
                            <div class="invoice-totals-row invoice-summary-discount desktop" data-selector="invoice-summary-discount">
                                <div class="invoice-summary-label ">Discount
                                    (<span class="discount-amount">0</span>%)</div>
                                <div class="invoice-summary-value">
                                    <span class="currency">
                                    <span class="currency_change">£</span> <span class="localized-number discount-amount-no" id="discount" name="discount">0.0</span>
                                    </span>
                                </div>
                            </div>
                            <div class="invoice-totals-row invoice-summary-tax desktop" data-selector="invoice-summary-tax">
                                <div class="invoice-summary-label">Tax
                                (<span class="tax-rate-amount">0</span>%)</div>
                                <div class="invoice-summary-value">
                                    <span class="currency">
                                    <span class="currency_change">£</span> <span class="localized-number tax-rate-amount-no required" id="tax" name="tax">0.0</span>
                                    </span>
                                </div>
                            </div>
                            <div class="invoice-totals-row desktop" data-selector="invoice-total">
                                <div class="invoice-summary-label" >Total</div>
                                <div class="invoice-summary-value">
                                    <span class="currency">
                                    <!-- <span class="currency_change">$</span> <span class="localized-number discount-amount-no " id="discount" name="discount">0.0</span> -->
                                    <span class="currency_change ">£</span> <span class="localized-number total_num "  name="total" id="total" total_bill=''>0.00</span>
                                    </span>
                                </div>
                            </div>
{{--                            <div class="invoice-totals-row invoice-summary-balance invoice-balance bold desktop" data-selector="invoice-balance">--}}
{{--                                <div class="invoice-summary-label">Balance Due</div>--}}
{{--                                <div class="invoice-summary-value">--}}
{{--                                    <span class="currency">--}}
{{--                                        <span class="localized-number">$0.00</span>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <!-- end of the invoicetotals container -->
                        <div class="content-block">
                            <div class="invoice-detail-notes clearfix">
                                <h3 class="invoice-notes-header">Notes</h3>
                                <textarea id="invoice-notes" class="invoice-notes-input require"  name="notes" id="notes" placeholder="Notes - any relevant information not covered, additional terms and conditions" style="height: 93px;"></textarea>
                            </div>
                        </div><!-- end of the invoice action -->
                        <div class="content-block">
                            <div class="clearfix"></div>
                            <hr>
{{--                            <span>--}}
                                <a  class="btn btn-info footer_reset_btn" href="{{route("home")}}">Reset Invoice</a>
                                <button type="button"  class="btn btn-success save " href="">Save Invoice</button>
{{--                                --}}{{--<div class="text-right">--}}
{{--                                    --}}{{--<button id="print" class="btn btn-default btn btn-success btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>--}}
{{--                                --}}{{--</div>--}}
{{--                            </span>--}}


                        </div>
                     <!-- end of the form -->
                    </div><!-- end of body -->
                </div><!-- end of the container -->
{{--                <div class="invoice-footer d-print-none">--}}
{{--                    <button class="btn btn-close">Close invoice</button>--}}
{{--                    <div class="confirm-delete-button">--}}
{{--                        <button disabled="" title="Delete Invoice" class="btn disabled btn-remove">--}}
{{--                            <span>Delete Invoice</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}


                <div class="invoice-footer d-print-none">

                </div>
                <!-- end of the invoice footer -->

            </div>   <!-- end of col-3 -->
            <div class="col-lg-3 d-print-none">
                <div class="invoice-sidebar">
                    <div class="invoice-settings">
                        <div class="pre_email_sec">
                               <h4>preview-email</h4>
                               <div style="margin-bottom: 8px;">
                                   <div class="text-with-icon">
{{--                                       <input type="text" id="selfemail" name="selfemail"   placeholder="name@business.com">--}}
                                       <input type='text t' name="ename" id='txtEmail' placeholder='Valid Email Address'/>
                                   </div>
                               </div>
                               <button type="button" onclick="window.location='{{ url("static-email") }}'"  id="btn-email-preview"  class="btn btn-prime btn-block btn-send-email-preview" >Send</button>

                           </form>
                        </div><!-- end of the email preview -->
                        <div class="invoice-delete-hidden">
                            <h4>
                                Color
                            </h4>
                            <div class="color-select" name="color-select">
                                <div color="#333333"  class="color-select-option selected" style="background-color: rgb(51, 51, 51);">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                </svg>
                            </div>
                                <div class="color-select-option" color="#555555" style="background-color: rgb(85, 85, 85); ">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                    </svg>
                                </div>
                                <div class="color-select-option"  color="#455a64" style="background-color: rgb(69, 90, 100);">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                    </svg>
                                </div>
                                <div class="color-select-option" color="#5d4037" style="background-color: rgb(93, 64, 55);">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor"d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                    </svg>
                                </div>
                                <div  class="color-select-option" color="#c62828"  style="background-color: rgb(198, 40, 40);">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                            class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="color-select-option" color="#d81b60"  style="background-color: rgb(216, 27, 96);">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                            class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.99726.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                    </svg>
                                </div>
                                <div class="color-select-option" color="#7b1fa2" style="background-color: rgb(123, 31, 162);">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                            class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                    </svg>
                                </div>
                                <div class="color-select-option" color="#4527a0" style="background-color: rgb(69, 39, 160);">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                    </svg>
                                </div>
                                <div class="color-select-option" color="#283593" style="background-color: rgb(40, 53, 147);">
{{--                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
{{--                                        <path fill="currentColo" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>--}}
{{--                                    </svg>--}}
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg>

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
                                        <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                    </svg>
                                </div>
                                <div class="color-select-option" color="#2e7d32" style="background-color: rgb(46, 125, 50);">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.99726.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                                    </svg>
                                </div>
                                <div class="color-select-option" color="#558b2f" style="background-color: rgb(85, 139, 47);">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.99726.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
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
                                            <input type="number" class="tax-rate" id="invoice-tax-rate-percent" min="1" max="100" placeholder="0.0%" step="any" value="">
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
                                                    <option name="percent" value="percent" class="type-opt">Percent</option>
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
                                                    <input type="number" class="discount-input" min="1" max="100" placeholder="0.0%" step="any" value="" id="invoice-discount-percent">
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
                                    <div class="input-group-addon currency-symbol">£</div>
                                    <div class="input-group-addon currency-addon">

                                      <select class="currency-selector">
                                        <option data-symbol="£" data-placeholder="0.00" selected>GBP</option>
                                        <option data-symbol="$" data-placeholder="0.00">USD</option>
                                        <option data-symbol="€" data-placeholder="0.00">EUR</option>
                                        <option data-symbol="¥" data-placeholder="0">JPY</option>
                                        <option data-symbol="$" data-placeholder="0.00">CAD</option>
                                        <option data-symbol="$" data-placeholder="0.00">AUD</option>
                                      </select>
                                    </div>
                                  </div>

                              </div>
                            <h4>Option</h4>
                            <div id="invoice-details-option">
                                <button type="button" class="btn btn-secondary btn-lg btn-block save">
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
    @section('scripts')
<script href="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

<script  href="{{ asset('js/bootstrap.min.js') }}"></script>

<script>

    $("body").on('click','.save',function () {

        var found = false;
        $(".required").each(function () {
            var input = $(this).val();
            if (input == ""){
                found = true;
            }
        });
        if (found != true){
            $("#form").submit();
        }else {
            swal("Read it Plz!","Fill all the fields to proceed your Invoice");
        }
    });

//invoice calculation
//
        $('tbody').on('change', '.qty', function() {
            calculateTotal();
        });
        $('tbody').on('change', '.rate', function() {
          calculateTotal();
        });
        $('body').on('change', '#type', function() {
          calculateTotal();
        });

        $('body').on('change', '#invoice-tax-rate-percent', function() {
          calculateTotal();
        });
        $('body').on('change', '#type1', function() {
          calculateTotal();
        });
        $('body').on('change', '#invoice-discount-percent', function() {
          calculateTotal();
        });
        $('body').on('change', '.checkbox2', function() {
          calculateTotal();
        });

        function calculateTotal() {
          var subTotal = 0;
          var totalTax = 0;
          var totalDiscount = 0;
          var total = 0;
          var taxType = $('#type').val();

          var taxRate = parseFloat($('#invoice-tax-rate-percent').val());
          if(isNaN(taxRate) || taxRate < 0) {
            taxRate = 0;
          }
          var discountType = $('#type1').val();
          var discountRate = parseFloat($('#invoice-discount-percent').val());
          if(isNaN(discountRate) || discountRate < 0) {
            discountRate = 0;
          }

          $('.main_tbody').find('tr').each(function () {
            var itemQuantity = parseFloat($(this).find('.qty').val());
            var itemRate = parseFloat($(this).find('.rate').val());
            var itemAmount = itemRate * itemQuantity;
            $(this).find('.amount').text(itemAmount);
            $('.amount').val(itemAmount);

            var isTaxable = $(this).find('.checkbox2').is(':checked');

            subTotal = subTotal + itemAmount;
            if(discountType == 'per-item') {
              var discount = (discountRate / 100) * itemAmount;
              itemAmount = itemAmount - discount;
              totalDiscount = totalDiscount + discount;
            }
            if(isTaxable && ( taxType == 'Deducted')) {
              var tax = (taxRate / 100) * itemAmount;
              itemAmount = itemAmount - tax;
              totalTax = totalTax + tax;
            }
            if(isTaxable && (taxType == 'per-item' )) {
              var tax = (taxRate / 100) * itemAmount;
              itemAmount = itemAmount + tax;
              totalTax = totalTax + tax;
            }
            total = total + itemAmount;
          });
          if(discountType == 'percent') {
            totalDiscount = (discountRate / 100) * total;
            total = total - totalDiscount;
          }
          if(discountType == 'flat-amount') {
            total = total - discountRate;
          }
          if(taxType == 'on-totle') {
            var totalTax = (taxRate / 100) * total;
            total = total + totalTax;
          }
          console.log('totalDiscount', totalDiscount.toFixed(2));
          $('.sub_total').text(subTotal.toFixed(2));
          $('.discount-amount').text(discountRate.toFixed(2));

          $('.discount-amount-no').text(totalDiscount.toFixed(2));
          $('.discount-amount-no').val(totalDiscount.toFixed(2));

          $('.tax-rate-amount').text(taxRate.toFixed(2));
          $('.tax-rate-amount-no').text(totalTax.toFixed(2));
          $('.tax-rate-amount-no').val(totalTax.toFixed(2));

          $('.total_num').text(total.toFixed(2));
          $('.total_num').val(total.toFixed(2));

            $('.tax_rate_percent').val(taxRate.toFixed(2));
            $('.discount_rate_percent').val(discountRate.toFixed(2));


        }

//        checkbox2

$('.checkbox2').click(function() {
   var x= $(this).val();


    $('.checkbox22').val(x);

    var check =1;
    var uncheck=0;

    if($('.checkbox22').val(x)==0)
    {
        $('.checkbox22').val(uncheck).is('check');
    }
    else{
        $('.checkbox22').val(check).is('uncheck');
    }

});



// currency symbol
//
      $('body').on('click', '.currency-inp', function() {
          var currency_symbol = ($(this).find('.currency-symbol').text());
      $('.currency_change').text(currency_symbol);
      $('.invoice_currency_option').val(currency_symbol);

      });

//currency and discount
//
    $(function() {
    $('#type').change(function(){
        if($('#type').val() == 'none') {
            $('.dim').hide();
            $('.invoice-totals-row.invoice-summary-tax.desktop').hide();
        } else {
            $('.dim').show();
            $('.invoice-totals-row.invoice-summary-tax.desktop').show();
        }
    });
    $('#type1').change(function(){
        if($('#type1').val() == 'none' ) {
            $('.dim1').hide();
            $('.invoice-summary-discount').hide();
        } else {
            $('.dim1').show();
            $('.invoice-summary-discount').show();
        }
    });
        $(".currency-inp").on("click",function(){
        var currency_symbol = $(this).find(".input-group-addon.currency-symbol").html();
        $(".currency_s").html(currency_symbol);
    });

// color change properties
//
    $('.color-select-option').click(function(){
        var color =  $(this).attr("color");
        $(".color-select-option").removeClass("selected")
        $(this).addClass("selected");
        $('.invoice-detail').css({'background-color':color});
        $('.table th').css({'background-color':color});
        $('hr.divider.margin.hr-list').css({'background-color':color});
        $('td#add-td').css({'border-top':color});
        $('button.btn.btn-remove').css({'background-color':color});
        $('button.btn.btn-add').css({'background-color':color});
        $('svg.svg-inline--fa.fa-check-square.fa-w-14').css({'color':color});
        $('button.btn.btn-remove').css({'border-color':color});
        $('button.btn.btn-remove').css({'color':color});
        $('svg#btn-remove_svg').css({'color':color});


        $('input.checkbox2').css({'background-color':color});
        // $('color_code').css({'background-color':color});
        $( ".color_code" ).val(color);
    });

    function updateSymbol(e){
    var selected = $(".currency-selector option:selected");
        $(".currency-symbol").text(selected.data("symbol"))
        $(".currency-amount").prop("placeholder", selected.data("placeholder"))
        $('.currency-addon-fixed').text(selected.text())
    }
    $(".currency-selector").on("change", updateSymbol)
    updateSymbol()


// DUPLICATE
/** https://github.com/ReallyGood/jQuery.duplicate */
$.duplicate = function(){
  var body = $('body');
  body.off('duplicate');
  var templates = {};
  var settings = {};
  var init = function(){
    $('[data-duplicate]').each(function(){
      var name = $(this).data('duplicate');
      var template = $('<div>').html( $(this).clone(true) ).html();
      var options = {};
      var min = +$(this).data('duplicate-min');
      options.minimum = isNaN(min) ? 1 : min;
      options.maximum = +$(this).data('duplicate-max') || Infinity;
      options.parent = $(this).parent();
      settings[name] = options;
      templates[name] = template;
    });
    body.on('click.duplicate', '[data-duplicate-add]', add);
    body.on('click.duplicate', '[data-duplicate-remove]', remove);
  };

  function add(){
    var color = $(".color-select").find(".selected").attr("color");
    $("body").find('.invoice-detail').css({'background-color':color});
    var targetName = $(this).data('duplicate-add');
    var selector = $('[data-duplicate=' + targetName + ']');
    var target = $(selector).last();
    if(!target.length) target = $(settings[targetName].parent);
    var newElement = $(templates[targetName]).clone(true);

    if($(selector).length >= settings[targetName].maximum) {
      $(this).trigger('duplicate.error');
      return;
    }
    target.after(newElement);
    $(this).trigger('duplicate.add');
    $("body").find('.invoice-detail').css({'background-color':color});
    $('.table th').css({'background-color':color});
    $('hr.divider.margin.hr-list').css({'background-color':color});
    $('td#add-td').css({'border-top':color});
    $("body").find('.btn-remove').css({'background-color':color});
    $('button.btn.btn-add').css({'background-color':color});
    $('svg.svg-inline--fa.fa-check-square.fa-w-14').css({'color':color});
    $('button.btn.btn-remove').css({'border-color':color});
    $('button.btn.btn-remove').css({'color':color});
    $('svg#btn-remove_svg').css({'color':color});

      // currency change when new record
      var currency_symbol = $('.currency-symbol').text();
      $('.currency_change').text(currency_symbol);
      $('.currency_change').val(currency_symbol);

      //

  }

  function remove(){
    var targetName = $(this).data('duplicate-remove');
    var selector = '[data-duplicate=' + targetName + ']';
    var target = $(this).closest(selector);
    if(!target.length) target = $(this).siblings(selector).eq(0);
    if(!target.length) target = $(selector).last();

    if($(selector).length <= settings[targetName].minimum) {
      $(this).trigger('duplicate.error');
      return;
    }
    target.remove();
    $(this).trigger('duplicate.remove');
  }
  $(init);
};

$.duplicate();
// END OF DUPLICATE

// dropzonef
        Dropzone.options.imageUpload = {
            uploadMultiple: false,
            parallelUploads: 1,
            maxFilesize : 1,
            maxFiles: 1,
            addRemoveLinks: true,

            dictRemoveFile: 'Remove',
            acceptedFiles: ".jpeg,.jpg,.png,.gif",

            removedfile: function(file,done) {
                var name = file.name;
                if (name) {
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }, //passes the current token of the page to image url
                        type: 'GET',
                        url: "invoice-store-remove" + name, //passes the image name to the method handling this url to //remove file
                        dataType: 'json',
                        success: function (data) {
                            var id ="#";
                            id +=data.id;
                            console.log(id);
                            $(id).remove();
                        }
                    });
                }

                var _ref;
                return (ref = file.previewElement) != null ? ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file,done) {

                var data = "";
                var value = "";
                value +=done.imageName;

                data +="<input type='hidden' value='"+value+"' name='uploadedImages' id='"+done.id+"'>";
                $(".files").html(data);
//localStorage.setItem("file", done.success);
            }
        };
//end of the dropzone

// sticky
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
//


});
//    end of the function of jquery
</script>

<script>

    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

<script type="text/javascript">

    $(function() {

    });
</script>

<script>
{{--  email-preview   --}}
$(document).ready(function() {

    $('#btn-email-preview').prop('disabled', true);
    $('input[type="text t"]').keyup(function() {
        if($(this).val() != '') {
            $('#btn-email-preview').prop('disabled', false);
        }
    });
});
{{--  end of email preview  --}}
</script>

    <script src="{{asset("admin/plugins/bower_components/sweetalert/sweetalert.min.js")}}"></script>
    <script src="{{asset("admin/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js")}}"></script>
    <script type="text/javascript" src="js/dropzone.js"></script>



    <script href="{{ asset('js/duplicate.js') }}"></script>
    <script src="{{ asset('theme/js/theme.js') }}"></script>

        @endsection
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
@include('themes.main-theme.includes.scripts')
</body>
</html>
