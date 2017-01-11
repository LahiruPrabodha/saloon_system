<?php
include_once("init.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Salon | View Sales</title>
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
<!--    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">-->
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

<!--    <style type="text/css">-->
<!---->
<!--        body {-->
<!--            margin-left: 0px;-->
<!--            margin-top: 0px;-->
<!--            margin-right: 0px;-->
<!--            margin-bottom: 0px;-->
<!--            background-color: #FFFFFF;-->
<!--        }-->
<!---->
<!--        * {-->
<!--            padding: 0px;-->
<!--            margin: 0px;-->
<!--        }-->
<!---->
<!--        #vertmenu {-->
<!--            font-family: Verdana, Arial, Helvetica, sans-serif;-->
<!--            font-size: 100%;-->
<!--            width: 160px;-->
<!--            padding: 0px;-->
<!--            margin: 0px;-->
<!--        }-->
<!---->
<!--        #vertmenu h1 {-->
<!--            display: block;-->
<!--            background-color: #FF9900;-->
<!--            font-size: 90%;-->
<!--            padding: 3px 0 5px 3px;-->
<!--            border: 1px solid #000000;-->
<!--            color: #333333;-->
<!--            margin: 0px;-->
<!--            width: 159px;-->
<!--        }-->
<!---->
<!--        #vertmenu ul {-->
<!--            list-style: none;-->
<!--            margin: 0px;-->
<!--            padding: 0px;-->
<!--            border: none;-->
<!--        }-->
<!---->
<!--        #vertmenu ul li {-->
<!--            margin: 0px;-->
<!--            padding: 0px;-->
<!--        }-->
<!---->
<!--        #vertmenu ul li a {-->
<!--            font-size: 80%;-->
<!--            display: block;-->
<!--            border-bottom: 1px dashed #C39C4E;-->
<!--            padding: 5px 0px 2px 4px;-->
<!--            text-decoration: none;-->
<!--            color: #666666;-->
<!--            width: 160px;-->
<!--        }-->
<!---->
<!--        #vertmenu ul li a:hover, #vertmenu ul li a:focus {-->
<!--            color: #000000;-->
<!--            background-color: #eeeeee;-->
<!--        }-->
<!---->
<!--        .style1 {-->
<!--            color: #000000-->
<!--        }-->
<!---->
<!--        div.pagination {-->
<!---->
<!--            padding: 3px;-->
<!---->
<!--            margin: 3px;-->
<!---->
<!--        }-->
<!---->
<!--        div.pagination a {-->
<!---->
<!--            padding: 2px 5px 2px 5px;-->
<!---->
<!--            margin: 2px;-->
<!---->
<!--            border: 1px solid #AAAADD;-->
<!---->
<!--            text-decoration: none; /* no underline */-->
<!---->
<!--            color: #000099;-->
<!---->
<!--        }-->
<!---->
<!--        div.pagination a:hover, div.pagination a:active {-->
<!---->
<!--            border: 1px solid #000099;-->
<!---->
<!--            color: #000;-->
<!---->
<!--        }-->
<!---->
<!--        div.pagination span.current {-->
<!---->
<!--            padding: 2px 5px 2px 5px;-->
<!---->
<!--            margin: 2px;-->
<!---->
<!--            border: 1px solid #000099;-->
<!---->
<!--            font-weight: bold;-->
<!---->
<!--            background-color: #000099;-->
<!---->
<!--            color: #FFF;-->
<!---->
<!--        }-->
<!---->
<!--        div.pagination span.disabled {-->
<!---->
<!--            padding: 2px 5px 2px 5px;-->
<!---->
<!--            margin: 2px;-->
<!---->
<!--            border: 1px solid #EEE;-->
<!---->
<!--            color: #DDD;-->
<!---->
<!--        }-->
<!---->
<!---->
<!--    </style>-->
    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/script.js"></script>
    <script>
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {

            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    address: {
                        minlength: 3,
                        maxlength: 500
                    },
                    contact1: {
                        minlength: 3,
                        maxlength: 20
                    },
                    contact2: {
                        minlength: 3,
                        maxlength: 20
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a Customer Name",
                        minlength: "Customer must consist of at least 3 characters"
                    },
                    address: {
                        minlength: "Customer Address must be at least 3 characters long",
                        maxlength: "Customer Address must be at least 3 characters long"
                    }
                }
            });

        });

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
               Add Customers
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Customers</li>
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
                    <div class="side-content fr">

                        <div class="content-module">

