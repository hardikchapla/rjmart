<?php
    include('../connection/connection.php');
    include('../helper/core_function.php');
    include('../helper/constant.php');
    $currentPage = 'user-Details';
    $user_id = $_REQUEST['id'];
    $user = $db->query("SELECT * FROM user WHERE id = '$user_id'");
    $feuser = $user->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?= APP_NAME ?></title>
    <link rel="icon" type="image/x-icon" href="<?= FAVICON ?>"/>
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
                
                    <div class="col-xl-3 col-lg-3 col-sm-3  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <img src="../assets/img/user/<?= ($feuser["avatar"] != '') ? $feuser["avatar"]:'default.png' ?>" style = "border-radius: 50px" width="200" height="200" />
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-sm-9  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                   <p><strong>Name :</strong></p>
                                </div>
                                <div class="col-xl-9 col-lg-9 col-sm-9">
                                   <p><?= $feuser['fullname'] ?></p> 
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                   <p><strong>Email :</strong></p> 
                                </div>
                                <div class="col-xl-9 col-lg-9 col-sm-9">
                                   <p><?= $feuser['email'] ?></p> 
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                   <p><strong>Mobile No. :</strong></p> 
                                </div>
                                <div class="col-xl-9 col-lg-9 col-sm-9">
                                   <p><?= $feuser['mobile'] ?></p> 
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                   <p><strong>Date Of Birth. :</strong></p> 
                                </div>
                                <div class="col-xl-9 col-lg-9 col-sm-9">
                                   <p><?= ($feuser['dob'] == '0000-00-00') ? '':$feuser['dob'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <section>

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">User Address</a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Orders</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div style="width: 100%;overflow-x: scroll;overflow-y: hidden">
                                        <table id="display_user" class="table" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Full Name</th>
                                                <th>Mobile Number</th>
                                                <th>Alt. Mobile Number</th>
                                                <th>House No.</th>
                                                <th>Building No.</th>
                                                <th>Road/Area/Colony</th>
                                                <th>Main area</th>
                                                <th>Landmark</th>
                                                <th>City</th>
                                                <th>State</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                        </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div style="width: 100%;overflow-x: scroll;overflow-y: hidden">
                                            <table id="display_order" class="table" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Order Number</th>
                                                    <th>Full Name</th>
                                                    <th>Order Items</th>
                                                    <th>Total Amount</th>
                                                    <th>Order Status</th>
                                                    <th>Payment Type</th>
                                                    <th>View</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
                    </div>

                </div>

            </div>
            <?php include('footer.php'); ?>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
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
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
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
        var user_id = '<?= $user_id ?>';
        $(document).ready(function() {
            var dataTable = $('#display_user').DataTable({
                "ajax": {
                    url: "code/display_user_address.php",
                    type: "POST",
                    data: {'user_id':user_id},
                }
            });
            var dataTable1 = $('#display_order').DataTable({
                "ajax": {
                    url: "code/display_user_order.php",
                    type: "POST",
                    data: {'user_id':user_id},
                }
            });
        });
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
    
</body>
</html>