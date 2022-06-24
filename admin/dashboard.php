<?php
    include('../connection/connection.php');
    include('../helper/core_function.php');
    include('../helper/constant.php');
    $currentPage = 'dashboard';

    $user = $db->query("SELECT * FROM  `user` WHERE user_type = 0");
    $total_user = $user->rowCount();

    $delivery_boy = $db->query("SELECT * FROM  `user` WHERE user_type = 1");
    $total_del_boy = $delivery_boy->rowCount();

    $act_del_boy = $db->query("SELECT * FROM `user` WHERE user_type = 1 AND status = 1");
    $total_act_del_boy = $act_del_boy->rowCount();

    $deact_del_boy = $db->query("SELECT * FROM `user` WHERE user_type = 1 AND status = 0");
    $total_deact_del_boy = $deact_del_boy->rowCount();

    $cat = $db->query("SELECT * FROM category");
    $category = $cat->rowCount();

    $prod = $db->query("SELECT * FROM product");
    $product = $prod->rowCount();

    $slider = $db->query("SELECT * FROM slider");
    $feslider = $slider->rowCount();

    $orders = $db->query("SELECT * FROM product_order");
    $total_order = $orders->rowCount();

    $completed_orders = $db->query("SELECT * FROM product_order WHERE order_status = 2");
    $total_completed_order = $completed_orders->rowCount();

    $pending_orders = $db->query("SELECT * FROM product_order WHERE order_status = 0");
    $total_pending_order = $pending_orders->rowCount();

    $confirmed_orders = $db->query("SELECT * FROM product_order WHERE order_status = 1");
    $total_confirmed_orders = $confirmed_orders->rowCount();

    $canceled_orders = $db->query("SELECT * FROM product_order WHERE order_status = 3");
    $total_canceled_order = $canceled_orders->rowCount();

    $recent_order = $db->query("SELECT a.*, b.*,a.id as order_id FROM product_order a, user b WHERE a.user_id = b.id ORDER BY a.id DESC LIMIT 0,10");

    $top_sales = $db->query("SELECT a.product_id, b.name, count(a.qty) as total,c.product_type_price FROM order_items a, product b, product_type c WHERE a.product_id = b.id AND a.product_type_id = c.product_type_id GROUP BY a.product_type_id ORDER BY total DESC LIMIT 0,10");

    $total_amount = $db->query("SELECT sum(a.total_amount) as total,b.payment_type FROM product_order a, payment b WHERE a.id = b.order_id AND a.order_status = 2 GROUP BY b.payment_type");
    $cash_amount = 0;
    $paytm_amount = 0;
    while($fetotal = $total_amount->fetch()){
        if($fetotal['payment_type'] == 1){
            $paytm_amount = $fetotal['total'];
        } else {
            $cash_amount = $fetotal['total'];
        }
    }
    $all_total = $cash_amount + $paytm_amount;

    $currunt_year = $db->query("select sum(`total_amount`) as total from product_order where YEAR(`created`) = YEAR(CURDATE()) AND order_status = 2");
    $fecurrunt = $currunt_year->fetch();

    $d = strtotime("today");
    $start_week = strtotime("last sunday midnight",$d);
    $end_week = strtotime("next saturday",$d);
    $start = date("Y-m-d",$start_week); 
    $end = date("Y-m-d",$end_week);  
    $start1 = date('Y-m-d', strtotime($start . ' +1 day'));
    $start2 = date('Y-m-d', strtotime($start . ' +2 day'));
    $start3 = date('Y-m-d', strtotime($start . ' +3 day'));
    $start4 = date('Y-m-d', strtotime($start . ' +4 day'));
    $start5 = date('Y-m-d', strtotime($start . ' +5 day'));
    $start6 = date('Y-m-d', strtotime($start . ' +6 day'));
    $sunday = $db->query("SELECT COUNT(*) FROM payment WHERE DATE(created) = '$start' AND status = '1'");
    $sundayCount = $sunday->fetchColumn();
    $monday = $db->query("SELECT COUNT(*) FROM payment WHERE DATE(created) = '$start1' AND status = '1'");
    $mondayCount = $monday->fetchColumn();
    $tuesday = $db->query("SELECT COUNT(*) FROM payment WHERE DATE(created) = '$start2' AND status = '1'");
    $tuesdayCount = $tuesday->fetchColumn();
    $wednesday = $db->query("SELECT COUNT(*) FROM payment WHERE DATE(created) = '$start3' AND status = '1'");
    $wednesdayCount = $wednesday->fetchColumn();
    $thursday = $db->query("SELECT COUNT(*) FROM payment WHERE DATE(created) = '$start4' AND status = '1'");
    $thursdayCount = $thursday->fetchColumn();
    $friday = $db->query("SELECT COUNT(*) FROM payment WHERE DATE(created) = '$start5' AND status = '1'");
    $fridayCount = $friday->fetchColumn();
    $saturday = $db->query("SELECT COUNT(*) FROM payment WHERE DATE(created) = '$start6' AND status = '1'");
    $saturdayCount = $saturday->fetchColumn();
    /*print_r("SELECT COUNT(*) FROM payment WHERE created = '$start2' AND status = '1'"); die;*/
