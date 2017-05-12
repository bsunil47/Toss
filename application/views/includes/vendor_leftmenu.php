<div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="<?php echo base_url()?>vendors/dashboard">
                    <img src="<?php echo base_url()?>img/logo-icon.png" alt="">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name"></span>
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                <!-- visible small devices end-->
<?php //echo "<pre>";print_r($this->session->userdata);exit;
$alloweddata=array('managevenues','addvenue','viewvenueinfo','editvenueinfo','managefacilities','addfacility','editfacilityinfo','viewfacility','manageaddons','addaddon','managepricing','viewprice','addpricing','editprice','managevenuemanagers','adduser','viewuserinfo','edituserinfo','manageslots','addslots','editslotinfo','viewslotinfo');
$seg=$this->router->fetch_method();
?>
                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked side-navigation">
                    <li>
                        <h3 class="navigation-title">Navigation</h3>
                    </li>
                    <li <?php if($this->uri->segment(2)=='dashboard'){?>class="active"<?php }?>><a href="<?php echo base_url()?>vendors/dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <li class="menu-list <?php if($this->uri->segment(2)=='viewvendor' || $this->uri->segment(2)=='editvendor'){?>nav-active active<?php }?>">
                        <a href="#"><i class="fa fa-user"></i>  <span>MyAccount</span></a>
                        <ul class="child-list">
                            <li <?php if($this->uri->segment(2)=='viewvendor'){?>class="active"<?php }?>><a href="<?php echo base_url()?>vendors/viewvendor"><i class="fa fa-book"></i>View Details</a></li>
                         <li <?php if($this->uri->segment(2)=='editvendor'){?>class="active"<?php }?>><a href="<?php echo base_url()?>vendors/editvendor"><i class="fa fa-book"></i>Edit Details</a></li>
                        </ul>
                        
                    </li>
					<li class="menu-list <?php if($seg=='managecoins' || $seg =='addrequestcoins' || $seg == 'editrequestcoinsinfo'){?>nav-active active<?php }?>">
                        <a href="#"><i class="fa fa-user"></i>  <span>Manage Coins</span></a>
                        <ul class="child-list">
                         <li <?php if($seg=='managecoins' || $seg =='addrequestcoins' || $seg == 'editrequestcoinsinfo'){?>class="active"<?php }?>><a href="<?php echo base_url()?>vendors/managecoins"><i class="fa fa-book"></i>Manage Coins</a></li>
                         <!--<li <?php //if($this->uri->segment(2)=='editrequestcoins'){?>class="active"<?php //}?>><a href="<?php //echo base_url()?>vendors/editvendor"><i class="fa fa-book"></i>Request Coins</a></li>-->
							
						</ul>
                        
                    </li>
                    <li <?php if(in_array($seg, $alloweddata)){?>class="active"<?php }?>><a href="<?php echo base_url() ?>vendors/managevenues"><i class="fa fa-building"></i><span>Manage Venues</span></a></li>
<!--                    <li <?php //if($this->uri->segment(2)=='managevenues'|| $this->uri->segment(2)=='addvenue'|| $this->uri->segment(2)=='viewvenueinfo' || $this->uri->segment(2)=='editvenueinfo'){?>class="active" <?php //}?>><a href="<?php //echo base_url() ?>vendors/managevenues"><i class="fa fa-building"></i><span>Manage Venues</span></a></li>-->
                    <?php /*<li <?php if($this->uri->segment(2)=='managefacilities' || $this->uri->segment(2)=='addfacility' || $this->uri->segment(2)=='editfacilityinfo' || $this->uri->segment(2)=='viewfacility'){?>class="active" <?php }?>><a href="<?php echo base_url() ?>vendors/managefacilities"><i class="fa fa-glass"></i><span>Manage Facilities</span></a></li>
                    <li <?php if($this->uri->segment(2)=='manageaddons' || $this->uri->segment(2)=='addaddon' ){?>class="active" <?php }?>><a href="<?php echo base_url() ?>vendors/manageaddons"><i class="fa fa-puzzle-piece"></i><span>Manage Addons</span></a></li>
                    <li <?php if($this->uri->segment(2)=='managepricing' || $this->uri->segment(2)=='viewprice' || $this->uri->segment(2)=='addpricing' || $this->uri->segment(2)=='editprice'){?>class="active" <?php }?>><a href="<?php echo base_url() ?>vendors/managepricing"><i class="fa fa-money"></i><span>Manage Pricing</span></a></li>
                    <li <?php if($this->uri->segment(2)=='managevenuemanagers' || $this->uri->segment(2)=='adduser' || $this->uri->segment(2)=='viewuserinfo' || $this->uri->segment(2)=='edituserinfo'){?>class="active" <?php }?>><a href="<?php echo base_url() ?>vendors/managevenuemanagers"><i class="fa fa-users"></i><span>Venue Users</span></a></li>
                    <li <?php if($this->uri->segment(2)=='manageslots' || $this->uri->segment(2)=='addslots' || $this->uri->segment(2)=='editslotinfo' || $this->uri->segment(2)=='viewslotinfo' ){?>class="active" <?php }?>><a href="<?php echo base_url() ?>vendors/manageslots"><i class="fa fa-clock-o"></i><span>Manage Time Slots</span></a></li>*/?>
						
						
                  </ul>
                <!--sidebar nav end-->

                <!--sidebar widget start-->
                
                <!--sidebar widget end-->

            </div>
        </div>