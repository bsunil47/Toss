<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina">
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>form layout</title>

    <!--right slidebar-->
    <link href="<?php echo base_url()?>css/slidebars.css" rel="stylesheet">

    <!--switchery-->
    <link href="<?php echo base_url()?>js/switchery/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />

    <!--bootstrap-fileinput-master-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/bootstrap-fileinput-master/css/fileinput.css" />

    <!--common style-->
    <link href="<?php echo base_url()?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/style-responsive.css" rel="stylesheet">
	<!--tagsinput-->
    <link href="<?php echo base_url()?>css/tagsinput.css" rel="stylesheet">
	<!--dropzone-->
    <link href="<?php echo base_url()?>css/dropzone.css" rel="stylesheet">
<!--Select2-->
    <link href="<?php echo base_url()?>css/select2.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/select2-bootstrap.css" rel="stylesheet">
    
	<!--bootstrap-touchspin-->
    <link href="<?php echo base_url()?>css/bootstrap-touchspin.css" rel="stylesheet">

    <!--bootstrap picker-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/bootstrap-datepicker/css/datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/bootstrap-timepicker/compiled/timepicker.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/bootstrap-colorpicker/css/colorpicker.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/bootstrap-datetimepicker/css/datetimepicker.css"/>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <?php include_once("includes/admin_leftmenu.php");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
            <?php include_once("includes/admin_header.php");?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Form Layout
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Form</a></li>
                        <li class="active">Form Layout</li>
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
                    Form Elements
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/addvenue" name="add_venue" method="POST" id="venue_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                    
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
						<?php if($this->session->flashdata('t_and_c_error')){?>
						<div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Request!&nbsp;</strong><?php echo  $this->session->flashdata('t_and_c_error');?>
                    </div>
								
						<?php }?>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Vendor</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="company_id">
									   <option value="">--Select Company--</option>
									   <?php foreach($getallcompanies as $getcompany) { ?>
                                    <option value="<?php echo $getcompany['v_id'];?>"><?php echo $getcompany['company_name'];?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('company_id')?>
                            </div>
							</div>
							<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">categories</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="cat_id">
									   <option value="">--Select Category--</option>
									   <?php foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php echo $getcategory['cat_id'];?>"><?php echo $getcategory['category_name'];?></option>
									   <?php } ?>
                                    
                                </select>
								<?php echo form_error('cat_id')?>
                            </div>
							</div>
							<!--<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Subcategory </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10" name="cat_type">
									   <option value="">--Select Sub Category--</option>
									   <?php //foreach($getallcategories as $getcategory) { ?>
                                    <option value="<?php //echo $getcategory['category_name'];?>"><?php //echo $getcategory['category_name'];?></option>
									   <?php //} ?>
                                    
                                </select>
								<?php echo form_error('cat_type')?>
                            </div>
                        </div>-->
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="v_name" value="<?php if(isset($_POST['v_name'])){echo $_POST['v_name'];}else{echo "";}?>">
								<?php echo form_error('v_name')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Display Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="v_disp_name" value="<?php if(isset($_POST['v_disp_name'])){echo $_POST['v_disp_name'];}else{echo "";}?>">
								<?php echo form_error('v_disp_name')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Address-1</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="v_add1" value="<?php if(isset($_POST['v_add1'])){echo $_POST['v_add1'];}else{echo "";}?>" placeholder="">
								<?php echo form_error('v_add1')?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Address-2</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="v_add2" value="<?php if(isset($_POST['v_add2'])){echo $_POST['v_add2'];}else{echo "";}?>"  placeholder="">
								<?php echo form_error('v_add2')?>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue City</label>
                            <div class="col-sm-10">
                                <input type="text" name="v_city" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['v_city'])){echo $_POST['v_city'];}else{echo "";}?>" >
								<?php echo form_error('v_city');?>
                            </div>
                        </div>
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
				<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Venue State</label>
                            <div class="col-lg-10">
                                 <input type="text" name="v_state" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['v_state'])){echo $_POST['v_state'];}else{echo "";}?>" >
									<?php echo form_error('v_state');?>
							</div>
                        </div>
						
						<!-- vendor details form start -->
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Country</label>
                            <div class="col-sm-10">
                                <input type="text" name="v_country" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['v_country'])){echo $_POST['v_country'];}else{echo "";}?>">
								<?php echo form_error('v_country');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Venue Pincode</label>
                            <div class="col-sm-10">
                                <input type="text" name="v_pincode" class="form-control" id="focusedInput"  value="<?php if(isset($_POST['v_pincode'])){echo $_POST['v_pincode'];}else{echo "";}?>">
								<?php echo form_error('v_pincode');?>
                            </div>
							
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-12 col-sm-2 control-label"><strong>Working days</strong> </label>
                            
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Monday</label>
								<input type="hidden" name="day_mon" value="1">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte1" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
								To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte1" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Tuesday</label>
								<input type="hidden" name="day_tue" value="2">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte2" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte2" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Wednesday</label>
								<input type="hidden" name="day_wed" value="3">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte3" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte3" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Thursday</label>
								<input type="hidden" name="day_thr" value="4">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte4" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte4" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Friday</label>
								<input type="hidden" name="day_fri" value="5">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte5" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte5" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Saturday</label>
								<input type="hidden" name="day_sat" value="6">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte6" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div><div class="col-sm-5">To <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte6" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Sunday</label>
								<input type="hidden" name="day_sun" value="7">
                            <div class="col-sm-5">
                              From
								<div class="input-group bootstrap-timepicker">
                                        <input type="text" name="frm_dte7" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div> 
							 </div>
							 <div class="col-sm-5">
							 To 
							 <div class="input-group bootstrap-timepicker">
                                        <input type="text" name="to_dte7" class="form-control timepicker-default">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                        </span>
                             </div>
								<?php echo form_error('c_city');?>
                            </div>
                        </div>
						
						<div class="form-group">
						<?php if($this->session->flashdata('error')){?>
						<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
                            <label class="col-lg-2 col-sm-2 control-label">Venue Picture</label>
                            <div class="col-lg-10">
                                <input type="file" id="file-2" name="v_pic" class="file"  multiple=true>
                            </div>
                        </div>
						<div class="form-group">
						
                            <label  class="col-sm-2 col-sm-2 control-label">Facilities</label>
                            <div class="col-sm-10">
                                <input type="text" name="v_facilities[]" class="form-control" id="box1"  value="<?php if(isset($_POST['c_add2'])){echo $_POST['c_add2'];}else{echo "";}?>">
								   
								<?php echo form_error('c_add2');?>
                            </div>
							
                       </div>
					   <!--<div class="my-form form-group">
						<p class="text-box">
                            <label for="box1" class="col-sm-2 col-sm-2 control-label">Facilities<span class="box-number">1</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="v_facilities[]" class="form-control" id="box1"  value="<?php if(isset($_POST['c_add2'])){echo $_POST['c_add2'];}else{echo "";}?>">
								   <a class="add-box" href="#">Add More</a>
								<?php echo form_error('c_add2');?>
                            </div>
							</p>
                       </div>-->
						<!--<div class="my-form">
        
            <p class="text-box">
                <label for="box1">Box <span class="box-number">1</span></label>
                <input type="text" name="boxes[]" value="" id="box1" />
                <a class="add-box" href="#">Add More</a>
            </p>
            <p><input type="submit" value="Submit" /></p>
        
    </div>-->
						<!-- vendor details form close -->
						<div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
						<button class="btn btn-info" type="submit" name="venuesubmit">Submit</button>
						</div>
                        </div>
                        <!--<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Disabled</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Placeholder</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" placeholder="placeholder">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">Static control</label>
                            <div class="col-lg-10">
                                <p class="form-control-static">email@example.com</p>
                            </div>
                        </div>

                        
							
								
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">Textarea</label>
                            <div class="col-lg-10">
                                <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>-->
							
                    </form>
                </div>
            </section>
            <!-- <section class="panel">
                <div class="panel-body">
                    
                       <div class="form-group has-success">
                            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Input with success</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputSuccess">
                            </div>
                        </div>
                        <div class="form-group has-warning">
                            <label class="col-sm-2 control-label col-lg-2" for="inputWarning">Input with warning</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputWarning">
                            </div>
                        </div>
                        <div class="form-group has-error">
                            <label class="col-sm-2 control-label col-lg-2" for="inputError">Input with error</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputError">
                            </div>
                        </div>
                    
                </div>
            </section>
            <section class="panel">
                <div class="panel-body">
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Control sizing</label>
                            <div class="col-lg-10">
                                <input class="form-control input-lg m-b-10" type="text" placeholder=".input-lg">
                                <input class="form-control m-b-10" type="text" placeholder="Default input">
                                <input class="form-control input-sm m-b-10" type="text" placeholder=".input-sm">

                                <select class="form-control input-lg m-b-10">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                                
                                <select class="form-control input-sm m-b-10">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </section>-->
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->


            <!--footer section start-->
            <footer>
                2015 &copy; SlickLab by VectorLab.
            </footer>
            
            
        <!-- body content end-->
    </section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?php echo base_url()?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url()?>js/jquery-migrate.js"></script>
<script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="<?php echo base_url()?>js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="<?php echo base_url()?>js/slidebars.min.js"></script>

<!--switchery-->
<script src="<?php echo base_url()?>js/switchery/switchery.min.js"></script>
<script src="<?php echo base_url()?>js/switchery/switchery-init.js"></script>

<!--Sparkline Chart-->
<script src="<?php echo base_url()?>js/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo base_url()?>js/sparkline/sparkline-init.js"></script>


<!--bootstrap-fileinput-master-->
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-fileinput-master/js/fileinput.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/file-input-init.js"></script>
<!--bootstrap picker-->
<!--<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>-->
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>-->
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<!--picker initialization-->
<script src="<?php echo base_url()?>js/picker-init.js"></script>
<!--common scripts for all pages-->
<script src="<?php echo base_url()?>js/scripts.js"></script>
<!--Add more jquery-->
<script type="text/javascript">
jQuery(document).ready(function($){
    $('.my-form .add-box').click(function(){
        var n = $('.text-box').length + 1;
        /*if( 5 < n ) {
            alert('Stop it!');
            return false;
        }*/
        var box_html = $('<p class="text-box"><label for="box' + n + '">Box <span class="box-number">' + n + '</span></label> <input type="text" name="v_facilities[]" value="" id="box' + n + '" /> <a href="#" class="remove-box">Remove</a></p>');
        box_html.hide();
        $('.my-form p.text-box:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });
    $('.my-form').on('click', '.remove-box', function(){
        $(this).parent().css( 'background-color', '#FF6C6C' );
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
            $('.box-number').each(function(index){
                $(this).text( index + 1 );
            });
        });
        return false;
    });
});
</script>

</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
