<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-customer">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
          <div class="col-md-12">
            <div id="msg" class=""></div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($name) ? $name : '' ?>"></input>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Location</label>
                <input type="text" name="location" id="location" class="form-control" value="<?php echo isset($location) ? $location : '' ?>"></input>
              </div>
            </div>
          
            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Route</label>
              <select class="form-control" name="route">
                 <option  value="0">Belongs to </option>
                  <?php 
           
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM route");
                    while($row= $qry->fetch_assoc())
                    {
                      extract($row);?>

                      <option  value="<?php echo $id;?>"><?php echo $name?></option>

                      <?php
                    }
                   
                     
                    
                        
            ?>
              </select>
              </div>
             
            </div>


            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Town</label>
                <input type="text" name="town" class="form-control" value="<?php echo isset($town) ? $town : '' ?>"></input>
              </div>
               <div class="col-sm-6 form-group ">
                <label for="" class="control-label">County</label>
                <input type="text" name="county" class="form-control" value="<?php echo isset($county) ? $county : '' ?>"></input>
              </div>
            </div>

          </div>
        </div>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-customer">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=customer_list">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<script>
	$('#manage-customer').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_customer',
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
              location.href = 'index.php?page=customer_list'
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