?>

<script>
var saturdayCount = "<?php echo $saturdayCount; ?>";
var sundayCount = "<?php echo $sundayCount; ?>";
var mondayCount = "<?php echo $mondayCount; ?>";
var tuesdayCount = "<?php echo $tuesdayCount; ?>";
var wednesdayCount = "<?php echo $wednesdayCount; ?>";
var thursdayCount = "<?php echo $thursdayCount; ?>";
var fridayCount = "<?php echo $fridayCount; ?>";
</script>
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
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/media.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <style>
    .admin-name-header {
        margin-top: 3px !important;
    }
    </style>
</head>

<body>
    <!--  BEGIN NAVBAR  -->
    <?php include('header.php'); ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <!--  BEGIN SIDEBAR  -->
        <?php include('sidebar.php'); ?>
        <!--  END SIDEBAR  -->
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Users</h6>
                                        <p class="text-center mt-3"><a href="users.php"><?= $total_user ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Delivery Boy</h6>
                                        <p class="text-center mt-3"><a href="delivery_boy.php"><?= $total_del_boy ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Active Delivery Boys</h6>
                                        <p class="text-center mt-3"><a
                                                href="delivery_boy.php"><?= $total_act_del_boy ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">New Delivery Boys</h6>
                                        <p class="text-center mt-3"><a
                                                href="delivery_boy.php"><?= $total_deact_del_boy ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row layout-top-spacing mt-0">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Categories</h6>
                                        <p class="text-center mt-3"><a href="category.php"><?= $category ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Products</h6>
                                        <p class="text-center mt-3"><a href="products.php"><?= $product ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Slider</h6>
                                        <p class="text-center mt-3"><a href="slider.php"><?= $feslider ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Confirmed Orders</h6>
                                        <p class="text-center mt-3"><a
                                                href="confirm_order.php"><?= $total_completed_order ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row layout-top-spacing mt-0">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Orders</h6>
                                        <p class="text-center mt-3"><a href="report.php"><?= $total_order ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Completed Orders</h6>
                                        <p class="text-center mt-3"><a
                                                href="report.php"><?= $total_completed_order ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Pending Orders</h6>
                                        <p class="text-center mt-3"><a href="orders.php"><?= $total_pending_order ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="">
                                    <div class="w-info">
                                        <h6 class="value">Canceled Orders</h6>
                                        <p class="text-center mt-3"><a
                                                href="cancel_orders.php"><?= $total_canceled_order ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget-two height_260">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-content">
                                        <span class="w-value mb-1">Daily sales</span>
                                        <span class="w-numeric-title">Go to columns for details.</span>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="daily-sales"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget-three height_260">
                            <div class="widget-heading">
                                <h5 class="">Summary</h5>
                            </div>
                            <div class="widget-content">

                                <div class="order-summary">

                                    <!-- <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-shopping-bag">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                        </div>
                                        <div class="w-summary-details">

                                            <div class="w-summary-info">
                                                <h6>Cash Income</h6>
                                                <p class="summary-count">₹<?= $cash_amount ?></p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                                        style="width: 90%" aria-valuenow="90" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-tag">
                                                <path
                                                    d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                                </path>
                                                <line x1="7" y1="7" x2="7" y2="7"></line>
                                            </svg>
                                        </div>
                                        <div class="w-summary-details">

                                            <div class="w-summary-info">
                                                <h6>Paytm Income</h6>
                                                <p class="summary-count">₹<?= $paytm_amount ?></p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar"
                                                        style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div> -->

                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-credit-card">
                                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                                <line x1="1" y1="10" x2="23" y2="10"></line>
                                            </svg>
                                        </div>
                                        <div class="w-summary-details">

                                            <div class="w-summary-info">
                                                <h6>Total Income</h6>
                                                <p class="summary-count">₹<?= $all_total ?></p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                        style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-one height_260">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-shopping-cart">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="w-content">
                                        <span class="w-value">₹<?= $fecurrunt['total'] ?></span>
                                        <span class="w-numeric-title">Current Year Orders Sales</span>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="total-orders"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row layout-top-spacing mt-0">
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing mt-0">
                        <div class="widget widget-table-two widget-20">

                            <div class="widget-heading">
                                <h5 class="">Recent Orders</h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="th-content">Customer</div>
                                                </th>
                                                <th>
                                                    <div class="th-content">Invoice</div>
                                                </th>
                                                <th>
                                                    <div class="th-content th-heading">Price</div>
                                                </th>
                                                <th>
                                                    <div class="th-content">Status</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        while($ferecent = $recent_order->fetch()){
                                            $image = '';
                                            if($ferecent['avatar'] != ''){
                                                $image = $ferecent["avatar"];
                                            } else {
                                                $image = 'default.png';
                                            }
                                            $order_status = '';
                                            if($ferecent['order_status'] == 0){
                                                $order_status = '<span class="badge outline-badge-warning">Pending</span>';
                                            } elseif ($ferecent['order_status'] == 1) {
                                                $order_status = '<span class="badge outline-badge-info">Confirmed</span>';
                                            } elseif($ferecent['order_status'] == 2) {
                                                $order_status = '<span class="badge outline-badge-success">Delivered</span>';
                                            } elseif($ferecent['order_status'] == 3) {
                                                $order_status = '<span class="badge outline-badge-danger">Cancelled</span>';
                                            } elseif($ferecent['order_status'] == 4) {
                                                $order_status = '<span class="badge outline-badge-success">Shipped</span>';
                                            } else {
                                                $order_status = '<span class="badge outline-badge-danger">Cancelled</span>';
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="td-content customer-name"><img
                                                            src="../assets/img/user/<?= $image ?>"
                                                            alt="avatar"><?= $ferecent['fullname'] ?></div>
                                                </td>
                                                <td>
                                                    <div class="td-content"><a
                                                            href="user-orders.php?id=<?= $ferecent["order_id"] ?>""><?= $ferecent['order_number'] ?></a></div></td>
                                                <td><div class=" td-content pricing"><span
                                                                class="">₹<?= $ferecent['total_amount'] ?></span></div>
                                                </td>
                                                <td>
                                                    <div class="td-content"><?= $order_status ?></div>
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

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-three widget-20">

                            <div class="widget-heading">
                                <h5 class="">Top Selling Product</h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="th-content">Image</div>
                                                </th>
                                                <th>
                                                    <div class="th-content th-heading">Name</div>
                                                </th>
                                                <th>
                                                    <div class="th-content th-heading">Price</div>
                                                </th>
                                                <th>
                                                    <div class="th-content">Sold</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        while ($fetop = $top_sales->fetch()){
                                            $product_id = $fetop['product_id'];
                                            $selectImages = $db->query("SELECT * FROM product_image WHERE p_id = '$product_id'");
                                            $fetchImage = $selectImages->fetch();
                                            $image = '';
                                            if($fetchImage['image'] != ''){
                                                $image = $fetchImage["image"];
                                            } else {
                                                $image = 'product.jpg';
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="td-content"><img
                                                            src="../assets/img/product/<?= $image ?>" alt="product">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="td-content"><span
                                                            class="product-name"><?= $fetop['name'] ?></span></div>
                                                </td>
                                                <td>
                                                    <div class="td-content"><span
                                                            class="pricing">₹<?= $fetop['product_type_price'] ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="td-content"><?= $fetop['total'] ?></div>
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
            <?php include('footer.php'); ?>
        </div>
        <!--  END CONTENT PART  -->
    </div>
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
</body>

</html>