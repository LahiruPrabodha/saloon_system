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
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
<!--    <link rel="stylesheet" href="plugins/morris/morris.css">-->
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

    <script type="text/javascript">
        $(function () {

            $("#supplier").autocomplete("customer1.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            $("#item").autocomplete("stock.php", {
                width: 160,
                autoFill: true,
                mustMatch: true,
                selectFirst: true
            });
            $("#item").blur(function () {
                document.getElementById('total').value = document.getElementById('sell').value * document.getElementById('quty').value
            });
            $("#item").blur(function () {


                $.post('check_item_details.php', {stock_name1: $(this).val()},
                    function (data) {

                        $("#sell").val(data.sell);
                        $("#stock").val(data.stock);
                        $('#guid').val(data.guid);
                        if (data.sell != undefined)
                            $("#0").focus();


                    }, 'json');


            });
            $("#supplier").blur(function () {


                $.post('check_customer_details.php', {stock_name1: $(this).val()},
                    function (data) {

                        $("#address").val(data.address);
                        $("#contact1").val(data.contact1);

                        if (data.address != undefined)
                            $("#0").focus();

                    }, 'json');


            });
            $('#test1').jdPicker();
            $('#test2').jdPicker();


            var hauteur = 0;
            $('.code').each(function () {
                if ($(this).height() > hauteur) hauteur = $(this).height();
            });

            $('.code').each(function () {
                $(this).height(hauteur);
            });
        });

    </script>
    <script>
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {
            document.getElementById('bill_no').focus();
            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    bill_no: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    stockid: {
                        required: true
                    },
                    grand_total: {
                        required: true
                    },
                    supplier: {
                        required: true,
                    },
                    payment: {
                        required: true,
                    }
                },
                messages: {
                    supplier: {
                        required: "Please Enter Supplier"
                    },
                    stockid: {
                        required: "Please Enter Stock ID"
                    },
                    payment: {
                        required: "Please Enter Payment"
                    },
                    grand_total: {
                        required: "Add Stock Items"
                    },
                    bill_no: {
                        required: "Please Enter Bill Number",
                        minlength: "Bill Number must consist of at least 3 characters"
                    }
                }
            });

        });
        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57)
                    return false
            }
        }


    </script>
    <script type="text/javascript">
        function remove_row(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }
        function add_values() {
            if (unique_check()) {

                if (document.getElementById('edit_guid').value == "") {
                    if (document.getElementById('item').value != "" && document.getElementById('quty').value != "" && document.getElementById('total').value != "") {

                        if (document.getElementById('quty').value != 0) {
                            code = document.getElementById('item').value;

                            quty = document.getElementById('quty').value;
                            sell = document.getElementById('sell').value;
                            disc = document.getElementById('stock').value;
                            total = document.getElementById('total').value;
                            item = document.getElementById('guid').value;
                            main_total = document.getElementById('posnic_total').value;

                            $('<tr id=' + item + '><td><input type=hidden value=' + item + ' id=' + item + 'id ><input type=text name="stock_name[]"  id=' + item + 'st style="width: 150px" class="round  my_with" ></td><td><input type=text name=quty[] readonly="readonly" value=' + quty + ' id=' + item + 'q class="round  my_with" style="text-align:right;" ></td><td><input type=text name=sell[] readonly="readonly" value=' + sell + ' id=' + item + 's class="round  my_with" style="text-align:right;"  ></td><td><input type=text name=stock[] readonly="readonly" value=' + disc + ' id=' + item + 'p class="round  my_with" style="text-align:right;" ></td><td><input type=text name=jibi[] readonly="readonly" value=' + total + ' id=' + item + 'to class="round  my_with" style="width: 120px;margin-left:20px;text-align:right;" ><input type=hidden name=total[] id=' + item + 'my_tot value=' + main_total + '> </td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/edit_new.png)" class="round" onclick="edit_stock_details(this.id)"  ></td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/close_new.png)" class="round" onclick=reduce_balance("' + item + '");$(this).closest("tr").remove(); ></td></tr>').fadeIn("slow").appendTo('#item_copy_final');
                            document.getElementById('quty').value = "";
                            document.getElementById('sell').value = "";
                            document.getElementById('stock').value = "";
                            document.getElementById('total').value = "";
                            document.getElementById('item').value = "";
                            document.getElementById('guid').value = "";
                            if (document.getElementById('grand_total').value == "") {
                                document.getElementById('grand_total').value = main_total;
                            } else {
                                document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) + parseFloat(main_total);
                            }
                            document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
                            document.getElementById(item + 'st').value = code;
                            document.getElementById(item + 'to').value = total;
                        } else {
                            alert('No Stock Available For This Item');
                        }
                    } else {
                        alert('Please Select An Item');
                    }
                } else {
                    id = document.getElementById('edit_guid').value;
                    document.getElementById(id + 'st').value = document.getElementById('item').value;
                    document.getElementById(id + 'q').value = document.getElementById('quty').value;
                    document.getElementById(id + 's').value = document.getElementById('sell').value;
                    document.getElementById(id + 'p').value = document.getElementById('stock').value;
                    document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) + parseFloat(document.getElementById('posnic_total').value) - parseFloat(document.getElementById(id + 'my_tot').value);
                    document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
                    document.getElementById(id + 'to').value = document.getElementById('total').value;
                    document.getElementById(id + 'id').value = id;

                    document.getElementById(id + 'my_tot').value = document.getElementById('posnic_total').value
                    document.getElementById('quty').value = "";
                    document.getElementById('sell').value = "";
                    document.getElementById('stock').value = "";
                    document.getElementById('total').value = "";
                    document.getElementById('item').value = "";
                    document.getElementById('guid').value = "";
                    document.getElementById('edit_guid').value = "";
                }
            }
            discount_amount();
        }
        function total_amount() {
            balance_amount();

            document.getElementById('total').value = document.getElementById('sell').value * document.getElementById('quty').value
            document.getElementById('posnic_total').value = document.getElementById('total').value;
            //  document.getElementById('total').value = '$ ' + parseFloat(document.getElementById('total').value).toFixed(2);
            if (document.getElementById('item').value === "") {
                document.getElementById('item').focus();
            }
        }
        function edit_stock_details(id) {
            document.getElementById('item').value = document.getElementById(id + 'st').value;
            document.getElementById('quty').value = document.getElementById(id + 'q').value;
            document.getElementById('sell').value = document.getElementById(id + 's').value;
            document.getElementById('stock').value = document.getElementById(id + 'p').value;
            document.getElementById('total').value = document.getElementById(id + 'to').value;

            document.getElementById('guid').value = id;
            document.getElementById('edit_guid').value = id;

        }
        function unique_check() {
            if (!document.getElementById(document.getElementById('guid').value) || document.getElementById('edit_guid').value == document.getElementById('guid').value) {
                return true;

            } else {

                alert("This Item is already added In This Purchase");
                document.getElementById('item').focus();
                document.getElementById('quty').value = "";
                document.getElementById('sell').value = "";
                document.getElementById('stock').value = "";
                document.getElementById('total').value = "";
                document.getElementById('item').value = "";
                document.getElementById('guid').value = "";
                document.getElementById('edit_guid').value = "";
                return false;
            }
        }
        function quantity_chnage(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 13 && unicode != 9) {
            }
            else {
                add_values();

                document.getElementById("item").focus();

            }
            if (unicode != 27) {
            }
            else {

                document.getElementById("item").focus();
            }
        }
        function formatCurrency(fieldObj) {
            if (isNaN(fieldObj.value)) {
                return false;
            }
            fieldObj.value = '$ ' + parseFloat(fieldObj.value).toFixed(2);
            return true;
        }
        function balance_amount() {
            if (document.getElementById('payable_amount').value != "" && document.getElementById('payment').value != "") {
                data = parseFloat(document.getElementById('payable_amount').value);
                document.getElementById('balance').value = data - parseFloat(document.getElementById('payment').value);
                if (parseFloat(document.getElementById('payable_amount').value) >= parseFloat(document.getElementById('payment').value)) {

                } else {
                    if (document.getElementById('payable_amount').value != "") {
                        document.getElementById('balance').value = '000.00';
                        document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);
                    } else {
                        document.getElementById('balance').value = '000.00';
                        document.getElementById('payment').value = "";
                    }
                }
            } else {
                document.getElementById('balance').value = "";
            }


        }
        function stock_size() {
            if (parseFloat(document.getElementById('quty').value) > parseFloat(document.getElementById('stock').value)) {
                document.getElementById('quty').value = parseFloat(document.getElementById('stock').value);

                console.log();
            }
        }
        function discount_amount() {

            if (document.getElementById('grand_total').value != "") {
                document.getElementById('disacount_amount').value = parseFloat(document.getElementById('grand_total').value) * (parseFloat(document.getElementById('discount').value)) / 100;

            }
            if (document.getElementById('discount').value == "") {
                document.getElementById('disacount_amount').value = "";
            }
            discont = parseFloat(document.getElementById('disacount_amount').value);
            if (document.getElementById('disacount_amount').value == "") {
                discont = 0;
            }
            document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont;
            if (parseFloat(document.getElementById('payment').value) > parseFloat(document.getElementById('payable_amount').value)) {
                document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);

            }

        }
        function discount_as_amount() {
            if (parseFloat(document.getElementById('disacount_amount').value) > parseFloat(document.getElementById('grand_total').value))
                document.getElementById('disacount_amount').value = "";

            if (document.getElementById('grand_total').value != "") {
                if (parseFloat(document.getElementById('disacount_amount').value) < parseFloat(document.getElementById('grand_total').value)) {
                    discont = parseFloat(document.getElementById('disacount_amount').value);

                    document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont;
                    if (parseFloat(document.getElementById('payment').value) > parseFloat(document.getElementById('payable_amount').value)) {
                        document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);

                    }
                } else {
                    // document.getElementById('disacount_amount').value=parseFloat(document.getElementById('grand_total').value)-1;
                }
            }
        }
        function reduce_balance(id) {
            var minus = parseFloat(document.getElementById(id + "my_tot").value);
            document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) - minus;
            document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
            discount_amount();
            //console.log(id);
        }
        function discount_type() {
            if (document.getElementById('round').checked) {
                document.getElementById("discount").readOnly = true;
                document.getElementById("disacount_amount").readOnly = false;
                if (parseFloat(document.getElementById('grand_total')) != "") {
                    document.getElementById('disacount_amount').value = "";
                    document.getElementById('discount').value = "";
                    discount_amount();
                }
            } else {
                document.getElementById("discount").readOnly = false;
                document.getElementById("disacount_amount").readOnly = true;
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
                Add Sales
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Sales</li>
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

<!--                                <h3 class="fl">Add Salesbhbb</h3>-->
<!--                                <span class="fr expand-collapse-text">Click to collapse</span>-->
<!--                                <span class="fr expand-collapse-text initial-expand">Click to expand</span>-->

<!--                            </div>-->
                            <!-- end content-module-heading -->

                            <div class="content-module-main cf">


                                <?php
                                //Gump is libarary for Validatoin
                                if (isset($_GET['msg'])) {
                                    echo $_GET['msg'];
                                }

                                if (isset($_POST['payment'])) {
                                    $_POST = $gump->sanitize($_POST);

                                    $gump->validation_rules(array(
                                        'payment' => 'required|max_len,100|min_len,1'


                                    ));

                                    $gump->filter_rules(array(
                                        'payment' => 'trim|sanitize_string|mysqli_escape'


                                    ));

                                    $validated_data = $gump->run($_POST);
                                    $stock_name = "";
                                    $stockid = "";
                                    $payment = "";
                                    $bill_no = "";


                                    if ($validated_data === false) {
                                        echo $gump->get_readable_errors(true);
                                    } else {
                                        $username = $_SESSION['username'];

                                        $stockid = mysqli_real_escape_string($db->connection, $_POST['stockid']);

                                        $bill_no = mysqli_real_escape_string($db->connection, $_POST['bill_no']);
                                        $customer = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                                        $address = mysqli_real_escape_string($db->connection, $_POST['address']);
                                        $contact = mysqli_real_escape_string($db->connection, $_POST['contact']);
                                        $count = $db->countOf("customer_details", "customer_name='$customer'");
                                        if ($count == 0) {
                                            $db->query("insert into customer_details(customer_name,customer_address,customer_contact1) values('$customer','$address','$contact')");
                                        }
                                        $stock_name = $_POST['stock_name'];
                                        $quty = $_POST['quty'];
                                        $date = mysqli_real_escape_string($db->connection, $_POST['date']);
                                        $sell = $_POST['sell'];
                                        $total = $_POST['total'];
                                        $payable = $_POST['subtotal'];
                                        $description = mysqli_real_escape_string($db->connection, $_POST['description']);
                                        $due = mysqli_real_escape_string($db->connection, $_POST['duedate']);
                                        $payment = mysqli_real_escape_string($db->connection, $_POST['payment']);
                                        $discount = mysqli_real_escape_string($db->connection, $_POST['discount']);
                                        if ($discount == "") {
                                            $discount = 00;
                                        }
                                        $dis_amount = mysqli_real_escape_string($db->connection, $_POST['dis_amount']);
                                        if ($dis_amount == "") {
                                            $dis_amount = 00;
                                        }
                                        $subtotal = mysqli_real_escape_string($db->connection, $_POST['payable']);
                                        $balance = mysqli_real_escape_string($db->connection, $_POST['balance']);
                                        $mode = mysqli_real_escape_string($db->connection, $_POST['mode']);
                                        $tax = mysqli_real_escape_string($db->connection, $_POST['tax']);
                                        if ($tax == "") {
                                            $tax = 00;
                                        }
                                        $tax_dis = mysqli_real_escape_string($db->connection, $_POST['tax_dis']);
                                        $temp_balance = $db->queryUniqueValue("SELECT balance FROM customer_details WHERE customer_name='$customer'");
                                        $temp_balance = (int)$temp_balance + (int)$balance;
                                        $db->execute("UPDATE customer_details SET balance=$temp_balance WHERE customer_name='$customer'");
                                        $selected_date = $_POST['due'];
                                        $selected_date = strtotime($selected_date);
                                        $mysqldate = date('Y-m-d H:i:s', $selected_date);
                                        $due = $mysqldate;
                                        $max = $db->maxOfAll("id", "stock_entries");
                                        $max = $max + 1;
                                        $autoid = "SD" . $max . "";
                                        for ($i = 0; $i < count($stock_name); $i++) {
                                            $name1 = $stock_name[$i];
                                            $quantity = $_POST['quty'][$i];
                                            $rate = $_POST['sell'][$i];
                                            $total = $_POST['total'][$i];


                                            $selected_date = $_POST['date'];
                                            $selected_date = strtotime($selected_date);
                                            $mysqldate = date('Y-m-d H:i:s', $selected_date);
                                            $username = $_SESSION['username'];

                                            $count = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");

                                            if ($count >= 1) {


                                                $db->query("insert into stock_sales (tax,tax_dis,discount,dis_amount,grand_total,transactionid,stock_name,selling_price,quantity,amount,date,username,customer_id,subtotal,payment,balance,due,mode,description,count1,billnumber)
                            values('$tax','$tax_dis','$discount','$dis_amount','$payable','$autoid','$name1','$rate','$quantity','$total','$mysqldate','$username','$customer','$subtotal','$payment','$balance','$due','$mode','$description',$i+1,'$bill_no')");

                                                $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
                                                $amount1 = $amount - $quantity;

                                                $db->query("insert into stock_entries (stock_id,stock_name,quantity,opening_stock,closing_stock,date,username,type,salesid,total,selling_price,count1,billnumber) values('$autoid','$name1','$quantity','$amount','$amount1','$mysqldate','$username','sales','$autoid','$total','$rate',$i+1,'$bill_no')");
                                                //echo "<br><font color=green size=+1 >New Sales Added ! Transaction ID [ $autoid ]</font>" ;


                                                $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
                                                $amount1 = $amount - $quantity;
                                                $db->execute("UPDATE stock_avail SET quantity='$amount1' WHERE name='$name1'");

                                            } else {
                                                echo "<br><font color=green size=+1 >There is no enough stock deliver for $name1! Please add stock !</font>";
                                            }


                                        }
                                        $msg = "<br><font color=green size=6px >Sales Added successfully Ref: [" . $_POST['stockid'] . "] !</font>";
                                        echo "<script>window.location = 'add_sales.php?msg=$msg';</script>";


                                        echo "<script>window.open('add_sales_print.php?sid=$autoid','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
                                        //echo "<script>window.open('add_sales_print.php?sid=$autoid','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
                                        //$msg="<br><font color=green size=6px >Parchase order Added successfully Ref: [". $_POST['stockid']."] !</font>" ;
                                        //header("location:  add_purchase.php?msg=$msg");
                                    }

                                }

                                ?>

                                <form name="form1" method="post" id="form1" action="" class="form-group">
                                    <div class="form-group">
                                    <input type="hidden" id="posnic_total">

<!--                                    <p><strong>Add Stock/Product </strong> - Add New ( Control +2)</p>-->
                                    <table class="table" border="0" cellspacing="10" cellpadding="10">
                                        <tr >
                                            <?php
                                            $max = $db->maxOfAll("id", "stock_entries");
                                            $max = $max + 3;
                                            $autoid = "PR" . $max . "";
                                            ?>
                                            <td>Stock ID:</td>
                                            <td><input name="stockid" type="text" id="stockid" readonly="readonly" maxlength="200"
                                                       class="round default-width-input" style="width:130px "
                                                       value="<?php echo $autoid ?>"/></td>

                                            <td>Date:</td>
                                            <td><input name="date" id="test1" placeholder="" value="<?php echo date('d-m-Y'); ?>"
                                                       type="text" id="name" maxlength="200" class="round default-width-input"/>
                                            </td>
                                            <td><span class="man">*</span>Bill No:</td>
                                            <td><input name="bill_no" placeholder="ENTER BILL NO" type="text" id="bill_no"
                                                       maxlength="200" class="round default-width-input" style="width:120px "/></td>

                                        </tr>
                                        <tr >
                                            <td><span class="man">*</span>Customer:</td>
                                            <td><input name="supplier" placeholder="ENTER CUSTOMER" type="text" id="supplier"
                                                       maxlength="200" class="round default-width-input" style="width:130px "/></td>

                                            <td>Address:</td>
                                            <td><input name="address" placeholder="ENTER ADDRESS" type="text" id="address"
                                                       maxlength="200" class="round default-width-input"/></td>

                                            <td>contact:</td>
                                            <td><input name="contact" placeholder="ENTER CONTACT" type="text" id="contact1"
                                                       maxlength="200" class="round default-width-input"
                                                       onkeypress="return numbersonly(event)" style="width:120px "/></td>

                                        </tr>
                                    </table>
                                    <input type="hidden" id="guid">
                                    <input type="hidden" id="edit_guid">
                                    <table class="table"  class="table table-bordered table-striped">
                                        <tr>
                                            <td>Item:</td>
                                            <td>Quantity:</td>

                                            <td>Price:</td>
                                            <td>Available Stock:</td>
                                            <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total</td>
                                            <td> &nbsp;</td>
                                        </tr>
                                        <tr>

                                            <td><input name="" type="text" id="item" maxlength="200"
                                                       class="round default-width-input " style="width: 150px"/></td>

                                            <td><input name="" type="text" id="quty" maxlength="200"
                                                       class="round default-width-input my_with"
                                                       onKeyPress="quantity_chnage(event);return numbersonly(event)"
                                                       onkeyup="total_amount();unique_check();stock_size();"/></td>


                                            <td><input name="" type="text" id="sell" readonly="readonly" maxlength="200"
                                                       class="round default-width-input my_with"/></td>


                                            <td><input name="" type="text" id="stock" readonly="readonly" maxlength="200"
                                                       class="round  my_with"/></td>


                                            <td><input name="" type="text" id="total" maxlength="200"
                                                       class="round default-width-input " style="width:120px;  margin-left: 20px"/>
                                            </td>
                                            <td><input type="button" onclick="add_values()" onkeyup=" balance_amount();"
                                                       id="add_new_code"
                                                       style="margin-left:30px; width:30px;height:30px;border:none;background:url(images/add_new.png)"
                                                       class="round"></td>

                                        </tr>
                                    </table>
                                    <div style="overflow:auto ;max-height:300px;  ">
                                        <table class="table"  id="item_copy_final">

                                        </table>
                                    </div>


                                    <table class="table">
                                        <tr>
                                            <td> &nbsp;</td>
                                            <td> &nbsp;</td>
                                            <td><input type="checkbox" id="round" onclick="discount_type()">Discount As Amount</td>
                                        </tr>
                                        <tr>
                                            <td> &nbsp;</td>
                                            <td>Discount %<input type="text" maxlength="3" class="round"
                                                                 onkeyup=" discount_amount(); "
                                                                 onkeypress="return numbersonly(event);" name="discount"
                                                                 id="discount">
                                            </td>

                                            <td>Discount Amount:<input type="text" readonly="readonly"
                                                                       onkeypress="return numbersonly(event);"
                                                                       onkeyup=" discount_as_amount(); " class="round"
                                                                       id="disacount_amount" name="dis_amount">
                                            </td>
                                            <td> &nbsp;</td>

                                            <td> &nbsp;</td>
                                            <td> &nbsp;</td>
                                            <td>Grand Total:<input type="hidden" readonly="readonly" id="grand_total"
                                                                   name="subtotal">
                                                <input type="text" id="main_grand_total" readonly="readonly"
                                                       class="round default-width-input" style="text-align:right;width: 120px">
                                            </td>
                                            <td> &nbsp;</td>
                                            <td>Description</td>
                                            <td><textarea name="description"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td> &nbsp;</td>
                                            <td>Payment:<input type="text" class="round" onkeyup=" balance_amount(); "
                                                               onkeypress="return numbersonly(event);" name="payment" id="payment">
                                            </td>

                                            <td>Balance:<input type="text" class="round" readonly="readonly" id="balance"
                                                               name="balance">
                                            </td>
                                            <td> &nbsp;</td>

                                            <td> &nbsp;</td>
                                            <td> &nbsp;</td>
                                            <td>Payable Amount:<input type="hidden" readonly="readonly" id="grand_total">
                                                <input type="text" id="payable_amount" readonly="readonly" name="payable"
                                                       class="round default-width-input" style="text-align:right;width: 120px">
                                            </td>
                                            <td> &nbsp;</td>
                                            <td> &nbsp;</td>
                                            <td> &nbsp;</td>
                                        </tr>
                                    </table>
                                    <table class="table">
                                        <tr>
                                            <td>Mode &nbsp;</td>
                                            <td>
                                                <select name="mode">
                                                    <option value="cash">Cash</option>
                                                    <option value="cheque">Cheque</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </td>
                                            <td>
                                                Due Date:<input type="text" name="duedate" id="test2"
                                                                value="<?php echo date('d-m-Y'); ?>" class="round">
                                            </td>
                                            <td> Tax:<input type="text" name="tax" onkeypress="return numbersonly(event);"></td>
                                            <td>Tax Description:<input type="text" name="tax_dis"></td>


                                            <td> &nbsp;</td>
                                            <td> &nbsp;</td>
                                        </tr>
                                    </table>
                                    <table >
                                        <tr>
                                            <td>
                                                <input class="button round blue image-right ic-add text-upper" type="submit"
                                                       name="Submit" value="Add">
                                            </td>
                                            <td>
                                                <input class="button round red   text-upper" type="reset" name="Reset"
                                                       value="Reset"></td>
                                            <td> &nbsp;</td>
                                            <td> &nbsp;</td>
                                        </tr>
                                    </table>
                                    </div>
                                </form>


                            </div>
                            <!-- end content-module-main -->


                        </div>
                        <!-- end content-module -->


                    </div>

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

</body>
</html>
