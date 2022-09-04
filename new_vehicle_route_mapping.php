<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-vehicle-route-mapping">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
          <div class="col-md-12">
            <div id="msg" class=""></div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Vehicle</label>
                <select name="vehicle" id="vehicle" class="form-control input-sm select2">
                  <option value=""></option>
                  <?php
                    $vehicles = $conn->query("SELECT * FROM vehicle");
                    while($row = $vehicles->fetch_assoc()):
                  ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($vehicle) && $vehicle == $row['id'] ? "selected":'' ?>><?php echo $row['plate'] ?></option>
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
                <label for="" class="control-label">Day</label>
                <input type="date" name="day" id="day" class="form-control" value="<?php echo isset($day) ? $day : '' ?>"></input>
              </div>
              
            </div>
            
        </div>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-vehicle-route-mapping">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=vehicle_route_mapping">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<script>
	$('#manage-vehicle-route-mapping').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_vehicle_route_mapping',
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
              location.href = 'index.php?page=vehicle_route_mapping'
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