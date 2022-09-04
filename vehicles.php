<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Loading{
public $used=[];
function empty_vehicles(){
	include'db_connect.php';
	$vehicles=[];
	$chk =  $conn->query("SELECT * FROM vehicle where loaded=0 " );
	while ($row=mysqli_fetch_assoc($chk)) {
		$vehicles[]=$row;

	}
	return $vehicles;
}
function getRouteName($id){
	include'db_connect.php';

	$chk =  $conn->query("SELECT * FROM route where id=$id" );
	$row=mysqli_fetch_assoc($chk);
	return $row['name'];
}
function getTempParcelsRoutes(){
	include'db_connect.php';
	$var=[];
	$chk =  $conn->query("SELECT customer.route as route FROM parcels join customer on parcels.customer_id=customer.id where loaded=0  " );
	while ($row=mysqli_fetch_assoc($chk)) {
		$var[]=$row['route'];

	}

	return array_unique($var);
}
function getTempParcels($route){
	include'db_connect.php';
	$var=[];
	$chk =  $conn->query("SELECT *, parcels.id as pid FROM parcels inner join customer on parcels.customer_id=customer.id where loaded=0  and customer.route=$route" );
	while ($row=$chk->fetch_assoc()) {
		$var[]=$row;

	}
	$arr=$var;
	// if(count($var)>4){
	// 		$arr=array_chunk($var,4);
	// 	}
	//die(json_encode($var));
	return $arr;
}
function compute_vehicle($route){

		$cont=0;
	$vehicles_list=$this->empty_vehicles();
	//die(json_encode($vehicles_list));
	$weight=[];
	$parcel_id=[];
	$arr=$this->getTempParcels($route);
	// if(count($this->getTempParcels($route)>4){
	// 	$arr=array_chunk($this->getTempParcels($route),4);
	// }
// echo json_encode(array_chunk($arr));exit;
	foreach($arr as $pacel){
		// $arr=$pacel;
		// die(print_r($pacel['weight']));
		
		 $weight[]=$pacel['weight'];
		 $parcel_id[]=$pacel['pid'];
	}
	$weight_sum=array_sum($weight);
	//echo(json_encode($weight));
	$vehicles_choosen=[];
	//die(json_encode(getTempParcels($id)));

	foreach($vehicles_list as $vehicle){
			extract($vehicle);
			
	// foreach($this->used as $v){
			
	// 		if($v==$id){
	// 			$cont=1;

	// 		}	
	// 	}
	// 		if($cont==1){
	// 			continue;
	// 		}
	
		if($capacity_weight>$weight_sum&&!in_array($id, $this->used)){

			if($cont<3){
				$cont++;

			}
			else{
				continue;
			}
			$percentage=$weight_sum/$capacity_weight*100;
			$vehicles_choosen[]=array("parcels"=>$parcel_id,"vehicle"=>$vehicle,"percentage"=>$percentage,"route"=>$this->getRouteName($route));
			$this->used[]=$id;
			//die($this->getRouteName($route));
			//echo $this->getRouteName($route);exit;
			break;

		}
		

		




	}

	//die("s".count($vehicles_choosen));
	// if(count($vehicles_choosen)==0){
	// 	$vehicles_weight=[];
	// 	foreach($vehicles_list as $vehicle){
	// 	extract($vehicle);
	// 	 		$vehicles_weight[]=$capacity_weight;


	// 		}
	// 	$vehicles_weight=$vehicles_weight;
	// 	$id=0;
	// 	$fully_packed=0;
	// 	$vehicle_full=0;
		
	// 	while ($fully_packed==0) {

	// 		 $vehicles_to_pack=[];
	// 		 $packed_weight=0;
	// 		 $full=0;
	// 		 $v=0;
	// 		 $stack=[];
	// 		 while($full<5){
	// 		 	//die(json_encode($vehicles_weight));
	// 		 	if($vehicles_weight[$v]>$packed_weight){
	// 		 		if($packed_weight+$weight[$id]<=$vehicles_weight[$v]){
	// 		 		$vehicles_to_pack[$v][]=$parcel_id[$id];
	// 		 		$packed_weight+=$weight[$id];
	// 				$stack[]=$weight[$id];
	// 				$full++;
	// 		 		}
	// 		 		else{
	// 		 			$full++;
	// 		 		}
	// 			$full++;
	// 			}
				
				
	// 			//$full=1;
				

	// 			$id++;


	// 		 }
			

	// 		 $vehicles_choosen[]=array("parcels"=>$stack,"vehicles"=>$v);
	// 		  $packed_weight=0;
	// 		  $stack=[];
	// 		 $fully_packed=1;
	// 		  $v++;
	// 	}



	// 	}
	// }else{
	// 	$vehicles_choosen[]=array("number"=>1,$vehicles_choosen);
	// }
	
	return $vehicles_choosen ;
}
function load(){
	$parcels=[];

	foreach ($this->getTempParcelsRoutes() as $route){
		$parcels[]=$this->compute_vehicle($route);
	}
	return $parcels;
}
}
$fun=new Loading();
//die(print_r(getTempParcelsRoutes()));
$package=$fun->load();
//echo json_encode($package);
?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=new_vehicle"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Route id</th>
						<th>Parcels</th>
						<th>Vehicles</th>
						<th>Percentage occupied</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				
					<?php foreach ($package as $p){?>
					<tr>
						<td class="text-center"></td>
						<td class="">
							<?php
							foreach($p as $parcels){
								echo($parcels['route']) ;
									break;
							}?>
						</td>
						<td><?php 

							foreach($p as $parcels){
								$i=0;
								foreach($parcels['parcels'] as $v){
									if($i<1){
										echo $v;
									}
									else{
										echo ",". $v;
									}
									$i++;
							}
							echo "<br>";
									//echo print_r();
						}
						?>
							

						</td>
						<td>
							<?php 

							foreach($p as $parcels){
								extract($parcels['vehicle']) ;
									echo $plate;
							
						echo "<br>";
									//echo print_r();
						}?>
						</td>
						<td><?php
							foreach($p as $parcels){
								echo(round($parcels['percentage']))."% full" ;
									echo "<br>";
							}
						?>
						</td>
						<td class="text-center">
		                    <div class="btn-group">
		                        <a href="index.php?page=edit_vehicle&id=" class="btn btn-primary btn-flat ">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-flat delete_vehicle" data-id="">
		                          <i class="fas fa-trash"></i>
		                        </button>
	                      </div>
						</td>
					</tr>	
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table td{
		vertical-align: middle !important;
	}
</style>