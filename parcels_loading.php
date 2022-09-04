<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include'db_connect.php';
$parcel_loading=[];
	$chk = $conn->query("SELECT * FROM vehicle where loaded=0 " );
	while ($row=mysqli_fetch_assoc($chk)) {
		$parcel_loading[]=$row;

	}
	echo json_encode($vehicles);