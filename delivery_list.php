<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="consignment-list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Delivery No.</th>
						<th>Recipient</th>
						<th>Vehicle</th>
						<th>Purchase Order No.</th>
						<th>Branch</th>
						<th>County</th>
						<th>Total Weight</th>
						<th>W. Unit</th>
						<th>Delivery Note</th>
						<th>Invoice</th>
						<!--<th>Status</th>-->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				
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
		$('#list').dataTable();
	
	$('.approve_parcel').click(function(){
	_conf("Are you sure to approve this consignment?","approve_parcel",[$(this).attr('data-id')])
	})
	
	})
	
	fetchConsignments();
	
	function fetchConsignments(){
	    
	     $.ajax({
			url:'ajax.php?action=get_delivery',
			method:'POST',
			data: null,
			error:err=>{
				console.log(err)
				alert_toast("An error occured while fetching consignments",'error')
				end_load()
			},
			success:function(resp){
				if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
					resp = JSON.parse(resp);
					var response = resp['consignments'];
					//console.log(response);
					if(Object.keys(response).length > 0){
						$('#consignment-list tbody').html('')
						var i =1;
						var selected_capacity = 0;
						var capacity = resp['capacity_weight'];
						
						Object.keys(response).map(function(k){
							var tr = $('<tr></tr>')
							tr.append('<td>'+(i++)+'</td>')
							tr.append('<td>'+(response[k].reference_number)+'</td>')
							tr.append('<td>'+(response[k].recipient_name)+'</td>')
							tr.append('<td>'+(response[k].plate)+'</td>')
							tr.append('<td>'+(response[k].purchase_order)+'</td>')
							tr.append('<td>'+(response[k].street)+'</td>')
							tr.append('<td>'+(response[k].city)+'</td>')
							tr.append('<td>'+(response[k].weight)+'</td>')
							tr.append('<td>'+(response[k].w_unit)+'</td>')
							tr.append('<td><a href="https://techsavanna.technology/courier/'+(response[k].delivery_note)+'">Delivery Note</a></td>')
							tr.append('<td><a href="https://techsavanna.technology/courier/'+(response[k].invoice)+'">Invoice</a></td>')
							
							var td = $('<td></td>')
							var div = $('<div class="btn-group"></div>')
							div.append('<button type="button" class="btn btn-warning btn-flat view_parcel" onclick="view_parcel('+response[k].id+')" ><i class="fas fa-eye"></i></button>')
							/*div.append('<a href="index.php?page=edit_consignment&id='+(response[k].id)+' " class="btn btn-primary btn-flat"><i class="fas fa-edit"></i></a>')
							div.append('<button type="button" class="btn btn-danger btn-flat delete_parcel" onclick="delete_parcel('+(response[k].id)+')"><i class="fas fa-trash"></i></button>')*/
							
    						td.append(div)
    						tr.append(td)
						
							$('#consignment-list tbody').append(tr)
						})
    
					}else{
						$('#consignment-list tbody').html('')
							var tr = $('<tr></tr>')
							tr.append('<th class="text-center" colspan="9">No result found.</th>')
							$('#consignment-list tbody').append(tr)
					}
				}
			}
			,complete:function(){
				end_load()
			}
			})
	}
	
	   function view_parcel(id){
			uni_modal("Parcel's Details","view_parcel.php?id="+id,"large")
		}
		
		function delete_parcel(id){
			_conf("Are you sure to delete this consignment?","delete_parcel", id)
		}
		
	
	function approve_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=approve_parcel',
			method:'POST',
			data: $id,
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully confirmed",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}else{
				    	alert_toast("Approval failed! Check if previous approvals were successful",'error')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
	
	function delete_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_parcel',
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