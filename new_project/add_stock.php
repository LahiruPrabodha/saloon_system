<?php
include_once("init.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Salon | Add Stock</title>
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
    <script src="js/script.js"></script>
    <script src="js/date_pic/jquery.date_input.js"></script>
    <script src="lib/auto/js/jquery.autocomplete.js "></script>

    <script>
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {
            $("#supplier").autocomplete("supplier1.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            $("#category").autocomplete("category.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    stockid: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    cost: {
                        required: true,

                    },
                    sell: {
                        required: true,

                    }
                },
                messages: {
                    name: {
                        required: "Please Enter Stock Name",
                        minlength: "Category Name must consist of at least 3 characters"
                    },
                    stockid: {
                        required: "Please Enter Stock ID",
                        minlength: "Category Name must consist of at least 3 characters"
                    },
                    sell: {
                        required: "Please Enter Selling Price",
                        minlength: "Category Name must consist of at least 3 characters"
                    },
                    cost: {
                        required: "Please Enter Cost Price",
                        minlength: "Category Name must consist of at least 3 characters"
                    }
                }
            });

        });
        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57)
                    return false
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
                Add Stock
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Stock</li>
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


                        <?php
                        //Gump is libarary for Validatoin

                        if (isset($_POST['name'])) {
                            $_POST = $gump->sanitize($_POST);
                            $gump->validation_rules(array(
                                'name' => 'required|max_len,100|min_len,3',
                                'stockid' => 'required|max_len,200',
                                'sell' => 'required|max_len,200',
                                'cost' => 'required|max_len,200',
                                'supplier' => 'max_len,200',
                                'category' => 'max_len,200'

                            ));

                            $gump->filter_rules(array(
                                'name' => 'trim|sanitize_string|mysqli_escape',
                                'stockid' => 'trim|sanitize_string|mysqli_escape',
                                'sell' => 'trim|sanitize_string|mysqli_escape',
                                'cost' => 'trim|sanitize_string|mysqli_escape',
                                'category' => 'trim|sanitize_string|mysqli_escape',
                                'supplier' => 'trim|sanitize_string|mysqli_escape'

                            ));

                            $validated_data = $gump->run($_POST);
                            $name = "";
                            $stockid = "";
                            $sell = "";
                            $cost = "";
                            $supplier = "";
                            $category = "";


                            if ($validated_data === false) {
                                echo $gump->get_readable_errors(true);
                            } else {


                                $name = mysqli_real_escape_string($db->connection, $_POST['name']);
                                $stockid = mysqli_real_escape_string($db->connection, $_POST['stockid']);
                                $sell = mysqli_real_escape_string($db->connection, $_POST['sell']);
                                $cost = mysqli_real_escape_string($db->connection, $_POST['cost']);
                                $supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                                $category = mysqli_real_escape_string($db->connection, $_POST['category']);


                                $count = $db->countOf("stock_details", "stock_id ='$stockid'");
                                if ($count == 1) {
                                    echo "<font color=red> Dublicat Entry. Please Verify</font>";
                                } else {

                                    if ($db->query("insert into stock_details(stock_id,stock_name,stock_quatity,supplier_id,company_price,selling_price,category) values('$stockid','$name',0,'$supplier','$cost','$sell','$category')")) {
                                        echo "<br><font color=green size=+1 > [ $name ] Stock Details Added !</font>";
                                        $db->query("insert into stock_avail(name,quantity) values('$name',0)");
                                    } else
                                        echo "<br><font color=red size=+1 >Problem in Adding !</font>";

                                }


                            }

                        }


                        ?>

                        <form name="form1" method="post" id="form1" action="">


                            <table class="table" border="0" cellspacing="10" cellpadding="10">
                                <tr>
                                    <?php
                                    $max = $db->maxOfAll("id", "stock_details");
                                    $max = $max + 1;
                                    $autoid = "SD" . $max . "";
                                    ?>
                                    <td><span class="man">*</span>Stock ID:</td>
                                    <td><input name="stockid" type="text" id="stockid" readonly="readonly" maxlength="200"
                                               class="round default-width-input"
                                               value="<?php echo isset($autoid) ? $autoid : ''; ?>"/></td>

                                    <td><span class="man">*</span>Name:</td>
                                    <td><input name="name" placeholder="ENTER CATEGORY NAME" type="text" id="name"
                                               maxlength="200" class="round default-width-input"
                                               value="<?php echo isset($name) ? $name : ''; ?>"/></td>

                                </tr>
                                <tr>
                                    <td><span class="man">*</span>Cost:</td>
                                    <td><input name="cost" placeholder="ENTER COST PRICE" type="text" id="cost"
                                               maxlength="200" class="round default-width-input"
                                               onkeypress="return numbersonly(event)"
                                               value="<?php echo isset($cost) ? $cost : ''; ?>"/></td>

                                    <td><span class="man">*</span>Sell:</td>
                                    <td><input name="sell" placeholder="ENTER SELLING PRICE" type="text" id="sell"
                                               maxlength="200" class="round default-width-input"
                                               onkeypress="return numbersonly(event)"
                                               value="<?php echo isset($sell) ? $sell : ''; ?>"/></td>

                                </tr>
                                <tr>
                                    <td>Supplier:</td>
                                    <td><input name="supplier" placeholder="ENTER SUPPLIER NAME" type="text" id="supplier"
                                               maxlength="200" class="round default-width-input"
                                               value="<?php echo isset($supplier) ? $supplier : ''; ?>"/></td>

                                    <td>Category:</td>
                                    <td><input name="category" placeholder="ENTER CATEGORY NAME" type="text" id="category"
                                               maxlength="200" class="round default-width-input"
                                               value="<?php echo isset($category) ? $category : ''; ?>"/></td>

                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>


                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <input class="button round blue image-right ic-add text-upper" type="submit"
                                               name="Submit" value="Add">


                                    <td align="right"><input class="button round red   text-upper" type="reset" name="Reset"
                                                             value="Reset"></td>
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
