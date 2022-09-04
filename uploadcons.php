<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include'db_connect.php';
$file=$_FILES['file'];
$name=$file['name'];
$type=$file['type'];
$temp_name=$file['tmp_name'];
$size=$file['size'];

if(strtolower(pathinfo($name,PATHINFO_EXTENSION))!='csv'){
    $_SESSION['import_csv']="error";
    $_SESSION['desc_error']="Error occured, only csv files are allowed";
    header("Location:index.php?page=import_consignment");
}else if (!($fp = fopen($temp_name, 'r'))) {
    $_SESSION['import_csv']="error";
    $_SESSION['desc_error']="Error occured when opening the csv file, make sure you upload the right file format";
    header("Location:index.php?page=import_consignment");
    }
    $key = fgetcsv($fp,"1024",",");
    $json = array();
        while ($row = fgetcsv($fp,"1024",",")) {
        $json[] = array_combine($key, $row);
    }
    fclose($fp);
    
    //encode array to json
   //echo json_encode($json);

$data = "";
foreach ($json as $dt){
    $reference_number = $dt['reference_number'];
	$chk = $conn->query("SELECT * FROM parcels where reference_number = '".$reference_number."' ")->num_rows;
	if($chk == 0){
        $date = date('Y-m-d', strtotime($dt['lpo_date']));
	    $data.="reference_number='". $dt['reference_number'] ."' ";
	    $data.=",customer_id='". $dt['customer_id'] ."' ";

	   
	    $data.=",vehicle='". $dt['vehicle'] ."' ";
	    $data.=",lpo_date='". $date ."' ";
	    $data.=",purchase_order='". $dt['purchase_order'] ."' ";
	    $data.=",branch_id='". $dt['branch_id'] ."' ";
	    $data.=",weight='". $dt['weight'] ."' ";
	    $data.=",w_unit='". $dt['w_unit'] ."' ";
	    $data.=",warehouse='". $dt['warehouse'] ."' ";
	}
	 $conn->query("INSERT INTO parcels set $data");
	 
	 $data="";
		
  $_SESSION['import_csv']="success";
}

header("Location:index.php?page=import_consignment");


 
?>