<!--                            <div class="content-module-heading cf">-->
<!---->
<!--                                <h3 class="fl">Add Customer</h3>-->
<!--                                <span class="fr expand-collapse-text">Click to collapse</span>-->
<!--                                <span class="fr expand-collapse-text initial-expand">Click to expand</span>-->
<!---->
<!--                            </div>-->
                            <!-- end content-module-heading -->

                            <div class="form-group">


                                <?php
                                //Gump is libarary for Validatoin

                                if (isset($_POST['name'])) {
                                    $_POST = $gump->sanitize($_POST);
                                    $gump->validation_rules(array(
                                        'name' => 'required|max_len,100|min_len,3',
                                        'address' => 'max_len,200',
                                        'contact1' => 'alpha_numeric|max_len,20',
                                        'contact2' => 'alpha_numeric|max_len,20'
                                    ));

                                    $gump->filter_rules(array(
                                        'name' => 'trim|sanitize_string|mysqli_escape',
                                        'address' => 'trim|sanitize_string|mysqli_escape',
                                        'contact1' => 'trim|sanitize_string|mysqli_escape',
                                        'contact2' => 'trim|sanitize_string|mysqli_escape'
                                    ));

                                    $validated_data = $gump->run($_POST);
                                    $name = "";
                                    $address = "";
                                    $contact1 = "";
                                    $contact2 = "";

                                    if ($validated_data === false) {
                                        echo $gump->get_readable_errors(true);
                                    } else {


                                        $name = mysqli_real_escape_string($db->connection, $_POST['name']);
                                        $address = mysqli_real_escape_string($db->connection, $_POST['address']);
                                        $contact1 = mysqli_real_escape_string($db->connection, $_POST['contact1']);
                                        $contact2 = mysqli_real_escape_string($db->connection, $_POST['contact2']);

                                        $count = $db->countOf("customer_details", "customer_name='$name'");
                                        if ($count == 1) {
                                            echo "<div class='error-box round'>Dublicat Entry. Please Verify</div>";
                                        } else {

                                            if ($db->query("insert into customer_details values(NULL,'$name','$address','$contact1','$contact2',0)"))
                                                echo "<div class='confirmation-box round'>[ $name ] Customer Details Added !</div>";
                                            else
                                                echo "<div class='error-box round'>Problem in Adding !</div>";

                                        }
                                    }
                                }

                                ?>

                                <form name="form1" method="post" id="form1" action="" >


                                    <table class="table" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><span class="man">*</span>Name:</td>
                                            <td><input name="name" placeholder="ENTER YOUR FULL NAME" type="text" id="name"
                                                       maxlength="200" value="<?php echo isset($name) ? $name : ''; ?>"/></td>
                                            <td>Contact 1</td>
                                            <td><input name="contact1" placeholder="ENTER YOUR ADDRESS contact1" type="text"
                                                       id="buyingrate" maxlength="20"
                                                       value="<?php echo isset($contact1) ? $contact1 : ''; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td><textarea name="address" placeholder="ENTER YOUR ADDRESS" cols="15"
                                                          ><?php echo isset($address) ? $address : ''; ?></textarea>
                                            </td>
                                            <td>Contact 2</td>
                                            <td><input name="contact2" placeholder="ENTER YOUR contact2" type="text"
                                                       id="sellingrate" maxlength="20"
                                                       value="<?php echo isset($contact2) ? $contact2 : ''; ?>"/></td>

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

                                            <td>
                                                &nbsp;
                                            </td>
                                            <td align="right"><input class="button round red text-upper" type="reset" name="Reset"
                                                                     value="Reset"></td>
                                        </tr>
                                    </table>
                                </form>


                            </div>
                            <!-- end content-module-main -->


                        </div>
                        <!-- end content-module -->


                    </div>
                    <!-- end full-width -->
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
<!--<script src="plugins/morris/morris.min.js"></script>-->
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
