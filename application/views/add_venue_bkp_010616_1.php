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
	
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <?php $this->load->view("includes/admin_leftmenu");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
            <?php $this->load->view("includes/admin_header"); ?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Add Venue
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a>
                        </li>
                        <li><a href="<?php echo base_url();?>admin/managevenues">Venues</a>
                        </li>
                        <li class="active">Add Venue</li>
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
						<?php if($this->session->flashdata('venue_success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('venue_success');?></p>
                    </div>
								
						<?php }?>  
                        <div class="panel-body no-pad">

                            <form id="basic-form" action="<?php echo  base_url() ?>admin/addvenue" name="add_venue" method="POST" enctype="multipart/form-data">
                              
								<div>
                                    <h3>Venue</h3>
                                    <section>
									<!--<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="vendor_id">
									   <option value="">--Select Vendor--</option>
									   <?php //foreach($getallcompanies as $getcompany) { ?>
                                    <option value="<?php //echo $getcompany['vendor_id'];?>"><?php //echo $getcompany['company_name'];?></option>
									   <?php //} ?>
                                    
                                </select>
								<?php //echo form_error('vendor_id')?>
                            </div>
							
							</div>-->
							<!--<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label" >Vendors</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="vendors" id="vendors"  onchange="getvenues(this.value);">
								<?php //echo form_error('vendors')?>
                            </div>
							
                        </div>
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="form-control m-b-10 category" name="cat_id">
									   <option value="">-- Select Category --</option>
									   <?php //foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php //echo $getcategory->category_id;?>"><?php //echo $getcategory->category_name;?></option>
									   <?php //} ?>
                                    
                                </select>
								<?php //echo form_error('cat_id');?>
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
								<?php echo form_error('sub_cat_id')?>
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
								<?php echo form_error('sub_cat_id')?>
                            </div>
							</div>
							<!--<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select id="multiple" class="select2-multiple form-control m-b-10 category" name="cat_id[]" multiple>
									   <option value="">-- Select Category --</option>
									   <?php //foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php //echo $getcategory->category_id;?>"><?php //echo $getcategory->category_name;?></option>
									   <?php //} ?>
                                    
                                </select>
								<?php //echo form_error('cat_id');?>
                            </div>
							</div>
							<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Subcategories</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10 subcategory" name="sub_cat_id">
									   <option value="">--Select SubCategory--</option>
									   <?php //foreach($getallsubcats as $getallsubcat) { ?>
                                    <option value="<?php //echo $getallsubcat['sub_category_id'];?>"><?php //echo $getcategory['sub_category_name'];?></option>
									   <?php //} ?>
                                    
                                </select>
								<?php //echo form_error('sub_cat_id')?>
                            </div>
							</div>-->
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
					   
					   <h3>Contact</h3>
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
								<?php echo form_error('toll_location')?>
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
                       <h3>Working Timings</h3>
					   
                        <section>
						
						<div class="class-lg-10" ><input type="checkbox" name="days[]" value="1"  style="margin-right:5px;" checked="checked"/>Mon <input type="checkbox" name="days[]" value="2" style="margin-right:5px;" checked="checked"/> Tue <input type="checkbox" name="days[]" value="3" style="margin-right:5px;" checked="checked"/> Wed <input type="checkbox" name="days[]" value="4" style="margin-right:5px;" checked="checked"/> Thu <input type="checkbox" name="days[]" value="5" style="margin-right:5px;" checked="checked"/> Fri <input type="checkbox" name="days[]" value="6" style="margin-right:5px;" checked="checked" /> Sat <input type="checkbox" name="days[]" value="7" style="margin-right:5px;" checked="checked"/> Sun</div>
                                        <div class="form-group clearfix">
                            <label class="col-sm-12 col-sm-2 control-label"><strong>Working Timings</strong> </label>
                            
                        </div>
						<div class="form-group clearfix">
                           <!-- <label class="col-sm-2 col-sm-2 control-label">Monday</label>
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
					   
                       
                       <h3>Images</h3>
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
						<h3>Facilities</h3>
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
                                        <input type="checkbox" name="facilities[]" class="js-switch-small-green" value="<?php echo $getfacility->facility_id;?>" />
                                    </span>
                            </li>
                            
						<?php } ?>
                        </ul>
                    </div>
                    
					</div>
						
						
						<div class="form-group clearfix">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="vendor_id" value="<?php echo $this->uri->segment(3);?>" />
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

				<?php $this->load->view("includes/admin_footer");?>
				
<script type="text/javascript">
jQuery.noConflict();
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

<script>
jQuery(function() { //alert('testing');

    jQuery( "#vendors" ).autocomplete({
	  minLength: 4,
      source: '<?php echo base_url()?>admin/search'
	  
    });
  });

function getvenues(e){
//alert(e);
var url='<?php echo base_url()?>admin/getvenues';
    var title="Select Venue";
    jQuery.ajax({
		type:'POST',
		url:url,
		data:{'id': e },
		dataType:"JSON",
		success: function(data){
			//jQuery(".subcategory option[value='x']").remove();
			jQuery('#venue').html(data);
			jQuery('#venue').append('<option value="">' +  title + '</option>');
			for(i in data){
				jQuery('#venue').append('<option  value="'+ data[i].venue_id + '">' + data[i].venue_display_name +'</option>');
			}
		
		}
		
	});    
}
</script>

</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:05:03 GMT -->
</html>
