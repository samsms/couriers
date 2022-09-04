<?php
ob_start();
date_default_timezone_set("Asia/Manila");

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}

if($action == 'approve_parcel'){
	$approve_parcel = $crud->approve_parcel();
	if($approve_parcel)
		echo $approve_parcel;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}

if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'update_user'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'save_vehicle_route_mapping'){
	$save = $crud->save_vehicle_route_mapping();
	if($save)
		echo $save;
}
if($action == 'save_customer_route_mapping'){
	$save = $crud->save_customer_route_mapping();
	if($save)
		echo $save;
}
if($action == 'delete_vehicle_route_mapping'){
	$save = $crud->delete_vehicle_route_mapping();
	if($save)
		echo $save;
}
if($action == 'save_branch'){
	$save = $crud->save_branch();
	if($save)
		echo $save;
}
if($action == 'save_customer'){
	$save = $crud->save_customer();
	if($save)
		echo $save;
}
if($action == 'save_route'){
	$save = $crud->save_route();
	if($save)
		echo $save;
}
if($action == 'save_vehicle'){
	$save = $crud->save_vehicle();
	if($save)
		echo $save;
}
if($action == 'delete_customer_route_mapping'){
	$save = $crud->delete_customer_route_mapping();
	if($save)
		echo $save;
}
if($action == 'delete_customer'){
	$save = $crud->delete_customer();
	if($save)
		echo $save;
}
if($action == 'delete_branch'){
	$save = $crud->delete_branch();
	if($save)
		echo $save;
}
if($action == 'delete_vehicle'){
	$save = $crud->delete_vehicle();
	if($save)
		echo $save;
}
if($action == 'delete_route'){
	$save = $crud->delete_route();
	if($save)
		echo $save;
}
if($action == 'save_parcel'){
	$save = $crud->save_parcel();
	if($save)
		echo $save;
}
if($action == 'delete_parcel'){
	$save = $crud->delete_parcel();
	if($save)
		echo $save;
}
if($action == 'update_parcel'){
	$save = $crud->update_parcel();
	if($save)
		echo $save;
}
if($action == 'get_parcel_heistory'){
	$get = $crud->get_parcel_heistory();
	if($get)
		echo $get;
}

if($action == 'get_report'){
	$get = $crud->get_report();
	if($get)
		echo $get;
}
if($action == 'get_routes'){
	$get = $crud->get_routes();
	if($get)
		echo $get;
}
if($action == 'get_consignments'){
	$get = $crud->get_consignments();
	if($get)
		echo $get;
}
if($action == 'get_transits'){
	$get = $crud->get_transits();
	if($get)
		echo $get;
}
if($action == 'transit_consignments'){
	$get = $crud->transit_consignments();
	if($get)
		echo $get;
}
if($action == 'deliver_consignments'){
	$get = $crud->deliver_consignments();
	//if($get)
		echo $get;
}
if($action == 'get_delivery'){
	$get = $crud->get_delivery();
	if($get)
		echo $get;
}
ob_end_flush();
?>
