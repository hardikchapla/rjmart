<?php
    include('../connection/connection.php');
    include('../helper/core_function.php');
    include('../helper/constant.php');
    $currentPage = 'products';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?= APP_NAME ?></title>
    <link rel="icon" type="image/x-icon" href="<?= FAVICON ?>"/>
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
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
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
                                            <h4>Add New Product</h4>
                                        </div>         
                                    </div>
                                </div>                                
                                <form class="needs-validation" novalidate action="javascript:void(0);" method="POST" accept-charset="utf-8" id="add-category-form">
                                    <div class="form-row pb-3" id="img-list"></div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                                <label>Upload Image </label>
                                                <div class="input-group">
                                                  <input type="text" class="form-control input-file-dummy" placeholder="Choose file" aria-describedby="fileHelp" required name="dummyImg" id="dummyImg">
                                                  <div class="valid-feedback order-last">File is valid</div>
                                                  <div class="invalid-feedback order-last">File is required</div>
                                                  <label class="input-group-append mb-0">
                                                    <span class="btn btn-primary input-file-btn">
                                                      Browse… <input type="file" hidden name="cat_profile[]" id="cat_profile" multiple data-show-upload="true" data-show-caption="true" required>
                                                    </span>
                                                  </label>
                                                </div>
                                                <input type="hidden" id="cat_profile1" name="cat_profile1" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="validationCustom05">Name</label>
                                            <input type="text" class="form-control" id="validationCustom05" placeholder="Name of The Category" required name="cat_name">
                                            <div class="invalid-feedback">
                                                Please provide a valid name.
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="validationCustom05">Select Category</label>
                                            <select class="form-control"  name="selected_category" id="selected_category" required>
                                            <option value="">Select Category</option>
                                                <?php
                                                    $cat = "SELECT * FROM category ORDER BY ID ASC";
                                                    $getData = $db->query($cat);
                                                    while($fetchData = $getData->fetch()){ ?>

                                                        <option value="<?php echo $fetchData['id']; ?>" ><?php echo $fetchData['name']; ?></option>
                                                   <?php }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a category.
                                            </div>
                                        </div>
                                        <div id="product_type_add">
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
                                    <input type="hidden" name="cat_id" id="cat_id" />
                                    <input type="hidden" name="operation" id="operation" value="Add" />
                                    <div class="">
                                        <button class="btn btn-primary mt-3 float-right" type="submit">Submit</button>
                                        <button class="btn btn-warning mt-3 float-right cancel-add" id="cancel-add" type="reset">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing" id="category-list-box">
                        <div class="widget-content widget-content-area br-6">
                            <div class="add-category">
                                <button class="btn btn-primary float-right" onclick="formReset()" type="button" id="add-category">Add New</button>
                            </div>
                            <div class="table-responsive mb-4 mt-5">
                                <table id="display_category" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <!-- <th>Price</th> -->
                                            <th>Description</th>
                                            <th>Active/Deactive</th>
                                            <th>Edit</th>
                                            <!-- <th>View</th> -->
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
     <!-- Start Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="modal-text">
                        <span id="plan_details"></span>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
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
        CKEDITOR.replace( 'editor1' );
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
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
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
        function formReset()
          {
            CKEDITOR.instances.editor1.setData('');
          }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var dataTable = $('#display_category').DataTable({
                "ajax": {
                    url: "code/display_product.php",
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
        $(document).ready(function() {
            $('#product_type_add').html('<div style="display: inline-flex;"><div class="col-md-4 mb-4"> <input type="text" class="form-control" id="product_type1" placeholder="Product type (EX: GM,KG)" required name="product_type[]"> </div><div class="col-md-3 mb-4"> <input type="text" class="form-control" id="product_type_qty1" placeholder="Product Quantity" required name="Product_qty[]"> </div><div class="col-md-3 mb-4"> <input type="text" class="form-control" id="product_type_price1" placeholder="Product Price" required name="product_type_price[]"> </div><div class="col-md-3 mb-4"> <button type="button" class="form-control btn btn-success" id="add_new_product_type">Add</button> </div></div>');
        });
        $(document).on('click', '#add_new_product_type', function(){ 
            $('#product_type_add').append('<div id="delete_type'+i+'" style="display: inline-flex;"><div class="col-md-4 mb-4"> <input type="text" class="form-control" id="product_type'+i+'" placeholder="Product type (EX: GM,KG)" required name="product_type[]"> </div><div class="col-md-3 mb-4"> <input type="text" class="form-control" id="product_type_qty'+i+'" placeholder="Product Quantity" required name="Product_qty[]"> </div><div class="col-md-3 mb-4"> <input type="text" class="form-control" id="product_type_price'+i+'" placeholder="Product Price" required name="product_type_price[]"> </div><div class="col-md-3 mb-4"> <button type="button" class="form-control btn btn-success" onclick="deleteProducttype('+i+')" id="delete_new_product_type'+i+'">Delete</button> </div></div>');
            i++;
        });
        function deleteProducttype(id){
            $( "#delete_type"+id ).remove();
        }
    </script>
    <script type="text/javascript">
        $("#editor1").keyup(function(){
                $("#error_plan_desc").html("");
            });
        $(document).on('submit', '#add-category-form', function(event) {
            var editor1 = CKEDITOR.instances.editor1.getData();
            if(editor1 == ""){
               $("#error_plan_desc").html("<code>Please enter the description</code>");
                return false;
            }
            event.preventDefault();
            $.ajax({
                url: "code/add_product.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                 beforeSend: function(){
                       $('.loader').show()
                   },
                success: function(response) {
                    console.log(response);
                    var obj = jQuery.parseJSON(response);
                    if (obj.error == 'success')
                    {
                       swal({
                           title: 'Product has been inserted successfully',
                           text: "",
                           type: 'success',
                           timer: 3000,
                           padding: '2em',
                           onOpen: function () {
                               swal.showLoading()
                           }
                       }).then(function (result) {
                            $(this).trigger('reset');
                            location.reload();
                       })
                    }
                    else if(obj.error == 'updateSuccess')
                    {
                        swal({
                                title: 'Product has been updated successfully',
                                  text: "",
                                  type: 'success',
                                timer: 3000,
                                padding: '2em',
                                onOpen: function () {
                                  swal.showLoading()
                                }
                              }).then(function (result) {
                                location.reload();
                          })
                    } 
                    else
                    {
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
        $(document).on('click', '.updateSubCategory', function() {
            $('.add-cat-box').show();
            $('#category-list-box').hide();
            $("#img-list").html('');
            var cat_id = $(this).attr("id");
            $.ajax({
                url: "code/update_product.php",
                method: "POST",
                data: {
                    cat_id: cat_id
                },
                dataType: "json",
                success: function(data) {
                    $('#validationCustom05').val(data.cat_name);
                    $('#selected_category').val(data.category_id);
                    /*$('#price').val(data.price);*/
                    CKEDITOR.instances['editor1'].setData(data.description);
                    $('#cat_id').val(cat_id);
                    $('#action').val("Edit");
                    $('#operation').val("Edit");
                    $('#cat_profile').attr('required',false);
                    $('#dummyImg').attr('required',false);
                    get_product_images(cat_id);
                    $.each( data.product_type, function( key, value ) {
                        if(i == 1){
                            $('#product_type_add').html('<div style="display: inline-flex;"><div class="col-md-4 mb-4"><input type="hidden" name="product_edit_type_id[]" value="'+value.product_type_id+'"> <input type="text" class="form-control" id="product_edit_type1" placeholder="Product type (EX: GM,KG)" required name="product_edit_type[]" value="'+value.product_type+'"> </div><div class="col-md-3 mb-4"> <input type="text" class="form-control" id="product_edit_type_qty1" placeholder="Product Quantity" required name="Product_edit_qty[]" value="'+value.Product_qty+'"> </div><div class="col-md-3 mb-4"> <input type="text" class="form-control" id="product_edit_type_price1" placeholder="Product Price" required name="product_edit_type_price[]" value="'+value.product_type_price+'"> </div><div class="col-md-3 mb-4"> <button type="button" class="form-control btn btn-success" id="add_new_product_type">Add</button> </div></div>');
                        } else {
                            $('#product_type_add').append('<div id="delete_edit_type'+i+'" style="display: inline-flex;"><div class="col-md-4 mb-4"> <input type="hidden" name="product_edit_type_id[]" value="'+value.product_type_id+'"><input type="text" class="form-control" id="product_edit_type'+i+'" placeholder="Product type (EX: GM,KG)" required name="product_edit_type[]" value="'+value.product_type+'"> </div><div class="col-md-3 mb-4"> <input type="text" class="form-control" id="product_edit_type_qty'+i+'" placeholder="Product Quantity" required name="Product_edit_qty[]" value="'+value.Product_qty+'"> </div><div class="col-md-3 mb-4"> <input type="text" class="form-control" id="product_edit_type_price'+i+'" placeholder="Product Price" required name="product_edit_type_price[]" value="'+value.product_type_price+'"> </div><div class="col-md-3 mb-4"> <button type="button" class="form-control btn btn-success" onclick="deleteEditProductType('+i+','+value.product_type_id+')" id="delete_new_product_edit_type'+i+'">Delete</button> </div></div>');
                        }
                        i++;
                    });
                }
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.deleteSubCategory', function(e) {
                var cat_id = $(this).attr("id");
                SwalDelete(cat_id);
                e.preventDefault();
            });
        });
        function deleteEditProductType(remove_id,product_type_id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this product type?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(221, 51, 51)',
                cancelButtonColor: '#4ac17d',
                cancelButtonText: "No, cancel please!",
                confirmButtonText: 'Yes, Delete it!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            url: 'code/delete_product_type.php',
                            type: 'POST',
                            data: {product_type_id:product_type_id},
                        })
                            .done(function(response) {
                                swal({
                                    title: 'Product type has been deleted successfully.',
                                    text: "",
                                    type: 'success',
                                    timer: 3000,
                                    padding: '2em',
                                    onOpen: function () {
                                        swal.showLoading()
                                    }
                                }).then(function (result) {
                                    $("#delete_edit_type"+ remove_id).remove();
                                })
                            })
                            .fail(function() {
                                swal('Oops...', 'Something went wrong with ajax !', 'error');
                            });
                    });
                },
            });
        }
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
                                url: 'code/delete_product.php',
                                type: 'POST',
                                data: 'cat_id=' + cat_id,
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal({
                                    title: 'Product has been deleted successfully',
                                    text: "",
                                    type: 'success',
                                    timer: 3000,
                                    padding: '2em',
                                    onOpen: function () {
                                        swal.showLoading()
                                    }
                                }).then(function (result) {
                                    location.reload();
                                }).fail(function () {
                                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                                    });
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
                $("#img-list").html('');
            });
        });
    </script>
    <script type="text/javascript">
       $(document).on('click', '.view_plan_details', function() {
            var id = $(this).attr("id");
            $.ajax({
                url: "code/view_product_details.php",
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
    <script type="text/javascript">
        $(function () {
          $('.input-file-dummy').each(function () {
            $($(this).parent().find('.input-file-btn input')).on('change', {dummy: this}, function(ev) {
              $(ev.data.dummy)
                .val($(this).val().replace(/\\/g, '/').replace(/.*\//, ''))
                .trigger('focusout');
            });
            $(this).on('focusin', function () {
                $(this).attr('readonly', '');
              }).on('focusout', function () {
                $(this).removeAttr('readonly');
              }).on('click', function () {
                $(this).parent().find('.input-file-btn').click();
              });
          });
        });
    </script>
    <script>
        function get_product_images(id){
            $.ajax({
                url:'code/fetch-product-images.php',
                method:'post',
                data:{id:id},
                success:function(data){
                    data.forEach(function(item){
                        $("#img-list").append("<div class='col-md-3 col-xs-6 image_delete' id='"+ item.id +"'><img src='../assets/img/product/"+ item.image + "' style='width:100%;height:200px;object-fit: cover;'><div class='text-center'><a class='btn btn-danger mt-2' onclick='delete_product_image("+ item.id +",\""+ item.image +"\")'>Delete</a></div></div>");
                    });
                },
                error:function(data){
                    console.log(data);
                }
            })
        }

        function delete_product_image(id, image){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this image?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(221, 51, 51)',
                cancelButtonColor: '#4ac17d',
                cancelButtonText: "No, cancel please!",
                confirmButtonText: 'Yes, Delete it!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            url: 'code/delete_product_image.php',
                            type: 'POST',
                            data: {id:id, image:image},
                        })
                            .done(function(response) {
                                swal({
                                    title: 'Image has been deleted successfully.',
                                    text: "",
                                    type: 'success',
                                    timer: 3000,
                                    padding: '2em',
                                    onOpen: function () {
                                        swal.showLoading()
                                    }
                                }).then(function (result) {
                                    $("#"+ id).remove();
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
            $(document).on('click', '.changeStatus', function(e) {
                var id = $(this).attr("id");
                var key = $(this).attr("key");
                SwalStatusChange(id,key);
                e.preventDefault();
            });
        });
        function SwalStatusChange(productId,status) {
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
                        url: 'code/product_status_change.php',
                        type: 'POST',
                        data: {productId:productId,status:status},
                        dataType: 'json'
                    })
                        .done(function(response) {
                            swal({
                                title: 'Status has been changed successfully',
                                text: "",
                                type: 'success',
                                timer: 3000,
                                padding: '2em',
                                onOpen: function () {
                                    swal.showLoading()
                                }
                            }).then(function (result) {
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
