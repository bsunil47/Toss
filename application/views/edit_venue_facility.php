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

    <title>TOSS</title>
<?php $this->load->view('includes/admin_header_links.php');?>
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
       <?php $this->load->view('includes/admin_leftmenu.php');?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
            <?php $this->load->view('includes/admin_header.php');?>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Edit Facility
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url()?>admin/listvenue/<?php echo $venue_id;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url()?>admin/managevenuefacilities/<?php echo $venue_id;?>">Manage Venue Facilities</a></li>
                        <li class="active">Edit Facility</li>
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
                 <!--   Form Elements-->
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/editfacilityvenuedetails" name="add_cat" method="POST" id="cat_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                    
						<?php if($this->session->flashdata('facility_success')){ ?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('facility_success');?></p>
                    </div>
				
						<?php } ?>
						<?php //echo "<pre>";print_r($editfacilities);exit;?>
                      <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Venue</label>
                            <div class="col-sm-10">
                                <select name="venue" class="form-control" id="venue" readonly>
                                    <option value="">-Select Venue-</option>
                                     <?php foreach($getvenues as $venue ){?>
                                    <option value="<?php echo $venue->venue_id;?>" <?php if($venue->venue_id==$getdetails->venue_id){?> selected=""<?php }?>><?php echo $venue->venue_display_name;?></option>
                                     <?php }?>
                                </select>
                               	<?php echo form_error('venue');?>
                            </div>
							
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Facility</label>
                            <div class="col-sm-10">
                                <select name="facility" id="facility" class="form-control" onchange="getval(this.value);">
                                    <option value="">-Select Facility-</option>
                                     <?php foreach($getallfacilities as $facility ){?>
                                    <option value="<?php echo $facility->facility_id;?>" <?php if($facility->facility_id==$getdetails->facility_id){?> selected=""<?php }?>><?php echo stripslashes($facility->facility_name);?></option>
                                     <?php }?>
<!--                                    <option value="other">Other Facility</option>-->
                                </select>
								<?php echo form_error('facility')?>
                            </div>
							
                        </div>
                                                <div id="other" style="display: none;">			
			<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Facility Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="faclty_name">
								<?php echo form_error('faclty_name')?>
                            </div>
							
                        </div>
                                                    
				<!--<div class="form-group">		
                            <label class="col-lg-2 col-sm-2 control-label">Facility Image</label>
                            <div class="col-lg-10">
							<input type="file" id="file-2" name="s_pan" class="file"  multiple=true>
                                <input type="file" name="facility_image" multiple=true>
                            </div>
                        </div>
                                                    
                 <div class="clearfix"></div>
                                                </div>
						<div id="fimg">
						<div class="form-group clearfix">
									
                            <label class="col-lg-2 col-sm-2 control-label">Facility Image</label>
                            <div class="col-lg-10">
							<!--<input type="file" id="file-2" name="s_pan" class="file"  multiple=true>
							<div class="col-lg-5">
                                <input type="file" name="facility1_image" multiple=true>
								</div>
								<div class="col-lg-5">
								<img src="<?php //echo base_url()?>images/facilities/<?php //echo $getdetails->facility_image;?>" name="facility_image" width="auto" height="100"/>
								</div>
                            </div>
                        </div>-->
                                                </div>
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<!--<input type="hidden" name="facilityid" value="<?php //echo $getdetails->facility_id;?>">-->
							<input type="hidden" name="ofacility" value="<?php echo $facility_id;?>">
						<button class="btn btn-info" type="submit" name="faclsubmit">Submit</button>
						</div>
                        </div>
                        
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
<?php $this->load->view('includes/admin_footer.php');?>

 <script>
                function getval(e){
                    if(e=='other'){
                        document.getElementById('other').style.display='block';
                        document.getElementById('fimg').style.display='none';
                    }else{
                        document.getElementById('other').style.display='none';
                         document.getElementById('fimg').style.display='block';
                    }
                }
                </script>

</body>

<!-- Mirrored from thevectorlab.net/slicklab/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 07:04:39 GMT -->
</html>
