            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Edit Venue
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a>
                        </li>
                        <li><a href="#" onclick="window.history.back();return false;">Venues</a>
                        </li>
                        <li class="active">Edit Venue</li>
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

                            <form id="basic-form" action="<?php echo  base_url() ?>admin/editvenuedetails" name="edit_vendor" method="POST" enctype="multipart/form-data">
                              
							  <?php 
							  //echo "<pre>";print_r($getallcategories);exit;
							  $editvenue=(array)$editvenueinfo;
							  //echo "<pre>";print_r($workinghours);exit;
							  //echo "<pre>";print_r($editvenue);exit;
							  //foreach($editvenuesinfo as $editvenue){
								  //echo "<pre>";print_r($editvenue);exit;
								  ?>
								<div>
                                    
					   
                       
						
						
					   <h3>Venue</h3>
                      <section>
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
							</div>--><?php //echo "<pre>";print_r($getallsubsubcategories);exit; ?>
                                              							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="select2 form-control m-b-10 category" name="cat_id[]" multiple>
									   <option value="">--Select Category--</option>
									   <?php 
									   
									   //$getcategories=(array)$getallcategories;
									   foreach($getallcategories as $getcategory) {foreach($venuecategoryinfo as $venuecat){
                                                    $venue_catarray=(array)$venuecat;
                                                } ?>
                                    <option value="<?php echo $getcategory->category_id;?>"<?php if(in_array($getcategory->category_id,$venue_catarray)){?> selected <?php } ?>><?php echo $getcategory->category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('cat_id')?>
                            </div>
							</div>
							 <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Subcategories</label>
                            <div class="col-sm-10">
                                <select id="multiple1" class="select2 form-control m-b-10 subcategory" name="sub_cat_id[]" multiple>
									   <option value="">--Select Subcategory--</option>
									   <?php
										//$getallsubcategories=(array)$getallsubcats;
									  foreach($getallsubcategories as $getallsubcat) { foreach($venuesubcategoryinfo as $venuesubcat){
                                                                          $venue_subcatarray=(array)$venuesubcat;}
                                                ?>
                                    <option value="<?php echo $getallsubcat->sub_category_id;?>"<?php if(in_array($getallsubcat->sub_category_id,$venue_subcatarray)){?> selected <?php } ?>><?php echo $getallsubcat->sub_category_name;?></option>
                                                                          <?php } ?>
                                    
                                </select>
								<?php //echo form_error('sub_cat_id')?>
                            </div>
							</div>
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Sub Subcategories</label>
                            <div class="col-sm-10">
                                <select id="multiple2" class="select2 form-control m-b-10 subsubcategory" name="sub_sub_cat_id[]" multiple>
									   <option value="">--Select Sub Subcategory--</option>
									   <?php
										//$getallsubcategories=(array)$getallsubcats;
									  foreach($getallsubsubcategories as $getallsubsubcat) { ?>
                                    <option value="<?php echo $getallsubsubcat->sub_sub_category_id;?>"<?php if($editvenue['sub_sub_category_id']==$getallsubsubcat->sub_sub_category_id){?> selected <?php } ?>><?php echo $getallsubsubcat->sub_sub_category_name;?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('sub_sub_cat_id')?>
                            </div>
							</div>
                         <!--<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="v_name" value="<?php //if(isset($_POST['v_name'])){echo $_POST['v_name'];}else{echo "";}?>">
								<?php //echo form_error('v_name')?>
                            </div>
							
                        </div>-->
                        <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Display Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="v_disp_name" value="<?php if(isset($editvenue['venue_display_name'])){echo $editvenue['venue_display_name'];}?>">
								<?php echo form_error('v_disp_name')?>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Contact Person Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cp_name" value="<?php if(isset($editvenue['contact_person'])){echo $editvenue['contact_person'];}?>">
								<?php echo form_error('cp_name')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Mobile Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cp_mobile" value="<?php if(isset($editvenue['venuephone'])){echo $editvenue['venuephone'];}?>">
								<?php echo form_error('cp_mobile')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cp_email" value="<?php if(isset($editvenue['email'])){echo $editvenue['email'];}?>">
								<?php echo form_error('cp_email')?>
                            </div>
                        </div>
						
						
                       </section>
					   
					   <h3>Contact</h3>
                       <section>
                         
						<div class="panel-body no-pad">
						
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Address-1</label>
                            <div class="col-sm-5">
                                <input type="text"  class="form-control" name="v_add1" value="<?php if(isset($editvenue['venueaddress'])){echo $editvenue['venueaddress'];}?>" placeholder="">
								<?php echo form_error('v_add1')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Address-2</label>
                            <div class="col-sm-5">
                                <input type="text"  class="form-control" name="v_add2" value="<?php if(isset($editvenue['venueaddresstwo'])){echo $editvenue['venueaddresstwo'];}?>" placeholder="">
								<?php echo form_error('v_add2')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue City</label>
                            <div class="col-sm-5">
                                <input type="text" name="v_city" class="form-control" id="focusedInput"  value="<?php if(isset($editvenue['venuecity'])){echo $editvenue['venuecity'];}?>" >
								<?php echo form_error('v_city');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Venue State</label>
                            <div class="col-lg-5">
                                 <input type="text" name="v_state" class="form-control" id="focusedInput"  value="<?php if(isset($editvenue['venuestate'])){echo $editvenue['venuestate'];}?>" >
									<?php echo form_error('v_state');?>
							</div>
                        </div>
						
						<!-- vendor details form start -->
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Country</label>
                            <div class="col-sm-5">
                                <input type="text" name="v_country" class="form-control" id="focusedInput"  value="<?php if(isset($editvenue['venuecountry'])){echo $editvenue['venuecountry'];}?>">
								<?php echo form_error('v_country');?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Pincode</label>
                            <div class="col-sm-5">
                                <input type="text" name="v_pincode" class="form-control" id="focusedInput"  value="<?php if(isset($editvenue['venuecountry'])){echo $editvenue['venuepincode'];}?>">
								<?php echo form_error('v_pincode');?>
                            </div>
							
                        </div>
						<div class="toll-form">
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Location</label>
                            <div class="col-sm-5">
                                <input type="text" name="toss_ven_location" class="form-control" id="toss_ven_location" value="<?php if(isset($editvenue['location'])){echo $editvenue['location'];}?>">
								<?php echo form_error('toss_ven_location')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Lattitude</label>
                            <div class="col-sm-5">
                                <input type="text" name="toss_ven_lat" class="form-control" id="toss_ven_lat" value="<?php if(isset($editvenue['lat'])){echo $editvenue['lat'];}?>">
								<?php echo form_error('toss_ven_lat')?>
                            </div>
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Longitude</label>
                            <div class="col-sm-5">
                                <input type="text" name="toss_ven_lng" class="form-control" id="toss_ven_lng" value="<?php if(isset($editvenue['lng'])){echo $editvenue['lng'];}?>">
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
                       <h3>Working Days and Timings</h3>
                        <section>
						<?php //echo "<pre>";print_r($workinghours);exit;?>
						<div class="class-lg-10" ><input type="checkbox" name="days[]" value="1"  style="margin-right:5px;" <?php if($workinghours[0]->day_id == 1){ echo "checked";}?>/>Mon <input type="checkbox" name="days[]" value="2" style="margin-right:5px;" <?php if($workinghours[1]->day_id == 2){ echo "checked";}?>/> Tue <input type="checkbox" name="days[]" value="3" style="margin-right:5px;" <?php if($workinghours[2]->day_id == 3){ echo "checked";}?>/> Wed <input type="checkbox" name="days[]" value="4" style="margin-right:5px;" <?php if($workinghours[3]->day_id == 4){ echo "checked";}?>/> Thu <input type="checkbox" name="days[]" value="5" style="margin-right:5px;" <?php if($workinghours[4]->day_id == 5){ echo "checked";}?>/> Fri <input type="checkbox" name="days[]" value="6" style="margin-right:5px;" <?php if($workinghours[5]->day_id == 6){ echo "checked";}?>/> Sat <input type="checkbox" name="days[]" value="7" style="margin-right:5px;" <?php if($workinghours[6]->day_id == 7){ echo "checked";}?>/> Sun</div>
                            <div class="form-group clearfix">
                            <label class="col-sm-12 col-sm-2 control-label"><strong>Working days</strong> </label>
                            
                        </div>
						<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Monday</label>
								<input type="hidden" name="day_mon" value="1">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte" value="<?php if(isset($workinghours[0]->start_time)){echo $workinghours[0]->start_time;}?>" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte" value="<?php if(isset($workinghours[0]->end_time)){echo $workinghours[0]->end_time;}?>" class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
			 <div class="form-group clearfix">
                      <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                         <div class="col-lg-10">
						 
						 <input type="hidden" name="vendor_id" value="<?php echo $editvenue['vendor_id'];?>"/>
						 <input type="hidden" name="venue_id" value="<?php echo $editvenue['venueid'];?>"/>
						 <input type="hidden" name="redirectid" value="<?php echo $this->uri->segment(4);?>" />
						 <input type="hidden" name="listvenue_vendor_id" value="<?php echo $this->uri->segment(5);?>" />
						    <button class="btn btn-info" type="submit" name="vendorsubmit">Submit</button>
						</div>
					  </div>			
                       </section>
					   
                       
                       
						<!--<h3>Facilities</h3>-->
                    <!--   <section>
                         <div class="form-group">
                    
							<div class="panel-body w-setting">
                                                            <ul class="team-list chat-list-side info statistics border-less-list setting-list" style="width: 1000px; height: 200px; overflow: auto">
						<?php
							$facility=str_split($facilities);				
						foreach($getfacilites as $getfacility){
							
						?>
                            <li>
                                <div class="inline">
                                        <span class="name">
                                            <?php echo stripslashes($getfacility->facility_name);?>
                                        </span>
                                </div>
                                    <span class="thumb-small">
									<input type="hidden" name="facility_id" value="<?php if(isset($getfacility->facility_id)){echo $getfacility->facility_id;}?>">
									
                                 <input type="checkbox" name="facilities[]" class="js-switch-small-green" value="<?php echo $getfacility->facility_id;?>"<?php if(in_array($getfacility->facility_id,$facility)){?> checked <?php } ?> />
                                    </span>
                            </li>
                            
						<?php } ?>
                        </ul>
                    </div>
                    
					</div>
                    </section>-->
			
					</div>
				<?php //} ?>
                 </form>
				</div>
            

           </div>

         </div>
            
        </div>
           		
<style>
	.wizard > .content{
		height:1030px;
	}
	</style>
