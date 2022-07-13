<?php
   include('../connection/connection.php');
   include('../helper/core_function.php');
   include('../helper/constant.php');
   /*include('../libraries/phpqrcode/qrlib.php');*/
   $currentPage = 'OrdersReports';
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
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/media.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/apps/invoice.css" rel="stylesheet" type="text/css" />
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
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <h4></h4>Order Reports</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <!--<label for="start_date">Start Date</label>
                              <input type="date" class="form-control" id="start_date" placeholder="Select start date" required name="start_date">-->
                                    <label for="startDate">Start Date</label>
                                    <input id="startDate" name="startDate" type="text" class="form-control mr-3" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <!-- <label for="end_date">End Date</label>
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
                            <div class="text-center">
                                <h5><b>Total Amount</b></h5>
                            </div>
                            <div class="text-center">
                                <h6 id="total_amount"></h6>
                            </div>
                            <hr>
                            <div style="width: 100%;overflow-x: scroll;overflow-y: hidden">
                                <table id="display_order_request" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Order Number</th>
                                            <th>Full Name</th>
                                            <th>Order Items</th>
                                            <th>Total Amount</th>
                                            <th>Payment Type</th>
                                            <th>View</th>
                                            <th>Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                           </button>-->
                            <!--<div class="invoice-header-section">
                           <h4 class="inv-number"></h4>
                           <div class="invoice-action">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer action-print" data-toggle="tooltip" data-placement="top" data-original-title="Reply"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                           </div>
                           </div>-->
                        </div>
                        <div class="modal-body">
                            <div class="invoice-container">
                                <div class="invoice-inbox">
                                    <div class="invoice-header-section">
                                        <h4 class="inv-number"></h4>
                                        <div class="invoice-action">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer action-print" data-toggle="tooltip" data-placement="top" data-original-title="Reply"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> -->
                                            <button id="generate_invoice" class="btn btn-primary">Print</button>
                                        </div>
                                    </div>
                                    <div id="ct_data">
                                        <style>
                                        @page {
                                            size: 5.5in 8.5in;
                                            size: landscape;
                                        }
                                        </style>
                                        <div class="container A3" style="margin-top:20px;" id="invoice-data">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                Close</button>
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
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="assets/js/custom.js"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/sweetalerts/custom-sweetalert.js"></script>
    <script src="assets/js/apps/invoice.js"></script>

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
    var start_date = '';
    var end_date = '';
    $(document).ready(function() {
        var dataTable1 = $('#display_order_request').DataTable({
            "destroy": true,
            "ajax": {
                url: "code/display_orders_report",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
            }
        });
        $.ajax({
            url: "code/view_order_total",
            method: "POST",
            data: {
                start_date: start_date,
                end_date: end_date
            },
            dataType: "json",
            success: function(data) {
                $('#total_amount').html('₹' + data.total_amount);
            }
        })
    });
    </script>
    <script type="text/javascript">
    $("#ordercheck").click(function() {
        start_date = document.getElementById("startDate").value;
        end_date = document.getElementById("endDate").value;
        if (start_date == '') {
            swal('Warning', 'Select start date', 'warning');
        }
        if (end_date == '') {
            swal('Warning', 'Select end date', 'warning');
        }
        var dataTable1 = $('#display_order_request').DataTable({
            "destroy": true,
            "ajax": {
                url: "code/display_orders_report",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
            }
        });
        $.ajax({
            url: "code/view_order_total",
            method: "POST",
            data: {
                start_date: start_date,
                end_date: end_date
            },
            dataType: "json",
            success: function(data) {
                $('#total_amount').html('₹' + data.total_amount);
            }
        })
    });
    $("#resetdefault").click(function() {
        location.reload();
        start_date = '';
        end_date = '';
        var dataTable1 = $('#display_order_request').DataTable({
            "destroy": true,
            "ajax": {
                url: "code/display_orders_report.php",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
            }
        });
        $.ajax({
            url: "code/view_order_total.php",
            method: "POST",
            data: {
                start_date: start_date,
                end_date: end_date
            },
            dataType: "json",
            success: function(data) {
                $('#total_amount').html(data.total_amount);
            }
        })
    });
    </script>

    <script type="text/javascript">
    $(document).on('click', '.view_plan_details', function() {
        var id = $(this).attr("id");
        $.ajax({
            url: "code/view_order_derails",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                console.log(response.display);
                $('#invoice-data').html(response.display);
            }
        })
    });
    </script>
    <script type="text/javascript">
    $("#generate_invoice").click(function() {
        var divContents = $("#ct_data").html();
        var printWindow = window.open('', '', 'height=400,width=800');
        printWindow.document.write('<html><head><title>Invoice</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });
    </script>
    <!-- <script type="text/javascript">
    if ($('[type="date"]').prop('type') != 'date') {
        $('[type="date"]').datepicker();
    }
    </script> -->
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

</body>

</html>