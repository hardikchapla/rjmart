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
    <link rel="icon" type="image/x-icon" href="<?= FAVICON ?>"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/media.css">
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <style>
        .form-form{
            width:100% !important;
        }
    </style>
</head>
<body class="form no-image-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 login-bg">
                
            </div>
            <div class="col-md-6">
                <div class="form-container outer">
                    <div class="form-form">
                        <div class="form-form-wrap">
                            <div class="form-container">
                                <div class="form-content">
                                    <h1 class="">Password Recovery</h1>
                                    <p class="signup-link recovery">Enter your email and instructions will sent to you!</p>
                                    <form class="text-left" method="post" id="forget-form" name="forget-form">
                                        <div class="form">
                                            <div id="email-field" class="field-wrapper input">
                                                <div class="d-flex justify-content-between">
                                                    <label for="email">EMAIL</label>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                                <input id="email" name="email" type="email" class="form-control" value="" placeholder="Email" required>
                                            </div>
                                            <div class="d-sm-flex justify-content-between">
            
                                                <div class="field-wrapper">
                                                    <button type="submit" class="btn btn-primary btn-theme-color" value="">Reset</button>
                                                </div>
                                            </div>
                                             <div class="login-again">
                                                <span>Did you remember?<a href="index.php" class="forgot-pass-link"> Sign In</a></span>
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
        $("#forget-form").on('submit',function(e){
            e.preventDefault();     
            var email=$("#email").val();
            var data = "email="+email;
            $.ajax({
                url: 'code/forgetpass.php',
                type: 'Post',
                data: data,
                cache: false,
                success: function(success){
                    var obj = $.parseJSON(success);
                    if(obj.success=="success")
                    { 
                        swal({
                            title: 'Mail has been sent',
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
                              console.log('I was closed by the timer')
                              window.location.href = 'index.php';
                            }
                          })
                    }
                    else if(obj.success=="fail")
                    {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'email is wrong!',
                            padding: '2em'
                          })
                        return false;
                    }
                }
            });
        });
    </script>
</body>
</html>