<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/slicklab/form-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:58 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina">
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>TOSS</title>

    <?php $this->load->view("includes/admin_header_links");?>
	<style>
	.wizard > .content{
		height:1030px;
	}
	</style>
	
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <?php $this->load->view("includes/admin_leftmenu");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1200px;">

            <!-- header section start-->
            <?php $this->load->view("includes/admin_header"); ?>
            <!-- header section end-->

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
							</div>-->
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="select2 form-control m-b-10 category" name="cat_id[]" multiple>
									   <option value="">--Select Category--</option>
									   <?php 
									   
									   //$getcategories=(array)$getallcategories;
									   foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php echo $getcategory->category_id;?>"<?php if($editvenue['category_id']==$getcategory->category_id){?> selected <?php } ?>><?php echo $getcategory->category_name;?></option>
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
									  foreach($getallsubcategories as $getallsubcat) { ?>
                                    <option value="<?php echo $getallsubcat->sub_category_id;?>"<?php if($editvenue['sub_category_id']==$getallsubcat->sub_category_id){?> selected <?php } ?>><?php echo $getallsubcat->sub_category_name;?></option>
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
                                    <option value="<?php echo $getallsubsubcat->sub_sub_category_id;?>"<?php if($editvenue['sub_sub_category_id']==$getallsubsubcat->sub_sub_category_id){?> selected <?php } ?>><?php echo $getallsubcat->sub_category_name;?></option>
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
						<!--<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Tuesday</label>
								<input type="hidden" name="day_tue" value="2">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte[2]" value="<?php //if(isset($workinghours[1]->start_time)){echo $workinghours[1]->start_time;}?>" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[2]" value="<?php //if(isset($workinghours[1]->end_time)){echo $workinghours[1]->end_time;}?>" class="form-control timepicker-24_to">
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
                                        <input type="text" name="frm_dte[3]" value="<?php //if(isset($workinghours[2]->start_time)){echo $workinghours[2]->start_time;}?>" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[3]" value="<?php //if(isset($workinghours[2]->end_time)){echo $workinghours[2]->end_time;}?>" class="form-control timepicker-24_to">
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
                                        <input type="text" name="frm_dte[4]" value="<?php //if(isset($workinghours[3]->start_time)){echo $workinghours[3]->start_time;}?>" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[4]" value="<?php //if(isset($workinghours[3]->end_time)){echo $workinghours[3]->end_time;}?>"  class="form-control timepicker-24_to">
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
                                        <input type="text" name="frm_dte[5]" value="<?php //if(isset($workinghours[4]->start_time)){echo $workinghours[4]->start_time;}?>" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[5]" value="<?php //if(isset($workinghours[4]->end_time)){echo $workinghours[4]->end_time;}?>" class="form-control timepicker-24_to">
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
                                        <input type="text" name="frm_dte[6]" value="<?php //if(isset($workinghours[5]->start_time)){echo $workinghours[5]->start_time;}?>" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[6]" value="<?php //if(isset($workinghours[5]->end_time)){echo $workinghours[5]->end_time;}?>" class="form-control timepicker-24_to">
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
                                        <input type="text" name="frm_dte[7]" value="<?php //if(isset($workinghours[6]->start_time)){echo $workinghours[6]->start_time;}?>" class="form-control timepicker-24">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte[7]" value="<?php //if(isset($workinghours[6]->end_time)){echo $workinghours[6]->end_time;}?>" class="form-control timepicker-24_to">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php //echo form_error('c_city');?>
                            </div>
                        </div>-->

                       </section>
					   
                       
                       <h3>Images</h3>
                        <section>
						   <div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture1</label>
								<div class="col-lg-10">
								<!-- id="file-2" class="file"  multiple=true -->
								<div class="col-lg-5">
									<input type="file" name="venue_pic_1">
									</div>
									<div class="col-lg-5">
									<img src="<?php echo base_url()?>images/vendors/<?php echo $editvenue['vendor_id'];?>/<?php echo $editvenue['venueid'];?>/<?php echo $editvenue['venue_pic_1'];?>" name="venue_pic_1" width="200" height="100"/>
								</div>
								</div>
							</div>
							<div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture2</label>
								<div class="col-lg-10">
									<div class="col-lg-5">
									<input type="file" name="venue_pic_2">
									</div>
									<div class="col-lg-5">
									<img src="<?php echo base_url()?>images/vendors/<?php echo $editvenue['vendor_id'];?>/<?php echo $editvenue['venueid'];?>/<?php echo $editvenue['venue_pic_2'];?>" name="venue_pic_2" width="200" height="100"/>
								</div>
								</div>
							</div>
							<div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture3</label>
								<div class="col-lg-10">
								<div class="col-lg-5">
									<input type="file" name="venue_pic_3">
									</div>
									<div class="col-lg-5">
									<img src="<?php echo base_url()?>images/vendors/<?php echo $editvenue['vendor_id'];?>/<?php echo $editvenue['venueid'];?>/<?php echo $editvenue['venue_pic_3'];?>" name="venue_pic_3" width="200" height="100"/>
								</div>
								</div>
							</div>
							<div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture4</label>
								
								<div class="col-lg-10">
									<div class="col-lg-5">
									<input type="file" name="venue_pic_4">
									</div>
									<div class="col-lg-5">
									<img src="<?php echo base_url()?>images/vendors/<?php echo $editvenue['vendor_id'];?>/<?php echo $editvenue['venueid'];?>/<?php echo $editvenue['venue_pic_4'];?>" name="venue_pic_4" width="200" height="100"/>
									</div>
								</div>
							</div>
							<div class="form-group clearfix">
							<?php if($this->session->flashdata('error')){?>
							<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
							<?php }?>
								<label class="col-lg-2 col-sm-2 control-label">Venue Picture5</label>
								<div class="col-lg-10">
								<div class="col-lg-5">	
								<input type="file" name="venue_pic_5">
								</div>
								<div class="col-lg-5">
								<img src="<?php echo base_url()?>images/vendors/<?php echo $editvenue['vendor_id'];?>/<?php echo $editvenue['venueid'];?>/<?php echo $editvenue['venue_pic_5'];?>" name="venue_pic_5" width="200" height="100"/>
								</div>
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
            <!-- body wrapper end -->

				<?php $this->load->view("includes/admin_footer");?>
		
				
				
<script ="text/javascript">
//jQuery.noConflict();
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
var placeholder = "Select One";
	jQuery('select.select2').select2({
		placeholder: placeholder
	});
	
jQuery(document).on('change','.category',function(){
	var catid=jQuery(this).val();
	//var subcatid = jQuery("#multiple1").val();
	
	//alert(catid);
	//alert(subcatid);
     jQuery('.fac_cls').hide();
	 jQuery('.cat_'+catid).show();
	//alert(catid);
	//var datastring='catid'+catid;
	var url='<?php echo base_url()?>admin/categorychange';
	
	jQuery.ajax({
		type:'POST',
		url:url,
		data:{'catid': catid },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('.subappend').html(data);
			var first="Select One";
			jQuery('.subappend').append('<select id="multiple1" class="select2 form-control m-b-10 subcategory" name="sub_cat_id[]" multiple><option value="">' +  first + '</option>');
			for(i in data){
			jQuery('#multiple1').append('<option  value="'+ data[i].sub_category_id + '">' + data[i].sub_category_name +'</option>');
			}
			jQuery('#multiple1').append('</select>');
			var placeholder = "Select One";
				jQuery('select#multiple1').select2({
						placeholder: placeholder
				});
		}
		
	});

});

