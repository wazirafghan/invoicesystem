@extends('themes.main-theme.layouts.master')
<?php
if(isset($settings['site_title'])) {
    $title = $settings['site_title'];
}else {
    $title = "no title";
}
?>
@section('title',$title)
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
    if(isset($settings['intensive'])) {
        $intensive = $settings['intensive'];
    }else {
        $intensive = 30;
    }
    ?>
    <div class="container-fluid">
        <div class="row bg-title">
            <!-- .page title -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{$service_item->title}}</h4> </div>
            <!-- /.page title -->
            <!-- .breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">{{$service_item->title}}</li>
                </ol>
            </div>
            <!-- /.breadcrumb -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">

                    <h3 class="box-title">
                        <a class="btn mtbutton btn-info btn-circle btn-sm" onclick="event.preventDefault();" title="View Form" href="#">
                            2
                        </a>
                        {{$service_item->title}}  Project Details

                        <span class="pull-right">Sub Total: <span class="aprx">GBP £<span class="p_rate_t">0.00</span> / Approx USD $<span class="d_rate_t">0.00</span></span></span>
                    </h3>
                    <form action="{{route('order-store')}}" method="post" id="form">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4 services" style="">
                                <?php $form = $service_item->itemform;

                                ?>
                                <input type="hidden" name="" id="extra_total" value="0">
                                <input type="hidden" name="" id="total" value="0">
                                <input type="hidden" name="inten" id="inten" value="0">
                                <input type="hidden" name="total" id="o_total" value="0">
                                <input type="hidden" name="total_approval" id="total_approval" value="0">
                                <input type="hidden" name="item_id" id="item_id" value="{{$service_item->id}}">
                                <input type="hidden" name="form_id" id="" value="{{$form->id}}">
                                <input type="hidden" name="pound_value" id="pound_value" value="{{$pound_value}}">
                                <label for="">Choose your quantity (Press Enter)</label>
                                @foreach($service_item->itemprices as $price)
                                    <div class="prices">
                                        <h5>{{$price->title}}</h5>
                                        <div class="input-group m-b-30">
                                            <input type="number" class="form-control price" name="price{{$price->id}}" min="0" id="{{$price->id}}" price="{{$price->price}}" value="0" aria-describedby="basic-addon2">
                                            <span class="input-group-addon " id="basic-addon2">£<span class="each">{{$price->price}}</span> each
                                                <?php $from = 1; ?>
                                            <a class="btn btn-info btn-xs tooltip-info" onclick="event.preventDefault();"  href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="@foreach($price->discounts as $discount)
                                                 <?php $from = $discount->placement; ?>{{$from}}+ £{{$discount->price}} each
                                                @endforeach">
                                                <i class="fa fa-question" ></i>
                                            </a>
                                            </span>
                                            <input type="hidden" class="1 dis_price" value="0" price="{{$price->price}}">
                                            @foreach($price->discounts as $discount)
                                                <input type="hidden" price="{{$discount->price}}" value="{{$discount->placement}}" class="dis_price">
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <div class="prices">
                                    @if($service_item->id == 1)
                                        {{--<h5>Optional</h5>--}}
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-info" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
                                        </div>
                                        <h5>Pre Approval</h5>
                                        <div class="input-group form-group">
                                            <select name="approval" id="approval" class="form-control price" price="20"  aria-describedby="basic-addon2">>
                                                <option value="0">NO</option>
                                                <option value="1">YES</option>
                                            </select>
                                            <input type="hidden" class="1 dis_price" value="0" price="20">
                                            <span class="input-group-addon " id="basic-addon2">£<span class="each">20</span> each
                                                <a class="btn btn-info btn-xs tooltip-info" onclick="event.preventDefault();"  href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Select Yes if you wish to pre-approve the sites your placements will appear on.">
                                                    <i class="fa fa-question" ></i>
                                                </a>
                                            </span>

                                        </div>
                                    @endif
                                </div>
                                <div class="prices">
                                    @if($service_item->id == 1)
                                        <h5>Niche Intensive (PayDay, Loans, Binary, Forex, Casino, Gambling)</h5>
                                        <div class="input-group form-group">
                                            <select name="intensive" id="intensive" class="form-control price" price="{{$intensive}}"  aria-describedby="basic-addon2">>
                                                <option value="0">NO</option>
                                                <option value="1">YES</option>
                                            </select>
                                            <input type="hidden" class="1 dis_price" value="0" price="{{$intensive}}">
                                            <span class="input-group-addon " id="basic-addon2"><span class="each">{{$intensive}}%</span>  Extra pricing
                                            <a class="btn btn-info btn-xs tooltip-info" onclick="event.preventDefault();"  href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Select Yes if you are promoting tough niches such as PayDay, Loans, Binary, Forex, Casino, Gambling.">
                                                <i class="fa fa-question" ></i>
                                            </a>
                                        </span>

                                        </div>
                                    @endif
                                </div>


                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-8 col-sm-offset-4 item_detail">
                                    <div class="keypoint_b " >
                                        <ul class="common-list">
                                            @foreach($service_item->itemkeypoints as $keypiont)
                                                <li><i class="fa fa-check blue-tick" ></i> {{$keypiont->description}}</li>

                                            @endforeach
                                        </ul>
                                    </div>
                                    {{--<button type="button" class="btn btn-default btn-outline tooltip-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">Info</button>--}}
                                    {{--@foreach($service_item->itemprices as $price)--}}
                                        {{--@if($price->discounts)--}}
                                            {{--<div class="panel panel-default" style="margin-top: 15px">--}}
                                                {{--<div class="panel-head">--}}
                                                    {{--<h5 >{{$price->title}} Discounts <span class="pull-right"><i class="fa fa-plus"></i></span></h5>--}}
                                                {{--</div>--}}
                                                {{--<div class="panel-body" style="display: none">--}}
                                                    {{--<ul class="common-list">--}}
                                                        {{--@foreach($price->discounts as $discount)--}}
                                                            {{--<li><i class="fa fa-check blue-tick" ></i> {{$discount->placement}} placements -- £{{$discount->price}}</li>--}}

                                                        {{--@endforeach--}}
                                                    {{--</ul>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                </div>

                            </div>

                        </div>


                        @foreach($service_item->itemprices as $price)
                            <div class="row " style="display: none">
                                <div class="row ">
                                    <div class="panel-sub-heading">
                                        <h5 >{{$price->title}} project details</h5>
                                    </div>
                                </div>
                                <div class="col-sm-12  add_project{{$price->id}}" style="padding-top: 30px;">

                                </div>

                            </div>
                        @endforeach


                    </form>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 15px;">
                            <button class="btn btn-info pull-right next" type="button">Next</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="form" style="display: none;">
            <div class="row">

                @foreach($form->forminputs as $input)
                    @if($input->status == 1)
                        <div class="col-sm-4 form-group">
                            <lable>{{$input->name}}</lable>
                            @if($input->tooltip)
                                <button data-toggle="tooltip" data-placement="left" title="" data-original-title="{{$input->tooltip->tip}}"  type="button" class="btn btn-info btn-xs pull-right tooltip-info" >Tip</button>
                            @endif
                            <input type="text" class="form-control result" id="{{$input->id}}" required>
                        </div>
                    @elseif($input->status == 2)
                        <div class="col-sm-12 form-group">
                            <lable>{{$input->name}}</lable>
                            @if($input->tooltip)
                                <button data-toggle="tooltip" data-placement="left" title="" data-original-title="{{$input->tooltip->tip}}"  type="button" class="btn btn-info btn-xs pull-right tooltip-info" >Tip</button>
                            @endif
                            <textarea name=""  class="form-control result" id="{{$input->id}}" rows="4" required></textarea>
                        </div>
                    @elseif($input->status ==3)
                        <div class="col-sm-4 form-group">
                            <lable>{{$input->name}}</lable>
                            @if($input->tooltip)
                                <button data-toggle="tooltip" data-placement="left" title="" data-original-title="{{$input->tooltip->tip}}"  type="button" class="btn btn-info btn-xs pull-right tooltip-info" >Tip</button>
                            @endif
                            <Select class="form-control result" id="{{$input->id}}" >
                                @foreach($input->inputoptions as $option)
                                    <option value="{{$option->value}}">{{$option->name}}</option>
                                @endforeach
                            </Select>
                        </div>
                    @elseif($input->status ==4)
                        <div class="col-sm-4 form-group">
                            <lable>{{$input->name}}</lable>
                            @if($input->tooltip)
                                <button data-toggle="tooltip" data-placement="left" title="" data-original-title="{{$input->tooltip->tip}}"  type="button" class="btn btn-info btn-xs pull-right tooltip-info" >Tip</button>
                            @endif
                            <Select class="form-control result num" id="{{$input->id}}" required required >
                                @foreach($input->inputoptions as $option)
                                    <option value="{{$option->value}}" cost="{{$option->value}}" >{{$option->name}}</option>
                                @endforeach
                            </Select>

                        </div>
                    @endif
                @endforeach
            </div>
            <hr>

        </div>
        <!-- .row -->
        <!-- .right-sidebar -->

        <!-- /.right-sidebar -->
    </div>
@stop
@section('stylesheets')
    <!--alerts CSS -->
    <link href="{{asset("admin/plugins/bower_components/sweetalert/sweetalert.css")}}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    <!-- Sweet-Alert  -->
    <script src="{{asset("admin/plugins/bower_components/sweetalert/sweetalert.min.js")}}"></script>
    <script src="{{asset("admin/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js")}}"></script>
    <script>
        $("body").on('change','.price',function () {
            var val = $(this).val();
            var pound_value = $("#pound_value").val();
            var item_id = $("#item_id").val();
            if (val < 0){
                $(this).val(0);
            }else {
                var form = $(".form").html();
                var total = 0;
                var sn = 0;
                var prc_len = $(".m-b-30").length;
                $(".m-b-30").each(function () {
                    sn++;
                    var  qty = parseInt($(this).find(".price").val());
                    var price =0;
                    $(this).find(".dis_price").each(function () {
                        if (parseInt($(this).val()) <= qty){
                           price = $(this).attr("price");
                        }
                    });
                    $(this).find(".each").html(price);
                    // var price = $(this).find(".price").attr("price");
                    var id = $(this).find(".price").attr("id");
                    var cls = "add_project"+id;
                    var txt = "txt"+id+"[]";
                    var drp = "drp"+id+"[]";
                    var dsc = "dsc"+id+"[]";
                    var drp_n = "drp_n"+id+"[]";
                    if (qty == 0) {
                        $("."+cls+"").children().remove();
                        $("."+cls+"").parent().hide();
                        $("."+cls+"").removeClass("main_row");
                    }else{
                        $("."+cls+"").parent().show();
                        $("."+cls+"").addClass("main_row");
                        var num_rows = $("."+cls+"").find(".row").length;
                        if (qty > num_rows){
                           var num_append = qty - num_rows;
                            for (i = 0; i < num_append; i++) {
                                $("."+cls+"").append(form);
                                $("."+cls+"").find(".result").attr("price_id",id);
                                $("."+cls+"").find(".result").each(function () {
                                    var i_id = $(this).attr("id");
                                    var p_id = $(this).attr("price_id");
                                    var name = "result"+i_id+p_id+"[]";
                                    $(this).attr("name",name);
                                });

                            }
                        }else if (qty < num_rows){
                            var num_del = qty - num_rows;
                            num_del --;
                            $("."+cls+"").find(".row:gt("+num_del+")").remove();
                            $("."+cls+"").find("hr:gt("+num_del+")").remove();
                        }

                    }
                    var sub_tot = qty * price ;
                    var tot_qty = 0;
                    tot_qty = tot_qty+qty;
                    total = total + sub_tot;
                    total = parseFloat(total);
                    if (item_id == 1){
                        var approval = $("#approval").val();
                        var total_approval = approval * 20 * tot_qty;
                        total = total + total_approval;
                    }
                    if (sn==prc_len && item_id == 1){
                        var intensive = $("#intensive").val();
                        var intensive_prc =  $("#intensive").attr("price");
                        var total_intensive =   ((intensive_prc / 100) * total) * intensive;
                        $("#inten").val(total_intensive);
                        total = total + total_intensive;
                    }
                    var total_pound = total * pound_value;

                    $(".p_rate_t").html(total.toFixed(2));
                    $(".d_rate_t").html(total_pound.toFixed(2));
                    $("#total").val(total.toFixed(2));
                    $("#o_total").val(total.toFixed(2));
                });
            }



        });
        $("#extra_total").change(function () {
           alert("working");
        });

        $("body").on('change','.num',function () {
            var extra_total = 0;
            var pound_value = $("#pound_value").val();
            $(".main_row").each(function () {
                $(this).find(".num").each(function () {
                    var num = parseFloat($(this).val());
                    extra_total = extra_total + num;
                    $("#extra_total").val(extra_total);
                    var ex_t = parseFloat($("#extra_total").val());
                    var tot = parseFloat($("#total").val());
                    var ov_tot = ex_t + tot ;
                    var ov_tot_pound = ov_tot * pound_value;
                    $("#o_total").val(ov_tot.toFixed(2));
                    $(".p_rate_t").html(ov_tot.toFixed(2));
                    $(".d_rate_t").html(ov_tot_pound.toFixed(2));
                });

            });


        });


        $("body").on('click','.next',function () {
            var found = false;
            var i_found = true;
            $(".price").each(function () {
                var qty = $(this).val();
                if (qty>0){
                   found = true;
                }
            });
            if (found == true){
                $(".main_row").each(function () {
                    $(this).find(".result").each(function () {
                        var num = $(this).val();
                        if (num==""){
                            i_found = false;
                        }
                    });

                });
                if (i_found == true){
                    $("#form").submit();
                }else {
                    swal("Read it Plz!","Fill all the fields to proceed your order");
                }

            }else {
                swal("Read it Plz!","You need to choose your quantity before we can proceed.");
            }


        });

        $("body").on('click','.panel-head',function () {
            // $(".panel-body").hide();
            $(this).parent().find(".panel-body").toggle();
        });


        $("body").on('mouseover','.row',function () {
            $('[data-toggle="tooltip"]').tooltip();
        });


    </script>

@endsection
