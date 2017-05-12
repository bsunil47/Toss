<div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="index-2.html">
                    <img src="<?php echo base_url()?>img/logo-icon.png" alt="">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <!--<span class="brand-name">SlickLab</span>-->
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                <!-- visible small devices end-->
<?php //echo "<pre>";print_r($this->session->userdata);exit;?>
                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked side-navigation">
                    <li>
                        <h3 class="navigation-title">Navigation</h3>
                    </li>
                    <li class="<?php if($this->router->fetch_method()=='dashboard'){?>active<?php } ?>"><a href="<?php echo base_url()?>venues/dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <!---- Venues list start --->
					<li class="menu-list <?php if($this->router->fetch_method()=='viewvenue' || $this->router->fetch_method()=='editvenueinfo' ){?>nav-active<?php } ?>">
                        <a href="#"><i class="fa fa-user"></i>  <span>My Account</span></a>
                        <ul class="child-list">
							<li class="<?php if($this->router->fetch_method()=='viewvenue'){?>active<?php } ?>"><a href="<?php echo base_url() ?>venues/viewvenue">View Details</a></li>
							<li class="<?php if($this->router->fetch_method()=='editvenueinfo'){?>active<?php } ?>"><a href="<?php echo base_url() ?>venues/editvenueinfo">Edit Details</a></li>						                        
                        </ul>
							<li class="<?php if($this->router->fetch_method()=='managefacilities' || $this->router->fetch_method()=='addfacility' || $this->router->fetch_method()=='editfacilityinfo' || $this->router->fetch_method()=='viewfacilities'){?>active<?php } ?>"><a href="<?php echo base_url() ?>venues/managefacilities"><i class="fa fa-glass"></i><span>Manage Facilities</span></a></li>
							<li class="<?php if($this->router->fetch_method()=='manageaddons' || $this->router->fetch_method()=='addaddon') {?>active<?php } ?>"><a href="<?php echo base_url() ?>venues/manageaddons"><i class="fa fa-puzzle-piece"></i><span>Manage Addons</span></a></li>
							<li class="<?php if($this->router->fetch_method()=='managepricing' || $this->router->fetch_method()=='addpricing' || $this->router->fetch_method()=='editprice' || $this->router->fetch_method()=='viewprice'){?>active<?php } ?>"><a href="<?php echo base_url() ?>venues/managepricing"><i class="fa fa-rupee"></i><span>Manage Pricing</span></a></li>
							<li class= "<?php if ($this->router->fetch_method() == 'manageslots' || $this->router->fetch_method()=='addslots' || $this->router->fetch_method()=='editslotinfo' || $this->router->fetch_method()=='viewslotinfo') { ?>active<?php } ?>"><a href="<?php echo base_url() ?>venues/manageslots"><i class="fa fa-clock-o"></i><span> Time Slots</span></a></li> 
							<li class= "<?php if ($this->router->fetch_method() == 'managestaff'  || $this->router->fetch_method()=='addstaff' || $this->router->fetch_method()=='editstaffinfo'|| $this->router->fetch_method()=='viewstaff') { ?>active<?php } ?>" ><a href="<?php echo base_url() ?>venues/managestaff"><i class="fa fa-users"></i><span>Manage Staff</span></a></li>
							
                    </li>
					<!-- end Venues list -->
                                        <li class="menu-list <?php if($this->router->fetch_method()=='managecustomers'){?>nav-active<?php } ?>">
                        <a href="#"><i class="fa fa-user"></i>  <span>Customers</span></a>
                        <ul class="child-list">
							<li class="<?php if($this->router->fetch_method()=='managecustomers'){?>active<?php } ?>"><a href="<?php echo base_url() ?>venues/managecustomers"><i class="fa fa-users"></i><span>Manage Customers</span></a></li>
							</ul>
                    </li>
                  </ul>
                <!--sidebar nav end-->

                <!--sidebar widget start-->
                
                <!--sidebar widget end-->

            </div>
        </div>