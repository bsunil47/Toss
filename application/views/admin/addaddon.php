            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                    Add Addon
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						<li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $getdetails->vendor_id;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>admin/manageaddons/<?php echo $venueid;?>">Addons</a></li>
                        <li class="active">Add Addon</li>
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
                    <?php if($this->session->flashdata('addon_error')){ ?>
						<div class="alert alert-danger alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Error!
                        </h4>
                        <p><?php echo  $this->session->flashdata('addon_error');?></p>
                    </div>
				
						<?php } ?>
                    <form action="<?php echo  base_url() ?>admin/addaddon/<?php echo $venueid;?>" name="add_addon" method="POST" id="cat_frm" class="form-horizontal tasi-form">
                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Addon Facility</label>
                            <div class="col-sm-10">
                                <select name="addon" id="facility" class="form-control m-b-10"  >
                                    <option value="">-Select -</option>
                                     <?php foreach($facilities as $facility ){?>
                                    <option value="<?php echo $facility->facility_id;?>"><?php echo stripslashes($facility->facility_name);?></option>
                                     <?php }?>
                                    <option value="other">Other</option>-->
                                </select>
								<?php echo form_error('addon')?>
                            </div>
							
                        </div>
                                                <div id="other" style="display: none;">	
                                                   <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Addon Type</label>
                            <div class="col-sm-10">
                               <select name="ptype" id="ptype"  class="form-control m-b-10">
                                    <option value="">-Select Addon Type-</option>
                                    <!--<option value="2">Category</option>-->
                                    <option value="2">Subcategory</option>
									   <option value="3">Sub Subcategory</option>
									
                                </select>
                                <?php echo form_error('ptype')?>
                                
                            </div>
							
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Addon Type Name</label>
                            <div class="col-sm-10">
                                <select name="type"  id="type" class="form-control m-b-10"></select>
                                <?php echo form_error('type')?>
                        </div>
							
                        </div>
			<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Add On Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="addon_name">
								<?php echo form_error('addon_name')?>
                            </div>
							
                        </div>
				     <div class="clearfix"></div>
                                                </div>
                        
                                   <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amount">
								<?php echo form_error('amount')?>
                            </div>
							
                        </div>            
                                                
                      <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="venue_id" value="<?php echo $venueid;?>" />
						<button class="btn btn-info" type="submit" name="addonsubmit">Submit</button>
						</div>
                        </div>
                        
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
            <script>
                 var venue_id=<?php echo $venueid;?>;
            </script>
            