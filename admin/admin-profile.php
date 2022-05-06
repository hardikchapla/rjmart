<?php
    include('../connection/connection.php');
    include('../helper/core_function.php');
    include('../helper/constant.php');
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

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
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

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll"
                            data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="general-info" class="section general-info" method="post"
                                        enctype="multipart/form-data">
                                        <?php
                                        $admin = $_SESSION['adminId'];
                                        $profile = $db->query("SELECT * FROM admin WHERE id = '$admin'");
                                        $profile1 = $profile->fetch();
                                    ?>
                                        <div class="info">
                                            <h6 class="mb-0">General Information</h6>
                                            <div class="row">
                                                <div class="col-lg-12 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-2 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                <input type="file" id="file" class="dropify"
                                                                    data-default-file="assets/img/<?= $profile1['avatar'] ?>"
                                                                    data-max-file-size="2M" name="photo" />
                                                                <input type="hidden" id="image" name="image"
                                                                    class="form-control"
                                                                    value="<?= $profile1['avatar'] ?>" />
                                                                <p class="mt-2"><i
                                                                        class="flaticon-cloud-upload mr-1"></i> Upload
                                                                    Picture</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-10 col-md-8 mt-md-0 mt-5">
                                                            <div class="form">
                                                                <div class="row mt-2">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Full Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="fullName" placeholder="Full Name"
                                                                                value="<?= $profile1['name'] ?>"
                                                                                name="fullName">
                                                                            <div id="name_error"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="userName">Username</label>
                                                                            <input type="text" class="form-control"
                                                                                id="userName" placeholder="Username"
                                                                                value="<?= $profile1['username'] ?>"
                                                                                name="userName">
                                                                            <div id="username_error"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="email">Email</label>
                                                                            <input type="email" class="form-control"
                                                                                id="email" placeholder="Email"
                                                                                value="<?= $profile1['email'] ?>"
                                                                                name="email">
                                                                            <div id="email_error"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="number">Number</label>
                                                                            <input type="text" class="form-control"
                                                                                id="number" placeholder="Number"
                                                                                value="<?= $profile1['number'] ?>"
                                                                                name="number">
                                                                            <div id="number_error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <div class="field-wrapper">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-theme-color update-profile"
                                                        value="">Update Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="update-password" class="section contact">
                                        <div class="info">
                                            <h5 class="">Change Password</h5>
                                            <div class="row">
                                                <div class="col-md-12 mx-auto">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="old-password">Old Password</label>
                                                            <input type="password" class="form-control"
                                                                id="old-password" placeholder="Old Password"
                                                                name="old-password">
                                                            <div id="old-pass_error"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="new-password">New Password</label>
                                                            <input type="password" class="form-control"
                                                                id="new-password" placeholder="New Password"
                                                                name="new-password">
                                                            <div id="new-pass_error"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="confirm-password">Confirm New Password</label>
                                                            <input type="Password" class="form-control"
                                                                id="confirm-password" placeholder="Confirm New Password"
                                                                name="confirm-password">
                                                            <div id="confirm-new-pass_error"></div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center mt-4">
                                                        <div class="field-wrapper">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-theme-color change-password"
                                                                value="">Change Password</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script type="text/javascript">
    $(document).ready(function() {
        $("#fullName").keyup(function() {
            $("#name_error").html("");
        });
        $("#userName").keyup(function() {
            $("#username_error").html("");
        });
        $("#email").keyup(function() {
            $("#email_error").html("");
        });
        $("#number").keyup(function() {
            $("#number_error").html("");
        });
        $("#general-info").on('submit', (function(e) {
            var username = $("#userName").val();
            var full_name = $("#fullName").val();
            var email = $("#email").val();
            var number = $("#number").val();
            if (username == "") {
                $("#username_error").html("<code>Please enter a valid username</code>");
                return false;
            }
            if (full_name == "") {
                $("#name_error").html("<code>Please enter a valid full name</code>");
                return false;
            }
            if (email == "") {
                $("#email_error").html("<code>Please enter a valid email</code>");
                return false;
            }
            if (number == "") {
                $("#number_error").html("<code>Please enter a valid number</code>");
                return false;
            }
            e.preventDefault();
            $.ajax({
                url: "code/update_profile",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(success) {
                    var obj = jQuery.parseJSON(success);
                    if (obj.error == 'success') {
                        swal({
                            title: 'Your profile has been updated successfully',
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
                        return true;
                        $('#general-info')[0].reset();
                    } else if (obj.error == 'error') {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'something went wrong!',
                            padding: '2em'
                        })
                        return false;
                    }
                }
            });
        }));
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#old-password").keyup(function() {
            $("#old-pass_error").html("");
        });
        $("#new-password").keyup(function() {
            $("#new-pass_error").html("");
        });
        $("#confirm-password").keyup(function() {
            $("#confirm-new-pass_error").html("");
        });
        $("#update-password").on('submit', (function(e) {
            var old = $("#old-password").val();
            var New = $("#new-password").val();
            var confirmNew = $("#confirm-password").val();
            if (old == "") {
                $("#old-pass_error").html("<code>Please enter old password</code>");
                return false;
            }
            if (New == "") {
                $("#new-pass_error").html("<code>Please enter new password</code>");
                return false;
            }
            if (confirmNew == "") {
                $("#confirm-new-pass_error").html("<code>Please enter confirm new password</code>");
                return false;
            }
            e.preventDefault();
            $.ajax({
                url: "code/admin_change_pass",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(success) {
                    var obj = jQuery.parseJSON(success);
                    if (obj.success == 'success') {
                        swal({
                            title: 'Your password has been changed successfully',
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
                        return true;
                        $('#update-password')[0].reset();
                    } else if (obj.success == 'error') {
                        swal({
                            title: "Warning ?",
                            text: obj.message,
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#EF5350"
                        });
                        return false;
                    } else if (obj.success == 'not_match') {
                        swal({
                            title: "Warning ?",
                            text: obj.message,
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#EF5350"
                        });
                        return false;
                    } else if (obj.success == 'not_valid') {
                        swal({
                            title: "Warning ?",
                            text: obj.message,
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#EF5350"
                        });
                        return false;
                    }
                }
            });
        }));
    });
    </script>
</body>

</html>