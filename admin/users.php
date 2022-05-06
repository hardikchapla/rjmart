<?php
    include('../connection/connection.php');
    include('../helper/core_function.php');
    include('../helper/constant.php');
    $currentPage = 'users';
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
                            <div class="table-responsive mb-4 mt-4">
                                <table id="display_user" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Avatar</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>View</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                </table>
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
    <!-- END PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('#display_user').DataTable({
            "ajax": {
                url: "code/display_user",
                type: "POST"
            }
        });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.deleteUser', function(e) {
            var id = $(this).attr("id");
            SwalDelete(id);
            e.preventDefault();
        });
    });

    function SwalDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this user?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'rgb(221, 51, 51)',
            cancelButtonColor: '#4ac17d',
            cancelButtonText: "No, cancel please!",
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            url: 'code/delete_user',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'json'
                        })
                        .done(function(response) {
                            swal({
                                title: 'User has been deleted successfully',
                                text: "",
                                type: 'success',
                                timer: 3000,
                                padding: '2em',
                                onOpen: function() {
                                    swal.showLoading()
                                }
                            }).then(function(result) {
                                if (

                                    result.dismiss === swal.DismissReason.timer
                                ) {
                                    console.log('I was closed by the timer')
                                    location.reload();
                                }
                            })
                        })
                        .fail(function() {
                            swal('Oops...', 'Something went wrong with ajax !', 'error');
                        });
                });
            },
        });
    }
    </script>
</body>

</html>