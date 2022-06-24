<?php
include('../connection/connection.php');
include('../helper/core_function.php');
include('../helper/constant.php');
$currentPage = 'Push Notification';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?= APP_NAME ?></title>
    <link rel="icon" type="image/x-icon" href="<?= FAVICON ?>" />
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL STYLES -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/media.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">

    <!-- END PAGE LEVEL STYLES -->
</head>

<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->
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
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div id="custom_styles" class="col-lg-12 layout-spacing col-md-6">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area br-6">
                                <div class="widget-header add-new-cat-title">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-0">
                                            <h4>Send Push Notification</h4>
                                        </div>
                                    </div>
                                </div>
                                <form class="needs-validation" novalidate action="javascript:void(0);" method="POST"
                                    accept-charset="utf-8" id="add-pincode-form">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="title">Select User Type</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="user_type"
                                                    id="user_type1" value="all">
                                                <label class="form-check-label" for="user_type1">All</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="user_type"
                                                    id="user_type2" value="delivery_boy">
                                                <label class="form-check-label" for="user_type2">Delivery Boy</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="user_type"
                                                    id="user_type3" value="users">
                                                <label class="form-check-label" for="user_type3">Users</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="selected_user">Select User</label>
                                            <select class="form-control" name="selected_user[]" id="selected_user"
                                                multiple>
                                                <?php
                                                    $getData = $db->query("SELECT * FROM user WHERE user_type = 0 ORDER BY ID ASC");
                                                    while($fetchData = $getData->fetch()){ ?>
                                                <option value="<?php echo $fetchData['id']; ?>">
                                                    <?php echo $fetchData['fullname']; ?></option>
                                                <?php }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" placeholder="Enter Title"
                                                required name="title">
                                            <div class="invalid-feedback">
                                                Please provide a valid Title.
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="message">Message</label>
                                            <textarea class="form-control" id="message" placeholder="Enter Message"
                                                required name="message"></textarea>
                                            <div class="invalid-feedback">
                                                Please provide a valid Message.
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="operation" id="operation" value="Add" />
                                    <button class="btn btn-primary mt-3 float-right" type="submit">Submit</button>
                                    <button class="btn btn-warning mt-3 float-right cancel-add" id="cancel-add"
                                        type="reset">Cancel</button>
                                </form>
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
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="plugins/apex/apexcharts.min.js"></script>
    <script src="assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/file-upload/file-upload-with-preview.min.js"></script>
    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/sweetalerts/custom-sweetalert.js"></script>
    <script src="plugins/select2/select2.min.js"></script>
    <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
    <script src="plugins/file-upload/file-upload-with-preview.min.js"></script>

    <!-- include Stylesheet -->

    <!-- END PAGE LEVEL PLUGINS -->
    <script>
    $(document).ready(function() {
        $('#selected_user').select2({
            placeholder: "Select users",
            allowClear: true
        });
        App.init();
    });
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
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
        "lengthMenu": [10, 20, 50],
        "pageLength": 10
    });
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
    </script>
    <script type="text/javascript">
    $(document).on('submit', '#add-pincode-form', function(event) {
        event.preventDefault();
        $.ajax({
            url: "code/send_push_notification",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                if (obj.error == 'success') {
                    swal({
                        title: 'Push notification send successfully',
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
                } else if (obj.error == 'updateSuccess') {
                    swal({
                        title: 'Pincode has been updated successfully',
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
                } else if (obj.error == 'duplicate') {
                    swal({
                        title: "Warning ?",
                        text: "This pincode is already exist!",
                        type: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#EF5350"
                    });
                    return false;
                } else {
                    swal({
                        title: "Warning ?",
                        text: "Oops! Something went wrong",
                        type: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#EF5350"
                    });
                    return false;
                }
            }
        });
    });
    </script>
</body>

</html>