<?php
	session_start();
	unset($_SESSION['adminId']);
	session_destroy();
	header("Location:../index.php");
?>    