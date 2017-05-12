<div class="header-section">

                <!--logo and logo icon start-->
                <div class="logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="<?php echo base_url()?>">
                        <img src="<?php echo base_url()?>img/logo-icon.png" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                        <span class="brand-name"></span>
                    </a>
                </div>

                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="<?php echo base_url() ?>">
                        <img src="img/logo-icon.png" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->

                <!--mega menu start-->
                <div id="navbar-collapse-1" class="navbar-collapse collapse yamm mega-menu">
                    <!-- <ul class="nav navbar-nav">
                        
                    </ul>-->
                </div>
                <!--mega menu end-->
                <div class="notification-wrap">
                <!--left notification start-->
                <div class="left-notification">
                <ul class="notification-menu">
                <!--mail info start-->
                
                <!--mail info end-->

                <!--task info start-->
                
                <!--task info end-->

                <!--notification info start-->
                
                <!--notification info end-->
                </ul>
                </div>
                <!--left notification end-->


                <!--right notification start-->
                <div class="right-notification">
                    <ul class="notification-menu">
                        <!--<li>
                            <form class="search-content" action="http://thevectorlab.net/slicklab/index.html" method="post">
                                <input type="text" class="form-control" name="keyword" placeholder="Search...">
                            </form>
                        </li>-->

                        <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="img/avatar-mini.jpg" alt=""><?php echo $this->session->userdata('user_name');?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu purple pull-right">
<!--                               <li><a href="javascript:;">  Profile</a></li>-->
                                <li>
								<?php if($this->session->userdata['user_type']==0 || $this->session->userdata['user_type']==1){?>
                                    <a href="<?php echo base_url() ?>admin/changepassword">
                                        <!-- <span class="badge bg-danger pull-right">40%</span>-->
                                        <span>Change Password</span>
                                    </a>
									<?php } else if($this->session->userdata['user_type']==2){?>
									<a href="<?php echo base_url() ?>vendors/changepassword">
                                        <!-- <span class="badge bg-danger pull-right">40%</span>-->
                                        <span>Change Password</span>
                                    </a>
									<?php } else {?>
									<a href="<?php echo base_url() ?>venues/changepassword">
                                        <!-- <span class="badge bg-danger pull-right">40%</span>-->
                                        <span>Change Password</span>
                                    </a>
									<?php } ?>
                                </li>
                               
                                <li><a href="<?php echo base_url() ?>admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>
<!--                        <li>
                            <div class="sb-toggle-right">
                                <i class="fa fa-indent"></i>
                            </div>
                        </li>-->

                    </ul>
                </div>
                <!--right notification end-->
                </div>

            </div>