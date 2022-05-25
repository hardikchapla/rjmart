<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 // Defining base url
    if($_SERVER['HTTP_HOST'] == "localhost"){
        define("BASE_URL", "http://localhost/rjmart/");
    } else {
        define("BASE_URL", "https://uniformedtech.com/rjmart/");
    }

    define('DATE_FORMAT_YMD', 'Y-m-d H:i:s');
    define('DEVICE_TYPE_ANDROID', 'ANDROID');
    define('DEVICE_TYPE_IOS', 'IOS');
    define('IS_PRODUCT_DEVELOPMENT_MODE', false);
    define('APP_NAME', 'RJ Mart');
    define('DATE_TIME_ZON', 'UTC');
    define('PASSWORD_RECOVERY', 'RJ Mart APP Password Recovery');
    define('QUERY_RESPONSE', 'Response about your query');
    define('RESET_LINK', BASE_URL.'admin/admin_reset_password.php');
    define('RESET_LINK_USER', BASE_URL.'reset-password.php');
    define('VERIFY_LINK', BASE_URL.'verify-email.php');
    define('FAVICON', 'assets/img/favicon.png');

    if (IS_PRODUCT_DEVELOPMENT_MODE):
        // EMAIL SETUP
        define('MAIL_FROM', 'admin@gmail.com');
        define('MAIL_FROM_NAME', 'RJMART');
        define('MAIL_HOST', 'smtp.gmail.com');
        define('MAIL_USERNAME', 'info.artechdev@gmail.com');
        define('MAIL_PASSWORD', 'ducfbawbzfhwljkp');
        define('MAIL_SMTP_SECURE', 'tls'); // SSL OR TLS
        define('MAIL_SMTP_PORT', '587');
	else:
        // EMAIL SETUP
        define('MAIL_FROM', 'admin@gmail.com');
        define('MAIL_FROM_NAME', 'RJMART');
        define('MAIL_HOST', 'smtp.gmail.com');
        define('MAIL_USERNAME', 'info.artechdev@gmail.com');
        define('MAIL_PASSWORD', 'ducfbawbzfhwljkp');
        define('MAIL_SMTP_SECURE', 'tls'); // SSL OR TLS
        define('MAIL_SMTP_PORT', '587');
    endif;

    define('IS_DEBUG_MODE', TRUE);
    if (IS_DEBUG_MODE):
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        ini_set("error_reporting", E_ALL ^ E_NOTICE);
        
        ini_set('display_errors', 1);
    else:
        error_reporting(0);    
    endif;