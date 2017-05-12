            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Add User
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                 <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url()?>">Home</a></li>
                        <li><a href="<?php echo base_url()?>users/manageadminusers">Admin Users</a></li>
                        <li class="active">Add User</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
				<?php if($this->session->flashdata('add_user_success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('add_user_success');?></p>
                    </div>
								
						<?php }?>
            
            
            
            <div class="row">
            <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>users/adduser" name="add_user" method="POST" id="user_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      
					<?php if($this->session->flashdata('t_and_c_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Request!&nbsp;</strong><?php echo  $this->session->flashdata('t_and_c_error');?>
                    </div>
								
						<?php }?>
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="uname" value="<?php if(isset($_POST['uname'])){echo $_POST['uname'];}else{echo "";}?>">
								<?php echo form_error('uname')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="u_email" value="<?php if(isset($_POST['u_email'])){echo $_POST['u_email'];}else{echo "";}?>">
								<?php echo form_error('u_email')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password"  class="form-control" name="u_passw" placeholder="">
								<?php echo form_error('u_passw')?>
                            </div>
                        </div>
						<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Gender</label>
                <div class="col-lg-10">
                    
                    
                    <div class="check-box">
                        <label>
                            <input type="radio" value="1" id="optionsRadios1" name="gender">
                            Male
                        </label>
                    
                    
                        <label>
                            <input type="radio" value="0" id="optionsRadios2" name="gender">
                            Female
                        </label>
						<?php echo form_error('gender')?>
                    </div>

                      </div>
                    </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="u_phone" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['u_phone'])){echo $_POST['u_phone'];}else{echo "";}?>" >
								<?php echo form_error('u_phone');?>
                            </div>
                        </div>
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Upload picture</label>
                            <div class="col-lg-10">
                                <input type="file" id="file-2" name="profile_pic" class="file"  multiple=true>
                            </div>
                        </div>
				<div class="form-group clearfix">
                      <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                         <div class="col-lg-10">
						<input type="hidden" name="venue_id" value="<?php echo $this->uri->segment(3);?>" >
						    <button class="btn btn-info" type="submit" name="usersubmit">Submit</button>
						</div>
					  </div>
					
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
