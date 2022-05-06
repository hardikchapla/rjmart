<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */
	 // error_reporting(0);
 	//  ob_start();
    session_start();
	date_default_timezone_set('UTC');

	$servername = 'localhost';
	$username = 'u806229794_food_app';
	$password = 'Food_App@123';
	$databaseName = 'u806229794_food_app';
	// Create connection
	$db = new PDO( 'mysql:host='.$servername.';dbname='.$databaseName, $username, $password );
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("SET NAMES utf8");
	//echo "Connected successfully";
?>