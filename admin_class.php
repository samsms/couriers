<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where email = '".$email."' and password = '".md5($password)."'  ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 2;
		}
	}
	
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM students where student_code = '".$student_code."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['rs_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	
	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password'){
					if(empty($v))
						continue;
					$v = md5($v);

				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");

		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
					$_SESSION['login_id'] = $id;
			return 1;
		}
	}

	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_FILES['img']['tmp_name'] != '')
			$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function save_system_settings(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", cover_img = '$fname' ";

		}
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set $data where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set $data");
		}
		if($save){
			foreach($_POST as $k => $v){
				if(!is_numeric($k)){
					$_SESSION['system'][$k] = $v;
				}
			}
			if($_FILES['cover']['tmp_name'] != ''){
				$_SESSION['system']['cover_img'] = $fname;
			}
			return 1;
		}
	}
	function save_image(){
		extract($_FILES['file']);
		if(!empty($tmp_name)){
			$fname = strtotime(date("Y-m-d H:i"))."_".(str_replace(" ","-",$name));
			$move = move_uploaded_file($tmp_name,'../assets/uploads/'. $fname);
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
			$hostName = $_SERVER['HTTP_HOST'];
			$path =explode('/',$_SERVER['PHP_SELF']);
			$currentPath = '/'.$path[1]; 
			if($move){
				return $protocol.'://'.$hostName.$currentPath.'/assets/uploads/'.$fname;
			}
		}
	}
	
	function save_customer_route_mapping(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO customer_route set $data");
		}else{
			$save = $this->db->query("UPDATE customer_route set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	function save_vehicle(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO vehicle set $data");
		}else{
			$save = $this->db->query("UPDATE vehicle set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function save_vehicle_route_mapping(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO vehicle_route set $data");
		}else{
			$save = $this->db->query("UPDATE vehicle_route set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	
	function save_customer(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO customer set $data");
		}else{
			$save = $this->db->query("UPDATE customer set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	function save_route(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO route set $data");
		}else{
			$save = $this->db->query("UPDATE route set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	function save_branch(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$i = 0;
			while($i == 0){
				$bcode = substr(str_shuffle($chars), 0, 15);
				$chk = $this->db->query("SELECT * FROM branches where branch_code = '$bcode'")->num_rows;
				if($chk <= 0){
					$i = 1;
				}
			}
			$data .= ", branch_code='$bcode' ";
			$save = $this->db->query("INSERT INTO branches set $data");
		}else{
			$save = $this->db->query("UPDATE branches set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_vehicle_route_mapping(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM vehicle_route where id = $id");
		if($delete){
			return 1;
		}
	}
	function delete_customer(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM customer where id = $id");
		if($delete){
			return 1;
		}
	}
	function delete_customer_route_mapping(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM customer_route where id = $id");
		if($delete){
			return 1;
		}
	}
	function delete_route(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM route where id = $id");
		if($delete){
			return 1;
		}
	}
	function delete_vehicle(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM vehicle where id = $id");
		if($delete){
			return 1;
		}
	}
	function delete_branch(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM branches where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_parcel(){
		extract($_POST);
		foreach($price as $k => $v){
			$data = "";
			foreach($_POST as $key => $val){
				if(!in_array($key, array('id','weight','w_unit','purchase_order')) && !is_numeric($key)){
					if(empty($data)){
						$data .= " $key='$val' ";
					}else{
						$data .= ", $key='$val' ";
					}
				}
			}
			if(!isset($type)){
				$data .= ", type='2' ";
			}
				$data .= ", w_unit='{$w_unit[$k]}' ";
				$data .= ", purchase_order='{$purchase_order[$k]}' ";
				$data .= ", weight='{$weight[$k]}' ";
			if(empty($id)){
				$i = 0;
				while($i == 0){
					$ref = sprintf("%'012d",mt_rand(0, 999999999999));
					$chk = $this->db->query("SELECT * FROM parcels where reference_number = '$ref'")->num_rows;
					if($chk <= 0){
						$i = 1;
					}
				}
				$data .= ", reference_number='$ref' ";
				if($save[] = $this->db->query("INSERT INTO parcels set $data"))
					$ids[]= $this->db->insert_id;
			}else{
				if($save[] = $this->db->query("UPDATE parcels set $data where id = $id"))
					$ids[] = $id;
			}
		}
		if(isset($save) && isset($ids)){
			// return json_encode(array('ids'=>$ids,'status'=>1));
			return 1;
		}
	}
	function delete_parcel(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM parcels where id = $id");
		if($delete){
			return 1;
		}
	}
	function approve_parcel(){
	    extract($_POST);
	    if($role == "1"){
	       $set = "lm = '1' ";
	    }elseif($role == "2"){
	        $set = "s = '1' ";
	    }elseif($role == "3"){
	        $set = "rc = '1' ";
	    }
	    $query = $this->db->query("SELECT * FROM parcels WHERE id = '$id'");
	    
		if(mysqli_num_rows($query) > 0){
		    $approve = $this->db->query("UPDATE parcels SET $set  WHERE id = '$id'");
			return 1;
    	}else{
    	    return 0;
    	}
	}
	function update_parcel(){
		extract($_POST);
		$update = $this->db->query("UPDATE parcels set status= $status where id = $id");
		$save = $this->db->query("INSERT INTO parcel_tracks set status= $status , parcel_id = $id");
		if($update && $save)
			return 1;  
	}
	function get_parcel_heistory(){
		extract($_POST);
		$data = array();
		$parcel = $this->db->query("SELECT * FROM parcels where reference_number = '$ref_no'");
		if($parcel->num_rows <=0){
			return 2;
		}else{
			$parcel = $parcel->fetch_array();
			$data[] = array('status'=>'Item accepted by Courier','date_created'=>date("M d, Y h:i A",strtotime($parcel['date_created'])));
			$history = $this->db->query("SELECT * FROM parcel_tracks where parcel_id = {$parcel['id']}");
			$status_arr = array("Item Accepted by Courier","Collected","Shipped","In-Transit","Arrived At Destination","Out for Delivery","Ready to Pickup","Delivered","Picked-up","Unsuccessfull Delivery Attempt");
			while($row = $history->fetch_assoc()){
				$row['date_created'] = date("M d, Y h:i A",strtotime($row['date_created']));
				$row['status'] = $status_arr[$row['status']];
				$data[] = $row;
			}
			return json_encode($data);
		}
	}
	//CASE WHEN $status = '1' THEN parcels.sm WHEN $status = '2' THEN parcels.ls //WHEN $status = '3' THEN parcels.fo WHEN $status = '4' THEN parcels.lm //WHEN $status = '5' THEN parcels.s END as status, 
	
	function get_routes(){
		extract($_POST);
		$data = array();
		
		$get = $this->db->query("SELECT route.id as id, route.name as name FROM vehicle_route 
		left join route on route.id = vehicle_route.route 
		where vehicle_route.vehicle = '".$vehicle."' and vehicle_route.day = '".$date."' ");
		
		while($row=$get->fetch_assoc()){
			$row['id'] = ucwords($row['id']);
			$row['name'] = ucwords($row['name']);
			$data[] = $row;
		}
		return json_encode($data);
	}
	
	function get_consignments(){
		extract($_POST);
		
		$data = array();
		$get = $this->db->query("SELECT parcels.id as id,
    		parcels.reference_number as reference_number,
    		customer.name as recipient_name,
    		parcels.purchase_order as purchase_order, 
    		parcels.weight as weight, 
    		parcels.rc as rc,
    		parcels.s as s,
    		parcels.lm as lm,
    		parcels.w_unit as w_unit, 
    		vehicle.plate as plate,
    		branches.street as street, 
    		parcels.lpo_date as lpo_date,
    		branches.city as city from parcels 
    		left join branches on branches.id = parcels.branch_id 
    		left join customer on customer.id = parcels.customer_id
    		left join vehicle on vehicle.id = parcels.vehicle
    		where loaded = '0' and delivered = '0'
    		order by unix_timestamp(parcels.lpo_date) desc, parcels.weight desc ");
	
		while($row=$get->fetch_assoc()){
			$row['id'] = ucwords($row['id']);
			$row['reference_number'] = ucwords($row['reference_number']);
			$row['purchase_order'] = ucwords($row['purchase_order']);
			$row['ls'] = ucwords($row['ls']);
			$row['recipient_name'] = ucwords($row['recipient_name']);
			$row['s'] = ucwords($row['s']);
			$row['weight'] = ucwords($row['weight']);
			$row['plate'] = ucwords($row['plate']);
			$row['w_unit'] = ucwords($row['w_unit']);
			$row['street'] = ucwords($row['street']);
			$row['city'] = ucwords($row['city']);
			$row['lpo_date'] = ucwords($row['lpo_date']);
			$data[] = $row;
		}
		return json_encode(array("consignments"=>$data, "capacity_weight" => $capacity_weight));
	}
	
	function get_transits(){
		extract($_POST);
		$data = array();
		$get = $this->db->query("SELECT parcels.id as id,
    		parcels.reference_number as reference_number,
    		customer.name as recipient_name,
    		parcels.purchase_order as purchase_order, 
    		parcels.lpo_date as lpo_date,
    		parcels.weight as weight, 
    		parcels.rc as rc,
    		parcels.s as s,
    		parcels.lm as lm,
    		parcels.w_unit as w_unit, 
    		vehicle.plate as plate,
    		branches.street as street, 
    		branches.city as city from parcels 
    		left join branches on branches.id = parcels.branch_id 
    		left join vehicle on vehicle.id = parcels.vehicle
    		left join customer on customer.id = parcels.customer_id
    		where loaded = '1' and delivered = '0'
    		order by unix_timestamp(parcels.lpo_date) desc, parcels.weight desc ");
	
		while($row=$get->fetch_assoc()){
			$row['id'] = ucwords($row['id']);
			$row['reference_number'] = ucwords($row['reference_number']);
			$row['purchase_order'] = ucwords($row['purchase_order']);
			$row['weight'] = ucwords($row['weight']);
			$row['rc'] = ucwords($row['rc']);
			$row['plate'] = ucwords($row['plate']);
			$row['w_unit'] = ucwords($row['w_unit']);
			$row['street'] = ucwords($row['street']);
			$row['city'] = ucwords($row['city']);
			$row['lpo_date'] = ucwords($row['lpo_date']);
			$data[] = $row;
		}
		return json_encode(array("consignments"=>$data, "capacity_weight" => $capacity_weight));
	}
	
	function get_delivery(){
		extract($_POST);
		
		$data = array();
		$get = $this->db->query("SELECT parcels.id as id,
		    parcels.delivery_note as delivery_note,
		    parcels.invoice as invoice,
    		parcels.reference_number as reference_number,
    		customer.name as recipient_name,
    		parcels.purchase_order as purchase_order, 
    		parcels.lpo_date as lpo_date,
    		parcels.weight as weight, 
    		parcels.w_unit as w_unit, 
    		vehicle.plate as plate,
    		branches.street as street, 
    		branches.city as city from parcels 
    		left join branches on branches.id = parcels.branch_id 
    		left join vehicle on vehicle.id = parcels.vehicle
    		left join customer on customer.id = parcels.customer_id
    		where loaded = '1' and delivered = '1'
    		order by unix_timestamp(parcels.lpo_date) desc, parcels.weight desc ");
	
		while($row=$get->fetch_assoc()){
			$row['id'] = ucwords($row['id']);
			$row['reference_number'] = ucwords($row['reference_number']);
			$row['plate'] = ucwords($row['plate']);
			$row['purchase_order'] = ucwords($row['purchase_order']);
			$row['weight'] = ucwords($row['weight']);
			$row['w_unit'] = ucwords($row['w_unit']);
			$row['street'] = ucwords($row['street']);
			$row['city'] = ucwords($row['city']);
			$row['lpo_date'] = ucwords($row['lpo_date']);
			$data[] = $row;
		}
		return json_encode(array("consignments"=>$data));
	}
	
	function transit_consignments(){
		extract($_POST);
        /*$signs=explode(",", $ids);*/
        foreach ($ids as $value) {
            $this->db->query("UPDATE parcels SET loaded = '1', loaded_by = '".$user."' WHERE id = '".$value."' ");
        }
		return 1;
	}
	
	function deliver_consignments(){
    	extract($_POST);
		$target_dir = "assets/uploads/delivery/";
     
		$extension1  = pathinfo($_FILES['delivery_note']["name"], PATHINFO_EXTENSION );
		$extension2  = pathinfo($_FILES['invoice']["name"], PATHINFO_EXTENSION );
		
		$basename1   = time() . "_delivery_note." . $extension1;
		$basename2   = time() . "_invoice." . $extension2;
		
		$target_file1 = $target_dir .$basename1;
		$target_file2 = $target_dir .$basename2;
		
		move_uploaded_file($_FILES['delivery_note']['tmp_name'],$target_file1);
		move_uploaded_file($_FILES['invoice']['tmp_name'],$target_file2);
		
		$signs=explode(",", $ids);
		foreach ($signs as $value) {
			 $this->db->query("UPDATE parcels SET delivered = '1', delivery_note = '".$target_file1."', invoice = '".$target_file2."', confirmed_by = '".$user."' WHERE id = '".$value."' ");
		}
		
		return 1;	
			
	}
	
	function get_report(){
		extract($_POST);
		$data = array();
		$get = $this->db->query("SELECT parcels.id as id, parcels.date_created as date_created,parcels.reference_number as reference_number,parcels.purchase_order as purchase_order, parcels.weight as weight, parcels.w_unit as w_unit, branches.street as street, branches.city as city from parcels left join branches on branches.id = parcels.branch_id where date(parcels.date_created) BETWEEN '$date_from' and '$date_to' order by unix_timestamp(parcels.date_created) asc");
	
		while($row=$get->fetch_assoc()){
			$row['reference_number'] = ucwords($row['reference_number']);
			$row['purchase_order'] = ucwords($row['purchase_order']);
			$row['street'] = ucwords($row['street']);
			$row['city'] = ucwords($row['city']);
			$row['weight'] = ucwords($row['weight']);
			$row['w_unit'] = ucwords($row['w_unit']);
			$row['date_created'] = date("M d, Y",strtotime($row['date_created']));
			$data[] = $row;
		}
		return json_encode($data);
	}
}