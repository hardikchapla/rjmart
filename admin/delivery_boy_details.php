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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css">
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
                            <img src="../assets/img/user/<?= ($feuser["avatar"] != '') ? $feuser["avatar"]:'default.png' ?>"
                                style="border-radius: 50px" width="200" height="200" />
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
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>User Status. :</strong></p>
                                </div>
                                <div class="col-xl-9 col-lg-9 col-sm-9">
                                    <p>
                                        <?php
                                        if($feuser['status'] == 0){
                                            echo "Deactive";
                                        } else {
                                            echo "Active";
                                        }
                                    ?>
                                    </p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3">
                                    <p><strong>Delivery Status. :</strong></p>
                                </div>
                                <div class="col-xl-9 col-lg-9 col-sm-9">
                                    <p>
                                        <?php
                                    if($feuser['active'] == 0){
                                        echo "Not Available";
                                    } else {
                                        echo "Available";
                                    }
                                    ?>
                                    </p>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-sm-12 text-right">
                                    <button class="btn btn-info view_documents" data-toggle="modal"
                                        data-target="#exampleModal" id="<?= $feuser['document'] ?>">Show
                                        Documents</button>
                                    <?php
                                    if($feuser['status'] == 0){
                                ?>
                                    <button class="btn btn-success changeStatus" key="1"
                                        id="<?= $feuser['id'] ?>">Activate</button>
                                    <?php
                                    } else {
                                ?>
                                    <button class="btn btn-warning changeStatus" key="0"
                                        id="<?= $feuser['id'] ?>">Deactivate</button>
                                    <?php
                                    }
                                ?>
                                    <?php
                                    if($feuser['status'] == 0){
                                ?>
                                    <button class="btn btn-danger disapproved"
                                        id="<?= $feuser['id'] ?>">Disapproved</button>
                                    <?php
                                    }
                                ?>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                        <h4>Completed/Confirm Orders</h4>
                        <div class="widget-content widget-content-area br-6">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <!--<label for="start_date">Start Date</label>
                                <input type="date" class="form-control" id="start_date" placeholder="Select start date" required name="start_date">-->
                                    <label for="startDate">Start Date</label>
                                    <input id="startDate" name="startDate" type="text" class="form-control mr-3" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <!--<label for="end_date">End Date</label>
                                <input type="date" class="form-control" id="end_date" placeholder="Select end date" required name="end_date">-->
                                    <label for="endDate">End Date</label>
                                    <input id="endDate" name="endDate" type="text" class="form-control  endDate" />
                                </div>
                                <div class="col-md-2 scbuttonpadding">
                                    <button type="button" class="form-control btn btn-success" id="ordercheck"
                                        name="ordercheck">to save</button>
                                </div>
                                <div class="col-md-3 scbuttonpadding">
                                    <button type="button" class="form-control btn btn-info" id="resetdefault"
                                        name="resetdefault">Reset to default</button>
                                </div>
                            </div>
                            <hr>
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
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                        <h4>Request Orders</h4>
                        <div class="widget-content widget-content-area br-6">
                            <div style="width: 100%;overflow-x: scroll;overflow-y: hidden">
                                <table id="display_order_request" class="table" style="width:100%">
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
                    <h5 class="modal-title" id="exampleModalLabel">User Document</h5>
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
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js">
    </script>
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
    var user_id = '<?= $user_id ?>';
    $(document).ready(function() {
        var dataTable1 = $('#display_order').DataTable({
            "destroy": true,
            "ajax": {
                url: "code/display_delivery_order",
                type: "POST",
                data: {
                    'user_id': user_id,
                    'status': 1
                },
            }
        });
        var dataTable1 = $('#display_order_request').DataTable({
            "ajax": {
                url: "code/display_delivery_order",
                type: "POST",
                data: {
                    'user_id': user_id,
                    'status': 0
                },
            }
        });
    });
    $("#ordercheck").click(function() {
        start_date = document.getElementById("startDate").value;
        end_date = document.getElementById("endDate").value;
        if (start_date == '') {
            swal('Warning', 'Select start date', 'warning');
        }
        if (end_date == '') {
            swal('Warning', 'Select end date', 'warning');
        }
        var dataTable1 = $('#display_order').DataTable({
            "destroy": true,
            "ajax": {
                url: "code/display_delivery_order.php",
                type: "POST",
                data: {
                    user_id: user_id,
                    status: 1,
                    start_date: start_date,
                    end_date: end_date
                },
            }
        });
    });
    $("#resetdefault").click(function() {
        // var dataTable1 = $('#display_order').DataTable({
        //     "destroy": true,
        //     "ajax": {
        //         url: "code/display_delivery_order.php",
        //         type: "POST",
        //         data: {user_id:user_id,status:1},
        //     }
        // });
        location.reload();
    });
    </script>
    <script type="text/javascript">
    $(document).on('click', '.view_documents', function() {
        var image = $(this).attr("id");
        $('#plan_details').html('<img src="../assets/img/user/' + image +
            '" style = "border-radius: 50px;width: 100%" height="350" />');
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.changeStatus', function(e) {
            var id = $(this).attr("id");
            var key = $(this).attr("key");
            SwalStatusChange(id, key);
            e.preventDefault();
        });
        $(document).on('click', '.disapproved', function(e) {
            var id = $(this).attr("id");
            SwalDisapproved(id);
            e.preventDefault();
        });

    });

    function SwalDisapproved(user_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to disapprove this user?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'rgb(221, 51, 51)',
            cancelButtonColor: '#4ac17d',
            cancelButtonText: "No, cancel please!",
            confirmButtonText: 'Yes, disapprove it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            url: 'code/delivery_boy_disapprove.php',
                            type: 'POST',
                            data: {
                                user_id: user_id
                            },
                            dataType: 'json'
                        })
                        .done(function(response) {
                            swal({
                                title: 'Delivery boy disapprove successfully',
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
                                    history.back();
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

    function SwalStatusChange(user_id, status) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change this user status?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'rgb(221, 51, 51)',
            cancelButtonColor: '#4ac17d',
            cancelButtonText: "No, cancel please!",
            confirmButtonText: 'Yes, Change it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            url: 'code/delivery_boy_status_change',
                            type: 'POST',
                            data: {
                                user_id: user_id,
                                status: status
                            },
                            dataType: 'json'
                        })
                        .done(function(response) {
                            swal({
                                title: 'Delivery boy status change successfully',
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

    <script type="text/javascript">
    var bindDateRangeValidation = function(f, s, e) {
        if (!(f instanceof jQuery)) {
            console.log("No jQuery object passed");
        }

        var jqForm = f,
            startDateId = s,
            endDateId = e;

        var checkDateRange = function(startDate, endDate) {
            var isValid = (startDate != "" && endDate != "") ? startDate <= endDate : true;
            return isValid;
        }

        var bindValidator = function() {
            var bstpValidate = jqForm.data('bootstrapValidator');
            var validateFields = {
                startDate: {
                    validators: {
                        notEmpty: {
                            message: 'This field has to be filled in.'
                        },
                        callback: {
                            message: 'The start date must be earlier than or equal to the end date.',
                            callback: function(startDate, validator, $field) {
                                return checkDateRange(startDate, $('#' + endDateId).val())
                            }
                        }
                    }
                },
                endDate: {
                    validators: {
                        notEmpty: {
                            message: 'This field has to be filled in.'
                        },
                        callback: {
                            message: 'The end date must be greater than or equal to the start date.',
                            callback: function(endDate, validator, $field) {
                                return checkDateRange($('#' + startDateId).val(), endDate);
                            }
                        }
                    }
                },
                customize: {
                    validators: {
                        customize: {
                            message: 'customize.'
                        }
                    }
                }
            }
            if (!bstpValidate) {
                jqForm.bootstrapValidator({
                    excluded: [':disabled'],
                })
            }

            jqForm.bootstrapValidator('addField', startDateId, validateFields.startDate);
            jqForm.bootstrapValidator('addField', endDateId, validateFields.endDate);

        };

        var hookValidatorEvt = function() {
            var dateBlur = function(e, bundleDateId, action) {
                jqForm.bootstrapValidator('revalidateField', e.target.id);
            }

            $('#' + startDateId).on("dp.change dp.update blur", function(e) {
                $('#' + endDateId).data("DateTimePicker").setMinDate(e.date);
                dateBlur(e, endDateId);
            });

            $('#' + endDateId).on("dp.change dp.update blur", function(e) {
                $('#' + startDateId).data("DateTimePicker").setMaxDate(e.date);
                dateBlur(e, startDateId);
            });
        }

        bindValidator();
        hookValidatorEvt();
    };


    $(function() {
        var sd = new Date(),
            ed = new Date();

        $('#startDate').datetimepicker({
            pickTime: false,
            format: "YYYY/MM/DD",
            defaultDate: sd,
            maxDate: ed
        });

        $('#endDate').datetimepicker({
            pickTime: false,
            format: "YYYY/MM/DD",
            defaultDate: ed,
            minDate: sd
        });

        //passing 1.jquery form object, 2.start date dom Id, 3.end date dom Id
        bindDateRangeValidation($("#form"), 'startDate', 'endDate');
    });
    </script>
    <script>
    $(document).ready(function() {
        App.init();
    });
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->

</body>

</html>