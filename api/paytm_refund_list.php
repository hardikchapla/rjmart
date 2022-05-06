<?php
/*
* import checksum generation utility
* You can get this utility from https://developer.paytm.com/docs/checksum/
*/
require_once("../libraries/paytm_new/PaytmChecksum.php");

$paytmParams = array();

$paytmParams["body"] = array(
    "mid"         => "tHrtod31123741500604",
    "isSort"      => "true",
    "startDate"   => "2020-06-01T00:34:00+05:30",
    "endDate"     => "2020-06-30T14:35:24+05:30",
    "pageSize"    => 10,
    "pageNum"     => 1
);

/*
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "mcwOj_bogaHTbfdu");

$paytmParams["head"] = array(
     "signature"      => $checksum
);

$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
$url = "https://securegw-stage.paytm.in/merchant-passbook/api/v1/refundList";

/* for Production */
// $url = "https://securegw.paytm.in/merchant-passbook/api/v1/refundList";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
$response = curl_exec($ch);
print_r($response);