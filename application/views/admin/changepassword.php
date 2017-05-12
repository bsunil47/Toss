            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Change Password
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						  <!--<li><a href="#" onclick="window.history.back();return false;">Venue Users</a></li>-->
                        <li class="active">Change Password</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
				<?php if($this->session->flashdata('update_pwd')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('update_pwd');?></p>
                    </div>
								
						<?php }?>
            
            <?php if($this->session->flashdata('c_pwd_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Warning!
                        </h4>
                        <p><?php echo  $this->session->flashdata('c_pwd_error');?></p>
                    </div>
								
						<?php }?>
						
			<?php if($this->session->flashdata('n_pwd_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Warning!
                        </h4>
                        <p><?php echo  $this->session->flashdata('n_pwd_error');?></p>
                    </div>
								
						<?php }?>
            
            <div class="row">
            <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/changepassword" name="changepwd" method="POST" id="changepwd" class="form-horizontal tasi-form" enctype="multipart/form-data">
                    
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Current Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="c_pwd">
								<?php echo form_error('c_pwd')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="n_pwd">
								<?php echo form_error('n_pwd')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Confirm New Password</label>
                            <div class="col-sm-10">
                                <input type="password"  class="form-control" name="c_n_pwd">
								<?php echo form_error('c_n_pwd')?>
                            </div>
                        </div>
						
						
						
				<div class="form-group clearfix">
                      <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                         <div class="col-lg-10">
						<input type="hidden" name="venue_id" value="<?php echo $this->uri->segment(3);?>" >
						    <button class="btn btn-info" type="submit" name="pwdsubmit">Submit</button>
						</div>
					  </div>
					
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
