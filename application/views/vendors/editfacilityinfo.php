            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Edit Facility
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url()?>vendors/dashboard">Home</a></li>
                        <li><a href="<?php echo base_url()?>vendors/managevenues">Venues</a></li>
                        <li><a href="<?php echo base_url()?>vendors/managefacilities/<?php echo $venue_id;?>">Facilities</a></li>
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
                    <form action="<?php echo  base_url() ?>vendors/editfacilitydetails" name="add_cat" method="POST" id="cat_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                    
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
                                <input type="hidden" name="ofacility" value="<?php echo $facility_id;?>">
								<?php echo form_error('facility')?>
                            </div>
							
                        </div>
                                                
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="facilityid" value="<?php echo $getdetails->facility_id;?>">
						<button class="btn btn-info" type="submit" name="faclsubmit">Submit</button>
						</div>
                        </div>
                        
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
  