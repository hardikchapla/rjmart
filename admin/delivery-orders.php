<?php
include('../connection/connection.php');
include('../helper/core_function.php');
include('../helper/constant.php');
$currentPage = 'user-Details';
$order_id = $_REQUEST['id'];
$order = $db->query("SELECT * FROM product_order WHERE id = '$order_id'");
$feorder = $order->fetch();

if($feorder['order_status'] == 0){
    $order_status = 'Pending';
} elseif ($feorder['order_status'] == 1){
    $order_status = 'Confirmed';
} elseif ($feorder['order_status'] == 2){
    $order_status = 'Shipped';
} else {
    $order_status = 'Cancel';
}


$user_address_id = $feorder['user_address_id'];
$user_address = $db->query("SELECT * FROM user_address WHERE id = '$user_address_id'");
$feaddress = $user_address->fetch();

//$order_items = $db->query("SELECT a.*,b.*,c.* FROM order_items a, product b, product_type c WHERE a.product_id = b.id AND a.product_type_id = c.product_type_id AND a.order_id = '$order_id'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?= APP_NAME ?></title>
    <link rel="icon" type="image/x-icon" href="<?= FAVICON ?>" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
</head>

<body>
    <!--  BEGIN NAVBAR  -->
    <?php include('header.php'); ?>
    <!--  END NAVBAR  -->
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <!--  BEGIN SIDEBAR  -->
        <?php include('sidebar.php'); ?>
        <!--  END SIDEBAR  -->
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <h4>Order Details : <?= $feorder['order_number'] ?></h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Payment Status :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $order_status ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Order Amount :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feorder['total_amount'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Payment Type :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feorder['payment_type'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Delivery Date. :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= ($feorder['order_date'] == '0000-00-00 00:00:00') ? '':date('d, M Y H:i a',strtotime($feorder['order_date'])) ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <h4>Delivery Address : </h4>
                            <hr>
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Full name :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['full_name'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Mobile Number :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['mobile_number'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Alt. Mobile Number :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['alt_mobile_number'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>House No. :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['house_no'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Building name. :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['building_name'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Road/Area/Colony :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['road_area_colony'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Main Area :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['main_area'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Landmark :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['landmark'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>City :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['city'] ?></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>State :</strong></p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><?= $feaddress['state'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <h4>Order Items : </h4>
                            <hr>
                            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                <div class="table-responsive mb-4 mt-4">
                                    <table id="display_order" class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Photo</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Offer</th>
                                                <th>Product Type</th>
                                                <th>Product Qty</th>
                                                <th>Product Price</th>
                                                <th>Order Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php include('footer.php'); ?>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <!-- Start Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">
                        <span id="plan_details"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                        Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
    $(document).ready(function() {
        App.init();
    });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="plugins/apex/apexcharts.min.js"></script>
    <script src="assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/sweetalerts/custom-sweetalert.js"></script>
    <script>
    $('#zero-config').DataTable({
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7
    });
    </script>
    <script type="text/javascript">
    var order_id = '<?= $order_id ?>';
    $(document).ready(function() {
        var dataTable1 = $('#display_order').DataTable({
            "ajax": {
                url: "code/display_order_details",
                type: "POST",
                data: {
                    'order_id': order_id
                },
            }
        });
    });
    </script>
    <script type="text/javascript">
    $(document).on('click', '.view_plan_details', function() {
        var id = $(this).attr("id");
        $.ajax({
            url: "code/view_product_details",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $('#plan_details').html(data.plan_details);
            }
        })
    });
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->

</body>

</html>