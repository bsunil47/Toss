            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Edit Vendor
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url(); ?>vendors/dashboard">Home</a>
                        <li class="active">Edit Vendor</li>
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
<!--                        <header class="panel-heading">
                            Basic Form Wizard
							
                        </header>-->
						<?php if($this->session->flashdata('vendor_success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('vendor_success');?></p>
                    </div>
								
						<?php }?>
						<?php if($this->session->flashdata('t_and_c_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Request!&nbsp;</strong><?php echo  $this->session->flashdata('t_and_c_error');?>
                    </div>
					<?php } ?> 
					
                        <div class="panel-body no-pad">

                            <form id="basic-form" action="<?php echo  base_url() ?>vendors/editvendordetails" name="edit_vendor" method="POST" enctype="multipart/form-data">
                              
							  <?php 
							  //echo "<pre>";print_r($getallcategories);exit;
							  $editvendor=(array)$editvendorinfo;
							  //echo "<pre>";print_r($workinghours);exit;
							  //echo "<pre>";print_r($editvendor);exit;
							  //foreach($editvendorsinfo as $editvendor){
								  //echo "<pre>";print_r($editvendor);exit;
								  ?>
								<div>
                                    <h3>General Info</h3>
                         <section>
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="uname" value="<?php if(isset($editvendor['vendorname'])){echo $editvendor['vendorname'];}?>">
								<?php echo form_error('uname')?>
                            </div>
							</div>
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Company Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_name" class="form-control" id="focusedInput"  value="<?php echo $editvendor['company_name'];?>">
								<?php echo form_error('c_name');?>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="u_email" value="<?php echo $editvendor['useremail'];?>">
								<?php echo form_error('u_email')?>
                            </div>
                        </div>
                        
						<div class="form-group clearfix">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Gender</label>
                <div class="col-lg-10">
                    <div class="check-box">
						<label>
                            <input type="radio" value="1"<?php if($editvendor['vendorgendor']=='1'){?>checked="checked"<?php }?> id="optionsRadios1" name="gender">
                        </label>
						<div style="position: relative; top: -29px; left: 15px;">Male</div>
                      <label>
                            <input type="radio" value="0"<?php if($editvendor['vendorgendor']=='0'){?>checked="checked"<?php }?> id="optionsRadios2" name="gender">
                            
                        </label>
						<div style="position: relative; top: -29px; left: 15px;">Female</div>
						<?php echo form_error('gender')?>
					</div>
				 </div>
                    </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="u_phone" class="form-control" id="focusedInput"  value="<?php echo $editvendor['userphone'];?>" >
								<?php echo form_error('u_phone');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Upload picture</label>
                            <div class="col-lg-10">
                    <div class="col-lg-5">			<!--<input type="file" id="file-2" name="u_pic" class="file"  multiple=true>-->
                                <input type="file" name="profile_pic" multiple=true>
                                </div><div class="col-lg-5"><img src="<?php echo base_url()?>images/profiles/<?php echo $editvendor['vendorid']."_user";?>.jpg" name="u_pic" width="200" height="100"/>
                                </div>
                            </div>
                        </div>
						
						
                       </section>
					   <h3>Address Details</h3>
                        <section>
						   
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_address" class="form-control" id="focusedInput"  value="<?php echo $editvendor['vendoraddress'];?>">
								<?php echo form_error('vendor_addressone');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor Address2</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_addresstwo" class="form-control" id="focusedInput"  value="<?php echo $editvendor['vendoraddresstwo'];?>">
								<?php echo form_error('vendor_addresstwo');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor City</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_city" class="form-control" id="focusedInput"  value="<?php echo $editvendor['vendorcity'];?>">
								<?php echo form_error('vendor_city');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor State</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_state" class="form-control" id="focusedInput"  value="<?php echo $editvendor['vendorstate'];?>">
								<?php echo form_error('vendor_state');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor Country</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_country" class="form-control" id="focusedInput"  value="<?php echo $editvendor['vendorcountry'];?>">
								<?php echo form_error('vendor_country');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor Pincode</label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_pin" class="form-control" id="focusedInput"  value="<?php echo $editvendor['vendorpin'];?>">
								<?php echo form_error('vendor_pin');?>
                            </div>
                        </div>
						
						
						
						
						
							
						</section>
                       
						<h3>Business Details</h3>
						<section style="min-height:1200px;">
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">PAN</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_pan" class="form-control" id="focusedInput"  value="<?php echo $editvendor['pan'];?>">
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
							<div class="col-lg-5">
                                <input type="file" name="pan_image" multiple=true>
								</div>
								<div class="col-lg-5">
								  <img src="<?php echo base_url()?>images/vendors/<?php echo $editvendor['vendorid'];?>/<?php echo "vendor_pan_image_".$editvendor['vendorid'];?>.jpg" name="pan_image" width="200" height="100"/>
                            </div>
							</div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">VAT</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_vat" class="form-control" id="focusedInput"  value="<?php echo $editvendor['vat'];?>">
								<?php echo form_error('c_vat');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of VAT</label>
                            <div class="col-lg-10">
							<div class="col-lg-5">
                                <input type="file" name="vat_image" multiple=true>
								</div>
								<div class="col-lg-5">
								<img src="<?php echo base_url()?>images/vendors/<?php echo $editvendor['vendorid'];?>/<?php echo "vendor_vat_image_".$editvendor['vendorid'];?>.jpg" name="vat_image" width="200" height="100"/>
                            </div>
							</div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">CST</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_cst" class="form-control" id="focusedInput"  value="<?php echo $editvendor['tan'];?>">
								<?php echo form_error('c_cst');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of CST</label>
                            <div class="col-lg-10">
							<div class="col-lg-5">
                                <input type="file" name="cst_image" multiple=true>
							</div>
							<div class="col-lg-5">
								<img src="<?php echo base_url()?>images/vendors/<?php echo $editvendor['vendorid'];?>/<?php echo "vendor_cst_image_".$editvendor['vendorid'];?>.jpg" name="cst_image" width="200" height="100"/>
                           </div> 
							</div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">TAN</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_tan" class="form-control" id="focusedInput"  value="<?php echo $editvendor['cst'];?>">
								<?php echo form_error('c_tan');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of TAN</label>
                            <div class="col-lg-10">
							<div class="col-lg-5">
                                <input type="file" name="tan_image" multiple=true>
								</div>
							<div class="col-lg-5">
								<img src="<?php echo base_url()?>images/vendors/<?php echo $editvendor['vendorid'];?>/<?php echo "vendor_tan_image_".$editvendor['vendorid'];?>.jpg" name="tan_image" width="200" height="100"/>
                         </div>   
							</div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Service TAX</label>
                            <div class="col-sm-10">
                                <input type="text" name="c_service_tax" class="form-control" id="focusedInput"  value="<?php echo $editvendor['service_tax'];?>">
								<?php echo form_error('c_service_tax');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
						<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of Service TAX</label>
                            <div class="col-lg-10">
							   <div class="col-lg-5">
                                <input type="file" name="service_tax_image" multiple=true>
								</div>
								<div class="col-lg-5">
								<img src="<?php echo base_url()?>images/vendors/<?php echo $editvendor['vendorid'];?>/<?php echo "vendor_service_tax_image_".$editvendor['vendorid'];?>.jpg" name="service_tax_image" width="200" height="100"/>
								</div>
							</div>
                       </div>
					   <div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Scanned Copy of Cancelled Cheque</label>
                            <div class="col-lg-10">
									<div class="col-lg-5">
                                <input type="file" name="cancelled_cheque_image" multiple=true>
								</div>
								<div class="col-lg-5">
								<img src="<?php echo base_url()?>images/vendors/<?php echo $editvendor['vendorid'];?>/<?php echo "vendor_cancelled_cheque_image_".$editvendor['vendorid'];?>.jpg" name="cancelled_cheque_image" width="200" height="100"/>
								</div>
							</div>
                        </div>
						

                       </section>
					   
                       
                       <h3>Account Details</h3>
                        <section>
						   
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Beneficiary Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="benf_name" class="form-control" id="focusedInput"  value="<?php echo $editvendor['beneficiary_name'];?>">
								<?php echo form_error('benf_name');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Account Number</label>
                            <div class="col-sm-10">
                                <input type="text" name="account_number" class="form-control" id="focusedInput"  value="<?php echo $editvendor['account_number'];?>">
								<?php echo form_error('account_number');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Type of Account</label>
                            <div class="col-sm-10">
                                <input type="text" name="t_account" class="form-control" id="focusedInput"  value="<?php echo $editvendor['account_type'];?>">
								<?php echo form_error('t_account');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">IFSC Code</label>
                            <div class="col-sm-10">
                                <input type="text" name="ifsc_cde" class="form-control" id="focusedInput"  value="<?php echo $editvendor['ifsc_code'];?>">
								<?php echo form_error('ifsc_cde');?>
                            </div>
                        </div>
						
						
						
						
						
						<!--<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Accept Terms and Conditions</label>
                            <div class="col-sm-10">
                               <!-- <input type="text" name="t_and_c" class="form-control" id="focusedInput"  value="">
								<input type="checkbox" name="tandc" value="1"><br />
								click here to see&nbsp;<a href="#" target="__blank">Terms and contions</a>
								<?php //echo form_error('tandc');?>
                            </div>
                        </div>-->
							
						</section>
						<h3>Other</h3>
                       <section>
                         <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Existing Website</label>
                            <div class="col-sm-10">
                                <input type="text" name="exst_wb" class="form-control" id="focusedInput"  value="<?php echo $editvendor['web_url'];?>">
								<?php echo form_error('exst_wb');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Other Website</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_web" class="form-control" id="focusedInput"  value="<?php echo $editvendor['web_url2'];?>">
								<?php echo form_error('other_web');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Other Information1</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_info1" class="form-control" id="focusedInput"  value="<?php echo $editvendor['other_info_one'];?>">
								<?php echo form_error('other_info1');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Other Information2</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_info2" class="form-control" id="focusedInput"  value="<?php echo $editvendor['other_info_two'];?>">
								<?php echo form_error('other_info2');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Other Information3</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_info3" class="form-control" id="focusedInput"  value="<?php echo $editvendor['other_info_three'];?>">
								<?php echo form_error('other_info3');?>
                            </div>
                        </div>
						
			<div class="form-group clearfix">
                      <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                         <div class="col-lg-10">
						 <input type="hidden" name="user_id" value="<?php echo $editvendor['user_id'];?>"/>
						 <input type="hidden" name="vendor_id" value="<?php echo $editvendor['vendorid'];?>"/>
						 <input type="hidden" name="venue_id" value="<?php echo $editvendor['venueid'];?>"/>
						    <button class="btn btn-info" type="submit" name="vendorsubmit">Submit</button>
						</div>
					  </div>			
						
                       </section>
				<?php //} ?>
                 </form>
				</div>
             </section>

           </div>

         </div>
            
        </div>
            <!-- body wrapper end -->
