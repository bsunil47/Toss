            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Edit User
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
               <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
			<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $getdetails->vendor_id;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>admin/viewvenueusersinfo/<?php echo $venueid;?>">Venue Users</a></li>
                        <li class="active">Edit Venue User</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">

            
            
            
            <div class="row">
            <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/edituserdetails" name="add_user" method="POST" id="user_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
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
						<?php //echo "<pre>";print_r($edituserdetails);exit;?>
					  <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">User Type</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="usertype">
									   <option value="">--Select User--</option>
									   <option value="1"<?php if($edituserdetails->usertype==1) {?>selected<?php }?>>Admin</option>
                                    <!--<option value="2"<?php //if($edituserdetails->user_type==2) {selected}?>>Vendor Admin</option>-->
									   <option value="3"<?php if($edituserdetails->usertype==3) {?>selected<?php }?>>Venue Manager</option>
                                    <option value="4"<?php if($edituserdetails->usertype==4) {?>selected<?php }?>>Venue Staff</option>
                                </select>
								<?php echo form_error('usertype')?>
                            </div>
							
                        </div>
						
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
                                <input type="text" class="form-control" name="uname" value="<?php if(isset($edituserdetails->name)){echo $edituserdetails->name;}?>">
								<?php echo form_error('uname')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="u_email" value="<?php if(isset($edituserdetails->email)){echo $edituserdetails->email;}?>">
								<?php echo form_error('u_email')?>
                            </div>
                        </div>
                       
						<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Gender</label>
                <div class="col-lg-10">
                    
                    
                    <div class="check-box">
                        <label>
                            <input type="radio" value="1"<?php if($edituserdetails->gender == 1) {?> checked="checked"<?php } ?> id="optionsRadios1" name="gender">
                            Male
                        </label>
                    
                    
                        <label>
                            <input type="radio" value="0"<?php if($edituserdetails->gender == 0) {?>checked="checked"<?php } ?> id="optionsRadios2" name="gender">
                            Female
                        </label>
						<?php echo form_error('gender')?>
                    </div>

                      </div>
                    </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="u_phone" class="form-control" id="focusedInput"  value="<?php if(isset($edituserdetails->phone)){echo $edituserdetails->phone;}?>" >
								<?php echo form_error('u_phone');?>
                            </div>
                        </div>
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Upload picture</label>
                            <div class="col-lg-10">
							<div class="col-lg-5">
                                <input type="file" id="file-2" name="profile_pic" class="file">
								</div>
							<div class="col-lg-5">
							<img src="<?php echo base_url()?>images/profiles/<?php echo $edituserdetails->profile_pic;?>" name="profile_pic" style="width:auto;height:100px;"/>
							</div>
                            </div>
                        </div>
				<div class="form-group clearfix">
                      <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                         <div class="col-lg-10">
						 <input type="hidden" name="venue_id" value="<?php echo $edituserdetails->venue_id;?>">
							<input type="hidden" name="user_id" value="<?php echo $edituserdetails->user_id;?>">
						    <button class="btn btn-info" type="submit" name="usersubmit">Submit</button>
						</div>
					  </div>
					
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
     