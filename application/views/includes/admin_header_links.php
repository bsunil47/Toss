<!--right slidebar-->
    <link href="<?php echo base_url()?>css/slidebars.css" rel="stylesheet">

    <!--switchery-->
    <link href="<?php echo base_url()?>js/switchery/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
<?php

//echo $this->uri->segment(2);exit;
 if($this->uri->segment(2)=="addvenue" || $this->uri->segment(2)=="addvendor" || $this->uri->segment(2)=="editvendor" || $this->uri->segment(2)=="editvenueinfo" || $this->uri->segment(2)=="addslots" || $this->uri->segment(2)=="editslotinfo" || $this->uri->segment(2)=="addfacility") { ?>	

	  <!--bootstrap-fileinput-master-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/bootstrap-fileinput-master/css/fileinput.css" />
    <!--Form Wizard-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery.steps.css" />
    <link href="<?php echo base_url()?>css/tagsinput.css" rel="stylesheet">
	<!--dropzone-->
    <link href="<?php echo base_url()?>css/dropzone.css" rel="stylesheet">
	<!--Select2-->
    <link href="<?php echo base_url()?>css/select2.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/select2-bootstrap.css" rel="stylesheet">
    
	<!--bootstrap-touchspin-->
    <link href="<?php echo base_url()?>css/bootstrap-touchspin.css" rel="stylesheet">
	<?php } ?>
	   <!--common style-->
    <link href="<?php echo base_url()?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/style-responsive.css" rel="stylesheet">
     
	<?php
$segment=$this->uri->segment(2);
$array=array("managevendors","managevenues","manageappusers","manageusers","manageadminusers","managevenuemanagers","managecategories","managesubcategories","manageslots","managefacilities","managevenuefacilities","managepricing","managestaff","manageaddons","managecoins","managecustomers");
if(in_array($segment,$array )){?>
    <!--Data Table -->
    <link href="<?php echo base_url()?>js/data-table/css/jquery.dataTables.css" rel="stylesheet">
    <link href="<?php echo base_url()?>js/data-table/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="<?php echo base_url()?>js/data-table/css/dataTables.colVis.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>js/data-table/css/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url()?>js/data-table/css/dataTables.scroller.css" rel="stylesheet">
    
    <!-- Base Styles -->
 <?php } ?>
 <!--gritter-->
 <?php if($this->uri->segment(2)=="view_vendors" || $this->uri->segment(2)=="view_venue"){?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/gritter/css/jquery.gritter.css" />
	<?php } ?>
	<?php 
	$segments=$this->router->fetch_method();
	$comparearray=array("addvenue","addsubcategory","addpricing","editrequestcoinsinfo","editcoininfo","addvendor","addrequestcoins","getfacilitiesbybasetype","editvendor","editvenueinfo","addslots","editslotinfo","editsubcategory","addcoins");
	//$segments=$this->uri->segment(2);
	//$comparearray=array("addvenue");
	//$this->uri->segment(2)=="addsubcategory" || $this->uri->segment(2)=="addvenue" || $this->uri->segment(2)=="addvendor" || $this->uri->segment(2)=="editvendor" || $this->uri->segment(2)=="editvenueinfo" || $this->uri->segment(2)=="addslots" || $this->uri->segment(2)=="editslotinfo";
	if(in_array($segments,$comparearray)){?>
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
	<?php } ?>
	<!--Select2-->
	<?php /*if($this->uri->segment(2)=="addsubcategory" || $this->uri->segment(2)=="addvendor" || $this->uri->segment(2)=="editvendor") { ?>
    <link href="<?php echo base_url()?>css/select2.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/select2-bootstrap.css" rel="stylesheet">
	<?php } */?>
	<!-- End select -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<script>
	var base_url = '<?php echo base_url(); ?>';
	</script>
