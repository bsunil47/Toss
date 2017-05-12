<div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="index-2.html">
                    <img src="<?php echo base_url()?>img/logo-icon.png" alt="">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name">SlickLa</span>
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                <!-- visible small devices end-->
<?php //echo "<pre>";print_r($this->session->userdata);exit;?>
                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked side-navigation" id="navlist">
				<?php echo $segment=$this->router->fetch_method();?>
                    <li>
                        <h3 class="navigation-title">Navigation</h3>
                    </li>
                    <li <?php if($segment=="dashboard"){?>class="active"<?php } ?>><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <li class="menu-list <?php if($segment=="managevendors" || $segment=="addvendor"|| $segment=="editvendor" || $segment=="listvenue"|| $segment=="viewvenueinfo"|| $segment=="editvenueinfo" || $segment=="viewvenueusersinfo" || $segment=="viewuserinfo" || $segment=="editsuserinfo" || $segment=="managevenues"|| $segment=="manageslots" || $segment=="managevenues" || $segment=="addvenue"|| $segment=="editvenueinfo"|| $segment=="viewvenueinfo" || $segment=="manageslots" || $segment=="addslots" || $segment=="editslotinfo" || $segment=="viewslotinfo"){?>nav-active active<?php } ?>" >
                        <a href="#"><i class="fa fa-user"></i>  <span>Vendors</span></a>
                        <ul class="child-list">
						<?php if($this->session->userdata['user_type']==0 || $this->session->userdata['user_type']==1) { ?>
                          
							<li <?php if($segment=="managevendors" || $segment=="addvendor"|| $segment=="editvendor" || $segment=="listvenue"|| $segment=="viewvenueinfo"|| $segment=="editvenueinfo" || $segment=="viewvenueusersinfo" || $segment=="viewuserinfo" || $segment=="editsuserinfo"){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>admin/managevendors"><i class="fa fa-user"></i>Manage Vendors</a></li>
							<?php /*<li <?php if($segment=="managevenues" || $segment=="addvenue" || $segment=="editvenueinfo" || $segment=="viewvenueinfo"){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>admin/managevenues"><i class="fa fa-building"></i>Manage Venues</a></li>
							<li <?php if($segment=="manageslots" || $segment=="addslots" || $segment=="editslotinfo" || $segment=="viewslotinfo"){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>admin/manageslots"><i class="fa fa-clock-o"></i>Manage Slots</a></li>*/?>
						<?php } ?>
						
                            <!--<li><a href="<?php //echo base_url() ?>admin/manageusers">Manage Users</a></li>-->
                            
                        </ul>
                    </li>
					
					<!-- Manage Tab -->
                    <li class="menu-list <?php if($segment=="managecategories" || $segment=="addcategory" || $segment=="editcategoryinfo" || $segment=="managesubcategories" || $segment=="addsubcategory" || $segment=="editsubcategory" || $segment=="managesubsubcategories" || $segment=="addsubsubcategory" || $segment=="editsubsubcategory" || $segment=="managefacilities" || $segment=="addfacility" || $segment=="editfacilityinfo" || $segment=="viewfacilityinfo" || $segment=="managecoins" || $segment=="editcoins"){?>nav-active active<?php } ?>">
                        <a href="#"><i class="fa fa-user"></i>  <span>Manage</span></a>
                        <ul class="child-list">
                            <li <?php if($segment=="managecategories" || $segment=="addcategory" || $segment=="editcategoryinfo"){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>admin/managecategories"><i class="fa fa-cubes"></i>Manage Categories</a></li>
                            <li <?php if($segment=="managesubcategories" || $segment=="addsubcategory" || $segment=="editsubcategory"){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>admin/managesubcategories"><i class="fa fa-cubes"></i>Manage Subcategories</a></li>
                            <li <?php if($segment=="managesubsubcategories" || $segment=="addsubsubcategory" || $segment=="editsubsubcategory"){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>admin/managesubsubcategories"><i class="fa fa-cubes"></i>Manage SubSubcategories</a></li>
                            <li <?php if($segment=="managefacilities" || $segment=="addfacility" || $segment=="editfacilityinfo" || $segment=="viewfacilityinfo" ){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>admin/managefacilities"><i class="fa fa-glass"></i>Manage Facilities</a></li>
                            <li <?php if($segment=="managecoins" || $segment=="editcoins"){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>admin/managecoins"><i class="fa fa-inr"></i>Manage Coins</a></li>
                        </ul>
                    </li>
					<!-- End Manage Tab -->
					
					<!---- user list tab --->
					<li class="menu-list <?php if($segment=="manageappusers" || $segment=="manageadminusers"){?>nav-active active<?php } ?>">
                        <a href="#"><i class="fa fa-user"></i>  <span>Users</span></a>
                        <ul class="child-list">
						
                            <li <?php if($segment=="manageappusers"){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>users/manageappusers"><i class="fa fa-users"></i>Manage App Users</a></li>
                            <li <?php if($segment=="manageadminusers"){?>class="active"<?php } ?>><a href="<?php echo base_url() ?>users/manageadminusers"><i class="fa fa-users"></i>Manage Admin Users</a></li>
                        </ul>
                    </li>
					<!-- end user list -->
                  </ul>
                <!--sidebar nav end-->

                <!--sidebar widget start-->
                
                <!--sidebar widget end-->

            </div>
        </div>