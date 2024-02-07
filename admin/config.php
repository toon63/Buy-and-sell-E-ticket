<?php
	// $info = array(
	// 	'host' => 'localhost',
	// 	'user' => 'root',
	// 	'password' => '',
	// 	'dbname' => 'sudigite_2428'
	// );
	// $con = mysqli_connect($info['host'],$info['user'],$info['password'],$info['dbname']) or die("Connection failed:");
	// mysqli_set_charset($con, "utf8");
	// date_default_timezone_set("Asia/Bangkok");
	
	$info = array(
		'host' => 'localhost',
		'user' => 'sudigite_2428',
		'password' => '028304024',
		'dbname' => 'sudigite_2428'
	);
	$con = mysqli_connect($info['host'],$info['user'],$info['password'],$info['dbname']) or die("Connection failed:");
	mysqli_set_charset($con, "utf8");
	date_default_timezone_set("Asia/Bangkok");
?>