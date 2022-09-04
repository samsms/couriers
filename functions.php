<?php
$qry = $conn->query("SELECT * FROM parcels where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
if($to_branch_id > 0 || $from_branch_id > 0){
	$to_branch_id = $to_branch_id  > 0 ? $to_branch_id  : '-1';
	$from_branch_id = $from_branch_id  > 0 ? $from_branch_id  : '-1';
$branch = array();
 $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches where id in ($to_branch_id,$from_branch_id)");
    while($row = $branches->fetch_assoc()):
    	$branch[$row['id']] = $row['address'];
	endwhile;
}

function getApprovedParcelById($id,$conn){
     $branches = $conn->query("SELECT id FROM parcels where id = ".$id." and sm=1 and ls=1 and fo=1 and lm=1");
    while($row = $branches->fetch_assoc()):
      $approved=$row["id"];
	endwhile;

    if($approved >0){ return TRUE;}
    else{ return FALSE;}
}