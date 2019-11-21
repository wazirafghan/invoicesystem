<html>
<head>
    <style href=""></style>
    <style type="text/css">
        table th{
            /*border: 1px solid #313131;*/
            color: white;
            background-color: #313131;
            padding: 5px 10px;
        }
        table td{
            /*border: 1px solid black;*/
            padding: 5px 10px;
        }
        .row{
            margin-top: 50px;
            width: 100%;
            margin-bottom: 100px;

        }
        .columnl{
            float: left;
        }
        .info{
            right: 50px;
        }
        .info h4{
            text-align: left;
            margin-bottom: 15px;
        }
        .info p{
            margin-top: 15px;
            text-align: left;
        }

        .first th{
            /*border: 1px solid black;*/
            color: #313131;
            background-color: #fff;
        }
        .columnr h1, .columnr p {
            text-align: right;
        }

        .columnr p{
            margin-top: 5px;
            font-size: 12px;
        }
        .columnr .total{
            background-color: #eeeeee;
            border-radius: 15px;
            padding: 5px 10px;
            font-weight: bold;
            display: inline-block;
            float: right;
            font-size: 15px;
        }


    </style>
</head>
<?php
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
if(isset($settings['site_title'])) {
    $site_title = $settings['site_title'];
}else {
    $site_title = "iNet Ventures";
}
?>
<div class="row">
    <div class="columnl">
        <div class="logo">
            <img src="{{ $logo }}" alt="" width="150px">
        </div>
        <div class="info">
            <p style="font-weight: 600">{{$site_title}}</p>
            <p><?php echo $address; ?></p>
            {{--<p>{{$email}}</p>--}}
        </div>
    </div>
    <div class="columnr">
        <h1>INVOICE</h1>
        <p>#{{$order->order_no}}</p>
        <p>Date :        {{$order->created_at->format('d/M/Y')}}</p>
        <p>Due Date :        {{$order->updated_at->format('d/M/Y')}}</p>
        <?php $discount_tot = $order->total - ($order->discount/100* $order->total); $discount_tot_usd = $order->total_usd - ($order->discount/100* $order->total_usd); ?>
        <p class="total">Balance Due :        £{{round($discount_tot,2)}}</p>
    </div>

</div>


<table class="table color-table " style="width: 100%">
    <thead>
    <tr style="border-radius: 5px">
        <th>Detail</th>
        <th>Quantity</th>
        <th>Rate</th>
        <th class="center">Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->orderprices as $price)
        <tr>
            <td>{{$order->service_title}} -- {{$price->price_title}}</td>
            <td><?php $qty = $price->qty; echo $qty; ?></td>
            <td>£<?php $prc = $price->price; echo $prc; ?></td>
            <td class="center">£<?php echo $qty * $prc;?></td>
        </tr>
        @foreach($price->priceinputs as $input)

            @if($input->extra_price > 0)
                <tr>
                    <td>1</td>
                    <td>{{$order->service_title}} -- {{$input->value}}</td>
                    <td>£{{$input->extra_price}}</td>
                    <td class="center">£{{$input->extra_price}}</td>
                </tr>
            @endif
        @endforeach
    @endforeach
    <?php $discount_am = $order->discount/100*$order->total; $discount_am_usd = $order->discount/100*$order->total_usd;?>
    <tr style="border-top: 2px solid #1b1b1b;">
        <td colspan="3" style="text-align: right"><label for="">Discount</label></td>
        <td class="center"><label for="">{{round($order->discount,2)}}% - £{{round($discount_am,2)}} - ${{round($discount_am_usd,2)}}</label></td>
    </tr>

    <tr >
        <td colspan="3" style="text-align: right"><label for="">GBP Total</label></td>
        <td class="center"><label for="">£{{round($discount_tot,2)}}</label></td>
    </tr>
    <tr >
        <td colspan="3" style="text-align: right"><label for="">Approx USD</label></td>
        <td class="center"><label for="">${{round($discount_tot_usd,2)}}</label></td>
    </tr>

    </tbody>
</table>
</html>




