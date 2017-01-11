<?php
include_once("init.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Salon | Purchase Report</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/date_pic/jquery.date_input.js"></script>
    <script src="js/script.js"></script>
    <script>
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {
            $('#from_sales_date').jdPicker();
            $('#to_sales_date').jdPicker();
            $('#from_purchase_date').jdPicker();
            $('#to_purchase_date').jdPicker();
            $('#from_sales_purchase_date').jdPicker();
            $('#to_sales_purchase_date').jdPicker();
            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },

                    cost: {
                        required: true

                    },
                    sell: {
                        required: true

                    }
                },
                messages: {
                    name: {
                        required: "Please enter a Stock Name",
                        minlength: "Stock must consist of at least 3 characters"
                    },
                    cost: {
                        required: "Please enter a cost Price"
                    },
                    sell: {
                        required: "Please enter a Sell Price"
                    }
                }
            });

        });
        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 38 && unicode != 39 && unicode != 40) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57)
                    return false
            }
        }
        function change_balance() {
            if (parseFloat(document.getElementById('new_payment').value) > parseFloat(document.getElementById('balance').value)) {
                document.getElementById('new_payment').value = parseFloat(document.getElementById('balance').value);
            }
        }

        function sales_report_fn() {
            window.open("sales_report.php?from_sales_date=" + $('#from_sales_date').val() + "&to_sales_date=" + $('#to_sales_date').val(), "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");

        }
        function purchase_report_fn() {
            window.open("purchase_report.php?from_purchase_date=" + $('#from_purchase_date').val() + "&to_purchase_date=" + $('#to_purchase_date').val(), "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");

        }

        function sales_purchase_report_fn() {
            window.open("all_report.php?from_sales_purchase_date=" + $('#from_sales_purchase_date').val() + "&to_sales_purchase_date=" + $('#to_sales_purchase_date').val(), "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");

        }

        function stock_sales_report_fn() {
            window.open("sales_stock_report.php?from_stock_sales_date=" + $('#from_stock_sales_date').val() + "&to_stock_sales_date=" + $('#to_stock_sales_date').val(), "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");

        }
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!--put header here-->
    <?php include 'templateCus/header.php'?>
    <!--put sidebar here-->
    <?php include 'templateCus/SideBar.php'?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Purchase Report
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Report</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <!--                    <h3 class="box-title">Data Table With Full Features</h3>-->
                </div>
                <!-- /.box-header -->

                <div class="content-module-main cf">
                    <form action="">

                        <table class="table" border="0" cellspacing="0" cellpadding="0">
<!--                            <form action="sales_report.php" method="post" name="form1" id="form1" name="sales_report"-->
<!--                                  id="sales_report" target="myNewWinsr">-->
<!--                                <tr>-->
<!---->
<!--                                    <td><strong>Sales Report </strong></td>-->
<!--                                    <td>From</td>-->
<!--                                    <td><input name="from_sales_date" type="text" id="from_sales_date"-->
<!--                                               style="width:80px;"></td>-->
<!--                                    <td>To</td>-->
<!--                                    <td><input name="to_sales_date" type="text" id="to_sales_date" style="width:80px;">-->
<!--                                    </td>-->
<!--                                    <td><input name="submit" type="button" value="Show" onClick='sales_report_fn();'>-->
<!--                                    </td>-->
<!---->
<!--                                </tr>-->
<!--                            </form>-->
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <form action="purchase_report.php" method="post" name="purchase_report" target="_blank">
                                <tr>
                                    <td><strong>Purchase Report </strong></td>
                                    <td>From</td>
                                    <td><input name="from_purchase_date" type="text" id="from_purchase_date"
                                               style="width:80px;"></td>
                                    <td>To</td>
                                    <td><input name="to_purchase_date" type="text" id="to_purchase_date"
                                               style="width:80px;"></td>
                                    <td><input name="submit" type="button" value="Show" onClick='purchase_report_fn();'>
                                    </td>
                                </tr>
                            </form>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

<!--                            <form action="sales_purchase_report.php" method="post" name="sales_purchase_report"-->
<!--                                  target="_blank">-->
<!--                                <tr>-->
<!--                                    <td><strong>Purchase Stocks </strong></td>-->
<!--                                    <td>From</td>-->
<!--                                    <td><input name="from_sales_purchase_date" type="text" id="from_sales_purchase_date"-->
<!--                                               style="width:80px;"></td>-->
<!--                                    <td>To</td>-->
<!--                                    <td><input name="to_sales_purchase_date" type="text" id="to_sales_purchase_date"-->
<!--                                               style="width:80px;"></td>-->
<!--                                    <td><input name="submit" type="button" value="Show"-->
<!--                                               onClick='sales_purchase_report_fn();'></td>-->
<!--                                </tr>-->
<!--                            </form>-->

                        </table>


                </div>
                <!-- end content-module-main -->

                <!--                    <table id="example1" class="table table-bordered table-striped">-->
                <!--                        <thead>-->
                <!--                        <tr>-->
                <!--                            <th>Rendering engine</th>-->
                <!--                            <th>Browser</th>-->
                <!--                            <th>Platform(s)</th>-->
                <!--                            <th>Engine version</th>-->
                <!--                            <th>CSS grade</th>-->
                <!--                        </tr>-->
                <!--                        </thead>-->
                <!--                        <tbody>-->
                <!--                        <tr>-->
                <!--                            <td>Trident</td>-->
                <!--                            <td>Internet-->
                <!--                                Explorer 4.0-->
                <!--                            </td>-->
                <!--                            <td>Win 95+</td>-->
                <!--                            <td> 4</td>-->
                <!--                            <td>X</td>-->
                <!--                        </tr>-->
                <!---->
                <!--                        </tbody>-->
                <!---->
                <!--                    </table>-->
            </div>
            <!-- /.box-body -->
    </div>




    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">

    </div>
    <strong>Copyright &copy; 2016-2017 <b>Salon</b></strong> All rights
    reserved.
</footer>


<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
</body>
</html>
