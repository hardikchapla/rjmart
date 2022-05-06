<?php
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
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />

    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
</head>

<body class="form">
    <div class="form-container outer login-bg">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Reset</h1>
                        <p class="">Reset Your Password</p>
                        <form class="text-left" method="post" name="reset-form" id="reset-form">
                            <div class="form">
                                <input type="hidden" id="Email" name="Email"
                                    value="<?= base64_decode($_REQUEST['Email']) ?>" class="form-control" />
                                <input type="hidden" id="old-Password" name="old-Password"
                                    value="<?= $_REQUEST['Password'] ?>" class="form-control" />
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="Password">
                                </div>
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="confirm-password">CONFIRM PASSWORD</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="confirm-password" name="confirm-password" type="password"
                                        class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary btn-theme-color login-btn"
                                            value="">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-2.js"></script>
    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/sweetalerts/custom-sweetalert.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#reset-form").on('submit', function(e) {
            e.preventDefault();
            var Email = $("#Email").val();
            var Password = $("#old-Password").val();
            var New_Password = $("#password").val();
            var confirm_password = $("#confirm-password").val();
            var form_data = "Email=" + Email + "&Password=" + Password + "&New_Password=" +
                New_Password + "&confirm_password=" + confirm_password;
            $.ajax({
                url: 'code/adminresetpassword',
                type: 'Post',
                data: form_data,
                cache: false,
                success: function(output) {
                    var obj = $.parseJSON(output);
                    if (obj.success == "success") {
                        swal({
                            title: 'Your Password has been changed',
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
                                window.location.href = 'index.php';
                            }
                        })
                    } else if (obj.success == "fail") {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'new password & confirm password are not same',
                            padding: '2em'
                        })
                        return false;
                    }
                },
            });
        });
    });
    </script>
</body>

</html>