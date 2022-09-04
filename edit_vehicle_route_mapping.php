<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM vehicle_route where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'new_vehicle_route_mapping.php';
?>