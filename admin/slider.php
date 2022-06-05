<?php
include('../connection/connection.php');
include('../helper/core_function.php');
include('../helper/constant.php');
$currentPage = 'Slider';
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
                    <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12 add-cat-box">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area br-6">
                                <div class="widget-header add-new-cat-title">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-0">
                                            <h4>Add New Slider</h4>
                                        </div>
                                    </div>
                                </div>
                                <form class="needs-validation" novalidate action="javascript:void(0);" method="POST"
                                    accept-charset="utf-8" id="add-category-form">
                                    <div class="form-row">
                                        <div class="col-md-3 mb-4">
                                            <!--<div class="custom-file-container" data-upload-id="myFirstImage">
                                             <label for="validationCustom05">Upload Image</label>
                                                <div class="custom-file mb-4">
                                                    <input type="file" class="custom-file-input form-control" id="cat_profile" name="cat_profile" required>
                                                    <label class="custom-file-label img_height" for="customFile">Choose file</label>
                                                    <div class="invalid-feedback">
                                                        Please select a image.
                                                    </div>
                                                </div>
                                                <input type="hidden" name="cat_profile1" id="cat_profile1">
                                        </div>-->
                                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                                <label>Upload (Single File) <a href="javascript:void(0)"
                                                        class="custom-file-container__image-clear"
                                                        title="Clear Image">x</a></label>
                                                <label class="custom-file-container__custom-file">
                                                    <input type="file"
                                                        class="custom-file-container__custom-file__custom-file-input"
                                                        id="cat_profile" name="cat_profile">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span
                                                        class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>
                                            <input type="hidden" name="cat_profile1" id="cat_profile1">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="validationCustom05">Select Category</label>
                                            <select class="form-control" name="selected_category" id="selected_category"
                                                required>
                                                <option value="">Select Category</option>
                                                <?php
                                                    $cat = "SELECT * FROM category ORDER BY ID ASC";
                                                    $getData = $db->query($cat);
                                                    while($fetchData = $getData->fetch()){ ?>
                                                <option value="<?php echo $fetchData['id']; ?>">
                                                    <?php echo $fetchData['name']; ?></option>
                                                <?php }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="validationCustom05">Slider Type</label>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="slider_type"
                                                        id="slider_type1" value="0" checked>
                                                    <label class="form-check-label" for="slider_type1">Image</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="slider_type"
                                                        id="slider_type2" value="1">
                                                    <label class="form-check-label" for="slider_type2">Video</label>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide a valid type.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="validationCustom05">Is Active?</label>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        id="is_active1" value="1" checked>
                                                    <label class="form-check-label" for="is_active1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        id="is_active2" value="0">
                                                    <label class="form-check-label" for="is_active2">No</label>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide a valid selection.
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="cat_id" id="cat_id" />
                                    <input type="hidden" name="operation" id="operation" value="Add" />
                                    <button class="btn btn-primary mt-3 float-right" type="submit">Submit</button>
                                    <button class="btn btn-warning mt-3 float-right cancel-add" id="cancel-add"
                                        type="reset">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing" id="category-list-box">
                        <div class="widget-content widget-content-area br-6">
                            <div class="add-category">
                                <button class="btn btn-primary float-right" type="button" id="add-category">Add
                                    New</button>
                            </div>
                            <div class="table-responsive mb-4 mt-5">
                                <table id="display_category" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Type</th>
                                            <th>Is Active?</th>
                                            <th>Edit</th>
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
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="plugins/apex/apexcharts.min.js"></script>
    <script src="assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/sweetalerts/custom-sweetalert.js"></script>
    <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
    <script src="plugins/file-upload/file-upload-with-preview.min.js"></script>

    <script>
    //First upload
    var firstUpload = new FileUploadWithPreview('myFirstImage')
    //Second upload
    var secondUpload = new FileUploadWithPreview('mySecondImage')
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
    $(document).ready(function() {
        var dataTable = $('#display_category').DataTable({
            "ajax": {
                url: "code/display_slider",
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
    $(document).ready(function() {
        $('#add-category').on('click', function(e) {
            $('.add-cat-box').show();
            $('#category-list-box').hide();
        });
    });
    </script>
    <script type="text/javascript">
    $(document).on('submit', '#add-category-form', function(event) {
        event.preventDefault();
        $.ajax({
            url: "code/add_slider",
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
                        title: 'Slider has been inserted successfully',
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
                        title: 'Slider has been updated successfully',
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
    $(document).on('click', '.updateCategory', function() {
        $('.add-cat-box').show();
        $('#category-list-box').hide();
        var cat_id = $(this).attr("id");
        $.ajax({
            url: "code/update_slider",
            method: "POST",
            data: {
                cat_id: cat_id
            },
            dataType: "json",
            success: function(data) {
                $('#cat_profile1').val(data.user_profile);
                $('#selected_category').val(data.cat_name);
                if (data.slider_type == 0) {
                    $('#slider_type1').attr('checked', true);
                } else {
                    $('#slider_type2').attr('checked', true);
                }
                if (data.is_active == 0) {
                    $('#is_active2').attr('checked', true);
                } else {
                    $('#is_active1').attr('checked', true);
                }
                $('#cat_id').val(cat_id);
                $('#action').val("Edit");
                $('#operation').val("Edit");
                $('#cat_profile').attr('required', false);
            }
        })
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.deleteCategory', function(e) {
            var cat_id = $(this).attr("id");
            SwalDelete(cat_id);
            e.preventDefault();
        });
    });

    function SwalDelete(cat_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "It will be deleted permanently!",
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
                            url: 'code/delete_slider',
                            type: 'POST',
                            data: 'cat_id=' + cat_id,
                            dataType: 'json'
                        })
                        .done(function(response) {
                            swal({
                                title: 'Slider has been deleted successfully',
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
    <script type="text/javascript">
    $(document).ready(function() {
        $('#cancel-add').on('click', function(e) {
            $('#category-list-box').show();
            $('.add-cat-box').hide();
        });
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
    });

    function SwalStatusChange(sliderId, status) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change this status?",
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
                            url: 'code/slider_status_change',
                            type: 'POST',
                            data: {
                                sliderId: sliderId,
                                status: status
                            },
                            dataType: 'json'
                        })
                        .done(function(response) {
                            swal({
                                title: 'Status has been changed successfully',
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
</body>

</html>