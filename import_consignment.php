<?php include'db_connect.php';
session_start();
?>
<div class="col-lg-12">
    <?php 

    if(isset($_SESSION['import_csv'])&& $_SESSION['import_csv']=="success"){
        echo '<div class="alert alert-success">The data was imported successfully</div>';
        
    }
   
    else if(isset($_SESSION['import_csv'])&& $_SESSION['import_csv']=="error"){
          echo '<div class="alert alert-danger">'.$_SESSION['desc_error'].'</div>';
    }
    unset($_SESSION['import_csv']);
    unset($_SESSION['desc_error']);
    ?>
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="assets/uploads/data.csv" download><i class="fa fa-download"></i> Import Consignment Data (csv) template</a>
			</div>
		</div>
		<div class="card-body">
		    <form class="form" action="uploadcons.php" enctype="multipart/form-data" method="POST">
		<label class="form-label" for="customFile">Your Csv file(reference_number, customer_id, vehicle, lpo_date, purchase_order, branch_id, weight, w_unit, warehouse)</label>
<input type="file" class="form-control" name="file" id="customFile" />
<hr>
<input type="submit" class="right success" value="Upload File">
</form>
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
		$('.view_staff').click(function(){
			uni_modal("staff's Details","view_staff.php?id="+$(this).attr('data-id'),"large")
		})
	$('.delete_staff').click(function(){
	_conf("Are you sure to delete this staff?","delete_staff",[$(this).attr('data-id')])
	})
	})
	function delete_staff($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_staff',
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