           <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Add Venue Facility
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $venue_id;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>admin/managevenuefacilities/<?php echo $venue_id;?>">Manage Venue Facilities</a></li>
                        <li class="active">Add Venue Facility</li>
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
                <!--    Form Elements-->
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/addvenuefacility/<?php echo $venue_id;?>" name="add_cat" method="POST" id="cat_frm" class="form-horizontal tasi-form" enctype="multipart/form-data">
                      
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
                                                                           
						<?php if($this->session->flashdata('error')){?>
						<div id="msg"><?php echo  $this->session->flashdata('error');?></div>
						<?php }?>
						
                               <div class="form-group">
                            <label class=" col-sm-2 col-sm-2 control-label" >Select Facility</label>
                            <div class="col-sm-10">
                                <select id="multiple" name="facility[]"  class="select2 form-control m-b-10" onchange="getval(this.value);" multiple>
                                    <option value="">-Select Facility-</option>
                                     <?php foreach($facilities as $facility ){?>
                                    <option value="<?php echo $facility->facility_id;?>"><?php echo stripslashes($facility->facility_name);?></option>
                                     <?php }?>
<!--                                    <option value="other">Other Facility</option>-->
                                </select>
								<?php echo form_error('facility')?>
                            </div>
							
                        </div>
                                                                                         
                                                
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="venueid" value="<?php echo $venue_id;?>" />
						<button class="btn btn-info" type="submit" name="faclsubmit">Submit</button>
						</div>
                        </div>
                        
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
