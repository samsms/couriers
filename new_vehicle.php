<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-vehicle">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
          <div class="col-md-12">
            <div id="msg" class=""></div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Vehicle Category</label>
                <input type="text" name="plate" id="plate" class="form-control" value="<?php echo isset($plate) ? $plate : '' ?>"></input>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Weight Capacity</label>
                <input type="text" name="capacity_weight" id="" class="form-control" value="<?php echo isset($capacity_weight) ? $capacity_weight : '0' ?>"></input>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Volume Capacity</label>
                <input type="text" name="capacity_vol" class="form-control" value="<?php echo isset($capacity_vol) ? $capacity_vol : '0' ?>"></input>
              </div>
               <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Litre Capacity</label>
                <input type="text" name="capacity_ltr" class="form-control" value="<?php echo isset($capacity_ltr) ? $capacity_ltr : '0' ?>"></input>
              </div>
            </div>

          </div>
        </div>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-vehicle">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=vehicle_list">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<script>
	$('#manage-vehicle').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_vehicle',
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
              location.href = 'index.php?page=vehicle_list'
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