jQuery(document).on('change','.subcategory',function(){
	//alert("i am coming");
	//var catid=jQuery(this).val();
	var catid = jQuery("#multiple").val();
	var subcatid = jQuery(this).val();
	
	//alert(catid);
	//alert(subcatid);
     //jQuery('.fac_cls').hide();
	 //jQuery('.cat_'+catid).show();
	//alert(catid);
	//var datastring='catid'+catid;
	var url='<?php echo base_url()?>admin/subcategorychange';
	
	jQuery.ajax({
		type:'POST',
		url:url,
		data:{'catid': catid,'subcatid': subcatid },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('.subsubappend').html(data);
			var second="Select One";
			jQuery('.subsubappend').append('<select id="multiple2" class="select2 form-control m-b-10 subsubcategory" name="sub_sub_cat_id[]" multiple><option value="">' +  second + '</option>');
			for(j in data){
				jQuery('#multiple2').append('<option  value="'+ data[j].sub_sub_category_id + '">' + data[j].sub_sub_category_name +'</option>');
			}
			jQuery('#multiple2').append('</select>');
			var placeholder = "Select One";
				jQuery('select#multiple2').select2({
						placeholder: placeholder
				});
		}
		
	});
		//jQuery('select.select2').select2();

});
});
</script>
<!--<script type="text/javascript">

jQuery(document).on('change','.category',function(){
	//alert("I M HERE");
	var catid=jQuery(this).val();
	//alert(catid);
	//var datastring='catid'+catid;
	var url='<?php //echo base_url()?>admin/categorychange';
	jQuery.ajax({
		type:'POST',
		url:url,
		data:{'catid': catid },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('.subcategory').html(data);
			var first="Select Sub Category";
			jQuery('.subcategory').append('<option value="">' +  first + '</option>');
			for(i in data){
				jQuery('.subcategory').append('<option  value="'+ data[i].sub_category_id + '">' + data[i].sub_category_name +'</option>');
			}
		
		}
		
	});
});
</script>-->

</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:05:03 GMT -->
</html>
