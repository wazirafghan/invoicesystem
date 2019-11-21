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
        <div class="container-fluid">
            {{--<div class="row bg-title">--}}
                {{--<!-- .page title -->--}}
                {{--<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">--}}
                    {{--<h4 class="page-title">Home</h4> </div>--}}
                {{--<!-- /.page title -->--}}
                {{--<!-- .breadcrumb -->--}}
                {{--<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">--}}
                    {{--<ol class="breadcrumb">--}}
                        {{--<li><a href="{{route('home')}}">Home</a></li>--}}
                        {{--<li class="active">Home</li>--}}
                    {{--</ol>--}}
                {{--</div>--}}
                {{--<!-- /.breadcrumb -->--}}
            {{--</div>--}}
            <!-- .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title">

                            Create Invoice
                        </h3>
                        <div class="row">
                            <div class="col-sm-12 " >
                                <form method="post" id="form" action="{{route("invoice-store")}}"  enctype="multipart/form-data">

                                    {{--<h3><b>INVOICE</b> <span class="pull-right">23232</span></h3>--}}
                                    @csrf
                                    <input type="hidden" name="total" class="total_num" id="total_num" value="0">
                                    <div class="col-md-3 text-large">
                                        <input class="form-control form-control-sm text-large required" type="text" name="title" id="title" placeholder="INVOICE"/>
                                    </div>

                                    <div class="col-md-3 text-large pull-right">
                                        <input class="form-control form-control-sm text-large invoiceLogo" type="file"
                                               name="pic" id="pic" />
                                        @if (Auth::check())
                                            <input type="checkbox" name="saved_logo" class="accountLogo" value="1">Account Saved Logo
                                        @endif

                                    </div>
                                    <br><br><br><br>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="col-lg-6">
                                                <h2>From</h2>
                                                <label>Name:</label>
                                                <input class="form-control form-control-sm required" type="text" name="from_name" id="from_name"  placeholder="Enter name"/>
                                                <br>
                                                <label>Email:</label>
                                                <input class="form-control form-control-sm required" type="text" name="from_email" id="from_email"  placeholder="name@bussiness.com"/>
                                                <br>
                                                <label>Address:</label>
                                                <textarea class="form-control form-control-sm required" type="text"  name="from_address" id="from_address"  placeholder="Street"></textarea>
                                                <br>
                                                <label>Phone#:</label>
                                                <input class="form-control form-control-sm required" type="number" name="from_phone" id="from_phone"  placeholder="(92)2233456"/>
                                                <br>
                                                <label>Buiseness Number:</label>
                                                <input class="form-control form-control-sm required" type="number" name="from_business_num" id="from_business_num"  placeholder="Eg. 123-22-345"/>
                                                <br><br>
                                            </div>

                                            <div class="col-lg-6 pull-left text-left">
                                                <h2>To</h2>
                                                <label>Name:</label>
                                                <input class="form-control form-control-sm required" type="text" name="to_name" id="to_name"  placeholder="Enter name"/>
                                                <br>
                                                <label>Email:</label>
                                                <input class="form-control form-control-sm required" type="text"  name="to_email" id="to_email" placeholder="name@bussiness.com"/>
                                                <br>
                                                <label>Address:</label>
                                                <textarea class="form-control form-control-sm required" type="text" name="to_address" id="to_address"  placeholder="Street"></textarea>
                                                <br>
                                                <label>Phone#:</label>
                                                <input class="form-control form-control-sm required" type="number" name="to_phone" id="to_phone"  placeholder="(92)2233456"/>
                                                <br><br>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="col-md-10">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label>Number:</label>
                                                <input class="form-control form-control-sm required" type="text" name="invoice_num" id="invoice_num"  placeholder="Invo0023"/>
                                                <br>
                                                <label>Date:</label>
                                                <input class="form-control form-control-sm required" type="date" name="date" id="date"  placeholder="20/7/2019"/>

                                                <br>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="table-responsive m-t-40 " style="clear: both;">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr style="background: #2cabe3;border-color: #BBB;">
                                                    <th style="color: white;">Description</th>
                                                    <th style="color: white;">Rate</th>
                                                    <th style="color: white;">Qty</th>
                                                    <th style="color: white;">Amount</th>
                                                    {{--<th>Tax</th>--}}
                                                    <th style="color: white;"></th>
                                                </tr>
                                                </thead>

                                                <tbody class="main_tbody">
                                                <tr >
                                                    <td><input class="form-control required"  type="text" name="description[]" id=""  placeholder="item description"/>
                                                        <br>
                                                        <textarea class="form-control required" type="text" name="detail[]" id=""  placeholder="Additional Details"></textarea>
                                                    </td>
                                                    <td><input class="form-control rate required" value="0" type="number" name="rate[]" id=""  placeholder=""/></td>
                                                    <td><input class="form-control qty required" value="1" type="number" name="qty[]" id=""  placeholder=""/></td>
                                                    <td><input class="form-control amount required" value="0" type="number" name="" id=""  disabled="disabled" placeholder=""/></td>
                                                    {{--<td><input class="" type="checkbox" placeholder=""/></td>--}}
                                                    <td>
                                                        {{--<button type="button" class="btn btn-danger ">X</button>--}}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <button id="btn2" type="button" class="btn btn-success">+</button>
                                            <hr>


                                            <table class="balance " style="margin-left: 80%">
                                                {{--<tr>--}}
                                                <th><span>Sub Total: </span></th>
                                                <td><span data-prefix>&pound;</span><span class="net_total">   0.00</span></td>
                                                </tr>
                                                <tr>
                                                <th><span>Discount(0%): </span></th>
                                                <td><input type="number" id="discount" name="discount" class="form-control" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <th><span>Total: </span></th>
                                                    <td ><span data-prefix>&pound;</span><span class="total" name="total" id="total" total_bill="0">  0.00</span></td>
                                                    {{--<td ><span><span data-prefix>$</span><input  class="form-control rate" value="" type="number" name="total" id="total"  placeholder="0:00"/></span></td>--}}
                                                </tr>
                                                {{--<tr>--}}
                                                {{--<th><span><b>Balance Due:</b></span></th>--}}
                                                {{--<td> <span data-prefix> $</span><span>   0.00</span></td>--}}
                                                {{--</tr>--}}
                                            </table>

                                            <br> <br>
                                            <div >
                                                <label>Notes:</label>
                                                <textarea style="margin: 0px;width: 1563px;height: 235px;" class="form-control form-control-sm" type="text" name="notes" id="notes" ng-model="toCompany" placeholder="Any relavent information....."></textarea>
                                                <br><br>

                                            </div>

                                        </div>
                                    </div>



                                </form>

                                <div class="col-md-12">
                                    <div class="clearfix"></div>
                                    <hr>
                                    <span>
                                        <a style="margin-left: 30px;" class="btn btn-info" href="{{route("home")}}">Reset Invoice</a>
                                        <button style="margin-left: 50px;" type="button" class="btn btn-success save" href="">Save Invoice</button>

                                        {{--<div class="text-right">--}}
                                            {{--<button id="print" class="btn btn-default btn btn-success btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>--}}
                                        {{--</div>--}}
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <!-- .row -->
            <!-- .right-sidebar -->

            <!-- /.right-sidebar -->
        </div>
        <!-- /.container-fluid -->
        @include('themes.main-theme.includes.footer')
        @section('scripts')
            <script src="{{asset("admin/plugins/bower_components/sweetalert/sweetalert.min.js")}}"></script>
            <script src="{{asset("admin/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js")}}"></script>
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
            </script>
            <script type="text/javascript">
                $("body").on('click','.panel-head',function () {
                    // $(".panel-body").hide();
                    $(this).parent().find(".panel-body").toggle();
                });
                $("#discount").on('change',function(){
                    var discount = $("#discount").val();

                    if (discount < 0){
                        discount = 0 ;
                        $("#discount").val(discount);
                    }
                    var total_bill = $(".total").attr("total_bill");
                    var net_bill = total_bill - (discount/100 * total_bill);
                    // var discount_rs = total_bill - net_bill;
                    // var discount_rs = discount_rs.toFixed(2);


                    $(".total").html(net_bill);
                    $("#total_num").val(net_bill);

                });
                {{--$(".service_item").click(function () {--}}
                    {{--var id = $(this).attr("id");--}}
                    {{--var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');--}}
                    {{--$(".service_item").removeClass("active");--}}
                    {{--$(this).addClass("active");--}}
                    {{--$.post("{{ route('getServiceItem') }}", {_token: CSRF_TOKEN, id: id}).done(function (response) {--}}

                        {{--// Add response in Modal body--}}
                        {{--$('.item_detail').html(response);--}}

                        {{--// Display Modal--}}
                        {{--// $('#empModal').modal('show');--}}

                    {{--});--}}
                {{--});--}}
                $(document).ready(function(){
                    $("#btn2").click(function(){
                        $(".main_tbody").append("<tr >\n" +
                            "                                        <td><input class=\"form-control\" required name='description[]' type=\"text\" placeholder=\"item description\"/>\n" +
                            "                                        <br>\n" +
                            "                                        <textarea class=\"form-control\" required name='detail[]' type=\"text\" placeholder=\"Additional Details\"></textarea>\n" +
                            "                                        </td>\n" +
                            "                                        <td><input class=\"form-control rate\" name='rate[]' required type=\"number\" value=\"0\" placeholder=\"\"/></td>\n" +
                            "                                        <td><input class=\"form-control qty\" name='qty[]' required type=\"number\" value=\"1\" placeholder=\"\"/></td>\n" +
                            "                                        <td><input class=\"form-control amount\"  type=\"number\" value=\"1\" disabled=\"disabled\" placeholder=\"\"/></td>\n" +
                            // "                                        <td><input class=\"\" type=\"checkbox\"  placeholder=\"\"/></td>\n" +
                            "                                        <td>\n" +
                            "                                            <button class=\"btn btn-danger remove\">X</button>\n" +
                            "                                        </td>\n" +
                            "                                    </tr>");
                        total()
                    });

                    $("tbody").on("click",".remove",function(){
                        $(this).parent().parent().remove();
                        total()
                    });
                    $("tbody").on("change",".rate",function(){
                        var rate = $(this).val();
                        if (rate < 0){
                            $(this).val(0);
                        }
                        total()
                    });
                    $("tbody").on("change",".qty",function(){
                        var qty = $(this).val();
                        if (qty < 1){
                            $(this).val(1);
                        }
                        total()
                    });
                    function total() {
                        var total = 0;
                        $(".main_tbody").find("tr").each(function () {
                            var rate = $(this).find(".rate").val();
                            var qty = $(this).find(".qty").val();
                            var sub_total = rate*qty;
                            $(this).find(".amount").val(sub_total);
                            total = total + sub_total;
                        });
                        $(".net_total").html(total);
                        $(".total").attr("total_bill",total);
                        var discount = $("#discount").val();
                        var net_bill = total - (discount/100 * total);
                        $("#total_num").val(net_bill);
                        $(".total").html(net_bill);

                    }
                });

                $(".accountLogo").click(function () {
                    var checked = $(this).is(':checked');
                    if (checked) {
                        $(".invoiceLogo").hide();
                    } else {
                        $(".invoiceLogo").show();
                    }

                });
            </script>
        @endsection
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
@include('themes.main-theme.includes.scripts')
</body>

</html>
