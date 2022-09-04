<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<a class="btn btn-primary" id="continue" ><i class="fa fa-check"></i> Confirm Delivery</a>
			
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="consignment-list">
				<thead>
					<tr>
					    <th></th>
						<th class="text-center">#</th>
						<th>Delivery No.</th>
						<th>Recipient</th>
						<th>Vehicle</th>
						<th>Purchase Order No.</th>
						<th>Branch</th>
						<th>County</th>
						<th>Total Weight</th>
						<th>W. Unit</th>
						<th>Status</th>
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
 var ids="";
	 var session_id 
	$(document).ready(function(){
		$('#list').dataTable();
	
	$('.approve_parcel').click(function(){
	_conf("Are you sure to approve this consignment?","approve_parcel",[$(this).attr('data-id')])
	})
	
	})
$("#continue").click(function(e){
	  session_id = '<?php echo $_SESSION["system"]["id"] ?>';
       ids=$("input[id^=selected]:checkbox:checked").map(function(){
            return $(this).val();
        });
      
      // var formData = new FormData($('#yourForm')[0]);
       if(ids.get()==""){
           alert_toast("Select at least one consignment",'error');
       }else{
       	ids=ids.get();
		up_file_modal();}

});
 function continue_modal(){
    var form_data=new FormData();
    form_data.append("ids",ids);
    form_data.append("user",session_id);
    form_data.append("delivery_note",$("#delivery_note")[0].files[0])
    form_data.append("invoice",$("#invoice")[0].files[0])
           $.ajax({
			url:'ajax.php?action=deliver_consignments',
			method:'POST',
			data: form_data,
			contentType: false,
    		processData: false,
			error:err=>{
				console.log(err)
				alert_toast("An error occured",'error')
				end_load()
			},
			success:function(resp){
			    console.log(resp);
			    if(resp == 1){
			        alert_toast("Selected consignments delivered successfully",'success')
			        setTimeout(function(){
                      location.reload(); 
                    },1000)
			    }else{
			        alert_toast("An error occured, Please try again!",'error')
			    }
				
			}
			,complete:function(){
				end_load()
			}
		})
           
       }
    
      
	
	fetchConsignments();
	
	function fetchRoutes(){
	    
	    $.ajax({
			url:'ajax.php?action=get_routes',
			method:'POST',
			data: null,
			error:err=>{
				console.log(err)
				alert_toast("An error occured while fetching routes",'error')
				end_load()
			},
			success:function(resp){
			    //console.log("routes "+resp)
				if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
					resp = JSON.parse(resp)
					if(Object.keys(resp).length > 0){
						$('#route').html('')
						Object.keys(resp).map(function(k){
							$('#route').append("<option value='"+resp[k].id+"' >"+(resp[k].name)+"</option>")
						})
					}else{
						$('#route').html('')
							$('#route').append('<option value="">No result found.</option>')
							
					}
				}
				fetchConsignments();
			}
			,complete:function(){
				end_load()
			}
		})
	}
	
	function fetchConsignments(){

	     $.ajax({
			url:'ajax.php?action=get_transits',
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
							tr.append('<td><input type="checkbox" id="selected'+(response[k].id)+'" name="selected[]" value="'+(response[k].id)+'"></td>')
							tr.append('<td>'+(i++)+'</td>')
							tr.append('<td>'+(response[k].reference_number)+'</td>')
							tr.append('<td>'+(response[k].recipient_name)+'</td>')
							tr.append('<td>'+(response[k].plate)+'</td>')
							tr.append('<td>'+(response[k].purchase_order)+'</td>')
							tr.append('<td>'+(response[k].street)+'</td>')
							tr.append('<td>'+(response[k].city)+'</td>')
							tr.append('<td>'+(response[k].weight)+'</td>')
							tr.append('<td>'+(response[k].w_unit)+'</td>')
							
							var classes = (response[k].rc == '1') ? "btn btn-success" : "btn btn-warning";
							
							var td1 = $('<td></td>')
							var div1 = $('<div class="btn-group"></div>')
							div1.append('<button type="button" class="btn-flat '+classes+'" >RC</button>')
							
    						td1.append(div1)
    						tr.append(td1)
    						var role = '<?php echo $_SESSION['login_role'] ?>';
							
							var td = $('<td></td>')
							var div = $('<div class="btn-group"></div>')
							if(role == '3'){
    							div.append('<button type="button" class="btn btn-info btn-flat approve_parcel" onclick="approve_parcel('+response[k].id+')" ><i class="fas fa-check"></i></button>')
							}
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
							tr.append('<th class="text-center" colspan="12">No result found.</th>')
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
			function up_file_modal(){
			uni_mo("Upload delivery note and invoice ","upload_file.php","small")
		}
	
	function approve_parcel(id){
		start_load()
		var role = '<?php echo $_SESSION['login_role'] ?>';
		$.ajax({
			url:'ajax.php?action=approve_parcel',
			method:'POST',
			data: {id: id, role: role},
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