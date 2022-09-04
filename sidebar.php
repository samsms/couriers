  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="./" class="brand-link">
        <?php if($_SESSION['login_type'] == 1): ?>
        <h3 class="text-center p-0 m-0"><b>ADMIN</b></h3>
        <?php else: ?>
        <h3 class="text-center p-0 m-0"><b>STAFF</b></h3>
        <?php endif; ?>

    </a>
      
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>     
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_branch">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Branch
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">
                <a href="./index.php?page=new_branch" class="nav-link nav-new_branch tree-item">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>New Branch</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="./index.php?page=branch_list" class="nav-link nav-branch_list tree-item">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Branch List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_staff">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Staff Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_staff" class="nav-link nav-new_staff tree-item">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>New Staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=staff_list" class="nav-link nav-staff_list tree-item">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Staff List</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_parcel">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Consignment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <!-- <li class="nav-item">
                <a href="./index.php?page=new_consignment" class="nav-link nav-new_parcel tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>New Consignment</p>
                </a>
              </li>-->
              <li class="nav-item">
            <a href="./index.php?page=import_consignment" class="nav-link nav-import_consignment nav-sall tree-item">
              <i class="nav-icon fas fa-file-import"></i>
              <p>
               Import Consignment
              </p>
            </a>
          </li> 
              <li class="nav-item">
                <a href="./index.php?page=consignment_list" class="nav-link nav-consignment_list nav-sall tree-item">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Consignment List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=transit_list" class="nav-link nav-transit_list nav-sall tree-item">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>In-Transit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=delivery_list" class="nav-link nav-delivery_list nav-sall tree-item">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Delivered</p>
                </a>
              </li>
              <li class="nav-item dropdown">
            <a href="./index.php?page=track" class="nav-link nav-track nav-sall tree-item">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Track Consignment
              </p>
            </a>
          </li>  
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_customer">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customer Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">
                <a href="./index.php?page=new_customer" class="nav-link nav-new_customer tree-item">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>New Customer</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="./index.php?page=customer_list" class="nav-link nav-customer_list tree-item">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Customer List</p>
                </a>
              </li>
             <!-- <li class="nav-item">
                <a href="./index.php?page=customer_route_mapping" class="nav-link nav-customer_route_mapping tree-item">
                  <i class="fa fas fa-arrows-alt-h nav-icon"></i>
                  <p>Customer To Route Mapping</p>
                </a>
              </li>-->
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_vehicle">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Vehicle Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <!-- <li class="nav-item">
                <a href="./index.php?page=new_vehicle" class="nav-link nav-new_vehicle tree-item">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>New Vehicle</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="./index.php?page=vehicle_list" class="nav-link nav-vehicle_list tree-item">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Vehicle List</p>
                </a>
              </li>
             <!-- <li class="nav-item">
                <a href="./index.php?page=vehicle_route_mapping" class="nav-link nav-vehicle_route_mapping tree-item">
                  <i class="fas fas fa-arrows-alt-h nav-icon"></i>
                  <p>Vehicle To Route Mapping</p>
                </a>
              </li>-->
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_route">
              <i class="nav-icon fas fa-route"></i>
              <p>
                Route Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">
                <a href="./index.php?page=new_route" class="nav-link nav-new_route tree-item">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>New Route</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="./index.php?page=route_list" class="nav-link nav-route_list tree-item">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Route List</p>
                </a>
              </li>
               <li class="nav-item dropdown">
            <a href="./index.php?page=vehicles" class="nav-link nav-reports">
              <i class="fas fa-list-alt nav-icon"></i>
              <p>
                Auto Routes
              </p>
            </a>
          </li> 
            </ul>
          </li>
          
           <li class="nav-item dropdown">
            <a href="./index.php?page=reports" class="nav-link nav-reports">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Reports
              </p>
            </a>
          </li>  
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>