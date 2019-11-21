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
            border:2px solid #e4e4e4;
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
<table style="width: 70%; border: 1px solid #e4e4e4;padding: 30px;margin-left: auto;margin-right: auto;">
    <tr>
        <td><h1>Your invoice has been viewed</h1></td>
    </tr>
    <tr>
        <td style="width: 100%;border-top:5px solid red;padding:5px  0 5px 0"></td>
    </tr>
    <tr>
        <td>Hey,</td>
    </tr>
    <tr>
        <td>
            It looks like <strong>{{ $from_email }}</strong> viewed your invoice!
        </td>
    </tr>
    <tr>
        <td>
            Here are the details for your records:
        </td>
    </tr>
    <tr>
        <td>Customer:&nbsp;&nbsp;        {{ $to_email }}</td>
    </tr>
    <tr>
        <td>Invoice:&nbsp;&nbsp;     {{ $invoice_num }}</td>
    </tr>
    <tr>
        <td>Status: &nbsp;&nbsp; Email opened </td>
    </tr>




{{--    <td>Customer:&nbsp;&nbsp;        {{ $from_email }}</td>--}}
{{--    <td>Invoice:&nbsp;&nbsp;     {{ $invoice_num }} </td>--}}
{{--    <td>Status: &nbsp;&nbsp; Email opened </td>--}}


</table>
</body>
</html>

