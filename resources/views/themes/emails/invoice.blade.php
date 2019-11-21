<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>email template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style>
        body{
            background-color:#efefef;
            font-family:'Montserrat', sans-serif;
            margin:0;
            padding:0;
            min-width: 100%;
            -webkit-text-size-adjust:none;
            -ms-text-size-adjust:none;
        }
        table#main_table{
            background-color:#ffffff;
            width: 70%;
            margin-top: 20px;
            margin-bottom: 30px;
            margin-left: auto;
            margin-right: auto;
            font-size:14px;
            color: #626262;
            border:2px solid {{$invoice->color_code}};
        }
        #sub_table{
            width: 60%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            margin-top: 30px;
            margin-bottom: 5px;
        }
        .invoice-hr{
            background-color: rgb(239, 239, 239);
            height: 1px;
            border-width: initial;
            border-style: none;
            border-color: initial;
            border-image: initial;
            margin: 1.4rem 0px;
            width: 90%; margin-left: auto;margin-right: auto;
        }
        .btn-invoice-email{
            background-color: #545454 !important;
            padding: 15px 20px 15px 20px;
            margin: 15px 0 0px 1px;
            font-size: 20px !important;
            border-radius: 5px;
            color: #ffffff;
            border:none;
        }
    </style>
</head>

<body>

<table style="width: 70%;margin-right: auto;margin-left: auto;margin-top: 40px;">
    <tr style="width: 100%">
        <td>Name: {{$invoice->from_name}} </td>
        <td style="text-align: right">Invoice# {{$invoice->invoice_num}}</td>
    </tr>
</table>
<table id="main_table">
    <tr style="background-color:{{$invoice->color_code}}; height: 10px;width:100%;">
        <td>&nbsp;
        </td>
    </tr>
    <tr>
        <td>
            <table id="sub_table">
                <tr>
                    <td><h1>Invoice Total {{$invoice->invoice_currency_option}}{{$invoice->total}}</h1></td>
                </tr>
                <tr>
                    <td><p>Click below to download the PDF invoice.</p></td>
                </tr>
                <tr>
                    <td><a href="{{route('generate-pdf',$invoice->id)}}"><button type="button" class="btn btn-invoice-email" >VIEW INVOICE</button></a></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><hr class="invoice-hr"></hr></td>
    </tr>
    <tr>
        <td><p style="padding-left:40px;">Notes: {{$invoice->notes}}</p></td>
    </tr>
    <tr>
        <td><hr class="invoice-hr"></hr></td>
    </tr>
    <tbody>
</table>{{--main table --}}


</body>
</html>

