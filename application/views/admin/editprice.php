            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">Edit Pricing</h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                <div class="state-information">
                    <ol class="breadcrumb m-b-less bg-less">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
						  <li><a href="<?php echo base_url();?>admin/listvenue/<?php echo $venueid;?>">Venues List</a></li>
                        <li><a href="<?php echo base_url();?>admin/managepricing/<?php echo $venueid;?>">Pricing</a></li>
                        <li class="active">Edit Pricing</li>
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
                    <form action="<?php echo  base_url() ?>admin/editprice/<?php echo $priceid;?>/<?php echo $venueid;?>/<?php echo $type;?>" name="edit_price" method="POST" id="edit_price" class="form-horizontal tasi-form" enctype="multipart/form-data">
                    
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
                            <label class="col-sm-2 col-sm-2 control-label ">Venue Pricing SubCategory/SubSubCategory Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly="" name="scat" value="<?php if($getdetails->price_type == 3){echo $getdetails->sub_category_name;}else{echo $getdetails->sub_sub_category_name;}?>">
                                <input type="hidden" name="price_id" id="price_id" value="<?php echo $getdetails->price_id;?>">                             
              		
                        </div>
                         </div>
                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label ">Venue Pricing By</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" readonly="" value="<?php echo $getdetails->membership_name;?>">
                                <input type="hidden" name="ptype" id="ptype" value="<?php echo $getdetails->type; ?>">                              
                            </div>
							
                        </div>                                       
                            <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $getdetails->amount;?>" onkeyup="getamountchange(this.value)">
								<?php echo form_error('amount')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Discount Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="dtype" id="dtype" value="flat" readonly="">
								<?php echo form_error('dtype')?>
                            </div>
							
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Discount Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="damount" id="damount" value="<?php echo $getdetails->discount_amount;?>" onkeyup="getdiscount(this.value);"  >
								<?php echo form_error('damount')?>
                            </div>
							
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                            <div class="col-lg-10">
							<input type="hidden" name="venue_id" value="<?php echo $venueid;?>"/>
						<button class="btn btn-info" type="submit" name="usersubmit">Submit</button>
						</div>
                        </div>
                        
							
                    </form>
                </div>
            </section>
            
            

            

            </div>
            </div>

            </div>
            <!--body wrapper end-->
	