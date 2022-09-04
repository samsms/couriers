<?php if(!isset($conn)){ include 'db_connect.php'; } 
?>
<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-route">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
          <div class="col-md-12">
            <div id="msg" class=""></div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Name</label>
                <input type="text" name="name" id="" class="form-control" value="<?php echo isset($name) ? $name : '' ?>"></input>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Town</label>
                <input type="text" name="town" id="" class="form-control" value="<?php echo isset($town) ? $town : '' ?>"></input>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">County</label>
                <input type="text" name="county" class="form-control" value="<?php echo isset($county) ? $county : '' ?>"></input>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Inbound/Outbound</label>
                <select name="inbound_outbound" id="inbound_outbound" class="form-control select2" required="">
                     <?php 
                  $result = array(array("id"=>"O", "name"=>"Outbound"), array("id"=>"I", "name"=>"Inbound"));
                    foreach($result as $val):
                ?>
                  <option value="<?php echo $val['id'] ?>" <?php echo isset($inbound_outbound) && $inbound_outbound == $val['id'] ? "selected":'' ?>><?php echo ucwords($val['name']) ?></option>
                <?php endforeach; ?>
        
              </select>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Status</label>
                <select name="active" id="active" class="form-control select2" required="">
                <?php 
                  $statuses = array(array("id"=>"1", "name"=>"Active"), array("id"=>"2", "name"=>"Inactive"));
                    foreach($statuses as $val):
                ?>
                  <option value="<?php echo $val['id'] ?>" <?php echo isset($active) && $active == $val['id'] ? "selected":'' ?>><?php echo ucwords($val['name']) ?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>

          </div>
        </div>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-route">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=route_list">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<script>
	$('#manage-route').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_route',
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
              location.href = 'index.php?page=route_list'
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