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
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/media.css">
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <style>
    .form-form {
        width: 100% !important;
    }
    </style>
</head>

<body class="form" style="overflow: hidden !important;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-container outer">
                    <div class="form-form">
                        <div class="form-form-wrap">
                            <div class="form-container">
                                <div class="form-content">
                                    <h1 class="">Sign In</h1>
                                    <p class="">Log in to your account to continue.</p>
                                    <form class="text-left" method="post" name="login-form" id="login-form">
                                        <div class="form">
                                            <div id="username-field" class="field-wrapper input">
                                                <label for="username">USERNAME</label>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-user">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <input id="username" name="username" type="text" class="form-control"
                                                    placeholder="e.g John_Doe" required>
                                            </div>
                                            <div id="password-field" class="field-wrapper input">
                                                <div class="d-flex justify-content-between">
                                                    <label for="password">PASSWORD</label>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-lock">
                                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                </svg>
                                                <input id="password" name="password" type="password"
                                                    class="form-control" placeholder="Password" required>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    id="toggle-password" class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </div>
                                            <div class="text-right">
                                                <a href="forgot-password.php" class="forgot-pass-link">Forgot
                                                    Password?</a>
                                            </div>
                                            <div class="d-sm-flex justify-content-between mt-3">
                                                <div class="field-wrapper">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-theme-color login-btn" value="">Log
                                                        In</button>
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
        $("#login-form").on('submit', function(e) {
            e.preventDefault();
            var username = $("#username").val();
            var password = $("#password").val();
            var form_data = "username=" + username + "&password=" + password;
            $.ajax({
                url: 'code/login',
                type: 'Post',
                data: form_data,
                cache: false,
                success: function(output) {
                    var obj = $.parseJSON(output);
                    if (obj.success == "success") {
                        swal({
                            title: 'You have been logged in',
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
                                window.location.href = 'dashboard.php';
                            }
                        })
                    } else if (obj.success == "fail") {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'username or password is wrong!',
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