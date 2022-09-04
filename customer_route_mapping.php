<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
		    	<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=new_customer_route_mapping"><i class="fa fa-plus"></i> Map Customer To Route</a>
			</div>
			</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Customer</th>
						<th>Route</th>
						<th>Outbound Priority</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT cr.id as id, cr.outbound_priority as priority, r.name as route, c.name as customer FROM customer_route cr left join route r on r.id = cr.route left join customer c on c.id = cr.customer");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td class=""><?php echo $row['customer'] ?></td>
						<td><?php echo ucwords($row['route']) ?></td>
						<td><?php echo ucwords($row['priority']) ?></td>
						<td class="text-center">
		                    <div class="btn-group">
		                        <a href="index.php?page=edit_customer_route_mapping&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat ">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-flat delete_customer_route_mapping" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
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
<script>
	$(document).ready(function(){
		$('#list').dataTable()
		$('.view_branch').click(function(){
			uni_modal("branch's Details","view_branch.php?id="+$(this).attr('data-id'),"large")
		})
	$('.delete_customer_route_mapping').click(function(){
	_conf("Are you sure to delete this customer route mapping?","delete_customer_route_mapping",[$(this).attr('data-id')])
	})
	})
	function delete_customer_route_mapping($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_customer_route_mapping',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>