<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-customer-route-mapping">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
          <div class="col-md-12">
            <div id="msg" class=""></div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Customer</label>
                <select name="customer" id="customer" class="form-control input-sm select2">
                  <option value=""></option>
                  <?php
                    $customers = $conn->query("SELECT * FROM customer");
                    while($row = $customers->fetch_assoc()):
                  ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($customer) && $customer == $row['id'] ? "selected":'' ?>><?php echo $row['name'] ?></option>
                <?php endwhile; ?>
                </select>
              </div>
            
            <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Route</label>
                <select name="route" id="route" class="form-control input-sm select2">
                  <option value=""></option>
                  <?php
                    $routes = $conn->query("SELECT * FROM route");
                    while($row1 = $routes->fetch_assoc()):
                  ?>
                  <option value="<?php echo $row1['id'] ?>" <?php echo isset($route) && $route == $row1['id'] ? "selected":'' ?>><?php echo $row1['name'] ?></option>
                <?php endwhile; ?>
                </select>
              </div>

          </div>
          
          <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Outbound Prority</label>
                <input type="number" name="outbound_priority" id="outbound_priority" class="form-control" value="<?php echo isset($outbound_priority) ? $outbound_priority : '' ?>"></input>
              </div>
              
            </div>
            
        </div>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-customer-route-mapping">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=customer_route_mapping">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<script>
	$('#manage-customer-route-mapping').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_customer_route_mapping',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
              location.href = 'index.php?page=customer_route_mapping'
					},2000)
				}
			}
		})
	})
  function displayImgCover(input,_this) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#cover').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>