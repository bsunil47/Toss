            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Add Facility
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>venues/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>venues/managefacilities">Facilities</a></li>
					    <li class="active">Add Facility</li>
                    </ol>
                </div>
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
          <div class="row">
            <div class="col-lg-12">
            <section class="panel">
                <!--<header class="panel-heading">
                    Add Facility
                </header>-->
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>venues/addfacility" name="add_facility" method="POST" id="cat_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      
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
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Facility</label>
                            <div class="col-sm-10">
                                <select  id="multiple" class="select2-multiple form-control m-b-10" name="facility[]" multiple >
                                    <option value="">-Select Facility-</option>
                                    <?php  foreach($facilities as $facility){?>
                                    <option value="<?php echo $facility->facility_id;?>"><?php echo stripslashes($facility->facility_name);?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('facility')?>
                            </div>
						</div>
						
						
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
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
	