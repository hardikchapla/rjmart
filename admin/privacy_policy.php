<?php
    include('../connection/connection.php');
    include('../helper/core_function.php');
    include('../helper/constant.php');
    $currentPage = 'Privacy';
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
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">
    <link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
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
                    <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12 add-cat-box">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area br-6">
                                <div class="widget-header add-new-cat-title">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-0">
                                            <h4>Update Privacy Policy</h4>
                                        </div>
                                    </div>
                                </div>
                                <form class="needs-validation" novalidate action="javascript:void(0);" method="POST"
                                    accept-charset="utf-8" id="add-category-form">
                                    <div class="form-row pb-3" id="img-list"></div>
                                    <div class="form-row">

                                        <div class="col-md-4 mb-4">
                                            <label for="slug_name">Slug Name</label>
                                            <input type="text" class="form-control" id="slug_name"
                                                placeholder="Name of The Slug" disabled>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="price">Description</label>
                                            <textarea name="editor1" id="editor1" class="form-control"></textarea>
                                            <div class="invalid-feedback">
                                                Please provide a valid description.
                                            </div>
                                            <div id="error_plan_desc"></div>
                                            <div class="all_error"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="privacy_id" id="privacy_id" />
                                    <input type="hidden" name="operation" id="operation" value="Edit" />
                                    <div class="">
                                        <button class="btn btn-primary mt-3 float-right" type="submit">Submit</button>
                                        <button class="btn btn-warning mt-3 float-right cancel-add" id="cancel-add"
                                            type="reset">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing" id="category-list-box">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-5">
                                <table id="display_privacy" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Edit</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Privacy Details</h5>
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
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace('editor1');
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
    $(document).ready(function() {
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
    function formReset() {
        CKEDITOR.instances.editor1.setData('');
    }
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('#display_privacy').DataTable({
            "ajax": {
                url: "code/display_privacy_policy",
                type: "POST"
            }
        });
    });
    </script>
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
    var i = 1;
    $(document).ready(function() {
        $('#add-category').on('click', function(e) {
            $('.add-cat-box').show();
            $('#category-list-box').hide();
        });
    });
    </script>
    <script type="text/javascript">
    $("#editor1").keyup(function() {
        $("#error_plan_desc").html("");
    });
    $(document).on('submit', '#add-category-form', function(event) {
        var editor1 = CKEDITOR.instances.editor1.getData();
        if (editor1 == "") {
            $("#error_plan_desc").html("<code>Please enter the description</code>");
            return false;
        }
        event.preventDefault();
        $.ajax({
            url: "code/edit_privacy_policy",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(response) {
                console.log(response);
                var obj = jQuery.parseJSON(response);
                if (obj.error == 'success') {
                    swal({
                        title: 'Privacy Policy has been inserted successfully',
                        text: "",
                        type: 'success',
                        timer: 3000,
                        padding: '2em',
                        onOpen: function() {
                            swal.showLoading()
                        }
                    }).then(function(result) {
                        $(this).trigger('reset');
                        location.reload();
                    })
                } else if (obj.error == 'updateSuccess') {
                    swal({
                        title: 'Privacy Policy has been updated successfully',
                        text: "",
                        type: 'success',
                        timer: 3000,
                        padding: '2em',
                        onOpen: function() {
                            swal.showLoading()
                        }
                    }).then(function(result) {
                        location.reload();
                    })
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
    <script type="text/javascript">
    $(document).on('click', '.updatePrivacyPolicy', function() {
        $('.add-cat-box').show();
        $('#category-list-box').hide();
        $("#img-list").html('');
        var privacy_id = $(this).attr("id");
        $.ajax({
            url: "code/update_privacy_policy",
            method: "POST",
            data: {
                privacy_id: privacy_id
            },
            dataType: "json",
            success: function(data) {
                $('#slug_name').val(data.privacy_slug);
                CKEDITOR.instances['editor1'].setData(data.description);
                $('#privacy_id').val(privacy_id);
                $('#action').val("Edit");
                $('#operation').val("Edit");
            }
        })
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#cancel-add').on('click', function(e) {
            $('#category-list-box').show();
            $('.add-cat-box').hide();
            $("#img-list").html('');
        });
    });
    </script>
    <script type="text/javascript">
    $(document).on('click', '.view_plan_details', function() {
        var id = $(this).attr("id");
        $.ajax({
            url: "code/view_privacy_details",
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
</body>

</html>