<!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Add Vendor
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a>
                        </li>
                        <li><a href="<?php echo base_url();?>admin/managevendors">Vendors</a>
                        </li>
                        <li class="active">Add Vendor</li>
                    </ol>
                </div>

            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">

            <div class="row">
                <div class="col-md-12">
                    <!--progress bar start-->
                    <section class="panel-">
                        <header class="panel-heading">
                            
                        </header>
						
						<?php if($this->session->flashdata('t_and_c_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Request!&nbsp;</strong><?php echo  $this->session->flashdata('t_and_c_error');?>
                    </div>
					<?php } ?> 
                        <div class="panel-body no-pad">

                            <form id="basic-form" action="<?php echo  base_url() ?>admin/addvendor" name="add_venue" method="POST" enctype="multipart/form-data">
                              
								<div>
                                    <h3>Step - General Info</h3>
                         <section>
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="uname" value="<?php if(isset($_POST['uname'])){echo $_POST['uname'];}else{echo "";}?>">
								<?php echo form_error('uname')?>
                            </div>
							</div>
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Company Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_name" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_name'])){echo $_POST['c_name'];}else{echo "";}?>">
								<?php echo form_error('c_name');?>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="u_email" value="<?php if(isset($_POST['u_email'])){echo $_POST['u_email'];}else{echo "";}?>">
								<?php echo form_error('u_email')?>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password"  class="form-control" name="u_passw" placeholder="">
								<?php echo form_error('u_passw')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Gender</label>
                <div class="col-lg-10">
                    <div class="check-box">
						<label>
                            <input type="radio" value="1" id="optionsRadios1" name="gender">
                        </label>
						<div style="position: relative; top: -29px; left: 15px;">Male</div>
                      <label>
                            <input type="radio" value="0" id="optionsRadios2" name="gender">
                            
                        </label>
						<div style="position: relative; top: -29px; left: 15px;">Female</div>
						<?php echo form_error('gender')?>
					</div>
				 </div>
                    </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="u_phone" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['u_phone'])){echo $_POST['u_phone'];}else{echo "";}?>" >
								<?php echo form_error('u_phone');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Upload picture</label>
                            <div class="col-lg-10">
							<!--<input type="file" id="file-2" name="u_pic" class="file"  multiple=true>-->
                                <input type="file" name="profile_pic" multiple=true>
                            </div>
                        </div>
						</section>
						
					   <h3>Step - Address Details</h3>
                       <section>
                         <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor Address 1 </label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_addressone" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['exst_wb'])){echo $_POST['exst_wb'];}else{echo "";}?>">
								<?php echo form_error('vendor_addressone');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor Address 2 </label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_addresstwo" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_web'])){echo $_POST['other_web'];}else{echo "";}?>">
								<?php echo form_error('vendor_addresstwo');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor City</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_city" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info1'])){echo $_POST['other_info1'];}else{echo "";}?>">
								<?php echo form_error('vendor_city');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor State</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_state" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info2'])){echo $_POST['other_info2'];}else{echo "";}?>">
								<?php echo form_error('vendor_state');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor Country</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_country" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info3'])){echo $_POST['other_info3'];}else{echo "";}?>">
								<?php echo form_error('vendor_country');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor Pincode</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_pin" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info3'])){echo $_POST['other_info3'];}else{echo "";}?>">
								<?php echo form_error('vendor_pin');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_phone" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info3'])){echo $_POST['other_info3'];}else{echo "";}?>">
								<?php echo form_error('vendor_phone');?>
                            </div>
                        </div>
						
                       </section>
					
                       
						<h3>Step - Business Details</h3>
						<section style="min-height:1200px;">
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">PAN</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_pan" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_pan'])){echo $_POST['c_pan'];}else{echo "";}?>">
								<?php echo form_error('c_pan');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
						
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of PAN</label>
                            <div class="col-lg-10">
							<!--<input type="file" id="file-2" name="s_pan" class="file"  multiple=true>-->
                                <input type="file" name="pan_image" multiple=true>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">VAT</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_vat" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_vat'])){echo $_POST['c_vat'];}else{echo "";}?>">
								<?php echo form_error('c_vat');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of VAT</label>
                            <div class="col-lg-10">
                                <input type="file" name="vat_image" multiple=true>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">CST</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_cst" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_cst'])){echo $_POST['c_cst'];}else{echo "";}?>">
								<?php echo form_error('c_cst');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of CST</label>
                            <div class="col-lg-10">
                                <input type="file" name="cst_image" multiple=true>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">TAN</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_tan" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_tan'])){echo $_POST['c_tan'];}else{echo "";}?>">
								<?php echo form_error('c_tan');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of TAN</label>
                            <div class="col-lg-10">
                                <input type="file" name="tan_image" multiple=true>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Service TAX</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_service_tax" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['c_service_tax'])){echo $_POST['c_service_tax'];}else{echo "";}?>">
								<?php echo form_error('c_service_tax');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
						<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of Service TAX</label>
                            <div class="col-lg-10">
                                <input type="file" name="service_tax_image" multiple=true>
                            </div>
                       </div>
					   <div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of Cancelled Cheque</label>
                            <div class="col-lg-10">
                                <input type="file" name="cancelled_cheque_image" multiple=true>
                            </div>
                        </div>
						

                       </section>
					   
                       
                       <h3> Step - Account Details</h3>
                        <section>
						   
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Beneficiary Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="benf_name" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['benf_name'])){echo $_POST['benf_name'];}else{echo "";}?>">
								<?php echo form_error('benf_name');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Account Number</label>
                            <div class="col-sm-10">
                                <input type="text" name="account_number" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['account_number'])){echo $_POST['account_number'];}else{echo "";}?>">
								<?php echo form_error('account_number');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Type of Account</label>
                            <div class="col-sm-10">
                                <input type="text" name="t_account" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['t_account'])){echo $_POST['t_account'];}else{echo "";}?>">
								<?php echo form_error('t_account');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">IFSC Code</label>
                            <div class="col-sm-10">
                                <input type="text" name="ifsc_cde" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['ifsc_cde'])){echo $_POST['ifsc_cde'];}else{echo "";}?>">
								<?php echo form_error('ifsc_cde');?>
                            </div>
                        </div>
						
						
						
						
						
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Accept Terms and Conditions</label>
                            <div class="col-sm-10">
                               <!-- <input type="text" name="t_and_c" class="form-control" id="focusedInput"  value="">-->
								<input type="checkbox" name="tandc" value="1"><br />
								click here to see&nbsp;<a href="#" target="__blank">Terms and contions</a>
								<?php echo form_error('tandc');?>
                            </div>
                        </div>
							
						</section>
						
						<h3>Step - Other</h3>
                       <section>
                         <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Existing Website</label>
                            <div class="col-sm-10">
                                <input type="text" name="exst_wb" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['exst_wb'])){echo $_POST['exst_wb'];}else{echo "";}?>">
								<?php echo form_error('exst_wb');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Other Website</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_web" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_web'])){echo $_POST['other_web'];}else{echo "";}?>">
								<?php echo form_error('other_web');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Other Information1</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_info1" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info1'])){echo $_POST['other_info1'];}else{echo "";}?>">
								<?php echo form_error('other_info1');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Other Information2</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_info2" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info2'])){echo $_POST['other_info2'];}else{echo "";}?>">
								<?php echo form_error('other_info2');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Other Information3</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_info3" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['other_info3'])){echo $_POST['other_info3'];}else{echo "";}?>">
								<?php echo form_error('other_info3');?>
                            </div>
                        </div>
						
						
						
                       </section>
					   <h3> Step - Venue</h3>
                      <section id="asa">
						<!--<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="vendor_id">
									   <option value="">--Select Company--</option>
									   <?php /*foreach($getallcompanies as $getcompany) { ?>
                                    <option value="<?php echo $getcompany['v_id'];?>"><?php echo $getcompany['company_name'];?></option>
									   <?php } */?>
                                    
                                </select>
								<?php //echo form_error('vendor_id')?>
                            </div>
							</div>-->
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="select2 form-control m-b-10 category" name="cat_id[]" multiple>
									  <option>--Select Category--</option>
									   <?php foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php echo $getcategory->category_id; ?>"><?php echo $getcategory->category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('cat_id')?>
                            </div>
							</div>
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Subcategories</label>
                            <div class="col-sm-10 subappend">
                                <select id="multiple1" class="select2 form-control m-b-10 subcategory" name="sub_cat_id[]" multiple>
									   <option value="">-- Select Subcategory --</option>
									   <?php //foreach($getallsubcats as $getallsubcat) { ?>
                                    <option value="<?php //echo $getallsubcat->sub_category_id;?>"><?php //echo $getallsubcat->sub_category_name;?></option>
									   <?php //} ?>
                                    
                               </select>
								<?php echo form_error('sub_cat_id');?>
                            </div>
							</div>
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Sub Subcategories</label>
                            <div class="col-sm-10 subsubappend">
                                <select id="multiple2" class="select2 form-control m-b-10 subsubcategory" name="sub_sub_cat_id[]" multiple>
									   <option value="">-- Select Sub Subcategory --</option>
									   <?php //foreach($getallsubcats as $getallsubcat) { ?>
                                    <option value="<?php //echo $getallsubcat['sub_category_id'];?>"><?php //echo $getallsubcat['sub_category_name'];?></option>
									   <?php //} ?>
                                    
                                </select>
								<?php echo form_error('sub_sub_cat_id');?>
                            </div>
							</div>
                         <!-- <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="v_name" value="<?php //if(isset($_POST['v_name'])){echo $_POST['v_name'];}else{echo "";}?>">
								<?php //echo form_error('v_name')?>
                            </div>
							
                        </div>-->
                        <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Display Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="v_disp_name" value="<?php if(isset($_POST['v_disp_name'])){echo $_POST['v_disp_name'];}else{echo "";}?>">
								<?php echo form_error('v_disp_name')?>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Contact Person Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cp_name" value="<?php if(isset($_POST['cp_name'])){echo $_POST['cp_name'];}else{echo "";}?>">
								<?php echo form_error('cp_name')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Mobile Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cp_mobile" value="<?php if(isset($_POST['cp_mobile'])){echo $_POST['cp_mobile'];}else{echo "";}?>">
								<?php echo form_error('cp_mobile')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cp_email" value="<?php if(isset($_POST['cp_email'])){echo $_POST['cp_email'];}else{echo "";}?>">
								<?php echo form_error('cp_email')?>
                            </div>
                        </div>
						
						
                       </section>
					   
					   <h3> Step - Contact</h3>
                       <section>
                         
						<div class="panel-body no-pad">
						
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Address-1</label>
                            <div class="col-sm-5">
                                <input type="text"  class="form-control" name="v_add1" value="<?php if(isset($_POST['v_add1'])){echo $_POST['v_add1'];}else{echo "";}?>" placeholder="">
								<?php echo form_error('v_add1')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Address-2</label>
                            <div class="col-sm-5">
                                <input type="text"  class="form-control" name="v_add2" value="<?php if(isset($_POST['v_add1'])){echo $_POST['v_add1'];}else{echo "";}?>" placeholder="">
								<?php echo form_error('v_add2')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue City</label>
                            <div class="col-sm-5">
                                <input type="text" name="v_city" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['v_city'])){echo $_POST['v_city'];}else{echo "";}?>" >
								<?php echo form_error('v_city');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Venue State</label>
                            <div class="col-lg-5">
                                 <input type="text" name="v_state" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['v_state'])){echo $_POST['v_state'];}else{echo "";}?>" >
									<?php echo form_error('v_state');?>
							</div>
                        </div>
						
						<!-- vendor details form start -->
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Country</label>
                            <div class="col-sm-5">
                                <input type="text" name="v_country" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['v_country'])){echo $_POST['v_country'];}else{echo "";}?>">
								<?php echo form_error('v_country');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Pincode</label>
                            <div class="col-sm-5">
                                <input type="text" name="v_pincode" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['v_pincode'])){echo $_POST['v_pincode'];}else{echo "";}?>">
								<?php echo form_error('v_pincode');?>
                            </div>
							
                        </div>
						<div class="toll-form">
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Location</label>
                            <div class="col-sm-5">
                                <input type="text" name="toss_ven_location" class="form-control" id="toss_ven_location">
								<?php echo form_error('toss_ven_location')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Lattitude</label>
                            <div class="col-sm-5">
                                <input type="text" name="toss_ven_lat" class="form-control" id="toss_ven_lat">
								<?php echo form_error('toss_ven_lat')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Longitude</label>
                            <div class="col-sm-5">
                                <input type="text" name="toss_ven_lng" class="form-control" id="toss_ven_lng">
								<?php echo form_error('toss_ven_lng')?>
                            </div>
                        </div>
						
						</div>
						
						
						<div class="form-group clearfix" style="position:absolute; top:2px; left:600px;">
                            <label class="col-sm-2 col-sm-2 control-label">Map</label>
                            <div class="col-sm-5">
                                <div id="map-canvas" style="width:700px; height:500px;"></div>
								
                            </div>
                        </div>
						
						</div>
						</section>
                       <h3> Step - Working Timings </h3>
					    <div class="col-lg-10"></div>
                        <section>
						<div class="class-lg-10" ><input type="checkbox" name="days[]" value="1"  style="margin-right:5px;" checked="checked"/>Mon <input type="checkbox" name="days[]" value="2" style="margin-right:5px;" checked="checked"/> Tue <input type="checkbox" name="days[]" value="3" style="margin-right:5px;" checked="checked"/> Wed <input type="checkbox" name="days[]" value="4" style="margin-right:5px;" checked="checked"/> Thu <input type="checkbox" name="days[]" value="5" style="margin-right:5px;" checked="checked"/> Fri <input type="checkbox" name="days[]" value="6" style="margin-right:5px;" checked="checked" /> Sat <input type="checkbox" name="days[]" value="7" style="margin-right:5px;" checked="checked"/> Sun</div>
                            <div class="form-group clearfix">
                            <label class="col-sm-12 col-sm-2 control-label"><strong>Working Timings</strong> </label>
                            
                        </div>
						<div class="form-group clearfix">
                            <!--<label class="col-sm-2 col-sm-2 control-label">Monday</label>
								<input type="hidden" name="day_mon" value="1">-->
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte" value="5:00:00" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte" value="22:00:00" class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
						<!--<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Tuesday</label>
								<input type="hidden" name="day_tue" value="2">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte[2]" value="5:00:00" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[2]" value="22:00:00" class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php //echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Wednesday</label>
								<input type="hidden" name="day_wed" value="3">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte[3]" value="5:00:00" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[3]" value="22:00:00" class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php //echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Thursday</label>
								<input type="hidden" name="day_thr" value="4">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte[4]" value="5:00:00" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[4]" value="22:00:00"  class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php //echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Friday</label>
								<input type="hidden" name="day_fri" value="5">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte[5]" value="5:00:00" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[5]" value="22:00:00" class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php //echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Saturday</label>
								<input type="hidden" name="day_sat" value="6">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte[6]" value="5:00:00" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[6]" value="22:00:00" class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php //echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Sunday</label>
								<input type="hidden" name="day_sun" value="7">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte[7]" value="5:00:00" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[7]" value="22:00:00" class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php //echo form_error('c_city');?>
                            </div>
                        </div>-->

                       </section>
					   
                       
                       <h3> Step - Images</h3>
                        <section>
						   <div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture1</label>
								<div class="col-lg-10">
								<!-- id="file-2" class="file"  multiple=true -->
									<input type="file" name="venue_pic_1">
								</div>
							</div>
							<div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture2</label>
								<div class="col-lg-10">
									<input type="file" name="venue_pic_2">
								</div>
							</div>
							<div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture3</label>
								<div class="col-lg-10">
									<input type="file" name="venue_pic_3">
								</div>
							</div>
							<div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture4</label>
								<div class="col-lg-10">
									<input type="file" name="venue_pic_4">
								</div>
							</div>
							<div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture5</label>
								<div class="col-lg-10">
									<input type="file" name="venue_pic_5">
								</div>
							</div>
							
						</section>
						<h3> Step - Facilities</h3>
                       <section>
                         <div class="form-group">
                    
							<div class="panel-body w-setting">
                        <ul class="team-list chat-list-side info statistics border-less-list setting-list" style="width: 1000px; height: 200px; overflow: auto">
						<?php
						foreach($getfacilites as $getfacility){
						
						?>
                            <li class="fac_cls cat_<?php echo $getfacility->base_type_id; ?>">
                                <div class="inline">
                                        <span class="name">
                                            <?php echo stripslashes($getfacility->facility_name);?>
                                        </span>
                                </div>
                                    <span class="thumb-small">
                                        <input type="checkbox" name="facilities[]" class="js-switch-small-green" value="<?php echo $getfacility->facility_id;?>"/>
                                    </span>
                            </li>
                            
						<?php } ?>
                        </ul>
                    </div>
                    
					</div>
                           <div class="form-group clearfix">
                      <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                         <div class="col-lg-10">
						    <button class="btn btn-info" type="submit" name="venuesubmit">Submit</button>
						</div>
					  </div>
                       </section>
					 
					</div>
                 </form>
				</div>
             </section>

           </div>

         </div>
            
        </div>
            <!--body wrapper end-->
