<?php
include_once("init.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Salon | Update Out Standing</title>
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
            $('#test1').jdPicker();
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
                Update Out standings
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Out Standings</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <!--                    <h3 class="box-title">Data Table With Full Features</h3>-->
                </div>
                <!-- /.box-header -->
                <div class="box-body">


                    <div class="content-module-main cf">
                        <form name="form1" method="post" id="form1" action="">

                            <table class="table" border="0" cellspacing="10" cellpadding="10">
                                <?php
                                if (isset($_POST['id'])) {

                                    $id = mysqli_real_escape_string($db->connection, $_POST['id']);
                                    $balance = mysqli_real_escape_string($db->connection, $_POST['balance']);
                                    $payment = mysqli_real_escape_string($db->connection, $_POST['payment']);
                                    $supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                                    $subtotal = mysqli_real_escape_string($db->connection, $_POST['total']);
                                    $newpayment = mysqli_real_escape_string($db->connection, $_POST['new_payment']);
                                    $selected_date = $_POST['date'];
                                    $selected_date = strtotime($selected_date);
                                    $mysqldate = date('Y-m-d H:i:s', $selected_date);
                                    $due = $mysqldate;
                                    $balance = (int)$balance - (int)$newpayment;
                                    $payment = (int)$payment + (int)$newpayment;

                                    if ($db->query("UPDATE stock_entries  SET balance='$balance',payment='$payment',due='$due' where stock_id='$id'")) {
                                        $db->query("INSERT INTO transactions(type,supplier,payment,balance,rid,due,subtotal) values('entry','$supplier','$newpayment','$balance','$id','$due','$subtotal')");
                                        echo "<br><font color=green size=+1 > [ $id ] Supplier Details Updated!</font>";
                                    } else
                                        echo "<br><font color=red size=+1 >Problem in Updation !</font>";


                                }
                                ?>
                                <?php
                                if (isset($_GET['sid']))
                                    $id = $_GET['sid'];

                                $line = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE stock_id='$id'");
                                ?>
                                <form name="form1" method="post" id="form1" action="">

                                    <input name="id" type="hidden" value="<?php echo $_GET['sid']; ?>">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>Sales ID</td>
                                        <td><input name="stock_id" type="text" readonly="readonly" readonly="readonly"
                                                   id="stockid" maxlength="200" class="round default-width-input"
                                                   value="<?php echo $line->stock_id; ?> "/>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>Customer</td>
                                        <td><input name="customer" type="text" id="customer" maxlength="200"
                                                   readonly="readonly" class="round default-width-input"
                                                   value="<?php echo $line->stock_supplier_name; ?> "/></td>
                                        <td>Total</td>
                                        <td><input name="total" type="text" id="tatal" maxlength="20" readonly="readonly"
                                                   class="round default-width-input"
                                                   value="<?php echo $line->subtotal; ?>"/></td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>Paid</td>
                                        <td><input name="paid" type="text" id="paid" maxlength="20" readonly="readonly"
                                                   class="round default-width-input"
                                                   value="<?php echo $line->payment; ?>"
                                                   onkeypress="return numbersonly(event)"/></td>
                                        <td>Balance</td>
                                        <td><input name="balance" type="text" id="balance" readonly="readonly"
                                                   maxlength="20" class="round default-width-input"
                                                   value="<?php echo $line->balance; ?>"
                                                   onkeypress="return numbersonly(event)"/></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>New Date</td>
                                        <td><input name="date" type="text" id="test1" maxlength="20"
                                                   class="round default-width-input"
                                                   value="<?php echo date("Y/m/d"); ?>"/></td>
                                        <td>New Payment</td>
                                        <td><input name="new_payment" id="new_payment" type="text"
                                                   onkeypress="return numbersonly(event)" maxlength="20"
                                                   onkeyup="change_balance()" class="round default-width-input"
                                                /></td>
                                    </tr>


                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <input class="button round blue image-right ic-add text-upper" type="submit"
                                                   name="Submit" value="Save">

                                        </td>
                                        <td align="right"><input class="button round red   text-upper" type="reset"
                                                                 name="Reset" value="Reset">
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                            </table>
                        </form>


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

</body>
</html>
