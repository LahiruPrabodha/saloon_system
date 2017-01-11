<?php
include_once("init.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Salon | Add Purchase</title>
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

    <script type="text/javascript">
        $(function () {
            document.getElementById('bill_no').focus();
            $("#supplier").autocomplete("supplier1.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            $("#item").autocomplete("stock_purchse.php", {
                width: 160,
                autoFill: true,
                mustMatch: true,
                selectFirst: true
            });
            $("#item").blur(function () {
                document.getElementById('total').value = document.getElementById('cost').value * document.getElementById('quty').value
            });
            $("#item").blur(function () {


                $.post('check_item_details.php', {stock_name1: $(this).val()},
                    function (data) {
                        $("#cost").val(data.cost);
                        $("#sell").val(data.sell);
                        $("#stock").val(data.stock);
                        $('#guid').val(data.guid);
                        if (data.cost != undefined)
                            $("#0").focus();


                    }, 'json');


            });
            $("#quty").blur(function () {
                if (document.getElementById('item').value == "") {
                    document.getElementById('item').focus();
                }
            });
            $("#supplier").blur(function () {


                $.post('check_supplier_details.php', {stock_name1: $(this).val()},
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
            if (document.getElementById('item') === "") {
                document.getElementById('item').focus();
            }
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
                    payment: {
                        required: true
                    },
                    supplier: {
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
                    grand_total: {
                        required: "Add Stock Items"
                    },
                    payment: {
                        required: "Enter Payment"
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
                    if (document.getElementById('item').value != "" && document.getElementById('quty').value != "" && document.getElementById('cost').value != "" && document.getElementById('total').value != "") {
                        code = document.getElementById('item').value;

                        quty = document.getElementById('quty').value;
                        cost = document.getElementById('cost').value;
                        sell = document.getElementById('sell').value;
                        disc = document.getElementById('stock').value;
                        total = document.getElementById('total').value;
                        item = document.getElementById('guid').value;
                        main_total = document.getElementById('posnic_total').value;

                        $('<tr id=' + item + '><td><input type=hidden value=' + item + ' id=' + item + 'id ><input type=text name="stock_name[]"  id=' + item + 'st style="width: 150px" class="round  my_with" ></td><td><input type=text name=quty[] readonly="readonly" value=' + quty + ' id=' + item + 'q class="round  my_with" style="text-align:right;" ></td><td><input type=text name=cost[] readonly="readonly" value=' + cost + ' id=' + item + 'c class="round  my_with" style="text-align:right;"></td><td><input type=text name=sell[] readonly="readonly" value=' + sell + ' id=' + item + 's class="round  my_with" style="text-align:right;"  ></td><td><input type=text name=stock[] readonly="readonly" value=' + disc + ' id=' + item + 'p class="round  my_with" style="text-align:right;" ></td><td><input type=text name=jibi[] readonly="readonly" value=' + total + ' id=' + item + 'to class="round  my_with" style="width: 120px;margin-left:20px;text-align:right;" ><input type=hidden name=total[] id=' + item + 'my_tot value=' + main_total + '> </td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/edit_new.png)" class="round" onclick="edit_stock_details(this.id)"  ></td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/close_new.png)" class="round" onclick= $(this).closest("tr").remove() ></td></tr>').fadeIn("slow").appendTo('#item_copy_final');
                        document.getElementById('quty').value = "";
                        document.getElementById('cost').value = "";
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
                        document.getElementById('item').focus();

                    } else {
                        alert('Please Select An Item');
                    }
                } else {
                    id = document.getElementById('edit_guid').value;
                    document.getElementById(id + 'st').value = document.getElementById('item').value;
                    document.getElementById(id + 'q').value = document.getElementById('quty').value;
                    document.getElementById(id + 'c').value = document.getElementById('cost').value;
                    document.getElementById(id + 's').value = document.getElementById('sell').value;
                    document.getElementById(id + 'p').value = document.getElementById('stock').value;
                    document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) + parseFloat(document.getElementById('posnic_total').value) - parseFloat(document.getElementById(id + 'my_tot').value);
                    document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
                    document.getElementById(id + 'to').value = document.getElementById('total').value;
                    document.getElementById(id + 'id').value = id;

                    document.getElementById(id + 'my_tot').value = document.getElementById('posnic_total').value
                    document.getElementById('quty').value = "";
                    document.getElementById('cost').value = "";
                    document.getElementById('sell').value = "";
                    document.getElementById('stock').value = "";
                    document.getElementById('total').value = "";
                    document.getElementById('item').value = "";
                    document.getElementById('guid').value = "";
                    document.getElementById('edit_guid').value = "";
                    document.getElementById('item').focus();
                }
            }

        }
        function total_amount() {
            balance_amount();

            document.getElementById('total').value = document.getElementById('cost').value * document.getElementById('quty').value
            document.getElementById('posnic_total').value = document.getElementById('total').value;
            document.getElementById('total').value = parseFloat(document.getElementById('total').value);
            if (document.getElementById('item').value === "") {
                document.getElementById('item').focus();
            }
        }
        function edit_stock_details(id) {
            document.getElementById('item').value = document.getElementById(id + 'st').value;
            document.getElementById('quty').value = document.getElementById(id + 'q').value;
            document.getElementById('cost').value = document.getElementById(id + 'c').value;
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
                document.getElementById('cost').value = "";
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
            if (document.getElementById('item').value == "") {
                document.getElementById('item').focus();
            }

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
            if (document.getElementById('grand_total').value != "" && document.getElementById('payment').value != "") {
                data = parseFloat(document.getElementById('grand_total').value);
                document.getElementById('balance').value = data - parseFloat(document.getElementById('payment').value);
                if (parseFloat(document.getElementById('grand_total').value) >= parseFloat(document.getElementById('payment').value)) {

                } else {
                    if (document.getElementById('grand_total').value != "") {
                        document.getElementById('balance').value = '000.00';
                        document.getElementById('payment').value = parseFloat(document.getElementById('grand_total').value);
                    } else {
                        document.getElementById('balance').value = '000.00';
                        document.getElementById('payment').value = "";
                    }
                }
            } else {
                document.getElementById('balance').value = "";
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
                Add Purchase
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Purchase</li>
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
                        if (isset($_GET['msg'])) {
                            echo $_GET['msg'];
                        }
                        if (isset($_POST['supplier']) and isset($_POST['stock_name'])) {
                            $_POST = $gump->sanitize($_POST);
                            $gump->validation_rules(array(
                                'supplier' => 'required|max_len,100|min_len,3'


                            ));

                            $gump->filter_rules(array(
                                'supplier' => 'trim|sanitize_string|mysqli_escape'


                            ));

                            $validated_data = $gump->run($_POST);
                            $supplier = "";
                            $stockid = "";
                            $stock_name = "";
                            $cost = "";
                            $bill_no = "";


                            if ($validated_data === false) {
                                echo $gump->get_readable_errors(true);
                            } else {
                                $username = $_SESSION['username'];

                                $stockid = mysqli_real_escape_string($db->connection, $_POST['stockid']);

                                $bill_no = mysqli_real_escape_string($db->connection, $_POST['bill_no']);
                                $supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                                $address = mysqli_real_escape_string($db->connection, $_POST['address']);
                                $contact = mysqli_real_escape_string($db->connection, $_POST['contact']);
                                $stock_name = $_POST['stock_name'];

                                $count = $db->countOf("supplier_details", "supplier_name='$supplier'");
                                if ($count == 0) {
                                    $db->query("insert into supplier_details(supplier_name,supplier_address,supplier_contact1) values('$supplier','$address','$contact')");
                                }
                                $quty = $_POST['quty'];
                                $date = date("d M Y h:i A");
                                $sell = $_POST['sell'];
                                $cost = $_POST['cost'];
                                $total = $_POST['total'];
                                $subtotal = $_POST['subtotal'];
                                $description = mysqli_real_escape_string($db->connection, $_POST['description']);
                                $due = mysqli_real_escape_string($db->connection, $_POST['duedate']);
                                $payment = mysqli_real_escape_string($db->connection, $_POST['payment']);
                                $balance = mysqli_real_escape_string($db->connection, $_POST['balance']);
                                $mode = mysqli_real_escape_string($db->connection, $_POST['mode']);

                                $autoid = $_POST['stockid'];
                                $autoid1 = $autoid;
                                $selected_date = $_POST['date'];
                                $selected_date = strtotime($selected_date);
                                $date = date('Y-m-d H:i:s', $selected_date);
                                for ($i = 0; $i < count($stock_name); $i++) {
                                    $count = $db->countOf("stock_avail", "name='$stock_name[$i]'");
                                    if ($count == 0) {
                                        $db->query("insert into stock_avail(name,quantity) values('$stock_name[$i]',$quty[$i])");
                                        echo "<br><font color=green size=+1 >New Stock Entry Inserted !</font>";

                                        $db->query("insert into stock_details(stock_id,stock_name,stock_quatity,supplier_id,company_price,selling_price) values('$autoid','$stock_name[$i]',0,'$supplier','$cost[$i]','$sell[$i]')");


                                        $db->query("INSERT INTO stock_entries(stock_id,stock_name, stock_supplier_name, quantity, company_price, selling_price, opening_stock, closing_stock, date, username, type, total, payment, balance, mode, description, due, subtotal,count1,billnumber) VALUES ( '$autoid1','$stock_name[$i]','$supplier','$quty[$i]','$cost[$i]','$sell[$i]',0,'$quty[$i]','$date','$username','entry','$total[$i]','$payment','$balance','$mode','$description','$due','$subtotal',$i+1,'$bill_no')");

                                    } else if ($count == 1) {

                                        $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$stock_name[$i]'");
                                        $amount1 = $amount + $quty[$i];
                                        $db->execute("UPDATE stock_avail SET quantity='$amount1' WHERE name='$stock_name[$i]'");
                                        $db->query("INSERT INTO stock_entries(stock_id,stock_name,stock_supplier_name,quantity,company_price,selling_price,opening_stock,closing_stock,date,username,type,total,payment,balance,mode,description,due,subtotal,count1,billnumber) VALUES ('$autoid1','$stock_name[$i]','$supplier','$quty[$i]','$cost[$i]','$sell[$i]','$amount','$amount1','$date','$username','entry','$total[$i]','$payment','$balance','$mode','$description','$due','$subtotal',$i+1,'$bill_no')");
                                        //INSERT INTO `stock`.`stock_entries` (`id`, `stock_id`, `stock_name`, `stock_supplier_name`, `category`, `quantity`, `company_price`, `selling_price`, `opening_stock`, `closing_stock`, `date`, `username`, `type`, `salesid`, `total`, `payment`, `balance`, `mode`, `description`, `due`, `subtotal`, `count1`)
                                        //VALUES (NULL, '$autoid1', '$stock_name[$i]', '$supplier', '', '$quantity', '$brate', '$srate', '$amount', '$amount1', '$mysqldate', 'sdd', 'entry', 'Sa45', '432.90', '2342.90', '24.34', 'cash', 'sdflj', '2010-03-25 12:32:02', '45645', '1');


                                    }
                                }
                                $msg = "<br><font color=green size=6px >Parchase order Added successfully Ref: [" . $_POST['stockid'] . "] !</font>";
                                echo "<script>window.location = 'add_purchase.php?msg=$msg';</script>";
                            }

                        }

                        ?>

                        <form name="form1" method="post" id="form1" action="">
                            <input type="hidden" id="posnic_total">


                            <table class="table" border="0" cellspacing="10" cellpadding="10" >
                                <tr>
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
                                <tr>
                                    <td><span class="man">*</span>Supplier:</td>
                                    <td><input name="supplier" placeholder="ENTER SUPPLIER" type="text" id="supplier"
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
                            <table class="table">
                                <tr>
                                    <td>Item:</td>
                                    <td>Quantity:</td>
                                    <td>Cost:</td>
                                    <td>Selling:</td>
                                    <td>Available Stock:</td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total</td>
                                    <td> &nbsp;</td>
                                </tr>
                                <tr>

                                    <td><input name="" type="text" id="item" maxlength="200"
                                               class="round default-width-input " style="width: 150px"/></td>

                                    <td><input name="" type="text" id="quty" maxlength="200"
                                               class="round default-width-input my_with"
                                               onKeyPress="quantity_chnage(event);return numbersonly(event);"
                                               onkeyup="total_amount();unique_check()"/></td>

                                    <td><input name="" type="text" id="cost" readonly="readonly" maxlength="200"
                                               class="round default-width-input my_with"/></td>


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
                                <table class="form" id="item_copy_final">

                                </table>
                            </div>


                            <table class="table">
                                <tr>
                                    <td> &nbsp;</td>
                                    <td>Payment:<input type="text" class="round" onkeyup=" balance_amount(); "
                                                       onkeypress="return numbersonly(event);" name="payment" id="payment">
                                    </td>
                                    <td> &nbsp;</td>
                                    <td>Balance:<input type="text" class="round" id="balance" readonly="readonly"
                                                       name="balance">
                                    </td>
                                    <td> &nbsp;</td>

                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td>Grand Total:<input type="hidden" readonly="readonly" id="grand_total"
                                                           name="subtotal">
                                        <input type="text" id="main_grand_total" class="round default-width-input"
                                               onkeypress="return numbersonly(event)" readonly="readonly"
                                               style="text-align:right;width: 120px">
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <td>Mode &nbsp;</td>
                                    <td>
                                        <select name="mode">
                                            <option value="cash">Cash</option>
                                            <option value="cash">Cash</option>
                                            <option value="cheque">Cheque</option>

                                            <option value="other">Other</option>
                                        </select>
                                    </td>
                                    <td>
                                        Due Date:<input type="text" name="duedate" id="test2"
                                                        value="<?php echo date('d-m-Y'); ?>" class="round">
                                    </td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>

                                    <td>Description</td>
                                    <td><textarea name="description"></textarea></td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                </tr>
                            </table>
                            <table class="table">
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
