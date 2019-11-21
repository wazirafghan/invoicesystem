
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
            width: 60%;
            margin-top: 50px;
            margin-bottom: 30px;
            margin-left: auto;
            margin-right: auto;
            font-size:14px;
            color: #626262;
            border:1px solid red;
        }
        p{
            font-size:14px;
        }
        tr.fr_to_email {
            line-height: 0px !important;
            color: #626262 !important;
        }
        img#email_logo {
            padding: 0 0 0 0;
            box-shadow: 0px 0px 2px 1px grey;
            margin: 30px 20px 0 0;
        }
        td.cl_email_tr {
            color: #626262;
            font-size:14px;
        }
        /**/
        .fr_to_email td{
            margin-left: 30px;
            width: 50%;
        }
        #sub_table {
            width: 100%;
            padding-left: 30px;
        }
        #last_table{
            width: 95%; margin-right:auto;margin-left:auto;
        }

    </style>
</head>

<body>

<table id="main_table">
    <tr style="background-color:red; height: 20px;width:100% ;">
        <th colspan="6">&nbsp;</th>
    </tr>
    <tbody>
    <tr>
        <td>
            <table  id="sub_table">
                <tbody>
                <tr style="line-height: 4px;">
                    <td>
                        <h1>waz</h1>
                    </td>
                    <td style="text-align:left;float:right">
                        <a style="text-decoration: none; color: #212121;" href="#" target="">
                            <img id="email_logo" style="width: 200px;border:none; display: block;"
                                 src="{{asset('uploads/service/image1.jpg')}}"
                                 alt="" border="0">
                        </a>
                    </td>
                </tr>
                <tr class="fr_to_email">
                    <td>
                        <p>From</p>
                        &nbsp;
                        <h4>Business Name</h4>
                    </td>
                    <td>
                        <p>To</p>
                        &nbsp;
                        <h4>Cient Name</h4>
                    </td>
                </tr >
                <tr class="fr_to_email">
                    <td>
                        <p>Ahmad khan</p>
                    </td>
                    <td>
                        <p>Ali Jan</p>
                    </td>
                </tr>
                <tr class="fr_to_email">
                    <td>
                        <p>wazirk217@gmail.com</p>
                    </td>
                    <td>
                        <p>wazirhashmi@yahoo.com</p>
                    </td>
                </tr >
                <tr class="fr_to_email">
                    <td>
                        <p>Ahmad Abad</p>
                    </td>
                    <td>
                        <p>Islamabad</p>
                    </td >
                </tr>
                <tr class="fr_to_email">
                    <td>
                        <p>132 000 000</p>
                    </td>
                    <td>
                        <p>132 000 000</p>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr class="fr_to_email">
                    <td>
                        <p>Number: <span>Iv1021021 </span></p>
                    </td>
                </tr>
                <tr class="fr_to_email">
                    <td>
                        <p>Date: <span>2019-11-01 </span></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table id="last_table">
                <thead style="min-height: 36px;color:#fff;">
                <tr style="background-color:red;text-align: left;padding-left: 10px">
                    <th  class="ltbl_th" style="padding:10px 0 10px 10px; width: 60%;">Description</th>
                    <th class="ltbl_th" style="padding-left:10px">Rate</th>
                    <th class="ltbl_th" style="padding-left:10px">Qty</th>
                    <th class="ltbl_th" style="padding-left:10px">Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td  style="padding-left:10px">Item description </td>
                    <td style="padding-left:10px">£3 </td>
                    <td style="padding-left:10px">123</td>
                    <td style="padding-left:10px">£369</td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:10px">
                        Item Detail
                    </td>
                </tr>
                <td  style="padding-left:10px">Description </td>
                <td style="padding-left:10px">£34 </td>
                <td style="padding-left:10px">132</td>
                <td style="padding-left:10px">£4488</td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:10px">
                        Detail
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="space2" style="border-top:2px solid #e4e4e4">&nbsp;
                    </td>
                </tr>
                <tr style="color: #626262;">
                    <td colspan="2" class="cl_email_tr"></td>
                    <td class="cl_email_tr" style="padding-left:10px">Sub total
                    </td>
                    <td class="cl_email_tr" style="padding-left:10px">£4857
                    </td>
                </tr>
                <tr style="color: #626262">
                    <td colspan="2" class="cl_email_tr">
                    </td>
                    <td  class="cl_email_tr" style="padding-left:10px">discount(10.00%)</td>
                    <td class="cl_email_tr" style="padding-left:10px">£971.40
                    </td>
                </tr>
                <tr style=";color: #626262">
                    <td colspan="2" class="cl_email_tr" style="padding-left:10px"></td>
                    <td class="cl_email_tr"  style="padding-left:10px">Tax(10.00%)</td>
                    <td class="cl_email_tr" style="padding-left:10px">£388.56</td>
                </tr>
                <tr style=";color: #626262">
                    <td colspan="2" class="cl_email_tr"></td>
                    <td  class="cl_email_tr" style="padding-left:10px">total</td>
                    <td  class="cl_email_tr" style="padding-left:10px">£4274.16</td>
                </tr>
                <tr>
                    <td colspan="4" class="space2s" style="padding: 0px 0 10px 0 !important;border-top:1px solid #333333">&nbsp;
                    </td>
                </tr>
                <tr>
                    <td id="lst-td" colspan="4"  class="cl_email_tr">
                        NOTES:
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>


