<?php
include_once("init.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Salon | Update Purchase</title>
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
    <script src="lib/auto/js/jquery.autocomplete.js "></script>
    <script src="js/script.js"></script>
    <script>
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {

            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    bill_no: {
                        required: true,
                        minlength: 3

                    },
                    stockid: {
                        required: true
                    },
                    grand_total: {
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
                    bill_no: {
                        required: "Please Enter Bill Number",
                        minlength: "Bill Number must consist of at least 3 characters"
                    }
                }
            });

        });
        $(function () {
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

        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 38 && unicode != 39 && unicode != 40) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57)
                    return false
            }
        }
        function edit_stock_details(id) {
            document.getElementById('display').style.display = "block";

            document.getElementById('item').value = document.getElementById(id + 'st').value;
            document.getElementById('quty').value = document.getElementById(id + 'q').value;
            document.getElementById('cost').value = document.getElementById(id + 'c').value;
            document.getElementById('sell').value = document.getElementById(id + 's').value;
            document.getElementById('stock').value = document.getElementById(id + 'p').value;
            document.getElementById('total').value = document.getElementById(id + 'to').value;
            document.getElementById('posnic_total').value = document.getElementById(id + 'to').value;

            document.getElementById('guid').value = id;
            document.getElementById('edit_guid').value = id;

        }
        function clear_data() {
            document.getElementById('display').style.display = "none";

            document.getElementById('item').value = "";
            document.getElementById('quty').value = "";
            document.getElementById('cost').value = "";
            document.getElementById('sell').value = "";
            document.getElementById('stock').value = "";
            document.getElementById('total').value = "";
            document.getElementById('posnic_total').value = "";

            document.getElementById('guid').value = "";
            document.getElementById('edit_guid').value = "";

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
                        document.getElementById('main_grand_total').value = '$ ' + parseFloat(document.getElementById('grand_total').value).toFixed(2);
                        document.getElementById(item + 'st').value = code;
                        document.getElementById(item + 'to').value = total;

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
                    data1 = parseFloat(document.getElementById('grand_total').value) + parseFloat(document.getElementById('posnic_total').value) - parseFloat(document.getElementById(id + 'my_tot').value);
                    document.getElementById('main_grand_total').value = data1;
                    document.getElementById('grand_total').value = data1;
                    document.getElementById(id + 'to').value = document.getElementById('total').value;
                    // document.getElementById('grand_total').value=parseFloat(document.getElementById('grand_total').value)+parseFloat(document.getElementById('total').value);
//alert(data1);
//alert(parseFloat(document.getElementById(id+'my_tot').value));
//alert(parseFloat(document.getElementById('posnic_total').value));
                    balance_amount();

                    document.getElementById(id + 'my_tot').value = document.getElementById('posnic_total').value
                    document.getElementById('quty').value = "";
                    document.getElementById('cost').value = "";
                    document.getElementById('sell').value = "";
                    document.getElementById('stock').value = "";
                    document.getElementById('total').value = "";
                    document.getElementById('item').value = "";
                    document.getElementById('guid').value = "";
                    document.getElementById('edit_guid').value = "";
                }
                document.getElementById('display').style.display = "none";

            }
        }
        function unique_check() {
            if (!document.getElementById(document.getElementById('guid').value) || document.getElementById('edit_guid').value == document.getElementById('guid').value) {
                return true;

            } else {

                alert("This Item is already added In This Purchase");
                document.getElementById('item').focus();
                id = document.getElementById('edit_guid').value;

                document.getElementById('item').focus();
                document.getElementById('item').value = document.getElementById(id + 'st').value;
                document.getElementById('quty').value = document.getElementById(id + 'q').value;
                document.getElementById('cost').value = document.getElementById(id + 'c').value;
                document.getElementById('sell').value = document.getElementById(id + 's').value;
                document.getElementById('stock').value = document.getElementById(id + 'p').value;
                document.getElementById('total').value = document.getElementById(id + 'to').value;
                document.getElementById('guid').value = id;
                document.getElementById('edit_guid').value = id;
                return false;


            }
        }
        function total_amount() {


            document.getElementById('total').value = document.getElementById('cost').value * document.getElementById('quty').value
            document.getElementById('posnic_total').value = document.getElementById('total').value;
            // document.getElementById('total').value = '$ ' + parseFloat(document.getElementById('total').value).toFixed(2);
            balance_amount();
        }
        function balance_amount() {
            if (document.getElementById('grand_total').value != "" && document.getElementById('payment').value != "") {
                data = parseFloat(document.getElementById('grand_total').value);
                document.getElementById('balance').value = data - parseFloat(document.getElementById('payment').value);
                console.log();
                if (parseFloat(document.getElementById('grand_total').value) >= parseFloat(document.getElementById('payment').value)) {

                    document.getElementById('balance').value = parseFloat(document.getElementById('grand_total').value) - parseFloat(document.getElementById('payment').value);
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

        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
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
                Update Purchase
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
                        if (isset($_POST['supplier']) and isset($_POST['stock_name'])) {
                            $billnumber = mysqli_real_escape_string($db->connection, $_POST['bill_no']);
                            $autoid = mysqli_real_escape_string($db->connection, $_POST['id']);

                            $supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);

                            $payment = mysqli_real_escape_string($db->connection, $_POST['payment']);
                            $balance = mysqli_real_escape_string($db->connection, $_POST['balance']);
                            $address = mysqli_real_escape_string($db->connection, $_POST['address']);
                            $contact = mysqli_real_escape_string($db->connection, $_POST['contact']);
                            $count = $db->countOf("supplier_details", "supplier_name='$supplier'");
                            if ($count == 0) {
                                $db->query("insert into supplier_details(supplier_name,supplier_address,supplier_contact1) values('$supplier','$address','$contact')");
                            }
                            $temp_balance = $db->queryUniqueValue("SELECT balance FROM supplier_details WHERE supplier_name='$supplier'");
                            $temp_balance = (int)$temp_balance + (int)$balance;
                            $db->execute("UPDATE supplier_details SET balance='$temp_balance' WHERE supplier_name='$supplier'");
                            $selected_date = $_POST['due'];
                            $selected_date = strtotime($selected_date);
                            $mysqldate = date('Y-m-d H:i:s', $selected_date);
                            $due = $mysqldate;
                            $mode = mysqli_real_escape_string($db->connection, $_POST['mode']);
                            $description = mysqli_real_escape_string($db->connection, $_POST['description']);

                            $namet = $_POST['stock_name'];
                            $quantityt = isset($_POST['quanitity']) ? $_POST['quanitity'] : '';
                            $bratet = $_POST['cost'];
                            $sratet = $_POST['sell'];
                            $totalt = $_POST['total'];

                            $subtotal = mysqli_real_escape_string($db->connection, $_POST['subtotal']);

                            $username = $_SESSION['username'];

                            $i = 0;
                            $j = 1;


                            $selected_date = $_POST['date'];
                            $selected_date = strtotime($selected_date);
                            $mysqldate = date('Y-m-d H:i:s', $selected_date);

                            foreach ($namet as $name1) {

                                $quantity = $_POST['quantity'][$i];
                                $brate = $_POST['cost'][$i];
                                $srate = $_POST['sell'][$i];
                                $total = $_POST['total'][$i];
                                $sysid = $_POST['gu_id'][$i];


                                $count = $db->countOf("stock_avail", "name='$name1'");

                                $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
                                $oldquantity = $db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE id='$sysid' ");
                                $amount1 = ($amount + $quantity) - $oldquantity;


                                $db->execute("UPDATE stock_avail SET quantity='$amount1' WHERE name='$name1'");
                                $db->query("UPDATE stock_entries SET stock_name='$name1', stock_supplier_name='$supplier', quantity='$quantity', company_price='$brate', selling_price='$srate', opening_stock='$amount', closing_stock='$amount1', date='$mysqldate', username='$username', type='entry', total='$total', payment='$payment', balance='$balance', mode='$mode', description='$description', due='$due', subtotal='$subtotal',billnumber='$billnumber' WHERE id='$sysid'");
                                //INSERT INTO `stock`.`stock_entries` (`id`, `stock_id`, `stock_name`, `stock_supplier_name`, `category`, `quantity`, `company_price`, `selling_price`, `opening_stock`, `closing_stock`, `date`, `username`, `type`, `salesid`, `total`, `payment`, `balance`, `mode`, `description`, `due`, `subtotal`, `count1`)
                                //VALUES (NULL, '$autoid1', '$name1', '$supplier', '', '$quantity', '$brate', '$srate', '$amount', '$amount1', '$mysqldate', 'sdd', 'entry', 'Sa45', '432.90', '2342.90', '24.34', 'cash', 'sdflj', '2010-03-25 12:32:02', '45645', '1');


                                $i++;
                                $j++;
                            }
                            echo "<br><font color=green size=+1 >Parchase order Updated successfully Ref: [ $autoid] !</font>";


                        }
                        ?>
                        <?php
                        if (isset($_GET['sid']))
                            $id = $_GET['sid'];
                        $line = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE stock_id='$id'");
                        ?>
                        <form name="form1" method="post" id="form1" action="">
                            <input type="hidden" id="posnic_total">
                            <input type="hidden" name="id" value="<?php echo $id ?>">

                            <table class="table" border="0" cellspacing="10" cellpadding="10">
                                <tr>
                                    <?php
                                    $max = $db->maxOfAll("id", "stock_sales");
                                    $max = $max + 1;
                                    $autoid = "PR" . $max . "";
                                    ?>
                                    <td>Stock ID:</td>
                                    <td><input name="stockid" type="text" id="stockid" readonly="readonly" maxlength="200"
                                               class="round default-width-input" style="width:130px "
                                               value="<?php echo $line->stock_id; ?>"/></td>

                                    <td>Date:</td>
                                    <td><input name="date" id="test1" placeholder="" value="<?php echo $line->date; ?> "
                                               type="text" id="name" maxlength="200" class="round default-width-input"/>
                                    </td>
                                    <td><span class="man">*</span>Bill No:</td>
                                    <td><input name="bill_no" placeholder="ENTER BILL NO" type="text" id="bill_no"
                                               maxlength="200" value="<?php echo $line->billnumber; ?> "
                                               class="round default-width-input" style="width:120px "/></td>

                                </tr>
                                <tr>
                                    <td><span class="man">*</span>Supplier:</td>
                                    <td><input name="supplier" placeholder="ENTER SUPPLIER" type="text" id="supplier"
                                               value="<?php echo $line->stock_supplier_name; ?> " maxlength="200"
                                               class="round default-width-input" style="width:130px "/></td>

                                    <td>Address:</td>
                                    <td><input name="address" placeholder="ENTER ADDRESS" type="text"
                                               value="<?php $quantity = $db->queryUniqueValue("SELECT supplier_address FROM supplier_details WHERE supplier_name='" . $line->stock_supplier_name . "'");
                                               echo $quantity; ?>" id="address" maxlength="200"
                                               class="round default-width-input"/></td>

                                    <td>contact:</td>
                                    <td><input name="contact" placeholder="ENTER CONTACT" type="text"
                                               value="<?php $quantity = $db->queryUniqueValue("SELECT supplier_contact1 FROM supplier_details WHERE supplier_name='" . $line->stock_supplier_name . "'");
                                               echo $quantity; ?>" id="contact1" maxlength="200"
                                               class="round default-width-input" onkeypress="return numbersonly(event)"
                                               style="width:120px "/></td>

                                </tr>
                            </table>
                            <input type="hidden" id="guid">
                            <input type="hidden" id="edit_guid">
                            <table id="hideen_display" class="table">
                                <tr>
                                    <td>Item:</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td>Quantity:</td>
                                    <td>Cost:</td>
                                    <td>Selling:</td>
                                    <td>Available Stock:</td>
                                    <td>Total</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                </tr>
                            </table>
                            <table class="table" id="display" style="display:none">
                                <tr>

                                    <td><input name="" type="text" id="item" maxlength="200" class="round my_with "
                                               style="width: 150px"
                                               value="<?php echo isset($supplier) ? $supplier : ''; ?>"/></td>

                                    <td><input name="" type="text" id="quty" maxlength="200" class="round  my_with"
                                               onKeyPress="quantity_chnage(event);return numbersonly(event)"
                                               onkeyup="total_amount();unique_check()"
                                               value="<?php echo isset($category) ? $category : ''; ?>"/></td>

                                    <td><input name="" type="text" id="cost" readonly="readonly" maxlength="200"
                                               class="round my_with"
                                               value="<?php echo isset($category) ? $category : ''; ?>"/></td>


                                    <td><input name="" type="text" id="sell" readonly="readonly" maxlength="200"
                                               class="round  my_with"
                                               value="<?php echo isset($category) ? $category : ''; ?>"/></td>


                                    <td><input name="" type="text" id="stock" readonly="readonly" maxlength="200"
                                               class="round  my_with"
                                               value="<?php echo isset($category) ? $category : ''; ?>"/></td>
                                    <td><input name="" type="text" id="total" maxlength="200"
                                               class="round default-width-input " style="width:120px;  margin-left: 20px"
                                               value="<?php echo isset($category) ? $category : ''; ?>"/></td>
                                    <td><input type="button" onclick="add_values()" onkeyup=" balance_amount();"
                                               id="add_new_code"
                                               style="margin-left:20px; width:30px;height:30px;border:none;background:url(images/save.png)"
                                               class="round">
                                    </td>
                                    <td><input type="button" value="" id="cancel" onclick="clear_data()"
                                               style="width:30px;float: right; border:none;height:30px;background:url(images/close_new.png)">
                                    </td>

                                </tr>
                            </table>
                            <input type="hidden" id="guid">
                            <input type="hidden" id="edit_guid">


                            <div style="overflow:auto ;max-height:300px;  ">
                                <table class="table" id="item_copy_final">

                                    <?php
                                    $sid = $line->stock_id;
                                    $max = $db->maxOf("count1", "stock_entries", "stock_id='$sid'");

                                    for ($i = 1; $i <= $max; $i++) {
                                        $line1 = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE stock_id='$sid' and count1=$i");

                                        $item = $db->queryUniqueValue("SELECT stock_id FROM stock_details WHERE stock_name='" . $line1->stock_name . "'");
                                        ?>

                                        <tr>

                                            <td><input name="stock_name[]" type="text" id="<?php echo $item . "st" ?>"
                                                       maxlength="20" style="width: 150px" readonly="readonly"
                                                       class="round "
                                                       value="<?php echo $line1->stock_name; ?>"/></td>

                                            <td><input name="quantity[]" type="text" id="<?php echo $item . "q" ?>"
                                                       maxlength="20" class="round my_with"
                                                       value="<?php echo $line1->quantity; ?>" readonly="readonly"
                                                       onkeypress="return numbersonly(event)"/></td>


                                            <td><input name="cost[]" type="text" id="<?php echo $item . "c" ?>"
                                                       maxlength="20" class="round my_with"
                                                       value="<?php echo $line1->company_price; ?>" readonly="readonly"
                                                       onkeypress="return numbersonly(event)"/></td>


                                            <td><input name="sell[]" type="text" id="<?php echo $item . "s" ?>"
                                                       maxlength="20" readonly="readonly" class="round my_with"
                                                       value="<?php echo $line1->selling_price; ?>"
                                                       onkeypress="return numbersonly(event)"/></td>
                                            <td><input name="stock[]" type="text" id="<?php echo $item . "p" ?>"
                                                       readonly="readonly" maxlength="200" class="round  my_with"
                                                       value="<?php $quantity = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='" . $line1->stock_name . "'");
                                                       echo $quantity; ?>"/></td>

                                            <td><input name="total[]" type="text" id="<?php echo $item . "to" ?>"
                                                       readonly="readonly" maxlength="20"
                                                       style="margin-left:20px;width: 120px" class="round "
                                                       value="<?php echo $line1->total; ?>"/></td>
                                            <td><input type="hidden" id="<?php echo $item . "my_tot" ?>" maxlength="20"
                                                       style="margin-left:20px;width: 120px" class="round "
                                                       value="<?php echo $line1->total; ?>"/></td>
                                            <td><input type="hidden" id="<?php echo $item; ?>"><input type="hidden"
                                                                                                      name="gu_id[]"
                                                                                                      value="<?php echo $line1->id ?>">
                                            </td>
                                            <td><input type=button value="" id="<?php echo $item; ?>"
                                                       style="width:30px;border:none;height:30px;background:url(images/edit_new.png)"
                                                       class="round" onclick="edit_stock_details(this.id)"></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>


                            <table class="table">
                                <tr>
                                    <td> &nbsp;</td>
                                    <td>Payment:<input type="text" class="round" value="<?php echo $line->payment; ?>"
                                                       onkeyup=" balance_amount(); return numbersonly(event);"
                                                       name="payment" id="payment">
                                    </td>
                                    <td> &nbsp;</td>
                                    <td>Balance:<input type="text" class="round" value="<?php echo $line->balance; ?>"
                                                       id="balance" name="balance">
                                    </td>
                                    <td> &nbsp;</td>

                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td>Grand Total:<input type="hidden" readonly="readonly" id="grand_total"
                                                           value="<?php echo $line->subtotal; ?>" name="subtotal">
                                        <input type="text" id="main_grand_total" class="round default-width-input"
                                               value="<?php echo $line->subtotal; ?>" style="text-align:right;width: 120px">
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <td>Mode &nbsp;</td>
                                    <td>
                                        <select name="mode">
                                            <option value="cheque">Cheque</option>
                                            <option value="cheque">Cash</option>
                                            <option value="cheque">Other</option>
                                        </select>
                                    </td>
                                    <td>
                                        Due Date:<input type="text" name="due" id="test2"
                                                        value="<?php echo date('d-m-Y'); ?>" class="round">
                                    </td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>

                                    <td>Description</td>
                                    <td><textarea name="description"><?php echo $line->description; ?></textarea></td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                </tr>
                            </table>
                            <table class="form">
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
