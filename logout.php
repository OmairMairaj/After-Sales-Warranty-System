<?php
	session_start();
	$serverName = 'localhost';
	$userName = 'omer_shakeel_17902';
	$password = '123456';
	$database = 'omair_mairaj_17849';
    $conn = mysqli_connect($serverName,$userName,$password,$database);
	
		echo "<script>window.open('login.php','_self');</script>";
		
	session_destroy();
	?>