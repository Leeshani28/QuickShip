<?php

include_once '../commons/session.php';
include_once '../model/order_model.php';
include_once '../model/driver_model.php';
include_once '../model/delivery_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/driver_model.php';
include_once '../model/customer_model.php';

//get user information from session
$driverrow = $_SESSION["driver"];

$orderObj = new Order();
$orderObj = new Customer();
$driverObj = new Driver();
$deliveryObj = new Delivery();
$warehouseObj = new Warehouse();
$driver_id = $driverrow["driver_id"];
$warehouseResult = $warehouseObj->getCompletedOfd($driver_id);
// $orderrow = $orderResult->fetch_assoc();


?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>
</head>

<body>

    <div class="container">


        <?php $pageName = "MY TASKS" ?>
        <?php include_once "../includes/driver_headerrow.php"; ?>




        <div class="row" style="margin-top:20px;margin-bottom:15px;">


        </div>

        <div class="row">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="driver_dashboard.php">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-primary" href="driver_completed_tasks.php">Completed Tasks</a>
                </li>

            </ul>
        </div>

        <div class="row">
            &nbsp
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body"
                        style="background: #ffffff;padding: 15px;padding-bottom: 5px;border-radius: 12px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">


                        <div class="col-md-12">
                            <?php
                            if (isset($_GET["msg"])) {
                                $msg = base64_decode($_GET["msg"]);



                                ?>
                                <div class="row" id="msg">
                                    <div class="alert alert-info">
                                        <?php echo $msg ?>

                                    </div>

                                </div>

                                <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-info table-striped" id="driverdeliverytable"
                                        style="text-align: left;">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="10%">Order ID</th>
                                                <th width="15%">Receiver Address</th>
                                                <th width="10%">Payment Type</th>
                                                <th width="8%">Amount(LKR)</th>
                                                <th width="10%">Proof of Delivery</th>
                                                <th width="8%">Status</th>
                                                <th width="34%">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($ofdrow = $warehouseResult->fetch_assoc()) {

                                                $ofd_id = $ofdrow["ofd_id"];
                                                $ofd_id = base64_encode($ofd_id);

                                                if ($ofdrow["ofd_status"] == "Pending") {
                                                    $color = "bg-warning";

                                                } elseif ($ofdrow["ofd_status"] == "Delivered") {
                                                    $color = "bg-success";

                                                } else {
                                                    $color = "bg-danger";
                                                }


                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php
                                                        echo $ofdrow["ofd_id"];

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $ofdrow["order_id"];

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $ofdrow["receiver_address"];

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $ofdrow["payment_type"];

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $ofdrow["amount"];

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php

                                                        echo $ofdrow["pod"] ? "Yes" : "No";

                                                        ?>
                                                    </td>

                                                    <td class="<?php echo $color; ?>">
                                                        <?php
                                                        echo $ofdrow["ofd_status"];

                                                        ?>
                                                    </td>

                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#myModal2"
                                                            class="btn btn-info"
                                                            onclick="loadorderdetails('<?php echo $ofdrow['order_id']; ?>');"><span
                                                                class="glyphicon glyphicon-search"></span>&nbsp;View</a>

                                                        &nbsp;
                                                        <?php
                                                        if ($ofdrow["ofd_status"] == "Pending") {


                                                            ?>
                                                            <a href="#" data-toggle="modal" data-target="#myModal"
                                                                class="btn btn-success"
                                                                onclick="deliveredorder('<?php echo $ofdrow['ofd_id']; ?>',
                                                                         '<?php echo $ofdrow['order_id']; ?>',
                                                                         '<?php echo $ofdrow['pod']; ?>',
                                                                         '<?php echo $ofdrow['payment_type']; ?>');"><span
                                                                    class="glyphicon glyphicon-ok"></span>&nbsp;Delivered</a>


                                                            &nbsp;
                                                            <a href="#" data-toggle="modal" data-target="#myModal1"
                                                                class="btn btn-danger" onclick="returnorder('<?php echo $ofdrow['ofd_id']; ?>',
                                                                    '<?php echo $ofdrow['order_id']; ?>');"><span
                                                                    class="glyphicon glyphicon-remove"></span>&nbsp;Return</a>

                                                            <?php
                                                        }
                                                        ?>

                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- view -->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">


        <div class="modal-content">
            <div id="display_data">

            </div>

        </div>

    </div>
