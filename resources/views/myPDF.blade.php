<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-size: 15px;
            color:#111111;
            font-family: Roboto,Helvetica,Arial;
        }
        div#bloc1 {
            display: inline-block;
        }
        hr{
            background-color: rgb(239, 239, 239);
            height: 1px;
            border-width: initial;
            border-style: none;
            border-color: initial;
            border-image: initial;
            margin: 2.4rem 0px;
        }
        .desc-td{
            padding: 10px 0 10px 0;
        }
        .total-des{
            padding-bottom: 10px;
            padding-top:10px;
        }

    </style>
</head>
<body >
 <div class="main" style="width: 100%; margin-left: auto;margin-right: auto;border:1px solid {{$invoice->color_code}};">
       <table class="table" style="width:100%;">
           <tr style="background-color: {{$invoice->color_code}};min-height: 20px;">
               <td>
                   &nbsp;
               </td>
           </tr>
       </table>

       <div id="block_container" style="padding-top: 30px; padding-bottom: 20px;">

           <table style="width: 100%;margin-left:20px;padding-top: 20px;">
               <tr>
                   <td>
                       <div id="bloc1"><p><h1>{{$invoice->title}}</h1></div>
                   </td>
                   <td style="text-align: right;padding-right: 20px;">
                   @if($invoice->uploadedImages)
                           <img style="width: 200px; margin-top: -30px;"
                              src="{{ public_path('uploads/service/'.$invoice->uploadedImages) }}" alt="logo_image" border="0">
                   @endif
                   </td>
               </tr>
           </table>
       </div>

       <div class="heading">
           <table class="table1" width="80%;margin-left:20px;">
               <tr class="tb1-tr" style="line-height: 1px">
                   <td><h2>From</h2></td>
                   <td><h2>To</h2></td>
               </tr>
               <tr class="tb1-tr" style="line-height: 1px">
                   <td><p>{{$invoice->from_name}}</p></td>
                   <td><p>{{$invoice->to_name}}</p></td>
               </tr>
               <tr class="tb1-tr" style="line-height: 1px">
                   <td><p>{{$invoice->from_email}}</p></td>
                   <td><p>{{$invoice->to_email}}</p></td>
               </tr>
               <tr class="tb1-tr" style="line-height: 1px">
                   <td><p>{{$invoice->from_address}}</p></td>
                   <td><p>{{$invoice->to_address}}</p></td>
               </tr>
{{--               <tr class="tb1-tr" style="line-height: 1px">--}}
{{--                   <td><p>{{$invoice->from_phone}}</p></td>--}}
{{--                   <td><p>{{$invoice->to_phone}}</p></td>--}}
{{--               </tr>--}}
{{--               <tr class="tb1-tr" style="line-height: 1px">--}}
{{--                   <td><p>{{$invoice->from_business_num}}</p></td>--}}
{{--                   <td><p>{{$invoice->to_address}}</p></td>--}}
{{--               </tr>--}}
           </table>
       </div>
       <p><hr></p>
       <div class="sub-data" style="margin-left:30px;">
           <p>Invoice #:&nbsp;&nbsp;&nbsp;&nbsp;{{$invoice->invoice_num}}</p>
           <p>Date:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;{{$invoice->date}}</p>
       </div>

       <div class="invoice-data">
           <table class="table2" style="width: 95%; margin-right: auto;margin-left: auto;">
               <tr style="background-color:{{$invoice->color_code}};min-height: 50px; color:#fff;padding:10px 0 10px 0 ">
                   <th style="width: 60% ;padding-top: 10px;padding-bottom: 10px;">&nbsp;&nbsp;Description</th>
                   <th>&nbsp;&nbsp;Rate</th>
                   <th>&nbsp;&nbsp;Qty</th>
                   <th>&nbsp;&nbsp;Amount</th>
               </tr>

           @php $net_total = 0; @endphp

           @foreach($invoice->items as $item)
              <tr id="desc-tr" style="background-color: #efefef;padding: 10px 0 10px 0">
                  <td class="desc-td">&nbsp;&nbsp; {{$item->description}}</td>
                  <td class="desc-td">&nbsp;&nbsp; {{$invoice->invoice_currency_option}}{{$item->rate}}</td>
                  <td class="desc-td">&nbsp;&nbsp; {{$item->qty}}</td>
                  <td class="desc-td">&nbsp;&nbsp; {{$invoice->invoice_currency_option}}<?php echo$sub_total = $item->qty * $item->rate;?></td>
                  @php $net_total = $net_total + $sub_total; @endphp
              </tr>
           @endforeach
              <tr class="total-des">
                  <td colspan="2"></td>
                  <td>&nbsp;&nbsp;Sub Total</td>
                  <td style="margin-bottom: 5px;">&nbsp;&nbsp;{{$invoice->invoice_currency_option}}{{$net_total}}</td>
              </tr>
               <tr class="total-des">
                   <td colspan="2"></td>
                   <td>&nbsp;&nbsp;Discount({{$invoice->discount_rate_percent}}%)</td>
                   <td>&nbsp;&nbsp;{{$invoice->invoice_currency_option}}{{$invoice->discount}} </td>
               </tr>
               <tr class="total-des">
                   <td colspan="2"></td>
                   <td>&nbsp;&nbsp;Tax({{$invoice->tax_rate_percent}}%)</td>
                   <td>&nbsp;&nbsp;{{$invoice->invoice_currency_option}}{{$invoice->tax}}</td>
               </tr>
               <tr class="total-des">
                   <td colspan="2"></td>
                   <td>&nbsp;&nbsp;Total</td>
                   <td>&nbsp;&nbsp;{{$invoice->invoice_currency_option}}{{($invoice->total)}}</td>
               </tr>

           </table>
           </tbody>
       </div>
   </div>
</body>
</html>
