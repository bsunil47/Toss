            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">Edit Addon</h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						  <li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $getvdetails->vendor_id;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>admin/manageaddons/<?php echo $venueid;?>">Adddons</a></li>
                        <li class="active">Edit Addon</li>
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
<!--                    Edit Pricing-->
                </header>
                <div class="panel-body">
                    <form action="<?php echo  base_url() ?>admin/editaddon/<?php echo $venueid;?>/<?php echo $base_type_id;?>/<?php echo $base_type;?>" name="edit_addon" method="POST" id="edit_price" class="form-horizontal tasi-form" enctype="multipart/form-data">
                    
						<?php if($this->session->flashdata('success')){?>
						<div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo  $this->session->flashdata('success');?></p>
                    </div>
				
						<?php }?>
						<?php //print_r($getdetails);?>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label ">Venue Display Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly="" name="vname" value="<?php echo $getdetails->venue_display_name;?>">
                            </div>
                         </div>
			 <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label ">Addon Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly="" name="atype" value="<?php if($getdetails->base_type == 1){echo "Category";}else if($getdetails->base_type==2){echo "Sub Category";}else{echo "Sub Sub Category";}?>">
                         </div>
                         </div>
                         <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label ">Addon For</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly="" name="afor" value="<?php if($getdetails->base_type == 1){echo $getdetails->category_name;}else if($getdetails->base_type==2){echo $getdetails->sub_category_name;}else{echo $getdetails->sub_sub_category_name;}?>">
                         </div>
                         </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label ">Addon Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly="" name="aname" value="<?php echo $getdetails->addon_name;?>">
                         </div>
                         </div>
                            <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $getdetails->amount;?>">
								<?php echo form_error('amount')?>
                            </div>
							
                        </div>
                                            
                         <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="venue_id" value="<?php echo $venueid;?>"/>
                                                        <input type="hidden" name="base_type_id" value="<?php echo $base_type_id;?>"/>
                                                        <input type="hidden" name="base_type" value="<?php echo $base_type;?>"/>
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
	