</div>
<!-- confirm modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to delivered</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/driver_delivery_controller.php?status=deliverd_order" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="ofd_id" id="delivered_ofd_id">
                    <input type="hidden" name="order_id" id="delivered_order_id">
                    <input type="hidden" name="pod" id="pod">

                    <input type="hidden" name="payment_type" id="payment_type">



                    <div class="row">
                        <div class="col-md-12">
                            <div id="podMessage">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="paymentSection">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4 text-right">
                            <label class="control-label ">Delivery Proof</label>
                        </div>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="delivery_proof" id="delivery_proof"
                                accept=".jpg,.jpeg,.png,.gif,.webp" onchange="displayImage(this);" />
                            <br />
                            <img id="img_prev" style="" />
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12" style="text-align:right;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">

                                &nbsp;
                                Delivered
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<!-- cancel modal -->
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to return order <?php
                $id = base64_decode($ofd_id);
                echo $id; ?> ?</h4>
            </div>
            <form action="../controller/driver_delivery_controller.php?status=return_order" method="post">
                <div class="modal-body">

                    <input type="hidden" name="ofd_id" id="return_ofd_id">
                    <input type="hidden" name="order_id" id="return_order_id">

                    <div>
                        &nbsp;
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align:right;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>




<script src="../js/datatable/jquery-3.5.1.js"></script>
<script src="../js/datatable/dataTables.bootstrap.min.js"></script>
<script src="../js/datatable/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/datatable/datatables.js"></script>

<script>
    $(document).ready(function () {
        $("#driverdeliverytable").DataTable();

    });


</script>

<script>
    function loadorderdetails(order_id) {

        var url = "../controller/driver_delivery_controller.php?status=driver_order_details";

        $.post(url, { order_id: order_id }, function (data) {
            $("#display_data").html(data).show();
        });

    }

</script>

<script>
    function deliveredorder(ofd_id, order_id, pod, payment_type) {

        document.getElementById("delivered_ofd_id").value = ofd_id;
        document.getElementById("delivered_order_id").value = order_id;
        document.getElementById("pod").value = pod;
        document.getElementById("payment_type").value = payment_type;

        // $("#payment_type").val(payment_type);
        // $("#payment_status").val(payment_status);


        if (pod == 1) {
            document.getElementById("podMessage").innerHTML =
                '<div class="alert alert-warning">' +
                '<strong>Notice!</strong> Proof of Delivery is required.' +
                '</div>';
        } else {
            document.getElementById("podMessage").innerHTML = '';
        }


        if (payment_type == "COD") {

            document.getElementById("paymentSection").innerHTML =
                '<div class="alert alert-warning">' +
                '<strong>Payment Type :</strong> Cash on Delivery (COD)<br><br>' +

                '<label>' +
                '<input type="checkbox" name="payment_status" value="Paid"> ' +
                'Receiver has paid' +
                '</label>' +
                '</div>';

        } else {

            document.getElementById("paymentSection").innerHTML =
                '<div class="alert alert-success">' +
                '<strong>Payment Type :</strong> Prepaid' +
                '</div>';

        }

    }



</script>

<script>
    function returnorder(ofd_id, order_id) {

        document.getElementById("return_ofd_id").value = ofd_id;
        document.getElementById("return_order_id").value = order_id;


    }

</script>

<script>
    function displayImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#img_prev").attr('src', e.target.result).width(80).height(60);

            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    const msg = document.getElementById('msg');

    const delayTime = 3000;

    setTimeout(() => {
        msg.style.display = 'none';
    }, delayTime);
</script>

</html>