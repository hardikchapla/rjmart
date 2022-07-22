<?php
	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */
	 // error_reporting(0);
 	//  ob_start();
    session_start();
	// date_default_timezone_set('UTC');
	date_default_timezone_set('Asia/Kolkata');

	if($_SERVER['HTTP_HOST'] == "localhost"){
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$databaseName = 'rjmart';
	} elseif ($_SERVER['HTTP_HOST'] == "rjmart.store") {
        $servername = 'localhost';
		$username = 'u818658830_rjmart';
		$password = 'f?c/q:ojP3';
		$databaseName = 'u818658830_rjmart';
	} else {
		$servername = 'localhost';
		$username = 'u269128924_rjmart';
		$password = '?lra8Tm#';
		$databaseName = 'u269128924_rjmart';
	}
	// Create connection
	$db = new PDO( 'mysql:host='.$servername.';dbname='.$databaseName, $username, $password );
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("SET NAMES utf8");
	//echo "Connected successfully";
?>